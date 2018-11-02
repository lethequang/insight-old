@extends('layouts.master')

@section('header_css')
    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">

    <!--Font Awesome [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

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
            <h1 class="page-header text-overflow">Quản lý thành viên</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li class="active">Cấp độ truy cập</li>
            <li class="active">{{$role->name}}</li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>
@endsection
@section('content')


    <div class="panel panel-bordered panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Chi tiết phân quyền: </h3>
        </div>
        <div class="panel-body">
            <!--Stacked Tabs Left-->
            <!--===================================================-->
            {!! Form::open(['route' => ['authorized.post-edit-permission', $id], 'method' => 'post', 'class' => 'form-horizontal', 'style' => 'width: 100%']) !!}
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
                <!--Tabs Content-->
                <div class="tab-content">
                    <div id="tab-users" class="tab-pane fade active in">
                        <div class="panel-body">
                            @foreach($permission_user as $item)
                                <div class="checkbox">
                                    <input id="checkbox{{ $item->id }}" value="{{ $item->id }}"
                                           <?= in_array($item->id, $permission_id) ? 'checked' : ''; ?> name="permission_id[]"
                                           class="magic-checkbox"
                                           type="checkbox">
                                    <label for="checkbox{{ $item->id }}">{{ $item->display_name }}</label>
                                </div>
                            @endforeach
                            <small class="text-danger">{{ $errors->first('permission') }}</small>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-7 col-sm-offset-5">
                                    <a class="btn btn-primary" href="{{ route('authorized.get-show-role') }}"> <i
                                                class="glyphicon glyphicon-share
                    "></i> Quay lại</a>
                                    <button class="btn btn-mint" type="submit">Lưu</button>
                                    <button class="btn btn-warning" type="reset">Chọn lại</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab-authorized" class="tab-pane fade">
                        <div class="panel-body">
                            @foreach($permission_authorized as $item)
                                <div class="checkbox">
                                    <input id="checkbox{{ $item->id }}" value="{{ $item->id }}"
                                           <?= in_array($item->id, $permission_id) ? 'checked' : ''; ?> name="permission_id[]"
                                           class="magic-checkbox"
                                           type="checkbox">
                                    <label for="checkbox{{ $item->id }}">{{ $item->display_name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-7 col-sm-offset-5">
                                    <a class="btn btn-primary" href="{{ route('authorized.get-show-role') }}"> <i
                                                class="glyphicon glyphicon-share
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
                                    <input id="checkbox{{ $item->id }}" value="{{ $item->id }}"
                                           <?= in_array($item->id, $permission_id) ? 'checked' : ''; ?> name="permission_id[]"
                                           class="magic-checkbox"
                                           type="checkbox">
                                    <label for="checkbox{{ $item->id }}">{{ $item->display_name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-7 col-sm-offset-5">
                                    <a class="btn btn-primary" href="{{ route('authorized.get-show-role') }}"> <i
                                                class="glyphicon glyphicon-share
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
                                    <input id="checkbox{{ $item->id }}" value="{{ $item->id }}"
                                           <?= in_array($item->id, $permission_id) ? 'checked' : ''; ?> name="permission_id[]"
                                           class="magic-checkbox"
                                           type="checkbox">
                                    <label for="checkbox{{ $item->id }}">{{ $item->display_name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-7 col-sm-offset-5">
                                    <a class="btn btn-primary" href="{{ route('authorized.get-show-role') }}"> <i
                                                class="glyphicon glyphicon-share
                    "></i> Quay lại</a>
                                    <button class="btn btn-mint" type="submit">Lưu</button>
                                    <button class="btn btn-warning" type="reset">Chọn lại</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small class="text-danger">{{ $errors->first('ids') }}</small>
                </div>
            </div>
        {!! Form::close() !!}

        <!--===================================================-->
            <!--End Stacked Tabs Left-->
        </div>
    </div>
    </div>
@endsection

@section('footer_js')

    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
@endsection
