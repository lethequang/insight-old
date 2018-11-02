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
            <h1 class="page-header text-overflow">Chi tiết khách hàng</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="/"><i class="demo-pli-home"></i></a></li>
            <li class="active"><a href=" {{url('/customer/show-all/')}}">Danh sách khách hàng</a></li>
            <li class="active">{{$data['user']['user_last_name'].' '.$data['user']['user_first_name']}}</li>
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
                            <h4 class=text-lg">Người dùng</h4>
                            <div class="pad-ver">
                                <img src="/assets/img/profile-photos/1.png" class="img-lg img-circle"
                                     alt="Profile Picture">
                            </div>
                            <h4 class="text-lg text-overflow mar-no">{{$data['user']['user_last_name'].' '.$data['user']['user_first_name']}}</h4>
                            <hr class="new-section-xs">
                            <h4 class=text-lg">Trạng thái</h4>
                            <div id="vm_status"
                                 class="label label-success">
                              @if($data['user']['user_status'] == 1)
                                 Đang hoạt động
                              @endif

                            </div>
                            <hr class="new-section-xs">
                            <br>
                            <div class="box-inline mar-rgt">
                                <!--Switchery : Checked by default-->
                                <!--===================================================-->
                                {{--<input id="sw-checkstate" class="switchery switchery-large" type="checkbox" checked>--}}
                                <button id="state-btn" class="btn btn-lg btn-labeled"
                                        data-loading-text="<span class='btn-label'><i class='fa-spin fa fa-superpowers'></i></span>Đang xử lý..."
                                        type="button">

                                </button>
                                <!--===================================================-->
                            </div>

                            <!--Switchery : Checking State Field-->
                            <!--===================================================-->
                            {{--<span id="sw-checkstate-field" class="label label-info text-lg"></span>--}}
                            {{--<button class="btn btn-warning btn-icon btn-group-lg btn-circle icon-3x"><i class="fa fa-power-off"></i></button>--}}
                            <hr>

                        </div>
                    </div>
                    <div class="fluid">

                        <div class="col-md-12">


                            <h5 class="text-uppercase text-muted text-normal">{{$data['user']['user_id']}}</h5>
                            <hr class="new-section-xs">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="list-group bg-trans ">
                                    <a class="list-group-item"><i class="demo-pli-internet icon-fw "></i>
                                        Email: {{$data['user']['user_email']}}</a>
                                    <a class="list-group-item"><i class="demo-pli-old-telephone icon-fw "></i> Số diện
                                        thoại: {{$data['user']['user_phone']}}</a>
                                    <a class="list-group-item"><i class="demo-pli-map-marker-2 icon-fw"></i> Địa
                                        chỉ: {{$data['user']['user_address']}}</a>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="list-group bg-trans mar-no">
                                    <a class="list-group-item"><i class="fa fa-calendar-check-o icon-lg icon-fw"></i>
                                        Ngày tạo: {{$data['user']['user_created_time']}}</a>
                                    <a class="list-group-item"><i class="fa fa-calendar-check-o icon-lg icon-fw"></i>
                                        Ngày cập nhập: {{$data['user']['user_update_time']}}</a>


                                    <a class="list-group-item"><i class="fa fa-paw icon-lg icon-fw"></i> Giới
                                        tính: {{$data['user']['user_gender']}}</a>
                                </div>
                            </div>
                        </div>
                        <hr class="new-section-xs">
                        <!-- Profile Details -->
                        <p class="pad-ver text-main text-sm text-uppercase text-bold">Thông tin máy thuê</p>
                        <div class="row">
                            <div class="col-sm-6">
                                @foreach($data['vms'] as $vms)
                                    <p class="pad-ver text-main text-sm text-uppercase text-bold"> {{$vms['vm_name_show']}}</p>

                                    <p><a href=" {{ url('/fdrive/server/detail/')}}/{{$vms['vm_code']}}"> <i
                                                    class="demo-pli-map-marker-2 icon-fw"></i>
                                            vm_code: {{$vms['vm_code']}}   </a></p>
                                @endforeach
                            </div>
                        </div>
                        <hr class="new-section-xs">
                        <a class="btn btn-info btn-labeled" href=" {{url('/customer/show-all/')}}"><i
                                    class="btn-label fa fa-list-alt"></i> Trở về danh sách khách hàng</a>
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





@endsection
