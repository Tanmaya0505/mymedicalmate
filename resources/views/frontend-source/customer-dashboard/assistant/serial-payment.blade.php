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
                <h4 class="mb-4">Serial Payment</h4>
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
                                    
                                    <th>Payment Mode</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $order)
                                <tr>
                                <td>{{$order->booking_id}}</td>
                                <td>{{$order->payment_mode==1 ? 'Online Payment Before Service Start' : 'Online Payment After Service Finish'}}</td>
                                <td>{{$order->total_price ?? 'N/A'}}</td>
                                
                                <td>{{$order->created_at}}</td>
                                
                                <td>{{$order->paid==1 ?  'Paid' : 'N/A'}}</td>
                                </tr>
                                @php 

                                $total_commision=$total_commision+$order->total_price;
                                


                                @endphp
                                @empty
                                @endforelse
                                <tr>
                                    <th>Total Commision</th><th></th>
                                    <th>{{$total_commision}}</th>
                                    <th>
                                        
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

