<?php

session_start();

include('connect.php'); 
$cus_id = $_POST['cus_id'];

if ($cus_id=='0'){
//customer data
$name = $_POST['cus_name'];
$phone_no = $_POST['phone_no'];
$address = $_POST['address'];
$email =  $_POST['email'];
$birthday=$_POST['birthday'];
}


// vehicle data
$vehicle_no = $_POST['vehicle_no'];
$model_id = $_POST['model'];
$fuel_type=$_POST['fuel_type'];
$transmission=$_POST['transmission'];


$result = $db->prepare("SELECT * FROM model WHERE id ='$model_id'");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $model= $row['manufacture'].' - '.$row['name']; }



// other information
$date=date('Y-m-d');
$time=date('H:i:s');

if($cus_id == 0) {

//Customer Save 
$sql = "INSERT INTO customer (customer_name,contact,address,email,birthday) VALUES (?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($name,$phone_no,$address,$email,$birthday));



//Find customer id 
$result = $db->prepare("SELECT * FROM customer ORDER BY id DESC LIMIT 1");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $cus_id= $row['id']; }

}else{
//Old customer data
$result = $db->prepare("SELECT * FROM customer ORDER BY id DESC LIMIT 1");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $cus_id= $row['id']; $name= $row['customer_name'];}
}

// Vehicle Save
$sql="INSERT INTO vehicle (vehicle_no,customer_id,customer_name,model,model_id,fuel_type,transmission_type,date,time) VALUES (?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($vehicle_no,$cus_id,$name,$model,$model_id,$fuel_type,$transmission,$date,$time));

if(isset($_POST['end'])){
 header("location: app/customer.php");
}else{
header("location: cus_view.php");
}





?>