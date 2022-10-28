@extends('backEnd.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">
        <div>
            <div class="inner-body">
                <!-- Row -->
                <div class=" square mt-5">
                    <div class="col-lg-12">
                        <div class="card custom-card ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="profile-tab tab-menu-heading">
                                            <nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100">
                                                <p>ویرایش اطلاعاتی کاربر </p>
                                            </nav>
                                        </div>
                                        <div class="card custom-card main-content-body-profile">
                                            <div class="tab-content">
                                                <div class="main-content-body tab-pane p-4 active border-top-0" id="edit">
                                                    @if($errors->any())
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            @foreach($errors->all() as $key=>$item)
                                                                <ul>
                                                                    <li style="list-style: none">{{++$key}}- {{$item}}</li>
                                                                </ul>
                                                            @endforeach
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    @endif
                                                    @include('alert.alert')
                                                    <div class="card-body border">
                                                        <div class="mb-4 main-content-label">اطلاعات کاربر</div>
                                                        <form class="form-horizontal"
                                                              action="{{ route('userManagement.update', $user->id) }}"
                                                              method="post"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            @method('put')
                                                            {{--                                                            <div class="mb-4 main-content-label"></div>--}}
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="username">نام کاربری<i>(الزامی)</i></label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <input type="text" name="name" id="name"
                                                                               class="form-control"
                                                                               value="{{ old('name', $user->name) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="fullName">نام و نام‌خانوادگی(الزامی)</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <input type="text" name="fullName" id="fullName"
                                                                               class="form-control"
                                                                               value="{{ old('fullName', $user->fullName) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="father_name">نام پدر</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <input type="text" name="father_name" id="father_name"
                                                                               class="form-control"
                                                                               value="{{ old('father_name', $user->father_name) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="email">ایمیل <i>(الزامی)</i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <input type="text" name="email" id="email"
                                                                               class="form-control"
                                                                               value="{{ old('email', $user->email) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="phoneNumber"> شماره همراه(الزامی)</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="phoneNumber" id="phoneNumber"
                                                                               class="form-control"
                                                                               value="{{ old('phoneNumber', $user->phoneNumber) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="parent_phoneNumber"> شماره همراه والدین</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <input type="text" name="parent_phoneNumber" id="parent_phoneNumber"
                                                                               class="form-control"
                                                                               value="{{ old('parent_phoneNumber', $user->parent_phoneNumber) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="gender">جنسیت</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <select name="gender" class="form-control"
                                                                                id="gender">
                                                                            <option value="0" @if(old('gender', $user->gender) == 0) selected @endif>خانم</option>
                                                                            <option value="1" @if(old('gender', $user->gender) == 1) selected @endif>آقا</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="role"> تعیین نقش</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <select name="role" class="form-control"
                                                                                id="role">
                                                                            <option value="0" @if(old('role', $user->hasRole('دانش‌آموز')) == 0 or old('role', $user->hasRole('دانش‌آموز')) === true) selected @endif>دانش آموز</option>
                                                                            <option value="1" @if(old('role', $user->hasRole('معلم')) == 1 or old('role', $user->hasRole('معلم')) === true) selected @endif>معلم</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="province">استان</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <input type="text" name="province" id="province"
                                                                               class="form-control"
                                                                               value="{{ old('province', $user->province) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="city">شهر</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <input type="text" name="city" id="city"
                                                                               class="form-control"
                                                                               value="{{ old('city', $user->city) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="birthday">تاریخ تولد</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <input type="text" name="birthday" id="birthday" class="form-control form-control-sm d-none" value="{{ $user->birthday }}">
                                                                        <input type="text" id="birthday_view" class="form-control" value="{{ jalaliDate($user->birthday, "%Y/%m/%d") }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="unit">سهمیه مناطق</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <select name="unit" class="form-control"
                                                                                id="unit">
                                                                            <option value="1" @if(old('unit', $user->unit) == 1) selected @endif>منطقه یک</option>
                                                                            <option value="2" @if(old('unit', $user->unit) == 2) selected @endif>منطقه دو</option>
                                                                            <option value="3" @if(old('unit', $user->unit) == 3) selected @endif>منطقه سه</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="grade_id">انتخاب پایه</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <select name="grade_id" class="form-control" id="grade_id">
                                                                            <option></option>
                                                                            @foreach($grades as $grade)
                                                                                <option value="{{ $grade->id }}" @if(old('grade_id', $user->grade_id) == $grade->id) selected @endif>{{ $grade->title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="image">تغییر تصویر پروفایل</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <input type="file" name="image" id="image"
                                                                               class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="national_code">کد ملی</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <input type="text" name="national_code" id="national_code"
                                                                               class="form-control"
                                                                               value="{{ old('national_code', $user->national_code) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="password">تغییر رمز</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <input type="password" name="password" id="password"
                                                                               class="form-control" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-12">
                                                                        <label class="form-label" for="password_confirmation">تکرار رمز</label>
                                                                    </div>
                                                                    <div class="col-md-9 col-12">
                                                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-3">
                                                                <button type="submit" class="btn btn-warning mr-1">ذخیره
                                                                    کردن
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.alert-success').fadeOut(250);
            $('#password').val('')
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#birthday_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#birthday'
            })
        });
    </script>
@endsection
