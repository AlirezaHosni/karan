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
                                    <label class="main-content-label mb-0 pt-1">ایجاد ویدئو</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('video.index', $type)}}" class="btn btn-info"> <i
                                                class="fa fa-arrow-right mx-2"></i>برگشت به لیست</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /ویدئو / ایجاد ویدئو </p>
                                <form action="{{route('video.store', $type)}}" method="post" id="fileUploadForm" class="my-5" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-12 offset-3">
                                            <div class="form-group">
                                                <label for="">عنوان:</label>
                                                <input type="text" name="title" class="form-control " />
                                            </div>
                                            <div class="form-group">
                                                <label for="resource_id">منبع:</label>
                                                <select name="resource_id"  class="form-control">
                                                    @foreach($resources as $resource)
                                                        <option value="{{$resource->id}}">{{$resource->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row justify-content-center  mb-5">
                                                <div class="col-10 mt-5">
                                                    <p>انتخاب ویدئو</p>
                                                </div>
                                                <div class="drop-zone col-10">
                                                    <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                    <input type="file" name="video" id="fuUpload" class="drop-zone__input">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="progress">
                                                    <div id="dvProgress" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"  style="width: 0%"></div>
                                                </div>
                                            </div>
                                            <div class="form-group w-25 mr-200">
                                                <input type="submit" id="btnUpload" value="ثبت" class="btn btn-success float-right btn-block " style="border-radius: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

                $(function () {

                    $(document).ready(function () {

                        $('#fileUploadForm').ajaxForm({

                            beforeSend: function () {

                                var percentage = '0';

                            },

                            uploadProgress: function (event, position, total, percentComplete) {

                                var percentage = percentComplete;

                                $('.progress .progress-bar').css("width", percentage+'%', function() {

                                    return $(this).attr("aria-valuenow", percentage) + "%";

                                })

                            },

                            complete: function (xhr) {

                                console.log('File has uploaded');

                            }

                        });

                    });

                });
            </script>
@endsection
