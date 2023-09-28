/*Trideep Custome Script*/
//var hostname = $(location).attr('origin')+'/medihelp/'+prefix+'/';
//Live
// if(location.hostname == 'localhost'){
//     var hostname = $(location).attr('origin')+'/medihelp/'+prefix+'/';
// } else {
    var hostname = $(location).attr('origin')+'/'+prefix+'/';
//}
function acceptBooking(dataId){
    let confirmAccept = confirm("Are you sure you want to Accept this booking");
    if(dataId != '' && confirmAccept){
        $.ajax({
            type: "POST",
            url: hostname + "accept-booking",
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
}

function acceptRequestBooking(dataId){
    
    let confirmAccept = confirm("Are you sure you want to Accept this booking");
    if(dataId != '' && confirmAccept){
        $.ajax({
            type: "POST",
            url: hostname + "accept-request-booking",
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
                    setTimeout(function(){
                        location.href='/assistant/bookings';
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
}

function declineRequestBooking(dataId){
    let confirmAccept = confirm("Are you sure you want to Decline this request");
    if(dataId != '' && confirmAccept){
        $.ajax({
            type: "POST",
            url: hostname + "decline-request-booking",
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
                    setTimeout(function(){
                        location.reload();
                        //location.href='/assistant/bookings';
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
}

function forwardRequest(dataId){
    let confirmAccept = confirm("Are you sure you want to Forward this request");
    if(dataId != '' && confirmAccept){
        $('#staticBackdrop').modal('show');
        $('#assistant_boy_fwrd_comment').val('');
        $('#booking_id').val(dataId);
    }
}

$('form#forward-booking-form').submit(function (e) {
    e.preventDefault();
    let reason = $('#assistant_boy_fwrd_comment').val();
    if(reason == ''){
        $('#assistant_boy_fwrd_comment').focus();
        $('.invalid-feedback').css({'display':'block'});
    } else {
        $.ajax({
            type: "POST",
            url: hostname + "forward-booking",
            data: $("#forward-booking-form").serialize(),
            dataType: 'json',
            beforeSend: function () {
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
                        window.location.href = hostname+"bookings";
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

$(document).ready(function() {
    $('input[type=checkbox][name=onbusy]').change(function() {
        if ($(this).is(':checked')) {
            $.ajax({
                type: "POST",
                url: hostname + "on-busy",
                data: {bookingId : this.value},
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

function completeService(dataId){
    //let confirmComplete = confirm("Are you sure you want to complete this booking");
    //let dataId = $(this).attr("data-id");
    $('#complete-confirm-service-modal').modal('show');
    $('.service-details').show();
    $('.complete-service').hide();
    $('#newinput').html("");
    $('#complete-confirm-service').trigger('reset');
    $('#confirm_servic_booking_id').val(dataId);
    // if(dataId != ''){
    //     $.ajax({
    //         type: "POST",
    //         url: hostname + "verify-booking-complete",
    //         data: {booking_id : dataId,'user':2},
    //         dataType: 'json',
    //         beforeSend: function () {
    //             $('.card').block({
    //               message: '<span class="semibold"> Please wait...</span>',
    //               overlayCSS: {
    //                 backgroundColor: '#fff',
    //                 opacity: 0.5,
    //                 cursor: 'wait'
    //               },
    //               css: {
    //                 border: 0,
    //                 padding: 0,
    //                 backgroundColor: 'transparent'
    //               }
    //             });
    //         },
    //         success: function (data) {
    //             $('.card').unblock();
    //             if (data.code === 200) {
    //                 $.notify({
    //                     icon: "nc-icon nc-check-2",
    //                     message: data.message
    //                 },{
    //                     type: "success"
    //                 });
    //                 $('#complete-book-service-modal').modal('show');
    //                 $('#otp_complete-book').val('');
    //                 $('#otp_book_booking_id').val(dataId);
    //             } else {
    //                 $.notify({
    //                     icon: "nc-icon nc-simple-remove",
    //                     message: data.message
    //                 },{
    //                     type: "danger"
    //                 });
    //                 setTimeout(function(){
    //                     location.reload(true);
    //                 }, 3000);
    //             }
    //         },
    //         error: function(XMLHttpRequest, textStatus, errorThrown) {
    //             //$('.card').unblock();
    //             console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
    //         } 
    //     });
    // }
};

$('form#complete-confirm-service').submit(function (e) {
    e.preventDefault();
    let booking_id = $('form#complete-confirm-service #confirm_servic_booking_id').val();
    
        $.ajax({
            type: "POST",
            url: hostname + "service-complete",
            data: $("#complete-confirm-service").serialize(),
            //data:{'booking_id':$('#otp_book_booking_id').val(),'otp':otp,'user':2},
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
                            location.href= '/assistant/bookings/'+booking_id;
                            //location.reload(true);
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
    
});

function completeBooking(dataId){
    
    if(dataId != ''){
        $.ajax({
            type: "POST",
            url: hostname + "verify-booking-complete",
            data: {booking_id : dataId,'user':2},
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
                    $('#otp_complete-book').val(data.otp);
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
    let booking_id = $('#otp_book_booking_id').val();
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
            data:{'booking_id':$('#otp_book_booking_id').val(),'otp':otp,'user':2,'paid_by':payment_mode},
            dataType: 'json',
            beforeSend: function () {
                $('.xhr-loading').css({'display':'block'});
            },
            success: function (data) {
                //$('#btn-confirm').html('Confirm');
                $('.xhr-loading').css({'display':'none'});
                if (data.code === 200) {
                    //$("#startserviceotp").modal('hide');
                    
                        $.notify({
                            title: '<strong>Success !</strong>',
                            message: data.message
                        },{
                            type: "success"
                        });
                        setTimeout(function(){ 
                            location.href= '/assistant/booking-success/'+booking_id;
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

function deliveryBooking(dataId){
    let confirmAccept = confirm("Are you sure you want to Delivered this booking");
    if(dataId != '' && confirmAccept){
        $.ajax({
            type: "POST",
            url: hostname + "delivery-booking",
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
}

function cancelPrescription(dataId){
    let confirmCancel = confirm("Are you sure you want to cancel this booking");
    //let dataId = $(this).attr("data-id");
    
            
    $('#booking_id').val(dataId);
    $('#staticBackdrop').modal('show');
                
}
$('form#cancel-booking-form').submit(function (e) {
    e.preventDefault();
    let cancel_reason = $('#cancel_reason').val();
    if(cancel_reason == ''){
        $('#cancel_reason').focus();
        $('.invalid-feedback').css({'display':'block'});
    } else {
        if(prefix=='user'){
            var url = hostname + "cancel-prescription";
        }else{
            var url = hostname + "cancel-booking";
        }
        $.ajax({
            type: "POST",
            url:url,
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
                        if(prefix=='user'){
                            location.reload();
                        }else{
                         location.href='/assistant/bookings/'+data.order_id;
                        }
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

function getCancel(dataId){
    let confirmCancel = confirm("Are you sure you want to cancel this booking");
    //let dataId = $(this).attr("data-id");
    
            
    $('#cancel-prescription-form #booking_id').val(dataId);
    $('#cancelPrescriptionPurchase').modal('show');
                
}

function getPayment(dataId){
    //let confirmCancel = confirm("Are you sure you want to cancel this booking");
    //let dataId = $(this).attr("data-id");
    
     $('.upionline').hide();       
    $('#payment-prescription-form #booking_id').val(dataId);
    $('#paymentPrescriptionPurchase').modal('show');
                
}

$('form#payment-prescription-form').submit(function (e) {
    e.preventDefault();
    var form = $(this)[0];
    var mydata = new FormData();
     var files = $('#upfile')[0].files;

    for(var i=0; i < form.elements.length; i++){
        var e = form.elements[i];
        var v = e.value;
        if(e.name!='receipt'){
            mydata.append(e.name,v);
        }
        //console.log(e.name+"="+e.value);
    }
        
    // Check file selected or not
    if(files.length > 0 ){
       mydata.append('file',files[0]);
   }
    // let cancel_reason = $('#cancel_reason').val();
    // if(cancel_reason == ''){
    //     $('#cancel_reason').focus();
    //     $('.invalid-feedback').css({'display':'block'});
    // } else {
        $.ajax({
            type: "POST",
            url: hostname + "payment-prescription",
            data: mydata,
            processData: false,
            contentType: false,
            dataType: "json",
            //dataType: 'json',
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
                    $('#btn-after-paid').show();
                    $('#btn-paid').prop('disabled',true);
                    // setTimeout(function(){
                    //     //location.href='/assistant/bookings/'+data.order_id;
                    // }, 3000);
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
    //}
});

$('.detailamt').click(function() {
        var order_id = $(this).data('id');
        var medicine_list = $(this).data('medicine');
       
        let domEl ='';
        $.each(medicine_list,function(count,item){
            console.log(item);
            domEl += '<ul class="d-flex flex-wrap col-12 pl-0 medicinelist">\
                                <li class="list-group-item d-flex justify-content-between align-items-center medicine-file col-2">\
                                    '+item.sl+'\
                                </li>\
                                <li class="list-group-item d-flex justify-content-between align-items-center col-5">\
                                    '+(item.name ? item.name :"--")+'</li>\
                                <li class="list-group-item d-flex justify-content-between align-items-center col-3">\
                                   '+item.available+'\
                                </li>\
                            </ul>';

        });
         

           //$('#medicine:last').append(domEl);
        $('#medicine').html(domEl);
         $('#Vendor_estimate_detail').modal('show');   
       
});
$('form#time-extend-service').submit(function (e) {
    e.preventDefault();
    
        $.ajax({
            type: "POST",
            url: hostname + "extend-time-booking",
            data: $("#time-extend-service").serialize(),
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
                        location.href='/assistant/bookings/'+data.order_id;
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
