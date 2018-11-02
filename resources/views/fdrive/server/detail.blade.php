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
        <h1 class="page-header text-overflow">Chi tiết Server</h1>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->


    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
        <li><a href="#"><i class="demo-pli-home"></i></a></li>
        <li class="active"><a href=" {{url('/fdrive/server/show-all/')}}">Server</a></li>
        <li class="active">{{$data['vm_name_show']}}</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->

</div>
@endsection
@section('content')
    <div id="page-content">
        <div class="panel">
            <div class="panel-body">
                <div class="fixed-fluid">
                    <div class="fixed-md-200 pull-sm-left fixed-right-border">

                        <!-- Simple profile -->
                        <div class="text-center">
                            <h4 class=text-lg">Hệ điều hành</h4>
                            <div class="pad-ver">
                                <img src="/assets/img/ubuntu.png" class="img-lg img-circle" alt="Profile Picture">
                            </div>
                            <h4 class="text-lg text-overflow mar-no">Ubuntu</h4>
                            <hr class="new-section-xs">
                            <h4 class=text-lg">Trạng thái</h4>
                            <div id="vm_status" class="label label-table label-success text-lg">{{$data['vm_status']}}</div>
                            <hr class="new-section-xs">
                            <br>
                            <div class="box-inline mar-rgt">
                                <!--Switchery : Checked by default-->
                                <!--===================================================-->
                                {{--<input id="sw-checkstate" class="switchery switchery-large" type="checkbox" checked>--}}
                                <button id="state-btn" class="btn btn-lg btn-labeled" data-loading-text="<span class='btn-label'><i class='fa-spin fa fa-superpowers'></i></span>Đang xử lý..." type="button">

                                </button>
                                <!--===================================================-->
                            </div>

                            <!--Switchery : Checking State Field-->
                            <!--===================================================-->
                            {{--<span id="sw-checkstate-field" class="label label-info text-lg"></span>--}}
                            {{--<button class="btn btn-warning btn-icon btn-group-lg btn-circle icon-3x"><i class="fa fa-power-off"></i></button>--}}
                            <hr>
                            <h4 class=text-lg">Restart</h4>
                            <button class="btn btn-warning btn-icon btn-group-lg btn-circle icon-3x" onclick="RestartVM()"><i class="fa fa-refresh"></i></button>
                        </div>
                    </div>
                    <div class="fluid">

                        <div class="col-md-12">
                            <h3 class="text-main text-normal text-2x mar-no">{{$data['vm_name_show']}}</h3>
                            <h5 class="text-uppercase text-muted text-normal">{{$data['vm_code']}}</h5>
                            <hr class="new-section-xs">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="list-group bg-trans ">
                                    <a class="list-group-item"><i class="fa fa-briefcase icon-lg icon-fw"></i> Gói: {{$data['vm_os_name']}}</a>
                                    <a class="list-group-item"><i class="fa fa-pie-chart icon-lg icon-fw"></i> Ổ cứng: {{$data['flavor_disk']}} GB</a>
                                    <a class="list-group-item"><i class="fa fa-tasks icon-lg icon-fw"></i> RAM: {{$data['flavor_ram']}} GB</a>
                                    <a class="list-group-item"><i class="fa fa-cogs icon-lg icon-fw"></i> CPU: {{$data['flavor_cpu']}} Core</a>
                                    <a class="list-group-item"><i class="fa fa-calendar-check-o icon-lg icon-fw"></i> Ngày tạo: {{$data['vm_create_date']}}</a>
                                    <a class="list-group-item"><i class="fa fa-database icon-lg icon-fw"></i> Server: {{$data['location_name']}}</a>
                                    <a class="list-group-item"><i class="fa fa-cloud icon-lg icon-fw"></i> Nơi đặt server: {{$data['location_name_show']}}</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="list-group bg-trans mar-no">
                                    <a class="list-group-item"><i class="fa fa-feed icon-lg icon-fw"></i> Public IP: {{$data['public_ip']}}</a>
                                    <a class="list-group-item"><i class="fa fa-plug icon-lg icon-fw"></i> Private IP: {{$data['private_ip']}}</a>
                                    <a class="list-group-item"><i class="fa fa-user-secret icon-lg icon-fw"></i> Username: {{$data['vm_user']}}</a>
                                    <a class="list-group-item"><i class="fa fa-paw icon-lg icon-fw"></i> Password: {{$data['vm_pass']}}</a>
                                </div>
                            </div>
                        </div>
                        <hr class="new-section-xs">
                        <!-- Profile Details -->
                        <p class="pad-ver text-main text-sm text-uppercase text-bold">Thông tin khách hàng</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="pad-ver text-main text-sm text-uppercase text-bold"> {{$data['user_first_name']}}</p>
                                <p><i class="demo-pli-map-marker-2 icon-fw"></i> Địa chỉ: {{$data['user_address']}}</p>
                                <p><i class="demo-pli-internet icon-fw "></i> Email: {{$data['user_email']}}</p>
                                <p><i class="demo-pli-old-telephone icon-fw "></i> Phone: {{$data['user_phone']}}</p>
                                <p><i class="fa fa-calendar-check-o icon-fw"></i> Ngày tạo tài khoản: {{$data['user_created_time']}}</p>
                                <a class="btn btn-success btn-labeled" href=" {{ url('/customer/detail')}}/{{$data['user_id']}}"><i class="btn-label fa fa-th-large"></i> Xem chi tiết</a>
                            </div>
                        </div>
                        <hr class="new-section-xs">
                        <a class="btn btn-info btn-labeled" href=" {{url('/fdrive/server/show-all/')}}"><i class="btn-label fa fa-list-alt"></i> Trở về danh sách server</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('footer_js')

<!--X-editable [ OPTIONAL ]-->
<script src="{{ asset('assets/plugins/x-editable/js/bootstrap-editable.min.js') }}"></script>


<!--Bootstrap Table [ OPTIONAL ]-->
<script src="{{ asset('assets/plugins/bootstrap-table/bootstrap-table.min.js') }}"></script>

<!--Switchery [ OPTIONAL ]-->
<script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>

<script>
    //on off server handle
    var stateBtn=$('#state-btn');
    var vmstatus=$('#vm_status');
    var active_btn_html="<span class='btn-label'><i class='fa fa-power-off'></i></span>Bật";
    var shutoff_btn_html="<span class='btn-label'><i class='fa fa-power-off'></i></span>Tắt";
    var die_btn_html="<span class='btn-label'><i class='fa fa-close'></i></span>Đang vô hiệu";
    function btnSetActive() {
        stateBtn.html(active_btn_html);
        stateBtn.removeClass( "btn-pink" ).addClass( "btn-mint" );
    }
    function btnSetOff() {
        stateBtn.html(shutoff_btn_html);
        stateBtn.removeClass( "btn-mint" ).addClass( "btn-pink" );
    }
    function btnSetDie() {
        stateBtn.html(die_btn_html);
        stateBtn.attr("class","btn btn-lg btn-labeled btn-dark");
        stateBtn.prop("disabled",true);
    }

    switch(vmstatus.text()) {
        case 'active':
            vmstatus.attr("class","label label-table text-lg label-success");
            btnSetOff();
            break;
        case 'shutoff':
            vmstatus.attr("class","label label-table text-lg label-pink");
            btnSetActive();
            break;
        case 'reboot':
            var doSomething = setTimeout(function () {
                clearTimeout(doSomething);
                window.location.reload(true);
            }, 30000);
        default:
            vmstatus.attr("class","label label-table text-lg label-dark");
            btnSetDie();
    }

    // if(vmstatus.text()=='active'){
    //     btnSetOff();
    // }
    // else{
    //     btnSetActive();
    // }
    $('#state-btn').on('click', function () {
        switch(vmstatus.text()) {
            case 'active':
                if (confirm('Bạn có chắc muốn tắt server này không?')) {
                    var btn = $(this).button('loading')
                    // business logic...
                    var doSomething = setTimeout(function () {
                        clearTimeout(doSomething);
                        ShutdownVM();
                    }, 3000);
                }
                break;
            case 'shutoff':
                if (confirm('Bạn có chắc muốn bật server này không?')) {
                    var btn = $(this).button('loading')
                    // business logic...
                    var doSomething = setTimeout(function () {
                        clearTimeout(doSomething);
                        BootVM();
                    }, 3000);
                }
                break;
            default:
        }
    });

    function BootVM(){
        var myData={
            'action': 'boot',
            'vmId': '<?php echo $data['vm_code']; ?>',
            'userId': '<?php echo $data['user_id'];?>'
        }
        $.ajax({
            url: '<?php echo url('/fdrive/server/action/') ;?>',
            data: myData,
            type: 'GET',
            crossDomain: true,
            dataType: 'json',
            success: function(response) {
                btnSetActive();
                // btn.button('dispose');
                alert("Thành công");
                console.log(response.param);
                window.location.reload(true);
            },
            error: function() { alert('Thất bại!'); }
        });
    }

    function ShutdownVM(){
        var myData={
            'action': 'shutdown',
            'vmId': '<?php echo $data['vm_code']; ?>',
            'userId': '<?php echo $data['user_id'];?>'
        }
        $.ajax({
            url: '<?php echo url('/fdrive/server/action/') ;?>',
            data: myData,
            type: 'GET',
            crossDomain: true,
            dataType: 'json',
            success: function(response) {
                btnSetOff();
                // btn.button('dispose');
                alert("Thành công");
                console.log(response.param);
                window.location.reload(true);
            },
            error: function() { alert('Thất bại!'); }
        });
    }

</script>

<script>


    function RestartVM() {
        if (confirm('Bạn có chắc restart server này không?')) {
            var myData={
                'action': 'reset',
                'vmId': '<?php echo $data['vm_code']; ?>',
                'userId': '<?php echo $data['user_id'];?>'
            }
            $.ajax({
                url: '<?php echo url('/fdrive/server/action/') ;?>',
                data: myData,
                type: 'GET',
                crossDomain: true,
                dataType: 'json',
                success: function(response) {
                    alert("Thành công");
                        console.log(response.param);
                    window.location.reload(true);
                    },
                error: function() {
                    alert('Thất bại!');
                    window.location.reload(true);
                }
            });
        }
    }
</script>



@endsection
