@extends('backEnd.layouts.master')
@section('master')
    <!-- Main Content-->
    <div class="main-content side-content pt-0 create-article-row">
        <div class="container-fluid">
            <div class="inner-body">
                <!--Row-->
                <div class="row row-sm mt-5 ">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card custom-card">
                            <div class="card-header border-bottom-0 pb-0">
                                <div class="d-flex justify-content-between">
                                    <label class="main-content-label mb-0 pt-1">ایجادسوال تستی</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('exam.index')}}" class="btn btn-info"> <i
                                                class="fa fa-arrow-right mx-2"></i>برگشت به لیست</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /سوال / طراحی سوالات چهارگزینه ای </p>
                                <form action="{{route('examBook.store')}}" method="post" class="my-5" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex row ">
                                        <div class="col-xl-6 col-md-6 offset-3">
                                            <div class="form-group">
                                                <label for="level">سوالات امتحانی مربوط به:</label>
                                                <select name="book_id" id="level" class="form-control">
                                                    @foreach($book as $item)
                                                        <option value="{{$item->id}}">{{implode(',',\App\Lesson::find($item->lesson_id)->grade()->pluck('title')->toArray())}}-{{$item->session}}-{{$item->part}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    <div class="d-flex row ">
                                        <div class="col-xl-6 col-md-6 offset-3">
                                            <div class="form-group">
                                                <label for="level">سطح آزمون</label>
                                                <select name="level" id="level" class="form-control">
                                                    <option value="1">آسان</option>
                                                    <option value="2">متوسط</option>
                                                    <option value="3">سخت</option>
                                                </select>
                                            </div>
                                            <div class="d-flex row ">
                                                <div class="col-xl-12 col-md-12 offset-3">
                                                    <div class="mt-3"><a class="btn btn-info mb-2 btn-q"> +ایجاد سوال</a>
                                                    </div>
                                                    <div class="form-group" >
                                                        <label for="question">صورت سوال</label>
                                                        <input type="text" name="question[]" class="form-control"
                                                               placeholder="صورت سوال مورد نظر خود را وارد کنید" style="width: 600px;">
                                                    </div>

                                                </div>

                                                <div class="form-group d-flex " style="width: 100%;">
                                                    <input style="width: 160px;
margin-left: 20px;" type="text" name="answerOne[]" class="form-control" placeholder="گزینه 1">
                                                    <input style="width: 160px;
margin-left: 20px;" type="text" name="answerTwo[]" class="form-control" placeholder="گزینه 2">
                                                    <input style="width: 160px;
margin-left: 20px;" type="text" name="answerThree[]" class="form-control" placeholder="گزینه 3">
                                                    <input style="width: 160px;
margin-left: 20px;" type="text" name="answerFour[]" class="form-control" placeholder="گزینه 4">
                                                    <input style="width: 160px;
margin-left: 20px;" type="text" name="True[]" class="form-control" placeholder="جواب صحیح">

                                                </div>
                                                <div class="form-group mr-2" >
                                                    <label for="image">انتخاب عکس</label>
                                                    <input type="file" name="image[]" class="form-control-file" style="width: 600px;">
                                                </div>
                                                <div id="add"></div>


                                           <div class="form-group w-25">
                                               <input type="submit" value="ثبت" class="btn btn-success float-right btn-block " style="border-radius: 10px;">
                                           </div>
                                            </div>

                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- COL END -->
                    </div>
                    <!-- row closed  -->
                </div>
            </div>
        </div>
        <!-- End Main Content-->
        @endsection
        @section('js')
            <script>
                $(document).ready(function () {
                    $('.btn-q').click(function () {
                        $('#add').append(`

                                                <div class="col-xl-12 col-md-12 offset-3">
                                                    <div class="form-group">
                                                        <label for="question">صورت سوال</label>
                                                        <input type="text" name="question[]" class="form-control" placeholder="صورت سوال مورد نظر خود را وارد کنید">
                                                    </div>

                                                </div>
                                                            <div class="form-group d-flex " style="width: 800%;">
                                                                <input style="width: 160px;
margin-left: 20px;" type="text" name="answerOne[]" class="form-control" placeholder="گزینه 1">
                                                                <input style="width: 160px;
margin-left: 20px;" type="text" name="answerTwo[]" class="form-control" placeholder="گزینه 2">
                                                                <input style="width: 160px;
margin-left: 20px;" type="text" name="answerThree[]" class="form-control" placeholder="گزینه 3">
                                                                <input style="width: 160px;
margin-left: 20px;" type="text" name="answerFour[]" class="form-control" placeholder="گزینه 4">
<input style="width: 300px;
margin-left: 20px;" type="text" name="True[]" class="form-control" placeholder="جواب صحیح">
</div>
<div class="form-group mr-2" >
                                                    <label for="image">انتخاب عکس</label>
                                                    <input type="file" name="image[]" class="form-control-file" style="width: 600px;">
                                                </div>


                        `)
                    });
                });
            </script>
@endsection
