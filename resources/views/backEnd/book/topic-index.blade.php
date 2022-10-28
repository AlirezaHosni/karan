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
                            <form action="{{route('topic.store')}}" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex flex-column col-12">
                                    <div class="form-group">
                                        <label for="gradeOptions" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                        <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                            <option></option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}" @if(old('grade_id') == $grade->id) selected @endif>{{$grade->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="lessonOptions" class="form-label">کتاب مورد نظر را انتخاب کنید:</label>
                                        <select name="lesson_id"  class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label for="sessionOptions" class="form-label">فصل / درس مورد نظر را انتخاب کنید:</label>
                                        <select name="session_id"  class="form-control" id="sessionOptions" data-url="{{ route('searchParts') }}">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="partOptions" class="form-label">بخش مورد نظر را بنویسید(می‌توان این بخش را خالی گذاشت):</label>
                                        <select name="part_id"  class="form-control" id="partOptions">
                                        </select>
                                    </div>
                                    <div id="topicDiv">
                                        <div class="form-group" >
                                            <label for="" class="form-label">موضوع مورد نظر را بنویسید:</label>
                                            <input type="text" name="topic[]" id="" class="form-control" autocomplete="off" placeholder="موضوع" />
                                        </div>
                                    </div>
                                    <div class="form-group row mr-2">
                                            <button type="button" class="btn btn-info ml-2 createTopic">
                                                موضوع جدید
                                            </button>
                                            <button type="submit" class="btn btn-info">
                                                ثبت
                                            </button>
                                     </div>
                                </div>
                            </form>
                            <div class="card-header border-bottom-0 pb-0">
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <label class="main-content-label mb-0 pt-1">لیست موضوع های ایجاد شده برای هر کتاب</label>
                                </div>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0 yajra-datatable" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span>شماره</span></th>
                                            <th class="wd-lg-8p"><span>موضوع</span></th>
                                            <th class="wd-lg-8p"><span>بخش</span></th>
                                            <th class="wd-lg-8p"><span>فصل</span></th>
                                            <th class="wd-lg-8p"><span>کتاب</span></th>
                                            <th class="wd-lg-8p"><span>پایه</span></th>
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
        $(document).ready(function () {
            $('.createTopic').click(function () {
                $('#topicDiv').append(`<div class="form-group">
                                            <label for="">موضوع مورد نظر را بنویسید:</label>
                                            <input type="text" name="topic[]" class="form-control " placeholder="موضوع" />
                                        </div>`)
            });
        });
    </script>
    <script type="text/javascript">
        $(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: "{{ route('topic.ajaxTopics') }}",
                    data: function (d) {
                        d.grade_id = $('#gradeOptions').val(),
                        d.lesson_id = $('#lessonOptions').val(),
                        d.session_id = $('#sessionOptions').val(),
                        d.part_id = $('#partOptions').val()
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'topic'},
                    {data: 'book.part', name: 'part'},
                    {data: 'book.session', name: 'session'},
                    {data: 'book.lesson.title', name: 'lesson'},
                    {data: 'book.lesson.grade.title', name: 'grade'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

            $('#gradeOptions').change(function(){
                console.log($(this).val(), table)
                table.draw();

            });
            $('#lessonOptions').change(function(){

                table.draw();

            });
            $('#sessionOptions').change(function(){

                table.draw();

            });
            $('#partOptions').change(function(){

                table.draw();

            });

        });
    </script>
@endsection
