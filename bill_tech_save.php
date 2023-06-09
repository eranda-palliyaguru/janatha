<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$id=$_REQUEST['job_no'];
$vehi=$_REQUEST['vehi'];

$code=$_REQUEST['mechanic'];




$sql = "UPDATE job 
        SET mechanic_id=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($code,$id));


$result = $db->prepare("SELECT * FROM sales WHERE vehicle_no = '$vehi' and job_no='$id' and action='' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $old_invo = $row['invoice_number'];
			
		}


header("location: sales.php?id=$old_invo");

?>