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
                                    <h3 class="font-weight-bold">ویرایش فایل‌های ذخیره شده</h3>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('user.dashboard.UserFile.update', $userFile->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-12 col-md-10 mb-2" id="send-file-div">
                                        <div class="row col-12">
                                            <div class="col-12 mb-2">
                                                <label for="description" class="form-label">نام فایل:</label>
                                                <input type="text" name="description" required id="description" value="{{ $userFile->description }}" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="drag1" class="form-label">فایل:</label>
                                                <div class="drop-zone col-12">
                                                    <span class="drop-zone__prompt">جایگزینی فایل</span>
                                                    <input type="file" name="file" required id="drag1" class="drop-zone__input">
                                                </div>
                                                <a href="{{ asset($userFile->file) }}" class="btn btn-sm btn-success mt-1" download>دانلود</a>
                                            </div>
                                        </div>
                                        <div class="form-group mr-200 col-2 m-2">
                                            <input type="submit" value="ثبت" class="btn btn-primary float-right btn-block " style="border-radius: 10px;">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 sidebar-left text-center mb-2">
                                        <a href="{{ route('user.dashboard.UserFile.index') }}" class="btn btn-dark mb-2">لیست فایل‌ها</a>
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
