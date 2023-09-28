
@extends('frontend-source.customer-dashboard.layouts.master')
@section('title') Prescription @stop
@section('keywords') Prescription @stop
@section('description') Prescription @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">
<style type="text/css">
    .donate-now {
  list-style-type: none;
  margin: 25px 0 0 0;
  padding: 0;
}

.donate-now li {
  float: left;
  margin: 0 5px 0 0;
  width: 100px;
  height: 40px;
  position: relative;
}

.donate-now label,
.donate-now input {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.donate-now input[type="radio"] {
  opacity: 0.01;
  z-index: 100;
}

.donate-now input[type="radio"]:checked+label,
.Checked+label {
  background: #DDD;
}

.donate-now label {
  padding: 5px;
  border: 1px solid #CCC;
  cursor: pointer;
  z-index: 90;
}

.donate-now label:hover {
  background: #DDD;
}

</style>
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Notifications</h4>
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
                                                    <th>id</th>
                                                    <th>Type</th>
                                                    <th width="15%">Message</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($list_notify as $key=>$coupon)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    
                                                    <td>{{ $coupon->notification_type }}</td>
                                                    <td>{{ $coupon->notification_message }}</td>
                                                    
                                                    
                                                    <!-- <td><a href="{{ url('/cms-admin/coupon-list/edit/'.$coupon->id) }}"><i class="fas fa-eye"></i></a>
                                                    </td> -->
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



@endsection
