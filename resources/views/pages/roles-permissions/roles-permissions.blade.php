@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','All Users')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">
<style>
.btn i {
    top:0px;
}
</style>
@endsection
@section('content')
<!-- account setting page start -->
<section id="page-account-settings">
    <div class="row">
        <div class="col-12">
            <div class="row">
                
                <!-- right content section -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                         aria-labelledby="account-pill-general" aria-expanded="true">
                                        <div class="table-responsive">
                                            <form novalidate id="add_per" method="post" action="{{url('/cms-admin/role-permissions-store')}}" enctype="multipart/form-data">
                                                
                                            @csrf 
                                            <div class="row">
                                                
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Roles</label>
                                                            <select id="role"  name="role"  class="form-control @error('user_role') is-invalid @enderror" required data-validation-required-message="This type field is required">
                                                                <option value="">Select Role</option>
                                                                @forelse($roles as $role)
                                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                                                @empty
                                                                @endforelse

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6"></div>
                                                <div class="col-12">
                                                     <h4>Permissions:-</h4>
                                                    @forelse($permissions as $persion)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input permission" type="checkbox" name="permisions[]" id="permission_{{$persion->id}}" value="{{$persion->id}}">
                                                        <label class="form-check-label" for="permission_{{$persion->id}}">{{$persion->name}}</label>
                                                    </div>
                                                    @empty
                                                    @endforelse
                                                    
                                                </div>
                                                
                                                

                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Create</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                        <!-- <div class="table-responsive">
                                            <table id="users-list-datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Role Name</th>
                                                        <th>Permission Name</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($data as $key=>$value)
                                                    
                                                    <tr>
                                                        
                                                        <td title="{{  $value->role_id }}">
                                                            {{ $value->role}}
                                                        </td>
                                                        <td title="{{  $value->permission_id }}">
                                                            {{ $value->permission}}
                                                        </td>
                                            
                                                    </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- account setting page ends -->
@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{asset('vendors/js/ui/blockUI.min.js')}}"></script>
@endsection
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-account-settings.js')}}"></script>
<script src="{{asset('js/scripts/extensions/toastr.js')}}"></script>
<script src="{{asset('custom/account-settings.js')}}"></script>
<script type="text/javascript">
    $('#role').on('change',function(){
        var role_id = $(this).val();

        $.ajax({
                url:"{{'/cms-admin/rolepermission-selected/'}}"+role_id,
                method:"GET",
                //data:{rating_data:rating_data, user_name:user_name, user_review:user_review},
                success:function(data)
                {
                    $('.permission').attr('checked',false);
                    $.each(data,function(index,per){
                        $('#permission_'+per.permission_id).attr('checked',true);

                    })
                }
            })

    })
</script>
@endsection
