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

                

                <div class="card">

                    <div class="card-body booking-details-body">

                        <div class="row">

                            <div class="col-xl-5">

                                <div class="row">

                                    <div class="col-12">

                                        <div class="widget about-widget">

                                            
                                            <p class="m-0">Patient: <strong>{{ $data->full_name }}</strong></p>
                                            <p class="m-0">From: <strong>{{ $patient_details->present_address }}</strong></p>

                                            <p class="m-0">Mobile Number: <strong>+91

                                                    {{ $data->mobile_no }}</strong></p>

                                            

                                            <p class="m-0">Email: <strong>{{ $patient_details->email }}</strong></p>

                                            <p class="m-0">Gender: <strong>{{ $data->gender }}</strong></p>

                                            <p class="m-0">Age: <strong>{{ $data->age }}</strong></p>

                                             
                                             <a class="btn btn-primary chkstatus" data-id="{{$data->booking_id}}" href="">Check Status</a>
                                                

                                        </div>

                                    </div>

                                    

                                    <div class="clearfix"></div>

                                </div>
                                @if(Session::get('check_prescription_status')==1)
                                <div class="row">
                                    @foreach($data->vendorprescriptions as $key=>$value)
                                        @php
                                            $full_name = ucwords($value->vendor->first_name);
                                            $meta = json_decode($value->vendor->meta);
                                        @endphp
                                        @if($meta->name_of_store)
                                        <div class="card col-12 " >
                                            <div class="card-body">
                                                
                                            <p>{{ $meta->name_of_store ?? $full_name }}@if($meta->discount) (-{{$meta->discount}}% )@else -- @endif</p>
                                            <p>Location: {{$meta->store_address ? $meta->store_address : '--'}} </p>
                                            <p>Working Hours: 07:00 AM -10:00 PM</p>
                                            <p>Home Delivery: Not Available</p>
                                                
                                            </div>
                                            <div class="card-footer">
                                                <span class="card-link"><i class="fa fa-map-marker" aria-hidden="true"></i> 5 Km</span>
                                                <a href="javascript:void(0)" data-id="{{$value->id}}"  class="card-link btn btn-primary btn-fill ">
                                                    @if($value->status==1)
                                                    Accepted
                                                    @elseif($value->status==0)
                                                    Not Seen
                                                    @endif

                                            </a>
                                            </div>
                                        </div>

                                        @endif
                                    @endforeach
                                        
                                    <!--  <a title="Cancel" href="javascript:void(0);"  onclick="cancelPrescription('{{ $data->order_id }}')"  class="btn btn-sm bg-danger btn-fill ">
                                                <i class="fas fa-times"></i> Cancel
                                            </a> -->
                                </div>
                                @endif

                                @if(Session::get('check_prescription_status')==2)
                                <div class="row">
                                    @foreach($data->vendorprescriptions as $key=>$value)
                                        @php
                                            $full_name = ucwords($value->vendor->first_name);
                                            $meta = json_decode($value->vendor->meta);
                                        @endphp
                                        @if($meta->name_of_store)
                                        <div class="card col-12 " >
                                            <div class="card-body">
                                                
                                            <p>{{ $meta->name_of_store ?? $full_name }}</p>
                                           <!--  <p>Amount: Rs.{{$value->min_amount ? $value->min_amount.' - '.$value->max_amount : '--'}} </p>
                                            <p>Flat Discount: {{$value->discount}}%</p> -->
                                            
                                                
                                            </div>
                                            <div class="card-footer">
                                                @if($value->status==1)
                                                <a   href="{{ url($account_prefix.'/status-change/2/'.$value->vendor_id.'/'.$data->order_id) }}" data-id="{{$value->id}}"      class="card-link btn btn-primary btn-fill ">
                                                    @if($value->status==4)
                                                    Proceed
                                                    @else
                                                    Process
                                                    @endif

                                                </a>
                                                @endif
                                            <!-- <a href="{{ url($account_prefix.'/status-change/3/'.$value->vendor_id.'/'.$data->order_id) }}" data-id="{{$value->id}}"  class="card-link btn btn-primary btn-fill ">
                                                    Cancel
                                                    

                                            </a> -->
                                            @if($value->min_amount)
                                            <a href="javascript:void(0)" data-id="{{$value->id}}" data-medicine='{{$value->medicine_list}}' class="card-link btn btn-primary btn-fill detailamt">
                                                    Details</a>
                                            @endif
                                            </div>
                                        </div>

                                        @endif
                                    @endforeach
                                        
                                     
                                </div>
                                @endif
                                @if(Session::get('check_prescription_status')==3)
                                <div class="row">
                                    @foreach($data->vendorprescriptions as $key=>$value)
                                        @php
                                            $full_name = ucwords($value->vendor->first_name);
                                            $meta = json_decode($value->vendor->meta);
                                        @endphp
                                        @if($value->status==4)
                                        <div class="card col-12 " >
                                            <div class="card-body">
                                                
                                            <p>{{ $meta->name_of_store ?? $full_name }}</p>
                                            <!-- <p>Amount: Rs.{{$value->min_amount ? $value->min_amount.' - '.$value->max_amount : '--'}} </p>
                                            <p>Flat Discount: {{$value->discount}}%</p> -->
                                            
                                                
                                            </div>
                                            <div class="card-footer">
                                                
                                                <a   href="javascript:void(0)" data-id="{{$value->id}}"  disabled    class="card-link btn btn-primary btn-fill ">
                                                    @if($value->status==4)
                                                    Proceed
                                                    @else
                                                    Process
                                                    @endif

                                            </a>
                                            

                                          <!--   <a href="{{ url($account_prefix.'/status-change/3/'.$value->vendor_id.'/'.$data->order_id) }}" data-id="{{$value->id}}"  class="card-link btn btn-danger btn-fill mt-2"> Cancel </a> -->
                                            </div>
                                        </div>

                                        @endif
                                    @endforeach
                                        
                                     
                                </div>
                                @endif
                                @if(Session::get('check_prescription_status')==4)
                                <div class="row">
                                    @foreach($data->vendorprescriptions as $key=>$value)
                                        @php
                                            $full_name = ucwords($value->vendor->first_name);
                                            $meta = json_decode($value->vendor->meta);
                                        @endphp
                                        @if($value->status==4)
                                        <div class="card col-12 " >
                                            <div class="card-body">
                                                
                                            <p>An Invoice received from {{ $meta->name_of_store ?? $full_name }}</p>
                                            
                                                
                                            </div>
                                            <div class="card-footer">
                                                
                                               
                                            <a href="{{ url($account_prefix.'/download-uploadprescription-invoice/'.$data->order_id) }}" data-id="{{$data->id}}"  class="card-link btn btn-info btn-fill ">Check & Pay </a>

                                            
                                            </div>
                                        </div>

                                        @endif
                                    @endforeach
                                        
                                     
                                </div>
                                @endif
                                <button class="btn btn-primary btn-fill">{{ (new \App\Helpers\CustomerHelper)->prescriptionsStatus($data->customer_status) }}</button>
                                @if(@$data->selectvendorprescription->payment_status==1)
                                            <a href="{{ url($account_prefix.'/download-invoice/'.$data->order_id) }}" class="btn btn-primary btn-fill mt-2"><i class="fas fa-file-invoice"></i> View Invoice</a>
                                @endif
                            </div>

                            <div class="col-xl-7">

                                <div class="white-bx">

                                    <!-- About Details -->
                                    <form class="otp-validation" novalidate id="complete-book-service">
                                    <input type="hidden" name="booking_id" id="otp_book_booking_id"  value="{{$data->booking_id}}"  />
                                    <h4>PRESCRIPTION</h4>

                                    <div class="widget about-widget">

                                        <table class="table table-hover table-striped presc-view-dtl">
                                            <thead>
                                                <tr>
                                                    <th class="w-lim">Prescription Img</th>
                                                    <th>Medicine Name</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($medicines as $key=>$value)
                                                @php
                                                    $photo = asset('prescription/photos/'. $value['photo']);
                                                    if(empty($value['photo']) || !file_exists(public_path('prescription/photos/'. $value['photo']))){
                                                        $photo = asset('frontend-source/images/upl-btn.png');
                                                        $ext='png';

                                                    }else{
                                                        $path_info = pathinfo($photo);
                                                        $ext = $path_info['extension'];
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>
                                                        @if($value['photo'])
                                                            @if(in_array($ext,['png','jpg','jpeg']))
                                                                <a href="{{ $photo }}" target="_blank" class="btn btn-info"><img src="{{ $photo }}" height="10px" width="10px" class="img-fluid prsc-thumb" alt=""></a>
                                                            @else
                                                                <a href="{{ $photo }}" target="_blank" class="btn btn-info"><i class="fas fa-file-prescription"></i> Prescription Download</a>
                                                            @endif
                                                        @else
                                                        <a href="#"><img src="{{ $photo }}" class="img-fluid prsc-thumb" alt=""></a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $value['medicine'] ?? 'N/A' }}</td>
                                                    <td>{{ $value['quantity'] ?? 'N/A' }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                    
                                    </form>
                                </div>

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