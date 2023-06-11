<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");
$vehicle_id = $_POST['cus'];

	$result = $db->prepare("SELECT * FROM vehicle WHERE id = '$vehicle_id' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $vehicle = $row['vehicle_no'];
			$customer_id=$row['customer_id'];
			$cus_name=$row['customer_name'];
			$model=$row['model'];
		}

	$result = $db->prepare("SELECT * FROM job WHERE vehicle_no = '$vehicle' and type='active' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $job_id = $row['id'];
		}

if($job_id>1){
?>	
	
<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
?>
<?php $sec=1;?>
<meta http-equiv="refresh" content="<?php echo $sec;?>;URL='job_add.php'">	
<body class="hold-transition skin-red sidebar-mini layout-top-nav">
	
<center>
	<br>
	
<br><br><br>
 <div class="col-md-12">
<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                It's Already save
              </div> </div>
	
	
	</center>
	</body>
</html>
<?php	
}else{




$job_type = $_POST['type'];
$km = 0;
$note1 = $_POST['note'];
$product1 = "";
$r_person=$_POST['rp'];
	
$toolkit = 0;
$carpet = 0;
$piuot_arm_cover = 0;
$piuot_arm_cover_r = 0;
$helmet = 0;	
	
	
$type="active";
$time= date("H.i");
$date= date("Y-m-d");

$note= str_replace(".","<br>",$note1); 
$product= str_replace(".","<br>",$product1);

$date=date("Y-m-d");
			 


 $result = $db->prepare("SELECT COUNT(id) FROM job WHERE date='$date' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$jid=$row['COUNT(id)'];
	}


$nba=1;

//---------------------------------------------------------------- upload image file ------------------------------------------------//
function compressImage($source, $destination, $quality) {
    $info = getimagesize($source);
    $mime = $info['mime'];

    // Create an image resource based on the MIME type
    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            break;

        case 'image/png':
            $image = imagecreatefrompng($source);
            break;

        case 'image/gif':
            $image = imagecreatefromgif($source);
            break;

        default:
            return false;
    }

    // Compress and save the image
    imagejpeg($image, $destination, $quality);

    // Free up memory
    imagedestroy($image);

    return true;
}

$target_dir = "job_img/";
$target_file = $target_dir . date('ymdHis').".".pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
	echo "Sorry, your file is too large.";
	compressImage($file['tmp_name'], $destination,60);
  }

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}



// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  

//---------------------------------------------------------------- upload image end ----------------------------------------------------//
	
$sql = "INSERT INTO job (vehicle_no,km,note,type,date,time,product_note,job_type,job_no,cus_id,vehicle_id,r_person,img) VALUES (:ve,:km,:note,:type,:date,:time,:pro,:j_type,:job_no,:cus_id,:vehicle_id,:r_person,:img)";
$q = $db->prepare($sql);
$q->execute(array(':ve'=>$vehicle,':km'=>$km,':note'=>$note,':type'=>$type,':date'=>$date,':time'=>$time,':pro'=>$product,':j_type'=>$job_type,':job_no'=>$nba,':cus_id'=>$customer_id,':vehicle_id'=>$vehicle_id,':r_person'=>$r_person,':img'=>$target_file));

//echo $customer_id;

$result = $db->prepare("SELECT * FROM job ORDER by id DESC limit 0,1");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
   $job_no=$row['id'];
}

$invo=date('ymdhis');
$sql = "INSERT INTO sales (vehicle_no,invoice_number,customer_name,km,date,cashier,comment,type,customer_id,model,job_no,job_type) VALUES (:a,:b,:c,:d,:e,:f,:j,:type,:cus_id,:model,:job,:job_type)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$vehicle,':b'=>$invo,':c'=>$cus_name,':d'=>$km,':e'=>$date,':f'=>"",':j'=>"",':type'=>'',':cus_id'=>$customer_id,':model'=>$model,':job'=>$job_no,':job_type'=>$job_type));



$sql = "UPDATE job
SET invoice_no=?
WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($invo,$job_no));

if(isset($_POST['end'])){
header("location: app/job_list.php?id=$job_no");
}else{header("location: job_list.php?id=$job_no"); }
	
} else {
    echo "Sorry, there was an error uploading your file.";
  }
}
	
}



?>