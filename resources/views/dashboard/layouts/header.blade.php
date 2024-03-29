<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">

                <div class="dropdown d-inline-block d-lg-none ml-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-danger badge-pill ml-3">{{auth()->guard('admin')->user()->unreadNotifications->count()}}</span>
                        <i class="mdi mdi-bell-outline"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> الاشعارات </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="{{url('read-all')}}" class="small"> قراءة الكل</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                            @forelse(auth()->guard('admin')->user()->unreadNotifications as $notification)
                            <a href="" class="text-reset notification-item">
                                <div class="media">
                                    <div class="avatar-xs mr-3">
                                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                                        <i class="fas fa-star-half-alt"></i>
                                                    </span>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1">{{$notification->data['title']}}</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">{{$notification->data['body']}}</p>
{{--                                            @php--}}
{{--                                                $now = \Illuminate\Support\Carbon::now();--}}
{{--                                                $created_at = \Illuminate\Support\Carbon::parse($notification->created_at);--}}
{{--                                                $diffMinutes = $created_at->diffInMinutes($now)   // 180--}}
{{--                                            @endphp--}}
{{--                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{$diffMinutes}} دقائق من الزمن</p>--}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @empty
                                <p style="text-align: center">لا توجد اشعارات حتى الان</p>
                            @endforelse

                        </div>

                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(isset(auth()->guard('admin')->user()->photo))
                            <img class="rounded-circle header-profile-user" src="{{asset('images/admins/'.auth()->guard('admin')->user()->photo)}}" alt="Header Avatar">
                        @else
                        <img class="rounded-circle header-profile-user" src="{{asset('dashboard/assets/images/users/avatar-2.jpg')}}" alt="Header Avatar">
                        @endif
                        <span class="d-none d-xl-inline-block ml-1">{{auth()->guard('admin')->user()->username}}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item" href="{{url('edit-profile')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> تحديث الملف الشخصي</a>
                        <!--   <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{url('logout')}}"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>تسجيل خروج</a>
                    </div>
                </div>

{{--                <div class="dropdown d-inline-block">--}}
{{--                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">--}}
{{--                        <i class="mdi mdi-settings-outline"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}

            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                                    <span class="logo-sm">
                                        <img src="{{asset('dashboard/assets/images/logo-sm.png')}}" alt="" height="20">
                                    </span>
                        <span class="logo-lg">
                                        <img src="assets/images/logo-dark.png" alt="" height="17">
                                    </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                                    <span class="logo-sm">
                                        <img src="assets/images/logo-sm.png" alt="" height="20">
                                    </span>
                        <span class="logo-lg">
                                        <img src="assets/images/logo-light.png" alt="" height="19">
                                    </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-lg-inline-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="bx bx-search-alt"></span>
                    </div>
                </form>

            </div>

        </div>
    </div>
</header>
