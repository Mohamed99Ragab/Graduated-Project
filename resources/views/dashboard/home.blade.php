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
        <div class="col-xl-3">
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
                        <div class="col-7">
                            <p class="mb-0"><span class="text-{{\App\Models\User::all()->count() < 50 ?'info': 'success'}} mr-2"> {{(\App\Models\User::all()->count()/100)*100}}% <i class="mdi mdi-arrow-{{\App\Models\User::all()->count() < 50 ?'down': 'up'}}"></i> </span></p>
                        </div>
                        <div class="col-5 align-self-center">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-{{\App\Models\User::all()->count() < 50 ?'danger': 'primary'}}" role="progressbar" style="width: {{\App\Models\User::all()->count()}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="avatar-sm font-size-20 mr-3">
                                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="fas fa-child"></i>
                                                </span>
                        </div>
                        <div class="media-body">
                            <div class="font-size-16 mt-2"> احصائيات لمرض الصفرة</div>

                        </div>
                    </div>
                    <h4 class="mt-4">2,456</h4>
                    <div class="row">
                        <div class="col-7">
                            <p class="mb-0"><span class="text-success mr-2"> 0.16% <i class="mdi mdi-arrow-up"></i> </span></p>
                        </div>
                        <div class="col-5 align-self-center">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="avatar-sm font-size-20 mr-3">
                                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="fas fa-child"></i>
                                                </span>
                        </div>
                        <div class="media-body">
                            <div class="font-size-16 mt-2">احصائيات لامراض الجلدية</div>

                        </div>
                    </div>
                    <h4 class="mt-4">2,456</h4>
                    <div class="row">
                        <div class="col-7">
                            <p class="mb-0"><span class="text-success mr-2"> 0.16% <i class="mdi mdi-arrow-up"></i> </span></p>
                        </div>
                        <div class="col-5 align-self-center">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="avatar-sm font-size-20 mr-3">
                                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="fas fa-child"></i>
                                                </span>
                        </div>
                        <div class="media-body">
                            <div class="font-size-16 mt-2">احصائيات لمرض mpc</div>

                        </div>
                    </div>
                    <h4 class="mt-4">2,456</h4>
                    <div class="row">
                        <div class="col-7">
                            <p class="mb-0"><span class="text-success mr-2"> 0.16% <i class="mdi mdi-arrow-up"></i> </span></p>
                        </div>
                        <div class="col-5 align-self-center">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
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

                    <h4 class="card-title mb-4">Pie Chart</h4>

                    <div class="row text-center">
                        <canvas id="mypieChart"style="max-height: 320px" width="200" height="100"></canvas>


                    </div>

                </div>
            </div>
        </div>



        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Bar Chart</h4>
                    <div class="row text-center">
                        <canvas id="myChart" width="250" height="150"></canvas>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">



        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">line Chart</h4>
                    <div class="row text-center">
                        <canvas id="lineChart" width="250" height="300"></canvas>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->








@endsection


@section('js')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{--    bar chart--}}
    <script>
            $(function () {
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
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
        $(function () {
            var ctx = document.getElementById("mypieChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
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
        $(function () {
            var ctx = document.getElementById("lineChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
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
