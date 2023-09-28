@extends('frontend-source.customer-dashboard.layouts.master')

@section('title') Bookings @stop

@section('keywords') Bookings @stop

@section('description') Bookings @stop

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">

@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">BOOKING COMMISION</h4>
                @php
                $total_commision = 0;
                $all_ids = '';

                @endphp
                <div class="users-list-table">
                    <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                        <!-- datatable start -->
                        <div class="table-responsive">
                            <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>Booking id</th>
                                    
                                    <th>Medemate Percentage(%)</th>
                                    <th>Medemate Price</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($commisionlist as $order)
                                <tr>
                                <td>{{$order->booking_id}}</td>
                                <td>{{$order->mademate_prcnt ?? 'N/A'}}</td>
                                <td>{{$order->mademate_amt ?? 'N/A'}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>{!! $order->status !!}</td>
                                
                                </tr>
                                @php 

                                $total_commision=$total_commision+$order->mademate_amt;
                                if($order->status=='unpaid'){
                                    $all_ids .= $order->booking_id.',';
                                }


                                @endphp
                                @empty
                                @endforelse
                                <tr>
                                    <th>Total Commision</th><th></th>
                                    <th>{{$total_commision}}</th>
                                    <th>
                                        @if($all_ids && $total_commision >= 500)
                                        <form method="post" action="{{url('/assistant/payment-request-admin')}}">
                                        @csrf
                                        <input type="hidden" name="booking_ids" value="{{$all_ids}}" />
                                        <button class="btn btn-primary">Request to Admin For Payment</button>
                                        </form>
                                        @endif
                                    </th>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <!-- datatable ends -->
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

