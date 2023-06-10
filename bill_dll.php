<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$id=$_REQUEST['id'];
$code="removed";

$sql = "UPDATE sales 
        SET action=?
		WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($code,$id));

if($_REQUEST['end']=='app'){header("location: app/index.php");}else{header("location: index.php");}
