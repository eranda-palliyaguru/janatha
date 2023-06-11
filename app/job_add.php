<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('hed.php'); ?>
    <link rel="stylesheet" href="css/select2.app.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

<body >
    <?php include('preload.php'); include("../connect.php"); ?>
    <br><br>
    <a href="index.php"><i style="font-size:30px; color:#3A3939; margin:6%" class="ion-chevron-left"></i></a>
    <a href="customer_add.php" class="pull-right"> <button class="model-box color-red" style="width: 150px;">ADD CUSTOMER</button> </a>
    <br><br>
    <h2 style="margin:15px">ADD NEW JOB</h2>
    <br>

    <center>


        
        <form action="../job_save.php" method="post" enctype="multipart/form-data">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <select class="model-box select2 " name="cus" style="width: 100%;">
                <option value="0" selected disabled>Vehicle No</option>
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

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <input type="file" name="fileToUpload" id="fileToUpload" class="model-box">
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <select class="model-box" name="rp" style="width: 100%;" tabindex="1" autofocus >
				 
                 <?php  $invo = $_GET['id'];
                  $result = $db->prepare("SELECT * FROM Employees WHERE type='2'  ");
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

            
            <br>
            <input type="submit" value="Save" name="submit" class="login-btn">
            <input type="hidden" name="end" value="app">
        </form>
    </center>
</body>

<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Select2 -->
<script src="../../../plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="js/cam/webcam.min.js"></script>

    <script ype="text/javascript">
        navigator.mediaDevices.enumerateDevices()
            .then(function(devices) {
                var videoDevices = devices.filter(function(device) {
                    return device.kind === 'videoinput';
                });

                var constraints = {
                    video: {
                        facingMode: {
                            exact: 'environment' // Use 'environment' for back camera
                        }
                    }
                };

                if (videoDevices.length > 0) {
                    constraints.video.deviceId = videoDevices[0].deviceId;
                }

                navigator.mediaDevices.getUserMedia(constraints)
                    .then(function(stream) {
                        var video = document.getElementById('video');
                        video.srcObject = stream;
                        video.play();
                    })
                    .catch(function(error) {
                        console.log("Error accessing camera: " + error);
                    });
            })
            .catch(function(error) {
                console.log("Error enumerating devices: " + error);
            });

        document.getElementById('capture-btn').addEventListener('click', function() {
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video');

            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            canvas.toBlob(function(blob) {
                var formData = new FormData();
                formData.append('photo', blob, 'photo.jpg');

                $.ajax({
                    url: 'upload_photo.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Photo uploaded successfully.');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error uploading photo: ' + error);
                    }
                });
            }, 'image/jpeg', 0.9);
        });
    </script>


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

$(function() {
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>

</html>