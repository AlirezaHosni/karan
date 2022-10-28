@extends('backEnd.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-5">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card">
                            <div class="card-header border-bottom-0 pb-0">
                                <div class="d-flex justify-content-between">
                                    <label class="main-content-label mb-3 pt-1">آزمون انتخابی</label>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /آزمون انتخابی</p>
                            </div>
                            <div class="card-body">
                                <!--<ul class="pagination list-group list-group-horizontal mt-4 mb-0 float-left col-12 row list-group-horizontal">-->
                                <!--    <li class="page-item page-prev col-12 list-group-item">-->
                            <!--        <a class="page-link py-2" href="{{route('examBook.create')}}">سوالات تستی</a>-->
                                <!--    </li>-->
                                <!--    <li class="page-item page-prev col-12 list-group-item">-->
                            <!--        <a class="page-link py-2" href="{{route('DescriptiveTest')}}">سوالات تشریحی</a>-->
                                <!--    </li>-->
                                <!--    <li class="page-item page-prev col-12 list-group-item">-->
                            <!--        <a class="page-link py-2" href="{{route('examBook.index')}}">مدیریت سوالات</a>-->
                                <!--    </li>-->

                                <!--</ul>-->
                                <ul class="list-group list-group-horizontal col-12 w-100">
                                    <li class="list-group-item col-4">
                                        <a class="page-link py-10" href="{{route('examBook.create')}}">سوالات تستی</a>
                                    </li>
                                    <li class="list-group-item col-4">
                                        <a class="page-link py-10" href="{{route('DescriptiveTest')}}">سوالات تشریحی</a>                                    </li>
                                    <li class="list-group-item col-4">
                                        <a class="page-link py-10" href="{{route('examBook.index')}}">مدیریت سوالات</a>                                   </li>
                                </ul>
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
