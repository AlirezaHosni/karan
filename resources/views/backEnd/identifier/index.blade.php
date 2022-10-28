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
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span>ردیف</span></th>
                                            <th class="wd-lg-8p"><span>نام معرف</span></th>
                                            <th class="wd-lg-8p"><span>کد اختصاصی(کد معرف)</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($identifiers as $key => $identifier)
                                                <tr onclick="clickIdentifier({{ $identifier->id }})">
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $identifier->fullName }}</td>
                                                    <td>{{ $identifier->userMeta->identifying_code }}</td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-header border-bottom-0 pb-0">
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <label class="main-content-label mb-0 pt-1 d-block">لیست کاربران</label>
                                </div>
                                <hr>
                            </div>
                            <form class="my-1">
                                <div class="d-flex">
                                    <div class="form-group col-xl-12 col-md-10 col-sm-12">
                                        <input type="text" id="search_box" class="form-control" placeholder="جستجو در بین کاربران " />
                                    </div>
                                </div>
                            </form>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0 yajra-datatable" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p text-right"><span>ردیف</span></th>
                                            <th class="wd-lg-8p text-right"><span>تاریخ ایجاد</span></th>
                                            <th class="wd-lg-8p"><span>نام</span></th>
                                            <th class="wd-lg-8p"><span>کد ملی</span></th>
                                            <th class="wd-lg-8p"><span>شماره تلفن</span></th>
                                            <th class="wd-lg-8p"><span>استان</span></th>
                                            <th class="wd-lg-8p"><span>شهر</span></th>
                                            <th class="wd-lg-8p"><span>پایه</span></th>
                                            <th class="wd-lg-8p"><span>میزان خرید(اشتراک-پک-آزمون)</span></th>
{{--                                            <th class="wd-lg-20p text-center">عمل</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td>کل</td>
                                            <td id="total-price"></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="table-responsive border userlist-table mt-5">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span>تعداد کل ثیت نامی ها</span></th>
                                            <th class="wd-lg-8p"><span>تعداد ثبت نامی‌ها دیروز</span></th>
                                            <th class="wd-lg-8p"><span>تعداد ثبت نامی‌ها امروز</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                    <div class="col-12 mt-3">
                                        <a href="{{ route('identifier.excel') }}" class="btn btn-success">خروجی به اکسل</a>
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
        oTable = $('#myTable').DataTable({
            "bPaginate": false,
            "bInfo": false,
        });
        $('#search_box').keyup(function(){
            oTable.search($(this).val()).draw() ;
        })
    </script>
<script type="text/javascript">
    var identifier_id = null;
    $(function () {

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            paging: false,
            ajax: {
                url: "{{ route('identifier.listUsers') }}",
                data: function (d) {
                    d.identifier_id = identifier_id
                }
                // success : function (data) {
                //     var totalPriceTag = $('#total-price')
                //     var totalPrice = 0
                //     for (d in data){
                //         totalPrice += d.buy_price
                //     }
                //     totalPriceTag.val(totalPrice)
                // }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: 'fullName', name: 'fullName'},
                {data: 'national_code', name: 'national_code'},
                {data: 'phoneNumber', name: 'phoneNumber'},
                {data: 'user_meta.province', name: 'province'},
                {data: 'user_meta.city', name: 'city'},
                {data: 'grade', name: 'grade'},
                {data: 'buy_price', name: 'buy_price'}
            ]
        });
    });
    function clickIdentifier(id){
        identifier_id = id;
        table.draw();
    }
</script>
@endsection
