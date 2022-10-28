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
    <title>انتخاب نوع آزمون</title>
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
                <div class=" row col-xl-12 text-center justify-content-center">
                    <div
                        class="col-xl-1 books-slider rounded-circle mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">

                        <a href="{{ route('user.dashboard.exam.placementTest.chooseLesson') }}" class="btn">تعیین سطح</a>
                    </div>
                    <div
                        class="col-xl-1 books-slider rounded-circle mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">

                        <a href="#" class="btn">آزمون برنامه‌ای</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end sectionTWO -->
<script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
</body>
</html>
