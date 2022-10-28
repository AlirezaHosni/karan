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
                                    <div class="col-md-6 col--12">
                                        <div class="form-group">
                                            <label for="title" class="form-label">نام پایه:</label>
                                            <input type="text" name="title" id="title" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="last_year_id" class="form-label">سال قبل پایه را انتخاب کنید:</label>
                                        <select name="last_year_id"  class="form-control" id="last_year_id" data-url="{{ route('searchLessons') }}">
                                            <option value="">ندارد</option>
                                            @foreach($grades as $grade)
                                                <option value="{{ $grade->id }}" @if(old('last_year_id') == $grade->id) selected @endif>{{ $grade->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-flex row ">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info mb-3">
                                                    ذخیره
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="mx-5"><a href="{{ route('grade.description.index') }}" class="btn btn-info">توضیحات پایه</a></div>
                            <div class="card-header border-bottom-0 pb-0">
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <label class="main-content-label mb-0 pt-1">لیست پایه‌های ثبت‌شده</label>
                                </div>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>

                                            <th class="wd-lg-8p text-right"><span>پایه تحصیلی</span></th>
{{--                                            <th class="wd-lg-20p"><span>تاریخ ایجاد </span></th>--}}

                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                           <tbody>
                                           @foreach($grades as $key=>$grade)
                                               <tr>
                                                   <td>{{++$key}}</td>
                                                   <td class="text-right">{{$grade->title}}</td>
{{--                                                   <td>{{\Hekmatinasser\Verta\Facades\Verta::instance($grade->created_at)->format('Y/n/j')}}</td>--}}

                                               <td class="d-flex justify-content-center">
                                                   <a href="{{route('grade.edit',$grade->id)}}" class="btn btn-success btn-sm ml-2">
                                                       <i class="fe fe-edit-2"></i>
                                                   </a>
                                                   <form action="{{route('grade.destroy',$grade->id)}}" method="post">
                                                       @csrf
                                                       @method('delete')
                                                       <button class="btn btn-danger btn-sm" type="submit">
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
