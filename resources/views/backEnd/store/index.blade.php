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
                                            <a class="page-link py-10 text-white bg-info" href="{{ route('store.subscription.index') }}">برنامه فروش اشتراکی</a>
                                        </li>
                                        <li class="list-group-item col-6">
                                            <a class="page-link py-10" href="{{ route('store.videoPack.index') }}"> برنامه فروش پک ویدئویی</a>
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                            </div>
                            <form action="{{ route('store.subscription.store') }}" method="post" class=" d-flex justify-content-center">
                                @csrf
                                <div class="col-12 row">
                                    <div class="card-body col-12">
                                        <div class="list-group list-group-horizontal col-12 w-100 btn-group" data-toggle="buttons">
                                            <label class="btn list-group-item col-6">
                                                <input type="radio" name="type" id="type0" value="0" hidden>دانش‌آموز
                                            </label>
                                            <label class="btn list-group-item col-6">
                                                <input type="radio" name="type" id="type1" value="1" hidden>معلم
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="grade_id">پایه مورد نظر را انتخاب کنید:</label>
                                        <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                            <option value=""></option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}" @if(old('grade_id') == $grade->id) selected @endif>{{$grade->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="lesson_id">کتاب مورد نظر را انتخاب کنید:</label>
                                        <select name="lesson_id"  class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group col-12">
                                            <label for="first_term_price">قیمت پیشنهادی ترم اول</label>
                                            <input type="text" id="first_term_price" name="first_term_price" value="" class="form-control form-control-sm col-6 cente">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group col-12 justify-content-center">
                                            <label for="second_term_price">قیمت پیشنهادی ترم دوم</label>
                                            <input type="text" id="second_term_price" name="second_term_price" value="" class="form-control form-control-sm col-6 cente">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group col-12">
                                            <label for="year_price">قیمت پیشنهادی کل سال</label>
                                            <input type="text" id="year_price" name="year_price" value="" class="form-control form-control-sm col-6 cente">
                                        </div>
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
                                            <th class="wd-lg-8p"><span> پایه</span></th>
                                            <th class="wd-lg-20p"><span>کتاب</span></th>
                                            <th class="wd-lg-20p"><span>دانش‌آموز/معلم</span></th>
                                            <th class="wd-lg-20p"><span>قیمت ترم یک</span></th>
                                            <th class="wd-lg-20p"><span>قیمت ترم دو</span></th>
                                            <th class="wd-lg-20p"><span>قیمت کل سال</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subscriptionSales as $key => $subscriptionSale)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $subscriptionSale->lesson->grade->title }}</td>
                                                <td>{{ $subscriptionSale->lesson->title }}</td>
                                                <td>@if($subscriptionSale->type === 0)دانش‌آموز@elseif($subscriptionSale->type === 1)معلم@endif</td>
                                                <td>{{ $subscriptionSale->first_term_price }}</td>
                                                <td>{{ $subscriptionSale->second_term_price }}</td>
                                                <td>{{ $subscriptionSale->year_price }}</td>
                                                <td class="d-flex justify-content-center">
{{--                                                    <a href="{{ route('discount.edit', $subscriptionSale->id) }}" class="btn btn-success btn-sm ml-2">--}}
{{--                                                        <i class="fe fe-edit-2"></i>--}}
{{--                                                    </a>--}}
{{--                                                    <form action="{{ route('discount.destroy', $subscriptionSale->id) }}" method="post">--}}
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
