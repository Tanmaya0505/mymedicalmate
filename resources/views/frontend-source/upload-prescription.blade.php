@extends('frontend-source.layouts.master')

@section('title') Upload prescription @stop

@section('keywords') Upload prescription @stop

@section('description') Upload prescription @stop

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/css/custom.css')}}">

<style type="text/css">

.help-block {

    font-size: 14px;

    color: #ff4b4b;

    font-weight: 300;

    text-align: left;

}

.courier_ship, .transportation_ship{

    display: none;

}

.rows {

    display: flex;

    width: 100%;

    margin-bottom: 20px;

}

.gj-textbox-md{

    border: 1px solid #ced4da;

    padding: .375rem .75rem;

}

.gj-textbox-md:focus {

    border-bottom: 1px solid #80bdff;

}

</style>

@endsection

@section('content')

<div class="hero text-center">

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">

            <div class="carousel-item active">

                <img src="{{ asset('frontend-source/images/hero1.jpg') }}" class="img-fluid">

            </div>

            <div class="carousel-item">

                <img src="{{ asset('frontend-source/images/hero2.jpg') }}" class="img-fluid">

            </div>

            <div class="carousel-item">

                <img src="{{ asset('frontend-source/images/hero3.jpg') }}" class="img-fluid">

            </div>

        </div>

        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">

            <span class="carousel-control-prev-icon" aria-hidden="true"></span>

            <span class="sr-only">Previous</span>

        </a>

        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">

            <span class="carousel-control-next-icon" aria-hidden="true"></span>

            <span class="sr-only">Next</span>

        </a>

    </div>

</div>

<div class="breadcrumb-sec">

    <div class="container">

        <div class="row clearfix">

            <div class="col-12 text-center">

                <h3>Upload Your Prescription</h3>

                <p class="text-center">Seven days return policy is applicable on medicine order</p>

            </div>

        </div>

    </div>

</div>

<section class="upload_prescription">

    <div class="container">

        <div class="row clearfix">

            <div class="col-12">

                <form method="POST" action="{{ url('upload-prescription') }}" enctype="multipart/form-data" id="upload-prescription" class="text-center">

                    @csrf

                    <div class="form-group files">

                        <input type="file" accept="image/png, image/jpg, image/jpeg, application/pdf, application/msword, application/vnd.ms-excel," name="prescription_photo" class="form-control" autofocus  >

                    </div>

                    @if ($errors->has('prescription_photo'))

                    <div class="help-block">

                        <strong>{{ $errors->first('prescription_photo') }}</strong>

                    </div>

                    @endif



                    <div class="prescription-gray-form">

                        <p class="lead">Indicate your medicine manually.</p>

                        <div class="input-group presc-row" id="medicine">

                            <div class="rows">

                                <div class="medicine-file">

                                    <label for="file-input">

                                        <img id="img_0" src="{{ asset('frontend-source/images/upl-btn.png') }}" height='20px' width='30px' >

                                    </label>

                                    <input type="file" data-id="0" accept="image/png, image/jpg, image/jpeg, application/pdf, application/msword, application/vnd.ms-excel," name="photo_0" onchange="previewFile(this,0);" />

                                </div>

                                <input type="text" class="form-control" name="medicine[]" placeholder="Medicine Name" required="">

                                <div class="input-group-prepend">

                                    <input type="text" class="form-control" name="quantity[]" placeholder="Quantity" required="" />

                                </div>

                                <div class="input-group-prepend">

                                    <input type="button" class="form-control red-btn add-more" value="+">

                                </div>

                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-3">
                                <label for="detail" class="control-label">Patient Details:</label>
                                
                                <label class="radio-inline">
                                    <input type="radio" name="detail" class="userdetail" value="self" /> Self
                                </label>
                                
                                <label class="radio-inline">
                                    <input type="radio" name="detail" class="userdetail" checked value="other" /> Other
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">

                            <input type="text" class="form-control" name="full_name" placeholder="Full Name" id="full_name" value="{{ old('full_name') }}">

                            @if ($errors->has('full_name'))

                            <div class="help-block">

                                <strong>{{ $errors->first('full_name') }}</strong>

                            </div>

                            @endif

                        </div>

                        <div class="form-group">

                            <input type="text" class="form-control" name="mobile_no" placeholder="Mobile No" id="mobile_no" value="{{ old('mobile_no') }}">

                            @if ($errors->has('mobile_no'))

                            <div class="help-block">

                                <strong>{{ $errors->first('mobile_no') }}</strong>

                            </div>

                            @endif

                        </div>

                        <div class="row clearfix custom-row">

                            <div class="col-6">

                                <div class="form-group">

                                    <select type="text" id="gender" class="form-control" name="gender">

                                        <option value="">Gender</option>

                                        <option value="Male" @if(old('gender') == 'Male') selected="selected" @endif>Male</option>

                                        <option value="Female" @if(old('gender') == 'Female') selected="selected" @endif>Female</option>
                                        <option value="Others" @if(old('gender') == 'Others') selected="selected" @endif>Others</option>

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

                                    <input type="text" id="age" class="form-control" name="age" placeholder="Age" value="{{ old('age') }}">

                                    @if ($errors->has('age'))

                                    <div class="help-block">

                                        <strong>{{ $errors->first('age') }}</strong>

                                    </div>

                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <select class="form-control" name="ship_type" onchange="shipType(this.value)">

                                <option value="">Medicine shipment by</option>

                                <option value="1">Self</option>

                                <option value="2">Other(Delivery Boy)</option>

                            </select>

                            @if ($errors->has('ship_type'))

                            <div class="help-block">

                                <strong>{{ $errors->first('ship_type') }}</strong>

                            </div>

                            @endif

                        </div>

                         <div class="courier_ship">

                            <div class="row clearfix custom-row">
                                <div class="col-12">
                                    <div class="form-group">

                                        <textarea class="form-control" name="address" id="address" placeholder="Delivery Address"></textarea>

                                        @if ($errors->has('address'))

                                        <div class="help-block">

                                            <strong>{{ $errors->first('address') }}</strong>

                                        </div>

                                        @endif

                                    </div>
                                </div>
                                <div class="col-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="city" placeholder="City" value="{{ old('city') }}">

                                        @if ($errors->has('city'))

                                        <div class="help-block">

                                            <strong>{{ $errors->first('city') }}</strong>

                                        </div>

                                        @endif

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="state" placeholder="State" value="{{ old('state') }}">

                                        @if ($errors->has('state'))

                                        <div class="help-block">

                                            <strong>{{ $errors->first('state') }}</strong>

                                        </div>

                                        @endif

                                    </div>

                                </div>

                            </div>

                            <div class="row clearfix custom-row">

                                <div class="col-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="zip" placeholder="Zip" value="{{ old('zip') }}">

                                        @if ($errors->has('zip'))

                                        <div class="help-block">

                                            <strong>{{ $errors->first('zip') }}</strong>

                                        </div>

                                        @endif

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="country" placeholder="Country" value="{{ old('country') }}">

                                        @if ($errors->has('country'))

                                        <div class="help-block">

                                            <strong>{{ $errors->first('country') }}</strong>

                                        </div>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                       <!-- <div class="transportation_ship">

                            <div class="row clearfix custom-row">

                                <div class="col-12">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="bus_name" placeholder="Enter the Bus Name" value="{{ old('bus_name') }}">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="from_arrival" id="from_arrival" placeholder="Arrival Time at cuttack" value="{{ old('from_arrival') }}">

                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="to_arrival" id="to_arrival" placeholder="Departure from cuttack" value="{{ old('to_arrival') }}">

                                    </div>

                                </div>

                            </div>

                        </div> -->

<!--                    

                        <div class="form-group">

                            <textarea class="form-control" name="note" placeholder="Note" rows="4"></textarea>

                            @if ($errors->has('note'))

                            <div class="help-block">

                                <strong>{{ $errors->first('note') }}</strong>

                            </div>

                            @endif

                        </div> -->

                        <div class="btn-section mt30">

                            <button type="submit" class="btn btn-primary btn-lg ">Submit & Search Medicine Store
</button>

                        </div>

                    </div>



                </form>

            </div>

        </div>

    </div>

</section>

@endsection

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

        if(value == 2){

            $('.courier_ship').css('display','block');

            $('#address').val('');

            $("input[name='bus_name']").val('');

            $("input[name='from_arrival']").val('');

            $("input[name='to_arrival']").val('');

        } else {

            $('#address').val('');

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

            let domEl = "<div class='rows'><div class='medicine-file'><label for='file-input'><img src='frontend-source/images/upl-btn.png' height='20px' width='30px' id='img_"+count+"'></label><input type='file' name='photo_"+count+"' onchange='previewFile(this,"+count+");' /></div><input type='text' required  class='form-control' name='medicine[]' placeholder='Medicine Name'><div class='input-group-prepend'><input type='text' required class='form-control' name='quantity[]' placeholder='Quantity'></div><div class='input-group-prepend'><input type='button' class='form-control red-btn add-more' value='+'></div></div>";

            $('#medicine').append(domEl);

        }

    });

    $(document).on('click', '#medicine .remove', function(){

        $(this).closest('.rows').remove();

    });

    $('.userdetail').on('change', function(){

        if($(this).is(':checked')){
            if($(this).val()=='self'){
                $.ajax({
                    type: "GET",
                    url: "/patient-details",
                    
                    dataType: 'json',
                    beforeSend: function () {
                        $('.xhr-loading').css({'display':'block'});
                    },
                    success: function (data) {
                        //$('#btn-confirm').html('Confirm');
                        $('.xhr-loading').css({'display':'none'});
                        if (data.code === 200) {
                            $('#full_name').val(data.meta.first_name+' '+data.meta.last_name);
                            $('#mobile_no').val(data.meta.phone);
                            $('#age').val(data.meta.age);
                            $('#gender option[value="'+data.meta.gender+'"]').attr('selected','selected');
                            
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
            }else{
                $('#full_name').val('');
                $('#mobile_no').val('');
                $('#age').val('');
            }
        }

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

