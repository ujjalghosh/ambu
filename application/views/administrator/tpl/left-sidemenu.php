  <?
  $module_slug=$this->uri->segment(3);
  $method_slug=$this->uri->segment(4);
  ?>

  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><? echo $user_name;?></p>
           
        </div>
      </div>
      <!-- search form -->
<!--       <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="  treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="administrator"><i class="fa fa-circle-o"></i> Dashboard</a></li>
           
          </ul>
        </li>


        <li class="treeview <?=$module_slug=='view_map'  ?'menu-open':''?>">
          <a href="#">
            <i class="fa fa-map-marker"></i>
            <span>Map</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="<?=$module_slug=='view_map'   ?'display: block;':''?>">
            <li class="<?=$module_slug=='view_map' ? 'active' : ''; ?>"><a href="administrator/map/view_map"><i class="fa fa-circle-o text-red"></i>Device Map Tracking </a></li>

          </ul>
        </li>


        <li class="treeview <?=$module_slug=='network_users' ?'menu-open':''?>">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="<?=$module_slug=='network_users' ?'display: block;':''?>">
            <li class="<?=$module_slug=='network_users' ? 'active' : ''; ?>"><a href="administrator/users/network_users"><i class="fa fa-circle-o text-red"></i> Users </a></li>
          </ul>
        </li>

        <li class="treeview <?=$module_slug=='email_template' ?'menu-open':''?>">
          <a href="#">
            <i class="fa fa-envelope "></i>
            <span>Email Template</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="<?=$module_slug=='email_template' ?'display: block;':''?>">
            <li class="<?=$module_slug=='email_template' ? 'active' : ''; ?>"><a href="administrator/email_template"><i class="fa fa-circle-o text-red"></i>Email Templates </a></li>
          </ul>
        </li>


       
 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>