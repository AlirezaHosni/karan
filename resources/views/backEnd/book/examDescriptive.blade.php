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
                                    <label class="main-content-label mb-0 pt-1">ایجادسوال تشریحی</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('book.index')}}" class="btn btn-info"> <i
                                                class="fa fa-arrow-right mx-2"></i>برگشت به لیست</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /سوال / طراحی سوالات تشریحی </p>
                                <form action="{{route('DescriptiveTest.Store')}}" method="post"
                                      enctype="multipart/form-data" class="my-5">
                                    @csrf
                                    <div class="d-flex row ">
                                        <div class="col-xl-6 col-md-6 offset-3">
                                            <div class="form-group">
                                                <label for="level">سوالات امتحانی مربوط به:</label>
                                                <select name="book_id" id="level" class="form-control">
                                                    @foreach($books as $item)
                                                        <option
                                                            value="{{$item->id}}">{{implode(',',\App\Lesson::find($item->lesson_id)->grade()->pluck('title')->toArray())}}
                                                            -{{$item->session}}-{{$item->part}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="d-flex row ">
                                                <div class="col-xl-6 col-md-6 offset-3">
                                                    <div class="form-group">
                                                        <label for="level">سطح آزمون</label>
                                                        <select name="level" id="level" class="form-control">
                                                            <option value="1">آسان</option>
                                                            <option value="2">متوسط</option>
                                                            <option value="3">سخت</option>
                                                        </select>
                                                    </div>
                                                    <div class="d-flex row ">
                                                        <div class="col-xl-12 col-md-12 ">
                                                        </div>
                                                    </div>
                                                    <div class="form-group" >
                                                        <label for="document">عنوان سوال</label>
                                                        <input type="text" name="title" class="form-control" style="width: 500px;" placeholder="عنوان سوال خود را تعیین کنید">

                                                    </div>
                                                    <div class="form-group" >
                                                        <label for="document">بارگذاری فایل سوالات تشریحی</label>
                                                        <input type="file" name="document" class="form-control" style="width: 500px;">

                                                    </div>


                                                    <div class="form-group w-25">
                                                        <input type="submit" value="ثبت"
                                                               class="btn btn-success float-right btn-block "
                                                               style="border-radius: 10px;">
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
