@extends('frontend-source.layouts.master')
@section('title') Consult doctor @stop
@section('keywords') Consult doctor @stop
@section('description') Consult doctor @stop
@section('style')
@endsection
@section('content')
<section class="doctor-details">
            <div class="container">
                <div class="row">
                    <div class="doctor-img"><img src="{{ asset('frontend-source/images/d1.jpg') }}" class="img-responsive" alt=""></div>
                    <div class="doctor-details-block">
                        <span>Dr. D N Mohanty</span>
                        <span class="mute">MD, SCB Medical Cuttack</span>
                        <span class="exp">10 Years Exp</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-30">
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fa fa-calendar"></i> Available: Mon, Wed, Fri, Sun</li>
                            <li class="list-group-item"><i class="fa fa-calendar-times-o"></i> Choose the date
                                <div class="dateslot">
                                    <input id="datepicker" width="100%" placeholder="Choose date" readonly />
                                </div>
                            </li>
                            <li class="list-group-item timeslot"><i class="fa fa-clock-o"></i> Choose Two Time Slots
                                <div class="row mt10">
                                    <div class="col-4">
                                        <strong>Morning</strong>
                                        <div class="button-group-pills text-center" data-toggle="buttons">
                                            <label class="btn btn-default active">
                                                <input type="radio" name="options" checked="">
                                                <div>7 AM - 9 AM</div>
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="options">
                                                <div>9 AM - 11 AM</div>
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="options">
                                                <div>11 AM - 1 PM</div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <strong>Afternoon</strong>
                                        <div class="button-group-pills text-center" data-toggle="buttons">
                                            <label class="btn btn-default active">
                                                <input type="radio" name="options" checked="">
                                                <div>3 PM - 4 PM</div>
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="options">
                                                <div>4 PM - 5 PM</div>
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="options">
                                                <div>5 PM - 6 PM</div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <strong>Evening</strong>
                                        <div class="button-group-pills text-center" data-toggle="buttons">
                                            <label class="btn btn-default active">
                                                <input type="radio" name="options" checked="">
                                                <div>7 PM - 8 PM</div>
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="options">
                                                <div>8 PM - 9 PM</div>
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="options">
                                                <div>9 PM - 10 PM</div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="btn-section">
                            <a href="#" class="btn-stroke blue">Continue</a>
                        </div>

                        <section class="doctor-slider custom-white">
                            <div class="container">
                                <div class="row clearfix">
                                    <div class="col-12">
                                        <div class="text-center mb50 wow fadeInDown">
                                            <h2 class="center mb30">Similar doctors are available for personal consult.</h2>
                                        </div>
                                        <div class="box-container slider">
                                            <div class="box-item">
                                                <div class="item-image">
                                                    <a href="#" class="">
                                                        <img src="{{ asset('frontend-source/images/d1.jpg') }}" class="img-fluid" alt="">
                                                    </a>
                                                </div>
                                                <div class="item-detail">
                                                    <ul class="detail">
                                                        <li class="assistant-name"><strong>Radhakanta Gupta</strong></li>
                                                        <li>pediatric, MD</li>
                                                        <li>Apollo, Bhubaneswar</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="box-item">
                                                <div class="item-image">
                                                    <a href="#" class="">
                                                        <img src="{{ asset('frontend-source/images/d2.jpg') }}" class="img-fluid" alt="">
                                                    </a>
                                                </div>
                                                <div class="item-detail">
                                                    <ul class="detail">
                                                        <li class="assistant-name"><strong>Dinesh Kumar Gupta</strong></li>
                                                        <li>Cardiology, MD</li>
                                                        <li>SCB Medical, Cuttack</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="box-item">
                                                <div class="item-image">
                                                    <a href="#" class="">
                                                        <img src="{{ asset('frontend-source/images/d3.jpg') }}" class="img-fluid" alt="">
                                                    </a>
                                                </div>
                                                <div class="item-detail">
                                                    <ul class="detail">
                                                        <li class="assistant-name"><strong>Arun Kumar Mohanty</strong></li>
                                                        <li>Gastrologer, MD</li>
                                                        <li>MS, Bhubaneswar</li>
                                                    </ul>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>
                </div>
            </div>
        </section>
@endsection
@push('script')
<script>

</script>
@endpush