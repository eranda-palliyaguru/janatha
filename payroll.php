<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
?>

<body class="hold-transition skin-blue sidebar-mini">
    <?php 
include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];

if($r =='Cashier'){

include_once("sidebar2.php");
}
if($r =='admin'){

include_once("sidebar.php");
}
?>




    <link rel="stylesheet" href="datepicker.css" type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(function() {
        $("#datepicker1").datepicker({
            dateFormat: 'yy/mm/dd'
        });
        $("#datepicker2").datepicker({
            dateFormat: 'yy/mm/dd'
        });

    });
    </script>




    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Payroll
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
            </ol>
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Payroll</h3>


                            <!-- /.box-header -->
                            <div class="form-group">

                                <form method="get" action="">

                                    <div class="box-body">
                                        <!-- /.box -->
                                        <div class="form-group">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <label>Employee</label>
                                                                </div>
                                                                <select class="form-control select2" name="id"
                                                                    style="width: 100%;" tabindex="1" autofocus>
                                                                    <option value="0"></option>
                                                                    <?php  
                                                             $result = $db->prepare("SELECT * FROM Employees ");
		                                                     $result->bindParam(':userid', $res);
		                                                     $result->execute();
		                                                     for($i=0; $row = $result->fetch(); $i++){ ?>
                                                                    <option value="<?php echo $row['id'];?>">
                                                                        <?php echo $row['name']; ?>
                                                                    </option>
                                                                    <?php	} ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="form-control select2" name="year"
                                                                style="width: 100%;" tabindex="1" autofocus>
                                                                <option> <?php echo date('Y')-1 ?> </option>
                                                                <option selected> <?php echo date('Y') ?> </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="form-control select2" name="month"
                                                                style="width: 100%;" tabindex="1" autofocus>
                                                                <?php for($x = 1; $x <= 12; $x++){ ?>
                                                                <option> <?php echo sprintf("%02d", $x); ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <input class="btn btn-info" type="submit" value="Submit">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                                <?php
                                function AddPlayTime($times) {
                                    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
                                    // loop throught all the times
                                    foreach ($times as $time) {
                                        list($hour, $minute) = explode('.', $time);
                                        $minutes += $hour * 60;
                                        $minutes += $minute;
                                    }
                                
                                    $hours = floor($minutes / 60);
                                    $minutes -= $hours * 60;
                                
                                    // returns the time already formatted
                                    return sprintf('%02d.%02d', $hours, $minutes);
                                }
                                
                                if(isset($_GET['id'])){ 
                                    $id=$_GET["id"];
                                    $d1=$_GET['year'].'-'.$_GET['month'].'-01';
                                    $d2=$_GET['year'].'-'.$_GET['month'].'-31';  $h=0;$m=0;
                                    $result = $db->prepare("SELECT deff_time,ot FROM attendance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){ 
                                        $hour[]=$row['deff_time'];
                                        $ot[]=$row['ot'];
                                    }

                                    $result = $db->prepare("SELECT count(id) FROM attendance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){ 
                                        $day=$row['count(id)'];
                                    }

                                    $result = $db->prepare("SELECT * FROM Employees WHERE id='$id' ");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for($i=0; $row = $result->fetch(); $i++){ 
                                        $name=$row['name'];
                                        $rate=$row['day_rate'];
                                    }

                                    ?>
                                <table class="table">
                                    <tr>
                                        <td>Number of days worked</td>
                                        <td><?php echo $day; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Work Hours</td>
                                        <td><?php echo AddPlayTime($hour); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Overtime</td>
                                        <td><?php echo $ot=AddPlayTime($ot); ?></td>
                                    </tr>

                                    <tr>
                                        <td>Day Rate</td>
                                        <td>Rs.<?php echo $rate; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Basic</td>
                                        <td>Rs.<?php echo number_format( $basic=$day*$rate,2); ?></td>
                                    </tr>
                                    <tr>
                                        <td>OT</td>
                                        <td>Rs.<?php echo $ot_tot=($rate/100 * 42.86)*$ot; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>Rs.<?php echo $ot_tot+$basic ?></td>
                                    </tr>
                                </table>
                                <?php } ?>
                                <!-- /.box -->
                            </div>
                            <!-- /.col (left) -->

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <?php if(isset($_GET['id'])){ ?>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Attendance List</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>IN</th>
                                        <th>OUT</th>
                                        <th>W time</th>
                                        <th>OT</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    <?php
                            $result = $db->prepare("SELECT * FROM attendance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
				            $result->bindParam(':userid', $date);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){
                                ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['date']?></td>
                                        <td><?php echo $row['IN_time'];?></td>
                                        <td><?php echo $row['OUT_time'];?></td>
                                        <td><?php echo $row['deff_time']; ?></td>
                                        <td><?php echo $row['ot']; ?></td>

                                        <?php	} ?>
                                    </tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <?php } ?>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->

        <section class="content">


    </div>

    </section>




    </div>

    <!-- /.content-wrapper -->
    <?php
  include("dounbr.php");
?>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- InputMask -->
    <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- jQuery 2.2.3 -->
    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->
    <script>
    $(function() {


        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
    </script>
</body>

</html>