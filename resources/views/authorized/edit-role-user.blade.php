@extends('layouts.master')

@section('header_css')
    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">

    <!--Font Awesome [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css') }}" rel="stylesheet">

    <style>
        .bootstrap-select {
            margin-bottom: 0px;
            margin-right: 5px;
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
            <li class="active">Danh sách thành viên</li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>
@endsection
@section('content')
    <a class="btn btn-primary" href="{{ route('authorized.get-show-role-user') }}"> <i class="glyphicon glyphicon-share
                    "></i> Quay lại</a>

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Cấp quyền nhóm: {{$users->username}} </h3>
        </div>

        <div class="panel-body">
            <!-- Default Bootstrap Select -->
            <!--===================================================-->

            {!! Form::open(['url' => url('authorized/edit-role-user/') . '/' . $id, 'method' => 'post']) !!}

            <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">

                <div class="col-sm-10">
                    <select class="selectpicker" name="role_id" id="role_id">
                        <option value="0" disabled {{ empty($userRoles) ? "selected" : null }}>
                            - ========Chọn nhóm=======
                        </option>
                        @foreach ($roles as $role)

                            <option value="{{ $role->id }}" {{in_array($role->id, $userRoles) ? "selected" : null}} >
                                - {{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success">Lưu</button>
                    <small class="text-danger">{{ $errors->first('role_id') }}</small>
                </div>
            </div>

        {{--<button type="submit" class="btn btn-success">Lưu</button>--}}

        {!! Form::close() !!}
        <!--===================================================-->
        </div>
    </div>

@endsection

@section('footer_js')

    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
@endsection
