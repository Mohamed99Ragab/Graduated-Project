<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
{{--            @if(isset(auth()->guard('admin')->user()->photo))--}}
{{--                <div class="user-img">--}}
{{--                    <img src="{{asset('images/admins/'.auth()->guard('admin')->user()->photo)}}" alt="" class="avatar-md mx-auto rounded-circle">--}}
{{--                </div>--}}
{{--            @else--}}
{{--            <div class="user-img">--}}
{{--                <img src="{{asset('dashboard/assets/images/users/avatar-2.jpg')}}" alt="" class="avatar-md mx-auto rounded-circle">--}}
{{--            </div>--}}
{{--            @endif--}}
                <div class="user-img">
                    <img src="{{asset('dashboard/assets/images/users/avatar-2.jpg')}}" alt="" class="avatar-md mx-auto rounded-circle">
                </div>
            <div class="mt-3">

                <a href="#" class="text-dark font-weight-medium font-size-16">Baby Health Care</a>
                <p class="text-body mt-1 mb-0 font-size-13">نظام ادارة الرعاية الصحية للطفل</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{url('home')}}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
{{--                        <span class="badge badge-pill badge-info float-right">2</span>--}}
                        <span style="font-family: 'Cairo', sans-serif">لوحة التحكم</span>
                    </a>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>متابعة التطور</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('subjects.index')}}">مواضيع الاسئلة</a></li>
                        <li><a href="{{route('questions.index')}}">الاسئلة</a></li>
                        <li><a href="{{route('tips.index')}}">الملاحظات</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-briefcase-medical"></i>
                        <span>التطعيمات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('vaccinations.index')}}">قائمة التطعيمات</a></li>
                        <li><a href="{{route('vaccinations.create')}}">اضافة تطعيم جديد</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{url('teeths')}}" class="waves-effect">
                        <i class="fa fa-thin fa-tooth"></i>
                        <span >الاسنان</span>
                    </a>

                </li>


                <li>
                    <a href="{{url('reviews')}}" class="waves-effect">
                        <i class="mdi mdi-star"></i>
                        <span >المراجعات</span>
                    </a>

                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
