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

header("location:./../../../index.php");
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
        $(".delbutton").click(function() {
            //Save the link in a variable called element
            var element = $(this);
            //Find the id of the link that was clicked
            var del_id = element.attr("id");
            //Built a url to send
            var info = 'id=' + del_id;
            if (confirm("Sure you want to delete this Product? There is NO undo!")) {
                $.ajax({
                    type: "GET",
                    url: "sales_dll.php",
                    data: info,
                    success: function() {}
                });
                $(this).parents(".record").animate({
                        backgroundColor: "#fbc7c7"
                    }, "fast")
                    .animate({
                        opacity: "hide"
                    }, "slow");
            }
            return false;
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
                Employee
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Advanced Elements</li>
            </ol>
        </section>
        <section class="content">


            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <center>
                            <h2>Save New Employee</h2>
                        </center>

                    </div>
                    <div class="modal-body">
                        <form method="post" action="hr_employee_save.php">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h3>Full Name</h3>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h3>Phone No</h3>
                                            <input class="form-control" type="text" name="phone_no">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h3>NIC</h3>
                                            <input class="form-control" type="text" name="nic">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h3>Address</h3>
                                            <input class="form-control" type="text" name="address">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h3>Hour Rate</h3>
                                            <input class="form-control" type="text" name="rate">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h3>Designation</h3>
                                            <select class="form-control" name="type" >
                                                <?php 
                                                $result = $db->prepare("SELECT * FROM Employees_des ");
                                                $result->bindParam(':userid', $res);
                                                $result->execute();
                                                for($i=0; $row = $result->fetch(); $i++){
                                                ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h3>EPF NO</h3>
                                            <input class="form-control" type="text" name="etf_no">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h3>EPF Amount</h3>
                                            <input class="form-control" type="text" name="etf_amount">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box -->
                            <input class="btn btn-info" type="submit" value="Save">
                        </form>
                    </div>

                </div>
            </div>
            <button class="btn btn-info" id="myBtn">Add Employee</button>

            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Employee Data</h3>

                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone NO</th>
                                <th>NIC</th>
                                <th>EPF</th>
                                <th>EPF No</th>
                                <th>Designation</th>
                                <th>Hour Rate</th>
                                
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                          $result = $db->prepare("SELECT * FROM Employees   ");
				                  $result->bindParam(':userid', $date);
                          $result->execute();
                          for($i=0; $row = $result->fetch(); $i++){	?>
                            <tr>
                                <td><?php echo $id=$row['id'];?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $vehi=$row['phone_no'];?></td>
                                <td><?php echo $row['nic'];?></td>
                                <td>Rs.<?php echo $row['epf_amount'];?></td>
                                <td><?php echo $row['epf_no'];?></td>
                                <td><?php echo $row['des'];?></td>
                                <td>Rs.<?php echo $row['hour_rate'];?></td>
                                
                            </tr>
                            <?php  }  ?>
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
    <!-- /.content -->
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
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


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