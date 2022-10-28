@extends('.backEnd.layouts.master')
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
                                    <label class="main-content-label mb-0 pt-1">ایجاد وظایف</label>
                                    <div class="mr-auto float-right">
                                        <a href="{{route('permission.index')}}" class="btn btn-info"> <i class="fa fa-arrow-right mx-2"></i>برگشت به لیست</a>
                                    </div>
                                </div>
                                <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت / وضایف / ایجاد وظیفه </p>
                                <!-- create Session  -->
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                        <strong>{{session('success')}}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                            @endif
                            <!-- End create Session  -->
                                <form action="{{route('permission.store')}}" method="post" class="my-5">
                                    @csrf
                                    <div class="d-flex row ">
                                        <div class="col-xl-6 col-md-6 offset-3">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control " placeholder="وظیفه" />
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" value="web" name="guard_name"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width: 400px">
                                        <label for="roles">انتخاب نقش:</label>
                                        <select class="js-example-basic-multiple" style="width: 122%;" name="roles[]" multiple="multiple">
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <button type="submit" class="btn btn-info mt-5">
                                        ایجاد وظیفه
                                    </button>

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
                $(document).ready(function (){
                    $('.alert').fadeOut(250);
                    $('.js-example-basic-multiple').select2();
                });
            </script>
@endsection
