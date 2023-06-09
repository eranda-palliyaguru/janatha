<?php

session_start();

include('connect.php');

date_default_timezone_set("Asia/Colombo"); 



$a1 = $_POST['name'];

//$d = $_POST['km'];
$comment = $_POST['comment'];
$type = "";
$mechanic=0;


$result = $db->prepare("SELECT * FROM vehicle WHERE id = '$a1' ");

		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $c = $row['customer_name'];
			 $model = $row['model'];
			$a = $row['vehicle_no'];
		}
$result = $db->prepare("SELECT * FROM job WHERE vehicle_no = '$a' and type='active' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$d = $row['km'];
			$mechanic = $row['mechanic_id'];
			$job_no=$row['id'];
			$job_type=$row['job_type'];
		}

$result = $db->prepare("SELECT * FROM sales WHERE vehicle_no = '$a' and job_no='$job_no' and action='' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $old_invo = $row['invoice_number'];	
            
		}
$b = date("ymdhis");
if($old_invo>0){
    
if($mechanic > 0){	$b=$old_invo; }

 }else{


$e = date("Y-m-d");

$f = $_SESSION['SESS_FIRST_NAME'];



// query

$sql = "INSERT INTO sales (vehicle_no,invoice_number,customer_name,km,date,cashier,comment,type,customer_id,model,mechanic,job_no,job_type) VALUES (:a,:b,:c,:d,:e,:f,:j,:type,:cus_id,:model,:mech,:job,:job_type)";

$ql = $db->prepare($sql);

$ql->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':j'=>$comment,':type'=>$type,':cus_id'=>$a1,':model'=>$model,':mech'=>$mechanic,':job'=>$job_no,':job_type'=>$job_type));
}
if($mechanic==0){
?>
<html>
<head>
	
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CLOUD ARM</title>
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
    <br><br>
   <center> <h1>SELECT MECHANIC</h1>
	   <img src="img/mechanic.svg" alt="" style="width: 400px">
	   <form action="bill_tech_save.php">
		   <h2>  <div class="col-md-6">
              <div class="form-group">
                
				  <div class="input-group">
				   <div class="input-group-addon">
                    <label>Mechanic	Name</label>
					   
                  </div>
					  <input type="hidden" name="job_no" value="<?php echo $job_no; ?>">
					  <input type="hidden" name="vehi" value="<?php echo $a; ?>">
                <select class="form-control select2" name="mechanic" style="width: 25%; font-size: 26px;"  required>
					<option></option>
				  <?php 
                $result = $db->prepare("SELECT * FROM mechanic ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
					
		<option  value="<?php echo $row['id'];?>"><?php echo $row['name']; ?>  </option>
	<?php
				}
			?>
                </select>
                  </div>
                  </div>
                  <br>
			   <input class="btn btn-info" style="font-size: 26px;" type="submit" value="NEXT" >
				</div></h2></form>
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
</body>
</html>


<?php 
}else{
	header("location: sales.php?id=$b");
	}


?>


