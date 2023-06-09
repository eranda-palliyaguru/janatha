<?php
session_start();
include('connect.php');
$id="-22".$_POST['id'];

header("location: sales.php?id=$id");
?>