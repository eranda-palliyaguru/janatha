<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$vehicle_id = $_POST['cus'];

	$result = $db->prepare("SELECT * FROM vehicle WHERE id = '$vehicle_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $vehicle = $row['vehicle_no'];
			$customer_id=$row['customer_id'];
			$cus_name=$row['customer_name'];
			$model=$row['model'];
		}

	$result = $db->prepare("SELECT * FROM job WHERE vehicle_no = '$vehicle' and type='active' and category='' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $job_id = $row['id'];
		}

if($job_id>1){
?>	
	
<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
?>
<?php $sec=1;?>
<meta http-equiv="refresh" content="<?php echo $sec;?>;URL='job_add.php'">	
<body class="hold-transition skin-red sidebar-mini layout-top-nav">
	
<center>
	<br>
	
<br><br><br>
 <div class="col-md-12">
<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                It's Already save
              </div> </div>
	
	
	</center>
	</body>
</html>
<?php	
}else{




$job_type = $_POST['type'];
$km = $_POST['km'];
$note1 = $_POST['note'];
$product1 = "";
	
$toolkit = 0;
$carpet = 0;
$piuot_arm_cover = 0;
$piuot_arm_cover_r = 0;
$helmet = 0;	
	
	
$type="active";
$time= date("H.i");
$date= date("Y-m-d");

$note= str_replace(".","<br>",$note1); 
$product= str_replace(".","<br>",$product1);

$date=date("Y-m-d");
			 


 $result = $db->prepare("SELECT COUNT(id) FROM job WHERE date='$date' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$jid=$row['COUNT(id)'];
	}


$nba=1;
	
$sql = "INSERT INTO job (vehicle_no,km,note,type,date,time,product_note,job_type,job_no,cus_id,vehicle_id) VALUES (:ve,:km,:note,:type,:date,:time,:pro,:j_type,:job_no,:cus_id,:vehicle_id)";
$q = $db->prepare($sql);
$q->execute(array(':ve'=>$vehicle,':km'=>$km,':note'=>$note,':type'=>$type,':date'=>$date,':time'=>$time,':pro'=>$product,':j_type'=>$job_type,':job_no'=>$nba,':cus_id'=>$customer_id,':vehicle_id'=>$vehicle_id));

//echo $customer_id;

$result = $db->prepare("SELECT * FROM job ORDER by id DESC limit 0,1");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
   $job_no=$row['id'];
}

$invo=date('ymdhis');
$sql = "INSERT INTO sales (vehicle_no,invoice_number,customer_name,km,date,cashier,comment,type,customer_id,model,job_no,job_type) VALUES (:a,:b,:c,:d,:e,:f,:j,:type,:cus_id,:model,:job,:job_type)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$vehicle,':b'=>$invo,':c'=>$cus_name,':d'=>$km,':e'=>$date,':f'=>"",':j'=>"",':type'=>'',':cus_id'=>$customer_id,':model'=>$model,':job'=>$job_no,':job_type'=>$job_type));



$sql = "UPDATE job
SET invoice_no=?
WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($invo,$job_no));

if(isset($_POST['end'])){
	

$result = $db->prepare("SELECT * FROM job_inspection WHERE type='1' ORDER by id ASC ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$ins_id=$row['id'];

$name=$row['name'];
$type=$_POST['type'.$ins_id];
$note=$_POST['note'.$ins_id];

if($type=='none'){}else{
$sql = "INSERT INTO job_list (name,type,ins_id,note,job_no,ins_type) VALUES (?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($name, $type, $ins_id,$note,$job_no,'1'));
}

 
}
header("location: app/index.php");
}else{header("location: index.php"); }
	
	
}



?>