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
    </style>
</head>

<body onload="window.print() " style=" font-size: 13px; font-family: 'Poppins';">

    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">

            <?php
            function AddPlayTime($times) {
                $minutes = 0; //declare minutes either it gives Notice: Undefined variable
                // loop throught all the times
                foreach ($times as $time) {
                    list($hour, $minute) = explode('.', $time);
                    $minutes += $hour * 60;
                    $minutes += $minute;
                }
            
                $hours = floor($minutes / 60);
                $minutes -= $hours * 60;
            
                // returns the time already formatted
                return sprintf('%02d.%02d', $hours, $minutes);
              
            }

            function TimeSet($times) {
                
                list($hour, $minute) = explode('.', $times);
                $minutes=$minute+$hour*60;
            
               return $minutes/60;
            }


           $id=$_GET["id"];
           $d1=$_GET['year'].'-'.$_GET['month'].'-01';
           $d2=$_GET['year'].'-'.$_GET['month'].'-31';  $h=0;$m=0;
           $result = $db->prepare("SELECT work_time,ot FROM attendance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
           $result->bindParam(':userid', $date);
           $result->execute();
           for($i=0; $row = $result->fetch(); $i++){ 
               $hour[]=$row['work_time'];
               $ot[]=$row['ot'];
           }

           $result = $db->prepare("SELECT count(id) FROM attendance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
           $result->bindParam(':userid', $date);
           $result->execute();
           for($i=0; $row = $result->fetch(); $i++){ 
               $day=$row['count(id)'];
           }

           $result = $db->prepare("SELECT * FROM Employees WHERE id='$id' ");
           $result->bindParam(':userid', $date);
           $result->execute();
           for($i=0; $row = $result->fetch(); $i++){ 
               $name=$row['name'];
               $rate=$row['hour_rate'];
               $epf=$row['epf_amount'];
           }

           $result = $db->prepare("SELECT sum(amount) FROM salary_advance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
           $result->bindParam(':userid', $date);
           $result->execute();
           for($i=0; $row = $result->fetch(); $i++){$adv=$row['sum(amount)'];}
         ?>


            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <h2><?php echo $name; ?></h2>
                    <h3><?php echo $_GET['year'].'-'.$_GET['month'] ?></h3>
                </div>
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

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>ATTENDANCE DAYS</td>
                                <td><?php echo $day; ?></td>
                            </tr>
                            <tr>
                                <td>Work Hours</td>
                                <td><?php echo $hour=AddPlayTime($hour); ?></td>
                            </tr>
                            <tr>
                                <td>Hour Rate</td>
                                <td>Rs.<?php echo $rate; ?></td>
                            </tr>
                            <tr style="font-size: 16px; color:#2E86C1">
                                <td>GROSS PAY</td>
                                <td>Rs.<?php echo number_format($basic =$rate*TimeSet($hour),2); ?></td>
                            </tr>
                            <tr>
                                <td>Overtime</td>
                                <td><?php echo $ot=AddPlayTime($ot); ?></td>
                            </tr>

                            <tr style="font-size: 16px; color:#2E86C1">
                                <td>OT</td>
                                <td>Rs.<?php echo $ot_tot=($rate * 142.86)/100 * TimeSet($ot); ?></td>
                            </tr>

                            <tr>
                                <td>Advance</td>
                                <td>Rs.<?php echo $adv; ?></td>
                            </tr>
                            <tr>
                                <td>EPF</td>
                                <td>Rs.<?php echo $epf; ?></td>
                            </tr>

                            <tr style="font-size: 20px; color:#2E86C1">
                                <td>Balance Pay</td>
                                <td>Rs.<?php echo ($ot_tot+$basic)-$epf-$adv ?></td>
                            </tr>
                        </table>
                    </div>


                </div>

<div>
                <div class="pull-right" style="width: 48%; ">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Salary Advance List</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Note</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    <?php
                                   $result = $db->prepare("SELECT * FROM salary_advance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
				                   $result->bindParam(':userid', $date);
                                   $result->execute();
                                   for($i=0; $row = $result->fetch(); $i++){
                                  ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['date']?></td>
                                        <td>Rs.<?php echo $row['amount'];?></td>
                                        <td><?php echo $row['note'];?></td>

                                        <?php	} ?>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th>Rs.<?php echo number_format($adv,2); ?></th>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>


                <div style="width:48%;">
                    <?php if(isset($_GET['id'])){ ?>
                    <div class="box box-warning">
                        <div class="box-header">
                            <h3 class="box-title">Attendance List</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>IN</th>
                                        <th>OUT</th>
                                        <th>W time</th>
                                        <th>OT</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    <?php
                            $result = $db->prepare("SELECT * FROM attendance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
				            $result->bindParam(':userid', $date);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){
                                ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['date']?></td>
                                        <td><?php echo $row['IN_time'];?></td>
                                        <td><?php echo $row['OUT_time'];?></td>
                                        <td><?php echo $row['work_time']; ?></td>
                                        <td><?php echo $row['ot']; ?></td>

                                        <?php	} ?>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><?php echo $hour; ?></th>
                                    <th><?php echo $ot ?></th>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <?php } ?>
                    <!-- /.box -->
                </div>
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
    <meta http-equiv="refresh" content="<?php echo $sec;?>;URL='hr_payroll.php">
    </div>
</body>

</html>