@extends('frontend-source.layouts.master')
@section('title') Details doctors @stop
@section('keywords') Details doctors @stop
@section('description') Details doctors @stop
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
                    <div class="col-12">
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fa fa-medkit"></i> Department: Cardiology, Medicines</li>
                            <li class="list-group-item"><i class="fa fa-hospital-o"></i> A Block, Plot No.55, Mangalabag, Cuttack</li>
                            <li class="list-group-item"><i class="fa fa-calendar"></i> Available: Mon, Wed, Fri, Sun</li>
                            <li class="list-group-item"><i class="fa fa-clock-o"></i> Time: 7.30 AM - 1.30 PM</li>
                            <li class="list-group-item"><i class="fa fa-home"></i> Visit to patient home in emergency: <strong>Yes</strong></li>
                            <li class="list-group-item"><i class="fa fa-book"></i> Qualification: <strong>MBBS, MIF, AIF</strong></li>
                            <li class="list-group-item"><i class="fa fa-certificate"></i> Awards/Achievement</li>
                            <li class="list-group-item"><i class="fa fa-money"></i> Consult fee Rs. 500 per patient</li>
                            <li class="list-group-item"><i class="fa fa-star"></i> Rating: 5 Star</li>
                        </ul>
                        <div class="description-block">
                            Description:<br><br>
                            I have been providing healthcare service to the people at low price.
                        </div>
                        <div class="accordion" id="accordion2">
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                        Comment/Feedback
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-body collapse">
                                    <div class="accordion-inner">
                                        One of the best doctor in cuttack - A. Nath
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section class="tips-slider">
                            <div class="tips-box-container slider">
                                <div class="box-item">
                                    <div class="item-image">
                                        <a href="#">
                                            <img src="{{ asset('frontend-source/images/tips1.jpg') }}" class="img-fluid" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="box-item">
                                    <div class="item-image">
                                        <a href="#">
                                            <img src="{{ asset('frontend-source/images/tips2.jpg') }}" class="img-fluid" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="box-item">
                                    <div class="item-image">
                                        <a href="#">
                                            <img src="{{ asset('frontend-source/images/tips3.jpg') }}" class="img-fluid" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="box-item">
                                    <div class="item-image">
                                        <a href="#">
                                            <img src="{{ asset('frontend-source/images/tips1.jpg') }}" class="img-fluid" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="box-item">
                                    <div class="item-image">
                                        <a href="#">
                                            <img src="{{ asset('frontend-source/images/tips2.jpg') }}" class="img-fluid" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="box-item">
                                    <div class="item-image">
                                        <a href="#">
                                            <img src="{{ asset('frontend-source/images/tips3.jpg') }}" class="img-fluid" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="btn-section">
                            <a href="#" class="btn-stroke">Share Now</a>
                            <a href="{{ url('/consult-doctor') }}" class="btn-stroke blue">Consult Now</a>
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