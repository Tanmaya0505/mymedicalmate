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
                        <input type="file" accept="image/png, image/jpg, image/jpeg" name="prescription_photo" class="form-control" autofocus>
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
                                        <img src="{{ asset('frontend-source/images/upl-btn.png') }}">
                                    </label>
                                    <input type="file" name="photo_0" />
                                </div>
                                <input type="text" class="form-control" name="medicine[]" placeholder="Medicine Name">
                                <div class="input-group-prepend">
                                    <input type="text" class="form-control" name="quantity[]" placeholder="Quantity" />
                                </div>
                                <div class="input-group-prepend">
                                    <input type="button" class="form-control red-btn add-more" value="+">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="{{ old('full_name') }}">
                            @if ($errors->has('full_name'))
                            <div class="help-block">
                                <strong>{{ $errors->first('full_name') }}</strong>
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="mobile_no" placeholder="Mobile No" value="{{ old('mobile_no') }}">
                            @if ($errors->has('mobile_no'))
                            <div class="help-block">
                                <strong>{{ $errors->first('mobile_no') }}</strong>
                            </div>
                            @endif
                        </div>
                        <div class="row clearfix custom-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <select type="text" class="form-control" name="gender">
                                        <option value="">Gender</option>
                                        <option value="Male" @if(old('gender') == 'Male') selected="selected" @endif>Male</option>
                                        <option value="Female" @if(old('gender') == 'Female') selected="selected" @endif>Female</option>
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
                                    <input type="text" class="form-control" name="age" placeholder="Age" value="{{ old('age') }}">
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
                                <option value="1">Courier</option>
                                <option value="2">Transportation</option>
                            </select>
                            @if ($errors->has('ship_type'))
                            <div class="help-block">
                                <strong>{{ $errors->first('ship_type') }}</strong>
                            </div>
                            @endif
                        </div>
                        <div class="courier_ship">
                            <div class="row clearfix custom-row">
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
                        <div class="transportation_ship">
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
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="address" placeholder="Shipping Address"></textarea>
                            @if ($errors->has('address'))
                            <div class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="note" placeholder="Note" rows="4"></textarea>
                            @if ($errors->has('note'))
                            <div class="help-block">
                                <strong>{{ $errors->first('note') }}</strong>
                            </div>
                            @endif
                        </div>
                        <div class="btn-section mt30">
                            <button type="submit" class="btn btn-primary w-avg">Submit</button>
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
            let domEl = "<div class='rows'><div class='medicine-file'><label for='file-input'><img src='frontend-source/images/upl-btn.png'></label><input type='file' name='photo_"+count+"' /></div><input type='text' class='form-control' name='medicine[]' placeholder='Medicine Name'><div class='input-group-prepend'><input type='text' class='form-control' name='quantity[]' placeholder='Quantity'></div><div class='input-group-prepend'><input type='button' class='form-control red-btn add-more' value='+'></div></div>";
            $('#medicine').append(domEl);
        }
    });
    $(document).on('click', '#medicine .remove', function(){
        $(this).closest('.rows').remove();
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
