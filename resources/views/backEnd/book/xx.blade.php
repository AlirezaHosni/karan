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
                            <form action="{{route('book-part.update', $book->id)}}" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="d-flex flex-column col-12">
                                    <div class="form-group">
                                        <label for="grade_id">پایه مورد نظر را انتخاب کنید:</label>
                                        <select name="grade_id"  class="form-control">
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}" @if(old('grade_id') == $grade->id) selected @endif>{{$grade->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="lesson_id">کتاب مورد نظر را انتخاب کنید:</label>
                                        <select name="lesson_id"  class="form-control">
                                            @foreach($lesson as $item)
                                                <option value="{{$item->id}}" @if(old('lesson_id') == $item->id) selected @endif>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="lesson_id">فصل / درس مورد نظر را انتخاب کنید:</label>
                                        <select name="session"  class="form-control">
                                            @foreach($books as $item)
                                                <option value="{{$item->session}}" @if(old('session') == $item->session) selected @endif>{{$item->session}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">بخش مورد نظر را بنویسید:</label>
                                        <input type="text" name="part" value="{{ old('part') }}" class="form-control " placeholder="عنوان بخش" />
                                    </div>
                                    <div id="topicDiv">
                                        @foreach($book->topics as $topic)
                                            <div class="form-group">
                                                <label for="">موضوع </label>
                                                <input type="text" name="topic[]" value="{{ $topic->title }}" class="form-control " placeholder="موضوع" />
                                            </div>
                                        @endforeach
                                        <div class="form-group">
                                            <label for="">موضوع مورد نظر را بنویسید:</label>
                                            <input type="text" name="topic[]"  class="form-control " placeholder="موضوع" />
                                        </div>
                                    </div>
                                    <div class="form-group row mr-2">
                                        <button type="button" class="btn btn-info ml-2 createTopic">
                                            موضوع جدید
                                        </button>
                                        <a href="{{ route('book-part.index') }}" class="btn btn-info ml-2">
                                            جدید
                                        </a>
                                        <button type="submit" class="btn btn-info">
                                            ثبت
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="card-header border-bottom-0 pb-0">
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <label class="main-content-label mb-0 pt-1">لیست بخش / موضوع های ایجاد شده برای هر کتاب</label>
                                </div>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-8p"><span>موضوع</span></th>
                                            <th class="wd-lg-8p"><span>بخش</span></th>
                                            <th class="wd-lg-8p"><span>فصل</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($topics as $key=>$topic)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td><a href="{{ route('book-part.edit', $topic->book_id) }}" class="text-dark">{{$topic->title}}</a></td>
                                                <td>{{ $topic->book->part }}</td>
                                                <td>{{ $topic->book->session }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{route('book.edit',$topic->book_id)}}"
                                                       class="btn btn-sm btn-info ml-2">
                                                        <i class="fe fa fe-book-open"></i>
                                                    </a>
                                                    <form action="{{route('book-part.destroy',$topic->id)}}" method="post">
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
@section('js')
    <script>
        $(document).ready(function () {
            $('.createTopic').click(function () {
                $('#topicDiv').append(`<div class="form-group">
                                            <label for="">موضوع مورد نظر را بنویسید:</label>
                                            <input type="text" name="topic[]" class="form-control " placeholder="موضوع" />
                                        </div>`)
            });
        });
    </script>
@endsection
