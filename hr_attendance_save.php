<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$in='0.0';
$out='0.0';



$id=$_POST['id'];
$date=$_POST['date'];
$time=$_POST['time'];
$type=$_POST['type'];



$result = $db->prepare("SELECT * FROM Employees WHERE id ='$id' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $name=$row['name'];}


$result = $db->prepare("SELECT * FROM attendance WHERE emp_id ='$id' AND date='$date' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $att_id=$row['id']; $in_t=$row['IN_time']; $out_t=$row['OUT_time'];}






if($type=='IN'){
    $in=$time;

    if($in < 8){
        $in_ti="8.00";
    }else{
        $in_ti=$in_t;
    }
$out_ti=$out_t;					


}else{ 
$out=$time;

if($in_t < 8){
    $in_ti="8.00";
}else{
    $in_ti=$in_t;	
}
$out_ti=$time;					

 }



if(isset($att_id)){



list($out_h, $out_m) = explode('.', $out_ti);
list($in_h, $in_m) = explode('.', $in_ti);

$deff_h=$out_h-$in_h;
$deff_m=$out_m-$in_m;
if ($deff_m < 0) {$deff_m=$deff_m+60; $deff_h=$deff_h-1;}


$deff=$deff_h.".".sprintf("%02d",$deff_m);

if($deff_h >= 10){$work_time='10.00';}else{$work_time=$deff;}


    if($deff_h<10){
        $wh=9;
        $wm=60;

        $ot_h=$deff_h-$wh;
        $ot_m=$wm-$deff_m;
       // $ot='-'.$ot_h.'.'.sprintf("%02d",$ot_m);
       $ot=0.00;
    }
    if($deff_h >= 10){
        $wh=10;

        $ot_h=$deff_h-$wh;
        $ot_m=$deff_m;

        $ot=$ot_h.'.'.sprintf("%02d",$ot_m);
    }
    






    if($type=='IN'){

    $sql = "UPDATE attendance
    SET IN_time=?,deff_time=?,ot=?,work_time=?
    WHERE id=?";
    $q = $db->prepare($sql);
    $q->execute(array($time,$deff,$ot,$work_time,$att_id));

    }else{

    $sql = "UPDATE attendance
    SET OUT_time=?,deff_time=?,ot=?,work_time=?
    WHERE id=?";
    $q = $db->prepare($sql);
    $q->execute(array($time,$deff,$ot,$work_time,$att_id));

    }

}else{

$sql = "INSERT INTO attendance (emp_id,name,date,time,IN_time,OUT_time) VALUES (?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($id,$name,$date,$time,$in,$out));
}

header("location: hr_attendance.php");

?>