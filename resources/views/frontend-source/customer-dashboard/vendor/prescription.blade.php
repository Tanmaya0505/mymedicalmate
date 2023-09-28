@extends('frontend-source.customer-dashboard.layouts.master')
@section('title') Prescription @stop
@section('keywords') Prescription @stop
@section('description') Prescription @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">
<style type="text/css">
    .donate-now {
  list-style-type: none;
  margin: 25px 0 0 0;
  padding: 0;
}

.donate-now li {
  float: left;
  margin: 0 5px 0 0;
  width: 100px;
  height: 40px;
  position: relative;
}

.donate-now label,
.donate-now input {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.donate-now input[type="radio"] {
  opacity: 0.01;
  z-index: 100;
}

.donate-now input[type="radio"]:checked+label,
.Checked+label {
  background: #DDD;
}

.donate-now label {
  padding: 5px;
  border: 1px solid #CCC;
  cursor: pointer;
  z-index: 90;
}

.donate-now label:hover {
  background: #DDD;
}

</style>
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">PRESCRIPTION</h4>
                <div class="appointment-tab">
                    <div class="tab-content">
                        <!-- Upcoming Appointment Tab -->
                        <div class="tab-pane show active" id="upcoming-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Full Name</th>
                                                    <th>Mobile No</th>
                                                    <th>Age</th>
                                                    <th>Submitted Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $key=>$prescValue)
                                                @php
                                                    $value = $prescValue->prescription;
                                                    $full_name = ucwords($value->full_name);
                                                @endphp
                                                <tr>
                                                    <td title="{{  $full_name }}">
                                                        {{ strlen($full_name) > 12 ? substr($full_name,0,12)."..." : $full_name }}
                                                        <br />
                                                        @if(!empty($value->prescription_photo)) <a href="{{ asset('public/prescription') }}/{{ $value->prescription_photo }}" target="_blank" class=""><i class="far fa-file-image"></i></a>  @endif
                                                        <a title="{{ $full_name }}" href="{{ url('/vendor/prescription/'.$value->order_id) }}">#{{ $value->order_id }}</a>
                                                    </td>
                                                    <td>{{ $value->mobile_no }}</td>
                                                    <td>{{ $value->age }} @if(!empty($value->age)) Years @endif <br/><span class="text-info">{{ $value->gender }}</span></td>
                                                    <td>{{ date('d M, Y' ,strtotime($value->created_at)) }}</td>
                                                    <td>
                                                        <span class="badge btn-white">{{ (new \App\Helpers\CustomerHelper)->prescriptionsStatus($value->customer_status) }}</span>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="table-action">
                                                        <!-- @if(in_array($prescValue->status,[0,1,2]))
                                                            @if($value->is_vendor_assigned  == 0)
                                                                <a title="Accept" @if($value->customer_status == 1) href='javascript:void(0)' onClick="AcceptService(2,{{$prescValue->vendor_id}},{{$value->order_id}})" @endif href="javascript:void(0);" class="btn btn-sm bg-secondary btn-fill @if($value->customer_status != 1) disabled @endif">
                                                                    <i class="fas fa-file-invoice"></i> Accept
                                                                </a>
                                                            @else

                                                                <a title="Accept" href='javascript:void(0)' onClick="AcceptService(4,{{$prescValue->vendor_id}},{{$value->order_id}})"   class="btn btn-sm bg-secondary btn-fill @if($value->amount) disabled @endif">
                                                                    <i class="fas fa-file-invoice"></i> Estimate
                                                                </a>
                                                                
                                                                <a title="Cancel" @if($value->customer_status == 2) href="{{ url($account_prefix.'/status-change/3/'.$prescValue->vendor_id.'/'.$value->order_id) }}" @endif href="javascript:void(0);" class="btn btn-sm bg-secondary btn-fill @if($value->customer_status != 2)disabled @endif">
                                                                    <i class="fas fa-file-invoice"></i> Cancel
                                                                </a>
                                                            @endif
                                                            <a title="Cancel" @if($value->customer_status == 2) href="{{ url($account_prefix.'/create-invoice/'.$value->order_id) }}" @endif href="javascript:void(0);" class="btn btn-sm bg-secondary btn-fill @if($value->customer_status != 2)disabled @endif">
                                                                <i class="fas fa-file-invoice"></i> Create Invoice
                                                            </a>
                                                            @else

                                                            <a title="Accept" href="javascript:void(0);" class="btn btn-sm bg-secondary btn-fill ">
                                                                    <i class="fas fa-file-invoice"></i> Accepted by Other Vendor
                                                                </a>



                                                             @endif -->
                                                            <a title="View" href="{{ url($account_prefix.'/prescription/'.$value->order_id) }}" class="btn btn-sm bg-info btn-fill">
                                                                <i class="far fa-eye"></i> View
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>		
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Upcoming Appointment Tab -->
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
                                <p><small>(Auto suggest max 5%)</small></p>
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

                    <div class="input-group presc-row mt-5" id="medicine">
                            <ul class="d-flex flex-wrap col-12 pl-0 medicinelist">
                                <li class="list-group-item d-flex justify-content-between align-items-center medicine-file col-2">
                                    <label>
                                        Sl1
                                    </label>
                                    
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center col-5">
                                    <input type="text" required="" class="form-control d-inline-block border-0" name="medicine_list[0][name]" placeholder="Medicine Name"> 
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
                            <label for="recipient-name" class="col-form-label">Discount(%):</label>
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

        if(count <= 9){

            $(this).replaceWith("<input type='button' class='form-control red-btn remove' value='-'>");

            let domEl = '<ul class="d-flex flex-wrap col-12 pl-0 medicinelist">\
                                <li class="list-group-item d-flex justify-content-between align-items-center medicine-file col-2">\
                                    <label >\
                                        Sl'+parseInt(count+1)+'\
                                    </label>\
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

        }

    });

    $(document).on('click', '#medicine .remove', function(){

        $(this).closest('.rows').remove();

    });
</script>
<script src="{{asset('frontend-source/myaccount/assets/js/vendor-validate.js')}}"></script>
@endpush