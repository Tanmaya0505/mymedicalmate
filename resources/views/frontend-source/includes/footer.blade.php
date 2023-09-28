<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li><a href="{{ url('/doctor/list') }}">Doctors </a></li>
                    <li><a href="{{ url('/hospital/list') }}">Hospitals</a></li>
                    <li><a href="{{ url('/nurses/list') }}">Nurses</a></li>
                    <li><a href="{{ url('/clinics/list') }}">Clinics</a></li>
                    <li><a href="{{ url('/pharmas/list') }}">Pharmaceutical Institution </a></li>
                    <li><a href="{{ url('/exams/list') }}">Examination Post filed</a></li>
                    <li><a href="{{ url('/diseases/list') }}">Disease Contain Post</a></li>
                    <li><a href="{{ url('/video/list') }}"> All Ads</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About MedicalMate</a></li>
                    <li><a href="{{ url('/terms') }}">Terms & Conditions</a></li>
                    <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ url('/return-policy') }}">Return Policy</a></li>
                    <li><a href="{{ url('/disclaimer') }}">Disclaimer</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
                <ul class="social-footer">
                    <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram-square"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<nav class="mb-nav">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-around">
                    <a href="{{ url('/') }}">
                        <i class="fal fa-home"></i>
                        <span>Home</span>
                    </a>

                    <a href="{{ url('/upload-prescription') }}">
                        <i class="fal fa-file-prescription"></i>
                        <span>Prescription</span>
                    </a>

                    <a href="{{ url('/medical-mate') }}">
                        <i class="fal fa-users"></i>
                        <span>Medical Mate</span>
                    </a>

                    <a href="@if(Session::get('userId')) {{ url(accountPrefix().'/my-profile') }} @else {{ url('/login') }} @endif">
                        <i class="fal fa-user-circle"></i>
                        <span>My Account</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>




<div class="modal fade pop-login" id="directBooking" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Booking Without Medmate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('frontend-source.includes.msg')
                <div class="row">
                    <div class="column col-md-6"><a href="{{url('direct-booking/serial')}}" class="btn btn-info">Booking for serial number</a></div>
                    <div class="column col-md-6"><a href="{{url('direct-booking/full-service')}}" class="btn btn-info">Booking for full service </a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade pop-login" id="directBookingwithmedmate" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Booking With Medmate </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('frontend-source.includes.msg')
                <div class="row">
                    <div class="column col-md-6"><a id="serialbook" href="" class="btn btn-info">Booking for serial number</a></div>
                    <div class="column col-md-6"><a id="fullbook" href="" class="btn btn-info">Booking for full service </a></div>
                </div>
            </div>
        </div>
    </div>
</div>