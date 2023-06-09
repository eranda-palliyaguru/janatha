<?php
session_start();
include('connect.php');


$result = $db->prepare("SELECT * FROM csv ");
$result->bindParam(':userid', $d);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['id'];
	
	$fw=$row['fw'];
	$ws=$row['ws'];
	$pws=$row['pws'];
	$wr=$row['wr'];
	
	if($fw=="TRUE"){
		$re="fw";
	}
	if($ws=="TRUE"){
		$re="ws";
	}
	if($pws=="TRUE"){
		$re="pws";
	}
	if($wr=="TRUE"){
		$re="wr";
	}
	
	
	$sql = "UPDATE csv 
        SET type=? 
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($re,$id));
	
	
	header("location: data_set.php");
				}
?>