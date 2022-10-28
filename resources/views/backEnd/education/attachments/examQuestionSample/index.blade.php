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
                            @include('alert.alert')
                            <form action="{{ route('education.ExamQuestionSampleAttachmentsStore') }}" method="post" id="form" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <div class="row-cols-2 row">
                                        <div class="form-group col-6">
                                            <label for="gradeOptions" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                            <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                                <option></option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" @if(old('grade_id') == $grade->id) selected @endif>{{$grade->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="lessonOptions" class="form-label">کتاب مورد نظر را انتخاب کنید:</label>
                                            <select name="lesson_id"  class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="sessionOptions" class="form-label">فصل/درس مورد نظر را انتخاب کنید:</label>
                                            <select name="session_id" class="form-control" id="sessionOptions">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row col-12">
                                    <div class="card-body col-12">
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
                                    <hr>
                                    <div class="card-body col-12 justify-content-center">
                                        <div class="list-group list-group-horizontal col-12 w-100 btn-group d-flex justify-content-center" data-toggle="buttons">
                                            <label class="btn list-group-item col-4">
                                                <input type="radio" name="type" id="type0" hidden value="0">تالیفی
                                            </label>
                                            <label class="btn list-group-item col-4">
                                                <input type="radio" name="type" id="type1" hidden value="1">سراسری
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row col-12">
                                        <div class="col-12" id="attachmentDiv">
                                            <div class="form-group col-6 mb-2">
                                                <label for="" class="form-label">بارگذاری ویدیو/جزوه:</label>
                                                <input type="file" name="attachments[]" class="form-control" />
                                            </div>
                                        </div>
                                        <input type="hidden" name="topic_id" id="selected_topic_id" class="form-control" />
                                        <div class="form-group row mr-2 col-12">
                                            <button type="button" class="btn btn-info ml-2 createAttachment">
                                                ویدیو/جزوه جدید
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
@section('js')
    <script>
        $(document).ready(function (){
            $('.alert').fadeOut(1000);
        });
    </script>
    <script>
        $(document).ready(function () {
            var counter = 0;
            $('.createAttachment').click(function () {
                counter = counter + 1;
                $('#attachmentDiv').append(`<div class="form-group col-6">
                                            <label for="">بارگذاری ویدیو/جزوه:</label>
                                            <input type="file" name="attachments[]" class="form-control" />
                                        </div>`)
            });
        });
    </script>
@endsection
