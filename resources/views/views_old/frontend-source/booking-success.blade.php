@extends('frontend-source.layouts.master')
@section('title') Login @stop
@section('keywords') Login @stop
@section('description') Login @stop
@section('style')
<style type="text/css">
    .input-group-addon {
        position: absolute;
        right: 25px;
        top: 16px;
    }
</style>
@endsection
@section('content')
<div class="content success-page-cont">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card success-card">
                    <div class="card-body">
                        <div class="success-cont">
                            <i class="fas fa-check"></i>
                            <h3>Medical Mate booked Successfully!</h3>
                            <p>Your Booking ID <strong>#{{ $booking->booking_id }}</strong><br> on <strong>{{ date('d F Y' ,strtotime($booking->book_date)) }} @if(!empty($booking->arrival_time)) at {{ $booking->arrival_time }} @endif</strong></p>
                            <a href="{{ url($account_prefix.'/bookings/') }}" class="btn btn-primary view-inv-btn">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')

@endpush
