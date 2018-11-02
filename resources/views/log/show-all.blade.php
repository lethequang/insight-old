@extends('layouts.master')

@section('header_css')
  <!--Bootstrap Table [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet">


  <!--Font Awesome [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

  <!--Bootstrap Datepicker [ OPTIONAL ]-->
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

  <!--X-editable [ OPTIONAL ]-->
{{--
  <link href="{{ asset('assets/plugins/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet">
--}}
  <link href="{{ asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
@endsection
@section('page-head')
  <div id="page-head">

    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
      <h1 class="page-header text-overflow">Hệ thống</h1>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->


    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
      <li><a href="/"><i class="demo-pli-home"></i></a></li>
      <li class="active">Nhật ký hoạt động</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->

    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title"></h3>
      </div>
      <div class="panel-body input_search">
        <p class="text-main text-bold">Ngày tạo</p>

        <div class="row">
          <div class="col-lg-6 col-md-6">
            <!--Bootstrap Datepicker : Range-->
            <!--===================================================-->
            <div id="demo-dp-range">
              <div class="input-daterange input-group" id="datepicker">
                <input id="from_filter" type="text" class="form-control" name="start" value="{{ $filters['from'] }}"/>
                <span class="input-group-addon">Đến</span>
                <input id="to_filter" type="text" class="form-control" name="end" value="{{ $filters['to'] }}"/>
              </div>
            </div>
            <!--===================================================-->
          </div>
          <div class="col-lg-1 col-md-1">
            <button id="submit" class="btn btn-primary" type="button" name="submit" title="Tìm kiếm">Tìm kiếm</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('content')
  <div class="panel">
    <div class="panel-body">
      <table id="show-all" class="demo-add-niftycheck" data-toggle="table"
            data-url="{{ url('/logs/ajax-data') }}"
            data-toolbar="#btn-add, #btn-trash"
            data-show-refresh="true"
            data-query-params="queryParams"
            data-show-toggle="true"
            data-show-columns="true"
            data-sort-name="id"
            data-sort-order="desc"
            data-page-list="[5, 10, 20]"
            data-side-pagination="server"
            data-page-size="<?= PAGE_LIST_COUNT; ?>"
            data-pagination="true"
            data-show-pagination-switch="true">
        <thead>
        <tr>
          <th data-field="url" data-sortable="true">URL</th>
          <th data-field="route" data-sortable="true">Route</th>
          <th data-field="action" data-sortable="true">Action</th>
          <th data-field="causer" data-sortable="true">User ID</th>
          <th data-field="properties" data-sortable="true">Value</th>
          <th data-field="user_agent" data-sortable="true">User Agent</th>
          <th data-field="ip" data-sortable="true">IP</th>
          <th data-field="created_at" data-sortable="true" data-formatter="dateFormatter">Date</th>
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

  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

  <script>
	  function queryParams(params) {
		  params.from = $('#from_filter').val();
		  params.to = $('#to_filter').val();
		  return params;
	  }
	  $(document).ready(function () {
		  $('#demo-dp-range .input-daterange').datepicker({
			  format: "yyyy-mm-dd",
			  todayBtn: "linked",
			  autoclose: true,
			  todayHighlight: true
		  });

		  /*$(".input_search").change(function() {
              $("#show-all").bootstrapTable('refresh');
          });*/
		  var $table = $('#show-all');

		  $('#submit').click(function () {
			  $("#show-all").bootstrapTable('refresh');
		  });
	  });
  </script>
@endsection
