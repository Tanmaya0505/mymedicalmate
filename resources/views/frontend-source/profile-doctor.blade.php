@extends('frontend-source.layouts.master')
@section('title') Profile doctor @stop
@section('keywords') Profile doctor @stop
@section('description') Profile doctor @stop
@section('style')
@endsection
@section('content')
<div class="breadcrumb-sec">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-sm-5">
                        <h3>Doctor Profile Exploration</h3>
                    </div>
                    <div class="col-sm-7 ">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Doctors Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="profile">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-xl-4">
                        <div class="profile-sidebox">
                            <div class="profile-img"><img src="{{ asset('frontend-source/images/doct-prof1.jpg') }}" alt="" class="img-fluid"></div>
                            <div class="name">Dr. John Smith</div>
                            <div class="desg">Professor, Neurology</div>
                            <div class="exp">Experience: 09 Year</div>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span class="rating-value">4.0</span>
                            </div>
                            <div class="speciality">
                                <h4>Speciality Area</h4>
                                <ul>
                                    <li><a href="#">Neuromuscular Disease</a></li>
                                    <li><a href="#">Neurology-Adult</a></li>
                                    <li><a href="#">Nerve Disorders</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xl-8 mt-40">
                        <h4>Basic Info</h4>
                        <hr>
                        <div class="name">Dr. John Smith</div>
                        <div class="desg mb-3">Professor, Neurology</div>
                        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer quis ligula neque. Duis eu lacinia nunc. Quisque tempus feugiat pellentesque. Suspendisse volutpat nec ipsum nec porttitor. Aenean non mollis lacus. Fusce orci lacus, ornare in est ut, finibus auctor elit. Nunc ut dolor enim. In hac habitasse platea dictumst. </p>
                        <h4>Clinic</h4>
                        <hr>
                        <ul class="clinic-list list-inline mb-5">
                            <li><a href="#">ABC Medical college & Hospital</a></li>
                            <li><a href="#">ABC Medical</a></li>
                        </ul>
                        <div class="booking-form">
                            <h4>Book An Appointment</h4>
                            <form action="action">
                                <div class="form-row">
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                            <select class="form-control no-brd-r">
                                                <option selected>Monday</option>
                                                <option>Wednesday</option>
                                                <option>Friday</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                            </div>
                                            <select class="form-control">
                                                <option selected>10.30 - 11.00</option>
                                                <option>11.00 - 11.30</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="booking-fees">Rs. 200 / Appointment</div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="#" class="hvr-sweep-to-right">Book Now <i class="fa fa-calendar"></i></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
@push('script')
<script>

</script>
@endpush