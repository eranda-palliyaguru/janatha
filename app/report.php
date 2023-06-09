<!DOCTYPE html>
<html lang="en">

<head>
<?php include('hed.php'); ?>
</head>

<body>
    <?php include('preload.php'); include("../connect.php"); $date=date('Y-m-d');?>
    <br><br>
    <h2 style="margin: 15px; color:#dbdbdb">Reports</h2>
    <br>
    <div class="model-box" style="margin:15px">

        <div align="right" style="width:100%;">
            <a style="width:30%;" href="sales_rp.php?d1=<?php  echo date("Y-m-d"); ?>&d2=<?php  echo date("Y-m-d"); ?>">
                <div
                    style="background-color: #9A2222; color:#dbdbdb; width:40%; text-align: center; border-radius: 0px 15px 0px 15px ; ">
                    Sales Report ></div>
            </a>
        </div>
        <div class="align-line">
            <h3 style="margin: 15px; color:#B5B5B8">
            Rs.<?php 
        $result1 = $db->prepare("SELECT  sum(amount) FROM sales WHERE action='active' AND date='$date' ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ echo number_format($row1['sum(amount)'],2);} ?>
        </h3>
            <div style="margin: 10px;" class="sparkline" data-type="bar" data-width="60%" data-height="40px"
                data-bar-Width="5" data-bar-Spacing="9" data-bar-Color="#B5B5B8">
                <?php 
        $result1 = $db->prepare("SELECT  sum(amount) FROM sales WHERE action='active' GROUP BY date ORDER BY date DESC LIMIT 14  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ echo $row1['sum(amount)'].",";} ?>
            </div>
        </div>
    </div>
   

    <div class="model-box" style="margin:15px">
        <div align="right" style="width:100%;">
            <a style="width:30%;" href="#<?php // echo $row['customer_id']; ?>">
                <div
                    style="background-color: #272946; color:#B5B5B8; width:40%; text-align: center; border-radius: 0px 15px 0px 15px; ">
                    Expenses Report ></div>
            </a>
        </div>
        <div class="align-line">
            <h3 style="margin: 15px; color:#B5B5B8">
        Rs.<?php 
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date='$date' ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ echo number_format($row1['sum(amount)'],2);} ?>
        </h3>
            <div style="margin: 10px;" class="sparkline" data-type="bar" data-width="60%" data-height="40px"
                data-bar-Width="10" data-bar-Spacing="9" data-bar-Color="#B5B5B8">
                <?php 
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records  GROUP BY date ORDER BY date DESC LIMIT 9  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ echo $row1['sum(amount)'].",";} ?>
            </div>
        </div>
    </div>
    

    <div class="model-box" style="margin:15px">
        <div align="right" style="width:100%;">
            <a style="width:30%;" href="#">
                <div
                    style="background-color: #0E8028; color:#dbdbdb; width:40%; text-align: center; border-radius: 0px 15px 0px 15px; ">
                    PNL Report</div>
            </a>
        </div>
        <div class="align-line">
            <h3 style="margin: 15px; color:#B5B5B8">Rs.
            <?php 
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date='$date' ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ echo number_format($row1['sum(profit)'],2);} ?>
        
        </h3>
            <div style="margin: 10px;" class="sparkline" data-type="bar" data-width="60%" data-height="40px"
                data-bar-Width="5" data-bar-Spacing="9" data-bar-Color="#B5B5B8">
                <?php 
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' GROUP BY date ORDER BY date DESC LIMIT 14  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ echo $row1['sum(profit)'].",";} ?>
            </div>
        </div>
    </div>




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
<!-- Bootstrap 3.3.6 -->
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../../../plugins/morris/morris.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="../../../plugins/chartjs/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../../plugins/sparkline/jquery.sparkline.min.js"></script>

<script src="js/nav.js"></script>
<script>
$(function() {

    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline();

    //INITIALIZE SPARKLINE CHARTS
    $(".sparkline").each(function() {
        var $this = $(this);
        $this.sparkline('html', $this.data());
    });

});
</script>

</html>