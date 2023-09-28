@extends('frontend-source.customer-dashboard.layouts.master')
@section('title') Dashboard @stop
@section('keywords') Dashboard @stop
@section('description') Dashboard @stop
@section('style')

@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        @if(Session::get('accountId') == Config::get('constants.accountType.user'))
            @include('frontend-source.customer-dashboard.user.dashboard')
        @elseif(Session::get('accountId') == Config::get('constants.accountType.assistant'))
            @include('frontend-source.customer-dashboard.assistant.dashboard')
        @elseif(Session::get('accountId') == Config::get('constants.accountType.doctor'))
            @include('frontend-source.customer-dashboard.doctor.dashboard')
        @elseif(Session::get('accountId') == Config::get('constants.accountType.vendor'))
            @include('frontend-source.customer-dashboard.vendor.dashboard')
        @endif
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
</script>
@endpush