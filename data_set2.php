<?php
session_start();
include('connect.php');


$result = $db->prepare("SELECT * FROM csv2 ");
$result->bindParam(':userid', $d);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

	$bik_no=$row['bik_no'];
	$fname=$row['fname'];
	$lname=$row['lname'];
	$adr1=$row['adr1'];
	$adr2=$row['adr2'];
	$model=$row['model'];
	$phone=$row['phone'];
	
    $name=$fname."".$lname;
	$adr= $adr1.",".$adr2;
	
	
	$sql = "INSERT INTO customer (vehicle_no,customer_name,address,model,contact) VALUES (:a,:b,:d,:f,:g)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$bik_no,':b'=>$name,':d'=>$adr,':f'=>$model,':g'=>$phone));
				}
?>