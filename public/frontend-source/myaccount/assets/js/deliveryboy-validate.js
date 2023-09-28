/*Trideep Custome Script*/
//var hostname = $(location).attr('origin')+'/medihelp/'+prefix+'/';
//Live
// if(location.hostname == 'localhost'){
//     var hostname = $(location).attr('origin')+'/medihelp/'+prefix+'/';
// } else {
    var hostname = $(location).attr('origin')+'/'+prefix+'/';
//}
function acceptBooking(dataId,type){
    let confirmAccept = confirm("Are you sure you want to Accept this booking");
    if(dataId != '' && confirmAccept){
        $.ajax({
            type: "POST",
            url: hostname + "accept-booking",
            data: {dataId : dataId,'type':type},
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


function deliveryBooking(dataId){
    let confirmAccept = confirm("Are you sure you want to Delivered this Package");
    if(dataId != '' && confirmAccept){
        $.ajax({
            type: "GET",
            url: hostname + "delivery-booking/"+dataId,
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


    

