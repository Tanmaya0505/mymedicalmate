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
            
            <h2 class="center mb30">Videos </h2>
               <br/>
            <!--bootstrap card with 3 horizontal images-->
            <div class="row">
                @if(count($data))
                        @foreach($data as $key=>$val)
                        @php
                            
                                $video = url($val->file_path);
                            
                        @endphp
                <div class="card col-md-4">
                    <button class="btn btn-lg video" data-video="{{$video}}" data-toggle="modal" data-target="#videoModal">Play Video</button>
  
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


<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <video controls width="100%">
            <source src="" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
<script src="{{ asset('frontend-source/js/medical-mate.js') }}" type="text/javascript" ></script>
<script>
$(function() {
  $(".video").click(function () {
    var theModal = $(this).data("target"),
        videoSRC = $(this).attr("data-video"),
        videoSRCauto = videoSRC + "";
    $(theModal + ' source').attr('src', videoSRCauto);
    $(theModal + ' video').load();
    $(theModal + ' button.close').click(function () {
      $(theModal + ' source').attr('src', videoSRC);
    });
  });
});
</script>
@endpush
