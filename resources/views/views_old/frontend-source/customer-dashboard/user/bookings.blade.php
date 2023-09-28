@extends('frontend-source.customer-dashboard.layouts.master')
@section('title') Bookings @stop
@section('keywords') Bookings @stop
@section('description') Bookings @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">
<style>
    ul {
        list-style: none;
        margin: 0;
        padding: 0;
        font-size: 14px;
    }
</style>
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-4 page-heading">MY BOOKING HISTRORY</h4>
            @foreach($data as $key=>$value)
            @php
                $assistant_boy_meta = json_decode($value->assistant_boy_meta, true);
                if(!empty($value->assistant_boy_id)){
                    $assistant_name = strtoupper($assistant_boy_meta['first_name'].' '.$assistant_boy_meta['last_name']);
                    $gender = $assistant_boy_meta['gender'];
                    $service_area = $assistant_boy_meta['service_area'];
                    $photo = asset('assistant/'. $assistant_boy_meta['photo']);
                    if(empty($assistant_boy_meta['photo']) || !file_exists(public_path('assistant/'. $assistant_boy_meta['photo']))){
                        $photo = asset('frontend-source/images/assistant-boy-icon.png');
                    }
                    $phone = $assistant_boy_meta['phone'];
                } else {
                    $assistant_name = strtoupper($assistant_boy_meta['name']);
                    $gender = 'Male';
                    $service_area = '--';
                    $photo = env('LOGO_URL');
                    $phone = 'N/A';
                }
                $assistant_email = $assistant_boy_meta['email'];
                $customer_meta = json_decode($value->customer_meta, true);
            @endphp
            <div class="mm-book-table-data">
                <div class="name">Medical Mate: {{ $assistant_name }} <span>{{ $gender }}</span></div>
                <div class="content">
                    <ul>
                        <li><strong><i class="fas fa-map-marker-alt"></i> Service Area:</strong> {{ $service_area }}</li>
                        <li><strong><i class="fas fa-calendar-alt"></i> Service Date:</strong> {{ date('d F Y' ,strtotime($value->book_date)) }}</li>
                        <li><strong><i class="fas fa-rupee-sign"></i> Service Charge:</strong> {{ $value->grand_price }}</li>
                        <li><strong><i class="fas fa-motorcycle"></i> Bike Fare:</strong>@if($value->pickup_status){{ $value->arrival_km }} @else 00-00Km @endif</li>
                    </ul>
                    <div class="row action-btn-part mt10">
                        @if($value->booking_status == 2)
                        <div class="col-4"><a href="javascript:void(0)" class="btn bg-success btn-fill">Accepted</a></div>
                        @endif
                        <div class="col-4 f0"><a href="{{ url($account_prefix.'/bookings/'.$value->booking_id) }}" class="btn bg-primary btn-fill"> View Details</a></div>
                        @if($value->booking_status == 1 || $value->booking_status == 2)
                        <div class="col-4"><a title="Cancel" href="javascript:void(0);" onclick="cancelBooking('{{ $value->booking_id }}')" class="btn bg-danger btn-fill"> Cancel</a></div>
                        @endif
                        @if($value->booking_status == 4)
                        <div class="col-4"><a href="javascript:void(0);" class="btn bg-danger btn-fill"> Cancelled</a></div>
                        @endif
                        @if($value->booking_status == 5)
                        <div class="col-4"><a href="javascript:void(0);" class="btn bg-success btn-fill">completed</a></div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
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
<script src="{{asset('frontend-source/myaccount/assets/js/user-validate.js')}}"></script>
@endpush
