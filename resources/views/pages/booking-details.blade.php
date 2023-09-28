@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Booking Details')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">
@endsection
@section('content')

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
                                    @if($value->fwrd_status == 1 && empty($value->assistant_boy_id))
                                    <a title="Assign" href="javascript:void(0)" onclick="findServiceArea({{ $value->id }})" class="btn btn-sm btn-info"> Assign</a>
                                    @endif
                                    <a title="Cancel" href="javascript:void(0);" @if($value->booking_status == 1 && $value->fwrd_status == 1 && empty($value->assistant_boy_id)) onclick="cancelBooking({{ $value->id }})" @endif class="btn btn-sm btn-light-danger @if($value->booking_status == 4 || !empty($value->assistant_boy_id)) disabled @endif">Cancel</a>
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
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Assign assistant Modal -->
<div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">ASSIGN TO ASSISTANT</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body scrollable-container">
                <form novalidate id="assign-assistant-form">
                    <input type="hidden" name="booking_id" id="booking_id" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Select Service Area:</label>
                        <select class="form-control" name="service_area" id="service_area" onchange="selectServiceArea(this.value)"></select>
                    </div>
                    <div id="assistant_data"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="assign-assistant" disabled="" class="btn btn-primary btn-sm">Assign</button>
          </div>
        </div>
    </div>
</div>
<!--End Assign assistant Modal -->
<!--Assign assistant Modal -->
<div class="modal fade text-left modal-borderless" id="cancel-modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">BOOKING CANCEL</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body scrollable-container">
                <form novalidate id="cancel-booking-form">
                    <input type="hidden" name="booking_id" id="cancel_booking_id" />
                    <input type="hidden" name="from_canceled" id="from_canceled" value="1" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Cancel Reasons:</label>
                        <textarea type="text" placeholder="Cancel Reasons" class="form-control" name="cancel_reason" id="cancel_reason" required=""></textarea>
                        <div class="invalid-feedback">Please write the reasons</div>
                    </div>
                    <button type="submit" id="btn-confirm" class="btn btn-primary btn-sm">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Assign assistant Modal -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/extensions/toastr.js')}}"></script>
<script src="{{asset('custom/assistant-booking.js')}}"></script>
@endsection