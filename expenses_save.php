<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");




$type = $_POST['type'];
$comment = $_POST['comment'];
$amount = $_POST['amount'];
$date = $_POST['date'];




$date = (float) strtr($date, [
    '/' => '',
   
]);



//echo $customer_name;

$sql = "INSERT INTO expenses_records (date,type,comment,amount) VALUES (:date,:a,:b,:amount)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$type,':b'=>$comment,':date'=>$date,':amount'=>$amount));


header("location: expenses.php");

?>