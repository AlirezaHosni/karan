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
                            <form action="{{ route('setting.karanCompetition.store') }}" method="post" class=" d-flex justify-content-center" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <div class="row-cols-2 row">
                                        <div class="form-group col-12">
                                            <label for="grade_id" class="form-label">پایه مورد نظر را انتخاب کنید:</label>
                                            <select name="grade_id"  class="form-control" id="grade_id">
                                                <option value=""></option>
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" @if(old('grade_id') == $grade->id) selected @endif>{{ $grade->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="card-body col-12">
                                            <div class="list-group list-group-horizontal col-12 w-100 btn-group justify-content-center" data-toggle="buttons">
                                                <label class="btn list-group-item border col-1 mx-2">
                                                    <input type="radio" name="karan_number" value="1" hidden>کران اول
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2">
                                                    <input type="radio" name="karan_number" value="2" hidden>کران دوم
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2">
                                                    <input type="radio" name="karan_number" value="3" hidden>کران سوم
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2">
                                                    <input type="radio" name="karan_number" value="4" hidden>کران چهارم
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2">
                                                    <input type="radio" name="karan_number" value="5" hidden>کران پنجم
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2">
                                                    <input type="radio" name="karan_number" value="6" hidden>کران ششم
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2">
                                                    <input type="radio" name="karan_number" value="7" hidden>کران هفتم
                                                </label>
                                                <label class="btn list-group-item border col-1 mx-2">
                                                    <input type="radio" name="karan_number" value="8" hidden>کران هشتم
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-12" id="createTestDiv">
                                            <div class="form-group col-12" >
                                                <label for="question" class="form-label">صورت سوال</label>
                                                <input type="text" name="question" class="form-control col-12"
                                                       placeholder="صورت سوال مورد نظر خود را وارد کنید" >
                                            </div>
                                            <div class="form-group col-12 row mr-1">
                                                <input type="text" name="answer[]" class="form-control col-9" placeholder="گزینه 1">
                                                <input type="file" name="answerImage[]" class="form-control col-3">
                                                <input type="text" name="answer[]" class="form-control col-9" placeholder="گزینه 2">
                                                <input type="file" name="answerImage[]" class="form-control col-3">
                                                <input type="text" name="answer[]" class="form-control col-9" placeholder="گزینه 3">
                                                <input type="file" name="answerImage[]" class="form-control col-3">
                                                <input type="text" name="answer[]" class="form-control col-9" placeholder="گزینه 4">
                                                <input type="file" name="answerImage[]" class="form-control col-3">
                                                <input type="text" name="answer[]" class="form-control col-9" placeholder="گزینه 5">
                                                <input type="file" name="answerImage[]" class="form-control col-3">
                                                <input type="text" name="answer[]" class="form-control col-9" placeholder="گزینه 6">
                                                <input type="file" name="answerImage[]" class="form-control col-3">
                                                <input type="number" name="true" min="1" max="6" class="form-control col-6" placeholder="جواب صحیح">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">بارگذاری تصویر یا نمودار سوال:</label>
                                                <input type="file" name="image" class="form-control"/>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="time" class="form-label">زمان(ثانیه):</label>
                                                <input type="text" value="{{ old('time') }}" name="time" id="time" class="form-control">
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
