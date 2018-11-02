@extends('layouts.master')

@section('header_css')
  <link href="/assets/plugins/themify-icons/themify-icons.min.css" rel="stylesheet">

  <style>
    #content-container {
      background-color: #ecf0f5;
    }
  </style>
@endsection

@section('page-head')
  <div id="page-head">

    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
      <h1 class="page-header text-overflow">Dashboard</h1>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->


    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
      <li><a href="#"><i class="demo-pli-home"></i></a></li>
      <li class="active">Dashboard</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->

  </div>
@endsection
@section('content')

  <div class="row">
    <div class="col-md-3">
      <div class="panel media middle">
        <div class="media-left bg-warning pad-all">
          <i class="ti-server icon-3x"></i>
        </div>
        <div class="media-body pad-all">
          <p class="text-2x mar-no text-semibold"><?php echo $dashboard['totalVms'] ?></p>
          <p class="mar-no">Máy chủ</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel media middle">
        <div class="media-left bg-info pad-all">
          <i class="ti-user icon-3x"></i>
        </div>
        <div class="media-body pad-all">
          <p class="text-2x mar-no text-semibold"><?php echo $dashboard['totalCustomers'] ?></p>
          <p class="mar-no">Khách hàng</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel media middle">
        <div class="media-left bg-success pad-all">
          <i class="ti-server icon-3x"></i>
        </div>
        <div class="media-body pad-all">
          <p class="text-2x mar-no text-semibold"><?php echo $dashboard['totalVmActive'] ?></p>
          <p class="mar-no">Máy chủ đang hoạt động</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel media middle">
        <div class="media-left bg-mint pad-all">
          <i class="ti-server icon-3x"></i>
        </div>
        <div class="media-body pad-all">
          <p class="text-2x mar-no text-semibold"><?php echo $dashboard['totalNewServers'] ?></p>
          <p class="mar-no">Máy chủ tạo trong tháng</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-9">


      <!--Panel with Tabs-->
      <!--===================================================-->
      <div id="dashboard-panel" class="panel">

        <!--Panel heading-->
        <div class="panel-heading">
          <div class="panel-control" style="float: left;">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tabs-dashboard-1" data-toggle="tab">Máy chủ</a></li>
              <li><a href="#tabs-dashboard-2" data-toggle="tab">Khách hàng</a></li>
            </ul>
          </div>
          <div class="panel-control" style="padding-right: 20px">
            <button id="dashboard-refresh" class="btn btn-default btn-active-primary" data-toggle="panel-overlay"
                    data-target="#dashboard-panel"><i class="demo-psi-repeat-2"></i></button>
          </div>
        </div>

        <div class="panel-body">
          <!--Panel body-->
          <div class="tab-content">
            <div class="tab-pane fade active in" id="tabs-dashboard-1">
              <!--Network Line Chart-->
              <!--===================================================-->
              <div id="flot-bar-servers" alt="123" style="width: 100%; height: 250px"></div>
              <!--===================================================-->
              <!--End network line chart-->
            </div>
            <div class="tab-pane fade" id="tabs-dashboard-2">
              <!--Network Line Chart-->
              <!--===================================================-->
              <div id="flot-bar-customers" alt="1233" style="width: 100%; height: 250px;"></div>
              <!--===================================================-->
              <!--End network line chart-->
            </div>
          </div>
        </div>
      </div>
      <!--===================================================-->
      <!--End Panel with Tabs-->


    </div>
    <div class="col-lg-3">
      <div class="row">
        <div class="col-sm-6 col-lg-12">

          <!--Sparkline Area Chart-->
          <div class="panel panel-success panel-colorful">
            <div class="pad-all">
              <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i> HDD Sử dụng</p>
              <p class="mar-no">
                <span class="pull-right text-bold">Unlimited</span> Dung lượng còn trống
              </p>
              <p class="mar-no">
                <span class="pull-right text-bold"><?php echo $dashboard['resourcesUsage']['disk_usage'] ?>Gb</span> Dung lượng đã SD
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-12">

          <!--Sparkline Line Chart-->
          <div class="panel panel-info panel-colorful">
            <div class="pad-all">
              <p class="text-lg text-semibold">Ram Sử dụng</p>
              <p class="mar-no">
                <span class="pull-right text-bold">Unlimited</span> Ram còn trống
              </p>
              <p class="mar-no">
                <span class="pull-right text-bold"><?php echo $dashboard['resourcesUsage']['ram_usage'] ?>Gb</span> Ram đã SD
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-12">

          <!--Sparkline bar chart -->
          <div class="panel panel-purple panel-colorful">
            <div class="pad-all">
              <p class="text-lg text-semibold">Cpu Sử dụng</p>
              <p class="mar-no">
                <span class="pull-right text-bold">Unlimited</span> Số lượng Cpu
              </p>
              <p class="mar-no">
                <span class="pull-right text-bold"><?php echo $dashboard['resourcesUsage']['cpu_usage'] ?>Core</span> Cpu đã SD
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@section('footer_js')

  <!--Flot Chart [ OPTIONAL ]-->
  <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.resize.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.pie.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.categories.min.js') }}"></script>

  <script type="text/javascript">

    $(document).ready(function () {
      $('#dashboard-refresh').niftyOverlay('show');
    });

    async function getDataForChart(url) {
      return await $.get(url).done(function (res) {
        return res;
      });
    }

     // data = [[1, 10], [2, 8], [3, 4], [4, 13], [5, 17], [6, 9], [7, 12], [8, 15], [9, 9], [10, 15]];
    var url = "{!! url('/dashboard/bar-chart-servers') !!}";

    getDataForChart(url).then(function (res) {
      // khởi tạo biểu đồ servers khi load trang.
      var data = JsonToArray(res);
      initBarChart('#flot-bar-servers', data, {'colors': ['#b939c2'], 'tooltipContent': 'Máy chủ'});

      var relTime = setInterval(function () {
        $('#dashboard-refresh').niftyOverlay('hide');
        clearInterval(relTime);
      }, 1000);

    });

    // convert json to array
    function JsonToArray(objects) {
      var data = [];
      var i = 0;
      for (var key in objects) {
        for (var monthName in objects[key]) {
          data[i] = [monthName, objects[key][monthName]]
        }
        i++;
      }
      return data;
    }

    // load biểu đồ khi đổi tab
    $('.nav-tabs a').on('shown.bs.tab', function (event) {
      var element = $(event.target).attr('href');
      var url = "{!! url('/dashboard/bar-chart-servers') !!}";
      var filters = {'colors': ['#b939c2'], 'tooltipContent': 'Máy chủ'};
      if (element === '#tabs-dashboard-2') {
        url = "{!! url('/dashboard/bar-chart-customers') !!}";
        filters = {'colors': ['#00aafb'], 'tooltipContent': 'Khách hàng'};
      }

      var elementChild = $(element).children();

      $('#dashboard-refresh').niftyOverlay('show');
      getDataForChart(url).then(function (res) {
        var data = JsonToArray(res);
        initBarChart(elementChild, data, filters);

        var relTime = setInterval(function () {
          $('#dashboard-refresh').niftyOverlay('hide');
          clearInterval(relTime);
        }, 1000);
      })

    });

    // khởi tạo biểu đồ.
    function initBarChart(el, data, filters) {
      $.plot(el, [data], {
        series: {
          bars: {
            show: true,
            barWidth: 0.5,
            align: 'center',
            fill: true,
            fillColor: {
              colors: [{
                opacity: 0.9
              }, {
                opacity: 0.9
              }]
            }
          }
        },
        colors: filters.colors,
        yaxis: {
          ticks: 5,
          tickColor: 'rgba(0,0,0,.1)'
        },
        xaxis: {
          mode: 'categories',
          tickColor: 'transparent'
        },
        grid: {
          hoverable: true,
          clickable: true,
          tickColor: '#eeeeee',
          borderWidth: 0
        },
        legend: {
          show: true,
          position: 'nw'
        },
        tooltip: {
          show: true,
          content: filters.tooltipContent+ ': %y'
        }
      });
    }

    // hiển thị icon loading khi đổi tab.
    $('#dashboard-refresh').niftyOverlay({
      iconClass: 'demo-psi-repeat-2 spin-anim icon-2x'
    }).on('click', function () {
      var $el = $(this), relTime;

      $el.niftyOverlay('show');

      getDataForChart("{!! url('/dashboard/bar-chart-customers') !!}").then(function (res) {
        var data = JsonToArray(res);
        initBarChart('#flot-bar-customers', data, {'colors': ['#00aafb'], 'tooltipContent': 'Khách hàng'});

        getDataForChart("{!! url('/dashboard/bar-chart-servers') !!}").then(function (res) {
          // khởi tạo biểu đồ servers khi load trang.
          var data = JsonToArray(res);
          initBarChart('#flot-bar-servers', data, {'colors': ['#b939c2'], 'tooltipContent': 'Máy chủ'});

          relTime = setInterval(function () {
            $el.niftyOverlay('hide');
            clearInterval(relTime);
          }, 2000);
        });

      });


    });

  </script>

@endsection
