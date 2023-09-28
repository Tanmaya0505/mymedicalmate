<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#pablo"> MY DASHBOARD </a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="nc-icon nc-circle-09"></i>  {{ (new \App\Helpers\CustomerHelper)->customerInfo(Session('userId'))->first_name.' '.(new \App\Helpers\CustomerHelper)->customerInfo(Session('userId'))->last_name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ url(accountPrefix().'/my-profile') }}"> My Profile</a>
                        <a class="dropdown-item" href="{{ url('/logout') }}"> Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>