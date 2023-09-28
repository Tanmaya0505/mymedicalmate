@extends('frontend-source.layouts.master')
@section('title') Listing Assistant @stop
@section('keywords') Listing Assistant @stop
@section('description') Listing Assistant @stop
@section('style')
@endsection
@section('content')
<section class="assistant-slider">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                <div class="text-center wow fadeInDown">
                    <h2 class="center mb30">Examination Post filed Listings</h2>
                </div>
                <div class="card mb20 search-filter">
                    <div class="card-header bg-secondary text-white"><strong><i class="fas fa-sort"></i> Advance Search</strong>
                        <span id="filter-btn"><i class="fas fa-bars"></i></span>
                    </div>
                    <div class="card-body" id="filter-content">
                        <form method="GET" action="">
                            
                            
                            <div class="form-group">
                                <label for="id1">Name of Exam</label>
                                <input class="form-control" type="text"
                                    id="id1" name="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="id2">Experience</label>
                                <input class="form-control" type="text"
                                    id="id2" name="experience" placeholder="Enter Experience">
                            </div>
                            <div class="form-group">
                                <label for="id2">Department</label>
                                <input class="form-control" type="text"
                                    id="id2" name="department" placeholder="Enter Department">
                            </div>
                            
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-primary">Apply</button>
                                <a href="" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
                    </div>
                </div>
                <div class="assistant-box-container slider">
                    <div class="row">
                    @if(count($data))
                        @foreach($data as $key=>$val)
                        @php
                            $meta = json_decode($val->meta, true);
                            $data = \App\Helpers\CustomerHelper::decodeAssistantData($meta);
                            $photo =  asset('frontend-source/images/assistant-boy-icon.png');
                            if($val->profile_picture){
                                $photo = url($val->profile_picture);
                            }
                        @endphp
                    <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="box-item">
                        <table>
                            <tr class="hl-header">
                                <td style="width:40%;" class="text-left">
                                    <span class="verified">Examination Post filed <i class="fas fa-check-circle"></i></span>
                                </td>
                                <td style="width:70%;" class="text-right" class="pickup">
                                   
                                </td>
                            </tr>
                                <tr class="ast-bx-flex">
                                    <td class="ast-img">
                                    <div class="item-image">
                                        <a href="{{ url('/exams/detail/'.urlencode($val->full_name)) }}">
                                            <img src="{{ $photo }}" class="img-fluid" alt="">
                                        </a>
                                        <!-- <span>Exp: {{ @$val->total_experience }} Yrs</span> -->
                                    </div>
                                </td>
                                    <td class="ast-dtl">
                                    <div class="item-detail">
                                            <ul>
                                                <li>Name of Exam: <Strong>{{ ucwords($val->full_name) }}</Strong></li>
                                                <li>Last date of Apply: <Strong>{{ date('d-m-Y',strtotime($val->last_date_of_apply)) }}</Strong></li>
                                                <li>Total Vacancy: <Strong>{{ $val->total_vacancy }}</Strong></li>
                                                <li>Exam Date: <Strong>{{ date('d-m-Y',strtotime($val->exam_date)) }}</Strong></li>
                                            </ul>
                                    </div>
                                </td>
                            </tr>
                                <tr>
                                <td class="text-left">
                                    
                                    <a class="primary-btn" href="#" >Share</a>
                                   
                                </td>
                                <td class="text-right">
                                    <a href="{{ url('/exams/detail/'.urlencode($val->full_name)) }}" class="primary-btn">View Details</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    </div>
                        @endforeach
                    @else
                    <h1>Sorry, no results found!</h1>
                    @endif



            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script src="{{ asset('frontend-source/js/medical-mate.js') }}" type="text/javascript" ></script>
<script>
$( "#filter-btn" ).click(function() {
    $('#filter-content').slideToggle();
});
</script>
@endpush
