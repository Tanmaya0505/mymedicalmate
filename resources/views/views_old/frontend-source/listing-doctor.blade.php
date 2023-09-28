@extends('frontend-source.layouts.master')
@section('title') Upload prescription @stop
@section('keywords') Upload prescription @stop
@section('description') Upload prescription @stop
@section('style')
@endsection
@section('content')
<div class="hero text-center">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('frontend-source/images/hero1.jpg') }}" class="img-fluid">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('frontend-source/images/hero2.jpg') }}" class="img-fluid">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('frontend-source/images/hero3.jpg') }}" class="img-fluid">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <section class="listing-section">
            <div class="container">
                <div class="listing-block">
                    <div class="row">
                        <div class="col-3"><div class="listing-img"><img src="{{ asset('frontend-source/images/d1.jpg') }}" class="img-fluid" alt=""></div></div>
                        <div class="col-7">
                            <div class="listing-content">
                                <strong>Dr. D N Mohanty</strong><br>
                                MD, SCB Medical, Cuttack<br>
                                <strong>Depart: </strong> Cardiology, medicines<br>
                                <i class="fa fa-map-marker"></i> Mangalabag, Cuttack - 754001<br>
                                <strong>Available: </strong><span>Mon</span><span>Wed</span><span>Fri</span><span>Sun</span><br>
                                <strong>Time: </strong>8:30 AM to 8.30 PM<br>
                                <strong>Rating: </strong>5
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="exp-box">14 Years Exp</div>
                        </div>
                        <div class="col-12 btn-section">
                            <a href="#" class="btn-stroke">Share</a>
                            <a href="{{ url('/profile-doctor') }}" class="btn-stroke">Know More</a>
                            <a href="{{ url('/profile-doctor') }}" class="btn-stroke blue">Consult Now</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>

                <div class="listing-block">
                    <div class="row">
                        <div class="col-3"><div class="listing-img"><img src="{{ asset('frontend-source/images/d2.jpg') }}" class="img-fluid" alt=""></div></div>
                        <div class="col-7">
                            <div class="listing-content">
                                <strong>Dr. D N Mohanty</strong><br>
                                MD, SCB Medical, Cuttack<br>
                                <strong>Depart: </strong> Cardiology, medicines<br>
                                <i class="fa fa-map-marker"></i> Mangalabag, Cuttack - 754001<br>
                                <strong>Available: </strong><span>Mon</span><span>Wed</span><span>Fri</span><span>Sun</span><br>
                                <strong>Time: </strong>8:30 AM to 8.30 PM<br>
                                <strong>Rating: </strong>5
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="exp-box">14 Years Exp</div>
                        </div>
                        <div class="col-12 btn-section">
                            <a href="#" class="btn-stroke">Share</a>
                            <a href="{{ url('/profile-doctor') }}" class="btn-stroke">Know More</a>
                            <a href="{{ url('/profile-doctor') }}" class="btn-stroke blue">Consult Now</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>

                <div class="listing-block">
                    <div class="row">
                        <div class="col-3"><div class="listing-img"><img src="{{ asset('frontend-source/images/d3.jpg') }}" class="img-fluid" alt=""></div></div>
                        <div class="col-7">
                            <div class="listing-content">
                                <strong>Dr. D N Mohanty</strong><br>
                                MD, SCB Medical, Cuttack<br>
                                <strong>Depart: </strong> Cardiology, medicines<br>
                                <i class="fa fa-map-marker"></i> Mangalabag, Cuttack - 754001<br>
                                <strong>Available: </strong><span>Mon</span><span>Wed</span><span>Fri</span><span>Sun</span><br>
                                <strong>Time: </strong>8:30 AM to 8.30 PM<br>
                                <strong>Rating: </strong>5
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="exp-box">14 Years Exp</div>
                        </div>
                        <div class="col-12 btn-section">
                            <a href="#" class="btn-stroke">Share</a>
                            <a href="{{ url('/profile-doctor') }}" class="btn-stroke">Know More</a>
                            <a href="{{ url('/profile-doctor') }}" class="btn-stroke blue">Consult Now</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
                <div class="listing-block">
                    <div class="row">
                        <div class="col-3"><div class="listing-img"><img src="{{ asset('frontend-source/images/d1.jpg') }}" class="img-fluid" alt=""></div></div>
                        <div class="col-7">
                            <div class="listing-content">
                                <strong>Dr. D N Mohanty</strong><br>
                                MD, SCB Medical, Cuttack<br>
                                <strong>Depart: </strong> Cardiology, medicines<br>
                                <i class="fa fa-map-marker"></i> Mangalabag, Cuttack - 754001<br>
                                <strong>Available: </strong><span>Mon</span><span>Wed</span><span>Fri</span><span>Sun</span><br>
                                <strong>Time: </strong>8:30 AM to 8.30 PM<br>
                                <strong>Rating: </strong>5
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="exp-box">14 Years Exp</div>
                        </div>
                        <div class="col-12 btn-section">
                            <a href="#" class="btn-stroke">Share</a>
                            <a href="{{ url('/profile-doctor') }}" class="btn-stroke">Know More</a>
                            <a href="{{ url('/profile-doctor') }}" class="btn-stroke blue">Consult Now</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>

                <div class="listing-block">
                    <div class="row">
                        <div class="col-3"><div class="listing-img"><img src="{{ asset('frontend-source/images/d2.jpg') }}" class="img-fluid" alt=""></div></div>
                        <div class="col-7">
                            <div class="listing-content">
                                <strong>Dr. D N Mohanty</strong><br>
                                MD, SCB Medical, Cuttack<br>
                                <strong>Depart: </strong> Cardiology, medicines<br>
                                <i class="fa fa-map-marker"></i> Mangalabag, Cuttack - 754001<br>
                                <strong>Available: </strong><span>Mon</span><span>Wed</span><span>Fri</span><span>Sun</span><br>
                                <strong>Time: </strong>8:30 AM to 8.30 PM<br>
                                <strong>Rating: </strong>5
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="exp-box">14 Years Exp</div>
                        </div>
                        <div class="col-12 btn-section">
                            <a href="#" class="btn-stroke">Share</a>
                            <a href="{{ url('/profile-doctor') }}" class="btn-stroke">Know More</a>
                            <a href="{{ url('/profile-doctor') }}" class="btn-stroke blue">Consult Now</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="listing-block">
                    <div class="row">
                        <div class="col-3"><div class="listing-img"><img src="{{ asset('frontend-source/images/d3.jpg') }}" class="img-fluid" alt=""></div></div>
                        <div class="col-7">
                            <div class="listing-content">
                                <strong>Dr. D N Mohanty</strong><br>
                                MD, SCB Medical, Cuttack<br>
                                <strong>Depart: </strong> Cardiology, medicines<br>
                                <i class="fa fa-map-marker"></i> Mangalabag, Cuttack - 754001<br>
                                <strong>Available: </strong><span>Mon</span><span>Wed</span><span>Fri</span><span>Sun</span><br>
                                <strong>Time: </strong>8:30 AM to 8.30 PM<br>
                                <strong>Rating: </strong>5
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="exp-box">14 Years Exp</div>
                        </div>
                        <div class="col-12 btn-section">
                            <a href="#" class="btn-stroke">Share</a>
                            <a href="{{ url('/profile-doctor') }}" class="btn-stroke">Know More</a>
                            <a href="{{ url('/profile-doctor') }}" class="btn-stroke blue">Consult Now</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
@endsection
@push('script')
<script>

</script>
@endpush