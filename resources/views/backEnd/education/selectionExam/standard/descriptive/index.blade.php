@extends('backEnd.layouts.master')
@section('head-tag')
    <link rel="stylesheet" href="{{ asset('backEnd/timepicker/css/timepicker.css') }}">
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
                                    <h3 class="font-weight-bold">آزمون انتخابی</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="card-header border-bottom-0 pb-0 col-12 justify-content-center">
                                <div class="card-body pt-0">
                                    <ul class="list-group list-group-horizontal col-12 w-100">
                                        <li class="list-group-item col-6">
                                            <a class="page-link py-10" href="{{ route('education.selectionExam.topic.descriptiveTest.Index') }}">موضوعی</a>
                                        </li>
                                        <li class="list-group-item col-6">
                                            <a class="page-link py-10 text-white bg-info" href="{{ route('education.selectionExam.standard.descriptiveTest.Index') }}">استاندارد</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <form action="{{ route('education.selectionExam.standard.descriptiveTest.Store') }}" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <div class="row-cols-2 row">
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
                                            <label for="session_id">فصل مورد نظر را بنویسید:</label>
                                            <select name="session_id"  class="form-control" id="sessionOptions">
                                            </select>
                                        </div>
                                        <div class="card-body col-6">
                                            <div class="list-group list-group-horizontal col-12 w-100 btn-group" data-toggle="buttons">
                                                <label class="btn list-group-item col-4">
                                                    <input type="radio" name="period" id="period0" value="0" hidden>ترم اول
                                                </label>
                                                <label class="btn list-group-item col-4">
                                                    <input type="radio" name="period" id="period1" value="1" hidden>ترم دوم
                                                </label>
                                                <label class="btn list-group-item col-4">
                                                    <input type="radio" name="period" id="period2" value="2" hidden>کل کتاب
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="number">شماره آزمون:</label>
                                            <input type="text" value="{{ old('number') }}" name="number" id="number" class="form-control">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="topic">زمان پیشنهادی</label>
                                            <input type="text" name="suggestedTime" class="form-control bs-timepicker" value="{{ old('suggestedTime', '00:00') }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="topic"></label>
                                            <ul class="list-group list-group-horizontal col-12">
                                                <li class="list-group-item col-6">
                                                    <a class="page-link py-10" href="{{ route('education.selectionExam.standard.test.Index') }}">تستی</a>
                                                </li>
                                                <li class="list-group-item col-6">
                                                    <a class="page-link py-10 text-white bg-info" href="{{ route('education.selectionExam.standard.descriptiveTest.Index') }}">تشریحی</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="form-group col-6 pt-4" >
                                            <label for="">بارگذاری پاسخنامه:</label>
                                            <input type="file" name="answerSheet" class="form-control" />
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
                                            <button type="submit" class="btn btn-info">
                                                ثبت
                                            </button>
                                        </div>
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
                                            <th class="wd-lg-20p"><span>فصل</span></th>
                                            <th class="wd-lg-20p"><span>نوع آزمون</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($exams as $key => $exam)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $exam->number }}</td>
                                                <td>{{ $exam->examable->session }}</td>
                                                <td>@if($exam->period === null)تعیین نشده@elseif($exam->period == 0)ترم اول@elseif($exam->period == 1)ترم دوم@elseif($exam->period == 2)کل کتاب@endif</td>
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
