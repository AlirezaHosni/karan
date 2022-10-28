@extends('backEnd.layouts.master')
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
                                <div >
                                    <h3 class="font-weight-bold text-center">فروشگاه</h3>
                                    <h5 class="font-weight-bold float-right">آموزش</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="card-header border-bottom-0 pb-0">
                                <div class="card-body">
                                    <ul class="list-group list-group-horizontal col-12 w-100">
                                        <li class="list-group-item col-6">
                                            <a class="page-link py-10" href="{{ route('store.subscription.index') }}">برنامه فروش اشتراکی</a>
                                        </li>
                                        <li class="list-group-item col-6">
                                            <a class="page-link py-10 text-white bg-info" href="{{ route('store.videoPack.index') }}"> برنامه فروش پک ویدئویی</a>
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                            </div>
                            <form action="{{ route('store.videoPack.store') }}" method="post" class=" d-flex justify-content-center">
                                @csrf
                                <div class="col-12 row">
                                    <div class="form-group col-6">
                                        <label for="grade_id">پایه مورد نظر را انتخاب کنید:</label>
                                        <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                            <option value=""></option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}" @if(old('grade_id') == $grade->id) selected @endif>{{$grade->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                            <label for="grade_price">قیمت پیشنهادی پایه</label>
                                            <input type="text" id="grade_price" name="grade_price" value="" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="lesson_id">کتاب مورد نظر را انتخاب کنید:</label>
                                        <select name="lesson_id"  class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                        </select>
                                    </div>
                                    <div class="col-6">
                                            <label for="lesson_price">قیمت پیشنهادی کتاب</label>
                                            <input type="text" id="lesson_price" name="lesson_price" value="" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="session_id">فصل مورد نظر را انتخاب کنید:</label>
                                        <select name="session_id"  class="form-control" id="sessionOptions">
                                        </select>
                                    </div>
                                    <div class="col-6">
                                            <label for="session_price">قیمت پیشنهادی فصل</label>
                                            <input type="text" id="session_price" name="session_price" value="" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-6">
                                            <label for="flash_capacity">ظرفیت هر فلش به گیگابایت</label>
                                            <input type="text" id="flash_capacity" name="flash_capacity" value="" class="form-control form-control-sm col-6 cente">
                                    </div>
                                    <div class="col-6">
                                            <label for="flash_price">قیمت هر فلش</label>
                                            <input type="text" id="flash_price" name="flash_price" value="" class="form-control form-control-sm col-6 cente">
                                    </div>
                                    <div class="col-6">
                                            <label for="dvd_capacity">ظرفیت هر DVD به گیگابایت</label>
                                            <input type="text" id="dvd_capacity" name="dvd_capacity" value="" class="form-control form-control-sm col-6 cente">
                                    </div>
                                    <div class="col-6">
                                            <label for="dvd_price">قیمت هر DVD</label>
                                            <input type="text" id="dvd_price" name="dvd_price" value="" class="form-control form-control-sm col-6 cente">
                                    </div>

                                    <div class="form-group row mr-2 col-6">
                                        <button type="submit" class="btn btn-info">
                                            ثبت
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-20p"><span> پایه</span></th>
                                            <th class="wd-lg-20p"><span>قیمت پایه</span></th>
                                            <th class="wd-lg-20p"><span> کتاب</span></th>
                                            <th class="wd-lg-20p"><span>قیمت کتاب</span></th>
                                            <th class="wd-lg-20p"><span> فصل</span></th>
                                            <th class="wd-lg-20p"><span>قیمت فصل</span></th>
                                            <th class="wd-lg-20p"><span>ظرفیت هر فلش</span></th>
                                            <th class="wd-lg-20p"><span>قیمت هر فلش</span></th>
                                            <th class="wd-lg-20p"><span>ظرفیت هر dvd</span></th>
                                            <th class="wd-lg-20p"><span>قیمت هر dvd</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($videoPackSales as $key => $videoPackSale)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $videoPackSale->grade->title }}</td>
                                                <td>{{ $videoPackSale->grade_price }}</td>
                                                <td>{{ $videoPackSale->lesson->title }}</td>
                                                <td>{{ $videoPackSale->lesson_price }}</td>
                                                <td>{{ $videoPackSale->session->session }}</td>
                                                <td>{{ $videoPackSale->session_price }}</td>
                                                <td>{{ $videoPackSale->flash_capacity }}</td>
                                                <td>{{ $videoPackSale->flash_price }}</td>
                                                <td>{{ $videoPackSale->dvd_capacity }}</td>
                                                <td>{{ $videoPackSale->dvd_price }}</td>
                                                <td class="d-flex justify-content-center">
{{--                                                    <a href="{{ route('store.videoPack.edit', $videoPackSale->id) }}" class="btn btn-success btn-sm ml-2">--}}
{{--                                                        <i class="fe fe-edit-2"></i>--}}
{{--                                                    </a>--}}
{{--                                                    <form action="{{ route('store.videoPack.destroy', $videoPackSale->id) }}" method="post">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('delete')--}}
{{--                                                        <button class="btn btn-danger btn-sm" type="submit">--}}
{{--                                                            <i class="fe fe-trash"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
                                                </td>
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
