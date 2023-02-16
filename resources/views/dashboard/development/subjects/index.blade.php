@extends('dashboard.layouts.master')
@section('title')
    الموضوعات
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
                <h4 class="page-title mb-0 font-size-18">الموضوعات</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item active">الموضوعات</li>
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

                    {{--       modal to store             --}}
                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#myModal">
                        أضافة موضوع للاسئلة
                    </button>

                    <br><br>
                    <!-- store modal -->
                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel"> اضافة موضوع جديد للاسئلة</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                  <form action="{{route('subjects.store')}}"method="post">
                                        @csrf

                                      <div class="form-group">
                                          <label for="name" class="text-black">ادخل اسم الموضوع:</label>
                                          <input id="name" type="text"name="name"class="form-control @error('name') is-invalid @enderror">
                                          @error('name')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
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
                            <th>الموضوع</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$subject->name}}</td>
                                <td>
                                    <button data-toggle="modal" data-target="#editModal{{$subject->id}}" class="btn btn-primary btn-sm waves-effect waves-light">
                                        تعديل
                                        <i class="fa fa-edit m-1"></i>

                                    </button>

                                    <button data-toggle="modal" data-target="#deleteModal{{$subject->id}}" class="btn btn-danger btn-sm waves-effect waves-light">
                                        حذف
                                        <i class="fa fa-trash m-1"></i>

                                    </button>

                                </td>

                            </tr>



                            <!-- edit modal -->
                            <div id="editModal{{$subject->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel"> تعديل موضوع </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('subjects.update',$subject->id)}}"method="post">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group">
                                                    <label for="name" class="text-black">ادخل اسم الموضوع:</label>
                                                    <input id="name" type="text"name="name"class="form-control @error('name') is-invalid @enderror" value="{{$subject->name}}">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
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
                            <div id="deleteModal{{$subject->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel"> حدف موضوع </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('subjects.destroy',$subject->id)}}"method="post">
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
