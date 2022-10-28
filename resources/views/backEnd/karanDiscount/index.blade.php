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
                                    <h5 class="font-weight-bold float-right">صدور کد تخفیف مسابقه
                                        کران آخر</h5>
                                </div>
                            </div>
                            <hr>
                            <form action="{{ route('discount.karanDiscount.store') }}" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <div class="col-12">
                                        <label for="karanDiscount_id">تخفیف مد نظر برای کران شماره:</label>
                                        <div class="form-group col-6">
                                           <select name="karanDiscount_id"  class="form-control" id="karanDiscount" data-url="{{ route('searchLessons') }}">
                                               <option></option>
                                               @foreach($karanDiscounts as $key => $karanDiscount)
                                                   <option value="{{ $karanDiscount->id }}">شماره کران را انتخاب نمایید {{ $karanDiscount->karan }}</option>
                                               @endforeach
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
                                            <div class="form-group col-6">
                                                <label for="discount_code">کد تخفیف:</label>
                                                <input type="text" name="discount_code" id="discount_code" value="" class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="percent">درصد تخفیف:</label>
                                                <input type="text" name="percent" id="percent" value="" class="form-control form-control-sm">
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
        $('#karanDiscount').change(function () {
            let karan = $(this).val()
            let karanDiscounts = @json($karanDiscounts);
            console.log

            $('#discount_start_date_view').val(karanDiscounts[karan-1].discount_start_date);
            $('#discount_start_date').val(karanDiscounts[karan-1].discount_start_date);

            $('#discount_end_date_view_view').val(karanDiscounts[karan-1].discount_end_date_view);
            $('#discount_end_date_view').val(karanDiscounts[karan-1].discount_end_date);

            $('#using_period_start_date_view').val(karanDiscounts[karan-1].using_period_start_date);
            $('#using_period_start_date').val(karanDiscounts[karan-1].using_period_start_date);

            $('#using_period_end_date_view').val(karanDiscounts[karan-1].using_period_end_date);
            $('#using_period_end_date').val(karanDiscounts[karan-1].using_period_end_date);

            $('#percent').val(karanDiscounts[karan-1].percent);

            $('#discount_code').val(karanDiscounts[karan-1].discount_code);
        });
    </script>
    <script src="{{ asset('backEnd/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('backEnd/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#discount_start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#discount_start_date',
            })
        });
        $(document).ready(function() {
            $('#discount_end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#discount_end_date',
            })
        });
        $(document).ready(function() {
            $('#using_period_start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#using_period_start_date',
            })
        });
        $(document).ready(function() {
            $('#using_period_end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#using_period_end_date',
            })
        });
    </script>
@endsection
