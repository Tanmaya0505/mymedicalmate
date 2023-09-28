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
            <div class="col-md-12">
                <h4 class="mb-4 page-heading">MY BOOKING HISTRORY (MEDICAL MATE)</h4>
                <div class="appointment-tab">
                    <div class="tab-content">
                        <!-- Upcoming Appointment Tab -->
                        <div class="tab-pane show active" id="upcoming-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <h1>Here is the booking 1 page</h1>
                                </div>
                            </div>
                        </div>
                        <!-- /Upcoming Appointment Tab -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
                <div class="col-md-12">
                    <div class="mm-book-table-data">
                        <div class="name">Medical Mate: Vishal Kumar Behere <span>Male</span></div>
                        <div class="content">
                            <ul>
                                <li><strong><i class="fas fa-map-marker-alt"></i> Service Area:</strong> Bhubaneswar, Odisha</li>
                                <li><strong><i class="fas fa-calendar-alt"></i> Date & Time:</strong> 22-Spt-2021 (08:30 AM)</li>
                                <li><strong><i class="fas fa-mobile"></i> Mobile No:</strong> 94375 75022/98738 50005</li>
                                <li><strong><i class="fas fa-rupee-sign"></i> Service Charge:</strong> + 20-25km Bike Fair: Rs 550</li>
                            </ul>
                        </div>
                        <div class="content-patient">
                            <ul class="mb10">
                                <li><strong>Patient Name:</strong> Ajaya Barik</li>
                                <li><strong>Patient From:</strong> Pattaamundai, Kendrapara</li>
                                <li><strong>Pick Up & Drop:</strong> Yes</li>
                            </ul>
                            <div class="row action-btn-part mt10">
                                <div class="col-4"><a href="#" class="btn bg-success btn-fill"><i class="fas fa-check-circle"></i> Accepted</a></div>
                                <div class="col-4 f0"><a href="#" class="btn bg-primary btn-fill"><i class="fas fa-eye"></i> View Details</a></div>
                                <div class="col-4"><a href="#" class="btn bg-muted btn-fill"><i class="fas fa-times"></i> Cancel</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mm-book-table-data">
                        <div class="name"> MEDICAL MATE: RAHUL KUMAR BARIK <span>Male</span></div>
                        <div class="content">
                            <ul>
                                <li><strong><i class="fas fa-map-marker-alt"></i> Service Area:</strong> Bhubaneswar, Odisha</li>
                                <li><strong><i class="fas fa-calendar-alt"></i> Date & Time:</strong> 22-Spt-2021 (08:30 AM)</li>
                                <li><strong><i class="fas fa-rupee-sign"></i> Service Charge:</strong> + 20-25km Bike Fair: Rs 550</li>
                            </ul>
                        </div>
                        <div class="content-patient">
                            <div class="row action-btn-part">
                                <div class="col-4"><a href="#" class="btn bg-primary btn-fill"><i class="fas fa-eye"></i> View Details</a></div>
                                <div class="col-4"></div>
                                <div class="col-4"><a href="#" class="btn bg-danger btn-fill"><i class="fas fa-times"></i> Cancelled</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mm-book-table-data">
                        <div class="name">  MEDICAL MATE: SANGEETA NAYAK <span>Female</span></div>
                        <div class="content">
                            <ul>
                                <li><strong><i class="fas fa-map-marker-alt"></i> Service Area:</strong> Bhubaneswar, Odisha</li>
                                <li><strong><i class="fas fa-calendar-alt"></i> Date & Time:</strong> 22-Spt-2021 (08:30 AM)</li>
                                <li><strong><i class="fas fa-rupee-sign"></i> Service Charge:</strong> + 20-25km Bike Fair: Rs 550</li>
                            </ul>
                        </div>
                        <div class="content-patient">
                            <div class="row action-btn-part">
                                <div class="col-4"><a href="#" class="btn bg-primary btn-fill"><i class="fas fa-eye"></i> View Details</a></div>
                                <div class="col-4"></div>
                                <div class="col-4"><a href="#" class="btn bg-success btn-fill"><i class="fas fa-check"></i> completed</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mm-book-table-data">
                        <div class="name">  MEDICAL MATE: DINESH KUMAR NAYAK<span>Male</span></div>
                        <div class="content">
                            <ul>
                                <li><strong><i class="fas fa-map-marker-alt"></i> Service Area:</strong> Bhubaneswar, Odisha</li>
                                <li><strong><i class="fas fa-calendar-alt"></i> Date & Time:</strong> 22-Spt-2021 (08:30 AM)</li>
                                <li><strong><i class="fas fa-rupee-sign"></i> Service Charge:</strong> Rs 300</li>
                            </ul>
                        </div>
                        <div class="content-patient">
                            <div class="row action-btn-part">
                                <div class="col-4"><a href="#" class="btn bg-primary btn-fill"><i class="fas fa-eye"></i> View Details</a></div>
                                <div class="col-4"><a href="#" class="btn bg-info btn-fill"><i class="far fa-calendar-alt"></i> Reschedule</a></div>
                                <div class="col-4"><a href="#" class="btn bg-danger btn-fill"><i class="fas fa-ban"></i> Expired</a></div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>



        <!-------------Booking summary page start here-------------------------->

<div class="text-center mt50">
    <h4>Booking-summery-page-front end</h4>
</div>
        <!-------------Step Form-------------------------->
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Medical Mate</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Booking Summary</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>Payment</p>
                </div>
            </div>
        </div>
        <form role="form">
            <div class="row setup-content" id="step-1">
                        <!-----------step1 content------------------------------>
                        <div class="col-md-12">
                            <div class="mm-book-table-data">
                                <div class="name">PATIENT: RAJENDRA KUMAR DAS <span>Male</span></div>
                                <div class="content">
                                    <ul>
                                        <li><strong><i class="fas fa-map-marker-alt"></i> Patient From:</strong> Pattamundai, Kendrapara</li>
                                        <li><strong><i class="fas fa-calendar-alt"></i> Booking Date & Time:</strong> 22-Sep-2021 (08:30 AM)</li>
                                        <li><strong><i class="fas fa-calendar-alt"></i> Service Date:</strong> 24-Sep-2021 (08:30 AM)</li>
                                        <li><strong><i class="fas fa-clock"></i> Arrival Time:</strong> 09:30 AM</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="text-center step-btn">
                                <a href="#" class="btn btn-md bg-primary btn-fill nextBtn">Next</a>
                            </div>
                        </div>
                        <!----------------------------------------->
            </div>
            <div class="row setup-content" id="step-2">
                        <!-----------step2 content------------------------------>
                        <div class="col-md-12">
                            <div class="mm-book-table-data">
                            <div class="name">MEDICAL MATE: DEEPENDRA KUMAR PATI <span>Male</span></div>
                                <div class="content">
                                    <ul>
                                        <li><strong><i class="fas fa-map-marker-alt"></i> Service Area:</strong> Bhubaneswar, Odisha</li>
                                        <li><strong><i class="fas fa-rupee-sign"></i> Service Charge:</strong> Rs.300/Day</li>
                                        <li><strong><i class="fas fa-motorcycle"></i> Bike Charge:</strong> 20-25km</li>
                                    </ul>
                                </div>
                                <div class="name pay-summary"><strong>Payment Summary</strong></div>
                                <div class="content">
                                    <table>
                                        <tr>
                                            <td>Medical Mate Service Charge Rs.300</td>
                                            <td>(1 Item)</td>
                                        </tr>
                                        <tr>
                                            <td>Bike Charge Rs.150</td>
                                            <td>(1 Item 20-25km)</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="name"><strong>Total Payable Amount: <strong>Rs.450</strong></div>
                            </div>
                            <div class="text-center step-btn">
                                <a href="#" class="btn btn-md bg-info btn-fill prvBtn">Back</a>
                                <a href="#" class="btn btn-md bg-primary btn-fill nextBtn">Next</a>
                            </div>
                        </div>
                        <!----------------------------------------->
            </div>
            <div class="row setup-content" id="step-3">
                        <!-----------step3 content------------------------------>
                        <div class="col-md-12">
                            <div class="mm-book-table-data">
                                <div class="blue-bar"><i class="fal fa-check-circle"></i> Safe and secure payment, ease return 100% on valid cancellation T&C</div>
                                    <div class="content">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio">Pay Online
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio">Pay After Service
                                            </label>
                                        </div>
                                    </div>
                            </div>
                            <div class="text-center step-btn">
                                <a href="#" class="btn btn-md bg-info btn-fill prvBtn">Back</a>
                                <a href="#" class="btn btn-md bg-success btn-fill">Submit Booking</a>
                            </div>
                        </div>
                        <!----------------------------------------->
            </div>
        </form>
        <!-------------Step Form-------------------------->
        <!-------------Booking summary page End here-------------------------->






        <!-------------On-Service_complete_dashboard_medicalmate-------------------------->

        <div class="text-center mt50">
            <h4>On-Service_complete_dashboard_medicalmate</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mm-book-table-data">
                    <div class="primary-header">Thanks for the choosing me to help you.<br>
                        <strong class="f22">Mr. Deependra Kumar Pati</strong>
                    </div>
                    <div class="content">
                        <ul>
                            <li><strong><i class="fas fa-user-injured"></i>Patient Name:</strong> Rajendra Kumar Das</li>
                            <li><strong><i class="fas fa-calendar-alt"></i> Service Date:</strong> 27-10-2021</li>
                            <li><strong><i class="fas fa-map-marker-alt"></i> Service Location:</strong> Bhubaneswar Odisha</li>
                        </ul>
                    </div>
                    <div class="primary-header">Check the payment status before complete.</div>
                </div>
                <div class="row">
                    <div class="col-6"><a href="#" class="full-btn yellow">Pay After Service</a></div>
                    <div class="col-6">
                        <div class="full-btn primary">
                            <select class="form-select" aria-label="Default select example">
                                <option>Select Payment</option>
                                <option>Net Banking</option>
                                <option>Credit Card</option>
                                <option>Pay Later</option>
                                <option>Cash on Delivery</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="final-payment-summary">
                            <div class="row">
                                <div class="col-9">Medical Mate Service Charge</div>
                                <div class="col-3">Rs300</div>
                            </div>
                            <div class="row">
                                <div class="col-9">Bike Charge</div>
                                <div class="col-3">Rs150</div>
                            </div>
                            <div class="row t-border">
                                <div class="col-9">Total Payable Amount</div>
                                <div class="col-3"><strong class="f22">Rs450</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <a href="#" class="btn bg-success btn-fill mt20">Pay & Complete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-------------On-Service_complete_dashboard_medicalmate-------------------------->






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
