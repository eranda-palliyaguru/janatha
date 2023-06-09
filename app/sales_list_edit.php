<?php 
include('../connect.php');


$price=$_POST['price'];
$id=$_POST['id'];

$result = $db->prepare("SELECT * FROM sales_list WHERE id='$id' ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty=$row['qty'];
$price_old=$row['price'];
$invoice_no=$row['invoice_no'];
}

if($price < $price_old){
    $dis=($price_old-$price)*$qty;
    
}

$amount=$price*$qty;



$sql = "UPDATE sales_list
SET amount=?,price=?,dic=?
WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($amount,$price,$dis,$id));


header("location: sales.php?id=$invoice_no");

?>