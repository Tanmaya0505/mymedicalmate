@extends('frontend-source.customer-dashboard.layouts.master')

@section('title') Bookings @stop

@section('keywords') Bookings @stop

@section('description') Bookings @stop
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
                                        
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <!-- <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-ads')}}">List Ads</a> -->
                                        </div>
                                         
                                        <form novalidate id="add_doctor" method="post" action="{{url('/user/postall_ads')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Ads For</label>
                                                            <select type="text" name="type_user"  class="form-control @error('type_user') is-invalid @enderror" required data-validation-required-message="This type field is required">
                                                                <option value="">Select Type</option>
                                                                <option value="3">Doctors</option>
                                                                <option value="1">Users</option>
                                                                <option value="2">Medical Mate</option>
                                                                <option value="4">Vendor</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Upload Video for Ads</label>
                                                            <input type="file" name="video" class="form-control @error('video') is-invalid @enderror" required accept="video/*" data-validation-required-message="The Video Ads field is required" >
                                                            @if ($errors->has('video'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('video') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                        
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
