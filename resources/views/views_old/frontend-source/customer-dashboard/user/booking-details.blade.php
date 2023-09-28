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
                        Payment Status: @if($value->payment_receive_status) Paid @else Unpaid Pay on Service @endif
                    </div>
                    <div class="content-patient bg-info">
                        Booking Status: {{ (new \App\Helpers\CustomerHelper)->bookingStatus($value->booking_status) }}
                    </div>
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
                <div class="row action-btn-part">
                        <div class="col-4"><a href="{{ url($account_prefix.'/bookings') }}" class="btn bg-primary btn-fill">Go Back</a></div>
                        <div class="col-4 text-center"></div>
                        <div class="col-4 text-right"><a href="#" class="btn bg-danger btn-fill">Cancel</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')

@endpush