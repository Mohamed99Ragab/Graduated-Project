@extends('dashboard.layouts.master')
@section('title')
    تحرير الملف الشخصي
@endsection

@section('css')


@endsection


@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">تحديث الحساب</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item active">تحرير الملف الشخصي</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{url('update-profile')}}"method="post"enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="username">الاسم:</label>
                                    <input type="text"class="form-control"name="username" value="{{$admin->username}}" id="username">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="email">الايميل:</label>
                                    <input type="email"class="form-control"value="{{$admin->email}}" name="email"id="email">
                                    <input type="hidden"value="{{$admin->id}}" name="admin_id">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="password">الباسورد:</label>
                            <input type="password"class="form-control"name="password"id="password">
                        </div>

                        <div class="form-group">
                            <label for="photo">ارفق صورة الحساب:</label>
                            <br>
                            @if(isset($admin->photo))
                                <image src="{{asset('images/admins/'.$admin->photo)}}"class="avatar-md rounded-circle"></image>
                            @endif
                            <br><br>
                            <input type="file"class="form-control-file"name="photo"id="photo">
                        </div>
                        <br>
                        <input type="submit"class="btn btn-primary">

                    </form>






                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->




@endsection


@section('js')

@endsection
