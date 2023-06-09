<?php
include("connect.php");
$result1 = $db->prepare("SELECT * FROM product ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$product_id=$row1['product_id'];
		$code1=$row1['code'];




$code= str_replace("-","",$code1); 
		

			
$sql = "UPDATE product 
        SET code=? 
		WHERE product_id=?
		";
$q = $db->prepare($sql);
$q->execute(array($code,$product_id));
			
			
			
		}
?>