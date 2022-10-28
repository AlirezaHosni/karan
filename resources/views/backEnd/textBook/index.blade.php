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
                                    <label class="main-content-label mb-0 pt-1">درسنامه ها</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('textBook.create')}}" class="btn btn-info"> <i class="fa fa-plus mx-2"></i>ایجاد درسنامه</a>
                                    </div>
                                    <div class="mr-3 float-right">
                                        <a href="{{route('video.index', 4)}}" class="btn btn-info"> <i class="fa fa-plus mx-2"></i>افزودن ویدئو</a>
                                    </div>
                                    <div class="mr-3 float-right">
                                        <a href="{{route('document.index', 4)}}" class="btn btn-info"> <i class="fa fa-plus mx-2"></i>افزودن جزوه پی‌دی‌اف</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /درسنامه‌ها</p>
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
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                          <tbody>

                                          @foreach($textBooks as $key=>$item)
                                           <tr>
                                               <td>{{++$key}}</td>
                                               <td>{{ $item->book->lesson->title }}</td>
                                               <td>{{$item->book->session}}</td>
                                               <td>{{$item->book->part}}</td>
                                               <td class="d-flex justify-content-center">
                                                   <a href="{{route('textBook.edit',$item->id)}}" class="btn btn-success btn-sm ml-2">
                                                       <i class="fe fe-edit-2"></i>
                                                   </a>
                                                   <form action="{{route('textBook.destroy',$item->id)}}" method="post">
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
