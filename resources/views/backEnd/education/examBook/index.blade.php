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
                                <div class="d-flex justify-content-center">
                                    <h3 class="font-weight-bold">تست جامع</h3>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('education.generalExamBookStore') }}" method="post" class=" d-flex justify-content-center" id="form" enctype="multipart/form-data">
                                @csrf
                                <div class="row col-12">
                                    <div class="row-cols-2 col-12 row">
                                        <div class="form-group col-6">
                                            <label for="grade_id">پایه مورد نظر را انتخاب کنید:</label>
                                            <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                                <option value=""></option>
                                                @foreach($grades as $grade)
                                                    <option value="{{$grade->id}}" @if(old('grade_id') == $grade->id) selected @endif>{{$grade->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="lesson_id">کتاب مورد نظر را انتخاب کنید:</label>
                                            <select name="lesson_id" class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="lesson_id">فصل/درس مورد نظر را انتخاب کنید:</label>
                                            <select name="session_id" class="form-control" id="sessionOptions">
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-xl-12 col-md-12 offset-3" id="createTestDiv">
                                    <div class="form-group col-12" >
                                            <label for="question" class="form-label">صورت سوال</label>
                                            <textarea dir="rtl" name="question[]" class="form-control col-12" id="editor1" placeholder="صورت سوال مورد نظر خود را وارد کنید"></textarea>
                                    </div>
                                    <div class="form-group col-12 row mr-1">
                                        <input type="text" name="answerOne[]" class="form-control col-9" placeholder="گزینه 1">
                                        <input type="file" name="answerOneImage[]" class="form-control col-3">
                                        <input type="text" name="answerTwo[]" class="form-control col-9" placeholder="گزینه 2">
                                        <input type="file" name="answerTwoImage[]" class="form-control col-3">
                                        <input type="text" name="answerThree[]" class="form-control col-9" placeholder="گزینه 3">
                                        <input type="file" name="answerThreeImage[]" class="form-control col-3">
                                        <input type="text" name="answerFour[]" class="form-control col-9" placeholder="گزینه 4">
                                        <input type="file" name="answerFourImage[]" class="form-control col-3">
                                        <input type="number" max="4" min="1" name="True[]" class="form-control col-6" placeholder="جواب صحیح">
                                    </div>
                                    <div class="form-group col-6">
                                            <label for="" class="mt-1">بارگذاری صوت راهنما:</label>
                                            <input type="file" name="audio[]" class="form-control col-6" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group col-12" >
                                                <label for="question" class="form-label text-dark">سوال مشابه اول</label>
                                                <div class="form-group col-12" >
                                                    <label for="question" class="form-label">صورت سوال</label>
                                                    <textarea dir="rtl" name="question_0[]" class="form-control col-12 editor" id="editor2" placeholder="صورت سوال مورد نظر خود را وارد کنید"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 row mr-1">
                                                <input type="text" name="answerOne_0[]" class="form-control col-9" placeholder="گزینه 1">
                                                <input type="file" name="answerOneImage_0[]" class="form-control col-3">
                                                <input type="text" name="answerTwo_0[]" class="form-control col-9" placeholder="گزینه 2">
                                                <input type="file" name="answerTwoImage_0[]" class="form-control col-3">
                                                <input type="text" name="answerThree_0[]" class="form-control col-9" placeholder="گزینه 3">
                                                <input type="file" name="answerThreeImage_0[]" class="form-control col-3">
                                                <input type="text" name="answerFour_0[]" class="form-control col-9" placeholder="گزینه 4">
                                                <input type="file" name="answerFourImage_0[]" class="form-control col-3">
                                                <input type="number" max="4" min="1" name="True_0[]" class="form-control col-6" placeholder="جواب صحیح">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="" class="mt-1 form-label">بارگذاری تصویر سوال مشابه اول:</label>
                                                <input type="file" name="image_0[]" class="form-control col-6" />
                                            </div>
                                            <div class="form-group col-12 mt-1" >
                                                <label for="question" class="form-label text-dark">سوال مشابه دوم</label>
                                                <div class="form-group col-12" >
                                                    <label for="question" class="form-label">صورت سوال</label>
                                                    <textarea dir="rtl" name="question_0[]" class="form-control col-12 editor" id="editor3" placeholder="صورت سوال مورد نظر خود را وارد کنید"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 row mr-1">
                                                <input type="text" name="answerOne_0[]" class="form-control col-9" placeholder="گزینه 1">
                                                <input type="file" name="answerOneImage_0[]" class="form-control col-3">
                                                <input type="text" name="answerTwo_0[]" class="form-control col-9" placeholder="گزینه 2">
                                                <input type="file" name="answerTwoImage_0[]" class="form-control col-3">
                                                <input type="text" name="answerThree_0[]" class="form-control col-9" placeholder="گزینه 3">
                                                <input type="file" name="answerThreeImage_0[]" class="form-control col-3">
                                                <input type="text" name="answerFour_0[]" class="form-control col-9" placeholder="گزینه 4">
                                                <input type="file" name="answerFourImage_0[]" class="form-control col-3">
                                                <input type="number" max="4" min="1" name="True_0[]" class="form-control col-6" placeholder="جواب صحیح">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="" class="mt-1 form-label">بارگذاری تصویر سوال مشابه دوم:</label>
                                                <input type="file" name="image_0[]" class="form-control col-6" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mr-2 col-6">
                                            <button type="button" class="btn btn-info ml-2 createTest">
                                                سوال جدید
                                            </button>
                                            <button type="submit" class="btn btn-info">
                                                ثبت
                                            </button>
                                    </div>
                                </div>
                            </form>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-8p"><span> سوال</span></th>
                                            <th class="wd-lg-20p"><span>فصل</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $key=0;
                                        @endphp
                                        @foreach($generalTests as $generalTest)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{!! $generalTest->question !!}</td>
                                                <td>{{ $generalTest->testable->session }}</td>
                                                <td class="d-flex justify-content-center">
{{--                                                    <a href="#" class="btn btn-success btn-sm ml-2">--}}
{{--                                                        <i class="fe fe-edit-2"></i>--}}
{{--                                                    </a>--}}
{{--                                                    <form action="#" method="post">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('delete')--}}
{{--                                                        <button class="btn btn-danger btn-sm" type="submit">--}}
{{--                                                            <i class="fe fe-trash"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
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
@section('js')
    <script>
        $(document).ready(function () {
            var counter = 0;
            $('.createTest').click(function () {
                counter = counter + 1;
                $('#createTestDiv').append(`
                                    <div class="form-group col-12" >
                                            <label for="question">صورت سوال</label>
                                            <div class="form-group col-12" >
                                                    <label for="question" class="form-label">صورت سوال</label>
                                                    <textarea dir="rtl" name="question[]" class="form-control col-12 editor" id="editor_1_`  + counter +`" placeholder="صورت سوال مورد نظر خود را وارد کنید"></textarea>
                                                </div>
                                    </div>
                                    <div class="form-group col-12 row mr-1">
                                        <input type="text" name="answerOne[]" class="form-control col-9" placeholder="گزینه 1">
                                        <input type="file" name="answerOneImage[]" class="form-control col-3">
                                        <input type="text" name="answerTwo[]" class="form-control col-9" placeholder="گزینه 2">
                                        <input type="file" name="answerTwoImage[]" class="form-control col-3">
                                        <input type="text" name="answerThree[]" class="form-control col-9" placeholder="گزینه 3">
                                        <input type="file" name="answerThreeImage[]" class="form-control col-3">
                                        <input type="text" name="answerFour[]" class="form-control col-9" placeholder="گزینه 4">
                                        <input type="file" name="answerFourImage[]" class="form-control col-3">
                                        <input type="number" max="4" min="1" name="True[]" class="form-control col-6" placeholder="جواب صحیح">
                                    </div>
                                    <div class="form-group col-6">
                                            <label for="" class="mt-1">بارگذاری صوت راهنما:</label>
                                            <input type="file" name="audio[]" class="form-control col-6" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group col-12" >
                                                <label for="question" class="form-label text-dark">سوال مشابه اول</label>
                                                <div class="form-group col-12" >
                                                    <label for="question" class="form-label">صورت سوال مشابه اول</label>
                                                    <textarea dir="rtl" name="question_` + counter +  `[]" class="form-control col-12 editor" id="editor_2_`  + counter +`"  placeholder="صورت سوال مورد نظر خود را وارد کنید"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 row mr-1">
                                                <input type="text" name="answerOne_` + counter +  `[]" class="form-control col-9" placeholder="گزینه 1">
                                                <input type="file" name="answerOneImage_` + counter +  `[]" class="form-control col-3">
                                                <input type="text" name="answerTwo_` + counter +  `[]" class="form-control col-9" placeholder="گزینه 2">
                                                <input type="file" name="answerTwoImage_` + counter +  `[]" class="form-control col-3">
                                                <input type="text" name="answerThree_` + counter +  `[]" class="form-control col-9" placeholder="گزینه 3">
                                                <input type="file" name="answerThreeImage_` + counter +  `[]" class="form-control col-3">
                                                <input type="text" name="answerFour_` + counter +  `[]" class="form-control col-9" placeholder="گزینه 4">
                                                <input type="file" name="answerFourImage_` + counter +  `[]" class="form-control col-3">
                                                <input type="number" max="4" min="1" name="True_` + counter +  `[]" class="form-control col-6" placeholder="جواب صحیح">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="" class="mt-1 form-label">بارگذاری تصویر سوال مشابه اول:</label>
                                                <input type="file" name="image_` + counter +`[]" class="form-control col-6" />
                                            </div>
                                            <div class="form-group col-12 mt-1" >
                                                <label for="question" class="form-label">سوال مشابه دوم</label>
                                                <div class="form-group col-12" >
                                                    <label for="question" class="form-label text-dark">صورت سوال مشابه دوم</label>
                                                    <textarea dir="rtl" name="question_` + counter +  `[]" class="form-control col-12 editor" id="editor_3_`  + counter +`" placeholder="صورت سوال مورد نظر خود را وارد کنید"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 row mr-1">
                                                <input type="text" name="answerOne_` + counter +  `[]" class="form-control col-9" placeholder="گزینه 1">
                                                <input type="file" name="answerOneImage_` + counter +  `[]" class="form-control col-3">
                                                <input type="text" name="answerTwo_` + counter +  `[]" class="form-control col-9" placeholder="گزینه 2">
                                                <input type="file" name="answerTwoImage_` + counter +  `[]" class="form-control col-3">
                                                <input type="text" name="answerThree_` + counter +  `[]" class="form-control col-9" placeholder="گزینه 3">
                                                <input type="file" name="answerThreeImage_` + counter +  `[]" class="form-control col-3">
                                                <input type="text" name="answerFour_` + counter +  `[]" class="form-control col-9" placeholder="گزینه 4">
                                                <input type="file" name="answerFourImage_` + counter +  `[]" class="form-control col-3">
                                                <input type="number" max="4" min="1" name="True_` + counter +  `[]" class="form-control col-6" placeholder="جواب صحیح">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="" class="mt-1 form-label">بارگذاری تصویر سوال مشابه دوم:</label>
                                                <input type="file" name="image_` + counter +`[]" class="form-control col-6" />
                                            </div>
                                        </div>
                                    `)
                ClassicEditor
                    .create( document.querySelector( '#editor_1_' + counter ), {
                        ckfinder : {
                            uploadUrl: "{{ route('ckeditor.upload', ["_token" => csrf_token()]) }}"
                        }
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
                ClassicEditor
                    .create( document.querySelector( '#editor_2_' + counter ), {
                        ckfinder : {
                            uploadUrl: "{{ route('ckeditor.upload', ["_token" => csrf_token()]) }}"
                        }
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
                ClassicEditor
                    .create( document.querySelector( '#editor_3_' + counter ), {
                        ckfinder : {
                            uploadUrl: "{{ route('ckeditor.upload', ["_token" => csrf_token()]) }}"
                        }
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            });
        });
    </script>
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
        ClassicEditor
            .create( document.querySelector( '#editor3' ), {
                ckfinder : {
                    uploadUrl: "{{ route('ckeditor.upload', ["_token" => csrf_token()]) }}"
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
