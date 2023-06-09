<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>COLOR Biznaz | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
 

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print() " style=" font-size: 13px; font-family: arial;">
<?php

$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='customer_rp.php'">	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> COLOR BIZ.
		  
          <small class="pull-right">Date:<?php date_default_timezone_set("Asia/Colombo"); 
	                                                        echo date("Y-m-d____h:ia")  ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
         Week Loan Deta
        <address>
          <strong></strong><br>
          <?php


		  
		  include("connect.php");
				
				
				
				
			
			
			
			?><br>
          <br>
         
        </address>
      </div>
      <!-- /.col -->
      
      
      <!-- /.col -->
    </div>
    <!-- /.row -->
<div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>ORDER ID</th>
				<th>Day</th>
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Amount Balance</th>
				  <th>Total Pay</th>
                  <th>Dela</th>
				   <th>Rate</th>
                  
                </tr>
                </thead>
                <tbody>
				
				
				
				
				
				
				
				
				<?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
				
				$day=$_GET['day'];
				//$d2=$_GET['d2'];
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT * FROM credit_sales_order WHERE   status='incomplete' AND day='$day'  ORDER by sn DESC");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$ord=$row['order_id'];
				
			?>
			
                <tr>
				<td><?php echo $row['order_id'];?></td>
				<td><?php echo $row['day'];?></td>
                  <td><?php echo $row['cus_name'];?></td>
                  <td>Rs.<?php echo $row['amount'];?></td>
                  
                  <td>Rs.<?php 
				  $alf=$row['amount_left'];
				  $i_amount=$row['interest_amount'];
				  
				  if($i_amount<=0){
					 $i_amount=0; 
				  }
				  
				  
				  
				  echo $alf+$i_amount;?>.00</td>
				  <?php
				$result1 = $db->prepare("SELECT sum(amount) FROM sales WHERE   order_id='$ord' AND do='' ");				
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				$int = $row1['sum(amount)'];
				
				}
			?>  
			<td>Rs.<?php echo $int;?></td>
				   <td>Rs.<?php echo $row['dela'];?></td> 
				  <td>Rs.<?php $re=$row['rate'];
				           echo $re;?></td>
				  
				
				 
				   
				   
				  
				  
				  <?php 
				  
				}
				   ?>
                </tr>
               
                
                </tbody>
				
                <tfoot>
                
				
				
				
				 
				
				
                </tfoot>
              </table>
            </div>
    <!-- Table row -->
   
    <!-- /.row -->

   
        </div>
      
      <!-- /.col -->
    
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
