@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Suggestions')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/pickadate/pickadate.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">
<style type="text/css">
    .checkbx-label{
        display: flex;
        align-items: center;
    }
    .table th, .table td{
        padding: 20px 5px;
    }
    .has-icon-left .form-control-position i{
        top: 8px;
    }
</style>
@endsection
@section('content')
<!-- users list start -->
<section class="users-list-wrapper">
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
                                    <th>Full Name</th>
                                    <th>Mobile No</th>
                                    <th>Email</th>
                                    <th>Complaint type</th>
                                    <th>state & Dist</th>
                                    <th>Message</th>
                                    <th>Submitted Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key=>$value)
                                @php
                                $full_name = ucwords($value->sugg_name);
                                $sugg_state = $value->sugg_state;
                                $states = array_filter($stateDistrictsJson['states'], function ($k) use($sugg_state) {
                                    return ($k == $sugg_state);
                                }, ARRAY_FILTER_USE_KEY);
                                $sugg_district = $value->sugg_district;
                                $district = array_filter($states[$sugg_state]['districts'], function ($k) use($sugg_district) {
                                    return ($k == $sugg_district);
                                }, ARRAY_FILTER_USE_KEY);
                                @endphp
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td title="{{  $full_name }}">
                                        {{ strlen($full_name) > 12 ? substr($full_name,0,12)."..." : $full_name }}
                                    </td>
                                    <td>{{ $value->sugg_phone }}</td>
                                    <td title="{{  $value->sugg_email }}">{{ strlen($value->sugg_email) > 12 ? substr($value->sugg_email,0,12)."..." : $value->sugg_email }}</td>
                                    <td>{{ $value->sugg_complaint_type }}</td>
                                    <td>{{ $states[$sugg_state]['state'].', '.$district[$sugg_district] }}</td>
                                    <td>{{ $value->sugg_message }}</td>
                                    <td>{{ date('d M,Y' ,strtotime($value->created_at)) }}</td>
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
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-users.js')}}"></script>
<script src="{{asset('js/scripts/extensions/toastr.js')}}"></script>
@endsection