@extends('frontend-source.customer-dashboard.layouts.master')

@section('title') Dashboard @stop

@section('keywords') Dashboard @stop

@section('description') Dashboard @stop

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/css/progressbarwithstepper.css')}}">

@if(Session::get('accountId') == 2)

<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

<style>

  #progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 33%;
    float: left;
    position: relative;
    font-weight: 400
}  

#progressbar-edit li {
    list-style-type: none;
    font-size: 15px;
    width: 33%;
    float: left;
    position: relative;
    font-weight: 400
}  

</style>

@else

<style>

  #progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 50%;
    float: left;
    position: relative;
    font-weight: 400
}  

</style>
@endif
@endsection

@section('content')

<div class="content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">

                        <h4 class="card-title">User Profile</h4>

                        <p class="card-category">Complete your profile</p>

                    </div>

                    @php
                        $userconfig =[];
                        if($data->account_id == 1){

                        $path = 'user/';

                        } elseif($data->account_id == 2){

                        $path = 'assistant/';
                        $userconfig = \App\Helpers\CustomerHelper::configData('assistant_config');

                        } elseif($data->account_id == 3){

                        $path = 'doctor/';

                        } elseif($data->account_id == 4){

                        $path = 'vendor/';

                        }else {

                        $path = 'delivery-boy/';

                        }
                    @endphp

                    <div class="card-body">
                        

                        <form novalidate method="POST" action="{{ url($account_prefix.'/user-profile') }}" id="form" enctype="multipart/form-data">

                            @csrf
                            @if(Session::get('accountId') == 4 || Session::get('accountId') == 5)
                            @if($data->is_profile_setup==1)
                                <ul id="progressbar-edit">
                                        <li class="active" id="step1"><strong>Step 1</strong></li>
                                        <li class="active" id="step2"><strong>Step 2</strong></li>
                                </ul>
                                <div class="progress">
                                    <div class="progress-bar-edit" style="width:100%"></div>
                                </div> <br>
                            @else
                            <ul id="progressbar">
                                <li class="active" id="step1">
                                    <strong>Step 1</strong>
                                </li>

                                <li id="step2"><strong>Step 2</strong></li>
                                
                                
                            </ul>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div> <br>
                            @endif
                            @elseif(Session::get('accountId') == 2)
                                @if($data->is_profile_setup==1)
                                    <ul id="progressbar-edit">
                                        <li class="active" id="step1"><strong>Step 1</strong></li>
                                        <li class="active" id="step2"><strong>Step 2</strong></li>
                                        <li class="active" id="step3"><strong>Step 3</strong></li>
                                        
                                    </ul>
                                    <div class="progress">
                                        <div class="progress-bar-edit" style="width:100%"></div>
                                    </div> <br>
                                @else
                                    <ul id="progressbar">
                                        <li class="active" id="step1">
                                            <strong>Step 1</strong>
                                        </li>

                                        <li  id="step2"><strong>Step 2</strong></li>
                                        <li  id="step3"><strong>Step 3</strong></li>
                                        
                                    </ul>
                                    <div class="progress">
                                        <div class="progress-bar" ></div>
                                    </div> <br>
                                @endif
                            @endif
                            
                            

                            <div class="mainrow">

                                @if(Session::get('accountId') == 1)

                                    {!! viewForm($userFormData[0], $meta, $path, $data) !!}

                                @elseif(Session::get('accountId') == 2)

                                    {!! viewForm($assistantBoyFormData[0], $meta, $path, $data) !!}

                                @elseif(Session::get('accountId') == 3)

                                    {!! viewForm($doctorFormData[0], $meta, $path, $data) !!}

                                @elseif(Session::get('accountId') == 4)

                                    {!! viewForm($vendorFormData[0], $meta, $path, $data) !!}
                                @elseif(Session::get('accountId') == 5)

                                    {!! viewForm($deliveryboyFormData[0], $meta, $path, $data) !!}

                                @endif

                            </div>

                            @if(Session::get('accountId') == 1 || Session::get('accountId') == 3)

                            <button type="submit" id="btn-submit" class="btn btn-primary pull-right">Update Profile</button>
                            @endif

                        </form>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card card-user">

                    <div class="card-image">

                        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="...">

                    </div>

                    <div class="card-body">

                        <div class="author">

                            <a href="#">

                                @php

                                    if($data->account_id == 1){

                                    $path = 'user/';

                                    } elseif($data->account_id == 2){

                                    $path = 'assistant/';

                                    } elseif($data->account_id == 3){

                                    $path = 'doctor/';

                                    } elseif($data->account_id == 4) {

                                    $path = 'vendor/';

                                    } elseif($data->account_id == 5) {

                                        $path = 'delivery-boy/';

                                    }



                                    $photo = asset($path. @$meta['photo']);

                                    if(empty($meta['photo']) || !file_exists(public_path($path. $meta['photo']))){

                                    $photo = asset('frontend-source/images/assistant-boy-icon.png');

                                    }

                                @endphp

                                <form novalidate method="POST" action="{{ url($account_prefix.'/user-profile') }}" id="profile_form" enctype="multipart/form-data">
                                    <input type="hidden" name="only_photo" value="1">
                                @csrf
                                <a  href="javascript:void(0)"  onclick="getFile()">
                                    <img class="avatar border-gray" src="{{ $photo }}" alt="...">
                                </a>

                                <div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" type="file" name="photo" onchange="sub(this)" /></div>
                                </form>
                                <h5 class="title">{{ $data->first_name." ".$data->last_name }}</h5>

                                @if($data->account_id != 1 && $data->admin_status == 1)

                                <div class="verified"><i class="fas fa-check-circle"></i> Verified</div>

                                @endif

                            </a>
                             <p class="description">ID - {{ $data->customerId }}</p>
                            <p class="description">Role - {{ $data->accountType->account_name }}</p>
                            <p class="description">Referal Code - {{ @$data->referal->ref_code }}</p>
                            <p class="description">Total Coins - {{ @$data->total_coin ?? 0 }}</p>

                        </div>

                        @if(Session::get('accountId') == 2)

                        <div class="text-center online-btn">

                            Online <input type="checkbox" data-toggle="toggle" data-size="xs" id="online_status" name="online_status" @if($data->online_status == 1) checked @endif value="{{ $data->online_status ? 0 : 1 }}">

                        </div>

                        @endif

                    </div>
                </div>
                @if(Session::get('accountId') == 2)  
                <div class="card card-user">
                    <div class="card-body mt-4">
                        <a href="{{@$userconfig['insurance_link']}}" target="_blank" class="box"><img src="{{@$userconfig['insurance_link_image']}}" height="100px" width="200px" alt="Insurance Link"></a>
                    </div>

                </div>
                @endif
            </div>

        </div>

    </div>

</div>



<div class="modal fade" id="add_referance" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title text-uppercase" id="staticBackdropLabel"><i class="nc-icon nc-notes"></i> Referance</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body ">

                <div class="doctor-widget"></div>

                <form novalidate id="add_referance_form">

                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>First Name</label>
                                    <input type="text" value="" id="ref_first_name" name="ref_first_name" class="form-control required" placeholder="First Name" required="" data-validation-required-message="First Name required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>Last Name</label>
                                    <input type="text" value="" id="ref_last_name" name="ref_last_name" class="form-control required" placeholder="Last Name" required="" data-validation-required-message="Last Name required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>Email</label>
                                    <input type="text" value="" id="ref_email" name="ref_email" class="form-control required" placeholder="Email" required="" data-validation-required-message="Email required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>Phone Number</label>
                                    <input type="number" value="" id="ref_phone" name="ref_phone" class="form-control required" placeholder="Phone Number" maxlength="10" required="" data-validation-required-message="Phone required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>Whats App Number</label>
                                    <input type="text" value="" name="ref_whatsapp" class="form-control" placeholder="Whats App Number">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>Current Age?</label>
                                    <input type="text" value="" name="ref_age" class="form-control required" placeholder="Current Age?" required="" data-validation-required-message="Age required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>Relationship with you?</label>
                                    <select name="ref_relationship" class="form-control required" placeholder="Relationship with you" required="" data-validation-required-message="Relationship required">
                                        <option value="">Select option</option>
                                        <option value="Wife">Wife</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Father">Father</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Son">Son</option>
                                        <option value="Daughter">Daughter</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>Current Occupation</label>
                                    <select name="ref_cur_occupation" class="form-control required" placeholder="Current Occupation" required="" data-validation-required-message="Current Occupation required">
                                        <option value="">Select option</option>
                                        <option  value="Job">Job</option>
                                        <option value="Bussiness">Bussiness</option>
                                        <option value="Self Employed">Self Employed</option>
                                        <option value="Retired">Retired</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>Is this your Nominee?</label>
                                    <select name="ref_is_nominee" class="form-control required" placeholder="Is this your Nominee" required="" data-validation-required-message="Nominee required">
                                        <option  value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="controls">
                                    <label>OTP</label>
                                    <input type="text" value="" id="otp"  class="form-control" placeholder="Verify OTP Code">
                                </div>
                            </div>
                            <div class="otp_error"></div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary  mt-4 otpbtn">Send Otp</button>
                        
                            <button type="button" class="btn btn-primary d-none  mt-4  verifybtn">Verify</button>
                            <button type="button" class="btn btn-primary d-none mt-4 rsotpbtn">Resend Otp</button>
                        </div>
                    </div>


                    <div class="form-group">

                        <button type="submit" id="btn-add-ref" class="btn btn-primary btn-sm btn-fill d-none">Add</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection

@push('script')

<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
@if(Session::get('accountId') == 1 || Session::get('accountId') == 3)
<script src="{{asset  ('js/scripts/forms/validation/form-validation.js')}}"></script>
@endif
<script src="{{asset  ('frontend-source/js/progressbarwithstepper.js')}}"></script>

@if(Session::get('accountId') == 2 || Session::get('accountId') == 4 || Session::get('accountId') == 5)

<script>
@if($data->is_profile_setup==1)
        $('.steponehide,.steptwohide,.stepthreehide').hide();
@else
        $('.steponehide,.steptwohide,.stepthreehide').show();
@endif
$('.edittoshow').on('click',function(){

    var id = $(this).data('id');
    if(id==1){
      $('.steponehide').show(); 
      $('.steponeshow').hide(); 
    }
    if(id==2){
      $('.steptwohide').show(); 
      $('.steptwoshow').hide(); 
    }
    if(id==3){
      $('.stepthreehide').show(); 
      $('.stepthreeshow').hide(); 
    }

})

$('.addreferance').on('click',function(){
    var no_add_ref = $('.reflist').find('ul').length;
    if(no_add_ref < 3){
    $('#add_referance').modal('show');
    }
});

$(document).on('click','.remvref',function(){
    var id = $(this).data('id');

    var confm = confirm("Do you want to Permanently removed this Referance?");
    if(confm){
        $.ajax({
            type: "GET",
            url:  "/assistant/remove-referance/"+id,
            //data: $("#add_referance_form").serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('.xhr-loading').css({'display':'block'});
            },
            success: function (data) {
                if (data.code === 200) {
                    
                    var html = '';
                    $.each(data.data,function(index,item){
                        html += '<ul class="list-group col-md-10 card ml-5">';
                        html += '<li class="list-group-item d-flex justify-content-between align-items-center border-0"> Referance No :'+ (index+1)+'\
                                         <span class=""><a class="btn btn-danger  remvref" data-id="'+index+'" href="javascript:void(0)">Remove</a></span>\
                                        </li>';
                        $.each(item,function(ind,itm){
                            html += '<li class="list-group-item d-flex justify-content-between align-items-center border-0"> '+ data.ref_title[ind]+'\
                                         :<span class="">'+itm+'</span>\
                                        </li>';
                        });
                        html += '</ul>';
                        

                    });
                    $('.reflist').html(html);
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
});

$('#ref_phone').on('keyup',function(){
    $('#btn-add-ref').addClass('d-none').hide();
});

$('.otpbtn , .rsotpbtn').on('click',function(){
    $.ajax({
        type: "POST",
        url:  "/sendotp",
        data: {"email":$('#ref_email').val(),'phone':$('#ref_phone').val(),'name':$('#ref_first_name').val()+' '+$('#ref_last_name').val()},
        dataType: 'json',
        beforeSend: function () {
            $('.xhr-loading').css({'display':'block'});
        },
        success: function (data) {
            if (data.code === 200) {
                 $.notify({

                    icon: "nc-icon nc-check-2",

                    message: data.message

                },{

                    type: "success"

                });
                $('#otp').val(data.otp);
                $('.otpbtn').hide();
                $('.verifybtn').removeClass('d-none').show();
                $('.rsotpbtn').removeClass('d-none').show();
                
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
$('.verifybtn').on('click',function(){
    $.ajax({
        type: "POST",
        url:  "/verifyotp",
        data: {"otp":$('#otp').val()},
        dataType: 'json',
        beforeSend: function () {
            $('.xhr-loading').css({'display':'block'});
        },
        success: function (data) {
            if (data.code === 200) {
                $('.otp_error').html('');
                $('#otp').val('')
                 $.notify({

                    icon: "nc-icon nc-check-2",

                    message: data.message

                },{

                    type: "success"

                });
                 $('#btn-add-ref').removeClass('d-none').show();
                
            } else {
               $('.otp_error').html(data.message);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            $('#staticBackdrop').unblock();

            console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
        } 
    });
});

$('#from_time').timepicker({

});

$("#from_time").focus(function () {

    $('#from_time').next().trigger('click');

});

$('#from_time').on('change', function(){

    let from_time = $('#from_time').val();

    $('#from_time').val(tConvert(from_time));

});



$('#to_time').timepicker({

});

$("#to_time").focus(function () {

    $('#to_time').next().trigger('click');

});

$('#to_time').on('change', function(){

    let to_time = $('#to_time').val();

    $('#to_time').val(tConvert(to_time));

});





function tConvert(time) {

  // Check correct time format and split into components

  time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];



  if (time.length > 1) { // If time format correct

    time = time.slice (1);  // Remove full string match value

    time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM

    time[0] = +time[0] % 12 || 12; // Adjust hours

  }

  return time.join (''); // return adjusted time or original string

}
function demo_callback_function($el, value, callback) {
    callback({
      value: value,
      valid: $($el).is(":checked"),
      message: "Must start with 'a' and end with 'z'"
    });
  }



$(".is_dispatch_cod").change(function(){

    if(this.value == 'Yes'){
        $('#per_percel_charge').prop('checked',true);
    }else{
        $('#per_percel_charge').prop('checked',false);
    }
});


$(".payment_info").change(function(){ 

    if(this.value == 'Check'){

        $('.upi_block').addClass('d-none');

        $('.acc_trans_block').addClass('d-none');

        $('.payment_info_msg').html('<i class="fal fa-info-circle"></i> <small style="display: inline-block; font-style: italic;" class="form-text text-muted">You will collect your check from the office</small>');

    } else if(this.value == 'UPI Transfer'){

        $('.payment_info_msg').html('');

        $('.acc_trans_block').addClass('d-none');

        $('.upi_block').removeClass('d-none');

    } else if(this.value == 'Account Transfer') {

        $('.payment_info_msg').html('');

        $('.upi_block').addClass('d-none');

        $('.acc_trans_block').removeClass('d-none');

    } else {

        $('.payment_info_msg').html('');

        $('.upi_block').addClass('d-none');

        $('.acc_trans_block').addClass('d-none');

    }

});



$('select[name="state"]').change(function(){

    if(this.value != 'Odisha'){

        if(!$('.state_error').length){

            $(this).after("<div class='state_error text-danger text-truncate small'>We will coming soon in this state</div>");

            $('#btn-submit').prop('disabled', true);

        }

    }

    if(this.value == 'Odisha' || this.value == ''){

        $(this).next().remove();

        $('#btn-submit').prop('disabled', false);

    }

});
 $("#is_home_delivery").on('change',function() {
    
        if($(this).val()=='Yes') {
            $('.home_delivery').show();
            $('.home_delivery_req').addClass('required');

        } else {
            
           $('.home_delivery').hide();
           $('.home_delivery_req').removeClass('required');
        }

    });

$(document).ready(function() {

    $(document).on('change',".is_bike",function() {

        if(this.checked) {
            $(document).find('#dl_number').addClass('required');
            $(document).find('#vehicle_number').addClass('required');
            $('.is_bike').val(1);

             $('.bike_block').removeClass('d-none');

        } else {
            
            $('.bike_block').addClass('d-none');
            $('.is_bike').val(0);
            $(document).find('#dl_number').removeClass('required');
            $(document).find('#dl_number').parents('.form-group').removeClass('error');
            $(document).find('#vehicle_number').removeClass('required');
            $(document).find('#vehicle_number').parents('.form-group').removeClass('error');
        }

    });





    if($("#is_home_delivery").children("option:selected").val() == 'Yes'){

        $('.home_delivery').show();

    

    } else {

        $('.home_delivery').hide();

    }



    $('.payment_info').after('<div class="payment_info_msg"></div>');

    

    //PAYMENT RESIVE INFORMATION

    if($(".payment_info").children("option:selected").val() == 1){

        $('.payment_info_msg').html('<i class="fal fa-info-circle"></i> <small style="display: inline-block; font-style: italic;" class="form-text text-muted">You will collect your check from the office</small>');

    } else if($(".payment_info").children("option:selected").val() == 2){

        $('.upi_block').removeClass('d-none');

    } else if($(".payment_info").children("option:selected").val() == 3) {

        $('.acc_trans_block').removeClass('d-none');

    } else {

        $('.payment_info_msg').html('');

        $('.upi_block').addClass('d-none');

        $('.acc_trans_block').addClass('d-none');

    }

});

</script>

@endif

@if(Session::get('accountId') == 2 || Session::get('accountId') == 1 || Session::get('accountId') == 5)

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>

let maxdate = new Date();

maxdate.setDate(maxdate.getDate() - 6570);

$('#dob').datepicker({

    uiLibrary: 'materialdesign',

    inline: false,

    format: 'dd-mmmm-yyyy',

    maxDate: maxdate,

    modal: true,

    header: true,

    footer: true

});
$('.acc_trans_block').removeClass('d-none');
$('#NewJoiner').css('height',"0px");
$(document).ready(function() {
    $(document).on('change',".partnerCom",function() {
        if($(this).val()=='I m existing delivery boy'){
            $('.partnercompany').show();
            $('.partnercompany').removeClass('d-none');
            $(document).find('.partnerrequired').addClass('required');
            $(document).find('.partnerrequired').attr('minchecked',1);
            $('.partnerCom').parent('label').removeClass('active');
            $(this).parent('label').addClass('active');
            $('.partnerrequired').prop('checked',false);

        }else{ 
            $('.partnercompany').hide();
            $(document).find('.partnerrequired').removeClass('required');
            $(document).find('.partnercompany .form-group').removeClass('error').addClass('validate');
             $(document).find('.partnerrequired').removeAttr('aria-invalid');
             $(document).find('.partnerrequired').removeAttr('minchecked');
            $(document).find('.partnercompany .form-group .controls .help-block').remove();
            $('.partnerCom').parent('label').removeClass('active');
            $('.partnerrequired').prop('checked',false);
            $(this).parent('label').addClass('active');
            $('#NewJoiner').prop('checked',true);
            
        }
    });
});
</script>
@endif
@if(Session::get('accountId') == 2 )
<script>

// let maxdate = new Date();

// maxdate.setDate(maxdate.getDate() - 6570);

// $('#dob').datepicker({

//     uiLibrary: 'materialdesign',

//     inline: false,

//     format: 'dd-mmmm-yyyy',

//     maxDate: maxdate,

//     modal: true,

//     header: true,

//     footer: true

// });



let check = false;

$('#All').click(function() {

    if(!check){

        check = true;

        $(".available").prop("checked", true);

    } else {

        check = false;

        $(".available").prop("checked", false);

    }

}); 







$(".declaration").change(function() {

    if(this.checked) {

        $('.declaration').val(1);

        $('#btn-submit').prop('disabled', false);

    } else {

        $('.declaration').val(0);

        $('#btn-submit').prop('disabled', true);

    }

});



$(document).ready(function() {

    //HAVE YOUR BIKE? 

    // if($(".is_bike").is(':checked')){ alert(111);

    //     $('.is_bike').val(1);

    //     $('.bike_block').removeClass('d-none');

    // } else {

    //     $('.is_bike').val(0);

    //     $('.bike_block').addClass('d-none');

    // }

    

    //DECLARATION

    if($(".declaration").is(':checked')){

        $('.declaration').val(1);

        $('#btn-submit').prop('disabled', false);

    } else {

        $('.declaration').val(0);

        $('#btn-submit').prop('disabled', true);

    }

    

    //ONLINE AND OFFLINE

    $('input[type=checkbox][name=online_status]').change(function() {

        $.ajax({

            type: "POST",

            url: "online-status",

            data: {online_status : this.value},

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

    });

});

</script>

@endif
<script type="text/javascript">
    function getFile() {
        document.getElementById("upfile").click();
    }
function sub(obj) {
  var file = obj.value;
  var fileName = file.split("\\");

  var file = $(obj).get(0).files[0];
  console.log(file);
  var url = obj.value;
  var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
  
        if (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg") {
            var img = $('<img />', { 
                  id: 'Myid',
                  src: 'MySrc.gif',
                  alt: 'MyAlt',
                  height:'10px',
                  width:'10px'
                });
            if(file){
                var reader = new FileReader();
     
                reader.onload = function(){
                    img.attr('src', reader.result);
                    img.appendTo('#prev_receipt');
                    //$("#prev_receipt").attr("src", reader.result);
                }
     
                reader.readAsDataURL(file);
            }
        }else{
            document.getElementById("prev_receipt").innerHTML = fileName[fileName.length - 1];
        }

        $('#profile_form').submit();
  
}
</script>

@endpush