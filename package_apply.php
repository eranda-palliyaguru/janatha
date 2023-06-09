<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 

$id = $_GET['id'];
$c = $_GET['invoice'];




$result1 = $db->prepare("SELECT * FROM package_list WHERE package_id = '$id' ");
$result1->bindParam(':userid', $res);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){
$product_id=$row1['package_id'];
$qty=$row1['qty'];
$price=$row1['price'];

$result = $db->prepare("SELECT * FROM product WHERE product_id = '$product_id' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$b = $row['name'];
$sell = $row['sell'];
$g = $row['code'];
$cost = $row['cost'];
$type = $row['type'];
}


$dis=$sell-$price;
if($dis < 0) {$dis=0;}

$profit=$price-$cost;
$profit=$profit*$qty;

$amount=$price*$qty;
$dis=$dis*$qty;

$date=date("Y-m-d");


// query
$sql = "INSERT INTO sales_list (product_id,name,invoice_no,price,dic,qty,code,profit,type,date,amount,cost,package_id) VALUES (:a,:b,:c,:d,:e,:f,:g,:pro,:type,:date,:amount,:cost,:pack)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$product_id,':b'=>$b,':c'=>$c,':d'=>$price,':e'=>$dis,':f'=>$qty,':g'=>$g,':pro'=>$profit,':type'=>$type,':date'=>$date,':amount'=>$amount,':cost'=>$cost,':pack'=>$id));

}


if(isset($_GET['end'])){
	header("location: app/sales.php?id=$c");
}else{
	header("location: sales.php?id=$c");
}



?>