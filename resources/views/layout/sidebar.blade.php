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
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ (Request::is('home') ? 'active' : '') }}">
                <a href="{{ url('home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview {{ (Request::is('account/*') ? 'active' : '') }}">
                <a href="#"><i class="fa fa-edit"></i><span>Account</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li {{ (Request::is('account/deposit') ? 'class=active' : '') }}><a href="{{ url('account/deposit') }}"><i class="fa fa-sign-in"></i> Deposit </a></li>
                    <li {{ (Request::is('account/withdraw') ? 'class=active' : '') }}><a href="{{ url('account/withdraw') }}"> <i class="fa fa-sign-out"></i> Withdraw</a></li>
                    <li {{ (Request::is('account/transfer') ? 'class=active' : '') }}><a href="{{ url('account/transfer') }}"><i class="fa  fa-credit-card"></i> Transfer</a></li>
                    <li {{ (Request::is('account/statement') ? 'class=active' : '') }}><a href="{{ url('account/statement') }}"><i class="fa fa-list-alt"></i> Statement</a></li>
                </ul>

            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>