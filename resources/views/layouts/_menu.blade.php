<div id="mainnav-menu-wrap">
  <div class="nano">
    <div class="nano-content">

      <!--Profile Widget-->
      <!--================================-->
      <div id="mainnav-profile" class="mainnav-profile">
        <div class="profile-wrap text-center">
          <div class="pad-btm">

            <img class="img-circle img-md" src="{{ asset('assets/img/profile-photos/1.png') }}" alt="Profile Picture">

          </div>
          <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
            <p class="mnp-name">{{ Auth::user()->username}} </p>
            <span class="mnp-desc">{{ Auth::user()->email}}</span>
          </a>
        </div>
        <div id="profile-nav" class="collapse list-group bg-trans">
         
          @if(Auth::check())
         
          <a href="/users/edit_myself/{{Auth::user()->user_id }}" class="list-group-item">
            <i class="demo-pli-male icon-lg icon-fw"></i> Profile
          </a>
        @endif
         
          <a href="{{ route('logout') }}" class="list-group-item">
            <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
          </a>
        </div>
      </div>


      <!--Shortcut buttons-->
      <!--================================-->
      <div id="mainnav-shortcut" class="hidden">
        <ul class="list-unstyled shortcut-wrap">
          <li class="col-xs-3" data-content="My Profile">
            <a class="shortcut-grid" href="#">
              <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                <i class="demo-pli-male"></i>
              </div>
            </a>
          </li>
          <li class="col-xs-3" data-content="Messages">
            <a class="shortcut-grid" href="#">
              <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                <i class="demo-pli-speech-bubble-3"></i>
              </div>
            </a>
          </li>
          <li class="col-xs-3" data-content="Activity">
            <a class="shortcut-grid" href="#">
              <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                <i class="demo-pli-thunder"></i>
              </div>
            </a>
          </li>
          <li class="col-xs-3" data-content="Lock Screen">
            <a class="shortcut-grid" href="#">
              <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                <i class="demo-pli-lock-2"></i>
              </div>
            </a>
          </li>
        </ul>
      </div>
      <!--================================-->
      <!--End shortcut buttons-->
      <ul id="mainnav-menu" class="list-group">

        <!--Category name-->
        <li class="list-header">Navigation</li>
        <!--Menu list item-->
        <li class="<?= (\Request::is('/')) ? 'active-sub active' : ''; ?>">
          <a href="/">
            <i class="demo-pli-home"></i>
            <span class="menu-title">Trang chủ</span>
            <i class="arrow"></i>
          </a>
        </li>
        @role('super')
        <li
           class="<?= (\Request::is('authorized/*')) ? 'active-sub active' : ''; ?>">
          <a href="#">
            <i class="ion-gear-a"></i>
            <span class="menu-title">Phân quyền</span>
            <i class="arrow"></i>
          </a>

          <!--Submenu-->
          <ul class="collapse">
            <li class="<?= (\Request::is('authorized/show-role-user')) ? 'active-link' : ''; ?>"><a
                 href="{{ url('/authorized/show-role-user') }}">Nhóm thành viên</a></li>
            <li class="<?= (\Request::is('authorized/role/show-role')) ? 'active-link' : ''; ?>"><a
                 href="{{ url('/authorized/role/show-role') }}">Cấp độ truy cập</a></li>
            <li class="<?= (\Request::is('authorized/permission/show-permission')) ? 'active-link' : ''; ?>"><a
                      href="{{ url('/authorized/permission/show-permission') }}">Quyền</a></li>
          </ul>
        </li>
        @endrole

        <!--Menu list item-->
        @permission(['user.show-all', 'user.edit', 'user.add', 'user.trash'])
        <li
           class="<?= (\Request::is('users/*')) ? 'active-sub active' : ''; ?>">
          <a href="#">
            <i class="fa fa-user-circle-o"></i>
            <span class="menu-title">Quản lý thành viên</span>
            <i class="arrow"></i>
          </a>

          <!--Submenu-->
          <ul class="collapse">
            @permission('user.show-all')
            <li class="<?= (\Request::is('users/show-all')) ? 'active-link' : ''; ?>">
              <a href="{{ url('/users/show-all') }}">Danh sách thành viên</a></li>
            @endpermission
            @permission('user.add')
            <li class="<?= (\Request::is('users/add')) ? 'active-link' : ''; ?>">
              <a href="{{ url('/users/add') }}">Thêm thành viên</a></li>
            @endpermission
          </ul>
        </li>
        @endpermission

        <!--Menu list item-->
        <li class="<?= (\Request::is('customer/*')) ? 'active-sub active' : ''; ?>">
          <a href="#">
            <i class="ion-person-stalker"></i>
            <span class="menu-title">Quản lý khách hàng</span>
            <i class="arrow"></i>
          </a>

          <!--Submenu-->
          <ul class="collapse">
            <li class="<?= (\Request::is('customer/show-all')) ? 'active-link' : ''; ?>">
              <a href="{{ url('/customer/show-all') }}">Danh sách khách hàng</a>
              </li>
          </ul>
        </li>

        <!--Menu list item-->
        <li class="<?= (\Request::is('fdrive/*')) ? 'active-sub active' : ''; ?>">
          <a href="#">
            <i class="fa fa-cloud"></i>
            <span class="menu-title">Dịch vụ Fdrive</span>
            <i class="arrow"></i>
          </a>

          <!--Submenu-->
          <ul class="collapse">

            <li class="<?= (\Request::is('fdrive/server/show-all')) ? 'active-link' : ''; ?>">
              <a href="{{ url('/fdrive/server/show-all') }}">Danh sách server</a>
              </li>
          </ul>

          <!--Submenu-->
          <!--<ul class="collapse">
            <li class="<?= (\Request::is('fdrive/server/add')) ? 'active-link' : ''; ?>">
            <a href="{{ url('fdrive/server/add') }}">Tạo mới server</a></li>
          </ul>-->
        </li>
        <li class="<?= (\Request::is('logs/*')) ? 'active-sub active' : ''; ?>">
          <a href="#">
            <i class="fa fa-flash"></i>
            <span class="menu-title">Hệ thống</span>
            <i class="arrow"></i>
          </a>

          <!--Submenu-->
          <ul class="collapse">
            <li class="<?= (\Request::is('logs/show-all')) ? 'active-link' : ''; ?>">
              <a href="{{ url('/logs/show-all') }}">Nhật ký hoạt động</a>
            </li>
          </ul>
        </li>
      </ul>


      <!--Widget-->
      <!--================================-->
      <div class="mainnav-widget">

        <!-- Show the button on collapsed navigation -->
        <div class="show-small">
          <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
            <i class="demo-pli-monitor-2"></i>
          </a>
        </div>

        <!-- Hide the content on collapsed navigation -->
        
      <!--================================-->
      <!--End widget-->

    </div>
  </div>
</div>