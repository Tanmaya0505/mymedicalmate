<?php 
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Session;
use DB;
use App\BookingCommision;
use App\VendorPrescription;
use App\Customer;
use App\AssistantBoyBooking;
use App\VendorInvoice;
use Config;
use Razorpay\Api\Api;
use App\Payment;
use App\Helpers\CustomerHelper;
use Carbon\Carbon;
  
class PaymentController extends Controller
{

    public function paymentdueadmin(Request $request){

        return view('payment.payment_due_admin');

    }
    public function afterpaymentdueadmin(Request $request){
        $vendor_id = Session::get('userId');

        $commisionlist = BookingCommision::with('vendor','vendornotify')->orderBy('id','DESC')
        ->select('*',DB::raw("SUM(admin_amt) as totalAmount"))
        ->where('admin_status','unpaid')
        ->where('vendor_id',$vendor_id)
        ->groupBy('vendor_id')
        ->get();
        if(count($commisionlist) > 0){
            foreach($commisionlist[0]->vendornotify as $com_notfy){

                $com_notfy->status = 'Paid';
                $com_notfy->save();

            }
        }
       
        BookingCommision::with('vendor','vendornotify')->orderBy('id','DESC')
        ->where('admin_status','unpaid')
        ->where('vendor_id',$vendor_id)->update(['admin_status'=>'Paid']);
        //dd($commisionlist);
        $customer = Customer::where('id',$vendor_id)->first();
        $customer->status = 1;
        $customer->admin_pay_due = 0;
        $customer->save();
        Session::put('accountStatus', 1);
        return redirect()->to('/vendor/my-profile');

        

    }

    public function razorpay(Request $request)
    {    
        $id = $request->id;
        $data = $request->desc;
        $medmateconfig = CustomerHelper::configData('assistant_config');
        $price = $medmateconfig['serial_no_booking_charge'];
        $booking_type = 'Serial Booking';
        if(isset($request->type) && $request->type=='serviceclose'){
            $booking_type = 'Service Close';
            $price = $request->amount;
        }
        $payment = Payment::where('booking_id',$id)->first();
            if(!$payment){
                $payment = new Payment();
                $payment->booking_id = $id;
                $payment->transaction_id = uniqid();
                $payment->booking_type  = $booking_type;
                $payment->status  = 'Inprogress';
                $payment->booking_start_date  = Carbon::now();
                $payment->payment_start_response  = $data;
                $payment->save();
            }  
            $payment->amount = $price;
            $payment->key_id = env('RAZOR_KEY'); 
            $payment->name = env('APP_NAME');
            $payment->payment_mode = 1;
            $payment->code = 200;
            return $payment; 
        //return view('payment.index',compact('payment','price'));
    }

    public function payment(Request $request)
    {        
        $input = $request->all();       
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        $booking_id = $payment->description; 
        $paymentdata = Payment::where('booking_id',$booking_id)->first();
        $booking = AssistantBoyBooking::where('booking_id',$booking_id)->first();
        $start_response = json_decode(CustomerHelper::getdataencrypt($paymentdata->payment_start_response));
        //dd($payment->toArray());
        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                
                $booking_desc = CustomerHelper::setdataencrypt(json_encode($response->toArray()));
                $paymentdata->status  = 'Success';
                $paymentdata->booking_end_date  = Carbon::parse($response['created_at'])->format('Y-m-d H:i:s');
                $paymentdata->payment_end_response  = $booking_desc;
                $paymentdata->save();
                if($booking){
                    if($start_response->type=='Serial Booking'){
                        $booking->payment_receive_status = 3;
                        $booking->paid = 1;
                        $booking->save();
                    }
                    if($start_response->type == 'Service Close'){
                        $booking->paid = 1;
                        $booking->save();

                    }
                }
            } 
            catch (\Exception $e) 
            {
                echo $e->getMessage();exit;
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }            
        }else{
            
                $paymentdata->status  = 'Failed';
                
                $paymentdata->save();
                \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
                return redirect()->to($start_response->next_url);
        }
        
        \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->to($start_response->next_url);
    }
}