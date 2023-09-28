@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Question Answar')
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
            <meta name="csrf-token" content="{{ csrf_token() }}">
                <!-- right content section -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                         aria-labelledby="account-pill-general" aria-expanded="true">
                                        
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/question-answar')}}">Back</a>
                                            
                                        </div>
                                        <div class="table-responsive">
                                            <form novalidate id="add_doctor" method="post" action="{{url('/cms-admin/question-answar/store')}}" enctype="multipart/form-data">    
                                            @csrf 
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Category Name</label>
                                                            <fieldset class="">
                                                                <select class="form-control" id="category_name" name="category_name">
                                                                <option value="Medicalmate">Medicalmate</option>
                                                                <option value="Clinic">clinic</option>
                                                                <option value="Vender">vender</option>
                                                                </select>
                                                                @if ($errors->has('category_name')) <span class="error" style="color:red">{{ $errors->first('category_name') }}</span> @endif
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Question</label>
                                                            <textarea required name="question" class="form-control @error('question') is-invalid @enderror" data-validation-required-message="This type field is required">
                                                            </textarea>
                                                            @if ($errors->has('question')) <span class="error" style="color:red">{{ $errors->first('question') }}</span> @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Answer</label>
                                                            <textarea  required name="answer" class="form-control @error('answer') is-invalid @enderror" data-validation-required-message="This type field is required">
                                                            </textarea>
                                                            @if ($errors->has('answer')) <span class="error" style="color:red">{{ $errors->first('answer') }}</span> @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Start Date</label>
                                                            <input type="date" required name="start_date" class="form-control @error('start_date') is-invalid @enderror" data-validation-required-message="This type field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>End Date</label>
                                                            <input type="date" required name="end_date" class="form-control @error('end_date') is-invalid @enderror" data-validation-required-message="This type field is required">
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Create</button>
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

@endsection
