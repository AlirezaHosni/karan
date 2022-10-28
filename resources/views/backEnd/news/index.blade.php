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
                            @include('alert.alert')
                            <form action="{{ route('news.store') }}" method="post" class=" d-flex justify-content-center">
                                @csrf
                                <div class="d-flex row d-flex justify-content-center col-12">
                                    <div class="form-group col-12 row">
                                        <div class="form-group col-12">
                                            <label class="form-label" for="title">عنوان خبر</label>
                                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" />
                                        </div>
                                        <div class="form-group col-12" >
                                            <label for="editor1" class="form-label text-dark">بدنه</label>
                                            <textarea name="body" class="form-control col-12 editor" id="editor1">{{ old('body') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="d-flex row">
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
                            <div class="card-header border-bottom-0 pb-0">
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <label class="main-content-label mb-0 pt-1 d-block">لیست اخبار ثبت ‌شده</label>
                                </div>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-8p text-right"><span>عنوان</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                           <tbody>
                                           @foreach($news as $key => $singleNews)
                                               <tr>
                                                   <td>{{ ++$key }}</td>
                                                   <td class="text-right">{{ $singleNews->title }}</td>
                                                   <td class="d-flex justify-content-center">
                                                       <a href="{{route('news.edit',$singleNews->id)}}" class="btn btn-success btn-sm ml-2">
                                                           <i class="fe fe-edit-2"></i>
                                                       </a>
                                                       <form action="{{route('news.destroy',$singleNews->id)}}" method="post">
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
@section('js')
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor1' ), {
                ckfinder : {
                    uploadUrl: "{{ route('ckeditor.upload', ["_token" => csrf_token()]) }}"
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
