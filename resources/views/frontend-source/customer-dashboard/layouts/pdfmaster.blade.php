@php

  $url = url()->current();

  $slug = Helper::getSlugUrl($url);

@endphp

<!DOCTYPE html>

<html>

<head lang="{{ app()->getLocale() }}">

   

    <link href="{{ asset('frontend-source/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

   


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

        

                    @yield('content')

           

        </div>

    </div>



</body>

</html>