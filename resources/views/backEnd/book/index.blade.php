@extends('backEnd.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-5">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card pt-5">
                            <form action="{{route('book.store')}}" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex flex-column col-12">
                                    <div class="form-group">
                                        <label for="grade_id">پایه مورد نظر را انتخاب کنید:</label>
                                        <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                            <option value=""></option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}" @if(old('grade_id') == $grade->id) selected @endif>{{$grade->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="lesson_id">کتاب مورد نظر را انتخاب کنید:</label>
                                        <select name="lesson_id"  class="form-control" id="lessonOptions">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">عنوان فصل/درس:</label>
                                        <input type="text" name="session" value="{{ old('session') }}" class="form-control " placeholder="عنوان فصل/درس" />
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-9">
                                            <label for="image" class="ml-2">عکس فصل/درس:</label>
                                            <input type="file" name="image" id="image">
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="form-group row">
                                                <button type="reset" class="btn btn-info ml-2">
                                                    جدید
                                                </button>
                                                <button type="submit" class="btn btn-info">
                                                    ثبت
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="card-header border-bottom-0 pb-0">
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <label class="main-content-label mb-0 pt-1">لیست فصل / درس های ایجاد شده برای هر کتاب</label>
                                </div>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-8p"><span>عنوان فصل/درس</span></th>
                                            <th class="wd-lg-8p"><span>عنوان کتاب</span></th>
                                            <th class="wd-lg-8p"><span>تصویر فصل/درس</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($books as $key=>$book)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td><a href="{{ route('book.edit', $book->id) }}" class="text-dark">{{$book->session}}</a></td>
                                                <td>{{ $book->lesson->title }}</td>
                                                <td class="text-center"><img src="{{asset($book->image)}}" alt="عکس" width="80px" height="80px"></td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{route('book.edit',$book->id)}}"
                                                       class="btn btn-sm btn-info ml-2"
                                                       title="نمایش سوالات امتحانی تستی">
                                                        <i class="fe fa fe-book-open"></i>
                                                    </a>
                                                    <form action="{{route('book.destroy',$book->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <i class="fe fe-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
{{--                                <ul class="pagination mt-4 mb-0 float-left">--}}
{{--                                    <li class="page-item page-prev disabled">--}}
{{--                                        <a class="page-link" href="#" tabindex="-1">قبلی</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">4</a></li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">5</a></li>--}}
{{--                                    <li class="page-item page-next">--}}
{{--                                        <a class="page-link" href="#">بعد</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
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
