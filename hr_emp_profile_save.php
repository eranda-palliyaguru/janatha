<?php
session_start();
include('connect.php');

$name = $_POST['name'];
$contact= $_POST['contact'];
$nic= $_POST['nic'];
$address= $_POST['address'];
$des= $_POST['des'];
$epf_no= $_POST['epf_no'];
$epf_amount= $_POST['epf_amount'];
$rate= $_POST['rate'];
$id= $_POST['id'];





$sql = "UPDATE Employees 
        SET name=?,address=?,nic=?,phone_no=?,hour_rate=?,des=?,epf_amount=?,epf_no=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($name,$address,$nic,$contact,$rate,$des,$epf_amount,$epf_no,$id));


header("location: hr_employee_profile.php?id=$id");


?>