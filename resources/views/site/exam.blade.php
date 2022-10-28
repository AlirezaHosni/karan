<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
    <title>آزمون</title>
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
                    @if(!isset($userExamAnswer))
                        <div class="col-xl-12">
                            <form action="{{ route('exam.index', $item) }}">
                                <div class="container-fluid">
                                    <p>لطفا نوع و سطح آزمون خود را انتخاب کنید</p>
                                </div>
                                <div class="col-xl-12 row">
                                    <div class="col-xl-5 col-md test-row1 p-3   d-flex mx-2 pt-3 @if(!isset($userExamAnswer)) h-50 @endif">
                                        <div class="form-check">
                                            <input required checked
                                                   class="form-check-input testi-input" type="radio" value="test"
                                                   name="type"
                                                   id="flexRadioDefault1">
                                        </div>
                                        <div class="mx-2">
                                            <p>تستی </p>

                                            <div class="d-flex">
                                                <div class="form-check radio1">
                                                    <input
                                                           @if(isset($level) && $level == 0)
                                                           checked
                                                           @endif
                                                           type="radio" class="form-check-input " id="radio1" name="level"
                                                           value="0"> ساده
                                                    <label class="form-check-label" for="radio1"></label>
                                                </div>
                                                <div class="form-check radio2">
                                                    <input
                                                        @if(isset($level) && $level == 1)
                                                        checked
                                                        @endif
                                                        type="radio" class="form-check-input" id="radio2" name="level"
                                                        value="1"> متوسط
                                                    <label class="form-check-label" for="radio2"></label>
                                                </div>
                                                <div class="form-check radio3">
                                                    <input
                                                        @if(isset($level) && $level == 2)
                                                        checked
                                                        @endif
                                                        type="radio" class="form-check-input" id="radio3" name="level"
                                                        value="2"> سخت
                                                    <label class="form-check-label" for="radio3"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md test-row1 p-3  d-flex mx-2 pt-3 @if(!isset($userExamAnswer)) h-50 @endif">
                                        <div class="form-check">
                                            <input required class="form-check-input tashrihi-input" value="descriptive" type="radio"
                                                   name="type"
                                                   id="flexRadioDefault2">
                                        </div>
                                        <div class="mx-2">
                                            <p> تشریحی</p>

                                            <div class="d-flex">
                                                <div class="form-check radio4">
                                                    <input type="radio" class="form-check-input " id="radio4" name="descriptiveLevel"
                                                           value="0"> ساده
                                                    <label class="form-check-label" for="radio4"></label>
                                                </div>
                                                <div class="form-check radio5">
                                                    <input type="radio" class="form-check-input" id="radio5" name="descriptiveLevel"
                                                           value="1"> متوسط
                                                    <label class="form-check-label" for="radio5"></label>
                                                </div>
                                                <div class="form-check radio6">
                                                    <input type="radio" class="form-check-input" id="radio6" name="descriptiveLevel"
                                                           value="2"> سخت
                                                    <label class="form-check-label" for="radio6"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        @if(!isset($userExamAnswer) and !isset($exams))
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-outline-success">
                                                مشاهده آزمون
                                            </button>
                                        </div>
                                        @elseif(!isset($userExamAnswer) and isset($exams))
                                            <div class="mt-5">
                                                @forelse($exams as $exam)
                                                    <div class="col-12 mb-2 justify-content-center">
                                                        <a href="{{ route('exam.create', $exam) }}" class="text-decoration-none">آزمون شماره {{ $loop->iteration }}</a>
                                                    </div>
                                                @empty
                                                    <div class="text-center">
                                                        آزمونی یافت نشد
                                                    </div>
                                                @endforelse
                                                <div class="container mt-5 mb-2">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-outline-success">
                                                            بارگذاری مجدد آزمون
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="container col-xl-12 p-3 bg-light slider-row h-100">
                            <div class="bg-white col-12 pt-1 px-1">
                                زمان باقی‌مانده : <span class="text-danger" id="timer"></span></div>
                            <div class="row mt-5 h-100">
                                    @if($userExamAnswer->exam->questionFormat == 0)
                                        <form action="{{ route('exam.submitExam', $userExamAnswer->id) }}" method="post" id="questionForm">
                                            @csrf
                                            <div class="scroller" style="height: 50rem">
                                                @foreach($userExamAnswer->exam->tests as $test)
                                                    <div class="d-flex p-2 @if(!$loop->first) mt-5 @endif col-12">
                                                        <div class="d-flex flex-row col-6">
                                                            <p class="mx-2">{{$loop->iteration}}</p>
                                                            <p>{{$test->question}}</p>
                                                        </div>
                                                        @if(!empty($test->image))
                                                            <div class="col-6">
                                                                <img src="{{ asset($test->image) }}" alt="تصویر سوال" style="width: 400px">
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
                                    @elseif($userExamAnswer->exam->questionFormat == 1)
                                        <form action="{{ route('exam.submitExam', $userExamAnswer->id) }}" method="post">
                                            @csrf
                                            <div class="scroller" style="height: 50rem">
                                                @foreach($userExamAnswer->exam->descriptiveTests as $descriptiveTest)
                                                    <div class="d-flex p-2 @if(!$loop->first) mt-5 @endif">
                                                        <p class="mx-2">{{ $loop->iteration }}</p>
                                                        <p>{{ $descriptiveTest->question }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between p-2">
                                                        <textarea class="form-text ckeditor col-12" rows="9" name="descriptiveTest[{{ $descriptiveTest->id }}]"></textarea>
                                                    </div>
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
                                    @endif
                            </div>
                        </div>
                    @endif
                </div>
                    <div class="col-xl-2  sidebar-left py-5 text-center">
                    <img src="{{asset('site/images/hand-arrow-down.png')}}" class="mb-3 icon-sidebar-left " height="50"
                         alt="">
                    <p class="text-light title-sidebar ">دسترسی آسان</p>
                    <nav class="nav flex-column sidebar-nav">
                        <a class="nav-link text-light sidebar-links active" href="#"> معرفی کتاب</a>
                        <a class="nav-link text-light sidebar-links" href="#"> درسنامه تشریحی</a>
                        <a class="nav-link text-light sidebar-links" href="#"> سوالات تشریحی </a>
                        <a class="nav-link text-light sidebar-links active-link-sidebar" href="#"> نکته و تست</a>
                        <a class="nav-link text-light sidebar-links" href="#"> ضمایم</a>
                        <a class="nav-link text-light sidebar-links" href="#"> آزمون انتخابی</a>
                        <a class="nav-link text-light sidebar-links" href="#"> کران بالا</a>
                        <a class="nav-link text-light sidebar-links" href="#"> نمونه سوالات امتحانی</a>
                        <a class="nav-link text-light sidebar-links" href="#"> تست های جامع</a>
                        <a class="nav-link text-light sidebar-links" href="#"> تمارین داخل کتاب</a>

                    </nav>
                </div>
            </div>
    </div>
</section>
<!-- end sectionTWO -->
<script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('site/js/app.js') }}"></script>
<script src="{{ asset('backEnd/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backEnd/ckeditor/build/ckeditor.js') }}"></script>
<script>
    @if(isset($userExamAnswer) and !empty($userExamAnswer->exam->suggestedTime))
    @php
        $suggestedTime = explode(':', $userExamAnswer->exam->suggestedTime);
        $endTime = \Carbon\Carbon::parse($userExamAnswer->created_at)->addHours($suggestedTime[0])->addMinutes($suggestedTime[1])->getTimestamp() * 1000;
    @endphp
{{--    @dd($suggestedTime, $endTime)--}}

    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = {{ $endTime }} - now;

        // Time calculations for days, hours, minutes and seconds
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("timer").innerHTML = seconds + " : " + minutes + " : " + hours;

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").parentElement.innerHTML = "زمان به پایان رسید";
            $('#questionForm').submit()
        }
    }, 1000);
    @endif
</script>
<script>
    $(document).ready(function (){
        var allEditors = document.querySelectorAll('.ckeditor');
        console.log(allEditors)
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(allEditors[i]);
        }
    })
</script>

</body>

</html>
