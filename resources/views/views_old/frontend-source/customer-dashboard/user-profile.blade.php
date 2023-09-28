@extends('frontend-source.customer-dashboard.layouts.master')

@section('title') Dashboard @stop

@section('keywords') Dashboard @stop

@section('description') Dashboard @stop

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">

@if(Session::get('accountId') == 2)

<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

@endif

<style>

    .gj-textbox-md{

        border: 1px solid #ced4da;

        padding: .375rem .75rem;

    }

    .gj-textbox-md:focus {

        border-bottom: 1px solid #80bdff;

    }

    .gj-datepicker-md [role=right-icon], .gj-timepicker-md [role=right-icon]{

        top: 10px;

        right: 10px;

    }

    .form-group .help-block ul li::before {

        content: '';

    }

</style>

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

                    <div class="card-body">

                        <form novalidate method="POST" action="{{ url($account_prefix.'/user-profile') }}" enctype="multipart/form-data">

                            @csrf

                            <div class="row">

                                @if(Session::get('accountId') == 1)

                                    {!! viewForm($userFormData[0], $meta) !!}

                                @elseif(Session::get('accountId') == 2)

                                    {!! viewForm($assistantBoyFormData[0], $meta) !!}

                                @elseif(Session::get('accountId') == 3)

                                    {!! viewForm($doctorFormData[0], $meta) !!}

                                @elseif(Session::get('accountId') == 4)

                                    {!! viewForm($vendorFormData[0], $meta) !!}

                                @endif

                            </div>

                            <button type="submit" id="btn-submit" class="btn btn-primary pull-right">Update Profile</button>

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

                                    } else {

                                    $path = 'vendor/';

                                    }



                                    $photo = asset($path. $meta['photo']);

                                    if(empty($meta['photo']) || !file_exists(public_path($path. $meta['photo']))){

                                    $photo = asset('frontend-source/images/assistant-boy-icon.png');

                                    }

                                @endphp

                                <img class="avatar border-gray" src="{{ $photo }}" alt="...">

                                <h5 class="title">{{ $data->first_name." ".$data->last_name }}</h5>

                                @if($data->account_id != 1 && $data->admin_status == 1)

                                <div class="verified"><i class="fas fa-check-circle"></i> Verified</div>

                                @endif

                            </a>

                            <p class="description">Role - {{ $data->accountType->account_name }}</p>

                        </div>

                        @if(Session::get('accountId') == 2)

                        <div class="text-center online-btn">

                            Online <input type="checkbox" data-toggle="toggle" data-size="xs" id="online_status" name="online_status" @if($data->online_status == 1) checked @endif value="{{ $data->online_status ? 0 : 1 }}">

                        </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('script')

<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>

<script src="{{asset  ('js/scripts/forms/validation/form-validation.js')}}"></script>

@if(Session::get('accountId') == 2 || Session::get('accountId') == 4)

<script>

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



$(".payment_info").change(function(){

    if(this.value == 1){

        $('.upi_block').addClass('d-none');

        $('.acc_trans_block').addClass('d-none');

        $('.payment_info_msg').html('<i class="fal fa-info-circle"></i> <small style="display: inline-block; font-style: italic;" class="form-text text-muted">You will collect your check from the office</small>');

    } else if(this.value == 2){

        $('.payment_info_msg').html('');

        $('.acc_trans_block').addClass('d-none');

        $('.upi_block').removeClass('d-none');

    } else if(this.value == 3) {

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

    if(this.value != 1){

        if(!$('.state_error').length){

            $(this).after("<div class='state_error text-danger text-truncate small'>We will coming soon in this state</div>");

            $('#btn-submit').prop('disabled', true);

        }

    }

    if(this.value == 1 || this.value == ''){

        $(this).next().remove();

        $('#btn-submit').prop('disabled', false);

    }

});

$(document).ready(function() {

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

@if(Session::get('accountId') == 2)

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



$(".is_bike").change(function() {

    if(this.checked) {

        $('.is_bike').val(1);

        $('.bike_block').removeClass('d-none');

    } else {

        $('.is_bike').val(0);

        $('.bike_block').addClass('d-none');

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

    if($(".is_bike").is(':checked')){

        $('.is_bike').val(1);

        $('.bike_block').removeClass('d-none');

    } else {

        $('.is_bike').val(0);

        $('.bike_block').addClass('d-none');

    }

    

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

@endpush