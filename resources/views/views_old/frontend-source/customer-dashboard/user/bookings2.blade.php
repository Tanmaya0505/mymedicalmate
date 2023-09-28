@extends('frontend-source.customer-dashboard.layouts.master')
@section('title') Bookings @stop
@section('keywords') Bookings @stop
@section('description') Bookings @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">
<style>
ul {
    list-style: none;
    margin: 0;
    padding: 0;
    font-size: 14px;
}
</style>
@endsection
@section('content')
<div class="content">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>BOOKING LIST PAGE 1</h3>
            </div>
            <div class="col-md-12">
                <div class="mm-book-table-data">
                    <div class="name">Medical Mate: Vishal Kumar Behere <span>Male</span></div>
                    <div class="content">
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> Service Area: Bhubaneswar, Odisha</li>
                            <li><i class="fas fa-calendar-alt"></i> Service Date: 11-Oct-2021</li>
                            <li><i class="fas fa-rupee-sign"></i> Service Charge: Rs 400</li>
                            <li><i class="fas fa-motorcycle"></i> Bike Fare: For 20-25km Rs.125</li>
                        </ul>
                        <div class="row action-btn-part mt10">
                            <div class="col-4"><a href="#" class="btn bg-primary btn-fill">Booking Status</a></div>
                            <div class="col-4 text-center"></div>
                            <div class="col-4 text-right"><a href="#" class="btn bg-danger btn-fill">Cancel</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mm-book-table-data">
                    <div class="name">Medical Mate: Ramesh Kumar Nayak <span>Male</span></div>
                    <div class="content">
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> Service Area: Bhubaneswar, Odisha</li>
                            <li><i class="fas fa-calendar-alt"></i> Service Date: 11-Oct-2021</li>
                            <li><i class="fas fa-rupee-sign"></i> Service Charge: Rs 400</li>
                            <li><i class="fas fa-motorcycle"></i> Bike Fare: For 10-15km Rs.75</li>
                        </ul>
                        <div class="row action-btn-part mt10">
                            <div class="col-4"><a href="#" class="btn bg-primary btn-fill">Booking Status</a></div>
                            <div class="col-4 text-center"></div>
                            <div class="col-4 text-right"><a href="#" class="btn bg-success btn-fill">Accepted</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mm-book-table-data">
                    <div class="name">Medical Mate: DINESH KUMAR NAYAK <span>Male</span></div>
                    <div class="content">
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> Service Area: Bhubaneswar, Odisha</li>
                            <li><i class="fas fa-calendar-alt"></i> Service Date: 11-Oct-2021</li>
                            <li><i class="fas fa-rupee-sign"></i> Service Charge: Rs 300</li>
                            <li><i class="fas fa-motorcycle"></i> Bike Fare: For 10-15km Rs.75</li>
                        </ul>
                        <div class="row action-btn-part mt10">
                            <div class="col-4"><a href="#" class="btn bg-primary btn-fill">View Details</a></div>
                            <div class="col-4 text-center"><a href="#" class="btn bg-warning btn-fill">Reschedule</a></div>
                            <div class="col-4 text-right"><a href="#" class="btn bg-danger btn-fill">Expired</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mm-book-table-data">
                    <div class="name">Medical Mate: PRITAM KUMAR DAS <span>Male</span></div>
                    <div class="content">
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> Service Area: Bhubaneswar, Odisha</li>
                            <li><i class="fas fa-calendar-alt"></i> Service Date: 11-Oct-2021</li>
                            <li><i class="fas fa-rupee-sign"></i> Service Charge: Rs 400</li>
                            <li><i class="fas fa-motorcycle"></i> Bike Fare: For 10-15km Rs.75</li>
                        </ul>
                        <div class="row action-btn-part mt10">
                            <div class="col-4"><a href="#" class="btn bg-primary btn-fill">View Details</a></div>
                            <div class="col-4 text-center"></div>
                            <div class="col-4 text-right"><a href="#" class="btn bg-success btn-fill">Completed</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mm-book-table-data">
                    <div class="name">Medical Mate: MILLON KUMAR SAHU <span>Male</span></div>
                    <div class="content">
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> Service Area: Bhubaneswar, Odisha</li>
                            <li><i class="fas fa-calendar-alt"></i> Service Date: 11-Oct-2021</li>
                            <li><i class="fas fa-rupee-sign"></i> Service Charge: Rs 400</li>
                            <li><i class="fas fa-motorcycle"></i> Bike Fare: For 10-15km Rs.75</li>
                        </ul>
                        <div class="row action-btn-part mt10">
                            <div class="col-4"><a href="#" class="btn bg-primary btn-fill">View Details</a></div>
                            <div class="col-4 text-center"></div>
                            <div class="col-4 text-right"><a href="#" class="btn bg-danger btn-fill">Cancelled</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 text-center mb20">
                <h3>BOOKING LIST PAGE 2</h3>
            </div>
            
                <div class="col-md-6">
                    <div class="mm-book-table-data">
                        <div class="name">Medical Mate: Vishal Kumar Behere <span>Male</span></div>
                        <div class="hl-content">
                            <ul>
                                <li>Medical Mate ID: 011205</li>
                                <li>Current Age: 27 Years</li>
                                <li>Service Area: Bhubaneswar Odisha</li>
                            </ul>
                        </div>
                        <div class="content">
                            <ul>
                                <li>Booking Date: 10-Oct-2021</li>
                                <li>Service Date: 11-Oct-2021</li>
                                <li>Booking for: Day</li>
                                <li>Booking Time: 10:30 AM</li>
                                <li>Arrival Time: 11:30 AM</li>
                                <li>Need Earlier Serial No for: Morning </li>
                                <li>Service Charge: Rs 300 </li>
                                <li>Coin Applied: -Rs <span class="strike">50</span></li>
                                <li>Bike fair for 20-30km: Rs 150</li>
                                <li>Fooding Offer: Yes</li>
                            </ul>
                            <div class="row action-btn-part mt10">
                                <div class="col-4"><a href="#" class="btn bg-primary btn-fill">Booking Status</a></div>
                                <div class="col-4 text-center"></div>
                                <div class="col-4 text-right"><a href="#" class="btn bg-danger btn-fill">Cancel</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mm-book-table-data patient-mate">
                        <div class="name">PATIENT MATE: RAHUL KUMAR BARICK <span>Male</span></div>
                        <div class="content">
                            <ul>
                                <li>Patient Current Age: 34</li>
                                <li>Patient From: Pattaamundai Kendrapara</li>
                                <li>Mobile No: 9843620154</li>
                                <li>What’s App No: 9785362030</li>
                            </ul>
                        </div>
                        <div class="content-patient">
                                PAYMENT DETAILS
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-9">Medical Mate Service Charge</div>
                                <div class="col-3">Rs 300</div>
                            </div>
                            <div class="row">
                                <div class="col-9">Coin Applied</div>
                                <div class="col-3">Rs <span class="strike">50</span></div>
                            </div>
                            <div class="row t-border">
                                <div class="col-9">Bike fair for 20-30 km:</div>
                                <div class="col-3">Rs 150</div>
                            </div>
                        </div>
                        <div class="content-patient">
                            <div class="row t-border">
                                <div class="col-9">Total Amount</div>
                                <div class="col-3">Rs 350</div>
                            </div>
                        </div>
                        <div class="content-patient bg-success">
                            Payment Status: Unpaid Pay on Service
                        </div>
                        <div class="content-patient bg-info">
                            Booking Status: Accepted for 11- Oct-2021
                        </div>
                        <div class="content">
                            <div class="row action-btn-part">
                                    <div class="col-4"><a href="#" class="btn bg-primary btn-fill">Go Back</a></div>
                                    <div class="col-4 text-center"></div>
                                    <div class="col-4 text-right"><a href="#" class="btn bg-danger btn-fill">Cancel</a></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="blue-bg text-center">
                        <h4>WE RESPECT YOUR TIME & BUDGET</h4>
                        <p>Sorry! Due to late response by the Vishal Kumar Behera so admin assigned to Rakesh Kumar Patra </p>
                    </div>
                    <div class="mm-rebook-profile">
                        <div class="mm-rebook-img">
                            <img src="{{ asset('frontend-source/images/t-1.jpg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="mm-rebook-details">
                            <h4>Vishal Kumar Behera</h4>
                            <span>Male</span>
                            <p>Service Area: Bhubaneswar<br>
                            Pick Up & Drop: Yes<br>
                            Service Charge: 400/Day<br>
                            Reason of skip: I’m not in that location</p>
                        </div>
                    </div>
                    <div class="mm-rebook-profile">
                        <div class="mm-rebook-img">
                            <img src="{{ asset('frontend-source/images/t-1.jpg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="mm-rebook-details">
                            <h4>Vishal Kumar Behera</h4>
                            <span>Male</span>
                            <p>Service Area: Bhubaneswar<br>
                            Pick Up & Drop: Yes<br>
                            Service Charge: 400/Day<br>
                            Reason of skip: I’m not in that location</p>
                        </div>
                    </div>
                    <div class="mm-rebook-profile">
                        <div class="mm-rebook-img">
                            <img src="{{ asset('frontend-source/images/t-1.jpg') }}" class="img-fluid" alt="">
                        </div>
                        <div class="mm-rebook-details">
                            <h4>Vishal Kumar Behera</h4>
                            <span>Male</span>
                            <p>Service Area: Bhubaneswar<br>
                            Pick Up & Drop: Yes<br>
                            Service Charge: 400/Day<br>
                            Reason of skip: I’m not in that location</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <a href="#" class="rebook-btn">CANCEL AND RE-BOOKING</a>
                </div>
        </div>


        <div class="row mt20">
            <div class="col-3"></div>
            <div class="col-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Open Popup1
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-body pop-info-mm">
                        <p>Hi Mr Rajesh Kumar do what to reschedule it?</p>
                        <div class="mm-info-p">
                            <div class="mm-info-img text-center">
                                <img src="{{ asset('frontend-source/images/t-1.jpg') }}" class="img-fluid" alt="">
                                25 Years
                            </div>                               
                            <div class="mm-info-details">
                                <span>Dinesh Kumar Nayak</span>
                                From: Pattamundai, Kedrapara 754211<br>
                                Service Area: Bhubaneswar City 
                            </div>                               
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-fill btn-primary">Yes</button>
                        <button type="button" class="btn btn-sm btn-fill btn-danger" data-dismiss="modal">No</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
                Feedback Popup
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog feedback-pp" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">FEEDBACK</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        Mr. Sujit Kumar Nayak<br>
                        <div class="star-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="white-bg">I really appreciated with Mr. Sujit Kumar service and well behavior. </span>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>  






       






</div>

<!--Cancel modal popup-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="staticBackdropLabel"><i class="nc-icon nc-notes"></i> Booking cancellation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="doctor-widget"></div>
                <form novalidate id="cancel-booking-form">
                    <input type="hidden" name="booking_id" id="booking_id" />
                    <input type="hidden" name="from_canceled" id="from_canceled" value="2" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Cancel Reasons:</label>
                        <textarea type="text" placeholder="Cancel Reasons" class="form-control" name="cancel_reason" id="cancel_reason" required=""></textarea>
                        <div class="invalid-feedback">Please write the reasons</div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-confirm" class="btn btn-primary btn-sm btn-fill">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Cancel modal popup-->
@endsection
@push('script')

@endpush
