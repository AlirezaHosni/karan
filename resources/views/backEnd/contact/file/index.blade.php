@extends('backEnd.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-2">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card pt-2">
                            <div class="card-header border-bottom-0 pb-0">
                                <div class="card-body">
                                    <ul class="list-group list-group-horizontal col-12 w-100">
                                        <li class="list-group-item col-3">
                                            <a class="page-link py-10 @if($format === null) text-white bg-primary @endif" href="{{ route('contact.file.index', ['type' => $type, 'format' => null]) }}">همه</a>
                                        </li>
                                        <li class="list-group-item col-3">
                                            <a class="page-link py-10 @if($format === 'audio') text-white bg-primary @endif" href="{{ route('contact.file.index', ['type' => $type, 'format' => 'audio']) }}">صوتی</a>
                                        </li>
                                        <li class="list-group-item col-3">
                                            <a class="page-link py-10 @if($format === 'text') text-white bg-primary @endif" href="{{ route('contact.file.index', ['type' => $type, 'format' => 'text']) }}">متنی</a>
                                        </li>
                                        <li class="list-group-item col-3 ">
                                            <a class="page-link py-10 @if($format === 'image') text-white bg-primary @endif" href="{{ route('contact.file.index', ['type' => $type, 'format' => 'image']) }}">تصویری</a>
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-20p"><span> متن</span></th>
                                            <th class="wd-lg-8p"><span> نام</span></th>
                                            <th class="wd-lg-8p"><span> پایه</span></th>
                                            <th class="wd-lg-8p"><span>فایل</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($files as $key => $file)
                                            <tr>
                                                <td >{{ ++$key }}</td>
                                                <td style="word-wrap: break-word; max-width: 10rem; min-width: 10rem">{!! $file->description !!}</td>
                                                <td >{{ $file->user->fullName }}</td>
                                                <td >{{ empty($file->user->user_meta->grade) ? '' : $file->user->user_meta->grade->title }}</td>

                                                <td ><a href="{{ asset($file->file) }}" class="btn btn-primary" download>دانلود</a></td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Content-->
@endsection
