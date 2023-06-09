<div class="wrapper">
 
		  
		  
  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>ARM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">CLOUD<b> ARM</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

	  
	  
	   <?php
		include('connect.php');
 date_default_timezone_set("Asia/Colombo");
                  $date =  date("Y/m/d");						
				$count=0;	
			?>
	  
	  
	  
	  
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->

          <!-- Notifications: style can be found in dropdown.less -->
		  
		  
		  <?php
		  
		include('connect.php');
 date_default_timezone_set("Asia/Colombo");
                  $date =  date("Y/m/d");		
				$rowcount123 = 0;			
				$ttre = 0;
                //$tre=$ttre-$rowcount123;
				$rv=0;
				$rate=0;				
			?>
  

          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">

              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['SESS_FIRST_NAME'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>    <?php echo $_SESSION['SESS_FIRST_NAME'];?> - <?php echo $_SESSION['SESS_LAST_NAME'];?>
                  <small>Member since Nov. 2023</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href=" ../../../index.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
		
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['SESS_FIRST_NAME'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
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
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
		  
		  
		  
		<li>
          <a  href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
			
            </span>
          </a>
        </li> 
		  
		  <?php if($_SESSION['SESS_FIRST_NAME']=="Mr.Chaminda"){ ?>
		  <li>
          <a  href="stock.php">
            <i class="fa fa-cubes"></i> <span>Stock</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
		  
		   <li>
          <a  href="stock_up.php">
            <i class="fa fa-cubes"></i> <span>Stock Update</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
		  
		  <li>
          <a  href="stock_re.php">
            <i class="fa fa-cubes"></i> <span> Re Order Stock</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
		  
		  
		  <li class="treeview">
          <a href="#">
            <i class="fa fa-line-chart"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
           </span>
        </a>
          <ul class="treeview-menu">
        
		<li><a href="stock_up_rp.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>"><i class="fa fa-circle-o text-yellow"></i> Stock up Report</a></li>
           
          </ul>
        </li>
		  
		  <?php }else{ ?>
		  
		  
		  
		  <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i> <span>Customer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
           </span>
        </a>
          <ul class="treeview-menu">
            <li><a href="cus.php"><i class="fa fa-circle-o text-yellow"></i> Add customer</a></li>
            <li><a href="cus_view.php"><i class="fa fa-circle-o text-aqua"></i> View customer</a></li>
          </ul>
        </li>
		   <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i> <span>Product & Service</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
           </span>
        </a>
          <ul class="treeview-menu">
            <li><a href="product.php"><i class="fa fa-circle-o text-yellow"></i> Add Product</a></li>
            <li><a href="product_view.php"><i class="fa fa-circle-o text-aqua"></i> View Product</a></li>
          </ul>
        </li>
		<li>
          <a  href="sales1.php">
            <i class="fa fa-file-text-o"></i> <span>Sales</span>
            <span class="pull-right-container">
			
            </span>
          </a>
        </li>
		 
		  
		  <li>
          <a  href="sales.php?id=qt<?php echo date("ymdhis");?>">
            <i class="fa fa-file-text-o"></i> <span>Quotations</span>
            <span class="pull-right-container">
			
            </span>
          </a>
        </li>
        
        <li>
          <a  href="package.php">
            <i class="fa fa-tags"></i> <span>Package and Promotion</span>
            <span class="pull-right-container">
			
            </span>
          </a>
        </li>
		  
		  <li>
          <a  href="expenses.php">
            <i class="fa fa-dollar"></i> <span>Expenses</span>
            <span class="pull-right-container">
			
            </span>
          </a>
        </li>
		  <li>
          <a  href="stock.php">
            <i class="fa fa-cubes"></i> <span>Stock</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
		  
		  
	    <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i> <span>Supplier</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
          <ul class="treeview-menu">
             <li><a href="sales.php?id=pu<?php echo date("ymdhis");?>"><i class="fa fa-circle-o text-yellow"></i>GRN</a></li>
            <li><a href="supplier.php"><i class="fa fa-circle-o text-yellow"></i>Supplier</a></li>
            <li><a href="supplier_payment.php"><i class="fa fa-circle-o text-red"></i>Supplier payment</a></li>
          </ul>
        </li>
		  
		  

		  
		  <li class="treeview">
          <a href="#">
            <i class="fa fa-line-chart"></i> <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
           </span>
        </a>
          <ul class="treeview-menu">
            <li><a href="sales_rp.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>"><i class="fa fa-circle-o text-red"></i> Sales Report</a></li>
			  
	<li><a href="purchases_rp.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>"><i class="fa fa-circle-o text-yellow"></i> Purchases Report</a></li>
  <li><a href="pnl_rp.php?d1=<?php echo date("Y-m");?>-01&d2=<?php echo date("Y-m");?>-31"><i class="fa fa-circle-o text-yellow"></i> PNL Report</a></li>
	<li><a href="inventory_rp.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>"><i class="fa fa-circle-o text-yellow"></i> Inventory Report</a></li>
		<li><a href="sms_rp.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>"><i class="fa fa-circle-o text-yellow"></i> SMS Report</a></li>
		<li><a href="stock_up_rp.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>"><i class="fa fa-circle-o text-yellow"></i> Stock up Report</a></li>
			  
<li><a href="stock_rp.php"><i class="fa fa-circle-o text-yellow"></i> Stock Value Report</a></li>
			  
            <li><a href="month_end.php"><i class="fa fa-circle-o text-yellow"></i> Quotation Report</a></li>
<li><a href="tech_com.php"><i class="fa fa-circle-o text-yellow"></i> Mechanic Share Report</a></li>
          </ul>
        </li>
		  
          </ul>
        </li> 
        
        <?php } ?>
      </ul>
    </section>