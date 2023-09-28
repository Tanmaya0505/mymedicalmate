@extends('frontend-source.layouts.master')
@section('title') Login register @stop
@section('keywords') Login register @stop
@section('description') Login register @stop
@section('style')
@endsection
@section('content')
<div class="floting-image"><img src="{{ asset('frontend-source/images/stethoscope.png') }}" alt="" class="img-fluid"></div>
<section class="hero text-center">
   <div class="container-fluid">
      <div class="row clearfix">
         <div class="col-12 p0">
            <div class="hero-slide slider">
               <div class="box-item">
                  <img src="{{ asset('frontend-source/images/banner-login.jpg') }}" class="img-fluid">
               </div>
               <div class="box-item">
                  <img src="{{ asset('frontend-source/images/banner-login.jpg') }}" class="img-fluid">
               </div>
               <div class="box-item">
                  <img src="{{ asset('frontend-source/images/banner-login.jpg') }}" class="img-fluid">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="login-section">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="welcome">
               <h2>Welcome to My Medical Mate</h2>
               <p class="lead">Wish you healthy and better suffer with My Medical Mate.</p>
               <a href="{{ url('/login') }}"><i class="fal fa-user-circle"></i> Login</a>
               <a href="{{ url('/sign-up') }}" class="log"><i class="fal fa-user-plus"></i> Sign Up</a>
            </div>
            <div class="icon-img"><img src="{{ asset('frontend-source/images/login-bg.png') }}" class="img-fluid center" alt=""></div>
         </div>
         <div class="clearfix"></div>
      </div>
   </div>
</section>
@endsection
@push('script')
<script>

</script>
@endpush