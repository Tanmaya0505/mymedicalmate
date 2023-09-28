@extends('frontend-source.customer-dashboard.layouts.master')

@section('title') Bookings @stop

@section('keywords') Bookings @stop

@section('description') Bookings @stop

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">

<style type="text/css">
    
.input-group-prepend {
    margin-right: -1px;
}
.input-group-prepend {
    display: flex;
}

.upload_prescription {

    padding: 40px 0;

}



.upload_prescription .files input {

    outline: none;

    border: none;

    width: 100%;

    padding: 95px 0px 0px 33%;

    text-align: center;

    height: 180px;

    position: relative;

    background: none;

    z-index: 1;

}



.upload_prescription .files {

    position: relative;

    background: #fff;

    box-shadow: rgb(0 0 0 / 10%) 0px 1px 3px 0px, rgb(0 0 0 / 6%) 0px 1px 2px 0px;

    z-index: 1;

    border-radius: 10px;

}



.upload_prescription .medicine-file {

    background: #f5f5f5;

    border: 1px solid #ced4da;

    padding: 8px 15px;

    display: block;

    cursor: pointer;

    position: relative;

    z-index: 1;

    border-right: none;

}



.presc-row input {

    border-radius: 0px;

    border-right: none;

}



.upload_prescription .medicine-file label {

    margin-bottom: 0;

}



.upload_prescription .medicine-file>input[type=file] {

    position: absolute;

    left: 0;

    top: 0;

    opacity: 0;

    z-index: 1;

    width: 60px;

    height: 48px;

}



.upload_prescription .files:after {

    content: "";

    position: absolute;

    top: 20px;

    bottom: auto;

    left: 0;

    right: 0;

    width: 60px;

    height: 60px;

    background: url(../images/upload-pres1.png) no-repeat;

    margin: auto;

}



.upload_prescription .files:before {

    content: "Choose File or Image";

    position: absolute;

    margin: 0 auto;

    top: auto;

    bottom: 20px;

    left: 0;

    right: 0;

    text-align: center;

    opacity: 0.7;

    z-index: 1;

}



.upload_prescription .custom-ph ::placeholder {

    font-size: 12px;

}



.upload_prescription .red-btn {

    background: #ff4b4b;

    color: #fff;

    width: 40px;

    border: 1px;

    cursor: pointer;

}



.upload_prescription .prescription-gray-form {

    background: #fff;

    padding: 30px 20px;

    border-radius: 15px;

    box-shadow: rgb(0 0 0 / 10%) 0px 1px 3px 0px, rgb(0 0 0 / 6%) 0px 1px 2px 0px;

}
.wd-30{
    width:30%;
}
.wd-10{
    width:10%;
}
.marg-bot-10{
    margin-bottom: 10px;
}
</style>

@endsection

@section('content')
<div class="breadcrumb-sec">

    <div class="container">

        <div class="row clearfix">

            <div class="col-12 text-center">

                <h3>Upload  Prescription for {{@Request::segment(3)}}</h3>

                <!-- <p class="text-center">Seven days return policy is applicable on medicine order</p> -->

            </div>

        </div>

    </div>

</div>
<section class="upload_prescription">

    <div class="container">

        <div class="row clearfix card">

            <div class="col-12">

                <form method="POST" action="{{ url('assistant/upload-prescription') }}" enctype="multipart/form-data" id="upload-prescription" class="text-center">

                    @csrf
                        <input type="hidden" name="booking_id" value="{{@Request::segment(3)}}">
                    <div class="form-group files">

                        <input type="file" accept="image/png, image/jpg, image/jpeg, application/pdf, application/msword, application/vnd.ms-excel," name="prescription_photo"  id="prescription_photo" class="form-control" autofocus>

                    </div>

                    @if ($errors->has('prescription_photo'))

                    <div class="help-block">

                        <strong>{{ $errors->first('prescription_photo') }}</strong>

                    </div>

                    @endif



                    <div class="prescription-gray-form">

                        <p class="lead">Upload Your Patient Prescription only with valid information
Don’t upload outside prescription.</p>

                        <div class="input-group presc-row" id="medicine">
                            <ul class="d-flex flex-wrap med col-12 pl-0">
                                <li class="list-group-item d-flex justify-content-between align-items-center medicine-file col-2">
                                    <label for="file-input">
                                        <img height='20px' width='30px' id="img_0" src="{{ asset('frontend-source/images/upl-btn.png') }}">
                                    </label>
                                    <input type="file" accept="image/png, image/jpg, image/jpeg, application/pdf, application/msword, application/vnd.ms-excel," name="photo_0"  onchange="previewFile(this,0);" />
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-5">
                                    <input type="text" required="" class="form-control d-inline-block border-0" name="medicine[]" placeholder="Medicine Name"> 
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-3">
                                   <select class="form-control border-0" name="quantity[]" placeholder="Quantity" >
                                       <option value="1">Strip1</option>
                                       <option value="2">Strip2</option>
                                       <option value="3">Strip3</option>
                                       <option value="4">Strip4</option>
                                       <option value="5">Strip5</option>
                                       <option value="6">Strip6</option>
                                       <option value="7">Strip7</option>
                                       <option value="8">Strip8</option>
                                       <option value="9">Strip9</option>
                                       <option value="10">Strip10</option>

                                   </select>
                                </li>
                                <li class="list-group-item d-flex col-1 border-0">
                                 <input type="button" class="form-control red-btn add-more" value="+">
                                </li>
                            </ul>
                            <div class="rows col-12" id="medicine-append">
                                
                            </div>

                        </div>
                        <ul class="d-flex flex-wrap col-12 pl-0">
                            <li class="list-group-item d-flex justify-content-between align-items-center col-12">
                                    Booking Id :{{@Request::segment(3)}}
                                </li>
                        </ul>
                        <ul class="d-flex flex-wrap col-12 pl-0">
                            <li class="list-group-item d-flex justify-content-between align-items-center col-2 border-right-0 pr-0 mr-0">
                                    Patient Name :
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-10 border-left-0">
                                   <input type="text" class="form-control border-0" name="full_name" placeholder="Full Name" value="{{ old('full_name',$patient_details->patient_name) }}">
                                   
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-12 border-top-0">
                                   @if ($errors->has('full_name'))
                                    <div class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </div>
                                    @endif
                                </li>
                        </ul>
                        <ul class="d-flex flex-wrap col-12 pl-0">
                            <li class="list-group-item d-flex justify-content-between align-items-center col-2 border-right-0 pr-0 mr-0">
                                    Patient From :
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-10 border-left-0">
                                   <input type="text" class="form-control border-0" name="address" placeholder="Address" value="{{ old('address',@$patient_details->present_address) }}">
                                   
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-12 border-top-0">
                                   @if ($errors->has('address'))
                                    <div class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </div>
                                    @endif
                                </li>
                        </ul>
                        <!-- <ul class="d-flex flex-wrap col-12 pl-0">
                            <li class="list-group-item d-flex justify-content-between align-items-center col-2 border-right-0 pr-0 mr-0">
                                    Contact No :
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-10 border-left-0">
                                   <input type="text" class="form-control border-0" name="mobile_no" placeholder="Mobile No" value="{{ old('mobile_no',$patient_details->patient_mobile) }}">
                                   
                                </li>
                                
                        </ul> -->
                        
                        <input type="hidden" class="form-control border-0" name="mobile_no" placeholder="Mobile No" value="{{ old('mobile_no',$patient_details->patient_mobile) }}">
                        

                        <div class="row clearfix custom-row">

                            <div class="col-6">

                                <div class="form-group">

                                    <select type="text" required class="form-control" name="gender">

                                        <option value=""  >Gender</option>

                                        <option value="Male" @if(old('gender',$patient_details->gender) == 'Male') selected="selected" @endif>Male</option>

                                        <option value="Female" @if(old('gender',$patient_details->gender) == 'Female') selected="selected" @endif>Female</option>

                                    </select>

                                    @if ($errors->has('gender'))

                                    <div class="help-block">

                                        <strong>{{ $errors->first('gender') }}</strong>

                                    </div>

                                    @endif

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="form-group">

                                    <input type="text" class="form-control" name="age" placeholder="Age" value="{{ old('age',$patient_details->age) }}">

                                    @if ($errors->has('age'))

                                    <div class="help-block">

                                        <strong>{{ $errors->first('age') }}</strong>

                                    </div>

                                    @endif

                                </div>

                            </div>

                        </div>

                        <ul class="d-flex flex-wrap col-12 pl-0">
                            <li class="list-group-item d-flex justify-content-between align-items-center col-8 border-right-0 pr-0 mr-0">
                                    Purchase Medicines for? :
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-4 border-left-0">
                                   <select class="form-control border-0" name="no_of_quanity_day" >
                                        <option value="7">7 Days</option>
                                       <option value="15">15 Days</option>
                                       <option value="30" selected>30 Days</option>
                                       <option value="45">45 Days</option>
                                       <option value="60">60 Days</option>
                                           
                                   </select>
                                   
                                </li>
                                
                        </ul>

                        <ul class="d-flex flex-wrap col-12 pl-0">
                            <li class="list-group-item d-flex justify-content-between align-items-center col-5 ">
                                    Self-Pickup
                                    <input type="checkbox" required name="pickup" value="self">
                                </li>
                                
                                <li class="list-group-item d-flex justify-content-between align-items-center col-6 ml-1 ">
                                   <select class="form-control border-0" required="" name="no_of_quanity_day" >
                                    <option value="">Select Payment Type</option>
                                        <option value="Payment by Cash">Payment by Cash</option>
                                       <option value="Payment by QR/UPI">Payment by QR/UPI</option>
                                       <option value="Payment by A/C" >Payment by A/C</option>
                                   </select>
                                   
                                </li>
                                
                        </ul>

                        <!-- <div class="form-group">

                            <textarea class="form-control" name="note" placeholder="Note" rows="4"></textarea>

                            @if ($errors->has('note'))

                            <div class="help-block">

                                <strong>{{ $errors->first('note') }}</strong>

                            </div>

                            @endif

                        </div> -->

                        <div class="btn-section mt30">

                            <button type="submit" class="btn btn-primary w-avg">Submit & Search Medicine Store</button>

                        </div>

                    </div>



                </form>

            </div>

        </div>

    </div>

</section>



<!--Comment modal popup-->



<!--End Comment modal popup-->

@endsection

@push('script')

@push('script')

<script src="{{ asset('frontend-source/bootstrap/js/bootstrap-notify.min.js') }}" type="text/javascript" ></script>

<script>
    function previewFile(input,id){
        var file = $(input).get(0).files[0];
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg") {
            if(file){
                var reader = new FileReader();
     
                reader.onload = function(){
                    $("#img_"+id).attr("src", reader.result);
                }
     
                reader.readAsDataURL(file);
            }
        }else{
            $("#img_"+id).attr("src", 'frontend-source/images/upl-btn.png');
        }
    }
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

        let count = $('#medicine .med').length;

        //if(count <= 9){

            $(this).replaceWith("<input type='button' class='form-control red-btn remove' value='-'>");

            let domEl = '<ul class="d-flex flex-wrap med col-12 pl-0">\
                                <li class="list-group-item d-flex justify-content-between align-items-center medicine-file col-2">\
                                    <label for="file-input">\
                                        <img height="20px" width="30px" id="img_'+count+'" src="{{ asset('frontend-source/images/upl-btn.png') }}">\
                                    </label>\
                                    <input type="file" accept="image/png, image/jpg, image/jpeg, application/pdf, application/msword, application/vnd.ms-excel," name="photo_'+count+'"  onchange="previewFile(this,'+count+');" />\
                                </li>\
                                <li class="list-group-item d-flex justify-content-between align-items-center col-5">\
                                    <input type="text" class="form-control d-inline-block border-0" name="medicine[]" placeholder="Medicine Name">            </li>\
                                <li class="list-group-item d-flex justify-content-between align-items-center col-3">\
                                   <select class="form-control border-0" name="quantity[]" placeholder="Quantity" >\
                                       <option value="1">Strip1</option>\
                                       <option value="2">Strip2</option>\
                                       <option value="3">Strip3</option>\
                                       <option value="4">Strip4</option>\
                                       <option value="5">Strip5</option>\
                                       <option value="6">Strip6</option>\
                                       <option value="7">Strip7</option>\
                                       <option value="8">Strip8</option>\
                                       <option value="9">Strip9</option>\
                                       <option value="10">Strip10</option>\
                                   </select>\
                                </li>\
                                <li class="list-group-item d-flex col-1 border-0">\
                                 <input type="button" class="form-control red-btn add-more" value="+">\
                                </li>\
                            </ul>';

            $('#medicine:last').append(domEl);

        //}

    });

    $(document).on('click', '#medicine .remove', function(){

        $(this).closest('.med').remove();

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

@if(Session::has('success'))

<script>

    $.notify({

        title: '<strong>Success !</strong>',

        message: " {{ Session::get('success') }}"

    },{

        type: "success"

    });

</script>

@endif

@endpush