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
                                    <label class="main-content-label mb-0 pt-1">ایجاد درس</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('lesson.index')}}" class="btn btn-info"> <i class="fa fa-arrow-right mx-2"></i>برگشت به
                                            لیست</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت / ایجاد درس </p>
                                <form action="{{route('lesson.store')}}" method="post" enctype="multipart/form-data" class="my-5">
                                    @csrf
                                    <div class=" row ">
                                        <div class="col-xl-6 col-md-6 ">
                                            <div class="form-group">
                                                <label for="grade_id">پایه تحصیلی:</label>
                                                <select name="grade_id"  class="form-control">
                                                    @foreach($grades as $grade)
                                                        <option value="{{$grade->id}}">{{$grade->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                <div class="form-group">
                                                    <label for="">عنوان درس:</label>
                                                    <input type="text" name="title" class="form-control " placeholder="عنوان درس" />
                                                </div>
                                        </div>

                                            </div>
                                            <div class="form-group ">
                                                <label for="">توضیحات درس:</label>
                                                <textarea name="description" id="editor1" style="resize: none;"></textarea>
                                            </div>


                                            <div class="row justify-content-center  mb-5">
                                                <div class="col-10 mt-5">
                                                    <p>عکس درس</p>
                                                </div>
                                                <div class="drop-zone col-10">
                                                    <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                    <input type="file" name="image" id="drag1" class="drop-zone__input">
                                                </div>
                                            </div>


                                        <div class="row d-flex justify-content-center ">
                                            <div class="col-6  ">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info btn-block mb-3" >
                                                        ذخیره
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                </form>



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
