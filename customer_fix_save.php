<?php
session_start();
include('connect.php');

$a = $_POST['id'];
$b = $_POST['lewal'];



$sql = "UPDATE product 
        SET re_order=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$a));



		
 date_default_timezone_set("Asia/Colombo");

                  $date =  date("Y/m/d");					
			
				
				date_default_timezone_set("Asia/Colombo");
				$date=date("Y/m/d");
				$date1=date("Y/m/01");
				$date2=date("Y/m/31");
			


header("location: product_sup.php");

?>