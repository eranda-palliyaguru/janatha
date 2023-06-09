<?php
session_start();
include('connect.php');
$a = $_POST['name'];
$b = $_POST['code'];
$c = $_POST['type'];
$d = $_POST['sell'];
$e = $_POST['cost'];
$f=0;
$rack=0;


if($c=="Product"){
    $f = $_POST['re_order'];
    $rack = $_POST['category']; 
}
if($c=="Materials"){
    $f = $_POST['re_order'];
}
if($c=="Quick"){
    $rack = $_POST['category'];
}


$time=date('Y-m-d H:i:s');


// query
$sql = "INSERT INTO product (name,code,type,sell,cost,re_order,category,time) VALUES (:a,:b,:c,:d,:e,:f,:rack,:time)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':rack'=>$rack,':time'=>$time));


if($c=='Service'){

    $result = $db->prepare("SELECT * FROM product ORDER BY product_id DESC LIMIT 1");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
        $pro_id=$row['product_id'];
        $id=0;
    }

    $sql = "UPDATE use_product
        SET main_product=?
		WHERE main_product=?";
$q = $db->prepare($sql);
$q->execute(array($pro_id,$id));

}

header("location: product_view.php");


?>