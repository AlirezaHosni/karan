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
                            <div class="card-header border-bottom-0 pb-0">
                                <div class="d-flex justify-content-between">
                                    <label class="main-content-label mb-0 pt-1">ایجاد درسنامه</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('textBook.index')}}" class="btn btn-info"> <i
                                                class="fa fa-arrow-right mx-2"></i>برگشت به لیست</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /ویدئو / ایجاد درسنامه </p>
                                <form action="{{route('textBook.update', $textBook)}}" method="post" id="fileUploadForm" class="my-5" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row ">
                                        <div class="col-12 offset-3">
                                            <div class="form-group">
                                                <label for="resource_id">انتخاب بخش:</label>
                                                <select name="book_id"  class="form-control">
                                                    @foreach($books as $book)
                                                        <option value="{{$book->id}}" @if($book->id == old('book_id', $textBook->book_id)) selected @endif>{{ $book->session }}-{{ $book->part }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="title"> عنوان را انتخاب کنید:</label>
                                                <input type="text" value="{{ old('title', $textBook->title) }}" class="form-control" name="title" required>
                                            </div>
                                            <div class="form-group ">
                                                <label for="">بدنه اصلی:</label>
                                                <textarea name="body" id="editor1" style="resize: none;">{{ old('body', $textBook->body) }}</textarea>
                                            </div>
                                            <div class="row justify-content-center  mb-5">
                                                <div class="col-10 mt-5">
                                                    <p>عکس درسنامه</p>
                                                </div>
                                                <div class="drop-zone col-10">
                                                    <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                    <input required type="file" name="image" id="drag1" class="drop-zone__input">
                                                </div>
                                            </div>
                                            <div class="form-group w-25 mr-200">
                                                <input type="submit" id="btnUpload" value="ثبت" class="btn btn-success float-right btn-block " style="border-radius: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
            <script>CKEDITOR.replace('editor1');</script>
@endsection
