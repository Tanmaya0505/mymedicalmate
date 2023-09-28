@extends('frontend-source.customer-dashboard.layouts.master')

@section('title') Dashboard @stop

@section('keywords') Dashboard @stop

@section('description') Dashboard @stop

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">

@if(Session::get('accountId') == 2)

<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

@endif

<style>

    .gj-textbox-md{

        border: 1px solid #ced4da;

        padding: .375rem .75rem;

    }

    .gj-textbox-md:focus {

        border-bottom: 1px solid #80bdff;

    }

    .gj-datepicker-md [role=right-icon], .gj-timepicker-md [role=right-icon]{

        top: 10px;

        right: 10px;

    }

    .form-group .help-block ul li::before {

        content: '';

    }

</style>

@endsection

@section('content')

<div class="content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <h4 class="card-title">Fill the Booking Information</h4>

                        
                    </div>

                    <div class="card-body">

                        <form novalidate method="POST" action="{{ url($account_prefix.'/postnew-booking') }}" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="assistant_boy_id" value="{{Session::get('userId')}}">

                            <div class="row">

                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Patient From</label>
                                                <input type="text" value="" name="location" class="form-control" placeholder="Enter Location" required="" data-validation-required-message="Location required">
                                                <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Patient Name</label>
                                            <input type="text" value="" name="patient_name" class="form-control" placeholder="Patient Name" required="" data-validation-required-message="Patient Name required">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Mobile No</label>
                                                <input type="text" value="" name="patient_mobile" class="form-control" placeholder="Patient Mobile No" required="" data-validation-required-message="Mobile No required" maxlength="10" required="" onkeypress="return isNumber(event)" >
                                                <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Whatsapp No (Optional)</label>
                                            <input type="text" value="" name="whats_app_no" class="form-control"  placeholder="Whatsapp No" maxlength="10"  onkeypress="return isNumber(event)" >
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Patient Email</label>
                                                <input type="text" value="" name="patient_email" class="form-control" placeholder="Patient Email" required="" data-validation-required-message="Patient Email required">
                                                <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender" required="" data-validation-required-message="Gender required">
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Age</label>
                                                <input type="text" value="" name="age" class="form-control" placeholder="Age" maxlength="2" required="" onkeypress="return isNumber(event)" data-validation-required-message="Age required">
                                                <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Choose the Date</label>
                                            <input type="text" value="" name="book_date" id="book_date" class="form-control" placeholder="Select Date" required="" data-validation-required-message="Date required">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Need Serial No?</label>
                                            <div class="">
                                                <div class="available_days">
                                                    <input type="radio" required="" value="1" id="early_serial_status1" name="early_serial_status" class="available">
                                                    <label for="early_serial_status1">Yes</label>
                                                </div>
                                                <div class="available_days">
                                                    <input type="radio" required="" value="0" id="early_serial_status2" name="early_serial_status" class="available">
                                                    <label for="early_serial_status2">No</label>
                                                </div>
                                            </div>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Fooding Offer to Medical Mate?</label>
                                            <div class="">
                                                <div class="available_days">
                                                    <input type="radio" required=""  value="1" id="fooding_status1" name="fooding_status" class="available">
                                                    <label for="fooding_status1">Yes</label>
                                                </div>
                                                <div class="available_days">
                                                    <input type="radio" required="" value="0" id="fooding_status2" name="fooding_status" class="available">
                                                    <label for="fooding_status2">No</label>
                                                </div>
                                            </div>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Booking Time?</label>
                                            <div class="">
                                                <div class="available_days">
                                                    <input type="radio" required="" value="1" id="day_booking" name="booking" class="available">
                                                    <label for="day_booking">Day</label>
                                                </div>
                                                <div class="available_days">
                                                    <input type="radio" required="" value="2" id="night_booking" name="booking" class="available">
                                                    <label for="night_booking">Night</label>
                                                </div>
                                                <div class="available_days">
                                                    <input type="radio" required="" value="3" id="day_night_booking" name="booking" class="available">
                                                    <label for="day_night_booking">24 Hours</label>
                                                </div>
                                            </div>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                            <button type="submit" id="btn-submit" class="btn btn-primary pull-right">Update Profile</button>

                        </form>

                    </div>

                </div>

            </div>

            

        </div>

    </div>

</div>

@endsection

@push('script')

<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>

<script src="{{asset  ('js/scripts/forms/validation/form-validation.js')}}"></script>





@if(Session::get('accountId') == 2)

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script>

let maxdate = new Date();

maxdate.setDate(maxdate.getDate() - 6570);

$('#book_date').datepicker({

    uiLibrary: 'materialdesign',

    inline: false,

    format: 'dd-mmmm-yyyy',

    //maxDate: maxdate,

    modal: true,

    header: true,

    footer: true

});

</script>

@endif

@endpush