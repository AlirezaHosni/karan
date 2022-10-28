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
                            @include('alert.alert')
                            <form action="{{ route('education.IntroduceBookAttachmentsStore') }}" method="post" class="col-12" id="form" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                <div class="row-cols-2 row">
                                    <div class="form-group col-6">
                                        <label for="grade_id" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                        <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                            <option></option>
                                            @foreach($grades as $grade)
                                                <option value="{{ $grade->id }}" @if(old('grade_id') == $grade->id) selected @endif>{{$grade->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="lesson_id" class="form-label">کتاب مورد نظر را انتخاب کنید:</label>
                                        <select name="lesson_id" class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body col-12">
                                <div class="list-group list-group-horizontal col-12 w-100 btn-group" data-toggle="buttons">
                                    <label class="btn list-group-item col-3">
                                        <input type="radio" name="type" id="type0" value="0" hidden>بیوگرافی و فلسفه کتاب
                                    </label>
                                    <label class="btn list-group-item col-3">
                                        <input type="radio" name="type" id="type1" value="1" hidden> کتاب در کنکور
                                    </label>
                                    <label class="btn list-group-item col-3">
                                        <input type="radio" name="type" id="type2" value="2" hidden>کتاب در امتحان پایانی
                                    </label>
                                    <label class="btn list-group-item col-3">
                                        <input type="radio" name="type" id="type3" value="3" hidden>نحوه مطالعه کتاب
                                    </label>
                                </div>
                            </div>
                            <hr>
                            <div class="row col-12">
                                <div class="col-12 row h-auto">
                                    <div id="attachmentDiv" class="col-12">
                                        <div class="form-group col-6">
                                            <label for="" class="form-label">بارگذاری ویدیو/جزوه:</label>
                                            <input type="file" name="attachments[]" class="form-control">
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
                                                    <a href="{{ route('education.IntroduceBookAttachments.edit',$document->documentable->id) }}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{ route('education.IntroduceBookAttachments.destroy',$document->documentable->id) }}" method="post">
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
            $('.createAttachment').click(function () {
                $('#attachmentDiv').append(`<div class="form-group col-6">
                                            <label for="">بارگذاری ویدیو/جزوه:</label>
                                            <input type="file" name="attachments[]" class="form-control" />
                                        </div>`)
            });
        });
        $('#form').submit(function (){
                let file = $('input[type="file"]').target.files[0]
                let channelId = "34696f5d-dc28-482c-a6f5-bafc721aaad5"
                let authorization = "{{ \Illuminate\Support\Facades\Config::get('app.arvan_cloud_api_key') }}";

                let options = {
                    "url": `https://napi.arvancloud.com/vod/2.0/channels/${channelId}/files`,
                    "authorization": `${authorization}`,
                    "acceptLanguage": "en",
                    "uuid": file.name + file.size + file.lastModified
                }

                let upload = new tus.Upload(file, {
                    fingerprint: () => {
                        return options.uuid
                    },
                    resume: true,
                    chunkSize: 1048576, // 1MB
                    endpoint: options.url,
                    retryDelays: [0, 500, 1000, 1500, 2000, 2500],
                    headers: {
                        'Authorization': options.authorization,
                        'Accept-Language': options.acceptLanguage
                    },
                    metadata: {
                        filename: file.name,
                        filetype: file.type
                    },
                    onError: function (error) {
                        console.log("Failed because: " + error)
                    },
                    onProgress: function (bytesUploaded, bytesTotal) {
                        var percentage = (bytesUploaded / bytesTotal * 100).toFixed(2)
                        console.log(bytesUploaded, bytesTotal, percentage + "%")
                    },
                    onSuccess: function () {
                        console.log("Download %s from %s", upload.file.name, upload.url)
                    }
                })
                let result = upload.start()
                $('#file_id').val(result)
            });

    </script>
@endsection
