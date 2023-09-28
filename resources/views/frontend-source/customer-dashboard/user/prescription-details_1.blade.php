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
                                                    <li class="shp-data"><i class="fas fa-shipping-fast"></i> Medicine Shipment By: <span>@if($data->ship_type == 1) Courier @elseif($data->ship_type == 2) Transportation @else Self @endif</span>
                                                        @if($data->ship_type != 3)
                                                        <ul class="shp-info">
                                                            @if($data->ship_type == 1)
                                                                <li>City: {{ $delivery_address['city'] }}</li>
                                                                <li>State: {{ $delivery_address['state'] }}</li>
                                                                <li>Zip: {{ $delivery_address['zip'] }}</li>
                                                                <li>Country: {{ $delivery_address['country'] }}</li>
                                                            @elseif($data->ship_type == 2)
                                                                <li>Bus Name: {{ $delivery_address['bus_name'] }}</li>
                                                                <li>From Arrival: {{ $delivery_address['from_arrival'] }}</li>
                                                                <li>To Arrival: {{ $delivery_address['to_arrival'] }}</li>
                                                            @endif
                                                        </ul>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                @if($data->ship_type != 3)
                                                <i class="fas fa-location-arrow"></i> <strong>Shipment Address:</strong>
                                                <p class="mt10">{{ $delivery_address['address'] }}</p>
                                                @endif
                                                <i class="fas fa-notes-medical"></i> <strong>Notes: </strong>
                                                <p>{{ $data->note ? $data->note : 'N/A' }}</p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-12 text-center prsc-btn-part">
                                            <button class="btn btn-facebook">{{ (new \App\Helpers\CustomerHelper)->prescriptionsStatus($data->customer_status) }}</button>
                                            @if($data->is_vendor_assigned==0)
                                                @if($account_prefix=='assistant')
                                                    <a href="{{url('assistant/medmate-search/'.$data->order_id)}}" class="btn btn-facebook" target="_blank">Search </a>
                                                @elseif($account_prefix=='user' && !$data->booking)
                                                    <a href="{{url('assistant/medmate-search/'.$data->order_id)}}" class="btn btn-facebook" target="_blank">Search </a>
                                                @endif
                                            @endif
                                            @if($data->payment_status == 1)
                                            <button class="btn btn-facebook">PAID</button>
                                            @endif
                                            @if(!empty($prescription_photo))
                                            <a href="{{ $prescription_photo }}" target="_blank" class="btn btn-info"><i class="fas fa-file-prescription"></i> Prescription Download</a>
                                            @endif
                                            @if($data->customer_status >= 1 && $data->payment_status != 1)
                                                <a href="{{url('user/payment/'.$data->order_id)}}" class="btn btn-info"><i class="fas fa-credit-card"></i> Pay For Medicine</a>
                                            @endif   
                                            @if($data->customer_status == 3 || $data->customer_status == 4 || $data->customer_status == 5)
                                            <a href="{{url('user/download-invoice/'.$data->order_id)}}" class="btn btn-fill"><i class="fas fa-file-invoice"></i> View Invoice</a>
                                                @if($data->customer_status == 3)
                                                <a href="{{url('vendor/send-invoice/4/'.$data->order_id)}}" class="btn btn-info mt-1" >Accept invoice</a>
                                                 @endif
                                                
                                                @if($data->customer_status == 5 )
                                                    @if($account_prefix=='assistant')
                                                        <a href="{{url('assistant/delivery-booking/'.$data->order_id)}}"   data-id="{{ $data->booking_id }}"  class="btn bg-info btn-fill mt-1">Delivered </a>
                                                    @elseif($account_prefix=='user' && !$data->booking)
                                                        <a href="{{url('assistant/delivery-booking/'.$data->order_id)}}"   data-id="{{ $data->booking_id }}"  class="btn bg-info btn-fill mt-1">Delivered </a>
                                                    @endif
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
                                <td>
                                    @if($value['photo'])
                                    <a href="{{ $photo }}" target="_blank" class="btn btn-info"><i class="fas fa-file-prescription"></i> Prescription Download</a>
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
            </div>
        </div>
    </div>
    </div>
</div>

<!--Cancel modal popup-->
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
<!--End Cancel modal popup-->
@endsection
@push('script')
<script>
    var prefix = "@php echo $account_prefix @endphp";
</script>
@endpush