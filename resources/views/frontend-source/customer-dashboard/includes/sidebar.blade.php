<div class="sidebar" data-image="{{ asset('frontend-source/myaccount/assets/img/sidebar-5.jpg') }}">

    <div class="sidebar-wrapper">

        <div class="logo">

            <a href="{{ url('/') }}" target="_blank" class="simple-text">{{ env('APP_NAME') }}</a>

        </div>

        <ul class="nav">

            @if(!empty($frontendSourceMenuData[Session::get('accountId') - 1]) && isset($frontendSourceMenuData[Session::get('accountId') - 1]))

            @foreach ($frontendSourceMenuData[Session::get('accountId') - 1]->menu as $menu)
            <?php 
            $accountmyprefix = strtolower(array_search(\Session::get('accountId'), \Config::get('constants.accountType')));
            //dd($accountmyprefix);
            $count_notify = \App\Notification::where('to_user_type',$accountmyprefix)->where('is_readed',0)->count(); ?>

                <li class="nav-item {{(request()->is($menu->url.'*')) ? 'active' : '' }}">

                    <a class="nav-link" href="@if(isset($menu->url)){{asset($menu->url)}} @endif">

                        @if(isset($menu->icon))

                            <i class="nc-icon {{$menu->icon}}"></i>

                            @if(isset($menu->name) && $menu->name == 'My Notifications')

                                <span class="notification">{{$count_notify}}</span>

                            @endif

                        @endif

                        @if(isset($menu->name))

                            <p>{{$menu->name}}</p>

                        @endif

                    </a>

                </li>

            @endforeach

            @endif

        </ul>

    </div>

</div>