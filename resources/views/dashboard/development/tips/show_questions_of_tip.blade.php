@extends('dashboard.layouts.master')
@section('title')
    tip  الاسئلة الخاصة بال
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
                <h4 class="page-title mb-0 font-size-18">اسئلة النصيحة</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item active">اسئلة النصيحة</li>
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







                    <a  href="{{route('tips.index')}}"   class="btn btn-success waves-effect waves-light">
                        رجوع
                    </a>

                    <br><br>



                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>السؤال</th>
                            <th>المرحلة العمرية بالشهور</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$question->question}}</td>
                                <td>{{$question->age_stage}}</td>

                            </tr>

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
