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
                                    <h3 class="font-weight-bold">انتخاب درس</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="card-header border-bottom-0 pb-0">
                                <div class="card-body justify-content-center">
                                    <ul class="list-group list-group-horizontal col-12 w-100 mb-2 border-0">
                                        <li class="list-group-item col-3 border mx-4">
                                            <a class="page-link py-10" href="{{ route('user.dashboard.UserFile.index') }}">آزمون تعیین سطح</a>
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
