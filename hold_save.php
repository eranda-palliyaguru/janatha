<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");




$d1 = $_POST['d1'];
$d2 = $_POST['d2'];
$amount = $_POST['amount'];
$date= date("Y-m-d");

$sql = "INSERT INTO hold_amount (date,amount) VALUES (:date,:a)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$amount,':date'=>$date));


header("location: sales_rp.php?d1='$d1'&d2='$d2'");

?>