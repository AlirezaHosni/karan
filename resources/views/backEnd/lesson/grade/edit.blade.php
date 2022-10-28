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
                                    <label class="main-content-label mb-0 pt-1">ویرایش پایه تحصیلی</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('grade.index')}}" class="btn btn-info"> <i class="fa fa-arrow-right mx-2"></i>برگشت به
                                            لیست</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت / ویرایش پایه تحصیلی </p>
                                <form action="{{route('grade.update',$grade->id)}}" method="post" class="my-5">
                                    @csrf
                                    @method('put')
                                    <div class="d-flex row ">
                                        <div class="col-xl-6 col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="title" class="form-control" placeholder="پایه تحصلی مورد نظرخودرا انتخاب کنید" value="{{$grade->title}}" />
                                            </div>
                                        </div>
                                        <div class="d-flex row ">
                                            <div class="col-xl-6 col-md-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info mb-3">
                                                        ویرایش
                                                    </button>
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
