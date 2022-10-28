@extends('user.dashboard.layouts.master')
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
                                    <h3 class="font-weight-bold">ارتباط با ما</h3>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('user.dashboard.contactUs.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-10 d-none" id="send-file-div">
                                        <div class="row col-12">
                                            <div class="col-6">
                                                <div class="form-group ">
                                                    <label for="editor1" class="form-label">توضیحات:</label>
                                                    <textarea name="description" id="editor1" rows="9" style="resize: none;">{{ old('description') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="agent_image" class="form-label">فایل:</label>
                                                <div class="drop-zone col-12">
                                                    <span class="drop-zone__prompt">بارگذاری فایل</span>
                                                    <input type="file" name="file" required id="drag1" class="drop-zone__input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mr-200 col-2">
                                            <input type="submit" value="ثبت" class="btn btn-primary float-right btn-block " style="border-radius: 10px;">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-10" id="list-file-div">
                                        @include('alert.alert')
                                        <div class="card-body">
                                            <div class="table-responsive border userlist-table">
                                                <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th class="wd-lg-8p"><span> ردیف</span></th>
                                                        <th class="wd-lg-8p text-right"><span>تاریخ</span></th>
                                                        <th class="wd-lg-8p"><span>نوع</span></th>
                                                        <th class="wd-lg-20p text-center">عمل</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($userFiles as $key => $userFile)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td class="text-right">{{  jalaliDate($userFile->created_at, "%Y / %m / %d") }}</td>
                                                            <td >@if($userFile->type === 0)فایل ارسالی علمی@elseif($userFile->type === 1)انتقادات@elseif($userFile->type === 2)پیشنهادات@elseif($userFile->type === 3)سوالات مطرح شده@endif</td>
                                                            <td class="d-flex justify-content-center">
                                                                <a href="{{ asset($userFile->file) }}" class="btn btn-primary mx-1" download>دانلود</a>
                                                                <form action="{{ route('user.dashboard.contactUs.destroy', $userFile->id) }}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button class="btn btn-danger btn-sm" type="submit">
                                                                        <i class="fe fe-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 sidebar-left text-center mb-2">
                                        <button type="button" class="btn btn-dark mb-2" id="list-send-file-button">ارسال فایل</button>
                                        <div class="list-group col-12 w-100 btn-group justify-content-center d-none" id="choose-file-type-div" data-toggle="buttons">
                                            <p class="mb-2">یکی از موارد زیر را انتخاب کنید</p>
                                            <label class="btn list-group-item border rounded col-12 mb-1">
                                                <input type="radio" name="type" value="0" hidden>ارسال فایل های علمی
                                                متنی / تصویری
                                            </label>
                                            <label class="btn list-group-item border rounded col-12 mb-1">
                                                <input type="radio" name="type" value="1" hidden>انتقادات
                                                صوتی / متنی / تصویری
                                            </label>
                                            <label class="btn list-group-item border rounded col-12 mb-1">
                                                <input type="radio" name="type" value="3" hidden>سواالت مربوط به سایت
                                                صوتی / متنی / تصویری
                                            </label>
                                            <label class="btn list-group-item border rounded col-12">
                                                <input type="radio" name="type" value="2" hidden>پیشنهادات
                                                صوتی / متنی / تصویری
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function (){
            $('.alert').fadeOut(1000);
        });
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor1' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        let listSendFileButtonStatus = 0;
        $('#list-send-file-button').click(function (){
            let listFilesDiv = $('#list-file-div')
            let sendFilesDiv = $('#send-file-div')
            let chooseFileTypeDiv = $('#choose-file-type-div')
            if (listSendFileButtonStatus === 0){
                listFilesDiv.addClass('d-none')
                sendFilesDiv.removeClass('d-none')
                chooseFileTypeDiv.removeClass('d-none')
                $(this).text('لیست فایل‌ها')
                listSendFileButtonStatus = 1;
            }
            else if(listSendFileButtonStatus === 1){
                listFilesDiv.removeClass('d-none')
                sendFilesDiv.addClass('d-none')
                chooseFileTypeDiv.addClass('d-none')
                $(this).text('ارسال فایل‌')
                listSendFileButtonStatus = 0;
            }
        });
    </script>
@endsection
