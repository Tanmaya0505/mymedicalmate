@extends('frontend-source.layouts.master')
@section('title') Listing Assistant @stop
@section('keywords') Listing Assistant @stop
@section('description') Listing Assistant @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/css/style.css')}}">
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
                <div class="row">
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
                    <!-- <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="box-item">
                            <table>
                                <tr class="hl-header">
                                    <td style="width:40%;" class="text-left">
                                        <span class="verified">Doctor <i class="fas fa-check-circle"></i></span>
                                    </td>
                                    <td style="width:70%;" class="text-right" class="pickup">

                                    </td>
                                </tr>
                                <tr class="ast-bx-flex">
                                    <td class="ast-img">
                                        <div class="item-image">
                                            <a href="{{ url('/doctor/detail/'.urlencode($val->full_name)) }}">
                                                <img src="{{ $photo }}" class="img-fluid" alt="">
                                            </a>
                                            <span>Exp: {{ @$val->total_experience }} Yrs</span>
                                        </div>
                                    </td>
                                    <td class="ast-dtl">
                                        <div class="item-detail">
                                            <ul>
                                                <li>Full Name: <Strong>{{ ucwords($val->full_name) }}</Strong></li>
                                                <li>Department: <Strong>{{ $val->department }}</Strong></li>
                                                <li>Designation: <Strong>{{ $val->designation }}</Strong></li>
                                                <li>Location: <Strong>{{ $val->location }}</Strong></li>
                                                <li>Rating: <Strong>{{ $val->star_ratings }}</Strong></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">

                                        <a class="primary-btn" href="#">Share</a>

                                    </td>
                                    <td class="text-right">
                                        <a href="{{ url('/doctor/detail/'.urlencode($val->full_name)) }}" class="primary-btn">View Details</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div> -->
                    <div class="col-xs-12 col-sm-6 col-md-4 title">
                        <div class="card card-body card-card">
                            <div class="col-md-12 back-color-card">
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <?php $rating = App\Rating::where('userdetail_id',$val->id)->avg('rating'); ?>
                                        <p class="list-rating">Rating: <img src="../assets/image/yl-star.png" alt="" class="list-star">
                                        (<?php echo number_format((float)$rating, 1, '.', ''); ?>)
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
                                        </p>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <p class="list-rating">Experience: {{ @$val->total_experience }} Years</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mtb-44">
                                <div class="row">
                                    <div class="col-md-1 col-1 mt-18">
                                        <div class="card card-body list-card">
                                            <img src="{{ url('/doctor/doctor1.png') }}" alt="" class="list-pro">
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-10 mrtt-10">
                                        <div class="card card-body list-icon">
                                            <p class="list-doc"><i class="fa fa-stethoscope fa-icon"></i>&nbsp; {{ ucwords($val->full_name) }}
                                                <img src="{{ url('/doctor/verify.png') }}" alt="" class="list-veri">
                                            </p>
                                            <p class="list-doc"><i class="fa fa-user-md fa-icon"></i>&nbsp; Specialised in {{ ucwords($val->designation) }}</p>
                                            <p class="list-doc"><i class="fa fa-hospital-o fa-icon"></i>&nbsp;  {{ ucwords($val->department) }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-2 col-2">
                                <a href="" class="btn btn-danger bt-dan" name="">View Details</a>
                                </div> -->

                                </div>
                            </div>
                            <div class="col-md-12 mrt-10">
                                <div class="row">
                                    <div class="col-md-7 col-7">
                                        <p class="list-doc-list" style="font-weight: 700;"><i class="fa fa-map-marker icon-mark" aria-hidden="true"></i> Work Location</p>
                                        <p class="list-doc-list">{{ ucwords($val->location) }} {{ ($val->landmark_pincode) }}</p>

                                    </div>
                                    <div class="col-md-5 col-5">
                                        <p class="list-doc-list" style="font-weight: 700;"><i class="fa fa-inr icon-mark" aria-hidden="true"></i> Consult Fee</p>
                                        <p class="list-doc-list list-doc-rupee"><i class="fa fa-rupee"></i>{{ ($val->consul_fee_from) }} - <i class="fa fa-rupee"></i>{{ ($val->consul_fee_to) }}</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ url('/doctor/detail/'.urlencode($val->full_name)) }}" class=" bt-dan" name="">View Details <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <h1>Sorry, no results found!</h1>
                    @endif

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