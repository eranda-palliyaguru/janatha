<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
date_default_timezone_set("Asia/Colombo");
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





    <script src='js/jquery-1.12.3.js'></script>
    <script src='js/jquery.dataTables.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script>
    $(document).ready(function() {
        $('button').click(function() {
            $('.cctv').load('terms3.php');

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
                Package
                <small>Preview</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <!-- SELECT2 EXAMPLE -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Package and Promotion</h3>









                    <!-- /.box-header -->
                    <div class="form-group">



                        <div class="box-body">



                            <div class="row">
                                <div class="col-md-5">
                                    <form method="post" action="package_save.php">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control select2" name="type" style="width: 100%;"
                                                    autofocus tabindex="1">
                                                    <option value="1">Package</option>
                                                    <option value="2">Promotion</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="number" class="form-control" name="amount">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Model</label>
                                                <select class="form-control select2" name="model" style="width: 100%;"
                                                    autofocus tabindex="1">
                                                    <option value="0">All Model</option>
                                                    <?php
                                                                            $result = $db->prepare("SELECT * FROM model ");
		                                                                        $result->bindParam(':userid', $res);
		                                                                        $result->execute();
		                                                                        for($i=0; $row = $result->fetch(); $i++){
	                                                                         ?>
                                                    <option value="<?php echo $row['id'];?>">
                                                        <?php echo $row['manufacture_name'].'-'.$row['name']; ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="text" value='<?php  echo date("Y-m-d"); ?> '
                                                    id="datepicker" name="d1" class="form-control pull-right">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="text" value='<?php  echo date("Y-m-d"); ?> '
                                                    id="datepickerd" name="d2" class="form-control pull-right">
                                            </div>
                                        </div>
                                        <input class="btn btn-info pull-right" type="submit" value="Submit">

                                    </form>

                                </div>
                                <div class="col-md-7">

                                    <div class="col-md-6">
                                        <label>Service</label>
                                        <select class="form-control select2" name="category" style="width: 100%;"
                                            id="mat">

                                            <?php
                                                                            $result = $db->prepare("SELECT * FROM product  ");
		                                                                        $result->bindParam(':userid', $res);
		                                                                        $result->execute();
		                                                                        for($i=0; $row = $result->fetch(); $i++){
	                                                                         ?>
                                            <option value="<?php echo $row['product_id'];?>">
                                            <?php echo $row['code'];?>  <?php echo $row['name']; ?> __ Rs.<?php echo $row['sell'];?>
                                            </option>
                                            <?php }    ?>
                                        </select>
                                    </div>

                                    <div class="col-md-2"><label>QTY</label>
                                        <input class="form-control" type="number" name="qty" id="qty" width="30%">
                                    </div>

                                    <div class="col-md-3"> <label>price</label>
                                        <input class="form-control" type="number" name="price" id="price">
                                    </div>
                                    <label>.</label>
                                    <div class="col-md-1"><b class="btn btn-success" onclick="matadd()">ADD</b>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="form-group" id="sub_list">
                                            <table width='100%' id="my" class='table'>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>QTY</th>
                                                    <th>Cost</th>
                                                    <th>O Price</th>
                                                    <th>Price</th>
                                                    <th>#</th>
                                                </tr>
                                                <?php $result = $db->prepare("SELECT * FROM package_list WHERE package_id ='0' ");
                                        $result->bindParam(':userid', $res);
                                        $result->execute();
                                        for($i=0; $row = $result->fetch(); $i++){
                                        ?>
                                                <tr class="pack_record">
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td><?php echo $row['cost']; ?></td>
                                                    <td>Rs.<?php echo $row['o_price']; ?></td>
                                                    <td>Rs.<?php echo $row['price']; ?></td>
                                                    <td>
                                                        <b class="btn btn-danger dllpack" id="<?php echo $row['id']; ?>"
                                                            onclick="dll(<?php echo $row['id']; ?>)"><i
                                                                class="icon-trash">x</i></b>
                                                    </td>
                                                </tr>

                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>





                                <div class="form-group">




                                </div>
                            </div>


                            <!-- /.box -->
                            <div class="form-group">








                                <div class="cctv">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php $result = $db->prepare("SELECT * FROM package WHERE action='0'  ");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ $type=$row['type'];  ?>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div
                    class="small-box bg-<?php if($type==2){echo "red"; $type_name="Promotion";}else{echo "green"; $type_name="Package";} ?>">
                    <div class="inner">
                        <h3><?php  echo $row['name']; ?></h3>

                        <p><?php echo $type_name; ?></p>
                        <b style="font-size: 15px;">Rs.<?php echo $row['amount'] ?></b>
                    </div>
                    <div class="icon">
                        <i class="ion ion-hammer"></i>
                    </div>
                </div>
            </div>
            <?php } ?>
    </div>

    <!-- /.content-wrapper -->
    <?php
  include("dounbr.php");
?>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

    <script src="js/jquery.js"></script>

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
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



    <!-- Select2 -->
    <script src="../../plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- bootstrap color picker -->





    <script type="text/javascript">

// Get the input field
var amount_box = document.getElementById("price");
var qty = document.getElementById("qty");

// Execute a function when the user presses a key on the keyboard
amount_box.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    matadd();
    document.getElementById("mat").focus();
  }
});


qty.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("price").focus();
  }
});



    function matadd() {
        var mat = document.getElementById("mat").value;
        var qty = document.getElementById("qty").value;
        var price = document.getElementById("price").value;
        var xmlhttp;

        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("sub_list").innerHTML = xmlhttp.responseText;
                document.getElementById("qty").value="";
                document.getElementById("price").value="";
            }
        }

        xmlhttp.open("GET", "package_list_save.php?mat=" + mat + "&qty=" + qty + "&price=" + price, true);
        xmlhttp.send();
    }


    function dll(did) {

        var xmlhttp;

        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("sub_list").innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "package_list_dll.php?id=" + did, true);
        xmlhttp.send();
    }




    $(function() {
        $(".delbutton").click(function() {
            //Save the link in a variable called element
            var element = $(this);
            //Find the id of the link that was clicked
            var del_id = element.attr("id");
            //Built a url to send
            var info = 'id=' + del_id;
            if (confirm("Sure you want to delete this Collection? There is NO undo!")) {

                $.ajax({
                    type: "GET",
                    url: "expenses_dll.php",
                    data: info,
                    success: function() {

                    }
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








    <!-- Page script -->
    <script>
    $(function() {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("YYYY-MM-DD", {
            "placeholder": "YYYY-MM-DD"
        });
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("YYYY-MM-DD", {
            "placeholder": "YYYY-MM-DD"
        });
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        //$('#datepicker').datepicker({datepicker: true,  format: 'yyyy/mm/dd '});
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'));
            }
        );

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true,
            datepicker: true,
            format: 'yyyy-mm-dd '
        });
        $('#datepicker').datepicker({
            autoclose: true
        });



        $('#datepickerd').datepicker({
            autoclose: true,
            datepicker: true,
            format: 'yyyy-mm-dd '
        });
        $('#datepickerd').datepicker({
            autoclose: true
        });





        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });
    });
    </script>












</body>

</html>