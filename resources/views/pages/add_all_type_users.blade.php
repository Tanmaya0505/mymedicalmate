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
<!-- <link href="{{asset('dist/css/select2.css')}}" rel="stylesheet" /> -->
<link rel="stylesheet" type="text/css" href="{{asset('csm-admin/all_type_doctor/css/style.css')}}">



<style>
    .btn i {
        top: 0px;
    }

    .x {
        /*position: absolute;*/
        background: red;
        color: white;
        top: -10px;
        right: -10px;
    }

    #university_date {
    border: 1px solid #e9e9e9;
    border-radius: 5px;
    height: 47px;
    width: 37%;
    color: #000000;
    font-size: 14px;
    padding-left: 8px;
    box-shadow: none;
    padding-top: 0px;
    margin-top: -47px;
    margin-left: 111px;
    z-index: 2;
    position: absolute;
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
                            @if(Request::segment(3)=='doctor') active @endif " id="account-pill-general" href="{{url('/cms-admin/alltype-user/doctor')}}" aria-expanded="true">
                                <i class="bx bx-cog"></i>
                                <span>Doctors</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='hospital') active @endif " id="account-pill-password" href="{{url('/cms-admin/alltype-user/hospital')}}" aria-expanded="false">
                                <i class="bx bx-lock"></i>
                                <span>Hospitals</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='nurses') active @endif " id="account-pill-social" href="{{url('/cms-admin/alltype-user/nurses')}}" aria-expanded="false">
                                <i class="bx bxl-twitch"></i>
                                <span>Nurses</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='clinics') active @endif" id="account-pill-notifications" href="{{url('/cms-admin/alltype-user/clinics')}}" aria-expanded="false">
                                <i class="bx bx-bell"></i>
                                <span>Clinics</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='pharmas') active @endif " id="account-pill-user-config" href="{{url('/cms-admin/alltype-user/pharmas')}}" aria-expanded="false">
                                <i class="bx bx-user"></i>
                                <span>Pharmaceutical Institutions</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='exams') active @endif " id="account-pill-assistant-config" href="{{url('/cms-admin/alltype-user/exams')}}" aria-expanded="false">
                                <i class="bx bx-briefcase-alt"></i>
                                <span>Examinations</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='diseases') active @endif " id="account-pill-doctor-config" href="{{url('/cms-admin/alltype-user/diseases')}}" aria-expanded="false">
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
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                        @if(Request::segment(3)=='doctor')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/doctor')}}">List Doctors</a>
                                        </div>

                                        <!-- <form novalidate id="add_doctor" method="post" action="{{url('/cms-admin/postalltype-user/doctor')}}" enctype="multipart/form-data">
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

                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end"> onsubmit="event.preventDefault();"
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save changes</button>onsubmit="return false"
                                                </div> /cms-admin/alltype-user/alltypeuserlog/doctor
                                            </div>
                                        </form> -->

                                        <div class="row">
                                            <div class="col-xl">
                                                <div class="card mb-4">
                                                    <div class="card-header d-flex justify-content-between align-items-center doc-back">
                                                        <p class="mb-0">Fill the Doctor Information</p>
                                                    </div>
                                                    <div class="card-body" style="padding-top: 30px;">
                                                        <form id="add_doctor" method="post" action="{{url('/cms-admin/postalltype-user/doctor')}}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                            <input type="hidden" name="data_id" value="{{$data->id ?? ''}}">
                                                            <div class="row mt-20">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <div class="input_wrap">
                                                                            @if(Auth::user()->id==1 && !empty($datalog->full_name) && $datalog->full_name !=$data->full_name)
                                                                            <input type="text" name="full_name" onkeydown="return /[a-z, ]/i.test(event.key)" id="full_name" value="{{old('full_name',$datalog->full_name ?? '')}}"   style="padding-left: 40px;color:red;padding-bottom: 10px;">
                                                                            @else
                                                                            <input type="text" name="full_name" onkeydown="return /[a-z, ]/i.test(event.key)"  id="full_name" value="{{old('full_name',$data->full_name ?? '')}}"   style="padding-left: 40px;padding-bottom: 10px;">
                                                                            @endif 
                                                                            <label class="floating-label">Full Name ?</label>
                                                                            <img src="{{asset('csm-admin/all_type_doctor/img/reg6.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                        </div>
                                                                        @if ($errors->has('full_name')) <span class="error" style="color:red">{{ $errors->first('full_name') }}</span> @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <div class="select_wrap select">
                                                                        @if(Auth::user()->id==1 && !empty($datalog->gender) && $datalog->gender !=$data->gender)
                                                                        <select name="gender" id="gender"   style="padding-left: 40px;color:red; padding-bottom: 10px;">
                                                                                <option value="" disabled="" selected=""></option>
                                                                                <option value="Male" {{ old('gender',@$datalog->gender) == "Male" ? 'selected' : '' }}>Male</option>
                                                                                <option value="Female" {{ old('gender',@$datalog->gender) == "Female" ? 'selected' : '' }}>Female</option>
                                                                                <option value="Other" {{ old('gender',@$datalog->gender) == "Other" ? 'selected' : '' }}>Other</option>
                                                                            </select>
                                                                        @else
                                                                        <select name="gender" id="gender"   style="padding-left: 40px;padding-bottom: 10px;">
                                                                                <option value="" disabled="" selected=""></option>
                                                                                <option value="Male" {{ old('gender',@$data->gender) == "Male" ? 'selected' : '' }}>Male</option>
                                                                                <option value="Female" {{ old('gender',@$data->gender) == "Female" ? 'selected' : '' }}>Female</option>
                                                                                <option value="Other" {{ old('gender',@$data->gender) == "Other" ? 'selected' : '' }}>Other</option>
                                                                            </select>
                                                                        @endif
                                                                            
                                                                            <label class="floating-label">Gender ?</label>
                                                                            <img src="{{asset('csm-admin/all_type_doctor/img/reg3.png')}}" alt="" class="booking-agent1-img">
                                                                            @if ($errors->has('gender')) <span class="error" style="color:red">{{ $errors->first('gender') }}</span> @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <div class="input_wrap">
                                                                            @if(Auth::user()->id==1 && !empty($datalog->mobile) && $datalog->mobile !=$data->mobile)
                                                                            <input type="text" name="mobile_no" id="dmobile_no" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  maxlength="10" value="{{old('mobile_no',$datalog->mobile ?? '')}}"  style="padding-left: 40px;color:red;padding-bottom: 10px;">
                                                                            @else
                                                                            <input type="text" name="mobile_no" id="dmobile_no" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  maxlength="10" value="{{old('mobile_no',$data->mobile ?? '')}}"  style="padding-left: 40px;padding-bottom: 10px;">
                                                                            @endif
                                                                            <label class="floating-label">Mobile Number ?</label>
                                                                            <img src="{{asset('csm-admin/all_type_doctor/img/reg18.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                            @if ($errors->has('mobile_no')) <span class="error" style="color:red">{{ $errors->first('mobile_no') }}</span> @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <div class="input_wrap">
                                                                            @if(Auth::user()->id==1 && !empty($datalog->email) && $datalog->email !=$data->email)
                                                                            <input type="email" name="email_id" id="doctor_email"  value="{{old('email_id',$datalog->email ?? '')}}"  style="padding-left:40px;color:red;padding-bottom: 10px;">
                                                                            @else
                                                                            <input type="email" name="email_id" id="doctor_email"  value="{{old('email_id',$data->email ?? '')}}"  style="padding-left: 40px;padding-bottom: 10px;">
                                                                            @endif
                                                                            <label class="floating-label">Email ID ?</label>
                                                                            <img src="{{asset('csm-admin/all_type_doctor/img/reg7.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                            @if ($errors->has('email_id')) <span class="error" style="color:red">{{ $errors->first('email_id') }}</span> @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row" style="margin-left: 0px">
                                                                    <div class="form-group" id="location">
                                                                        <div class="input_wrap">
                                                                            @if(Auth::user()->id==1 && !empty($datalog->doctorqualification) && $datalog->doctorqualification !=$data->doctorqualification)
                                                                            <input type="text" name="doctorqualification"  id="doctorqualification" oninput="this.value=this.value.replace(/[^a-z, ]/gi, '');" value="{{old('doctorqualification',$datalog->doctorqualification ?? '')}}"  style="padding-left: 40px;color:red; padding-bottom: 10px;">
                                                                            @else
                                                                            <input type="text" name="doctorqualification"  id="doctorqualification" oninput="this.value=this.value.replace(/[^a-z, ]/gi, '');" value="{{old('doctorqualification',$data->doctorqualification ?? '')}}"  style="padding-left: 40px; padding-bottom: 10px;">
                                                                            @endif  
                                                                            <i class="fa fa-plus fa9-plus add-qualification" id="add_qualifications"></i>
                                                                            <label class="floating-label">Doctor Qualification ?</label>
                                                                            <img src="{{asset('csm-admin/all_type_doctor/img/reg27.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                            @if ($errors->has('doctorqualification')) <span class="error" style="color:red">{{ $errors->first('doctorqualification') }}</span> @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" id="locations" style="margin-left: 10px;">
                                                                        <div class="select_wrap select">
                                                                            @if(Auth::user()->id==1 && !empty($datalog->univercity) && $datalog->univercity !=$data->univercity)
                                                                            <input type="text" oninput="this.value=this.value.replace(/[^a-z, ]/gi, '');" name="univercity" id="univercity" maxlength="50" value="{{old('univercity',$datalog->univercity ?? '')}}"  style="padding-left: 40px;color:red;padding-bottom: 10px;">
                                                                            @else
                                                                            <input type="text" oninput="this.value=this.value.replace(/[^a-z, ]/gi, '');" name="univercity" id="univercity" maxlength="50" value="{{old('univercity',$data->univercity ?? '')}}"  style="padding-left: 40px;padding-bottom: 10px;">
                                                                            @endif
                                                                            <label class="floating-label">university ?</label>
                                                                            <img src="{{asset('csm-admin/all_type_doctor/img/reg15.png')}}" alt="" class="booking-agent1-img">
                                                                            @if(Auth::user()->id==1 && !empty($datalog->university_date) && $datalog->university_date !=$data->university_date)
                                                                            <input type="text" id="university_date" name="university_date" oninput="this.value=this.value.replace(/[^0-9]/, '');" maxlength="4"  @if($data->university_date ?? '') value="{{old('university_date',$datalog->university_date ?? '')}}" @else value="{{old('university_date')}}" @endif style="color:red;">
                                                                            @else
                                                                            <input type="text" id="university_date" name="university_date" oninput="this.value=this.value.replace(/[^0-9]/, '');" maxlength="4"  @if($data->university_date ?? '') value="{{old('university_date',$data->university_date ?? '')}}" @else value="{{old('university_date')}}" @endif  />
                                                                            @endif
                                                                            @if ($errors->has('univercity')) <span class="error" style="color:red">{{ $errors->first('univercity') }}</span> @endif
                                                                            @if ($errors->has('university_date')) <span class="error" style="color:red">{{ $errors->first('university_date') }}</span> @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    
                                                                </div>

                                                                <div id="workingContainer">
                                                                    <div id="newWorking" class=" col-md-12 back-gray">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <div class="select_wrap">
                                                                                        @if(Auth::user()->id==1 && !empty($datalog->slefemp_emplaye) && $datalog->slefemp_emplaye !=$data->slefemp_emplaye)
                                                                                            <select name="slefemp_emplaye" id="slefemp_emplaye" style="padding-left: 40px; color:red;padding-bottom: 10px;">
                                                                                                <option value="" disabled="" selected=""></option>
                                                                                                <option value="Self-Employed" {{ old('slefemp_emplaye',@$datalog->slefemp_emplaye) == "Self-Employed" ? 'selected' : '' }}>Self-Employed</option>
                                                                                                <option value="Employed" {{ old('slefemp_emplaye',@$datalog->slefemp_emplaye) == "Employed" ? 'selected' : '' }}>Employed</option>
                                                                                            </select>
                                                                                        @else
                                                                                            <select name="slefemp_emplaye" id="slefemp_emplaye" style="padding-left: 40px;padding-bottom: 10px;">
                                                                                                <option value="" disabled="" selected=""></option>
                                                                                                <option value="Self-Employed" {{ old('slefemp_emplaye',@$data->slefemp_emplaye) == "Self-Employed" ? 'selected' : '' }}>Self-Employed</option>
                                                                                                <option value="Employed" {{ old('slefemp_emplaye',@$data->slefemp_emplaye) == "Employed" ? 'selected' : '' }}>Employed</option>
                                                                                            </select>
                                                                                        @endif
                                                                                        <label class="floating-label">Select Employed/Self-Employed?</label>
                                                                                        <img src="{{asset('csm-admin/all_type_doctor/img/reg8.png')}}" alt="" class="booking-agent1-img">
                                                                                        @if ($errors->has('slefemp_emplaye')) <span class="error" style="color:red">{{ $errors->first('slefemp_emplaye') }}</span> @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 remove-on-add">
                                                                                <div class="form-group">
                                                                                    <div class="input_wrap">
                                                                                        @if(Auth::user()->id==1 && !empty($datalog->designation) && $datalog->designation !=$data->designation)
                                                                                        <input type="text" name="designation" id="designation" oninput="this.value=this.value.replace(/[^a-z, ]/gi, '');" value="{{old('designation',$datalog->designation ?? '')}}"  style="padding-left: 40px;color:red;padding-bottom: 10px;">
                                                                                        @else
                                                                                        <input type="text" name="designation" id="designation" oninput="this.value=this.value.replace(/[^a-z, ]/gi, '');" value="{{old('designation',$data->designation ?? '')}}"  style="padding-left: 40px;padding-bottom: 10px;">
                                                                                        @endif
                                                                                        <label class="floating-label">Designation ?</label>
                                                                                        <img src="{{asset('csm-admin/all_type_doctor/img/h-desig.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                        @if ($errors->has('designation')) <span class="error" style="color:red">{{ $errors->first('designation') }}</span> @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 remove-on-add">
                                                                                <div class="form-group">
                                                                                    <div class="input_wrap">
                                                                                        @if(Auth::user()->id==1 && !empty($datalog->department) && $datalog->department !=$data->department)
                                                                                        <input type="text" name="department" id="department" oninput="this.value=this.value.replace(/[^a-z, ]/gi,'');" value="{{old('department',$datalog->department ?? '')}}"  style="padding-left: 40px;color:red;padding-bottom: 10px;">
                                                                                        @else
                                                                                        <input type="text" name="department" id="department" oninput="this.value=this.value.replace(/[^a-z, ]/gi,'');" value="{{old('department',$data->department ?? '')}}"  style="padding-left: 40px;padding-bottom: 10px;">
                                                                                        @endif
                                                                                        <label class="floating-label">Department ?</label>
                                                                                        <img src="{{asset('csm-admin/all_type_doctor/img/reg15.png')}}" alt="" class="booking-agent1-img">
                                                                                        @if ($errors->has('department')) <span class="error" style="color:red">{{ $errors->first('department') }}</span> @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 remove-on-add">
                                                                                <div class="form-group">
                                                                                    <div class="input_wrap">
                                                                                        @if(Auth::user()->id==1 && !empty($datalog->total_experience) && $datalog->total_experience !=$data->total_experience)
                                                                                        <input type="text" name="totalexprience" id="totalexprience" onKeyUp="if(this.value>60){this.value='60';}else if(this.value<0){this.value='0';}" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/, '');" value="{{old('totalexprience',$datalog->total_experience ?? '')}}"  style="padding-left: 40px;color:red;padding-bottom: 10px;">
                                                                                        @else
                                                                                        <input type="text" name="totalexprience" id="totalexprience" onKeyUp="if(this.value>60){this.value='60';}else if(this.value<0){this.value='0';}" maxlength="2"  oninput="this.value=this.value.replace(/[^0-9]/, '');" value="{{old('totalexprience',$data->total_experience ?? '')}}"  style="padding-left: 40px;padding-bottom: 10px;">
                                                                                        @endif
                                                                                        <label class="floating-label">Total Experience ?</label>
                                                                                        <img src="{{asset('csm-admin/all_type_doctor/img/reg23.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                        @if ($errors->has('totalexprience')) <span class="error" style="color:red">{{ $errors->first('totalexprience') }}</span> @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <div class="input_wrap">
                                                                                        @if(Auth::user()->id==1 && !empty($datalog->orgnization_name) && $datalog->orgnization_name !=$data->orgnization_name)
                                                                                        <input type="text" name="orgnization_name" id="orgnization_name" oninput="this.value=this.value.replace(/[^a-z, ]/gi,'');" value="{{old('orgnization_name',$datalog->orgnization_name ?? '')}}" style="padding-left:40px;color:red;padding-bottom: 10px;">
                                                                                        @else
                                                                                        <input type="text" name="orgnization_name" id="orgnization_name" oninput="this.value=this.value.replace(/[^a-z, ]/gi,'');" value="{{old('orgnization_name',$data->orgnization_name ?? '')}}" style="padding-left:40px;padding-bottom: 10px;">
                                                                                        @endif
                                                                                        <label class="floating-label">Organization Name ?</label>
                                                                                        <img src="{{asset('csm-admin/all_type_doctor/img/reg11.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                        @if ($errors->has('orgnization_name')) <span class="error" style="color:red">{{ $errors->first('orgnization_name') }}</span> @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <div class="input_wrap">
                                                                                        @if(Auth::user()->id==1 && !empty($datalog->location) && $datalog->location !=$data->location)
                                                                                        <input type="text" name="orgnization_location" id="orgnization_location" oninput="this.value=this.value.replace(/[^a-z, ]/gi,'');"  value="{{old('orgnization_location',$datalog->location ?? '')}}"  style="padding-left:40px;color:red;padding-bottom: 10px;">
                                                                                        @else
                                                                                        <input type="text" name="orgnization_location" id="orgnization_location" oninput="this.value=this.value.replace(/[^a-z, ]/gi,'');"  value="{{old('orgnization_location',$data->location ?? '')}}"  style="padding-left:40px;padding-bottom:10px;">
                                                                                        @endif
                                                                                        <label class="floating-label">Organization Location ?</label>
                                                                                        <img src="{{asset('csm-admin/all_type_doctor/img/reg14.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                        @if ($errors->has('orgnization_location')) <span class="error" style="color:red">{{ $errors->first('orgnization_location') }}</span> @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">

                                                                                    <div class="input_wrap">
                                                                                        @if(Auth::user()->id==1 && !empty($datalog->state_city) && $datalog->state_city !=$data->state_city)
                                                                                        <input type="text" name="state_city" id="state_city" oninput="this.value=this.value.replace(/[^a-z, ]/gi,'');" value="{{old('state_city',$datalog->state_city ?? '')}}"  style="padding-left:40px;color:red;padding-bottom: 10px;">
                                                                                        @else
                                                                                        <input type="text" name="state_city" id="state_city" oninput="this.value=this.value.replace(/[^a-z, ]/gi,'');" value="{{old('state_city',$data->state_city ?? '')}}"  style="padding-left:40px;padding-bottom: 10px;">
                                                                                        @endif
                                                                                        <label class="floating-label">In Which State/City ?</label>
                                                                                        <img src="{{asset('csm-admin/all_type_doctor/img/reg14.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                        @if ($errors->has('state_city')) <span class="error" style="color:red">{{ $errors->first('state_city') }}</span> @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <div class="input_wrap">
                                                                                        @if(Auth::user()->id==1 && !empty($datalog->landmark_pincode) && $datalog->landmark_pincode !=$data->landmark_pincode)
                                                                                        <input type="text" name="landmark_pincode" oninput="this.value=this.value.replace(/[^a-z0-9, ]/gi,'');"  id="landmark_pincode"  value="{{old('landmark_pincode',$datalog->landmark_pincode ?? '')}}"  style="padding-left:40px;color:red;padding-bottom: 10px;">
                                                                                        @else
                                                                                        <input type="text" name="landmark_pincode" oninput="this.value=this.value.replace(/[^a-z0-9, ]/gi,'');"  id="landmark_pincode"  value="{{old('landmark_pincode',$data->landmark_pincode ?? '')}}"  style="padding-left:40px;padding-bottom: 10px;">
                                                                                        @endif
                                                                                        <label class="floating-label">Landmark with pincode ?</label>
                                                                                        <img src="{{asset('csm-admin/all_type_doctor/img/reg14.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                        @if ($errors->has('landmark_pincode')) <span class="error" style="color:red">{{ $errors->first('landmark_pincode') }}</span> @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="checkbox-dropdown"><img src="{{asset('csm-admin/all_type_doctor/img/reg4.png')}}" alt="" class="booking-agent1-img fixed-image" style="margin-top: -2px; margin-left: -2px">
                                                                                    Availability Of Days
                                                                                    <ul class="checkbox-dropdown-list">
                                                                                        @php $result = explode(",",$data->avl_days ?? ''); $resultlog = explode(",",$datalog->avl_days ?? ''); @endphp
                                                                                        <li>
                                                                                            <label>
                                                                                                <input type="checkbox" class="check-box-11" id="checkAll" value="" name="checkAll">All Day</label>
                                                                                        </li>
                                                                                        <li>
                                                                                            @if(Auth::user()->id==1 && !empty($datalog->avl_days) && $result !=$resultlog)
                                                                                            <label style="color: red;"><input type="checkbox" class="check-box-11"  value="SUNDAY" {{ old('avl_days.0', in_array("SUNDAY",$resultlog))== "SUNDAY" ? 'checked' : '' }} name="avl_days[]">Sunday</label>
                                                                                            @else
                                                                                            <label><input type="checkbox" class="check-box-11"  value="SUNDAY" {{ old('avl_days.0', in_array("SUNDAY",$result))== "SUNDAY" ? 'checked' : '' }} name="avl_days[]">Sunday</label>
                                                                                            @endif   
                                                                                        </li>
                                                                                        <li>
                                                                                            @if(Auth::user()->id==1 && !empty($datalog->avl_days) && $result !=$resultlog)
                                                                                            <label style="color: red;"><input type="checkbox" class="check-box-11"  value="MONDAY" {{ old('avl_days.1', in_array("MONDAY",$resultlog))== "MONDAY" ? 'checked' : '' }} name="avl_days[]">Monday</label>
                                                                                            @else
                                                                                            <label><input type="checkbox" class="check-box-11"  value="MONDAY" {{ old('avl_days.1', in_array("MONDAY",$result))== "MONDAY" ? 'checked' : '' }} name="avl_days[]">Monday</label>
                                                                                            @endif
                                                                                        </li>
                                                                                        <li>
                                                                                            <label>
                                                                                                <input type="checkbox" class="check-box-11"  value="TUESDAY" {{ old('avl_days.2', in_array("TUESDAY",$result))== "TUESDAY" ? 'checked' : '' }} name="avl_days[]">Tuesday</label>
                                                                                        </li>
                                                                                        <li>
                                                                                            <label>
                                                                                                <input type="checkbox" class="check-box-11"  value="WEDNESDAY" {{ old('avl_days.3', in_array("WEDNESDAY",$result))== "WEDNESDAY" ? 'checked' : '' }} name="avl_days[]">Wednesday</label>
                                                                                        </li>
                                                                                        <li>
                                                                                            <label>
                                                                                                <input type="checkbox" class="check-box-11" value="THURSDAY" {{ old('avl_days.4', in_array("THURSDAY",$result))== "THURSDAY" ? 'checked' : '' }} name="avl_days[]">Thursday</label>
                                                                                        </li>
                                                                                        <li>
                                                                                            <label>
                                                                                                <input type="checkbox" class="check-box-11"  value="FRIDAY" {{ old('avl_days.5', in_array("FRIDAY",$result))== "FRIDAY" ? 'checked' : '' }} name="avl_days[]">Friday</label>
                                                                                        </li>
                                                                                        <li>
                                                                                            <label>
                                                                                                <input type="checkbox" class="check-box-11"  value="SATERDAY" {{ old('avl_days.6', in_array("SATERDAY",$result))== "SATERDAY" ? 'checked' : '' }} name="avl_days[]">Saturday</label>
                                                                                        </li>
                                                                                    </ul>
                                                                                    @if ($errors->has('avl_days')) <span class="error" style="color:red">{{ $errors->first('avl_days') }}</span> @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 ht-30">
                                                                                <div class="form-group">
                                                                                    <div class="input_wrap">
                                                                                        <input type="time" name="from_time" id="from_time" @if($data->from_time ?? '') value="{{date('H:i',strtotime($data->from_time ?? ''))}}" @else value="{{old('from_time')}}" @endif  style="padding-left: 40px;padding-bottom: 10px;">
                                                                                        <label class="floating-label">From Time(Opt.) ?</label>
                                                                                        <img src="{{asset('csm-admin/all_type_doctor/img/reg2.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                        @if ($errors->has('from_time')) <span class="error" style="color:red">{{ $errors->first('from_time') }}</span> @endif
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 ht-30">
                                                                                <div class="form-group">
                                                                                    <div class="input_wrap"> 
                                                                                        <input type="time" name="to_time" min=""  id="to_time" @if($data->to_time ?? '') value="{{date('H:i',strtotime($data->to_time ?? ''))}}" @else value="{{old('to_time')}}" @endif style="padding-left: 40px;padding-bottom: 10px;">
                                                                                        <label class="floating-label">To Time(Opt.) ?</label>
                                                                                        <img src="{{asset('csm-admin/all_type_doctor/img/reg2.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                        @if ($errors->has('to_time')) <span class="error" style="color:red">{{ $errors->first('to_time') }}</span> @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 ">
                                                                                <div class="form-group">
                                                                                    <div class="input_wrap">
                                                                                        <input type="number" name="consul_fee_from" id="ninetyPercent" onInput="checkValue('ninetyPercent')" oninput="this.value=this.value.replace(/[^0-9]/gi,'');" value="{{old('consul_fee_from',$data->consul_fee_from?? '')}}"  style="padding-left: 40px;padding-bottom: 10px;">
                                                                                        <label class="floating-label">Consult Fee From ?</label>
                                                                                        <img src="{{asset('csm-admin/all_type_doctor/img/reg21.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                        @if ($errors->has('consul_fee_from')) <span class="error" style="color:red">{{ $errors->first('consul_fee_from') }}</span> @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 ">
                                                                                <div class="form-group">
                                                                                    <div class="input_wrap">
                                                                                        <input type="text" name="consul_fee_to" id="twentyPercent"  oninput="this.value=this.value.replace(/[^0-9]/gi,'');" value="{{old('consul_fee_to',$data->consul_fee_to?? '')}}"  style="padding-left: 40px;padding-bottom: 10px;">
                                                                                        <label class="floating-label">Consult Fee To ?</label>
                                                                                        <img src="{{asset('csm-admin/all_type_doctor/img/reg21.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                        @if ($errors->has('consul_fee_to')) <span class="error" style="color:red">{{ $errors->first('consul_fee_to') }}</span> @endif
                                                                                    </div>
                                                                                </div>
                                                                                <a class="btn-sm" id="addButton">Add More</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <div class="input_wrap">
                                                                            <input type="text" name="website_url" id="website_url" value="{{old('website_url',$data->website_url?? '')}}"  style="padding-left: 40px;padding-bottom: 10px;">
                                                                            <label class="floating-label">Website URL ?</label>
                                                                            <img src="{{asset('csm-admin/all_type_doctor/img/reg10.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                            @if ($errors->has('website_url')) <span class="error" style="color:red">{{ $errors->first('website_url') }}</span> @endif
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <div class="input_wrap">
                                                                            <input type="text" name="" readonly="" onclick="openSocial()" placeholder="Social Media Profile Links(Click Me)" style="padding-left: 40px;padding-bottom: 10px;">
                                                                            <i class="fa fa-plus fa7-plus" onclick="openSocial()"></i>
                                                                            <img src="{{asset('csm-admin/all_type_doctor/img/reg13.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="newSocial" class="hidden col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <div class="input_wrap">
                                                                                    <input type="text" name="facebook_url" id="facebook_url" value="{{old('facebook_url',$data->social_media_link?? '')}}" style="padding-left: 40px;padding-bottom: 10px;">
                                                                                    <label class="floating-label">Facebook Profile Link ?</label>
                                                                                    <img src="{{asset('csm-admin/all_type_doctor/img/reg9.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <div class="input_wrap">
                                                                                    <input type="text" name="instagram_url" id="instagram_url" value="{{old('instagram_url',$data->instagram_url?? '')}}" style="padding-left: 40px;padding-bottom: 10px;">
                                                                                    <label class="floating-label">Instagram Profile Link ?</label>
                                                                                    <img src="{{asset('csm-admin/all_type_doctor/img/reg12.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <div class="input_wrap">
                                                                                    <input type="text" name="youth_profile_url" id="youth_profile_url" value="{{old('youth_profile_url',$data->youth_profile_url?? '')}}" style="padding-left: 40px;padding-bottom: 10px;">
                                                                                    <label class="floating-label">Youtube Profile Link ?</label>
                                                                                    <img src="{{asset('csm-admin/all_type_doctor/img/reg25.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <div class="input_wrap">
                                                                                    <input type="text" name="twiter_profile_url" id="twiter_profile_url" value="{{old('twiter_profile_url',$data->twiter_profile_url?? '')}}" style="padding-left: 40px;padding-bottom: 10px;">
                                                                                    <label class="floating-label">Twitter Profile Link ?</label>
                                                                                    <img src="{{asset('csm-admin/all_type_doctor/img/reg22.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <div class="input_wrap">
                                                                            <input type="text" name="achivement_award" id="achivement_award" value="{{old('achivement_award',$data->achievement_award?? '')}}"  style="padding-left: 40px;padding-bottom: 10px;">
                                                                            <label class="floating-label">Achievement &amp; Awards ?</label>
                                                                            <img src="{{asset('csm-admin/all_type_doctor/img/reg20.png')}}" alt="" class="booking-agent1-img fixed-image">

                                                                        </div>
                                                                        <div class="input_wrap float-top">

                                                                            <input type="file" name="doctorachievement_file"  style="padding-left: 40px;padding-bottom: 10px;">
                                                                            <i class="fa fa-plus fa6-plus add-achievement"></i>

                                                                            <img src="{{asset('csm-admin/all_type_doctor/img/reg20.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <div class="input_wrap">
                                                                            <textarea  type="text"  name="descriptions" id="descriptions"  style="padding-left: 40px;padding-bottom: 10px;">{{old('descriptions',$data->description?? '')}}</textarea>
                                                                            <label class="floating-label">Description</label>
                                                                            <img src="{{asset('csm-admin/all_type_doctor/img/reg19.png')}}" alt="" class="booking-agent1-img fixed-images">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 ">
                                                                    <div class="form-group">
                                                                        <div class="input_wrap" style="margin-top: -8px;">
                                                                            <p class="profile-float">Profile Picture ?</p>
                                                                            <input type="file" name="profile_picture" style="padding-left: 40px;padding-bottom: 10px;">
                                                                            <img src="{{asset('csm-admin/all_type_doctor/img/reg24.png')}}" alt="" class="booking-agent1-img fixed-image">
                                                                            @if ($errors->has('profile_picture')) <span class="error" style="color:red">{{ $errors->first('profile_picture') }}</span> @endif
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 ">


                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12  col-12">
                                                                    @if(Auth::user()->id==1)
                                                                        <center>
                                                                            <button class="btn btn-success suc-sub" id="alltypeuserlogsubmit" type="submit">Submit Now</button>
                                                                        </center>
                                                                    @elseif(Request::segment(4)=='edit') 
                                                                     
                                                                    @else
                                                                        <center>
                                                                            <button class="btn btn-success suc-sub" id="alltypeuserlogsubmit" type="submit">Submit Now</button>
                                                                        </center>    
                                                                    @endif 
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif(Request::segment(3)=='doctorview')
                                        <div class="row">
                                            <div class="col-xl">
                                                <div class="card mb-4">
                                                    <div class="card-header d-flex justify-content-between align-items-center view-doc-back">
                                                        <a href="admin-doctor-listing.html" class="btn btn-list">Doctor Listing</a>

                                                    </div>
                                                    <div class="card-body admin-docvw-back" style="padding-top: 30px;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/h-docname.png')}}" class="admin-doclist-img1">Dr. Name: {{$data->full_name}}</p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/h-phone.png')}}" class="admin-doclist-img1">Mobile No: {{$data->mobile}}</p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/h-qual.png')}}" class="admin-doclist-img1">Doctor Qualification: {{$data->doctorqualification}}</p>

                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/h-dist.png')}}" class="admin-doclist-img1">Organization Name: {{$data->department}}</p>

                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/h-day.png')}}" class="admin-doclist-img1">Availability: {{$data->avl_days}} </p>

                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg2.png')}}" class="admin-doclist-img1">To Time: {{$data->to_time}} </p>

                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg23.png')}}" class="admin-doclist-img1">Total Experience:{{$data->total_experience}} Years </p>

                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg21.png')}}" class="admin-doclist-img1">Consult fee to: {{$data->consul_fee_to}} </p>

                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg12.png')}}" class="admin-doclist-img1">Instagram Profile: {{$data->instagram_url}} </p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg22.png')}}" class="admin-doclist-img1">Twitter Profile: {{$data->twiter_profile_url}} </p>

                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg20.png')}}" class="admin-doclist-img1">Awards: {{$data->achievement_award}} <span><img src="img/award-image.jpg" alt="" class="award-picture"></span></p>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg3.png')}}" class="admin-doclist-img1">Gender: {{$data->gender}} </p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/h-email.png')}}" class="admin-doclist-img1">E-Mail ID: {{$data->email}} </p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg8.png')}}" class="admin-doclist-img1">{{$data->slefemp_emplaye}}</p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg14.png')}}" class="admin-doclist-img1">Organization Location:{{$data->location}}</p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg2.png')}}" class="admin-doclist-img1">From Time:{{$data->from_time}}</p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/h-depart.png')}}" class="admin-doclist-img1">Department: {{$data->department}}</p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg21.png')}}" class="admin-doclist-img1">Consult fee from: {{$data->consul_fee_from}}</p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg10.png')}}" class="admin-doclist-img1">Website URL: {{$data->website_url}}</p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg9.png')}}" class="admin-doclist-img1">Facebook Page: {{$data->social_media_link}}</p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg25.png')}}" class="admin-doclist-img1">Youtube Profile: {{$data->youth_profile_url}}</p>
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg20.png')}}" class="admin-doclist-img1">Achievement: {{$data->achievement_award}}<span><img src="img/award-image.jpg" alt="" class="award-picture"></span></p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <p class="admin-doctor-listing-text1 admin-doctor-listing-text1-desc"><img src="{{asset('csm-admin/all_type_doctor/img/reg17.png')}}" class="admin-doclist-img1">Description:{{$data->description}} </p>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/reg24.png')}}" class="admin-doclist-img1">Profile Picture <span><img src="{{asset('csm-admin/all_type_doctor/img/award-image.jpg')}}" alt="" class="award-picture"></span></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="admin-doctor-listing-text1"><img src="{{asset('csm-admin/all_type_doctor/img/h-hosveri.png')}}" class="admin-doclist-img1">Verified</p>
                                                            </div>
                                                        </div>
                                                        <center><a href="{{url('/cms-admin/alltype-user/doctor')}}" class="btn btn-close-now">Close Now</a></center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" placeholder="Tele Phone No" data-validation-required-message="Tele Phone No is required" value="{{$data->telephone ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Achievement & Award</label>
                                                            <input type="file" name="award[]" multiple="" accept="image/*" class="form-control @error('award') is-invalid @enderror" required placeholder="Achievement & Award" data-validation-required-message="Achievement & Award is required">
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
                                                            <label>Achievement & Award</label>
                                                            <input type="file" name="award[]" multiple="" accept="image/*" class="form-control @error('award') is-invalid @enderror" required placeholder="Achievement & Award" data-validation-required-message="Achievement & Award is required">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Star and Ratings</label>
                                                            <input type="text" name="star_ratings" class="form-control @error('star_ratings') is-invalid @enderror" required placeholder="Star and Ratings" data-validation-required-message="The Star and Ratings is required" value="{{$data->star_ratings ?? ''}}">
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
                                                            <input type="file" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror" required placeholder="Profile Picture" data-validation-required-message="The Profile Picture field is required">

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
                                                                <option @if(in_array('test2',$available_test)) selected @endif>test2</option>
                                                                <option @if(in_array('test3',$available_test)) selected @endif>test3</option>
                                                                <option @if(in_array('test4',$available_test)) selected @endif>test4</option>
                                                                <option @if(in_array('test5',$available_test)) selected @endif>test5</option>
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
                                                            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" placeholder="Tele Phone No" data-validation-required-message="Tele Phone No is required" value="{{$data->telephone ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Achievement & Award</label>
                                                            <input type="file" name="award[]" multiple="" accept="image/*" class="form-control @error('award') is-invalid @enderror" required placeholder="Achievement & Award" data-validation-required-message="Achievement & Award is required">
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
                                                                <option @if(in_array('Offer2',$course_offered)) selected @endif>Offer2</option>
                                                                <option @if(in_array('Offer3',$course_offered)) selected @endif>Offer3</option>
                                                                <option @if(in_array('Offer4',$course_offered)) selected @endif>Offer4</option>
                                                                <option @if(in_array('Offer5',$course_offered)) selected @endif>Offer5</option>
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
                                                            <input type="text" name="telephone" value="{{@$data->telephone}}" class="form-control @error('telephone') is-invalid @enderror" placeholder="Tele Phone No" data-validation-required-message="Tele Phone No is required" value="{{$data->telephone ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Achievement & Award</label>
                                                            <input type="file" name="award[]" multiple="" accept="image/*" class="form-control @error('award') is-invalid @enderror" required placeholder="Achievement & Award" data-validation-required-message="Achievement & Award is required">
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
                                                            <input type="text" name="doc_profile" class="form-control @error('doc_profile') is-invalid @enderror" placeholder="Doctor profile link" data-validation-required-message="Doctor profile link is required" value="{{$data->doc_profile ?? ''}}">
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
                                                                @endif
                                                            </div>
                                                            <a href="{{ url('/cms-admin/alltype-user/diseaseslist/'.$post->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><span class="badge badge-primary badge-pill">X</span></a>
                                                        </li>
                                                        @empty
                                                        @endforelse
                                                    </ul>
                                                </div>
                                                @endif
                                                <div class="col-12">
                                                    <div id="row" class="row  m-3">

                                                        <div class="col-6">
                                                            <textarea class="form-control" name="disease_desc[]"></textarea>
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="file" name="disease_img[]">
                                                        </div>
                                                        <div class="col-2">
                                                            <button id="rowAdder" type="button" class="btn btn-dark">
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
<script src="{{asset('csm-admin/all_type_doctor/js/script.js')}}"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript">
    $(document).on("click", ".checkbox-dropdown", function() {
        $(this).toggleClass("is-active");
    });

    $(document).on("click", ".checkbox-dropdown ul", function(e) {
        e.stopPropagation();
    });

    $("#rowAdder").click(function() {
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

    $("body").on("click", "#x", function() {
        $(this).parents("#row").remove();
    });
</script>
<script>
    $(document).ready(function() {
        let sectionCount = 1;

        function attachAvailabilityHandlers(section) {
            section.find(".anchor").click(function() {
                $(this).siblings(".checkbox-dropdown-list").toggle();
            });

            section.find(".checkbox-dropdown-list").click(function(e) {
                e.stopPropagation();
            });
        }

        $("#addButton").click(function() {
            sectionCount++;

            // Clone the existing working section
            const newSection = $("#newWorking").clone();

            // Update IDs and other attributes
            newSection.attr("id", `newWorking${sectionCount}`);

            // Remove the specific fields you want
            newSection.find(".remove-on-add").remove();

            // Change the label for the new section
            newSection.find(".anchor").text("Availability Of Days");

            // Create the list for the new section
            const newList = $("<ul>").addClass("checkbox-dropdown-list");
            // ... Add list items to newList ...

            // Append the new list to the new section
            newSection.append(newList);

            // Add remove button
            const removeButton = $("<button>").text("Remove").addClass("btn-rmv");
            removeButton.click(function() {
                $(`#newWorking${sectionCount}`).remove();
            });
            newSection.append(removeButton);

            // Append the new section to the container
            $("#workingContainer").append(newSection);

            // Attach availability handlers to the newly added section
            attachAvailabilityHandlers(newSection);
        });

        // Attach availability handlers to the first section
        attachAvailabilityHandlers($("#newWorking"));

        function openDay(sectionCount) {
            // Implement your openDay logic here
        }
    });
</script>
<script>
    $("#checkAll").change(function() {
        var ischecked= $(this).is(':checked');
        if (ischecked) {
            $('input:checkbox').prop('checked', true);
        } else {
            $('input:checkbox').prop('checked', false);
        }
    });
    
 
</script>
<script>
    $('#add_qualifications').hide(); 
    $('#university_date').on('change' ,function(){
        //document.getElementByID('add_qualifications').style.display = "block";
        $('#add_qualifications').show(); 
    });
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('add-qualification')) {
            const newQualificationDiv = document.createElement('div');
            newQualificationDiv.classList.add('row');
            newQualificationDiv.innerHTML = `
            <div class="form-group" id="location" style="margin-left: 0px;">
                <div class="input_wrap">
                    <input type="text" name="doctorQualification" required style="padding-left: 40px; padding-bottom: 10px;">
                    <i class="fa fa-plus fa9-plus add-qualification"></i>
                    <label class="floating-label">Doctor Qualification ?</label>
                    <img src="{{asset('csm-admin/all_type_doctor/img/reg27.png')}}" alt="" class="booking-agent1-img fixed-image">
                </div>
            </div>
            <div class="form-group" style="margin-left: 10px;">
                <div class="select_wrap select">
                <input type="text" oninput="this.value=this.value.replace(/[^a-z0-9]/gi, '');" name="univercity" id="univercity" maxlength="50" value="{{old('univercity',$data->univercity ?? '')}}"  style="padding-left: 40px;padding-bottom: 10px;">
                    <label class="floating-label">university ?</label>
                    <img src="{{asset('csm-admin/all_type_doctor/img/reg15.png')}}" alt="" class="booking-agent1-img">
                    <input type="text" oninput='this.value=this.value.replace(/[^\d]/, '');' maxlength="4"  @if($data->university_date ?? '') value="{{date('Y-m-d',strtotime($data->university_date ?? ''))}}" @else value="{{old('university_date')}}" @endif id="university_date" name='university_date' />
                    @if ($errors->has('univercity')) <span class="error" style="color:red">{{ $errors->first('univercity') }}</span> @endif
                </div>
            </div>
            
        `;
        

            // Remove the "Add Qualification" icon from the previous div
            const previousAddButton = event.target;
            previousAddButton.style.display = 'none';

            // Insert the new qualification div after the last qualification div
            const lastQualificationDiv = event.target.closest('.row');
            lastQualificationDiv.parentNode.insertBefore(newQualificationDiv, lastQualificationDiv.nextSibling);
            // //sadasd univercity
            // const lastQualificationDivs = event.target.closest('.univercity');
            // lastQualificationDiv.parentNode.insertBefore(newQualificationDivs, lastQualificationDivs.nextSibling);
        }
    });

    function openWorking() {
        var div = document.getElementById('newWorking');
        div.classList.toggle('hidden');
    }

    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('add-achievement')) {
            const newQualificationDiv = document.createElement('div');
            newQualificationDiv.classList.add('col-md-4');
            var img = "{{asset('csm-admin/all_type_doctor/img/reg27.png')}}";
            newQualificationDiv.innerHTML = `
            <div class="form-group" id="location">
                <div class="input_wrap">
                    <input type="text" name="doctorachievement" required style="padding-left: 40px; padding-bottom: 10px;">
                    <label class="floating-label">Achievement & Awards  ?</label>
                    <img src="{{asset('csm-admin/all_type_doctor/img/reg20.png')}}" alt="" class="booking-agent1-img fixed-image">
                </div>
                 <div class="input_wrap float-top">
                    <input type="file" name="doctorachievement" required style="padding-left: 40px; padding-bottom: 10px;">
                    <i class="fa fa-plus fa6-plus add-achievement"></i>
                   
                    <img src="{{asset('csm-admin/all_type_doctor/img/reg20.png')}}" alt="" class="booking-agent1-img fixed-image">
                </div>
            </div>
        `;

            // Remove the "Add Qualification" icon from the previous div
            const previousAddButton = event.target;
            previousAddButton.style.display = 'none';

            // Insert the new qualification div after the last qualification div
            const lastQualificationDiv = event.target.closest('.col-md-4');
            lastQualificationDiv.parentNode.insertBefore(newQualificationDiv, lastQualificationDiv.nextSibling);
        }
    });
    // consulant free in %//
    //document.getElementById("twentyPercent").setAttribute("readonly", "true");
    document.getElementById('twentyPercent').onkeydown = function(e){
         e.preventDefault();
    }
    function checkValue (type) {
       // alert(3333333);
        var no = 0;
        var percent = 0;
        var otherPercent = 0;
        if (type === 'ninetyPercent') {
            no = document.getElementById('ninetyPercent').value;
            //otherPercent = (parseFloat(percent.toFixed(2)) + parseInt(no))
            percent = (20/ 100) * parseInt(no).toFixed(2) + parseInt(no);
            document.getElementById('twentyPercent').value = percent;
        }
        
    }

    document.getElementById("from_time").onchange = function () {
        var input = document.getElementById("to_time");
        input.setAttribute("min", this.value);
    }

    $(document).ready(function(){
        <?php if(Request::segment(4)=='edit'){ ?>
        $('#descriptions').on('change',function(){
            var descriptions= $(this).val();  //alltypeuserlogsubmit
            save_description(descriptions,'');
        });

        $('#achivement_award').on('change',function(){
            var achivement_award= $(this).val();
            save_description('',achivement_award);

        });
        $('#twiter_profile_url').on('change',function(){
            var twiter_profile_url= $(this).val(); 
            save_description('','',twiter_profile_url);

        });
        $('#youth_profile_url').on('change',function(){
            var youth_profile_url= $(this).val();
            save_description('','','',youth_profile_url);

        });
        $('#instagram_url').on('change',function(){
            var instagram_url= $(this).val();
            save_description('','','','',instagram_url);

        });
        $('#facebook_url').on('change',function(){
            var facebook_url= $(this).val();  
            save_description('','','','','',facebook_url);

        });
        $('#website_url').on('change',function(){
            var website_url= $(this).val();
            save_description('','','','','','',website_url);

        });
        $('#ninetyPercent').on('change',function(){
            var ninetyPercent= $(this).val();
            var no = 0;
            var percent = 0;
            var otherPercent = 0;
            if (ninetyPercent) {
                no = document.getElementById('ninetyPercent').value;
                //otherPercent = (parseFloat(percent.toFixed(2)) + parseInt(no)) to_time
                percent = (20/ 100) * parseInt(no).toFixed(2) + parseInt(no);
               var consul_fee_to = percent;
            }
            save_description('','','','','','','',ninetyPercent,consul_fee_to);

        });
        $('#from_time').on('change',function(){
            var from_time= $(this).val();  
            save_description('','','','','','','','','',from_time);

        });
        $('#to_time').on('change',function(){
            var to_time= $(this).val();
            save_description('','','','','','','','','','',to_time);

        });
        $("input[name='avl_days[]']").on('change',function(){
            
            var avl_dayss = parseInt($(this).val()); 
            var avl_days= $(this).val();
            alert(avl_days);
            save_description('','','','','','','','','','','',avl_days);

        });
        $('#landmark_pincode').on('change',function(){
            var landmark_pincode= $(this).val();
            save_description('','','','','','','','','','','','',landmark_pincode);

        });
        $('#state_city').on('change',function(){
            var state_city= $(this).val(); 
            save_description('','','','','','','','','','','','','',state_city);

        });
        $('#orgnization_location').on('change',function(){
            var orgnization_location= $(this).val();
            save_description('','','','','','','','','','','','','','',orgnization_location);

        });
        $('#orgnization_name').on('change',function(){
            var orgnization_name= $(this).val(); 
            save_description('','','','','','','','','','','','','','','',orgnization_name);

        });
        $('#totalexprience').on('change',function(){
            var totalexprience= $(this).val(); 
            save_description('','','','','','','','','','','','','','','','',totalexprience);

        });
        $('#department').on('change',function(){
            var department= $(this).val(); //slefemp_emplaye
            alert(department);
            save_description('','','','','','','','','','','','','','','','','',department);

        });
        $('#designation').on('change',function(){
            var designation= $(this).val(); 
            alert(designation);
            save_description('','','','','','','','','','','','','','','','','','',designation);

        });
        $('#slefemp_emplaye').on('change',function(){
            var slefemp_emplaye= $(this).val(); 
            alert(slefemp_emplaye);
            save_description('','','','','','','','','','','','','','','','','','','',slefemp_emplaye);

        });
        $('#univercity').on('change',function(){
            var univercity= $(this).val(); 
            save_description('','','','','','','','','','','','','','','','','','','','',univercity);

        });
        $('#university_date').on('change',function(){
            var university_date= $(this).val();
            save_description('','','','','','','','','','','','','','','','','','','','','',university_date);

        });
        $('#doctorqualification').on('change',function(){
            var doctorqualification= $(this).val(); 
            alert(doctorqualification);
            save_description('','','','','','','','','','','','','','','','','','','','','','',doctorqualification);

        });
        $('#doctor_email').on('change',function(){
            var doctor_email= $(this).val();
            alert(doctor_email); //gender
            save_description('','','','','','','','','','','','','','','','','','','','','','','',doctor_email);

        });
        $('#dmobile_no').on('change',function(){
            var dmobile_no= $(this).val(); //full_name
            alert(dmobile_no);
            save_description('','','','','','','','','','','','','','','','','','','','','','','','',dmobile_no);

        });
        $('#gender').on('change',function(){
            var gender= $(this).val();
            alert(gender);
            save_description('','','','','','','','','','','','','','','','','','','','','','','','','',gender);

        });
        $('#full_name').on('change',function(){
            var full_name= $(this).val();
            alert(full_name);
            save_description('','','','','','','','','','','','','','','','','','','','','','','','','','',full_name);

        });
        function save_description(descriptions,achivement_award,twiter_profile_url,
        youth_profile_url,instagram_url,facebook_url,website_url,ninetyPercent,consul_fee_to,
        from_time,to_time,avl_days,landmark_pincode,state_city,orgnization_location,
        orgnization_name,totalexprience,department,designation,slefemp_emplaye,univercity,
        university_date,doctorqualification,doctor_email,dmobile_no,gender,full_name){
            let _token   = $('meta[name="csrf-token"]').attr('content');
            var data_id = $('input[name=data_id]').val();
            //alert(data_id);
            $.ajax({
                method:'POST',
                url:"{{url('/cms-admin/alltype-user/alltypeuserlog/doctor')}}",
                //data:'description='+descriptions+"&achivement_award="+achivement_award+"&_token="+_token,data_id
                data:{descriptions:descriptions,
                    achivement_award :achivement_award,
                    _token: _token,data_id:data_id,
                    twiter_profile_url:twiter_profile_url,
                    youth_profile_url:youth_profile_url,instagram_url:instagram_url,facebook_url:facebook_url,
                    website_url:website_url,consul_fee_from:ninetyPercent,consul_fee_to:consul_fee_to,
                    from_time:from_time,to_time:to_time,avl_days:avl_days,landmark_pincode:landmark_pincode,
                    state_city:state_city,orgnization_location:orgnization_location,
                    orgnization_name:orgnization_name,totalexprience:totalexprience,
                    department:department,designation:designation,
                    slefemp_emplaye:slefemp_emplaye,univercity:univercity,
                    university_date:university_date,doctorqualification:doctorqualification,
                    doctor_email:doctor_email,dmobile_no:dmobile_no,gender:gender,full_name:full_name},
                success: function(data){
                    console.log(data);
                    alert('submit successfully');
                }
            });
        }
        <?php } ?> 
   }); 
    
</script>
@endsection