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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="text-center wow fadeInDown">
                        <h2 class="center mb30">Doctor Listings</h2>
                    </div>
                    <div class="card mb20 search-filter">
                        <div class="card-header bg-secondary text-white"><strong><i class="fas fa-sort"></i> Advance Search</strong>
                            <span id="filter-btn"><i class="fas fa-bars"></i></span>
                        </div>
                        <div class="card-body" id="filter-content">
                            <form method="GET" action="">
                                <div class="form-group">
                                    <label for="id1">Name</label>
                                    <input class="form-control" type="text" id="id1" name="name" placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <label for="id2">Experience</label>
                                    <input class="form-control" type="text" id="id2" name="experience" placeholder="Enter Experience">
                                </div>
                                <div class="form-group">
                                    <label for="id2">Department</label>
                                    <input class="form-control" type="text" id="id2" name="department" placeholder="Enter Department">
                                </div>

                                <div class="mx-auto">
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                    <a href="" class="btn btn-secondary">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="assistant-box-container slider">
                <div class="">
                    <div class="row row-doclistmob">
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
                        <div class="col-xs-12 col-sm-6 col-md-4 title">
                            <div class="card card-body card-card">
                                <div class="col-md-12 list-mob-12 back-color-card">
                                    <div class="row row-doclistmob">
                                        <div class="col-md-6 col-6">
                                            <p class="list-rating">Experience: {{ @$val->total_experience }} Years</p>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <?php 
                                            $ratings = App\Rating::where('userdetail_id',$val->id)->avg('rating');
                                            $rating = App\Rating::where('userdetail_id',$val->id)->avg('rating');
                                            ?>
                                            <p class="list-rating list-rating-list-doc">Rating:
                                            <a @if(Session::get('userId')) @else href="javascript:confirm('hello world')" data-toggle="modal" data-target="#staticBackdrop" @endif>
                                            @if(!$ratings)  @elseif($ratings=floatval($ratings)) @endif
                                            @foreach(range(1,5) as $i)
                                                <span class="fa-stack" style="width:1em">
                                                    <i class="far fa-stack-1x"><img src="{{ url('/doctor/g-star.png') }}" alt="" class="list-star"></i>
                                                    @if($ratings >0)
                                                    @if($ratings >0.5)
                                                    <i class="fas  fa-stack-1x"><img src="{{ url('/doctor/yl-star.png') }}" alt="" class="list-star"></i>
                                                    @else
                                                    <i class="fas fa-star-half fa-stack-1x" style="color: #ff9b00;"></i>
                                                    @endif
                                                    @endif
                                                    @php $ratings--;  @endphp 
                                                </span>
                                                @endforeach
                                            </a>(<?php  echo number_format((float)$rating, 1, '.', ''); ?>)
                                             <!-- <img src="{{ url('/doctor/yl-star.png') }}" alt="" class="list-star">
                                                <img src="{{ url('/doctor/yl-star.png') }}" alt="" class="list-star">
                                                <img src="{{ url('/doctor/g-star.png') }}" alt="" class="list-star">   -->
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 list-mob-12 mtb-44">
                                    <div class="row row-doclistmob">
                                        <div class="col-md-1 col-1 mt-18">
                                            <div class="card card-body list-card">
                                                <img src="{{ url('/doctor/dtlts-doc1.jpg') }}" alt="" class="list-pro" style="border-radius: 50%;">
                                                <p class="doc-prime">Prime <img src="{{ url('/doctor/doctor-check.png') }}" alt="" class="list-in-mob-img1"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-10 mrtt-10">
                                            <div class="card card-body list-icon">
                                                <p class="list-doc" style="font-size: 15px !important;width: 250px"><img src="{{ url('/doctor/h-docname.png') }}" alt="" class="list-mob-img">&nbsp;{{ucwords($val->full_name)}}
                                                    <img src="{{ url('/doctor/verify.png') }}" alt="" class="list-veri">
                                                </p>
                                                <p class="list-doc" style="font-weight: 600;"><img src="{{ url('/doctor/expertise.png') }}" alt="" class="list-mob-img">&nbsp;{{ucwords($val->department)}}</p>
                                                <p class="list-doc" style="font-weight: 600;"><img src="{{ url('/doctor/first-aid-kit.png') }}" alt="" class="list-mob-img">&nbsp; MD at
                                                {{ ucwords($val->department) }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12  list-mob-12 mrt-10">
                                    <div class="row row-doclistmob">
                                        <div class="col-md-7 col-7">
                                            <p class="list-in-mob" style="font-weight: 800;"><img src="{{ url('/doctor/h-hoscamp.png') }}" alt="" class="list-mob-img"> Work Location</p>
                                            <p class="list-doc-list">{{ ucwords($val->location) }}, {{ ($val->landmark_pincode) }}</p>
                                        </div>
                                        <div class="col-md-5 col-5">
                                            <p class="list-in-mob" style="font-weight: 800;margin-left: -12px;"><img src="{{ url('/doctor/rupee.png') }}" alt="" class="list-mob-img" style="width: 12px;margin-left: -38px;"> Private Consult Fee</p>
                                            <p class="list-doc-list list-doc-rupee" style="margin-left: -48px;"><i class="fa fa-rupee"></i>
                                            {{ ($val->consul_fee_from) }} - <i class="fa fa-rupee"></i> {{ ($val->consul_fee_to) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 list-mob-12">
                                    <a href="{{ url('/doctor/detail/'.urlencode($val->full_name)) }}" class=" bt-dan" name="">View Details <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-6 col-md-4 title">
                            <div class="card card-body card-card">
                                <div class="col-md-12 list-mob-12 back-color-card">
                                    <div class="row row-doclistmob">
                                        <div class="col-md-6 col-6">
                                            <p class="list-rating">Experience: 20 Years</p>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <p class="list-rating list-rating-list-doc">Rating: <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                                <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                                <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                                <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                                <img src="../assets/image/g-star.png" alt="" class="list-star"> (4.7)
                                            </p>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12 list-mob-12 mtb-44">
                                    <div class="row row-doclistmob">
                                        <div class="col-md-1 col-1 mt-18">
                                            <div class="card card-body list-card">
                                                <img src="../assets/image/senario/dtlts-doc1.jpg" alt="" class="list-pro" style="border-radius: 50%;">
                                                <p class="doc-gold">Gold <img src="../assets/image/senario/doctor-check.png" alt="" class="list-in-mob-img1"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-10 mrtt-10">
                                            <div class="card card-body list-icon">
                                                <p class="list-doc" style="font-size: 15px !important;width: 250px"><img src="../assets/img/h-docname.png" alt="" class="list-mob-img">&nbsp; Dr. Rabindra Kumar
                                                    Das
                                                    <img src="../assets/image/senario/blue-tick.png" alt="" class="list-veri">
                                                </p>
                                                <p class="list-doc" style="font-weight: 600;"><img src="../assets/image/senario/expertise.png" alt="" class="list-mob-img">&nbsp; Laparoscopic Surgeon</p>
                                                <p class="list-doc" style="font-weight: 600;"><img src="../assets/image/senario/first-aid-kit.png" alt="" class="list-mob-img">&nbsp; MD at
                                                    SCB Medical Cuttack
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 list-mob-12 mrt-10">
                                    <div class="row row-doclistmob">
                                        <div class="col-md-7 col-7">
                                            <p class="list-in-mob" style="font-weight: 800;"><img src="../assets/img/h-hoscamp.png" alt="" class="list-mob-img"> Work Location</p>
                                            <p class="list-doc-list">Badambadi, Cuttack 754001</p>

                                        </div>
                                        <div class="col-md-5 col-5">
                                            <p class="list-in-mob" style="font-weight: 800;margin-left: -12px;"><img src="../assets/image/senario/rupee.png" alt="" class="list-mob-img" style="width: 12px;margin-left: -38px;"> Private Consult Fee</p>
                                            <p class="list-doc-list list-doc-rupee" style="margin-left: -48px;"><i class="fa fa-rupee"></i>
                                                300 - <i class="fa fa-rupee"></i> 400</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 list-mob-12">
                                    <a href="doctor-details.html" class=" bt-dan" name="">View Details <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-xs-12 col-sm-6 col-md-4 title">
                        <div class="card card-body card-card">
                            <div class="col-md-12 list-mob-12 back-color-card">
                                <div class="row row-doclistmob">
                                    <div class="col-md-6 col-6">
                                        <p class="list-rating">Experience: 20 Years</p>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <p class="list-rating list-rating-list-doc">Rating: <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                            <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                            <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                            <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                            <img src="../assets/image/g-star.png" alt="" class="list-star"> (4.7)
                                        </p>

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 list-mob-12 mtb-44">
                                <div class="row row-doclistmob">
                                    <div class="col-md-1 col-1 mt-18">
                                        <div class="card card-body list-card">
                                            <img src="../assets/image/senario/dtlts-doc1.jpg" alt="" class="list-pro" style="border-radius: 50%;">
                                            <p class="doc-silver">Silver <img src="../assets/image/senario/doctor-check.png" alt="" class="list-in-mob-img1"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-10 mrtt-10">
                                        <div class="card card-body list-icon">
                                            <p class="list-doc" style="font-size: 15px !important;width: 250px"><img src="../assets/img/h-docname.png" alt="" class="list-mob-img">&nbsp; Dr. Rabindra Kumar
                                                Das
                                                <img src="../assets/image/senario/blue-tick.png" alt="" class="list-veri">
                                            </p>
                                            <p class="list-doc" style="font-weight: 600;"><img src="../assets/image/senario/expertise.png" alt="" class="list-mob-img">&nbsp; Laparoscopic Surgeon</p>
                                            <p class="list-doc" style="font-weight: 600;"><img src="../assets/image/senario/first-aid-kit.png" alt="" class="list-mob-img">&nbsp; MD at
                                                SCB Medical Cuttack
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 list-mob-12 mrt-10">
                                <div class="row row-doclistmob">
                                    <div class="col-md-7 col-7">
                                        <p class="list-in-mob" style="font-weight: 800;"><img src="../assets/img/h-hoscamp.png" alt="" class="list-mob-img"> Work Location</p>
                                        <p class="list-doc-list">Badambadi, Cuttack 754001</p>

                                    </div>
                                    <div class="col-md-5 col-5">
                                        <p class="list-in-mob" style="font-weight: 800;margin-left: -12px;"><img src="../assets/image/senario/rupee.png" alt="" class="list-mob-img" style="width: 12px;margin-left: -38px;"> Private Consult Fee</p>
                                        <p class="list-doc-list list-doc-rupee" style="margin-left: -48px;"><i class="fa fa-rupee"></i>
                                            300 - <i class="fa fa-rupee"></i> 400</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 list-mob-12">
                                <a href="doctor-details.html" class=" bt-dan" name="">View Details <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div> -->
                        <!-- <div class="col-xs-12 col-sm-6 col-md-4 title">
                        <div class="card card-body card-card">
                            <div class="col-md-12 list-mob-12 back-color-card">
                                <div class="row row-doclistmob">
                                    <div class="col-md-6 col-6">
                                        <p class="list-rating">Experience: 20 Years</p>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <p class="list-rating list-rating-list-doc">Rating: <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                            <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                            <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                            <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                            <img src="../assets/image/g-star.png" alt="" class="list-star"> (4.7)
                                        </p>

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 list-mob-12 mtb-44">
                                <div class="row row-doclistmob">
                                    <div class="col-md-1 col-1 mt-18">
                                        <div class="card card-body list-card">
                                            <img src="../assets/image/senario/dtlts-doc1.jpg" alt="" class="list-pro" style="border-radius: 50%;">
                                            <p class="doc-general">General <img src="../assets/image/senario/doctor-check.png" alt="" class="list-in-mob-img1"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-10 mrtt-10">
                                        <div class="card card-body list-icon">
                                            <p class="list-doc" style="font-size: 15px !important;width: 250px"><img src="../assets/img/h-docname.png" alt="" class="list-mob-img">&nbsp; Dr. Rabindra Kumar
                                                Das
                                                <img src="../assets/image/senario/blue-tick.png" alt="" class="list-veri">
                                            </p>
                                            <p class="list-doc" style="font-weight: 600;"><img src="../assets/image/senario/expertise.png" alt="" class="list-mob-img">&nbsp; Laparoscopic Surgeon</p>
                                            <p class="list-doc" style="font-weight: 600;"><img src="../assets/image/senario/first-aid-kit.png" alt="" class="list-mob-img">&nbsp; MD at
                                                SCB Medical Cuttack
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 list-mob-12 mrt-10">
                                <div class="row row-doclistmob">
                                    <div class="col-md-7 col-7">
                                        <p class="list-in-mob" style="font-weight: 800;"><img src="../assets/img/h-hoscamp.png" alt="" class="list-mob-img"> Work Location</p>
                                        <p class="list-doc-list">Badambadi, Cuttack 754001</p>

                                    </div>
                                    <div class="col-md-5 col-5">
                                        <p class="list-in-mob" style="font-weight: 800;margin-left: -12px;"><img src="../assets/image/senario/rupee.png" alt="" class="list-mob-img" style="width: 12px;margin-left: -38px;"> Private Consult Fee</p>
                                        <p class="list-doc-list list-doc-rupee" style="margin-left: -48px;"><i class="fa fa-rupee"></i>
                                            300 - <i class="fa fa-rupee"></i> 400</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 list-mob-12">
                                <a href="doctor-details.html" class=" bt-dan" name="">View Details <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div> -->
                        <!-- <div class="col-xs-12 col-sm-6 col-md-4 title">
                        <div class="card card-body card-card">
                            <div class="col-md-12 list-mob-12 back-color-card">
                                <div class="row row-doclistmob">
                                    <div class="col-md-6 col-6">
                                        <p class="list-rating">Experience: 20 Years</p>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <p class="list-rating list-rating-list-doc">Rating: <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                            <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                            <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                            <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                            <img src="../assets/image/g-star.png" alt="" class="list-star"> (4.7)
                                        </p>

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 list-mob-12 mtb-44">
                                <div class="row row-doclistmob">
                                    <div class="col-md-1 col-1 mt-18">
                                        <div class="card card-body list-card">
                                            <img src="../assets/image/senario/dtlts-doc1.jpg" alt="" class="list-pro" style="border-radius: 50%;">
                                            <p class="doc-general">General <img src="../assets/image/senario/doctor-check.png" alt="" class="list-in-mob-img1"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-10 mrtt-10">
                                        <div class="card card-body list-icon">
                                            <p class="list-doc" style="font-size: 15px !important;width: 250px"><img src="../assets/img/h-docname.png" alt="" class="list-mob-img">&nbsp; Dr. Rabindra Kumar
                                                Das
                                                <img src="../assets/image/senario/blue-tick.png" alt="" class="list-veri">
                                            </p>
                                            <p class="list-doc" style="font-weight: 600;"><img src="../assets/image/senario/expertise.png" alt="" class="list-mob-img">&nbsp; Laparoscopic Surgeon</p>
                                            <p class="list-doc" style="font-weight: 600;"><img src="../assets/image/senario/first-aid-kit.png" alt="" class="list-mob-img">&nbsp; MD at
                                                SCB Medical Cuttack
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 list-mob-12 mrt-10">
                                <div class="row row-doclistmob">
                                    <div class="col-md-7 col-7">
                                        <p class="list-in-mob" style="font-weight: 800;"><img src="../assets/img/h-hoscamp.png" alt="" class="list-mob-img"> Work Location</p>
                                        <p class="list-doc-list">Badambadi, Cuttack 754001</p>

                                    </div>
                                    <div class="col-md-5 col-5">
                                        <p class="list-in-mob" style="font-weight: 800;margin-left: -12px;"><img src="../assets/image/senario/rupee.png" alt="" class="list-mob-img" style="width: 12px;margin-left: -38px;"> Private Consult Fee</p>
                                        <p class="list-doc-list list-doc-rupee" style="margin-left: -48px;"><i class="fa fa-rupee"></i>
                                            300 - <i class="fa fa-rupee"></i> 400</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 list-mob-12">
                                <a href="doctor-details.html" class=" bt-dan" name="">View Details <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div> -->
                        <!--ten card end-->
                        @endforeach
                    @else
                    <h1>Sorry, no results found!</h1>
                    @endif  
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <div class="pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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