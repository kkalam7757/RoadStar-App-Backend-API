  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('admin') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        
        <div class="pull-left info">
          <p>RoadStar</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      
         <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="{{ url('home') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>            
          </a> 
        </li>

        <li>
          <a href="{{ action('AdminController\ProviderController@company') }}">
            <i class="fa fa-users"></i> <span>Company</span>            
          </a> 
        </li>

        <li>
          <a href="{{ action('AdminController\ProviderController@driver') }}">
            <i class="fa fa-users"></i> <span>Driver</span>            
          </a> 
        </li>

        <li>
          <a href="{{ action('AdminController\ProviderController@individual') }}">
            <i class="fa fa-user"></i> <span>Individual</span>            
          </a> 
        </li>
      
       <!--         <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Providers</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Categories</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Sub Categories</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Orders</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Slider Images</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Settings</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Logout</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
