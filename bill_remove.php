<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$id=$_REQUEST['id'];
$d1=$_REQUEST['d1'];
$d2=$_REQUEST['d2'];
$code=1;

$sql = "UPDATE sales 
        SET remove=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($code,$id));

header("location: sales_rp.php?d1=$d1&d2=$d2");