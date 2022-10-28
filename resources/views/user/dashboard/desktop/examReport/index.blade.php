@extends('user.dashboard.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-5">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card pt-5">
                            <div class="card-header border-bottom-0 pb-0">
                                <div class="d-flex justify-content-center">
                                    <h3 class="font-weight-bold">کارنامه‌ها</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-8p text-right"><span>تاریخ</span></th>
                                            <th class="wd-lg-8p text-right"><span>نوع</span></th>
                                            <th class="wd-lg-8p text-right"><span>تستی/تشریحی</span></th>
                                            <th class="wd-lg-8p text-right"><span>عنوان</span></th>
                                            <th class="wd-lg-8p text-right"><span>نمره</span></th>
{{--                                            <th class="wd-lg-20p text-center">عمل</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($examReports as $key => $examReport)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td class="text-right">{{  jalaliDate($examReport->created_at, "%Y / %m / %d") }}</td>
                                                <td class="text-right">@if($examReport->section == 0)@if($examReport->examable_type == \App\Topic::class)آزمون انتخابی-موضوعی@elseif($examReport->examable_type == \App\book::class)آزمون انتخابی-استاندارد@endif
                                                    @elseif($examReport->section == 1)آزمون برنامه‌ای@endif
                                                </td>
                                                <td class="text-right">@if($examReport->format == 0)تستی@elseif($examReport->format == 1)تشریحی@endif</td>
                                                <td class="text-right">@if($examReport->examable_type == \App\Topic::class){{ $examReport->examable->title }}@elseif($examReport->examable_type == \App\book::class){{ $examReport->examable->session }}@endif</td>
                                                <td class="text-right">{{ $examReport->score }}</td>
{{--                                                <td class="d-flex justify-content-center">--}}
{{--                                                    <a href="{{route('examReport.edit',$examReport->id)}}" class="btn btn-success btn-sm ml-2">--}}
{{--                                                        <i class="fe fe-edit-2"></i>--}}
{{--                                                    </a>--}}
{{--                                                    <form action="{{route('examReport.destroy',$examReport->id)}}" method="post">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('delete')--}}
{{--                                                        <button class="btn btn-danger btn-sm" type="submit">--}}
{{--                                                            <i class="fe fe-trash"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
{{--                                                </td>--}}
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
