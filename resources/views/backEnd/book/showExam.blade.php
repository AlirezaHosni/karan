@extends('backEnd.layouts.master')
@section('master')

    <!-- Main Content-->
    <div class="main-content side-content pt-0" >
        <div >
            <div class="inner-body">
                <!-- Row -->
                <div class=" square mt-5">
                    <div class="col-lg-12">
                        <div class="card custom-card ">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-sm-6 col-md-4 col-xl-3 p-1">
                                        <div class="card custom-card" >
                                            <div class="user-card text-center">
                                                <div class="  online text-center ">

                                                </div>

                                                    <div class="d-flex justify-content-between mt-3">
                                                        <p>پایه تحصیلی: </p>
                                                        <p>{{implode(',',\App\Lesson::find($books->lesson_id)->grade()->pluck('title')->toArray())}}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <p>نام کتاب: </p>
                                                        <p>{{implode(',',$books->lesson()->get()->pluck('title')->toArray())}}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <p> فصل: </p>
                                                        <p> {{$books->session}}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <p>بخش:</p>
                                                        <p> {{$books->part}} </p>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 ">
                                        <div class="profile-tab tab-menu-heading">
                                            <nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100 text-center" style="margin-right: 350px;">
                                                <a class="nav-link  active text-center" style="margin: 0 auto;color: goldenrod;font-size: 16px;" data-toggle="tab" href="#about">سوالات </a>

                                            </nav>
                                        </div>
                                        <div class="card custom-card main-content-body-profile">
                                            <div class="tab-content">
                                                <div class="main-content-body tab-pane p-4 border-top-0 active" id="about">
                                                    <div class="card-body p-0 border p-0 rounded-10">
                                                        <div class="col-12 ">

                                                            @foreach($exam as $key=>$item)
                                                               <p class="ml-3"> <span class="ml-2">{{++$key}}){{$item->question}}</span></p>
                                                                <div class="d-flex justify-content-start">
                                                                    <p class="ml-2">1.{{$item->answerOne}}</p>
                                                                    <p class="ml-2">2.{{$item->answerTwo}}</p>
                                                                    <p class="ml-2">3.{{$item->answerThree}}</p>
                                                                    <p class="ml-2">4.{{$item->answerFour}}</p>
                                                                    <p class="ml-2">صحیح:{{$item->True}}</p>
                                                                </div>
                                                            @endforeach

                                                        </div>

                                                    </div>
                                                </div>



                                                <div class="main-content-body tab-pane p-4 border-top-0" id="edit">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Row -->

                        </div>

                    </div>

                    <!-- End Main Content-->

@endsection
