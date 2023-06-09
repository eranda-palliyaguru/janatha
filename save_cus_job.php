<?php

session_start();

include('connect.php');

$a = $_POST['vehicle_no'];

$b = $_POST['model'];

$c = $_POST['cus_name'];

$d = $_POST['phone_no'];

$e = $_POST['address'];

$f =  $_POST['email'];

$g =  $_POST['engine_no'];

$h =  $_POST['chassis_no'];

$i =  $_POST['bye_date'];

$j =  $_POST['color'];
$birthday =  $_POST['birthday'];
$gend =  $_POST['gend'];







// query

$sql = "INSERT INTO customer (vehicle_no,model,customer_name,contact,address,email,engine_no,chassis_no,bye_date,color,birthday,gend) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:birthday,:gend)";

$ql = $db->prepare($sql);

$ql->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$i,':j'=>$j,':birthday'=>$birthday,':gend'=>$gend));

header("location: job.php");





?>