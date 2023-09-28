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
                @if(Session::get('accountId') == 2)
                <a href="{{url('assistant/upload-prescription')}}">UPLOAD PRESCRIPTION</a>
                @endif
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
                                                @foreach($data as $key=>$value)
                                                @php
                                                    $full_name = ucwords($value->full_name);
                                                @endphp
                                                <tr>
                                                    <td title="{{  $full_name }}">
                                                        {{ strlen($full_name) > 12 ? substr($full_name,0,12)."..." : $full_name }}
                                                        <br />
                                                        @if(!empty($value->prescription_photo)) <a href="{{ url('prescription') }}/{{ $value->prescription_photo }}" target="_blank" class=""><i class="far fa-file-image"></i></a>  @endif
                                                        <a title="{{ $full_name }}" href="{{ url($account_prefix.'/prescription/'.$value->order_id) }}">#{{ $value->order_id }}</a>
                                                    </td>
                                                    <td>{{ $value->mobile_no }}</td>
                                                    <td>{{ $value->age }} @if(!empty($value->age)) Years @endif <br/><span class="text-info">{{ $value->gender }}</span></td>
                                                    <td>{{ date('d M, Y' ,strtotime($value->created_at)) }}</td>
                                                    <td>
                                                        <span class="badge btn-white">{{ (new \App\Helpers\CustomerHelper)->prescriptionsStatus($value->customer_status) }}</span>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="table-action">
                                                            <a title="View" href="{{ url($account_prefix.'/prescription/'.$value->order_id) }}" class="btn btn-sm bg-info btn-fill">
                                                                <i class="far fa-eye"></i> View
                                                            </a>
                                                            <a title="Cancel" href="javascript:void(0);" @if($value->customer_status == 1) onclick="cancelPrescription('{{ $value->customer_status }}')" @endif class="btn btn-sm bg-danger btn-fill @if($value->customer_status != 1)disabled @endif">
                                                                <i class="fas fa-times"></i> Cancel
                                                            </a>
                                                            @if(Session::get('accountId') == 2)
                                                            <a href="{{url('assistant/medmate-search/'.$value->order_id)}}" class="btn btn-sm bg-info btn-fill" target="_blank">Search</a>
                                                            @endif
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