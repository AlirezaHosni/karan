
<!DOCTYPE html>
<html lang="en" dir="rtl">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <meta name="description" content="akam" />
    <meta name="author" content="akam" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta
        name="keywords"
        content="akam"
    />
    <!-- Favicon -->
    <link rel="icon" href="{{asset('backEnd/img/brand/logo.png')}}" type="image/x-icon" />
    <!-- Title -->
    <title>داشبورد</title>
    <!-- Bootstrap css-->
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
    @yield('head-tag')

</head>
<body class="main-body leftmenu">
<!-- Sidemenu -->
@include('user.dashboard.partial._sideMenu')
<!-- End Sidemenu -->
<!-- Main Header-->
@include('user.dashboard.partial._mainHeader')
<!-- End Main Header-->
<!-- Mobile-header -->
@include('user.dashboard.partial._mobileHeader')
<!-- Mobile-header closed -->
@yield('master')
<!-- Main Footer-->
@include('user.dashboard.partial._mainFooter')
<!--End Footer-->
</div>

<!-- Jquery js-->
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

@yield('js')


</body>



