<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.rtl.min.css')}}">


    <link rel="stylesheet" href="{{asset('site/css/style.css')}}">
    <title>سوالات جامع</title>
</head>

<body>
<!-- sectionOne -->
<section class="section-one mt-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 container  ">
        <div class="container-fluid">
            <div class="row w-100">
                <div class="signin-users">
                    <a class="nav-link login-users navbar-links mx-1 text-black " aria-current="page" href="#"> <img
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
    <div class="container col-xl-12 p-3  section-two mt-2 ">

            <div class="d-flex flex-row">
                <div class="col-xl-10">
                        <div class="container col-xl-12 p-3 bg-light slider-row h-100">
                            <div class="row mt-5 h-100">
                                @if($generalTests->count() > 0)
                                        <form action="{{ route('generalTest.submitGeneralTests') }}" method="post">
                                            @csrf
                                            <div class="scroller" style="height: 50rem">
                                                @foreach($generalTests as $test)
                                                    <div class="d-flex p-2 @if(!$loop->first) mt-5 @endif col-12">
                                                        <div class="d-flex flex-row col-6">
                                                            <p class="mx-2">{{$loop->iteration}}</p>
                                                            <p>{{$test->question}}</p>
                                                        </div>
                                                        @if(!empty($test->audio) and file_exists($test->audio))
                                                            <div class="col-6 row">
{{--                                                                <a href="{{ asset($test->audio) }}" class="btn btn-info" download>دانلود صوت راهنما</a>--}}
                                                                <audio controls preload="auto">
                                                                    <source src="{{ asset($test->audio) }}" type="audio/{{ pathinfo( $test->audio, PATHINFO_EXTENSION) }}"/>
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex col-12 p-2">
                                                        <div class="form-check col-6">
                                                            <input class="form-check-input" type="radio" name="test[{{$test->id}}]"
                                                                   id="{{$test->id}}"
                                                                   value="1">
                                                            <label class="form-check-label" for="{{$test->id}}">
                                                                {{$test->answerOne}}
                                                            </label>
                                                        </div>
                                                        @if(!empty($test->imageOne))
                                                            <div class="col-6">
                                                                <img src="{{ asset($test->imageOne) }}" alt="تصویر سوال" style="width: 400px">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex col-12 p-2">
                                                        <div class="form-check col-6">
                                                            <input class="form-check-input" type="radio" name="test[{{$test->id}}]"
                                                                   id="{{$test->id}}"
                                                                   value="2">
                                                            <label class="form-check-label" for="{{$test->id}}">
                                                                {{$test->answerTwo}}
                                                            </label>
                                                        </div>
                                                        @if(!empty($test->imageTwo))
                                                            <div class="col-6">
                                                                <img src="{{ asset($test->imageTwo) }}" alt="تصویر سوال" style="width: 400px">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex col-12 p-2">
                                                        <div class="form-check col-6">
                                                            <input class="form-check-input" type="radio" name="test[{{$test->id}}]"
                                                                   id="{{$test->id}}"
                                                                   value="3">
                                                            <label class="form-check-label" for="{{$test->id}}">
                                                                {{$test->answerThree}}
                                                            </label>
                                                        </div>
                                                        @if(!empty($test->imageThree))
                                                            <div class="col-6">
                                                                <img src="{{ asset($test->imageThree) }}" alt="تصویر سوال" style="width: 400px">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex col-12 p-2">
                                                        <div class="form-check col-6">
                                                            <input class="form-check-input" type="radio" name="test[{{$test->id}}]"
                                                                   id="{{$test->id}}"
                                                                   value="4">
                                                            <label class="form-check-label" for="{{$test->id}}">
                                                                {{$test->answerFour}}
                                                            </label>
                                                        </div>
                                                        @if(!empty($test->imageFour))
                                                            <div class="col-6">
                                                                <img src="{{ asset($test->imageFour) }}" alt="تصویر سوال" style="width: 400px">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <hr>
                                                @endforeach
                                            </div>
                                            <div class="container mt-5 mb-2">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-outline-success">
                                                        ثبت آزمون
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                @else
                                    <div class="mt-5">
                                        <div class="text-center">
                                            سوالی یافت نشد
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                </div>
                    <div class="col-xl-2  sidebar-left py-5 text-center">
                    <img src="{{asset('site/images/hand-arrow-down.png')}}" class="mb-3 icon-sidebar-left " height="50"
                         alt="">
                    <p class="text-light title-sidebar ">دسترسی آسان</p>
                        <nav class="nav flex-column sidebar-nav">
                            <a class="nav-link text-light sidebar-links @if($operation == 'lesson') active-link-sidebar @endif" href="{{ getRoute('lesson', $item) }}"> معرفی کتاب</a>
                            <a class="nav-link text-light sidebar-links @if($operation == 'textBook') active-link-sidebar @endif" href="{{ getRoute('textBook', $item) }}"> درسنامه تشریحی</a>
                            <a class="nav-link text-light sidebar-links @if($operation == 'descriptive') active-link-sidebar @endif" href="{{ getRoute('descriptive', $item) }}"> سوالات تشریحی </a>
                            <a class="nav-link text-light sidebar-links @if($operation == 'examBook') active-link-sidebar @endif" href="{{ getRoute('examBook', $item) }}"> نکته و تست</a>
                            <a class="nav-link text-light sidebar-links @if($operation == 'appendices') active-link-sidebar @endif" href="{{ getRoute('appendices', $item) }}"> ضمایم</a>
                            <a class="nav-link text-light sidebar-links " href="{{ getRoute('exam', $item) }}"> آزمون انتخابی</a>
                            <a class="nav-link text-light sidebar-links @if($operation == 'karanBala') active-link-sidebar @endif" href="{{ getRoute('karanBala', $item) }}"> کران بالا</a>
                            <a class="nav-link text-light sidebar-links @if($operation == 'examQuestionSample') active-link-sidebar @endif" href="{{ getRoute('examQuestionSample', $item) }}"> نمونه سوالات امتحانی</a>
                            <a class="nav-link text-light sidebar-links @if($operation == 'generalTest') active-link-sidebar @endif" href="{{ getRoute('generalTest', $item) }}"> تست های جامع</a>
                            <a class="nav-link text-light sidebar-links @if($operation == 'bookExercises') active-link-sidebar @endif" href="{{ getRoute('bookExercises', $item) }}"> تمارین داخل کتاب</a>
                        </nav>
                </div>
            </div>
    </div>
</section>
<!-- end sectionTWO -->
<script src="{{asset('site/js/bootstrap.min.js')}}"></script>
<script src="{{asset('site/js/app.js')}}"></script>
</body>
</html>
