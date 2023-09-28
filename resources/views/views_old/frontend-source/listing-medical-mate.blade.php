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
                    <h2 class="center mb30">Profile Listings</h2>
                </div>
                <div class="card mb20 search-filter">
                    <div class="card-header bg-secondary text-white"><strong><i class="fas fa-sort"></i> Advance Search</strong>
                        <span id="filter-btn"><i class="fas fa-bars"></i></span>
                    </div>
                    <div class="card-body" id="filter-content">
                        <form method="POST" action="{{ url('medical-mate') }}">
                            @csrf
                            <div class="form-group">
                                <label class="sub-h"><i class="fas fa-rupee-sign"></i> Price</label>
                                <select class="form-control" name="day_charges">
                                    <option value="">Sort by: Featured</option>
                                    <option value="1" @if(isset($_REQUEST['day_charges']) && $_REQUEST['day_charges'] == 1 && $_REQUEST['day_charges'] != '') selected @endif>Price: Low to High</option>
                                    <option value="2" @if(isset($_REQUEST['day_charges']) && $_REQUEST['day_charges'] == 2 && $_REQUEST['day_charges'] != '') selected @endif>Price: High to Low</option>
                                </select>
                            </div>
                            <div class="form-group">
                            <label class="sub-h"><i class="fas fa-location"></i> Service Area</label>
                              <div class="form-check serv-area">
                                @foreach ($service_area as $key=>$val)
                                  <div class="w-auto">
                                    <input type="checkbox" name="service_area[]" class="form-check-input" id="servicearea_{{ $key+1 }}" value="{{ $key+1 }}" @if(isset($_REQUEST['service_area']) && is_array($_REQUEST['service_area']) && in_array($key+1, $_REQUEST['service_area'])) checked @endif>
                                    <label class="form-check-label" for="servicearea_{{ $key+1 }}">{{ $val['option_value'] }}</label>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="sub-h"><i class="fas fa-calendar-day"></i> Availability </label>
                                <div class="form-check">
                                  @foreach ($available_day as $key=>$val)
                                    <div class="w-auto">
                                      <input type="checkbox" name="available[]" class="form-check-input" id="availabledays_{{ $key+1 }}" value="{{ $key+1 }}" @if(isset($_REQUEST['available']) && is_array($_REQUEST['available']) && in_array($key+1, $_REQUEST['available'])) checked @endif>
                                      <label class="form-check-label" for="availabledays_{{ $key+1 }}">{{ $val['option_value'] }}</label>
                                    </div>
                                  @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="sub-h"><i class="fas fa-motorcycle"></i> Need Bike?  </label>
                                <select class="form-control" name="is_bike">
                                    <option value="">Need Bike?</option>
                                    <option value="1" @if(isset($_REQUEST['is_bike']) && $_REQUEST['is_bike'] == 1 && $_REQUEST['is_bike'] != '') selected @endif>Yes</option>
                                    <option value="2" @if(isset($_REQUEST['is_bike']) && $_REQUEST['is_bike'] == 2 && $_REQUEST['is_bike'] != '') selected @endif>No</option>
                                </select>
                            </div>
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-primary">Apply</button>
                                <a href="{{ url('/medical-mate') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
                    </div>
                </div>
                <div class="assistant-box-container slider">
                    <div class="row">
                    @if(count($assistant))
                        @foreach($assistant as $key=>$val)
                        @php
                            $meta = json_decode($val->meta, true);
                            $data = \App\Helpers\CustomerHelper::decodeAssistantData($meta);
                            $photo = asset('assistant/'. $data['photo']);
                            if(!file_exists(public_path('assistant/'. $data['photo']))){
                                $photo = asset('frontend-source/images/assistant-boy-icon.png');
                            }
                        @endphp
                    <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="box-item">
                        <table>
                            <tr class="hl-header">
                                <td style="width:40%;" class="text-left">
                                    <span class="verified">Medical Mate <i class="fas fa-check-circle"></i></span>
                                </td>
                                <td style="width:70%;" class="text-right" class="pickup">
                                    <img src="{{ asset('frontend-source/images/bike.png') }}" alt="">@if(isset($data['is_bike']) && $data['is_bike']) {{ $data['km_range'] }} @else {{ '00-00 KM' }} @endif
                                </td>
                            </tr>
                                <tr class="ast-bx-flex">
                                    <td class="ast-img">
                                    <div class="item-image">
                                        <a href="{{ url('/medical-mate/'.$val->id) }}">
                                            <img src="{{ $photo }}" class="img-fluid" alt="">
                                        </a>
                                        <span>Age: {{ $data['dob_year'] }} Yrs</span>
                                    </div>
                                </td>
                                    <td class="ast-dtl">
                                    <div class="item-detail">
                                            <ul>
                                                <li>Name: <Strong>{{ ucwords($data['first_name'].' '.$data['last_name']) }}</Strong></li>
                                                <li>From: <Strong>{{ $data['present_address'] }}</Strong></li>
                                                <li>Service Area: <Strong>{{ $data['service_area'] }}</Strong></li>
                                                <li>Service Charge: <Strong>{{ $data['day_charges'] }} Day | {{ $data['night_charges'] }} Night</Strong></li>
                                                <li>Avl. in Days: <Strong>{{ str_replace(',', ' | ', $data['available']) }}</Strong></li>
                                            <!--Rating: <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> 4.3 <br>-->
                                            </ul>
                                    </div>
                                </td>
                            </tr>
                                <tr>
                                <td class="text-left">
                                    @if(Session::get('userId') && Session::get('accountId') != Config::get('constants.accountType.assistant') && Session::get('accountId') != Config::get('constants.accountType.vendor'))
                                        <a class="primary-btn" href="{{ url('/book-medical-mate/'.$val->id) }}">Book Now</a>
                                    @elseif(Session::get('userId') && Session::get('accountId') == Config::get('constants.accountType.assistant') || Session::get('accountId') == Config::get('constants.accountType.vendor'))
                                        <a class="primary-btn" style="cursor: not-allowed;" href="javascript:void(0)">Book Now</a>
                                    @else
                                        <a class="primary-btn" href="javascript:void(0)" data-toggle="modal" data-target="#staticBackdrop">Book Now</a>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ url('/medical-mate/'.$val->id) }}" class="primary-btn">View Details</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    </div>
                        @endforeach
                    @else
                    <h1>Sorry, no results found!</h1>
                    @endif


<!--                <div class="center">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>-->
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
