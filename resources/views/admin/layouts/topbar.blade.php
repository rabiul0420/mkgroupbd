<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        {{-- <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
                            data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html" data-toggle="tooltip"
                        data-placement="top" title="Email"><i class="ficon" data-feather="mail"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-toggle="tooltip"
                        data-placement="top" title="Chat"><i class="ficon" data-feather="message-square"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-calendar.html"
                        data-toggle="tooltip" data-placement="top" title="Calendar"><i class="ficon"
                            data-feather="calendar"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html" data-toggle="tooltip"
                        data-placement="top" title="Todo"><i class="ficon" data-feather="check-square"></i></a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning"
                            data-feather="star"></i></a>
                    <div class="bookmark-input search-input">
                        <div class="bookmark-input-icon"><i data-feather="search"></i></div>
                        <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0"
                            data-search="search">
                        <ul class="search-list search-list-bookmark"></ul>
                    </div>
                </li>
            </ul>
        </div> --}}
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);"
                    data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span
                        class="badge badge-pill badge-danger badge-up">{{ App\Models\Notification::where('notification_for',Auth::user()->id)->where('read_status',false)->count() ?? 0 }}</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                            {{-- <div class="badge badge-pill badge-light-primary">6 New</div> --}}
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        @foreach (App\Models\Notification::where('notification_for',Auth::user()->id)->latest()->take(10)->get() as $data)
                            
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar"><img src="{{ asset('assets/common/images/bell.png') }}"
                                            alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">{{ $data->notification_text ?? '' }}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach

                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="{{ route('admin.notifications') }}">Read
                            all notifications</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                    id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{ strLimit(Auth::user()->name) }}</span><span class="user-status">
                        {{ Auth::user()->designation->name ?? 'User' }}</span></div><span class="avatar"><img
                            class="round" src="{{ asset(Auth::user()->image) }}" alt="avatar"
                            height="40" width="40"><span class="{{ Auth::user()->online_status == 1 ? 'avatar-status-online' : '' }}"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a class="dropdown-item"
                        href="{{ route("admin.profile") }}"><i class="mr-50" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="mr-50"
                            data-feather="power"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>