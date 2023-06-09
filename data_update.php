<?php 
include('connect.php');

$result = $db->prepare("SELECT * FROM use_product ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
  
    $type="Materials";
    $id=$row['product_barcode'];




    $sql = "UPDATE sales
        SET vehicle_id=?
		WHERE vehicle_no=?";
$q = $db->prepare($sql);
$q->execute(array($type,$id));
}