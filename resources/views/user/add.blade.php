@extends('layouts.master') @section('header_css')
  <!--Bootstrap Select [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">

  <!--Font Awesome [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

  <link href="{{ asset('assets/fancybox/jquery.fancybox-1.3.4.css') }}"
        rel="stylesheet"> @endsection @section('page-head')
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
      <li>
        <a href="/">
          <i class="demo-pli-home"></i>
        </a>
      </li>
      <li class="active">Thêm thành viên</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->

  </div>
@endsection @section('content')
  <div class="panel panel-bordered panel-dark">
    <div class="panel-heading">
      <h3 class="panel-title">
        Thêm thành viên
      </h3>
    </div>
    {!! Form::open(['url' => 'users/add', 'method' => 'post', 'class' => 'panel-body form-horizontal form-padding']) !!}
    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
      <label for="username" class="col-sm-2 control-label">
        <dt>Tên tài khoản</dt>
      </label>

      <div class="col-sm-10">
        <input type="text" class="form-control" name="username"  id="username" value="{{ old('username') }}">
        <small class="text-danger">{{ $errors->first('username') }}</small>
      </div>
    </div>



    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
      <label for="password" class="col-sm-2 control-label">
        <dt>Mật khẩu</dt>
      </label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="password" value="" id="password">
        <small class="text-danger">{{ $errors->first('password') }}</small>

      </div>
    </div>
    {{--End Input Staff Password--}} {{--Begin Input Staff Confirm Password--}}


    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
      <label for="password_confirmation" class="col-sm-2 control-label">
        <dt>Lặp lại mật khẩu</dt>
      </label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="password_confirmation" value="" id="password_confirmation">
        <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
      </div>
    </div>
    {{--End Input Staff Confirm Password--}} {{--Begin Input Staff First Name--}}


    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <label for="email" class="col-sm-2 control-label">
        <dt>Hòm thư</dt>
      </label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="email">
        <small class="text-danger">{{ $errors->first('email') }}</small>
      </div>
    </div>


    {{--End Input Staff First Name--}} {{--Begin Input Staff First Name--}}
    <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
      <label for="firstname" class="col-sm-2 control-label">
        <dt>Tên</dt>
      </label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="firstname" id="firstname" value="{{ old('firstname') }}">
        <small class="text-danger">{{ $errors->first('firstname') }}</small>
      </div>
    </div>
    {{--End Input Staff First Name--}} {{--Begin Input Staff Last Name--}}
    <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
      <label for="lastname" class="col-sm-2 control-label">
        <dt>Họ</dt>
      </label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="lastname"  id="lastname" value="{{ old('lastname') }}">
        <small class="text-danger">{{ $errors->first('lastname') }}</small>
      </div>
    </div>


    {{--End Input Staff Last Name--}} {{--Begin Input Staff Last Name--}}
    <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
      <label for="role_id" class="col-sm-2 control-label">
        <dt>Nhóm</dt>
      </label>
      <div class="col-sm-10">
        <select class="selectpicker" name="role_id" id="role_id">

          @foreach ($roles as $role)

            <option value={{ $role->id }}>- {{ucfirst($role->name)  }}</option>

          @endforeach
        </select>
        <small class="text-danger">{{ $errors->first('role_id') }}</small>
      </div>
    </div>




    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
      <label for="staff_status" class="col-sm-2 control-label">
        <dt>Trạng thái</dt>
      </label>
      <div class="col-sm-10">
        <div class="radio">
          <input id="staff_status_true" class="magic-radio" type="radio" value="1" name="status">
          <label for="staff_status_true">Kích hoạt</label>

          <input id="staff_status_false" class="magic-radio" type="radio" value="0" name="status" checked>
          <label for="staff_status_false">Đang chờ</label>
          <small class="help-block">{{ $errors->first('status') }}</small>
        </div>
      </div>
    </div>
    {{--End Input Staff Status--}}


    <div class="row">
      <div class="col-sm-10 col-sm-offset-2">
        <button class="btn btn-mint" type="submit">Lưu</button>
      </div>
    </div>
    {!! Form::close() !!}


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