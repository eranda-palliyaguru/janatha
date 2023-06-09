<!DOCTYPE html>
<html lang="en">

<head>
<?php include('hed.php'); ?>
</head>

<body>
    <br> <a href="customer.php"><i style="font-size:30px; color:#3A3939; margin:6%" class="ion-chevron-left"></i></a>
    <?php include("../connect.php");
$id=$_GET["id"];
$result = $db->prepare("SELECT *  FROM customer INNER JOIN vehicle ON customer.id=vehicle.customer_id  WHERE vehicle.id='$id'  ");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 
?>

    <h2 style="color: #fff; margin:20px"><?php echo $model_name=$row['model']; ?></h2>
    <p style="color: #B6B6B6; margin:-10px 30px 30px 30px; font-size:20px"><?php echo $vehicle=$row['vehicle_no']; ?>
    </p>
    <br><br><br>
    <?php 
$result1 = $db->prepare("SELECT *  FROM model  WHERE name='$model_name'  ");
$result1->bindParam(':userid', $date);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){ 
?>
    <center><img src="../<?php echo $row1['parth']; ?>" width="300px"></center>
    <?php } ?>

    <br><br><br><br><br>

    <div class="hederbar" style="overflow-x:auto;">
        <table>
            <tr>
                
                <td>
                    <div style="height: 190px; margin: 10px 10px 10px 50px; width:110px " class="model-box">

                        <img style="width: 60px; margin:25px; color:#dbdbdb;" src="img/paint gun.svg" alt="">
                        <P style="color: #585757 ;">COLOR</P>
                        <p style="padding-bottom: 5px; color:#959595; "><?php echo $row['color'] ?></p>
                    </div>
                </td>

                <td>
                    <div style="height: 190px; margin: 10px; width:110px " class="model-box">
                        <img style="width: 60px; margin:25px; color:#dbdbdb;" src="img/emging.svg" alt="">
                        <P style="color: #585757 ;">ENGING NO</P>
                        <p style="font-size:10px; padding-bottom: 5px; color:#959595; "><?php echo $row['engine_no'] ?></p>
                    </div>
                </td>

                <td>
                    <div style="height: 190px;  margin: 10px; width:110px " class="model-box">
                        <img style="width: 60px; margin:25px; color:#dbdbdb;" src="img/car.svg" alt="">
                        <P style="color: #585757 ;">CHASSIS NO</P>
                        <p style="font-size:10px; padding-bottom: 5px; color:#959595; "><?php echo $row['chassis_no'] ?>
                        </p>
                    </div>
                </td>

                <td>
                    <div style="height: 190px;  margin: 10px; width:110px " class="model-box">
                        <img style="width: 60px; margin:25px; color:#dbdbdb;" src="img/owner.svg" alt="">
                        <P style="color: #585757 ;">OWNER</P>
                        <p style="font-size:12px;padding-bottom: 5px; color:#959595; ">
                            <?php echo $row['customer_name'] ?></p>
                    </div>
                </td>

                <td>
                    <div style="height: 190px;  margin: 10px; width:110px " class="model-box">
                        <img style="width: 60px; margin:25px; color:#dbdbdb;" src="img/phone.svg" alt="">
                        <P style="color: gray;">CONTACT</P>
                        <p style="padding-bottom: 5px; color:#959595; "><?php echo $row['contact'] ?></p>
                    </div>
                </td>



            </tr>
        </table>
    </div>
    <?php } ?>

    <?php 
    $result = $db->prepare("SELECT *  FROM sales  WHERE vehicle_no='$vehicle' AND action='active' ORDER BY transaction_id DESC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    ?>
    <div
        style="border-radius: 15px; background-color: #181929; color:aliceblue;  margin: 10px; color:#959595; text-align: center;">
        <table width="100%">
            <tr>
                <td><img style="width: 60px; margin:10px; color:#dbdbdb;" src="img/invoice.png" alt=""></td>
                <td>
                    <p style="color: #fff;">INVOICE NUMBER - <?php echo $row['invoice_number'] ?></p>
                    <table width="100%">
                        <tr>
                            <td>
                                <p><?php echo $row['date'] ?></p>
                            </td>
                            <td style="text-align: center;">
                                <p>Rs.<?php echo $row['amount']; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div align="right" style="width:100%;">
            <a href="invoice.php?id=<?php echo $row['transaction_id']; ?>&back=profile.php?id=<?php echo $_GET['id'] ?>">
                <div
                    style="background-color: #850808; color:#999797; width:30%; text-align: center; border-radius: 15px 0px 15px 0px; ">
                    VIEW</div>
            </a>
        </div>
    </div>
    <?php } ?>





    <br><br><br>
</body>


</html>