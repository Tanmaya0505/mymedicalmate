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
        <div class="col-md-12 Prescription-view-details">
            <h4 class="mb-4">PRESCRIPTION DETAILS</h4>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="booking-details-body">
                                        <h4 class="patnt-name">
                                            {{ $data->full_name }} <span>{{ $data->gender }}</span>
                                        </h4>
                                        <hr>
                                        <div class="patient-info row">
                                            <div class="col-md-6">
                                                <ul>
                                                    <li><i class="fas fa-mobile-alt"></i> {{ $data->mobile_no }}</li>
                                                    <li><i class="fas fa-universal-access"></i> {{ $data->age }} Years</li>
                                                    <li class="shp-data"><i class="fas fa-shipping-fast"></i> Medicine Shipment By: <span>@if($data->ship_type == 1) Courier @else Transportation @endif</span>
                                                        <ul class="shp-info">
                                                            @if($data->ship_type == 1)
                                                                <li>City: {{ $delivery_address['city'] }}</li>
                                                                <li>State: {{ $delivery_address['state'] }}</li>
                                                                <li>Zip: {{ $delivery_address['zip'] }}</li>
                                                                <li>Country: {{ $delivery_address['country'] }}</li>
                                                            @else
                                                                <li>Bus Name: {{ @$delivery_address['bus_name'] }}</li>
                                                                <li>From Arrival: {{ @$delivery_address['from_arrival'] }}</li>
                                                                <li>To Arrival: {{ @$delivery_address['to_arrival'] }}</li>
                                                            @endif
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <i class="fas fa-location-arrow"></i> <strong>Shipment Address:</strong>
                                                <p class="mt10">{{ @$delivery_address['address'] }}</p>
                                                <i class="fas fa-notes-medical"></i> <strong>Notes: </strong>
                                                <p>{{ $data->note ? $data->note : 'N/A' }}</p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-12 text-center prsc-btn-part">
                                            @if($data->vendorprescription->status==1)
                                            <button class="btn btn-facebook">{{ (new \App\Helpers\CustomerHelper)->prescriptionsStatus($data->customer_status) }}</button>
                                            @endif
                                            @if(!empty($prescription_photo))
                                            <a href="{{ $prescription_photo }}" target="_blank" class="btn btn-info"><i class="fas fa-file-prescription"></i> Prescription Download</a>
                                            @endif
                                            @if(in_array($data->vendorprescription->status,[0,1,2]))
                                                            @if($data->is_vendor_assigned  == 0)
                                                                <a title="Accept" @if($data->customer_status == 1) href='javascript:void(0)' onClick="AcceptService(2,{{$data->vendorprescription->vendor_id}},{{$data->order_id}})" @endif href="javascript:void(0);" class="btn btn-sm bg-secondary btn-fill @if($data->customer_status != 1) disabled @endif">
                                                                    <i class="fas fa-file-invoice"></i> Accept
                                                                </a>
                                                            @else

                                                                <a title="Accept" href='javascript:void(0)' onClick="AcceptService(4,{{$data->vendorprescription->vendor_id}},{{$data->order_id}})"   class="btn btn-sm bg-secondary btn-fill @if($data->amount) disabled @endif">
                                                                    <i class="fas fa-file-invoice"></i> Estimate
                                                                </a>
                                                                
                                                               
                                                            @endif
                                                        @endif
                                            @if($data->vendorprescription->status==1)
                                                @if($data->customer_status == 2)
                                                <a href="{{ url($account_prefix.'/create-invoice/'.$data->order_id) }}" class="btn btn-outline-secondary"><i class="fas fa-file-invoice"></i> Create Invoice</a>
                                                @endif
                                                @if($data->customer_status == 3)
                                                <a href="#" class="btn btn-fill"><i class="fas fa-file-invoice"></i> View Invoice</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
            <h4>Medicine Details</h4>
            <div class="card invoice">
                <div class="card-body table-full-width table-responsive">
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
                                }
                            @endphp
                            <tr>
                                <td><a href="#"><img src="{{ $photo }}" class="img-fluid prsc-thumb" alt=""></a></td>
                                <td>{{ $value['medicine'] ?? 'N/A' }}</td>
                                <td>{{ $value['quantity'] ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>


<div class="modal fade" id="accept_max_price" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                        <button type="submit" id="btn-confirm" class="btn btn-primary btn-sm btn-fill">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    var prefix = "@php echo $account_prefix @endphp";
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