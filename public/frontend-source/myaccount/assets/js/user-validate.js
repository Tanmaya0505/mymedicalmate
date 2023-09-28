/*Trideep Custome Script*/
//var hostname = $(location).attr('origin')+'/medihelp/'+prefix+'/';
//Live
// if(location.hostname == 'localhost'){
//     var hostname = $(location).attr('origin')+'/medihelp/'+prefix+'/';
// } else {
    var hostname = $(location).attr('origin')+'/'+prefix+'/';
//}
function cancelBooking(dataId){
    let confirmCancel = confirm("Are you sure you want to cancel this booking");
    //let dataId = $(this).attr("data-id");
    if(dataId != '' && confirmCancel){
        $.ajax({
            type: "POST",
            url: hostname + "booking-info",
            data: {dataId : dataId},
            dataType: 'json',
            beforeSend: function () {
                $('.card').block({
                  message: '<span class="semibold"> Please wait...</span>',
                  overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.5,
                    cursor: 'wait'
                  },
                  css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                  }
                });
            },
            success: function (data) {
                $('.card').unblock();
                if(data.data.assistant_boy_meta){
                    let value = JSON.parse(data.data.assistant_boy_meta);
                    if(typeof value.first_name !== 'undefined' && typeof value.last_name !== 'undefined'){
                        var fullName = value.first_name+' '+value.last_name;
                    } else {
                        var fullName = value.name;
                    }
                    let name = fullName.toUpperCase();
                    
                    if(typeof value.dob !== 'undefined' && typeof value.gender !== 'undefined'){
                        let dob =  value.dob.split("/");
                        let date = new Date();
                        let currentYear = date.getFullYear();
                        var dobYearGender = '<li class="text-warning"><i class="nc-icon nc-single-02"></i> Age '+currentYear - dob[2]+' '+value.gender+'</li>';
                    } else {
                        var dobYearGender = '';
                    }
                    
                    if(typeof value.present_address !== 'undefined' && typeof value.dist !== 'undefined' && typeof value.state !== 'undefined' && typeof value.pincode !== 'undefined'){
                        var address = '<li class="text-muted"><i class="nc-icon nc-square-pin"></i> '+ value.present_address+', '+value.dist+', '+value.state+' ('+value.pincode+')'+'</li>';
                    } else {
                        var address = '';
                    }
                }
                
                if (data.code === 200) {

                    $('#booking_id').val(data.data.id);
                    if(data.data.assistant_boy_meta){
                        let value = JSON.parse(data.data.assistant_boy_meta);
                        if(value.photo && name && address && dobYearGender){
                        $('.doctor-widget').html('<div class="doc-info-left"><div class="doctor-img"><img src="'+ value.photo +'" class="img-fluid" alt="User Image"></div><div class="doc-info-cont"><h4 class="doc-name">'+ name +'</h4><ul>'+ dobYearGender +'<li class="text-info"><i class="nc-icon nc-tag-content"></i> #'+ data.data.booking_id+'</li>'+ address +'</ul></div></div>');
                        }
                    }
                    $('#staticBackdrop').modal('show');
                } else {
                    $.notify({
                        icon: "nc-icon nc-simple-remove",
                        message: data.message
                    },{
                        type: "danger"
                    });
                    setTimeout(function(){
                        location.reload(true);
                    }, 3000);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //$('.card').unblock();
                console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
            } 
        });
    }
};

$('form#cancel-booking-form').submit(function (e) {
    e.preventDefault();
    let cancel_reason = $('#cancel_reason').val();
    if(cancel_reason == ''){
        $('#cancel_reason').focus();
        $('.invalid-feedback').css({'display':'block'});
    } else {
        $.ajax({
            type: "POST",
            url: hostname + "cancel-booking",
            data: $("#cancel-booking-form").serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('#btn-confirm').html('Submitting...');
                $('.modal-content').block({
                  message: '<span class="semibold"> Please wait...</span>',
                  overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.5,
                    cursor: 'wait'
                  },
                  css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                  }
                });
            },
            success: function (data) {
                $('#staticBackdrop').modal('hide');
                $('.modal-content').unblock();
                if (data.code === 200) {
                    $.notify({
                        icon: "nc-icon nc-check-2",
                        message: data.message
                    },{
                        type: "success"
                    });
                    setTimeout(function(){
                        location.reload(true);
                    }, 3000);
                } else {
                    $.notify({
                        icon: "nc-icon nc-simple-remove",
                        message: data.message
                    },{
                        type: "danger"
                    });
                    setTimeout(function(){
                        location.reload(true);
                    }, 3000);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //$('.card').unblock();
                console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
            } 
        });
    }
});

function completeBooking(dataId){
    let confirmComplete = confirm("Are you sure you want to complete this booking");
    //let dataId = $(this).attr("data-id");
    if(dataId != '' && confirmComplete){
        $.ajax({
            type: "POST",
            url: hostname + "verify-booking-complete",
            data: {booking_id : dataId,'user':1},
            dataType: 'json',
            beforeSend: function () {
                $('.card').block({
                  message: '<span class="semibold"> Please wait...</span>',
                  overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.5,
                    cursor: 'wait'
                  },
                  css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                  }
                });
            },
            success: function (data) {
                $('.card').unblock();
                if (data.code === 200) {
                    $.notify({
                        icon: "nc-icon nc-check-2",
                        message: data.message
                    },{
                        type: "success"
                    });
                    $('#complete-book-service-modal').modal('show');
                    $('#otp_complete-book').val('');
                    $('#otp_book_booking_id').val(dataId);
                } else {
                    $.notify({
                        icon: "nc-icon nc-simple-remove",
                        message: data.message
                    },{
                        type: "danger"
                    });
                    setTimeout(function(){
                        location.reload(true);
                    }, 3000);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //$('.card').unblock();
                console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
            } 
        });
    }
};
$('form#complete-book-service').submit(function (e) {
    e.preventDefault();
    let payment_mode = $('#payment_mode').val();
    console.log(payment_mode,'payment_mode');
    let otp = $('#otp_complete-book').val();
    if(otp == ''){
        $('#otp_complete-book').focus();
        toastr.error('Please enter your OTP', 'Error', { positionClass: "toast-bottom-right", "closeButton": true});
    } else {
        $.ajax({
            type: "POST",
            url: hostname + "booking-complete",
            //data: $("#book-assistant").serialize() + '&otp=' + otp,
            data:{'booking_id':$('#otp_book_booking_id').val(),'otp':otp,'user':1},
            dataType: 'json',
            beforeSend: function () {
                $('.xhr-loading').css({'display':'block'});
            },
            success: function (data) {
                //$('#btn-confirm').html('Confirm');
                $('.xhr-loading').css({'display':'none'});
                if (data.code === 200) {
                    $("#startserviceotp").modal('hide');
                    
                        $.notify({
                            title: '<strong>Success !</strong>',
                            message: data.message
                        },{
                            type: "success"
                        });
                        setTimeout(function(){ 
                            location.reload(true);
                            //$('#staticBackdrop').unblock();
                        }, 2000);
                    
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
                $('#startserviceotp').unblock();
                console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
            } 
        });
    }
});
function startserviceRequest(dataId){
    let confirmAccept = confirm("Are you sure you want to Start this Service");
    if(dataId != '' && confirmAccept){
        

        $.ajax({
            type: "POST",
            url: hostname + "startservice-booking",
            data: {dataId : dataId},
            dataType: 'json',
            beforeSend: function () {
                $('.card').block({
                  message: '<span class="semibold"> Please wait...</span>',
                  overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.5,
                    cursor: 'wait'
                  },
                  css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                  }
                });
            },
            success: function (data) {
                $('.card').unblock();
                if (data.code === 200) {
                    $.notify({
                        icon: "nc-icon nc-check-2",
                        message: data.message
                    },{
                        type: "success"
                    });
                    $('#startserviceotp').modal('show');
                    $('#otp').val('');
                    $('#otp_booking_id').val(dataId);
                } else {
                    $.notify({
                        icon: "nc-icon nc-simple-remove",
                        message: data.message
                    },{
                        type: "danger"
                    });
                    setTimeout(function(){
                        location.reload(true);
                    }, 3000);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //$('.card').unblock();
                console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
            } 
        });
    
    }
}
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
            url: hostname + "poststartservice-booking",
            //data: $("#book-assistant").serialize() + '&otp=' + otp,
            data:{'booking_id':$('#otp_booking_id').val(),'otp':otp},
            dataType: 'json',
            beforeSend: function () {
                $('.xhr-loading').css({'display':'block'});
            },
            success: function (data) {
                //$('#btn-confirm').html('Confirm');
                $('.xhr-loading').css({'display':'none'});
                if (data.code === 200) {
                    $("#startserviceotp").modal('hide');
                    
                        $.notify({
                            title: '<strong>Success !</strong>',
                            message: data.message
                        },{
                            type: "success"
                        });
                        setTimeout(function(){ 
                            location.reload(true);
                            //$('#staticBackdrop').unblock();
                        }, 2000);
                    
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
                $('#startserviceotp').unblock();
                console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
            } 
        });
    }
});

function confirmAvlRequest(dataId){
    //let confirmCancel = confirm("Are you sure you want to Confirm this booking");
    //let dataId = $(this).attr("data-id");
    
            
    $('#avl_cnf_booking_id').val(dataId);
    $('#avl_cnf_booking_message').val('');
    $('#avl_cnf_booking_modal').modal('show');
}
$('form#avl_cnf_booking_form').submit(function (e) {
    e.preventDefault();
    
        $.ajax({
            type: "POST",
            url: hostname + "confirm-message-booking",
            data: $("#avl_cnf_booking_form").serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('#btn-confirm').html('Submitting...');
                $('.modal-content').block({
                  message: '<span class="semibold"> Please wait...</span>',
                  overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.5,
                    cursor: 'wait'
                  },
                  css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                  }
                });
            },
            success: function (data) {
                $('#avl_cnf_booking_modal').modal('hide');
                $('.modal-content').unblock();
                if (data.code === 200) {
                    $.notify({
                        icon: "nc-icon nc-check-2",
                        message: data.message
                    },{
                        type: "success"
                    });
                    setTimeout(function(){
                        location.href='/user/bookings/'+data.order_id;
                    }, 3000);
                } else {
                    $.notify({
                        icon: "nc-icon nc-simple-remove",
                        message: data.message
                    },{
                        type: "danger"
                    });
                    setTimeout(function(){
                        location.reload(true);
                    }, 3000);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //$('.card').unblock();
                console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
            } 
        });
    
});