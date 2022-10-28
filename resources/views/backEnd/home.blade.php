@extends('backEnd.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-5">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card pt-5 pb-3">
                            <div class="d-flex flex-column col-12">
                                <div class="form-group">
                                    <label for="gradeOptions" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                    <select name="grade_id"  class="form-control" id="gradeOptions" data-url="{{ route('searchLessons') }}">
                                        <option></option>
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}" @if(old('grade_id') == $grade->id) selected @endif>{{$grade->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive border userlist-table mt-5">
                                <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th class="wd-lg-8p"><span>تعداد کل ثیت نامی ها</span></th>
                                        <th class="wd-lg-8p"><span>تعداد ثبت نامی‌ها دیروز</span></th>
                                        <th class="wd-lg-8p"><span>تعداد ثبت نامی‌ها امروز</span></th>
                                        <th class="wd-lg-8p"><span>تعداد کل فعالان</span></th>
                                        <th class="wd-lg-8p"><span>تعداد فعالان دیروز</span></th>
                                        <th class="wd-lg-8p"><span>تعداد فعالان امروز</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $allUsers }}</td>
                                        <td>{{ $todayRegisteredUser }}</td>
                                        <td>{{ $yesterdayRegisteredUser }}</td>
                                        <td>{{ $allActives }}</td>
                                        <td>{{ $todayActives }}</td>
                                        <td>{{ $yesterdayActives }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-header border-bottom-0 pb-0">
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <label class="main-content-label mb-0 pt-1 d-block">لیست کاربران</label>
                                </div>
                                <hr>
                            </div>
{{--                            <form class="my-1">--}}
{{--                                <div class="d-flex">--}}
{{--                                    <div class="form-group col-xl-12 col-md-10 col-sm-12">--}}
{{--                                        <input type="text" id="search_box" class="form-control" placeholder="جستجو در بین کاربران " />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0 yajra-datatable">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p text-right"><span>ردیف</span></th>
                                            <th class="wd-lg-8p text-right"><span>تاریخ ایجاد</span></th>
                                            <th class="wd-lg-8p"><span>نام</span></th>
                                            <th class="wd-lg-8p"><span>معرف</span></th>
                                            <th class="wd-lg-8p"><span>کد ملی</span></th>
                                            <th class="wd-lg-8p"><span>شماره تلفن</span></th>
                                            <th class="wd-lg-8p"><span>شماره تلفن والذین</span></th>
                                            <th class="wd-lg-8p"><span>استان</span></th>
                                            <th class="wd-lg-8p"><span>شهر</span></th>
                                            <th class="wd-lg-8p"><span>وضعیت</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="{{ route('home.user.excel') }}" class="btn btn-success">خروجی به اکسل</a>
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
                    url: "{{ route('home.listUsers') }}",
                    data: function (d) {
                        d.grade_id = $('#gradeOptions').val()
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'fullName', name: 'fullName'},
                    {data: 'identifier', name: 'identifier'},
                    {data: 'national_code', name: 'national_code'},
                    {data: 'phoneNumber', name: 'phoneNumber'},
                    {data: 'user_meta.parent_phoneNumber', name: 'parent_phoneNumber'},
                    {data: 'user_meta.province', name: 'province'},
                    {data: 'user_meta.city', name: 'city'},
                    {
                        data: 'status',
                        name: 'status',
                        orderable: true,
                        searchable: true
                    },
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
        });
    </script>
@endsection
