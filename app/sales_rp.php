<!DOCTYPE html>
<html lang="en">

<head>
<?php include('hed.php'); ?>
<link rel="stylesheet" href="css/datepik.css">

</head>

<body>
    <?php include('preload.php'); include("../connect.php"); $d1=$_GET["d1"]; $d2=$_GET["d2"];?>
    <br><br>
    <h2 style="margin:15px">Sales Report</h2>
    <br>

    <center>
        <div class="model-box" style="width: 350px;">
            <form action="" method="get">
                <input type="text" name="d1" id="d1" class="model-box v-1" readonly onclick="calender('d1')" value="<?php echo $d1 ?>"> to
                <input type="text" name="d2" id="d2" class="model-box v-1" readonly onclick="calender('d2')" value="<?php echo $d2 ?>">
                <input class="model-box" type="submit" value="Filter">
            </form>
        </div>
    </center>
    <br>


    <?php 
    $result = $db->prepare("SELECT count(amount), sum(amount)  FROM sales  WHERE action='active' AND date BETWEEN '$d1' AND '$d2' ORDER BY transaction_id DESC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){$bill=$row['count(amount)']; $total=$row['sum(amount)'];} 
    if($bill > 0){
    ?>
    <div class="model-box">
        <div style="display:grid; grid-template-columns: auto auto auto auto; margin: 15px 15px 5px 15px;">
        <p style="color:#858585">Number of Bill: <b style="color:#DC4444"><?php echo $bill; ?></b></p>
        <p style="color:#858585">Total Amount: <b style="color:#DC4444">Rs.<?php echo number_format($total,2) ?></b> </p>
        </div>
    </div>
    <?php }else{ ?>
        <br><br><br><br>
        <div class="model-box"><h3 style="margin: 10px 15px 15px 15px;">A record could not be found</h3></div>
        <?php } ?>


    <?php  
    $result = $db->prepare("SELECT *  FROM sales  WHERE action='active' AND date BETWEEN '$d1' AND '$d2' ORDER BY transaction_id DESC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
    ?>
    <div
        style="border-radius: 15px; background-color: #181929; color:aliceblue;  margin: 10px; color:#959595; text-align: center;">
        <table width="100%">
            <tr>
                <td width="10%"><img style="width: 80px; color:#dbdbdb;" src="img/invoice.png" alt=""></td>
                <td align="left">
                    <p style="color: #fff;">INVOICE NO - <?php echo $row['invoice_number'] ?></p>

                    <div class="align-line">

                    <b style="color:#DC4444"><?php echo $row['vehicle_no'] ?></b>
                        <p style="color:#858585"><?php echo $row['date'] ?></p>
                        <p>Rs.<?php echo $row['amount']; ?></p>
                        

                    </div>
                    

                </td>
            </tr>
        </table>
        <div align="right" style="width:100%;">
            <a href="invoice.php?id=<?php echo $row['transaction_id']; ?>&back=sales_rp.php?d1=<?php echo $d1; ?>*d2=<?php echo $d2; ?>">
                <div
                    style="background-color: #850808; color:#999797; width:30%; text-align: center; border-radius: 15px 0px 15px 0px; ">
                    VIEW</div>
            </a>
        </div>
    </div>
    <?php } ?>

    <br><br><br><br>
    <nav class="nav">
        <div class="nav-item" id="index.php">
            <i class="material-icons home-icon  menu-icon">
                home
            </i>
            <span class="nav-text">Home</span>
        </div>

        <div class="nav-item " id="customer.php">
            <i class="material-icons person-icon menu-icon">
                person
            </i>
            <span class="nav-text">Customer</span>
        </div>

        <div class="nav-item active" id="report.php">
            <i class="ion-stats-bars menu-icon"></i>
            <span class="nav-text">Reports</span>
        </div>

        <div class="nav-item" id="#">
            <i class="material-icons search-icon menu-icon">
                search
            </i>
            <span class="nav-text">Search</span>
        </div>
    </nav>
</body>
<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="js/nav.js"></script>
<script src="js/datepik.js"></script>

</html>