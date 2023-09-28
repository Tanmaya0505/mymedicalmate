@extends('frontend-source.customer-dashboard.layouts.master')
@section('title') Bookings @stop
@section('keywords') Bookings @stop
@section('description') Bookings @stop
@section('style')
<link href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">BOOKINGS</h4>
                
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
                                                    <th>Patient Name</th>
                                                    <th>Booked Date</th>
                                                    <th>Patient Mobile</th>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($bookings as $key=>$value)
                                                @php
                                                    
                                                    $patient_name = strtoupper($value->booking->full_name);
                                                    $delivery_address = json_decode($value->booking->delivery_address, true);
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            {{ strlen($patient_name) > 12 ? substr($patient_name,0,12)."..." : $patient_name }} <span>#{{ $value->order_id }}</span>
                                                        </h2>
                                                    </td>
                                                    <td>{{ date('d F Y' ,strtotime($value->booking->created_at)) }}</td>
                                                    <td>{{ $value->booking->mobile_no }}</td>
                                                    
                                                    <td><p>{{ $delivery_address['address'] }}</p>
                                                        <p>{{ @$delivery_address['city'] }}</p><p>{{ @$delivery_address['state'] }}</p>
                                                        <p>{{ @$delivery_address['country'] }}</p><p>{{ @$delivery_address['pincode'] }}</p>
                                                    
                                                
                                                    </td>
                                                    <td>
                                                        @if($value->status == 'Sent' )
                                                            
                                                                <a title="Accept Request" href="javascript:void(0)" data-id="{{ $value->order_id }}" onclick="acceptBooking('{{ $value->order_id }}')"><span class="badge badge-pill bg-warning-light"> <i class="nc-icon nc-tap-01"></i> Accept</span></a>
                                                            
                                                        
                                                        @elseif($value->status == 'Accept')
                                                        <span class="badge badge-pill bg-success-light"> <i class="nc-icon nc-check-2"></i> Accepted</span>
                                                        @elseif($value->status == 'Delivered')
                                                        <span title="On Service" class="badge badge-pill bg-warning-light"><i class="nc-icon nc-bulb-63"></i> Delivered</span>
                                                        @elseif($value->status == 'Cancel')
                                                        <span title="Cancelled" class="badge badge-pill bg-danger-light"><i class="nc-icon nc-simple-remove"></i> Cancelled</span>
                                                        @endif
                                                        
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="table-action">
                                                            <a title="View" href="{{ url($account_prefix.'/bookings/'.$value->order_id) }}" class="btn btn-sm bg-info btn-fill">
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
<script>
    var prefix = "@php echo $account_prefix @endphp";
</script>
<script src="{{asset('frontend-source/myaccount/assets/js/deliveryboy-validate.js')}}"></script>
@endpush