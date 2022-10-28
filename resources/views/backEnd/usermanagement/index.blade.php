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
                                    <label class="main-content-label mb-0 pt-1">مدیریت کاربران</label>
                                    <div class="mr-auto float-right">
                                        <div class="">
                                            <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" style="">
                                                <a class="dropdown-item" href="#">امروز </a>
                                                <a class="dropdown-item" href="#">هفته </a>
                                                <a class="dropdown-item" href="#">گذشته ماه </a>
                                                <a class="dropdown-item" href="#">گذشته سال گذشته</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت / مدیریت کاربران</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-8p"><span>نام کاربری </span></th>
                                            <th class="wd-lg-20p"><span> نام و نام خانوادگی</span></th>
                                            <th class="wd-lg-20p"><span> شماره همراه</span></th>
                                            <th class="wd-lg-20p"><span> ایمیل</span></th>
                                            <th class="wd-lg-20p"><span> نقش</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                           <tbody>
                                           @foreach($users as $key=>$user)
                                               <tr>
                                                   <td>{{++$key}}</td>
                                                   <td>{{$user->name}}</td>
                                                   <td>{{$user->fullName}}</td>
                                                   <td>{{$user->phoneNumber}}</td>
                                                   <td>{{$user->email}}</td>
                                                   <td>{{implode(',',$user->roles()->get()->pluck('name')->toArray())}}</td>
                                                   <td class="d-flex justify-content-center">
                                                       <a href="{{route('userManagement.edit',$user->id)}}" class="btn btn-warning btn-sm ml-2">
                                                           <i class="fe fe-edit-2"></i>
                                                       </a>
                                                       <form action="{{route('userManagement.destroy',$user->id)}}" method="post" enctype="multipart/form-data">
                                                           @csrf
                                                           @method('delete')
                                                           <button class="btn btn-sm btn-danger"><i class="fe fe-trash"></i></button>
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
                    <!-- COL END -->
                </div>
                <!-- row closed  -->
            </div>
        </div>
    </div>
    <!-- End Main Content-->
@endsection
