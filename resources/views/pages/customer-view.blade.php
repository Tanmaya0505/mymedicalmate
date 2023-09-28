@extends('layouts.contentLayoutMaster')

{{-- page title --}}

@section('title','Users Edit')

{{-- vendor styles --}}

@section('vendor-styles')

<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">

@endsection



{{-- page styles --}}

@section('page-styles')

<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">

<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">

    .table td{

        padding: 5px;

    }

    .available_days {

        display: inline-block;

        width: calc(25% - 15%);

    }

    .available_days input, .is_bike_available input {

        width: 16px;

        height: 16px;

        float: left;

        margin-right: 3px;

        margin-top: 3px;

        cursor: pointer;

    }

    .is_bike_available {

        display: inline-block;

    }

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

</style>

@endsection



@section('content')

<!-- users edit start -->

<section class="users-edit">

    <div class="card">

        <div class="card-content">

            <div class="card-body">

                <ul class="nav nav-tabs mb-2" role="tablist">

                    <li class="nav-item">

                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab"

                           href="#account" aria-controls="account" role="tab" aria-selected="true">

                            <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">{{ $customer->first_name }} {{ $customer->last_name }} Account Details</span>

                        </a>

                    </li>

                </ul>

                <!--                <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">

                                    <div class="col-12 col-sm-4 p-2">

                                        <h6 class="text-primary mb-0">Request Accepted: <span class="font-large-1 text-info align-middle">00</span></h6>

                                    </div>

                                    <div class="col-12 col-sm-4 p-2">

                                        <h6 class="text-primary mb-0">Request Declined: <span class="font-large-1 text-danger align-middle">00</span></h6>

                                    </div>

                                    <div class="col-12 col-sm-4 p-2">

                                        <h6 class="text-primary mb-0">Request Completed: <span class="font-large-1 text-success align-middle">00</span></h6>

                                    </div>

                                </div>-->

                <div class="tab-content">

                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">

                        <!-- users edit media object start -->

                        <div class="media mb-2">

                            <a class="mr-2" href="#">

                                @php

                                if($customer->account_id == 1){

                                $path = 'user/';

                                } elseif($customer->account_id == 2){

                                $path = 'assistant/';

                                } elseif($customer->account_id == 3){

                                $path = 'doctor/';

                                } else {

                                $path = 'vendor/';

                                }

                                $photo = asset($path. @$meta['photo']);

                                if(empty($meta['photo']) || !file_exists(public_path($path. $meta['photo']))){

                                $photo = asset('frontend-source/images/assistant-boy-icon.png');

                                }

                                @endphp

                                <img src="{{ $photo }}" alt="users avatar"

                                     class="users-avatar-shadow rounded-circle" height="64" width="64">

                            </a>

                            <div class="media-body">

                                <table class="table table-borderless">

                                    <tbody>

                                        <tr>

                                            <td>Role:</td>

                                            <td>

                                                <span class="badge badge-light-info">@if(!empty($customer->accountType)) {{ $customer->accountType->account_name }} @else {{ 'Not Selected' }} @endif</span>

                                            </td>

                                            <td>Registered:</td>

                                            <td>{{ date('d M,Y' ,strtotime($customer->created_at)) }}</td>

                                            <td>Admin Status:</td>

                                            <td>

                                                <span class="badge @if($customer->admin_status == 0) badge-light-warning @else badge-light-success @endif">

                                                    @if($customer->admin_status == 0)

                                                    <span style="display: block;"><i class="bx bx-user"></i></span>

                                                    @else

                                                    <span style="display: block;"><i class="bx bx-user-check"></i></span>

                                                    @endif

                                                    {{ (new \App\Helpers\CustomerHelper)->customerAdminStatus($customer->admin_status) }}

                                                </span>

                                            </td>

                                            <td>Customer Status:</td>

                                            <td>

                                                <span class="badge @if($customer->status == 0) badge-light-warning @elseif($customer->status== 1) badge-light-success @else badge-light-danger @endif">

                                                    @if($customer->status == 0)

                                                    <span style="display: block;"><i class="bx bx-mail-send"></i></span>

                                                    @elseif($customer->status== 1)

                                                    <span style="display: block;"><i class="bx bx-user-check"></i></span>

                                                    @else

                                                    <span style="display: block;"><i class="bx bx-block"></i></span>

                                                    @endif

                                                    {{ (new \App\Helpers\CustomerHelper)->customerStatus($customer->status) }}

                                                </span>

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <!-- users edit media object ends -->

                        <!-- users edit account form start -->

                        <form novalidate method="POST" action="{{ url($configData['route'].'/customer-listing') }}" enctype="multipart/form-data" id="customer_form">

                            @csrf

                            <input type="hidden" name="id" value="{{ $customer->id }}" />

                            <input type="hidden" id="customer_status" value="{{ $customer->status }}" />


                            <div class="row">

                                @if($customer->account_id == 1)

                                {!! viewForm($userFormData[0], $meta, $path) !!}

                                @elseif($customer->account_id == 2)

                                {!! viewForm($assistantBoyFormData[0], $meta, $path) !!}

                                @elseif($customer->account_id == 3)

                                {!! viewForm($doctorFormData[0], $meta, $path) !!}

                                @elseif($customer->account_id == 4)

                                {!! viewForm($vendorFormData[0], $meta, $path) !!}

                                @elseif(Session::get('accountId') == 5)

                                {!! viewForm($deliveryboyFormData[0], $meta, $path) !!}

                                @endif



                                @if($customer->account_id != 1)

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>Admin Status</label>

                                        <select @if($customer->admin_status) disabled="" @endif class="form-control" name="admin_status">

                                                 <option value="0" @if($customer->admin_status == 0) selected @endif>PENDING</option>

                                            <option value="1" @if($customer->admin_status == 1) selected @endif>VERIFIED</option>

                                        </select>

                                        @if ($errors->has('admin_status'))

                                        <span class="help-block">

                                            <strong>{{ $errors->first('admin_status') }}</strong>

                                        </span>

                                        @endif

                                    </div>

                                </div>

                                @endif

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>Customer Status</label>

                                        <select class="form-control" name="status" onchange="customerStatus(this.value)">

                                            <option value="1" @if($customer->status == 1) selected @endif>ACTIVE</option>

                                            <option value="2" @if($customer->status == 2) selected @endif>RESTRICTED</option>
                                            <option value="3" @if($customer->status == 3) selected @endif>ALLOW TO EDIT</option>

                                        </select>

                                        @if ($errors->has('status'))

                                        <span class="help-block">

                                            <strong>{{ $errors->first('status') }}</strong>

                                        </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6 @if($customer->status == 1) d-none @else d-block @endif">

                                    <div class="form-group">

                                        <div class="controls">

                                            <label>Select a specific reason</label>

                                            <select class="form-control" name="restricted_reason" id="restricted_reason">

                                                <option value="">Select restricted reason</option>

                                                @foreach($restricted_msg as $val)

                                                <option value="{{ $val['value'] }}" @if($customer->restricted_reason == $val['value']) selected @endif>{{ $val['label'] }}</option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </div>

                    </div>

                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">

                        @if(!empty($customer->account_id))

                        <button type="submit" id="btn-submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save changes</button>

                        @endif

                        <a href="{{url($configData['route'].'/customer-listing')}}" class="btn btn-light">Back to Listing</a>

                    </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</section>

<!-- users edit ends -->


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
                    @csrf
                    <input type="hidden" name="cus_id" id="cus_id" value="" />
                    
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
                                        <option value="Friend">Friend</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Father">Father</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Relatives">Relatives</option>
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



{{-- vendor scripts --}}

@section('vendor-scripts')

<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>

@include('panels.msg')

<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>

<script src="{{asset('vendors/js/ui/blockUI.min.js')}}"></script>

@endsection



{{-- page scripts --}}

@section('page-scripts')

<script src="{{asset('js/scripts/pages/page-users.js')}}"></script>

<script src="{{asset('js/scripts/navs/navs.js')}}"></script>

<script src="{{asset('js/scripts/extensions/toastr.js')}}"></script>

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

@if($customer->account_id == 2 || $customer->account_id == 4)

<script>

$('.addreferance').on('click',function(){
    $('#add_referance').modal('show');
    $('#cus_id').val("{{$customer->id}}");
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

$("#add_referance_form .required").jqBootstrapValidation({
        preventSubmit: true,
        submitSuccess: function($form, event){  
        event.preventDefault();
            $.ajax({
                type: "POST",
                url:  "/cms-admin/add-referance",
                data: $("#add_referance_form").serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('.xhr-loading').css({'display':'block'});
                },
                success: function (data) {
                    if (data.code === 200) {
                        $('#add_referance').modal('hide');
                        $('#add_referance_form')[0].reset()
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
                            $('.reflist').html(html);

                        })
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

$('#from_time').timepicker({

});

$("#from_time").focus(function () {

    $('#from_time').next().trigger('click');

});

$('#from_time').on('change', function () {

    let from_time = $('#from_time').val();

    $('#from_time').val(tConvert(from_time));

});



$('#to_time').timepicker({

});

$("#to_time").focus(function () {

    $('#to_time').next().trigger('click');

});

$('#to_time').on('change', function () {

    let to_time = $('#to_time').val();

    $('#to_time').val(tConvert(to_time));

});





function tConvert(time) {

    // Check correct time format and split into components

    time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];



    if (time.length > 1) { // If time format correct

        time = time.slice(1);  // Remove full string match value

        time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM

        time[0] = +time[0] % 12 || 12; // Adjust hours

    }

    return time.join(''); // return adjusted time or original string

}



$(".payment_info").change(function () {

    if (this.value == 'Check') {

        $('.upi_block').addClass('d-none');

        $('.acc_trans_block').addClass('d-none');

        $('.payment_info_msg').html('<i class="fal fa-info-circle"></i> <small style="display: inline-block; font-style: italic;" class="form-text text-muted">You will collect your check from the office</small>');

    } else if (this.value == 'UPI Transfer') {

        $('.payment_info_msg').html('');

        $('.acc_trans_block').addClass('d-none');

        $('.upi_block').removeClass('d-none');

    } else if (this.value == 'Account Transfer') {

        $('.payment_info_msg').html('');

        $('.upi_block').addClass('d-none');

        $('.acc_trans_block').removeClass('d-none');

    } else {

        $('.payment_info_msg').html('');

        $('.upi_block').addClass('d-none');

        $('.acc_trans_block').addClass('d-none');

    }

});

$(document).ready(function () {

    $('.payment_info').after('<div class="payment_info_msg"></div>');



    //PAYMENT RESIVE INFORMATION

    if ($(".payment_info").children("option:selected").val() == 'Check') {

        $('.payment_info_msg').html('<i class="fal fa-info-circle"></i> <small style="display: inline-block; font-style: italic;" class="form-text text-muted">You will collect your check from the office</small>');

    } else if ($(".payment_info").children("option:selected").val() == 'UPI Transfer') {

        $('.upi_block').removeClass('d-none');

    } else if ($(".payment_info").children("option:selected").val() == 'Account Transfer') {

        $('.acc_trans_block').removeClass('d-none');

    } else {

        $('.payment_info_msg').html('');

        $('.upi_block').addClass('d-none');

        $('.acc_trans_block').addClass('d-none');

    }

});

</script>

@endif

@if($customer->account_id == 2)

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

    $('#All').click(function () {

        if (!check) {

            check = true;

            $(".available").prop("checked", true);

        } else {

            check = false;

            $(".available").prop("checked", false);

        }

    });



    $(".is_bike").change(function () {

        if (this.checked) {

            $('.is_bike').val(1);

            $('.bike_block').removeClass('d-none');

        } else {

            $('.is_bike').val(0);

            $('.bike_block').addClass('d-none');

        }

    });



    $(".declaration").change(function () {

        if (this.checked) {

            $('.declaration').val(1);

            $('#btn-submit').prop('disabled', false);

        } else {

            $('.declaration').val(0);

            $('#btn-submit').prop('disabled', true);

        }

    });



    $(document).ready(function () {

        //HAVE YOUR BIKE? 

        if ($(".is_bike").is(':checked')) {

            $('.is_bike').val(1);

            $('.bike_block').removeClass('d-none');

        } else {

            $('.is_bike').val(0);

            $('.bike_block').addClass('d-none');

        }



        //DECLARATION

        if ($(".declaration").is(':checked')) {

            $('.declaration').val(1);

            $('#btn-submit').prop('disabled', false);

        } else {

            $('.declaration').val(0);

            $('#btn-submit').prop('disabled', true);

        }

    });

</script>

@endif

<script>

    function customerStatus(value){

        $('#customer_status').val(value);

        if(value == 2){

            $("#restricted_reason").closest(".d-none").addClass("d-block").removeClass("d-none");

        } else {

            $("#restricted_reason").closest(".d-block").addClass("d-none").removeClass("d-block");

        }

    }

    $('form#customer_form').submit(function (e) {

        let status = $('#customer_status').val();

        if(status == 2){

            if($('#restricted_reason').val() == ''){

                e.preventDefault();

                if(!$('.restricted_reason_error').length){

                    $('#restricted_reason').after("<div class='restricted_reason_error text-danger text-truncate'>Please select the reason</div>");

                }

            }

        }

    });

    

    $('#restricted_reason').change(function(){

        if (this.value != '') {

            $('.restricted_reason_error').remove();

        } else {

            if(!$('.restricted_reason_error').length){

                $('#restricted_reason').after("<div class='restricted_reason_error text-danger text-truncate'>Please select the reason</div>");

            }

        }

    });

</script>

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

@endsection