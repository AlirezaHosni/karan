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
                                    <h3 class="font-weight-bold">اخبار کران</h3>
                                </div>
                            </div>
                            <div class="container bg-light mt-5 p-2">
                                @foreach($news as $singleNews)
                                <div class="row col-12 mt-5">
                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <h3>{{ $singleNews->title }}</h3>
                                            <h6 style="position: absolute; left: 0">{{ jalaliDate($singleNews->updated_at, '%Y / %m / %d') }}</h6>
                                        </div>
                                        <p class="text-right">
                                            {!! $singleNews->body !!}
                                        </p>
                                    </div>
                                </div>
                                @endforeach
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
