/*Trideep Custome Script*/
//var hostname = $(location).attr('origin')+'/medihelp/'+prefix+'/';
//Live
// if(location.hostname == 'localhost'){
//     var hostname = $(location).attr('origin')+'/medihelp/'+prefix+'/';
// } else {
    var hostname = $(location).attr('origin')+'/'+prefix+'/';
//}

function AcceptService(status,vendor_id,order_id){
    
    $('#accept_max_price').modal('show');
    
    $('#booking_id').val(order_id);
    $('#vendor_id').val(vendor_id);
    $('#status').val(status);
    
};

function AcceptServiceEdit(status,vendor_id,order_id){

    $('#accept_max_price_edit').modal('show');
    
    $('#booking_id').val(order_id);
    $('#vendor_id').val(vendor_id);
    $('#status').val(status);

}

$('form#estm-booking-form').submit(function (e) {
    e.preventDefault();
        let orderId = $('#estm-booking-form #booking_id').val();
        let vendorId = $('#estm-booking-form #vendor_id').val();
        let status = 2;//$('#estm-booking-form #status').val();
    
        $.ajax({
            type: "POST",
            url: hostname + "status-change/"+status+"/"+vendorId+"/"+orderId,
            data: $("#estm-booking-form").serialize(),
            //data:{'booking_id':$('#otp_book_booking_id').val(),'otp':otp,'user':2},
            dataType: 'json',
            beforeSend: function () {
                $('.xhr-loading').css({'display':'block'});
            },
            success: function (data) {
                //$('#btn-confirm').html('Confirm');
                $('.xhr-loading').css({'display':'none'});
                if (data.code === 200) {
                    $("#accept_max_price").modal('hide');
                    
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


