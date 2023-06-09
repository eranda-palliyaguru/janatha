<?php 
include('connect.php');

$name=$_POST['name'];
$type=$_POST['type'];
$amount=$_POST['amount'];
$model=$_POST['model'];
$d1=$_POST['d1'];
$d2=$_POST['d2'];

if($model> 0){$result = $db->prepare("SELECT * FROM model WHERE id='$model'");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ $model_name=$row['name']; }
}else{
    $model=0;
    $model_name="All models";
}


$sql = "INSERT INTO package (name,type,start_date,end_date,model,amount,model_id) VALUES (?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($name,$type,$d1,$d2,$model_name,$amount,$model));

$result = $db->prepare("SELECT id FROM package ORDER BY id DESC LIMIT 1");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ $id=$row['id']; }

$sql = "UPDATE package_list 
        SET package_id=?
		WHERE package_id=?";
$q = $db->prepare($sql);
$q->execute(array($id,'0'));


header("location: package.php");
?>