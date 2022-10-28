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
                                    <label class="main-content-label mb-0 pt-1">جزوه پی‌دی‌اف‌ها</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route(\App\Document::getRoute($type))}}" class="btn btn-info"> <i
                                                class="fa fa-arrow-right mx-2"></i>برگشت به لیست</a>
                                    </div>
                                    <div class="mr-3 float-right">
                                        <a href="{{route('document.create', $type)}}" class="btn btn-info">بارگذاری جزوه پی‌دی‌اف‌ +</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /جزوه پی‌دی‌اف‌ها</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-8p"><span>عنوان</span></th>
                                            <th class="wd-lg-20p"><span>فصل</span></th>
                                            <th class="wd-lg-20p"><span>بخش</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($documents as $key=>$document)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{ $document->title }}</td>
                                                <td>
                                                    @if($document->type == 1){{ $document->documentable->session }}@elseif($document->type == 2){{ $document->documentable->book->session }}@elseif($document->type == 3){{ $document->documentable->book->session }}
                                                    @else{{ $document->documentable->book->session }}@endif
                                                </td>
                                                <td>
                                                    @if($document->type == 1){{ $document->documentable->part }}@elseif($document->type == 2){{ $document->documentable->book->part }}@elseif($document->type == 3){{ $document->documentable->book->part }}
                                                    @else{{ $document->documentable->book->part }}@endif
                                                </td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{route('document.edit',$document->id)}}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{route('document.destroy',$document->id)}}" method="post">
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
