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
    <title>انتخاب درس</title>
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
                <div class="card-header border-bottom-0 pb-0">
                    <div class="card-body justify-content-center">
                        @foreach($grade->lessons->chunk(3) as $lessons)
                            <ul class="list-group list-group-horizontal col-12 w-100 mb-2 border-0">
                                @foreach($lessons as $lesson)
                                    <li class="list-group-item col-3 border mx-4">
                                        <a class="page-link py-10" href="{{ route('user.dashboard.exam.placementTest.findExam', $lesson->id) }}">{{ $lesson->title }} - {{ $lesson->grade->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                    <hr>
                </div>
                <div class="card-header border-bottom-0 pb-0">
                    <hr>
                    <div class="d-flex justify-content-center">
                        <label class="main-content-label mb-0 pt-1 d-block">لیست آزمون های قبلی</label>
                    </div>
                    <hr>
                </div>
                <div class="col-12">
                    <div class="card-body">
                        <div class="table-responsive border userlist-table">
                            <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="wd-lg-8p"><span> ردیف</span></th>
                                    <th class="wd-lg-8p"><span>تاریخ</span></th>
                                    <th class="wd-lg-8p"><span>درس</span></th>
                                    <th class="wd-lg-8p"><span>درصد</span></th>
                                    <th class="wd-lg-20p text-center">مشاهده</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($exams as $key => $exam)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td class="text-right">{{  jalaliDate($exam->created_at, "%Y / %m / %d") }}</td>
                                        <td >{{ $exam->exam->examable->title }} - {{ $exam->exam->examable->grade->title }}</td>
                                        <td >{{ $exam->score / $exam->exam->tests()->count() * 100 }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('user.dashboard.exam.placementTest.analyseTest', $exam->id) }}" class="btn btn-primary mx-1"><i class="fe fe-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-header border-bottom-0 pb-0">
                    <hr>
                    <div class="d-flex justify-content-center">
                        <label class="main-content-label mb-0 pt-1 d-block">لیست موضوعات نیاز به مطالعه بیشتر</label>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="card-body">
                            <div class="table-responsive border userlist-table">
                                <table class="table card-table table-striped table-vcenter text-nowrap mb-0 yajra-datatable">
                                    <thead>
                                    <tr>
                                        <th class="wd-lg-8p text-center"><span> ردیف</span></th>
                                        <th class="wd-lg-8p text-center"><span>موضوع</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 sidebar-left text-center mb-2">
                        <div class="list-group col-12 w-100 btn-group justify-content-center" id="choose-file-type-div" data-toggle="buttons">
                            <label for="lessons" class="form-label text-dark">درس مورد نظر را انتخاب کنید:</label>
                            <select class="form-control" id="lessons">
                                <option value="">همه</option>
                                @foreach($grade->lessons as $lesson)
                                    <option value="{{ $lesson->id }}" @if(old('lesson_id') == $lesson->id) selected @endif>{{ $lesson->title }} - {{ $lesson->grade->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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

