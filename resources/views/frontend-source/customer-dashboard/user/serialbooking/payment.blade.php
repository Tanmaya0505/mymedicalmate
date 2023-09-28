@extends('frontend-source.layouts.master')
@section('title') Book Medical Mate @stop
@section('keywords') Book Medical Mate @stop
@section('description') Book Medical Mate @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/css/custom.css')}}">
<style>
    .gj-textbox-md{
        border: 1px solid #ced4da;
        padding: .375rem .75rem;
    }
    .gj-textbox-md:focus {
        border-bottom: 1px solid #80bdff;
    }
    .gj-datepicker-md [role=right-icon]{
        top: 14px;
        right: 14px;
    }
    #error_availability {
        color: #ff6262;
        font-size: 15px;
    }
    select.form-control.form-control-sm {
        height: 27px;
        padding: 0 2px;
        margin-left: 10px;
    }
    #booking-info{
        display: contents;
    }
    #booking-summery{
        display: none;
        margin-bottom: 30px;
    }
    #step-2, #step-3{
        display: none;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div id="booking-info" class="col-lg-12 ">
            
            <div class="col-lg-12">
            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Error!</strong> {{ $message }}
                </div>
            @endif
            {!! Session::forget('error') !!}
            @if($message = Session::get('success'))
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Success!</strong> {{ $message }}
                </div>
            @endif
            {!! Session::forget('success') !!}
                <div class="booking-form">
                    <h2 class="mb20">Patient & Booking Information</h2>
                    @php
                       // dd($post);
                            $customer_meta = json_decode($post->customer_meta);
                        
                        @endphp
                    
                            <ul class="list-group col-md-12">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Patient :
                                <span class="">{{$customer_meta->patient_type}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Patient From :
                                <span class="">{{$customer_meta->patient_from}}</span>
                                </li>
                               
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Patient Visit to :
                                <span class="">{{$customer_meta->hospital}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Enter the Prefer Doctor Name(option) :
                                <span class="">{{$customer_meta->specific_doctor}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Patient Name :
                                <span class="">{{$customer_meta->patient_name}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Mobile No :
                                <span class="">{{$customer_meta->patient_mobile}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Whatsapp No (Optional) :
                                <span class="">{{$customer_meta->whats_app_no}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Patient Email :
                                <span class="">{{$customer_meta->patient_email}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Gender :
                                <span class="">{{$customer_meta->gender}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Age :
                                <span class="">{{$customer_meta->age}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Hospital Visit Date :
                                <span class="">{{$post->book_date}}</span>
                                </li>
                               
                            </ul>
                            
                       
                        
                    
                    <div>
                        <div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="booking-form">
                    <h2 class="mb20">Payment Details</h2>
                    <ul class="list-group col-md-12">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                        Medmate Charge :
                        <span class="">Rs. {{$medmateconfig['serial_no_booking_charge']}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                        Payment Mode :
                        <span class="">{{$post->payment_mode==1 ? 'Online' : 'Pay After Service'}}</span>
                        </li>
                    </ul>
                    <div class="text-center">
                        @if($post->payment_mode==1)
                        <form action="{!!route('razorpay')!!}" method="POST" id="form-pay-now">
                        <button type="button" id="btn-pay-now" class="btn btn-primary">Paynow</button>
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <input type="hidden" name="id" value="{{$id}}">
                            <input type="hidden" name="desc" value="{{$booking_desc}}">
                        </form>
                        <form action="{!!route('payment')!!}" method="POST" id="payment_form" style="display:none">
                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="{{ env('RAZOR_KEY') }}"
                                        data-amount="{{$price*100}}"
                                        data-buttontext="Pay Amount (Rs. {{$price}})"
                                        data-name="Mymedicalmate"
                                        data-description="{{$id}}"
                                        data-prefill.name="name"
                                        data-prefill.email="email"
                                        data-theme.color="#ff7529">
                            </script>
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        </form>
                        @else
                            @if($post->assistant_boy_id)
                            <a class="btn btn-primary" href="{{url('/user/bookings/'.$id)}}">Proceed</a>
                            @else
                            <a class="btn btn-primary" href="{{url('/direct-booking/search-medmate/'.$id)}}">Proceed</a>
                            @endif
                            
                        @endif
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="col-lg-12 " id="booking-summery"></div>
    </div>
</div>

<!--OTP Confirmation modal popup-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">VERIFY OTP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="otp-validation" novalidate id="confirm-book-assistant">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">OTP:</label>
                        <input type="text" placeholder="OTP" class="form-control" name="otp" id="otp" required="">
                        <div class="invalid-feedback">Please enter your OTP</div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-confirm" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End OTP Confirmation modal popup-->
@endsection
@push('script')
<script src="{{ asset('frontend-source/bootstrap/js/bootstrap-notify.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset('vendors/js/ui/blockUI.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend-source/js/booking-validate.js') }}?v={{time()}}" type="text/javascript"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
    
    
   
    
    
    $('input[type=radio][name=early_serial_status]').change(function() {
        let value = $( 'input[name=early_serial_status]:checked' ).val();
        if (value == 1) {
            $('#early_serial').removeClass('d-none');
        } else{
            $('#early_serial').addClass('d-none');
        }
    });

    $('#is_pickup').change(function() {
        let value = $(this).val();
        if (value == 'No') {
            $('.pickup_time').addClass('d-none');
        } else{
            $('.pickup_time').removeClass('d-none');
        }
    });

    $('input[type=radio][name=pickup_status]').change(function() {
        let value = $('input[name=pickup_status]:checked').val();
        let sumKm = 0;
        if (value == 1) {
            $('#arrival_km').removeClass('d-none');
            $('.arrival_time').removeClass('d-none');
            let totalKm = $('#arrival_km').val();
            sumKm = parseInt(totalKm.split('-')[0])+parseInt({{ Config::get('constants.distanceKm') }});
        } else{
            $('#arrival_km').addClass('d-none');
            $('.arrival_time').addClass('d-none');
        }
        //$('#pickup_price').val(sumKm * parseInt({{ @$data['per_km_harges'] }}));
        //payAmount();
    });
    $('#btn-pay-now').on('click',function(){
        
        $.ajax({
            type: "Post",
            dataType: "json",
            url: "{{url('/razorpay')}}",
            data: $('#form-pay-now').serialize(),
            success: function (result) {
                
                $('#payment_form').submit();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
            } 
        });
    });
   
    
    function payAmount(){
        let amount = parseInt($('#price').val());
        let km = parseInt($('#pickup_price').val());
        $('#total_price').val(amount + km);
        $('#pay_amount').html('&#x20B9;' + (amount + km));
    }
    
</script>
@endpush