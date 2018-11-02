@extends('layouts.master')

@section('header_css')
  <!--Bootstrap Table [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet">


  <!--Font Awesome [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

  <!--Bootstrap Datepicker [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
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
          <p class="text-main text-bold">Tên công ty</p>
          <!--Bootstrap Datepicker : Text Input-->
          <!--===================================================-->
          <div>
            <input id="name" type="text" class="form-control">
          </div>
          <!--===================================================-->
        </div>

        <div class="col-lg-6 col-md-6">
          <p class="text-main text-bold">Email</p>
          <!--Bootstrap Datepicker : Component-->
          <!--===================================================-->
          <div>
            <input  id="email" type="text" class="form-control">
          </div>
          <!--===================================================-->
        </div>

        <div class="col-lg-6 col-md-6">
          <p class="text-main text-bold">Số điện thoại</p>
          <!--Bootstrap Datepicker : Component-->
          <!--===================================================-->
          <div>
            <input  id="phone" type="text" class="form-control">
          </div>
          <!--===================================================-->
        </div>

        <div class="col-lg-6 col-md-6">
          <p class="text-main text-bold">Địa chỉ</p>
          <!--Bootstrap Datepicker : Component-->
          <!--===================================================-->
          <div>
            <input  id="address" type="text" class="form-control">
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
             data-url="{{ url('/customer/ajax-data') }}"
             data-toolbar="#btn-add, #btn-trash"
             data-search="false"
             data-query-params="queryParams"
             data-show-refresh="true"
             data-show-toggle="true"
             data-show-columns="true"
             data-sort-name="user_id"
             data-page-list="[5, 10, 20]"
             data-side-pagination="server"
             data-page-size="<?=PAGE_LIST_COUNT ?>"
             data-pagination="true"
             data-show-pagination-switch="true">

        <thead>
        <tr>
          <th data-field="user_id" data-sortable="true">Id</th>
          <th data-field="user_email" data-sortable="true">Email</th>
          <th data-field="user_phone" data-sortable="true">Số điện thoại</th>
          <th data-field="user_first_name" data-sortable="true">Tên công ty</th>
          <th data-field="user_address" data-sortable="true">Địa chỉ</th>
          <th data-field="user_created_time" data-sortable="true" >Ngày tạo</th>
          <th data-field="user_status" data-sortable="true" data-align="center" data-formatter="actionColumnStatus">Trạng thái</th>
            @permission('customer.detail')
            <th data-field="user_id" data-align="center" data-formatter="detail">Xem chi tiết</th>
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
          if(document.getElementById("email").value) {
              params['email'] = document.getElementById("email").value;
          }
          if(document.getElementById("phone").value) {
              params['phone'] = document.getElementById("phone").value;
          }
          if(document.getElementById("name").value) {
              params['name'] = document.getElementById("name").value;
          }
          if(document.getElementById("address").value) {
              params['address'] = document.getElementById("address").value;
          }
          if(document.getElementById("created_time_from").value) {
              params['created_time_from'] = document.getElementById("created_time_from").value;
          }
          if(document.getElementById("created_time_to").value) {
              params['created_time_to'] = document.getElementById("created_time_to").value;
          }
          return params;
      };

      function detail(value, row, index, field) {
          var url="{{ url('/customer/detail/') }}";
          var statusBtn = [
              '<a class="btn btn-success btn-labeled" href="'+url+'/'+ value+'"><i class="btn-label fa fa-th-large"></i>'+ 'Detail' +'</a>'
          ].join('');

          return [statusBtn].join('');
      }

  </script>

  <script>
      var pros = {
          pro1: '#email',
          pro2: '#phone',
          pro3: '#name',
          pro4: '#address',
          pro5: '#created_time_from',
          pro6: '#created_time_to'
      };
      $(".input_search").change(function() {
          $("#show-all").bootstrapTable('refresh');
      });
  </script>

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


  </script>
@endsection

