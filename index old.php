<!DOCTYPE html>

<html>

<?php 

include("head.php");
include("connect.php");

?>

	
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
	

	
$(document).ready(function(){
	setInterval(function(){
		$("#job_cancel").load('index_cancel_appr.php')
    }, 50000);
});
	
</script>
	
	
<body class="hold-transition skin-blue sidebar-mini">

<?php 

include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];
if($r =='mechanic'){
header("location: job.php");
}
if($r =='admin'){
include_once("sidebar.php");
}
//header("location: 404.php");

?>





    <!-- /.sidebar -->

  </aside>



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Home

        <small>Preview</small>

      </h1>

      

    </section>



    <!-- Main content -->

    <section class="content">



	

	

	<?php

		include('connect.php');

 date_default_timezone_set("Asia/Colombo");

 $cash=$_SESSION['SESS_FIRST_NAME'];



                  $date =  date("Y-m-d");					

			

				$result = $db->prepare("SELECT sum(profit) FROM sales WHERE action='active' AND  date='$date' ");

				

					$result->bindParam(':userid', $date);

                $result->execute();

                for($i=0; $row = $result->fetch(); $i++){

				  

				  $profit=$row['sum(profit)'];

				}

				







$result = $db->prepare("SELECT sum(amount) FROM sales WHERE  action='active' AND  date='$date'  ");

				

					$result->bindParam(':userid', $date);

                $result->execute();

                for($i=0; $row = $result->fetch(); $i++){

				  

				  $amount=$row['sum(amount)'];

				}		
				$result = $db->prepare("SELECT sum(amount) FROM sales WHERE  action='active' AND  date='$date' AND customer_name='Unknown customer' ");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				  $dr_amount=$row['sum(amount)'];

				}	

$result = $db->prepare("SELECT sum(amount) FROM expenses_records WHERE  date = '$date' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$ex=$row['sum(amount)'];
				}


		$month1=date("Y-m-01");
		$month2=date("Y-m-31");
		
		$result = $db->prepare("SELECT * FROM model ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$model_name=$row['name'];
					$model_id=$row['id'];
				
				$result1 = $db->prepare("SELECT sum(amount) FROM sales WHERE  model='$model_name' AND  date BETWEEN '$month1' AND '$month2' ");
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				  $model_amount=$row1['sum(amount)'];
				}
$sql = "UPDATE model 
        SET amount=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($model_amount,$model_id));
				
				}
		
		
		$result1 = $db->prepare("SELECT sum(amount) FROM model ");
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				  $month_amount=$row1['sum(amount)'];
				}
		date_default_timezone_set("Asia/Colombo");
		$date=date("Y-m-d");
		$result = $db->prepare("SELECT count(id) FROM job WHERE  date='$date' ORDER by id DESC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$job_count=$row['count(id)'];	
				}
		
		
		
		

				

				$date=date("Y-m-d");

			?>

	

	

	

	

	

	 <div class="row">

	 

	 

	 

	 

	 <?php     $r=$_SESSION['SESS_LAST_NAME'];



if($r =='Cashier'){

	?>

	

<?php }



else{

 ?>

	 

	 

	 

	 

        <div class="col-lg-3 col-xs-6">

          <!-- small box -->

          <div class="small-box bg-aqua">

            <div class="inner">

              <h3>Rs.<?php echo $amount; ?></h3>



              <p>Total Sales</p>

            </div>

            <div class="icon">

              <i class="ion ion-pie-graph"></i>

            </div>

            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

          </div>

        </div>

        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">

          <!-- small box -->

          <div class="small-box bg-green">

            <div class="inner">

              <h3>Rs.<?php echo $ex; ?></sup></h3>



              <p>Expenses Total </p>

            </div>

            <div class="icon">

              <i class="ion ion-stats-bars"></i>

            </div>

            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

          </div>

        </div>

        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">

          <!-- small box -->

          <div class="small-box bg-yellow">

            <div class="inner">

              <h3>Rs.<?php echo $dr_amount; ?></h3>



              <p>Shop Sales</p>

            </div>

            <div class="icon">

              <i class="ion ion-person-add"></i>

            </div>

            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

          </div>

        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $job_count; ?></h3>



              <p>Total Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-hammer"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

      </div>

	<?php 

}

 ?>

	<div id="job_cancel"></div>  
	  
	  
<div class="row">
	
	
		<div class="col-md-12">
 <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest JOB Orders <a href="job_add.php" class="btn btn-info">Add new Job</a></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
	
            <!-- /.box-header -->
            





<div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
					  <th >No.</th>
                    <th >Vehicle No.</th>
                    <th >Mileage</th>
                    <th>Time</th>
					  <th>Type</th>
					  <th>Customer</th>
					  <th>Phone no</th>
					  <th>Bill</th>
					  <th>#</th>
                   
                  </tr>
                  </thead>
                  <tbody>
					  <?php 
					  date_default_timezone_set("Asia/Colombo");
					  include("connect.php");
					  
		$result = $db->prepare("SELECT * FROM job WHERE type='active' AND ramp='wash' ORDER by id ASC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$wid2=$row['id'];
				$wash_time1=$row['wash_time'];
				
$time_now=date("H.i");
$date1 = new DateTime($time_now);
$date2 = $date1->diff(new DateTime($wash_time1));

$h=$date2->h;
$m=$date2->i;

if($h>0){$m=$h*60+$m;}

if($m>29){
$sql = "UPDATE job 
        SET wash_time=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($time_now,$wid2));

$drying="Drying";	
$sql = "UPDATE job 
        SET ramp=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($drying,$wid2));
					}
				}
					  $ramp="";
					  $tot_bill=0;
					  $job_no=0;
					  $mechanic_id=0;
			$result = $db->prepare("SELECT * FROM job WHERE type='active' and category='' ORDER by id DESC LIMIT 17 ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$now_job_id=$row['id'];
					$wash_id=$row['washer_id'];
					$mechanic_id=$row['mechanic_id'];
					$date=$row['date'];
					$ramp=$row['ramp'];
					$job_type=$row['job_type'];
					
		$resultm = $db->prepare("SELECT * FROM mechanic WHERE ramp = '$ramp' ");
		$resultm->bindParam(':userid', $res);
		$resultm->execute();
		for($i=0; $rowm = $resultm->fetch(); $i++){
		$rname = $rowm['name'];	
		}
		
			
					
					
					$job_no+=1;
					$color_ramp="maroon"; $info="Waiting";
					if($ramp==""){ $color_ramp="maroon"; $info="Waiting"; }
					if($ramp>0){ $color_ramp="red"; $info=$rname; }
					if($ramp=="wash"){ $color_ramp="blue"; $info="Washing"; }
					if($ramp=="Drying"){ $color_ramp="yellow"; $info="Drying"; }
					
					
					if($job_type==1){ $type_color="red"; $type_info="Full Service"; }
					if($job_type==2){ $type_color="green"; $type_info="1st Free Service"; }
					if($job_type==7){ $type_color="green"; $type_info="2nd Free Service"; }
					if($job_type==6){ $type_color="green"; $type_info="Accident"; }
					if($job_type==3){ $type_color="yellow"; $type_info="Repair"; }
					if($job_type==4){ $type_color="aqua"; $type_info="Echo Test"; }
					if($job_type==5){ $type_color="blue"; $type_info="Body Wash"; }
					
					
					$date1=date("Y-m-d");
					if($date==$date1){
					$time=$row['time'];
					
						
$time_now=date("H.i");					
$date1 = new DateTime($time_now);
$date2 = $date1->diff(new DateTime($time));

$h=$date2->h;
$m=$date2->i;
					
			if($h==0){ 
				$time_on=$m;	
			$time_type="minute";
			}else{
			$time_on=$h;
			$time_type="hours";	
			}	
			}else{
				  $sday= strtotime( $date);
                  $nday= strtotime($date1);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $time_on= intval($nbday1);
				  $time_type="Day";}
					if($time_type=="minute"){ $color="green"; }
					if($time_type=="Day"){ $color="red";  }
					if($time_type=="hours"){ $color="blue";								   
					   if($time_on>4){ $color="yellow"; }	 }  
										   
					$vehicle=$row['vehicle_no'];
					$idi=0;
				$result1 = $db->prepare("SELECT * FROM customer WHERE vehicle_no='$vehicle'");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				$idi=$row1['customer_id'];	
					$cus_name=$row1['customer_name'];
					$phone_no=$row1['contact'];
					$phone_no2=$row1['contact2'];
				}
					
					
					
					
$wash_time=$row['wash_time'];					
$time_now=date("H.i");					
$wtime1 = new DateTime($time_now);
$wtime2 = $wtime1->diff(new DateTime($wash_time));

$wh=$wtime2->h;
$wm=$wtime2->i;
			$wtime_on=0;			
			if($wh==0){ 
				$wtime_on=$wm;	
			$wtime_type="minute";
			}else{
			$wtime_on=$wh;
			$wtime_type="hours";	
			}		

	                if($wtime_type=="minute"){ $wcolor="green"; }
					if($wtime_type=="hours"){ $wcolor="blue";								   
					     if($wtime_on>4){ $wcolor="yellow"; }	 }
					
					
					
					
					$tech_time=$row['tech_time'];					
$time_now=date("H.i");					
$ttime1 = new DateTime($time_now);
$ttime2 = $ttime1->diff(new DateTime($tech_time));

$th=$ttime2->h;
$tm=$ttime2->i;
			$ttime_on=0;			
			if($th==0){ 
				$ttime_on=$tm;	
			$ttime_type="minute";
			}else{
			$ttime_on=$th;
			$ttime_type="hours";	
			}		

	                if($ttime_type=="minute"){ $tcolor="green"; }
					if($ttime_type=="hours"){ $tcolor="blue";								   
					     if($ttime_on>4){ $tcolor="yellow"; }	 }
					
					
					
		$invoice_number=6699;			
		$list_invo="-22".$row['vehicle_no'];
		$resultm = $db->prepare("SELECT sum(price) FROM sales_list WHERE invoice_no = '$list_invo' ");
		$resultm->bindParam(':userid', $res);
		$resultm->execute();
		for($i3=0; $rowm = $resultm->fetch(); $i3++){
		$tot_bill1 = $rowm['sum(price)'];
		}
		$resultm = $db->prepare("SELECT * FROM sales WHERE job_no='$now_job_id' ");
		$resultm->bindParam(':userid', $res);
		$resultm->execute();
		for($i=0; $row12 = $resultm->fetch(); $i++){	
		$invoice_number = $row12['invoice_number'];
		}
		$resultm = $db->prepare("SELECT sum(price) FROM sales_list WHERE invoice_no='$invoice_number' ");
		$resultm->bindParam(':userid', $res);
		$resultm->execute();
		for($i=0; $row12 = $resultm->fetch(); $i++){	
		$total_bill2 = $row12['sum(price)'];
		}
					$tot_bill=$total_bill2+$tot_bill1;
					
					$reson_id=$row['reason'];
					if($reson_id==""){
					  ?>
					  
                  <tr>
					  
					  <?php }else{ ?>
					   <tr class="alert alert-general record" style="background-color:brown">
					   <?php } ?>
					  
					  <td><?php echo $job_no;?><span class="badge bg-<?php echo $type_color;?>"><i class="fa fa-clock-o"></i> <?php echo $type_info;?></span></td>
                    <td><?php echo $row['vehicle_no'];?>
					  
					   <?php  if($mechanic_id>0){?>
						<i class="fa fa-wrench " style="color: #C10004" ></i>
						<?php  if($ramp>0){?>
							<span class="badge bg-red"><?php echo $ttime_on." ".$ttime_type;?> </span>
						<?php } ?>
						<?php  }if($wash_id>0){?>
						<i class="fa fa-tint" style="color: mediumblue">
							<?php  if($ramp=="wash"){?>
							<span class="badge bg-blue"><?php echo $wtime_on." ".$wtime_type;?> </span>
						<?php } ?>
						</i>
						<?php  }if($ramp=="Drying"){?>
<i class="fa fa-sun-o" style="color: darkorange"><span class="badge bg-yellow"><?php echo $wtime_on." ".$wtime_type;?> </span></i>
						 <?php } ?>
					  </td>
                    <td><?php echo $row['km'];?></td>
					  
                    <td><span class="badge bg-<?php echo $color;?>"><i class="fa fa-clock-o"></i> <?php echo $time_on." ".$time_type;?></span></td>
					  
					  
					  <td><span class="badge bg-<?php echo $color_ramp;?>"><?php echo $info;?></span></td>
					  <td><?php echo $cus_name;?></td>
					  <td><?php echo $phone_no." / ".$phone_no2;?></td>
					  <td><?php	echo "Rs.".$tot_bill;?></td>
					  
					  <td>
						  <a href="profile.php?id=<?php echo $row['cus_id']; ?>" > <button class="btn btn-success"><i class="glyphicon glyphicon-user"></i></button></a>
						 <a href="job_print.php?id=<?php echo $row['id']; ?>" >
					  <button class="btn btn-warning"><i class="glyphicon glyphicon-print"></i></button></a>
					  
					  
					  <a rel="facebox" href="lord_cancel_job.php?id=<?php echo $row['id']; ?>" >
					  <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button></a>
					  
					  
					  
					  </td>
                  </tr>
                  <?php } $date=date("Y-m-d");
					  $job_type1="";
		 $result = $db->prepare("SELECT * FROM job WHERE type='Close' and date='$date' ORDER by id DESC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$vehicle=$row['vehicle_no'];
			    $job_type1=$row['job_type'];
					
				$result1 = $db->prepare("SELECT * FROM customer WHERE vehicle_no='$vehicle'");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				$idi=$row1['customer_id'];	
					$cus_name=$row1['customer_name'];
					$phone_no=$row1['contact'];
					$phone_no2=$row1['contact2'];
					
				}
					//$job_type1=$row['type_type']; 
					if($job_type1==1){ $type_color1="red"; $type_info1="Full Service"; }
					if($job_type1==2){ $type_color1="green"; $type_info1="1st Free Service"; }
					if($job_type1==7){ $type_color1="green"; $type_info1="2nd Free Service"; }
					if($job_type1==8){ $type_color1="green"; $type_info1="NED Free Service"; }
					if($job_type1==3){ $type_color1="yellow"; $type_info1="Repair"; }
					if($job_type1==4){ $type_color1="aqua"; $type_info1="Echo Test"; }
					if($job_type1==5){ $type_color1="blue"; $type_info1="Body Wash"; }
					  
					  
					  ?>
					  
					  <tr class="alert alert-general record" style="background-color:#ebebed">
						  <td><span class="badge bg-<?php echo $type_color1;?>"><i class="fa fa-clock-o"></i> <?php echo $type_info1;?></span></td>
                    <td><?php echo $row['vehicle_no'];?></td>
                    <td><?php echo $row['km'];?></td>
                    <td><span class="badge bg-green"><i class="fa fa-clock-o"></i> <?php echo $row['type']; ?></span></td>  
				<td><span class="badge bg-red"><i class="fa fa-wrench " ></i>  <?php $ramp1=$row['mechanic_id']; 
						   
						   $resultm = $db->prepare("SELECT * FROM mechanic WHERE id = '$ramp1' ");
		$resultm->bindParam(':userid', $res);
		$resultm->execute();
		for($i=0; $rowm = $resultm->fetch(); $i++){
		echo $rowm['name'];	
		}
						   
						   
						   ?></span></td>
					  
						  <td><?php echo $cus_name;?></td>
						  <td><?php echo $phone_no;?></td>
						  <td></td>
						  
						  <td> 
					  <a href="profile.php?id=<?php echo $idi; ?>" >
					  <button class="btn btn-info"><i class="glyphicon glyphicon-user"></i></button></a></td>
                  </tr>
                  <?php 
				} ?>
                  </tbody>
					
                </table>
              </div>
              <!-- /.table-responsive -->
				
            </div>
	 
	 
	 </div></div>
	
	

	  
	  
	  <div class="col-md-6">
 <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th width="20%">Model</th>
                    <th width="50%">Percentage</th>
                    <th>Amount</th>
                   
                  </tr>
                  </thead>
                  <tbody>
					  <?php $color="green";
			$result = $db->prepare("SELECT * FROM model ORDER by amount DESC limit 0,5");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					  
					if($i==0){ $color="green"; $color1="success"; }
					if($i==1){ $color="yellow"; $color1="warning"; }
					if($i==2){ $color="red"; $color1="danger"; }
					if($i==3){ $color="blue"; $color1="info (2)"; }
					if($i==4){ $color="aqua"; $color1="info"; }
					
					
					
					
$h1=$month_amount;
$h2=$row['amount'];
$h3=$h1/100;
$h41=$h2/$h3;
$h41=number_format($h41,1);
					
					  ?>
                  <tr>
                    <td><img style="width: 110px"  src="<?php echo $row['parth'];?>" >
					  <?php echo $row['name'];?>
					  
					  </td>
                    <td><div class="progress progress active">
						<div class="progress-bar progress-bar-<?php echo $color;?> progress-bar-striped" style="width: <?php echo $h41;?>%"></div></div></td>
                    <td><span class="badge bg-<?php echo $color;?>"><?php echo $h41;?>%</span>
					  <span class="badge bg-">Rs.<?php echo $row['amount'];?></span></td>
                   
                  </tr>
                  <?php } ?>
                  </tbody>
					
                </table>
              </div>
              <!-- /.table-responsive -->
				
            </div>
	 
	 
	 </div></div>
	  
	  
	  
	  
	  </div>
	

      <!-- SELECT2 EXAMPLE -->

      <div class="box box-info">

        <div class="box-header with-border">

          <h3 class="box-title"><?php echo date("Y")-1 ?> to <?php echo date("Y") ?> Sales Chart</h3>



		  

		  

		  

		  

          <div class="chart">

        <canvas id="lineChart" style="height:250px"></canvas>

		</div>

		 <!-- Main content -->

		

		

		

		  </div>

		  </div>

		

		

		

		

		

		

		

		

	

  </div>

  <!-- /.content-wrapper -->

  <?php

  include("dounbr.php");

?>

  <!-- /.control-sidebar -->

  <!-- Add the sidebar's background. This div must be placed

       immediately after the control sidebar -->

  <div class="control-sidebar-bg"></div>



<!-- ./wrapper -->



<!-- jQuery 2.2.3 -->

<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- Bootstrap 3.3.6 -->

<script src="../../bootstrap/js/bootstrap.min.js"></script>

<!-- ChartJS 1.0.1 -->

<script src="../../plugins/chartjs/Chart.min.js"></script>

<!-- FastClick -->

<script src="../../plugins/fastclick/fastclick.js"></script>

<!-- AdminLTE App -->

<script src="../../dist/js/app.min.js"></script>

<!-- AdminLTE for demo purposes -->

<script src="../../dist/js/demo.js"></script>







 <?php

 include("chart.php");

?>





<!-- page script -->

<script>

  $(function () {

    /* ChartJS

     * -------

     * Here we will create a few charts using ChartJS

     */



    //--------------

    //- AREA CHART -

    //--------------



    // Get context with jQuery - using jQuery's .get() method.

    var areaChartCanvas = $("#lineChart").get(0).getContext("2d");

    // This will get the first returned node in the jQuery collection.

    var areaChart = new Chart(areaChartCanvas);



    var areaChartData = {

      labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],

      datasets: [

        {

          label: <?php echo date("Y")-1 ?> + " SALES ",

          fillColor: "rgba(210, 214, 222, 1)",

          strokeColor: "rgba(210, 214, 222, 1)",

          pointColor: "rgba(210, 214, 222, 1)",

          pointStrokeColor: "#c1c7d1",

          pointHighlightFill: "#fff",

          pointHighlightStroke: "rgba(220,220,220,1)",

          data:  [<?php  echo $m1t; ?>, <?php  echo $m2t; ?>, <?php  echo $m3t; ?>, <?php  echo $m4t; ?>, <?php  echo $m5t; ?>, <?php  echo $m6t; ?>, <?php  echo $m7t; ?>, <?php  echo $m8t; ?>, <?php  echo $m9t; ?>, <?php  echo $m10t; ?>, <?php  echo $m11t; ?>, <?php  echo $m12t; ?>]

        },

        {

          label: <?php echo date("Y") ?> + " SALES ",

          fillColor: "rgba(60,141,188,0.9)",

          strokeColor: "rgba(60,141,188,0.8)",

          pointColor: "#3b8bba",

          pointStrokeColor: "rgba(60,141,188,1)",

          pointHighlightFill: "#fff",

          pointHighlightStroke: "rgba(60,141,188,1)",

          data: [<?php  echo $m1; ?>, <?php  echo $m2; ?>, <?php  echo $m3; ?>, <?php  echo $m4; ?>, <?php  echo $m5; ?>, <?php  echo $m6; ?>, <?php  echo $m7; ?>, <?php  echo $m8; ?>, <?php  echo $m9; ?>, <?php  echo $m10; ?>, <?php  echo $m11; ?>, <?php  echo $m12; ?>] 

        }

      ]

    };



    var areaChartOptions = {

      //Boolean - If we should show the scale at all

      showScale: true,

      //Boolean - Whether grid lines are shown across the chart

      scaleShowGridLines: false,

      //String - Colour of the grid lines

      scaleGridLineColor: "rgba(0,0,0,.05)",

      //Number - Width of the grid lines

      scaleGridLineWidth: 1,

      //Boolean - Whether to show horizontal lines (except X axis)

      scaleShowHorizontalLines: true,

      //Boolean - Whether to show vertical lines (except Y axis)

      scaleShowVerticalLines: true,

      //Boolean - Whether the line is curved between points

      bezierCurve: true,

      //Number - Tension of the bezier curve between points

      bezierCurveTension: 0.3,

      //Boolean - Whether to show a dot for each point

      pointDot: false,

      //Number - Radius of each point dot in pixels

      pointDotRadius: 4,

      //Number - Pixel width of point dot stroke

      pointDotStrokeWidth: 1,

      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point

      pointHitDetectionRadius: 20,

      //Boolean - Whether to show a stroke for datasets

      datasetStroke: true,

      //Number - Pixel width of dataset stroke

      datasetStrokeWidth: 2,

      //Boolean - Whether to fill the dataset with a color

      datasetFill: true,

      //String - A legend template

      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",

      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container

      maintainAspectRatio: true,

      //Boolean - whether to make the chart responsive to window resizing

      responsive: true

    };



    //Create the line chart

    areaChart.Line(areaChartData, areaChartOptions);



    //-------------

    //- LINE CHART -

    //--------------

    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");

    var lineChart = new Chart(lineChartCanvas);

    var lineChartOptions = areaChartOptions;

    lineChartOptions.datasetFill = false;

    lineChart.Line(areaChartData, lineChartOptions);



    //-------------

    //- PIE CHART -

    //-------------

    // Get context with jQuery - using jQuery's .get() method.

    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");

    var pieChart = new Chart(pieChartCanvas);

    var PieData = [

      {

        value: 700,

        color: "#f56954",

        highlight: "#f56954",

        label: "Chrome"

      },

      {

        value: 500,

        color: "#00a65a",

        highlight: "#00a65a",

        label: "IE"

      },

      {

        value: 400,

        color: "#f39c12",

        highlight: "#f39c12",

        label: "FireFox"

      },

      {

        value: 600,

        color: "#00c0ef",

        highlight: "#00c0ef",

        label: "Safari"

      },

      {

        value: 300,

        color: "#3c8dbc",

        highlight: "#3c8dbc",

        label: "Opera"

      },

      {

        value: 100,

        color: "#d2d6de",

        highlight: "#d2d6de",

        label: "Navigator"

      }

    ];

    var pieOptions = {

      //Boolean - Whether we should show a stroke on each segment

      segmentShowStroke: true,

      //String - The colour of each segment stroke

      segmentStrokeColor: "#fff",

      //Number - The width of each segment stroke

      segmentStrokeWidth: 2,

      //Number - The percentage of the chart that we cut out of the middle

      percentageInnerCutout: 50, // This is 0 for Pie charts

      //Number - Amount of animation steps

      animationSteps: 100,

      //String - Animation easing effect

      animationEasing: "easeOutBounce",

      //Boolean - Whether we animate the rotation of the Doughnut

      animateRotate: true,

      //Boolean - Whether we animate scaling the Doughnut from the centre

      animateScale: false,

      //Boolean - whether to make the chart responsive to window resizing

      responsive: true,

      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container

      maintainAspectRatio: true,

      //String - A legend template

      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"

    };

    //Create pie or douhnut chart

    // You can switch between pie and douhnut using the method below.

    pieChart.Doughnut(PieData, pieOptions);



    //-------------

    //- BAR CHART -

    //-------------

    var barChartCanvas = $("#barChart").get(0).getContext("2d");

    var barChart = new Chart(barChartCanvas);

    var barChartData = areaChartData;

    barChartData.datasets[1].fillColor = "#00a65a";

    barChartData.datasets[1].strokeColor = "#00a65a";

    barChartData.datasets[1].pointColor = "#00a65a";

    var barChartOptions = {

      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value

      scaleBeginAtZero: true,

      //Boolean - Whether grid lines are shown across the chart

      scaleShowGridLines: true,

      //String - Colour of the grid lines

      scaleGridLineColor: "rgba(0,0,0,.05)",

      //Number - Width of the grid lines

      scaleGridLineWidth: 1,

      //Boolean - Whether to show horizontal lines (except X axis)

      scaleShowHorizontalLines: true,

      //Boolean - Whether to show vertical lines (except Y axis)

      scaleShowVerticalLines: true,

      //Boolean - If there is a stroke on each bar

      barShowStroke: true,

      //Number - Pixel width of the bar stroke

      barStrokeWidth: 2,

      //Number - Spacing between each of the X value sets

      barValueSpacing: 5,

      //Number - Spacing between data sets within X values

      barDatasetSpacing: 1,

      //String - A legend template

      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",

      //Boolean - whether to make the chart responsive

      responsive: true,

      maintainAspectRatio: true

    };



    barChartOptions.datasetFill = false;

    barChart.Bar(barChartData, barChartOptions);

  });

</script>

</body>

</html>

