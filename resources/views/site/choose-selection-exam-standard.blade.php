<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/style.css')}}">
    <title>انتخاب آزمون</title>
</head>

<body>
<!-- sectionOne -->
<section class="section-one mt-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 container  ">
        <div class="container-fluid">
            <div class="row w-100">
                <div class="signin-users">
                    <a class="nav-link login-users navbar-links mx-1 text-black " aria-current="page" href="{{route('login')}}"> <img
                            src="{{asset('site/images/users.png')}}"
                            height="25px" class="mx-1" alt=""> ورود کاربران</a>
                </div>
                <div class="header-brand">
                    <span></span>
                </div>
            </div>

        </div>
    </nav>
</section>
<!-- end sectionOne -->
<!-- sectionTWO -->
<section class="d-flex flex-grow-1">
    <div class="container section-two mt-3 mb-5">
        <div class="row ">
            <div class="col-xl-12 py-20">
                <div class=" row col-xl-12 text-center justify-content-center">
                    @forelse($exams as $exam)
                        <div
                            class="col-xl-1 exams-slider rounded-circle mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">

                            <a href="{{ route('sessionBook', [$exam->examable->id, 'test']) }}" class="btn">آزمون شماره {{ $exam->number }}</a>
                        </div>
                    @empty
                        <p>آزمونی وجود ندارد</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end sectionTWO -->
<script src="{{asset('site/js/bootstrap.min.js')}}"></script>
</body>
</html>
