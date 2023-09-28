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
<section class="assistant-slider">
    <div class="container">
        <div class="assistant-box-container slider">
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
                    <form action="{{url('user/user-send-request/'.$id)}}" novalidate id="upcoming-appointments-form" method="post">
                                    @csrf
                    <button type="button" class="btn btn-success glow mr-sm-1 mb-1 btn-fill">Added<span id="total_vendor"></span></button>
                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1 btn-fill">Send Now</button>
                        </form>
                </div>
                 @endif
        </div>
    </div>
</section>
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
            }else{
                    $('#total_vendor').text('('+vendor_list.length+')');
                    $('#vendors').val(vendor_list.toString());
            }
                //console.log(vendor_list);

        }else{
            vendor_list.push(vendor_id)
            $(this).removeClass('btn-primary').addClass('btn-success').text('Added');

            $('#total_vendor').text('('+vendor_list.length+')');
            $('#vendors').val(vendor_list.toString());
            $('#upcoming-appointments-form').append('<input type="hidden" name="vendorids[]" value="'+vendor_id+'" id="vendors_'+vendor_id+'">');
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