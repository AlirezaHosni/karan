@extends('.backEnd.layouts.master')
@section('master')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
    <div class="row"></div>
    <div class="row row-sm mt-5">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card custom-card">
                <div class="card-header border-bottom-0 pb-0">
                    <div class="d-flex justify-content-between">
                        <label class="main-content-label mb-0 pt-1">مدیریت نقش ها</label>
                        <div class="mr-auto float-right">
                            <a href="{{route('role.create')}}" class="btn btn-info"> <i class="fa fa-plus mx-2"></i>  ایجاد نقش</a>
                        </div>
                    </div>
                    <p class="tx-12 tx-gray-500 mt-0 mb-2">مدیریت / مدیریت نقش ها</p>
                    <!-- create Session  -->
                    @if(session('delete'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <strong>{{session('delete')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                @endif
                    @if(session('update'))
                        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                            <strong>{{session('update')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                @endif
                <!-- End create Session  -->

                </div>
                <div class="card-body">
                    <div class="table-responsive border userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                            <thead>
                            <tr>
                                <th class="wd-lg-8p"><span> ردیف</span></th>
                                <th class="wd-lg-8p"><span> نقش </span></th>
                                <th class="wd-lg-20p text-center">عمل</th>
                            </tr>
                            </thead>
                            <tbody>
                             @foreach($roles as $key=>$role)
                                 <tr>
                                     <td>{{++$key}}</td>
                                     <td>{{$role->name}}</td>
                                     <td class="text-center d-flex justify-content-center">
                                         <a href="{{route('role.edit',$role->id)}}" class="btn btn-sm btn-info ml-2">
                                             <i class="fe fe-edit-2"></i>
                                         </a>
                                         <form action="{{route('role.destroy',$role->id)}}" method="post">
                                             @csrf
                                             @method('delete')
                                             <button class="btn btn-danger btn-sm"> <i class="fe fe-trash"></i></button>
                                         </form>

                                     </td>
                                 </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <ul class="pagination mt-4 mb-0 float-left">
                        <li class="page-item page-prev disabled">
                            <a class="page-link" href="#" tabindex="-1">قبلی</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item page-next">
                            <a class="page-link" href="#">بعد</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>
    </div>
        </div>
    </div>
    <!-- row closed  -->
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.alert').fadeOut(250);

        });
    </script>
@endsection
