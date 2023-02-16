@extends('dashboard.layouts.master')
@section('title')
    الاسئلة
@endsection

@section('css')
    {{--     DataTables  --}}
    <link href="{{asset('dashboard/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection


@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">الاسئلة</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item active">الاسئلة</li>
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







                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#myModal">
                        أضافة  سؤال
                    </button>

                    <br><br>
                    <!-- store modal -->
                    <div id="myModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel"> اضافة الاسئلة</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">



                                    <form class="outer-repeater" action="{{route('questions.store')}}"method="post">
                                        @csrf

                                                    <div data-repeater-list="questions" >

                                                        <div data-repeater-item class="inner mb-3 row">

                                                            <div class="col-6">

                                                                <div class="form-group">
                                                                    <label for="question">السؤال :</label>
                                                                    <input type="text" name="question" class="inner form-control" id="question" placeholder="ادخل السؤال هنا...">
                                                                </div>

                                                            </div>

                                                            <div class="col align-self-center">

                                                                <div class="form-group">
                                                                    <label class="control-label"> موضوع السؤال :</label>
                                                                    <br>
                                                                    <select name="subject" class="form-control"style="height: 40px" >
                                                                        <option selected disabled>حدد موضوع السؤال </option>
                                                                        @foreach($subjects as $subject)
                                                                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>

                                                            <div class="col">

                                                                <div class="form-group">
                                                                    <label class="control-label">المرحلة العمرية بالشهور  :</label>
                                                                    <input type="number" name="age_stage" class="inner form-control">
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-2 align-self-center">
                                                                <input data-repeater-delete type="button" class="btn btn-danger btn-block" value="حذف" />
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <input data-repeater-create type="button" class="btn btn-primary inner" value="اضافة سؤال" />


                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">اغلاق</button>
                                                        <button type="submit" class="btn btn-success waves-effect waves-light">حفظ</button>
                                                    </div>
                                    </form>


                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /.modal -->


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>السؤال</th>
                            <th>موضوع السؤال</th>
                            <th> المرحلة العمرية للسؤال </th>
                            <th>العمليات</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$question->question}}</td>
                                <td>{{$question->subject->name}}</td>
                                <td>{{$question->age_stage}}</td>
                                <td>
                                    <button data-toggle="modal" data-target="#editModal{{$question->id}}" class="btn btn-primary btn-sm waves-effect waves-light">
                                        تعديل
                                        <i class="fa fa-edit m-1"></i>

                                    </button>

                                    <button data-toggle="modal" data-target="#deleteModal{{$question->id}}" class="btn btn-danger btn-sm waves-effect waves-light">
                                        حذف
                                        <i class="fa fa-trash m-1"></i>

                                    </button>

                                </td>

                            </tr>



                            <!-- edit modal -->
                            <div id="editModal{{$question->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel"> تعديل سؤال </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('questions.update',$question->id)}}"method="post">
                                                @csrf
                                                @method('PATCH')

                                                <div class="form-group">
                                                    <label  class="text-black">ادخل السؤال:</label>
                                                    <input  type="text"name="question" class="form-control @error('question') is-invalid @enderror" value="{{$question->question}}">
                                                    @error('question')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="row">

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="control-label"> موضوع السؤال :</label>
                                                            <br>
                                                            <select name="subject" class="form-control @error('subject') is-invalid @enderror"style="height: 40px" >
                                                                <option selected disabled>حدد موضوع السؤال </option>
                                                                @foreach($subjects as $subject)
                                                                    <option value="{{$subject->id}}" {{$subject->id == $question->subject->id ? 'selected' :''}}>{{$subject->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('subject')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label  class="text-black">المرحلة العمرية بالشهور:</label>
                                                            <input  type="number"name="age_stage" class="form-control @error('age_stage') is-invalid @enderror" value="{{$question->age_stage}}">
                                                            @error('age_stage')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>



                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">اغلاق</button>
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">حفظ</button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!-- /.modal -->




                            <!-- destroy modal -->
                            <div id="deleteModal{{$question->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel"> حذف سؤال </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('questions.destroy',$question->id)}}"method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="form-group">
                                                    <h5>هل انت متاكد من عملية الحدف ؟</h5>
                                                </div>


                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">اغلاق</button>
                                                    <button type="submit" class="btn btn-danger waves-effect waves-light">حذف</button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!-- /.modal -->


                        @endforeach


                        </tbody>
                    </table>









                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->




@endsection


@section('js')
    <!-- Required datatable js -->
    <script src="{{asset('dashboard/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>



    <!-- Buttons examples -->
    <script src="{{asset('dashboard/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('dashboard/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>


    <!-- Datatable init js -->
    <script src="{{asset('dashboard/assets/js/pages/datatables.init.js')}}"></script>



    <!-- form repeater js -->
    <script src="{{asset('dashboard/assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>

    <!-- form repeater init -->
    <script src="{{asset('dashboard/assets/js/pages/form-repeater.init.js')}}"></script>





@endsection
