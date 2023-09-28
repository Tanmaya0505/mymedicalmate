@extends('frontend-source.customer-dashboard.layouts.master')

@section('title') Prescription Details @stop

@section('keywords') Prescription Details @stop

@section('description') Prescription Details @stop

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">

@endsection

@section('content')

<div class="content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <h4 class="mb-4">PRESCRIPTION DETAILS</h4>

                @php

                $customer_meta = json_decode($value->customer_meta, true);

                @endphp

                <div class="card">

                    <div class="card-body booking-details-body">

                        <div class="row">

                            <div class="col-xl-5">

                                <div class="row">

                                    <div class="col-12">

                                        <div class="widget about-widget">

                                            
                                            <p class="m-0">Patient: <strong>{{ $customer_meta['patient_name'] }}</strong></p>
                                            <p class="m-0">From: <strong>{{ $customer_meta['patient_from'] }}</strong></p>

                                            <p class="m-0">Mobile Number: <strong>+91

                                                    {{ $customer_meta['patient_mobile'] }}</strong></p>

                                            

                                            <p class="m-0">Email: <strong>{{ $customer_meta['patient_email'] }}</strong></p>

                                            <p class="m-0">Gender: <strong>{{ $customer_meta['gender'] }}</strong></p>

                                            <p class="m-0">Age: <strong>{{ $customer_meta['age'] }}</strong></p>

                                             
                                             <a class="btn btn-primary chkstatus" data-id="{{$value->booking_id}}" href="">Check Status</a>

                                             <a class="btn btn-primary chkstatus" href="{{url('direct-booking/search-medmate/'.$value->booking_id)}}" data-id="{{$value->booking_id}}" href="">Re-search</a>
                                                

                                        </div>

                                    </div>

                                    

                                    <div class="clearfix"></div>

                                </div>
                                @if(Session::get('check_prescription_status')==1)
                                <div class="row">
                                    @foreach($value->medmaterequestlists as $key=>$val)
                                        @php
                                            $full_name = ucwords($val->medmate->first_name);

                                            $meta = json_decode($val->medmate->meta,1);
                                            $data = \App\Helpers\CustomerHelper::decodeAssistantData($meta);
                                        @endphp
                                        
                                        <div class="card col-12 " >
                                            <div class="card-body">
                                                
                                            <p>Name: <Strong>{{ userfirstname(ucwords($data['first_name'])).' '.ucwords($data['last_name']) }}</Strong></p>
                                            <p>From: <Strong>{{ @$data['present_address'] }}</Strong></p>
                                            <p>Service Area: <Strong>{{ @$data['service_area'] }}</Strong></p>
                                            <p>Service Charge: <Strong>{{ @$data['day_charges'] }} Day | {{ @$data['night_charges'] }} Night</Strong></p>
                                            <p>Avl. in Days: <Strong>{{ str_replace(',', ' | ', @$data['available']) }}</Strong></p>
                                                
                                            </div>
                                            <div class="card-footer">
                                                <span class="card-link"><i class="fa fa-map-marker" aria-hidden="true"></i> 5 Km</span>
                                                <a href="javascript:void(0)" data-id="{{$value->id}}"  class="card-link btn btn-primary btn-fill ">
                                                    @if($val->status==1)
                                                    Accepted
                                                    @elseif($val->status==0)
                                                    Not Seen
                                                    @elseif($val->status==2)
                                                    Cancelled
                                                    @endif

                                            </a>
                                            </div>
                                        </div>

                                        
                                    @endforeach
                                        
                                   
                                </div>
                                @endif

                                @if(Session::get('check_prescription_status')==2)
                                <div class="row">
                                     @foreach($value->medmaterequestlists as $key=>$val)
                                        @php
                                            $full_name = ucwords($val->medmate->first_name);

                                            $meta = json_decode($val->medmate->meta,1);
                                            $data = \App\Helpers\CustomerHelper::decodeAssistantData($meta);
                                        @endphp
                                        
                                        <div class="card col-12 " >
                                            <div class="card-body">
                                                
                                            <p>Name: <Strong>{{ ucwords($data['first_name'].' '.$data['last_name']) }}</Strong></p>
                                            <p>From: <Strong>{{ @$data['present_address'] }}</Strong></p>
                                            <p>Service Area: <Strong>{{ @$data['service_area'] }}</Strong></p>
                                            <p>Service Charge: <Strong>{{ @$data['day_charges'] }} Day | {{ @$data['night_charges'] }} Night</Strong></p>
                                            <p>Avl. in Days: <Strong>{{ str_replace(',', ' | ', @$data['available']) }}</Strong></p>
                                                
                                            </div>
                                            <div class="card-footer">
                                                <!-- <span class="card-link"><i class="fa fa-map-marker" aria-hidden="true"></i> 5 Km</span> -->
                                                <a href="javascript:void(0)" data-id="{{$value->id}}"  class="card-link btn btn-primary btn-fill ">
                                                    @if($val->status==1)
                                                    Accepted
                                                    @elseif($val->status==0)
                                                    Not Seen
                                                    @endif

                                            </a>
                                            </div>
                                        </div>

                                        
                                    @endforeach
                                        
                                     
                                </div>
                                @endif
                                
                            </div>

                            

                            <div class="clearfix"></div>

                        </div>

                        <hr />

                        

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="staticBackdropLabel"><i class="nc-icon nc-notes"></i> Booking cancellation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="doctor-widget"></div>
                <form novalidate id="cancel-booking-form">
                    <input type="hidden" name="booking_id" id="booking_id" />
                    <input type="hidden" name="from_canceled" id="from_canceled" value="2" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Cancel Reasons:</label>
                        <textarea type="text" placeholder="Cancel Reasons" class="form-control" name="cancel_reason" id="cancel_reason" required=""></textarea>
                        <div class="invalid-feedback">Please write the reasons</div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-confirm" class="btn btn-primary btn-sm btn-fill">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="Vendor_estimate_detail" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="staticBackdropLabel"><i class="nc-icon nc-notes"></i>Medicine Availability Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="doctor-widget"></div>
                 <div class="input-group presc-row mt-5" id="medicine" >
                           
                            

                        </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('script')

<script>

    var prefix = "@php echo $account_prefix @endphp";
    var span = document.getElementById('cur_time');

// function time() {
//   var d = new Date();
//   var ampm = d.getHours( ) >= 12 ? ' PM' : ' AM';
//   var s = d.getSeconds();
//   var m = d.getMinutes();
//   var h = (d.getHours() < 12) ? d.getHours() : d.getHours() - 12;
//   span.textContent =("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2)+ ampm;;
// }

//setInterval(time, 1000);

$("#rowAdder").click(function () {
    var valid = true;
            $('.hospital-valid').each(function() {
                if ($(this).val() == '') { 
                    valid = false;
                  $(this).addClass('highlight');
                }
            });
            $('.doctor-valid').each(function() {
                if ($(this).val() == '') { 
                    valid = false;
                  $(this).addClass('highlight');
                }
            });
            $('.specialized-valid').each(function() {
                if ($(this).val() == '') { 
                    valid = false;
                  $(this).addClass('highlight');
                }
            });

            if(valid){
                newRowAdd =
                '<div id="row" class="mt-5"><a id="DeleteRow" type="button" class="float-right">\
                    <i class="fa fa-trash fa-1x" aria-hidden="true"></i>\
                            </a>\ <ul class="list-group">\
                <li class="list-group-item"><input type="text" class="form-control hospital-valid" name="hospital[]" placeholder="Clinic/Hospital Name:">\
                </li>\
                <li class="list-group-item"><input type="text" class="form-control doctor-valid" name="doctor[]" placeholder="Doctors Name:"></li>\
                <li class="list-group-item"><input type="text" class="form-control specialized-valid" name="specialized[]" placeholder="Specialized In:"></li>\
                </ul></div>';
     
                $('#newinput').append(newRowAdd);
            }else{
                alert("Please Enter all fields!");
            }
        });
 
        $("body").on("click", "#DeleteRow", function () {
            $(this).parents("#row").remove();
        })
        $('#btn-add-detail').click(function(){
            var valid = true;
            $('.hospital-valid').each(function() {
                if ($(this).val() == '') { 
                    valid = false;
                  $(this).addClass('highlight');
                }
            });
            $('.doctor-valid').each(function() {
                if ($(this).val() == '') { 
                    valid = false;
                  $(this).addClass('highlight');
                }
            });
            $('.specialized-valid').each(function() {
                if ($(this).val() == '') { 
                    valid = false;
                  $(this).addClass('highlight');
                }
            });
            if(valid){
                $('.service-details').hide();
                $('.complete-service').show();
            }else{
                alert("Please Enter all fields!");
            }

        });
</script>

<script src="{{asset('frontend-source/myaccount/assets/js/assistant-validate.js')}}"></script>

@endpush