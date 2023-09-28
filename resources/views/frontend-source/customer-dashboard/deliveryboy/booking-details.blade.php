@extends('frontend-source.customer-dashboard.layouts.master')

@section('title') Bookings @stop

@section('keywords') Bookings @stop

@section('description') Bookings @stop

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">

@endsection

@section('content')

<div class="content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <h4 class="mb-4">BOOKING DETAILS</h4>

                @php

                $delivery_address = json_decode($prescription->delivery_address, true);

               $patient_name = $prescription->full_name;

                $phone = $prescription->mobile_no;

                $age = $prescription->age;

                $gender = $prescription->gender;

                $address = $delivery_address['address'];
                $value = $prescription;

                $photo = '';

                


                @endphp

                <div class="card">

                    <div class="card-body booking-details-body">

                        <div class="row">

                            <div class="col-xl-5">

                                <div class="row">

                                    <div class="col-3">

                                        <div class="doctor-img">

                                            <img src="{{ $photo }}" class="img-fluid" alt="User Image">

                                        </div>

                                    </div>

                                    <div class="col-9">

                                        <div class="doc-info-cont">

                                            
                                            <p class="m-0"><strong>

                                                {{ $patient_name }}</strong></p>
                                                
                                                <p class="m-0">Age: <strong>{{ $age }}({{ $gender }})</strong></p>
                                            <p class="m-0">Mobile Number: <strong>+91

                                                {{ $phone }}</strong></p>


                                        </div>    
                                    </div>        
                                    <div class="col-12">

                                        <div class="doc-info-cont">
                                            <hr>

                                            <div class="clearfix"></div>

                                            <div class="clini-infos row">

                                                <div class="col-12">

                                                    <ul>

                                                        <li>

                                                            <i class="fas fa-calendar-check"></i>{{ date('d F Y' ,strtotime($value->created_at)) }}

                                                        </li>

                                                        <li>

                                                            <i class="fas fa-business-time"></i>{{ (new \App\Helpers\CustomerHelper)->prescriptionsStatus($value->customer_status) }}

                                                        </li>

                                                        <li>

                                                            <span class="d-block"><i class="fas fa-clock"></i>{{ $delivery_address['address'] }}</span>

                                                        </li>

                                                        

                                                        

                                                    </ul>

                                                </div>

                                                
                                                
                                                <div class="clearfix"></div>

                                            </div>

                                        </div>
                                        @if($value->customer_status == 5)

                                        <!-- <a title="Accept Request" href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="acceptBooking('{{ $value->booking_id }}')"><span class="badge badge-pill bg-warning-light"> <i class="nc-icon nc-tap-01"></i> Accept</span></a> -->

                                        
                                       

                                        @elseif($value->customer_status == 10)

                                            @if(!$value->deliveryboy)
                                                
                                                <a title="Accept Request" href="javascript:void(0)"   data-id="{{ $value->order_id }}" onclick="acceptBooking('{{ $value->order_id }}',1)" class="btn bg-info btn-fill"><i class="nc-icon nc-tap-01"></i> Accept</a>
                                                <a title="Decline Request" href="javascript:void(0)"   data-id="{{ $value->order_id }}" onclick="acceptBooking('{{ $value->order_id }}',2)" class="btn bg-info btn-fill"><i class="nc-icon nc-tap-01"></i> Decline</a>

                                            @else

                                                    @if($value->deliveryboy->status=='Accept')
                                                        <span class="btn  btn-fill bg-success-light"> <i class="nc-icon nc-check-2"></i> Accepted</span>
                                                    @elseif($value->deliveryboy->status=='Cancel')
                                                    <span class="btn  btn-fill bg-danger-light"> <i class="nc-icon nc-check-2"></i> Cancelled</span>
                                                    @endif
                                                
                                            @endif

                                        @elseif($value->customer_status == 11)

                                        <span title="On Service" class="badge badge-pill bg-warning-light"><i class="nc-icon nc-bulb-63"></i> On Service</span>
                                        <a title="Accept Request" href="javascript:void(0)"   data-id="{{ $value->order_id }}" onclick="deliveryBooking('{{ $value->order_id }}')" class="btn bg-info btn-fill"><i class="nc-icon nc-tap-01"></i> Confirm Delivery</a>
                                        @elseif($value->customer_status == 0)

                                        <span title="Cancelled" class="badge badge-pill bg-danger-light"><i class="nc-icon nc-simple-remove"></i> Cancelled</span>

                                        @elseif($value->customer_status == 6)

                                        <span title="Completed" class="badge badge-pill bg-success-light"><i class="nc-icon nc-satisfied"></i> Completed</span>

                                        @endif

                                       

                                       

                                        
                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>

                            

                            <div class="clearfix"></div>

                        </div>

                        <hr />

                        <div class="tab-content pt-0">

                            <!-- Overview Content -->

                            

                            @if($value->booking_status == 5)

                            <nav class="user-tabs mb-4 mt-4 review-tab">

                                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">

                                    <li class="nav-item">

                                        <span class="nav-link" href="#doc_reviews" data-toggle="tab">REVIEW</span>

                                    </li>

                                </ul>

                            </nav>

                            @if($value->reviewData->isNotEmpty())

                            @php

                            $review_photo = asset('user/review/'. $value->reviewData[0]->photo);

                            if(empty($value->reviewData[0]->photo) || !file_exists(public_path('user/review/'. $value->reviewData[0]->photo))){

                                $review_photo = asset('frontend-source/images/assistant-boy-icon.png');

                            }

                            @endphp

                            <!-- Review Listing -->

                            <div class="widget review-listing">

                                <ul class="comments-list">

                                    <!-- Comment List -->

                                    <li>

                                        <div class="comment">

                                            <img class="avatar avatar-sm rounded-circle" alt="User Image" src="{{ $review_photo }}">

                                            <div class="comment-body">

                                                <div class="meta-data">

                                                    <span class="comment-author">{{ $prescription->full_name }}</span>

                                                    <span class="comment-date">Reviewed

                                                        <span class="comment-date-hl"><i class="far fa-calendar-alt"></i>{{ date('d F Y' ,strtotime($value->reviewData[0]->created_at)) }}</span>

                                                    </span>

                                                    <div class="review-count rating">

                                                        @for($i = 0; $i < $value->reviewData[0]->rating; $i++)

                                                        <i class="fas fa-star filled"></i>

                                                        @endfor

                                                    </div>

                                                </div>

                                                <p class="comment-content">{{ $value->reviewData[0]->review }}</p>

                                            </div>

                                        </div>

                                    </li>

                                    <!-- /Comment List -->

                                </ul>

                            </div>

                            @endif

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<!--Comment modal popup-->



<!--End Comment modal popup-->

<div class="modal fade" id="startserviceotp" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="startserviceotpLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="startserviceotpLabel">VERIFY User PIN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="otp-validation" novalidate id="confirm-book-assistant">
                    <input type="hidden" name="booking_id" id="otp_booking_id" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">PIN:</label>
                        <input type="text" placeholder="PIN" class="form-control" name="otp" id="otp" required="">
                        <div class="invalid-feedback">Please enter your PIN</div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-confirm" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="complete-confirm-service-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="startserviceotpLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="startserviceotpLabel">TO COMPLETE SERVICE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="otp-validation" novalidate id="complete-confirm-service">
                    <input type="hidden" name="booking_id" id="confirm_servic_booking_id" />
                    <div class="col-lg-12 service-details">
                        <b> Please fill the below details in order to ending the services</b>
                        <div id="row">
                            <ul class="list-group">
                                <li class="list-group-item"><input type="text" class="form-control hospital-valid" name="hospital[]" placeholder="Clinic/Hospital Name:"></li>
                                <li class="list-group-item"><input type="text" class="form-control doctor-valid" name="doctor[]" placeholder="Doctors Name:"></li>
                                <li class="list-group-item"><input type="text" class="form-control specialized-valid" name="specialized[]" placeholder="Specialized In:"></li>
                            </ul>
                        </div>
     
                        <div id="newinput"></div>
                        <a id="rowAdder" type="button"
                            class="float-right">
                            <i class="fa fa-plus fa-3x" aria-hidden="true"></i>
                        </a>
                        <div class="form-group mt-5">
                            <button type="button" id="btn-add-detail" class="btn btn-primary float-right">Add Details</button>
                        </div>
                    </div>
                    <div class="row complete-service" style="display:none">
                        <div class="form-group " >
                            <label for="recipient-name" class="col-form-label">Complete Service With:</label>
                            <select class="form-control" required="" name="service_close_with">
                                <option>Complete without uploading prescription? </option>
                                <option>Service Complete with purchases medicine? </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="btn-confirm" class="btn btn-primary float-right">Complete Service</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="complete-book-service-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="startserviceotpLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="startserviceotpLabel">VERIFY OTP TO COMPLETE SERVICE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="otp-validation" novalidate id="complete-book-service">
                    <input type="hidden" name="booking_id" id="otp_book_booking_id" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">OTP:</label>
                        <input type="text" placeholder="OTP" class="form-control" name="otp" id="otp_complete-book" required="">
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



@endsection

@push('script')

<script>

    var prefix = "@php echo $account_prefix @endphp";
    var span = document.getElementById('cur_time');

function time() {
  var d = new Date();
  var ampm = d.getHours( ) >= 12 ? ' PM' : ' AM';
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = (d.getHours() <= 12) ? d.getHours() : d.getHours() - 12;
  span.textContent = 
    ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2)+ ampm;;
}

setInterval(time, 1000);



// Set the date we're counting down to
var countDownDate = new Date("{{\Carbon\Carbon::parse($value->service_start_time)->addHour($value->extend_hour)->format('F d, Y H:i:s')}}").getTime();

// Update the count down every 1 second
var countdownfunction = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();
  
  // Find the distance between now an the count down date
  var distance = countDownDate - now;
  
  // Time calculations for days, hours, minutes and seconds
 var days = '';//Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
  // Output the result in an element with id="demo"
  document.getElementById("time_to_left").innerHTML =  hours + "h "
  + minutes + "m " + seconds + "s ";
  
if (hours == 0 && minutes < 60 ) {
    $('.extendtime').removeClass('d-none');
  }
  //alert(distance);
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(countdownfunction);
    document.getElementById("time_to_left").innerHTML = "EXPIRED";
  }
}, 1000);


$("#rowAdder").click(function () {
    var valid = true;
    $('.hospital-valid').each(function() {
        if ($(this).val() == '') { 
            valid = false;
          $(this).addClass('highlight');
        }
    });
    $('.doctor-valid').each(function() {
        if ($(this).val() == '') { 
            valid = false;
          $(this).addClass('highlight');
        }
    });
    $('.specialized-valid').each(function() {
        if ($(this).val() == '') { 
            valid = false;
          $(this).addClass('highlight');
        }
    });

    if(valid){
        newRowAdd =
        '<div id="row" class="mt-5"><a id="DeleteRow" type="button" class="float-right">\
            <i class="fa fa-trash fa-1x" aria-hidden="true"></i>\
                    </a>\ <ul class="list-group">\
        <li class="list-group-item"><input type="text" class="form-control hospital-valid" name="hospital[]" placeholder="Clinic/Hospital Name:">\
        </li>\
        <li class="list-group-item"><input type="text" class="form-control doctor-valid" name="doctor[]" placeholder="Doctors Name:"></li>\
        <li class="list-group-item"><input type="text" class="form-control specialized-valid" name="specialized[]" placeholder="Specialized In:"></li>\
        </ul></div>';

        $('#newinput').append(newRowAdd);
    }else{
        alert("Please Enter all fields!");
    }
});
 
$("body").on("click", "#DeleteRow", function () {
    $(this).parents("#row").remove();
})
$('#btn-add-detail').click(function(){
    var valid = true;
    $('.hospital-valid').each(function() {
        if ($(this).val() == '') { 
            valid = false;
          $(this).addClass('highlight');
        }
    });
    $('.doctor-valid').each(function() {
        if ($(this).val() == '') { 
            valid = false;
          $(this).addClass('highlight');
        }
    });
    $('.specialized-valid').each(function() {
        if ($(this).val() == '') { 
            valid = false;
          $(this).addClass('highlight');
        }
    });
    if(valid){
        $('.service-details').hide();
        $('.complete-service').show();
    }else{
        alert("Please Enter all fields!");
    }

});
function extenttime(booking_id){
    $('#extent_time-modal').modal('show');
    $('#otp_extend_booking_id').val(booking_id);
}

$('.otpbtn , .rsotpbtn').on('click',function(){
    $.ajax({
        type: "POST",
        url:  "/sendotp",
        data: {"email":"{{ @$prescription->email }}",'phone':"{{ @$prescription->mobile_no }}",'name':"{{ $prescription->full_name }}"},
        dataType: 'json',
        beforeSend: function () {
            $('.xhr-loading').css({'display':'block'});
        },
        success: function (data) {
            if (data.code === 200) {
                 $.notify({

                    icon: "nc-icon nc-check-2",

                    message: data.message

                },{

                    type: "success"

                });
                $('#extent_time_otp').val(data.otp);
                $('.otpbtn').hide();
                $('.verifybtn').removeClass('d-none').show();
                $('.rsotpbtn').removeClass('d-none').show();
                
            } else {
               console.log(data);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            $('#staticBackdrop').unblock();
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});
$('.verifybtn').on('click',function(){
    $.ajax({
        type: "POST",
        url:  "/verifyotp",
        data: {"otp":$('#extent_time_otp').val()},
        dataType: 'json',
        beforeSend: function () {
            $('.xhr-loading').css({'display':'block'});
        },
        success: function (data) {
            if (data.code === 200) {
                $('.otp_error').html('');
                $('#extent_time_otp').val('')
                 $.notify({

                    icon: "nc-icon nc-check-2",

                    message: data.message

                },{

                    type: "success"

                });
                 $('#btn-extent-time').removeClass('d-none').show();
                
            } else {
               $('.otp_error').html(data.message);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            $('#staticBackdrop').unblock();

            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});
</script>

<script src="{{asset('frontend-source/myaccount/assets/js/deliveryboy-validate.js')}}"></script>

@endpush