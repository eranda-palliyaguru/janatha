<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");




$name=$_POST['name'];
$phone_no=$_POST['phone_no'];
$address=$_POST['address'];
$nic=$_POST['nic'];

$attend_date=date('Y-m-d');
$type='4';



//echo $customer_name;

$sql = "INSERT INTO Employees (name,type,phone_no,nic,address,attend_date) VALUES (?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($name,$type,$phone_no,$nic,$address,$attend_date));


header("location: employee.php");

?>