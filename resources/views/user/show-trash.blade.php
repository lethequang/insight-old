@extends('layouts.master')

@section('header_css')
  <!--Bootstrap Table [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet">


  <!--Font Awesome [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">


  <!--X-editable [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet">
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
  <div class="panel">
    <div class="panel-body">
      <table id="show-all" class="demo-add-niftycheck" data-toggle="table"
             data-url="{{ url('users/ajax-data-trash') }}"
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
          <th data-field="username" data-sortable="true">Tên tài khoản</th>
          <th data-field="email" data-sortable="true">Hòm thư</th>
          <th data-field="lastname" data-sortable="true">Họ</th>
          <th data-field="firstname" data-sortable="true">Tên</th>
          <th data-field="date_created" data-sortable="true" data-formatter="dateFormatter">Ngày đăng ký</th>
          <th data-field="date_modified" data-sortable="true" data-formatter="dateFormatter">Đăng nhập cuối cùng</th>
          <th data-field="status" data-sortable="true" data-align="center" data-formatter="actionColumnStatus">Trạng thái</th>
          <th data-field="user_id" data-align="center" data-formatter="actionColumnAction">Hoạt động</th>
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
    var $table = $('#show-all');

    function actionColumnStatus(value, row, index, field) {
      var label = 'dark';
      var status = 'Không kích hoạt';
      if (value === 1) {
        label = 'success';
        status = 'Kích hoạt';
      }

      var statusBtn = [
        '<span class="label label-table label-' + label + '"  data-toggle="tooltip" data-placement="bottom" title="'+ status +'">'+ status +'</span>'
      ].join('');

      return [statusBtn].join('');
    }

    function actionColumnAction(value, row, index, field) {
      var btnRestore = [
        '<a href="#" onclick="putBackItem('+ value +', event)"',
        'class="btn btn-warning btn-icon btn-xs" data-toggle="tooltip" data-placement="bottom" title="Khôi phục">',
        '<i class="fa fa-repeat icon-lg"></i></a>'
      ].join('');

      var btnRemove = [
        '<a href="#" onclick="removeItem('+ value +', event)" style="margin-left: 5px"',
        'class="btn btn-danger btn-icon btn-xs" data-toggle="tooltip" data-placement="bottom" title="Xóa">',
        '<i class="fa fa-trash icon-lg"></i></a>'
      ].join('');
      return [btnRestore, btnRemove].join('');
    }

    function putBackItem(item, e) {
      if (e) e.preventDefault();
      if (confirm('Xác nhận khôi phục thành viên ?')) {
        var url = '{{ url("users/put-back") }}';
        var data = {
          '_token': '{{ csrf_token() }}',
          'id': item
        };
        $.post(url, data).done(function(data){
          var type = (data.code != 0) ? 'danger' : 'success';
          notifyMsg(data.msg, type);
          $table.bootstrapTable('refresh');
        });
      }
    }

    function removeItem(item, e) {
      if (e) e.preventDefault();
      if (confirm('Xác nhận xóa vĩnh viễn thành viên ?')) {
        var url = '{{ url("users/remove-trash") }}';
        var data = {
          '_token': '{{ csrf_token() }}',
          'id': item
        };
        $.post(url, data).done(function(data){
          var type = (data.code != 0) ? 'danger' : 'success';
          notifyMsg(data.msg, type);
          $table.bootstrapTable('refresh');
        });
      }
    }



  </script>
@endsection
