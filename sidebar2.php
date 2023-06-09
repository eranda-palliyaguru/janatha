<div class="wrapper">


		  
		  
		  
		  
		  
  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>Biz</span>
      <!-- logo for regular state and mobile devices -->
      <span  class="logo-lg"><b>Color</b>Biz</span>
      
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
			
				
				
				
				
				
				$result = $db->prepare("SELECT count(date) FROM sales WHERE date= :userid  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
				$count=$row['count(date)'];
				}
				
			?>
	  
	  
	  
	  
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-check-square-o"></i>
              <span class="label label-success"><?php echo $count; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $count; ?> Payment</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
				<?php
					
				$result = $db->prepare("SELECT * FROM sales WHERE date= :userid  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
				
				
				
			?>
				
				
				
                  <li>
                    <a href="pay_rp.php?d1=<?php echo $date;?>&d2=<?php echo $date;?>">
                      <i class="fa fa-user text-green"></i> <?php echo $row['name']; ?>
					  
					  </a>
                    
                  </li>
                  <!-- end message -->
                    
				<?php } ?>
					
					
					
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
		  
		  
		  <?php
		  
		include('connect.php');
 date_default_timezone_set("Asia/Colombo");

                  $date =  date("Y/m/d");

		$date1 =  date('Y/m/d',strtotime("-7 days") );


				  
			
				$result = $db->prepare("SELECT * FROM credit_sales_order WHERE ls_date= :userid AND status='incomplete' ");
				$result->bindParam(':userid', $date);
				$result->execute();
				$rowcount123 = $result->rowcount();

				
				
				$result = $db->prepare("SELECT * FROM credit_sales_order WHERE ls_date< :userid AND status='incomplete' AND type='week' ORDER by ls_date ASC ");
				$result->bindParam(':userid', $date1);
				$result->execute();
				$ttre = $result->rowcount();
                $tre=$ttre-$rowcount123;
				
				
				
				$result = $db->prepare("SELECT * FROM credit_sales_order WHERE ls_date< :userid AND status='incomplete' AND type='day' ORDER by ls_date ASC ");
				$result->bindParam(':userid', $date);
				$result->execute();
				$ttre1 = $result->rowcount();
                $tre1=$ttre1-$rowcount123;
				$rv=$tre+$tre1;
				
				
				
				
				$result = $db->prepare("SELECT * FROM credit_sales_order WHERE  ls_date< :userid AND status='incomplete' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
				$rate=$row['cus_name'];
				
				}
			?>
		  
		  
		  
		  
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-credit-card"></i>
              <span class="label label-warning"><?php echo $rv; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $rv; ?> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  
  <?php
		include('connect.php');
 date_default_timezone_set("Asia/Colombo");

                  $date =  date("Y/m/d");					
			
				
				
				
				
				
				$result = $db->prepare("SELECT * FROM credit_sales_order WHERE ls_date< :userid AND status='incomplete' AND type='day' ORDER by sn DESC LIMIT    0, 3 ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
				$rate=$row['cus_name'];
				
				
			?>
                  <li>
                    <a href="delay payment.php?id=day">
                      <i class="fa fa-user text-yellow"></i> <?php echo $row['cus_name']; ?>
                    </a>
                  </li>
				    <?php
				  
				  }
				
			
			
			$result = $db->prepare("SELECT * FROM credit_sales_order WHERE ls_date< :userid AND status='incomplete' AND type='week' ");
				$result->bindParam(':userid', $date1);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
				$rate=$row['cus_name'];
				
				
			?>
                  <li>
                    <a href="delay payment.php?id=week">
                      <i class="fa fa-user text-navy"></i> <?php echo $row['cus_name']; ?>
                    </a>
                  </li>
				    <?php
				  
				  }
				
			?>
                 
				
				  
				  
                </ul>
              </li>
              <li class="footer"><a href="delay payment.php?id=week">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/IMG_1972.JPG" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['SESS_FIRST_NAME'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../../dist/img/IMG_1972.JPG" class="img-circle" alt="User Image">

                <p>    <?php echo $_SESSION['SESS_FIRST_NAME'];?> - <?php echo $_SESSION['SESS_LAST_NAME'];?>
                  <small>Member since Nov. 2012</small>
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
          <img src="../../dist/img/IMG_1972.JPG" class="img-circle" alt="User Image">
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
       
        
       
		
		
		
		
		<?php
		include('connect.php');
 date_default_timezone_set("Asia/Colombo");

                  $date =  date("Y/m/d");					
			
				$result = $db->prepare("SELECT * FROM credit_sales_order WHERE ls_date= :userid AND status='incomplete' ");
				$result->bindParam(':userid', $date);
				$result->execute();
				$rowcount123 = $result->rowcount();

				
				
				$result = $db->prepare("SELECT * FROM credit_sales_order WHERE status='incomplete' ");
				$result->bindParam(':userid', $date);
				$result->execute();
				$ttre = $result->rowcount();
                $tre=$ttre-$rowcount123;
				
				date_default_timezone_set("Asia/Colombo");
				$date=date("Y/m/d");
				$date1=date("Y/m/01");
				$date2=date("Y/m/31");
			?>
		
		
		
		<li>
          <a href="terms.php">
            <i class="fa fa-credit-card"></i> <span>Payment</span>
            <span class="pull-right-container">
			<small class="label pull-right bg-yellow"><?php echo $tre; ?></small>
              <small class="label pull-right bg-red"></small>
              
            </span>
          </a>
        </li>
		
		
		
        <li class="treeview">
          <a href="#">
            <i class="fa fa-line-chart"></i>
            <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  
		  
		  
          <ul class="treeview-menu">
		  
            <li><a href="pay_rp.php?d1=<?php echo $date;?>&d2=<?php echo $date;?>"><i class="fa fa-circle-o text-aqua "></i> Collection Report
            <small class="label pull-right bg-green"><?php echo $rv; ?></small></a></li>
			<li><a href="user_rp.php?d1=<?php echo $date1;?>&d2=<?php echo $date2;?>"><i class="fa fa-circle-o text-aqua "></i> User Report</a></li>
            </a></li>
          </ul>
        </li>
		
		
		
		
		
       
        
            
      </ul>
    </section>