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
                                    <h3 class="font-weight-bold">تمارین داخل کتاب</h3>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('education.booksExercisesAttachments.update', $booksExercise->id) }}" method="post" id="form" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-12 mb-4">
                                    <div class="row-cols-3 row">
                                        <div class="form-group col-6">
                                            <label for="gradeOptions" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                            <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                                <option></option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" @if($booksExercise->book->lesson->grade_id == $grade->id) selected @endif>{{$grade->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="lessonOptions" class="form-label">کتاب مورد نظر را انتخاب کنید:</label>
                                            <select name="lesson_id"  class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                                @foreach($booksExercise->book->lesson->grade->lessons as $lesson)
                                                    <option value="{{ $lesson->id }}" @if($booksExercise->book->lesson_id == $lesson->id) selected @endif>{{ $lesson->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="sessionOptions" class="form-label">فصل مورد نظر را بنویسید:</label>
                                            <select name="session_id"  class="form-control" id="sessionOptions" data-url="{{ route('searchParts') }}">
                                                @foreach($booksExercise->book->lesson->books()->where('part', null)->get() as $session)
                                                    <option value="{{ $session->id }}" @if($booksExercise->book->session == $session->session) selected @endif>{{ $session->session }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @empty(!$booksExercise->document)
                                    <div class="col-12 row mx-2 mt-4">
                                        <label for="attachments" class="form-label">جایگزینی ویدیو/جزوه:</label>
                                        <div class="col-4 row">
                                            <input type="file" name="attachments" class="form-control">
                                        </div>
                                        <div class="col-1">
                                            <a class="btn btn-warning btn-sm" href="{{ asset($booksExercise->document->document) }}" download>دانلود</a>
                                        </div>
                                        {{--                                            <div class="col-1">--}}
                                        {{--                                                <form action="{{ route('education.IntroduceBookAttachments.destroy', $booksExercise->id) }}" method="post">--}}
                                        {{--                                                    @csrf--}}
                                        {{--                                                    @method('delete')--}}
                                        {{--                                                    <button class="btn btn-danger btn-sm" type="submit">--}}
                                        {{--                                                        حذف--}}
                                        {{--                                                    </button>--}}
                                        {{--                                                </form>--}}
                                        {{--                                            </div>--}}
                                    </div>
                                @endempty
                                @empty(!$booksExercise->video)
                                    <div class="col-12 row mx-2 mt-4">
                                        <label for="attachments" class="form-label">جایگزینی ویدیو/جزوه:</label>
                                        <div class="col-4 row">
                                            <input type="file" name="attachments" class="form-control">
                                        </div>
                                        <div class="col-1">
                                            <a class="btn btn-warning btn-sm" href="{{ asset($booksExercise->video->video) }}" download>دانلود</a>
                                        </div>
                                        {{--                                            <div class="col-1">--}}
                                        {{--                                                <form action="{{ route('education.IntroduceBookAttachments.destroy', $booksExercise->id) }}" method="post">--}}
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
