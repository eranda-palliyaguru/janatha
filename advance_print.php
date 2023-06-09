<!DOCTYPE html>
<html>
<head>
	<?php
		  include("connect.php");
	
	$invo = $_GET['id'];
	$co = substr($invo,0,2) ;
			?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CLOUD ARM </title>
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
  <!--[if lt IE 9]
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print() " style=" font-size: 13px; font-family: arial;">
<?php
$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='sales1.php'">	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
	  
	  
	  
	  
	  <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-7">
        <img src="RHN Logo.jpg" width="145" alt="">
         <h5> <b>RHN TRADING COMPANY (PVT) LTD</b></h5>
         <p>NO. 325/6, PAHALA BOMITIYA <BR>
         KADUWELA<br> <br>
         Mobile: 070-7485485<br>
         E-mail: info@rhntrading.com<br>
         www.rhntrading.com <br><br>

         </p>
        </div>
        <!-- /.col -->
		  
		  
		  
        <div class="col-xs-4">
        <h1 class="pull-right"><?php if ($co=="qt"){ echo "Quotation";}
           if($co > 0){ echo "PAYMENT"; }
           ?></h1>
           <h5 class="pull-right"><b class="pull-right">#<?php echo $_GET['id']; ?></b><br><br>
           		  Date:<?php date_default_timezone_set("Asia/Colombo"); 
    echo date("Y-m-d"); echo "  Time-";  echo date("h:ia")  ?></h5>
        <h5 class="pull-right">
		  <?php  
		  if ($co>0){
		 
			   $invo=$_GET['id'];	
				$result = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$mechanic_id=$row['mechanic_id'];
					
					$kmm=$row['km'];
					$kmplus=2000;
					if($kmm<1800){$kmplus=1400;}
					if($kmm<580){$kmplus=1100;}
					
					
					
					
					
				echo "<b>Vehicle No: </b>".$row['vehicle_no'];
					echo "<br>";

					
				}
			  $result = $db->prepare("SELECT * FROM mechanic WHERE   id='$mechanic_id'");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				echo "<b>Mechanic: </b>".$row['name'];
					echo "<br></h6></b>";
				}
			  
			  }   ?>
			</h5></div>
        <!-- /.col -->
		 
		  <?php  
			  
			  $invo=$_GET['id'];
					$tot_amount=0;
				$result1 = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'  ");		
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				    $tot_amount=$row1['amount'];
				    $balance=$row1['balance'];
					$advance=$row1['advance'];
					$advance_type=$row1['advance_type'];
				}
			  
			  
			  ?>
			  
      </div>
  
<div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>ID</th>
				<th>Decs</th>
				<th>Payment Type</th>
                  <th>Amount </th>
                </tr>
                </thead>
                <tbody>

                <tr>
				<td>0001</td>
                  <td>Advance Payment</td>
                  <td><?php echo $advance_type;?></td>
					<td><?php echo $advance;?></td>
                 </tr>
                </tbody>
              </table>
  
	<div class="col-xs-6">
         
          <div class="table-responsive">
            <table class="table">
			<tr>
                <th>Bill Amount</th>
                <td>Rs.<?php echo $tot_amount; ?>.00</td>
              </tr>
			  <tr>
                <th>Pay Amount</th>
                <td>Rs.<?php echo $advance; ?>.00</td>
              </tr>
              <tr>
                <th>Balance:</th>
                <td>Rs.<?php echo $tot_amount-$advance; ?></td>
              </tr>
            </table>
          </div>
        </div>
	
            </div><br><br><br><br>
	 <small class="pull-right"><img src="img/cloud arm 2.png" width="60" alt=""> <br> CLOUD ARM</small>
	
        </div>
	  __________________ <br> DEALER SIGNATURE
  </section>
</div>
</body>
</html>