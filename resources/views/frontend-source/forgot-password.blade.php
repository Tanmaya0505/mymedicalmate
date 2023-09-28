@extends('frontend-source.layouts.master')
@section('title') Login @stop
@section('keywords') Login @stop
@section('description') Login @stop
@section('style')
<style type="text/css">
.input-group-addon {
    position: absolute;
    right: 25px;
    top: 16px;
}
</style>
@endsection
@section('content')
<section class="loginform">
   <div class="container">
   <div class="row m-2 shadow-box">
   <div class="col-lg-6 d-none d-lg-block">
      <img src="{{ asset('frontend-source/images/login-image.jpg') }}" class="img-fluid fill-img" />
   </div>
   <div class="col-lg-6 log-content">
   <h3 class="mb20">Forgot Your Password?</h3>
   <p>Please enter the email you use to sign in to My Medical Mate.</p>
   <div class="form-style">
      <form>
         <div class="form-control mb20">
            <input required type="text" />
            <label>Your email address </label>
         </div>
         <div class="pb-2">
            <button type="submit" class="btn btn-primary w-100 mt-2">Request Password Reset</button>
         </div>
      </form>
      <div class="sideline">OR</div>
      <div class="pt-4 text-center">
         Back to <a href="{{ url('/login') }}">login</a> or <a href="{{ url('/sign-up') }}">Sign Up</a> Now.
      </div>
   </div>
</section>
@endsection
@push('script')

@endpush
