





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
					  
		$result = $db->prepare("SELECT * FROM job WHERE type='active' and ramp='wash' ORDER by id ASC ");
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
			$result = $db->prepare("SELECT * FROM job WHERE type='active' and category='' ORDER by id ASC ");
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
					  
					  <td><?php if($idi>1){ ?>
						  <a href="profile.php?id=<?php echo $idi; ?>" >
					  <button class="btn btn-success"><i class="glyphicon glyphicon-user"></i></button></a>
						  <?php }else{ ?>
						   <a href="cus.php" >
					  <button class="btn btn-info"><i class="glyphicon glyphicon-user">+</i></button></a>
						  <?php } ?><a href="job_print.php?id=<?php echo $row['id']; ?>" >
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