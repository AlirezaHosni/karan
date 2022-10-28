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
                            <form action="{{ route('setting.teacherList.update', $teacher->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-12 form-group">
                                    <div class="col-12">
                                        <div class="form-group col-12">
                                            <label class="form-label" for="session_id">فصل/درس مورد نظر را انتخاب کنید:</label>
                                            <select name="session_id[]"  id="session_id" class="form-control js-example-basic-multiple" multiple="multiple">
                                                @foreach($sessions as $session)
                                                    <option value="{{ $session->id }}" @if(in_array($session->id, $teacher->sessions()->get()->pluck('id')->toArray())) selected @endif>{{ $session->lesson->grade->title }}-{{ $session->lesson->title }}-{{ $session->session }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row col-12">
                                            <div class="col-6">
                                                <div class="form-group ">
                                                    <label for="editor1" class="form-label">رزومه:</label>
                                                    <textarea name="resume" id="editor1" rows="9" style="resize: none;">{{ old('resume', $teacher->resume) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="agent_image" class="form-label"> عکس استاد:</label>
                                                <div class="drop-zone col-12">
                                                    <span class="drop-zone__prompt">@if(empty($teacher->user->image))بارگذاری عکس استاد@else<img src="{{ asset($teacher->user->image) }}" width="150px" alt="عکس یافت نشد">@endif</span>
                                                    <input type="file" name="image" id="drag1" class="drop-zone__input">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-12">
                                    <div class="form-group row mr-2 col-6">
                                        <button type="submit" class="btn btn-info">
                                            ثبت
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="card-header border-bottom-0 pb-0 mt-4">
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <label class="main-content-label mb-0 pt-1 d-block">لیست اساتید</label>
                                </div>
                                <hr>
                            </div>
                            <div class="row-cols-2 col-12 row">
                                <div class="form-group col-6">
                                    <label for="grade_id" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                    <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                        <option value=""></option>
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}" @if(old('grade_id') == $grade->id) selected @endif>{{ $grade->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="lesson_id" class="form-label">کتاب مورد نظر را انتخاب کنید:</label>
                                    <select name="lesson_id" class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0 yajra-datatable">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p text-right"><span>ردیف</span></th>
                                            <th class="wd-lg-8p text-right"><span>نام</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
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
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
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
    </script>
    <script type="text/javascript">
        $(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: "{{ route('setting.teacherList.list') }}",
                    data: function (d) {
                        d.grade_id = $('#gradeOptions').val()
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user.fullName', name: 'fullName'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

            $('#gradeOptions').change(function(){
                table.draw();
            });

            $('#lessonOptions').change(function(){
                table.draw();
            });
        });
    </script>
@endsection
