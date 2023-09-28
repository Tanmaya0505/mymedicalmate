@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Prescription Details')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">
<style type="text/css">
    .checkbx-label{
        display: flex;
        align-items: center;
    }
    .table th, .table td{
        padding: 20px 5px;
    }
    .has-icon-left .form-control-position i{
        top: 8px;
    }
</style>
@endsection
@section('content')
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
                                                                <li>Bus Name: {{ $delivery_address['bus_name'] }}</li>
                                                                <li>From Arrival: {{ $delivery_address['from_arrival'] }}</li>
                                                                <li>To Arrival: {{ $delivery_address['to_arrival'] }}</li>
                                                            @endif
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <i class="fas fa-location-arrow"></i> <strong>Shipment Address:</strong>
                                                <p class="mt10">{{ $delivery_address['address'] }}</p>
                                                <i class="fas fa-notes-medical"></i> <strong>Notes: </strong>
                                                <p>{{ $data->note ? $data->note : 'N/A' }}</p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-12 text-center prsc-btn-part">
                                            <button class="btn btn-dark">{{ (new \App\Helpers\CustomerHelper)->prescriptionsStatus($data->customer_status) }}</button>
                                            @if(!empty($prescription_photo))
                                            <a href="{{ $prescription_photo }}" target="_blank" class="btn btn-info"><i class="fas fa-file-prescription"></i> Prescription Download</a>
                                            @endif
                                            @if($data->customer_status == 1)
                                            <button type="button" title="Assign" class="btn btn-info" data-toggle="modal" data-target="#border-less" onclick="assignVendor({{ $data->id }})">Assign</button>
                                            @endif
                                            @if($data->customer_status == 3)
                                            <a href="#" class="btn btn-dropbox"><i class="fas fa-file-invoice"></i> Download Invoice</a>
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

<!--Assign to vendor Modal -->
<div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">ASSIGN TO VENDOR</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body scrollable-container">
                <form novalidate id="assign-vendor-form">
                    <input type="hidden" name="prescription_id" id="prescription_id" />
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dist" class="col-form-label">Select Dist:</label>
                                <select class="form-control" name="dist" id="dist" onchange="filterVendor()">
                                    @foreach($dist as $dk=>$dv)
                                    <option value="{{ $dk }}">{{ $dv['option_label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="categories" class="col-form-label">Select Dist:</label>
                                <select class="form-control" name="categories" id="categories" onchange="filterVendor()">
                                    @foreach($categories as $catk=>$catv)
                                    <option value="{{ $catk }}">{{ $catv['option_label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="discount" class="col-form-label">Discount:</label>
                                <select class="form-control" name="discount" id="discount" onchange="filterVendor()">
                                    @foreach($discount as $disk=>$disv)
                                    <option value="{{ $disk }}">{{ $disv['option_label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="vendor_data"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="assign-vendor" disabled="" class="btn btn-primary btn-sm">Assign</button>
          </div>
        </div>
    </div>
</div>
<!--End Assign to vendor Modal -->
@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/extensions/toastr.js')}}"></script>
<script src="{{asset('custom/prescription.js')}}"></script>
@endsection