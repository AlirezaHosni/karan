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
                                    <label class="main-content-label mb-0 pt-1">ایجاد توضبحات پایه</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('video.index')}}" class="btn btn-info"> <i
                                                class="fa fa-arrow-right mx-2"></i>برگشت به لیست</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /پایه / ایجاد توضبحات پایه </p>
                                <form action="{{route('video.create')}}" method="post" class="my-5" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-12 offset-3">
                                            <div class="form-group">
                                                <label for="type">نوع منبع:</label>
                                                <select name="type"  class="form-control" onselect="selectType()">
                                                    <option value="1" >کتاب</option>
                                                    <option value="2" >سوال تشریحی</option>
                                                    <option value="3" >نکته و تست</option>
                                                </select>
                                            </div>
                                            <div class="form-group w-25 mr-200">
                                                <input type="submit" value="ثبت" class="btn btn-success float-right btn-block " style="border-radius: 10px;">
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
