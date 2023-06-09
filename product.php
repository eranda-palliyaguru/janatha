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
                Product and Service Form
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Product and Service Form</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- SELECT2 EXAMPLE -->
            <div class="box box-info">
                <div class="box-header with-border">



                    <!-- /.box-header -->
                    <div class="form-group">


                        <!-- /.box -->

                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Product</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Service</a></li>
                                    <li><a href="#tab_3" data-toggle="tab">Materials</a></li>
                                    <li><a href="#tab_4" data-toggle="tab">Quick Product</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <b>Product:</b>

                                        <form method="post" action="save_product.php">

                                            <div class="box-body">
                                                <!-- /.box -->
                                                <div class="form-group">
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> Name</label>
                                                                        </div>
                                                                        <input type="text" name="name"
                                                                            class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group date">
                                                                        <div class="input-group-addon">
                                                                            <label>Code</label>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="code" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> Sell Price</label>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="sell">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> Cost Price</label>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="cost">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> RE-Order level</label>
                                                                        </div>
                                                                        <input type="text" name="re_order"
                                                                            class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> Category</label>
                                                                        </div>
                                                                        <select class="form-control select2"
                                                                            name="category" style="width: 100%;"
                                                                            autofocus>

                                                                            <?php
                                                                            $result = $db->prepare("SELECT * FROM catogary_list ");
		                                                                        $result->bindParam(':userid', $res);
		                                                                        $result->execute();
		                                                                        for($i=0; $row = $result->fetch(); $i++){
	                                                                         ?>
                                                                            <option value="<?php echo $row['id'];?>">
                                                                                <?php echo $row['name']; ?>
                                                                            </option>
                                                                            <?php
				                                                                         }
			                                                                         ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="type" value="Product">
                                                    <input class="btn btn-info" type="submit" value="Submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <form method="post" action="save_product.php">

                                            <div class="box-body">
                                                <!-- /.box -->
                                                <div class="form-group">
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon">
                                                                                <label> Name</label>
                                                                            </div>
                                                                            <input type="text" name="name"
                                                                                class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-group date">
                                                                            <div class="input-group-addon">
                                                                                <label>Code</label>
                                                                            </div>
                                                                            <input type="text" class="form-control"
                                                                                name="code" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">

                                                                        <div class="input-group">
                                                                            <div class="input-group-addon">
                                                                                <label> Sell Price</label>
                                                                            </div>
                                                                            <input type="text" class="form-control"
                                                                                name="sell">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon">
                                                                                <label> Cost Price</label>
                                                                            </div>
                                                                            <input type="text" class="form-control"
                                                                                name="cost">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6" style="background-color: #DDDDDD;">
                                                                <h3>Use Materials</h3>
                                                                <div class="col-md-6">
                                                                    <select class="form-control select2" name="category"
                                                                        style="width: 100%;" id="mat">

                                                                        <?php
                                                                            $result = $db->prepare("SELECT * FROM product WHERE type='Materials' ");
		                                                                        $result->bindParam(':userid', $res);
		                                                                        $result->execute();
		                                                                        for($i=0; $row = $result->fetch(); $i++){
	                                                                         ?>
                                                                        <option
                                                                            value="<?php echo $row['product_id'];?>">
                                                                            <?php echo $row['name']; ?>
                                                                        </option>
                                                                        <?php
				                                                                         }
			                                                                         ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3"><input class="form-control"
                                                                        type="text" name="qty" id="qty" width="50%">
                                                                </div>
                                                                <div class="col-md-3"><b class="btn btn-info"
                                                                        onclick="matadd()">ADD</b></div>
                                                                <div class="col-md-12">

                                                                    <div class="form-group" id="sub_list">
                                                                        <table width='100%' class='table'>
                                                                            <?php $result = $db->prepare("SELECT * FROM use_product WHERE system_id ='' ");
                                                                             $result->bindParam(':userid', $res);
                                                                             $result->execute();
                                                                             for($i=0; $row = $result->fetch(); $i++){
                                                                               ?>
                                                                            <tr>
                                                                                <td><?php echo $row['product_name']; ?>
                                                                                </td>
                                                                                <td><?php echo $row['qty']; ?></td>
                                                                                <td><b class="btn btn-danger dllpack"
                                                                                        id="<?php echo $row['id']; ?>"
                                                                                        onclick="dll(<?php echo $row['id']; ?>)"><i
                                                                                            class="icon-trash">x</i></b>
                                                                                </td>
                                                                            </tr>

                                                                            <?php } ?>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <input type="hidden" name="type" value="Service">
                                                    <input type="hidden" name="category" value="0">
                                                    <input type="hidden" name="re_order" value="0">
                                                    <input class="btn btn-info" type="submit" value="Submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">
                                        <form method="post" action="save_product.php">

                                            <div class="box-body">
                                                <!-- /.box -->
                                                <div class="form-group">
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> Name</label>
                                                                        </div>
                                                                        <input type="text" name="name"
                                                                            class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group date">
                                                                        <div class="input-group-addon">
                                                                            <label>Code</label>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="code" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> Sell Price</label>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="sell">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> Cost Price</label>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="cost">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> RE-Order level</label>
                                                                        </div>
                                                                        <input type="text" name="re_order"
                                                                            class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="type" value="Materials">
                                                    <input type="hidden" name="category" value="0">
                                                    <input class="btn btn-info" type="submit" value="Submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->

                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_4">
                                        <form method="post" action="save_product.php">

                                            <div class="box-body">
                                                <!-- /.box -->
                                                <div class="form-group">
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> Name</label>
                                                                        </div>
                                                                        <input type="text" name="name"
                                                                            class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group date">
                                                                        <div class="input-group-addon">
                                                                            <label>Code</label>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="code" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> Sell Price</label>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="sell">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> Cost Price</label>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="cost">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <label> Category</label>
                                                                        </div>
                                                                        <select class="form-control select2"
                                                                            name="category" style="width: 100%;"
                                                                            autofocus>

                                                                            <?php
                                                                            $result = $db->prepare("SELECT * FROM catogary_list ");
		                                                                        $result->bindParam(':userid', $res);
		                                                                        $result->execute();
		                                                                        for($i=0; $row = $result->fetch(); $i++){
	                                                                         ?>
                                                                            <option value="<?php echo $row['id'];?>">
                                                                                <?php echo $row['name']; ?>
                                                                            </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="type" value="Quick">
                                                    <input type="hidden" name="category" value="0">
                                                    <input class="btn btn-info" type="submit" value="Submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>

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
    <script src="../../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Page script -->
    <script>
        var qty = document.getElementById("qty");
    qty.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            matadd();
        }
    });



    function mataddy() {
        var mat = document.getElementById("mat").value;
        var qty = document.getElementById("qty").value;
        var dd = fetch("product_sub_list_add.php?mat=" + mat + "&qty=" + qty).then(responseText => responseText);

        document.getElementById("sub_list").innerHTML = responseText;


    }


    function matadd() {
        var mat = document.getElementById("mat").value;
        var qty = document.getElementById("qty").value;
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

        xmlhttp.open("GET", "product_sub_list_add.php?mat=" + mat + "&qty=" + qty, true);
        xmlhttp.send();

        document.getElementById("qty").value="";
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

        xmlhttp.open("GET", "material_dll.php?id=" + did, true);
        xmlhttp.send();
    }

    $(function() {
        //Initialize Select2 Elements
        $(".select2").select2();
    });
    </script>
</body>

</html>