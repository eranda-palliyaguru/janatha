<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$id=$_POST['id'];

$a1 = $_POST['invoice'];
$type = '';

$incom_id = $_POST['incom'];

$result = $db->prepare("SELECT * FROM vehicle WHERE id = '$id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $cus = $row['customer_name'];
		$model=$row['manufacture'].'-'.$row['model'];	
		$vehicle_no= $row['vehicle_no'];
		}


		$result = $db->prepare("SELECT * FROM insurance_com WHERE id = '$incom_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $incom = $row['name'];
		}


//$c = $_POST['cus_name'];
$result = $db->prepare("SELECT sum(price) FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $a = $row['sum(price)'];
		}


$result = $db->prepare("SELECT sum(profit) FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $profit = $row['sum(profit)'];	
		}



$c = "active";
$date=date("Y-m-d");
$cashi = $_SESSION['SESS_FIRST_NAME'];
// query
$sql = "INSERT INTO sales (vehicle_no,invoice_number,date,cashier,amount,balance,action,model,customer_name,in_com_name,in_com_id,customer_id) VALUES (:a,:b,:c,:d,:e,:f,:g,:model,:cus,:com,:com_id,:cus_id)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$vehicle_no,':b'=>$a1,':c'=>$date,':d'=>$cashi,':e'=>$a,':cus'=>$cus,':model'=>$model,':com'=>$incom,':com_id'=>$incom_id,':f'=>"0",':g'=>"Quotations",':cus_id'=>$id));


header("location: bill.php?id=$a1&vehicle_no=$vehicle_no&type=$type");


?>