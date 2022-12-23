<!doctype html>
<html lang="en">

@include('dashboard.layouts.head')
@yield('css')

<body data-layout="detached" data-topbar="colored">

<div class="container-fluid">
    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('dashboard.layouts.header')
        <!-- Right Sidebar -->
        @include('dashboard.layouts.sidebar')
        <!-- /Right-bar -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">

                @yield('content')

            </div>
            <!-- End Page-content -->

            @include('dashboard.layouts.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

</div>
<!-- end container-fluid -->

{{--@include('dashboard.layouts.setting')--}}


<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
@include('dashboard.layouts.scripts')

@yield('js')

</body>

</html>
