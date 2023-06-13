<?php
session_start();
include('connect.php');
$name= $_POST['name'];
$type = $_POST['type'];
$code=0;
$cat = 0; 

$supply=0;
$refit=0;
$repair=0;
$paint=0;

$sell=0;
$cost=0;

$re_order=0;

if($type=="Service"){
   
    $cat = $_POST['category']; 
    $supply=$_POST['supply'];
    $refit=$_POST['refit'];
    $repair=$_POST['repair'];
    $paint=$_POST['paint'];
}

if($type=="Product"){
    $f = $_POST['re_order'];
    $rack = $_POST['category']; 
}


if($type=="Materials"){
    $f = $_POST['re_order'];
}
if($type=="Quick"){
    $rack = $_POST['category'];
}


$time=date('Y-m-d H:i:s');
// query
$sql = "INSERT INTO product (name,code,type,sell,cost,re_order,category,time,supply,refit,repair,paint) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($name,$code,$type,$sell,$cost,$re_order,$cat,$time,$supply,$refit,$repair,$paint));



header("location: product_view.php");


?>