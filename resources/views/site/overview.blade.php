<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/style.css')}}">
    <title>دانلودها</title>
</head>

<body>
<!-- sectionOne -->
<section class="section-one mt-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 container  ">
        <div class="container-fluid">
            <div class="row w-100">
                <div class="signin-users">
                    <a class="nav-link login-users navbar-links mx-1 text-black " aria-current="page"
                       href="{{route('login')}}"> <img src="{{asset('site/images/users.png')}}"
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
    <div class="container col-xl-12 p-3  section-two-page-4 mt-2  " style="background-color:#f5f6fb;">

        <div class="row  ">
            <div class="col-xl-10 m-1 row-two-page4">

                <div class="video justify-content-center d-flex mt-3">


                    <video id='video' controls="controls" preload='none' class="col-xl-6 col-md-6 col-8 rounded-3">
                           ">
                        <source id='mp4' src="@if(count($videos) > 0) {{ asset($videos->first()->video) }} @endif" type='video/mp4'
                                class="col-xl-6 col-md-6 col-8 rounded-3"/>

                        <!--
                    Track to be used for accessibility using the VTT standard.

                    See https://www.html5rocks.com/en/tutorials/track/basics/ for more information on how to use text tracks
                        -->
                        <track kind="subtitles" label="English subtitles" src="subtitles_en.vtt" srclang="en" default>
                        </track>
                        <!--
                    We can also add more than one text track and let the user choose which one to play. There is now way to
                    currently do this with the built in controls so it'll have to be scripted -->
                        <track kind="subtitles" label="Deutsche Untertitel" src="subtitles_de.vtt" srclang="de">
                        </track>

                        <!--
                    We're not using Flash as a fallback option. It should be coverage enough to
                    -->
                        <p>Your user agent does not support the HTML5 Video element.</p>
                    </video>

                </div>

                @foreach($videos as $video)
                <div class="row justify-content-center  align-items-center my-3">
                    <div class="video-details col-xl-6 col-md-6 col-8 d-flex  justify-content-between ">
                        <div class="d-flex align-items-center rounded-circle align-items-center ">
                            <a href="" class="number-video  nav-link  text-dark mx-2 mb-2">1</a>
                            <p>{{ $video->title }}</p>
                        </div>
{{--                        <div class="align-items-center d-flex">--}}
{{--                            <p class="text-center">زمان {{ $video->title }}</p>--}}

{{--                        </div>--}}
                        <div class="d-flex align-items-center">
                            <button id="playButton" type="button" class="nav-link btn bg-transparent" onclick="playVideo({{ $video->video }})"> مشاهده <img src="{{asset('site/images/icons8-play-64.png')}}"
                                                                     height="25px" alt=""> </button>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="row justify-content-center">
                    <div
                        class="my-4 col-xl-6 col-md-6 col-10  justify-content-between bottom-row-page4 align-items-center d-flex">
                        <h5>جزوه پی دی اف</h5>
                    </div>
                </div>
                @foreach($documents as $document)
                    <div class="row justify-content-center">
                        <div
                            class="my-2 col-xl-6 col-md-6 col-10  justify-content-between bottom-row-page4 align-items-center d-flex">
                            <h5>{{ $document->title }}</h5>
                            <a class="btn list-books-item-1 px-5 my-2 py-3" href="{{ route('downloadDocument', $document->id) }}">
                                دانلود
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-xl  sidebar-left py-5 text-center">
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
<script src="{{asset('backEnd/plugins/jquery/jquery.min.js')}}"></script>
<script>
    function playVideo(source){
        $('#mp4 video source').attr('src', source);
        $("#mp4 video").load();
    }
</script>


</body>

</html>
