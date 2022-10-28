<div class="main-sidebar main-sidebar-sticky side-menu">
    <div class="sidemenu-logo">
        <a class="main-logo" href="{{ route('home')}} ">
            <img src="{{ asset('assets/img/brand/logo.png') }}" class="we-logo" height="50px " alt="لوگو" />
        </a>
    </div>
    <div class="main-sidebar-body">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.dashboard.entryPanel.index') }}"><span class="shape1"></span><span class="shape2"></span><i class="ti-home sidemenu-icon"></i><span class="sidemenu-label">داشبورد</span></a>
            </li>
            <li class="nav-header"><span class="nav-label">پنل ورودی</span></li>
            <ul>
                <li class="nav-sub-item" >
                    <a class="nav-sub-link" href="{{ route('user.dashboard.entryPanel.index') }}"><i class="fa fa-user fa-lg ml-2 text-warning"></i>پروفایل</a>
                </li>
            </ul>
            <li class="nav-header"><span class="nav-label">میزکار</span></li>
            <ul>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('user.dashboard.schedule.index') }}"><i class="fa fa-list fa-lg ml-2 text-warning"></i>دفتر برنامه‌ریزی</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('user.dashboard.contactUs.index') }}"><i class="fa fa-user fa-lg ml-2 text-warning"></i>ارتباط با ما</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('user.dashboard.speakToStudent.index') }}"><i class="fa fa-user-alt fa-lg ml-2 text-warning"></i>سخنی با دانش‌آموز</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('user.dashboard.UserFile.index') }}"><i class="fa fa-file fa-lg ml-2 text-warning"></i>فایل‌های ذخیره شده</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('user.dashboard.news.index') }}"><i class="fa fa-newspaper fa-lg ml-2 text-warning"></i>اخبار کران</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('user.dashboard.examReport.index') }}"><i class="fa fa-book-open fa-lg ml-2 text-warning"></i>کارنامه‌ها</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('user.dashboard.studyProcess.index') }}"><i class="fa fa-book-reader fa-lg ml-2 text-warning"></i>روند مطالعاتی</a>
                </li>
                <li class="nav-sub-item">
                    <a class="nav-sub-link" href="{{ route('user.dashboard.rateTeacher.index') }}"><i class="fa fa-chalkboard-teacher fa-lg ml-2 text-warning"></i>امتیازدهی به اساتید</a>
                </li>
            </ul>
{{--            <li class="nav-header"><span class="nav-label">آزمون</span></li>--}}
{{--            <ul>--}}
{{--                <li class="nav-sub-item" >--}}
{{--                    <a class="nav-sub-link" href="{{ route('user.dashboard.exam.placementTest.chooseLesson') }}"><i class="fa fa-list fa-lg ml-2 text-warning"></i>آزمون تعیین سطح</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
        </ul>
    </div>
</div>
