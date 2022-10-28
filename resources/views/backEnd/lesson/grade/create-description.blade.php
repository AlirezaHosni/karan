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
                                    <label class="main-content-label mb-0 pt-1">ایجاد توضبحات پایه</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('grade.index')}}" class="btn btn-info"> <i
                                                class="fa fa-arrow-right mx-2"></i>برگشت به لیست</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /پایه / ایجاد توضبحات پایه </p>
                                <form action="{{route('grade.description.store')}}" method="post" class="my-5" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-12 offset-3">
                                            <div class="form-group ">
                                                <label for="">توضیحات درس:</label>
                                                <textarea name="description" id="editor1" style="resize: none;">{{ old('description') }}</textarea>
                                            </div>
                                            <div class="row justify-content-center  mb-5">
                                                <div class="col-10 mt-5">
                                                    <p>عکس توضیحات</p>
                                                </div>
                                                <div class="drop-zone col-10">
                                                    <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                    <input type="file" name="image" id="drag1" class="drop-zone__input">
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="">توضیحات دوم درس:</label>
                                                <textarea name="descriptionTwo" id="editor2" style="resize: none;">{{ old('descriptionTwo') }}</textarea>
                                            </div>
                                            <div class="row justify-content-center  mb-5">
                                                <div class="col-10 mt-5">
                                                    <p>عکس دوم توضیحات</p>
                                                </div>
                                                <div class="drop-zone col-10">
                                                    <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                    <input type="file" name="imageTwo" id="drag1" class="drop-zone__input">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="grade_id">پایه تحصیلی:</label>
                                                <select name="grade_id"  class="form-control">
                                                    @foreach($grades as $grade)
                                                        <option value="{{$grade->id}}" @if($grade->id == old('grade_id')) selected @endif>{{$grade->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
{{--                                            <div class="form-group">--}}
{{--                                                    <label>انتخاب معلم</label>--}}
{{--                                                    <select id="#example-getting-started" name="users"  class="form-control form-select" multiple="multiple">--}}
{{--                                                        @foreach($users as $user)--}}
{{--                                                            <option value="{{$user->id}}">{{$user->name}}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="form-group w-25 mr-200">
                                               <input type="submit" value="ثبت" class="btn btn-success float-right btn-block " style="border-radius: 10px;">
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
                ClassicEditor
                    .create( document.querySelector( '#editor2' ), {
                        ckfinder : {
                            uploadUrl: "{{ route('ckeditor.upload', ["_token" => csrf_token()]) }}"
                        }
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>
@endsection
