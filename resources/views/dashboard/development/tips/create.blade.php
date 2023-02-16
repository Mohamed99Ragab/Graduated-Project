@extends('dashboard.layouts.master')
@section('title')
    اضافة ملاحظات
@endsection

@section('css')

@endsection


@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">اضافة ملاحظة</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item active">اضافة ملاحظة</li>
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


{{--                    @if ($errors->any())--}}

{{--                        <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                            <ul>--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        --}}
{{--                    @endif--}}




                    <form action="{{route('tips.store')}}"method="post">

                        @csrf


                        <label class="control-label" for="questions">حدد الاسئلة :</label>
                        <br><br>
                        @foreach($questions as $question)

                        <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox"name="question_ids[]"value="{{$question->id}}"id="{{$question->id}}"class="custom-control-input">

                                <label for="{{$question->id}}"class="custom-control-label">{{$question->question}}</label>
                                <strong>
                                    <span class="badge badge-success">العمر بالشهور: {{$question->age_stage}}</span>
                                </strong>
                                <br><br>
                        </div>
                        @endforeach




                        <div class="form-group">
                            <label  class="control-label" for="tips">ادخل الملاحظة </label>
                            <textarea name="description" class="form-control"cols="4"rows="6" placeholder="اكتب هنا النصائح التى تريدها"></textarea>
                        </div>


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
