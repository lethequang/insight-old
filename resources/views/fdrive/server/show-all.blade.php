@extends('layouts.master')

@section('header_css')
  <!--Bootstrap Table [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet">


  <!--Font Awesome [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

  <!--Bootstrap Datepicker [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

  <!--Switchery [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet">

@endsection
@section('page-head')
  <div id="page-head">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
      <h1 class="page-header text-overflow">Quản lý Server</h1>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->


    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
      <li><a href="/"><i class="demo-pli-home"></i></a></li>
      <li class="active">Danh sách Server</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->

    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Tìm kiếm</h3>
      </div>
      <div class="panel-body input_search">
        <div class="col-lg-6 col-md-6">
          <p class="text-main text-bold">Mã VM</p>
          <!--Bootstrap Datepicker : Text Input-->
          <!--===================================================-->
          <div>
            <input id="vm_code_search" type="text" class="form-control">
          </div>
          <!--===================================================-->
        </div>

        <div class="col-lg-6 col-md-6">
          <p class="text-main text-bold">Địa chỉ IP</p>
          <!--Bootstrap Datepicker : Component-->
          <!--===================================================-->
          <div>
            <input  id="ip_search" type="text" class="form-control">
          </div>
          <!--===================================================-->
        </div>

        <div class="col-lg-6 col-md-6">
          <p class="text-main text-bold">Tên VM</p>
          <!--Bootstrap Datepicker : Component-->
          <!--===================================================-->
          <div>
            <input  id="vm_name_show" type="text" class="form-control">
          </div>
          <!--===================================================-->
        </div>

        <div class="col-lg-6 col-md-6">
          <p class="text-main text-bold">Ngày tạo</p>
          <!--Bootstrap Datepicker : Range-->
          <!--===================================================-->
          <div id="demo-dp-range">
            <div class="input-daterange input-group" id="datepicker">
              <input id="created_time_from" type="text" class="form-control" name="start" />
              <span class="input-group-addon">to</span>
              <input id="created_time_to" type="text" class="form-control" name="end" />
            </div>
          </div>
          <!--===================================================-->
        </div>

      </div>
    </div>

  </div>
@endsection
@section('content')
  <div class="panel">
    <div class="panel-body">
      <?php $margin = 0; ?>
      <table id="show-all" class="demo-add-niftycheck" data-toggle="table"
             data-url="{{ url('/fdrive/server/ajax-data') }}"
             data-toolbar="#btn-add, #btn-trash"
             data-search="fasle"
             data-query-params="queryParams"
             data-show-refresh="true"
             data-show-toggle="true"
             data-show-columns="true"
             data-sort-name="vm_code"
             data-page-list="[5, 10, 20]"
             data-side-pagination="server"
             data-page-size="<?=PAGE_LIST_COUNT ?>"
             data-pagination="true"
             data-show-pagination-switch="true">

        <thead>
        <tr>
          <th data-field="vm_code" data-sortable="true">Mã VM</th>
          <th data-field="vm_name_show" data-sortable="true">Tên VM</th>
          <th data-field="vm_os_name" data-sortable="true">Tên hệ điều hành</th>
          <th data-field="public_ip" data-sortable="true">Public IP</th>
          <th data-field="private_ip" data-sortable="true">Private IP</th>
          <th data-field="vm_user">Username</th>
          <th data-field="vm_pass">Password</th>
          <th data-field="vm_create_date" data-sortable="true" >Ngày tạo</th>

          <th data-field="vm_status" >Trạng thái</th>
            @permission('server.detail')
          <th data-field="vm_code" data-align="center" data-formatter="detail">Xem chi tiết</th>
            @endpermission
        </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection

@section('footer_js')

  <!--X-editable [ OPTIONAL ]-->
  <script src="{{ asset('assets/plugins/x-editable/js/bootstrap-editable.min.js') }}"></script>


  <!--Bootstrap Table [ OPTIONAL ]-->
  <script src="{{ asset('assets/plugins/bootstrap-table/bootstrap-table.min.js') }}"></script>


  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

  <!--Switchery [ OPTIONAL ]-->
  <script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>

  <script>
      $('#demo-dp-range .input-daterange').datepicker({
          format: "yyyy-mm-dd",
          todayBtn: "linked",
          autoclose: true,
          todayHighlight: true
      });
  </script>

  <script>
      function queryParams(params) {
          if(document.getElementById("vm_code_search").value) {
              params['vm_code'] = document.getElementById("vm_code_search").value;
          }
          if(document.getElementById("vm_name_show").value) {
              params['vm_name_show'] = document.getElementById("vm_name_show").value;
          }
          if(document.getElementById("ip_search").value) {
              params['ip'] = document.getElementById("ip_search").value;
          }
          if(document.getElementById("created_time_from").value) {
              params['created_time_from'] = document.getElementById("created_time_from").value;
          }
          if(document.getElementById("created_time_to").value) {
              params['created_time_to'] = document.getElementById("created_time_to").value;
          }
          return params;
      };
  </script>

  <script>
      var pros = {
          pro1: '#vm_code',
          pro2: '#ip',
          pro3: '#created_time_from',
          pro4: '#created_time_to',
          pro5: '#vm_name_show'
      };
      $(".input_search").change(function() {
          $("#show-all").bootstrapTable('refresh');
      });
  </script>

  <script>
    var $table = $('#show-all');

    function detail(value, row, index, field) {
        var url="{{ url('/fdrive/server/detail/') }}";
        var statusBtn = [
            '<a class="btn btn-success btn-labeled" href="'+url+'/'+ value+'"><i class="btn-label fa fa-th-large"></i>'+ 'Detail' +'</a>'
        ].join('');

        return [statusBtn].join('');
    }

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
      <?php if (\Entrust::can('user.edit')): ?>
      var btnEdit = [
        '<a style="margin-right: 5px" target="_blank" href="{{ url('users/edit') }}/' + value + '" ',
        'class="btn btn-mint btn-icon btn-xs" data-toggle="tooltip" data-placement="bottom" title="Sửa">',
        '<i class="fa fa-pencil icon-lg"></i></a>'
      ].join('');
      <?php endif ?>
      var btnTrash = [].join('');
      <?php if (\Entrust::can('user.remove')): ?>
      var btnTrash = [
        '<a href="#" onclick="moveTrashItem('+ value +', event)"',
        'class="btn btn-danger btn-icon btn-xs" data-toggle="tooltip" data-placement="bottom" title="Xóa">',
        '<i class="fa fa-trash icon-lg"></i></a>'
      ].join('');
      <?php endif ?>


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

    $table.bootstrapTable({
        onLoadSuccess: function () {
            var collection = $(".demo-sw-sz");
            collection.each(function(entry, index) {
                // You can access `collection.length` here.
                new Switchery(index);
            });
        }
    });
  </script>



@endsection
