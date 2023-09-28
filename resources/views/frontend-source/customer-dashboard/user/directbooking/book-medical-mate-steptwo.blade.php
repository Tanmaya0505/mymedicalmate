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
                <div class="booking-form">
                    <h2 class="mb20">Patient & Booking Information</h2>
                    @php
                        
                            $customer_meta = json_decode($post->customer_meta);
                        
                        @endphp
                    <form class="needs-validation" novalidate id="book-assistant-direct">
                        @csrf
                        
                        <input type="hidden" name="price" id="price" value="0" />
                        <input type="hidden" name="pickup_price" id="pickup_price" value="0" />
                        <input type="hidden" name="total_price" id="total_price" value="0" />
                        <input type="hidden" name="payment_mode" id="payment_mode" value="" />
                        @if(Request::segment(2)=='step-2')
                            <input type="hidden" name="step"  value="2" />
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
                                Pickup Area Pincode :
                                <span class="">{{@$customer_meta->location_pincode}}</span>
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
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Need Pick up & Drop? :
                                <span class="">{{$post->pickup_status==1 ? "Yes  ($post->arrival_km)" : 'No'}}  </span>
                                </li>
                                @if($post->pickup_status==1)
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Arrival Time :
                                <span class="">{{$post->arrival_time}}</span>
                                </li>
                                @endif
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Need Serial No? :
                                <span class="">{!! $post->early_serial_status ? 'Serial no <small class="d-gender">('.$post->early_serial.')</small>' : 'Not Required' !!}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Mode of Booking? :
                                <span class="">{{ (new \App\Helpers\CustomerHelper)->bookingCriteriaStatus($post->booking_criteria) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                Fooding Offer to Medical Mate? :
                                <span class="">{{$post->fooding_status==1 ? "Yes" : "No"}}</span>
                                </li>
                            </ul>
                            <div class="text-center">
                            <a href="{{url('/direct-booking/step-1/'.$id)}}" id="btn-submit-request" class="btn btn-primary">Back</a>
                            <a href="{{url('/direct-booking/step-3/'.$id)}}" id="btn-submit-request" class="btn btn-primary">Next</a>
                            </div>
                        @endif
                        @if(Request::segment(2)=='step-1')
                        <input type="hidden" name="step"  value="1" />
                        <input type="hidden" name="booking_id"  value="{{$id}}" />
                        <div class="form-group">
                            <label><b><i class="fal fa-venus"></i>Patient</b></label>
                            <select class="form-control" name="patient_type" id="patient_type" >
                                <option value="New Patient" @if($customer_meta->patient_type=='New Patient') selected @endif  >New Patient</option>
                                <option value="Old Patient"  @if($customer_meta->patient_type=='Old Patient') selected @endif >Old Patient</option>
                            </select>
                            <div class="invalid-feedback">Please select Patient.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-map-marker-alt"></i>Patient From</b></label>
                            <input type="text" value="{{$customer_meta->patient_from}}" class="form-control" name="location" placeholder="Enter Location">
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-map-marker-alt"></i>Pickup Area Pincode</b></label>
                            <input type="number" class="form-control" name="location_pincode" placeholder="Enter Location Pincode" value="{{@$customer_meta->location_pincode}}">
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-map-marker-alt"></i>Patient Visit to: </b></label>
                            <input type="text" class="form-control" required name="hospital" placeholder="Patient wants to visit specific hospital" value="{{$customer_meta->hospital}}">
                            <div class="invalid-feedback">Please Enter Hospital Name.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-map-marker-alt"></i>Enter the Prefer Doctor Name(option) </b></label>
                            <input type="text" class="form-control" value="{{$customer_meta->specific_doctor}}" name="specific_doctor" placeholder="Patient wants to consult with specific doctor">

                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-user-shield"></i>Patient Name</b></label>
                            <input placeholder="Patient Name" type="text" name="patient_name" id="patient_name" value="{{@$customer_meta->patient_name}}" class="form-control" required>
                            <div class="invalid-feedback">Please Enter Patient Name.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-mobile"></i>Mobile No</b></label>
                            <input placeholder="Patient Mobile No" type="number" name="patient_mobile" id="patient_mobile" class="form-control" value="{{$customer_meta->patient_mobile}}" maxlength="10" required onkeypress="return isNumber(event)">
                            <div class="invalid-feedback">Please Enter Patient Mobile No.</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fab fa-whatsapp"></i>Whatsapp No (Optional)</b></label>
                            <input placeholder="Whatsapp No" type="number" name="whats_app_no" id="whats_app_no" class="form-control" value="{{$customer_meta->whats_app_no}}" maxlength="10" onkeypress="return isNumber(event)">
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-envelope-open"></i>Patient Email</b></label>
                            <input placeholder="Patient Email" type="email" name="patient_email" id="patient_email" class="form-control" value="{{$customer_meta->patient_email}}" required>
                            <div class="invalid-feedback">Please Enter Patient Email.</div>
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
                            <label><b><i class="fal fa-user-circle"></i>Age</b></label>
                            <input placeholder="Age" type="text" name="age" id="age" class="form-control" value="{{$customer_meta->age}}" maxlength="2" required onkeypress="return isNumber(event)">
                            <div class="invalid-feedback">Please Enter Age.</div>
                        </div>
                        
                        <div class="form-group">
                                <label><b><i class="fal fa-calendar-alt"></i>Hospital Visit Date</b></label>
                                <input placeholder="Select date" type="text" name="book_date" id="book_date_serial" class="form-control" value="{{$post->book_date}}" required>
                                <div id="error_availability"></div>
                                <div class="invalid-feedback">Please Choose the Date</div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="far fa-motorcycle"></i>Need Pick up & Drop?</b></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pickup_status" id="pickup_status1" value="1" required @if($post->pickup_status==1) checked @endif >
                                <label class="form-check-label" for="pickup_status1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pickup_status" id="pickup_status2" value="0" required  @if($post->pickup_status==0) checked @endif >
                                <label class="form-check-label" for="pickup_status2">No</label>
                                <select class="form-control form-control-sm @if($post->pickup_status==0) d-none @endif" name="arrival_km" id="arrival_km">
                                    <option value="">Including pickup and droop</option>
                                    <option value="10-20KM" @if($post->arrival_km=="10-20KM") selected @endif  >10-20 KM</option>
                                    <option  value="20-30KM" @if($post->arrival_km=="20-30KM") selected @endif>20-30 KM</option>
                                    <option value="30-40KM" @if($post->arrival_km=="30-40KM") selected @endif>30-40 KM</option>
                                    <option value="40-50KM" @if($post->arrival_km=="40-50KM") selected @endif>40-50 KM</option>
                                </select>
                            </div><br>
                            
                        </div>

                        <div class="form-group arrival_time @if($post->pickup_status==0) d-none @endif">
                            <label><b><i class="fal fa-clock"></i>Arrival Time</b></label>
                            <select class="form-control" name="arrival_time" id="arrival_time">
                                <option value="">Select Arrival Time</option>
                                @foreach($getTime as $key=>$val)
                                <option value="{{ $val }}" @if($post->arrival_time==$val) selected @endif   >{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label><b><i class="far fa-prescription"></i>Need Serial No?</b></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="early_serial_status" id="early_serial_status1" value="1" @if($post->early_serial_status==1) checked @endif required>
                                <label class="form-check-label" for="early_serial_status1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="early_serial_status" id="early_serial_status2" value="0" @if($post->early_serial_status==0) checked @endif required>
                                <label class="form-check-label" for="early_serial_status2">No</label>
                                <select class="form-control form-control-sm @if($post->early_serial_status==0) d-none @endif " name="early_serial" id="early_serial">
                                    <option value="Morning" @if($post->early_serial=='Morning') selected @endif >Morning</option>
                                    <option value="Afternoon" @if($post->early_serial=='Afternoon') selected @endif >Afternoon</option>
                                    <option value="Evening" @if($post->early_serial=='Evening') selected @endif >Evening</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="fal fa-business-time"></i>Mode of Booking?</b></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking" id="day_booking" value="1" @if($post->booking_criteria==1) checked @endif required>
                                <label class="form-check-label" for="day_booking">Day Booking (8 Hr)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking" id="night_booking" value="2" @if($post->booking_criteria==2) checked @endif required>
                                <label class="form-check-label" for="night_booking">Night Booking (8 Hr)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking" id="day_night_booking" value="3" @if($post->booking_criteria==3) checked @endif required>
                                <label class="form-check-label" for="day_night_booking">2 Shift Booking (16 Hr)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking" id="three_hour_booking" value="4" @if($post->booking_criteria==4) checked @endif required>
                                <label class="form-check-label" for="three_hour_booking">Booking for 3 hour</label>
                            </div>
                            <div class="col-sm-12 mt-3 p-0 d-none" id="play_amount"><strong class="text-primary">Pay Amount</strong> <span id="pay_amount"></span></div>
                        </div>
                        <div class="form-group">
                            <label><b><i class="far fa-utensils-alt"></i>Fooding Offer to Medical Mate?</b></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fooding_status" id="fooding_status1" value="1"  @if($post->fooding_status==1) checked @endif  >
                                <label class="form-check-label" for="fooding_status1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fooding_status" id="fooding_status2" value="0" @if($post->fooding_status==0) checked @endif >
                                <label class="form-check-label" for="fooding_status2">No</label>
                            </div>
                            <div class="invalid-feedback">Please choose any one</div>
                        </div>
                        <div class="text-center">
                            <button type="submit" id="btn-submit-request" class="btn btn-primary">Update</button>
                        </div>
                        @endif
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