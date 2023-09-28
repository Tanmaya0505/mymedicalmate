/*Trideep Custome Script*/
//var hostname = $(location).attr('origin')+'/medihelp/cms-admin/';
//Live
if(location.hostname == 'localhost'){
    var hostname = $(location).attr('origin')+'/medihelp/cms-admin/';
    var hostname = $(location).attr('origin')+'/cms-admin/';
} else {
    var hostname = $(location).attr('origin')+'/cms-admin/';
}
//Category
$('form#general-info').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: hostname + "update-general-info",
        data: $("#general-info").serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('.card').block({
              message: '<span class="semibold"> Please wait...</span>',
              timeout: 2000, //unblock after 2 seconds
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
            //$('.card').unblock();
            if (data.code === 200) {
                toastr.success(data.message, 'Congrats!', { positionClass: data.msg_position, "closeButton": true});
            } else {
                toastr.error(data.message, 'Try again', { positionClass: data.msg_position, "closeButton": true});
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            //$('.card').unblock();
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});

$('form#change-password').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: hostname + "change-password",
        data: $("#change-password").serialize(),
        dataType: 'json',
        beforeSend: function () {
            //$("#loader").css({"display": "block"});
        },
        success: function (data) {
            if (data.code === 200) {
                $("#change-password")[0].reset();
                toastr.success(data.message, 'Congrats!', { positionClass: data.msg_position, "closeButton": true});
            } else {
                toastr.error(data.message, 'Try again', { positionClass: data.msg_position, "closeButton": true});
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});

$('form#update-user-config').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: hostname + "update-user-config",
        data: $("#update-user-config").serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('.card').block({
              message: '<span class="semibold"> Please wait...</span>',
              timeout: 2000, //unblock after 2 seconds
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
            if (data.code === 200) {
                toastr.success(data.message, 'Congrats!', { positionClass: data.msg_position, "closeButton": true});
            } else {
                toastr.error(data.message, 'Try again', { positionClass: data.msg_position, "closeButton": true});
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});

$('form#update-assistant-config').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: hostname + "update-assistant-config",
        data: $("#update-assistant-config").serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('.card').block({
              message: '<span class="semibold"> Please wait...</span>',
              timeout: 2000, //unblock after 2 seconds
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
            if (data.code === 200) {
                toastr.success(data.message, 'Congrats!', { positionClass: data.msg_position, "closeButton": true});
            } else {
                toastr.error(data.message, 'Try again', { positionClass: data.msg_position, "closeButton": true});
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});

$('form#update-doctor-config').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: hostname + "update-doctor-config",
        data: $("#update-doctor-config").serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('.card').block({
              message: '<span class="semibold"> Please wait...</span>',
              timeout: 2000, //unblock after 2 seconds
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
            if (data.code === 200) {
                toastr.success(data.message, 'Congrats!', { positionClass: data.msg_position, "closeButton": true});
            } else {
                toastr.error(data.message, 'Try again', { positionClass: data.msg_position, "closeButton": true});
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});

$('form#update-admin-config').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: hostname + "update-admin-config",
        data: $("#update-admin-config").serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('.card').block({
              message: '<span class="semibold"> Please wait...</span>',
              timeout: 2000, //unblock after 2 seconds
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
            if (data.code === 200) {
                toastr.success(data.message, 'Congrats!', { positionClass: data.msg_position, "closeButton": true});
            } else {
                toastr.error(data.message, 'Try again', { positionClass: data.msg_position, "closeButton": true});
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});

$('form#update-vendor-config').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: hostname + "update-vendor-config",
        data: $("#update-vendor-config").serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('.card').block({
              message: '<span class="semibold"> Please wait...</span>',
              timeout: 2000, //unblock after 2 seconds
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
            if (data.code === 200) {
                toastr.success(data.message, 'Congrats!', { positionClass: data.msg_position, "closeButton": true});
            } else {
                toastr.error(data.message, 'Try again', { positionClass: data.msg_position, "closeButton": true});
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});
