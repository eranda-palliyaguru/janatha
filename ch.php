<?php
session_start();
include('connect.php');

$d=$_GET['id'];;


$result = $db->prepare("SELECT * FROM credit_sales_order WHERE order_id='$d' ");
				
					$result->bindParam(':userid', $d);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					
					$interest_amount=$row['interest_amount'];
					$amount_left=$row['amount_left'];
					$amount_lorn=$row['amount'];
				}



$result = $db->prepare("SELECT sum(interest) FROM sales WHERE order_id='$d' AND do='' ");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					
					$total_interest=$row['sum(interest)'];
					
				}




$result = $db->prepare("SELECT sum(amount) FROM sales WHERE order_id='$d' AND do='' ");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					
					$total_amaunt1=$row['sum(amount)'];
					$total_amaunt=$total_amaunt1-$amount_lorn;
				}
				
				echo $total_amaunt;
				echo'<br> Lorn amount ';
				echo $amount_lorn;
				echo'<br><br><br><br><br> total amount ';
				echo $amount_left-$amount_lorn;
				echo'<br> <br><br><br><br>interest_amount ';
				//echo $amount_left;
				
				echo'<br> amount_left ';
				echo $amount_left;
				
				echo'<br> total_interest ';
				echo $total_interest;
				
				echo'<br> total_pay ';
				echo $total_amaunt1;
				
				
				
				
				
				
?>