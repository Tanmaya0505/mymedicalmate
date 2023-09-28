@php

  $url = url()->current();

  $slug = Helper::getSlugUrl($url);

@endphp

<!DOCTYPE html>

<html>

<head lang="{{ app()->getLocale() }}">

    <meta charset="UTF-8">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('frontend-source/myaccount/assets/img/apple-icon.png') }}">

    <link rel="icon" type="image/png" href="{{ asset('frontend-source/myaccount/assets/img/favicon.ico') }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') || Medihelp</title>

    @yield('meta')

    <meta name="keywords" content="@yield('keywords')">

    <meta name="description" content="@yield('description')">

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

    <link href="{{ asset('frontend-source/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->

    <link href="{{ asset('frontend-source/fonts/font-awesome-web/css/all.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('frontend-source/myaccount/assets/css/light-bootstrap-dashboard.css') }}" rel="stylesheet" />

    <link href="{{ asset('frontend-source/myaccount/assets/css/demo.css') }}" rel="stylesheet" />

    <link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" rel="stylesheet">

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!--Toaster Message-->

    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">

    <!--End Toaster Message-->
    <style type="text/css">
        
        .loadingDiv {
            position:absolute;;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background-color:#dee1e5;
            opacity:0.6;
        }
        .center {
          /*border: 5px solid;*/
          margin: auto;
          width: 50%;
          /*padding: 10px;*/
          vertical-align:center;
          background-color:#000;
          background-image: url("/images/paper.gif");
          opacity:1;
          
        }
    </style>

    @yield('style')

</head>

<body>

    @php
    //dd(profileStatus());
    @endphp

    @if(profileStatus() && (Session::get('accountId') == Config::get('constants.accountType.assistant') || Session::get('accountId') == Config::get('constants.accountType.doctor')))

    <div class="alert profile-setup"> 

        Please complete your profile so that you can see your profile details on the website. 

        <a href="{{ url(accountPrefix().'/my-profile') }}" class="btn btn-primary" title="Setup Profile" type="button">Setup Profile <i class="nc-icon nc-notification-70"></i></a>

    </div>

    @endif

    <div class="wrapper">

        @include('frontend-source.customer-dashboard.includes.sidebar')

        <div class="main-panel">

            @include('frontend-source.customer-dashboard.includes.navbar')

                    @yield('content')

            @include('frontend-source.customer-dashboard.includes.footer')

        </div>

    </div>

<script src="{{ asset('frontend-source/myaccount/assets/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('frontend-source/myaccount/assets/js/core/popper.min.js') }}" type="text/javascript"></script>



<!--<script src="{{ asset('frontend-source/js/jquery-2.2.0.min.js') }}" type="text/javascript"></script>-->

<script src="{{ asset('frontend-source/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('frontend-source/myaccount/assets/js/plugins/bootstrap-switch.js') }}" type="text/javascript" ></script>

<script src="{{ asset('frontend-source/myaccount/assets/js/plugins/chartist.min.js') }}" type="text/javascript" ></script>

<script src="{{ asset('frontend-source/myaccount/assets/js/plugins/bootstrap-notify.js') }}" type="text/javascript" ></script>

<script src="{{ asset('frontend-source/myaccount/assets/js/light-bootstrap-dashboard.js') }}" type="text/javascript"></script>

<script src="{{ asset('frontend-source/myaccount/assets/js/demo.js') }}"></script>

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

<!--Toaster Message-->

<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>

<script src="{{asset('vendors/js/ui/blockUI.min.js')}}"></script>

<script src="{{asset('js/scripts/extensions/toastr.js')}}"></script>

@include('frontend-source.customer-dashboard.includes.msg')

<!--End Toaster Message-->

@stack('script')

<script type="text/javascript">

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
@if(Session::get('accountStatus')==2)
    var loadingdiv='<div style="" class="loadingDiv"><div class=" center alert alert-warning" >\
          <div class="card-body alert alert-warning" style="background-color:#000;">\
            <h5 class="card-title">Your Account has been Blocked By Admin.</h5>\
            <p class="card-text">If you want to recover your account. Please Contact with Admin. </p>\
            <p class="card-text">Email:support@mymedicalmate.com </p>\
            <p class="card-text">Visiting Hour:9am-9pm(IST) </p>';
            @if(Session::get('accountduepay')==1)
            loadingdiv +='<p><a href="{{url('/paymentdueadmin')}}" class="btn btn-primary">Pay Now</a></p>';
            @endif

            loadingdiv +='<a href="#" class="btn btn-primary">Schedule Request</a>\
            <a class="btn btn-primary float-right" href="/logout"> Log out</a>\
          </div>\
        </div></div>'
        $('body').append(loadingdiv);
    $('.sidebar-wrapper').append('<div style="" class="loadingDiv"></div>');
@endif
</script>

</body>

</html>