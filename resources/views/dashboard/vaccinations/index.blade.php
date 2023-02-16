@extends('dashboard.layouts.master')
@section('title')
    التطعيمات
@endsection

@section('css')

@endsection


@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">التطعيمات</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">الرئيسية</a></li>
                        <li class="breadcrumb-item active">التطعيمات</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        @foreach($vaccinations as $vaccine)

        <div class="col-lg-6">
            <div class="card">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-8">
                        <div class="card-body">

                            <h5 class="card-title mr-3"style="display: inline-block">{{$vaccine->name}}</h5><span class="badge badge-{{$vaccine->important == 1 ? 'primary':'warning'}}">{{$vaccine->important == 1 ? 'مهم':'غير مهم'}}</span>
                            <p class="card-text">{{substr($vaccine->about,0,350)}}.</p>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text"style="display: inline-block"><small class="text-muted">عدد الحقن المطلوبة:</small></p>
                                    <strong class="text-dark"style="font-size: larger">{{$vaccine->number_syringe}}</strong>

                                </div>
                                <div class="col">
                                    <p class="card-text" style="display: inline-block"><small class="text-muted">المرحلة العمرية بالشهور:</small></p>
                                    <strong class="text-dark"style="font-size: larger">{{$vaccine->vaccine_age}}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dropdown float-right mr-3">
                            <a href="#" class="dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{route('vaccinations.edit',$vaccine->id)}}">
                                    تعديل
                                    <i class="fa fa-edit m-1"></i>
                                </a>

                                <button type="button" class="dropdown-item"data-toggle="modal" data-target="#deleteModal{{$vaccine->id}}" >
                                    حدف
                                    <i class="fa fa-trash m-1"></i>
                                </button>





                            </div>
                        </div>
                        <!-- end dropdown -->
                        @if(isset($vaccine->image))
                        <img class="avatar-lg rounded-circle ml-3 mb-3" src="{{asset('images/vaccinations/'.$vaccine->image)}}" alt="Card image">
                        @else
                        <img class="avatar-lg rounded-circle ml-3 mb-3" src="{{asset('images/vaccinations/default-vaccine.png')}}" alt="Card image">
                        @endif
                    </div>


                    <!-- destroy modal -->
                    <div id="deleteModal{{$vaccine->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel"> حدف التطعيم </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('vaccinations.destroy',$vaccine->id)}}"method="post">
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






                </div>
            </div>
        </div>



        @endforeach


    </div>
    <!-- end row -->




@endsection


@section('js')

@endsection
