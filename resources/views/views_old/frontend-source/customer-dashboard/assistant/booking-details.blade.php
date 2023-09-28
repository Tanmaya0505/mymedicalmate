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

                $assistant_boy_meta = json_decode($value->assistant_boy_meta, true);

                if(!empty($value->assistant_boy_id)){

                $assistant_name = strtoupper($assistant_boy_meta['first_name'].' '.$assistant_boy_meta['last_name']);

                $photo = asset('assistant/'. $assistant_boy_meta['photo']);

                if(empty($assistant_boy_meta['photo']) || !file_exists(public_path('assistant/'. $assistant_boy_meta['photo']))){

                    $photo = asset('frontend-source/images/assistant-boy-icon.png');

                }

                $phone = $assistant_boy_meta['phone'];

                $age = 'Age ' . $assistant_boy_meta['dob_year'];

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

                            <div class="col-xl-5">

                                <div class="row">

                                    <div class="col-3">

                                        <div class="doctor-img">

                                            <img src="{{ $photo }}" class="img-fluid" alt="User Image">

                                        </div>

                                    </div>

                                    <div class="col-9">

                                        <div class="doc-info-cont">

                                            <!-- <h4 class="doc-name">

                                                {{ $assistant_name }}

                                                <span class="doc-splnum">#{{ $value->booking_id }}</span>

                                            </h4> -->
                                            <p class="m-0"><strong>

                                                {{ $assistant_name }}</strong></p>
                                                <p class="m-0">ID: <strong>

                                                {{ $value->assistantData->customerId }}</strong></p>
                                                <p class="m-0">Age: <strong>{{ $assistant_boy_meta['dob_year'] }}({{ $assistant_boy_meta['gender'] }})</strong></p>
                                            <p class="m-0">Mobile Number: <strong>+91

                                                {{ $assistant_boy_meta['phone'] }}</strong></p>

                                        

                                        <p class="m-0">Email: <strong>{{ $assistant_boy_meta['email'] }}</strong></p>

                                        

                                            <!-- <div class="col-md-12 p-0">

                                                <div class="d-info">

                                                    @if(!empty($age))

                                                    <small class="d-age">{{ $age }}</small>

                                                    @endif

                                                    @if(!empty($gender))

                                                    <small class="d-gender">{{ $gender }}</small>

                                                    @endif

                                                </div>

                                            </div> -->
                                        </div>    
                                    </div>        
                                    <div class="col-12">

                                        <div class="doc-info-cont">
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

                                                       <!--  <li>

                                                            <i class="fas fa-mobile"></i> {{ $phone }}

                                                        </li> -->

                                                        <!-- <li title="{{ $assistant_email }}">

                                                            <i class="fas fa-envelope"></i> 

                                                            {{ strlen($assistant_email) > 15 ? substr($assistant_email,0,15)."..." : $assistant_email }}

                                                        </li> -->

                                                        <!-- @if(!empty($address))

                                                        <li>

                                                            <i class="fas fa-map-marker-alt"></i>{{ $address }}

                                                        </li>

                                                        @endif -->

                                                        <li>

                                                            <i class="far fa-money-bill-alt"></i>&#8377;{{ $value->grand_price }}

                                                        </li>

                                                    </ul>

                                                </div>

                                                <div class="clearfix"></div>

                                            </div>

                                        </div>

                                        @if($value->booking_status == 1 && $value->assistant_boy_id == Session::get('userId'))

                                        <a title="Accept Request" href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="acceptBooking('{{ $value->booking_id }}')"><span class="badge badge-pill bg-warning-light"> <i class="nc-icon nc-tap-01"></i> Accept</span></a>

                                        @if($value->fwrd_status == 0 && $value->assistant_boy_id == Session::get('userId'))

                                            <!-- <a title="Forward Request" href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="forwardRequest('{{ $value->booking_id }}')"><span class="badge badge-pill bg-info-light"> <i class="nc-icon nc-spaceship"></i> Forward</span></a> -->

                                        @endif

                                        @elseif($value->booking_status == 2)

                                        <span class="badge badge-pill bg-success-light"> <i class="nc-icon nc-check-2"></i> Accepted</span>

                                        <a href="javascript:void(0)"  href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="startserviceRequest('{{ $value->booking_id }}')" class="btn bg-info btn-fill">Start Service</a>

                                        @elseif($value->booking_status == 3)

                                        <span title="On Service" class="badge badge-pill bg-warning-light"><i class="nc-icon nc-bulb-63"></i> On Service</span>

                                        @if($value->payment_receive_status == 0)
                                        <!-- <a href="{{url('user/order-payment/'.$value->booking_id)}}" class="btn btn-info"><i class="fas fa-credit-card"></i> Pay For Service</a> -->
                                        @endif    

                                        @if(isset($prescription))
                                            <span title="On Service" class="badge badge-pill bg-warning-light"><i class="nc-icon nc-bulb-63"></i> Prescription Uploaded</span>



                                        @endif

                                        @if(isset($prescription) && $prescription->customer_status == 4)
                                            <span title="On Service" class="badge badge-pill bg-warning-light"><i class="nc-icon nc-bulb-63"></i> Invoice Accepted</span>

                                        @endif

                                        
                                        @if($value->payment_receive_status == 1)
                                            <!-- <a href="javascript:void(0)"  href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="completeBooking('{{ $value->booking_id }}')" class="btn bg-info btn-fill">Complete </a> -->
                                        @endif
                                        @elseif($value->booking_status == 4)

                                        <span title="Cancelled" class="badge badge-pill bg-danger-light"><i class="nc-icon nc-simple-remove"></i> Cancelled</span>

                                        @elseif($value->booking_status == 5)

                                        <span title="Completed" class="badge badge-pill bg-success-light"><i class="nc-icon nc-satisfied"></i> Completed</span>

                                        @endif

                                        @if($value->booking_status == 2 && $value->book_date == date('d-m-Y'))

                                        <div class="custom-control custom-switch">

                                            <input type="checkbox" class="custom-control-input" id="onbusy" @if($value->booking_status == 3) disabled checked @endif value="{{ $value->id }}" name="onbusy">

                                            <label class="custom-control-label" for="onbusy">On busy</label>

                                        </div>

                                        @endif

                                        @if($value->booking_status == 3)
                                        <div class="table-action mt-5">
                                            @if($prescription)
                                            <a title="View" href="{{ url($account_prefix.'/prescription/'.$value->booking_id) }}" class="btn btn-sm bg-info btn-fill">
                                                <i class="far fa-eye"></i> View Prescription
                                            </a>
                                            
                                                @if($prescription->is_vendor_assigned==0)
                                               <!--  <a href="{{url('assistant/medmate-search/'.$value->booking_id)}}" class="btn btn-sm bg-info btn-fill" target="_blank">Search {{$value->is_vendor_assigned}}</a> -->
                                                @endif
                                            @endif
                                            <!-- <a title="Cancel" href="javascript:void(0);" @if($value->customer_status == 1) onclick="cancelPrescription('{{ $value->customer_status }}')" @endif class="btn btn-sm bg-danger btn-fill @if($value->customer_status != 1)disabled @endif">
                                                <i class="fas fa-times"></i> Cancel
                                            </a> -->
                                        
                                        </div>
                                        @endif
                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>

                            <div class="col-xl-7">

                                <div class="white-bx">

                                    <!-- About Details -->
                                    <form class="otp-validation" novalidate id="complete-book-service">
                                    <input type="hidden" name="booking_id" id="otp_book_booking_id"  value="{{$value->booking_id}}"  />
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

                                    </div>
                                    @if($value->service_close_request)
                                        <h4>PAYMENT DETAILS</h4>

                                    <div class="widget about-widget">

                                        
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Medical Mate Service Charge :
                                            <span class="">Rs.{{ $value->total_price}}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Bike Charge:
                                            <span class="">Rs.{{ $value->pickup_price}}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Coin Applied:
                                            <span class="">Rs.{{ $value->discount_price}}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Total Payable Amount :
                                            <span class="">Rs.{{ $value->grand_price}}</span>
                                            </li>
                                        </ul>
                                        @if($value->booking_status!=5)
                                        <div class="clini-infos row">

                                                <div class="col-6">
                                                    <ul class="list-group">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                                            <select  class="form-control"
                                                             name="paid_by" id="payment_mode" >
                                                                 <option>Payment by QR/UPI</option>
                                                                 <option>Payment by Cash</option>
                                                             </select>
                                                        </li>
                                                        
                                                        
                                                        </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="list-group">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <input type="text" id="otp_complete-book" class="form-control border-0"
                                                             name="otp" placeholder="Enter Otp">
                                                             <a href="javascript:void(0)" onClick="completeBooking({{$value->booking_id}});"   >Refresh</a>
                                                        </li>
                                                        
                                                        
                                                    </ul>
                                                </div>
                                        </div>
                                        @endif
                                    </div>
                                    @else

                                        @if($value->booking_status == 3)
                                        <ul class="d-flex flex-wrap">
                                            <li class="list-group-item list-group-item-info">Start Time:
                                                <br/> {{@$value->service_start_time}}
                                              </li>
                                            <li class="list-group-item list-group-item-info">Current Time:<br/> <span id="cur_time"></span></li>
                                            <li class="list-group-item list-group-item-info">Service Time:<br/>07:00 Hours</li>
                                        </ul>
                                        @endif
                                    @endif
                                    @if($value->booking_status == 3)
                                        @if(!$prescription)
                                            @if($value->booking_type!='serial')
                                            <a class="btn btn-primary" href="{{url('assistant/upload-prescription/'.$value->booking_id)}}">Upload Prescription</a>
                                            @endif

                                            @if($value->service_close_request)
                                                <button  data-id="{{ $value->booking_id }}"  class="btn bg-info btn-fill float-right">Complete Service</button>
                                            @else
                                                <a href="javascript:void(0)"  href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="completeService('{{ $value->booking_id }}')" class="btn bg-info btn-fill float-right">Complete Service</a>
                                            @endif
                                        @else
                                        <!-- /About Details -->
                                            @if($value->service_close_request)
                                                <button  data-id="{{ $value->booking_id }}"  class="btn bg-info btn-fill float-right">Complete Service</button>
                                            @else
                                                <a href="javascript:void(0)"  href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="completeService('{{ $value->booking_id }}')" class="btn bg-info btn-fill float-right">Complete Service</a>
                                            @endif
                                        @endif
                                    @endif
                                    </form>
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

                                                    <span class="comment-author">{{ $customer_meta['patient_name'] }}</span>

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

                            