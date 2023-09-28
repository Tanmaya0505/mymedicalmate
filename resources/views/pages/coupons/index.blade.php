@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Coupon Listing')
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
   
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-right pull-right">
                        <a href="{{url('/cms-admin/add-coupon')}}" class="btn btn-primary btn-block glow users-list-clear mb-0">Add Coupon</a>
                    </div>
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Coupon Name</th>
                                    <th>Purchasing Value</th>
                                    <th>Coupon Value</th>
                                    <th width="15%">Start Date</th>
                                    <th width="15%">End Date</th>
                                    <th>Type</th>
                                    
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_coupons as $key=>$coupon)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    
                                    <td>{{ $coupon->coupon_name }}</td>
                                    <td>{{ $coupon->purchasing_value }}</td>
                                    <td>{{ $coupon->coupon_value }}</td>
                                    <td>{{ $coupon->start_date }}</td>
                                    <td>{{ $coupon->end_date }}</td>
                                    <td>
                                        {{$coupon->coupon_type}}
                                    </td>
                                    
                                    <td>{{$coupon->status }}</td>
                                    
                                    <td><a href="{{ url('/cms-admin/coupon-list/edit/'.$coupon->id) }}"><i class="fas fa-edit"></i></a>
                                    <a href="{{ url('/cms-admin/coupon-list/delete/'.$coupon->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a></td>
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
<div class="modal fade" id="add_bonus_by_admin" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Bonus To User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="otp-validation" action="{{url('/cms-admin/add-bonus')}}" method="post" novalidate id="add-bonus-user">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Users:</label>

                        
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Bonus:</label>
                        <input type="number" placeholder="bonus" class="form-control" name="bonus" id="bonus" required="">
                        <div class="invalid-feedback">Please enter your Bonus</div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Expaire Date:</label>
                        <input type="date" placeholder="Expaired date" class="form-control" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" name="exp_date" id="exp_date" required="">
                        <div class="invalid-feedback">Please enter your Expaired</div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-confirm" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
    $('#search_user_bonus').on('change', function() {
      $('#search_form_bonus').submit();
    });
    function addCoupon(){
        $('#add_coupon').modal('show');
    }
</script>
@endsection