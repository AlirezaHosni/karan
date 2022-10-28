@extends('backEnd.layouts.master')
@section('head-tag')
    <link rel="stylesheet" href="{{ asset('backEnd/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection
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
                                <div >
                                    <h3 class="font-weight-bold text-center">فروشگاه</h3>
                                    <h5 class="font-weight-bold float-right">صدور کد تخفیف</h5>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('discount.store') }}" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <div class="col-12">
                                        <label for="discount_type">نوع تخفیف را انتخاب کنید</label>
                                        <div class="form-group col-6">
                                            <select name="discount_type"  class="form-control" id="discount_type">
                                                <option></option>
                                                <option value="0">صدور کد تخیف با درصد مشخص (یکبار مصرف)</option>
                                                <option value="1">صدور کد تخیف جشواره ای با درصد مشخص</option>
                                                <option value="2">صدور کد تخیف معرف با درصد مشخص</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="">مدت اعتبار کد تخفیف به روز:</label>
                                        <br>
                                        <div class="col-12 row">
                                            <div class="form-group col-6">
                                                <label for="start_at">تاریخ شروع</label>
                                                <input type="text" name="discount_start_date" id="discount_start_date" value="" class="form-control form-control-sm d-none">
                                                <input type="text" id="discount_start_date_view" value="" class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="start_at">تاریخ پایان</label>
                                                <input type="text" name="discount_end_date" id="discount_end_date" value="" class="form-control form-control-sm d-none">
                                                <input type="text" id="discount_end_date_view" value="" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="">مدت زمان اعتبار استفاده
                                            از سایت به روز:</label>
                                        <br>
                                        <div class="col-12 row">
                                            <div class="form-group col-6">
                                                <label for="start_at">تاریخ شروع</label>
                                                <input type="text" name="using_period_start_date" id="using_period_start_date" value="" class="form-control form-control-sm d-none">
                                                <input type="text" id="using_period_start_date_view" value="" class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="start_at">تاریخ پایان</label>
                                                <input type="text" name="using_period_end_date" id="using_period_end_date" value="" class="form-control form-control-sm d-none">
                                                <input type="text" id="using_period_end_date_view" value="" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-12 row">
{{--                                            <div class="form-group col-6">--}}
{{--                                                <label for="discount_code">کد تخفیف:</label>--}}
{{--                                                <input type="text" name="discount_code" id="discount_code" value="" class="form-control form-control-sm">--}}
{{--                                            </div>--}}
                                            <div class="form-group col-6">
                                                <label for="percent">درصد تخفیف:</label>
                                                <input type="text" name="percent" id="percent" value="" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-12 row d-none" id="users">
                                            <div class="form-group col-6">
                                                <label for="users">انتخاب معرف:</label>
                                                <select name="identifier_id"  class="form-control">
                                                    <option></option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->fullName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mr-2 col-6">
                                            <button type="submit" class="btn btn-info">
                                                ثبت
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="card-body">
                                <div class="table-responsive border userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span> ردیف</span></th>
                                            <th class="wd-lg-8p"><span> نوع</span></th>
                                            <th class="wd-lg-20p"><span>کد تخفیف</span></th>
                                            <th class="wd-lg-20p"><span>درصد تخفیف</span></th>
                                            <th class="wd-lg-20p"><span>نام معرف</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($discounts as $key => $discount)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>@if($discount->type === 0) کد تخیف یکبار مصرف@elseif($discount->type === 1) کد تخیف جشواره ای @elseif($discount->type === 2) کد تخیف معرف@endif</td>
                                                <td>{{ $discount->discount_code }}</td>
                                                <td>{{ $discount->percent }}</td>
                                                <td>@if($discount->type === 2){{ $discount->user->fullName }}@endif</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{route('discount.edit', $discount->id)}}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{route('discount.destroy', $discount->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <i class="fe fe-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                @endforeach
                                            </tr>
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
        $('#discount_type').change(function () {
            let discount_type = $(this).val()
            let users_tag = $('#users')

            if(discount_type === '2'){
                if(users_tag.hasClass('d-none')) {
                    users_tag.removeClass('d-none');
                }
            }else{
                if(!users_tag.hasClass('d-none'))
                    users_tag.addClass('d-none')
            }
        });
    </script>
    <script src="{{ asset('backEnd/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('backEnd/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#discount_start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#discount_start_date',
                initialValue: false
            })
        });
        $(document).ready(function() {
            $('#discount_end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#discount_end_date',
                initialValue: false
            })
        });
        $(document).ready(function() {
            $('#using_period_start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#using_period_start_date',
                initialValue: false
            })
        });
        $(document).ready(function() {
            $('#using_period_end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#using_period_end_date',
                initialValue: false
            })
        });
    </script>
@endsection
