@extends('dashboard.layouts.master')

@section('title')
    لوحة التحكم

@endsection


@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @endif

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="avatar-sm font-size-20 mr-3">
                                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="fas fa-users"></i>
                                                </span>
                        </div>
                        <div class="media-body">
                            <div class="font-size-16 mt-2">اجمالي المستخدمين</div>
                        </div>
                    </div>
                    <h4 class="mt-4">{{{\App\Models\User::all()->count()}}}</h4>
                    <div class="row">

                        <div class="col-5 align-self-center">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{\App\Models\User::all()->count()}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="avatar-sm font-size-20 mr-3">
                                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="fas fa-headset"></i>
                                                </span>
                        </div>
                        <div class="media-body">
                            <div class="font-size-16 mt-2">اجمالي طلبات التواصل اليوم</div>

                        </div>
                    </div>
                    <h4 class="mt-4">{{$customer_support_count}}</h4>
                    <div class="row">

                        <div class="col-5 align-self-center">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$customer_support_count}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="avatar-sm font-size-20 mr-3">
                                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="fas fa-syringe"></i>
                                                </span>
                        </div>
                        <div class="media-body">
                            <div class="font-size-16 mt-2">التطعيمات المنشورة</div>

                        </div>
                    </div>
                    <h4 class="mt-4">{{\App\Models\Vaccination::all()->count()}}</h4>
                    <div class="row">

                        <div class="col-5 align-self-center">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{\App\Models\Vaccination::all()->count()}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- end row -->





    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">عدد الاطفال المسجلة لدينا من كل نوع</h4>

                    <div class="row text-center">
                        <canvas id="mypieChart"style="max-height: 320px" width="200" height="100"></canvas>


                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">عدد الاطفال المصابين في كل مرض</h4>
                    <div class="row text-center">
                        <canvas id="lineChart" width="50" height="320"></canvas>

                    </div>

                </div>
            </div>
        </div>


    </div>
    <!-- end row -->


    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">عدد الاطفال الغير مصابين في كل مرض</h4>
                    <div class="row text-center">
                        <canvas id="normalDiseaseChart" width="250" height="150"></canvas>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">عدد المستخدمين المسجلين في كل شهر هذا العام</h4>
                    <div class="row text-center">
                        <canvas id="myChart" width="250" height="150"></canvas>

                    </div>

                </div>
            </div>
        </div>


    </div>


    <div class="row">




    </div>
    <!-- end row -->








@endsection


@section('js')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{--    bar chart--}}
    <script>
        var labels =  {{ Js::from($labels) }};
        var users =  {{ Js::from($data) }};
            $(function () {
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: labels,
            datasets: [{
            label: 'عدد المستخدمين',
            data: users,
            backgroundColor: [
            'rgba(21,141,226)',
            'rgb(21,141,226)',
            'rgba(21,141,226)',
            'rgba(21,141,226)',
            'rgba(21,141,226)',
            'rgba(21,141,226)'
            ],
            borderColor: [
                'rgba(21,141,226)',
                'rgba(21,141,226)',
                'rgba(21,141,226)',
                'rgba(21,141,226)',
                'rgba(21,141,226)',
                'rgba(21,141,226)',
            ],
            borderWidth: 1
        }]
        },
            options: {
            scales: {
            yAxes: [{
            ticks: {
            beginAtZero:true
        }
        }]
        }
        }
        });
        });
    </script>


{{--    Doughnut chart--}}
    <script>

        var $gender_labels =  {{ Js::from($gender_labels) }};
        var genderCount =  {{ Js::from($gender_count) }};

        $(function () {
            var ctx = document.getElementById("mypieChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: $gender_labels,
                    datasets: [{
                        label: '# عدد الاطفال من هذا النوع',
                        data: genderCount,
                        backgroundColor: [
                            'rgba(255, 99, 132)',
                            'rgba(54, 162, 235)',
                            'rgba(255, 206, 86',
                            'rgba(75, 192, 192)',
                            'rgba(153, 102, 255)',
                            'rgba(255, 159, 64)'
                        ],
                        borderColor: [
                            'rgb(255,99,99)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    </script>

    {{--    line chart--}}
    <script>

        var disease_labels =  {{ Js::from($disease_labels) }};
        var disease_count =  {{ Js::from($disease_count) }};

        $(function () {
            var ctx = document.getElementById("lineChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: disease_labels,
                    datasets: [{
                        label: 'عدد الاطفال المصابة',
                        data: disease_count,
                        backgroundColor: [
                            'rgba(21,141,226)',
                            'rgb(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)'
                        ],
                        borderColor: [
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    </script>


{{--    normal disease chart--}}
    <script>
        var disease_normal_labels =  {{ Js::from($disease_normal_labels) }};
        var disease_normal_count =  {{ Js::from($disease_normal_count) }};
        $(function () {
            var ctx = document.getElementById("normalDiseaseChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: disease_normal_labels,
                    datasets: [{
                        label: 'عدد المستخدمين غير المصابين',
                        data: disease_normal_count,
                        backgroundColor: [
                            'rgba(21,141,226)',
                            'rgb(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)'
                        ],
                        borderColor: [
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                            'rgba(21,141,226)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    </script>

@endsection
