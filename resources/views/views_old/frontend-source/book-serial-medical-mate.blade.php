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
            <div class="profile-nav col-lg-4">
                <div class="panel">
                    <div class="user-heading round">
                        <div class="d-flex bd-highlight align-items-center">
                            <div class="info-icon">
                                <img src="{{ asset('frontend-source/images/verify-icon.png') }}" alt="">
                                <p>Profile Verified</p>
                            </div>
                            <div class="profile-image">
                                <a href="#">
                                    <img src="{{ $photo }}" class="img-fluid" alt="">
                                </a>
                                <p class="p-age">Age: @if(isset($data['dob_year']) && !empty($data['dob_year'])) {{ $data['dob_year'] }} Years @else -- @endif</p>
                            </div>
                            <div class="info-icon">
                                <img src="{{ asset('frontend-source/images/ride-icon.png') }}" alt="">
                                <p>Ride: @if(isset($data['is_bike']) && $data['is_bike']) {{ @$data['km_range'] ?? '00-00 KM' }} @else {{ '00-00 KM' }} @endif</p>
                            </div>
                        </div>

                        <div class="user-details">
                            <b><i class="fal fa-user"></i>Name:</b> {{ ucwords($data['first_name'].' '.$data['last_name']) }}<br>
                            <b><i class="fal fa-map-marker-alt"></i>From:</b> {{ $data['present_address'] }}<br>
                            <b><i class="fal fa-map-marker-alt"></i>Service Area:</b> {{ $data['service_area'] }}<br>
                            <b><i class="fal fa-calendar-alt"></i>Available:</b> {{ str_replace(',', ' | ', $data['available']) }}<br>
                            <b><i class="fal fa-money-bill-alt"></i>Price:</b> Rs {{ $data['day_charges'] }} Day | {{ $data['night_charges'] }} Night<br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="booking-form">
                    <h2 class="mb20">Fill the Booking Information</h2>
                    <form class="needs-validation" novalidate id="book-assistant-serial">
                        @csrf
                       <input type="hidden" name="assistant_boy_id" id="assistant_boy_id" value="{{ $assistant->id }}" />
                        <input type="hidden" name="price" id="price" value="0" />
                        <input type="hidden" name="pickup_price" id="pickup_price" value="0" />
                        <input type="hidden" name="total_price" id="total_price" value="0" />
                        <input type="hidden" name="payment_mode" id="payment_mode" value="" />
                        <input  type="hidden" name="booking_type" id="booking_type" value="serial" >
                        <div class="form-group">
                            <label><b><i class="fal fa-venus"></i>Patient</b></label>
                            <select class="form-control" name="patient_type" id="patient_type" >
                                <option value="New Patient">New Patient</option>
                                <option value="Old Patient">Old Patient</option>
                            </select>
                            <div class="invalid-feedback">Please select Patient.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-map-marker-alt"></i>Patient Come From</b></label>
                            <input type="text" class="form-control" required name="location" placeholder="Enter Location">
                            <div class="invalid-feedback">Please Enter Location.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-map-marker-alt"></i>Patient wants to visit specific hospital </b></label>
                            <input type="text" class="form-control" required name="hospital" placeholder="Patient wants to visit specific hospital">
                            <div class="invalid-feedback">Please Enter Hospital Name.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-map-marker-alt"></i>Patient wants to consult with specific doctor (option) </b></label>
                            <input type="text" class="form-control" name="specific_doctor" placeholder="Patient wants to consult with specific doctor">

                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-user-circle"></i>Age</b></label>
                            <input placeholder="Age" type="number" name="age" id="age" class="form-control" maxlength="2" required onkeypress="return isNumber(event)">
                            <div class="invalid-feedback">Please Enter Age.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-user-shield"></i>Patient Name</b></label>
                            <input placeholder="Patient Name"  type="text" name="patient_name" id="patient_name" value="{{@$userdata['first_name'] ? @$userdata['first_name'].' '.@$userdata['last_name'] :''}}" class="form-control" required>
                            <div class="invalid-feedback">Please Enter Patient Name.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-venus"></i>Gender</b></label>
                            <select class="form-control" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="invalid-feedback">Please select Gender.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-mobile"></i>Mobile No</b></label>
                            <input placeholder="Patient Mobile No" type="number" name="patient_mobile" id="patient_mobile" class="form-control" value="{{@$userdata['phone']}}" maxlength="10" required onkeypress="return isNumber(event)">
                            <div class="invalid-feedback">Please Enter Patient Mobile No.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fab fa-whatsapp"></i>Whatsapp No (Optional)</b></label>
                            <input placeholder="Whatsapp No" type="number" name="whats_app_no" id="whats_app_no" class="form-control" maxlength="10" onkeypress="return isNumber(event)">
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-envelope-open"></i>Patient Email</b></label>
                            <input placeholder="Patient Email" type="email" name="patient_email" id="patient_email" class="form-control" value="{{@$userdata['email']}}" required>
                            <div class="invalid-feedback">Please Enter Patient Email.</div>
                        </div>
                        
                        
                        
                            <div class="form-group @if(isset($data['is_bike']) && $data['is_bike']) col-md-6 @endif">
                                <label><b><i class="fal fa-calendar-alt"></i>Choose the Date</b></label>
                                <input placeholder="Select date" type="text" name="book_date" id="book_date" class="form-control" required>
                                <div id="error_availability"></div>
                                <div class="invalid-feedback">Please Choose the Date</div>
                            </div>
                            <div class="form-group @if(isset($data['is_bike']) && $data['is_bike']) col-md-6 @endif">
                                <label><b><i class="fal fa-calendar-alt"></i>Arrival at Destination </b></label>
                                <input placeholder="" type="text" name="destination_address" id="destination_address" class="form-control" required>
                                <div id="error_availability"></div>
                                <div class="invalid-feedback">Please Enter Destination Address</div>
                            </div>
                             <div class="form-group oldpatient">
                                <label><b><i class="fal fa-calendar-alt"></i>Upload Your Old Prescription</b> <button type="button" id="button1" class="btn btn-primary float-right" onclick="getFile()">Upload</button></p></label>
                                &nbsp;&nbsp;&nbsp;<span id="prev_receipt"></span>
                                <div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" type="file" name="upfile" value="upload" onchange="sub(this)" /></div>
                                <div class="invalid-feedback">Please Enter Destination Address</div>
                            </div>
                            <div class="form-group ">
                                <label><b><i class="fal fa-calendar-alt"></i>Mode of Payment (Online/Pay Later)</b></label>
                                <select class="form-control "  name="payment_mode">
                                    <option value="2">Pay Later</option>
                                    <option value="1">UPI/Online</option>
                                </select>
                                <div class="invalid-feedback">Please Enter Destination Address</div>
                            </div>
                            
                       
                        
                        
                        <div class="text-center">
                            <button type="submit" id="btn-submit-request" class="btn btn-primary">Submit Request</button>
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
    // $('input[type=radio][name=booking]').change(function() {
    //     $('#play_amount').removeClass('d-none');
    //     let amount = 0;
    //     if (this.value == 1) {
    //         amount = {{ $data['day_charges'] }};
    //     } else if (this.value == 2) {
    //         amount = {{ $data['night_charges'] }};
    //     } else {
    //         amount = ({{ $data['day_charges'] }} + {{ $data['night_charges'] }});
    //     }
    //     $('#price').val(amount);
    //     payAmount();
    // });
    
    // $('input[type=radio][name=early_serial_status]').change(function() {
    //     let value = $( 'input[name=early_serial_status]:checked' ).val();
    //     if (value == 1) {
    //         $('#early_serial').removeClass('d-none');
    //     } else{
    //         $('#early_serial').addClass('d-none');
    //     }
    // });
    
    // $('input[type=radio][name=pickup_status]').change(function() {
    //     let value = $('input[name=pickup_status]:checked').val();
    //     let sumKm = 0;
    //     if (value == 1) {
    //         $('#arrival_km').removeClass('d-none');
    //         let totalKm = $('#arrival_km').val();
    //         sumKm = parseInt(totalKm.split('-')[0])+parseInt({{ Config::get('constants.distanceKm') }});
    //     } else{
    //         $('#arrival_km').addClass('d-none');
    //     }
    //     $('#pickup_price').val(sumKm * parseInt({{ $data['per_km_harges'] }}));
    //     payAmount();
    // });
    
    // $('#arrival_km').on('change', function(){
    //     let sumKm = parseInt(this.value.split('-')[0])+parseInt({{ Config::get('constants.distanceKm') }});
    //     $('#pickup_price').val(sumKm * parseInt({{ $data['per_km_harges'] }}));
    //     payAmount();
    // });
    

    $('.oldpatient').hide();
    $('#patient_type').change(function(){

        if($(this).val()=='Old Patient'){
                $('.oldpatient').show();

        }else{
            $('.oldpatient').hide();
        }

    });
    function payAmount(){
        let amount = parseInt($('#price').val());
        let km = parseInt($('#pickup_price').val());
        $('#total_price').val(amount + km);
        $('#pay_amount').html('&#x20B9;' + (amount + km));
    }
    
</script>
@endpush