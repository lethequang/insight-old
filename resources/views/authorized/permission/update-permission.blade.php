@extends('layouts.master') @section('header_css')
    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">

    <!--Font Awesome [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/fancybox/jquery.fancybox-1.3.4.css') }}" rel="stylesheet">
    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css') }}" rel="stylesheet">



@endsection
@section('page-head')
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Quản lý nhóm</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('user.get-show-all') }}">
                    <i class="demo-pli-home"></i>
                </a>
            </li>
            <li class="active">Thêm quyền</li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>
@endsection @section('content')
    <div class="panel panel-bordered panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                Thêm quyền
            </h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => ['authorized.postUpdatePermission', $permission->id], 'method' => 'post', 'class' => 'panel-body form-horizontal form-padding']) !!}
            {{--Begin Input Staff Name--}}

            <div class="col-lg-6">
                <div class="panel">


                    <!--No Label Form-->
                    <!--===================================================-->
                    <form class="form-horizontal">
                        <div class="panel-body">
                            <div class="row">
                                <label for="name" class="col-sm-2 control-label">
                                    <dt>Tên quyền</dt>
                                </label>

                                <div class="col-md-4 mar-btm">
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                           value="{{$permission->name}}">
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                </div>

                                <label for="display_name" class="col-sm-2 control-label">
                                    <dt>Tên hiển thị</dt>
                                </label>

                                <div class="col-md-4 mar-btm">
                                    <input type="text" class="form-control" placeholder="display_name"
                                           name="display_name" value="{{$permission->display_name}}">
                                </div>


                                {{--Begin Input Staff Last Name--}}
                                <div class="form-group">

                                    <label for="description" class="col-sm-2 control-label">
                                        <dt>Chi tiết</dt>
                                    </label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" name="description" id="description">
                                            <option value="0" disabled selected>
                                                - ========Chọn nhóm=======
                                            </option>
                                            <option value="1">- Thành viên</option>
                                            <option value="2">- Dịch vụ Fdrive</option>
                                            <option value="3">- Khách hàng</option>
                                            <option value="4">- Phân quyền</option>
                                        </select>
                                        <small class="help-block">{{ $errors->first('role_id') }}</small>
                                    </div>

                                    {{--End Input Staff Last Name--}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-7 col-sm-offset-5">
                                <a class="btn btn-primary" href="{{ route('authorized.get-show-permission') }}"> <i
                                            class="glyphicon glyphicon-share
                    "></i> Quay lại</a>
                                <button class="btn btn-mint" type="submit">Lưu</button>
                                <button class="btn btn-warning" type="reset">Chọn lại</button>
                            </div>
                        </div>

                    </form>
                    <!--===================================================-->
                    <!--End No Label Form-->

                </div>
            </div>

            {!! Form::close() !!}

        </div>

    </div>
    </div>


@endsection
@section('footer_js')
    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <script src="{{ asset('assets/fancybox/jquery.fancybox-1.3.4.pack.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.iframe-btn').fancybox({
                'width': 900,
                'height': 600,
                'type': 'iframe',
                'autoScale': false
            });
        });

        function responsive_filemanager_callback(field_id) {
            var url = jQuery('#' + field_id).val();
            $("#im_avatar").attr('src', url);
        }
    </script>
@endsection