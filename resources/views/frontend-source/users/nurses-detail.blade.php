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
    <?php 
        $photo =  asset('frontend-source/images/assistant-boy-icon.png');
        if($data->profile_picture){
            $photo = url($data->profile_picture);
        }
    ?>
    <div class="row">
        <div class="profile-nav col-lg-5 col-xl-4">
            <div class="panel">
                <div class="user-heading round">
                    <div class="d-flex bd-highlight align-items-center">
                        <div class="info-icon">
                            <p class="">                              {{$data->total_experience}} Years exp</p>
                        </div>
                        <div class="profile-image">
                            <a href="#">
                                <img src="{{ $photo }}" class="img-fluid" alt="">
                            </a>
                           <!--  <p class="p-age">Exp: {{ $data->total_experience }} Years </p> -->
                        </div>
                        <div class="info-icon">
                            <p>Ratings: {{ $data->star_ratings }} </p>
                        </div>
                    </div>

                    <div class="user-details">
                        <b><!-- <i class="fal fa-user"></i> -->Full Name:</b> {{ ucwords($data->full_name) }}<br>
                        <b><!-- <i class="fal fa-map-marker-alt"></i> -->Designation:</b> {{ $data->designation }}<br>
                       
                        <b><!-- <i class="fal fa-map-marker-alt"></i> -->Location:</b> {{ $data->location }}<br>
                    </div>
                </div>
                <div class="text-center mt20">
                   
                       <!--  <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#staticBackdrop">Book Now</a> -->
                    
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xl-8">
            <div class="profile-info">
                <h4 class="mb20">Nurses Details</h4>
                <ul class="list-group detail-profile-list">
                    <li class="list-group-item">
                        <i class="fal fa-eye"></i>
                        <span><strong>{{ $data->mobile}}</strong></span>
                    </li>
                
                    <li class="list-group-item">
                        <i class="fal fa-eye"></i>
                        <span><strong>{{ $data->email}}</strong></span>
                    </li>
                
                    <li class="list-group-item">
                        <span><strong>{{ $data->website_url}}</strong></span>
                    </li>
                
                    <li class="list-group-item">
                        <span><strong>{{ $data->social_media_link}}</strong></span>
                    </li>
                
                    <li class="list-group-item">
                        <span><strong>{{ $data->description}}</strong></span>
                    </li>
                
                    <li class="list-group-item">
                        <i class="fal fa-eye"></i>
                        <span><strong>Achievement & Award</strong></span>
                    </li>
                </ul>
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
@endpush
