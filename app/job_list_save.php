<?php 
include("../connect.php");

$job_no=$_POST['job_no'];
$name=$_POST['name'];
$type="pending";
$note="";



$sql = "INSERT INTO job_list (name,type,ins_id,note,job_no,ins_type) VALUES (?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($name, $type, '0',$note,$job_no,'1'));


 


header("location: job_list.php?id=$job_no");
?>