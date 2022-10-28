<div class="main-sidebar main-sidebar-sticky side-menu">
    <div class="sidemenu-logo">
        <a class="main-logo" href="{{route('home')}}">
            <img src="{{ asset('assets/img/brand/logo.png') }}" class="we-logo" height="50px " alt="لوگو" />
        </a>
    </div>
    <div class="main-sidebar-body">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}"><span class="shape1"></span><span class="shape2"></span><i class="ti-home sidemenu-icon"></i><span class="sidemenu-label">داشبورد</span></a>
            </li>
            <li class="nav-header"><span class="nav-label">مدیریت محتوا</span></li>

            <ul >
                <li class="nav-sub-link" >
                    <a class="nav-sub-link" href="{{route('grade.index')}}"><i class="fa fa-school fa-lg ml-2 text-warning"></i>ایجاد پایه</a>
                </li>
                <li class="navitem">
                    <a class="nav-sub-link" href="{{route('lesson.index')}}"> <i class="fa fa-book fa-lg ml-2 text-warning"></i>ابجاد کتاب</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{route('book.index')}}" ><i class="fa fa-list fa-lg ml-2 text-warning"></i>ایجاد فصل/درس</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{route('book-part.index')}}" ><i class="fa fa-list-ol fa-lg ml-2 text-warning"></i>ایجاد بخش</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{route('topic.index')}}" ><i class="fa fa-list-ul fa-lg ml-2 text-warning"></i>ایجاد موضوع</a>
                </li>
            </ul>
            <li class="nav-header"><span class="nav-label">آموزش</span></li>
            <ul>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('education.IntroduceBookAttachmentsIndex') }}"><i class="fa fa-map fa-lg ml-2 text-warning"></i>معرفی کتاب</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('education.textBookAttachmentsIndex') }}"><i class="fa fa-bar-chart fa-lg ml-2 text-warning"></i>  درسنامه تشریحی  </a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('education.descriptiveTestAttachmentsIndex') }}"><i class="fa fa-map fa-lg ml-2 text-warning"></i>  سوالات تشریحی </a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('education.examBookAttachmentsIndex') }}"><i class="fa fa-bars fa-lg ml-2 text-warning"></i>  نکته و تست </a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('education.selectionExam.topic.test.Index') }}"><i class="fa fa-bullhorn fa-lg ml-2 text-warning"></i>آزمون انتخابی</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('education.karanBalaAttachmentsIndex') }}"><i class="fa fa-tag fa-lg ml-2 text-warning"></i> کران بالا  </a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('education.AppendicesAttachmentsIndex') }}"><i class="fa fa-tag fa-lg ml-2 text-warning"></i>  ضمایم  </a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('education.ExamQuestionSampleAttachmentsIndex') }}"><i class="fa fa-tag fa-lg ml-2 text-warning"></i> نمونه سوالات امتحانی  </a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('education.booksExercisesAttachmentsIndex') }}"><i class="fa fa-tag fa-lg ml-2 text-warning"></i> تمارین داخل کتاب  </a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('education.generalExamBookIndex') }}"><i class="fa fa-tag fa-lg ml-2 text-warning"></i> تست های جامع  </a>
                </li>
            </ul>
            <li class="nav-header"><span class="nav-label">فروشگاه</span></li>
            <ul>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('store.subscription.index') }}"><i class="fa fa-store fa-lg ml-2 text-warning"></i>آموزش</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('discount.examDiscount.index') }}"><i class="fa fa-percent fa-lg ml-2 text-warning"></i>تخفیف آزمون‌های برنامه‌ای</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('discount.index') }}"><i class="fa fa-percent fa-lg ml-2 text-warning"></i>صدور کد تخفیف</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('discount.karanDiscount.index') }}"><i class="fa fa-percent fa-lg ml-2 text-warning"></i>تخفیف کران‌ها</a>
                </li>
                {{--                <li class="nav-sub-item">--}}
                {{--                    <a class="nav-sub-link" href="{{ route('admin.onlineContact') }}"><i class="fa fa-bullhorn fa-lg ml-2 text-warning"></i>ارتباط آنلاین</a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-sub-item">--}}
                {{--                    <a class="nav-sub-link" href="{{ route('admin.questionBank') }}"><i class="fa fa-bullhorn fa-lg ml-2 text-warning"></i>بانک سوال</a>--}}
                {{--                </li>--}}
            </ul>
            <li class="nav-header"><span class="nav-label">پنل ارتباطی کاربران</span></li>
            <ul>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('contact.file.index', ['type' => 'sentFile']) }}"><i class="fa fa-comment fa-lg ml-2 text-warning"></i>فایل‌های ارسالی</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('contact.file.index', ['type' => 'criticism']) }}"><i class="fa fa-comment fa-lg ml-2 text-warning"></i>انتقادات</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('contact.file.index', ['type' => 'suggestion']) }}"><i class="fa fa-comment fa-lg ml-2 text-warning"></i>پیشنهادات</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('contact.file.index', ['type' => 'question']) }}"><i class="fa fa-comment fa-lg ml-2 text-warning"></i>سوالات مطرج شده</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('contact.teacherRate.index') }}"><i class="fa fa-chalkboard-teacher fa-lg ml-2 text-warning"></i>امتیاز دهی اساتید</a>
                </li>
            </ul>
            <li class="nav-header"><span class="nav-label">صفحه اصلی</span></li>
            <ul>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('setting.logo.index') }}"><i class="fa fa-image fa-lg ml-2 text-warning"></i>لوگو</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('setting.agent.index') }}"><i class="fa fa-user-alt fa-lg ml-2 text-warning"></i>شخص معرف رشته</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('setting.help.index', 'education') }}"><i class="fa fa-hands-helping fa-lg ml-2 text-warning"></i>راهنما</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('setting.student.index') }}"><i class="fa fa-user fa-lg ml-2 text-warning"></i>عکس دانش‌آموز</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('setting.karanCompetition.index') }}"><i class="fa fa-trophy fa-lg ml-2 text-warning"></i>مسابقه کران</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('setting.teacherList.index') }}"><i class="fa fa-chalkboard-teacher fa-lg ml-2 text-warning"></i>لیست اساتید</a>
                </li>
            </ul>
            <li class="nav-header"><span class="nav-label">موارد بیشتر</span></li>
            <ul>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('education.planExam.test.Index') }}"><i class="fa fa-list-ul fa-lg ml-2 text-warning"></i>آزمون برنامه‌ای</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('education.planExam.placementTest.test.index') }}"><i class="fa fa-list fa-lg ml-2 text-warning"></i>آزمون تعیین سطح</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('admin.onlineContact') }}"><i class="fa fa-bullhorn fa-lg ml-2 text-warning"></i>ارتباط آنلاین</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('admin.questionBank') }}"><i class="fa fa-bullhorn fa-lg ml-2 text-warning"></i>بانک سوال</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('news.index') }}"><i class="fa fa-newspaper fa-lg ml-2 text-warning"></i>اخبار</a>
                </li>
            </ul>
            <li class="nav-sub-item">
                <a class="nav-sub-link" href="{{ route('identifier.index') }}"><i class="fa fa-user fa-lg ml-2 text-warning"></i>معرف</a>
            </li>




{{--            <li class="nav-header"><span class="nav-label">مدریت کاربران</span></li>--}}

{{--            <ul>--}}
{{--                <li class="nav-sub-item">--}}
{{--                    <a class="nav-sub-link" href="{{route('userManagement.index')}}"><i class="fa fa-user fa-lg ml-2 text-warning"></i>  مدیریت کاربران</a>--}}
{{--                </li>--}}


{{--                <li class="nav-sub-item">--}}
{{--                    <a class="nav-sub-link" href="{{route('role.index')}}"><i class="fa fa-comment fa-lg ml-2 text-warning"></i> نقش ها </a>--}}
{{--                </li>--}}
{{--                <li class="nav-sub-item">--}}
{{--                    <a class="nav-sub-link" href="{{route('permission.index')}}"><i class="fa fa-comment fa-lg ml-2 text-warning"></i> وظایف </a>--}}
{{--                </li>--}}
{{--               --}}{{-- <li class="nav-sub-item">--}}
{{--                    <a class="nav-sub-link" href="./chat.html"><i class="fa fa-support fa-lg ml-2 text-warning"></i>  تیکت ها </a>--}}
{{--                </li>--}}
{{--            </ul>--}}

           {{-- <li class="nav-item">
                <a class="nav-link with-sub" href="#">
                    <span class="shape1"></span><span class="shape2"></span><i class="ti-lock sidemenu-icon"></i><span class="sidemenu-label">صفحات سفارشی</span><i class="angle fe fe-chevron-left"></i>
                </a>
                <ul class="nav-sub">
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="signin.html">ورود</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="signup.html">ثبت نام</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="forgot.html">رمز عبور را فراموش کرده اید</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="reset.html">بازنشانی گذرواژه</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="lockscreen.html">صفحه قفل</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="underconstruction.html">در دست ساخت</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="error404.html">خطای 404</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="error500.html">500 خطا</a>
                    </li>
                </ul>
            </li>--}}
        </ul>
    </div>
</div>
