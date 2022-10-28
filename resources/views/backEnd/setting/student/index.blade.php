@extends('backEnd.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0 create-article-row">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-5 ">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card">
                            <div class="card-header border-bottom-0 pb-0 mb-2">
                                <div class="d-flex justify-content-between">
                                    <label class="main-content-label mb-0 pt-1"> تصویر دانش‌آموز</label>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /تنظیمات / ویرایش تصویر دانش‌آموز </p>
                                @include('alert.alert')
                                <form action="{{ route('setting.student.store') }}" method="post" class="my-5" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row col-12">
                                        <div class="col-12">
                                            <label for="student_image" class="form-label"> تصویر دانش‌آموز:</label>
                                            <div class="drop-zone col-12">
                                                <span class="drop-zone__prompt">بارگذاری تصویر مربوط به شخص تصویر دانش‌آموز</span>
                                                <input type="file" name="image" id="drag1" required class="drop-zone__input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-2 mt-2">
                                        <input type="submit" value="ثبت" class="btn btn-primary float-right btn-block " style="border-radius: 10px;">
                                    </div>
                                </form>
                                <div class="card-header border-bottom-0 pb-0">
                                    <hr>
                                    <div class="d-flex justify-content-center">
                                        <label class="main-content-label mb-0 pt-1">لیست لیست تصاویر دانش‌آموز</label>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-12" id="list-file-div">
                                    <div class="card-body">
                                        <div class="table-responsive border userlist-table">
                                            <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                                <thead>
                                                <tr>
                                                    <th class="wd-lg-8p"><span> ردیف</span></th>
                                                    <th class="wd-lg-8p text-right"><span>تاریخ</span></th>
                                                    <th class="wd-lg-8p"><span>تصویر</span></th>
                                                    <th class="wd-lg-20p text-center">عمل</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($studentImages as $key => $studentImage)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td class="text-right">{{  jalaliDate($studentImage->created_at, "%Y / %m / %d") }}</td>
                                                        <td><img src="{{ asset($studentImage->image) }}" alt="عکس دانش‌آموز" width="100px"></td>
                                                        <td class="d-flex justify-content-center">
                                                            <form action="{{ route('setting.student.destroy', $studentImage->id) }}" method="post">
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
                            </div>
                        </div>
                    </div>
                    <!-- row closed  -->
                </div>
            </div>
        </div>
        <!-- End Main Content-->
        @endsection
        @section('js')
            <script>
                ClassicEditor
                    .create( document.querySelector( '#editor1' ), {
                        ckfinder : {
                            uploadUrl: "{{ route('ckeditor.upload', ["_token" => csrf_token()]) }}"
                        }
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>
@endsection
