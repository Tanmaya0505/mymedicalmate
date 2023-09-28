@extends('frontend-source.layouts.master')
@section('title') Book Medical Mate @stop
@section('keywords') Book Medical Mate @stop
@section('description') Book Medical Mate @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/css/custom.css')}}">
<style>
    .gj-textbox-md{
        border: 1px solid #ced4da;
        padding: .375rem .75rem;
    }
    .gj-textbox-md:focus {
        border-bottom: 1px solid #80bdff;
    }
    .gj-datepicker-md [role=right-icon]{
        top: 14px;
        right: 14px;
    }
    #error_availability {
        color: #ff6262;
        font-size: 15px;
    }
    select.form-control.form-control-sm {
        height: 27px;
        padding: 0 2px;
        margin-left: 10px;
    }
    #booking-info{
        display: contents;
    }
    #booking-summery{
        display: none;
        margin-bottom: 30px;
    }
    #step-2, #step-3{
        display: none;
    }
</style>
@endsection
@section('content')
@php 
    $assistantconfig = \App\Helpers\CustomerHelper::configData('assistant_config');
    $pickup_pincode = explode(',',$assistantconfig['list_of_pincode']);

@endphp

<section class="assistant-slider">
    <div class="container">
        <div class="assistant-box-container slider">
            <div class="container-fluid">
        <div class="users-list-filter px-1">
            <form>
                <div class="row border rounded py-2 mb-2">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <label for="users-list-verified">Pin Code</label>
                        <fieldset class="form-group">
                            <select class="form-control" name="pincode" >
                                <option value="">All</option>
                                
                                    @foreach($pickup_pincode as $pinn)
                                        <option @if(@$_GET['pincode']==$pinn) selected @endif  >{{$pinn}}</option>
                                    @endforeach
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <label for="users-list-status">Booking Type</label>
                        <fieldset class="form-group">
                            <select class="form-control" name="booking_type" >
                                <option value="">All</option>
                                <option @if(@$_GET['booking_type']==1) selected @endif value="1"  >Day Booking (8 Hr)</option>
                                <option @if(@$_GET['booking_type']==2) selected @endif value="2"  >Night Booking (8 Hr)</option>
                                <option @if(@$_GET['booking_type']==3) selected @endif value="3"  >2 Shift Booking (16 Hr)</option>
                                <option @if(@$_GET['booking_type']==4) selected @endif value="4"  >Booking for 3 hour</option>
                                    
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <label for="users-list-role">Medmate Name</label>
                        <fieldset class="form-group">
                            <input type="text" name="name" placeholder="Medmate Name" class="form-control" value="{{@$_GET['name']}}">
                        </fieldset>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                        <button  type="submit" class="btn btn-primary btn-block glow users-list-clear mb-0">Search</button>
                    </div>
                </div>
            </form>
        </div>
                <div class="row">
                    @if(count($assistant))
                        @foreach($assistant as $key=>$val)
                            @php
                                $meta = json_decode($val->meta, true);
                                $data = \App\Helpers\CustomerHelper::decodeAssistantData($meta);
                                $photo = asset('assistant/'. @$data['photo']);
                                if(!file_exists(public_path('assistant/'. @$data['photo']))){
                                    $photo = asset('frontend-source/images/assistant-boy-icon.png');
                                }
                            @endphp
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="box-item">
                            <table>
                                <tr class="hl-header">
                                    <td style="width:40%;" class="text-left">
                                        <span class="verified">Medical Mate <i class="fas fa-check-circle"></i></span>
                                    </td>
                                    <td style="width:70%;" class="text-right" class="pickup">
                                        <img src="{{ asset('frontend-source/images/bike.png') }}" alt="">@if(isset($data['is_bike']) && $data['is_bike']) {{ @$data['km_range'] }} @else {{ '00-00 KM' }} @endif
                                    </td>
                                </tr>
                                    <tr class="ast-bx-flex">
                                        <td class="ast-img">
                                        <div class="item-image">
                                            <a href="{{ url('/medical-mate/'.$val->id) }}">
                                                <img src="{{ $photo }}" class="img-fluid" alt="">
                                            </a>
                                            <span>Age: {{ @$data['dob_year'] }} Yrs</span>
                                        </div>
                                    </td>
                                        <td class="ast-dtl">
                                        <div class="item-detail">
                                                <ul>
                                                    <li>Name: <Strong>{{ userfirstname(ucwords($data['first_name'])).' '.ucwords($data['last_name']) }}</Strong></li>
                                                    <li>From: <Strong>{{ @$data['present_address'] }}</Strong></li>
                                                    <li>Service Area: <Strong>{{ @$data['service_area'] }}</Strong></li>
                                                    <li>Service Charge: <Strong>{{ @$data['day_charges'] }} Day | {{ @$data['night_charges'] }} Night</Strong></li>
                                                    <li>Avl. in Days: <Strong>{{ str_replace(',', ' | ', @$data['available']) }}</Strong></li>
                                                <!--Rating: <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> 4.3 <br>-->
                                                </ul>
                                        </div>
                                    </td>
                                </tr>
                                    <tr>
                                    <td class="text-left">
                                        <a href="javascript:void(0)" data-id="{{$val->id}}"  class="card-link btn btn-primary btn-fill viewmedmate">Detail</a>
                                    </td>
                                    <td class="text-right">

                                       <a href="javascript:void(0)" data-id="{{$val->id}}"  class="card-link btn btn-primary btn-fill addvendor">Add</a>
                                    </td>
                                </tr>
                            </table>
                                </div>
                            </div>
                        @endforeach
                    @else
                            <h1>Sorry, no results found!</h1>
                    @endif
                </div>
                @if(count($assistant))
                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                    <!-- <form action="{{url('user/user-send-request/'.$id)}}" novalidate id="upcoming-appointments-form" method="post">
                                    @csrf -->
                    <button type="button" class="btn btn-success glow mr-sm-1 mb-1 btn-fill">Added<span id="total_vendor"></span></button>

                    <button type="button" id="total_vendor_send_otp" class="btn btn-success glow mr-sm-1 mb-1 btn-fill disabled">Send Now</button>
                   <!--  <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1 btn-fill">Send Now</button> -->
                        <!-- </form> -->
                </div>
                 @endif
        </div>
    </div>
</section>

<div class="modal fade" id="medmate_search_otp_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addMedicineLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title text-uppercase" id="addMedicineLabel"><i class="nc-icon nc-notes"></i> Verify OTP</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body" id="medmate_detail_otp">

                <div class="col-12">
                    <form action="{{url('user/user-send-request/'.$id)}}" novalidate id="upcoming-appointments-form" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="controls">
                                    <label>Otp</label>
                                    <input type="text" id="verify_otp"  name="otp"  class="form-control " required data-validation-required-message="This otp field is required" />
                                        
                                </div>
                            </div>
                        <button type="button" class="btn btn-success verifybtn glow mr-sm-1 mb-1 btn-fill" id="total_vendor_verify_otp">Verify</button>
                        <button type="button" class="btn btn-primary otpbtn glow mr-sm-1 mb-1 btn-fill" id="serch_medmate_send_otp">Send Otp</button>
                    </form>
                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="medmate_detail_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addMedicineLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title text-uppercase" id="addMedicineLabel"><i class="nc-icon nc-notes"></i> Medmate Details</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body" id="medmate_detail">

                

            </div>

        </div>

    </div>

</div>
@endsection
@push('script')
<script src="{{ asset('frontend-source/bootstrap/js/bootstrap-notify.min.js') }}" type="text/javascript" ></script>
<script src="{{ asset('vendors/js/ui/blockUI.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend-source/js/booking-validate.js') }}?v={{time()}}" type="text/javascript"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
   
       var vendor_list = [];
    $(document).on('click', '.addvendor', function(){

        let vendor_id = $(this).data('id');
        let vendor_name = $(this).text();
        if(vendor_name=='Added'){
                const newvendor_list = vendor_list.filter((el) => {
                    //console.log(el);
                        return vendor_id!=el;
                });
                //console.log(newvendor_list);
                vendor_list = newvendor_list;
            $(this).removeClass('btn-success').addClass('btn-primary').text('Add');
            
            $('#vendors_'+vendor_id+'').remove();
            if(vendor_list.length==0){
                    $('#total_vendor').text('');
                    $('#vendors').val("");
                    $('#total_vendor_send_otp').addClass('disabled');
            }else{
                    $('#total_vendor').text('('+vendor_list.length+')');
                    $('#vendors').val(vendor_list.toString());
                    $('#total_vendor_send_otp').removeClass('disabled');
            }
                //console.log(vendor_list);

        }else{
            vendor_list.push(vendor_id)
            $(this).removeClass('btn-primary').addClass('btn-success').text('Added');

            $('#total_vendor').text('('+vendor_list.length+')');
            $('#vendors').val(vendor_list.toString());
            $('#upcoming-appointments-form').append('<input type="hidden" name="vendorids[]" value="'+vendor_id+'" id="vendors_'+vendor_id+'">');
            $('#total_vendor_send_otp').removeClass('disabled');
        }

    });

    $(document).on('click', '.viewmedmate', function(){

        let medmate_id = $(this).data('id');
        let vendor_name = $(this).text();
        if(medmate_id != ''){
        $.ajax({
            type: "GET",
            url: "/medical-mate/"+medmate_id,
            //data: {dataId : dataId},
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
                    $('#medmate_detail').html(data.detail);
                   $('#medmate_detail_modal').modal('show');
                    

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

    });

    function shipType(value){

        if(value == 1){

            $('.courier_ship').css('display','block');

            $('.transportation_ship').css('display','none');

            $("input[name='bus_name']").val('');

            $("input[name='from_arrival']").val('');

            $("input[name='to_arrival']").val('');

        } else {

            $('.transportation_ship').css('display','block');

            $('.courier_ship').css('display','none');

            $("input[name='city']").val('');

            $("input[name='state']").val('');

            $("input[name='zip']").val('');

            $("input[name='country']").val('');

        }

    }

    $(document).on('click', '#medicine .add-more', function(){

        let count = $('#medicine .rows').length;

        if(count <= 9){

            $(this).replaceWith("<input type='button' class='form-control red-btn remove' value='-'>");

            let domEl = "<div class='rows'><div class='medicine-file'><label for='file-input'><img src='/frontend-source/images/upl-btn.png'></label><input type='file' accept='image/png, image/jpg, image/jpeg, application/pdf, application/msword, application/vnd.ms-excel,' name='photo_"+count+"' /></div><input type='text' class='form-control' name='medicine[]' placeholder='Medicine Name'><div class='input-group-prepend'><input type='text' class='form-control' name='quantity[]' placeholder='Quantity'></div><div class='input-group-prepend'><input type='button' class='form-control red-btn add-more' value='+'></div></div>";

            $('#medicine').append(domEl);

        }

    });

    $(document).on('click', '#medicine .remove', function(){

        $(this).closest('.rows').remove();

    });

    $(document).on('click','#total_vendor_send_otp', function(){ 
        $('#medmate_search_otp_modal').modal('show');
    });

    $('.otpbtn').on('click',function(){
        $.ajax({
            type: "POST",
            url:  "/sendotp",
            data: {"email":"{{ $customer_meta['patient_email'] }}",'phone':"{{ $customer_meta['patient_mobile'] }}",'name':"{{ $customer_meta['patient_name'] }}"},
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
                    $('#verify_otp').val(data.otp);
                    $('.xhr-loading').css({'display':'none'});
                    
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
        data: {"otp":$('#verify_otp').val()},
        dataType: 'json',
        beforeSend: function () {
            $('.xhr-loading').css({'display':'block'});
        },
        success: function (data) {
            if (data.code === 200) {
                $('.otp_error').html('');
                $('#verify_otp').val('')
                 $.notify({

                    icon: "nc-icon nc-check-2",

                    message: data.message

                },{

                    type: "success"

                });
                 $('#medmate_search_otp_modal').modal('hide');
                // $('.xhr-loading').css({'display':'none'});

                 $('#upcoming-appointments-form').submit();
                
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



//Time Picker

$('#from_arrival').timepicker({

});

$("#from_arrival").focus(function () {

    $('#from_arrival').next().trigger('click');

});

$('#from_arrival').on('change', function(){

    let from_time = $('#from_arrival').val();

    $('#from_arrival').val(tConvert(from_time));

});



$('#to_arrival').timepicker({

});

$("#to_arrival").focus(function () {

    $('#to_arrival').next().trigger('click');

});

$('#to_arrival').on('change', function(){

    let to_time = $('#to_arrival').val();

    $('#to_arrival').val(tConvert(to_time));

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
   
</script>
@endpush