<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.rtl.min.css')}}">


    <link rel="stylesheet" href="{{asset('site/css/style.css')}}">
    <title>انتخاب کتاب</title>
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
    <div class="container section-two mt-3 mb-5">

        <div class="row ">
            <div class="col-xl-12">
                <div id="carouselExampleInterval2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($lessons as $lesson)

                            <div class="carousel-item @if($loop->first) active  @endif" data-bs-interval="10000">
                                <div class="row mb-5">
                                    <div class="col-xl-7 col-md-6  p-5">
                                        <h3>
                                            {{$lesson->title}}
                                        </h3>
                                        <p class="mt-4">

                                            {{$lesson->description}}
                                        </p>
                                    </div>
                                    @if($lesson->image != null)
                                        <div class="col-xl-5 col-md-6  p-5">
                                            <img src="{{asset('upload/lesson/'.$lesson->image)}}" class="img-fluid"
                                                 alt="">
                                        </div>

                                    @endif
                                    <div class=" row col-xl-12 text-center justify-content-center">

                                        <div
                                            class="col-xl-1 books-slider rounded-circle mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">
                                            <a href="{{ route('lesson.chooseLessonItem',[$lesson->id]) }}" class="btn ">معرفی کتاب</a>
                                        </div>
                                        <div
                                            class="col-xl-1 books-slider rounded-circle mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">

                                            <a href="{{route('sessionBook', [$lesson->id, 'textBook'])}}" class="btn ">درسنامه تشریحی </a>

                                        </div>
                                        <div
                                            class="col-xl-1 books-slider rounded-circle mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">
                                            <a href="{{route('sessionBook', [$lesson->id, 'descriptive'])}}" class="btn ">سوالات تشریحی</a>

                                        </div>
                                        <div
                                            class="col-xl-1 books-slider rounded-circle mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">
                                            <a href="{{route('sessionBook', [$lesson->id, 'examBook'])}}" class="btn "> نکته و تست</a>

                                        </div>
                                        <div
                                            class="col-xl-1 books-slider rounded-circle mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">
                                            <a href="{{route('sessionBook', [$lesson->id, 'appendices'])}}" class="btn "> ضمایم </a>

                                        </div>


                                    </div>
                                    <div class=" row col-xl-12 text-center justify-content-center">
                                        <div
                                            class="col-xl-1 books-slider rounded-circle  mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">
                                            <a href="{{ route('lesson.chooseSelectionExamItem', $lesson->id) }}" class="btn"> آزمون انتخابی</a>

                                        </div>
                                        <div
                                            class="col-xl-1 books-slider rounded-circle  mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">
                                            <a href="{{route('sessionBook', [$lesson->id, 'karanBala'])}}}" class="btn  ">کران بالا </a>

                                        </div>
                                        <div
                                            class="col-xl-1 books-slider rounded-circle  mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">
                                            <a href="{{ route('lesson.chooseBookExerciseSession', $lesson->id) }}" class="btn  "> نمونه سوالات امتحانی</a>

                                        </div>
                                        <div
                                            class="col-xl-1 books-slider rounded-circle  mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">
                                            <a href="{{route('sessionBook', [$lesson->id, 'generalTest'])}}" class="btn  "> تست های جامع</a>

                                        </div>
                                        <div
                                            class="col-xl-1 books-slider rounded-circle  mx-4 my-2 col-md-1 col-3 slider-items d-flex justify-content-center">
                                            <a href="{{route('sessionBook', [$lesson->id, 'bookExercises'])}}" class="btn  "> تمارین داخل کتاب</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach


                    </div>
                    <div class="next-prev-box">
                        <button class="carousel-control-prev next-btn" type="button"
                                data-bs-target="#carouselExampleInterval2"
                                data-bs-slide="next">
                            <img src="{{ asset('site/images/sectionTwo/next.png') }}" class="img-fluid" alt="">
                        </button>
                        <button class="carousel-control-prev prev-btn" type="button"
                                data-bs-target="#carouselExampleInterval2"
                                data-bs-slide="prev">
                            <img src="{{ asset('site/images/sectionTwo/prev.png') }}" class="img-fluid" alt="">
                        </button>
                    </div>

                    <!-- <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval2"
                      data-bs-slide="next">
                      <img src="./images/left.png" alt="">
                    </button> -->

                </div>
            </div>


        </div>


    </div>
    </div>
</section>
<!-- end sectionTWO -->
<script src="{{asset('site/js/bootstrap.min.js')}}"></script>


</body>

</html>
