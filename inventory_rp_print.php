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
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='inventory_rp.php?d1=<?php echo $_GET['d1']; ?>&d2=<?php echo $_GET['d2']; ?>'">	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">

            <div class="box-body">

           <table id="example1" class="table table-bordered table-striped">
			  
                <thead>
                <tr>
                  <th>Code</th>
				  <th>Name</th>
                  <th>Sell QTY</th>
				  <th>Stock QTY</th>
				
                </tr>
				
                </thead>
				
                              <tbody>
				<?php
   $d1=$_GET['d1'];
   $d2=$_GET['d2'];
   $tot=0;
  
	   
	$result = $db->prepare("SELECT sum(qty), code, name, product_id  FROM sales_list WHERE  action='1' and  date BETWEEN '$d1' AND '$d2' GROUP BY product_id ");
	$result->bindParam(':userid', $res);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
            $co_id = $row['product_id'];
			
				
			?>
                <tr>
				  <td><?php echo $row['code'];?></td>
				  <td><?php echo $row['name'];?></td>
                  
                  <td><?php echo $row['sum(qty)'];?></td>
                  <?php 
    $result1 = $db->prepare("SELECT qty  FROM product WHERE  product_id='$co_id' ");
	$result1->bindParam(':userid', $res);
	$result1->execute();
	for($i=0; $row1 = $result1->fetch(); $i++){ ?>
                  <td><?php echo $row1['qty'];?></td>
                  <?php } ?>
                </tr>
           <?php } ?>    
                
                </tbody>
                <tfoot>
                
				
				
				
				
				
				
                </tfoot>
              </table>
				<div class="row">
<center>
					</center>
				</div></div>
  </section>
</div>
</body>
</html>