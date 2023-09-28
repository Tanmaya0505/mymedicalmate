<header id="myHeader">
    <div class="container">
        <div class="row">
            <div class="col-4 col-lg-3 logo">
                <a href="{{ url('/') }}"><img src="{{ asset('frontend-source/images/logo.svg') }}" style="width:160px;" alt="My Medical Mate" title="My Medical Mate"></a>
            </div>
            <div class="d-none d-lg-block d-lg-none col-md-6 col-lg-6 text-center">
                <div class="d-flex justify-content-around top-nav">
                    <a href="{{ url('/') }}">
                        <i class="fal fa-home"></i>
                        <span>Home</span>
                    </a>

                    <a @if(Session::get('userId')) href="{{ url('/upload-prescription') }}" @else href="javascript:void(0)" data-toggle="modal" data-target="#staticBackdrop" @endif>
                        <i class="fal fa-file-prescription"></i>
                        <span>Prescription</span>
                    </a>

                    <a href="{{ url('/medical-mate') }}">
                        <i class="fal fa-users"></i>
                        <span>Medical Mate</span>
                    </a>

                    <a href="@if(Session::get('userId')) {{ url(accountPrefix().'/my-profile') }} @else {{ url('/login') }} @endif">
                        <i class="fal fa-user-circle"></i>
                        <span>My Account</span>
                    </a>
                </div>
            </div>
            <div class="mb-vsbl-nv col-8 col-lg-3 d-flex align-content-center justify-content-end">
                <ul class="list-inline mb-0">
                    @if(Session::get('userId'))
                    <li><a href="javascript:void(0);" class="hl-btn"><i class="fas fa-bell"></i></a></li>
                    <li><a href="javascript:void(0);" class="hl-btn" id="menu-toggle"><i class="fas fa-bars"></i></a></li>
                    @else
                    <li><a href="{{ url('/sign-up') }}" class="hl-btn"><i class="fas fa-user"></i></a></li>
                    <li><a href="{{ url('/login') }}" class="hl-btn"><i class="fas fa-sign-in-alt"></i></a></li>
                    @endif
                </ul>
            </div>
            @if(Session::get('userId'))
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <a id="menu-close" href="#" class="btn btn-default btn-lg pull-right toggle"><i class="far fa-window-close"></i></a>
                    @if(!empty($frontendSourceMenuData[Session::get('accountId') - 1]) && isset($frontendSourceMenuData[Session::get('accountId') - 1]))
                    @foreach ($frontendSourceMenuData[Session::get('accountId') - 1]->menu as $menu)
                    @if(isset($menu->frontend))
                    <li><a href="@if(isset($menu->url)){{asset($menu->url)}} @endif"><i class="far fa-user-alt"></i> {{$menu->name}}</a></li>
                    @endif
                    @endforeach
                    @endif
                    <li><a href="{{ url('/logout') }}"><i class="far fa-sign-out"></i> Log out</a></li>
                </ul>
            </div>
            @endif
            <div class="clearfix"></div>
        </div>
    </div>
</header>
<div class="search-bar">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                <div class="input-group search">
                    <input type="text" class="form-control" placeholder="Search here...">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="load-container">
    <div class="load-wrap">
        <div class="loading">
            <div class="bounceball"></div>
            <div class="load-text">SITE LOADING</div>
        </div>
    </div>
</div>  -->