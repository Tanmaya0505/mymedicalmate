@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Bonus Listing')
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
        <form id="search_form_bonus">
            
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-role">User</label>
                    <fieldset class="form-group">
                        <select class="form-control" name="user_id" id="search_user_bonus">
                            <option value="">ANY</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" @if(isset($_GET['user_id']) && $_GET['user_id'] == $user->id) selected @endif>{{ $user->first_name .' '.$user->last_name }}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                    <a href="{{url($configData['route'].'/bonus-list')}}" type="reset" class="btn btn-primary btn-block glow users-list-clear mb-0">Clear</a>
                </div>
            </div>
        </form>
    </div>
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-right pull-right">
                        <button type="button"  onclick="addBonus()" class="btn btn-primary btn-block glow users-list-clear mb-0">Add Bonus</button>
                    </div>
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Staff Name</th>
                                    <th width="15%">Gen Date</th>
                                    <th width="15%">Exp Date</th>
                                    <th>Bonus</th>
                                    <th>Bonus Type</th>
                                    
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_bonus as $key=>$bonus)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    
                                    <td>{{ $bonus->user->first_name .' '.$bonus->user->last_name }}</td>
                                    <td>{{ $bonus->gen_date }}</td>
                                    <td>{{ $bonus->exp_date }}</td>
                                    <td>
                                        {{$bonus->bonus_price}}
                                    </td>
                                    <td>
                                        {{$bonus->bonus_type }}
                                    </td>
                                    <td>{{$bonus->status }}</td>
                                    
                                    
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

                        <select class="form-control" name="user_id" re id="account_type">
                            <option value="">ANY</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" >{{ $user->first_name .' '.$user->last_name }}</option>
                            @endforeach
                        </select>
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
    function addBonus(){
        $('#add_bonus_by_admin').modal('show');
    }
</script>
@endsection