/*Trideep Custome Script*/
if(location.hostname == 'localhost'){
    var hostname = $(location).attr('origin')+'/medihelp/cms-admin/';
} else {
    var hostname = $(location).attr('origin')+'/cms-admin/';
}
function findServiceArea(bookingId){
    $('#booking_id').val(bookingId);
    $.ajax({
        type: "POST",
        url: hostname + "find-service-area",
        data: {id: bookingId},
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
                $('#service_area option').remove();
                $('#assistant_data').html('');
                $("#assign-assistant").prop("disabled", true);
                $("#border-less").modal('show');
                let serviceArea = JSON.parse(data.data).service_area;
                $.each(serviceArea, function(key, item) {
                    $('#service_area').append($("<option></option>").attr("value", item.option_value).text(item.option_label));
                });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('#card').unblock();
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
}

function selectServiceArea(value){
    let booking_id = $('#booking_id').val();
    $.ajax({
        type: "POST",
        url: hostname + "find-assistant",
        data: {service_area: value,booking_id: booking_id},
        dataType: 'json',
        beforeSend: function () {
            $('#border-less').block({
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
            $('#border-less').unblock();
            $('#assistant_data').html('');
            if (data.code === 200) {
                let assistant = JSON.parse(data.data);
                //console.log(assistant);
                $('#assistant_data').html('<div class="form-group"><label for="recipient-name" class="col-form-label">Select Assistant:</label><div class="table-responsive"><table class="table table-borderless mb-0" id="assistant_boys"></table></div></div>');
                $.each(assistant, function(key, item) {
                    $('#assistant_boys').append('<tr><td class="pr-0"><div class="align-items-center"><fieldset><div class="radio radio-success"><input type="radio" name="assistant_id" value="'+item.assistant_id+'" id="assistant_id_'+item.assistant_id+'"><label for="assistant_id_'+item.assistant_id+'" class="cursor-pointer"><img class="rounded-circle mr-1" src="'+item.assistant_image+'" alt="avatar" height="32" width="32"><div class="flex-content"> '+item.assistant_name+'</div></label></div></fieldset></div></td></tr>');
                });
                callback();
            } else {
                $("#assign-assistant").prop("disabled", true);
                $('#assistant_data').html('<p class="text-danger">'+data.message+'</p>');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('#card').unblock();
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
}

function callback(){
    $('input[type=radio][name=assistant_id]').change(function() {
        $("#assign-assistant").prop("disabled", false);
    });
}

$('#assign-assistant').on('click', function(){
    $.ajax({
        type: "POST",
        url: hostname + "assign-assistant",
        data: $("#assign-assistant-form").serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('#border-less').block({
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
            $("#border-less").modal('hide');
            $('#border-less').unblock();
            if (data.code === 200) {
                $('.ass_assign_'+ $('#booking_id').val()).html('<span title="Pending" class="badge badge-light-warning">Pending</span>');
                toastr.success(data.message, 'Congrats!', { positionClass: data.msg_position, "closeButton": true});
            } else {
                toastr.error(data.message, 'Try again', { positionClass: data.msg_position, "closeButton": true});
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('#card').unblock();
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});

function cancelBooking(dataId){
    let confirmCancel = confirm("Are you sure you want to cancel this booking");
    //let dataId = $(this).attr("data-id");
    if(dataId != '' && confirmCancel){
        $('#cancel_booking_id').val(dataId);
        $('#cancel-modal').modal('show');
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
                $('#cancel-modal').modal('hide');
                $('.modal-content').unblock();
                if (data.code === 200) {
                    toastr.success(data.message, 'Congrats!', { positionClass: data.msg_position, "closeButton": true});
                    setTimeout(function(){
                        location.reload(true);
                    }, 3000);
                } else {
                    toastr.error(data.message, 'Try again', { positionClass: data.msg_position, "closeButton": true});
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