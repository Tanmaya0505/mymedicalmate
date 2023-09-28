//if(location.hostname == 'localhost'){
    var hostname = $(location).attr('origin')+'/medihelp/';
// } else {
//     var hostname = $(location).attr('origin')+'/';
// }
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

let mindate = new Date();
mindate.setDate(mindate.getDate() - 1);

let maxdate = new Date();
maxdate.setDate(maxdate.getDate() + 2);
$('#book_date').datepicker({
    uiLibrary: 'materialdesign',
    inline: false,
    format: 'dd-mm-yyyy',
    minDate: mindate,
    maxDate: maxdate,
    modal: true,
    header: true,
    footer: true
});

$('#book_date_serial').datepicker({
    uiLibrary: 'materialdesign',
    inline: false,
    format: 'dd-mm-yyyy',
    minDate: mindate,
    maxDate: maxdate,
    modal: true,
    header: true,
    footer: true
});

//$('#arrival_time').timepicker({
//});
//$("#arrival_time").focus(function () {
//    $('#arrival_time').next().trigger('click');
//});

$('#book_date').on('change', function(){
    let date = $('#book_date').val();
    let assistant_boy_id = $('#assistant_boy_id').val();
    $.ajax({
        type: "Post",
        dataType: "json",
        url: hostname + "check-availability-assistant",
        data: {date: date, assistant_boy_id: assistant_boy_id},
        success: function (result) {
            if(result.getTime !== 'undefined'){
                $('#arrival_time').empty().append('<option value="">Select Arrival Time</option>');
                $.each(result.getTime, function (key, val) {
                    $('#arrival_time').append($("<option/>", {
                        value: val,
                        text: val
                    }));
                });
            }
            if (result.code != 200) {
                $('#error_availability').html(result.message);
                $.notify({
                    title: '<strong>Error !</strong>',
                    message: result.message
                },{
                    type: "danger"
                });
                $('#btn-submit-request').attr('disabled', 'disabled');
            } else {
                $('#error_availability').html('');
                $('#btn-submit-request').removeAttr('disabled', 'disabled');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});

//$('#arrival_time').on('change', function(){
//    let arrival_time = $('#arrival_time').val();
//    $('#arrival_time').val(tConvert(arrival_time));
//});
//
//function tConvert(time) {
//  // Check correct time format and split into components
//  time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
//
//  if (time.length > 1) { // If time format correct
//    time = time.slice (1);  // Remove full string match value
//    time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
//    time[0] = +time[0] % 12 || 12; // Adjust hours
//  }
//  return time.join (''); // return adjusted time or original string
//}

(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                event.stopPropagation();
                if (form.checkValidity() === false) {
                    form.classList.add('was-validated');
                } else {
                    if(form.id=='book-assistant-serial'){
                        bookSerialNumber();
                    }else if(form.id=='book-assistant-direct'){

                        bookDirectFullAssistant();
                    }else{
                        bookAssistant();
                    }
                }
            }, false);
        });
    }, false);
})();

function bookAssistant(){
    $.ajax({
        type: "POST",
        url: hostname + "booking-summery",
        data: $("#book-assistant").serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('.xhr-loading').css({'display':'block'});
        },
        success: function (data) {
            $('.xhr-loading').css({'display':'none'});
            $('#btn-submit-request').html('Submit Request');
            $('#book-assistant').unblock();
            if (data.code === 200) {
                $('#booking-info').css({'display':'none'});
                $('#booking-summery').css({'display':'block'});
                $('#booking-summery').html(data.data);
                $("input[name=payment][value='2']").prop('checked', true);
                $('#payment_mode').val(2);
            } else {
                $("#staticBackdrop").modal('show');
                $.notify({
                    title: '<strong>Error !</strong>',
                    message: data.message
                },{
                    type: "danger"
                });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('#btn-submit-request').html('Submit Request');
            $('#book-assistant').unblock();
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
}
function bookDirectFullAssistant(){
    $.ajax({
        type: "POST",
        url: hostname + "booking-summery-direct",
        data: $("#book-assistant-direct").serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('.xhr-loading').css({'display':'block'});
        },
        success: function (data) {
            $('.xhr-loading').css({'display':'none'});
            $('#btn-submit-request').html('Submit Request');
            $('#book-assistant').unblock();
            if (data.code === 200) {
                location.href = data.url;
                // $('#booking-info').css({'display':'none'});
                // $('#booking-summery').css({'display':'block'});
                // $('#booking-summery').html(data.data);
                // $("input[name=payment][value='2']").prop('checked', true);
                // $('#payment_mode').val(2);
            } else {
                $("#staticBackdrop").modal('show');
                $.notify({
                    title: '<strong>Error !</strong>',
                    message: data.message
                },{
                    type: "danger"
                });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('#btn-submit-request').html('Submit Request');
            $('#book-assistant').unblock();
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
}
function bookSerialNumber(){
    $.ajax({
        type: "POST",
        url: hostname + "book-assistant-serial",
        data: $("#book-assistant-serial").serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('.xhr-loading').css({'display':'block'});
        },
        success: function (data) {
            $('.xhr-loading').css({'display':'none'});
            $('#btn-submit-request').html('Submit Request');
            $('#book-assistant').unblock();
            if (data.code === 200) {
                // $('#booking-info').css({'display':'none'});
                // $('#booking-summery').css({'display':'block'});
                // $('#booking-summery').html(data.data);
                // $("input[name=payment][value='2']").prop('checked', true);
                // $('#payment_mode').val(2);

                location.href = '/booking/serial/payment/'+data.booking_id;
                
                // if(data.assistant_boy_id){
                //     location.href = '/medihelp/booking-success/'+data.booking_id;
                // }else{
                //     location.href = '/direct-booking/search-medmate/'+data.booking_id;
                // }
            } else {
                //$("#staticBackdrop").modal('show');
                $.notify({
                    title: '<strong>Error !</strong>',
                    message: data.message
                },{
                    type: "danger"
                });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('#btn-submit-request').html('Submit Request');
            $('#book-assistant').unblock();
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
}

$(document).on('click', '#step-1 .nextBtn', function(){
    $('#step-1').css({'display':'none'});
    $('#step-2').css({'display':'block'});
    $('.tab-1').addClass('btn-default').removeClass('btn-primary');
    $('.tab-1').attr('disabled','disabled');
    
    $('.tab-2').addClass('btn-primary').removeClass('btn-default');
    $('.tab-2').removeAttr('disabled');
});

$(document).on('click', '#step-1 .prvBtn', function(){
    $('#booking-info').css({'display':'block'});
    $('#booking-summery').html('');
    $('#booking-summery').css({'display':'none'});
});

$(document).on('click', '#step-2 .prvBtn', function(){
    $('#step-1').css({'display':'block'});
    $('#step-2').css({'display':'none'});
    
    $('.tab-1').addClass('btn-primary').removeClass('btn-default');
    $('.tab-1').removeAttr('disabled');
    $('.tab-2').addClass('btn-default').removeClass('btn-primary');
    $('.tab-2').attr('disabled');
});

$(document).on('click', '#step-2 .nextBtn', function(){
    $('#step-2').css({'display':'none'});
    $('#step-3').css({'display':'block'});
    
    $('.tab-3').addClass('btn-primary').removeClass('btn-default');
    $('.tab-3').removeAttr('disabled');
    $('.tab-2').addClass('btn-default').removeClass('btn-primary');
    $('.tab-2').attr('disabled');
});

$(document).on('click', '#step-3 .prvBtn', function(){
    $('#step-2').css({'display':'block'});
    $('#step-3').css({'display':'none'});
    
    $('.tab-2').addClass('btn-primary').removeClass('btn-default');
    $('.tab-2').removeAttr('disabled');
    $('.tab-3').addClass('btn-default').removeClass('btn-primary');
    $('.tab-3').attr('disabled');
});

$(document).on('click', '#booking-summery .submit-data', function(){
    let patient_name = $('#patient_name').val();
    let patient_mobile = $('#patient_mobile').val();
    let email = $('#patient_email').val();
    $.ajax({
        type: "POST",
        url: hostname + "assistant-booking-otp",
        data: {name: patient_name, mobile: patient_mobile, email: email},
        dataType: 'json',
        beforeSend: function () {
            $('.xhr-loading').css({'display':'block'});
        },
        success: function (data) {
            $('.xhr-loading').css({'display':'none'});
            $('#btn-submit-request').html('Submit Request');
            $('#book-assistant').unblock();
            if (data.code === 200) {
                if(checkDevice() == 1){
                    $(".modal-dialog").removeClass('modal-dialog-centered');
                } else {
                    $(".modal-dialog").addClass('modal-dialog-centered');
                }
                $('#otp').val('');
                $("#staticBackdrop").modal('show');
                $.notify({
                    title: '<strong>Success !</strong>',
                    message: data.message
                },{
                    type: "success"
                });
            } else {
                $("#staticBackdrop").modal('show');
                $.notify({
                    title: '<strong>Error !</strong>',
                    message: data.message
                },{
                    type: "danger"
                });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('#btn-submit-request').html('Submit Request');
            $('#book-assistant').unblock();
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});

$(document).on('change', 'input[type=radio][name=payment]', function(){
    let value = $('input[name=payment]:checked').val();
    $('#payment_mode').val(value);
});
    
$('form#confirm-book-assistant').submit(function (e) {
    e.preventDefault();
    let payment_mode = $('#payment_mode').val();
    console.log(payment_mode,'payment_mode');
    let otp = $('#otp').val();
    if(otp == ''){
        $('#otp').focus();
        toastr.error('Please enter your OTP', 'Error', { positionClass: "toast-bottom-right", "closeButton": true});
    } else {
        $.ajax({
            type: "POST",
            url: hostname + "book-assistant",
            data: $("#book-assistant").serialize() + '&otp=' + otp,
            dataType: 'json',
            beforeSend: function () {
                $('.xhr-loading').css({'display':'block'});
            },
            success: function (data) {
                //$('#btn-confirm').html('Confirm');
                $('.xhr-loading').css({'display':'none'});
                if (data.code === 200) {
                    $("#staticBackdrop").modal('hide');
                    if(data.payment_mode == 1){
                        var unique_id = data.booking_id;
                        var options = {
                            key: data.key_id,
                            amount: (data.amount * 100),
                            name: data.name,
                            description: unique_id,
                            //image: "",
                            handler: function (response) {
                                $.ajax({
                                    url: hostname + 'update-transaction',
                                    type: 'post',
                                    dataType: 'json',
                                    beforeSend: function () {
                                        $('.xhr-loading').css({'display':'block'});
                                    },
                                    data: {
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        totalAmount: data.amount,
                                        unique_id: unique_id
                                    },
                                    success: function (msg) {
                                        window.location.href = hostname + 'booking-success/' + msg.booking_id;
                                    }
                                });
                            },
                            prefill: {
                                contact: $('#patient_mobile').val(),
                                email: $('#patient_email').val()
                            },
                            theme: {
                                color: "#002060"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    } else {
                        $.notify({
                            title: '<strong>Success !</strong>',
                            message: data.message
                        },{
                            type: "success"
                        });
                        setTimeout(function(){ 
                            window.location.href = hostname + 'booking-success/' + data.booking_id;
                            //$('#staticBackdrop').unblock();
                        }, 2000);
                    }
                } else {
                    $.notify({
                        title: '<strong>Error !</strong>',
                        message: data.message
                    },{
                        type: "danger"
                    });
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $('#staticBackdrop').unblock();
                console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
            } 
        });
    }
});

function checkDevice(){
    //1-Desktop, 2-Mobile
    let device = 1;
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        device = 2;
    }else{
        device = 1;
    }
    return device;
}

$("#show_password a").on('click', function(event) {
    event.preventDefault();
    if($('#show_password input').attr("type") == "text"){
        $('#show_password input').attr('type', 'password');
        $('#show_password i').addClass( "fa-eye-slash" );
        $('#show_password i').removeClass( "fa-eye" );
    }else if($('#show_password input').attr("type") == "password"){
        $('#show_password input').attr('type', 'text');
        $('#show_password i').removeClass( "fa-eye-slash" );
        $('#show_password i').addClass( "fa-eye" );
    }
});