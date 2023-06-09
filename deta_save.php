<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 

$id = $_POST['id'];
$d = $_POST['km'];

$result = $db->prepare("SELECT * FROM customer WHERE vehicle_no = '$id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $c = $row['customer_name'];
			$a = $row['vehicle_no'];
		}
$b = date("ymdhis");
$e = $_POST['date'];
$f = $_SESSION['SESS_FIRST_NAME'];
$comment = $_POST['comment'];
$amount = $_POST['amount'];

// query
$sql = "INSERT INTO sales (vehicle_no,invoice_number,customer_name,km,date,cashier,comment,amount,action) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:hh)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$comment,':h'=>$amount,':hh'=>"active"));
header("location: deta_enter.php?id=$id");
?>
