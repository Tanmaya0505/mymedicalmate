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
            
            <div class="col-lg-8">
                <div class="booking-form">
                    <h2 class="mb20">Fill the Booking Information</h2>
                    <form class="needs-validation" novalidate id="book-assistant-serial">
                        @csrf
                       
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
                                <input placeholder="Select date" type="text" name="book_date" id="book_date_serial" class="form-control" required>
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
                                    <option value="1">UPI/Online</option>
                                    <option value="2">Pay After Service</option>
                                </select>
                                <div class="invalid-feedback">Please Enter Destination Address</div>
                            </div>
                            
                       
                        
                        
                        <div class="text-center">
                            <button type="submit" id="btn-submit-request" class="btn btn-primary">Next</button>
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
    $('input[type=radio][name=early_serial_status]').change(function() {
        let value = $( 'input[name=early_serial_status]:checked' ).val();
        if (value == 1) {
            $('#early_serial').removeClass('d-none');
        } else{
            $('#early_serial').addClass('d-none');
        }
    });
    $('.oldpatient').hide();
    $('#patient_type').change(function(){

        if($(this).val()=='Old Patient'){
                $('.oldpatient').show();

        }else{
            $('.oldpatient').hide();
        }

    });
    
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
                  height:'30px',
                  width:'30px'
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
    
</script>
@endpush