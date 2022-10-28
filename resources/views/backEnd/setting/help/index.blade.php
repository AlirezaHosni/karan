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
                                    <label class="main-content-label mb-0 pt-1">ویرایش راهنما</label>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /تنظیمات / ویرایش راهنما </p>
                                @include('alert.alert')
                                <div class="card-header border-bottom-0 pb-0">
                                    <div class="card-body">
                                        <ul class="list-group list-group-horizontal col-12 w-100">
                                            <li class="list-group-item col-3">
                                                <a class="page-link py-10 @if($type == 'education') bg-primary text-white @endif" href="{{ route('setting.help.index', 'education') }}">آموزش</a>
                                            </li>
                                            <li class="list-group-item col-3">
                                                <a class="page-link py-10 @if($type == 'exam') bg-primary text-white @endif" href="{{ route('setting.help.index', 'exam') }}">آزمون</a>
                                            </li>
                                            <li class="list-group-item col-3 ">
                                                <a class="page-link py-10 @if($type == 'onlineContact') bg-primary text-white @endif" href="{{ route('setting.help.index', 'onlineContact') }}">ارتباط آنلاین</a>
                                            </li>
                                            <li class="list-group-item col-3 ">
                                                <a class="page-link py-10 @if($type == 'questionBank') bg-primary text-white @endif" href="{{ route('setting.help.index', 'questionBank') }}">بانک سوال</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <form action="{{ route('setting.help.store', $type) }}" method="post" class="my-4" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row col-12">
                                        <div class="col-6">
                                            <label for="drag1" class="form-label">جزوه راهنما:</label>
                                            <div class="drop-zone col-12">
                                                <span class="drop-zone__prompt">بارگذاری پی دی اف مربوط به شخص راهنما</span>
                                                <input type="file" name="pdf" id="drag1" class="drop-zone__input">
                                            </div>
                                            @if(file_exists($setting->pdfs[$type]))
                                            <div><a href="{{ asset($setting->pdfs[$type]) }}" class="btn btn-info p-1 mt-1" download>دانلود</a></div>
                                            @endif
                                        </div>
                                        <div class="col-6">
                                            <label for="drag2" class="form-label">ویدئو راهنما:</label>
                                            <div class="drop-zone col-12">
                                                <span class="drop-zone__prompt">بارگذاری ویدئو مربوط به شخص راهنما</span>
                                                <input type="file" name="video" id="drag2" class="drop-zone__input">
                                            </div>
                                            @if(file_exists($setting->videos[$type]))
                                                <div><a href="{{ asset($setting->videos[$type]) }}" class="btn btn-info p-1 mt-1" download>دانلود</a></div>
                                            @endif
                                        </div>
                                    </div>
                                        <div class="form-group col-2 mt-3">
                                            <input type="submit" value="ثبت" class="btn btn-primary float-right btn-block " style="border-radius: 10px;">
                                        </div>
                                </form>
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
