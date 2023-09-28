@extends('frontend-source.customer-dashboard.layouts.master')
@section('title') Bookings @stop
@section('keywords') Bookings @stop
@section('description') Bookings @stop
@section('style')
<link href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Coupon</h4>
                
                <div class="appointment-tab">
                    <div class="tab-content">
                        <!-- Upcoming Appointment Tab -->
                        <div class="tab-pane show active" id="upcoming-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Coupon Title</th>
                                                    <th>Coupon Name</th>
                                                    <th>coupon Discount Type</th>
                                                    <th>Coupon Type</th>
                                                    <th>Purchasing value</th>
                                                    <th>Coupon value</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $coupon)
                                                
                                                <tr>
                                                    <td>{{ $coupon->coupon_title }}</td>
                                                    <td>{{ $coupon->coupon_name }}</td>
                                                    <td>{{ $coupon->coupon_discount_type }}</td>
                                                    <td>{{ ($coupon->coupon_type) }}</td>
                                                    <td>{{ ($coupon->purchasing_value) }}</td>
                                                    <td>{{ ($coupon->coupon_value) }}</td>
                                                    <td>
                                                        <span class="badge btn-white">{{ ($coupon->status) }}</span>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="table-action">
                                                            <a title="View" href="#{{ url($account_prefix.'/coupon/'.$coupon->id) }}" class="btn btn-sm bg-info btn-fill">
                                                                <i class="far fa-eye"></i> View
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>		
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Upcoming Appointment Tab -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Comment modal popup-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="staticBackdropLabel"><i class="nc-icon nc-notes"></i> Booking Forward</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="doctor-widget"></div>
                <form novalidate id="forward-booking-form">
                    <input type="hidden" name="booking_id" id="booking_id" />
                    <input type="hidden" name="from_canceled" id="from_canceled" value="2" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Forward Reasons:</label>
                        <select class="form-control" name="assistant_boy_fwrd_comment" id="assistant_boy_fwrd_comment" required="">
                            <option value="">Select Forward reasons</option>
                            @foreach($fwrd_reasons as $key=>$val)
                            <option value="{{ $val['value'] }}">{{ $val['label'] }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select the reasons</div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-confirm" class="btn btn-primary btn-sm btn-fill">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Comment modal popup-->
@endsection
@push('script')
<script>
    var prefix = "@php echo $account_prefix @endphp";
</script>
<script src="{{asset('frontend-source/myaccount/assets/js/assistant-validate.js')}}"></script>
@endpush