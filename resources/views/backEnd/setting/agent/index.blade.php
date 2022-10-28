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
                                    <label class="main-content-label mb-0 pt-1">ویرایش معرف رشته</label>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت /تنظیمات / ویرایش معرف رشته </p>
                                @include('alert.alert')
                                <form action="{{ route('setting.agent.store') }}" method="post" class="my-5" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row col-12">
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label for="editor1" class="form-label">توضیحات معرف رشته:</label>
                                                <textarea name="agent_text" id="editor1" rows="9" style="resize: none;">{{ old('agent_text', $setting->agent_text) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="agent_image" class="form-label">تصویر معرف رشته:</label>
                                            <div class="drop-zone col-12">
                                                <span class="drop-zone__prompt">@if(empty($setting->agent_image))بارگذاری تصویر مربوط به شخص معرف رشته
                                                    @else<img src="{{ asset($setting->agent_image) }}"  width="150px" height="150px">@endif</span>
                                                <input type="file" name="agent_image" id="drag1" class="drop-zone__input">

                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group mr-200 col-2">
                                            <input type="submit" value="ثبت" class="btn btn-primary float-right btn-block " style="border-radius: 10px;">
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- row closed  -->
                </div>
            </div>
        </div>
        <!-- End Main Content-->
        @endsection
        @section('js')
            <script>
                ClassicEditor
                    .create( document.querySelector( '#editor1' ), {
                        ckfinder : {
                            uploadUrl: "{{ route('ckeditor.upload', ["_token" => csrf_token()]) }}"
                        }
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>
@endsection
