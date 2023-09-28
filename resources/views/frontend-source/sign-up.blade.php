@extends('frontend-source.layouts.master')
@section('title') Sign up @stop
@section('keywords') Sign up @stop
@section('description') Sign up @stop
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
      <img src="{{ asset('frontend-source/images/signup-image.jpg') }}" class="img-fluid fill-img" />
   </div>
   <div class="col-lg-6 signup-content">
   <h3 class="mb20">Sign-Up/Registration</h3>
   <div class="form-style">
       @include('frontend-source.includes.msg')
      <form method="POST" action="{{ url('sign-up') }}" novalidate>
          @csrf
         <div class="row mt-4">
            <div class="col">
               <div class="form-control">
                  <input required type="text" name="first_name" value="{{ old('first_name') }}" />
                  <label>First Name </label>
                    @if ($errors->has('first_name'))
                        <span class="help-block">
                          <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
               </div>
            </div>
            <div class="col">
               <div class="form-control">
                  <input required type="text" name="last_name" value="{{ old('last_name') }}" />
                  <label>Last Name </label>
                    @if ($errors->has('last_name'))
                        <span class="help-block">
                          <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
               </div>
            </div>
         </div>
         <div class="row mt-4">
            <div class="col">
               <div class="form-control">
                  <input required type="text" class="numeric"   maxlength="10" name="phone" value="{{ old('phone') }}" />
                  <label>Mobile Number </label>
                    @if ($errors->has('phone'))
                        <span class="help-block">
                          <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
               </div>
            </div>
         </div>
         <div class="row mt-4">
            <div class="col">
               <div class="form-control">
                  <input required type="text" name="email" value="{{ old('email') }}" />
                  <label>Email Address </label>
                    @if ($errors->has('email'))
                        <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
               </div>
            </div>
         </div>
         <div class="row mt-4">
            <div class="col">
               <div class="form-control" id="show_password">
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
            </div>
         </div>
         <div class="row mt-4">
            <div class="col">
               <div class="form-control" id="show_con_password">
                    <input required type="password" name="confirm_password" />
                    <label>Confirm Password </label>
                    <div class="input-group-addon">
                        <a href="javascript:void(0)"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                    </div>
                    @if ($errors->has('confirm_password'))
                        <span class="help-block">
                          <strong>{{ $errors->first('confirm_password') }}</strong>
                        </span>
                    @endif
               </div>
            </div>
         </div>
         <div class="row mt-4">
            <div class="col">
               <div class="form-control" id="referal_code">
                    <input  type="text" name="referal_code" />
                    <label>Referal Code </label>
                    
                    @if ($errors->has('referal_code'))
                        <span class="help-block">
                          <strong>{{ $errors->first('referal_code') }}</strong>
                        </span>
                    @endif
               </div>
            </div>
         </div>
         <div class="row mt-4 pb-2">
            <div class="col">
                <button type="submit" class="btn btn-primary w-100 mt-2">SignUp Now</button>
            </div>
         </div>
      </form>
      <div class="sideline">OR</div>
      <div class="pt-4 text-center">
         Already have an account <a href="{{ url('/login') }}">Login</a> here.
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
    $("#show_con_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_con_password input').attr("type") == "text"){
            $('#show_con_password input').attr('type', 'password');
            $('#show_con_password i').addClass( "fa-eye-slash" );
            $('#show_con_password i').removeClass( "fa-eye" );
        }else if($('#show_con_password input').attr("type") == "password"){
            $('#show_con_password input').attr('type', 'text');
            $('#show_con_password i').removeClass( "fa-eye-slash" );
            $('#show_con_password i').addClass( "fa-eye" );
        }
    });
});
         
$('.numeric').keypress(function(e) {
      var a = [];
      var k = e.which;

      for (i = 48; i < 58; i++)
         a.push(i);

      if (!(a.indexOf(k)>=0))
         e.preventDefault();
});
        
</script>
@endpush