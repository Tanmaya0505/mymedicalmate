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
@php 
    $assistantconfig = \App\Helpers\CustomerHelper::configData('assistant_config');
    $pickup_pincode = explode(',',$assistantconfig['list_of_pincode']);

@endphp
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
                            <b><i class="fal fa-user"></i>Name:</b> {{ userfirstname(ucwords($data['first_name'])).' '.ucwords($data['last_name']) }}<br>
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
                    <form class="needs-validation" novalidate id="book-assistant">
                        @csrf
                        <input type="hidden" name="assistant_boy_id" id="assistant_boy_id" value="{{ $assistant->id }}" />
                        <input type="hidden" name="price" id="price" value="0" />
                        <input type="hidden" name="pickup_price" id="pickup_price" value="0" />
                        <input type="hidden" name="total_price" id="total_price" value="0" />
                        <input type="hidden" name="payment_mode" id="payment_mode" value="" />
                        <div class="form-group">
                            <label><b><i class="fal fa-venus"></i>Patient</b></label>
                            <select class="form-control userdetail" name="patient_type" id="patient_type" >
                                <option value="New Patient">New Patient</option>
                                <option value="Old Patient">Old Patient</option>
                            </select>
                            <div class="invalid-feedback">Please select Patient.</div>
                        </div>
                        <!-- <div class="form-group">
                            <label><b><i class="fal fa-venus"></i>Patient Details</b></label>
                            <select class="form-control userdetail" name="patient_detail_type" id="patient_detail_type" >
                                <option value="Self">Self</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="invalid-feedback">Please select Patient.</div>
                        </div> -->
                        <div class="form-group">
                            <label><b><i class="fal fa-map-marker-alt"></i>Patient From</b></label>
                            <input type="text" class="form-control" name="location" placeholder="Enter Location">
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-map-marker-alt"></i>Pickup Area Pincode</b></label>
                            <select class="form-control" id="location_pincode" name="location_pincode">
                                <option value="">Choose Pincode</option>
                                @foreach($pickup_pincode as $pin)
                                    <option>{{$pin}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="number" class="form-control" name="location_pincode" placeholder="Enter Location Pincode"> -->
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-map-marker-alt"></i>Patient Visit to: </b></label>
                            <input type="text" class="form-control" required name="hospital" placeholder="Patient wants to visit specific hospital">
                            <div class="invalid-feedback">Please Enter Hospital Name.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-map-marker-alt"></i>Enter the Prefer Doctor Name(option) </b></label>
                            <input type="text" class="form-control" name="specific_doctor" placeholder="Patient wants to consult with specific doctor">

                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-user-shield"></i>Patient Name</b></label>
                            <input placeholder="Patient Name" type="text" name="patient_name" id="patient_name" value="{{@$userdata['first_name'].' '.@$userdata['last_name']}}" class="form-control" required>
                            <div class="invalid-feedback">Please Enter Patient Name.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-mobile"></i>Mobile No</b></label>
                            <input placeholder="Patient Mobile No" type="text" name="patient_mobile" id="patient_mobile" class="form-control" value="{{@$userdata['phone']}}" maxlength="10" required onkeypress="return isNumber(event)">
                            <div class="invalid-feedback">Please Enter Patient Mobile No.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fab fa-whatsapp"></i>Whatsapp No (Optional)</b></label>
                            <input placeholder="Whatsapp No" type="text" name="whats_app_no" id="whats_app_no" class="form-control" maxlength="10" onkeypress="return isNumber(event)">
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-envelope-open"></i>Patient Email</b></label>
                            <input placeholder="Patient Email" type="email" name="patient_email" id="patient_email" class="form-control" value="{{@$userdata['email']}}" required>
                            <div class="invalid-feedback">Please Enter Patient Email.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-venus"></i>Gender</b></label>
                            <select class="form-control" id="patient_gender" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="invalid-feedback">Please select Gender.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-user-circle"></i>Age</b></label>
                            <input placeholder="Age" type="text" name="age" id="age" class="form-control" maxlength="2" required onkeypress="return isNumber(event)">
                            <div class="invalid-feedback">Please Enter Age.</div>
                        </div>
                        <div class="form-group ref">
                            <label><b><i class="fal fa-user-circle"></i>Attendant. Name</b></label>
                            <input placeholder="Attendant. Name" type="text" name="ref_name" id="ref_name" class="form-control refvalid"   >
                            <div class="invalid-feedback">Please Enter Attendant. Name.</div>
                        </div>
                        <div class="form-group ref">
                            <label><b><i class="fal fa-user-circle"></i>Attendant Mobile</b></label>
                            <input placeholder="Attendant Mobile" type="text" name="ref_mobile" id="ref_mobile" class="form-control refvalid" maxlength="10" >
                            <div class="invalid-feedback">Please Enter Attendant. Mobile.</div>
                        </div>
                        <div class="form-group ref">
                            <label><b><i class="fal fa-user-circle"></i>Attendant Relation</b></label>
                            <input placeholder="Attendant Relation" type="text" name="ref_relation" id="ref_relation" class="form-control refvalid"   >
                            <div class="invalid-feedback">Please Enter Attendant Relation.</div>
                        </div>
                        @if(isset($data['is_bike']) && $data['is_bike'])
                        <div class="form-row">
                        @endif
                            <div class="form-group @if(isset($data['is_bike']) && $data['is_bike']) col-md-6 @endif">
                                <label><b><i class="fal fa-calendar-alt"></i>Hospital Visit Date</b></label>
                                <input placeholder="Select date" type="text" name="book_date" id="book_date" class="form-control" required>
                                <div id="error_availability"></div>
                                <div class="invalid-feedback">Please Choose the Date</div>
                            </div>
                            @if(isset($data['is_bike']) && $data['is_bike'])
                            @php
                                $total_km = $data['km_range']??'00-00';
                                $explode_km = explode('-', $total_km);
                                $exploding_data = explode(' ', $explode_km[1]);
                            @endphp
                            <div class="form-group col-md-6">
                                <label><b><i class="fal fa-clock"></i>Arrival Time</b></label>
                                <select class="form-control" name="arrival_time" id="arrival_time">
                                    <option value="">Select Arrival Time</option>
                                    @foreach($getTime as $key=>$val)
                                    <option value="{{ $val }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group pickup-drop">
                            <label><b><i class="far fa-motorcycle"></i>Need Pick up & Drop?</b></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pickup_status" id="pickup_status1" value="1" required>
                                <label class="form-check-label" for="pickup_status1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pickup_status" id="pickup_status2" value="0" required>
                                <label class="form-check-label" for="pickup_status2">No</label>
                                <select class="form-control form-control-sm d-none" name="arrival_km" id="arrival_km">
                                    <option value="">Including pickup and droop</option>
                                    @for($i = Config::get('constants.minKM'); $i < $exploding_data[0]; $i=$i+Config::get('constants.distanceKm'))
                                        <option value="{{ $i }}-{{ $i+Config::get('constants.distanceKm') }}Km">{{ $i }} - {{ $i+Config::get('constants.distanceKm') }}Km</option>
                                    @endfor
                                </select>
                            </div><br>
                            <small>Note: Per Km charges Rs {{ $data['per_km_harges'] }} | {{ $data['km_range'] ?? '00-00' }}</small>
                        </div>
                        @endif
                        <div class="form-group">
                            <label><b><i class="far fa-prescription"></i>Need Serial No?</b></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="early_serial_status" id="early_serial_status1" value="1" required>
                                <label class="form-check-label" for="early_serial_status1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="early_serial_status" id="early_serial_status2" value="0" required>
                                <label class="form-check-label" for="early_serial_status2">No</label>
                                <select class="form-control form-control-sm d-none" name="early_serial" id="early_serial">
                                    <option value="Morning">Morning</option>
                                    <option value="Afternoon">Afternoon</option>
                                    <option value="Evening">Evening</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-business-time"></i>Mode of Booking?</b></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking" id="day_booking" value="1" required>
                                <label class="form-check-label" for="day_booking">Day Booking (8 Hr)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking" id="night_booking" value="2" required>
                                <label class="form-check-label" for="night_booking">Night Booking (8 Hr)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking" id="day_night_booking" value="3" required>
                                <label class="form-check-label" for="day_night_booking">2 Shift Booking (16 Hr)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking" id="three_hour_booking" value="4" required>
                                <label class="form-check-label" for="three_hour_booking">Booking for 3 hour</label>
                            </div>
                            <div class="col-sm-12 mt-3 p-0 d-none" id="play_amount"><strong class="text-primary">Pay Amount</strong> <span id="pay_amount"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Save% <stripe><s><span id="save_amount"></span></s></div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="far fa-utensils-alt"></i>Fooding Offer to Medical Mate?</b></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fooding_status" id="fooding_status1" value="1" required>
                                <label class="form-check-label" for="fooding_status1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fooding_status" id="fooding_status2" value="0" required>
                                <label class="form-check-label" for="fooding_status2">No</label>
                            </div>
                            <div class="invalid-feedback">Please choose any one</div>
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
    $('#location_pincode').on('change',function(){
        if($(this).val()){
            $('.pickup-drop').show();
            //$('#pickup_status1').attr('checked','checked');
        }else{
            $('.pickup-drop').hide();
            $('#pickup_status1').removeAttr('checked');
            $('#pickup_status2').prop('checked',true);
        }
    });
     $('.pickup-drop').hide();
     $('#pickup_status2').attr('checked',true);
    $('#age').on('blur',function(){
        var age = $(this).val();
        if(age > 65 || age < 18){
            
            $('.ref').show();
            $('.refvalid').attr('required',true);
        }else{
           
            $('.ref').hide();
            $('.refvalid').attr('required',false);
        }
    })
   
    $('.ref').hide();
    $('input[type=radio][name=booking]').change(function() {
        $('#play_amount').removeClass('d-none');
        let amount = 0;
        let save_amount = 0;
        if (this.value == 1) {
            amount = {{ $data['day_charges'] ? $data['day_charges'] : 0 }};
            save_amount = (({{ $assistantconfig['max_day_charge']}}-amount)/{{$assistantconfig['max_day_charge']}})*100;
        } else if (this.value == 2) {
            amount = {{ isset($data['night_charges'])  ?  $data['night_charges'] : 0 }};
            save_amount = (({{ $assistantconfig['max_night_charge']}}-amount)/{{$assistantconfig['max_night_charge']}})*100;
        } else if (this.value == 3){
            amount = ({{ $data['day_charges'] ? $data['day_charges'] : 0 }} + {{ isset($data['night_charges'])  ?  $data['night_charges'] : 0 }});
            save_amount = (({{ $assistantconfig['max_day_charge']+$assistantconfig['max_night_charge']}}-amount)/{{$assistantconfig['max_day_charge']+$assistantconfig['max_night_charge']}})*100;
        }else{
            amount =  {{ isset($data['hourly_charges'])  ?  $data['hourly_charges'] : 0 }};
            save_amount = (({{ $assistantconfig['max_hourly_charge']}}-amount)/{{$assistantconfig['max_hourly_charge']}})*100;
        }
        $('#price').val(amount);
        $('#save_amount').html(Math.floor(save_amount));
        payAmount();
    });
    
    $('input[type=radio][name=early_serial_status]').change(function() {
        let value = $( 'input[name=early_serial_status]:checked' ).val();
        if (value == 1) {
            $('#early_serial').removeClass('d-none');
        } else{
            $('#early_serial').addClass('d-none');
        }
    });
    
    $('input[type=radio][name=pickup_status]').change(function() {
        let value = $('input[name=pickup_status]:checked').val();
        let sumKm = 0;
        if (value == 1) {
            $('#arrival_km').removeClass('d-none');
            let totalKm = $('#arrival_km').val();
            sumKm = parseInt(totalKm.split('-')[0])+parseInt({{ Config::get('constants.distanceKm') }});
        } else{
            $('#arrival_km').addClass('d-none');
        }
        $('#pickup_price').val(sumKm * parseInt({{ $data['per_km_harges'] }}));
        payAmount();
    });
    
    $('#arrival_km').on('change', function(){
        let sumKm = parseInt(this.value.split('-')[0])+parseInt({{ Config::get('constants.distanceKm') }});
        $('#pickup_price').val(sumKm * parseInt({{ $data['per_km_harges'] }}));
        payAmount();
    });
    
    function payAmount(){
        let amount = parseInt($('#price').val());
        let km = parseInt($('#pickup_price').val());
        $('#total_price').val(amount + km);
        $('#pay_amount').html('&#x20B9;' + (amount + km));
    }

    $('.userdetail').on('change', function(){

        
            if($(this).val()=='Self' || $(this).val()=='Old Patient'){
                $.ajax({
                    type: "GET",
                    url: "/patient-details",
                    
                    dataType: 'json',
                    beforeSend: function () {
                        $('.xhr-loading').css({'display':'block'});
                    },
                    success: function (data) {
                        //$('#btn-confirm').html('Confirm');
                        $('.xhr-loading').css({'display':'none'});
                        if (data.code === 200) {
                            $('#patient_name').val(data.meta.first_name+' '+data.meta.last_name);
                            $('#patient_mobile').val(data.meta.phone);
                            $('#age').val(data.meta.age);
                            $('#patient_email').val(data.meta.email);
                            $('#patient_gender option[value="'+data.meta.gender+'"]').attr('selected','selected');
                            
                        } else {
                            $.notify({
                                title: '<strong>Error !</strong>',
                                message: data.message
                            },{
                                type: "danger"
                            });
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        $('#startserviceotp').unblock();
                        console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
                    } 
                });
            }else{
                $('#patient_name').val('');
                $('#patient_mobile').val('');
                $('#patient_email').val('');
                $('#age').val('');
            }
        

    });
    
</script>
@endpush