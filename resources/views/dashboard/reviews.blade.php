@extends('dashboard.layouts.master')
@section('title')
    طلبات التواصل
@endsection

@section('css')
    {{--     DataTables  --}}
    <link href="{{asset('dashboard/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <style>



    </style>
@endsection


@section('content')




    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">طلبات التواصل</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item active">طلبات التواصل</li>
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


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>صورة المستخدم</th>
                            <th>المستخدم</th>
                            <th>الرسالة</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($reviews as $review)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    @if(!empty($review->user->photo))
                                        <img style="max-width: 70px;border-radius: 2px"  src="{{asset('images/users/'.$review->user->photo)}}" alt="" srcset="">

                                    @else
                                        <img class="rounded-circle "style="max-width: 50px" src="{{asset('dashboard/assets/images/baby-user.jpg')}}" alt="" srcset="">

                                    @endif
                                </td>
                                <td>{{$review->user->name}}</td>
                                <td>{{$review->message}}</td>

                                <td>


                                    <button data-toggle="modal" data-target="#deleteModal{{$review->id}}" class="btn btn-danger btn-sm waves-effect waves-light">
                                        حذف
                                        <i class="fa fa-trash m-1"></i>

                                    </button>

                                    <button data-toggle="modal" data-target="#supportModal{{$review->id}}" class="btn btn-success btn-sm waves-effect waves-light">
                                        رد
                                        <i class="fa fa-reply m-1"></i>

                                    </button>

                                </td>

                            </tr>





                            <!-- destroy modal -->
                            <div id="deleteModal{{$review->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel"> حدف المراجعة </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('reviews/delete',$review->id)}}"method="post">
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


                            <!-- support modal -->
                            <div id="supportModal{{$review->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title mt-0" id="myModalLabel"> الرد على رسالة <span class="text-primary">"{{$review->user->name}}"</span>  </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('support/reply')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="message">:رسالتك</label>
                                                    <textarea class="form-control" rows="7" cols="6" name="message"></textarea>
                                                    <input type="hidden" name="emailOfUser" value="{{$review->user->email}}">
                                                    <input type="hidden" name="phoneOfUser" value="{{$review->user->phone_number}}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">اغلاق</button>
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">ارسال</button>
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




    <!-- Responsive examples -->
    <script src="{{asset('dashboard/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>


    <!-- Datatable init js -->
    <script src="{{asset('dashboard/assets/js/pages/datatables.init.js')}}"></script>


    <!-- Bootstrap rating js -->
    <script src="{{asset('dashboard/assets/libs/bootstrap-rating/bootstrap-rating.min.js')}}"></script>

    <script src="{{asset('dashboard/assets/js/pages/rating-init.js')}}"></script>


@endsection
