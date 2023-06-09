<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>COLOR BIZNAZ | SMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<br><br><br><br><br><br><br><br><br><br><br><br><br>
   <center> 
	   <h2>SMS Sending</h2>
	   
 <h1> <i class="fa fa-refresh fa-spin"></i> </h1>  
  </center>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
<?php 
include("connect.php");
session_start();
date_default_timezone_set("Asia/Colombo");
$date=date("Y-m-d");
$log="";
$result = $db->prepare("SELECT * FROM login WHERE date='$date'  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$log=$row['id'];
		}
$log="";		
if($log>0){ header("location: index.php"); }else{




       $result = $db->prepare("SELECT * FROM customer ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$customer_name=$row['customer_name'];
		$customer_id=$row['customer_id'];
		$vehicle_no=$row['vehicle_no'];
		$set_day=$row['day'];
		$phone_number=$row['contact'];
		
			//$phone_number= (float) strtr($phone_number, ['-' => '',]);
			//$phone_number= (float) strtr($phone_number, ['(' => '',]);
			//$phone_number= (float) strtr($phone_number, [')' => '',]);
			
$result1 = $db->prepare("SELECT * FROM sales WHERE customer_id='$customer_id' and action='active' ORDER by transaction_id DESC limit 0,1 ");
		$result1->bindParam(':userid', $set_day);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$date1=$row1['date'];	
		}
			$smsday="2018-01-01";
	$result1 = $db->prepare("SELECT * FROM sms WHERE vehicle_no='$vehicle_no' ORDER by transaction_id DESC limit 0,1 ");
		$result1->bindParam(':userid',$set_day);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$smsday=$row1['date'];	
		}
					
	              $date = date("Y-m-d");
				  $sday= strtotime( $date1);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs1= intval($nbday1);
			
			      $date = date("Y-m-d");
				  $sday= strtotime( $smsday);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs2= intval($nbday1);
			
			
			
if($set_day==0){
	$set_day=60;
}			
$act=0;
if($set_day<$rs1){
if($set_day<$rs2){
$act=10;	
}	
}			
			
if($act==10){
$phone_number="(077)-9252594";
	
//$phone_number=str_replace("(","",$phone_number);
//$phone_number=str_replace(")","",$phone_number);
//$phone_number=str_replace("-","",$phone_number);
//$phone_number=substr($phone_number,1);
//$phone_number="94".$phone_number;	


$action="1";	
$text="4544";


$date=date("Y-m-d");
$sql = "INSERT INTO sms (vehicle_no,customer_id,customer_name,phone_number,massage,date,action) VALUES (:a,:b,:c,:d,:e,:f,:g)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$vehicle_no,':b'=>$customer_id,':c'=>$customer_name,':d'=>$phone_number,':e'=>$text,':f'=>$date,':g'=>$action));

}
		}

	
$time=date("H.i");
$username=$_SESSION['SESS_FIRST_NAME'];
$date=date("Y-m-d");
$sql = "INSERT INTO login (user,date,time) VALUES (:a,:b,:c)";
$ql = $db->prepare($sql);
$ql->execute(array(':a'=>$username,':b'=>$date,':c'=>$time));

header("location: index.php");
}
?>