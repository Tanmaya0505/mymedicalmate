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
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0 pills-stacked">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='doctor') active @endif" id="account-pill-general" 
                               href="{{url('/cms-admin/alltype-user/doctor')}}" aria-expanded="true">
                                <i class="bx bx-cog"></i>
                                <span>Doctors</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='hospital') active @endif" id="account-pill-password"  href="{{url('/cms-admin/alltype-user/hospital')}}" aria-expanded="false">
                                <i class="bx bx-lock"></i>
                                <span>Hospitals</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='nurses') active @endif" id="account-pill-social"
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
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='exams') active @endif" id="account-pill-assistant-config"
                               href="{{url('/cms-admin/alltype-user/exams')}}" aria-expanded="false">
                                <i class="bx bx-briefcase-alt"></i>
                                <span>Examinations</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='diseases') active @endif" id="account-pill-doctor-config"
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
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/doctor/add')}}">Add Doctor</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="users-list-datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Full Name</th>
                                                        <th>Department</th>
                                                        <th>Designation</th>
                                                        <th>Total Experience</th>
                                                        <th>Location</th>
                                                        <th>Action</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($data as $key=>$value)
                                                    
                                                    <tr>
                                                        <td title="{{  $value->full_name }}">
                                                            {{ $value->full_name}}
                                                        </td>
                                                        <td>{{ $value->department }}</td>
                                                        <td title="{{  $value->designation }}">{{ $value->designation }}</td>
                                                        <td>{{ $value->total_experience }}</td>
                                                        <td>{{ $value->location }}</td>
                                                        
                                                        <td><a href="{{ url('/cms-admin/alltype-user/doctor/edit/'.$value->id) }}"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ url('/cms-admin/alltype-user/doctor/delete/'.$value->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        @elseif(Request::segment(3)=='hospital')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/hospital/add')}}">Add Hospital</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="users-list-datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Hospital Name</th>
                                                        <th>Location</th>
                                                        <th>Established Year</th>
                                                        <th>Type of Hospital</th>
                                                        <th>Multi Specialist</th>
                                                        <th>Star and Ratings</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($data as $key=>$value)
                                                    <tr>
                                                        <td title="{{  $value->full_name }}">
                                                            {{ $value->full_name}}
                                                        </td>
                                                        <td>{{ $value->location }}</td>
                                                        <td>{{ $value->etablished_year }}</td>
                                                        <td>{{ $value->type_hospital }}</td>
                                                        <td>{{ $value->multi_specialist =='0'?'No':'Yes'}}</td>
                                                        <td>{{ $value->star_ratings }}</td>
                                                        <td><a href="{{ url('/cms-admin/alltype-user/hospital/edit/'.$value->id) }}"><i class="fas fa-edit"></i></a>
                                                            <a href="{{ url('/cms-admin/alltype-user/hospital/delete/'.$value->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        @elseif(Request::segment(3)=='nurses')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/nurses/add')}}">Add Nurses</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="users-list-datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Full Name</th>
                                                        <th>Designation</th>
                                                        <th>Total Experience</th>
                                                        <th>Location</th>
                                                        <th>Star and Ratings</th>
                                                        <th>Upload Profile Picture</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($data as $key=>$value)
                                                    
                                                    <tr>
                                                        
                                                        <td title="{{  $value->full_name }}">
                                                            {{ $value->full_name}}
                                                        </td>
                                                        <td title="{{  $value->designation }}">{{ $value->designation }}</td>
                                                        <td>{{ $value->total_experience }}</td>
                                                        <td>{{ $value->location }}</td>
                                                        
                                                        <td>{{ $value->star_ratings }}</td>
                                                        <td><img height="100px" width="100px" src="{{ url($value->profile_picture) }}"></td>
                                                        <td>
                                                            <a href="{{ url('/cms-admin/alltype-user/nurses/edit/'.$value->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{ url('/cms-admin/alltype-user/nurses/delete/'.$value->id) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        @elseif(Request::segment(3)=='clinics')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/clinics/add')}}">Add clinics</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="users-list-datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Clinic Name</th>
                                                        <th>Location</th>
                                                        <th>Established Year</th>
                                                        <th>Specialized in</th>
                                                        <th>Star and Ratings</th>
                                                        <th>Clinic Picture</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($data as $key=>$value)
                                                    
                                                    <tr>
                                                        <td title="{{  $value->full_name }}">
                                                            {{ $value->full_name}}
                                                        </td>
                                                        <td>{{ $value->location }}</td>
                                                        <td>{{ $value->specialized }}</td>
                                                        <td>{{ $value->available_test }}</td>
                                                        <td>{{ $value->star_ratings }}</td>
                                                        <td><img height="100px" width="100px" src="{{ url($value->profile_picture) }}"></td>
                                                        <td>
                                                            <a href="{{ url('/cms-admin/alltype-user/clinics/edit/'.$value->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{ url('/cms-admin/alltype-user/clinics/delete/'.$value->id) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        @elseif(Request::segment(3)=='pharmas')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/pharmas/add')}}">Add pharmas</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="users-list-datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Name of Institution</th>
                                                        <th>Location</th>
                                                        <th>Established Year</th>
                                                        <th>Star and Ratings</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($data as $key=>$value)
                                                    
                                                    <tr>
                                                        <td title="{{  $value->full_name }}">
                                                            {{ $value->full_name}}
                                                        </td>
                                                        <td>{{ $value->location }}</td>
                                                        <td>{{ $value->etablished_year }}</td>
                                                        <td>{{ $value->star_ratings }}</td>
                                                        <td>
                                                            <a href="{{ url('/cms-admin/alltype-user/pharmas/edit/'.$value->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{ url('/cms-admin/alltype-user/pharmas/delete/'.$value->id) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        @elseif(Request::segment(3)=='exams')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/exams/add')}}">Add exams</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="users-list-datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Name of Exam</th>
                                                        <th>Last date of Apply</th>
                                                        <th>Total Vacancy</th>
                                                        <th>Exam Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($data as $key=>$value)
                                                    <tr>
                                                        <td title="{{  $value->full_name }}">
                                                            {{ $value->full_name}}
                                                        </td>
                                                        <td>{{ $value->last_date_of_apply }}</td>
                                                        <td>{{ $value->total_vacancy }}</td>
                                                        <td>{{ $value->exam_date }}</td>
                                                        <td>
                                                            <a href="{{ url('/cms-admin/alltype-user/exams/edit/'.$value->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{ url('/cms-admin/alltype-user/exams/delete/'.$value->id) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        @elseif(Request::segment(3)=='diseases')
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/alltype-user/diseases/add')}}">Add diseases</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="users-list-datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Name of Disease</th>
                                                        <th>Refer by Hospital/Doctor</th>
                                                        <th>Primary Contain</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($data as $key=>$value)
                                                    
                                                    <tr>
                                                        
                                                        <td title="{{  $value->full_name }}">
                                                            {{ $value->full_name}}
                                                        </td>
                                                        <td>{{ $value->references_hos_doc }}</td>
                                                        <td>{{ $value->prime_contain }}</td>
                                                        <td>
                                                            <a href="{{ url('/cms-admin/alltype-user/diseases/edit/'.$value->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{ url('/cms-admin/alltype-user/diseases/delete/'.$value->id) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
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
@endsection
