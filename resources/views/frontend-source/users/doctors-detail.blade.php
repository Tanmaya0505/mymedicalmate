@extends('frontend-source.layouts.master')
@section('title') Medical Mate Details @stop
@section('keywords') Medical Mate Details @stop
@section('description') Medical Mate Details @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/css/custom.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/doctorlistcss/style.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    /* .row {
        display: block;
    } */
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
@endsection
@section('content')
<div class="">
    <?php
    $photo =  asset('frontend-source/images/assistant-boy-icon.png');
    if ($data->profile_picture) {
        $photo = url($data->profile_picture);
    }
    ?>
    <main id="main" class="main-doc">
    <div class="row">
        <!--Section qna start-->
        <div class="col-md-4 pd-lt-0-doc desktop-doctor-block">
            <section>
                <div class="col-md-12" style="padding-left: 0px !important;">
                    <div class="count" style="background-color: #DEEBF7;">
                        <div id="countdown9" style="padding-top: 0px !important;margin-left: -16px;">
                            <ul>
                                <li class="li2"><span id="days9"></span>Days</li>
                                <li class="li2"><span id="hours9"></span>Hours</li>
                                <li class="li2"><span id="minutes9"></span>Minutes</li>
                                <li class="li2"><span id="seconds9"></span>Seconds</li>
                            </ul>
                        </div>
                        <p class="get-doc-dtls">Get Up to 25% Cashback on Medicine Order</p>
                        <div class="variantss">
                            <div class='filen file--upload'>
                                <label for='input-file'>
                                    Upload Prescription
                                </label>
                                <input id='input-file' type='file' />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Section Similar doctor start-->
            <section id="similar-doc">
                <div class="container-fluid container-fluid-doc1 cont-doc-fld">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="qs-ass">Similar doctor's profile</p>
                            </div>
                            @foreach($alldoctor as $key=>$val)
                            @php $acb=explode(',',$val->star_ratings);  @endphp
                            <?php $rating = App\Rating::where('userdetail_id',$val->id)->avg('rating'); ?>
                            <div class="col-xs-12 col-sm-6 col-md-12  wi-100 wii-100 wi-dtls-pd coll-50 wow slideInUp">
                                <div class="card card-body img-fluid">
                                    <p class="similar-text similar-dtls-doc"><b>{{$val->full_name}}</b> <img src="{{ url('/doctor/blue-tick.png') }}" alt="" style="width:15px;margin-top: -4px;">
                                        <button class="btn btn-primary btn-prmr btn-year">{{$val->total_experience}} Years</button>
                                    </p>
                                    <p class="similar-text">MD in Cardiology at {{$val->orgnization_name}}</p>
                                    <p class="similar-text">Overall {{$val->total_experience}} Years of Experience in {{$val->department}}</p>
                                    <p class="similar-text">Public Rating: (<?php  echo number_format((float)$rating, 1, '.', ''); ?>)</p>

                                    <span class="ig-rit">
                                        <a href="{{ url('/doctor/detail/'.urlencode($val->full_name)) }}" class="ig-a">Know More <i class="fa fa-arrow-right"></i></a>

                                    </span>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-md-12">
                                <a href="" class="btn btn-dlts-view" style="float: right;">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="qna" class="desk-open desk-scroll ">
                <div class="container-fluid container-fluid-doc1 cont-doc-fld">
                    <div class="col-md-12 doctor-wd-12-wd-12">

                        <div class="">
                            <div class="col-md-12 card card-body card-qs card-qsas">
                                <div class="">
                                    <h1 class="question1 qs-ass qs-doc-ans"> View Question & Answer<span class="faq-tt"></span>
                                    </h1>
                                    @foreach($questionAnswar as $answer )
                                    <div class="topic" style="display: none;">
                                        <div class="open">
                                            <h2 style="position: none;" class="question">{{$answer->question}}</h2><span class="faq-t"></span>
                                        </div>
                                        <p class="answer"> {{$answer->answar}}</p>
                                    </div>
                                    @endforeach
                                    <div class="col-md-12 card card-body p-card wwd-100 wow slideInUp" style="padding-right:0px">
                                        <div class="">
                                            <form action="{{url('doctor/detail/questionanswarUpdate')}}" method="post">
                                            @csrf
                                                <input type="text" class="form-control p-control-card" name="question" onclick="openSubmitButton1()" placeholder="Add Your Question ?">
                                                <div class="file-upload-doc" id="uploaded" style="display: none;">
                                                    <label for="upload" class="file-upload__label-doc"><i class="fa fa-upload"></i>
                                                        Upload</label>
                                                    <input id="upload" class="file-upload__input-doc" type="file" name="file-upload">
                                                </div>
                                                <button type="submit" id="submitButton1" name="" class="btn btn-primary pri-share" value="Submit" style="display: none;">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-8 pd-rt-0-doc">
            <section id="hero-doc hero-dtls">
                <div class="container-fluid container-fluid-doc1 cont-fld cont-fld-doc1">
                    <div class="col-md-12 mob-pd-wd-12">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 ">
                                <div class="card card-body pro-card pro-card0" style="height: 300px;padding: 0px;">
                                    <div style="background-color: #0009;height: 300px;"></div>
                                    <div class="row">
                                        <div class="col-md-1 "></div>
                                        <div class="col-md-3 col-4">
                                            <div class="card card-body pro-card01">
                                                <img src="{{ url('/doctor/real-doc.jpeg') }}" alt="" class="dtls-doc-img">
                                                <!--for desktop-->
                                                <div class="card card-body" style="background-color: #6f42c199;border: transparent;height: 40px;margin-top: -40.2px;border-radius: 0px;color: #fff;font-weight: 600;text-align: center;">
                                                    Prime <img src="{{ url('/doctor/doctor-check.png') }}" alt="" style="width: 25px;margin-left:80px ;margin-top: -25px;"></div>
                                                <!--desktop end-->
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-8">
                                            <!--foe mobile-->
                                            <p><img src="{{ url('/doctor/real-doc.jpeg') }}" alt="" class="dtls-doc-img-circle">
                                            <div class="card card-body prime-green-card">Prime</div>
                                            </p>
                                            <!--mobile end-->
                                            <div class="dtls-doc-dtls">

                                                <p class="dtls-text-doc1"><b>{{ $data->full_name}}</b> <img src="{{ url('/doctor/blue-tick.png') }}" alt="" style="width:20px;margin-top: -1px;">
                                                </p>
                                                <p class="dtls-text-doc2" style="margin-top: 3px;">Prof at {{$data->orgnization_name}} {{$data->landmark_pincode}}</p>
                                                <p class="dtls-text-doc2 dtls-text-doc20" style="margin-top: 3px;">Overall {{$data->total_experience}} Years of
                                                    Experience in <b>{{$data->department}}</b>
                                                    <img src="../assets/image/heart.png" alt="" class="wish-doc-img">
                                                    <img src="../assets/image/share.png" alt="" class="share-doc-img">
                                                </p>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 mob-xs-pd-12">
                                <div class="card card-body pro-card-card1 dtls-card-card2 ">
                                    <div class="row">
                                        <div class="col-md-3 dtls-wd-3"></div>
                                        <?php $rating = App\Rating::where('userdetail_id',$data->id)->avg('rating'); ?>
                                        <div class="col-md-3 dtls-wd1-3">
                                            <p class="dtls-text-doc2 dtls-text-doc22">Public Ratings
                                                <img src="../assets/image/senario/ty.png" alt="" class="dtls-doc-star">
                                                (<?php  echo number_format((float)$rating, 1, '.', ''); ?>)
                                            </p>
                                        </div>
                                        <div class="col-md-3 dtls-wd2-3">
                                            <img src="../assets/image/senario/dtls-gara.png" alt="" class="dtls-gara1">
                                            <p class="dtls-text-doc3"> Expected Cons
                                                <span class="dtls-txt1-count">1000+</span>
                                            </p>
                                            <p class="dtls-text-doc6 dtls-text-doc66">In Last Three Months</p>
                                        </div>
                                        <div class="col-md-3 dtls-wd3-3">
                                            <img src="../assets/image/senario/dtls-gara.png" alt="" class="dtls-gara2">
                                            <p class="dtls-text-doc4"> Visitors
                                                <span class="dtls-txt1-count">2000+</span>
                                            </p>
                                            <p class="dtls-text-doc6">In Last Three Months</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End Hero -->
            <!--Start Time section-->
            <section id="time">
                <div class="container-fluid container-fluid-doc1 time-container-fluid">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card card-body card-locc col-12 ">

                                <!--desktop view start-->
                                <div class="col-md-12 desk-blck">
                                    <div class="row">
                                        <div class="col-md-6 dtls-6-doctor wow slideInUp">
                                            <p class="doc-high-back">Doctor Features</p>
                                            <p class="location-text location-details-1 mob-dtls-control2">
                                                <img src="../assets/image/senario/hospital-1.png" alt="" class="pro-ctime"> Consult Location
                                            </p>
                                            <p class="form-control control-data mob-dtls-control" style="margin-top: -6px !important;margin-bottom: 20px;">{{$data->landmark_pincode}}</p>
                                            <p class="location-text location-details-1 dtls-location-txt1 mob-dtls-control1" style="padding-top: 0px;padding-bottom: 0px;">
                                                <img src="../assets/img/h-ftime.png" alt="" class="pro-ctime"> Consult Time
                                            </p>
                                            <p class="form-control control-data">{{$data->from_time}} - {{$data->to_time}}</p>
                                        </div>
                                        <div class="col-md-6 dtls-6-doctor wow slideInUp">

                                            <p class="location-text location-details-1 days-dtls-txt" style="padding-top:36px">
                                                <img src="../assets/image/senario/calendar.png" alt="" class="pro-ctime"> Consult Days
                                            </p>
                                            <p class="form-control control-data" style="margin-top: -3px !important;">{{$data->avl_days}}</p>
                                            <p class="location-text location-details-1" style="padding-bottom: 3px;">
                                                <img src="../assets/image/senario/my-coin.png" alt="" class="pro-ctime"> Consult Fee
                                            </p>
                                            <p class="form-control control-data" style="margin-top: -3px !important;">
                                                <i class="fa fa-rupee"></i> {{$data->consul_fee_from}} - <i class="fa fa-rupee"></i> {{$data->consul_fee_to}}
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
                <div class="container-fluid container-fluid-doc1 time-container-fluid">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card card-body pro-qual pro-background col-12 ">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12" style="text-align: center;">

                                            <img src="{{ url('/doctor/a-trophy.gif') }}" alt="" class="pro-trophy">

                                        </div>
                                        <div class="col-md-6 col-12 wow slideInUp">
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
                                                            <div class="col-md-12 col-12 " style="padding-left: 0px;padding-right: 0px;">
                                                                <div class="form-control card-blue" style="margin-top: -65px;">
                                                                    <div class="row">
                                                                        <div class="col-md-11 col-9">
                                                                            <p class="text-award">{{$data->doctorqualification}} from {{$data->univercity}} {{$data->university_date}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="form-control card-blue">
                                                                    <div class="row">
                                                                        <div class="col-md-11 col-9">
                                                                            <p class="text-award">{{$data->doctorqualification}} from {{$data->univercity}} {{$data->university_date}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                                <!-- <div class="form-control card-blue">
                                                                    <div class="row">
                                                                        <div class="col-md-11 col-9">
                                                                            <p class="text-award">{{$data->doctorqualification}} from {{$data->univercity}} {{$data->university_date}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 wow slideInUp">
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
                                                    <div class="col-md-12 col-12" style="padding-left: 0px;padding-right: 0px;">
                                                        <div class="form-control card-blue" style="margin-top: 3px;">
                                                            <div class="row">
                                                                <div class="col-md-11 col-9">
                                                                    <p class="text-award">{{$data->achievement_award}}</p>
                                                                </div>
                                                                <div class="col-md-1 col-3">
                                                                @if(!empty($data->profile_picture))<img src="{{ url($data->profile_picture)}}" class="details-modal-img" data-toggle="modal" data-target="#myModaldelete"> @else <img src="{{ url('/doctor/pro-doc.jpg') }}" class="details-modal-img" data-toggle="modal" data-target="#myModaldelete"> @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="text-align: center;">
                                            <form action="{{url('doctor/detail/doctorVeryfiyOtp')}}" method="post" id="getintochformedit">
                                                @csrf
                                                <input hidden value="{{$data->full_name}}"  type="text"  name="name" id="name" />
                                                <input hidden  value="{{$data->mobile}}" type="text" name="mobile" id="mobile" />
                                                <input hidden  type="text"  value="{{$data->email}}" name="email" id="email" />  
                                                <button type="button" id="editsubmit_data" class="btn btn-primary btn-prm getin-tochOtp" data-toggle="modal" data-id="{{$data->id}}" data-target="#myModal">GET
                                                    IN TOUCH <img src="{{ url('/doctor/hand1.png') }}" alt="" class="icon-hand">
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Section award end-->
            <section>
                <div class="col-md-12">
                    <div class="card card-body story-card-doc">
                        <p class="story-doc-txt1">Doctor Stories</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2 col-3">
                                        <img src="{{ url('/doctor/consultation.png') }}" alt="" class="doc-story-img">
                                    </div>
                                    <div class="col-md-10 col-9">
                                        <p class="story-doc-txt2 wow slideInUp"><b>No of Consultation!</b><br>Around {{$data->consultation}}+ consultation in
                                            last {{$data->total_experience}} years.</p>
                                    </div>
                                </div>
                                <hr class="dtls-hr1">
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2 col-3">
                                        <img src="{{ url('/doctor/prescribing.png') }}" alt="" class="doc-story-img">
                                    </div>
                                    <div class="col-md-10 col-9">
                                        <p class="story-doc-txt2 wow slideInUp"><b>No of Consultation at Clinic !</b><br> Around {{$data->consultation_clinic}}+
                                            consultation in last {{$data->total_experience}} years.</p>
                                    </div>
                                </div>
                                <hr class="dtls-hr1">
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2 col-3">
                                        <img src="{{ url('/doctor/search.png') }}" alt="" class="doc-story-img" style="width: 45px;">
                                    </div>
                                    <div class="col-md-10 col-9">
                                        <p class="story-doc-txt2 wow slideInUp"> <b>No of Research in Career !</b><br> Around {{$data->no_research}}+
                                            consultation in last {{$data->total_experience}} years.</p>
                                        </p>
                                    </div>

                                </div>
                                <hr class="dtls-hr2">
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2 col-3">
                                        <img src="{{ url('/doctor/medical-service.png') }}" alt="" class="doc-story-img" style="width: 37px;margin-top: -6px;">
                                    </div>
                                    <div class="col-md-10 col-9">
                                        <p class="story-doc-txt2 wow slideInUp"><b>Type of Language Known !</b><br> Doctor fluent speak in
                                        {{$data->no_language}}</p>
                                        </p>
                                    </div>

                                </div>
                                <hr class="dtls-hr2">
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="col-md-12 dtls-dtls-122">
                    <div class="card card-body loc-cardd loc-socialmedia">

                        <div class="col-md-12 ">
                            <div class="row">
                                <div class="col-md-6 second-dtls-doc-6 second-dtls-doc-66  wow slideInUp">
                                    <p class="doc-high-back1">Connect with Social Media</p>
                                    <p class="location-text location-details-1 background-social-border">
                                        <a href="" class="location-text location-details-1"> <img src="{{ url('/doctor/web.png') }}" alt="Website" class="icon-social"> &nbsp;Website URL</a>
                                    </p>

                                    <p class="location-text location-details-1 background-social-border">
                                        <a href="https://www.facebook.com/" class="location-text location-details-1"> <img src="{{ url('/doctor/face.png') }}" alt="Facebook" class="icon-social">&nbsp;Facebook URL</a>
                                    </p>

                                    <p class="location-text location-details-1 background-social-border">
                                        <a href="" class="location-text location-details-1"> <img src="{{ url('/doctor/instagram.png') }}" alt="Instagram" class="icon-social">&nbsp;Instagram URL</a>
                                    </p>

                                </div>
                                <div class="col-md-6 second-dtls-doc-6 second-dtls-doc-66 second-dtls-doc-list-6 wow slideInUp">

                                    <p class="location-text location-details-1 background-social-border">
                                        <a href="" class="location-text location-details-1"> <img src="{{ url('/doctor/linked.png') }}" alt="linkedIn" class="icon-social">&nbsp;LinkedIn URL</a>
                                    </p>

                                    </p>
                                    <p class="location-text location-details-1 background-social-border">
                                        <a href="" class="location-text location-details-1 "> <img src="{{ url('/doctor/youtube.png') }}" alt="Youtube" class="icon-social">&nbsp;Youtube URL</a>
                                    </p>

                                    </p>
                                    <p class="location-text location-details-1 background-social-border">
                                        <a href="" class="location-text location-details-1 "> <img src="{{ url('/doctor/twitter.png') }}" alt="Twitter" class="icon-social">&nbsp;Twitter URL</a>
                                    </p>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Section Social media start-->
            <section id="social-media">
                <div class="container-fluid container-fluid-doc1">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card card-body  card-web">
                                <div class="card card-body loc-cardd wow slideInUp">
                                    <p class="loc-des loc-text"  style="font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 1000px;">Description: {{$data->description}}........... <a class="button loc-read" onclick="openPopup1()">Read More</a></p>
                                    <!-- Modal -->
                                    <div class="popup-overlay" id="popup1">
                                        <div class="popup-content">
                                            <span class="popup-close" onclick="closePopup1()">&times;</span>
                                            <h5 class="h5">View Details</h5>

                                            <div class="content" style="padding-top:8px">
                                                <p class="comment-text">Description:{{$data->description}}  </p>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--Doctor description modal end-->
                                <div class="col-md-12 md-md">
                                    <div class="row">
                                        <!--Doctor comments modal start-->
                                        <div class="col-md-8 col-7 wow slideInUp">
                                            <div class="form-control loc-cardd loc-card-form">
                                                <p class="loc-text" type="button" onclick="openPopup()">Comments</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a class="button" onclick="openPopup()"> <i class="fa fa-eye fa-eyee"></i></a>
                                                </div>
                                                <div class="popup-overlay" id="popup">
                                                    <div class="popup-content">
                                                        <div style="position: fixed;width: 63.5%;background-color: #fff;margin-top:-18px">
                                                        <span class="popup-close" onclick="closePopup()">&times;</span>
                                                        <h5 class="h5">View Comments</h5>
                                                        </div>
                                                        <div class="content">
                                                            @php $comments=App\Comment::where('userdetail_id',$data->id)->get(); @endphp
                                                            @foreach($comments as $comment)
                                                            <p class="comment-date">Justin Beiber&nbsp;&nbsp;Date: 08-07-2023</p>
                                                            <p class="comment-text">{{$comment->comments}}</p>
                                                            <hr>
                                                            @endforeach
                                                            <p class="comment-date">Justin Beiber&nbsp;&nbsp;Date: 08-07-2023</p>
                                                            <p class="comment-text">{{$data->comments}}</p>
                                                            <hr>
                                                            <p class="comment-date">Justin Beiber&nbsp;&nbsp;Date: 08-07-2023</p>
                                                            <p class="comment-text">{{$data->comments}}</p>
                                                            <hr>
                                                            <p class="comment-date">Justin Beiber&nbsp;&nbsp;Date: 08-07-2023</p>
                                                            <p class="comment-text">{{$data->comments}}</p>
                                                            <hr>
                                                        </div>
                                                        <button class="comment-add btn btn-primary pri-share1" @if(Session::get('userId')) onclick="openComment()" @else onclick="javascript:confirm('Please login')"  @endif>Add
                                                            Comment</button>

                                                        <a href="#" class="comment-view btn btn-primary pri-view">View More</a>
                                                        <div class="col-md-12">
                                                            <form action="{{url('detail/comments')}}" method="post">
                                                                @csrf
                                                                <div id="myComment" class="hidden-div">
                                                                    <input type="date" name="date" placeholder="" class="form-control">
                                                                    <input type="hidden" name="user_id" value="{{Session::get('userId')}}" class="form-control">
                                                                    <input type="hidden" name="usedetails_id" value="{{$data->id}}" class="form-control">
                                                                    <input type="textarea" name="comments" placeholder="Add Your Comment" class="form-control">
                                                                    <center><button type="submit" class="btn btn-primary pri-share" name="">Submit</button></center>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Doctor comments modal end-->
                                        <div class="col-md-4 col-5 wow slideInUp">
                                            <div class="form-control loc-cardd loc-card-form">
                                                <p class="loc-text">Views</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 doctor-mt-top">
                                    <div class="row">
                                        <div class="col-md-4 offset-4 col-4">
                                            <center>
                                                <div class="card card-body card-pro">
                                                    @if(!empty($data->profile_picture))<img src="{{ url($data->profile_picture)}}" alt="" class="image-pro"> @else <img src="{{ url('/doctor/woman.png') }}" alt="" class="image-pro"> @endif
                                                </div>
                                            </center>
                                        </div>
                                        <div class="col-md-12 col-12" style="text-align: center;">
                                            <p class="star-text">{{ $data->full_name}}<img src="{{ url('/doctor/blue-tick.png') }}" alt="" style="width:20px;margin-top: -4px;">
                                            </p>
                                        </div>
                                        <div class="col-md-12 col-12">
                                        <?php $rating = App\Rating::where('userdetail_id',$data->id)->avg('rating');
                                        $ratings = App\Rating::where('userdetail_id',$data->id)->avg('rating'); ?>
                                            <p class="star-text" style="text-align: center;">
                                            <a @if(Session::get('userId')) @else href="javascript:confirm('hello world')" data-toggle="modal" data-target="#staticBackdrop" @endif>
                                                @if(!$ratings)  @elseif($ratings=floatval($ratings)) @endif
                                                @foreach(range(1,5) as $i)
                                                <span class="fa-stack" style="width:2em">
                                                    <i class="far fa-stack-1x"><img src="{{ url('/doctor/g-star.png') }}" alt="" class="yl-star"></i>
                                                    @if($ratings >0)
                                                    @if($ratings >0.5)
                                                    <i class="fas  fa-stack-1x"><img src="{{ url('/doctor/yl-star.png') }}" alt="" class="yl-star"></i>
                                                    @else
                                                    <i class="fas fa-star-half fa-stack-1x" style="color: #ff9b00;"></i>
                                                    @endif
                                                    @endif
                                                    @php $ratings--;  @endphp 
                                                </span>
                                                @endforeach
                                            </a>
                                            </p>
                                        </div>
                                        <div class="col-md-12 col-12" style="text-align: center;">

                                            <a href="" class="btn btn-primary pri-share">Share Now&nbsp;<i class="fa fa-share-square-o" style="font-size: 15px;margin-left: 5px;"></i>
                                            </a>

                                        </div>
                                        <div class="col-md-12 fot-dtls-back-img" style="background-image: url(/doctor/doctor-background-footer.png);background-size: contain;height: 120px;margin-top: -95px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!--Section Social media end-->
        <section id="qna" class="mob-open desk-scroll">
            <div class="container-fluid container-fluid-doc1 cont-doc-fld">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 card card-body card-qs">
                            <div class="row">
                                <h1 class="question1 qs-ass qs-doc-ans">View Question & Answer<span class="faq-tt"></span>
                                </h1>
                                @foreach($questionAnswar as $answer )
                                <div class="topic" style="display: none;">
                                    <div class="open">
                                        <h2 class="question">{{$answer->question}}</h2><span class="faq-t"></span>
                                    </div>
                                    <p class="answer">{{$answer->answar}}</p>
                                </div>
                                @endforeach
                                <div class="col-md-12 card card-body p-card wwd-100 wow slideInUp">
                                    <div class="">
                                        <form action="{{url('doctor/detail/questionanswarUpdate')}}" method="post">
                                        @csrf
                                            <input type="text" name="question" class="form-control p-control-card " id="myInput" onclick="openSubmitButton2()" placeholder="Add Your Question ?" style="height: 50px !important;">
                                            <div class="file-upload-doc" id="uploaded1" style="display: none;">
                                                <label for="upload" class="file-upload__label-doc"><i class="fa fa-upload"></i>upload</label>
                                                <input id="upload" class="file-upload__input-doc" type="file" name="file-upload">
                                            </div>
                                            <button type="submit" id="submitButton2" name="" class="btn btn-primary pri-share"  style="display: none;">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Section qna start-->
        <div class="col-md-4 pd-lt-0-doc mobile-doctor-block">
            <section>
                <div class="col-md-12" style="padding-left: 0px !important;">
                    <div class="count" style="background-color: #DEEBF7;">
                        <div id="countdown95" style="padding-top: 0px !important;margin-left: -16px;">
                            <ul>
                                <li class="li2"><span id="days95"></span>Days</li>
                                <li class="li2"><span id="hours95"></span>Hours</li>
                                <li class="li2"><span id="minutes95"></span>Minutes</li>
                                <li class="li2"><span id="seconds95"></span>Seconds</li>
                            </ul>
                        </div>
                        <p class="get-doc-dtls">Get Up to 25% Cashback on Medicine Order</p>
                        <div class="variantss">
                            <div class='filen file--upload'>
                                <label for='input-file'>
                                    Upload Prescription
                                </label>
                                <input id='input-file' type='file' />
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!--Section Similar doctor start-->
            <section id="similar-doc">
                <div class="container-fluid container-fluid-doc1 cont-doc-fld">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="qs-ass">Similar doctor's profile</p>
                            </div>
                            @foreach($alldoctor as $key=>$val)
                            @php $acb=explode(',',$val->star_ratings);  @endphp
                            <div class="col-xs-12 col-sm-6 col-md-12  wi-100 wii-100 wi-dtls-pd coll-50 wow slideInUp">
                                <div class="card card-body img-fluid">

                                    <p class="similar-text similar-dtls-doc" style="font-size: 18px !important;"><b>{{$val->full_name}}</b> <img src="{{ url('/doctor/blue-tick.png') }}" alt="" style="width:15px;margin-top: -4px;">
                                        <button class="btn btn-primary btn-prmr btn-year">{{$val->total_experience}} Years</button>
                                    </p>
                                    @php $rating = App\Rating::where('userdetail_id',$val->id)->avg('rating'); @endphp
                                    <p class="similar-text" style="font-size: 15px;">MD in{{$val->department}} at {{$val->landmark_pincode}}</p>
                                    <p class="similar-text" style="font-size: 15px;">Overall {{$val->total_experience}} Years of Experience in {{$val->department}}</p>
                                    <p class="similar-text" style="font-size: 15px;">Public Rating: (<?php  echo number_format((float)$rating, 1, '.', ''); ?>)</p>

                                    <span class="ig-rit">
                                        <a href="{{ url('/doctor/detail/'.urlencode($val->full_name)) }}" class="ig-a">Know More <i class="fa fa-arrow-right"></i></a>

                                    </span>
                                </div>
                            </div>
                            @endforeach		
                            <div class="col-md-12">
                                <a href="" class="btn btn-dlts-view" style="float: right;">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="qna" class="desk-open desk-scroll">
                <div class="container-fluid container-fluid-doc1 cont-doc-fld">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 card card-body card-qs">
                                <div class="row">

                                    <h1 class="question1 qs-ass qs-doc-ans"> View Question & Answer<span class="faq-tt"></span>
                                    </h1>
                                    @foreach($questionAnswar as $answer )
                                    <div class="topic" style="display: none;">
                                        <div class="open">
                                            <h2 class="question">{{$answer->question}}</h2><span class="faq-t"></span>
                                        </div>
                                        <p class="answer">{{$answer->answar}}</p>
                                    </div>
                                    @endforeach

                                    <div class="col-md-12 card card-body p-card wwd-100 wow slideInUp">
                                        <div class="">
                                            <form action="{{url('doctor/detail/questionanswarUpdate')}}" method="post">
                                                @csrf
                                                <input type="text" name="question" class="form-control p-control-card" id="myInput" onclick="openSubmitButton1()" placeholder="Add Your Question ?">
                                                <div class="file-upload-doc" id="uploaded" style="display: none;">
                                                    <label for="upload" class="file-upload__label-doc"><i class="fa fa-upload"></i>
                                                        Upload</label>
                                                    <input id="upload" class="file-upload__input-doc" type="file" name="file-upload">
                                                </div>
                                                <button type="submit" id="submitButton1" name="" class="btn btn-primary pri-share" value="Submit" style="display: none;">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    </main>
</div>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
                <form action="" method="post" id="formsubmedititopt">
                    @csrf
                    <div class="card card-body otp-card " id="newotpCard" style="display: none;">
                        <div class="verification-code">
                            <label class="control-label">Enter the OTP</label>
                            <div class="verification-code--inputs">
                                <input type="text"  style="width: 283px;" name="otp"/>
                            </div>
                            <input type="hidden" id="verificationeditCode" name="editverifyCode" value=""/>
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
<!--get in touch modal end-->
<div class="modal fade" id="myModaldelete" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="background-color: #fff0;box-shadow: 0 5px 15px rgb(0 0 0 / 0%);border: none !important;">
        <div class="modal-body">
          <img src="{{ url($data->profile_picture)}}" style="height: 430px;
          width: 100%;
          margin-top: 35px;">
         
        </div>
      </div>
    </div>
  </div>
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
    function openSubmitButton2() {
    // Show the file input and submit button
    document.getElementById("uploaded1").style.display = "block";
    document.getElementById("submitButton2").style.display = "block";
    }
    function openSubmitButton1() {
    // Show the file input and submit button
    document.getElementById("uploaded").style.display = "block";
    document.getElementById("submitButton1").style.display = "block";
    }

    $(document).ready(function () {
      // Toggle FAQ topics when clicking the FAQ header
      $(".question1").click(function () {
        $(".topic").slideToggle(200);

      });
    });
    $('.getin-tochOtp').click( function(){
        var id= $(this).data('id');
        $(".modal-body #verificationeditCode").val(id);
    });
    $("#editsubmit_data").click(function(e){
        e.preventDefault();
        let form =$(this).closest('#getintochformedit');
        let name=form.find("input[name=name]").val();
        let email=form.find("input[name=email]").val();
        let mobile=form.find("input[name=mobile]").val();
        let _token =$("meta[name='csrf-token']").attr('content');
        //alert(token);
        let url = form.attr('action');
        $.ajax({
            type:"POST",
            url:url,
            data:{
            name:name,
            email:email,
            mobile :mobile,
            _token: _token,
             },
             FormElement:form,
             success: function(data){
                $("#myModal").modal('show');
                alert("Form Submited Successfully"); 
             }
        });
    });
    $(".open").click(function () {
      var container = $(this).parents(".topic");
      var answer = container.find(".answer");
      var trigger = container.find(".faq-t");

      answer.slideToggle(200);

      if (trigger.hasClass("faq-o")) {
        trigger.removeClass("faq-o");
      } else {
        trigger.addClass("faq-o");
      }

      if (container.hasClass("expanded")) {
        container.removeClass("expanded");
      } else {
        container.addClass("expanded");
      }
    });
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
                if (response.success == true) { // if true (1)
                    window.location.reload();
                }
            }

        });
        // }else{

        //     alert('form unsubmit');

        // }
    });
</script>
<script>
    function updateCountdown() {
      const countdownElement = document.getElementById('countdown9');
      const daysElement = document.getElementById('days9');
      const hoursElement = document.getElementById('hours9');
      const minutesElement = document.getElementById('minutes9');
      const secondsElement = document.getElementById('seconds9');

      // Get the stored timestamp or set a new one if it doesn't exist
      let startTime = localStorage.getItem('countdownStartTime');
      if (!startTime) {
        // Start the countdown from 15 days (15 days * 24 hours * 60 minutes * 60 seconds * 1000 milliseconds)
        startTime = new Date().getTime() + (15 * 24 * 60 * 60 * 1000);
        localStorage.setItem('countdownStartTime', startTime);
      }

      // Calculate remaining time
      const currentTime = new Date().getTime();
      const remainingTime = startTime - currentTime;

      if (remainingTime <= 0) {
        // Countdown has finished, reset the timer
        localStorage.setItem('countdownStartTime', currentTime + (15 * 24 * 60 * 60 * 1000));
        startTime = currentTime + (15 * 24 * 60 * 60 * 1000);
      }

      const days = Math.floor(remainingTime / (24 * 60 * 60 * 1000));
      const hours = Math.floor((remainingTime % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
      const minutes = Math.floor((remainingTime % (60 * 60 * 1000)) / (60 * 1000));
      const seconds = Math.floor((remainingTime % (60 * 1000)) / 1000);

      daysElement.textContent = days.toString().padStart(2, '0');
      hoursElement.textContent = hours.toString().padStart(2, '0');
      minutesElement.textContent = minutes.toString().padStart(2, '0');
      secondsElement.textContent = seconds.toString().padStart(2, '0');
    }

    // Initial update
    updateCountdown();

    // Update the countdown every second
    setInterval(updateCountdown, 1000);
  </script>

<script>
  function updateCountdown() {
    const countdownElement = document.getElementById('countdown95');
    const daysElement = document.getElementById('days95');
    const hoursElement = document.getElementById('hours95');
    const minutesElement = document.getElementById('minutes95');
    const secondsElement = document.getElementById('seconds95');

    // Get the stored timestamp or set a new one if it doesn't exist
    let startTime = localStorage.getItem('countdownStartTime5');
    if (!startTime) {
      // Start the countdown from 15 days (15 days * 24 hours * 60 minutes * 60 seconds * 1000 milliseconds)
      startTime = new Date().getTime() + (15 * 24 * 60 * 60 * 1000);
      localStorage.setItem('countdownStartTime5', startTime);
    }

    // Calculate remaining time
    const currentTime = new Date().getTime();
    const remainingTime = startTime - currentTime;

    if (remainingTime <= 0) {
      // Countdown has finished, reset the timer
      localStorage.setItem('countdownStartTime5', currentTime + (15 * 24 * 60 * 60 * 1000));
      startTime = currentTime + (15 * 24 * 60 * 60 * 1000);
    }

    const days = Math.floor(remainingTime / (24 * 60 * 60 * 1000));
    const hours = Math.floor((remainingTime % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
    const minutes = Math.floor((remainingTime % (60 * 60 * 1000)) / (60 * 1000));
    const seconds = Math.floor((remainingTime % (60 * 1000)) / 1000);

    daysElement.textContent = days.toString().padStart(2, '0');
    hoursElement.textContent = hours.toString().padStart(2, '0');
    minutesElement.textContent = minutes.toString().padStart(2, '0');
    secondsElement.textContent = seconds.toString().padStart(2, '0');
  }

  // Initial update
  updateCountdown();

  // Update the countdown every second
  setInterval(updateCountdown, 1000);
</script>
@endpush