@extends('user.dashboard.layouts.master')
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
                                    <h3 class="font-weight-bold">ویرایش دفتر برنامه‌ریزی</h3>
                                </div>
                            </div>
                            @include('alert.alert')
                            <form class="col-12 mt-3" action="{{ route('user.dashboard.schedule.update', $schedule) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="col-12">
                                    <div class="row-cols-3 row">
                                        <div class="form-group col-6">
                                            <label for="lessonOptions" class="form-label">کتاب مورد نظر را انتخاب کنید:</label>
                                            <select name="lesson_id"  class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                                <option></option>
                                                @foreach($schedule->topic->book->lesson->grade->lessons as $lesson)
                                                    <option value="{{ $lesson->id }}" @if($schedule->topic->book->lesson_id == $lesson->id) selected @endif>{{ $lesson->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="sessionOptions" class="form-label">فصل مورد نظر را بنویسید:</label>
                                            <select name="session"  class="form-control" id="sessionOptions" data-url="{{ route('searchParts') }}">
                                                @foreach($schedule->topic->book->lesson->books()->where('part', null)->get() as $session)
                                                    <option value="{{ $session->id }}" @if($schedule->topic->book->session == $session->session) selected @endif>{{ $session->session }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row-cols-2 row">
                                        <div class="form-group col-6">
                                            <label for="partOptions" class="form-label">بخش مورد نظر را بنویسید:</label>
                                            <select name="part"  class="form-control" id="partOptions" data-url="{{ route('searchTopics') }}">
                                                @foreach($schedule->topic->book->lesson->books()->whereNotNull('part')->get() as $part)
                                                    <option value="{{ $part->id }}" @if($schedule->topic->book_id == $part->id) selected @endif>{{ $part->part }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="topicOptions" class="form-label">موضوع مورد نظر را انتخاب کنید:</label>
                                            <select name="topic_id" class="form-control" id="topicOptions">
                                                @foreach($schedule->topic->book->topics as $topic)
                                                    <option value="{{ $topic->id }}" @if($schedule->topic->book_id == $topic->id) selected @endif>{{ $topic->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row-cols-2 row">
                                        <div class="form-group col-6" id="start-at-div">
                                            <label for="date" class="form-label">تاریخ:</label>
                                            <input type="text" name="date" id="date" class="form-control form-control-sm d-none" value="{{ $schedule->start_time }}">
                                            <input type="text" id="date_view" class="form-control form-control-sm" value="{{ $schedule->start_time }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="startTime" class="form-label">زمان شروع:</label>
                                            <input type="text" name="startTime" id="startTime" class="form-control bs-timepicker" value="{{ old('startTime', jalaliDate($schedule->start_time, 'H:i')) }}">
                                        </div>
                                    </div>
                                    <div class="row-cols-2 row">
                                        <div class="form-group col-6">
                                            <label for="endTime" class="form-label">زمان پایان:</label>
                                            <input type="text" name="endTime" id="endTime" class="form-control bs-timepicker" value="{{ old('endTime', jalaliDate($schedule->end_time, 'H:i')) }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="type" class="form-label">نوع یادگیری را انتخاب کنید:</label>
                                            <select name="type" class="form-control" id="type">
                                                <option value="0" @if(old('type', $schedule->type) == 0) selected @endif>مطالعه</option>
                                                <option value="1" @if(old('type', $schedule->type) == 1) selected @endif>مطالعه و حل سوال تشریحی</option>
                                                <option value="2" @if(old('type', $schedule->type) == 2) selected @endif>حل سوال تشریحی</option>
                                                <option value="3" @if(old('type', $schedule->type) == 3) selected @endif>مطالعه و حل تست</option>
                                                <option value="4" @if(old('type', $schedule->type) == 4) selected @endif>حل تست</option>
                                                <option value="5" @if(old('type', $schedule->type) == 5) selected @endif>آزمون</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 row" >
                                    <div class="form-group col-12" >
                                        <label for="description" class="form-label">توضیحات:</label>
                                        <textarea dir="rtl" name="description" class="form-control col-12 editor" id="description">{{ old('description', $schedule->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 my-4 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success col-2">
                                        ‌ذخیره
                                    </button>
                                </div>
                            </form>
                            <div class="card-header border-bottom-0 pb-0">
                                <hr>
                                <div class="card-body">
                                    <p>نمایش بر مبنای:</p>
                                    <ul class="list-group list-group-horizontal col-12 w-100">
                                        <li class="list-group-item col-4">
                                            <a class="page-link py-10 @if($type == 'month') text-white bg-info @endif" href="{{ route('user.dashboard.schedule.edit', ['schedule' => $schedule, 'type' => 'month']) }}">برنامه ماهیانه</a>
                                        </li>
                                        <li class="list-group-item col-4">
                                            <a class="page-link py-10 @if($type == 'week') text-white bg-info @endif" href="{{ route('user.dashboard.schedule.edit', ['schedule' => $schedule, 'type' => 'week']) }}"> برنامه هفتگی</a>
                                        </li>
                                        <li class="list-group-item col-4">
                                            <div class="dropdown">
                                                <button class="btn @if($type == 'lesson') btn-primary @else btn-white @endif dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    برنامه کتاب مورد نظر
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @foreach($lessons as $lesson)
                                                        <a href="{{ route('user.dashboard.schedule.edit', ['schedule' => $schedule, 'type' => 'lesson', 'lesson' => $lesson->id]) }}" class="dropdown-item">{{ $lesson->title }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                            </div>
                            <div class="col-12" id="list-file-div">
                                <div class="card-body">
                                    <div class="table-responsive border userlist-table">
                                        <table class="table card-table table-striped table-bordered table-vcenter text-nowrap mb-0">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>ساعت</th>
                                                <th>۶ صبح</th>
                                                <th colspan="35" class="text-center">تایم لاین زمان</th>
                                                <th>۱۲ شب</th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">روز و تاریخ</th>
                                                <th>۶:۰۰</th>
                                                <th>۶:۳۰</th>
                                                <th>۷:۰۰</th>
                                                <th>۷:۳۰</th>
                                                <th>۸:۰۰</th>
                                                <th>۸:۳۰</th>
                                                <th>۹:۰۰</th>
                                                <th>۹:۳۰</th>
                                                <th>۱۰:۰۰</th>
                                                <th>۱۰:۳۰</th>
                                                <th>۱۱:۰۰</th>
                                                <th>۱۱:۳۰</th>
                                                <th>۱۲:۰۰</th>
                                                <th>۱۲:۳۰</th>
                                                <th>۱۳:۰۰</th>
                                                <th>۱۳:۳۰</th>
                                                <th>۱۴:۰۰</th>
                                                <th>۱۴:۳۰</th>
                                                <th>۱۵:۰۰</th>
                                                <th>۱۵:۳۰</th>
                                                <th>۱۶:۰۰</th>
                                                <th>۱۶:۳۰</th>
                                                <th>۱۷:۰۰</th>
                                                <th>۱۷:۳۰</th>
                                                <th>۱۸:۰۰</th>
                                                <th>۱۸:۳۰</th>
                                                <th>۱۹:۰۰</th>
                                                <th>۱۹:۳۰</th>
                                                <th>۲۰:۰۰</th>
                                                <th>۲۰:۳۰</th>
                                                <th>۲۱:۰۰</th>
                                                <th>۲۱:۳۰</th>
                                                <th>۲۲:۰۰</th>
                                                <th>۲۲:۳۰</th>
                                                <th>۲۳:۰۰</th>
                                                <th>۲۳:۳۰</th>
                                                <th>۲۴:۰۰</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($schedules as $date => $sameDateSchedules)
                                                    <tr>
                                                        <td class="text-right">{{ $date }}</td>
                                                        @foreach($sameDateSchedules as $schedule)
                                                            @php
                                                                $startTime = \Morilog\Jalali\Jalalian::forge($schedule->start_time);
                                                                $endTime = \Morilog\Jalali\Jalalian::forge($schedule->end_time);
                                                                $halfHourCountBetweenStartAndEnd = (($endTime->getHour() * 60 + $endTime->getMinute()) - ($startTime->getHour() * 60 + $startTime->getMinute())) / 30 + 1;
                                                                $emptyHalfHourCountBeforeStart = ($startTime->getHour() * 60 + $startTime->getMinute()) / 30;
                                                                if (isset($halfHourCountUntilEnd) and $halfHourCountUntilEnd !== null)
                                                                    $emptyHalfHourCountBeforeStart -= $halfHourCountUntilEnd;
                                                                else
                                                                    $emptyHalfHourCountBeforeStart -= 11;
                                                                $halfHourCountUntilEnd = (($endTime->getHour()) * 60 + $endTime->getMinute()) / 30 + 1;
                                                            @endphp
                                                            @for($i=0;$i < $emptyHalfHourCountBeforeStart;$i++)
                                                                <td></td>
                                                            @endfor
                                                            <td colspan="{{ $halfHourCountBetweenStartAndEnd }}"><a href="{{ route('user.dashboard.schedule.edit', $schedule->id) }}" class="text-dark">{{ $schedule->topic->book->lesson->title }} = {{ $schedule->topic->book->session }} @if($schedule->type === 0)(مطالعه)@elseif($schedule->type === 1)(مطالعه و حل سوال تشریحی)@elseif($schedule->type === 2)(حل سوال تشریحی)@elseif($schedule->type === 3)(مطالعه و حل تست)@elseif($schedule->type === 4)(حل تست)@elseif($schedule->type === 5)(آزمون)@endif</a></td>
                                                        @endforeach
                                                        @php
                                                            $halfHourCountUntilEndOfDay = 49 - $halfHourCountUntilEnd;
                                                        @endphp
                                                        @for($i=0;$i < $halfHourCountUntilEndOfDay;$i++)
                                                            <td></td>
                                                        @endfor
                                                    </tr>
                                                    @php
                                                        $halfHourCountUntilEnd = null;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
        $(document).ready(function () {
            $('.alert').fadeOut(1000);
        });
    </script>
    <script src="{{ asset('backEnd/timepicker/js/timepicker.js') }}"></script>
    <script>
        $('.bs-timepicker').timepicker();
    </script>
    <script src="{{ asset('backEnd/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('backEnd/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#date',
            })
        });
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ), {
                ckfinder : {
                    uploadUrl: "{{ route('ckeditor.upload', ["_token" => csrf_token()]) }}"
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        $('#lessonOptions').change(function (){
            if($(this).val() !== ''){
                var data = {
                    _token: '{{ csrf_token() }}',
                    lesson_id : $(this).val()
                };
                url = $(this).attr('data-url')

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (data) {
                        result = data;
                        $('#sessionOptions').empty();
                        $('#sessionOptions').append('<option value=""></option>');
                        $.each(data, function (i, value) {
                            $('#sessionOptions').append('<option value=' + JSON.stringify(value.id) + '>' + JSON.stringify(value.session) + '</option>');
                        });
                    },
                    error: function error(data) {
                        result = data;
                    },
                })
            }
        });
        //    ---------------------------------------------------------------------------------------------------------
        $('#sessionOptions').change(function (){
            if($(this).val() !== ''){
                var data = {
                    _token: '{{ csrf_token() }}',
                    session_id : $(this).val()
                };
                url = $(this).attr('data-url')

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (data) {
                        result = data;
                        $('#partOptions').empty();
                        $('#partOptions').append('<option value=""></option>');
                        $.each(data, function (i, value) {
                            $('#partOptions').append('<option value=' + JSON.stringify(value.id) + '>' + JSON.stringify(value.part) + '</option>');
                        });
                    },
                    error: function error(data) {
                        result = data;
                    },
                })
            }
        });
        //    ---------------------------------------------------------------------------------------------------------
        $('#partOptions').change(function (){
            if($(this).val() !== ''){
                var data = {
                    _token: '{{ csrf_token() }}',
                    part_id : $(this).val()
                };
                url = $(this).attr('data-url')

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (data) {
                        result = data;
                        $('#topicOptions').empty();
                        $('#topicOptions').append('<option value=""></option>');
                        $.each(data, function (i, value) {
                            $('#topicOptions').append('<option value=' + JSON.stringify(value.id) + '>' + JSON.stringify(value.title) + '</option>');
                        });
                    },
                    error: function error(data) {
                        result = data;
                    },
                })
            }
        });
        //    ---------------------------------------------------------------------------------------------------------
    </script>
@endsection
