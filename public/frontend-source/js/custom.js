if(location.hostname == 'localhost'){
    var hostname = $(location).attr('origin')+'/medihelp/';
} else {
    var hostname = $(location).attr('origin')+'/';
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function selctState(val){
    $.ajax({
        type: "POST",
        url: hostname + "search-districts",
        data: {state:val},
        dataType: 'json',
        beforeSend: function () {
            $('.xhr-loading').fadeIn(400);
        },
        success: function (data) {
            $('.xhr-loading').fadeOut(400);
            if (data.code === 200) {
                //console.log(data);
                $('#sugg_district option').remove();
                $('#sugg_district').append($("<option></option>").attr("value", '').text('Select district'));
                $.each(data.data, function(key, value) {
                    $('#sugg_district').append($("<option></option>").attr("value", key).text(value));
                });
            } else {
               console.log(data);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            $('#staticBackdrop').unblock();
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
}

$('#post_suggetion').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: hostname + "submit-suggetion",
        data: $("#post_suggetion").serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('.xhr-loading').fadeIn(400);
        },
        success: function (data) {
            $('.xhr-loading').fadeOut(400);
            if (data.code === 200) {
                $("#suggForm").modal('hide');
                $('#post_suggetion')[0].reset();
                $.notify({
                    title: '<strong>Success !</strong>',
                    message: data.message
                },{
                    type: "success"
                });
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
});