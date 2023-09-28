@extends('frontend-source.layouts.master')
@section('title') Login @stop
@section('keywords') Login @stop
@section('description') Login @stop
@section('style')
<style type="text/css">
.input-group-addon {
    position: absolute;
    right: 16px;
    top: 10px;
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
   <h3 class="mb20">Login</h3>
   <div class="form-style">
      @include('frontend-source.includes.msg')
      <form method="POST" action="{{ url('login') }}">
         @csrf
         <div class="form-control mb20">
            <input required type="email" name="email" value="{{ old('email') }}" />
            <label>Email </label>
            @if ($errors->has('email'))
            <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
         </div>
         <div class="form-control mb20" id="show_password">
            <input required type="password" name="password" />
            <label>Password </label>
            <div class="input-group-addon">
                <a href="javascript:void(0)"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
            </div>
            @if ($errors->has('password'))
            <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
         </div>
         <div class="mb20"><a href="{{ url('/forgot-password') }}">Forget Password?</a></div>
         <div class="pb-2">
            <button type="submit" class="btn btn-primary w-100 mt-2">Login Now</button>
         </div>
      </form>
      <div class="sideline">OR</div>
      <div class="pt-4 text-center">
         I don't have account <a href="{{ url('/sign-up') }}">Sign Up</a> Now.
      </div>
   </div>
</section>
@endsection
@push('script')
<script>
$(document).ready(function() {
    $("#show_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_password input').attr("type") == "text"){
            $('#show_password input').attr('type', 'password');
            $('#show_password i').addClass( "fa-eye-slash" );
            $('#show_password i').removeClass( "fa-eye" );
        }else if($('#show_password input').attr("type") == "password"){
            $('#show_password input').attr('type', 'text');
            $('#show_password i').removeClass( "fa-eye-slash" );
            $('#show_password i').addClass( "fa-eye" );
        }
    });
});
</script>
@endpush
