@extends('frontend-source.layouts.master')
@section('title') Listing Assistant @stop
@section('keywords') Listing Assistant @stop
@section('description') Listing Assistant @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/doctorlistcss/style.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    @media(max-width: 768px) {
        #hero {
            width: 100%;
            background-color: rgb(255 255 255 / 80%);
            overflow: hidden;
            position: relative;
            margin-top: 60px !important;
        }

        .col-md-12 {
            padding-right: 12px !important;
            padding-left: 15px !important;

        }

        .container-fluid {
            padding: 0px 1px;
        }

        .row {
            margin-right: -44px;
        }
    }

    .row {
        margin-right: -40px;
    }

    .col-md-12 {
        padding-right: 14px;
        padding-left: 15px;

    }

    #hero {
        width: 100%;
        background-color: rgb(255 255 255 / 80%);
        overflow: hidden;
        position: relative;
        margin-top: 80px;
    }
</style>
@endsection
@section('content')
<link href="../assets/css/style.css" rel="stylesheet">
<div class="">
<main id="main">

<!-- ======= Hero Section ======= -->

<section class="hero-list2">
  <div class="container-fluid container-fluid-doc-list">
    <div class="col-md-12 doc-list-colmd-12" style="padding-right: 0px;width: 101%;">
      <input type="text" name="" class="form-control search-control-list" placeholder="What you are looking for?">
      <img src="{{ url('/doctor/adv-search.png') }}"
        style="width: 35px;float: right;z-index: 2;position: sticky;margin-top: 5px;margin-right: 20px;">
    </div>
    <div class="col-md-12 doc-list-colmd-12">

      <div class="row row-doc-list">
        <div class="col-md-3 ">
          <div class="card card-body doc-list-card3">
            <p class="doc-list-txt2">Quick Search</p>
            <div class="form-control doc-list-card4 check-list">
              <input type="checkbox" name="">
              <p class="search-list-txt">Cardiology Doctor</p>
            </div>
            <div class="form-control doc-list-card4 check-list">
              <input type="checkbox" name="">
              <p class="search-list-txt">Orthopedic Doctor</p>
            </div>
            <div class="form-control doc-list-card4 check-list">
              <input type="checkbox" name="">
              <p class="search-list-txt">Surgery Doctors</p>
            </div>
            <div class="form-control doc-list-card4 check-list">
              <input type="checkbox" name="">
              <p class="search-list-txt">Neurologist Doctor</p>
            </div>
            <div class="form-control doc-list-card4 check-list">
              <input type="checkbox" name="">
              <p class="search-list-txt">Gastrologer Doctor</p>
            </div>
            <div class="form-control doc-list-card4 check-list">
              <input type="checkbox" name="">
              <p class="search-list-txt">Neurologist Doctor</p>
            </div>
            <div class="form-control doc-list-card4 check-list">
              <input type="checkbox" name="">
              <p class="search-list-txt">Gastrologer Doctor</p>
            </div>
            <div class="form-control doc-list-card4 check-list">
              <input type="checkbox" name="">
              <p class="search-list-txt">Gastrologer Doctor</p>
            </div>
            <div class="form-control doc-list-card4 check-list">
              <input type="checkbox" name="">
              <p class="search-list-txt">Gastrologer Doctor</p>
            </div>
          </div>
        </div>
        <div class="col-md-9 doctor-list-tab-9" style="margin-top: 62px;padding-left:22px">
        @if(count($data))
        @foreach($data as $key=>$val)
        @php
        $meta = json_decode($val->meta, true);
        $data = \App\Helpers\CustomerHelper::decodeAssistantData($meta);
        $photo = asset('frontend-source/images/assistant-boy-icon.png');
        if($val->profile_picture){
        $photo = url($val->profile_picture);
        }
        @endphp
          <div class="card card-body doc-list-card1">
            <div class="row row-doc-list">
              <div class="col-md-3 col-2 desk-wd-list-3">
                <img src="{{ url('/doctor/real-doc.jpeg') }}" alt="" class="doc-list-img1">
                <div class="card card-body doc-list-card-profile1">
                  <p class="doc-list-card-profile-txt"> Prime &nbsp;<img
                      src="{{ url('/doctor/doctor-check.png') }}" alt="" class="doctor-clasify-list"></p>
                </div>
              </div>
              <div class="col-md-9 col-10">
                <div class="span-hover">
                <?php $rating = App\Rating::where('userdetail_id',$val->id)->avg('rating');
                $ratings = App\Rating::where('userdetail_id',$val->id)->avg('rating'); ?>
                  <p class="doc-list-txt1" style="float: right;">Rating:
                  <a @if(Session::get('userId')) @else href="javascript:confirm('hello world')" data-toggle="modal" data-target="#staticBackdrop" @endif>
                    @if(!$ratings)  @elseif($ratings=floatval($ratings)) @endif
                    @foreach(range(1,5) as $i)
                      <span class="fa-stack" style="width:1em">
                          <i class="far fa-stack-1x"><img src="{{ url('/doctor/g-star.png') }}" alt="" class="list-doc-star-img"></i>
                          @if($ratings >0)
                          @if($ratings >0.5)
                          <i class="fas  fa-stack-1x"><img src="{{ url('/doctor/yl-star.png') }}" alt="" class="list-doc-star-img"></i>
                          @else
                          <i class="fas fa-star-half fa-stack-1x" style="color: #ff9b00;"></i>
                          @endif
                          @endif
                          @php $ratings--;  @endphp 
                      </span>
                      @endforeach
                  </a>(<?php  echo number_format((float)$rating, 1, '.', ''); ?>)
                  </p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/medical-checkup.png') }}" class="doc-list-icon1"
                      alt=""> {{ucwords($val->full_name)}}</p>
                      <p class="doc-list-txt1"><img src="{{ url('/doctor/education.png') }}" class="doc-list-icon1"
                      alt=""> {{ucwords($val->doctorqualification)}}</p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/first-aid-kit.png') }}"
                      class="doc-list-icon1" alt=""> {{ucwords($val->department)}}</p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/expertise.png') }}" class="doc-list-icon1"
                      alt="">{{ucwords($val->total_experience)}} Years’ Experience Overall (5 Years’ experience in Surgery)</p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/hospital-1.png') }}" class="doc-list-icon1"
                      alt=""> {{ucwords($val->landmark_pincode)}}</p>

                  <p style="text-align: right;"><a href="{{ url('/doctor/detail/'.urlencode($val->full_name)) }}" class="btn dtls-effects">Details</a>
                    <a href="" class="btn  notify-effects">
                      Notify
                    </a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        @else
        <h1>Sorry, no results found!</h1>
        @endif 
          <!-- <div class="card card-body doc-list-card1">
            <div class="row row-doc-list">
              <div class="col-md-3 desk-wd-list-3 ">
                <img src="{{ url('/doctor/real-doc.jpeg') }}" alt="" class="doc-list-img1">
                <div class="card card-body doc-list-card-profile2">
                  <p class="doc-list-card-profile-txt"> Gold &nbsp;<img
                      src="{{ url('/doctor/doctor-check.png') }}" alt="" class="doctor-clasify-list"></p>
                </div>
              </div>
              <div class="col-md-9 col-10">
                <div class="span-hover">
                  <p class="doc-list-txt1">
                    <img src="{{ url('/doctor/medical-checkup.png') }}" alt="" class="doc-list-icon1"> Dr. Pratik
                    Das <img src="{{ url('/doctor/blue-tick.png') }}" alt=""
                      style="width:18px;margin-top: -1px;">
                    <span style="float: right;">Ratings
                      <img src="{{ url('/doctor/ty.png') }}" alt="" class="list-doc-star-img">
                      <img src="{{ url('/doctor/ty.png') }}" alt="" class="list-doc-star-img">
                      <img src="{{ url('/doctor/ty.png') }}" alt="" class="list-doc-star-img">
                      <img src="{{ url('/doctor/ty.png') }}" alt="" class="list-doc-star-img">
                      <img src="{{ url('/doctor/tg.png') }}" alt="" class="list-doc-star-img">(4.7)
                    </span>
                  </p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/education.png') }}" class="doc-list-icon1"
                      alt=""> MBBS, MS - General Surgery</p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/first-aid-kit.png') }}"
                      class="doc-list-icon1" alt=""> Laparoscopic Surgeon</p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/expertise.png') }}" class="doc-list-icon1"
                      alt="">20 Years’ Experience Overall (5 Years’ experience in Surgery)</p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/hospital-1.png') }}" class="doc-list-icon1"
                      alt=""> Nayapalli, Bhubaneswar 754001</p>
                  <p style="text-align: right;"><a href="" class="btn dtls-effects">Details</a>
                    <a href="" class="btn  notify-effects">
                      Notify
                    </a>
                  </p>
                </div>
              </div>
            </div>
          </div> -->
          <!-- <div class="card card-body doc-list-card1">
            <div class="row row-doc-list">
              <div class="col-md-3 desk-wd-list-3">
                <img src="{{ url('/doctor/real-doc.jpeg') }}" alt="" class="doc-list-img1">
                <div class="card card-body doc-list-card-profile3">
                  <p class="doc-list-card-profile-txt"> Silver &nbsp;<img
                      src="{{ url('/doctor/doctor-check.png') }}" alt="" class="doctor-clasify-list"></p>
                </div>
              </div>
              <div class="col-md-9 col-10">
                <div class="span-hover">
                  <p class="doc-list-txt1">
                    <img src="{{ url('/doctor/medical-checkup.png') }}" alt="" class="doc-list-icon1"> Dr. Pratik
                    Das <img src="{{ url('/doctor/blue-tick.png') }}" alt=""
                      style="width:18px;margin-top: -1px;">
                    <span style="float: right;">Ratings
                      <img src="{{ url('/doctor/ty.png') }}" alt="" class="list-doc-star-img">
                      <img src="{{ url('/doctor/ty.png') }}" alt="" class="list-doc-star-img">
                      <img src="{{ url('/doctor/ty.png') }}" alt="" class="list-doc-star-img">
                      <img src="{{ url('/doctor/ty.png') }}" alt="" class="list-doc-star-img">
                      <img src="{{ url('/doctor/tg.png') }}" alt="" class="list-doc-star-img">(4.7)
                    </span>
                  </p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/education.png') }}" class="doc-list-icon1"
                      alt=""> MBBS, MS - General Surgery</p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/first-aid-kit.png') }}"
                      class="doc-list-icon1" alt=""> Laparoscopic Surgeon</p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/expertise.png') }}" class="doc-list-icon1"
                      alt="">20 Years’ Experience Overall (5 Years’ experience in Surgery)</p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/hospital-1.png') }}" class="doc-list-icon1"
                      alt=""> Nayapalli, Bhubaneswar 754001</p>
                  <p style="text-align: right;"><a href="" class="btn dtls-effects">Details</a>
                    <a href="" class="btn  notify-effects">
                      Notify
                    </a>
                  </p>
                </div>
              </div>
            </div>
          </div> -->
          <!-- <div class="card card-body doc-list-card1">
            <div class="row row-doc-list">
              <div class="col-md-3 desk-wd-list-3">
                <img src="{{ url('/doctor/real-doc.jpeg') }}" alt="" class="doc-list-img1">
                <div class="card card-body doc-list-card-profile4">
                  <p class="doc-list-card-profile-txt"> General &nbsp;<img
                      src="{{ url('/doctor/doctor-check.png') }}" alt="" class="doctor-clasify-list"></p>
                </div>
              </div>
              <div class="col-md-9 col-10">
                <div class="span-hover">
                  <p class="doc-list-txt1">
                    <img src="{{ url('/doctor/medical-checkup.png') }}" alt="" class="doc-list-icon1"> Dr. Pratik
                    Das <img src="{{ url('/doctor/blue-tick.png') }}" alt=""
                      style="width:18px;margin-top: -1px;">
                    <span style="float: right;">Ratings
                      <img src="{{ url('/doctor/ty.png') }}" alt="" class="list-doc-star-img">
                      <img src="{{ url('/doctor/ty.png') }}" alt="" class="list-doc-star-img">
                      <img src="{{ url('/doctor/ty.png') }}" alt="" class="list-doc-star-img">
                      <img src="{{ url('/doctor/ty.png') }}" alt="" class="list-doc-star-img">
                      <img src="{{ url('/doctor/tg.png') }}" alt="" class="list-doc-star-img">(4.7)
                    </span>
                  </p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/education.png') }}" class="doc-list-icon1"
                      alt=""> MBBS, MS - General Surgery</p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/first-aid-kit.png') }}"
                      class="doc-list-icon1" alt=""> Laparoscopic Surgeon</p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/expertise.png') }}" class="doc-list-icon1"
                      alt="">20 Years’ Experience Overall (5 Years’ experience in Surgery)</p>
                  <p class="doc-list-txt1"><img src="{{ url('/doctor/hospital-1.png') }}" class="doc-list-icon1"
                      alt=""> Nayapalli, Bhubaneswar 754001</p>
                  <p style="text-align: right;"><a href="" class="btn dtls-effects">Details</a>
                    <a href="" class="btn  notify-effects">
                      Notify
                    </a>
                  </p>
                </div>
              </div>

            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
  </div>
</section><!-- End Hero -->


</main>
</div>
@endsection
@push('script')
<script src="{{ asset('frontend-source/js/medical-mate.js') }}" type="text/javascript"></script>
<script>
    $("#filter-btn").click(function() {
        $('#filter-content').slideToggle();
    });
</script>
<script>
    //doctor list pagination start
    var items = document.querySelectorAll('.title');
    var itemsPerPage = 6;
    var currentPage = 1;

    function displayItems(page) {
        var startIndex = (page - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;

        for (var i = 0; i < items.length; i++) {
            if (i >= startIndex && i < endIndex) {
                items[i].style.display = 'block';
            } else {
                items[i].style.display = 'none';
            }
        }
    }

    function setupPagination() {
        var totalPages = Math.ceil(items.length / itemsPerPage);
        var paginationDiv = document.querySelector('.pagination');
        paginationDiv.innerHTML = '';

        for (var i = 1; i <= totalPages; i++) {
            var link = document.createElement('a');
            link.href = '#';
            link.textContent = i;

            if (i === currentPage) {
                link.classList.add('active');
            }

            link.addEventListener('click', function(e) {
                e.preventDefault();
                currentPage = parseInt(e.target.textContent);
                displayItems(currentPage);
                setupPagination();
            });

            paginationDiv.appendChild(link);
        }
    }

    displayItems(currentPage);
    setupPagination();
    //doctor list pagination end
</script>
@endpush