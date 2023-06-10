<?php 
session_start();

include('../connect.php'); 


$phone=$_GET["phone"];

$name='nott';

$result = $db->prepare("SELECT * FROM customer WHERE contact='$phone' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$name=$row['customer_name'];
$birthday=$row['birthday'];
$email=$row['email'];
$address=$row['address'];
$id=$row['id'];

}
if($name =='nott'){$response = array('action'=>'false');
}else{

$response = array('name'=>$name,'birthday'=>$birthday,'email'=>$email,'address'=>$address,'id'=>$id,'action'=>'true');
}


	$json_response = json_encode($response);
	echo $json_response;
?>