@extends('backEnd.layouts.master')
@section('head-tag')
    <link rel="stylesheet" href="{{ asset('backEnd/timepicker/css/timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('backEnd/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection
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
                                    <h3 class="font-weight-bold">آزمون برنامه‌ای</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="card-header border-bottom-0 pb-0 col-12 justify-content-center">
                                <div class="card-body pt-0">
                                    <ul class="list-group list-group-horizontal col-12 w-100">
                                        <li class="list-group-item col-6">
                                            <a class="page-link py-10" href="{{ route('education.planExam.test.Index') }}">تستی</a>
                                        </li>
                                        <li class="list-group-item col-6">
                                            <a class="page-link py-10 text-white bg-info" href="{{ route('education.planExam.descriptive.Index') }}">تشریحی</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @include('alert.alert')
                            <form action="{{ route('education.planExam.descriptive.Store') }}" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <div class="row-cols-2 row">
                                        <div class="form-group col-6">
                                            <label for="type">نوع آزمون را انتخاب کنید:</label>
                                            <select name="type"  id="type" class="form-control">
                                                <option value="0" @if(old('type') == 0) selected @endif>تعیین سطح</option>
                                                <option value="1" @if(old('type') == 1) selected @endif>تیرماه</option>
                                                <option value="2" @if(old('type') == 2) selected @endif>دی‌ماه</option>
                                            </select>
                                        </div>
{{--                                        <div class="form-group col-6">--}}
{{--                                            <label for="scheduling">زمانبندی آزمون را انتخاب کنید:</label>--}}
{{--                                            <select name="scheduling"  id="scheduling" class="form-control">--}}
{{--                                                <option value="0" @if(old('scheduling') == 0) selected @endif>هفتگی آنلاین</option>--}}
{{--                                                <option value="1" @if(old('scheduling') == 1) selected @endif>دو هفته آنلاین</option>--}}
{{--                                                <option value="2" @if(old('scheduling') == 2) selected @endif>آفلاین(تعیین سطح)</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
                                        <div class="form-group col-6">
                                            <label for="number">شماره آزمون:</label>
                                            <input type="text" value="{{ old('number') }}" name="number" id="number" class="form-control">
                                        </div>
{{--                                        <div class="form-group col-6">--}}
{{--                                            <label for="period">شیوه ارائه آزمون را انتخاب کنید:</label>--}}
{{--                                            <select name="period"  id="period" class="form-control">--}}
{{--                                                <option value="3" @if(old('period') == 0) selected @endif>دوازدهم + ترم اول دهم</option>--}}
{{--                                                <option value="4" @if(old('period') == 1) selected @endif>دوازدهم + ترم اول یازدهم</option>--}}
{{--                                                <option value="5" @if(old('period') == 2) selected @endif>هر سه پایه همزمان</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
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
                                        <div class="form-group col-6">
                                            <label for="session">فصل مورد نظر را بنویسید:</label>
                                            <select name="session"  class="form-control" id="sessionOptions" data-url="{{ route('searchParts') }}">
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="part">بخش مورد نظر را بنویسید:</label>
                                            <select name="part"  class="form-control" id="partOptions" data-url="{{ route('searchTopics') }}">
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="topic">موضوع مورد نظر را انتخاب کنید:</label>
                                            <select name="topic_id" class="form-control" id="topicOptions">
                                            </select>
                                        </div>
                                        <div class="form-group col-12" id="createTestDiv">
                                            <div class="col-xl-12 col-md-12 offset-3">
                                                <div class="form-group col-12 row" >
                                                    <label for="question">صورت سوال</label>
                                                    <input type="text" name="question[]" class="form-control col-12"
                                                           placeholder="صورت سوال مورد نظر خود را وارد کنید" >
                                                </div>
                                                <div class="form-group col-12 row" id="createAnswerDiv_0">
                                                    <input type="text" name="answer_0[]" class="form-control col-12" placeholder="پاسخ بخش">
                                                    <input type="text" name="score_0[]" class="form-control col-6 mt-1" placeholder="بارم">
                                                    <input type="file" name="answer_image_0[]" class="form-control col-6 mt-1" placeholder="'بارگذاری عکس پاسخ"/>
                                                </div>
                                                <div class="form-group row col-6">
                                                    <button type="button" class="btn btn-info ml-2 createAnswer" onclick="createAnswer(0)">
                                                        پاسخ بخش جدید
                                                    </button>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="">بارگذاری تصویر یا نمودار سوال:</label>
                                                    <input type="file" name="image[]" class="form-control col-6" />
                                                </div>
                                            </div>
                                        </div>
                                            <div class="form-group row mr-2 col-6">
                                                <button type="button" class="btn btn-info ml-2 createTest">
                                                    سوال جدید
                                                </button>
                                            </div>
                                    </div>
                                    <hr>
                                    <div class="col-12 row">
                                        <div class="form-group col-6">
                                            <label for="topic">زمان پیشنهادی</label>
                                            <input type="text" name="suggestedTime" class="form-control bs-timepicker" value="{{ old('suggestedTime', '00:00') }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="start_at">تاریخ فعال شدن پیشنهادی آزمون</label>
                                            <input type="text" name="start_at" id="start_at" class="form-control form-control-sm d-none">
                                            <input type="text" id="start_at_view" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="end_at">تاریخ بسته شدن آزمون</label>
                                            <input type="text" name="end_at" id="end_at" class="form-control form-control-sm d-none">
                                            <input type="text" id="end_at_view" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">بارگذاری پاسخنامه:</label>
                                            <input type="file" name="answerSheet" class="form-control" />
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
                                            <th class="wd-lg-20p"><span>شماره آزمون</span></th>
                                            <th class="wd-lg-20p"><span>موضوع</span></th>
                                            <th class="wd-lg-20p"><span>پایه</span></th>
                                            <th class="wd-lg-20p"><span>نوع آزمون</span></th>
{{--                                            <th class="wd-lg-20p"><span>زمانبندی آزمون</span></th>--}}
{{--                                            <th class="wd-lg-20p"><span>شیوه ارائه</span></th>--}}
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($exams as $key => $exam)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $exam->number }}</td>
                                                <td>{{ $exam->examable->title }}</td>
                                                <td>{{ $exam->examable->book->lesson->grade->title }}</td>
                                                <td>@if($exam->type === null)تعیین نشده@elseif($exam->type == 0)تعیین سطح@elseif($exam->type == 1)تیرماه@elseif($exam->type == 2)دی‌ماه@endif</td>
{{--                                                <td>@if($exam->scheduling === null)تعیین نشده@elseif($exam->scheduling == 0)هفتگی آنلاین@elseif($exam->scheduling == 1)دو هفته آنلاین@elseif($exam->scheduling == 2)آفلاین(تعیین سطح)@endif</td>--}}
{{--                                                <td>@if($exam->period === null)تعیین نشده@elseif($exam->period == 3)دوازدهم ترم + اول دهم@elseif($exam->period == 4)دوازدهم + ترم اول یازدهم@elseif($exam->period == 5)هر سه پایه همزمان@endif</td>--}}
                                                <td class="d-flex justify-content-center">
{{--                                                    <a href="#" class="btn btn-success btn-sm ml-2">--}}
{{--                                                        <i class="fe fe-edit-2"></i>--}}
{{--                                                    </a>--}}
{{--                                                    <form action="#" method="post">--}}
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
    <script src="{{ asset('backEnd/timepicker/js/timepicker.js') }}"></script>
    <script>
            $('.bs-timepicker').timepicker();
    </script>
    <script src="{{ asset('backEnd/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('backEnd/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#start_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_at',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            })
        });
        $(document).ready(function() {
            $('#end_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_at',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            })
        });
    </script>
    <script>
        $(document).ready(function () {
            var questionCounter = 0;
            $('.createTest').click(function () {
                questionCounter = questionCounter + 1
                $('#createTestDiv').append(`<div class="col-xl-12 col-md-12 offset-3">
                                                <div class="form-group col-12 row" >
                                                    <label for="question">صورت سوال</label>
                                                    <input type="text" name="question[]" class="form-control col-12"
                                                           placeholder="صورت سوال مورد نظر خود را وارد کنید" >
                                                </div>
                                                <div class="form-group col-12 row" id="createAnswerDiv_` + questionCounter + `">
                                                    <input type="text" name="answer_` + questionCounter + `[]" class="form-control col-12" placeholder="پاسخ بخش">
                                                    <input type="text" name="score_` + questionCounter + `[]" class="form-control col-6 mt-1" placeholder="بارم">
                                                    <input type="file" name="answer_image_` + questionCounter + `[]" class="form-control col-6 mt-1" placeholder="'بارگذاری عکس پاسخ"/>
                                                </div>
                                                <div class="form-group row col-6">
                                                    <button type="button" class="btn btn-info ml-2 createAnswer" onclick="createAnswer(` + questionCounter + `)">
                                                        پاسخ بخش جدید
                                                    </button>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="">بارگذاری تصویر یا نمودار سوال:</label>
                                                    <input type="file" name="image[]" class="form-control col-6" />
                                                </div>
                                            </div>`)
            });
        });
    </script>
    <script>
        function createAnswer(id){
            divName =  "#createAnswerDiv_" + id
            $(divName).append(`<input type="text" name="answer_` + id + `[]" class="form-control col-12 mt-2" placeholder="پاسخ بخش">
                               <input type="text" name="score_` + id + `[]" class="form-control col-6 mt-1" placeholder="بارم">
                                <input type="file" name="answer_image_` + id + `[]" class="form-control col-6 mt-1" placeholder="'بارگذاری عکس پاسخ"/>`)
        }
    </script>
@endsection
