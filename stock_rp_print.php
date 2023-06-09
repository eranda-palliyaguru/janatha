<!DOCTYPE html>
<html>
<head>
	<?php
		  include("connect.php");
	

			?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CLOUD ARM | Invoice</title>
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
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='stock_rp.php">	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
			   <div class="col-xs-6">
           <h3>CHAMINDA MOTORS.</h3>
	  <h5>NO.02,Gellisan Rd,Negombo. <br>
	  Authorized Dealer For Yamaha <br>
	  	  BR no- .wv/5468 <br>
	<b>Tel: 031-2221109 </b><br><b>Mobile: 077-3301106 </b><br>	
		  Date:<?php date_default_timezone_set("Asia/Colombo"); 
    echo date("Y-m-d"); echo "  Time-";  echo date("h:ia")  ?>
			</h5>
	  
        </div>
            <div class="box-body">
                         <table id="example1" class="table table-bordered table-striped">

			  

                <thead>

                <tr>

				<th>Product_id</th>

					<th>Code</th>

                  <th>Name</th>
                  <th>Price</th>
				  <th>qty</th>
					<th>Value</th>
                 
				

				  

				

                </tr>

				

                </thead>

				

                <tbody>

				<?php
$tot=0;
   

   $result = $db->prepare("SELECT * FROM product  WHERE qty > '0' ORDER by product_id ASC  ");

				$result->bindParam(':userid', $date);

                $result->execute();

                for($i=0; $row = $result->fetch(); $i++){	

			?>

                <tr class="record" >

				<td><?php echo $id=$row['product_id'];?></td>

			      <td><?php echo $row['code'];?></td>

                  <td><?php echo $row['name'];?></td>  
                  <td>Rs.<?php echo $row['sell'];?></td>
				  <td><?php echo $row['qty'];?></td>
                  <td>Rs.<?php echo $row['qty']*$row['sell'];?></td>
				  

		

				  

				   <?php 

				$tot+=$row['qty']*$row['sell'];

				}

				?>

                </tr>

               

                

                </tbody>

                <tfoot>

                

				

				

				

				

				

				

                </tfoot>

              </table>
<h3>Total Value Rs.<?php echo $tot; ?></h3>
            </div>
				
				
				
				
				
				
				</div></div>
  </section>
</div>
</body>
</html>