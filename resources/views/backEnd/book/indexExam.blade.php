

@extends('backEnd.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-5">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card">
                            <div class="card-header border-bottom-0 pb-0">
                                <div class="d-flex justify-content-between">
                                    <label class="main-content-label mb-0 pt-1">آزمون ها</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('examBook.create')}}" class="btn btn-info"> <i class="fa fa-plus mx-2"></i>ایجاد سوال تستی</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /آزمون های تستی</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-8p"><span>نام کتاب</span></th>
                                            <th class="wd-lg-20p"><span> عنوان</span></th>
                                            <th class="wd-lg-20p"><span>بخش</span></th>
                                            <th class="wd-lg-20p"><span>  آزمون ثبت شده</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                          <tbody>

                                          @foreach($exam as $key=>$item)
                                           <tr>
                                               <td>{{++$key}}</td>
                                               <td>{{implode(',',$item->lesson()->get()->pluck('title')->toArray())}}</td>
                                               <td>{{$item->session}}</td>
                                               <td>{{$item->part}}</td>
                                               @if(!empty(implode(',',$item->examBooks()->get()->pluck('book_id')->toArray())))
                                               <td>دارد</td>
                                               @else
                                                   <td>ندارد</td>
                                               @endif
                                               <td class="text-center d-flex justify-content-center">
                                                   <form action="{{route('examBook.destroy',$item->id)}}" method="post">
                                                       @csrf
                                                       @method('delete')
                                                       @if(!empty(implode(',',$item->examBooks()->get()->pluck('book_id')->toArray())))
                                                       <button type="submit" class="btn btn-sm btn-danger ml-1">حذف آزمون</button>
                                                       @else
                                                           <button type="submit" class="btn btn-sm btn-danger ml-1" disabled>حذف آزمون</button>
                                                       @endif
                                                   </form>
                                                   <a href="{{route('book.show',$item->id)}}" class="btn btn-success btn-sm "> نمایش آزمون تستی</a>
                                               </td>
                                           </tr>
                                          @endforeach

                                          </tbody>
                                    </table>
                                </div>
                                <ul class="pagination mt-4 mb-0 float-left">
                                    <li class="page-item page-prev disabled">
                                        <a class="page-link" href="#" tabindex="-1">قبلی</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item page-next">
                                        <a class="page-link" href="#">بعد</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- COL END -->
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                    <div class="card custom-card">
                        <div class="card-header border-bottom-0 pb-0">
                            <div class="d-flex justify-content-between">
                                <label class="main-content-label mb-0 pt-1">آزمون ها</label>
                                <div class="mr-auto float-right">
                                    <a href="{{route('DescriptiveTest')}}" class="btn btn-info"> <i class="fa fa-plus mx-2"></i>ایجاد سوال تشریحی</a>
                                </div>
                            </div>
                            <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /آزمون های تشریحی</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive border userlist-table">
                                <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th class="wd-lg-8p"><span> ردیف</span></th>
                                        <th class="wd-lg-8p"><span>نام کتاب</span></th>
                                        <th class="wd-lg-20p"><span> عنوان</span></th>
                                        <th class="wd-lg-20p"><span>بخش</span></th>
                                        <th class="wd-lg-20p"><span>  آزمون ثبت شده</span></th>
                                        <th class="wd-lg-20p text-center">عمل</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($exam as $key=>$item)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{implode(',',$item->lesson()->get()->pluck('title')->toArray())}}</td>
                                            <td>{{$item->session}}</td>
                                            <td>{{$item->part}}</td>
                                            @if(!empty(implode(',',$item->DescriptiveTests()->get()->pluck('book_id')->toArray())))
                                                <td>دارد</td>
                                            @else
                                                <td>ندارد</td>
                                            @endif
                                            <td class="text-center d-flex justify-content-center">
                                                <form action="{{route('DescriptiveTest.Delete',$item->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    @if(!empty($item->DescriptiveTests()->get()->pluck('document')->toArray()))
                                                    <button type="submit" class="btn btn-sm btn-danger ml-1">حذف آزمون</button>
                                                    @else
                                                        <button type="submit" class="btn btn-sm btn-danger ml-1" disabled>حذف آزمون</button>
                                                    @endif
                                                </form>
                                                @if(!empty($item->DescriptiveTests()->get()->pluck('document')->toArray()))
                                                <a class="btn btn-info btn-sm" href="{{"upload/Descriptivetest/".implode(',',$item->DescriptiveTests()->get()->pluck('document')->toArray())}}">دانلود فایل سوال</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination mt-4 mb-0 float-left">
                                <li class="page-item page-prev disabled">
                                    <a class="page-link" href="#" tabindex="-1">قبلی</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item page-next">
                                    <a class="page-link" href="#">بعد</a>
                                </li>
                            </ul>
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
