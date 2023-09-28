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
                @endphp
                <div class="card">
                    <div class="card-body booking-details-body">
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="doctor-img">
                                            <img src="{{ $photo }}" class="img-fluid" alt="User Image">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="doc-info-cont">
                                            <h4 class="doc-name">
                                                {{ $assistant_name }}
                                                <span class="doc-splnum">#{{ $value->booking_id }}</span>
                                            </h4>
                                            <div class="col-md-12 p-0">
                                                <div class="d-info">
                                                    @if(!empty($age))
                                                    <small class="d-age">{{ $age }}</small>
                                                    @endif
                                                    @if(!empty($gender))
                                                    <small class="d-gender">{{ $gender }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="clearfix"></div>
                                            <div class="clini-infos row">
                                                <div class="col-6">
                                                    <ul>
                                                        <li>
                                                            <i class="fas fa-calendar-check"></i>{{ date('d F Y' ,strtotime($value->book_date)) }}
                                                        </li>
                                                        <li>
                                                            <i class="fas fa-business-time"></i>{{ (new \App\Helpers\CustomerHelper)->bookingCriteriaStatus($value->booking_criteria) }}
                                                        </li>
                                                        <li>
                                                            <span class="d-block"><i class="fas fa-clock"></i>{{ $value->arrival_time ?? 'N/A' }}</span>
                                                        </li>
                                                        <li>
                                                            <i class="far fa-motorcycle"></i>{{ $value->pickup_status ? $value->arrival_km : '00-00 KM' }}
                                                        </li>
                                                        <li>
                                                            <i class="far fa-prescription"></i>{!! $value->early_serial_status ? 'Serial no <small class="d-gender">'.$value->early_serial.'</small>' : 'Not Required' !!}
                                                        </li>
                                                        <li>
                                                            <i class="far fa-utensils-alt"></i>{{ $value->fooding_status ? 'Customer will offer fooding' : 'No food offers' }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul>
                                                        <li>
                                                            <i class="fas fa-mobile"></i> {{ $phone }}
                                                        </li>
                                                        <li title="{{ $assistant_email }}">
                                                            <i class="fas fa-envelope"></i>
                                                            {{ strlen($assistant_email) > 15 ? substr($assistant_email,0,15)."..." : $assistant_email }}
                                                        </li>
                                                        @if(!empty($address))
                                                        <li>
                                                            <i class="fas fa-map-marker-alt"></i>{{ $address }}
                                                        </li>
                                                        @endif
                                                        <li>
                                                            <i class="far fa-money-bill-alt"></i>&#8377;{{ $value->grand_price }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="white-bx">
                                    <!-- About Details -->
                                    <h4>PATIENT DETAILS</h4>
                                    <div class="widget about-widget">
                                        <h5 class="doc-name">{{ $customer_meta['patient_name'] }}</h5>
                                        <p class="m-0">Mobile Number: <strong>+91
                                                {{ $customer_meta['patient_mobile'] }}</strong></p>
                                        <p class="m-0">Whats App Number: <strong>+91
                                                {{ $customer_meta['whats_app_no'] }}</strong></p>
                                        <p class="m-0">Email: <strong>{{ $customer_meta['patient_email'] }}</strong></p>
                                        <p class="m-0">Gender: <strong>{{ $customer_meta['gender'] }}</strong></p>
                                        <p class="m-0">Age: <strong>{{ $customer_meta['age'] }}</strong></p>
                                        <p>Booking Status:
                                            @if($value->booking_status == 1)
                                            <span class="badge badge-pill bg-success-light"> <i class="nc-icon nc-satisfied"></i> Booked</span>
                                            @elseif($value->booking_status == 2)
                                            <span class="badge badge-pill bg-success-light"> <i class="nc-icon nc-check-2"></i> Accepted</span>
                                            @elseif($value->booking_status == 3)
                                            <span title="On Service" class="badge badge-pill bg-warning-light"><i class="nc-icon nc-bulb-63"></i> On Service</span>
                                            @elseif($value->booking_status == 4)
                                            <span title="Cancelled" class="badge badge-pill bg-danger-light"><i class="nc-icon nc-simple-remove"></i> Cancelled</span>
                                            @elseif($value->booking_status == 5)
                                            <span title="Completed" class="badge badge-pill bg-success-light"><i class="nc-icon nc-satisfied"></i> Completed</span>
                                            @endif
                                        </p>
                                    </div>
                                    <!-- /About Details -->
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
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
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="mm-book-table-data">
                        <div class="name">Medical Mate: {{ $assistant_name }} @if(!empty($gender))<span>{{ $gender }}</span>@endif</div>
                        <div class="hl-content">
                            <ul>
                                <li>Booking ID: {{ $value->booking_id }}</li>
                                <li>Current Age: @if(!empty($age)) {{ $age }} Years @endif</li>
                                <li>Service Area: @if(!empty($address)) {{ $address }} @endif</li>
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
                                <li>Service Charge: Rs {{ $value->grand_price }} </li>
                                <li>Bike fair for: {{ $value->pickup_status ? $value->arrival_km : '00-00 KM' }}</li>
                                <li>Fooding Offer: {{ $value->fooding_status ? 'Yes' : 'No' }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mm-book-table-data patient-mate">
                        <div class="name">PATIENT MATE: {{ $customer_meta['patient_name'] }} <span>{{ $customer_meta['gender'] }}</span></div>
                        <div class="content">
                            <ul>
                                <li>Patient Current Age: {{ $customer_meta['age'] }}</li>
                                <!--<li>Patient From: Pattaamundai Kendrapara</li>-->
                                <li>Mobile No: {{ $customer_meta['patient_mobile'] }}</li>
                                <li>What’s App No: {{ $customer_meta['whats_app_no'] }}</li>
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
                            Payment Status: @if($value->payment_receive_status==1) Paid @elseif($value->payment_receive_status==2) Unpaid Pay on Service @elseif($value->payment_receive_status==3) Medmate Payment Paid @endif
                        </div>
                        <div class="content-patient bg-info">
                            Booking Status: {{ (new \App\Helpers\CustomerHelper)->bookingStatus($value->booking_status) }}
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="blue-bg text-center">
                        <h4>WE RESPECT YOUR TIME & BUDGET</h4>
                        <p>Sorry! Due to late response by the Vishal Kumar Behera so admin assigned to Rakesh Kumar Patra </p>
                    </div>
                    <div class="mm-rebook-profile">
                        <div class="mm-rebook-img">
                            <img src="{{ asset('frontend-source/images/t-1.jpg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="mm-rebook-details">
                            <h4>Vishal Kumar Behera</h4>
                            <span>Male</span>
                            <p>Service Area: Bhubaneswar<br>
                            Pick Up & Drop: Yes<br>
                            Service Charge: 400/Day<br>
                            Reason of skip: I’m not in that location</p>
                        </div>
                    </div>
                    <div class="mm-rebook-profile">
                        <div class="mm-rebook-img">
                            <img src="{{ asset('frontend-source/images/t-1.jpg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="mm-rebook-details">
                            <h4>Vishal Kumar Behera</h4>
                            <span>Male</span>
                            <p>Service Area: Bhubaneswar<br>
                            Pick Up & Drop: Yes<br>
                            Service Charge: 400/Day<br>
                            Reason of skip: I’m not in that location</p>
                        </div>
                    </div>
                    <div class="mm-rebook-profile">
                        <div class="mm-rebook-img">
                            <img src="{{ asset('frontend-source/images/t-1.jpg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="mm-rebook-details">
                            <h4>Vishal Kumar Behera</h4>
                            <span>Male</span>
                            <p>Service Area: Bhubaneswar<br>
                            Pick Up & Drop: Yes<br>
                            Service Charge: 400/Day<br>
                            Reason of skip: I’m not in that location</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row action-btn-part">
                            <div class="col-4"><a href="{{ url($account_prefix.'/bookings') }}" class="btn bg-primary btn-fill">Go Back</a></div>
                            <div class="col-4 text-center"></div>
                            <div class="col-4 text-right"><a href="#" class="btn bg-danger btn-fill">Cancel</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')

@endpush