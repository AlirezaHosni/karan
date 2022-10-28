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
                                <div class="d-flex justify-content-center">
                                    <h3 class="font-weight-bold">ضمایم</h3>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('education.AppendicesAttachments.update', $appendices->id) }}" method="post" id="form" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-12">
                                    <div class="row-cols-3 row">
                                        <div class="form-group col-4">
                                            <label for="gradeOptions" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                            <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                                <option></option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" @if($appendices->book->lesson->grade_id == $grade->id) selected @endif>{{$grade->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="lessonOptions" class="form-label">کتاب مورد نظر را انتخاب کنید:</label>
                                            <select name="lesson_id"  class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                                @foreach($appendices->book->lesson->grade->lessons as $lesson)
                                                    <option value="{{ $lesson->id }}" @if($appendices->book->lesson_id == $lesson->id) selected @endif>{{ $lesson->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="sessionOptions" class="form-label">فصل مورد نظر را بنویسید:</label>
                                            <select name="session_id"  class="form-control" id="sessionOptions" data-url="{{ route('searchParts') }}">
                                                @foreach($appendices->book->lesson->books()->where('part', null)->get() as $session)
                                                    <option value="{{ $session->id }}" @if($appendices->book->session == $session->session) selected @endif>{{ $session->session }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header border-bottom-0 pb-0">
                                    <div class="card-body">
                                        <ul class="list-group list-group-horizontal col-12 w-100">
                                            <li class="list-group-item col-3">
                                                <a class="page-link py-10" href="{{ route('education.AppendicesAttachmentsIndex') }}">همه</a>
                                            </li>
                                            <li class="list-group-item col-3">
                                                <a class="page-link py-10" href="{{ route('education.AppendicesAttachmentsIndex', 0) }}">خلاصه درس/فصل</a>
                                            </li>
                                            <li class="list-group-item col-3">
                                                <a class="page-link py-10" href="{{ route('education.AppendicesAttachmentsIndex', 1) }}">جدول افقی عمودی</a>
                                            </li>
                                            <li class="list-group-item col-3 ">
                                                <a class="page-link py-10" href="{{ route('education.AppendicesAttachmentsIndex', 2) }}">پیوست ها </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr>
                                </div>
                                @empty(!$appendices->document)
                                    <div class="col-12 row mx-2">
                                        <label for="attachments" class="form-label">جایگزینی ویدیو/جزوه:</label>
                                        <div class="col-4 row">
                                            <input type="file" name="attachments" class="form-control">
                                        </div>
                                        <div class="form-check form-check-inline col-4">
                                            <input class="form-check-input ml-1" type="radio" name="type" id="type0" value="0" @if($appendices->type === 0) checked @endif>
                                            <label class="form-check-label form-label" for="type0">خلاصه درس/فصل</label>
                                            <input class="form-check-input ml-1" type="radio" name="type" id="type1" value="1" @if($appendices->type === 1) checked @endif>
                                            <label class="form-check-label form-label" for="type1">جدول افقی عمودی</label>
                                            <input class="form-check-input ml-1" type="radio" name="type" id="type2" value="2" @if($appendices->type === 2) checked @endif>
                                            <label class="form-check-label form-label" for="type2">پیوست ها </label>
                                        </div>
                                        <div class="col-1">
                                            <a class="btn btn-warning btn-sm" href="{{ asset($appendices->document->document) }}" download>دانلود</a>
                                        </div>
                                        {{--                                            <div class="col-1">--}}
                                        {{--                                                <form action="{{ route('education.IntroduceBookAttachments.destroy', $appendices->id) }}" method="post">--}}
                                        {{--                                                    @csrf--}}
                                        {{--                                                    @method('delete')--}}
                                        {{--                                                    <button class="btn btn-danger btn-sm" type="submit">--}}
                                        {{--                                                        حذف--}}
                                        {{--                                                    </button>--}}
                                        {{--                                                </form>--}}
                                        {{--                                            </div>--}}
                                    </div>
                                @endempty
                                @empty(!$appendices->video)
                                    <div class="col-12 row mx-2">
                                        <label for="attachments" class="form-label">جایگزینی ویدیو/جزوه:</label>
                                        <div class="col-4 row">
                                            <input type="file" name="attachments" class="form-control">
                                        </div>
                                        <div class="form-check form-check-inline col-4">
                                            <input class="form-check-input ml-1" type="radio" name="type" id="type0" value="0" @if($appendices->type === 0) checked @endif>
                                            <label class="form-check-label form-label" for="type0">خلاصه درس/فصل</label>
                                            <input class="form-check-input ml-1" type="radio" name="type" id="type1" value="1" @if($appendices->type === 1) checked @endif>
                                            <label class="form-check-label form-label" for="type1">جدول افقی عمودی</label>
                                            <input class="form-check-input ml-1" type="radio" name="type" id="type2" value="2" @if($appendices->type === 2) checked @endif>
                                            <label class="form-check-label form-label" for="type2">پیوست ها </label>
                                        </div>
                                        <div class="col-1">
                                            <a class="btn btn-warning btn-sm" href="{{ asset($appendices->video->video) }}" download>دانلود</a>
                                        </div>
                                        {{--                                            <div class="col-1">--}}
                                        {{--                                                <form action="{{ route('education.IntroduceBookAttachments.destroy', $appendices->id) }}" method="post">--}}
                                        {{--                                                    @csrf--}}
                                        {{--                                                    @method('delete')--}}
                                        {{--                                                    <button class="btn btn-danger btn-sm" type="submit">--}}
                                        {{--                                                        حذف--}}
                                        {{--                                                    </button>--}}
                                        {{--                                                </form>--}}
                                        {{--                                            </div>--}}
                                    </div>
                                @endempty
                                <div class="form-group row mr-2 col-6">
                                    <button type="submit" id="submit_form_btn" class="btn btn-info">
                                        ثبت
                                    </button>
                                </div>
                            </form>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-8p"><span> نوع</span></th>
                                            <th class="wd-lg-8p"><span> نوع ضمیمه</span></th>
                                            <th class="wd-lg-20p"><span>فصل</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $key=0;
                                        @endphp
                                        @foreach($videos as $video)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>ویدیو</td>
                                                <td>@if($video->videoable->type === 0)خلاصه درس/فصل@elseif($video->videoable->type === 1)جدول افقی عمودی@elseif($video->videoable->type === 2)پیوست ها@endif</td>
                                                <td>{{ $video->videoable->title }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('education.AppendicesAttachments.edit', $video->videoable->id) }}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{ route('education.AppendicesAttachments.destroy', $video->videoable->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <i class="fe fe-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                @endforeach
                                        @foreach($documents as $document)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>جزوه</td>
                                                <td>@if($document->documentable->type === 0)خلاصه درس/فصل@elseif($document->documentable->type === 1)جدول افقی عمودی@elseif($document->documentable->type === 2)پیوست ها@endif</td>
                                                <td>{{ $document->documentable->title }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('education.AppendicesAttachments.edit', $document->documentable->id) }}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{ route('education.AppendicesAttachments.destroy', $document->documentable->id) }}" method="post">
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
