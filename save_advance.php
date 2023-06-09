<?php 
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 
$ar = $_POST['amount'];
$type = $_POST['type'];
$a1 = $_POST['invoice'];


$sql = "UPDATE sales 
        SET advance=?
		WHERE invoice_number=?";
$q = $db->prepare($sql);
$q->execute(array($ar,$a1));

$sql = "UPDATE sales 
        SET advance_type=?
		WHERE invoice_number=?";
$q = $db->prepare($sql);
$q->execute(array($type,$a1));

$date=date("Y-m-d");

$sql = "UPDATE sales 
        SET advance_date=?
		WHERE invoice_number=?";
$q = $db->prepare($sql);
$q->execute(array($date,$a1));

header("location: advance_print.php?id=$a1");
?>