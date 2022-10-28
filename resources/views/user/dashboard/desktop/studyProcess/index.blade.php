@extends('user.dashboard.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-2">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card pt-2">
                            <div class="card-header border-bottom-0 pb-0">
                                <div class="d-flex justify-content-center">
                                    <h3 class="font-weight-bold">روند مطالعاتی</h3>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        انتخاب بازه زمانی
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="{{ route('user.dashboard.studyProcess.index', ['period' => 'day']) }}" class="dropdown-item">روزانه</a>
                                        <a href="{{ route('user.dashboard.studyProcess.index', ['period' => 'week']) }}" class="dropdown-item">هفتگی</a>
                                        <a href="{{ route('user.dashboard.studyProcess.index', ['period' => 'month']) }}" class="dropdown-item">ماهانه</a>
                                        <a href="{{ route('user.dashboard.studyProcess.index', ['period' => 'year']) }}" class="dropdown-item">سالانه</a>
                                    </div>
                                </div>
                            </div>
                            <div class="m-3">
                                <span class="m-2">زمان صبح از ساعت ۶ تا ۱۲</span>
                                <span class="m-2">زمان بعد از ظهر از ساعت ۱۲ تا ۱۸</span>
                                <span class="m-2">زمان صبح از ساعت ۱۸ تا ۲۴</span>
                            </div>
                            <div class="container bg-light p-2">
                                <canvas id="canvas" height="280" width="600"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- COL END -->
                </div>
                <!-- row closed  -->
            </div>
        </div>
    </div>
    <!-- End Main Content-->
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script type="text/javascript">
        var labels = ['همه دروس'];

        const data = {

            labels: labels,

            datasets: [{

                label: 'صبح',

                backgroundColor: 'rgb(31,79,204)',

                borderColor: 'rgb(31,79,204)',

                data: @json($morningInterval),

            },{

                label: 'بعدازظهر',

                backgroundColor: 'rgb(5,166,31)',

                borderColor: 'rgb(5,166,31)',

                data: @json($afternoonInterval),

            },{

                label: 'شب',

                backgroundColor: 'rgb(236,195,28)',

                borderColor: 'rgb(236,195,28)',

                data: @json($nightInterval),

            },
            ]

        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    text: "میزان مطالعه بر حسب ساعت",
                    categoryPercentage : 0.8,
                    barPercentage : 0.5,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                        }],
                        xAxes: [{
                            // barThickness: 20,  // number (pixels) or 'flex'
                            // maxBarThickness: 30 // number (pixels)
                            categoryPercentage : 0.6,
                            barPercentage : 0.2,
                        }]
                    },
                    elements: {
                        rectangle: {
                            borderWidth: 4,
                            borderColor: 'rgb(0, 255, 0)',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: "میزان مطالعه بر حسب ساعت"
                    }
                }
            });
        };

    </script>
@endsection
