@extends('backEnd.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0 create-article-row">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-5 ">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card">
                            <div class="card-header border-bottom-0 pb-0">
                                <div class="d-flex justify-content-between">
                                    <label class="main-content-label mb-0 pt-1">ویرایش پایه تحصیلی</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('grade.index')}}" class="btn btn-info"> <i class="fa fa-arrow-right mx-2"></i>برگشت به
                                            لیست</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت / ویرایش پایه تحصیلی </p>
                                <form action="{{ route('grade.update', $grade->id) }}" method="post" class="my-5">
                                    @csrf
                                    @method('put')
                                    <div class="row mb-2">
                                        <div class="col-md-6 col--12">
                                            <div class="form-group">
                                                <label for="title" class="form-label">نام پایه:</label>
                                                <input type="text" name="title" id="title" class="form-control " value="{{ $grade->title }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="last_year_id" class="form-label">سال قبل پایه را انتخاب کنید:</label>
                                            <select name="last_year_id"  class="form-control" id="last_year_id" data-url="{{ route('searchLessons') }}">
                                                <option value="">ندارد</option>
                                                @foreach($grades as $singleGrade)
                                                    <option value="{{ $singleGrade->id }}" @if(old('last_year_id', $singleGrade->last_year_id) == $singleGrade->id) selected @endif>{{ $singleGrade->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex row ">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info mb-3">
                                                    ذخیره
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
