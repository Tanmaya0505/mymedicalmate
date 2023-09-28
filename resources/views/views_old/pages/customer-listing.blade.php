@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Customer listing')
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
        <form>
            <div class="row border rounded py-2 mb-2">
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-verified">Admin status</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="admin_status">
                            <option value="">ANY</option>
                            <option value="1" @if(isset($_GET['admin_status']) && $_GET['admin_status'] == 1) selected @endif>VERIFIED</option>
                            <option value="0" @if(isset($_GET['admin_status']) && $_GET['admin_status'] == 0 && $_GET['admin_status'] != '') selected @endif>PENDDING</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-status">Customer Status</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="customer_status">
                            <option value="">ANY</option>
                            <option value="0" @if(isset($_GET['customer_status']) && $_GET['customer_status'] == 0 && $_GET['customer_status'] != '') selected @endif>NOT VERIFIED</option>
                            <option value="1" @if(isset($_GET['customer_status']) && $_GET['customer_status'] == 1) selected @endif>ACTIVE</option>
                            <option value="2" @if(isset($_GET['customer_status']) && $_GET['customer_status'] == 2) selected @endif>BANNED</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-role">Account Type</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="account_type">
                            <option value="">ANY</option>
                            @foreach($types as $type)
                            <option value="{{ $type->id }}" @if(isset($_GET['account_type']) && $_GET['account_type'] == $type->id) selected @endif>{{ $type->account_name }}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                    <a href="{{url($configData['route'].'/customer-listing')}}" type="reset" class="btn btn-primary btn-block glow users-list-clear mb-0">Clear</a>
                </div>
            </div>
        </form>
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
                                    <th>Account Type</th>
                                    <th width="15%">Full Name</th>
                                    <th>Email</th>
                                    <th>Admin status</th>
                                    <th>Customer status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $key=>$customer)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>@if(!empty($customer->accountType)) {{ $customer->accountType->account_name }} @else {{ 'Not Selected' }} @endif</td>
                                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                        <span class="badge @if($customer->admin_status == 0) badge-light-warning @else badge-light-success @endif">
                                            @if($customer->admin_status == 0)
                                                <span style="display: block;"><i class="bx bx-user"></i></span>
                                            @else
                                                <span style="display: block;"><i class="bx bx-user-check"></i></span>
                                            @endif
                                            {{ (new \App\Helpers\CustomerHelper)->customerAdminStatus($customer->admin_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge @if($customer->status == 0) badge-light-warning @elseif($customer->status== 1) badge-light-success @else badge-light-danger @endif">
                                            @if($customer->status == 0)
                                                <span style="display: block;"><i class="bx bx-mail-send"></i></span>
                                            @elseif($customer->status== 1)
                                                <span style="display: block;"><i class="bx bx-user-check"></i></span>
                                            @else
                                                <span style="display: block;"><i class="bx bx-block"></i></span>
                                            @endif
                                            {{ (new \App\Helpers\CustomerHelper)->customerStatus($customer->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{url($configData['route'].'/customer-listing',$customer->id)}}/view">
                                            <span class="badge badge-light-secondary">
                                                <span style="display: block;"><i class="bx bx-edit-alt"></i></span>
                                                View & Update
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
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-users.js')}}"></script>
<script type="text/javascript">
    $('select').on('change', function() {
        let admin_status = $('#admin_status').val();
        let customer_status = $('#customer_status').val();
        let account_type = $('#account_type').val();
        let queryString = window.location.search;
        let params = new URLSearchParams(queryString);
        params.delete('admin_status');
        params.append('admin_status', admin_status);
        params.delete('customer_status');
        params.append('customer_status', customer_status);
        params.delete('account_type');
        params.append('account_type', account_type);
        document.location.href = "?" + params.toString();
    });
</script>
@endsection