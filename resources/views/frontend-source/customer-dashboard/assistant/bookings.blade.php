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
                                                    <th>Status</th>
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
                                                        @if($value->booking_status == 1 )
                                                            @if(!$curbooking)
                                                                <a title="Accept Request" href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="acceptBooking('{{ $value->booking_id }}')"><span class="badge badge-pill bg-warning-light"> <i class="nc-icon nc-tap-01"></i> Accept</span></a>
                                                            @else
                                                                <a title="Accept Request" href="javascript:void(0)" data-id="{{ $value->booking_id }}" ><span class="badge badge-pill bg-warning-light"> <i class="nc-icon nc-tap-01"></i> Waiting To Accept</span></a>
                                                            @endif
                                                        @if($value->fwrd_status == 0)
                                                            <!-- <a title="Forward Request" href="javascript:void(0)" data-id="{{ $value->booking_id }}" onclick="forwardRequest('{{ $value->booking_id }}')"><span class="badge badge-pill bg-info-light"> <i class="nc-icon nc-spaceship"></i> Forward</span></a> -->
                                                        @endif
                                                        @elseif($value->booking_status == 2)
                                                        <span class="badge badge-pill bg-success-light"> <i class="nc-icon nc-check-2"></i> Accepted</span>
                                                        @elseif($value->booking_status == 3)
                                                        <span title="On Service" class="badge badge-pill bg-warning-light"><i class="nc-icon nc-bulb-63"></i> On Service</span>
                                                        @elseif($value->booking_status == 4)
                                                        <span title="Cancelled" class="badge badge-pill bg-danger-light"><i class="nc-icon nc-simple-remove"></i> Cancelled</span>
                                                        @elseif($value->booking_status == 5)
                                                        <span title="Completed" class="badge badge-pill bg-success-light"><i class="nc-icon nc-satisfied"></i> Completed</span>
                                                        @endif
                                                        @if($value->booking_status == 2 && $value->book_date == date('d-m-Y'))
                                                        <div class="custom-control custom-switch">
                                                            <!-- <input type="checkbox" class="custom-control-input" id="onbusy" @if($value->booking_status == 3) disabled checked @endif value="{{ $value->id }}" name="onbusy">
                                                            <label class="custom-control-label" for="onbusy">On busy</label> -->
                                                        </div>
                                                        @endif
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

<!--Comment modal popup-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="staticBackdropLabel"><i class="nc-icon nc-notes"></i> Booking Forward</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="doctor-widget"></div>
                <form novalidate id="forward-booking-form">
                    <input type="hidden" name="booking_id" id="booking_id" />
                    <input type="hidden" name="from_canceled" id="from_canceled" value="2" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Forward Reasons:</label>
                        <select class="form-control" name="assistant_boy_fwrd_comment" id="assistant_boy_fwrd_comment" required="">
                            <option value="">Select Forward reasons</option>
                            @foreach($fwrd_reasons as $key=>$val)
                            <option value="{{ $val['value'] }}">{{ $val['label'] }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select the reasons</div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-confirm" class="btn btn-primary btn-sm btn-fill">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Comment modal popup-->
@endsection
@push('script')
<script>
    var prefix = "@php echo $account_prefix @endphp";
</script>
<script src="{{asset('frontend-source/myaccount/assets/js/assistant-validate.js')}}"></script>
@endpush