<?php
session_start();
include('connect.php');

 
$d1=$_GET['id'];
$result = $db->prepare("SELECT * FROM customer WHERE customer_name='$d1' ");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					
					$sha=$row['customer_id'];
					


				}





header("location: profile.php?id=$sha");

?>