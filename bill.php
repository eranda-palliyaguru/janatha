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
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
    body {
        font-family: 'Poppins';
    }

    @media print {
        td.cs {
            background-color: #737373 !important;
            color: #eee !important;
        }
    }

    table.list{
        border: 1px solid;
        
    }
    th:not(:last-child), td:not(:last-child) { border-right: 1px solid; }
    </style>
</head>

<body onload="window.print() " style=" font-size: 13px; font-family: 'Poppins';">

    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">

            <?php
           $invo=$_GET['id'];	
		   $result1 = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
		   $result1->bindParam(':userid', $date);
           $result1->execute();
           for($i=0; $row1 = $result1->fetch(); $i++){ $cus_name= $row1['customer_name']; 
                    
                $job_no=$row1['job_no'];
                $email=$row1['email'];
                $note=$row1['comment'];
		
		$result = $db->prepare("SELECT * FROM job WHERE  id='$job_no'  ");
		$result->bindParam(":userid", $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){ $job_type=$row['job_type']; }
		
		
		if($job_type==1){
		$h1="Vehicle no:";
		$h2="Mileage:";
		$h3="Next Service:";
		$vehicle_no=$row1['vehicle_no'];
		$km=$row1['km']." Km";
		$next_km=$row1['plus_km']+$row1['km']." Km";
		}else{
		$h1="Vehicle no:";
		$h2="Model:";
		$h3="";
		$vehicle_no=$row1['vehicle_no'];
		$km=$row1['model'];
		$next_km=" ";
		}
		//if ($co=="qt"){ $h3="Note:"; $next_km=$row1['comment'];}
                }
                
                
         ?>


            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <img src="bill.jpeg" width="145" alt="">
                    <h5> <b>JANATHA MOTORS</b></h5>
                    <p>52/B/1, 10th Mile Post, <br>
                        Katuwawala, <br>
                        Boralasgauwa <BR>
                        <br>
                        Call: 0112 150 400<br>
                        E-mail: startupautoare@gmail.com<br><br>
                        Bill To:<br>
                        <?php echo $cus_name; ?>

                    </p>
                </div>
                <!-- /.col -->





                <div class="col-xs-6">
                    <h1 class="pull-right"><?php if ($co=="qt"){ echo "Quotation";}
           if($co > 0){ echo "INVOICE"; }
           ?></h1>
                    <h5 class="pull-right"><b class="pull-right">#<?php echo $_GET['id']; ?></b><br><br>
                        Date:<?php date_default_timezone_set("Asia/Colombo"); 
    echo date("Y-m-d"); echo "  Time-";  echo date("h:ia")  ?></h5>

                    <table align="right" cellpadding="0" cellspacing="0" border="0" width="70%">
                        <tr>
                            <td align="right"><?php echo $h1 ?></td>
                            <td align="right"><?php echo $vehicle_no ?></td>
                        </tr>

                        <tr>
                            <td align="right"><?php echo $h2 ?></td>
                            <td align="right"><?php echo $km ?></td>
                        </tr>

                        <tr>
                            <td align="right"><?php echo $h3 ?></td>
                            <td align="right"><?php echo $next_km ?></td>
                        </tr>
                    </table>
                </div>
                <?php if($note==""){}else{ echo "Note:  ".$note; }?>

                <!-- /.col -->
            </div>
            <?php
  			  $invo=$_GET['id'];
					$tot_amount=0;
				$result = $db->prepare("SELECT sum(dic) FROM sales_list WHERE   invoice_no='$invo'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$dis_tot=$row['sum(dic)'];
				}
  ?>
            <div class="box-body">
                <table style="width:100%;" class="list">
                    <thead style="border: 1px solid;">
                        <tr >

                            <th>Decs</th>
                            <th width="40px">Qty</th>
                            <th>Rate</th>

                            <?php
					if($dis_tot>0){
					?>
                            <th>Disc</th>
                            <?php } ?>
                            <th style="text-align: right;">Amount </th>
                            <th style="text-align: right;">Amendment</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                <b><u>Supply</u></b>

                            </td>
                            <td></td> <td></td> <td></td> <td></td>

                        </tr>
                        <?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$invo=$_GET['id'];
					$tot_amount=0; $tot=0;
				$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$invo' AND service_type='Supply'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$u_to=$row['price']+$row['dic'];
					$u_pri=$u_to/$row['qty'];
			?>
                        <tr>
                            <td width="40%"><?php echo $row['name'];?></td>
                            <td style="text-align: center;"><?php echo $row['qty'];?></td>
                            <td style="text-align: center;"><?php echo $row['price'];?></td>

                            <?php
					if($dis_tot>0){
					?>
                            <td><?php echo $row['dic'];?></td>
                            <?php } ?>
                            <td style="text-align: right;">Rs.<?php echo $row['amount'];?></td>
                            <?php $tot_amount+= $row['amount']; $tot+=$row['amount'];?>
                            <td></td>
                        </tr>
                        <?php } ?>













                        <tr>
                            <td></td> <td></td> <td></td>
                            <td align="right" style="font-size: 18px;"><b>Rs.<?php echo $tot; ?></b></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>
                                <b><u>Remove & Refitting</u></b>
                            </td>
                            <td></td> <td></td> <td></td> <td></td>

                        </tr>
                        <?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$invo=$_GET['id'];
					 $tot=0;
				$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$invo' AND service_type='ReReFit'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$u_to=$row['price']+$row['dic'];
					$u_pri=$u_to/$row['qty'];
			?>
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td style="text-align: center;"><?php echo $row['qty'];?></td>
                            <td style="text-align: center;"><?php echo $row['price'];?></td>
                            <?php
					if($dis_tot>0){
					?>
                            <td><?php echo $row['dic'];?></td>
                            <?php } ?>
                            <td style="text-align: right;">Rs.<?php echo $row['price'];?></td>
                            <?php $tot_amount+= $row['amount']; $tot+=$row['amount'];?>
                            <td></td>
                        </tr>
                        <?php } ?>







                        <tr>
                        <td></td> <td></td> <td></td>
                            <td align="right" style="font-size: 18px;"><b>Rs.<?php echo $tot; ?></b></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>
                                <b><u>Repair</u></b>
                            </td>
                            <td></td> <td></td> <td></td> <td></td>

                        </tr>
                        <?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$invo=$_GET['id'];
					 $tot=0;
				$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$invo' AND service_type='Repair'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$u_to=$row['price']+$row['dic'];
					$u_pri=$u_to/$row['qty'];
			?>
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td style="text-align: center;"><?php echo $row['qty'];?></td>
                            <td style="text-align: center;"><?php echo $row['price'];?></td>
                            <?php
					if($dis_tot>0){
					?>
                            <td><?php echo $row['dic'];?></td>
                            <?php } ?>
                            <td style="text-align: right;">Rs.<?php echo $row['price'];?></td>
                            <?php $tot_amount+= $row['amount']; $tot+= $row['amount'];?>
                            <td></td>
                        </tr>
                        <?php } ?>






                        <tr>
                        <td></td> <td></td> <td></td>
                            <td align="right" style="font-size: 18px;"><b>Rs.<?php echo $tot; ?></b></td>
                            <td></td>
                        </tr>

                        <tr>
                            <th>
                                <b><u>Paint</u></b>
                                <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </th>
                            

                        </tr>
                        <?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$invo=$_GET['id'];
					 $tot=0;
				$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$invo' AND service_type='Paint'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$u_to=$row['price']+$row['dic'];
					$u_pri=$u_to/$row['qty'];
			?>
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td style="text-align: center;"><?php echo $row['qty'];?></td>
                            <td style="text-align: center;"><?php echo $row['price'];?></td>
                            <?php
					if($dis_tot>0){
					?>
                            <td><?php echo $row['dic'];?></td>
                            <?php } ?>
                            <td style="text-align: right;">Rs.<?php echo $row['price'];?></td>
                            <?php $tot_amount+= $row['price']; $tot+=$row['amount'];?>
                            <td></td>
                        </tr>
                        <?php } ?>


                        <tr>
                        <td></td> <td></td> <td></td>
                            <td align="right" style="font-size: 18px;"><b>Rs.<?php echo $tot; ?></b></td>
                            <td></td>
                        </tr>


                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>

                </table>
                <br><br>
                <?php
				$result1 = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'  ");		
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				//$tot_amount=$row1['amount'];
					$balance=$row1['balance'];
				}
			?>
                <div class="col-xs-5 pull-right" style="font-size: 25px;">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4 class="pull-right">Total</h4>
                        </div>
                        <div class="col-xs-6">
                            <h4><b class="pull-right">Rs.<?php echo number_format($tot_amount,2); ?></b> </h4>

                        </div>
                    </div>
                    <?php if ($co>0){ ?>
                    <div class="row">
                        <div class="col-xs-6">
                            <p class="pull-right">Pay Amount</p>
                        </div>
                        <div class="col-xs-6">
                            <p class="pull-right">Rs.<?php echo number_format($tot_amount+$balance,2); ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <p class="pull-right">Balance:</p>
                        </div>
                        <div class="col-xs-6">
                            <p class="pull-right">Rs.<?php echo number_format($balance,2); ?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>




            </div>
            <center>
                <br><br><br><br>
                <img src="img/cloud arm name.svg" width="100" alt="">
            </center>



    </div>
    </section>
    <?php
$sec = "1";
?>
    <meta http-equiv="refresh"
        content="<?php echo $sec;?>;<?php if($email==1){echo "URL='email_invoice/email.php?id=".$invo."'";}else{echo "URL='index.php'";} ?>">
    </div>
</body>

</html>