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
                                        <a href="{{ route('grade.index') }}" class="btn btn-info"> <i
                                                class="fa fa-arrow-right mx-2"></i>برگشت به لیست</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /پایه / ایجاد توضبحات پایه </p>
                                <form action="{{ route('grade.description.update', $gradeDescription->id) }}" method="post" class="my-5" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-12 offset-3">
                                            <div class="form-group">
                                                <label for="editor1" class="form-label">توضیحات درس:</label>
                                                <textarea name="description" id="editor1" style="resize: none;">{{ old('description', $gradeDescription->description) }}</textarea>
                                            </div>
                                            <div class="row justify-content-center mb-5">
                                                <div class="col-10 mt-5">
                                                    <p>عکس توضیحات</p>
                                                </div>
                                                <div class="drop-zone col-10">
                                                    <span class="drop-zone__prompt"><img src="{{ asset($gradeDescription->image) }}" width="150px" alt="عکس پایه"></span>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="selected_lesson_id" class="form-label">کتاب منتخب پایه:</label>
                                                <select name="selected_lesson_id" id="selected_lesson_id" class="form-control">
                                                    @foreach($gradeDescription->grade->lessons as $lesson)
                                                        <option value="{{ $lesson->id }}" @if($lesson->id == old('selected_lesson_id', $gradeDescription->selected_lesson_id)) selected @endif>{{ $lesson->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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
            </script>
@endsection
