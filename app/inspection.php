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
    <h2 style="margin:15px">Inspection</h2>
    <br>

    <center>
        <h1>
            <?php $id=$_GET["id"];
    $result = $db->prepare("SELECT * FROM job WHERE id='$id' ORDER by id ASC ");
                 $result->bindParam(':userid', $res);
                 $result->execute();
                 for($i=0; $row = $result->fetch(); $i++){ echo $row['vehicle_no']; } ?>
        </h1>


        <?php 
    $result = $db->prepare("SELECT *  FROM job_list  WHERE job_no='$id' ORDER BY id DESC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    ?>
        <div style="border-radius: 15px; background-color: #181929; color:aliceblue;  margin: 10px; color:#959595; ">
            <table width="100%" style="margin: 10px;">
                <tr>
                    <td style="font-size: 22px;"><?php echo $row['name']; ?></td>
                    <td style="color:#585757; width:20%"><?php echo $row['note']; ?></td>
                    <td width="15%">
                        <?php if($row['type']=="OK"){ ?>
                        <span style="color:#009C28;" class="material-symbols-outlined">
                            done
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

        <form action="inspection_save.php" method="post">


            <?php  
                  $result = $db->prepare("SELECT * FROM job_inspection WHERE type = '3' ORDER by id ASC ");
                 $result->bindParam(':userid', $res);
                 $result->execute();
                 for($i=0; $row = $result->fetch(); $i++){ ?>
            <input type="hidden" name="type<?php echo $row['id'] ?>" value="none">


            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="model-box" id="<?php echo $row['id']; ?>" style="margin-top: 15px; border-color:#9A4AFF;">
                    <div class="row">
                        <h3><?php echo $row['name'] ?></h3>
                        <textarea class="model-box" placeholder="Note"
                            style="width: 40%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                            name="note<?php echo $row['id'] ?>" id="" cols="70" rows="1"></textarea>
                        <label>
                            <input type="radio" name="type<?php echo $row['id'] ?>"
                                onclick="back(<?php echo $row['id'] ?>,'op1')" id="<?php echo $row['id'] ?>_op1"
                                value="GOOD">
                            <span class="material-symbols-outlined">
                                thumb_up
                            </span>

                        </label>

                        <label>
                            <input type="radio" name="type<?php echo $row['id'] ?>"
                                onclick="back(<?php echo $row['id'] ?>,'op2')" id="<?php echo $row['id'] ?>_op2"
                                value="BAD">
                            <span class="material-symbols-outlined">
                                thumb_down
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php  
                  $result = $db->prepare("SELECT * FROM job_inspection WHERE type = '2' ORDER by id ASC ");
                 $result->bindParam(':userid', $res);
                 $result->execute();
                 for($i=0; $row = $result->fetch(); $i++){ ?>
            <input type="hidden" name="type<?php echo $row['id'] ?>" value="none">


            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="model-box" id="<?php echo $row['id']; ?>" style="margin-top: 15px;">
                    <div class="row">
                        <h3><?php echo $row['name'] ?></h3>
                        <textarea class="model-box" placeholder="Note"
                            style="width: 40%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                            name="note<?php echo $row['id'] ?>" id="" cols="70" rows="1"></textarea>
                        <label>
                            <input type="radio" name="type<?php echo $row['id'] ?>"
                                onclick="back(<?php echo $row['id'] ?>,'op1')" id="<?php echo $row['id'] ?>_op1"
                                value="GOOD">
                            <span class="material-symbols-outlined">
                                thumb_up
                            </span>

                        </label>

                        <label>
                            <input type="radio" name="type<?php echo $row['id'] ?>"
                                onclick="back(<?php echo $row['id'] ?>,'op2')" id="<?php echo $row['id'] ?>_op2"
                                value="BAD">
                            <span class="material-symbols-outlined">
                                thumb_down
                            </span>
                        </label>

                        <label>
                            <input type="radio" name="type<?php echo $row['id'] ?>"
                                onclick="back(<?php echo $row['id'] ?>,'op3')" id="<?php echo $row['id'] ?>_op3"
                                value="Replace">
                            <span class="material-symbols-outlined">
                                swap_horiz
                            </span>
                        </label>

                        <label>
                            <input type="radio" name="type<?php echo $row['id'] ?>"
                                onclick="back(<?php echo $row['id'] ?>,'op4')" id="<?php echo $row['id'] ?>_op4"
                                value="Clean">
                            <span class="material-symbols-outlined">
                                mop
                            </span>
                        </label>

                    </div>
                </div>
            </div>
            <?php } ?>
            <br>
            <input type="submit" value="Save" class="login-btn">
            <input type="hidden" name="job_no" value="<?php echo $id; ?>">
        </form>
    </center>
    <br><br><br><br>
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
    if (op == "op3") {
        document.getElementById(id).style.backgroundColor = "#169886";
    }
    if (op == "op4") {
        document.getElementById(id).style.backgroundColor = "#162298";
    }
}
</script>

</html>