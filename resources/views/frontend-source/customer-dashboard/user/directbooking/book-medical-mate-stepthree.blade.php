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
    .underline{
      text-decoration: underline;
    }

</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div id="booking-info" class="col-lg-12 ">
            
            <div class="col-lg-12">
                <div class="booking-form">
                    <h2 class="mb20">Free Service From Our Trust</h2>
                    <p class="underline alert-warning">All the services only for specific location like (SCB Medical, AIIMS, Burla Medical and the time between (10:00 AM - 04:00 PM)
                    </p>
                    @php
                        
                            $customer_meta = json_decode($post->customer_meta);
                        
                        @endphp
                    <form class="needs-validation" novalidate id="book-assistant-direct">
                        @csrf
                        
                        <input type="hidden" name="booking_id" id="booking_id" value="{{$id}}" />
                        
                        <input type="hidden" name="step"  value="3" />
                        <div class="col-md-6">
                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Free Blood Group Report :
                                            <span class=""><input type="checkbox" name="Free_Blood_Group_Report[]" value="Free Blood Group Report"></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Free Random Sugar Test :
                                            <span class=""><input type="checkbox" name="Free_Blood_Group_Report[]" value="Free Random Sugar Test"></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Free Hemoglobin Test :
                                            <span class=""><input type="checkbox" name="Free_Blood_Group_Report[]" value="Free Hemoglobin Test"></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Blood Pressure Test :
                                            <span class=""><input type="checkbox" name="Free_Blood_Group_Report[]" value="Blood Pressure Test"></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Free Weight Measurement  :
                                            <span class=""><input type="checkbox" name="Free_Blood_Group_Report[]" value="Free Weight Measurement"></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Free BMI Test :
                                            <span class=""><input type="checkbox" name="Free_Blood_Group_Report[]" value="Free BMI Test"></span>
                                            </li>
                                            
                                        </ul>
                                    </div>
                        <div class="text-center">
                            <a href="{{url('/direct-booking/step-2/'.$id)}}" id="btn-submit-request" class="btn btn-primary">Back</a>
                            <a href="{{url('/direct-booking/search-medmate/'.$id)}}" id="btn-submit-request" class="btn btn-primary">Skip</a>
                           <button type="submit" id="btn-submit-request" class="btn btn-primary">Submit & Search Medical Mate</button>
                        </div>
                    </form>
                    <div>
                        <div>
                            <div class="clearfix"></div>
                        </div>
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
   
    
    function payAmount(){
        let amount = parseInt($('#price').val());
        let km = parseInt($('#pickup_price').val());
        $('#total_price').val(amount + km);
        $('#pay_amount').html('&#x20B9;' + (amount + km));
    }
    
</script>
@endpush