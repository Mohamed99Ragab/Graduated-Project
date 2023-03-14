@extends('dashboard.layouts.master')
@section('title')
    اضافة تطعيم جديد
@endsection

@section('css')


@endsection


@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">اضافة تطعيم</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('vaccinations.index')}}">التطعيمات</a></li>
                        <li class="breadcrumb-item active">اضافة تطعيم</li>
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


                    <form action="{{route('vaccinations.store')}}"method="post"enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="name">اسم التطعيم :</label>
                                    <input type="text"name="name" class="form-control" id="name"value="{{old('name')}}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="syringe">عدد الحقن:</label>
                                    <input type="number"name="number_syringe" class="form-control" id="syringe"value="{{old('number_syringe')}}">
                                </div>
                            </div>



                            <div class="col">
                                <div class="form-group">
                                    <label for="age">المرحلة العمرية بالشهور: </label>
                                    <input type="number"name="vaccine_age" class="form-control" id="age"value="{{old('vaccine_age')}}">
                                </div>
                            </div>


                        </div>



                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label>تعريف التطعيم : </label>
                                    <textarea cols="4"rows="6" class="form-control"name="about">{{old('about')}}</textarea>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>الوقاية من المرض : </label>
                                    <textarea cols="4"rows="6" class="form-control"name="disease_prevention">{{old('disease_prevention')}}</textarea>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>آثار جانبية : </label>
                                    <textarea cols="4"rows="6" class="form-control"name="side_effects">{{old('side_effects')}}</textarea>
                                </div>
                            </div>




                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">حالة التطعيم :</label>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" value="1" id="customRadio1" name="important" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">مهم</label>
                                    </div>

                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio"value="0" id="customRadio2" name="important" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">غير مهم</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">ارفق صورة التطعيم :</label>
                                    <input type="file"name="image" class="form-control-file" id="exampleFormControlFile1">
                                </div>
                            </div>
                        </div>


                        <br>

                        <button type="submit" class="btn btn-primary">حفظ</button>
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
