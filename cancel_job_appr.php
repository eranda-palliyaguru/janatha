<?php
session_start();
include('connect.php');

$id = $_GET['id'];
$invo = "cancel";

$sql = "UPDATE job 
        SET type=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($invo,$id));

header("location: index.php");
?>