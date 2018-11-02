@extends('layouts.master')

@section('header_css')
  <!--Bootstrap Table [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet">


  <!--Font Awesome [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">


  <!--X-editable [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet">

  <style>
    a {
      color: #337ab7;
    }
  </style>
@endsection
@section('page-head')
  <div id="page-head">

    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
      <h1 class="page-header text-overflow">Phân quyền</h1>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->


    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
      <li><a href="/"><i class="demo-pli-home"></i></a></li>
      <li class="active">Nhóm thành viên</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->

  </div>
@endsection
@section('content')



  <div class="panel">
    <div class="panel-body">
      @permission('user.add')
        <?php $margin = 10; ?>

      <a href="{{ url('authorized/role/add') }}" id="btn-add" class="btn btn-primary">
        <i class="fa fa-plus-circle icon-lg"></i> Thêm nhóm</a>

      @endpermission
      <table id="role-admin-table" class="demo-add-niftycheck" data-toggle="table"
             data-url="{{ url('/authorized/ajax-role-user') }}"
             data-toolbar="#btn-add"
             data-search="true"
             data-show-refresh="true"
             data-show-toggle="true"
             data-show-columns="true"
             data-sort-name="user_id"
             data-page-list="[5, 10, 20]"
             data-side-pagination="server"
             data-page-size="<?= PAGE_LIST_COUNT; ?>"
             data-pagination="true"
             data-show-pagination-switch="true">
        <thead>
        <tr>
          <th data-field="username" data-sortable="true">Tên</th>
          <th data-field="email" data-sortable="true">Email</th>
          <th data-field="date_created" data-sortable="true" data-formatter="dateFormatter">Ngày tạo</th>
          <th data-field="date_created" data-sortable="true" data-formatter="dateFormatter">Ngày cập nhật</th>
          <th data-field="name"  data-formatter="detail" data-sortable="true">Nhóm</th>
          <th data-field="user_id" data-align="center" data-formatter="actionColumnEdit">Phân quyền</th>

        </tr>
        </thead>
      </table>
    </div>
  </div>

@endsection

@section('footer_js')
  <!--Bootstrap Table Sample [ SAMPLE ]-->
  <script src="{{ asset('assets/js/demo/tables-bs-table.js') }}"></script>


  <!--X-editable [ OPTIONAL ]-->
  <script src="{{ asset('assets/plugins/x-editable/js/bootstrap-editable.min.js') }}"></script>


  <!--Bootstrap Table [ OPTIONAL ]-->
  <script src="{{ asset('assets/plugins/bootstrap-table/bootstrap-table.min.js') }}"></script>


  <!--Bootstrap Table Extension [ OPTIONAL ]-->
  <script src="{{ asset('assets/plugins/bootstrap-table/extensions/editable/bootstrap-table-editable.js') }}"></script>

  <script>
    function actionColumnEdit(value, row, index, field) {
      var ticketBtn = [
        '<a target="_self" href="{{ url("authorized/edit-role-user") }}/' + value + '" ',
        'class="btn btn-mint btn-icon btn-xs" data-placement="top" data-original-title="Sửa">',
        '<i class="fa fa-pencil icon-lg"></i></a>'
      ].join('');

      return [ticketBtn].join('');
    }

  </script>


  <script>

    function detail(value, row, index, field) {
          var url="{{ url('/authorized/edit-permission/') }}";
          var statusBtn = [
            `<a target="_self" href="${url}/${row['id']}">${value}</a>`
          ].join('');

          return [statusBtn].join('');
      }
  </script>
@endsection
