<!DOCTYPE html>
<html>
<head>
	<?php
		  include("connect.php");
	

			?>
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
  <!--[if lt IE 9]
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print() " style=" font-size: 13px; font-family: arial;">
<?php
$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='month_end.php'">	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">

            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">

			  

                <thead>

                <tr>

				<th>Model</th>

					<th>M/C no</th>

                  <th>MILAGE</th>

				  <th>F/S</th>
                  <th>W/S</th>
					<th>P/W/S</th>
				

				  

				 

                </tr>

				

                </thead>

				

                <tbody>

				<?php

   $date1=$_GET['d1'];
					$date2=$_GET['d2'];

   $result = $db->prepare("SELECT * FROM sales where action='active' and date BETWEEN '$date1' and '$date2' ORDER by transaction_id ASC  ");

				$result->bindParam(':userid', $date);

                $result->execute();

                for($i=0; $row = $result->fetch(); $i++){	
					
					$id=$row['customer_id'];
					
					$result1 = $db->prepare("SELECT * FROM customer where customer_id ='$id' ORDER by model ASC  ");

				$result1->bindParam(':userid', $id);

                $result1->execute();

                for($i=0; $row1 = $result1->fetch(); $i++){
$type=$row['type'];
			?>

                <tr class="record" >

				<td><?php echo $row1['model'];?></td>

			      <td><?php echo $row1['vehicle_no'];?></td>

                  <td><?php echo $row['km'];?></td>  

				  <td><?php if($type=="Free  Service"){ echo "X"; } ;?></td>
					<td><?php if($type=="Warranty Service"){ echo "X"; } ;?></td>

				  <td><?php if($type=="Normal Service"){ echo "X"; } ;?></td>

				 

                  

                  

				  

				 

				  

				   <?php 
				}
				

				}

				?>

                </tr>

               

                

                </tbody>

                <tfoot>

                

				

				

				

				

				

				

                </tfoot>

              </table>

            </div>
  </section>
</div>
</body>
</html>