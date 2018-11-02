@extends('layouts.master')

@section('header_css')
  <!--Bootstrap Table [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet">


  <!--Font Awesome [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">


  <!--X-editable [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
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
      <?php $margin = 0; ?>
      @permission('user.add')
          <?php $margin = 10; ?>

        <a href="{{ url('users/add') }}" id="btn-add" class="btn btn-primary">
        <i class="ion-person-add"></i> Thêm thành viên</a>
      @endpermission
      @permission('user.trash')
      <a href="{{ url('users/show-trash') }}" id="btn-trash" class="btn btn-primary" style="margin-left: {{ $margin }}px;">
        <i class="fa fa-trash icon-lg"></i> Thùng rác</a>
      @endpermission
      <table id="show-all" class="demo-add-niftycheck" data-toggle="table"
             data-url="{{ url('/users/ajax-data') }}"
             data-toolbar="#btn-add, #btn-trash"
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
          <th data-field="date_modified" data-sortable="true" data-formatter="dateFormatter">Ngày cập nhật</th>
          <th data-field="status" data-sortable="true" data-align="center" data-formatter="actionColumnStatus">Trạng thái</th>
          @permission(['user.edit', 'user.remove'])
          <th data-field="user_id" data-align="center" data-formatter="actionColumnAction">Hoạt động</th>
          @endpermission
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
      var status = 'Đang chờ';
      if (value === 1) {
        label = 'success';
        status = 'Kích hoạt';
      }

      var statusBtn = [
        '<span class="label label-table label-' + label + '">'+ status +'</span>'
      ].join('');

      return [statusBtn].join('');
    }

    function actionColumnAction(value, row, index, field) {
   
      var btnEdit = [].join('');
      <?php if (\Entrust::can('user.edit')) : ?>
      var btnEdit = [
        '<a style="margin-right: 5px" target="_self" href="{{ url('users/edit') }}/' + value + '" ',
        'class="btn btn-mint btn-icon btn-xs" data-toggle="tooltip" data-placement="bottom" title="Sửa">',
        '<i class="fa fa-pencil icon-lg"></i></a>'
      ].join('');
      <?php endif; ?>
      var btnTrash = [].join('');
      <?php if (\Entrust::can('user.remove')) : ?>
      var btnTrash = [
        '<a href="#" onclick="moveTrashItem('+ value +', event)"',
        'class="btn btn-danger btn-icon btn-xs" data-toggle="tooltip" data-placement="bottom" title="Xóa">',
        '<i class="fa fa-trash icon-lg"></i></a>'
      ].join('');
      <?php endif; ?>


          return [btnEdit, btnTrash].join('');
    }


    function moveTrashItem(item, e) {
      if (e) e.preventDefault();
      if (confirm('Xác nhận di chuyển thành viên vào thùng rác ?')) {
        var url = '{{ url("users/move-trash") }}';
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
