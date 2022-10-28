@extends('backEnd.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-5">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card pt-5 flex-row col-12">
                            <div class="col-8">
                                <div class="card-header border-bottom-0 pb-0">
                                    <hr>
                                    <div class="d-flex justify-content-center">
                                        <label class="main-content-label mb-0 d-block"> نمایش ثبت اطلاعات توسط دانش‌آموزان</label>
                                    </div>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive border userlist-table">
                                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0 yajra-datatable" id="myTable">
                                            <thead>
                                            <tr>
                                                <th class="wd-lg-8p"><span>ردیف</span></th>
                                                <th class="wd-lg-8p"><span>نام</span></th>
                                                <th class="wd-lg-8p"><span>پایه</span></th>
                                                <th class="wd-lg-8p"><span>امتیاز</span></th>
                                                {{--                                            <th class="wd-lg-20p text-center">عمل</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
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
@section('js')
    <script type="text/javascript">
        $(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                paging: false,
                ajax: {
                    url: "{{ route('contact.teacherRate.list') }}",
                    data: function (d) {
                        d.grade_id = $('#gradeOptions').val()
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user.fullName', name: 'fullName'},
                    {data: 'grade', name: 'grade'},
                    {data: 'rate', name: 'rate'},
                ]
            });

            $('#gradeOptions').change(function(){
                table.draw();
            });

        });
    </script>
@endsection
