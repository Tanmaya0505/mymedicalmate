@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Staff Working Hours Views')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection
@section('content')
<!-- users list start -->
<section class="users-list-wrapper">
    <div class="users-list-filter px-1">
        
    </div>
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Staff Name</th>
                                    <th width="15%">Date</th>
                                    <th>LogIn Date Time</th>
                                    <th>LogOut Date Time</th>
                                    <th>Total Hour</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $key=>$customer)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    
                                    <td>{{ $customer->user->name }}</td>
                                    <td>{{ $customer->login_date }}</td>
                                    <td>
                                        {{$customer->login_date_time}}
                                    </td>
                                    <td>
                                        {{$customer->logout_date_time}}
                                    </td>
                                    <td>  {{\Carbon\Carbon::parse($customer->login_date_time)->diffInMinutes($customer->logout_date_time)}} </td>
                                    
                                    <td>
                                        <a href="{{url($configData['route'].'/staff-workingtime',$customer->staff_id)}}">
                                            <span class="badge badge-light-secondary">
                                                <span style="display: block;"><i class="bx bx-edit-alt"></i></span>
                                                View 
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- datatable ends -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
@endsection

{{-- page scripts --}}
