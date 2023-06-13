<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 

$product_id = $_POST['name'];
$qty = $_POST['qty'];

$invoice_no = $_POST['invoice'];


$result = $db->prepare("SELECT * FROM product WHERE product_id='$product_id'");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
    $name=$row['name'];
}





$date=date("Y-m-d");


if($_POST['supply_c']=="ok"){
    $price=$_POST['supply'];
// query
$sql = "INSERT INTO sales_list (product_id,name,invoice_no,price,qty,service_type,date,amount) VALUES (?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($product_id,$name,$invoice_no,$price,$qty,'Supply',$date,$price*$qty));
}

if($_POST['refit_c']=="ok"){
    $price=$_POST['refit'];
// query
$sql = "INSERT INTO sales_list (product_id,name,invoice_no,price,qty,service_type,date,amount) VALUES (?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($product_id,$name,$invoice_no,$price,$qty,'ReReFit',$date,$price*$qty));
}

if($_POST['repair_c']=="ok"){
    $price=$_POST['repair'];
// query
$sql = "INSERT INTO sales_list (product_id,name,invoice_no,price,qty,service_type,date,amount) VALUES (?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($product_id,$name,$invoice_no,$price,$qty,'Repair',$date,$price*$qty));
}

if($_POST['paint_c']=="ok"){
    $price=$_POST['paint'];
// query
$sql = "INSERT INTO sales_list (product_id,name,invoice_no,price,qty,service_type,date,amount) VALUES (?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($product_id,$name,$invoice_no,$price,$qty,'Paint',$date,$price*$qty));
}


header("location: quotation.php?id=$invoice_no");




?>