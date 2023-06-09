<?php

session_start();
include('connect.php');

$name = $_POST['name'];
$person = $_POST['person'];
$office = $_POST['office'];
$mobil = $_POST['mobil'];
$address = $_POST['address'];
$email =  $_POST['email'];








// query

$sql = "INSERT INTO supplier (name,contact_person,contact,mobil,address,email) VALUES (?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($name,$person,$office,$mobil,$address,$email));

header("location: supplier.php");





?>