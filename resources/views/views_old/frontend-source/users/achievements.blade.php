@extends('frontend-source.layouts.master')
@section('title') Listing Assistant @stop
@section('keywords') Listing Assistant @stop
@section('description') Listing Assistant @stop
@section('style')
@endsection
@section('content')
<section class="assistant-slider">
    <div class="container">
        <div class="card-group">
            
            <h2 class="center mb30">Achievement & Award @if($name) of {{$name}}  @endif</h2>
               
            <!--bootstrap card with 3 horizontal images-->
            <div class="row">
                @if(count($data))
                        @foreach($data as $key=>$val)
                        @php
                            
                                $photo = url($val);
                            
                        @endphp
                <div class="card col-md-4">
                    <img class="card-img-top" src="{{$photo}}">
  
                    <!-- <div class="card-body">
                        <h3 class="card-title">Compare</h3>
                        <p class="card-text">JavaScript | Python</p>
                    </div> -->
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
