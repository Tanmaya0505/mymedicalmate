@extends('frontend-source.customer-dashboard.layouts.master')

@section('title') Bookings @stop

@section('keywords') Bookings @stop

@section('description') Bookings @stop

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">

<style type="text/css">
    /*.upload_prescription{
    padding:40px 0;
    .files input {
        outline: none;
        border: 1px dashed #d7d7d7;
        border-radius: 10px;
        width: 100%;
        padding: 95px 0px 0px 33%;
        text-align: center;
        height: 180px;
    }
    .files{
        position:relative;
    }
    .files:after {
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
    .files:before {
        content: "Choose File or Image";
        position: absolute;
        margin: 0 auto;
        top: auto;
        bottom: 20px;
        left: 0;
        right: 0;
        text-align: center;
    }
    .custom-ph{
        ::placeholder {
            font-size: 12px;
        }
    }
    .red-btn{
        background: #ff4b4b;
        color: #fff;
    }

}*/
.input-group-prepend {
    margin-right: -1px;
}
.input-group-prepend {
    display: flex;
}
/*#prescription_photo{
    height: 100px;
    text-align: center;
     margin: auto;
     position: absolute;
     top: 50%; 
}*/
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

</style>

@endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Vendor List</h4>
                
                <div class="appointment-tab">
                    <div class="tab-content">
                        <!-- Upcoming Appointment Tab -->
                        <div class="tab-pane show active" id="upcoming-appointments">
                            <div class="card card-table mb-0">
                                <form action="{{url('assistant/medmate-send-request/'.$id)}}" novalidate id="upcoming-appointments-form" method="post">
                                    @csrf
                                    <div class="card-body">
                                        @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
                                        <div class="table-responsive">
                                            <table class="table table-hover table-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Vendor Name</th>
                                                        <!-- <th>Rating</th> -->
                                                        <th>Discount</th>
                                                        <th>Address</th>
                                                        <!-- <th>Status</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($vendors as $key=>$value)
                                                    @php
                                                        $full_name = ucwords($value->first_name);
                                                        $meta = json_decode($value->meta);
                                                    @endphp
                                                    @if($meta->name_of_store)
                                                    <tr>
                                                        
                                                        <td title="{{  $full_name }}">
                                                            <input type="checkbox" name="vendorids[]" value="{{$value->id}}">
                                                            {{ $meta->name_of_store ?? $full_name }}
                                                            
                                                        </td>
                                                       <!--  <td></td> -->
                                                        <td>@if($meta->discount) {{$meta->discount}}% @else -- @endif</td>
                                                        <td>{{$meta->store_address ? $meta->store_address : '--'}}</td>
                                                        <!-- <td>
                                                            @if($value->online_status==1)
                                                                Online
                                                            @endif
                                                        </td> -->
                                                        
                                                        
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>        
                                        </div>
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Send Request</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /Upcoming Appointment Tab -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@push('script')

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

            let domEl = "<div class='rows'><div class='medicine-file'><label for='file-input'><img src='/frontend-source/images/upl-btn.png'></label><input type='file' accept='image/png, image/jpg, image/jpeg, application/pdf, application/msword, application/vnd.ms-excel,' name='photo_"+count+"' /></div><input type='text' class='form-control' name='medicine[]' placeholder='Medicine Name'><div class='input-group-prepend'><input type='text' class='form-control' name='quantity[]' placeholder='Quantity'></div><div class='input-group-prepend'><input type='button' class='form-control red-btn add-more' value='+'></div></div>";

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