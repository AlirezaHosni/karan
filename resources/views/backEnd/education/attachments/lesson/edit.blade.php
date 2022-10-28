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
                                    <h3 class="font-weight-bold">معرفی کتاب</h3>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('education.IntroduceBookAttachments.update', $introduceBook->id) }}" method="post" class="col-12" id="form" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-12">
                                    <div class="row-cols-2 row">
                                        <div class="form-group col-6">
                                            <label for="grade_id" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                            <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                                <option></option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" @if($introduceBook->lesson->grade_id == $grade->id) selected @endif>{{ $grade->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="lesson_id" class="form-label">کتاب مورد نظر را انتخاب کنید:</label>
                                            <select name="lesson_id" class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                                @foreach($introduceBook->lesson->grade->lessons as $lesson)
                                                    <option value="{{ $lesson->id }}" @if($introduceBook->lesson_id == $lesson->id) selected @endif>{{ $lesson->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body col-12">
                                    <div class="list-group list-group-horizontal col-12 w-100 btn-group" data-toggle="buttons">
                                        <label class="btn list-group-item col-3 @if($introduceBook->type === 0) active @endif">
                                            <input type="radio" name="type" id="type0" value="0" hidden @if($introduceBook->type === 0) checked @endif>بیوگرافی و فلسفه کتاب
                                        </label>
                                        <label class="btn list-group-item col-3 @if($introduceBook->type === 1) active @endif">
                                            <input type="radio" name="type" id="type1" value="1" hidden @if($introduceBook->type === 1) checked @endif> کتاب در کنکور
                                        </label>
                                        <label class="btn list-group-item col-3 @if($introduceBook->type === 2) active @endif">
                                            <input type="radio" name="type" id="type2" value="2" hidden @if($introduceBook->type === 2) checked @endif>کتاب در امتحان پایانی
                                        </label>
                                        <label class="btn list-group-item col-3 @if($introduceBook->type === 3) active @endif">
                                            <input type="radio" name="type" id="type3" value="3" hidden @if($introduceBook->type === 3) checked @endif>نحوه مطالعه کتاب
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row col-12">
                                    @empty(!$introduceBook->document)
                                        <div class="col-12 row">
                                            <label for="attachments" class="form-label">جایگزینی ویدیو/جزوه:</label>
                                            <div class="col-6 row">
                                                <input type="file" name="attachments" class="form-control">
                                            </div>
                                            <div class="col-1">
                                                <a class="btn btn-warning btn-sm" href="{{ asset($introduceBook->document->document) }}" download>دانلود</a>
                                            </div>
{{--                                            <div class="col-1">--}}
{{--                                                <form action="{{ route('education.IntroduceBookAttachments.destroy', $introduceBook->id) }}" method="post">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('delete')--}}
{{--                                                    <button class="btn btn-danger btn-sm" type="submit">--}}
{{--                                                        حذف--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
                                        </div>
                                    @endempty
                                    @empty(!$introduceBook->video)
                                        <div class="col-12 row">
                                            <label for="attachments" class="form-label">جایگزینی ویدیو/جزوه:</label>
                                            <div class="col-6 row">
                                                <input type="file" name="attachments" class="form-control">
                                            </div>
                                            <div class="col-1">
                                                <a class="btn btn-warning btn-sm" href="{{ asset($introduceBook->video->video) }}" download>دانلود</a>
                                            </div>
{{--                                            <div class="col-1">--}}
{{--                                                <form action="{{ route('education.IntroduceBookAttachments.destroy', $introduceBook->id) }}" method="post">--}}
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
                                            <th class="wd-lg-8p"><span> قسمت</span></th>
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
                                                <td>@if($video->videoable->type === 0)بیوگرافی و فلسفه کتاب@elseif($video->videoable->type === 1) کتاب در کنکور@elseif($video->videoable->type === 2)کتاب در امتحان پایانی@elseif($video->videoable->type === 3)نحوه مطالعه کتاب@endif</td>
                                                <td>{{ $video->videoable->lesson->title }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('education.IntroduceBookAttachments.edit', $video->videoable->id) }}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{ route('education.IntroduceBookAttachments.destroy', $video->videoable->id) }}" method="post">
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
                                                <td>@if($document->documentable->type === 0)بیوگرافی و فلسفه کتاب@elseif($document->documentable->type === 1) کتاب در کنکور@elseif($document->documentable->type === 2)کتاب در امتحان پایانی@elseif($document->documentable->type === 3)نحوه مطالعه کتاب@endif</td>
                                                <td>{{ $document->documentable->lesson->title }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('education.IntroduceBookAttachments.edit', $document->documentable->id) }}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{ route('education.IntroduceBookAttachments.destroy', $document->documentable->id) }}" method="post">
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
        $("#submit_form_btn").click(function(){
            $("#form").submit();
        })
    </script>
@endsection
