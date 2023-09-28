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
                                                    <th>Patient Email</th>
                                                    <th>Paid Amount</th>
                                                    <!-- <th>Status</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $key=>$value)
                                                @php
                                                    $customer_meta = json_decode($value->customer_meta, true);
                                                    $patient_name = strtoupper($customer_meta['patient_name']);
                                                    $patient_email = $customer_meta['patient_email'];
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a title="{{ $patient_name }}" href="{{ url($account_prefix.'/bookings/'.$value->booking_id) }}">{{ strlen($patient_name) > 12 ? substr($patient_name,0,12)."..." : $patient_name }} <span>#{{ $value->booking_id }}</span></a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ date('d F Y' ,strtotime($value->book_date)) }}<span class="d-block text-info">{{ $value->arrival_time }}</span></td>
                                                    <td>{{ $customer_meta['patient_mobile'] }}</td>
                                                    <td title="{{ $patient_email }}">{{ strlen($patient_email) > 16 ? substr($patient_email,0,16)."..." : $patient_email }}</td>
                                                    <td>&#8377;{{ $value->grand_price }}</td>
                                                    <td>
                                                        
                                                           
                                                                <!-- <a title="Accept Request" href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="acceptRequestBooking('{{ $value->booking_id }}')"><span class="badge badge-pill bg-warning-light"> <i class="nc-icon nc-tap-01"></i> Accept</span></a> -->
                                                            
                                                        
                                                        
                                                        
                                                        
                                                        
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="table-action">
                                                            <a title="View" href="{{ url($account_prefix.'/bookings/'.$value->booking_id) }}" class="btn btn-sm bg-info btn-fill">
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
<script src="{{asset('frontend-source/myaccount/assets/js/assistant-validate.js')}}"></script>
@endpush