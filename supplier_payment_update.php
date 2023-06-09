<?php
include('connect.php');

$id = $_POST['id'];
$amount = $_POST['amount'];


			
$sql = "UPDATE purchases 
        SET pay_amount=pay_amount+?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($amount,$id));


header("location: supplier_payment.php");
?>