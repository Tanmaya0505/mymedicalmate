/*Trideep Custome Script*/
//var hostname = $(location).attr('origin')+'/medihelp/cms-admin/';
//var domain = $(location).attr('origin')+'/medihelp/';
//Live
if(location.hostname == 'localhost'){
    var hostname = $(location).attr('origin')+'/medihelp/cms-admin/';
    var domain = $(location).attr('origin')+'/medihelp/';
} else {
    var hostname = $(location).attr('origin')+'/cms-admin/';
    var domain = $(location).attr('origin')+'/';
}
function assignVendor(prescription_id){
    $('#prescription_id').val(prescription_id);
    $('#vendor_data').html('');
    $("#assign-vendor").prop("disabled", true);
    $('#assign-vendor-form')[0].reset();
}

function filterVendor(){
    let dist = $('#dist').val();
    let categories = $('#categories').val();
    let discount = $('#discount').val();
//    console.log(dist,'dist');
//    console.log(discount,'discount'); return;
    $.ajax({
        type: "POST",
        url: hostname + "find-vendor",
        data: {dist: dist,categories:categories,discount:discount},
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
            $('#vendor_data').html('');
            $("#assign-vendor").prop("disabled", true);
            if (data.code === 200) {
                let assistant = JSON.parse(data.data);
                //console.log(assistant);
                $('#vendor_data').html('<div class="form-group"><div class="checkbox checkbox-success"style="margin-left: 5px;"><input type="checkbox" id="all_vendor"><label for="all_vendor" class="cursor-pointer checkbx-label">Select All</label></div><div class="table-responsive"><table class="table table-borderless mb-0" id="assistant_boys"></table></div></div>');
                $.each(assistant, function(key, item) {
                    $('#assistant_boys').append('<tr><td class="pr-0"><div class="align-items-center"><fieldset><div class="checkbox checkbox-success"><input type="checkbox" name="vendor_id[]" value="'+item.vendor_id+'" id="vendor_id_'+item.vendor_id+'"><label for="vendor_id_'+item.vendor_id+'" class="cursor-pointer checkbx-label"><img class="rounded-circle mr-1" src="'+domain+'vendor/'+item.vendor_image+'" alt="avatar" height="32" width="32"><div class="flex-content"> '+item.vendor_name+'</div></label></div></fieldset></div></td></tr>');
                });
                callback();
            } else {
                $('#vendor_data').html('<p class="text-danger">'+data.message+'</p>');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('#card').unblock();
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
}

function callback(){
    $("#all_vendor").change(function () {
        if ($(this).prop('checked')) {
            $('input[type=checkbox]').each(function () {
                $(this).prop('checked', true);
            });
        } else {
            $('input[type=checkbox]').each(function () {
                $(this).prop('checked', false);
            });
        }
    });
    
    $("input[type=checkbox]").change(function() {
        let len = $("input[name='vendor_id[]']:checked").length;
        if(len < $("#assistant_boys tr").length){
            $("#all_vendor").prop('checked', false);
        }
        if(len > 0){
            $("#assign-vendor").prop("disabled", false);
        } else {
            $("#assign-vendor").prop("disabled", true);
        }
    });
}

$('#assign-vendor').on('click', function(){
    $.ajax({
        type: "POST",
        url: hostname + "assign-vendor",
        data: $("#assign-vendor-form").serialize(),
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
                console.log(data);
                toastr.success(data.message, 'Congrats!', { positionClass: data.msg_position, "closeButton": true});
                setTimeout(function(){
                    location.reload(true);
                }, 3000);
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