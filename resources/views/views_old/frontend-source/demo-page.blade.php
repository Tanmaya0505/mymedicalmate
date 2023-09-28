@extends('frontend-source.layouts.master')
@section('title') Book Medical Mate @stop
@section('keywords') Book Medical Mate @stop
@section('description') Book Medical Mate @stop
@section('style')

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="text-center mt50">
            <h4>Booking-summery-page-front end</h4>
        </div>
        
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
        <form>
            <div class="row setup-content" id="step-1">
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
            </div>
            <div class="row setup-content" id="step-2">
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
            </div>
            <div class="row setup-content" id="step-3">
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
            </div>
        </form>
        

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
    </div>
</div>
@endsection
@push('script')
<script>
$(document).ready(function () {
    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');
            allPrvBtn = $('.prvBtn');
    allWells.hide();
    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);
        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
});

allNextBtn.click(function(){
    var curStep = $(this).closest(".setup-content"),
        curStepBtn = curStep.attr("id"),
        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
        curInputs = curStep.find("input[type='text'],input[type='url']"),
        isValid = true;
    $(".form-group").removeClass("has-error");
    for(var i=0; i<curInputs.length; i++){
        if (!curInputs[i].validity.valid){
            isValid = false;
            $(curInputs[i]).closest(".form-group").addClass("has-error");
        }
    }
    if (isValid)
        nextStepWizard.removeAttr('disabled').trigger('click');
});

allPrvBtn.click(function(){
    var curStep = $(this).closest(".setup-content"),
    curStepBtn = curStep.attr("id"),
    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a"),
    curInputs = curStep.find("input[type='text'],input[type='url']"),
    isValid = true;
    $(".form-group").removeClass("has-error");
    for(var i=0; i<curInputs.length; i--){
        if (!curInputs[i].validity.valid){
            isValid = false;
            $(curInputs[i]).closest(".form-group").addClass("has-error");
        }
    }
    if (isValid)
        nextStepWizard.removeAttr('disabled').trigger('click');
});
$('div.setup-panel div a.btn-primary').trigger('click');
});
</script>
@endpush


