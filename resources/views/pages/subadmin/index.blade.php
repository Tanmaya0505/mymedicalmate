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
<link href="{{asset('dist/css/select2.css')}}" rel="stylesheet" />
<style>
.btn i {
    top:0px;
}
.x {
    /*position: absolute;*/
    background: red;
    color: white;
    top: -10px;
    right: -10px;
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
                                        
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/sub-admin/add')}}">Add Sub Admin</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="users-list-datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Full Name</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Password</th>
                                                        
                                                        <th>Action</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($data as $key=>$value)
                                                    
                                                    <tr>
                                                        <td title="{{  $value->name }}">
                                                            {{ $value->name}}
                                                        </td>
                                                        <td>{{ $value->email }}</td>
                                                        
                                                        <td>{{ $value->role ? $value->role->name :'' }}</td>
                                                        
                                                        <td>{{ $value->user_password }}</td>
                                                        <td><a href="{{ url('/cms-admin/sub-admin/edit/'.$value->id) }}"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ url('/cms-admin/sub-admin/delete/'.$value->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        
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
<script src="{{asset('dist/js/select2.js')}}"></script>
<script type="text/javascript">
    $(function () {
      $('select').each(function () {
        $(this).select2({
          //theme: 'bootstrap4',
          //width: 'style',
          placeholder: $(this).attr('placeholder'),
          allowClear: Boolean($(this).data('allow-clear')),
        });
      });
    });
    $("#rowAdder").click(function () {
            newRowAdd =
            '<div id="row" class="row  m-3" >\
            <div class="col-6">\
                <textarea name="disease_desc[]" class="form-control"></textarea>\
            </div>\
            <div class="col-4">\
                <input type="file" name="disease_img[]">\
            </div>\
            <div class="col-2">\
                <button type="button" id = "x">X</button>\
            </div></div>';
 
            $('#newinput').append(newRowAdd);
        });
 
        $("body").on("click", "#x", function () {
            $(this).parents("#row").remove();
        });
</script>
@endsection
