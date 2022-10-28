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
                                    <h3 class="font-weight-bold">میزکار</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="card-header border-bottom-0 pb-0">
                                <div class="card-body justify-content-center">
                                    <ul class="list-group list-group-horizontal col-12 w-100 mb-2 border-0">
                                        <li class="list-group-item col-3 border mx-4">
                                            <a class="page-link py-10" href="{{ route('user.dashboard.schedule.index') }}">دفتر برنامه ریزی</a>
                                        </li>
                                        <li class="list-group-item col-3 border mx-4">
                                            <a class="page-link py-10 " href="{{ route('user.dashboard.contactUs.index') }}">ارتباط با ما</a>
                                        </li>
                                        <li class="list-group-item col-3 border mx-4 ">
                                            <a class="page-link py-10" href="{{ route('user.dashboard.speakToStudent.index') }}">سخنی با دانش آموز</a>
                                        </li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal col-12 w-100 mb-2 border-0">
                                        <li class="list-group-item col-3 border mx-4">
                                            <a class="page-link py-10" href="{{ route('user.dashboard.UserFile.index') }}">فایل‌های ذخیره شده</a>
                                        </li>
                                        <li class="list-group-item col-3 border mx-4">
                                            <a class="page-link py-10 " href="{{ route('user.dashboard.news.index') }}">اخبار کران</a>
                                        </li>
                                        <li class="list-group-item col-3 border mx-4 ">
                                            <a class="page-link py-10" href="{{ route('user.dashboard.examReport.index') }}">کارنامه ها </a>
                                        </li>
                                    </ul>
                                    <ul class="list-group list-group-horizontal col-12 w-100 border-0">
                                        <li class="list-group-item col-3 border mx-4">
                                            <a class="page-link py-10" href="#">روند مطالعاتی</a>
                                        </li>
                                        <li class="list-group-item col-3 border mx-4 ">
                                            <a class="page-link py-10" href="{{ route('user.dashboard.rateTeacher.index') }}">امتیاز دهی به
                                                اساتید </a>
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
