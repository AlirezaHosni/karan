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
                            <form action="{{ route('book-part.update', $part->id) }}" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="d-flex flex-column col-12">
                                    <div class="form-group">
                                        <label for="grade_id" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                        <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                            <option></option>
                                            @foreach($grades as $grade)
                                                <option value="{{ $grade->id }}" @if($part->lesson->grade_id == $grade->id) selected @endif>{{$grade->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="lesson_id" class="form-label">کتاب مورد نظر را انتخاب کنید:</label>
                                        <select name="lesson_id"  class="form-control" id="lessonOptions" data-url="{{ route('searchSessions') }}">
                                        @foreach($part->lesson->grade->lessons as $lesson)
                                            <option value="{{ $lesson->id }}" @if($part->lesson_id == $lesson->id) selected @endif>{{ $lesson->title }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="session" class="form-label">فصل / درس مورد نظر را انتخاب کنید:</label>
                                        <select name="session"  class="form-control" id="sessionOptions">
                                        @foreach($part->lesson->books()->where('part', null)->get() as $session)
                                            <option value="{{ $session->id }}" @if($part->session == $session->session) selected @endif>{{ $session->session }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">بخش مورد نظر را بنویسید:</label>
                                        <input type="text" name="part" value="{{ $part->part }}" class="form-control " placeholder="عنوان بخش" />
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
                                    <label class="main-content-label mb-0 pt-1 d-block">لیست بخش های ایجاد شده برای هر کتاب</label>
                                </div>
                                <hr>
                            </div>
                            <form class="my-1">
                                <div class="d-flex">
                                    <div class="form-group col-xl-12 col-md-10 col-sm-12">
                                        <input type="text" id="search_box" class="form-control" placeholder="جستجو در بخش فصل کتاب و پایه " />
                                    </div>
                                </div>
                                <div class="d-flex search-submit-form">

                                </div>
                            </form>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0 yajra-datatable" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p text-right"><span>شماره</span></th>
                                            <th class="wd-lg-8p text-right"><span>عنوان</span></th>
                                            <th class="wd-lg-8p"><span>فصل</span></th>
{{--                                            <th class="wd-lg-8p"><span>کتاب</span></th>--}}
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
    {{--    <script>--}}
    {{--        oTable = $('#myTable').DataTable({--}}
    {{--            "bPaginate": false,--}}
    {{--            "bInfo": false,--}}
    {{--        });--}}
    {{--        $('#search_box').keyup(function(){--}}
    {{--            oTable.search($(this).val()).draw() ;--}}
    {{--        })--}}

    {{--    </script>--}}
    <script type="text/javascript">
        $(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: "{{ route('book-part.ajaxParts') }}",
                    data: function (d) {
                        d.grade_id = $('#gradeOptions').val(),
                            d.lesson_id = $('#lessonOptions').val(),
                            d.session_id = $('#sessionOptions').val()
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'part', name: 'part'},
                    {data: 'session', name: 'session'},
                    // {data: 'lesson.title', name: 'lesson'},
                    {data: 'lesson.grade.title', name: 'grade'},
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
        });
    </script>
@endsection
