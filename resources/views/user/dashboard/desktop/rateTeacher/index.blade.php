@extends('user.dashboard.layouts.master')
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
                                <div class="d-flex justify-content-center">
                                    <h3 class="font-weight-bold">امنتیازدهی به اساتید</h3>
                                </div>
                            </div>
                            @include('alert.alert')
                            <form action="{{ route('user.dashboard.rateTeacher.store') }}" method="post" class="d-flex justify-content-center">
                                @csrf
                                <div class="card-body">
                                    <div class="table-responsive border userlist-table">
                                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th><span> ردیف</span></th>
                                                    <th><span>نام و نام‌خانوادگی</span></th>
                                                    <th><span>فصل/درس</span></th>
                                                    <th><span>بار علمی(۰ تا ۱۰۰)</span></th>
                                                    <th><span>شیوه تدریس(۰ تا ۱۰۰)</span></th>
                                                    <th><span>تدریس کامل(۰ تا ۱۰۰)</span></th>
                                                    <th><span>روش حل سوال(۰ تا ۱۰۰)</span></th>
                                                    <th><span>ارتباط بصری(۰ تا ۱۰۰)</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($teacherSessions as $key => $teacherSession)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $teacherSession->teacher->user->fullName }}</td>
                                                    <td>{{ $teacherSession->session->session }}</td>
                                                    <td><input type="number" min="0" max="100" name="expert[{{ $teacherSession->id }}]" class="form-control"></td>
                                                    <td><input type="number" min="0" max="100" name="teaching_method[{{ $teacherSession->id }}]" class="form-control"></td>
                                                    <td><input type="number" min="0" max="100" name="complete_teaching[{{ $teacherSession->id }}]" class="form-control"></td>
                                                    <td><input type="number" min="0" max="100" name="question_answering_method[{{ $teacherSession->id }}]" class="form-control"></td>
                                                    <td><input type="number" min="0" max="100" name="visual_communication[{{ $teacherSession->id }}]" class="form-control"></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group col-2 mt-3">
                                        <input type="submit" value="ثبت" class="btn btn-primary float-right btn-block " style="border-radius: 10px;">
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
