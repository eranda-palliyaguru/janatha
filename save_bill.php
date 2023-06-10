<?php
session_start();
include('connect.php');
$a1 = $_POST['invoice'];
$ar = $_POST['amount'];
$type = $_POST['type'];
$note = $_POST['note'];
$email=$_POST['email'];
$km=$_POST['km'];
date_default_timezone_set("Asia/Colombo"); 

$act=1;
$sql = "UPDATE sales_list 
        SET action=?
		WHERE invoice_no=?";
$q = $db->prepare($sql);
$q->execute(array($act,$a1));

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


$result = $db->prepare("SELECT sum(price) FROM sales_list WHERE invoice_no = '$a1' and type='Service'");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $labor_cost = $row['sum(price)'];	
		}




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




$result = $db->prepare("SELECT * FROM hold_amount WHERE date_sum='' ORDER by id DESC limit 0,1 ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $hold_id = $row['id'];
		$hold_date = date("Y-m-d");
			
$sql = "UPDATE hold_amount 
        SET date_sum=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($hold_date,$hold_id));
		}
$result = $db->prepare("SELECT * FROM hold_amount WHERE date_sum='$hold_date' and date='$hold_date' ORDER by id DESC limit 0,1 ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
        $hold_id = $row['id'];
		$hold_date1 ="";
			
$sql = "UPDATE hold_amount 
        SET date_sum=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($hold_date1,$hold_id));
		}


$result1 = $db->prepare("SELECT * FROM sales WHERE invoice_number='$a1' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$job_no=$row1['job_no'];	
		}

$result1 = $db->prepare("SELECT * FROM job WHERE id='$job_no' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$mechanic_id=$row1['mechanic_id'];	
		}

$result1 = $db->prepare("SELECT * FROM mechanic WHERE id='$mechanic_id' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$mechanic=$row1['name'];	
		}
//$mechanic_id=1;


$b = $ar-$a;
$c = "active";
$date=date("Y-m-d");
$time=date('H:i:s');

$credit=0;
if($type=="Credit"){$credit=$a-$ar;}

// query
$sql = "UPDATE  sales SET amount=?,balance=?,action=?,profit=?,labor_cost=?,pay_type=?,date=?,mechanic_id=?,mechanic=?,email=?,plus_km=?,comment=?,time=?,credit=? WHERE invoice_number=?";
$ql = $db->prepare($sql);
$ql->execute(array($a,$b,$c,$profit,$labor_cost,$type,$date,$mechanic_id,$mechanic,$email,$km,$note,$time,$credit,$a1));

$result1 = $db->prepare("SELECT * FROM sales WHERE invoice_number='$a1' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$vehicle_no=$row1['vehicle_no'];	
		}
$job_type="Close";
$sql = "UPDATE job 
        SET type=?
		WHERE vehicle_no=?";
$q = $db->prepare($sql);
$q->execute(array($job_type,$vehicle_no));

	


header("location: bill.php?id=$a1");

?>