<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Login | Baby Health Care</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('dashboard/assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('dashboard/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('dashboard/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('dashboard/assets/css/app-rtl.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    {{--  google fonts  --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>




    <style>
        body{
            font-family: 'Cairo', sans-serif;
        }
    </style>





</head>

<body>


<div class="home-btn d-none d-sm-block">
    <a href="{{route('dashboard')}}" class="text-dark"><i class="fas fa-home h2"></i></a>
</div>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-login text-center">
                        <div class="bg-login-overlay"></div>
                        <div class="position-relative">
                            <h5 class="text-white font-size-20">مرحبا بعودتك !</h5>
                            <p class="text-white-50 mb-0">يمكنك التسجيل لتمكن من الدخول الى لوحة التحكم.</p>
                            <a href="{{route('dashboard')}}" class="logo logo-admin mt-4">
                                <img src="{{asset('dashboard/assets/images/logo-sm-dark.png')}}" alt="" height="30">
                            </a>
                        </div>
                    </div>
                    <div class="card-body pt-5">
                        <div class="p-2">
                            <form class="form-horizontal" action="{{url('login')}}"method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="email">الايميل</label>
                                    <input type="email" class="form-control"name="email" id="email" placeholder="ادخل الايميل">
                                </div>

                                <div class="form-group">
                                    <label for="userpassword">كلمة المرور</label>
                                    <input type="password" class="form-control"name="password" id="userpassword" placeholder="ادخل كلمة المرور">
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline">تذكرني</label>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">تسجيل دخول</button>
                                </div>

                                <div class="mt-4 text-center">
                                    <a href="{{route('password.forget')}}" class="text-muted"><i class="mdi mdi-lock mr-1"></i> هل نسيت كلمة المرور ؟</a>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>© 2023 Baby health care <i class="mdi mdi-heart text-danger"></i> by Elgwile</p>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="{{asset('dashboard/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/node-waves/waves.min.js')}}"></script>

<script src="{{asset('dashboard/assets/js/app.js')}}"></script>

<script>
    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.success("{{ session('success') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    @endif





</script>
</body>

</html>
