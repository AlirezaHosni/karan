@extends('backEnd.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-5">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card pt-5">
                            <form action="{{route('grade.store')}}" method="post" class=" d-flex justify-content-center">
                                @csrf
                                <div class="d-flex row d-flex justify-content-center col-12">
                                    <div class="col-xl-10 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="title" class="form-control " placeholder="پایه مورد نظر را بنویسید" />
                                        </div>
                                    </div>
                                    <div class="d-flex row ">
                                        <div class="col-xl-6 col-md-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info mb-3">
                                                    ذخیره
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <label class="main-content-label mb-0 pt-1">لیست کتاب های ایجاد شده برای هر پایه</label>
                                </div>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-8p"><span>نام درس</span></th>
                                            <th class="wd-lg-20p"><span>پایه تحصیلی</span></th>
                                            <th class="wd-lg-8p text-center"><span>عکس درس</span></th>
                                            <th class="wd-lg-20p ">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($lesson as $key=>$item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$item->title}}</td>
                                                <td>{{implode(',',$item->grade()->get()->pluck('title')->toArray())}}</td>
                                                <td class="text-center"><img src="{{asset('upload/lesson/'.$item->image)}}" alt="عکس" width="80px" height="80px"></td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{route('lesson.edit',$item->id)}}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{route('lesson.destroy',$item->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm ml-3" type="submit">
                                                            <i class="fe fe-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{--                                <ul class="pagination mt-4 mb-0 float-left">--}}
                                {{--                                    <li class="page-item page-prev disabled">--}}
                                {{--                                        <a class="page-link" href="#" tabindex="-1">قبلی</a>--}}
                                {{--                                    </li>--}}
                                {{--                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
                                {{--                                    <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                                {{--                                    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                                {{--                                    <li class="page-item"><a class="page-link" href="#">4</a></li>--}}
                                {{--                                    <li class="page-item"><a class="page-link" href="#">5</a></li>--}}
                                {{--                                    <li class="page-item page-next">--}}
                                {{--                                        <a class="page-link" href="#">بعد</a>--}}
                                {{--                                    </li>--}}
                                {{--                                </ul>--}}
                            </div>
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
