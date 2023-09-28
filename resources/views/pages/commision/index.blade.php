@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users List')
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
          <label for="users-list-role">Medmate</label>
          <fieldset class="form-group">
            <select class="form-control" id="user_id" name="medmate">
              <option value="">Select Medmate</option>
              @forelse($users as $user)
              <option value="{{$user->id}}" @if(isset($_GET['medmate']) && $_GET['medmate'] == $user->id) selected @endif  >{{$user->first_name.' '.$user->last_name}}</option>
              @empty
              @endforelse
            </select>
          </fieldset>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
          <label for="users-list-role">Vendor</label>
          <fieldset class="form-group">
            <select class="form-control" id="vendor_id" name="vendor">
              <option value="">Select Vendor</option>
              @forelse($vendors as $vend)
              <option value="{{$vend->id}}" @if(isset($_GET['vendor']) && $_GET['vendor'] == $user->id) selected @endif  >{{$vend->first_name.' '.$vend->last_name}}</option>
              @empty
              @endforelse
            </select>
          </fieldset>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
          <button type="submit" class="btn btn-primary btn-block glow users-list-clear mb-0">Search</button>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
          <a href="{{url('/cms-admin/commision-management')}}" class="btn btn-primary btn-block glow users-list-clear mb-0">Clear</a>
        </div>
      </div>
    </form>
  </div>
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
                    <th>Admin Percentage(%)</th>
                    <th>Admin Price</th>
                    <th>Medemate Percentage(%)</th>
                    <th>Medemate Price</th>
                    <th>Date</th>
                    <!-- <th>status</th> -->
                    <!-- <th>edit</th> -->
                </tr>
              </thead>
              <tbody>
                @forelse($commisionlist as $order)
                <tr>
                  <td>{{$order->booking_id}}</td>
                  <td>{{$order->admin_prcnt ?? 'N/A'}}
                  </td>
                  <td>{{$order->admin_amt ?? 'N/A'}}</td>
                  <td>{{$order->mademate_prcnt ?? 'N/A'}}</td>
                  <td>{{$order->mademate_amt ?? 'N/A'}}</td>
                  <td>{{$order->created_at}}</td>
                  <!-- <td>{!! $order->status !!}</td> -->
                  <!-- <td><a href="{{asset('page-users-edit')}}"><i
                              class="bx bx-edit-alt"></i></a></td> -->
                </tr>
                @php 

                  $total_commision=$total_commision+$order->admin_amt;
                  if($order->admin_status=='unpaid'){
                      $all_ids .= $order->booking_id.',';
                  }
                @endphp
                @empty
                @endforelse
                
              </tbody>
              <tfoot>
              @if(Request::get('vendor'))
                <tr>
                    <th>Total Commision</th><th></th>
                    <th>{{$total_commision}}</th>
                    <th>
                        @if($all_ids && $total_commision >= 1000)
                        <form method="post" action="{{url('/cms-admin/payment-request-vendor')}}">
                        @csrf
                        <input type="hidden" name="booking_ids" value="{{$all_ids}}" />
                        <input type="hidden" name="vendor_id" value="{{Request::get('vendor')}}" />
                        <button class="btn btn-primary">Request to Vendor For Payment</button>
                        </form>
                        @endif
                    </th>
                </tr>
                @endif
              </tfoot>
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
@endsection