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
<!--                     <div class="d-flex bd-highlight align-items-center">
                        <div class="info-icon">
                            <p class="">                              {{$data->total_experience}} Years exp</p>
                        </div>
                        <div class="profile-image">
                            <a href="#">
                                <img src="{{ $photo }}" class="img-fluid" alt="">
                            </a>
                           
                        </div>
                        <div class="info-icon">
                            <p>Ratings: {{ $data->star_ratings }} </p>
                        </div>
                    </div> -->

                    <div class="user-details">
                        <b><!-- <i class="fal fa-user"></i> -->Name of Disease:</b> {{ ucwords($data->full_name) }}<br>
                        <b><!-- <i class="fal fa-map-marker-alt"></i> -->Refer by:</b> {{ $data->references_hos_doc }}<br>
                        <b><!-- <i class="fal fa-map-marker-alt"></i> -->Doctor profile link:</b> {{ $data->doc_profile }}<br>
                        
                    </div>
                </div>
                <div class="text-center mt20">
                   
                       <!--  <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#staticBackdrop">Book Now</a> -->
                    
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xl-8">
            <div class="profile-info">
                <h4 class="mb20">Disease Contain Post Details</h4>
                
                    @forelse($data->diseasedetails as $post)
                    <div class="row  mb-2">
                        <div class="col-7 mr-1 border border-primary">
                          <p>{{$post->disease_desc}}</p>
                        </div>
                        
                        <div class="col-4 ml-1 border border-primary">
                            @if($post->disease_img)
                            <img src="{{url($post->disease_img)}}" height="100px" width="100px">
                            @endif
                        </div>
                    </div>
                    
                    @empty
                    @endforelse
                
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
