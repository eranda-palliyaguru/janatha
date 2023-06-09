<?php
session_start();
include('connect.php');
$a1 = $_POST['model'];


$sql = "INSERT INTO model (name) VALUES (:a)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a1));
header("location: cus.php");


?>