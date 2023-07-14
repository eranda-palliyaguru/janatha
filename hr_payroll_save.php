<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

function AddPlayTime($times) {
    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
    // loop throught all the times
    foreach ($times as $time) {
        list($hour, $minute) = explode('.', $time);
        $minutes += $hour * 60;
        $minutes += $minute;
    }

    $hours = floor($minutes / 60);
    $minutes -= $hours * 60;

    // returns the time already formatted
    return sprintf('%02d.%02d', $hours, $minutes);
  
}

function TimeSet($times) {
    
    list($hour, $minute) = explode('.', $times);
    $minutes=$minute+$hour*60;

   return $minutes/60;
}


$date=$_POST['date'];

$d1=$date."-01";
$d2=$date."-31";




$result1 = $db->prepare("SELECT * FROM Employees");
$result1->bindParam(':userid', $res);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){
    $id=$row1['id'];
    $name=$row['name'];
    $rate=$row['hour_rate'];
    $epf=$row['epf_amount'];


    $result = $db->prepare("SELECT work_time,ot FROM attendance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ 
        $hour[]=$row['work_time'];
        $ot[]=$row['ot'];
    }

    $result = $db->prepare("SELECT count(id) FROM attendance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ 
    $day=$row['count(id)'];
    }


    $result = $db->prepare("SELECT sum(amount) FROM salary_advance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
	$result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){$adv=$row['sum(amount)'];}


    $result = $db->prepare("SELECT * FROM hr_allowances WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
	$result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    $allowances+=$row['amount'];
    }



//--------------- OT Time -----------------//
$ot=AddPlayTime($ot);  
$ot_tot=($rate * 142.86)/100 * TimeSet($ot);

//--------------- Worck hour -------------//
$hour=AddPlayTime($hour);
$basic =$rate*TimeSet($hour);



$amount=($ot_tot+$basic+$allowances)-$epf-$adv;


$result = $db->prepare("SELECT * FROM hr_payroll WHERE emp_id ='$id' AND date='$date' ORDER BY id ASC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ 
        $empid=$row['emp_id'];
    }
    if(isset($empid)){}else{

$time=date('H:i:s');
$sql = "INSERT INTO hr_payroll (name,emp_id,amount,date,time) VALUES (?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($name,$id,$amount,$date,$time));
    }
}





header("location: hr_payroll_print.php?id=1&date=$date");

?>