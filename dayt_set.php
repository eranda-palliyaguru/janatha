 

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
date_default_timezone_set("Asia/Colombo");
include("connect.php");

                $result = $db->prepare("SELECT * FROM customer  ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		$customer_id=$row['customer_id'];
		$vehicle_no=$row['vehicle_no'];

		$result1 = $db->prepare("SELECT * FROM sales WHERE vehicle_no='$vehicle_no' and action='active' ORDER by transaction_id DESC limit 0,1 ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$date=$row1['date'];	
		}


	
       $result1 = $db->prepare("SELECT * FROM sales WHERE vehicle_no='$vehicle_no' and action='active' ORDER by transaction_id DESC limit 1,1 ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$date1=$row1['date'];	
		}
			
	    $result1 = $db->prepare("SELECT * FROM sales WHERE vehicle_no='$vehicle_no' and action='active' ORDER by transaction_id DESC limit 2,1 ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$date2=$row1['date'];	
		}
			
	    $result1 = $db->prepare("SELECT * FROM sales WHERE vehicle_no='$vehicle_no' and action='active' ORDER by transaction_id DESC limit 3,1 ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$date3=$row1['date'];
		}
			
		$result1 = $db->prepare("SELECT * FROM sales WHERE vehicle_no='$vehicle_no' and action='active' ORDER by transaction_id DESC limit 4,1 ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$date4=$row1['date'];
		}
			
		$result1 = $db->prepare("SELECT * FROM sales WHERE vehicle_no='$vehicle_no' and action='active' ORDER by transaction_id DESC limit 5,1 ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$date5=$row1['date'];
		}
			 
			//echo $rs1;
			
                  $date =  $date;
				  $sday= strtotime( $date1);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs1= intval($nbday1);
		 
			      $date =  $date1;
				  $sday= strtotime( $date2);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs2= intval($nbday1);
			
			      $date =  $date2;
				  $sday= strtotime( $date3);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs3= intval($nbday1);
			
			      $date =  $date3;
				  $sday= strtotime( $date4);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs4= intval($nbday1);
			
			      $date =  $date4;
				  $sday= strtotime( $date5);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $rs5= intval($nbday1);
			
			$xb=5;$last_day=$rs5;
			if($rs1>1000){ $rs1=0; $last_day=0;}
			if($rs2>1000){ $rs2=0;$xb=1; $last_day=$rs1;}
			if($rs3>1000){ $rs3=0;$xb=2; $last_day=$rs2;}
			if($rs4>1000){ $rs4=0;$xb=3; $last_day=$rs3;}
			if($rs5>1000){ $rs5=0;$xb=4; $last_day=$rs4;}
			
			
			
			$f_rs=$rs1+$rs2+$rs3+$rs4+$rs5;
			$f_rs= $f_rs/$xb;
			
			$reset=$f_rs+$last_day;
			$reset=$reset/2;
		echo	$reset= number_format($reset,0);
		echo "<br>";	
$sql = "UPDATE customer 
        SET day=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$customer_id));
			

			$rs1="";$rs2="";$rs3="";$rs4="";$rs5="";
			
			$date="";
			$date1="";
			$date2="";
			$date3="";
			$date4="";
			$date5="";
			$f_rs="";
		}


//header("location: sms.php");
	?>