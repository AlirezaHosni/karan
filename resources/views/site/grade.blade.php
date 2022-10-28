<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.rtl.min.css')}}">


    <link rel="stylesheet" href="{{asset('site/css/style.css')}}">
    <title>پایه های تحصیلی</title>
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
<section>
    <div class="container col-xl-12 p-5   mt-2 ">

        <div class="row">
            <div class="col-xl-4 side-right-page-3 bg-light">
                <div class="scroller scroller-page-3 mt-5 text-center">

                    @foreach($grades as $grade)
                        <a class="btn list-books-item-1 px-5 my-2 py-3" href="{{is_null($grade->gradeDescription) ? route('lessons',$grade->id) : route('grade.karanbala',$grade->id)}}">
                            <img src="{{asset('site/images/book icon.png')}}" class="mx-2" height="30px" alt="">
                            {{$grade->title}}
                        </a>

                    @endforeach
                </div>

            </div>
            <div class="col-xl-7 side-left-page-3 mt-5 mb-5">
                <img src="{{asset('site/images/sectionTwo/index pic.png')}}" class="img-fluid" alt="">
            </div>

        </div>
    </div>


</section>
<!-- end sectionTWO -->
<script src="{{asset('site/js/bootstrap.min.js')}}"></script>


</body>

</html>
