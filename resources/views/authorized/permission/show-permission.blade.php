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
            <h1 class="page-header text-overflow">Phân quyền</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="demo-pli-home"></i>
                </a>
            </li>
            <li class="active">Cấp độ truy cập</li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>

@endsection @section('content')

    <div class="panel">
        <div class="panel-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @permission('user.add')
            <?php $margin = 10; ?>
            <a href="{{ url('authorized/permission/add-permission') }}" id="btn-add" class="btn btn-primary">
                <i class="fa fa-plus-circle icon-lg"></i> Thêm quyền</a>
            <a href="{{ url('authorized/permission/show-trash-permission') }}" id="btn-trash" class="btn btn-primary"
               style="margin-left: {{ $margin }}px;">
                <i class="fa fa-trash icon-lg"></i> Thùng rác</a>

            @endpermission
            <table id="roles-admin" class="demo-add-niftycheck" data-toggle="table"
                   data-url="{{ url('/authorized/permission/ajax-data-permission') }}"
                   data-toolbar="#btn-add, #btn-trash"

                   data-search="true" data-show-refresh="true" data-show-toggle="true" data-show-columns="true"
                   data-sort-name="id" data-page-list="[5, 10, 20]"
                   data-side-pagination="server" data-page-size="<?= PAGE_LIST_COUNT; ?>" data-pagination="true"
                   data-show-pagination-switch="true">
                <thead>
                <tr>
                    <th data-field="name" data-sortable="true">Tên</th>
                    <th data-field="display_name" data-sortable="true">Tên đại diện</th>
                    <th data-field="description" data-formatter="detail" data data-sortable="true">Chi tiết</th>

                    <th data-field="created_at" data-sortable="true" data-formatter="dateFormatter">Ngày tạo</th>
                    <th data-field="id" data-align="center" data-formatter="actionColumnEdit">Phân quyền</th>
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

        var $table = $('#roles-admin');

        function actionColumnEdit(value, row, index, field) {
            var editBtn = [].join('');
            var editBtn = [
                '<a style="margin-right: 5px" target="_self" href="{{ url("authorized/permission/update-permission/") }}/' + value + '" ',
                'class="btn btn-mint btn-icon btn-xs" data-placement="top" data-original-title="Sửa" title="Sửa">',
                '<i class="fa fa-pencil icon-lg"></i></a>'
            ].join('');
            var btnTrash = [].join('');

            var btnTrash = [
                '<a href="#" onclick="moveTrashItem(' + value + ', event)"',
                'class="btn btn-danger btn-icon btn-xs" data-toggle="tooltip" data-placement="bottom" title="Xóa">',
                '<i class="fa fa-trash icon-lg"></i></a>'
            ].join('');

            return [editBtn, btnTrash].join('');
        }

        function moveTrashItem(item, e) {
            if (e) e.preventDefault();
            if (confirm('Xác nhận di chuyển quyền vào thùng rác ?')) {
                var url = '{{ url("authorized/permission/move-trash-permission") }}';
                var data = {
                    '_token': '{{ csrf_token() }}',
                    'id': item
                };
                $.post(url, data).done(function (data) {
                    var type = (data.code != 0) ? 'danger' : 'success';
                    notifyMsg(data.msg, type);
                    $table.bootstrapTable('refresh');
                });
            }
        }
    </script>


    <script>
        function detail(value, row, index, field) {
           if(value ==1){
               return 'Thành viên';
           }
            if(value ==2){
                return 'Dịch vụ Fdrive';
            }
            if(value ==3){
                return 'Khách hàng';
            }
            if(value ==4){
                return ' Phân quyền';
            }

        }
    </script>
@endsection