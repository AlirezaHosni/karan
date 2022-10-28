<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('backEnd/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- Icons css-->
    <link href="{{asset("backEnd/plugins/web-fonts/icons.css")}}" rel="stylesheet" />
    <link href="{{asset('backEnd/plugins/web-fonts/font-awesome/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('backEnd/plugins/web-fonts/plugin.css')}}" rel="stylesheet" />
    <!-- Style css-->
    <link href="{{asset('backEnd/css-rtl/style/style.css')}}" rel="stylesheet" />
    <link href="{{asset('backEnd/css-rtl/skins.css')}}" rel="stylesheet" />
    <link href="{{asset('backEnd/css-rtl/dark-style.css')}}" rel="stylesheet" />
    <link href="{{asset('backEnd/css-rtl/colors/default.css')}}" rel="stylesheet" />
    <!-- Color css-->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('backEnd/css-rtl/colors/color.css')}}" />
    <!-- Select2 css -->
    <link href="{{asset('backEnd/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <!-- Mutipleselect css-->
    <link rel="stylesheet" href="{{asset('backEnd/plugins/multipleselect/multiple-select.css')}}" />
    <!-- Sidemenu css-->
    <link href="{{asset('backEnd/css-rtl/sidemenu/sidemenu.css')}}" rel="stylesheet" />
    <!-- Switcher css-->
    <link href="{{asset('backEnd/switcher/css/switcher-rtl.css')}}" rel="stylesheet" />
    <link href="{{asset('backEnd/switcher/demo.css')}}" rel="stylesheet" />
    <link href="{{asset('backEnd/select2/select2.css')}}" rel="stylesheet" />
    <link href="{{asset('backEnd/datePicker/DatePicker.css')}}" rel="stylesheet" />
    <!-- SEARCH BOX css-->
    <link href="{{asset('backEnd/search/datatables.css')}}" rel="stylesheet" />
    <link href="{{asset('backEnd/search/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('backEnd/search/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/style.css')}}">
    <title>تحلیل نتیجه آزمون</title>
</head>

<body>
<!-- sectionOne -->
<section class="section-one mt-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 container  ">
        <div class="container-fluid">
            <div class="row w-100">
                <div class="signin-users">
                    <a class="nav-link login-users navbar-links mx-1 text-black " aria-current="page" href="{{route('login')}}"> <img
                            src="{{asset('site/images/users.png')}}"
                            height="25px" class="mx-1" alt=""> ورود کاربران</a>
                </div>
                <div class="header-brand">
                    <span></span>
                </div>
            </div>

        </div>
    </nav>
</section>
<!-- end sectionOne -->
<!-- sectionTWO -->
<section class="d-flex flex-grow-1">
    <div class="container section-two mt-3 mb-5">
        <div class="row ">
            <div class="col-xl-12 py-20">
                @include('alert.alert')
                <div class="card-header border-bottom-0 pb-0 d-flex justify-content-center">
                    <div class="col-12 col-md-10">
                        <div class="card-body">
                            <div class="table-responsive border userlist-table">
                                <table class="table card-table table-bordered table-vcenter text-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th colspan="6" class="wd-lg-8p text-center"><span> کارنامه اولیه</span></th>
                                    </tr>
                                    <tr>
                                        <th class="wd-lg-8p"><span> موضوع</span></th>
                                        <th class="wd-sm-5"><span>گزینه ۴</span></th>
                                        <th class="wd-sm-5"><span>گزینه ۳</span></th>
                                        <th class="wd-sm-5"><span>گزینه ۲</span></th>
                                        <th class="wd-sm-5"><span>گزینه ۱</span></th>
                                        <th class="wd-lg-5p"><span>{{ $userExamAnswer->exam->examable->title }}</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($userExamAnswer->userTestAnswers as $key => $test)
                                        <tr>
                                            <td>{{  $test->test->testable->title }}</td>
                                            <td class="text-center @if($test->answer == 4) bg-dark @endif">@if($test->test->True == 4)<i class="fe fe-check-square" style="color: limegreen"></i>@endif</td>
                                            <td class="text-center @if($test->answer == 3) bg-dark @endif">@if($test->test->True == 3)<i class="fe fe-check-square" style="color: limegreen"></i>@endif</td>
                                            <td class="text-center @if($test->answer == 2) bg-dark @endif">@if($test->test->True == 2)<i class="fe fe-check-square" style="color: limegreen"></i>@endif</td>
                                            <td class="text-center @if($test->answer == 1) bg-dark @endif">@if($test->test->True == 1)<i class="fe fe-check-square" style="color: limegreen"></i>@endif</td>
                                            <td>{{ ++$key }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-4 d-flex justify-content-center row">
                    <a href="{{ route('user.dashboard.exam.placementTest.chooseLesson') }}" class="btn btn-success col-2">
                        بازگشت به صفحه آزمون تعیین سطح
                    </a>
                    <a href="{{ route('exam.result', $userExamAnswer->id) }}" class="btn btn-primary col-2 mx-2">
                        مرور کلی آزمون
                    </a>
                    {{--                                <a href="{{ asset($userExamAnswer->exam->answerSheet) }}" class="btn btn-dark col-2 mx-2">--}}
                    {{--                                    دانلود پاسخنامه--}}
                    {{--                                </a>--}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end sectionTWO -->
<script src="{{asset('backEnd/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('backEnd/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('backEnd/plugins/bootstrap/js/bootstrap-rtl.js')}}"></script>
<!-- Perfect-scrollbar js -->
<script src="{{asset('backEnd/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>
<!-- Sidemenu js -->
<script src="{{asset('backEnd/plugins/sidemenu/sidemenu-rtl.js')}}"></script>
<!-- Sidebar js -->
<script src="{{asset('backEnd/plugins/sidebar/sidebar-rtl.js')}}"></script>
<!-- Select2 js-->
<script src="{{asset('backEnd/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Chart.Bundle js-->
<script src="{{asset('backEnd/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Peity js-->
<script src="{{asset('backEnd/plugins/peity/jquery.peity.min.js')}}"></script>
<!-- Internal Morris js -->
<script src="{{'backEnd/plugins/raphael/raphael.min.js'}}"></script>
<script src="{{asset('backEnd/plugins/morris.js/morris.min.js')}}"></script>
<!-- Circle Progress js-->
<script src="{{asset('backEnd/js/circle-progress.min.js')}}"></script>
<script src="{{asset('backEnd/js/chart-circle.js')}}"></script>
<!-- Internal Dashboard js-->
<script src="{{asset('backEnd/js/index.js')}}"></script>
<!-- Sticky js -->
<script src="{{asset('backEnd/js/sticky.js')}}"></script>
<!-- Custom js -->
<script src="{{asset('backEnd/js/custom.js')}}"></script>
<!-- Switcher js -->
<script src="{{asset('backEnd/switcher/js/switcher-rtl.js')}}"></script>
<script src="{{asset('backEnd/ckeditor/build/ckeditor.js')}}"></script>
<script src="{{asset('backEnd/select2/select2_js.js')}}"></script>
<script src="{{asset('backEnd/datePicker/DatePicker_js.js')}}"></script>
<!-- SEARCH BOX css-->
<script src="{{asset('backEnd/search/DATATABLE.js')}}"></script>
<script src="{{asset('backEnd/search/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backEnd/search/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backEnd/search/jquery.validate.js')}}"></script>
<script type="text/javascript">
    $(function () {

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            paging: false,
            ajax: {
                url: "{{ route('user.dashboard.exam.placementTest.topics') }}",
                data: function (d) {
                    d.lesson_id = $('#lessons').val()
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'topic', name: 'topic'}
            ]
        });

        $('#lessons').change(function(){
            table.draw();
        });
    });
</script>
</body>
</html>


