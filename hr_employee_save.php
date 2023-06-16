<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");




$name=$_POST['name'];
$phone_no=$_POST['phone_no'];
$address=$_POST['address'];
$nic=$_POST['nic'];
$etf_no=$_POST['etf_no'];
$etf_amount=$_POST['etf_amount'];
$des_id=$_POST['type'];
$rate=$_POST['rate'];

$attend_date=date('Y-m-d');
$type='4';

$result = $db->prepare("SELECT * FROM Employees_des WHERE id='$des_id'");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $des=$row['name']; $type=$row['type'];}


//echo $customer_name;

$sql = "INSERT INTO Employees (name,type,phone_no,nic,address,attend_date,hour_rate,des,epf_no,epf_amount) VALUES (?,?,?,?,?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($name,$type,$phone_no,$nic,$address,$attend_date,$rate,$des,$etf_no,$etf_amount));


header("location: hr_employee.php");

?>