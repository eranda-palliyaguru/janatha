<?php 
include("../connect.php");

$job_no='1';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['photo'])) {
        $targetDir = 'job_img/';
        $targetFile = $targetDir . basename($_FILES['photo']['name']);

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
            echo 'Photo uploaded successfully.';
        } else {
            echo 'Error uploading photo.';
        }
    } else {
        echo 'No photo found.';
    }


$date=date('Y-m-d');
$time=date('H:i:s');

$sql = "INSERT INTO job_img (name,job_no,date,time) VALUES (?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($image_name, $job_no, $date, $time));
}

?>