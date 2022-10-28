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
                            @include('alert.alert')
                            <form action="{{ route('education.AppendicesAttachmentsStore') }}" method="post" id="form" enctype="multipart/form-data">
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
                                <div class="card-header border-bottom-0 pb-0">
                                    <div class="card-body">
                                        <ul class="list-group list-group-horizontal col-12 w-100">
                                            <li class="list-group-item col-3">
                                                <a class="page-link py-10 @if($type === null or !isset($type)) text-white bg-info @endif" href="{{ route('education.AppendicesAttachmentsIndex') }}">همه</a>
                                            </li>
                                            <li class="list-group-item col-3">
                                                <a class="page-link py-10 @if($type === '0') text-white bg-info @endif" href="{{ route('education.AppendicesAttachmentsIndex', 0) }}">خلاصه درس/فصل</a>
                                            </li>
                                            <li class="list-group-item col-3">
                                                <a class="page-link py-10 @if($type === '1') text-white bg-info @endif" href="{{ route('education.AppendicesAttachmentsIndex', 1) }}">جدول افقی عمودی</a>
                                            </li>
                                            <li class="list-group-item col-3 ">
                                                <a class="page-link py-10 @if($type === '2') text-white bg-info @endif" href="{{ route('education.AppendicesAttachmentsIndex', 2) }}">پیوست ها </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row col-12">
                                    <div class="col-12 row h-auto">
                                        <div id="attachmentDiv" class="col-12 row">
                                            <div class="form-group col-6">
                                                <label for="">بارگذاری ویدیو/جزوه:</label>
                                                <input type="file" name="attachments[]" class="form-control" />
                                            </div>
                                            <div class="form-check form-check-inline  col-5  pt-4">
                                                    <input class="form-check-input ml-1" type="radio" name="type0" id="type0" value="0">
                                                    <label class="form-check-label form-label" for="type0">خلاصه درس/فصل</label>
                                                    <input class="form-check-input ml-1" type="radio" name="type0" id="type1" value="1">
                                                    <label class="form-check-label form-label" for="type1">جدول افقی عمودی</label>
                                                    <input class="form-check-input ml-1" type="radio" name="type0" id="type2" value="2">
                                                    <label class="form-check-label form-label" for="type2">پیوست ها </label>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group row mr-2 col-6">
                                            <button type="button" class="btn btn-info ml-2 createAttachment">
                                                ویدیو/جزوه جدید
                                            </button>
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
@section('js')
    <script>
        $(document).ready(function () {
            var counter = 0;
            $('.createAttachment').click(function () {
                counter = counter + 1;
                $('#attachmentDiv').append(`<div class="form-group col-6">
                                            <label for="">بارگذاری ویدیو/جزوه:</label>
                                            <input type="file" name="attachments[]" class="form-control" />
                                        </div>
                                        <div class="form-check form-check-inline  col-5  pt-4">
                                                    <input class="form-check-input ml-1" type="radio" name="type` + counter +`" id="type0" value="0">
                                                    <label class="form-check-label form-label" for="type0">خلاصه درس/فصل</label>
                                                    <input class="form-check-input ml-1" type="radio" name="type` + counter +`" id="type1" value="1">
                                                    <label class="form-check-label form-label" for="type1">جدول افقی عمودی</label>
                                                    <input class="form-check-input ml-1" type="radio" name="type` + counter +`" id="type2" value="2">
                                                    <label class="form-check-label form-label" for="type2">پیوست ها </label>
                                            </div>`)
            });
        });
    </script>
@endsection
