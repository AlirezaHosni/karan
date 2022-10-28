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
                                            <a class="page-link py-10 text-white bg-info" href="{{ route('education.planExam.test.Index') }}">تستی</a>
                                        </li>
                                        <li class="list-group-item col-6">
                                            <a class="page-link py-10 " href="{{ route('education.planExam.descriptive.Index') }}">تشریحی</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <form action="{{ route('education.planExam.test.Store') }}" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <div class="row-cols-2 row">
                                        <div class="form-group col-6">
                                            <label for="exam-type" class="form-label">نوع آزمون را انتخاب کنید:</label>
                                            <select name="type"  id="exam-type" class="form-control">
                                                <option></option>
                                                <option value="1" @if(old('type') === 1) selected @endif>تیرماه</option>
                                                <option value="2" @if(old('type') === 2) selected @endif>دی‌ماه</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6" id="scheduling-div">
                                            <label for="scheduling" class="form-label">زمانبندی آزمون را انتخاب کنید:</label>
                                            <select name="scheduling"  id="scheduling" class="form-control">
                                                <option value="0" @if(old('scheduling') == 0) selected @endif>هفتگی آنلاین</option>
                                                <option value="1" @if(old('scheduling') == 1) selected @endif>دو هفته آنلاین</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="number" class="form-label">شماره آزمون:</label>
                                            <input type="text" value="{{ old('number') }}" name="number" id="number" class="form-control">
                                        </div>
                                        <div class="form-group col-6" id="period-div">
                                            <label for="period" class="form-label">شیوه ارائه آزمون را انتخاب کنید:</label>
                                            <select name="period"  id="period" class="form-control">
                                                <option value="3" @if(old('period') == 0) selected @endif>دوازدهم + ترم اول دهم</option>
                                                <option value="4" @if(old('period') == 1) selected @endif>دوازدهم + ترم اول یازدهم</option>
                                                <option value="5" @if(old('period') == 2) selected @endif>هر سه پایه همزمان</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="gradeOptions" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                            <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                                <option value=""></option>
                                                @foreach($grades as $grade)
                                                    <option value="{{$grade->id}}" @if(old('grade_id') == $grade->id) selected @endif>{{$grade->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6" >
                                            <label for="lessonOptions" class="form-label">کتاب مورد نظر را انتخاب کنید:</label>
                                            <select name="lesson_id"  class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="sessionOptions" class="form-label">فصل مورد نظر را بنویسید:</label>
                                            <select name="session"  class="form-control" id="sessionOptions" data-url="{{ route('searchParts') }}">
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="partOptions" class="form-label">بخش مورد نظر را بنویسید:</label>
                                            <select name="part"  class="form-control" id="partOptions" data-url="{{ route('searchTopics') }}">
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="topicOptions" class="form-label">موضوع مورد نظر را انتخاب کنید:</label>
                                            <select name="topic_id" class="form-control" id="topicOptions">
                                            </select>
                                        </div>
                                        <div class="form-group col-12" id="createTestDiv">
                                            <label for="topic">انتخاب قالب سوال</label>
                                            <div class="list-group list-group-horizontal col-12 w-100 btn-group" data-toggle="buttons">
                                                <label class="btn list-group-item col-3">
                                                    <img src="{{ asset('testFormat/1.PNG') }}">
                                                    <input type="radio" name="testFormat0" id="testFormat1" value="1" hidden>
                                                </label>
                                                <label class="btn list-group-item col-3">
                                                    <img src="{{ asset('testFormat/2.PNG') }}">
                                                    <input type="radio" name="testFormat0" id="testFormat2" value=2" hidden>
                                                </label>
                                                <label class="btn list-group-item col-3">
                                                    <img src="{{ asset('testFormat/3.PNG') }}">
                                                    <input type="radio" name="testFormat0" id="testFormat3" value="3" hidden>
                                                </label>
                                                <label class="btn list-group-item col-3">
                                                    <img src="{{ asset('testFormat/4.PNG') }}">
                                                    <input type="radio" name="testFormat0" id="testFormat4" value="4" hidden>
                                                </label>
                                            </div>
                                            <div class="col-xl-12 col-md-12 offset-3">
                                                <div class="form-group col-12" >
                                                    <label for="question" class="form-label">صورت سوال</label>
                                                    <input type="text" name="question[]" class="form-control col-12"
                                                           placeholder="صورت سوال مورد نظر خود را وارد کنید" >
                                                </div>
                                                <div class="form-group col-12 row mr-1">
                                                    <input type="text" name="answerOne[]" class="form-control col-9" placeholder="گزینه 1">
                                                    <input type="file" name="answerOneImage[]" class="form-control col-3">
                                                    <input type="text" name="answerTwo[]" class="form-control col-9" placeholder="گزینه 2">
                                                    <input type="file" name="answerTwoImage[]" class="form-control col-3">
                                                    <input type="text" name="answerThree[]" class="form-control col-9" placeholder="گزینه 3">
                                                    <input type="file" name="answerThreeImage[]" class="form-control col-3">
                                                    <input type="text" name="answerFour[]" class="form-control col-9" placeholder="گزینه 4">
                                                    <input type="file" name="answerFourImage[]" class="form-control col-3">
                                                    <input type="number" name="True[]" class="form-control col-6" placeholder="جواب صحیح">
                                                </div>
                                                <div class="col-12 row">
                                                    <div class="form-group col-6">
                                                        <label for="">بارگذاری تصویر یا نمودار سوال:</label>
                                                        <input type="file" name="image[]" class="form-control"/>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="question_level">سطح سوال را انتخاب کنید:</label>
                                                        <select name="question_level[]"  id="question_level" class="form-control">
                                                            <option value="0" @if(old('question_level') == 0) selected @endif>آسان</option>
                                                            <option value="1" @if(old('question_level') == 1) selected @endif>متوسط</option>
                                                            <option value="2" @if(old('question_level') == 2) selected @endif>سخت</option>
                                                        </select>
                                                    </div>
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
                                            <label for="suggestedTime" class="form-label">زمان پیشنهادی</label>
                                            <input type="text" name="suggestedTime" id="suggestedTime" class="form-control bs-timepicker" value="{{ old('suggestedTime', '00:00') }}">
                                        </div>
                                        <div class="form-group col-6" id="start-at-div">
                                            <label for="start_at" class="form-label">تاریخ فعال شدن پیشنهادی آزمون</label>
                                            <input type="text" name="start_at" id="start_at" class="form-control form-control-sm d-none">
                                            <input type="text" id="start_at_view" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="answerSheet" class="form-label">بارگذاری پاسخنامه:</label>
                                            <input type="file" name="answerSheet" id="answerSheet" class="form-control" />
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
    </script>
    <script>
        $(document).ready(function () {
            var counter = 0;
            $('.createTest').click(function () {
                counter = counter + 1;
                console.log(counter)
                $('#createTestDiv').append(`<label for="topic">انتخاب قالب سوال</label>
                                            <div class="list-group list-group-horizontal col-12 w-100 btn-group" data-toggle="buttons">
                                                <label class="btn list-group-item col-3">
                                                    <img src="http://127.0.0.1:8000/testFormat/1.PNG">
                                                    <input type="radio" name="testFormat` + counter + `" id="testFormat1" value="1" hidden>
                                                </label>
                                                <label class="btn list-group-item col-3">
                                                    <img src="http://127.0.0.1:8000/testFormat/2.PNG">
                                                    <input type="radio" name="testFormat` + counter + `" id="testFormat2" value=2" hidden>
                                                </label>
                                                <label class="btn list-group-item col-3">
                                                    <img src="http://127.0.0.1:8000/testFormat/3.PNG">
                                                    <input type="radio" name="testFormat` + counter + `" id="testFormat3" value="3" hidden>
                                                </label>
                                                <label class="btn list-group-item col-3">
                                                    <img src="http://127.0.0.1:8000/testFormat/4.PNG">
                                                    <input type="radio" name="testFormat` + counter + `" id="testFormat4" value="4" hidden>
                                                </label>
                                            </div>
                                            <div class="col-xl-12 col-md-12 offset-3">
                                                <div class="form-group col-12" >
                                                    <label for="question">صورت سوال</label>
                                                    <input type="text" name="question[]" class="form-control col-12"
                                                           placeholder="صورت سوال مورد نظر خود را وارد کنید" >
                                                </div>
                                                <div class="form-group col-12 row mr-1">
                                                    <input type="text" name="answerOne[]" class="form-control col-9" placeholder="گزینه 1">
                                                    <input type="file" name="answerOneImage[]" class="form-control col-3">
                                                    <input type="text" name="answerTwo[]" class="form-control col-9" placeholder="گزینه 2">
                                                    <input type="file" name="answerTwoImage[]" class="form-control col-3">
                                                    <input type="text" name="answerThree[]" class="form-control col-9" placeholder="گزینه 3">
                                                    <input type="file" name="answerThreeImage[]" class="form-control col-3">
                                                    <input type="text" name="answerFour[]" class="form-control col-9" placeholder="گزینه 4">
                                                    <input type="file" name="answerFourImage[]" class="form-control col-3">
                                                    <input type="number" name="True[]" class="form-control col-6" placeholder="جواب صحیح">
                                                </div>
                                                <div class="col-12 row">
                                                    <div class="form-group col-6">
                                                        <label for="">بارگذاری تصویر یا نمودار سوال:</label>
                                                        <input type="file" name="image[]" class="form-control"/>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="question_level">سطح سوال را انتخاب کنید:</label>
                                                        <select name="question_level[]"  id="question_level" class="form-control">
                                                            <option value="0"  selected >آسان</option>
                                                            <option value="1"  selected >متوسط</option>
                                                            <option value="2"  selected >سخت</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>`)
            });
        });
    </script>
    <script>
        $('#exam-type').change(function () {
            let value = $(this).val()
            console.log(value)
            let schedulingDiv = $('#scheduling-div')
            let periodDiv = $('#period-div')
            let startAtDiv = $('#start-at-div')
            if (value === '0'){
                console.log(value)
                schedulingDiv.addClass('d-none')
                periodDiv.addClass('d-none')
                periodDiv.addClass('d-none')
                startAtDiv.addClass('d-none')
            }
            else if (value === '1'){
                console.log(value)
                schedulingDiv.removeClass('d-none')
                periodDiv.addClass('d-none')
                startAtDiv.removeClass('d-none')
            }
            else if (value === '2'){
                console.log(value)
                schedulingDiv.removeClass('d-none')
                periodDiv.removeClass('d-none')
                startAtDiv.removeClass('d-none')
            }
        })
    </script>
@endsection
