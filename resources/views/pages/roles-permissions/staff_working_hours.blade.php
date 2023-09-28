@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Staff Working Hours')
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
                    <label for="users-list-verified">From Date</label>
                    <fieldset class="form-group">
                        <input type="date" class="form-control" name="from_date"/>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-status">To Date</label>
                    <fieldset class="form-group">
                    <input type="date" class="form-control" name="to_date" />
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-role">Staffs</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="account_type" name="staff_id">
                            <option value="">ANY</option>
                            @foreach($types as $type)
                            <option value="{{ $type->id }}" @if(isset($_GET['staff_id']) && $_GET['staff_id'] == $type->id) selected @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                <button type="submit" class="btn btn-primary btn-block glow users-list-clear mb-0 mr-2">Search</button>
                <br/>
                    <a href="{{url($configData['route'].'/staff-workingtime')}}" type="reset" class="btn btn-primary btn-block glow users-list-clear mb-0 ml-2">Clear</a>
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
                                    <th>Staff Name</th>
                                    <th width="15%">Date</th>
                                    <th>LogIn Date Time</th>
                                    <th>LogOut Date Time</th>
                                    
                                    <!-- <th>Action</th> -->
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
                                        {{$customer->logout_date_time }}
                                    </td>
                                    
                                    
                                    <!-- <td>
                                        <a href="{{url($configData['route'].'/staff-workingtime',$customer->staff_id)}}">
                                            <span class="badge badge-light-secondary">
                                                <span style="display: block;"><i class="bx bx-edit-alt"></i></span>
                                                View 
                                            </span>
                                        </a>
                                    </td> -->
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
    // $('select').on('change', function() {
    //    // let admin_status = $('#admin_status').val();
    //     //let customer_status = $('#customer_status').val();
    //     let account_type = $('#account_type').val();
    //     let queryString = window.location.search;
    //     let params = new URLSearchParams(queryString);
    //    // params.delete('admin_status');
    //     //params.append('admin_status', admin_status);
    //    // params.delete('customer_status');
    //    // params.append('customer_status', customer_status);
    //     params.delete('account_type');
    //     params.append('staff_id', account_type);
    //     document.location.href = "?" + params.toString();
    // });
</script>
@endsection