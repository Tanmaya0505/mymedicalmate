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
                <h4 class="mb-4">INVOICE</h4>
                
                
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
      
    </div>
    @empty
    @endforelse
    

  </div>



                                <div class="invoice-table">
                                    <div class="row mt-3 border-tb">
                                        <div class="col-12 col-sm-5 col-md-7 text-grey-d2 text-95 mt-2 mt-lg-0">
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
                                            $total_discount =number_format(($total_amount*($vendorDetails->discount/100)),2);
                                            $tax_amount  = number_format((($total_amount-$total_discount)*($tax/100)),2);
                                            $total_final = number_format(($total_amount-$total_discount+$tax_amount),2);
                                            @endphp
                                            <div class="row my-2">
                                                <div class="col-7 text-right">
                                                    Discount ({{$vendorDetails->discount}}%)
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
                                    <div class="row mt50 mb20">
                                        <div class="col-sm-9">
                                            <div class="mb20">
                                                <h4>Payment Method: @if($vendorDetails->payment_information==1)
                                                  Check
                                                @elseif($vendorDetails->payment_information==2)
                                                UPI Transfer
                                                @elseif($vendorDetails->payment_information==3)
                                                Account Transfer
                                                @endif
                                                </h4>
                                                @if($vendorDetails->payment_information==2)
                                                <p>IFSC Code: {{$vendorDetails->upi_id}}</p>
                                                @elseif($vendorDetails->payment_information==3)
                                                <p>Account Holder Name: {{$vendorDetails->account_holder_name}}<br>
                                                  Branch: {{$vendorDetails->branch_name}}<br>
                                                  Account No: {{$vendorDetails->account_number}}<br>
                                                  IFSC Code: {{$vendorDetails->ifsc_code}}</p>
                                                @endif
                                                <h4>Terms & Conditions</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 text-center">
                                            <img src="{{asset('frontend-source/images/auth-sign.png')}}" alt="" class="img-fluid d-block m-auto">
                                            <p class="mt10">Authorise Signature</p>
                                        </div>
                                    </div>
                                    <div class="row contact-inf mb50">
                                        <div class="col-md-4">
                                            <div class="icon-block">
                                                <div class="icon"><i class="fas fa-phone-rotary"></i></div>
                                                <div class="content">{{$vendorDetails->phone}}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="icon-block">
                                                <div class="icon"><i class="fas fa-envelope"></i></div>
                                                <div class="content">{{$vendorDetails->email}}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="icon-block">
                                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                                <div class="content">{{$vendorDetails->store_address}}, {{$vendorDetails->dist}}, {{$vendorDetails->state}} - {{$vendorDetails->pincode}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                  <a href="{{url('vendor/send-invoice/4/'.$prescription->order_id)}}" class="btn btn-info btn-sm pull-right" >Confirm</a>
                  <a href="{{url('vendor/send-invoice/0/'.$prescription->order_id)}}" class="btn btn-info btn-sm" >Cancel</a>
                
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
@endsection
@push('script')
<script type="text/javascript">
$('form .quantitylist').on('change', function() {
    $(this).closest('form').submit();
});
</script>
@endpush
