@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Dashboard Ecommerce')
{{-- vendor css --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-ecommerce.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/autocompletecustom.css')}}">
<style type="text/css">
  .tree {
    min-height:20px;
    padding:19px;
    margin-bottom:20px;
    background-color:#fbfbfb;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
}
.tree li {
    list-style-type:none;
    margin:0;
    padding:10px 5px 0 5px;
    position:relative
}
.tree li::before, .tree li::after {
    content:'';
    left:-20px;
    position:absolute;
    right:auto
}
.tree li::before {
    border-left:1px solid #999;
    bottom:50px;
    height:100%;
    top:0;
    width:1px
}
.tree li::after {
    border-top:1px solid #999;
    height:20px;
    top:30px;
    width:25px
}
.tree li span {
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border:1px solid #999;
    border-radius:5px;
    display:inline-block;
    padding:3px 8px;
    text-decoration:none
}
.tree li.parent_li>span {
    cursor:pointer
}
.tree>ul>li::before, .tree>ul>li::after {
    border:0
}
.tree li:last-child::before {
    height:30px
}
.tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
    background:#eee;
    border:1px solid #94a0b4;
    color:#000
}
</style>
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
    <div class="row">
      <div class="col-xl-12 col-12 dashboard-users">
       
          <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
              <form class="card card-sm">
                <div class="card-body row no-gutters align-items-center">
                  <!-- <div class="col-auto">
                    <i class="fas fa-search h4 text-body"></i>
                  </div> -->
                                  <!--end of col-->
                  <div class="col">
                    <input class="form-control form-control-lg form-control-borderless"  id="myInput" type="search" placeholder="Search Customer Name">
                    <input  name="id" id="searchinput" type="hidden" >
                  
                  </div>
                                  <!--end of col-->
                  <div class="col-auto">
                    <button class="btn btn-lg btn-success" type="submit">Search</button>
                  </div>
                                  <!--end of col-->
                </div>
              </form>
            </div>
          </div>
     <div class="row  ">
          <!-- Statistics Cards Starts -->
          <div id="collapseDVR3" class="panel-collapse collapse in show">
              <div class="tree ">
                  <ul>
                      <li> <span><i class="fa fa-folder-open"></i> {{$customer->full_name}} </span> 
                          <ul>
                            @forelse($customer->firstchilds as $user)
                              <li>  <span><i class="fa fa-minus-square"></i>
                                <a href="{{url('/cms-admin/referal-management?id='.$user->customer->id)}}">{{$user->customer->full_name}}</a></span> 
                                @if($user->customer->firstchilds)
                                   
                                    <ul>
                                      @forelse($user->customer->firstchilds as $child)
                                        <li> <span> <a href="{{url('/cms-admin/referal-management?id='.$child->customer->id)}}">{{$child->customer->full_name}}</a> </span> </li>
                                    
                                      @empty
                                      @endforelse
                                    </ul>
                                @endif
                              </li>
                            @empty
                            @endforelse
                              <!-- <li>  <span><i class="fa fa-minus-square"></i> другая </span>
                                  <ul>
                                      <li> <span> Менюшка </span></li>
                                      <li>  <span><i class="fa fa-minus-square"></i> Менюшка</span>
                                          <ul>
                                              <li> <span><i class="fa fa-minus-square"></i> Менюшка</span>
                                                  <ul>
                                                      <li> <span> Менюшка</span></li>
                                                      <li> <span> Менюшка</span></li>
                                                  </ul>
                                              </li>
                                              <li> <span> Менюшка</span> </li>
                                              <li> <span> Менюшка</span> </li>
                                          </ul>
                                      </li>
                                      <li> <span> Менюшка</span></li>
                                  </ul>
                              </li> -->
                          </ul>
                      </li>
                      <!-- <li> <span><i class="fa fa-folder-open"></i> Менюшка2</span>
                          <ul>
                              <li>  <span> Менюшка</span> </li>
                          </ul>
                      </li> -->
                  </ul>
              </div>
          </div>

          <!-- Revenue Growth Chart Starts -->
        </div>
      </div>
    </div>

</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-scripts')
<!-- <script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script> -->
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/pages/dashboard-ecommerce.js')}}"></script>
<script src="{{asset('js/scripts/pages/autocompletecustom.js')}}"></script>
<script type="text/javascript">
   $(function () {
      $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
      $('.tree li.parent_li > span').on('click', function (e) {
          var children = $(this).parent('li.parent_li').find(' > ul > li');
          if (children.is(":visible")) {
              children.hide('fast');
              $(this).attr('title', 'Expand this branch').find(' > i').addClass('fa-plus-square').removeClass('fa-minus-square');
          } else {
              children.show('fast');
              $(this).attr('title', 'Collapse this branch').find(' > i').addClass('fa-minus-square').removeClass('fa-plus-square');
          }
          e.stopPropagation();
      });
  });

</script>
@endsection

