<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <?php
        $user=\Illuminate\Support\Facades\Auth::user();
    ?>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("bower_components/admin-lte/dist/img/user2-160x160.jpg")}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $user->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview {{ (Request::is('building/*') ? 'active' : '') }}">
                <a href="#"><i class="fa fa-edit"></i><span>Building</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li {{ (Request::is('building/add') ? 'class=active' : '') }}><a href="{{ url('building/add') }}">Add </a></li>
                    <li {{ (Request::is('building/view') ? 'class=active' : '') }}><a href="{{ url('building/view') }}">View</a></li>
                </ul>

            </li>

            <li class="treeview {{ (Request::is('room/*') ? 'active' : '') }}">
                <a href="#"><i class="fa fa-edit"></i><span>Room</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li {{ (Request::is('room/add') ? 'class=active' : '') }}><a href="{{ url('room/add') }}">Add </a></li>
                    <li {{ (Request::is('room/view') ? 'class=active' : '') }}><a href="{{ url('room/view') }}">View</a></li>
                </ul>

            </li>

            <li class="treeview {{ (Request::is('tenants/*') ? 'active' : '') }}">
                <a href="#"><i class="fa fa-edit"></i><span>Tenants</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li {{ (Request::is('tenants/add') ? 'class=active' : '') }}><a href="{{ url('tenants/add') }}">Add </a></li>
                    <li {{ (Request::is('tenants/view') ? 'class=active' : '') }}><a href="{{ url('tenants/view') }}">View</a></li>
                </ul>

            </li>



        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>