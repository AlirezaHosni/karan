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
                            <form action="#" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <div class="row-cols-3 row">
                                        <div class="form-group col-4">
                                            <label for="gradeOptions" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                            <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                                <option></option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" @if($karanBala->topic->book->lesson->grade_id == $grade->id) selected @endif>{{$grade->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="lessonOptions" class="form-label">کتاب مورد نظر را انتخاب کنید:</label>
                                            <select name="lesson_id"  class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                                @foreach($karanBala->topic->book->lesson->grade->lessons as $lesson)
                                                    <option value="{{ $lesson->id }}" @if($karanBala->topic->book->lesson_id == $lesson->id) selected @endif>{{ $lesson->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="sessionOptions" class="form-label">فصل مورد نظر را بنویسید:</label>
                                            <select name="session"  class="form-control" id="sessionOptions" data-url="{{ route('searchParts') }}">
                                                @foreach($karanBala->topic->book->lesson->books()->where('part', null)->get() as $session)
                                                    <option value="{{ $session->session }}" @if($karanBala->topic->book->session == $session->session) selected @endif>{{ $session->session }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                <div class="row-cols-2 row">
                                    <div class="form-group col-6">
                                        <label for="partOptions" class="form-label">بخش مورد نظر را بنویسید:</label>
                                        <select name="part"  class="form-control" id="partOptions" data-url="{{ route('searchTopics') }}">
                                            @foreach($karanBala->topic->book->lesson->books()->whereNotNull('part')->get() as $part)
                                                <option value="{{ $part->id }}" @if($karanBala->topic->book_id == $part->id) selected @endif>{{ $part->part }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="topicOptions" class="form-label">موضوع مورد نظر را انتخاب کنید:</label>
                                        <select name="topic_id" class="form-control" id="topicOptions">
                                            @foreach($karanBala->topic->book->topics as $topic)
                                                <option value="{{ $topic->id }}" @if($karanBala->topic->book_id == $topic->id) selected @endif>{{ $topic->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                </div>
                            </form>
                            <div class="card-header border-bottom-0 pb-0">
                                <hr>
                                <div class="card-body">
                                    <ul class="list-group list-group-horizontal col-12 w-100">
                                        <li class="list-group-item col-3">
                                            <a class="page-link py-10" href="{{ route('education.textBookAttachmentsIndex') }}">درسنامه تشریحی</a>
                                        </li>
                                        <li class="list-group-item col-3">
                                            <a class="page-link py-10" href="{{ route('education.descriptiveTestAttachmentsIndex') }}"> سوالات تشریحی</a>
                                        </li>
                                        <li class="list-group-item col-3">
                                            <a class="page-link py-10" href="{{ route('education.karanBalaAttachmentsIndex') }}">نکته و تست </a>
                                        </li>
                                        <li class="list-group-item col-3">
                                            <a class="page-link py-10 text-white bg-info" href="{{ route('education.karanBalaAttachmentsIndex') }}"> کران بالا</a>
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                            </div>
                            <form action="{{ route('education.karanBalaAttachments.update', $karanBala->id) }}" method="post" id="form" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-12">
                                    <input type="hidden" name="topic_id" id="selected_topic_id" class="form-control" />
                                @empty(!$karanBala->document)
                                        <div class="col-12 row">
                                            <label for="attachments" class="form-label">جایگزینی ویدیو/جزوه:</label>
                                            <div class="col-6 row">
                                                <input type="file" name="attachments" class="form-control">
                                            </div>
                                            <div class="col-1">
                                                <a class="btn btn-warning btn-sm" href="{{ asset($karanBala->document->document) }}" download>دانلود</a>
                                            </div>
                                            {{--                                            <div class="col-1">--}}
                                            {{--                                                <form action="{{ route('education.IntroduceBookAttachments.destroy', $karanBala->id) }}" method="post">--}}
                                            {{--                                                    @csrf--}}
                                            {{--                                                    @method('delete')--}}
                                            {{--                                                    <button class="btn btn-danger btn-sm" type="submit">--}}
                                            {{--                                                        حذف--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </form>--}}
                                            {{--                                            </div>--}}
                                        </div>
                                    @endempty
                                    @empty(!$karanBala->video)
                                        <div class="col-12 row">
                                            <label for="attachments" class="form-label">جایگزینی ویدیو/جزوه:</label>
                                            <div class="col-6 row">
                                                <input type="file" name="attachments" class="form-control">
                                            </div>
                                            <div class="col-1">
                                                <a class="btn btn-warning btn-sm" href="{{ asset($karanBala->video->video) }}" download>دانلود</a>
                                            </div>
                                            {{--                                            <div class="col-1">--}}
                                            {{--                                                <form action="{{ route('education.IntroduceBookAttachments.destroy', $karanBala->id) }}" method="post">--}}
                                            {{--                                                    @csrf--}}
                                            {{--                                                    @method('delete')--}}
                                            {{--                                                    <button class="btn btn-danger btn-sm" type="submit">--}}
                                            {{--                                                        حذف--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </form>--}}
                                            {{--                                            </div>--}}
                                        </div>
                                    @endempty
                                </div>
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
                                            <th class="wd-lg-8p"><span>موضوع</span></th>
                                            <th class="wd-lg-20p"><span>کتاب</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $key=0;
                                        @endphp
                                        @foreach($videos as $video)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>ویدیو</td>
                                                <td>{{ $video->videoable->topic->title }}</td>
                                                <td>{{ $video->videoable->topic->book->lesson->title }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('education.karanBalAttachments.edit', $video->videoable->id) }}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{ route('education.karanBalaAttachments.destroy', $video->videoable->id) }}" method="post">
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
                                                <td>{{++$key}}</td>
                                                <td>جزوه</td>
                                                <td>{{ $document->documentable->topic->title }}</td>
                                                <td>{{ $document->documentable->topic->book->lesson->title }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('education.karanBalAttachments.edit', $document->documentable->id) }}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{ route('education.karanBalaAttachments.destroy', $document->documentable->id) }}" method="post">
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
@section('js')
    <script>
        $('#form').submit(function (event){
            var topicSelected = $('#topicOptions').val()
            var topicInput = $('#selected_topic_id')
            topicInput.val(topicSelected)
        });
    </script>
@endsection
