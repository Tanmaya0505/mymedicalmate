@extends('frontend-source.customer-dashboard.layouts.master')
@section('title') Bookings @stop
@section('keywords') Bookings @stop
@section('description') Bookings @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">
<style>
    ul {
        list-style: none;
        margin: 0;
        padding: 0;
        font-size: 14px;
    }
</style>
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">BOOKING DETAILS</h4>
                @php
                if($value->assistant_boy_meta){
                    $assistant_boy_meta = json_decode($value->assistant_boy_meta, true);
                    if(!empty($value->assistant_boy_id)){
                    $assistant_name = strtoupper($assistant_boy_meta['first_name'].' '.$assistant_boy_meta['last_name']);
                    $photo = asset('assistant/'. $assistant_boy_meta['photo']);
                    if(empty($assistant_boy_meta['photo']) || !file_exists(public_path('assistant/'. $assistant_boy_meta['photo']))){
                        $photo = asset('frontend-source/images/assistant-boy-icon.png');
                    }
                    $phone = $assistant_boy_meta['phone'];
                    $age = $assistant_boy_meta['dob_year'];
                    $gender = $assistant_boy_meta['gender'];
                    $address = $assistant_boy_meta['present_address'] . ', ' .$assistant_boy_meta['dist'] . ', ' .
                    $assistant_boy_meta['state'] .' (' . $assistant_boy_meta['pincode'] . ')';
                    } else {
                    $assistant_name = strtoupper($assistant_boy_meta['name']);
                    $photo = env('LOGO_URL');
                    $phone = 'N/A';
                    $age = '';
                    $gender = '';
                    $address = '';
                    }
                    $assistant_email = $assistant_boy_meta['email'];
                    $customer_meta = json_decode($value->customer_meta, true);
                }
                @endphp
                <div class="mm-book-table-data">
                    <div class="name">Medical Mate: {{ @$assistant_name }} @if(!empty($gender))<span>{{ $gender }}</span>@endif</div>
                    <div class="hl-content">
                        <ul>
                            <li>Booking ID: {{ $value->booking_id }}</li>
                            <li>Current Age: @if(!empty($age)) {{ $age }} Years @endif</li>
                            <li>Service Area: @if(!empty($address)) {{ $address }} @endif</li>
                            <li>Pin: {{$value->booking_pin}}</li>
                            <li>Confirm Message: @if(!empty($value->confirm_message_assistant_boy)) {{ $value->confirm_message_assistant_boy }} @endif</li>
                        </ul>
                    </div>
                    <div class="content">
                        <ul>
                            <li>Booking Date: {{ date('d F Y' ,strtotime($value->created_at)) }}</li>
                            <li>Service Date: {{ date('d F Y' ,strtotime($value->book_date)) }}</li>
                            <li>Booking for: {{ (new \App\Helpers\CustomerHelper)->bookingCriteriaStatus($value->booking_criteria) }}</li>
                            <li>Booking Time: {{ date('H:i A' ,strtotime($value->created_at)) }}</li>
                            <li>Arrival Time: {{ $value->arrival_time ?? 'N/A' }}</li>
                            <li>Need Earlier Serial No for: {{ $value->early_serial_status ? $value->early_serial : 'Not Required' }} </li>
                            <li>Service Charge: Rs {{ $value->total_price }} </li>
                            <li>Bike fair for: {{ $value->pickup_status ? $value->arrival_km : '00-00 KM' }}</li>
                            <li>Fooding Offer: {{ $value->fooding_status ? 'Yes' : 'No' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="mm-book-table-data patient-mate">
                    <div class="name">PATIENT MATE: {{ @$customer_meta['patient_name'] }} <span>{{ @$customer_meta['gender'] }}</span></div>
                    <div class="content">
                        <ul>
                            <li>Patient Current Age: {{ @$customer_meta['age'] }}</li>
                            <!--<li>Patient From: Pattaamundai Kendrapara</li>-->
                            <li>Mobile No: {{ @$customer_meta['patient_mobile'] }}</li>
                            <li>What’s App No: {{ @$customer_meta['whats_app_no'] }}</li>
                        </ul>
                    </div>
                    <div class="content-patient">
                            PAYMENT DETAILS
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-9">Medical Mate Service Charge</div>
                            <div class="col-3">Rs {{ $value->total_price }}</div>
                        </div>
                        <div class="row">
                            <div class="col-9">Bike Charges for({{ $value->arrival_km ?? '00-00Km' }})</div>
                            <div class="col-3">Rs {{ $value->pickup_price }}</div>
                        </div>
                        <div class="row">
                            <div class="col-9">Coin Applied</div>
                            <div class="col-3">Rs <span class="strike">{{ $value->discount_price }}</span></div>
                        </div>
                        <!--<div class="row t-border">
                            <div class="col-9">Bike fair for 20-30 km:</div>
                            <div class="col-3">Rs 150</div>
                        </div>-->
                    </div>
                    <div class="content-patient">
                        <div class="row t-border">
                            <div class="col-9">Total Amount</div>
                            <div class="col-3">Rs {{ $value->grand_price }}</div>
                        </div>
                    </div>
                    <div class="content-patient bg-success">
                    Payment Status: @if($value->paid==1) Paid @elseif($value->payment_receive_status==1) Unpaid Pay on Service @elseif($value->payment_receive_status==3) Medmate Payment Paid @else Pending @endif
                    </div>
                    <div class="content-patient bg-info">
                        Booking Status: {{ (new \App\Helpers\CustomerHelper)->bookingStatus($value->booking_status) }}
                    </div>
                    @if($value->booking_status==2)
                        @if(!$value->confirm_message_assistant_boy)
                        <div class="content-patient ">
                            <a href="javascript:void(0)"  href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="confirmAvlRequest('{{ $value->booking_id }}')" class="btn bg-info btn-fill">Confirm Medmate Contacted Or Not?</a>
                        </div>
                        @endif
                    @endif
                </div>
                @if($value->FwrdData->isNotEmpty())
                <div class="blue-bg text-center">
                    <h4>WE RESPECT YOUR TIME & BUDGET</h4>
                    <p>Sorry! Due to late response by the Vishal Kumar Behera so admin assigned to Rakesh Kumar Patra </p>
                </div>
                @foreach($value->FwrdData as $fwdKey=>$fwdVal)
                @php
                $assistant_boy_fwrd_from_meta = json_decode($fwdVal->assistant_boy_fwrd_from_meta, true);
                if(!empty($fwdVal->assistant_boy_fwrd_from_id)){
                    $name        = strtoupper($assistant_boy_fwrd_from_meta['first_name'] . ' ' . $assistant_boy_fwrd_from_meta['last_name']);
                    $age         = $assistant_boy_fwrd_from_meta['dob_year'];
                    $gender      = $assistant_boy_fwrd_from_meta['gender'];
                    $email       = $assistant_boy_fwrd_from_meta['email'];
                    $day_charges = $assistant_boy_fwrd_from_meta['day_charges'];
                    $night_charges = $assistant_boy_fwrd_from_meta['night_charges'];
                    $comment     = $fwdVal['assistant_boy_fwrd_comment'];
                    $assistant_fwrd_photo = asset('assistant/'. $assistant_boy_fwrd_from_meta['photo']);
                    if(empty($assistant_boy_fwrd_from_meta['photo']) || !file_exists(public_path('assistant/'. $assistant_boy_fwrd_from_meta['photo']))){
                        $assistant_fwrd_photo = asset('frontend-source/images/assistant-boy-icon.png');
                    }
                } else {
                    $name        = strtoupper($assistant_boy_fwrd_from_meta['name']);
                    $age         = '';
                    $gender      = '';
                    $email       = $assistant_boy_fwrd_from_meta['email'];
                    $day_charges = 0.00;
                    $night_charges = 0.00;
                    $comment     = $fwdVal['assistant_boy_fwrd_comment'];
                    $assistant_fwrd_photo = asset($assistant_boy_fwrd_from_meta['photo']);
                }
                @endphp
                <div class="mm-rebook-profile">
                    <div class="mm-rebook-img">
                        <img src="{{ $assistant_fwrd_photo }}" class="img-fluid" alt="">
                    </div>
                    <div class="mm-rebook-details">
                        <h4>{{ $name }}</h4>
                        <span>{{ $gender }}</span>
                        Service Charge: @if($value->booking_criteria == 1) {{ $day_charges }} @elseif($value->booking_criteria == 2) {{ $night_charges }} @else {{ $day_charges+$night_charges }} @endif<br>
                        Reason of skip: {{ $fwdVal['assistant_boy_fwrd_comment'] }}</p>
                    </div>
                </div>
                @endforeach
                @endif
                <hr />
                        <div class="tab-content pt-0">
                            <!-- Overview Content -->
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    @if($value->FwrdData->isNotEmpty())
                                    <!-- Education Details -->
                                    <div class="widget education-widget">
                                        <h4 class="widget-title">FORWARDED ASSISTANT</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach($value->FwrdData as $fwdKey=>$fwdVal)
                                                @php
                                                $assistant_boy_fwrd_from_meta = json_decode($fwdVal->assistant_boy_fwrd_from_meta, true);
                                                if(!empty($fwdVal->assistant_boy_fwrd_from_id)){
                                                    $name        = strtoupper($assistant_boy_fwrd_from_meta['first_name'] . ' ' . $assistant_boy_fwrd_from_meta['last_name']);
                                                    $age         = $assistant_boy_fwrd_from_meta['dob_year'];
                                                    $gender      = $assistant_boy_fwrd_from_meta['gender'];
                                                    $email       = $assistant_boy_fwrd_from_meta['email'];
                                                    $day_charges = $assistant_boy_fwrd_from_meta['day_charges'];
                                                    $night_charges = $assistant_boy_fwrd_from_meta['night_charges'];
                                                    $comment     = $fwdVal['assistant_boy_fwrd_comment'];
                                                    $assistant_fwrd_photo = asset('assistant/'. $assistant_boy_fwrd_from_meta['photo']);
                                                    if(empty($assistant_boy_fwrd_from_meta['photo']) || !file_exists(public_path('assistant/'. $assistant_boy_fwrd_from_meta['photo']))){
                                                        $assistant_fwrd_photo = asset('frontend-source/images/assistant-boy-icon.png');
                                                    }
                                                } else {
                                                    $name        = strtoupper($assistant_boy_fwrd_from_meta['name']);
                                                    $age         = '';
                                                    $gender      = '';
                                                    $email       = $assistant_boy_fwrd_from_meta['email'];
                                                    $day_charges = 0.00;
                                                    $night_charges = 0.00;
                                                    $comment     = $fwdVal['assistant_boy_fwrd_comment'];
                                                    $assistant_fwrd_photo = asset($assistant_boy_fwrd_from_meta['photo']);
                                                }
                                                @endphp
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle">
                                                            <img src="{{ $assistant_fwrd_photo }}" class="img-fluid" alt="Photo">
                                                        </div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">{{ $name }}</a>
                                                            @if(!empty($age))
                                                            <h6 class="exp-title">
                                                                Age {{ $age }}
                                                                <span>{{ $gender }}</span>
                                                            </h6>
                                                            @endif
                                                            <span class="time"><strong>Email:</strong>
                                                                {{ $email }}</span>
                                                            <span class="time"><strong>Price:</strong>
                                                                &#8377;
                                                                @if($value->booking_criteria == 1)
                                                                    {{ $day_charges }}
                                                                @elseif($value->booking_criteria == 2)
                                                                    {{ $night_charges }}
                                                                @else
                                                                    {{ $day_charges+$night_charges }}
                                                                @endif
                                                            </span>
                                                            <span class="time"><strong>Forwarded Reason:</strong>
                                                                {{ $fwdVal['assistant_boy_fwrd_comment'] }}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Education Details -->
                                    @endif
                                </div>
                            </div>
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
                                                    <span
                                                        class="comment-author">{{ $customer_meta['patient_name'] }}
                                                    </span>
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
                            <!-- /Review Listing -->
                            @else
                            <div class="write-review">
                                <h4>Write a review for <strong>{{ $assistant_name }}</strong></h4>
                                <!-- Write Review Form -->
                                <form method="POST" action="{{ url($account_prefix.'/add-review') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="booking_id" value="{{ $value->id }}" />
                                    <div class="form-group">
                                        <label>Review</label>
                                        <div class="star-rating">
                                            <input id="star-5" type="radio" name="rating" value="5">
                                            <label for="star-5" title="5 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-4" type="radio" name="rating" value="4">
                                            <label for="star-4" title="4 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-3" type="radio" name="rating" value="3">
                                            <label for="star-3" title="3 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-2" type="radio" name="rating" value="2">
                                            <label for="star-2" title="2 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-1" type="radio" name="rating" value="1">
                                            <label for="star-1" title="1 star">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Upload your photo</label>
                                        <input class="form-control" type="file" name="photo" />
                                    </div>
                                    <div class="form-group">
                                        <label>Your review</label>
                                        <textarea id="review_desc" required="" name="review" class="form-control"
                                                  rows="3"></textarea>
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Add Review</button>
                                    </div>
                                </form>
                                <!-- /Write Review Form -->
                            </div>
                            @endif
                            @endif
                        </div>
                <div class="row action-btn-part mt-5">
                        <div class="col-4"><a href="{{ url($account_prefix.'/bookings') }}" class="btn bg-primary btn-fill">Go Back</a></div>
                        <div class="col-4 text-center"></div>
                        <div class="col-4 text-right">
                            
                            @if(isset($value->prescription))
                            <a href="{{url('user/prescription/'.$value->booking_id)}}" class="btn bg-success btn-fill">Go To Prescription Details</a>
                            @endif
                            @if($value->paid == 0 && $value->booking_status==3 &&  $value->assistant_boy_id)
                            <a href="javascript:void(0)" id="confirm-payment-assistant" class="btn btn-fill bg-success float-right mt-2">Pay Now</a>
                            @endif
                            @if($value->booking_status == 3 && $value->payment_receive_status == 1 && $value->paid == 1)
                            <a href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="completeBooking('{{ $value->booking_id }}')"class="btn bg-success btn-fill mt-5">Complete</a>
                            @endif
                            
                            @if($value->booking_status == 1 || $value->booking_status == 2)

                            @if($value->booking_type == 'fullbook')
                            <a class="btn btn-primary chkstatus" href="{{url('direct-booking/search-medmate/'.$value->booking_id)}}" data-id="{{$value->booking_id}}" href="">Re-search</a>
                            @endif

                            <a href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="cancelBooking('{{ $value->booking_id }}')"class="btn bg-danger btn-fill">Cancel</a>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="startserviceotp" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="startserviceotpLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="startserviceotpLabel">VERIFY OTP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="otp-validation" novalidate id="confirm-book-assistant">
                    <input type="hidden" name="booking_id" id="otp_booking_id" />
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

<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="staticBackdropLabel"><i class="nc-icon nc-notes"></i> Booking cancellation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="doctor-widget"></div>
                <form novalidate id="cancel-booking-form">
                    <input type="hidden" name="booking_id" id="booking_id" />
                    <input type="hidden" name="from_canceled" id="from_canceled" value="2" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Cancel Reasons:</label>
                        <textarea type="text" placeholder="Cancel Reasons" class="form-control" name="cancel_reason" id="cancel_reason" required=""></textarea>
                        <div class="invalid-feedback">Please write the reasons</div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-confirm" class="btn btn-primary btn-sm btn-fill">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="avl_cnf_booking_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="startserviceotpLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="startserviceotpLabel">Confirm Medmate Contact </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="otp-validation" novalidate id="avl_cnf_booking_form">
                    <input type="hidden" name="booking_id" id="avl_cnf_booking_id" />
                    <input type="hidden" name="message" id="avl_cnf_booking_message" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Is Medmate Contacted or Not ? </label>
                        <div class="form-group">
                            <button type="button" data-msg="yes"  class="btn btn-primary medmatecnfmsg">Yes</button>
                            <button type="button" data-msg="no"  class="btn btn-primary medmatecnfmsg">No</button>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <button type="submit" id="btn-confirm" class="btn btn-primary">Confirm</button>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>

    var prefix = "@php echo $account_prefix @endphp";

    $('.medmatecnfmsg').on('click',function(){
        var msg = $(this).data('msg');
        $('#avl_cnf_booking_message').val(msg);
        $('#avl_cnf_booking_form').submit();
    });

</script>

<script src="{{asset('frontend-source/myaccount/assets/js/user-validate.js')}}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$('#confirm-payment-assistant').click(function (e) {
    e.preventDefault();
    
        $.ajax({
            type: "POST",
            url: "/razorpay",
            data: {'id':"{{$value->booking_id}}",'desc':"{{$booking_desc}}",'amount':"{{$amount}}",'type':'serviceclose'},
            dataType: 'json',
            beforeSend: function () {
                $('.xhr-loading').css({'display':'block'});
            },
            success: function (data) {
                //$('#btn-confirm').html('Confirm');
                $('.xhr-loading').css({'display':'none'});
                if (data.code === 200) {
                    $("#staticBackdrop").modal('hide');
                    if(data.payment_mode == 1){
                        var unique_id = data.booking_id;
                        var options = {
                            key: data.key_id,
                            amount: (data.amount * 100),
                            name: data.name,
                            description: unique_id,
                            //image: "",
                            handler: function (response) {
                                $.ajax({
                                    url: '/medihelp/update-transaction',
                                    type: 'post',
                                    dataType: 'json',
                                    beforeSend: function () {
                                        $('.xhr-loading').css({'display':'block'});
                                    },
                                    data: {
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        totalAmount: data.amount,
                                        unique_id: unique_id
                                    },
                                    success: function (msg) {
                                        window.location.reload();
                                        //window.location.href = hostname + 'booking-success/' + msg.booking_id;
                                    }
                                });
                            },
                            prefill: {
                                contact: $('#patient_mobile').val(),
                                email: $('#patient_email').val()
                            },
                            theme: {
                                color: "#002060"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    } else {
                        $.notify({
                            title: '<strong>Success !</strong>',
                            message: data.message
                        },{
                            type: "success"
                        });
                        setTimeout(function(){ 
                            window.location.reload();
                            //window.location.href = hostname + 'booking-success/' + data.booking_id;
                            //$('#staticBackdrop').unblock();
                        }, 2000);
                    }
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
                $('#staticBackdrop').unblock();
                console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
            } 
        });
    
});
</script>
@endpush