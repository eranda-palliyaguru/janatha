<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('hed.php'); ?>
</head>

<body>
    <br> <a href="index.php"><i style="font-size:30px; color:#3A3939; margin:6%" class="ion-chevron-left"></i></a>
    <?php include("../connect.php");
$id=$_GET["id"];
$result = $db->prepare("SELECT *  FROM job WHERE id='$id'");
$result->bindParam(':userid', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 
    $note=$row['note'];
    $invo=$row['invoice_no'];
    $cus_id=$row['cus_id'];
    $vehicle_id=$row['vehicle_id'];


$result1 = $db->prepare("SELECT *  FROM customer  WHERE id='$cus_id'  ");
$result1->bindParam(':userid', $date);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){ }

$result1 = $db->prepare("SELECT *  FROM vehicle  WHERE id='$vehicle_id'  ");
$result1->bindParam(':userid', $date);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){ $model_name=$row1['model']; }
?>

    <h2 style="color: #fff; margin:20px"><?php echo $model_name; ?></h2>
    <p style="color: #B6B6B6; margin:-10px 30px 30px 30px; font-size:20px"><?php echo $vehicle=$row['vehicle_no']; ?>
    </p>
    <br>
    <div
        style="border-radius: 15px; background-color: #181929; color:aliceblue;  margin: 10px; text-align: center;">
        <table width="100%">
            <tr>
                <td style="color:#585757">
                <span class="material-symbols-outlined" style="margin: 10px;">
                        shopping_cart
                    </span>
                </td>
                <td style="color:#585757">
                    
                    Bill Amount <br>
                    <b style="color: #dbdbdb; font-size:18px;">Rs.<?php $resultm = $db->prepare("SELECT sum(price) FROM sales_list WHERE invoice_no = '$invo' ");
		$resultm->bindParam(':userid', $res);
		$resultm->execute();
		for($i3=0; $rowm = $resultm->fetch(); $i3++){
		 echo number_format($rowm['sum(price)'],2);
		} ?></b>
                </td>
                <td><a href="sales.php?id=<?php echo $row['invoice_no']; ?>">
                        <div class="btn"
                            style="background-color: #3A3939; border-radius: 5px;  margin: 10px; border:0px; color:#737373;">

                            <i style="font-size: 18px;">Go Invoice</i>
                        </div>
                    </a>
                </td>
            </tr>
        </table>

    </div>
    <?php } ?>
    <br>
    <?php 
$result1 = $db->prepare("SELECT *  FROM model  WHERE name='$model_name'  ");
$result1->bindParam(':userid', $date);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){ 
?>
    <center><img src="../<?php echo $row1['parth']; ?>" width="300px"></center>
    <?php } ?>

    <br><br><br>
    <div
        style="border-radius: 15px; background-color: #181929; color:aliceblue;  margin: 10px;">
        <table width="98%" style="margin: 10px;">
            <tr>
                <td style="color:#585757">
                Job Note: <b style="color:#B6B6B6"><?php echo $note; ?></b> 
                </td>
                
                <td width="30%"><a href="inspection.php?id=<?php echo $id; ?>">
                        <div class="btn"
                            style="background-color: #3A3939; border-radius: 5px;  margin: 10px; border:0px; color:#737373;">

                            <i style="font-size: 18px;">Go inspection</i>
                        </div>
                    </a>
                </td>
            </tr>
        </table>

    </div>
   

   
   

    <?php 
    $result = $db->prepare("SELECT *  FROM job_list  WHERE job_no='$id' ORDER BY id DESC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    ?>
    <div
        style="border-radius: 15px; background-color: #181929; color:aliceblue;  margin: 10px; color:#959595; ">
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

<br><br>
<?php 
$result1 = $db->prepare("SELECT *  FROM customer INNER JOIN vehicle ON customer.id=vehicle.customer_id WHERE vehicle.id='$vehicle_id'  ");
$result1->bindParam(':userid', $date);
$result1->execute();
for($i=0; $row = $result1->fetch(); $i++){ 
?>
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
                        <p style="font-size:10px; padding-bottom: 5px; color:#959595; "><?php echo $row['engine_no'] ?>
                        </p>
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



    <br><br><br>
</body>


</html>