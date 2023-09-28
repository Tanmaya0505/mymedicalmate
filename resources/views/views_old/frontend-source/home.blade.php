@extends('frontend-source.layouts.master')
@section('title') Home @stop
@section('keywords') home @stop
@section('description') Home @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/css/custom.css')}}">
<style type="text/css">
.input-group-addon {
    position: absolute;
    right: 16px;
    bottom: 6px;
    
}
</style>
@endsection
@section('content')
<section class="hero text-center">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12 p0">
                <div class="hero-slide slider">
                    <div class="box-item">
                        <img src="{{ asset('frontend-source/images/hero1.jpg') }}" class="img-fluid">
                    </div>
                    <div class="box-item">
                        <img src="{{ asset('frontend-source/images/hero2.jpg') }}" class="img-fluid">
                    </div>
                    <div class="box-item">
                        <img src="{{ asset('frontend-source/images/hero3.jpg') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="top-icon">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <div class="featureicon-slider">
                    <div class="icon-feature">
                        <img src="{{ asset('frontend-source/images/icon3.png') }}" alt="">
                        <p>Free & Fast Shipping</p>
                    </div>
                    <div class="icon-feature">
                        <img src="{{ asset('frontend-source/images/icon1.png') }}" alt="">
                        <p>Return Policy</p>
                    </div>
                    <div class="icon-feature">
                        <img src="{{ asset('frontend-source/images/icon2.png') }}" alt="">
                        <p>100% Money Back</p>
                    </div>
                    <div class="icon-feature">
                        <img src="{{ asset('frontend-source/images/icon4.png') }}" alt="">
                        <p>1000 of Medical Mates</p>
                    </div>
                    <div class="icon-feature">
                        <img src="{{ asset('frontend-source/images/icon5.png') }}" alt="">
                        <p>Get Rs 500 Bonus</p>
                    </div>
                    <div class="icon-feature">
                        <img src="{{ asset('frontend-source/images/icon6.png') }}" alt="">
                        <p>Get Instant Actions</p>
                    </div>
                    <div class="icon-feature">
                        <img src="{{ asset('frontend-source/images/icon7.png') }}" alt="">
                        <p>7 Days Support</p>
                    </div>
                    <div class="icon-feature">
                        <img src="{{ asset('frontend-source/images/icon8.png') }}" alt="">
                        <p>Get Upto 40% Off</p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
<section class="features">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <a @if(Session::get('userId')) href="{{ url('/upload-prescription') }}" @else href="javascript:void(0)" data-toggle="modal" data-target="#staticBackdrop" @endif>
                    <div class="feature-box">
                        <div class="f-box-img"><img src="{{ asset('frontend-source/images/prescription-icon.png') }}" class="img-fluid" alt=""></div>
                        <span>Upload Prescription</span>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ url('/medical-mate') }}">
                    <div class="feature-box">
                        <div class="f-box-img"><img src="{{ asset('frontend-source/images/mate-icon.png') }}" class="img-fluid" alt=""></div>
                        <span>Medical Mate</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="assistant-slider">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                <div class="text-center wow fadeInDown">
                    <h2 class="center mb30">May I Help You</h2>
                    <p>Here is thousands of honest & innocent Medical Mates are ready to help you at affordable price</p>
                </div>
                <div class="assistant-box-container assistant-box-container-slide slider">
                    @foreach($assistant as $key=>$val)
                    @php
                    $meta = json_decode($val->meta, true);
                    $data = \App\Helpers\CustomerHelper::decodeAssistantData($meta);
                    $photo = asset('assistant/'. $data['photo']);
                    if(!file_exists(public_path('assistant/'. $data['photo']))){
                        $photo = asset('frontend-source/images/assistant-boy-icon.png');
                    }
                    @endphp
                    <div class="box-item">
                        <table>
                            <tr class="hl-header">
                                <td style="width:40%;" class="text-left">
                                    <span class="verified">Medical Mate <i class="fas fa-check-circle"></i></span>
                                </td>
                                <td style="width:70%;" class="text-right">
                                        <img src="{{ asset('frontend-source/images/bike.png') }}" alt="">@if(isset($data['is_bike']) && $data['is_bike']) {{ @$data['km_range'] }} @else {{ '00-00 KM' }} @endif
                                </td>
                            </tr>
                            <tr class="ast-bx-flex">
                                <td class="ast-img">
                                    <div class="item-image">
                                        <a href="{{ url('/medical-mate/'.$val->id) }}">
                                            <img src="{{ $photo }}" class="img-fluid" alt="">
                                        </a>
                                        <span>Age: {{ $data['dob_year'] }} Yrs</span>
                                    </div>
                                </td>
                                <td class="ast-dtl">
                                    <div class="item-detail">
                                        <ul>
                                            <li><Strong>{{ ucwords($data['first_name'].' '.$data['last_name']) }}</Strong></li>
                                            <li>From: {{ $data['present_address'] . ', ' . $data['dist'] . ', ' . $data['state'] }}</li>
                                            <li>Service Area: {{ $data['service_area'] }}</li>
                                            <li>Service Charge: @if(isset($data['day_charges'])) {{ $data['day_charges'] }}/Day @else -- @endif</li>
                                            <li><!--Total Service Served: 0<br>-->
                                            Available in Days: {{ str_replace(',', ' | ', $data['available']) }}
                                            <!-- Rating: <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> 4.3 <br>-->
                                            <!--Rating: -- --></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    @if(Session::get('userId') && Session::get('accountId') != Config::get('constants.accountType.assistant') && Session::get('accountId') != Config::get('constants.accountType.vendor'))
                                        <!-- <a class="primary-btn" href="{{ url('/book-medical-mate/fullbook/'.$val->id) }}">Book Now</a> -->
                                        <a class="primary-btn" href="javascript:void(0)" onClick="OpenBooking({{$val->id}})">Book Now</a>
                                    @elseif(Session::get('userId') && Session::get('accountId') == Config::get('constants.accountType.assistant') || Session::get('accountId') == Config::get('constants.accountType.vendor'))
                                        <a class="primary-btn" style="cursor: not-allowed;" href="javascript:void(0)">Book Now</a>
                                    @else
                                        <a class="primary-btn" href="javascript:void(0)" data-toggle="modal" data-target="#staticBackdrop">Book Now</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/medical-mate/'.$val->id) }}" class="primary-btn ml5 right-btn">View Details</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="text-center view-listing-btn">
                <a href="{{ url('/medical-mate') }}" class="btn btn-primary"><img src="{{ asset('frontend-source/images/mate-icon-color.png') }}" class="img-fluid mb10" alt=""> View All MedicalMate Profiles</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="ml6">
                <span class="text-wrapper">
                    <span class="letters">Deal of the day</span>
                </span>
            </h1>
        </div>
        <div class="col-12">
            <div class="deal-timer">
                <img src="{{ asset('frontend-source/images/deal-banner.jpg') }}" class="img-fluid mb10" alt="">
                <ul>
                    <li><span id="days"></span>days</li>
                    <li><span id="hours"></span>Hours</li>
                    <li><span id="minutes"></span>Minutes</li>
                    <li><span id="seconds"></span>Seconds</li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<section class="lab-slider">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                <div class="text-center wow fadeInDown">
                    <h2 class="center mb30">laboratory Test & Clinic</h2>
                </div>
                <div class="lab-box-container slider">
                    <div class="box-item">
                        <div class="item-detail">
                            <ul class="detail">
                                <li class="assistant-name"><strong>Divine Care</strong></li>
                                <li>Mangalabag, Cuttack-75421</li>
                                <li>Established in 2002</li>
                                <li>Rating: 5.0</li>
                                <li><a href="#">More</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="item-detail">
                            <ul class="detail">
                                <li class="assistant-name"><strong>New Life Care</strong></li>
                                <li>Ranihat, Cuttack-75421</li>
                                <li>Established in 2005</li>
                                <li>Rating: 4.0</li>
                                <li><a href="#">More</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="item-detail">
                            <ul class="detail">
                                <li class="assistant-name"><strong>Divine Care</strong></li>
                                <li>Mangalabag, Cuttack-75421</li>
                                <li>Established in 2002</li>
                                <li>Rating: 5.0</li>
                                <li><a href="#">More</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="item-detail">
                            <ul class="detail">
                                <li class="assistant-name"><strong>New Life Care</strong></li>
                                <li>Ranihat, Cuttack-75421</li>
                                <li>Established in 2005</li>
                                <li>Rating: 4.0</li>
                                <li><a href="#">More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tips-slider">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                <div class="text-center wow fadeInDown">
                    <h2 class="center mb30">Healthcare Tips from Experts</h2>
                </div>
                <div class="tips-box-container slider">
                    <div class="box-item">
                        <div class="item-image">
                            <a href="#">
                                <img src="{{ asset('frontend-source/images/tips1.jpg') }}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <p class="text-center">During Pregnency</p>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="item-image">
                            <a href="#">
                                <img src="{{ asset('frontend-source/images/tips2.jpg') }}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <p class="text-center">During Pregnency</p>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="item-image">
                            <a href="#">
                                <img src="{{ asset('frontend-source/images/tips3.jpg') }}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <p class="text-center">During Pregnency</p>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="item-image">
                            <a href="#">
                                <img src="{{ asset('frontend-source/images/tips1.jpg') }}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <p class="text-center">During Pregnency</p>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="item-image">
                            <a href="#">
                                <img src="{{ asset('frontend-source/images/tips2.jpg') }}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <p class="text-center">Diabetes Care</p>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="item-image">
                            <a href="#">
                                <img src="{{ asset('frontend-source/images/tips3.jpg') }}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <p class="text-center">Gastrologer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="mt10 mb30 text-center">
    <a href="#" class="btn btn-primary mb10" data-toggle="modal" data-target="#suggForm">Suggestions & Complaints</a><br>
    <small>Let us know what you would like to improve in this.</small>

    <!-- The Modal -->
    <div class="modal text-left" id="suggForm">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="card">
                    <div class="card-header bg-primary text-white">Post Your Suggetion
                        <a href="#" class="fr" data-dismiss="modal" aria-label="Close"><i class="far fa-times-circle"></i></a>
                    </div>
                    <div class="card-body">
                        <form id="post_suggetion">
                            <div class="form-group">
                                <label for="sugg_name">Name</label>
                                <input type="text" class="form-control form-control-sm" name="sugg_name" id="sugg_name" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="sugg_phone">Phone</label>
                                <input type="text" class="form-control" name="sugg_phone" id="sugg_phone" onkeypress="return isNumber(event)" placeholder="Phone Number" required>
                            </div>
                            <div class="form-group">
                                <label for="sugg_email">Email address</label>
                                <input type="email" class="form-control" name="sugg_email" id="sugg_email" aria-describedby="emailHelp" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label for="sugg_complaint_type">Choose complaint type</label>
                                <select class="form-control" name="sugg_complaint_type" id="sugg_complaint_type">
                                    <option value="">Choose complaint type</option>
                                    <option value="Suggestion">Suggestion</option>
                                    <option value="Feedback">Feedback</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sugg_state">Select state</label>
                                <select class="form-control" name="sugg_state" id="sugg_state" onchange="selctState(this.value)">
                                    <option value="">Select state</option>
                                    @foreach($states as $sKey=>$sVal)
                                    <option value="{{ $sKey }}">{{ $sVal['state'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sugg_district">Select district</label>
                                <select class="form-control" name="sugg_district" id="sugg_district">
                                    <option>--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sugg_message">Message</label>
                                <textarea class="form-control" name="sugg_message" id="sugg_message" rows="3"  placeholder="Please provide your full adrress with the message" required></textarea>
                            </div>
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                            <small id="emailHelp" class="form-text text-muted mt10">We'll never share your contact information with anyone else. <a href="#">Read More</a></small>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<section class="testimonials">
    <div class="container">
        <div class="row">
            <div class="col-12 col-center m-auto">
                <h2 class="mb-4 center">Our Customer's Feedback</h2>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item carousel-item active">
                            <div class="img-box"><img src="{{ asset('frontend-source/images/d1.jpg') }}" alt=""></div>
                            <p class="overview">Prakash Kumar Sahoo</p>
                            <p class="testimonial">This is a verygood platform for all of us also its very genuine service along with affordable price.</p>
                        </div>
                        <div class="item carousel-item">
                            <div class="img-box"><img src="{{ asset('frontend-source/images/d1.jpg') }}" alt=""></div>
                            <p class="overview">Trideep Dakua</p>
                            <p class="testimonial">This is a verygood platform for all of us also its very genuine service along with affordable price.</p>
                        </div>
                        <div class="item carousel-item">
                            <div class="img-box"><img src="{{ asset('frontend-source/images/d1.jpg') }}" alt=""></div>
                            <p class="overview">Gourav Mishra</p>
                            <p class="testimonial">This is a verygood platform for all of us also its very genuine service along with affordable price.</p>
                        </div>
                    </div>
                    <!-- Carousel controls -->
                    <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                        <img src="{{ asset('frontend-source/images/arrow-left.png') }}" alt="">
                    </a>
                    <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                    <img src="{{ asset('frontend-source/images/arrow-right.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend-source.includes.login-popup')
@endsection
@push('script')
<script src="{{ asset('frontend-source/bootstrap/js/bootstrap-notify.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset('frontend-source/js/custom.js') }}" type="text/javascript" ></script>
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
    },{
        type: "success"
    });
</script>
@endif
<script type="text/javascript">
    function OpenBooking(booking_id){
    $('#directBookingwithmedmate #serialbook').attr('href','/book-medical-mate/serial/'+booking_id);
    $('#directBookingwithmedmate #fullbook').attr('href','/book-medical-mate/fullbook/'+booking_id);

    $('#directBookingwithmedmate').modal('show');
}
</script>
@endpush