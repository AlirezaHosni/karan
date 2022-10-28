<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>کران بالا</title>
  <link rel="stylesheet" href="{{ asset('site/karan/css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('site/karan/bootstrap-5.2.2-dist/css/bootstrap-reboot.min.css') }}">
  <link rel="stylesheet" href="{{ asset('site/karan/css/media-query.css') }}">
  <link href="style.css" rel="stylesheet" media="all" />
  <link href="portrait.css" rel="stylesheet" media="(orientation:portrait)" />
  <link href="print.css" rel="stylesheet" media="print" />
</head>

<body>
  <!-- Top Header -->
  <nav class="navbar header flex-row justify-content-between navbar-dm-expand sticky-top">
    <div class="container">
      <div class="right-side-header d-flex align-items-center col-6">
        <div class="col-md-3">
          <img src="{{ asset('site/karan/images/logo.png') }}" alt="" class="navbar-brand logo">
        </div>
        <div class="header-icons col-3 d-flex">
          <a href="#"><img src="{{ asset('site/karan/images/icon1.png') }}" alt="user"></a>
          <a href="#"><img src="{{ asset('site/karan/images/icon2.png') }}" alt="basket"></a>
          <a href="{{ route('user.dashboard.entryPanel.index') }}"><img src="{{ asset('site/karan/images/icon3.png') }}" alt="monitor"></a>
        </div>
      </div>
      <div class="goat">
        <img src="{{ asset('site/karan/images/goat.png') }}" alt="">
      </div>
      <div class="main-header col-5">
        <div class="header-copy d-flex">
          <div class="main-header-text">
            <p class="mt-3" dir="rtl">{{ jalaliDate(Carbon\Carbon::now(), '%A %d %B %Y H:i') }}</p>
          </div>
          <div class="header-search d-flex">
            <button type="button" class="header-button">
              <i class="fas fa-search"></i>
            </button>
            <div class="form-outline">
              <input type="search" id="form1" class="form-control" placeholder="جست و جو" />
            </div>
          </div>
        </div>
        <input type="checkbox" id="check" class="checkbox" hidden>
        <div class="hamburger-menu">
          <label for="check" class="menu">
            <div class="menu-line line1"></div>
            <div class="menu-line line2"></div>
            <div class="menu-line line3"></div>
          </label>
        </div>
        <div class="main-navbar d-md-flex align-items-center">
          <div class="main-header-text">
            <p class="mt-3" dir="rtl">{{ jalaliDate(Carbon\Carbon::now(), '%A %d %B %Y H:i') }}</p>
          </div>
          <div class="header-search d-flex">
            <button type="button" class="header-button">
              <i class="fas fa-search"></i>
            </button>
            <div class="form-outline">
              <input type="search" id="form1" class="form-control" placeholder="جست و جو" />
            </div>
          </div>
          <div class="header-icons col-3 d-flex burger-menu-icons">
            <a href="#"><img src="{{ asset('site/karan/images/icon1.png') }}" alt="user"></a>
            <a href="#"><img src="{{ asset('site/karan/images/icon2.png') }}" alt="basket"></a>
            <a href="{{ route('user.dashboard.entryPanel.index') }}"><img src="{{ asset('site/karan/images/icon3.png') }}" alt="monitor"></a>
          </div>
          <ul class="navbar-nav d-flex flex-column main-nav navbar-expand">
            <li class="nav-item"><a href="{{ route('grades') }}" class="nav-link">خانه</a></li>
            <li class="nav-item"><a href="{{ route('lessons', $grade->id) }}" class="nav-link">آموزش</a></li>
            <li class="nav-item"><a href="{{ route('aboutUs') }}" class="nav-link">درباره ما</a></li>
            <li class="nav-item"><a href="{{ route('user.dashboard.contactUs.index') }}" class="nav-link">ارتباط با ما</a></li>
            <li class="nav-item"><a href="#" class="nav-link">بلاگ</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
<!-- News Menu -->
  <div class="down-menu">
    <div class="down-menu-move">
      <p class="down-menu-text">
          @foreach($news as $singleNews)
              <a class="text-dark" href="{{ route('user.dashboard.news.index') }}">{{ $singleNews->title }}</a>
              {{ '                     ' }}
          @endforeach
      </p>
    </div>
  </div>
<!-- About Us Section -->
  <section class="about-us fade-in">
      <div class="about-us-grid mb-5">
        <div class="about-us-content d-flex flex-column mt-5 align-items-center">
          <a href="#"><img src="{{ asset('site/karan/images/217038633.png') }}" alt="alialavi"></a>
          <button>علی علوی</button>
        </div>
        <div class="about-us-text d-flex flex-column mt-5 align-items-center two-img">
          <div class="img-right d-flex mt-2">
          <a href="#"><img src="{{ asset('site/karan/images/5.png') }}" alt="" class="img-fluid book-img"></a>
            <div class="img-left">
              <a href="#"> <img src="{{ asset('site/karan/images/logo.png') }}" alt="karan"></a>
              <h3 class="text-info-title">کران ي موفقیت در کران بالا</h3>
            </div>
          </div>
          <p class="col-7 info">کران ي موفقیت در کران بالا ما بر این باوریم که با استعانت از درگاه باري تعالی، همیت و
            کوشش اساتید گرانقدر و
            ران ي موفقیت در کران بالا ما بر این باوریم که با استعانت از درگاه باري تعالی، همیت و کوشش اساتید  گرانقدرو
          </p>
        </div>
        <div class="about-us-text d-flex flex-column mt-5 align-items-center">
            <div class="col-7 info">
                {!! $grade->gradeDescription->description !!}
            </div>
        </div>
        <div class="about-us-content d-flex flex-column text-left mt-5 align-items-center">
          <a href="{{ route('lesson.chooseLessonItem', $grade->gradeDescription->selected_lesson_id) }}"> <img src="{{ asset('site/karan/images/915032575.png') }}" alt="maryam-mirzakhani" class="maryam-img"></a>
          <button>{{ $grade->gradeDescription->selectedLesson->title . ' ' . $grade->title }} </button>
        </div>
      </div>
  </section>
<!-- Our Service Pictures Section -->
  <section class="our-service container d-flex flex-wrap fade-in mt-5">
    <a href="{{ route('lessons', $grade->id) }}"> <img src="{{ asset('site/karan/images/Layer 4.png') }}" alt="service1"></a>
    <a href="{{ route('karanBala.exam.chooseExamType') }}"><img src="{{ asset('site/karan/images/Layer 5.png') }}" alt="service2"></a>
      <a href="{{ route('onlineContact') }}"><img src="{{ asset('site/karan/images/Layer 6.png') }}" alt="service3"></a>
  </section>
  <!-- Gallery & Box & Text Section  -->
  <section class="gallery">
    <div class="container">
      <div class="gallery-grid">
        <div class="gallery-img fade-in text-right">
          <a href="#"><img src="{{ asset('site/karan/images/candy-shomin.png') }}" alt=""></a>
        </div>
        <div class="gallery-box-text d-flex flex-column align-items-end mt-5 fade-in">
          <p>دانش آموزان عزیز میتواند در بخش کتابچه راهنمای کران با تمام بخش های اموزش،آزمون و ارتباط آنلاین به صورت
            متنی و اینفوگرافیک اشنا شوید،
            <br> برای دسترسی به ویدیو های هر بخش روی بخش مربوطه کلیک کنید<br>
          </p>
          <div class="box-group fade-in">
            <div class="box1 bg-primary box-item">
              <p>ارتباط انلاین</p>
            </div>
            <div class="box2 bg-warning box-item">
              <p>آزمون</p>
            </div>
            <div class="box3 bg-danger box-item">
              <p>آموزش</p>
            </div>
          </div>
        </div>
        <div class="gallery-img align-items-start fade-in">
          <div class="position text-right">
            <a href="#"><img src="{{ asset('site/karan/images/Layer 9.png') }}" alt=""></a>
            <h2>مسابقه کران</h2>
          </div>
        </div>
        <div class="gallery-img d-flex flex-column align-items-end fade-in">
          <img src="{{ asset('site/karan/images/Layer 12.png') }}" alt="" class="gallery-img-study">
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- Teachers Info Section -->
  <section class="our-teachers fade-in">
    <div class="our-teachers-grid container">
          @foreach($teachers as $teacher)
              <div class="teacher-card d-flex flex-column align-items-center">
                    <img src="{{ asset($teacher->user->image) }}" alt="عکس دبیر">
                    <h3>{{ $teacher->user->fullName }}</h3>
                    @php
                        $lessonIds = $teacher->sessions()->distinct('lesson_id')->pluck('lesson_id')->toArray();
                    @endphp
                    <h5>{{ implode(',', \App\Lesson::whereIn('id', $lessonIds)->pluck('title')->toArray()) }}</h5>
                    <div class="our-teachers-line"></div>
                    <p>{!! $teacher->resume !!}</p>
              </div>
          @endforeach
    </div>
  </section>
  <!-- Footer -->
  <footer>
    <section class="top-footer">
      <div class="top-footer-img">
        <img src="{{ asset('site/karan/images/footer-logo-bg-lg.png') }}" class="footer-img" alt="">
        <img src="{{ asset('site/karan/images/goat.png') }}" class="footer-goat" alt="">
      </div>
    </section>
    <section class="main-footer">
      <div class="container">
        <div class="main-footer-content">
          <div class="footer-icon">
            <div class="icons-group d-flex">
              <div class="icons"><i class="fa-brands fa-instagram"></i></div>
              <div class="icons"><i class="fa-brands fa-telegram"></i></div>
              <div class="icons"><i class="fa-brands fa-linkedin"></i></div>
              <div class="icons"><i class="fa-brands fa-twitter"></i></div>
            </div>
          </div>
          <div class="footer-contact d-flex">
            <h3>Info@karanbala.com</h3>
            <h3>00000 - 021</h3>
          </div>
        </div>
      </div>
    </section>
    <section class="down-footer">
      <div class="container">
        <div class="down-footer-content">
          <div class="footer-text-area">
            <p>همراه شما هستیم شما میتوانید به راحتی از طریق روش های زیر با مجموعه ما در تماس باشید</p>
          </div>
          <div class="footer-text-area">
            <p>همراه شما هستیم شما میتوانید به راحتی از طریق روش های زیر با مجموعه ما در تماس باشید</p>
          </div>
          <div class="img-group-footer">
            <img src="{{ asset('site/karan/images/namad.png') }}" alt="">
          </div>
        </div>
      </div>
    </section>
  </footer>


  <!-- bootstrap Css CDN -->
  <link href="{{asset('backEnd/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
  <!-- JS CDN -->
  <script src="{{asset('backEnd/plugins/bootstrap/js/popper.min.js')}}"></script>
  <script src="{{asset('backEnd/plugins/bootstrap/js/bootstrap-rtl.js')}}"></script>

  <script>

// Fade loading Java Script
    const faders = document.querySelectorAll('.fade-in');
    const appearOptions ={
      threshold: 0,
      rootMargin: "0px 0px -100px 0px"
    };
    const appearOnScroll = new IntersectionObserver
    (function (
      entries,
      appearOnScroll)
      {entries.forEach(entry => {
      if (!entry.isIntersecting){
        return;

      }else{
        entry.target.classList.add('appear');
        appearOnScroll.unobserve(entry.target);
      }
    });
  },
  appearOptions);

  faders.forEach(fader => {
    appearOnScroll.observe(fader);
  })
  </script>
</body>

</html>
