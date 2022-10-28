<div class="main-header side-header sticky">
    <div class="container-fluid">
        <div class="main-header-right">
            <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
        </div>
        <div class="main-header-center">
            <div class="responsive-logo text-center">
                <a href=""><img src="{{asset('backEnd/img/brand/logo.png')}}" height="50px" class="" alt="لوگو" /></a>
            </div>
        </div>
        <div class="main-header-right">
            <div class="dropdown header-search">
                <a class="nav-link icon header-search">
                    <i class="fe fe-search header-icons"></i>
                </a>
                <div class="dropdown-menu">
                    <div class="main-form-search p-2">
                        <div class="input-group">
                            <div class="input-group-btn search-panel">
                                <select class="form-control select2-no-search">
                                    <option label="دسته بندی ها"> </option>
                                    <option value="IT Projects">
                                        پروژه های IT
                                    </option>
                                    <option value="Business Case">
                                        مورد تجاری
                                    </option>
                                    <option value="Microsoft Project">
                                        پروژه مایکروسافت
                                    </option>
                                    <option value="Risk Management">
                                        مدیریت ریسک
                                    </option>
                                    <option value="Team Building">
                                        تیم سازی
                                    </option>
                                </select>
                            </div>
                            <input type="search" class="form-control" placeholder="هر چیزی را جستجو کنید ..." />
                            <button class="btn search-btn">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-search"
                                >
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown d-md-flex">
                <a class="nav-link icon full-screen-link" href="#">
                    <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                    <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                </a>
            </div>
            <div class="dropdown main-header-notification">
                <a class="nav-link icon" href="#">
                    <i class="fe fe-bell header-icons"></i>
                    <span class="badge badge-danger nav-link-badge">4</span>
                </a>
                <div class="dropdown-menu">
                    <div class="header-navheading">
                        <p class="main-notification-text">شما 1 اعلان خوانده نشده <span class="badge badge-pill badge-primary mr-3">مشاهده همه</span></p>
                    </div>
                    <div class="main-notification-list">
                        <div class="media new">
                            <div class="main-img-user online"><img alt="آواتار" src="" /></div>
                            <div class="media-body">
                                <p>به <strong>اولیویا جیمز</strong> برای شروع الگوی جدید تبریک می گوییم</p>
                                <span>15 بهمن 12:32 بعد از ظهر</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="main-img-user"><img alt="آواتار" src="{{asset('backEnd\img\users\2.jpg')}}" /></div>
                            <div class="media-body">
                                <p><strong></strong>پیام جدید <strong>جوشوا گری</strong> دریافت شد</p>
                                <span>13 بهمن 02:56 صبح</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="main-img-user online"><img alt="آواتار" src="{{asset('backEnd\img\users\3.jpg')}}" /></div>
                            <div class="media-body">
                                <p><strong>الیزابت لوئیس</strong> برنامه جدیدی را به فروش مجدد اضافه کرد</p>
                                <span>12 بهمن 10:40 بعد از ظهر</span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-footer">
                        <a href="#">مشاهده همه اعلان ها</a>
                    </div>
                </div>
            </div>
            <div class="main-header-notification">
                <a class="nav-link icon" href="chat.html">
                    <i class="fe fe-message-square header-icons"></i>
                    <span class="badge badge-success nav-link-badge">6</span>
                </a>
            </div>
            <div class="dropdown main-profile-menu">
                <a class="d-flex" href="#">
                    <span class="main-img-user"><img alt="پروفایل" src="{{asset('upload/user/'.auth()->user()->image)}}" /></span>
                </a>
                <div class="dropdown-menu">
                    <div class="header-navheading">
                        <h6 class="main-notification-title">{{auth()->user()->name}}</h6>

                        <p class="main-notification-text"></p>
                    </div>

                    <a class="dropdown-item border-top" href="{{route('userManagement.edit',auth()->user()->id)}}"> <i class="fe fe-user"></i> پروفایل من </a>
                    <a class="dropdown-item" href=""> <i class="fe fe-edit"></i> ویرایش نمایه </a>
                    <a class="dropdown-item" href="profile.html"> <i class="fe fe-settings"></i> تنظیمات حساب </a>
                    <a class="dropdown-item" href="profile.html"> <i class="fe fe-settings"></i> پشتیبانی </a>
                    <a class="dropdown-item" href="profile.html"> <i class="fe fe-compass"></i> فعالیت </a>
                    <a class="dropdown-item">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="btn btn-sm"><i class="fe fe-power"></i>خروج از سیستم</button>
                        </form>
                    </a>

                    {{--<a class="dropdown-item" href="{{route('logout')}}"> <button>Logout</button><i class="fe fe-power"></i> خروج از سیستم </a>--}}
                </div>
            </div>
            <button
                class="navbar-toggler navresponsive-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent-4"
                aria-controls="navbarSupportedContent-4"
                aria-expanded="false"
                aria-label="تغییر پیمایش"
            >
                <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
            </button>
            <!-- Navresponsive closed -->
        </div>
    </div>
</div>
