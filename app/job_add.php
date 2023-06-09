<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('hed.php'); ?>
    <link rel="stylesheet" href="css/datepik.css">
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
    <h2 style="margin:15px">ADD NEW JOB</h2>
    <br>

    <center>
        <form action="../job_save.php" method="post">
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
                <input type="number" class="model-box" style="width: 100%;" name="km" placeholder="Mileage">
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <select class="model-box" name="type" style="width: 100%;">

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

            <?php  
                  $result = $db->prepare("SELECT * FROM job_inspection WHERE type='1' ORDER by id ASC ");
                 $result->bindParam(':userid', $res);
                 $result->execute();
                 for($i=0; $row = $result->fetch(); $i++){ ?>
                 <input type="hidden" name="type" value="non">


            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="model-box" id="<?php echo $row['id']; ?>" style="margin-top: 15px;">
                    <div class="row">
                        <h3><?php echo $row['name'] ?></h3>
                        <textarea class="model-box" placeholder="Note"
                            style="width: 60%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                            name="note<?php echo $row['id'] ?>" id="" cols="70" rows="1"></textarea>
                        <label>
                            <input type="radio" name="type<?php echo $row['id'] ?>"
                                onclick="back(<?php echo $row['id'] ?>,'op1')" id="<?php echo $row['id'] ?>_op1"
                                value="OK">
                            <span class="material-symbols-outlined">
                                done
                            </span>
                        </label>

                        <label>
                            <input type="radio" name="type<?php echo $row['id'] ?>"
                                onclick="back(<?php echo $row['id'] ?>,'op2')" id="<?php echo $row['id'] ?>_op2"
                                value="NO">
                            <span class="material-symbols-outlined">
                                block
                            </span>
                        </label>

                    </div>
                </div>
            </div>
            <?php } ?>
            <br>
            <input type="submit" value="Save" class="login-btn">
            <input type="hidden" name="end" value="app">
        </form>
    </center>
</body>
<script>
function back(id, op) {
    option = document.getElementById(op);
    if (op == "op1") {
        document.getElementById(id).style.backgroundColor = "#009C28";
    }
    if (op == "op2") {
        document.getElementById(id).style.backgroundColor = "#BE0909";
    }
}
</script>

</html>