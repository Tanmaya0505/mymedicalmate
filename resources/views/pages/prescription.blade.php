@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Prescription listing')
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
    <div class="users-list-filter px-1">
        <form id="prescription_filter">
            <div class="row border rounded py-2 mb-2">
                <?php
                    if(isset($_GET['from_date'])){
                        $from_date = trim($_GET['from_date']);
                    } else {
                        $from_date = '';
                    }
                    
                    if(isset($_GET['to_date'])){
                        $to_date = trim($_GET['to_date']);
                    } else {
                        $to_date = '';
                    }
                ?>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-verified">Booking status</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="customer_status" name="customer_status">
                            <option value="">ANY</option>
                            <option value="1" @if(isset($_GET['customer_status']) && $_GET['customer_status'] == 1) selected @endif>UPLOADED</option>
                            <option value="2" @if(isset($_GET['customer_status']) && $_GET['customer_status'] == 2) selected @endif>ASSIGNED TO VENDOR</option>
                            <option value="3" @if(isset($_GET['customer_status']) && $_GET['customer_status'] == 3) selected @endif>PENDING FROM CUSTOMER</option>
                            <option value="4" @if(isset($_GET['customer_status']) && $_GET['customer_status'] == 4) selected @endif>CONFIRMED</option>
                            <option value="5" @if(isset($_GET['customer_status']) && $_GET['customer_status'] == 5) selected @endif>DISPATCHED</option>
                            <option value="6" @if(isset($_GET['customer_status']) && $_GET['customer_status'] == 6) selected @endif>DELIVERED</option>
                            <option value="7" @if(isset($_GET['customer_status']) && $_GET['customer_status'] == 7) selected @endif>RETURN REQUEST</option>
                            <option value="8" @if(isset($_GET['customer_status']) && $_GET['customer_status'] == 8) selected @endif>RETURNED</option>
                            <option value="0" @if(isset($_GET['customer_status']) && $_GET['customer_status'] == 0) selected @endif>CANCELLED</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-status">Order From Date</label>
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control pickadate-months-year" id="from_date" name="from_date" value="{{ $from_date }}" placeholder="Select Order From Date">
                        <div class="form-control-position">
                          <i class='bx bx-calendar'></i>
                        </div>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-role">Order To Date</label>
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control pickadate-months-year" id="to_date" name="to_date" value="{{ $to_date }}" placeholder="Select Order To Date">
                        <div class="form-control-position">
                          <i class='bx bx-calendar'></i>
                        </div>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{url($config['route'].'/prescription')}}" type="reset" class="btn btn-primary">Clear</a>
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
                                    <td>{{ $key+1 }}</td>
                                    <td title="{{  $full_name }}">
                                        {{ strlen($full_name) > 12 ? substr($full_name,0,12)."..." : $full_name }}
                                        <br />
                                        @if(!empty($value->prescription_photo)) <a href="{{ asset('public/prescription') }}/{{ $value->prescription_photo }}" target="_blank" class=""><i class="far fa-file-image"></i></a>  @endif
                                        <a title="{{ $full_name }}" href="{{ url('/prescription/'.$value->order_id) }}">#{{ $value->order_id }}</a>
                                    </td>
                                    <td>{{ $value->mobile_no }}</td>
                                    <td>{{ $value->age }} @if(!empty($value->age)) Years @endif <br/><span class="text-info">{{ $value->gender }}</span></td>
                                    <td>{{ date('d M,Y' ,strtotime($value->created_at)) }}</td>
                                    <td>
                                        <span class="badge btn-outline-dark">{{ (new \App\Helpers\CustomerHelper)->prescriptionsStatus($value->customer_status) }}</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="table-action">
                                            @if($value->customer_status == 1)
                                            <a title="Assign" href="javascript:void(0)" class="btn btn-sm btn-light-info" data-toggle="modal" data-target="#border-less" onclick="assignVendor({{ $value->id }})">Assign</a>
                                            @endif
                                            <a title="View" href="{{ url($config['route'].'/prescription/'.$value->order_id) }}" class="btn btn-sm btn-light-info">View</a>
                                            <a title="Cancel" href="javascript:void(0);" @if($value->customer_status == 1) onclick="cancelPrescription('{{ $value->customer_status }}')" @endif class="btn btn-sm btn-light-danger @if($value->customer_status != 1) disabled @endif">Cancel</a>
                                        </div>
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

<!--Assign to vendor Modal -->
<div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">ASSIGN TO VENDOR</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body scrollable-container">
                <form novalidate id="assign-vendor-form">
                    <input type="hidden" name="prescription_id" id="prescription_id" />
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dist" class="col-form-label">Select Dist:</label>
                                <select class="form-control" name="dist" id="dist" onchange="filterVendor()">
                                    @foreach($dist as $dk=>$dv)
                                    <option value="{{ $dk }}">{{ $dv['option_label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="categories" class="col-form-label">Select Dist:</label>
                                <select class="form-control" name="categories" id="categories" onchange="filterVendor()">
                                    @foreach($categories as $catk=>$catv)
                                    <option value="{{ $catk }}">{{ $catv['option_label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="discount" class="col-form-label">Discount:</label>
                                <select class="form-control" name="discount" id="discount" onchange="filterVendor()">
                                    @foreach($discount as $disk=>$disv)
                                    <option value="{{ $disk }}">{{ $disv['option_label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="vendor_data"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="assign-vendor" disabled="" class="btn btn-primary btn-sm">Assign</button>
          </div>
        </div>
    </div>
</div>
<!--End Assign to vendor Modal -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-users.js')}}"></script>
<script src="{{asset('js/scripts/extensions/toastr.js')}}"></script>
<script src="{{asset('custom/prescription.js')}}"></script>
<script src="{{asset('js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>
@endsection