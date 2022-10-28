<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/style.css')}}">
    <title>انتخاب فصل</title>
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
                    <div
                        class="col-xl-1 books-slider rounded-circle mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">

                        <a href="{{ route('overview.examQuestionSample', ['item' => $lesson_id, 'period' => 1]) }}" class="btn">ترم اول</a>
                    </div>
                    <div
                        class="col-xl-1 books-slider rounded-circle mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">

                        <a href="{{ route('overview.examQuestionSample', ['item' => $lesson_id, 'period' => 2]) }}" class="btn">ترم دوم</a>
                    </div>
                    <div
                        class="col-xl-1 books-slider rounded-circle mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">

                        <a href="{{ route('overview.examQuestionSample', ['item' => $lesson_id, 'period' => 3]) }}" class="btn">کل کتاب</a>
                    </div>
                    @forelse($books as $book)
                        <div
                            class="col-xl-1 books-slider rounded-circle mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">

                            <a href="{{ route('overview.examQuestionSample', ['item' => $book->id]) }}" class="btn">{{ $book->session }}</a>
                        </div>
                    @empty
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
