@extends('frontend-source.customer-dashboard.layouts.master')
@section('title') Create Invoice @stop
@section('keywords') Create Invoice @stop
@section('description') Create Invoice @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 Prescription-view-details">
                <h4 class="mb-4">View INVOICE</h4>
               
                
                <div class="card page-content invoice-page">
                    <div class="px-0">
                        <div class="mt-4">
                            <div class="col-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <small class="text-sm text-grey-m2 align-middle">Billing To:</small>
                                            <div class="name">{{$vendorDetails->name_of_store}}</div>
                                        </div>
                                        <div class="text-grey-m2 billing-details">
                                            <div class="my-1"><span>A:</span>{{$vendorDetails->store_address}}, {{$vendorDetails->dist}}, {{$vendorDetails->state}} - {{$vendorDetails->pincode}}</div>
                                            <div class="my-1"><span>P:</span>{{$vendorDetails->phone}}</div>
                                            <div class="my-1"><span>E:</span>{{$vendorDetails->email}}</div>
                                        </div>
                                    </div>
                                    <div class="text-95 col-md-6 align-self-start d-sm-flex justify-content-end">
                                        <hr class="d-sm-none" />
                                        <div class="text-grey-m2">
                                            <h3>Invoice</h3>

                                            <div class="my-2"><span class="text-600 text-90">ID:</span> #{{$prescription->order_id}}</div>

                                            <div class="my-2"><span class="text-600 text-90">Issue Date:</span> {{Carbon\Carbon::now()->format('m-d-Y')}}</div>
                                        </div>
                                    </div>
                                </div>



                                <div class="res-table mt-4">

    <div class="row t-row header">
      <div class="col-1 cell c-deep">
        #
      </div>
      <div class="col-5 cell c-deep after">
        Medicine Name
      </div>
      <div class="col-2 cell text-center">
        Qty
      </div>
      <div class="col-2 cell">
        Unit Price
      </div>
      <div class="col-2 cell">
        Amount
      </div>
      <div class="col-1 cell">
        
      </div>
    </div>
    @php
    $total_amount = '0.00';

    @endphp
    @forelse($allmedicines as $key => $med)
    @php
    $total_amount = $total_amount+$med->total_price;
    @endphp
    <div class="t-row">
      <div class="cell" data-title="#">
       {{$key+1}}
      </div>
      <div class="cell" data-title="Description">
        {{$med->medicine_name}}
      </div>
      <div class="cell text-center" data-title="Qty">
        {{$med->quantity}}
      </div>
      <div class="cell" data-title="Unit Price">
        {{number_format($med->price,2)}}
      </div>
      <div class="cell" data-title="Amount">
        Rs.{{number_format($med->total_price,2)}}
      </div>
      <div class="cell" data-title="Amount">
        <!-- <a href="{{url('/vendor/delete-medicine/'.$med->id)}}" onclick='return confirm("Are you sure to remove this Medicine?")'>X</a> -->
      </div>
    </div>
    @empty
    @endforelse
    

  </div>



                                <div class="invoice-table">
                                    <div class="row mt-3 border-tb">
                                        <div class="col-12 col-sm-5 col-md-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                        @if($VendorPrescriptionexist->payment_status==1)    
                                            <div class="row my-2">
                                                <div class="col-7 text-right">
                                                    <h1>Paid</h1>
                                                </div>
                                                
                                            </div>
                                        @endif
                                        </div>
                                        <div class="col-12 col-sm-7 col-md-5 text-grey text-90 order-first order-sm-last">
                                            <div class="row my-2">
                                                <div class="col-7 text-right">
                                                    SubTotal
                                                </div>
                                                <div class="col-5">
                                                    <span class="text-secondary-d1 pl10">Rs.{{number_format($total_amount,2)}}</span>
                                                </div>
                                            </div>
                                            @php
                                            $tax = 2;
                                            if(!$customer){
                                                $vendor_discount = $vendorDetails->discount;
                                                $total_discount =number_format(($total_amount*($vendorDetails->discount/100)),2);
                                                $tax_amount  = number_format((($total_amount-$total_discount)*($tax/100)),2);
                                                $total_final = number_format(($total_amount-$total_discount+$tax_amount),2);
                                            }else{
                                                $vendor_discount = $VendorPrescriptionexist->discount;
                                                $total_discount =number_format(($total_amount*($VendorPrescriptionexist->discount/100)),2);
                                                $tax_amount  = number_format((($total_amount-$total_discount)*($tax/100)),2);
                                                $total_final = number_format(($total_amount-$total_discount+$tax_amount),2);
                                            }
                                            $total_final_amount = $total_final;
                                            @endphp
                                            <div class="row my-2">
                                                <div class="col-7 text-right">
                                                    Discount ({{$vendor_discount}}%)
                                                </div>
                                                <div class="col-5">
                                                    <span class="text-secondary-d1 pl10">Rs. {{$total_discount}}</span>
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-7 text-right">
                                                    Tax ({{$tax}}%)
                                                </div>
                                                <div class="col-5">
                                                    <span class="text-secondary-d1 pl10">Rs. {{$tax_amount}}</span>
                                                </div>
                                            </div>
                                            <div class="row align-items-center total-amount">
                                                <div class="col-7 col-lg-7 col-sm-6 text-right total">
                                                    Total Amount
                                                </div>
                                                <div class="col-5 col-lg-5 col-sm-6">
                                                    <span class="amount">Rs. {{$total_final}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="row contact-inf mb50">
                                        <div class="col-md-8">
                                            <p>My Medical Mate</p>
                                            <p>{{$vendorDetails->email}}</p>
                                            <p>Call:{{$vendorDetails->phone}}</p>
                                        </div>
                                        
                                        <div class="col-md-4">
                                        <a class="btn btn-primary btn-fill" href="{{url('invoice-order-download/'.$prescription->order_id)}}">Download</a>
                                        </div>
                                        
                                        
                                    </div>
                                    @if($VendorPrescriptionexist->payment_status==0)
                                    <div class="row contact-inf mb50">
                                        <div class="col-md-8">
                                            <a class="btn btn-primary btn-fill" onClick="getPayment({{$prescription->order_id}})" href="javascript:void(0)">Pay Rs {{$total_final}}</a>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <a class="btn btn-primary btn-fill" onClick="getCancel({{$prescription->order_id}})" href="javascript:void(0)">Cancel</a>
                                        </div>
                                        
                                        
                                    </div>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="addMedicine" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addMedicineLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title text-uppercase" id="addMedicineLabel"><i class="nc-icon nc-notes"></i> Add Medicine</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="doctor-widget"></div>

                <form novalidate id="add-medicine-form" action="{{url('/vendor/add-medicine')}}" method="post">
                  @csrf
                    <input type="hidden" name="booking_id" id="booking_id" value="{{$prescription->order_id}}" />
                    <input type="hidden" name="vendor_id" id="vendor_id" value="{{$vendor->id}}" />

                    

                    <div class="form-group">

                        <label for="recipient-name" class="col-form-label">Medicine:</label>

                        <input type="text" class="form-control" id="medicine" required="" name="medicine">

                        <div class="invalid-feedback">Please enter medicine name</div>

                    </div>
                    <div class="form-group">

                        <label for="recipient-name" class="col-form-label">Quantity:</label>

                        <input type="number" class="form-control" name="quantity" required="" id="quantity">

                        <div class="invalid-feedback">Please enter quantity</div>

                    </div>
                    <div class="form-group">

                        <label for="recipient-name" class="col-form-label">Price:</label>

                        <input type="number" class="form-control" name="price" required="" id="price">

                        <div class="invalid-feedback">Please enter price</div>

                    </div>

                    <div class="form-group">

                        <button type="submit" id="btn-addmedicine" class="btn btn-primary btn-sm btn-fill">Add</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="cancelPrescriptionPurchase" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addMedicineLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title text-uppercase" id="addMedicineLabel"><i class="nc-icon nc-notes"></i>We respect your decision and we would love to listen!</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="doctor-widget"></div>

                <form novalidate id="cancel-prescription-form" action="{{url('/assistant/cancel-prescription')}}" method="post">
                  @csrf
                    <input type="hidden" name="booking_id" id="booking_id" value="{{$prescription->order_id}}" />
                    <input type="hidden" name="vendor_id" id="vendor_id" value="{{$vendor->id}}" />

                    

                    <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center ">
                                            
                                            <input type="radio" required="" value="I Forgot to add all medicines" id="a1" name="cancel_reason" />
                                            <label for="a1" style="margin-bottom:0 !important">I Forgot to add all medicines</label>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center ">
                                                <input type="radio" required="" value="I got the same medicines at low price" id="a2" name="cancel_reason" />
                                            <label for="a2" style="margin-bottom:0 !important">I got the same medicines at low price</label>
                                            
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center ">
                                                <input type="radio" required="" value="I Insufficient of money" id="a3" name="cancel_reason" />
                                            <label for="a3" style="margin-bottom:0 !important">I Insufficient of money </label>
                                            
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center ">
                                                <input type="radio" required="" value="Patient change the mind" id="a4" name="cancel_reason" />
                                            <label for="a4" style="margin-bottom:0 !important">Patient change the mind</label>
                                             
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center ">
                                                <input type="radio" required="" value="Write the cause of cancellation" id="a5" name="cancel_reason" />
                                            <label for="a5" style="margin-bottom:0 !important">I Write the cause of cancellation</label>
                                            
                                            </li>
                                        </ul>

                    <div class="form-group">

                        <button type="submit" id="btn-addmedicine" class="btn btn-primary btn-sm btn-fill">Submit Now</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="paymentPrescriptionPurchase" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addMedicineLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title text-uppercase" id="addMedicineLabel"><i class="nc-icon nc-notes"></i>Payment For Medicines!</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="doctor-widget"></div>

                <form novalidate id="payment-prescription-form" action="{{url('/assistant/payment-prescription')}}" method="post">
                  @csrf
                    <input type="hidden" name="booking_id" id="booking_id" value="{{$prescription->order_id}}" />
                    <input type="hidden" name="vendor_id" id="vendor_id" value="{{$vendor->id}}" />
                    <input type="hidden" name="total_amount" id="total_amount" value="{{$total_final_amount}}" />
                    <input type="hidden" name="coin_amount" id="coin_amount" value="0" />
                    

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center ">
                        
                        Total Payable  <span id="total_amount_view">Rs.{{$total_final}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center ">
                            <p>Total Available Coin ({{$user->total_coin}})<br><span class="alert alert-warning"><span>10 coins = Rs.1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
                            You can use max 50 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br> coin on each payment!</span></span></p>
                            <p><input type="checkbox" id="is_apply_coin" name="is_apply_coin" value="50"> <label for="is_apply_coin">Apply coin 50</label></p>
                            
                        </li>
                        <!-- <li class="list-group-item d-flex justify-content-between align-items-center ">
                           <p> Apply coupon? </p>

                           <p><input type="text" required="" value=""  name="coupon" class="form-control" /></p>
                        
                        </li> -->
                        <li class="list-group-item d-flex justify-content-between align-items-center ">
                            <select class="form-control border-0" onChange="getPaymentType(this)" name="payment_type">
                                <option>Cash</option>
                                <option>UPI/Online</option>
                            </select>
                         
                        </li>
                        <li class="list-group-item  justify-content-between align-items-center upionline" style="display:none">
                           <span id="div1"> {{$vendorDetails->upi_id}} </span>

                           <p class="float-right"><button type="button"  class="btn btn-primary" id="button1" onclick="CopyToClipboard('div1')">Copy</button></p>
                        
                        </li>
                        <li class="list-group-item  justify-content-between align-items-center upionline" style="display:none">
                           <p> Upload the payment proof <span id="prev_receipt"></span>

                           <button type="button" id="button1" class="btn btn-primary float-right" onclick="getFile()">Upload</button></p>
                           
                        
                        </li>
                    </ul>
                    <div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" type="file" value="upload" onchange="sub(this)" /></div>
                    <p class="mt-2">Please confirm your payment by clicking on paid bottom 
                        and send to medical mate</p>
                    <div class="form-group mt-5">

                        <button type="submit" id="btn-paid" class="btn btn-primary btn-sm btn-fill">PAID {{$total_final}}</button>
                        <button type="button" id="btn-after-paid" style="display:none" class="btn btn-success btn-sm btn-fill"><i class="fa fa-check" aria-hidden="true"></i>PAID {{$total_final}}</button>
                        <a href="{{ url($account_prefix.'/status-change/4/'.$vendor->id.'/'.$prescription->order_id) }}" id="btn-sendmedicalmate" disabled class="btn btn-primary btn-sm btn-fill float-right">SEND TO MEDICINE STORE </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@endsection
@push('script')
<script type="text/javascript">
var prefix = "@php echo $account_prefix @endphp";

function CopyToClipboard(containerid) {
  if (document.selection) {
    var range = document.body.createTextRange();
    range.moveToElementText(document.getElementById(containerid));
    range.select().createTextRange();
    document.execCommand("copy");
  } else if (window.getSelection) {
    var range = document.createRange();
    range.selectNode(document.getElementById(containerid));
    window.getSelection().addRange(range);
    document.execCommand("copy");
    //alert("Text has been copied!")
  }
}

function getFile() {
  document.getElementById("upfile").click();
}
function sub(obj) {
  var file = obj.value;
  var fileName = file.split("\\");

  var file = $(obj).get(0).files[0];
  console.log(file);
  var url = obj.value;
  var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
  
        if (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg") {
            var img = $('<img />', { 
                  id: 'Myid',
                  src: 'MySrc.gif',
                  alt: 'MyAlt',
                  height:'10px',
                  width:'10px'
                });
            if(file){
                var reader = new FileReader();
     
                reader.onload = function(){
                    img.attr('src', reader.result);
                    img.appendTo('#prev_receipt');
                    //$("#prev_receipt").attr("src", reader.result);
                }
     
                reader.readAsDataURL(file);
            }
        }else{
            document.getElementById("prev_receipt").innerHTML = fileName[fileName.length - 1];
        }
  
}
function getPaymentType($type){
    
    if($type.value=='Cash'){
        $('.upionline').hide();
    }else{
        $('.upionline').show();
    }

}
$('#is_apply_coin').on('change',function(){
    if($(this).is(':checked')){
        $('#coin_amount').val(5);
        var new_total_amount = parseFloat($('#total_amount').val());
        alert(new_total_amount);
        $('#total_amount').val(parseFloat(new_total_amount-5));
        $('#total_amount_view').html('Rs.'+parseFloat(new_total_amount-5));
    }else{
        $('#coin_amount').val(0);
        var new_total_amount = parseFloat($('#total_amount').val());
        $('#total_amount').val(parseFloat(new_total_amount+5));
        $('#total_amount_view').html('Rs.'+parseFloat(new_total_amount+5));
    }
})
</script>
<script src="{{asset('frontend-source/myaccount/assets/js/assistant-validate.js')}}"></script>
@endpush
