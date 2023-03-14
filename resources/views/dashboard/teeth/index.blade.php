@extends('dashboard.layouts.master')
@section('title')
    الاسنان
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
                <h4 class="page-title mb-0 font-size-18">الاسنان</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item active">الاسنان</li>
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

                    @if ($errors->any())

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    @endif




                    {{--       modal to store             --}}
                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#myModal">
                        أضافة
                    </button>

                    <br><br>
                    <!-- store modal -->
                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel"> اضافة الاسنان الطبية</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('teeths.store')}}"method="post">
                                        @csrf

                                        <div class="form-group">
                                            <label for="name" class="text-black">ادخل اسم السنة الطبية:</label>
                                            <input id="name" type="text"name="name"class="form-control">
                                        </div>

                                        <h6>فترة ظهور السنة بالشهور:</h6>
                                       <div class="row">
                                           <div class="col">
                                               <div class="form-group">
                                                   <label for="from" class="text-black"> من:</label>
                                                   <input id="from" type="number"name="start"class="form-control">

                                               </div>
                                           </div>

                                           <div class="col">
                                               <div class="form-group">
                                                   <label for="to" class="text-black"> إلى:</label>
                                                   <input id="to" type="number"name="end"class="form-control">

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


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>السنة</th>
                            <th> الفترة بالشهر من</th>
                            <th>الي</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($teeths as $teeth)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$teeth->name}}</td>
                                <td>{{$teeth->month_start}}</td>
                                <td>{{$teeth->month_end}}</td>
                                <td>
                                    <button data-toggle="modal" data-target="#editModal{{$teeth->id}}" class="btn btn-primary btn-sm waves-effect waves-light">
                                        تعديل
                                        <i class="fa fa-edit m-1"></i>

                                    </button>

                                    <button data-toggle="modal" data-target="#deleteModal{{$teeth->id}}" class="btn btn-danger btn-sm waves-effect waves-light">
                                        حذف
                                        <i class="fa fa-trash m-1"></i>

                                    </button>

                                </td>

                            </tr>



                            <!-- edit modal -->
                            <div id="editModal{{$teeth->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel"> تعديل السنة الطبية </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('teeths.update',$teeth->id)}}"method="post">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group">
                                                    <label for="name" class="text-black">السنة الطبية:</label>
                                                    <input id="name" value="{{$teeth->name}}" type="text"name="name"class="form-control">

                                                </div>

                                                <h6>فترة ظهور السنة بالشهور:</h6>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="from" class="text-black"> من:</label>
                                                            <input id="from" value="{{$teeth->month_start}}" type="number"name="start"class="form-control ">

                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="to" class="text-black"> إلى:</label>
                                                            <input id="to" value="{{$teeth->month_end}}" type="number"name="end"class="form-control">

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
                            <div id="deleteModal{{$teeth->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel"> حذف السينة </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('teeths.destroy',$teeth->id)}}"method="post">
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
@endsection
