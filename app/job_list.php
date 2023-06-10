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
    <?php include("../connect.php"); ?>
    <br><br>
    <a href="job_view.php?id=<?php echo $_GET['id']; ?>"><i style="font-size:30px; color:#3A3939; margin:6%"
            class="ion-chevron-left"></i></a>
    <br><br>
    <h2 style="margin:15px">Job Listing</h2>
    <br>

    <center>
        <h1>
            <?php $id=$_GET["id"];
    $result = $db->prepare("SELECT * FROM job WHERE id='$id' ORDER by id ASC ");
                 $result->bindParam(':userid', $res);
                 $result->execute();
                 for($i=0; $row = $result->fetch(); $i++){ echo $row['vehicle_no']; } ?>
        </h1>



        <form action="job_list_save.php" method="post">

            <div class="col-xs-9 col-sm-8 col-md-8 col-lg-3">
                <input type="text" name="name" class="model-box" style="width: 100%;">
            </div>
            <div class="col-xs-3 col-sm-2 col-md-4 col-lg-3">
                <input type="submit" value="ADD" class="model-box">
            </div>
            <input type="hidden" name="job_no" value="<?php echo $id; ?>">
        </form>
    </center>

    <br><br><br><br>
    <?php 
    $result = $db->prepare("SELECT *  FROM job_list  WHERE job_no='$id' ORDER BY id DESC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    ?>
    <div style="border-radius: 15px; background-color: #181929; color:aliceblue;  margin: 10px; color:#959595; ">
        <table width="100%" style="margin: 10px;">
            <tr>
                <td style="font-size: 15px;"><?php echo $row['name']; ?></td>

                <?php if($row['type']=="pending"){ ?>

                <td width="15%">
                    Pending
                </td>
                <td width="15%">
                    <span style="color:#FFA245" class="material-symbols-outlined">
                        pending_actions
                    </span>
                    <?php } ?>

                    <?php if($row['type']=="NO"){ ?>
                    <span style="color:#BE0909" class="material-symbols-outlined">
                        block
                    </span>
                    <?php } ?>

                    <?php if($row['type']=="GOOD"){ ?>
                    <span style="color:#009C28" class="material-symbols-outlined">
                        thumb_up
                    </span>
                    <?php } ?>

                    <?php if($row['type']=="BAD"){ ?>
                    <span style="color:#BE0909" class="material-symbols-outlined">
                        thumb_down
                    </span>
                    <?php } ?>

                    <?php if($row['type']=="Replace"){ ?>
                    <span style="color:#169886" class="material-symbols-outlined">
                        swap_horiz
                    </span>
                    <?php } ?>

                    <?php if($row['type']=="Clean"){ ?>
                    <span style="color:#162298" class="material-symbols-outlined">
                        mop
                    </span>
                    <?php } ?>
                </td>
            </tr>
        </table>

    </div>
    <?php } ?>
</body>
<script>

</script>

</html>