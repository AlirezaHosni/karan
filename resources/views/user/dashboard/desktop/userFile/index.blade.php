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
                                    <h3 class="font-weight-bold">فایل‌های ذخیره شده</h3>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('user.dashboard.UserFile.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-10 d-none mb-2" id="send-file-div">
                                        <div class="row col-12">
                                            <div class="col-12">
                                                <label for="agent_image" class="form-label">فایل:</label>
                                                <div class="drop-zone col-12">
                                                    <span class="drop-zone__prompt">بارگذاری فایل</span>
                                                    <input type="file" name="file" required id="drag1" class="drop-zone__input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mr-200 col-2 m-2">
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
                                                        <th class="wd-lg-8p"><span>فایل</span></th>
                                                        <th class="wd-lg-20p text-center">عمل</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($userFiles as $key => $userFile)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td class="text-right">{{  jalaliDate($userFile->created_at, "%Y / %m / %d") }}</td>
                                                            <td ><a href="{{ asset($userFile->file) }}" class="btn btn-sm btn-primary" download>دانلود</a></td>
                                                            <td class="d-flex justify-content-center">
                                                                <a href="{{ route('user.dashboard.UserFile.edit', $userFile->id) }}" class="btn btn-success btn-sm ml-2">
                                                                    <i class="fe fe-edit-2"></i>
                                                                </a>
                                                                <form action="{{ route('user.dashboard.UserFile.destroy', $userFile->id) }}" method="post">
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
                                        <div class="col-12 d-none" id="file-name-div">
                                            <label for="description" class="form-label">نام فایل را انتخاب کنید</label>
                                            <input type="text" name="description" id="description" class="form-control flex-wrap">
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
        let listSendFileButtonStatus = 0;
        $('#list-send-file-button').click(function (){
            let listFilesDiv = $('#list-file-div')
            let sendFilesDiv = $('#send-file-div')
            let fileNameDiv = $('#file-name-div')
            if (listSendFileButtonStatus === 0){
                listFilesDiv.addClass('d-none')
                sendFilesDiv.removeClass('d-none')
                fileNameDiv.removeClass('d-none')
                $(this).text('لیست فایل‌ها')
                listSendFileButtonStatus = 1;
            }
            else if(listSendFileButtonStatus === 1){
                listFilesDiv.removeClass('d-none')
                sendFilesDiv.addClass('d-none')
                fileNameDiv.addClass('d-none')
                $(this).text('ارسال فایل‌')
                listSendFileButtonStatus = 0;
            }
        });
    </script>
@endsection
