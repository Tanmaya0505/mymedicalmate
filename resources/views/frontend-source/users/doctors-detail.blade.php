@extends('frontend-source.layouts.master')
@section('title') Medical Mate Details @stop
@section('keywords') Medical Mate Details @stop
@section('description') Medical Mate Details @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/css/custom.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/css/style.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
    .row {
        display: block;
    }

    .p-control-card {
        height: 50px;
    }

    .carousel-indicators {
        bottom: -100px !important;
    }

    @media screen and (min-width: 768px) and (max-width: 960px) {
        .wwd-100 {
            width: 100%;
        }

        .p-textx {
            padding-top: 9px;
        }

        #hero {
            width: 100%;
            background-color: rgb(255 255 255 / 80%);
            overflow: hidden;
            position: relative;
            margin-top: 60px !important;
        }
    }

    @media screen and (min-width: 734px) and (max-width: 1524px) {
        .pro-pro {

            margin-left: 132px !important;
            margin-top: -64px;
        }

        .rating {
            margin-left: 243px;
            margin-top: -111px;
        }
    }

    @media screen and (min-width: 360px) and (max-width: 428px) {
        .pro-text {
            margin-left: 5px !important;
            width: 90px !important;
        }

        .pro-pro {

            margin-left: 132px !important;
            margin-top: -64px;
        }

        /* .rating{
            margin-left: 243px;
            margin-top: -79px;
        }
        .view{
            margin-left: 220px;
            margin-top: -48px;
        } */
    }

    .p-text {
        padding-top: 5px;
    }

    .location-text {
        padding-bottom: 10px;
    }

    .mglft-10 {
        padding-left: 7px;
    }

    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        margin-top: 13px;
    }

    .btn-uppload {
        border: 2px solid gray;
        color: gray;
        background-color: white;
        padding: 8px 13px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: bold;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }

    .text-block {
        position: absolute;
        top: 218%;
        left: 50%;
        transform: translate(-50%, -50%);
        bottom: 45px;
        background-color: #efe5e500;
        color: #fff;
        padding-left: 70px;
        padding-right: 70px;
        padding-top: 25px;
        padding-bottom: 70px;
        font-size: 22px;
        font-weight: 600;
        border-radius: 5px;
        text-align: center;
    }

    .btn-closa {
        margin-top: -6px !important;
        padding-left: 0px !important;
        padding-right: 30px !important;
        background-color: #d43f3a00 !important;
        opacity: 10;
        padding-bottom: 10px;
    }


    .verification-code {
        max-width: 100%;
        position: relative;
        margin: -14px auto;
        text-align: center;
    }

    .control-label {
        display: block;
        margin: 40px auto;
        font-weight: 900;
    }

    .verification-code--inputs input[type=text] {
        border: 2px solid #e1e1e100;
        width: 50px;
        height: 50px;
        padding: 10px;
        text-align: center;
        display: inline-block;
        box-sizing: border-box;
        background-color: #2e75b5;
        border-radius: 6px;
        margin-right: 9px;
        color: #fff;
        font-size: 25px;
        font-weight: 700;
    }

    #hero {
        width: 100%;
        background-color: rgb(255 255 255 / 80%);
        overflow: hidden;
        position: relative;

    }

    .pro-pro {
        width: 120px;
        height: 120px;
        border: 7px solid #fff !important;
        border-radius: 50% !important;
        /* justify-content: center; */
        align-items: center;
        margin-left: 32px;
        background-color: transparent !important;
        background-image: url(../image/circle.png);
        background-size: cover;
        padding: 0px !important;
    }

    @media screen and (min-width:360px) and (max-width:768px) {
        .pro-pro {
            width: 120px;
            height: 120px;
            border: 5px solid #fff !important;
            border-radius: 50% !important;
            /* justify-content: center; */
            align-items: center;
            margin-left: 32px;
            background-color: transparent !important;
            background-image: url(../image/circle.png);
            background-size: cover;
            padding: 0px !important;
        }

        .pro-d-flex {
            display: flex;
        }
    }

    .star {
        visibility: hidden;
        font-size: 30px;
        cursor: pointer;
        color: #dfbf82;
    }

    .star:before {
        content: "\2605";
        position: absolute;
        visibility: visible;
    }

    .star:checked:before {
        content: "\2606";
        position: absolute;
    }

    .star:checked {
        color: #ff9b00;
    }
</style>
<style type="text/css">
    .input-group-addon {
        position: absolute;
        right: 16px;
        bottom: 12px;
    }
</style>
@endsection
@section('content')
<div class="">
    <?php
    $photo =  asset('frontend-source/images/assistant-boy-icon.png');
    if ($data->profile_picture) {
        $photo = url($data->profile_picture);
    }
    ?>
    <div class="main">
        <!-- <div class="profile-nav col-lg-5 col-xl-4">
            <div class="panel">
                <div class="user-heading round">
                    <div class="d-flex bd-highlight align-items-center">
                        <div class="info-icon">
                            <p class=""> {{$data->total_experience}} </p>
                        </div>
                        <div class="profile-image">
                            <a href="#">
                                <img src="{{ $photo }}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="info-icon">
                            <p>Ratings: {{ $data->star_ratings }} </p>
                        </div>
                    </div>

                    <div class="user-details">
                        <b>Full Name:</b> {{ ucwords($data->full_name) }}<br>
                        <b>Designation:</b> {{ $data->designation }}<br>
                        <b>Department:</b> {{ $data->department }}<br>
                        <b>Location:</b> {{ $data->location }}<br>
                    </div>
                </div>
                <div class="text-center mt20">
  

                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xl-8">
            <div class="profile-info">
                <h4 class="mb20">Doctor Details</h4>
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
                        <a target="_blank" href="{{url('achievement/doctor/'.urlencode($data->full_name))}}"><span><strong>Achievement & Award</strong></span></a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="clearfix"></div>
            </div>
        </div> -->
        <!-- ======= Hero Section ======= -->
        <section id="hero" style="height: 350px;">
            <div class="container-fluid cont-fld">
                <div class="col-md-12">
                    <div class="row">

                        <div class="col-sm-6 col-xs-12  wow slideInLeft">
                            <div class="card card-body pro-card pro-card1" id="grad1">
                                <div class="row">
                                    <div class="col-md-12 pro-d-flex">
                                        <div class="row">
                                            <div class="col-md-4  col-4">
                                                <p class="pro-text pro-text1">{{ $data->total_experience}} Years Exp</p>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <div class="card card-body pro-pro pro-pro1">
                                                    <img src="{{ url('/doctor/doctor1.png') }}" alt="" class="pro-doc">
                                                </div>
                                            </div>
                                            <div class="col-md-4  col-4 ">
                                                <p class="pro-text ">Rating: {{floatval($rating)}} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <p class="pro-contenn">
                                            <img src="{{ url('/doctor/name.png') }}" alt="" class="pro-image">
                                            <span class="profile-name mrglft-10"> Full Name :</span><span class="mglft-10"> {{ $data->full_name}}
                                            </span> <img src="{{ url('/doctor/verify.png') }}" alt="" class="pro-veri">
                                        </p>
                                        <p class="pro-conten">
                                            <img src="{{ url('/doctor/gender.png') }}" alt="" class="pro-image">
                                            <span class="profile-name mrglft-10"> Gender : </span><span class="mglft-10"> {{ $data->gender}}</span> <img src="../assets/image/back.png" alt="" class="back-hidden">
                                        </p>
                                        <p class="pro-conten ln-cn" style="line-height: 20px !important;">
                                            <img src="{{ url('/doctor/desig.png') }}" alt="" class="pro-image">
                                            <span class="profile-name mrglft-10"> Designation :</span><span class="mglft-10"> {{ $data->designation}}
                                                {{ $data->orgnization_name}}</span>
                                        </p>
                                        <p class="pro-conten">
                                            <img src="{{ url('/doctor/depart.png') }}" alt="" class="pro-image">
                                            <span class="profile-name mrglft-10">Departments :</span><span class="mglft-10"> {{ $data->department}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mob-non wow slideInRight" style="background-image: linear-gradient(to right, #1e4364 , #1b5e9c);height: 135px; border-radius: 5px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <!-- <img src="../assets/image/doctor-background.jpg" alt="" class="header-doct"> -->
                                    <div class="text-block">
                                        <div id="timer">00 00 00 00</div>
                                        <div class="timer-label">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Day&nbsp;&nbsp;&nbsp;&nbsp;Hr&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Min&nbsp;&nbsp;&nbsp;Sec
                                        </div>
                                        <div class="upload-btn-wrapper">
                                            <button class="btn-uppload">Upload Prescription</button>
                                            <input type="file" name="myfile" />
                                        </div>

                                    </div>

                                    </p>

                                </div>
                            </div>
                            <div class="row mob-non">
                                <div class="container">
                                    <div id="demo" class="carousel slide" data-bs-ride="carousel">
                                        <!-- The slideshow/carousel -->
                                        <div class="carousel-inner ">
                                            <div class="carousel-item carousel-items active">
                                                <img src="{{ url('/doctor/diabetes-2.png') }}" alt="Slide 1" class="d-block w-100 caro-1">
                                            </div>
                                            <div class="carousel-item carousel-items">
                                                <img src="{{ url('/doctor/diabetes-3.png') }}" alt="Slide 2" class="d-block w-100 caro-1">
                                            </div>
                                            <div class="carousel-item carousel-items">
                                                <img src="{{ url('/doctor/diabetes-2.png') }}" alt="Slide 3" class="d-block w-100 caro-1">
                                            </div>
                                        </div>

                                        <!-- Left and right controls/icons -->
                                        <a class="carousel-control-prev" href="#demo" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                        </a>
                                        <a class="carousel-control-next" href="#demo" data-bs-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>
        <!-- End Hero -->
        <!--Start Time section-->
        <section id="time">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <div class="card card-body card-locc col-12 ">

                            <!--desktop view start-->
                            <div class="col-md-12 desk-blck">
                                <div class="row">
                                    <div class="col-md-6 wow slideInRight">
                                        <p class="location-text ">
                                            <img src="{{ url('/doctor/location.png') }}" alt="" class="pro-ctime"> Consult Location
                                        </p>
                                        <p class="form-control control-data">{{ $data->location}}, {{ $data->landmark_pincode}}</p>
                                        <p class="location-text">
                                            <img src="{{ url('/doctor/calender.png') }}" alt="" class="pro-ctime"> Consult Days
                                        </p>
                                        <p class="form-control control-data">{{ $data->avl_days}}</p>
                                    </div>
                                    <div class="col-md-6 wow slideInLeft">
                                        <p class="location-text">
                                            <img src="{{ url('/doctor/ctime.png') }}" alt="" class="pro-ctime"> Consult Time
                                        </p>
                                        <p class="form-control control-data">{{ $data->from_time}} - {{ $data->to_time}}</p>
                                        <p class="location-text">
                                            <img src="{{ url('/doctor/rupee.png') }}" alt="" class="pro-ctime"> Consult Fee
                                        </p>
                                        <p class="form-control control-data">
                                            <i class="fa fa-rupee"></i> {{ $data->consul_fee_from}} - <i class="fa fa-rupee"></i> {{ $data->consul_fee_to}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--desktop view end-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End time section-->
        <!--Section award start-->
        <section id="award">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <div class="card card-body pro-qual pro-background col-12 ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            <img src="{{ url('/doctor/a-trophy.gif') }}" alt="" class="pro-trophy">
                                        </center>
                                    </div>
                                    <div class="col-md-6 col-12 wow slideInLeft">

                                        <div class="form-control loc-card-achieve">
                                            <p class="loc-text" onclick="toggleSection()" style="color: #154e83 !important;font-weight: 600">
                                                <img src="{{ url('/doctor/qualif.png') }}" alt="" class="award-image">
                                                Qualification
                                            </p>
                                        </div>
                                        <div class="toggle-wrap">
                                            <i id="toggleIcon" class="fa fa-angle-down fa-angle fa-anglee" onclick="toggleSection()"></i>
                                            <div id="content" class="content hidden">
                                                <div id="newQual" class="hidden col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-control card-blue">
                                                                <div class="row">
                                                                    <div class="col-md-11 col-9">
                                                                        <p class="text-award">{{ $data->doctorqualification}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 wow slideInRight">
                                        <div class="form-control loc-card-achieve">
                                            <p class="loc-text" onclick="toggleAwardSection()" style="color: #154e83 !important;font-weight: 600">
                                                <img src="{{ url('/doctor/acaw.png') }}" alt="" class="award-image"> Achievements & Awards
                                            </p>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <i class="fa fa-angle-down fa-angle fa-anglee" onclick="toggleAwardSection()" id="awardToggleIcon"></i>
                                            </div>
                                        </div>
                                        <div id="newAward" class="hidden col-md-12">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="form-control card-blue">
                                                        <div class="row">
                                                            <div class="col-md-11 col-9">
                                                                <p class="text-award">{{ $data->achievement_award}}</p>
                                                            </div>
                                                            <div class="col-md-1 col-3">
                                                                <div class="image-container">
                                                                    <a href="{{ url('/doctor/pro-doc.jpg') }}" class="zoom-image">
                                                                        <img src="{{ url('/'.$data->profile_picture) }}" alt="" class="doc-award" width="172" height="115">
                                                                    </a>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            <button type="button" class="btn btn-primary btn-prm" data-toggle="modal" data-target="#myModal">GET IN
                                                TOUCH <img src="{{ url('/doctor/hand1.png') }}" alt="" class="icon-hand">
                                            </button>
                                        </center>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Section award end-->
        <!--Section Social media start-->
        <section id="social-media">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <div class="card card-body  card-web">
                            <div class="card card-body loc-cardd loc-socialmedia">

                                <div class="col-md-12 ">
                                    <div class="row">
                                        <div class="col-md-6 wow slideInRight">
                                            <p class="location-text">
                                                <img src="{{ url('/doctor/web.png') }}" alt="Website" class="icon-social"> &nbsp;Website
                                            </p>
                                            <p class="form-control control-data"><a href="" class="social-link-a">{{ $data->website_url}}</a></p>
                                            <p class="location-text">
                                                <img src="{{ url('/doctor/face.png') }}" alt="Facebook" class="icon-social">&nbsp;Facebook
                                            </p>
                                            <p class="form-control control-data"><a href="" class="social-link-a">{{ $data->social_media_link}}</a></p>
                                            <p class="location-text">
                                                <img src="{{ url('/doctor/instagram.png') }}" alt="Instagram" class="icon-social">&nbsp;Instagram
                                            </p>
                                            <p class="form-control control-data"><a href="" class="social-link-a">{{ $data->instagram_url}}</a></p>
                                        </div>
                                        <div class="col-md-6 wow slideInLeft">

                                            <p class="location-text">
                                                <img src="{{ url('/doctor/linked.png') }}" alt="linkedIn" class="icon-social">&nbsp;LinkedIn
                                            </p>
                                            <p class="form-control control-data"><a href="" class="social-link-a">https://dr.rabin/m.linkedin.com</a>
                                            </p>
                                            <p class="location-text">
                                                <img src="{{ url('/doctor/youtube.png') }}" alt="Youtube" class="icon-social">&nbsp;Youtube
                                            </p>
                                            <p class="form-control control-data"><a href="" class="social-link-a">{{ $data->youth_profile_url}}</a>
                                            </p>
                                            <p class="location-text">
                                                <img src="{{ url('/doctor/twitter.png') }}" alt="Twitter" class="icon-social">&nbsp;Twitter
                                            </p>
                                            <p class="form-control control-data"><a href="" class="social-link-a">{{$data->twiter_profile_url}}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card card-body loc-cardd wow slideInLeft">
                                <p class="loc-des loc-text">{{$data->description}}...........
                                    <a class="button loc-read" onclick="openPopup1()">Read More</a>
                                </p>


                                <div class="popup-overlay" id="popup1">
                                    <div class="popup-content">
                                        <span class="popup-close" onclick="closePopup1()">&times;</span>
                                        <h5 class="h5">View Details</h5>

                                        <div class="content">
                                            <p class="comment-text">Description: Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                                                1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
                                                bookDescription: Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                                                printer took a galley of type and scrambled it to make a type specimen bookDescription: Lorem
                                                Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                                                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                                type and scrambled it to make a type specimen bookDescription: Lorem Ipsum is simply dummy text
                                                of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                                make a type specimen bookDescription: Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                                                1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
                                                book</p>

                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 md-md">
                                <div class="row">

                                    <div class="col-md-8 col-7 wow slideInLeft">
                                        <div class="form-control loc-cardd loc-card-form">
                                            <p class="loc-text" type="button" onclick="openPopup()">Comments</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a class="button" onclick="openPopup()"> <i class="fa fa-eye fa-eyee"></i></a>
                                            </div>
                                            <div class="popup-overlay" id="popup">
                                                <div class="popup-content">
                                                    <span class="popup-close" onclick="closePopup()">&times;</span>
                                                    <h5 class="h5">View Comments</h5>

                                                    <div class="content">
                                                        <p class="comment-date">Justin Beiber&nbsp;&nbsp;Date: 08-07-2023</p>
                                                        <p class="comment-text">{{$data->comments}}</p>
                                                        <hr>
                                                        <p class="comment-date">Justin Beiber&nbsp;&nbsp;Date: 08-07-2023</p>
                                                        <p class="comment-text">{{$data->comments}}</p>
                                                        <hr>
                                                    </div>
                                                    <button class="comment-add btn btn-primary pri-share" onclick="openComment()">Add
                                                        Comment</button>

                                                    <a href="#" class="comment-view btn btn-primary pri-view">View More</a>
                                                    <div class="col-md-12">
                                                        <form action="">
                                                            <div id="myComment" class="hidden-div">
                                                                <input type="date" name="" placeholder="" class="form-control">
                                                                <input type="text" name="" placeholder="Add Your Name" class="form-control">
                                                                <input type="textarea" name="" placeholder="Add Your Comment" class="form-control">
                                                                <center><button class="btn btn-primary pri-share" name="">Submit</button></center>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-5 wow slideInLeft">
                                        <div class="form-control loc-cardd loc-card-form view">
                                            <p class="loc-text">Views</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 offset-4 col-4">
                                        <center>
                                            <div class="card card-body card-pro">
                                                <img src="{{ URL::asset('/doctor/doctor1.png') }}" alt="" class="image-pro">
                                            </div>
                                        </center>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <center>
                                            <p class="star-text">{{ $data->full_name}} <img src="{{ url('/doctor/verify.png') }}" alt="" class="star-veri">
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <center>
                                            <!-- <p class="star-text">
                                                <img src="{{ url('/doctor/yl-star.png') }}" alt="" class="yl-star">
                                                <img src="{{ url('/doctor/yl-star.png') }}" alt="" class="yl-star">
                                                <img src="{{ url('/doctor/yl-star.png') }}" alt="" class="yl-star">
                                                <img src="{{ url('/doctor/yl-star.png') }}" alt="" class="yl-star">
                                                <img src="{{ url('/doctor/g-star.png') }}" alt="" class="g-star">
                                            </p> -->


                                            @if(Session::get('userId'))
                                            <!-- <form class="form-horizontal poststars" action="{{url('/doctor/detail/rating')}}" id="addStar" method="POST">
                                                {{ csrf_field() }}
                                                <div class="form-group required">
                                                    <div class="col-sm-12">
                                                        <input hidden value="{{Session::get('userId')}}" id="star-5" type="text" name="userid" />
                                                        <input hidden value="{{$data->id}}" id="star-5" type="text" name="userdetail_id" />
                                                        <input class="star" value="5" id="star-5" type="checkbox" name="star[]" />
                                                        <input class="star " value="4" id="star-4" type="checkbox" name="star[]" />
                                                        <input class="star " value="3" id="star-3" type="checkbox" name="star[]" />
                                                        <input class="star" value="2" id="star-2" type="checkbox" name="star[]" />
                                                        <input class="star" value="1" id="star-1" type="checkbox" name="star[]" />
                                                    </div>
                                                </div>
                                                <input type="submit" class="btn-primary" name="Submit" id='submitstar' value="Rating">                                                
                                            </form> -->
                                            @endif
                                            @if(!$rating)  @elseif($rating=floatval($rating)) @endif
                                            @foreach(range(1,5) as $i)
                                            <a @if(Session::get('userId')) @else href="javascript:confirm('hello world')" data-toggle="modal" data-target="#staticBackdrop" @endif>
                                                <span class="fa-stack" style="width:1em">
                                                    <i class="far fa-star fa-stack-1x"></i>
                                                    @if($rating >0)
                                                    @if($rating >0.5)
                                                    <i class="fas fa-star fa-stack-1x" style="color: #ff9b00;"></i>
                                                    @else
                                                    <i class="fas fa-star-half fa-stack-1x" style="color: #ff9b00;"></i>
                                                    @endif
                                                    @endif
                                                    @php $rating--; @endphp
                                                </span>
                                            </a>
                                            @endforeach
                                        </center>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <center>
                                        <button type="button" class="btn btn-primary pri-share" @if(Session::get('userId')) data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" @else href="javascript:confirm('hello world')" data-toggle="modal" data-target="#staticBackdrop" @endif>Add Feedback</button>
                                            <a href="" class="btn btn-primary pri-share">Share Now&nbsp;
                                            </a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Star rating model start-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Feedback message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/doctor/detail/rating')}}" id="addStar" method="POST">
                        {{ csrf_field() }}
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <input hidden value="{{Session::get('userId')}}" id="star-5" type="text" name="userid" />
                                    <input hidden value="{{$data->id}}" id="star-5" type="text" name="userdetail_id" />
                                    <input class="star" value="1" id="star-5" type="checkbox" name="star[]" />
                                    <input class="star " value="2" id="star-4" type="checkbox" name="star[]" />
                                    <input class="star " value="3" id="star-3" type="checkbox" name="star[]" />
                                    <input class="star" value="4" id="star-2" type="checkbox" name="star[]" />
                                    <input class="star" value="5" id="star-1" type="checkbox" name="star[]" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="rating_message" name="rating_message"></textarea>
                            </div>  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <input type="submit" class="btn-primary" name="Submit" id='submitstar' value="Rating"> -->
                        <button type="submit" class="btn btn-primary" id="submitstar">Send Feedback</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--star rating model end -->
        <!--Section Social media end-->
        <!--Section qna start-->
        <section id="qna">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 card card-body card-qs">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="qs-ass">Question & Answer</p>
                                </div>
                                <div class="col-md-4 card card-body p-card wwd-100 wow slideInLeft">
                                    <div class="form-control p-control">
                                        <p class="p-text p-textx" onclick="toggleFee()">What is the consult fee ?</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <i id="toggleIconFee" class="fa fa-eye eye-fa" onclick="toggleFee()"></i>
                                        </div>
                                    </div>
                                    <div id="newFee" class="col-md-12" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="card card-body card-fee">
                                                    <p class="">Rs {{$data->consul_fee_from}} - Rs {{$data->consul_fee_to}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 card card-body p-card wwd-100 wow slideInLeft">
                                    <div class="form-control p-control">
                                        <p class="p-text p-textx" onclick="toggleTime()">What is the consult time?</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <i id="toggleIconTime" class="fa fa-eye eye-fa" onclick="toggleTime()"></i>
                                        </div>
                                    </div>
                                    <div id="newTime" class="col-md-12" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="card card-body card-fee">

                                                    <p class="">{{$data->from_time}} - {{$data->to_time}}</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 card card-body p-card wwd-100 wow slideInLeft">
                                    <div class="">
                                        <form action="">
                                            <a @if(Session::get('userId')) onclick="openSubmitButton()" @else href="javascript:confirm('hello world')" data-toggle="modal" data-target="#staticBackdrop" @endif><input type="text" name="" class="form-control p-control-card " id="myInput" placeholder="Add Your Question ?"></a>
                                            <input type="submit" id="submitButton" name="" class="btn btn-primary pri-share" value="Submit" style="display: none;">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <form class="form-inline" method="post" action="{{url('doctor/detail/questionanswarUpdate')}}">
                                @csrf
                                <!-- <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail3">
                                    </div>
                                </div> -->
                                <div class="col-sm-3 col-md-4 card card-body p-card wwd-100 wow">
                                    <select class=" form-control p-control" name="question_id" id="specificSizeSelect">
                                    <option class="card card-body card-fee" selected>--Choose Question--</option>
                                    @foreach($questionAnswar as $answer )
                                    <option class="card card-body card-fee" value="{{$answer->id}}">{{$answer->question}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary pri-share">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Section qna end-->
        <!--Section Similar doctor start-->
        <section id="similar-doc">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="qs-ass">Similar doctor's profile</p>
                        </div>
                        @foreach($alldoctor as $key=>$val)
                        @php $acb=explode(',',$val->star_ratings); $ratings = count($acb); @endphp
                        <div class="col-xs-12 col-sm-6 col-md-4  wi-100 wii-100 coll-50 wow slideInLeft">
                            <div class="card card-body img-fluid">

                                <p class="similar-text">Name: {{$val->full_name}}<img src="{{ url('/doctor/verify.png') }}" alt="" class="ig-fl">
                                    <button class="btn btn-primary btn-prmr btn-year">20 Years</button>
                                </p>
                                <p class="similar-text">Department: {{$val->department}}</p>
                                <p class="similar-text">Designation: {{$val->designation}} {{$val->orgnization_name}}</p>
                                <p class="similar-text">Location: {{$val->location}}, {{$val->landmark_pincode}}</p>
                                <p class="similar-text">Rating: {{$ratings}}</p>
                                <span class="ig-rit">
                                    <a href="{{ url('/doctor/detail/'.urlencode($val->full_name)) }}" class="ig-a">Know More <i class="fa fa-arrow-right"></i></a>

                                </span>
                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-6 col-md-4 wi-100 coll-50 wow slideInLeft">
                            <div class="card card-body img-fluid">

                                <p class="similar-text">Name: Dr. Rabindra Mohanty <img src="{{ url('/doctor/verify.png') }}" alt="" class="ig-fl">
                                    <button class="btn btn-primary btn-prmr btn-year">20 Years</button>
                                </p>
                                <p class="similar-text">Department: Cardiology</p>
                                <p class="similar-text">Designation: MD at SCB Medical Cuttack</p>
                                <p class="similar-text">Location: Badambadi, Cuttack 754001</p>
                                <p class="similar-text">Rating: 4.5</p>
                                <span class="ig-rit">
                                    <a href="doctor-details.html" class="ig-a">Know More <i class="fa fa-arrow-right"></i></a>

                                </span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 wi-100 wwi-100 coll-50 wow slideInLeft">
                            <div class="card card-body img-fluid">

                                <p class="similar-text">Name: Dr. Rabindra Mohanty <img src="{{ url('/doctor/verify.png') }}" alt="" class="ig-fl">
                                    <button class="btn btn-primary btn-prmr btn-year">20 Years</button>
                                </p>
                                <p class="similar-text">Department: Cardiology</p>
                                <p class="similar-text">Designation: MD at SCB Medical Cuttack</p>
                                <p class="similar-text">Location: Badambadi, Cuttack 754001</p>
                                <p class="similar-text">Rating: 4.5</p>
                                <span class="ig-rit">
                                    <a href="doctor-details.html" class="ig-a">Know More <i class="fa fa-arrow-right"></i></a>

                                </span>
                            </div>
                        </div> -->
                        @endforeach
                        <center> <a href="doctor-similar-doctor.html" class="btn btn-primary btn-view">View All</a></center>
                    </div>
                </div>
            </div>
        </section>
        <!--Section similar doctor end-->
    </div>
</div>
<!--get in touch modal start-->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body card card-body mod-crd">
                <p class="doc-mod-txt1">In order to securities concern need an <b>OTP</b> verification and proper reason for
                    it.</p>
                <select class="form-control put-rs-control" name="">

                    <option value="">Put the reason ?</option>
                    <option value="" onclick="openOptionotp()">Reason 1</option>
                    <option value="" onclick="openOptionotp()">Reason 2</option>

                </select>
                <p class="doc-mod-txt2">OTP has been sent to your register email address.</p>
                <p class="doc-mod-txt3">sharatzone@gmail.com</p>
                <form>
                    <div class="card card-body otp-card " id="newotpCard" style="display: none;">
                        <div class="verification-code">
                            <label class="control-label">Enter the OTP</label>
                            <div class="verification-code--inputs">
                                <input type="text" maxlength="1" />
                                <input type="text" maxlength="1" />
                                <input type="text" maxlength="1" />
                                <input type="text" maxlength="1" />
                                <input type="text" maxlength="1" />
                            </div>
                            <input type="hidden" id="verificationCode" />
                        </div>
                        <center><button class="btn btn-otp" name="">Submit Now</button></center>
                    </div>
                </form>
                <form>
                    <p class="doc-mod-txt4">Didn't you receive any code?</p>
                    <p class="doc-mod-txt5">Resend New Code</p>
                </form>
            </div>
        </div>
    </div>
</div>
<!--get in touch modal end addStar-->
@include('frontend-source.includes.login-popup')
@endsection
@push('script')

<script src="{{ asset('frontend-source/bootstrap/js/bootstrap-notify.min.js') }}" type="text/javascript"></script>
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
    }, {
        type: "success"
    });
</script>
@endif
<script src="{{ asset('frontend-source/js/booking-validate.js') }}?v={{time()}}" type="text/javascript"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        function openOptionotp() {
            var div = document.getElementById("newotpCard");
            div.style.display = "block";
        }


        var selectElement = document.querySelector(".put-rs-control");
        selectElement.addEventListener("change", openOptionotp);
    });
</script>
<script>
    //timer start
    const timer = document.getElementById("timer");
    const timerLabel = document.querySelector(".timer-label");

    function updateTimer() {
        const now = new Date();
        const days = String(now.getDate()).padStart(2, "0");
        const hours = String(now.getHours()).padStart(2, "0");
        const minutes = String(now.getMinutes()).padStart(2, "0");
        const seconds = String(now.getSeconds()).padStart(2, "0");

        timer.textContent = `${days}:${hours}:${minutes}:${seconds}`;
    }

    // Update the timer every second
    setInterval(updateTimer, 1000);

    // Initial call to set the initial time
    updateTimer();
    //timer end

    //Code Verification
    var verificationCode = [];
    $(".verification-code input[type=text]").keyup(function(e) {

        // Get Input for Hidden Field
        $(".verification-code input[type=text]").each(function(i) {
            verificationCode[i] = $(".verification-code input[type=text]")[i].value;
            $('#verificationCode').val(Number(verificationCode.join('')));
            //console.log( $('#verificationCode').val() );
        });

        //console.log(event.key, event.which);

        if ($(this).val() > 0) {
            if (event.key == 1 || event.key == 2 || event.key == 3 || event.key == 4 || event.key == 5 || event.key == 6 || event.key == 7 || event.key == 8 || event.key == 9 || event.key == 0) {
                $(this).next().focus();
            }
        } else {
            if (event.key == 'Backspace') {
                $(this).prev().focus();
            }
        }

    }); // keyup

    $('.verification-code input').on("paste", function(event, pastedValue) {
        console.log(event)
        $('#txt').val($content)
        console.log($content)
        //console.log(values)
    });

    $editor.on('paste, keydown', function() {
        http: //jsfiddle.net/5bNx4/#run
            var $self = $(this);
        setTimeout(function() {
            var $content = $self.html();
            $clipboard.val($content);
        }, 100);
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery/3.5.0.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    $('#addStar').on('submit', function(e) {
        e.preventDefault();
        //alert(2222);
        // if (this.checked)
        // {
        //alert('form submitted');
        //    var searchIDs = $("input:checkbox:checked").map(function(){return $(this).val(); }).get();
        //    var userid = "{{Session::get('userId')}}";
        //    var userdetail_id = "{{$data->id}}";
        //alert(userid);
        //console.log(searchIDs);


        var form = $("#addStar");
        var url = form.attr('action');
        var methord = form.attr('method');
        //alert(url);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: methord,
            url: url,
            //data:{rating:searchIDs,userid:userid,userdetail_id:userdetail_id},
            data: form.serialize(),
            success: function(response) {
                alert("Form Submited Successfully");
                document.getElementById("addStar").reset();
                $('#exampleModal').modal('hide');
                if(response.success == true){ // if true (1)
                    window.location.reload();
                }
            }

        });
        // }else{

        //     alert('form unsubmit');

        // }
    });
</script>
@endpush