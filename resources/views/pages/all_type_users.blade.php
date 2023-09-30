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
<link rel="stylesheet" type="text/css" href="{{asset('csm-admin/all_type_doctor/css/style.css')}}">
<!-- Core CSS -->


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
<!-- Fonts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .btn i {
        top: 0px;
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
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='doctor') active @endif" id="account-pill-general" href="{{url('/cms-admin/alltype-user/doctor')}}" aria-expanded="true">
                                <i class="bx bx-cog"></i>
                                <span>Doctors</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='hospital') active @endif" id="account-pill-password" href="{{url('/cms-admin/alltype-user/hospital')}}" aria-expanded="false">
                                <i class="bx bx-lock"></i>
                                <span>Hospitals</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='nurses') active @endif" id="account-pill-social" href="{{url('/cms-admin/alltype-user/nurses')}}" aria-expanded="false">
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
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='exams') active @endif" id="account-pill-assistant-config" href="{{url('/cms-admin/alltype-user/exams')}}" aria-expanded="false">
                                <i class="bx bx-briefcase-alt"></i>
                                <span>Examinations</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center @if(Request::segment(3)=='diseases') active @endif" id="account-pill-doctor-config" href="{{url('/cms-admin/alltype-user/diseases')}}" aria-expanded="false">
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
                                        <!-- <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
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
                                        </div> -->
                                        <div class="row">
                                            <div class="col-xl">
                                                <div class="card mb-4">
                                                    <div class="card-header d-flex justify-content-between align-items-center doc-back">
                                                        <p class="mb-0">Doctor Listing</p>
                                                    </div>
                                                    <div class="card card-body admin-doc-card1">
                                                        <form id="searchform" action="{{url('/cms-admin/alltype-user/doctor')}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <p class="admin-doc-card1-text1">FROM DATE</p>
                                                                <p>
                                                                    <input type="date" class="form-control" name="from_date">
                                                                </p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <p class="admin-doc-card1-text1">TO DATE</p>
                                                                <input type="date" class="form-control" name="to_date">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <p class="admin-doc-card1-text1">LOCATION</p>
                                                                <select class="form-control select-admin-control1" name="location">
                                                                    <option value="">Select Location</option>
                                                                    <option value="">Bhubaneswar</option>
                                                                    <option value="">Cuttack</option>
                                                                    <option value="">Puri</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-md-3  ">
                                                                <p>
                                                                    <button type="submit" name="searchsubmit" value="search" class="btn btn-search">SEARCH</button>
                                                                    <a href="" class="btn btn-clear">CLEAR</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-12">

                                                        <a href="{{url('/cms-admin/alltype-user/doctor/add')}}" class="btn btn-add">Add Doctor</a>
                                                    </div>
                                                    <div class="card-body" style="padding-top: 30px;">
                                                        <div class="table-responsive ">
                                                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                                <!-- <div class="row">
                                                                    <div class="col-sm-12 col-md-6">
                                                                        <div class="dataTables_length" id="example_length"><label>Show <select name="example_length" aria-controls="example" class="custom-select custom-select-sm form-control form-control-sm">
                                                                                    <option value="10">10</option>
                                                                                    <option value="25">25</option>
                                                                                    <option value="50">50</option>
                                                                                    <option value="100">100</option>
                                                                                </select> entries</label></div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-6">
                                                                        <div id="example_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example"></label></div>
                                                                    </div>
                                                                </div> -->
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <table class="table table-hover table-bordered display dataTable no-footer" id="example" aria-describedby="example_info">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="sl-pd sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Sl. No#: activate to sort column descending" style="width: 64.4375px;">Sl. No#</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Dr. Name: activate to sort column ascending" style="width: 110.812px;">Full Name</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Dr. Designation: activate to sort column ascending" style="width: 146.953px;">Department</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending" style="width: 136.375px;">Designation</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending" style="width: 136.375px;">Total Experience</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date of Entry: activate to sort column ascending" style="width: 125.953px;">Location</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 147.859px;">Status</th>
                                                                                    <th class="ac-pd sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 79.4219px;">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @php $n = 1; @endphp
                                                                                @forelse($data as $key=>$value)
                                                                                <tr class="odd">
                                                                                    <td class="sorting_1">{{ $n++}}</td>
                                                                                    <td title="{{  $value->full_name }}">
                                                                                        {{ $value->full_name}}
                                                                                    </td>
                                                                                    <td>{{ $value->department }}</td>
                                                                                    <td title="{{  $value->designation }}">{{ $value->designation }}</td>
                                                                                    <td>{{ $value->total_experience }}</td>
                                                                                    <td>{{ $value->location }}</td>
                                                                                    <td>
                                                                                        @if(@$value->status==1)
                                                                                        <button class="btn btn-doc-veri">Verified&nbsp;<i class="fa fa-check-circle-o"></i></button><br>
                                                                                        @elseif(@$value->status==0)
                                                                                        <a href=""> <button class="btn btn-doc-veri-no">Unverified&nbsp;<i class="fa fa-times-circle"></i></button></a>
                                                                                        @elseif(@$value->status==2)
                                                                                        <a href=""> <button class="btn btn-doc-veri-pen">Pending&nbsp;<i class="fa fa-ellipsis-h"></i></button>
                                                                                        </a>
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>
                                                                                        <form action="{{url('cms-admin/alltype-user/doctor/doctorVeryfiyOtp')}}" enctype="multipart/form-data" method="POST" id="docotpform">
                                                                                        @csrf
                                                                                        <input hidden value="{{$value->full_name}}"  type="text"  name="name" id="name" />
                                                                                        <input hidden  value="{{$value->mobile}}" type="text" name="mobile" id="mobile" />
                                                                                        <input hidden  type="text"  value="{{$value->email}}" name="email" id="email" />
                                                                                        <button  type="button" class="btn btn-doc-view open-AddBookOtp" id="submit-data" data-id="{{$value->id}}" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa fa-eye"></i>&nbsp; </button>
                                                                                         </form>
                                                                                        <a class="btn btn-doc-edit" href="{{ url('/cms-admin/alltype-user/doctor/edit/'.$value->id) }}" role="button"><i class="fas fa-edit"></i>&nbsp;</a>
                                                                                        <!-- <button class="btn btn-doc-veri-dlt" data-bs-toggle="modal" data-bs-target="#myModaldlt"><i class="fa fa-trash"></i>&nbsp;</button> -->
                                                                                        <a class="btn btn-doc-veri-dlt" href="{{ url('/cms-admin/alltype-user/doctor/delete/'.$value->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                                <!-- <tr class="even">
                                                                                    <td class="sorting_1">02</td>
                                                                                    <td>Dr. Pratik Das</td>
                                                                                    <td>Neurologist</td>
                                                                                    <td>Cuttack, 754321</td>
                                                                                    <td>21.08.2023</td>
                                                                                    <td>
                                                                                        <a href=""> <button class="btn btn-doc-veri-no">Unverified&nbsp;<i class="fa fa-times-circle"></i></button></a>
                                                                                    </td>
                                                                                    <td>
                                                                                        <a href=""><button class="btn btn-doc-view"><i class="fa fa-eye"></i>&nbsp; </button></a>
                                                                                        <a href=""><button class="btn btn-doc-edit"><i class="fa fa-edit"></i>&nbsp; </button></a>
                                                                                        <a href=""><button class="btn btn-doc-veri-dlt"><i class="fa fa-trash"></i>&nbsp;</button></a>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="odd">
                                                                                    <td class="sorting_1">03</td>
                                                                                    <td>Dr. Pratik Das</td>
                                                                                    <td>Neurologist</td>
                                                                                    <td>Cuttack, 754321</td>
                                                                                    <td>21.08.2023</td>
                                                                                    <td>
                                                                                        <a href=""> <button class="btn btn-doc-veri-pen">Pending&nbsp;<i class="fa fa-ellipsis-h"></i></button>
                                                                                        </a>
                                                                                    </td>
                                                                                    <td>
                                                                                        <a href=""><button class="btn btn-doc-view"><i class="fa fa-eye"></i>&nbsp; </button></a>
                                                                                        <a href=""> <button class="btn btn-doc-edit"><i class="fa fa-edit"></i>&nbsp; </button></a>
                                                                                        <a href=""> <button class="btn btn-doc-veri-dlt"><i class="fa fa-trash"></i>&nbsp;</button></a>
                                                                                    </td>
                                                                                </tr> -->
                                                                                @empty
                                                                                @endforelse
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="row">
                                                                    <div class="col-sm-12 col-md-5">
                                                                        <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 1 to 4 of 4 entries</div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-7">
                                                                        <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                                                                            <ul class="pagination">
                                                                                <li class="paginate_button page-item previous disabled" id="example_previous"><a aria-controls="example" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link">Previous</a></li>
                                                                                <li class="paginate_button page-item active"><a href="#" aria-controls="example" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                                                                <li class="paginate_button page-item next disabled" id="example_next"><a aria-controls="example" aria-disabled="true" role="link" data-dt-idx="next" tabindex="-1" class="page-link">Next</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Modal start of view button-->
                                        <!-- The Modal -->
                                        <div class="modal" id="myModal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    <!-- Modal body -->
                                                    <form action="{{ url('/cms-admin/alltype-user/ViewDoctor') }}" id="formsubmitopt" method="POST" >
                                                       @csrf
                                                        <div class="modal-body">
                                                            <p class="admin-modal-text1">Your OTP has been sent to register email address admin@mymedicalmate.com</p>

                                                            <p class="admin-modal-text1">Please Enter the five digit of OTP in below box</p>
                                                            <div class="verification-code">
                                                                <div class="from-group">
                                                                    <input type="text" class="form-controller" name="otp" />
                                                                    <!-- <input type="text" maxlength="1" name="otp" />
                                                                    <input type="text" maxlength="1" name="otp" />
                                                                    <input type="text" maxlength="1" name="otp" />
                                                                    <input type="text" maxlength="1" name="otp" />
                                                                    <input type="text" maxlength="1" name="otp" /> -->

                                                                </div>
                                                                <input type="hidden" id="verificationCode" name="verifyCode" value="" />
                                                            </div>
                                                            <center><button  type="button" id="submitopt" class="btn btn-success">Submit</button>></center>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Modal end of view button-->
                                        <!--Modal start of edit button-->
                                        <!-- The Modal -->
                                        <div class="modal" id="myModaledit">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <p class="admin-modal-text1">Your OTP has been sent to register email address admin@mymedicalmate.com</p>

                                                        <p class="admin-modal-text1">Please Enter the five digit of OTP in below box</p>
                                                        <div class="verification-code">

                                                            <div class="verification-code--inputs">
                                                                <input type="text" maxlength="1" />
                                                                <input type="text" maxlength="1" />
                                                                <input type="text" maxlength="1" />
                                                                <input type="text" maxlength="1" />
                                                                <input type="text" maxlength="1" />

                                                            </div>
                                                            <input type="hidden" id="verificationCode"  />
                                                        </div>
                                                        <center><a href="" class="btn btn-success">Submit</a></center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Modal end of edit button-->

                                        <!--Modal start of delete button-->
                                        <!-- The Modal -->
                                        <div class="modal" id="myModaldlt">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>


                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <p class="admin-modal-text1">Your OTP has been sent to register email address admin@mymedicalmate.com</p>

                                                        <p class="admin-modal-text1">Please Enter the five digit of OTP in below box</p>
                                                        <div class="verification-code">

                                                            <div class="verification-code--inputs">
                                                                <input type="text" maxlength="1" />
                                                                <input type="text" maxlength="1" />
                                                                <input type="text" maxlength="1" />
                                                                <input type="text" maxlength="1" />
                                                                <input type="text" maxlength="1" />

                                                            </div>
                                                            <input type="hidden" id="verificationCode" />
                                                        </div>
                                                        <center><a href="" class="btn btn-success">Submit</a></center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Modal end of delete button-->

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
                                                            <a href="{{ url('/cms-admin/alltype-user/hospital/delete/'.$value->id) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                                        </td>
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
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    new DataTable('#example');
</script> 
<script>
    // $(document).on('click', '#submit-data', function(e){ 
    //     e.preventDefault();
    //    // let url = "{{url('cms-admin/alltype-user/doctorVeryfiyOtp')}}";
    //     //alert(abd); submit-data
       
    //   // var $form = $(this);
    //   var submit = $( 'button[id=submit-data]' );
    //    var form = $("#docotpform");
    //    var url = form.attr('action');
    //    var methord = form.attr('method');
    //     // Get form fields
    //     //var hostname = $(location).attr('origin')+'/alltype-user/doctorVeryfiyOtp';
    //     var data = form.serializeArray(), obj = {}, j = 0;
    //     for( var i = 0; i < data.length; i++ )
    //     {
    //         //alert(obj[data[i].name] = data[i].value);
    //       if( data[i].name in obj )                                                                  
    //       {
    //         var key = data[i].name + '_' + j;
    //         obj[key] = data[i].value;
    //         j++;
    //       }
    //       else
    //       {
    //         obj[data[i].name] = data[i].value;
    //       }
    //     };

    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         type:methord,
    //          url:url,
    //         //url: hostname,
    //         //data: form.serialize(),
    //         data: 'submit-data=' + JSON.stringify( obj ),
    //         success: function(data){
    //             //console.log(respone) ;
    //             if (data.code === 200) {
    //             $("#myModal").modal('show');
    //             alert("Form Submited Successfully");
    //             }
    //         }
    //     });
    // });
</script> 
<script>
$(document).ready(function() {
    $(document).on('click', '#submit-data', function(e){ 
        e.preventDefault();
       // var form = $("#docotpform");
        let form = $(this).closest('#docotpform');

        // var inputs = $('#docotpform');
        // if (input.length === 0) {
        //     //show input error on the form
        // }
        // var data = {}
        // inputs.each(function (i, input) {
        //     var elem = $(input);

        //     data['name' + i] = elem.find('[id="name' + i +'"]').val();
        //     data['email' + i] = elem.find('[id="email' + i +'"]').val();
        //     data['mobile' + i] = elem.find('[id="mobile' + i +'"]').val();
        // });
        //alert(form.attr("form[id=docotpform]"))
        let name = form.find("input[name=name]").val();
        let email = form.find("input[name=email]").val();
        let mobile = form.find("input[name=mobile]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let urldecode ="{{url('cms-admin/alltype-user/doctor/doctorVeryfiyOtp')}}";
        var url = form.attr("action");
        alert();
        $.ajax({
            type:"POST",
            url:url,
           // data:{name: full_name, mobile: doctor_mobile, email: doctor_email},
           // data   : $('form[id=docotpform]').serialize(),
           //data: data,
           data:{
            name:name,
            email:email,
            mobile :mobile,
            _token: _token,
             },
             formElement:form,
            success: function(respone){
                console.log(respone);
                $("#myModal").modal('show');
                alert("Form Submited Successfully"); 
            }
        });
    });
});
$(document).ready(function(){
    $(document).on('click','#submitopt',function(e){
        e.preventDefault();
        //var form = $(this).closest('#formsubmitopt'); {{ url('/cms-admin/alltype-user/ViewDoctor/') }}
        // var form = $("#formsubmitopt");
        // var url=form.attr('action');
        // var merhord = form.attr('method');
        var form = $(this).closest('#formsubmitopt');
        //var url=form.attr('action');
        //var method = form.attr('method');
        let verifyId = form.find("input[name=verifyCode]").val();
        let otp = form.find("input[name=otp]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type:"POST",
            url:"{{ url('/cms-admin/alltype-user/doctor/ViewDoctor/') }}",
            //data:form.serialize(),
            data:{
            otp:otp,   
            verifyId :verifyId,
            _token: _token,
             },
             formElement:form,
            success: function(data){
                //alert(data);
                if(data.code == 204){
                    //$("#subscribe_result").html(result.error); 
                    alert("please enter correct OTP"); 
                }
                else{
                    window.location = "{{ url('/cms-admin/alltype-user/doctorview/edit/') }}/"+verifyId;
                    //location.window.href = "redirect user to the thank you page";
                }

            }
        });

    });
});
$(document).ready(function () {
    $(".open-AddBookOtp").click(function () {
       // let user_id   =  $('#verificationCode').val($(this).data('id'));
        var user_id = $(this).data('id');
		$(".modal-body #verificationCode").val( user_id );
         //alert(user_id);
        $('#myModal').modal('show');
    });
});  
</script>  
@endsection