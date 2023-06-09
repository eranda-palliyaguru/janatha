<!DOCTYPE html>
<html lang="en">

<head>
<?php include('hed.php'); ?>
</head>

<body>
<?php include('preload.php'); include("../connect.php"); $id=$_GET['id']; $back=Str_replace('*','&',$_GET['back']);?>
    <br><br>
    <a href="<?php echo $back; ?>"><i style="font-size:30px; color:#3A3939; margin:6%" class="ion-chevron-left"></i></a>
    <br>
    <H2 style="margin: 10px;">INVOICE</H2>
    <br><br>
<?php $result1 = $db->prepare("SELECT * FROM sales WHERE action='active' AND transaction_id='$id' ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ ?>
    
    <h3 style="margin: 10px;"><?php echo $row1['customer_name']; ?></h3>
    <p style="margin: 10px;"><?php echo $row1['vehicle_no']; ?></p>
    <p align="right" style="margin: 10px;">INVOICE NO: <?php echo $invo=$row1['invoice_number']; ?></p>
    <p align="right" style="margin: 10px;"><?php echo $row1['date']; ?></p>


<br>
<div class="model-box">
<table style="width: 96%;  margin:2%; text-align:center;">
        <thead>
            <tr style="background-color: #00525E;">
                <td>item</td>
                <td>qty</td>
                <td align="right">price</td>
                <td align="right">amount</td>
            </tr>
        </thead>
        <tbody>
<?php $result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' ");
        $result->bindParam(':userid', $date);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){ ?>
            <tr style="border-color: #959595;">
                <td width="60%"><?php echo $row['name']; ?></td>
                <td><?php echo $row['qty']; ?></td>
                <td align="right"><?php echo $row['price']/$row['qty']; ?></td>
                <td align="right"><?php echo $row['price'] ?></td>
            </tr>
            <tr>
                <td> _</td>
            </tr>
            <?php } ?>
        </tbody>

    </table>
</div>

<div class="model-box">
<h3 align="right" style="margin: 10px;">Rs.<?php echo number_format($row1['amount'],2); ?></h3>
<h3 align="right" style="margin: 10px;"><?php echo $row1['pay_type'] ?></h3>
</div>
<?php } ?>
</body>

</html>