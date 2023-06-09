<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$a1 = $_POST['invoice'];
$vehicle_no = "non";
$cus = "Minuwangoda";
$model = "non";
$comment = $_POST['note'];



$result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $id = $row['product_id'];
		$qty = $row['qty'];
			
$sql = "UPDATE product 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));
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
$sql = "INSERT INTO sales (vehicle_no,invoice_number,date,cashier,amount,balance,action,model,customer_name,comment,type) VALUES (:a,:b,:c,:d,:e,:f,:g,:model,:cus,:com,:ty)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$vehicle_no,':b'=>$a1,':c'=>$date,':d'=>$cashi,':e'=>$a,':cus'=>$cus,':model'=>$model,':com'=>$comment,':f'=>"0",':g'=>"Transfer",':ty'=>"1"));






include('connect2.php');
$cus="Negambo";
$sql = "INSERT INTO sales (vehicle_no,invoice_number,date,cashier,amount,balance,action,model,customer_name,comment,type) VALUES (:a,:b,:c,:d,:e,:f,:g,:model,:cus,:com,:ty)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$vehicle_no,':b'=>$a1,':c'=>$date,':d'=>$cashi,':e'=>$a,':cus'=>$cus,':model'=>$model,':com'=>$comment,':f'=>"0",':g'=>"Transfer",':ty'=>"2"));



include('connect.php');
$result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$a1' ");
		$result->bindParam(':userid', $res);
		$result->execute();

		for($i=0; $row = $result->fetch(); $i++){
            $a1 = $row['product_id'];
			 $b = $row['name'];
			 $c = $row['invoice_no'];
			 $price = $row['price'];
			$dic = $row['dic'];
			$qty = $row['qty'];
			$code = $row['code'];
			$profit = $row['profit'];
			$type = $row['type'];
			$type_q = $row['qty_type'];
			

include('connect2.php');			
$sql = "INSERT INTO sales_list (product_id,name,invoice_no,price,dic,qty,code,profit,type,qty_type) VALUES (:a,:b,:c,:d,:e,:f,:g,:pro,:type,:type_q)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a1,':b'=>$b,':c'=>$c,':d'=>$price,':e'=>$dic,':f'=>$qty,':g'=>$code,':pro'=>$profit,':type'=>$type,':type_q'=>$type_q));	
		}



header("location: bill.php?id=$c&vehicle_no=$vehicle_no");
?>