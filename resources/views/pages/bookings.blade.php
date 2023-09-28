@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Bookings')
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
        <form id="booking_filter">
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
                        <select class="form-control" id="booking_status" name="booking_status">
                            <option value="">ANY</option>
                            <option value="0" @if(isset($_GET['booking_status']) && $_GET['booking_status'] == 0 && $_GET['booking_status'] != '') selected @endif>FAILED</option>
                            <option value="1" @if(isset($_GET['booking_status']) && $_GET['booking_status'] == 1) selected @endif>BOOKED</option>
                            <option value="2" @if(isset($_GET['booking_status']) && $_GET['booking_status'] == 2) selected @endif>ACCEPTED</option>
                            <option value="3" @if(isset($_GET['booking_status']) && $_GET['booking_status'] == 3) selected @endif>ON BUSY</option>
                            <option value="4" @if(isset($_GET['booking_status']) && $_GET['booking_status'] == 4) selected @endif>CANCELLED</option>
                            <option value="5" @if(isset($_GET['booking_status']) && $_GET['booking_status'] == 5) selected @endif>COMPLETED</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-status">Booking From Date</label>
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control pickadate-months-year" id="from_date" name="from_date" value="{{ $from_date }}" placeholder="Select Booking From Date">
                        <div class="form-control-position">
                          <i class='bx bx-calendar'></i>
                        </div>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-role">Booking To Date</label>
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control pickadate-months-year" id="to_date" name="to_date" value="{{ $to_date }}" placeholder="Select Booking To Date">
                        <div class="form-control-position">
                          <i class='bx bx-calendar'></i>
                        </div>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{url($config['route'].'/bookings')}}" type="reset" class="btn btn-primary">Clear</a>
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
                                    <th>PATIENT NAME</th>
                                    <th>BOOKED DATE</th>
                                    <th>PATIENT MOBILE</th>
                                    <th>PATIENT EMAIL</th>
                                    <th>PAID AMOUNT</th>
                                    <th>STATUS</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $key=>$value)
                                @php
                                $customer_meta = json_decode($value->customer_meta, true);
                                $patient_name = ucwords($customer_meta['patient_name']);
                                $patient_email = strtolower($customer_meta['patient_email']);
                                @endphp
                                <tr>
                                    <td>{{ strlen($patient_name) > 12 ? substr($patient_name,0,12)."..." : $patient_name }} <br /><a title="{{ $patient_name }}" href="{{ url($config['route'].'/bookings/'.$value->booking_id) }}">#{{ $value->booking_id }}</a></td>
                                    <td>{{ date('d M,Y' ,strtotime($value->book_date)) }}<span class="d-block text-info">{{ $value->arrival_time }}</span></td>
                                    <td>{{ $customer_meta['patient_mobile'] }}</td>
                                    <td title="{{ $patient_email }}">{{ strlen($patient_email) > 10 ? substr($patient_email,0,10)."..." : $patient_email }}</td>
                                    <td>&#8377;{{ $value->grand_price }}</td>
                                    <td class="ass_assign_{{ $value->id }}">
                                        @if(!empty($value->assistant_boy_id) && $value->booking_status == 1)
                                        <span title="Pending" class="badge badge-light-warning">Pending</span>
                                        @elseif(empty($value->assistant_boy_id) && $value->booking_status == 1)
                                        <a title="Assign" href="javascript:void(0)" onclick="findServiceArea({{ $value->id }})"><span class="badge badge-pill bg-warning-light"> Assign</span></a>
                                        @elseif($value->booking_status == 2)
                                        <span title="Accepted" class="badge badge-light-success">Accepted</span>
                                        @elseif($value->booking_status == 3)
                                        <span title="Accepted" class="badge badge-light-warning">On Service</span>
                                        @elseif($value->booking_status == 4)
                                        <span title="Cancelled" class="badge badge-light-danger">Cancelled</span>
                                        @elseif($value->booking_status == 5)
                                        <span title="Cancelled" class="badge badge-light-success">Completed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a title="View" href="{{ url($config['route'].'/bookings/'.$value->booking_id) }}" class="btn btn-sm btn-light-info">View</a>
                                        <a title="Cancel" href="javascript:void(0);" @if($value->booking_status == 1 && $value->fwrd_status == 1 && empty($value->assistant_boy_id)) onclick="cancelBooking({{ $value->id }})" @endif class="btn btn-sm btn-light-danger @if($value->booking_status == 4 || !empty($value->assistant_boy_id)) disabled @endif">Cancel</a>
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

<!--Assign assistant Modal -->
<div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">ASSIGN TO ASSISTANT</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body scrollable-container">
                <form novalidate id="assign-assistant-form">
                    <input type="hidden" name="booking_id" id="booking_id" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Select Service Area:</label>
                        <select class="form-control" name="service_area" id="service_area" onchange="selectServiceArea(this.value)"></select>
                    </div>
                    <div id="assistant_data"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="assign-assistant" disabled="" class="btn btn-primary btn-sm">Assign</button>
          </div>
        </div>
    </div>
</div>
<!--End Assign assistant Modal -->
<!--Assign assistant Modal -->
<div class="modal fade text-left modal-borderless" id="cancel-modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">BOOKING CANCEL</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body scrollable-container">
                <form novalidate id="cancel-booking-form">
                    <input type="hidden" name="booking_id" id="cancel_booking_id" />
                    <input type="hidden" name="from_canceled" id="from_canceled" value="1" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Cancel Reasons:</label>
                        <textarea type="text" placeholder="Cancel Reasons" class="form-control" name="cancel_reason" id="cancel_reason" required=""></textarea>
                        <div class="invalid-feedback">Please write the reasons</div>
                    </div>
                    <button type="submit" id="btn-confirm" class="btn btn-primary btn-sm">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Assign assistant Modal -->
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
<script src="{{asset('custom/assistant-booking.js') }}"></script>
<script src="{{asset('js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>
@endsection