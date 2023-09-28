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

                $assistant_boy_meta = json_decode($value->assistant_boy_meta, true);

                if(!empty($value->assistant_boy_id)){

                $assistant_name = strtoupper($assistant_boy_meta['first_name'].' '.$assistant_boy_meta['last_name']);

                $photo = asset('assistant/'. $assistant_boy_meta['photo']);

                if(empty($assistant_boy_meta['photo']) || !file_exists(public_path('assistant/'. $assistant_boy_meta['photo']))){

                    $photo = asset('frontend-source/images/assistant-boy-icon.png');

                }

                $phone = $assistant_boy_meta['phone'];

                $age = 'Age ' . $assistant_boy_meta['dob_year'];

                $gender = $assistant_boy_meta['gender'];

                $address = $assistant_boy_meta['present_address'] . ', ' .$assistant_boy_meta['dist'] . ', ' .

                $assistant_boy_meta['state'] .' (' . $assistant_boy_meta['pincode'] . ')';

                } else {

                $assistant_name = strtoupper($assistant_boy_meta['name']);

                $photo = env('LOGO_URL');

                $phone = 'N/A';

                $age = '';

                $gender = '';

                $address = '';

                }

                $assistant_email = $assistant_boy_meta['email'];

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
                                            <p class="m-0">From: <strong>{{ $customer_meta['patient_name'] }}</strong></p>

                                            <p class="m-0">Mobile Number: <strong>+91

                                                    {{ $customer_meta['patient_mobile'] }}</strong></p>

                                            

                                            <p class="m-0">Email: <strong>{{ $customer_meta['patient_email'] }}</strong></p>

                                            <p class="m-0">Gender: <strong>{{ $customer_meta['gender'] }}</strong></p>

                                            <p class="m-0">Age: <strong>{{ $customer_meta['age'] }}</strong></p>



                                            
                                            <button class="btn btn-primary btn-fill">{{ (new \App\Helpers\CustomerHelper)->prescriptionsStatus($data->customer_status) }}</button>
                                            @if($data->vendorprescription->payment_status==1)
                                            <a href="{{ url($account_prefix.'/download-invoice/'.$data->order_id) }}" class="btn btn-primary btn-fill mt-2"><i class="fas fa-file-invoice"></i> View Invoice</a>
                                            @endif
                                            @if(!empty($prescription_photo))
                                            <a href="{{ $prescription_photo }}" target="_blank" class="btn btn-info"><i class="fas fa-file-prescription"></i> Prescription Download</a>
                                            @endif
                                            @if($data->customer_status == 9)
                                                @php 
                                                
                                                $vendor_order_id = $data->vendorprescription->vendor_id.'/'.$data->order_id;
                                                @endphp
                                                <a title="Accept"  href='{{url("/vendor/status-change/5/$vendor_order_id")}}'  class="btn btn-sm bg-secondary btn-fill ">
                                                                    <i class="fas fa-file-invoice"></i> Approve
                                                                </a>
                                            @endif
                                            @if(in_array($data->ship_type,[1,3]) && $data->customer_status == 5)
                                            @php 
                                                
                                                $vendor_order_id = $data->vendorprescription->vendor_id.'/'.$data->order_id;
                                                @endphp
                                                <a title="Accept"  href='{{url("/vendor/status-change/6/$vendor_order_id")}}'  class="btn btn-fill bg-secondary btn-fill mt-2">
                                                                    <i class="fas fa-file-invoice"></i> Confirm Handover
                                                                </a>


                                            @endif
                                            @if(in_array($data->vendorprescription->status,[0,1,2,3,4]))
                                                           @if(!$data->vendorprescription->min_amount)
                                                                <a title="Accept" @if($data->customer_status == 1) href='javascript:void(0)' onClick="AcceptService(2,{{$data->vendorprescription->vendor_id}},{{$data->order_id}})" @endif href="javascript:void(0);" class="btn btn-sm bg-secondary btn-fill @if($data->customer_status != 1) disabled @endif">
                                                                    <i class="fas fa-file-invoice"></i> @if($data->vendorprescription->min_amount) Accepted @else  Accept @endif
                                                                </a>
                                                            @else

                                                                <a title="Accept" href='javascript:void(0)'  
                                                                @if($data->vendorprescription->min_amount) 
                                                                onClick="AcceptServiceEdit(4,{{$data->vendorprescription->vendor_id}},{{$data->order_id}})"
                                                                @else
                                                                disabled @endif  class="btn btn-sm bg-secondary btn-fill @if($data->vendorprescription->min_amount) disabled @endif">
                                                                    <i class="fas fa-file-invoice"></i> Estimate 
                                                                </a>
                                                                
                                                               
                                                            @endif
                                                        @endif
                                            @if($data->vendorprescription->status==4)
                                                @if($data->customer_status == 2)
                                                <a href="{{ url($account_prefix.'/create-invoice/'.$data->order_id) }}" class="btn btn-info mt-2 btn-fill"><i class="fas fa-file-invoice"></i> Create Invoice</a>
                                                @endif
                                                @if($data->customer_status == 3)
                                                <a href="{{ url($account_prefix.'/download-invoice/'.$data->order_id) }}" class="btn btn-confirm btn-fill mt-2"><i class="fas fa-file-invoice"></i> View Invoice</a>
                                                @endif
                                            @endif
                                           

                                        </div>

                                    </div>

                                    

                                    <div class="clearfix"></div>

                                </div>
                               

                                
                            </div>

                            <div class="col-xl-7">

                                <div class="white-bx">

                                    <!-- About Details -->
                                    <form class="otp-validation" novalidate id="complete-book-service">
                                    <input type="hidden" name="booking_id" id="otp_book_booking_id"  value="{{$value->booking_id}}"  />
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

@if(!$data->vendorprescription->min_amount)
<div class="modal fade" id="accept_max_price" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="staticBackdropLabel"><i class="nc-icon nc-notes"></i> INVOICE TENTIVE VALUE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="doctor-widget"></div>
                <form  id="estm-booking-form">
                    <input type="hidden" name="booking_id" id="booking_id" />
                    <input type="hidden" name="vendor_id" id="vendor_id" value="2" />
                    <input type="hidden" name="status" id="status" value="2" />
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Min Amount:</label>
                                <input type="text" placeholder="Min Amount" class="form-control" name="min_amount" id="min_amount_price" required="" onblur="getMaxAmount(this)" />
                                <div class="invalid-feedback">Please write the Min Amount</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Max Amount:</label>
                                <input type="text" placeholder="Max Amount" class="form-control" name="max_amount" id="max_amount_price" required="" />
                                <!-- <p><small>(Auto suggest max 5%)</small></p> -->
                                <div class="invalid-feedback">Please write the Max Amount</div>
                            </div>
                        </div>
                        
                    </div>
                    <p>Medicine Availability According to Prescription </p>
                    <ul class="donate-now row">
                        <li class="col-5 form-control">
                            <input type="radio" required="" value="1" id="a25" name="is_all_medicine" />
                            <label for="a25" style="margin-bottom:0 !important">Available All Medicine</label>
                        </li>
                        <li class="col-5 form-control">
                            <input type="radio" required="" value="2" id="a50" name="is_all_medicine" />
                            <label for="a50" style="margin-bottom:0 !important">Partial Medicine</label>
                        </li>
                      
                    </ul>

                    <div class="input-group presc-row mt-5" id="medicine" style="display:none">
                            <ul class="d-flex flex-wrap col-12 pl-0 medicinelist">
                                <li class="list-group-item d-flex justify-content-between align-items-center medicine-file col-2">
                                    <select class="form-control border-0" name="medicine_list[0][sl]" placeholder="Sl" >\
                                       <option >Sl-1</option>
                                       <option >Sl-2</option>
                                       <option >Sl-3</option>
                                       <option >Sl-4</option>
                                       <option >Sl-5</option>
                                       <option >Sl-6</option>
                                       <option >Sl-7</option>
                                       <option >Sl-8</option>
                                       <option >Sl-9</option>
                                       <option >Sl-10</option>
                                   </select>
                                    
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-5">
                                    <input type="text"  class="form-control d-inline-block border-0" name="medicine_list[0][name]" placeholder="Medicine Name"> 
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-3">
                                   <select class="form-control border-0" name="medicine_list[0][available]" placeholder="Quantity" >
                                       <option >Available</option>
                                       <option >Not Available</option>
                                   </select>
                                </li>
                                <li class="list-group-item d-flex col-1 border-0">
                                 <input type="button" class="form-control red-btn add-more" value="+">
                                </li>
                            </ul>
                            

                        </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Flat Discount(%):</label>
                            <input type="text" placeholder="Discount" class="form-control" name="discount" id="discount_price" required="" onblur="getAppxAmount(this)" />
                            <div class="invalid-feedback">Please write the Discount</div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Approx price:</label>
                                <input type="hidden" placeholder="Max Amount" class="form-control" name="approx_price" id="approx_price" required="" />
                                <span class="form-control" id="new_approx_price"></span>
                                
                                <div class="invalid-feedback">Please write the Approx price</div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" id="btn-confirm" class="btn btn-primary btn-sm btn-fill">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="modal fade" id="accept_max_price_edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="staticBackdropLabel"><i class="nc-icon nc-notes"></i> INVOICE TENTIVE VALUE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="doctor-widget"></div>
                <form  id="estm-booking-form">
                    <input type="hidden" name="booking_id" id="booking_id" value="{{$data->order_id}}" />
                    <input type="hidden" name="vendor_id" id="vendor_id" value="2" />
                    <input type="hidden" name="status" id="status" value="2" />
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Min Amount:</label>
                                <input type="text" placeholder="Min Amount" class="form-control" name="min_amount" id="min_amount_price" value="{{$data->vendorprescription->min_amount}}" required="" onblur="getMaxAmount(this)" />
                                <div class="invalid-feedback">Please write the Min Amount</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Max Amount:</label>
                                <input type="text" placeholder="Max Amount" class="form-control" name="max_amount" id="max_amount_price"  value="{{$data->vendorprescription->max_amount}}" required="" />
                                <!-- <p><small>(Auto suggest max 5%)</small></p> -->
                                <div class="invalid-feedback">Please write the Max Amount</div>
                            </div>
                        </div>
                        
                    </div>
                    <p>Medicine Availability According to Prescription </p>
                    <ul class="donate-now row">
                        <li class="col-5 form-control">
                            <input type="radio" required="" @if($data->vendorprescription->all_medicine==1) checked  @endif    value="1" id="a25" name="is_all_medicine" />
                            <label for="a25" style="margin-bottom:0 !important">Available All Medicine</label>
                        </li>
                        <li class="col-5 form-control">
                            <input type="radio" required="" @if($data->vendorprescription->all_medicine==2) checked  @endif  value="2" id="a50" name="is_all_medicine" />
                            <label for="a50" style="margin-bottom:0 !important">Partial Medicine</label>
                        </li>
                      
                    </ul>

                    <div class="input-group presc-row mt-5" id="medicine" @if($data->vendorprescription->all_medicine==1) style="display:none"  @endif>
                        @php
                            $vendorprescriptionlist =  json_decode($data->vendorprescription->medicine_list);
                            
                        @endphp
                        @forelse($vendorprescriptionlist as $med)
                            <ul class="d-flex flex-wrap col-12 pl-0 medicinelist">
                                <li class="list-group-item d-flex justify-content-between align-items-center medicine-file col-2">
                                    <select class="form-control border-0" name="medicine_list[0][sl]" placeholder="Sl" >\
                                       <option @if($med->sl=='Sl-1') selected  @endif >Sl-1</option>
                                       <option @if($med->sl=='Sl-2') selected  @endif >Sl-2</option>
                                       <option @if($med->sl=='Sl-3') selected  @endif >Sl-3</option>
                                       <option @if($med->sl=='Sl-4') selected  @endif >Sl-4</option>
                                       <option @if($med->sl=='Sl-5') selected  @endif >Sl-5</option>
                                       <option @if($med->sl=='Sl-6') selected  @endif >Sl-6</option>
                                       <option @if($med->sl=='Sl-7') selected  @endif >Sl-7</option>
                                       <option @if($med->sl=='Sl-8') selected  @endif >Sl-8</option>
                                       <option @if($med->sl=='Sl-9') selected  @endif >Sl-9</option>
                                       <option @if($med->sl=='Sl-10') selected  @endif >Sl-10</option>
                                   </select>
                                    
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-5">
                                    <input type="text"  class="form-control d-inline-block border-0" name="medicine_list[0][name]" value="{{$med->name}}" placeholder="Medicine Name"> 
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-3">
                                   <select class="form-control border-0" name="medicine_list[0][available]" placeholder="Quantity" >
                                       <option @if($med->available=='Available') selected  @endif >Available</option>
                                       <option @if($med->available=='Not Available') selected  @endif >Not Available</option>
                                   </select>
                                </li>
                                @if($data->vendorprescription->status!=4)
                                <li class="list-group-item d-flex col-1 border-0">
                                 <input type="button" class="form-control red-btn add-more" value="+">
                                </li>
                                @endif
                            </ul>
                        @empty
                        @endforelse    

                        </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Flat Discount(%):</label>
                            <input type="text" placeholder="Discount" class="form-control" name="discount" id="discount_price" value="{{$data->vendorprescription->discount}}" required="" onblur="getAppxAmount(this)" />
                            <div class="invalid-feedback">Please write the Discount</div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Approx price:</label>
                                <input type="hidden" placeholder="Max Amount" class="form-control" name="approx_price" value="{{$data->vendorprescription->appox_amount}}" id="approx_price" required="" />
                                <span class="form-control" id="new_approx_price">{{$data->vendorprescription->appox_amount}}</span>
                                
                                <div class="invalid-feedback">Please write the Approx price</div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        @if($data->vendorprescription->status!=4)
                        <button type="submit" id="btn-confirm" class="btn btn-primary btn-sm btn-fill">Send</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif


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