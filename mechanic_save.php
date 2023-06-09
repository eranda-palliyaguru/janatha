<?php
session_start();
include('connect.php');
$a1 = $_POST['mechanic'];


$sql = "INSERT INTO mechanic (name) VALUES (:a)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a1));
header("location: sales1.php");


?>