<?php
session_start();
include('connect.php');

$a = $_POST['name'];
$b = $_POST['vehicle_no'];
$c = $_POST['color'];
$d = $_POST['contact'];
$e = $_POST['engine_no'];
$f = $_POST['chassis_no'];
$id= $_POST['id'];
$email=$_POST['email'];
$address=$_POST['address'];
$model=$_POST['model'];





$sql = "UPDATE customer 
        SET customer_name=?,address=?,email=?,model=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$address,$email,$model,$id));





$sql = "UPDATE customer 
        SET vehicle_no=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$id));



$sql = "UPDATE customer 
        SET color=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$id));


$sql = "UPDATE customer 
        SET contact=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($d,$id));

$sql = "UPDATE customer 
        SET engine_no=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($e,$id));

$sql = "UPDATE customer 
        SET chassis_no=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$id));


header("location: profile.php?id=$id");


?>