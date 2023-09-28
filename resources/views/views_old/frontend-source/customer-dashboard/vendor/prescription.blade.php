@extends('frontend-source.customer-dashboard.layouts.master')
@section('title') Prescription @stop
@section('keywords') Prescription @stop
@section('description') Prescription @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">
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
                                                        @if(in_array($prescValue->status,[0,1,2]))
                                                            @if($value->is_vendor_assigned  == 0)
                                                                <a title="Accept" @if($value->customer_status == 1) href="{{ url($account_prefix.'/status-change/2/'.$prescValue->vendor_id.'/'.$value->order_id) }}" @endif href="javascript:void(0);" class="btn btn-sm bg-secondary btn-fill @if($value->customer_status != 1)disabled @endif">
                                                                    <i class="fas fa-file-invoice"></i> Accept
                                                                </a>
                                                            @else
                                                                
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



                                                             @endif
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
@endsection
@push('script')

@endpush