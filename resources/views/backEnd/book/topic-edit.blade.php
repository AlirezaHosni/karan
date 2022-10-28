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
                            <form action="{{ route('topic.update', $topic->id) }}" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="d-flex flex-column col-12">
                                    <div class="form-group">
                                        <label for="grade_id">پایه مورد نظر را انتخاب کنید:</label>
                                        <select name="grade_id" id="grade_id" class="form-control">
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}" @if($topic->book->lesson->grade_id == $grade->id) selected @endif>{{$grade->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="lesson_id">کتاب مورد نظر را انتخاب کنید:</label>
                                        <select name="lesson_id" id="lesson_id"  class="form-control">
                                        @foreach($topic->book->lesson->grade->lessons as $lesson)
                                            <option value="{{ $lesson->id }}" @if($topic->book->lesson_id == $lesson->id) selected @endif>{{ $lesson->title }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="session">فصل / درس مورد نظر را انتخاب کنید:</label>
                                        <select name="session_id" id="session" class="form-control">
                                        @foreach($topic->book->lesson->books()->where('part', null)->get() as $session)
                                            <option value="{{ $session->session }}" @if($topic->book->session == $session->session) selected @endif>{{ $session->session }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="part_id">بخش مورد نظر را بنویسید(می‌توان این بخش را خالی گذاشت):</label>
                                        <select name="part_id"  class="form-control" id="part_id">
                                            @foreach($topic->book->lesson->books()->whereNotNull('part')->get() as $part)
                                                <option value="{{ $part->id }}" @if($topic->book_id == $part->id) selected @endif>{{ $part->part }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="topicDiv">
                                        <div class="form-group">
                                            <label for="topic">موضوع </label>
                                            <input type="text" id="topic" name="topic" value="{{ $topic->title }}" class="form-control " placeholder="موضوع" />
                                        </div>
                                    </div>
                                    <div class="form-group row mr-2">
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
