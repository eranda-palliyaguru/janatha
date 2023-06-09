<?php
session_start();
include('connect.php');


$result = $db->prepare("SELECT * FROM csv3 ");
$result->bindParam(':userid', $d);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

	$code=$row['code'];
	$name=$row['name'];
	$price=$row['price'];
	$qty=$row['qty'];
	
	
    $type="Product";
	
	
	
	$sql = "INSERT INTO product (code,name,sell,qty,type) VALUES (:a,:b,:d,:f,:g)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$code,':b'=>$name,':d'=>$price,':f'=>$qty,':g'=>$type));
				}
?>