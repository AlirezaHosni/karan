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
                                    <h3 class="font-weight-bold">نمونه سوالات امتحانی</h3>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('education.ExamQuestionSampleAttachments.update', $examQuestionSample->id) }}" method="post" id="form" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-12">
                                    <div class="row-cols-3 row">
                                        <div class="form-group col-4">
                                            <label for="gradeOptions" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                            <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                                <option></option>
                                                @if($examQuestionSample->exam_question_sampleable_type == \App\book::class)
                                                    @foreach($grades as $grade)
                                                        <option value="{{ $grade->id }}" @if($examQuestionSample->examQuestionSampleable->lesson->grade_id == $grade->id) selected @endif>{{ $grade->title }}</option>
                                                    @endforeach
                                                @elseif($examQuestionSample->exam_question_sampleable_type == \App\Lesson::class)
                                                    @foreach($grades as $grade)
                                                        <option value="{{ $grade->id }}" @if($examQuestionSample->examQuestionSampleable->grade_id == $grade->id) selected @endif>{{ $grade->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="lessonOptions" class="form-label">کتاب مورد نظر را انتخاب کنید:</label>
                                            <select name="lesson_id"  class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                                @if($examQuestionSample->exam_question_sampleable_type == \App\book::class)
                                                    @foreach($examQuestionSample->examQuestionSampleable->lesson->grade->lessons as $lesson)
                                                        <option value="{{ $lesson->id }}" @if($examQuestionSample->examQuestionSampleable->lesson_id == $lesson->id) selected @endif>{{ $lesson->title }}</option>
                                                    @endforeach
                                                @elseif($examQuestionSample->exam_question_sampleable_type == \App\Lesson::class)
                                                    @foreach($examQuestionSample->examQuestionSampleable->grade->lessons as $lesson)
                                                        <option value="{{ $lesson->id }}" @if($examQuestionSample->exam_question_sampleable_id == $lesson->id) selected @endif>{{ $lesson->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="sessionOptions" class="form-label">فصل مورد نظر را بنویسید:</label>
                                            <select name="session_id"  class="form-control" id="sessionOptions" data-url="{{ route('searchParts') }}">
                                                @if($examQuestionSample->exam_question_sampleable_type == \App\book::class)
                                                    @foreach($examQuestionSample->examQuestionSampleable->lesson->books()->where('part', null)->get() as $session)
                                                        <option value="{{ $session->id }}" @if($examQuestionSample->examQuestionSampleable->session == $session->session) selected @endif>{{ $session->session }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row col-12">
                                    <div class="card-body col-12">
                                        <div class="list-group list-group-horizontal col-12 w-100 btn-group" data-toggle="buttons">
                                            <label class="btn list-group-item col-4 @if($examQuestionSample->period === 0) active @endif">
                                                <input type="radio" name="period" id="period0" value="0" hidden @if($examQuestionSample->period === 0) checked @endif>ترم اول
                                            </label>
                                            <label class="btn list-group-item col-4 @if($examQuestionSample->period === 1) active @endif">
                                                <input type="radio" name="period" id="period1" value="1" hidden @if($examQuestionSample->period === 1) checked @endif>ترم دوم
                                            </label>
                                            <label class="btn list-group-item col-4 @if($examQuestionSample->period === 2) active @endif">
                                                <input type="radio" name="period" id="period2" value="2" hidden @if($examQuestionSample->period === 2) checked @endif>کل کتاب
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card-body col-12 justify-content-center">
                                        <div class="list-group list-group-horizontal col-12 w-100 btn-group d-flex justify-content-center" data-toggle="buttons">
                                            <label class="btn list-group-item col-4 @if($examQuestionSample->type === 0) active @endif">
                                                <input type="radio" name="type" id="type0" hidden value="0" @if($examQuestionSample->type === 0) checked @endif>تالیفی
                                            </label>
                                            <label class="btn list-group-item col-4 @if($examQuestionSample->type === 1) active @endif">
                                                <input type="radio" name="type" id="type1" hidden value="1" @if($examQuestionSample->type === 1) checked @endif>سراسری
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    @empty(!$examQuestionSample->document)
                                        <div class="col-12 row mx-2">
                                            <label for="attachments" class="form-label">جایگزینی ویدیو/جزوه:</label>
                                            <div class="col-6 row">
                                                <input type="file" name="attachments" class="form-control">
                                            </div>
                                            <div class="col-1">
                                                <a class="btn btn-warning btn-sm" href="{{ asset($examQuestionSample->document->document) }}" download>دانلود</a>
                                            </div>
                                            {{--                                            <div class="col-1">--}}
                                            {{--                                                <form action="{{ route('education.IntroduceBookAttachments.destroy', $examQuestionSample->id) }}" method="post">--}}
                                            {{--                                                    @csrf--}}
                                            {{--                                                    @method('delete')--}}
                                            {{--                                                    <button class="btn btn-danger btn-sm" type="submit">--}}
                                            {{--                                                        حذف--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </form>--}}
                                            {{--                                            </div>--}}
                                        </div>
                                    @endempty
                                    @empty(!$examQuestionSample->video)
                                        <div class="col-12 row mx-2">
                                            <label for="attachments" class="form-label">جایگزینی ویدیو/جزوه:</label>
                                            <div class="col-6 row">
                                                <input type="file" name="attachments" class="form-control">
                                            </div>
                                            <div class="col-1">
                                                <a class="btn btn-warning btn-sm" href="{{ asset($examQuestionSample->video->video) }}" download>دانلود</a>
                                            </div>
                                            {{--                                            <div class="col-1">--}}
                                            {{--                                                <form action="{{ route('education.IntroduceBookAttachments.destroy', $examQuestionSample->id) }}" method="post">--}}
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
                                </div>
                            </form>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-8p"><span> نوع</span></th>
                                            <th class="wd-lg-20p"><span>کتاب</span></th>
                                            <th class="wd-lg-20p"><span>نوع امتحان</span></th>
                                            <th class="wd-lg-20p"><span>طول امتحان</span></th>
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
                                                <td>{{ $video->videoable->title }}</td>
                                                <td>@if($video->videoable->type === 0)تالیفی@elseif($video->videoable->type === 1)سراسری@endif</td>
                                                <td>@if($video->videoable->period === 0)ترم اول@elseif($video->videoable->period === 1)ترم دوم@elseif($video->videoable->period === 2)کل کتاب@endif</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('education.ExamQuestionSampleAttachments.edit', $video->videoable->id) }}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{ route('education.ExamQuestionSampleAttachments.destroy', $video->videoable->id) }}" method="post">
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
                                                <td>{{ $document->documentable->title }}</td>
                                                <td>@if($document->documentable->type === 0)تالیفی@elseif($document->documentable->type === 1)سراسری@endif</td>
                                                <td>@if($document->documentable->period === 0)ترم اول@elseif($document->documentable->period === 1)ترم دوم@elseif($document->documentable->period === 2)کل کتاب@endif</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('education.ExamQuestionSampleAttachments.edit', $document->documentable->id) }}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{ route('education.ExamQuestionSampleAttachments.destroy', $document->documentable->id) }}" method="post">
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
