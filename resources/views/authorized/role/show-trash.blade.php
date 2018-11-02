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
            <h1 class="page-header text-overflow">Quản lý nhóm</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li class="active">Danh sách nhóm đã xóa</li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->


    </div>
@endsection
@section('content')
    <div class="panel">
        <div class="panel-heading">
            <a class="btn btn-primary" href="{{ route('authorized.get-show-role') }}"> <i class="glyphicon glyphicon-share
                    "></i> Quay lại</a>
        </div>
        <div class="panel-body">
            <table id="show-all" class="demo-add-niftycheck" data-toggle="table"
                   data-url="{{ url('authorized/role/ajax-data-trash') }}"
                   data-search="true"
                   data-show-refresh="true"
                   data-show-toggle="true"
                   data-show-columns="true"
                   data-sort-name="id"
                   data-page-list="[5, 10, 20]"
                   data-side-pagination="server"
                   data-page-size="<?= PAGE_LIST_COUNT; ?>"
                   data-pagination="true"
                   data-show-pagination-switch="true">

                <thead>
                <tr>
                    <th data-field="name" data-sortable="true">Name</th>
                    <th data-field="display_name" data-sortable="true">Display name</th>
                    <th data-field="description" data-sortable="true">Description</th>
                    <th data-field="created_at" data-sortable="true" data-formatter="dateFormatter">Ngày đăng ký</th>
                    <th data-field="updated_at" data-sortable="true" data-formatter="dateFormatter">Đăng nhập cuối
                        cùng
                    </th>
                    <th data-field="id" data-align="center" data-formatter="actionColumnAction">Hoạt động</th>
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
        function actionColumnAction(value, row, index, field) {
            var btnRestore = [
                '<a href="#" onclick="putBackItem(' + value + ', event)"',
                'class="btn btn-warning btn-icon btn-xs" data-toggle="tooltip" data-placement="bottom" title="Khôi phục">',
                '<i class="fa fa-repeat icon-lg"></i></a>'
            ].join('');
            var btnRemove = [
                '<a href="#" onclick="removeItem(' + value + ', event)" style="margin-left: 5px"',
                'class="btn btn-danger btn-icon btn-xs" data-toggle="tooltip" data-placement="bottom" title="Xóa">',
                '<i class="fa fa-trash icon-lg"></i></a>'
            ].join('');
            return [btnRestore, btnRemove].join('');
        }

        var $table = $('#show-all');

        function removeItem(id) {
            if (confirm('Xác nhận khôi phục nhóm ?')) {
                var data = {
                    '_token': '{{ csrf_token() }}',
                };
                $.post('/authorized/role/remove-trash/' + id, data, function (data) {
                    var type = (data.code != 0) ? 'danger' : 'success';
                    notifyMsg(data.msg, type);
                    $table.bootstrapTable('refresh');
                });
            }
        }

        function putBackItem(id) {
            if (confirm('Xác nhận khôi phục nhóm ?')) {
                var data = {
                    '_token': '{{ csrf_token() }}',
                };
                $.post('/authorized/role/put-back/' + id, data, function (data) {
                    var type = (data.code != 0) ? 'danger' : 'success';
                    notifyMsg(data.msg, type);
                    $table.bootstrapTable('refresh');
                });
            }
        }
    </script>
@endsection