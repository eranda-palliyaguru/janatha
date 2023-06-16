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
                Attendance
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- SELECT2 EXAMPLE -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">ADD New Attendance</h3>


                    <!-- /.box-header -->
                    <div class="form-group">

                        <form method="post" action="hr_attendance_save.php">

                            <div class="box-body">



                                <!-- /.box -->
                                <div class="form-group">


                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">

                                                    
                                                        <select class="form-control select2" name="id"
                                                            style="width: 100%;" tabindex="1" autofocus>

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

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <label>Date (<b style="color:brown">YYYY-MM-DD</b>)</label>
                                                        </div>
                                                        <input type="text" class="form-control" name="date"
                                                            value="<?php echo date('Y-m-d') ?>" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <label>Time (<b style="color:brown">HH.mm</b>)</label>
                                                        </div>
                                                        <input type="text" class="form-control" name="time"
                                                            value="<?php echo date('H.i') ?>" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select class="form-control" name="type" id="">
                                                        <option>IN</option>
                                                        <option>OUT</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                <input class="btn btn-info" type="submit" value="Submit">
                                                </div>
                                            </div>

                                        </div>







                                    </div>


                                    

                        </form>
                        <!-- /.box -->

                    </div>
                    <!-- /.col (left) -->



                    <!-- /.box-body -->

                </div>
            </div>
            <!-- /.box -->
    </div>
    <!-- /.col (right) -->
    </div>
    <!-- /.row -->

    </section>
    <!-- /.content -->

    <section class="content">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Attendance List</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>name</th>
                            <th>Date</th>
                            <th>IN</th>
                            <th>OUT</th>
                            <th>Hour count</th>
                            <th>OT</th>
                        </tr>

                    </thead>

                    <tbody>
                        <?php
   
                $result = $db->prepare("SELECT * FROM attendance ORDER BY id DESC LIMIT 50");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){

				
			?>
                        <tr>
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['date']?></td>
                            <td><?php echo $row['IN_time'];?></td>
                            <td><?php echo $row['OUT_time'];?></td>
                            <td><?php echo $row['deff_time']?></td>
                            <td><?php echo $row['ot']?></td>

                            <?php	} ?>
                        </tr>


                    </tbody>
                    <tfoot>







                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
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