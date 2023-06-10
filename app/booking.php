<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('hed.php'); ?>
    <link rel="stylesheet" href="css/select2.app.css">
    <link rel="stylesheet" href="css/datepik.css">
    <style>
        
    input {
        width: 80%;
    }

    .login-btn {
        border-radius: 30px;
        width: 40%;
        background: linear-gradient(27deg, rgba(190, 0, 0, 0.8), rgba(50, 0, 0, 0.6));
        /* color:#FF3636; */
        color: #ABABAB;
        margin-top: 50px;
        font-size: 17px;
        height: 40px;
    }
    </style>
</head>

<body>
    <?php include('preload.php'); include("../connect.php"); ?>
    <br><br>
    <a href="index.php"><i style="font-size:30px; color:#3A3939; margin:6%" class="ion-chevron-left"></i></a>
    <br><br>
    <h2 style="margin:15px">ADD NEW Booking</h2>
    <br>
    <img src="img/booking.svg" alt="img" width="100%" >
    <center>

    
        <form action="../booking_save.php" method="post">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <select class="model-box select2 " name="cus" style="width: 100%;">
                    <?php 
			 $result = $db->prepare("SELECT * FROM vehicle ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
                    <option value="<?php echo $row['id'];?>"><?php echo $row['vehicle_no']; ?> (
                        <?php echo $row['manufacture']; ?>-<?php echo $row['model']; ?> ) </option>
                    <?php
				}
			?>
                </select>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <select class="model-box select2" name="emp" style="width: 100%;">
                <option value="0">Select Employee </option>

                    <?php  
                $result = $db->prepare("SELECT * FROM mechanic ");
                $result->bindParam(':userid', $res);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){ ?>
                    <option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?></option>
                    <?php	} ?>
                </select>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <select class="model-box select2" name="type" style="width: 100%;">

                    <?php  $invo = $_GET['id'];
                  $result = $db->prepare("SELECT * FROM job_type WHERE action='' ORDER by order_no ASC ");
                 $result->bindParam(':userid', $res);
                 $result->execute();
                 for($i=0; $row = $result->fetch(); $i++){ ?>
                    <option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?></option>
                    <?php	} ?>
                </select>
            </div>

            

            <br>
            <textarea name="note" class="model-box" placeholder="Note"
                style="width: 90%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <input type="text" name="d1" id="d1" class="model-box" readonly onclick="calender('d1')" placeholder="Date" required>
            </div>


            <br>
            <input type="submit" value="Save" class="login-btn">
            <input type="hidden" name="end" value="app">
        </form>
    </center>
</body>

<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Select2 -->
<script src="../../../plugins/select2/select2.full.min.js"></script>
<script src="js/datepik.js"></script>

<script>
$(function() {
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>

</html>