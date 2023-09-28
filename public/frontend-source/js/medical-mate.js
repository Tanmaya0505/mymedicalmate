if(location.hostname == 'localhost'){
    var hostname = $(location).attr('origin')+'/medihelp/';
} else {
    var hostname = $(location).attr('origin')+'/';
}

$('form#filter-medicalmate').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: hostname + "filter-medicalmate",
        data: $("#filter-medicalmate").serialize(),
        dataType: 'json',
        beforeSend: function () {
            $('.xhr-loading').css({'display':'block'});
        },
        success: function (data) {
            if (data.code === 200) {
                console.log(data);
            } else {
               console.log(data);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            $('#staticBackdrop').unblock();
            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});