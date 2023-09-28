@extends('frontend-source.layouts.master')
@section('title') Medical Mate Details @stop
@section('keywords') Medical Mate Details @stop
@section('description') Medical Mate Details @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/css/custom.css')}}">
<style type="text/css">
.input-group-addon {
    position: absolute;
    right: 16px;
    bottom: 12px;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="profile-nav col-lg-5 col-xl-4">
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
                            <p>Ride: @if(isset($data['is_bike']) && $data['is_bike']) {{ $data['km_range'] }} @else {{ '00-00 KM' }} @endif</p>
                        </div>
                    </div>

                    <div class="user-details">
                        <b><i class="fal fa-user"></i>Name:</b> {{ userfirstname(ucwords($assistant->first_name)).' '.ucwords($assistant->last_name) }}<br>
                        <b><i class="fal fa-map-marker-alt"></i>From:</b> {{ $data['present_address'] }}, {{ $data['dist'] }}, {{ $data['state'] }}<br>
                    </div>
                </div>
                <div class="text-center mt20">
                    @if(Session::get('userId') && Session::get('accountId') != Config::get('constants.accountType.assistant') && Session::get('accountId') != Config::get('constants.accountType.vendor'))
                        <!-- <a class="btn btn-primary" href="{{ url('/book-medical-mate/fullbook/'.$assistant->id) }}">Book Now</a> -->
                        <a class="primary-btn" href="javascript:void(0)" onClick="OpenBooking({{$assistant->id}})">Book Now</a>
                    @elseif(Session::get('userId') && Session::get('accountId') == Config::get('constants.accountType.assistant') || Session::get('accountId') == Config::get('constants.accountType.vendor'))
                        <a class="btn btn-primary" style="cursor: not-allowed;background: #eee;color: #797979;" href="javascript:void(0)">Book Now</a>
                    @else
                        <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#staticBackdrop">Book Now</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xl-8">
            <div class="profile-info">
                <h4 class="mb20">Profile Details</h4>
                <ul class="list-group detail-profile-list">
                    <li class="list-group-item"><i class="fal fa-medkit"></i><span>Charges: <strong>Rs {{ $data['day_charges'] }} Day | {{ $data['night_charges'] }} Night</strong></span></li>
                    <li class="list-group-item"><i class="fal fa-map-marker-alt"></i><span>Service Area: <strong>{{ $data['present_address'] }}, {{ $data['dist'] }}, {{ $data['state'] }} ({{ $data['pincode'] }})</strong></span></li>
                    <li class="list-group-item"><i class="fal fa-calendar-alt"></i><span>Available: <strong> {{ str_replace(',', ' | ', $data['available']) }}</strong></span></li>
                    <li class="list-group-item"><i class="fal fa-clock"></i><span>Time: <strong>{{ $data['from_time'] }} - {{ $data['to_time'] }}</strong></span></li>
                    <li class="list-group-item"><i class="fal fa-map-marked-alt"></i><span>Service Area: <strong>{{ $data['service_area'] }}</strong></span></li>
                    <li class="list-group-item"><i class="fal fa-graduation-cap"></i><span>Qualification: <strong>{{ $data['highest_qualification'] }}</strong></span></li>
                    <!--<li class="list-group-item"><i class="fal fa-ballot-check"></i><span>Completed Services: <strong>0</strong></span></li>-->
                    <!--<li class="list-group-item"><i class="fal fa-star"></i><span>Rating: <strong>4 Star</strong></span></li>-->
                </ul>
                <!-- <div class="description-block">
                    <div class="mb10"><strong>Description:</strong></div>
                    <p></p>
                </div> -->
            </div>
            <div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@include('frontend-source.includes.login-popup')
@endsection
@push('script')
<script src="{{ asset('frontend-source/bootstrap/js/bootstrap-notify.min.js') }}" type="text/javascript" ></script>
@if(Session::has('error') || $errors->has('email') || $errors->has('password'))
<script>
    $("#staticBackdrop").modal('show');
</script>
@endif
@if(Session::has('success'))
<script>
    $.notify({
        title: '<strong>Success !</strong>',
        message: " {{ Session::get('success') }}"
    },{
        type: "success"
    });
</script>
@endif
<script src="{{ asset('frontend-source/js/booking-validate.js') }}?v={{time()}}" type="text/javascript"></script>
<script type="text/javascript">
    function OpenBooking(booking_id){
    $('#directBookingwithmedmate #serialbook').attr('href','/book-medical-mate/serial/'+booking_id);
    $('#directBookingwithmedmate #fullbook').attr('href','/book-medical-mate/fullbook/'+booking_id);

    $('#directBookingwithmedmate').modal('show');
}
</script>
@endpush
