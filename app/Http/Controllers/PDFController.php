<?php 
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use PDF;
use Session;
use App\CustomerPrescription;
use App\VendorPrescription;
use App\Customer;
use App\AssistantBoyBooking;
use App\VendorInvoice;
use Config;
  
class PDFController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request,$order_id)
    {
        $filename = 'invoice_'.time().'_'.$order_id.'.pdf';
  
        $data = [
            'title' => 'Generate PDF using Laravel TCPDF - ItSolutionStuff.com!'
        ];

        $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $prescription = CustomerPrescription::where('order_id',$order_id)->first();
            //$vendor_id = $prescription->customer_id;
            $prescription_id = $prescription->id;
        $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription_id)->whereNotIn('status',[0,2])->first();
        $vendor_id = $VendorPrescriptionexist->vendor_id;
        $vendor = Customer::where('account_id',4)->where('id',$vendor_id)->first();
        $customer = AssistantBoyBooking::where('booking_id',$order_id)->first();
        $vendorDetails = json_decode($vendor->meta);
        $medicines          = json_decode($prescription->medicine, true);
        if($customer){
            $customer_address   = json_decode($customer->customer_meta, true);
        }else{
            $customer_address   = '';//json_decode($customer->customer_meta, true);
        }
        
        $allmedicines = VendorInvoice::where('order_id',$order_id)->where('is_deleted',0)->get();

        $data = ['vendor' => $vendor ,
        'vendorDetails' => $vendorDetails,
        'prescription' => $prescription,
        'allmedicines' => $allmedicines,
        'medicines' => $medicines,
        'customer_address' => $customer_address,
        'account_prefix' => $account_prefix,
        'VendorPrescriptionexist' => $VendorPrescriptionexist,
        'customer' => $customer
        ];
        

//         $html = view('pdf.invoice',['vendor' => $vendor ,
//         'vendorDetails' => $vendorDetails,
//         'prescription' => $prescription,
//         'allmedicines' => $allmedicines,
//         'medicines' => $medicines,
//         'customer_address' => $customer_address,
//         'account_prefix' => $account_prefix,
//         'VendorPrescriptionexist' => $VendorPrescriptionexist
//         ])->render();
// return $html;
// exit;
        $html = view()->make('pdf.invoice', $data)->render();
 //return $html;
//exit;       
        $pdf = new PDF;
          
        $pdf::SetTitle('Invoice of '.$order_id);
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
  
        $pdf::Output(public_path($filename), 'F');
  
        return response()->download(public_path($filename));
    }
}