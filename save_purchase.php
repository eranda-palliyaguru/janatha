<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 
$date = date("Y-m-d");
$a1 = $_POST['id'];
$c = $_POST['invo_no'];
$e = $_POST['remarks'];
$supplier=$_POST['supplier'];
$pay=$_POST['type'];

$result = $db->prepare("SELECT name FROM supplier WHERE id = '$supplier' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $name = $row['name'];
		}

$result = $db->prepare("SELECT sum(price) FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $d = $row['sum(price)'];	
		}

$result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $id = $row['product_id'];
		$qty = $row['qty'];
			
$sql = "UPDATE product 
        SET qty=qty+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));
			
			
	$sql = "UPDATE product 
        SET qty_tot=qty_tot+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));
			
			
		}
// query
$sql = "INSERT INTO purchases (invoice_no,date,suplier_invoice,amount,remarks,supplier_id,pay_type,name) VALUES (:a,:b,:c,:d,:e,:sup,:pay,:name)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a1,':b'=>$date,':c'=>$c,':d'=>$d,':e'=>$e,':sup'=>$supplier,':pay'=>$pay,':name'=>$name));
header("location: sales1.php");


?>