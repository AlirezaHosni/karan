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
                                    <label class="main-content-label mb-0 pt-1">ایجاد پایه تحصیلی</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('book.index')}}" class="btn btn-info"> <i
                                                class="fa fa-arrow-right mx-2"></i>برگشت به
                                            لیست</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت / ایجاد پایه تحصیلی </p>
                                @if(!empty($grades))
                                    <form action="{{route('book.search')}}" method="post" class="my-5">
                                        @csrf
                                        <div class="d-flex row ">
                                            <div class="col-xl-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="grades">پایه تحصیلی:</label>
                                                    <select name="id" class="form-control">
                                                        <option>پایه تحصیلی مورد نظر خو را انتخاب کنید</option>
                                                        @foreach($grades as $grade)
                                                            <option value="{{$grade->id}}">{{$grade->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-xl-12 col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-info mt-4  ">
                                                            انتخاب پایه تحصیلی
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                                @if(!empty($lesson))
                                    <form action="{{route('book.store')}}" method="post" class="my-5">
                                        @csrf
                                        <div class="d-flex row ">
                                            <div class="col-xl-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="item">درس مورد نظر خود را انتخاب کنید:</label>
                                                    <select required name="lesson_id" class="form-control">
                                                        <option disabled selected>درس مورد نظر خود را انتخاب کنید</option>
                                                        @foreach($lesson as $item)
                                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="session">فصل را انتخاب کنید:</label>
                                                    <input required type="text" class="form-control" name="session_book"
                                                           placeholder="فصل مورد نظر خود را انتخاب کنید">
                                                </div>
                                                <div class="form-group">
                                                    <label for="session">بخش را انتخاب کنید:</label>
                                                    <input required type="text" class="form-control" name="part"
                                                           placeholder="در صورت نیاز بخش موردنظرخود را انتخاب کنید">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center  mb-5">
                                            <div class="col-10 mt-5">
                                                <p>عکس فصل</p>
                                            </div>
                                            <div class="drop-zone col-10">
                                                <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                <input required type="file" name="image" id="drag1" class="drop-zone__input">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button class="btn btn-info">ثبت</button>
                                        </div>

                                    </form>
                                @endif


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
