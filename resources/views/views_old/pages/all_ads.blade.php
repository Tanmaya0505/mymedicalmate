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
                                        @if(Auth::user()->user_role==2)
                                        <!-- <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-ads/add')}}">Add Ads</a>
                                        </div> -->
                                        @endif
                                        <div class="table-responsive">
                                            <table id="users-list-datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Ads For</th>
                                                        <th>Add Url</th>
                                                        <th>Status</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($data as $key=>$value)
                                                    
                                                    <tr>
                                                        
                                                        <td title="{{  $value->type_user }}">
                                                            {{ $user_types[$value->type_user]}}
                                                        </td>
                                                        <td><a target="_blank" href="{{ url($value->file_path) }}" > {{$value->file_path}}</a>
                                                        </td>
                                                        <td><a  href="{{ url('cms-admin/alltype-ads/'.$value->id) }}" onclick='return confirm("Are you sure to {{ $value->status==0 ? 'Active' :'In-Active' }} this Ads?")' >{{ $value->status==0 ? 'Inactive' :'Active' }}</a></td>
                                                        
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
@endsection
