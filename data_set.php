<?php
session_start();
include('connect.php');

$result1 = $db->prepare("SELECT * FROM sales ORDER by transaction_id DESC limit 0,500 ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$job_no=$row1['job_no'];
		$id=$row1['transaction_id'];
		
		
$result = $db->prepare("SELECT * FROM job WHERE id='$job_no' ");
		$result->bindParam(':userid', $a1);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$mechanic_id=$row['mechanic_id'];	
		}

			
$sql = "UPDATE sales 
        SET mechanic_id=? 
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($mechanic_id,$id));		
		
		}


$qty=10;



?>