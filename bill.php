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

    th.hed_list {
        border-right: 0px solid;
    }
    </style>
</head>

<body onload="window.print() " style=" font-size: 13px; font-family: 'Poppins';">

    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">

            <?php $job_type=0;
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
        $incom=$row1['in_com_name'];
        $date=$row1['date'];
		}
		//if ($co=="qt"){ $h3="Note:"; $next_km=$row1['comment'];}
                }
                
                
         ?>


            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                <h4 ><?php if ($co=="qt"){ }
           if($co > 0){ echo "INVOICE"; }
           ?></h4>
           <br><br>
           
           For:<b> <?php echo $incom; ?></b>
                </div>
                <!-- /.col -->


                <div class="col-xs-6">
                    
                    <h5 class="pull-right"><b class="pull-right">#<?php echo $_GET['id']; ?></b><br><br>
                        </h5>

                    <table align="right" cellpadding="0" cellspacing="0" border="0" width="70%">

                        <tr>
                            <td align="right" class="hed_list"><b>Date:</b></td>
                            <td align="right" class="hed_list"><?php echo $date; ?></td>
                        </tr>

                        <tr>
                            <td align="right"><?php echo $h1 ?></td>
                            <td align="right"><?php echo $vehicle_no ?></td>
                        </tr>

                        <tr>
                            <td align="right"><?php echo $h2 ?></td>
                            <td align="right"><?php echo $km ?></td>
                        </tr>

                    </table>
                </div>
                <?php if($note==""){}else{ echo "Note:  ".$note; }?>

                <!-- /.col -->
            </div>
            <h4><center><u><?php echo "Estimate For Repairs to Vehicle Number: <i>".$vehicle_no."</i>"; ?></u></center></h4>
            <p>We thank you for your kind inquiries and wish to submit our quotation for your kind consideration.</p>
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
                    <thead style="border: 1px solid; text-align: center;" >
                        <tr >
                            <th style="text-align: center;">#</th>
                            <th style="text-align: center;">Decs</th>
                            <th style="text-align: center;" width="40px">Qty</th>
                            <th style="text-align: center;">Rate</th>

                            <?php
					if($dis_tot>0){
					?>
                            <th>Disc</th>
                            <?php } ?>
                            <th style="text-align: center;">Amount </th>
                            <th style="text-align: center;">Amendment</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr><td></td>
                            <td>
                                <b><u>Supply</u></b>

                            </td>
                            <td></td> <td></td> <td></td> <td></td>

                        </tr>
                        <?php $list_no=1;
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
                            <td style="text-align: center;"><?php echo $list_no ?>.</td>
                            <td width="40%"><?php echo $row['name'];?></td>
                            <td style="text-align: center;"><?php echo $row['qty'];?></td>
                            <td style="text-align: right;"><?php echo number_format($row['price'],2);?></td>

                            <?php
					if($dis_tot>0){
					?>
                            <td><?php echo $row['dic'];?></td>
                            <?php } ?>
                            <td style="text-align: right;">Rs.<?php echo number_format($row['amount'],2);?></td>
                            <?php $tot_amount+= $row['amount']; $tot+=$row['amount'];?>
                            <td></td>
                        </tr>
                        <?php $list_no+=1; } ?>

                        <tr><td></td>
                            <td></td> <td></td> <td></td>
                            <td align="right" style="font-size: 16px;"><b> <u>Rs.<?php echo number_format($tot,2); ?></u></b></td>
                            <td></td>
                        </tr>







                        <tr><td></td>
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
				$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$invo' AND service_type='refit'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$u_to=$row['price']+$row['dic'];
					$u_pri=$u_to/$row['qty'];
			?>
                        <tr>
                        <td style="text-align: center;"><?php echo $list_no ?>.</td>
                            <td width="40%"><?php echo $row['name'];?></td>
                            <td style="text-align: center;"><?php echo $row['qty'];?></td>
                            <td style="text-align: right;"><?php echo number_format($row['price'],2);?></td>
                            <?php
					if($dis_tot>0){
					?>
                            <td><?php echo $row['dic'];?></td>
                            <?php } ?>
                            <td style="text-align: right;">Rs.<?php echo number_format($row['amount'],2);?></td>
                            <?php $tot_amount+= $row['amount']; $tot+=$row['amount'];?>
                            <td></td>
                        </tr>
                        <?php $list_no+=1; } ?>

                        <tr><td></td>
                        <td></td> <td></td> <td></td>
                            <td align="right" style="font-size: 16px;"><b> <u>Rs.<?php echo number_format($tot,2); ?></u></b></td>
                            <td></td>
                        </tr>

                        <tr><td></td>
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
                        <td style="text-align: center;"><?php echo $list_no ?>.</td>
                            <td width="40%"><?php echo $row['name'];?></td>
                            <td style="text-align: center;"><?php echo $row['qty'];?></td>
                            <td style="text-align: right;"><?php echo number_format($row['price'],2);?></td>
                            <?php
					if($dis_tot>0){
					?>
                            <td><?php echo $row['dic'];?></td>
                            <?php } ?>
                            <td style="text-align: right;">Rs.<?php echo number_format($row['amount'],2)?></td>
                            <?php $tot_amount+= $row['amount']; $tot+= $row['amount'];?>
                            <td></td>
                        </tr>
                        <?php $list_no+=1; } ?>






                        <tr><td></td>
                        <td></td> <td></td> <td></td>
                            <td align="right" style="font-size: 16px;"><b> <u>Rs.<?php echo number_format($tot,2); ?></u></b></td>
                            <td></td>
                        </tr>

                        <tr><td></td>
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
                        <td style="text-align: center;"><?php echo $list_no ?>.</td>
                            <td width="40%"><?php echo $row['name'];?></td>
                            <td style="text-align: center;"><?php echo $row['qty'];?></td>
                            <td style="text-align: right;"><?php echo number_format($row['price'],2);?></td>
                            <?php
					if($dis_tot>0){
					?>
                            <td><?php echo $row['dic'];?></td>
                            <?php } ?>
                            <td style="text-align: right;">Rs.<?php echo number_format($row['amount'],2);?></td>
                            <?php $tot_amount+= $row['price']; $tot+=$row['amount'];?>
                            <td></td>
                        </tr>
                        <?php $list_no+=1; } ?>


                        <tr><td></td>
                        <td></td> <td></td> <td></td>
                            <td align="right" style="font-size: 16px;"><b> <u>Rs.<?php echo number_format($tot,2); ?></u></b></td>
                            <td></td>
                        </tr>





                        <td></td>
                        <td>
                                <b><u>Miscellaneous</u></b>
                            </td>
                            <td></td> <td></td> <td></td> <td></td>

                        </tr>
                        <?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$invo=$_GET['id'];
					 $tot=0;
				$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$invo' AND service_type='mis'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$u_to=$row['price']+$row['dic'];
					$u_pri=$u_to/$row['qty'];
			?>
                        <tr>
                        <td style="text-align: center;"><?php echo $list_no ?>.</td>
                            <td width="40%"><?php echo $row['name'];?></td>
                            <td style="text-align: center;"><?php echo $row['qty'];?></td>
                            <td style="text-align: right;"><?php echo number_format($row['price'],2);?></td>
                            <?php
					if($dis_tot>0){
					?>
                            <td><?php echo $row['dic'];?></td>
                            <?php } ?>
                            <td style="text-align: right;">Rs.<?php echo number_format($row['amount'],2);?></td>
                            <?php $tot_amount+= $row['amount']; $tot+=$row['amount'];?>
                            <td></td>
                        </tr>
                        <?php $list_no+=1; } ?>

                        <tr><td></td>
                        <td></td> <td></td> <td></td>
                            <td align="right" style="font-size: 16px;"><b> <u>Rs.<?php echo number_format($tot,2); ?></u></b></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
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
            <h4>SPECIAL NOTE</h4>
            <P>We assure our best service all the time. Waiting for your valuable confirmation</P>
            <b>Thanking You, <br> Yours Faithfully</b> <br><br>

            ----------------------- <br>
            Managing Director
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