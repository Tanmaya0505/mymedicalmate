@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Account Settings')
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
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0 pills-stacked">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center active" id="account-pill-general" data-toggle="pill"
                               href="#account-vertical-general" aria-expanded="true">
                                <i class="bx bx-cog"></i>
                                <span>General</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="account-pill-password" data-toggle="pill"
                               href="#account-vertical-password" aria-expanded="false">
                                <i class="bx bx-lock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="account-pill-social" data-toggle="pill"
                               href="#account-vertical-social" aria-expanded="false">
                                <i class="bx bxl-twitch"></i>
                                <span>Social links</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="account-pill-notifications" data-toggle="pill"
                               href="#account-vertical-notifications" aria-expanded="false">
                                <i class="bx bx-bell"></i>
                                <span>Admin Config</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="account-pill-user-config" data-toggle="pill"
                               href="#account-vertical-user-config" aria-expanded="false">
                                <i class="bx bx-user"></i>
                                <span>User Config</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="account-pill-assistant-config" data-toggle="pill"
                               href="#account-vertical-assistant-config" aria-expanded="false">
                                <i class="bx bx-briefcase-alt"></i>
                                <span>Medical Mate Config</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="account-pill-doctor-config" data-toggle="pill"
                               href="#account-vertical-doctor-config" aria-expanded="false">
                                <i class="bx bx-first-aid"></i>
                                <span>Doctor Config</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="account-pill-vendor-config" data-toggle="pill"
                               href="#account-vertical-vendor-config" aria-expanded="false">
                                <i class='bx bxs-donate-blood'></i>
                                <span>Vendor Config</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- right content section -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                         aria-labelledby="account-pill-general" aria-expanded="true">
                                        <div class="media">
                                            <a href="javascript: void(0);">
                                                <img src="{{asset('images/portrait/small/avatar-s-16.jpg')}}"
                                                     class="rounded mr-75" alt="profile image" height="64" width="64">
                                            </a>
                                            <div class="media-body mt-25">
                                                <div
                                                    class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                    <label for="select-files" class="btn btn-sm btn-light-primary ml-50 mb-50 mb-sm-0">
                                                        <span>Upload new photo</span>
                                                        <input id="select-files" type="file" hidden>
                                                    </label>
                                                    <button class="btn btn-sm btn-light-secondary ml-50">Reset</button>
                                                </div>
                                                <p class="text-muted ml-1 mt-50"><small>Allowed JPG, GIF or PNG. Max
                                                        size of 800kB</small></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <form novalidate id="general-info">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Full Name</label>
                                                            <input type="text" class="form-control" name="name" placeholder="Name"
                                                                   value="{{ $adminInfo->name }}" required
                                                                   data-validation-required-message="This name field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>E-mail</label>
                                                            <input type="email" class="form-control" name="email" placeholder="Email"
                                                                   value="{{ $adminInfo->email }}" required
                                                                   data-validation-required-message="This email field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade " id="account-vertical-password" role="tabpanel"
                                         aria-labelledby="account-pill-password" aria-expanded="false">
                                        <form novalidate id="change-password">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Old Password</label>
                                                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required placeholder="Old Password" data-validation-required-message="This old password field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>New Password</label>
                                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" required data-validation-required-message="The password field is required" minlength="6">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Retype new Password</label>
                                                            <input type="password" name="con_password" class="form-control @error('con_password') is-invalid @enderror" required data-validation-match-match="password" placeholder="New Password" data-validation-required-message="The Confirm password field is required" minlength="6">
                                                            @if ($errors->has('con_password'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('con_password') }}</strong>
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
                                    <div class="tab-pane fade " id="account-vertical-social" role="tabpanel"
                                         aria-labelledby="account-pill-social" aria-expanded="false">
                                        <form>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Facebook</label>
                                                        <input type="text" class="form-control" placeholder="Add link">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Twitter</label>
                                                        <input type="text" class="form-control" placeholder="Add link"
                                                               value="https://www.twitter.com">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>LinkedIn</label>
                                                        <input type="text" class="form-control" placeholder="Add link"
                                                               value="https://www.linkedin.com">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Instagram</label>
                                                        <input type="text" class="form-control" placeholder="Add link">
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel"
                                         aria-labelledby="account-pill-notifications" aria-expanded="false">
                                        <form novalidate id="update-admin-config">
                                            @csrf
                                            <div class="row">
                                                @if(!empty($config['admin_config']->configs))
                                                    {!! viewForm($config['admin_config']->configs) !!}
                                                @endif
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="account-vertical-user-config" role="tabpanel"
                                         aria-labelledby="account-pill-user-config" aria-expanded="false">
                                        <form novalidate id="update-user-config">
                                            @csrf
                                            <div class="row">
                                                @if(!empty($config['user_config']->configs))
                                                    {!! viewForm($config['user_config']->configs) !!}
                                                @endif
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="account-vertical-assistant-config" role="tabpanel"
                                         aria-labelledby="account-pill-assistant-config" aria-expanded="false">
                                        <form novalidate id="update-assistant-config">
                                            @csrf
                                            <div class="row">
                                                @if(!empty($config['assistant_config']->configs))
                                                    {!! viewForm($config['assistant_config']->configs) !!}
                                                @endif
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="account-vertical-doctor-config" role="tabpanel"
                                         aria-labelledby="account-pill-doctor-config" aria-expanded="false">
                                        <form novalidate id="update-doctor-config">
                                            @csrf
                                            <div class="row">
                                                @if(!empty($config['doctor_config']->configs))
                                                    {!! viewForm($config['doctor_config']->configs) !!}
                                                @endif
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="account-vertical-vendor-config" role="tabpanel"
                                         aria-labelledby="account-pill-vendor-config" aria-expanded="false">
                                        <form novalidate id="update-vendor-config">
                                            @csrf
                                            <div class="row">
                                                @if(!empty($config['vendor_config']->configs))
                                                    {!! viewForm($config['vendor_config']->configs) !!}
                                                @endif
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
