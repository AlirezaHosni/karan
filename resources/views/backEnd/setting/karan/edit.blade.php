@extends('backEnd.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-2">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card pt-2">
                            @include('alert.alert')
                            <form action="{{ route('setting.karanCompetition.update', $karanCompetition->id) }}" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-12">
                                    <div class="row-cols-2 row">
                                        <div class="form-group col-12">
                                            <label for="grade_id" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                            <select name="grade_id"  class="form-control" id="grade_id">
                                                <option value=""></option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" @if(old('grade_id', $karanCompetition->grade_id) == $grade->id) selected @endif>{{ $grade->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="card-body col-12">
                                            <div class="list-group list-group-horizontal col-12 w-100 btn-group justify-content-center" data-toggle="buttons">
                                                <label class="btn list-group-item border col-1 mx-2 @if(old('karan_number', $karanCompetition->karan_number) == 1) active @endif">
                                                    <input type="radio" name="karan_number" value="1" hidden @if(old('karan_number', $karanCompetition->karan_number) == 1) checked @endif>کران اول
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2 @if(old('karan_number', $karanCompetition->karan_number) == 2) active @endif">
                                                    <input type="radio" name="karan_number" value="2" hidden @if(old('karan_number', $karanCompetition->karan_number) == 2) checked @endif>کران دوم
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2 @if(old('karan_number', $karanCompetition->karan_number) == 3) active @endif">
                                                    <input type="radio" name="karan_number" value="3" hidden @if(old('karan_number', $karanCompetition->karan_number) == 3) checked @endif>کران سوم
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2 @if(old('karan_number', $karanCompetition->karan_number) == 4) active @endif">
                                                    <input type="radio" name="karan_number" value="4" hidden @if(old('karan_number', $karanCompetition->karan_number) == 4) checked @endif>کران چهارم
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2 @if(old('karan_number', $karanCompetition->karan_number) == 5) active @endif">
                                                    <input type="radio" name="karan_number" value="5" hidden @if(old('karan_number', $karanCompetition->karan_number) == 5) checked @endif>کران پنجم
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2 @if(old('karan_number', $karanCompetition->karan_number) == 6) active @endif">
                                                    <input type="radio" name="karan_number" value="6" hidden @if(old('karan_number', $karanCompetition->karan_number) == 6) checked @endif>کران ششم
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2 @if(old('karan_number', $karanCompetition->karan_number) == 7) active @endif">
                                                    <input type="radio" name="karan_number" value="7" hidden @if(old('karan_number', $karanCompetition->karan_number) == 7) checked @endif>کران هفتم
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2 @if(old('karan_number', $karanCompetition->karan_number) == 8) active @endif">
                                                    <input type="radio" name="karan_number" value="8" hidden @if(old('karan_number', $karanCompetition->karan_number) == 8) checked @endif>کران هشتم
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-12" id="createTestDiv">
                                            <div class="form-group col-12" >
                                                <label for="question" class="form-label">صورت سوال</label>
                                                <input type="text" name="question" class="form-control col-12"
                                                       value="{{ $karanCompetition->question }}" >
                                            </div>
                                            <div class="form-group col-12 row">
                                                @foreach($karanCompetition->answers as $key => $answer)
                                                    <input type="text" name="answer[{{ $answer->id }}]" value="{{ $answer->answer }}" class="form-control col-8">
                                                    <input type="file" name="answerImage[{{ $answer->id }}]" class="form-control col-2">
                                                    <img src="{{ asset($answer->image) }}" class="col-2" alt="بدون عکس">
                                                @endforeach
                                                <div class="col-7 row">
                                                    <label for="true" class="form-label">پاسخ:</label>
                                                    <select name="true"  class="form-control" id="true">
                                                        @foreach($karanCompetition->answers as $key => $answer)
                                                            <option value="{{ $answer->id }}" @if($answer->is_true == 1) selected @endif>{{ ++$key }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-12">
                                                <div class="col-12 mb-1">
                                                    <label for="image" class="form-label">بارگذاری تصویر یا نمودار سوال:</label>
                                                    <div class="col-12 row">
                                                        <div class="col-6">
                                                            <input type="file" name="image" id="image" class="form-control"/>
                                                        </div>
                                                        <div class="col-6">
                                                            <img src="{{ asset($karanCompetition->image) }}" width="150px" alt="بدون عکس">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="time" class="form-label">زمان(ثانیه):</label>
                                                <input type="text" value="{{ old('time', $karanCompetition->time) }}" name="time" id="time" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mr-2 col-12">
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
                                            <th class="wd-lg-20p"><span>صورت سوال</span></th>
                                            <th class="wd-lg-20p"><span>شماره کران</span></th>
                                            <th class="wd-lg-20p text-center">عمل</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($karanCompetitions as $key => $karanCompetition)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $karanCompetition->question }}</td>
                                                <td>{{ $karanCompetition->karan_number }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('setting.karanCompetition.edit', $karanCompetition->id) }}" class="btn btn-success btn-sm ml-2">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <form action="{{ route('setting.karanCompetition.destroy', $karanCompetition->id) }}" method="post">
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
