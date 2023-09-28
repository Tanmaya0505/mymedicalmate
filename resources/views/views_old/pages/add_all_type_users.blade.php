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
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0 pills-stacked">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center 
                            @if(Request::segment(3)=='doctor') active @endif " id="account-pill-general" 
                               href="{{url('/cms-admin/alltype-user/doctor')}}" aria-expanded="true">
                                <i class="bx bx-cog"></i>
                                <span>Doctors</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='hospital') active @endif " id="account-pill-password"  href="{{url('/cms-admin/alltype-user/hospital')}}" aria-expanded="false">
                                <i class="bx bx-lock"></i>
                                <span>Hospitals</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='nurses') active @endif " id="account-pill-social"
                               href="{{url('/cms-admin/alltype-user/nurses')}}" aria-expanded="false">
                                <i class="bx bxl-twitch"></i>
                                <span>Nurses</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='clinics') active @endif" id="account-pill-notifications"
                               href="{{url('/cms-admin/alltype-user/clinics')}}" aria-expanded="false">
                                <i class="bx bx-bell"></i>
                                <span>Clinics</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='pharmas') active @endif " id="account-pill-user-config"
                               href="{{url('/cms-admin/alltype-user/pharmas')}}" aria-expanded="false">
                                <i class="bx bx-user"></i>
                                <span>Pharmaceutical Institutions</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='exams') active @endif " id="account-pill-assistant-config"
                               href="{{url('/cms-admin/alltype-user/exams')}}" aria-expanded="false">
                                <i class="bx bx-briefcase-alt"></i>
                                <span>Examinations</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='diseases') active @endif " id="account-pill-doctor-config"
                               href="{{url('/cms-admin/alltype-user/diseases')}}" aria-expanded="false">
                                <i class="bx bx-first-aid"></i>
                                <span>Diseases</span>
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
                                        @if(Request::segment(3)=='doctor')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/doctor')}}">List Doctors</a>
                                        </div>
                                         
                                        <form novalidate id="add_doctor" method="post" action="{{url('/cms-admin/postalltype-user/doctor')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="data_id" value="{{$data->id ?? ''}}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Full Name</label>
                                                            <input type="text" value="{{$data->full_name ?? ''}}" name="full_name" class="form-control @error('full_name') is-invalid @enderror" required placeholder="Full Name" data-validation-required-message="Full name is required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Department</label>
                                                            <select name="department"  class="form-control @error('department') is-invalid @enderror" required data-validation-required-message="Select Department">
                                                                <option value=''>Select Department</option>
                                                                <option value="Department - 1" @if(@$data->department) selected @endif>Department - 1</option>
                                                                <option value="Department - 2" @if(@$data->department) selected @endif>Department - 2</option>
                                                            </select>
                                                           
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Designation</label>
                                                            <input type="text" name="designation" value="{{$data->designation ?? ''}}" class="form-control @error('designation') is-invalid @enderror" required placeholder="Designation" data-validation-required-message=" Designation is required" >
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Total Experience</label>
                                                            <input type="text" name="total_experience" value="{{$data->total_experience ?? ''}}" class="form-control @error('total_experience') is-invalid @enderror" required placeholder="Total Experience" data-validation-required-message="Total Experience is required" >
                                                           
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Location</label>
                                                            <input type="text" name="location" value="{{$data->location ?? ''}}" class="form-control @error('location') is-invalid @enderror" required placeholder="Location" data-validation-required-message="The Location field is required" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Mobile No</label>
                                                            <input type="text" name="mobile_no" value="{{$data->mobile ?? ''}}" class="form-control @error('mobile_no') is-invalid @enderror" required placeholder="Mobile No" data-validation-required-message="Mobile No is required" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Email ID</label>
                                                            <input type="text" name="email_id" value="{{$data->email ?? ''}}" class="form-control @error('email_id') is-invalid @enderror" required data-validation-match-match="password" placeholder="Email ID" data-validation-required-message="Email ID is required" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Website URL</label>
                                                            <input type="text" name="website_url" value="{{$data->website_url ?? ''}}" class="form-control @error('website_url') is-invalid @enderror" placeholder="Website URL" data-validation-required-message="Website URL is required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Social Media Link</label>
                                                            <input type="text" name="social_media_link" value="{{$data->social_media_link ?? ''}}" class="form-control @error('social_media_link') is-invalid @enderror" placeholder="Social Media Link" data-validation-required-message="Social Media Link is required" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Achievement & Award</label>
                                                            <input type="file" name="award[]" multiple="" accept="image/*" class="form-control @error('award') is-invalid @enderror" required  placeholder="Achievement & Award" data-validation-required-message="Achievement & Award is required">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Description</label>
                                                            <textarea name="description"  class="form-control @error('description') is-invalid @enderror" required placeholder="Description" data-validation-required-message="Description is required">{{$data->description ?? ''}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Star and Ratings</label>
                                                            <input type="text" name="star_ratings" value="{{$data->star_ratings ?? ''}}" class="form-control @error('star_ratings') is-invalid @enderror" placeholder="Star Rating" data-validation-required-message="The Star and Ratings field is required" >
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Upload Profile Picture</label>
                                                            <input type="file" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror"   placeholder="Profile Picture" data-validation-required-message=" Profile Picture is required" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>

                                        @elseif(Request::segment(3)=='hospital')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/hospital')}}">List Hospital</a>
                                        </div>
                                         
                                        <form novalidate id="add_doctor" method="post" action="{{url('/cms-admin/postalltype-user/hospital')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="data_id" value="{{$data->id ?? ''}}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Hospital Name</label>
                                                            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" required placeholder="Hospital Name" data-validation-required-message="Hospital name is required" value="{{$data->full_name ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Location</label>
                                                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" required placeholder="Location" data-validation-required-message="Location is required" value="{{$data->location ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Established Year</label>
                                                            <input type="number" name="etablished_year" class="form-control @error('etablished_year') is-invalid @enderror" placeholder="Established Year" required data-validation-required-message="Established Year is required" maxlength="4" minlength="4" value="{{$data->etablished_year ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Type of Hospital</label>
                                                            <select name="type_hospital" class="form-control @error('type_hospital') is-invalid @enderror" required data-validation-required-message="Type of Hospital is required">
                                                                <option value="">Select hospital type</option>
                                                                <option value="Type 1">Type 1</option>
                                                                <option value="Type 2">Type 2</option>
                                                                <option value="Type 3">Type 3</option>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Specialized</label>
                                                            <select name="specialized" class="form-control @error('specialized') is-invalid @enderror" required placeholder="Specialized" data-validation-required-message="Specialized is required">
                                                                <option value=''>Select Specialization </option>
                                                                <option value='Specialization 1'>Specialization 1 </option>
                                                                <option value='Specialization 2'>Specialization 2 </option>
                                                                <option value='Specialization 3'>Specialization 3 </option>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Multi Specialist</label>
                                                            <select name="multi_specialist" class="form-control @error('multi_specialist') is-invalid @enderror" required placeholder="Multi Specialist" data-validation-required-message="Multi specialist is required">
                                                                <option value="0">No</option>
                                                                <option value="1">Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Contact Information: (Mobile No)</label>
                                                            <input type="number" name="mobile" class="form-control @error('mobile') is-invalid @enderror" required placeholder="Mobile No" data-validation-required-message="Mobile no is required" maxlength="10" minlength="10" value="{{$data->mobile ?? ''}}">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Tele Phone No</label>
                                                            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"  placeholder="Tele Phone No"data-validation-required-message="Tele Phone No is required" value="{{$data->telephone ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>                                                
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Achievement & Award</label>
                                                            <input type="file" name="award[]" multiple="" accept="image/*" class="form-control @error('award') is-invalid @enderror" required  placeholder="Achievement & Award" data-validation-required-message="Achievement & Award is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Website URL</label>
                                                            <input type="text" name="website_url" class="form-control @error('website_url') is-invalid @enderror" placeholder="Website URL" data-validation-required-message="Website URL is required" value="{{$data->website_url ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Social Media Link</label>
                                                            <input type="text" name="social_media_link" class="form-control @error('social_media_link') is-invalid @enderror" placeholder="Social Media Link" data-validation-required-message="Social Media Link is required" value="{{$data->social_media_link ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Star and Ratings</label>
                                                            <input type="text" name="star_ratings" class="form-control @error('star_ratings') is-invalid @enderror" required placeholder="Star and Ratings" data-validation-required-message="Star Ratings is required" value="{{$data->star_ratings ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Description</label>
                                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required placeholder="Description" data-validation-required-message="Description is required">{{$data->description ?? ''}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Upload Hospital Images</label>
                                                            <input type="file" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror" required placeholder="Upload Hospital Images" data-validation-required-message="Upload Hospital Images is required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>

                                        @elseif(Request::segment(3)=='nurses')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/nurses')}}">List Nurses</a>
                                        </div>
                                         
                                        <form novalidate id="add_doctor" method="post" action="{{url('/cms-admin/postalltype-user/nurses')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="data_id" value="{{$data->id ?? ''}}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Full Name</label>
                                                            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" required placeholder="Full Name" data-validation-required-message="The Full Name field is required" value="{{$data->full_name ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Designation</label>
                                                            <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" required placeholder="Designation" data-validation-required-message=" Designation is required" value="{{$data->designation ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Total Experience</label>
                                                            <input type="number" name="total_experience" class="form-control @error('total_experience') is-invalid @enderror" required placeholder="Total Experience" data-validation-required-message=" Total Experience is required" value="{{$data->total_experience ?? ''}}">
                                                           
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Location</label>
                                                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" required placeholder="Location" data-validation-required-message=" Location is required" value="{{$data->location ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Mobile No</label>
                                                            <input type="number" name="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" required placeholder="Mobile No" data-validation-required-message="Mobile No is required" minlength="10" maxlength="10" value="{{$data->mobile ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Email ID</label>
                                                            <input type="text" name="email_id" class="form-control @error('email_id') is-invalid @enderror" required placeholder="Email ID" data-validation-required-message="Email ID is required" value="{{$data->email_id ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Website URL</label>
                                                            <input type="text" name="website_url" class="form-control @error('website_url') is-invalid @enderror"  placeholder="Website URL" data-validation-required-message="Website URL is required" value="{{$data->website_url ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Social Media Link</label>
                                                            <input type="text" name="social_media_link" class="form-control @error('social_media_link') is-invalid @enderror" placeholder="Social Media Link" data-validation-required-message="Social Media Link is required" value="{{$data->social_media_link ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Achievement & Award</label>
                                                            <input type="file" name="award[]" multiple="" accept="image/*" class="form-control @error('award') is-invalid @enderror" required  placeholder="Achievement & Award" data-validation-required-message="Achievement & Award is required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Star and Ratings</label>
                                                            <input type="text" name="star_ratings" class="form-control @error('star_ratings') is-invalid @enderror" required  placeholder="Star and Ratings" data-validation-required-message="The Star and Ratings is required" value="{{$data->star_ratings ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Description</label>
                                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required placeholder="Description" data-validation-required-message="The Description field is required">{{$data->description ?? ''}}</textarea>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Upload Profile Picture</label>
                                                            <input type="file" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror" required  placeholder="Profile Picture" data-validation-required-message="The Profile Picture field is required" >
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>

                                        @elseif(Request::segment(3)=='clinics')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/clinics')}}">List Nurses</a>
                                        </div>
                                         
                                        <form novalidate id="add_doctor" method="post" action="{{url('/cms-admin/postalltype-user/clinics')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="data_id" value="{{$data->id ?? ''}}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Clinic Name</label>
                                                            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" required placeholder="Clinic Name" data-validation-required-message="Clinic name is required" value="{{$data->full_name ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Location</label>
                                                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" required placeholder="Location" data-validation-required-message="Location is required" value="{{$data->location ?? ''}}">
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Established Year</label>
                                                            <input type="text" name="etablished_year" class="form-control @error('etablished_year') is-invalid @enderror" placeholder="Established Year" required data-validation-required-message="Established Year is required" maxlength="4" minlength="4" value="{{$data->etablished_year ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                @php 
                                                    $available_test =[];
                                                    if(@$data->available_test){
                                                        $available_test = json_decode($data->available_test,1);
                                                    }

                                                @endphp
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Available Test</label>
                                                            <select multiple name="available_test[]" class="form-control @error('available_test') is-invalid @enderror" placeholder="Available Test" data-allow-clear="1" data-validation-required-message="Available Test is required">
                                                            <option @if(in_array('test1',$available_test)) selected @endif>test1</option>
                                                            <option @if(in_array('test2',$available_test)) selected @endif >test2</option>
                                                            <option @if(in_array('test3',$available_test)) selected @endif >test3</option>
                                                            <option @if(in_array('test4',$available_test)) selected @endif >test4</option>
                                                            <option @if(in_array('test5',$available_test)) selected @endif >test5</option>
                                                          </select>
                                                                                                                       
                                                        </div>
                                                    </div>
                                                </div> 


                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Specialized in</label>
                                                            <input type="text" name="specialized" class="form-control @error('specialized') is-invalid @enderror" required placeholder="Specialized in" data-validation-required-message="Specialized in is required" value="{{$data->specialized ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Contact Information: (Mobile No)</label>
                                                            <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" required placeholder="Mobile No" data-validation-required-message="Mobile no is required" maxlength="10" minlength="10" value="{{$data->mobile ?? ''}}">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Tele Phone No</label>
                                                            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"  placeholder="Tele Phone No" data-validation-required-message="Tele Phone No is required" value="{{$data->telephone ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>                                                
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Achievement & Award</label>
                                                            <input type="file" name="award[]" multiple="" accept="image/*" class="form-control @error('award') is-invalid @enderror" required  placeholder="Achievement & Award" data-validation-required-message="Achievement & Award is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Website URL</label>
                                                            <input type="text" name="website_url" class="form-control @error('website_url') is-invalid @enderror" placeholder="Website URL" data-validation-required-message="Website URL is required" value="{{$data->website_url ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Social Media Link</label>
                                                            <input type="text" name="social_media_link" class="form-control @error('social_media_link') is-invalid @enderror" placeholder="Social Media Link" data-validation-required-message="Social Media Link is required" value="{{$data->social_media_link ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Star and Ratings</label>
                                                            <input type="text" name="star_ratings" class="form-control @error('star_ratings') is-invalid @enderror" required placeholder="Star and Ratings" data-validation-required-message="Star Ratings is required" value="{{$data->star_ratings ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Description</label>
                                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required placeholder="Description" data-validation-required-message="Description is required">{{$data->description ?? ''}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Upload Clinic Images</label>
                                                            <input type="file" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror" required placeholder="Upload Hospital Images" data-validation-required-message="Upload Clinic Images is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>

                                        @elseif(Request::segment(3)=='pharmas')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/pharmas')}}">List Nurses</a>
                                        </div>
                                         
                                        <form novalidate id="add_doctor" method="post" action="{{url('/cms-admin/postalltype-user/pharmas')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="data_id" value="{{$data->id ?? ''}}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Name of Institution</label>
                                                            <input type="text" name="full_name" value="{{@$data->full_name}}" class="form-control @error('full_name') is-invalid @enderror" required placeholder="Name of Institution" data-validation-required-message="Name of Institution is required" value="{{$data->full_name ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Location</label>
                                                            <input type="text" name="location" value="{{@$data->location}}" class="form-control @error('location') is-invalid @enderror" required placeholder="Location" data-validation-required-message="Location is required" value="{{$data->location ?? ''}}">
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Established Year</label>
                                                            <input type="text" name="etablished_year" value="{{@$data->etablished_year}}" class="form-control @error('etablished_year') is-invalid @enderror" placeholder="Established Year" required data-validation-required-message="Established Year is required" maxlength="4" minlength="4">
                                                        </div>
                                                    </div>
                                                </div>
                                                @php 
                                                    $course_offered =[];
                                                    if(@$data->course_offered){
                                                        $course_offered = json_decode($data->course_offered,1);
                                                    }

                                                @endphp
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Course Offered</label>
                                                            <select multiple name="course_offered[]" class="form-control @error('course_offered') is-invalid @enderror" placeholder="Course Offered" data-allow-clear="1" data-validation-required-message="Course Offered is required">
                                                            <option @if(in_array('Offer1',$course_offered)) selected @endif>Offer1</option>
                                                            <option @if(in_array('Offer2',$course_offered)) selected @endif >Offer2</option>
                                                            <option @if(in_array('Offer3',$course_offered)) selected @endif >Offer3</option>
                                                            <option @if(in_array('Offer4',$course_offered)) selected @endif >Offer4</option>
                                                            <option @if(in_array('Offer5',$course_offered)) selected @endif >Offer5</option>
                                                          </select>                       
                                                        </div>
                                                    </div>
                                                </div>    
                                                
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Contact Information: (Mobile No)</label>
                                                            <input type="text" name="mobile" value="{{@$data->mobile}}" class="form-control @error('mobile') is-invalid @enderror" required placeholder="Mobile No" data-validation-required-message="Mobile no is required" maxlength="10" minlength="10" value="{{$data->mobile ?? ''}}">
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Tele Phone No:</label>
                                                            <input type="text" name="telephone" value="{{@$data->telephone}}" class="form-control @error('telephone') is-invalid @enderror"  placeholder="Tele Phone No" data-validation-required-message="Tele Phone No is required" value="{{$data->telephone ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>                                                
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Achievement & Award</label>
                                                            <input type="file" name="award[]" multiple="" accept="image/*" class="form-control @error('award') is-invalid @enderror" required  placeholder="Achievement & Award" data-validation-required-message="Achievement & Award is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Website URL</label>
                                                            <input type="text" name="website_url" value="{{@$data->website_url}}" class="form-control @error('website_url') is-invalid @enderror" placeholder="Website URL" data-validation-required-message="Website URL is required" value="{{$data->website_url ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Social Media Link</label>
                                                            <input type="text" name="social_media_link" value="{{@$data->social_media_link}}" class="form-control @error('social_media_link') is-invalid @enderror" placeholder="Social Media Link" data-validation-required-message="Social Media Link is required" value="{{$data->social_media_link ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Star and Ratings</label>
                                                            <input type="text" name="star_ratings" value="{{@$data->star_ratings}}" class="form-control @error('star_ratings') is-invalid @enderror" required placeholder="Star and Ratings" data-validation-required-message="Star Ratings is required" value="{{$data->star_ratings ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Description</label>
                                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required placeholder="Description" data-validation-required-message="Description is required">{{@$data->description}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Upload Institution Images</label>
                                                            <input type="file" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror" required placeholder="Upload Institution Images" data-validation-required-message="Upload Institution Images is required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>

                                        @elseif(Request::segment(3)=='exams')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/exams')}}">List Nurses</a>
                                        </div>
                                         
                                        <form novalidate id="add_doctor" method="post" action="{{url('/cms-admin/postalltype-user/exams')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="data_id" value="{{$data->id ?? ''}}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Name of Exam</label>
                                                            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" required placeholder="Name of Exam" data-validation-required-message="Name of Exam is required" value="{{$data->full_name ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Last date of Apply</label>
                                                            <input type="date" name="last_date_of_apply" class="form-control @error('last_date_of_apply') is-invalid @enderror" placeholder="Last date of Apply" required data-validation-required-message="Last date of Apply is required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Total Vacancy</label>
                                                            <input type="number" name="total_vacancy" class="form-control @error('total_vacancy') is-invalid @enderror" required placeholder="Total Vacancy" data-validation-required-message="Total Vacancy is required" value="{{$data->total_vacancy ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Exam Date</label>
                                                            <input type="date" name="exam_date" class="form-control @error('exam_date') is-invalid @enderror" required placeholder="Exam Date" data-validation-required-message="Exam Date is required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Description</label>
                                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required placeholder="Description" data-validation-required-message="Description is required"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>References site link URL</label>
                                                            <input type="text" name="references_site" class="form-control @error('references_site') is-invalid @enderror" required placeholder="References site link URL" data-validation-required-message="References site link URL is required" value="{{$data->references_site ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>

                                        @elseif(Request::segment(3)=='diseases')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/diseases')}}">List Nurses</a>
                                        </div>
                                         
                                        <form novalidate id="add_doctor" method="post" action="{{url('/cms-admin/postalltype-user/diseases')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="data_id" value="{{$data->id ?? ''}}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Name of Disease</label>
                                                            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" required placeholder="Name of Disease" data-validation-required-message="Name of Disease is required" value="{{$data->full_name ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Refer by Hospital/Doctor</label>
                                                            <input type="text" name="references_hos_doc" class="form-control @error('references_hos_doc') is-invalid @enderror" placeholder="Refer by Hospital/Doctor" required data-validation-required-message="Refer by Hospital/Doctor is required" value="{{$data->references_hos_doc ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Doctor profile link</label>
                                                            <input type="text" name="doc_profile" class="form-control @error('doc_profile') is-invalid @enderror"  placeholder="Doctor profile link" data-validation-required-message="Doctor profile link is required" value="{{$data->doc_profile ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                               @if(@$data->diseasedetails)
                                                <div class="form-group">
                                                    <ul class="list-group">
                                                    @forelse($data->diseasedetails as $post)
                                                    
                                                      <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div class="col">{{$post->disease_desc}}</div>
                                                        <div class="col">@if($post->disease_img)
                                                        <img src="{{url($post->disease_img)}}" height="100px" width="100px">
                                                        @endif</div>
                                                        <a href="{{ url('/cms-admin/alltype-user/diseaseslist/'.$post->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><span class="badge badge-primary badge-pill">X</span></a>
                                                      </li>
  

                                                    
                                                    @empty
                                                    @endforelse
                                                    </ul>
                                                </div>
                                               @endif
                                                
                                                <div class="col-12">
                                                    <div id="row" class="row  m-3" >
                                                        
                                                        <div class="col-6">
                                                            <textarea class="form-control" name="disease_desc[]" ></textarea>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="file" name="disease_img[]">
                                                        </div>
                                                        <div class="col-2">
                                                            <button id="rowAdder" type="button"
                                                        class="btn btn-dark">
                                                                <span class="bi bi-plus-square-dotted">
                                                                </span> ADD
                                                            </button>
                                                        </div>
                                                    </div>
 
                                                    <div id="newinput"></div>
                                                    
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>                                          
                                        @endif
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
