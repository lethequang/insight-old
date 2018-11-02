@extends('layouts.master')

@section('header_css')
  <!--Font Awesome [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

  <!--Bootstrap Select [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">

  <!--Bootstrap Validator [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/bootstrap-validator/bootstrapValidator.min.css') }}" rel="stylesheet">

@endsection
@section('page-head')
  <div id="page-head">

    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
      <h1 class="page-header text-overflow">Dịch vụ Fdrive</h1>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->


    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
      <li><a href="/"><i class="demo-pli-home"></i></a></li>
      <li class="active">{{ $pageTitle }}</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->

  </div>
@endsection

@section('content')
  <div class="panel panel-bordered panel-dark">
    <div class="panel-heading">
      <h3 class="panel-title">
        {{ $pageTitle }}
      </h3>
    </div>
    {!! Form::open(['route' => 'server.postAdd', 'method' => 'post', 'class' => 'panel-body form-horizontal form-padding', 'id' => 'form-create-server']) !!}
    {{--Begin Input Staff Name--}}
    <div class="form-group">
      <label for="staff_name" class="col-sm-2 control-label">
        <dt>ID User</dt>
      </label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="userId" value="" id="userId">
      </div>
    </div>
    {{--End Input Staff Name--}}

    {{--Begin Input Staff Password--}}
    <div class="form-group">
      <label for="staff_password" class="col-sm-2 control-label">
        <dt>ID Image</dt>
      </label>
      <div class="col-sm-3" style="width: 280px">
        {!! Form::select('imageId', ['9ea00fba-0545-4e67-9956-a7c00154102' => 'FDRIVE'], '9ea00fba-0545-4e67-9956-a7c00154102', ['class' => 'selectpicker', 'id' => 'imageId']) !!}

      </div>
    </div>
    {{--End Input Staff Password--}}

    {{--Begin Input Staff Password--}}
    <div class="form-group">
      <label for="staff_password" class="col-sm-2 control-label">
        <dt>Server Name</dt>
      </label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="serverName" value="" id="serverName">
      </div>
    </div>
    {{--End Input Staff Password--}}

    <div class="row">
      <div class="col-sm-10 col-sm-offset-2">
        <button class="btn btn-mint" type="submit">Tạo</button>
      </div>
    </div>
    {!! Form::close() !!}


  </div>
@endsection

@section('footer_js')
  <!--Bootstrap Select [ OPTIONAL ]-->
  <script src="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>

  <!--Bootstrap Validator [ OPTIONAL ]-->
  <script src="{{ asset('assets/plugins/bootstrap-validator/bootstrapValidator.min.js') }}"></script>


  <!--Masked Input [ OPTIONAL ]-->
  <script src="{{ asset('assets/plugins/masked-input/jquery.maskedinput.min.js') }}"></script>

  <script>
    var faIcon = {
      valid: 'fa fa-check-circle fa-lg text-success',
      invalid: 'fa fa-times-circle fa-lg',
      validating: 'fa fa-refresh'
    };

    $('#form-create-server').bootstrapValidator({
      excluded: [':disabled'],
      feedbackIcons: faIcon,
      fields: {
        userId: {
          validators: {
            notEmpty: {
              message: 'Vui lòng nhập thông tin ID user.'
            },
            regexp: {
              regexp: /^\d+$/,
              message: 'ID user không hợp lệ.'
            },
          }
        },
        imageId: {
          validators: {
            notEmpty: {
              message: 'Vui lòng nhập thông tin ID image.'
            },
            regexp: {
              regexp: /^[a-z0-9-]*$/,
                message: 'ID image không hợp lệ.'
            },
          }
        },
        serverName: {
          validators: {
            notEmpty: {
              message: 'Vui lòng nhập thông tin tên server.'
            }
          }
        }
      }
    });
  </script>
@endsection