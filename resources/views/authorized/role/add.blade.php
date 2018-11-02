@extends('layouts.master') @section('header_css')
    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">

    <!--Font Awesome [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/fancybox/jquery.fancybox-1.3.4.css') }}" rel="stylesheet">
    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css') }}" rel="stylesheet">

    <style>
        .tab-stacked-left .nav-tabs {
            width: 15%;
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
            color: #0391d1;
        }

        .tab-content .panel-footer {
            background-color: #fdfdfe;
            color: #7a878e;
            border-color: rgba(0, 0, 0, 0.02);
        }
    </style>

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
            <li class="active">Thêm nhóm</li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>
@endsection @section('content')
    <div class="panel panel-bordered panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                Thêm nhóm
            </h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['url' => 'authorized/role/add', 'method' => 'post', 'class' => 'panel-body form-horizontal form-padding']) !!}
            {{--Begin Input Staff Name--}}



         <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="username" class="col-sm-2 control-label">
                <dt>Tên nhóm</dt>
            </label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name">
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
         </div>


         <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
            <label for="display_name " class="col-sm-2 control-label">
                <dt>Tên hiển thị</dt>
            </label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="display_name" value="{{ old('display_name') }}"
                       id="display_name ">
                <small class="text-danger">{{ $errors->first('display_name') }}</small>
            </div>
            </div>

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="description" class="col-sm-2 control-label">
                <dt>Chi tiết</dt>
            </label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="description" value="{{ old('description') }}"
                       id="description ">
                <small class="text-danger">{{ $errors->first('description') }}</small>
            </div>
            </div>

            <div class="tab-base tab-stacked-left">

                <!--Nav tabs-->
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-users">
                            <dt> Thành viên</dt>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#tab-authorized">
                            <dt> Phân quyền</dt>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#tab-customer">
                            <dt> Khách hàng</dt>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#tab-service">
                            <dt> Dịch vụ Fdrive</dt>
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="tab-users" class="tab-pane fade active in">
                        <div class="panel-body">
                            @foreach($permission_user as $item)
                                <div class="checkbox">
                                    <input id="checkbox{{ $item->id }}" value="{{ $item->id }}" name="permission[]"
                                           class="magic-checkbox"
                                           type="checkbox">
                                    <label for="checkbox{{ $item->id }}">{{ $item->display_name }}</label>
                                </div>
                            @endforeach
                            <small class="text-danger">{{ $errors->first('permission') }}</small>

                        </div>

                        <div class="row">
                            <div class="col-sm-7 col-sm-offset-5">
                                <a class="btn btn-primary" href="{{ route('authorized.get-show-role-user') }}"> <i class="glyphicon glyphicon-share
                    "></i> Quay lại</a>
                                <button class="btn btn-mint" type="submit">Lưu</button>
                                <button class="btn btn-warning" type="reset">Chọn lại</button>
                            </div>
                        </div>


                    </div>

                    <div id="tab-authorized" class="tab-pane fade">
                        <div class="panel-body">
                            @foreach($permission_authorized as $item)
                                <div class="checkbox">
                                    <input id="checkbox{{ $item->id }}" value="{{ $item->id }}"
                                           name="ids1[]"
                                           class="magic-checkbox"
                                           type="checkbox">
                                    <label for="checkbox{{ $item->id }}">{{ $item->display_name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-7 col-sm-offset-5">
                                    <a class="btn btn-primary" href="{{ route('authorized.get-show-role-user') }}"> <i class="glyphicon glyphicon-share
                    "></i> Quay lại</a>
                                    <button class="btn btn-mint" type="submit">Lưu</button>
                                    <button class="btn btn-warning" type="reset">Chọn lại</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab-customer" class="tab-pane fade">
                        <div class="panel-body">
                            @foreach($permission_customer as $item)
                                <div class="checkbox">
                                    <input id="checkbox{{ $item->id }}" value="{{ $item->id }}" name="ids1[]"
                                           class="magic-checkbox"
                                           type="checkbox">
                                    <label for="checkbox{{ $item->id }}">{{ $item->display_name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-7 col-sm-offset-5">
                                    <a class="btn btn-primary" href="{{ route('authorized.get-show-role-user') }}"> <i class="glyphicon glyphicon-share
                    "></i> Quay lại</a>
                                    <button class="btn btn-mint" type="submit">Lưu</button>
                                    <button class="btn btn-warning" type="reset">Chọn lại</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab-service" class="tab-pane fade">
                        <div class="panel-body">
                            @foreach($permission_service as $item)
                                <div class="checkbox">
                                    <input id="checkbox{{ $item->id }}" value="{{ $item->id }}" name="permission[]"
                                           class="magic-checkbox"
                                           type="checkbox">
                                    <label for="checkbox{{ $item->id }}">{{ $item->display_name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-7 col-sm-offset-5">
                                    <a class="btn btn-primary" href="{{ route('authorized.get-show-role-user') }}"> <i class="glyphicon glyphicon-share
                    "></i> Quay lại</a>
                                    <button class="btn btn-mint" type="submit">Lưu</button>
                                    <button class="btn btn-warning" type="reset">Chọn lại</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {!! Form::close() !!}

        </div>

    </div>
@endsection @section('footer_js')
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