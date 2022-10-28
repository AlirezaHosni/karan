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
                <div class="mt-2">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card pt-2">
                            <div class="card-header border-bottom-0 pb-0">
                                <div>
                                    <h3 class="font-weight-bold text-center">فروشگاه</h3>
                                    <h5 class="font-weight-bold float-right">آزمون برنامه‌ای</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <form action="{{ route('discount.examDiscount.store') }}" method="post" class="col-12" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12 row">
                                        <div class="form-group col-6">
                                            <label for="grade_id">پایه مورد نظر را انتخاب کنید:</label>
                                            <select name="grade_id"  class="form-control" id="grades" data-url="{{ route('discount.examDiscount.exams') }}">
                                                <option value=""></option>
                                                @foreach($grades as $grade)
                                                    <option value="{{$grade->id}}" @if(old('grade_id') == $grade->id) selected @endif>{{$grade->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="exam_id">آزمون مورد نظر را انتخاب کنید:</label>
                                            <select name="exam_id"  class="form-control" id="examOptions">
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                                <label for="price">تعیین قیمت آزمون</label>
                                                <input type="text" id="price" name="price" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="">تنظیم تخفیف:</label>
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
                                        <div class="col-12 row">
                                            <div class="form-group col-6">
                                                <label for="discount_percent">درصد تخفیف:</label>
                                                <input type="text" name="discount_percent" id="percent" value="" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="form-group row mr-2 col-6">
                                            <button type="submit" class="btn btn-info">
                                                ثبت
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
        $('#grades').change(function (){
            if($(this).val() !== ''){
                var data = {
                    _token: '{{ csrf_token() }}',
                    grade_id : $(this).val()
                };
                url = $(this).attr('data-url')

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (data) {
                        result = data;
                        $('#examOptions').empty();
                        $('#examOptions').append('<option value=""></option>');
                        $.each(data, function (i, value) {
                            $('#examOptions').append('<option value=' + JSON.stringify(value.id) + '>' + 'آزمون شماره ' + JSON.stringify(value.number) +'</option>');
                        });
                    },
                    error: function error(data) {
                        result = data;
                    },
                })
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
            })
        });
    </script>
@endsection
