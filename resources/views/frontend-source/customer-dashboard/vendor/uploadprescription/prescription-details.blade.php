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

                    $vendorprescription = $data->vendorprescription;

                @endphp

                <div class="card">

                    <div class="card-body booking-details-body">

                        <div class="row">

                            <div class="col-xl-5">

                                <div class="row">

                                    <div class="col-12">

                                        <div class="widget about-widget">

                                            
                                            <p class="m-0">Patient: <strong>{{ $data->full_name }}</strong></p>
                                            
                                            <p class="m-0">Mobile Number: <strong>+91

                                                    {{ $data->mobile_no }}</strong></p>
                                            
                                            <p class="m-0">Gender: <strong>{{ $data->gender }}</strong></p>

                                            <p class="m-0">Age: <strong>{{ $data->age }}</strong></p>
                                            
                                                
                                            <p class="m-0">Medicine Shipment By: @if($data->ship_type == 1) Self @else Delivery Boy @endif</p>
                                                    
                                            @if($data->ship_type == 2)
                                                <p>Address: {{ @$delivery_address['address'] }}</p>
                                                <p>City: {{ @$delivery_address['city'] }}</p>
                                                <p>State: {{ @$delivery_address['state'] }}</p>
                                                <p>Zip: {{ @$delivery_address['zip'] }}</p>
                                                <p>Country: {{ @$delivery_address['country'] }}</p>
                                            
                                            @endif
                                                    


                                            
                                            <button class="btn btn-primary btn-fill">{{ (new \App\Helpers\CustomerHelper)->prescriptionsStatus($data->customer_status) }}</button>
                                            @if(@$data->selectvendorprescription->payment_status==1)
                                            <a href="{{ url($account_prefix.'/download-invoice/'.$data->order_id) }}" class="btn btn-primary btn-fill mt-2"><i class="fas fa-file-invoice"></i> View Invoice</a>
                                            @endif
                                            @if($data->ship_type==2 && $data->customer_status==5)
                                                <a title="Search Delivery Boy"  href='{{url("/vendor/deliveryboy-search/$data->order_id")}}'  class="btn  bg-secondary btn-fill mt-5">
                                                                    Search Delivery Boy
                                                                </a>
                                            @endif

                                            @if($data->customer_status == 9)
                                                <a title="Accept"  href='{{url("/vendor/status-change/5/$vendorprescription->vendor_id/$data->order_id")}}'  class="btn btn-sm bg-secondary btn-fill ">
                                                                    <i class="fas fa-file-invoice"></i> Approve
                                                                </a>
                                            @endif
                                            
                                            @if(!empty($prescription_photo))
                                            <a href="{{ $prescription_photo }}" target="_blank" class="btn btn-info"><i class="fas fa-file-prescription"></i> Prescription Download</a>
                                            @endif
                                            @if(isset($data->vendorprescription) && in_array($data->vendorprescription->status,[0,1,2,3,4]))
                                                           
                                                                <a title="Accept" @if($vendorprescription->status == 0) href='{{url("/vendor/status-change/2/$vendorprescription->vendor_id/$data->order_id")}}' @endif href="javascript:void(0);" class="btn btn-sm bg-secondary btn-fill @if($vendorprescription->status != 0) disabled @endif">
                                                                    <i class="fas fa-file-invoice"></i> @if($vendorprescription->status==1) Accepted @else  Accept @endif
                                                                </a>
                                                            
                                                        @endif
                                            @if(isset($data->vendorprescription) && $data->vendorprescription->status==4)
                                                @if($data->customer_status == 2)
                                                <a href="{{ url($account_prefix.'/create-invoice/'.$data->order_id) }}" class="btn btn-info mt-2 btn-fill"><i class="fas fa-file-invoice"></i> Create Invoice</a>
                                                @endif
                                                @if($data->customer_status == 3)
                                                <a href="{{ url($account_prefix.'/download-invoice/'.$data->order_id) }}" class="btn btn-confirm btn-fill mt-2"><i class="fas fa-file-invoice"></i> View Invoice</a>
                                                @endif
                                            @endif

                                        </div>
                                        @if($data->ship_type == 2)
                                            <div class="row">


                                                @if($data->customer_status==5)
                                                <h2>Delivery Boy List1</h2>
                                                @php
                                                $msg = 'Delivery Request Sent to ';
                                                @endphp
                                                @endif
                                                @if(in_array($data->customer_status,[10,11,6,0,7,8]))
                                                @php
                                                $msg = 'Delivery Request Processed By ';
                                                @endphp
                                                @endif 
                                                @foreach($data->deliveryboylist as $key=>$value)
                                                    @php
                                                        $full_name = ucwords($value->deliveryboy->first_name.' '.$value->deliveryboy->last_name);
                                                        $meta = json_decode($value->deliveryboy->meta,true);
                                                    @endphp
                                                    @if($value->status!='Cancel')
                                                    <div class="card col-12 " >
                                                        <div class="card-body">
                                                            
                                                        <p> {{$msg}}{{  $full_name }}</p>
                                                        <p>Phone: {{$meta['phone']}}</p>
                                                        
                                                            
                                                        </div>
                                                        <div class="card-footer">
                                                            
                                                        @if($value->status=='Sent')
                                                        <span>Waiting For Confirmation</span>
                                                        <!-- <a href="{{ url($account_prefix.'/download-invoice/'.$data->order_id) }}" data-id="{{$value->id}}"  class="card-link btn btn-info btn-fill ">Check & Pay </a> -->
                                                        @endif
                                                        @if($value->status=='Accept')
                                                        <span>Accepted</span>
                                                        <!-- <a href="{{ url($account_prefix.'/download-invoice/'.$data->order_id) }}" data-id="{{$value->id}}"  class="card-link btn btn-info btn-fill ">Check & Pay </a> -->
                                                        @endif
                                                        
                                                        </div>
                                                    </div>
                                                    @endif
                                                    
                                                @endforeach
                                                    
                                                
                                            </div>
                                        @elseif($data->ship_type == 1 && in_array($data->customer_status,[5,11]))
                                        <a title="Accept"  href='{{url("/vendor/status-change/6/$vendorprescription->vendor_id/$data->order_id")}}'  class="btn  bg-secondary btn-fill" >
                                                                    <i class="fas fa-file-invoice"></i> Deliver
                                                                </a>
                                        @endif
                                    </div>

                                    

                                    <div class="clearfix"></div>

                                </div>
                               

                                
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




@endsection

@push('script')

<script>

    var prefix = "@php echo $account_prefix @endphp";
    var span = document.getElementById('cur_time');

    function getMaxAmount(input){
        var min_price = $(input).val();
        var new_extra = (min_price*(5/100));
        var new_max_price = parseFloat(min_price)+parseFloat(new_extra);
        $('#max_amount_price').val(new_max_price);

    }
    function getAppxAmount(input){
        var discount = parseFloat($(input).val());
        var min_price = parseFloat($('#min_amount_price').val());
        //console.log(discount+'---'+min_price);
        var new_extra = parseFloat(min_price*(discount/100));
        //console.log(new_extra);
        var new_max_price = parseFloat(min_price)-parseFloat(new_extra);
        //console.log(new_max_price);
        $('#approx_price').val(new_max_price);
        $('#new_approx_price').html(new_max_price);

    }

     $(document).on('click', '#medicine .add-more', function(){

        let count = $('#medicine .medicinelist').length;

        //if(count <= 9){

            $(this).replaceWith("<input type='button' class='form-control red-btn remove' value='-'>");

            let domEl = '<ul class="d-flex flex-wrap col-12 pl-0 medicinelist">\
                                <li class="list-group-item d-flex justify-content-between align-items-center medicine-file col-2">\
                                    <select class="form-control border-0" name="medicine_list['+count+'][sl]" placeholder="Sl" >\
                                       <option >Sl-1</option>\
                                       <option >Sl-2</option>\
                                       <option >Sl-3</option>\
                                       <option >Sl-4</option>\
                                       <option >Sl-5</option>\
                                       <option >Sl-6</option>\
                                       <option >Sl-7</option>\
                                       <option >Sl-8</option>\
                                       <option >Sl-9</option>\
                                       <option >Sl-10</option>\
                                   </select>\
                                </li>\
                                <li class="list-group-item d-flex justify-content-between align-items-center col-5">\
                                    <input type="text" class="form-control d-inline-block border-0" name="medicine_list['+count+'][name]" placeholder="Medicine Name">            </li>\
                                <li class="list-group-item d-flex justify-content-between align-items-center col-3">\
                                   <select class="form-control border-0" name="medicine_list['+count+'][available]" placeholder="Quantity" >\
                                       <option >Available</option>\
                                       <option >Not Available</option>\
                                   </select>\
                                </li>\
                                <li class="list-group-item d-flex col-1 border-0">\
                                 <input type="button" class="form-control red-btn add-more" value="+">\
                                </li>\
                            </ul>';

            $('#medicine:last').append(domEl);

       // }

    });

    $(document).on('click', '#medicine .remove', function(){

        $(this).closest('.medicinelist').remove();

    });
    $("input[name='is_all_medicine']").click(function(){
        
       if($(this).is(':checked')){
            if($(this).val()==2){
                $('#medicine').show();
            }else{
                $('#medicine').hide();
            }
       }else{
            $('#medicine').hide();
       }
    });
</script>

<script src="{{asset('frontend-source/myaccount/assets/js/vendor-validate.js')}}"></script>

@endpush