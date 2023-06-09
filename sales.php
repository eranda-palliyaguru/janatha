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
	$type_name = "Sales";
	$type_color= "info";
	$invo = $_GET['id'];
	$co = substr($invo,0,2) ;
	if ($co=="qt"){
		$type_name = "Quotations";
		$type_color= "success";
	}
	if ($co=="pu"){
		$type_name = "purchase";
		$type_color= "danger";
	}
	if ($co=="tr"){
		$type_name = "Transfer";
		$type_color= "warning";
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
                <?php echo $type_name ?>
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active"><?php echo $type_name ?> Form</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
            <div class="box box-<?php echo $type_color ?>">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $type_name ?></h3>
                    <!-- /.box-header -->
                    <div class="form-group">

                        <div class="box-body">

                            <!-- /.box -->

                            <div class="form-group">
                                <div class="box-body">
                                    <form method="post" action="sales_save.php">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <label>Product</label>
                                                        </div>

                                                        <select class="form-control select2" name="name"
                                                            style="width: 100%;" tabindex="1" autofocus>

                                                            <?php  $invo = $_GET['id'];
         $result = $db->prepare("SELECT * FROM product ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){ ?>
                                                            <option value="<?php echo $row['product_id'];?>">
                                                                <?php echo $row['name']; ?> -<?php echo $row['code']; ?>
                                                                -
                                                                Rs<?php if($co>0){ echo $row['sell'];} if($co=="pu"){echo $row['cost'];} ?>
                                                            </option>
                                                            <?php	} ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <label>Qty</label>
                                                        </div>
                                                        <input type="number" class="form-control" value="1" name="qty"
                                                            tabindex="2">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <label>Dis %</label>
                                                        </div>
                                                        <input type="number" class="form-control" name="dis"
                                                            tabindex="2">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <label>Price</label>
                                                        </div>
                                                        <input type="number" class="form-control" name="price"
                                                            tabindex="2">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="invoice" value="<?php echo $invo; ?>">
                                            <input class="btn btn-<?php echo $type_color ?>" type="submit"
                                                value="Submit">
                                        </div>
                                    </form>
                                </div>



                                <!-- /.box -->


                                <div class="box-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>QTY</th>
                                            <th>Dic (Rs.)</th>
                                            <th>Price (Rs.)</th>
                                            <th>Amount (Rs.)</th>
                                            <th>#</th>
                                        </tr>
                                        <?php $total=0; $style="";
                $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invo' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$pro_id=$row['product_id'];

$resultz = $db->prepare("SELECT * FROM product WHERE product_id = '$pro_id' ");
$resultz->bindParam(':userid', $res);
$resultz->execute();
for($i=0; $rowz = $resultz->fetch(); $i++){
$stock=$rowz['qty'];
}
if ($stock < 0) {
$style='style="color:red" ';
}

	?>
                                        <tr <?php echo $style; ?>>
                                            <td  width="50%"><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['qty']; ?></td>
                                            <td align="right"><?php echo $row['dic']; ?></td>
                                            <td align="right">
                                              <form action="sales_list_edit.php" method="post">
                                              <input style="text-align: right;" type="number" class="form-control" name="price" value="<?php echo $row['price']; ?>" id="">
                                              <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                              </form>
                                            </td>
                                            <td align="right"><?php echo $row['amount']; ?></td>
                                            <td width="5%"> <a
                                                    href="sales_dll.php?id=<?php echo $row['id']; ?>&invo=<?php echo $invo; ?>">
                                                    <button class="btn btn-danger"><i
                                                            class="fa fa trash">X</i></button></a></td>
                                            <?php  $total+=$row['price']; ?>
                                        </tr>
                                        <?php
		}

$result1 = $db->prepare("SELECT * FROM sales WHERE invoice_number='$invo' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$adv=$row1['advance'];
		$customer_id=$row1['customer_id'];
		$job_no=$row1['job_no'];

		}

				 ?>
                                    </table>

                                    <table align="right" cellpadding="0" cellspacing="0" border="0" width="30%">
                                        <tr>
                                            <td style="font-size:20px" align="right">Total:</td>
                                            <td style="font-size:20px" align="right">
                                                Rs.<?php echo number_format($total,2); ?></td>
                                            <td width="15%"></td>
                                        </tr>

                                        <tr>
                                            <td align="right">Advance:</td>
                                            <td align="right">Rs.<?php echo number_format($adv,2); ?></td>
                                            <td width="15%"></td>
                                        </tr>

                                        <tr>
                                            <td align="right">Balance:</td>
                                            <td align="right">Rs.<?php echo number_format($total-$adv,2); ?></td>
                                            <td width="15%"></td>
                                        </tr>
                                    </table>




                                </div>
                            </div>
                            <!-- /.col (left) -->


                            <?php if ($co=="pu"){
		?>
                            <form method="post" action="save_purchase.php">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <label>Supplier</label>
                                        </div>
                                        <select class="form-control select2" name="supplier" style="width: 100%;"
                                            tabindex="1" autofocus>

                                            <?php  $invo = $_GET['id'];
         $result = $db->prepare("SELECT * FROM supplier ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){ ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?>
                                            </option>
                                            <?php	} ?>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" name="total"
                                            value="<?php echo $total; ?>">
                                        <input type="hidden" class="form-control" name="id"
                                            value="<?php echo $invo; ?>">
                                        <div class="input-group-addon">
                                            <label>Suplier Invoice No</label>
                                        </div>
                                        <input type="text" class="form-control" name="invo_no">
                                    </div><br>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <label>Remarks</label>
                                        </div>
                                        <input type="text" class="form-control" name="remarks">
                                    </div>

                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="type" id="optionsRadios1" value="Cash"
                                                    checked>
                                                Cash <i class="fa fa-money"></i>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="type" id="optionsRadios2" value="Chq">
                                                Chq <i class="fa fa-credit-card"></i>
                                            </label>
                                        </div>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="type" id="optionsRadios2" value="Credit">
                                                Credit <i class="fa fa-credit-card"></i>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <input class="btn btn-<?php echo $type_color ?>" type="submit" value="Save">
                            </form>
                            <?php } 	?>
                            <!-- /sub -->
                            <?php if ($co=="ds"){
		?>
                            <form method="post" action="save_bill.php">
                                <div class="form-group">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" id="optionsRadios1" value="Cash" checked>
                                            Cash <i class="fa fa-money"></i>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" id="optionsRadios2" value="Card">
                                            Card <i class="fa fa-credit-card"></i>
                                        </label>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <!-- /btn-group -->
                                        <input type="number" class="form-control" name="amount" value="">
                                        <div class="input-group-btn">
                                            <input type="hidden" class="form-control" name="total"
                                                value="<?php echo $total; ?>">
                                            <input type="hidden" class="form-control" name="invoice"
                                                value="<?php echo $invo; ?>">
                                            <input class="btn btn-info" type="submit" value="Pay and Print">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php } ?>


                            <?php if ($co=="tr"){
		?>
                            <form method="post" action="save_tr.php">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="hidden" class="form-control" name="total"
                                            value="<?php echo $total; ?>">
                                        <input type="hidden" class="form-control" name="invoice"
                                            value="<?php echo $invo; ?>">
                                        <label>Note</label>
                                        <input type="text" name="note" class="form-control" required>

                                    </div>
                                </div>

                                <input class="btn btn-<?php echo $type_color ?>" type="submit" value="Transfer">
                            </form>





                            <?php } if ($co=="qt"){
		?>
                            <form method="post" action="save_qt.php">

                                <input type="hidden" class="form-control" name="total" value="<?php echo $total; ?>">
                                <input type="hidden" class="form-control" name="invoice" value="<?php echo $invo; ?>">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Vehicle Number</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-motorcycle"></i>
                                            </div>
                                            <input type="text" name="vehicle_no" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Customer Name</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" class="form-control" name="cus" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Comment</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" class="form-control" name="comment" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Model</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-arrow-down"></i>
                                            </div>
                                            <select class="form-control select2" name="model" style="width: 100%;"
                                                autofocus>


                                                <?php
                $result = $db->prepare("SELECT * FROM model ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
                                                <option value="<?php echo $row['name'];?>"><?php echo $row['name']; ?>
                                                </option>
                                                <?php
				}
			?>
                                            </select>

                                        </div>



                                        <div class="form-group">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="type" id="optionsRadios1"
                                                        value="Quotations" checked>
                                                    Quotations<i class="fa fa-money"></i>
                                                </label>
                                            </div>


                                        </div>



                                    </div>
                                </div>



                        </div>

                        <input class="btn btn-<?php echo $type_color ?>" type="submit" value=" Print">
                        </form>


                        <?php } if ($co>0){	
		    
		
		$result1 = $db->prepare("SELECT * FROM job WHERE id='$job_no' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$job_type=$row1['job_type'];
		}
		
		$result1 = $db->prepare("SELECT * FROM customer WHERE id='$customer_id' ");
		$result1->bindParam(':userid', $a1);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$email=$row1['email'];
		}
		
		?>
                        <form method="post" action="save_bill.php">
                            <div class="form-group">

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Note</label><br>
                                            <textarea name="note" id="" cols="70" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" id="optionsRadios1" value="Cash" checked>
                                        Cash <i class="fa fa-money"></i>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" id="optionsRadios2" value="Card">
                                        Card <i class="fa fa-credit-card"></i>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php if($email==""){}else{ ?>
                    <div class="col-md-3">
                        <input id="vehicle2" type="checkbox" name="email" value="1">
                        <label style="margin: 10px;" for="vehicle2"> Send to <?php echo $email; ?></label>
                    </div>

                    <?php } ?>

                    <?php if($job_type==1){ ?>
                    <div class="col-md-3">
                        <div class="input-group">
                            <!-- /btn-group -->
                            <input type="number" class="form-control" width="100%" name="km" value="5000">
                            <div class="input-group-addon">
                                <label>Km</label>
                            </div>
                        </div>
                    </div>

                    <?php } ?>

                    <div class="col-md-3">
                        <div class="input-group">
                            <!-- /btn-group -->
                            <input type="number" class="form-control" name="amount" value="">
                            <div class="input-group-addon">
                                <label>Pay Amount</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="total" value="<?php echo $total; ?>">
                    <input type="hidden" class="form-control" name="invoice" value="<?php echo $invo; ?>"> <br><br>
                    <input class="btn btn-info pull-right" type="submit" value="Pay and Print">
                    </form>


                    <?php }	?>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->
            </div>
    </div>

    <br><br>
    <?php  if ($co>0){	?>

    <br><br><br>

    <div class="col-md-7">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Advance Payment</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="post" action="save_advance.php">
                    <div class="form-group">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" id="optionsRadios1" value="Cash" checked>
                                            Cash <i class="fa fa-money"></i>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" id="optionsRadios2" value="Card">
                                            Card <i class="fa fa-credit-card"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-7">
                        <div class="input-group">
                            <!-- /btn-group -->
                            <div class="input-group-addon">
                                <label>Advance amount</label>
                            </div>
                            <input type="number" class="form-control" name="amount" value="">
                            <div class="input-group-btn">

                                <input type="hidden" class="form-control" name="invoice" value="<?php echo $invo; ?>">
                                <input class="btn btn-info" type="submit" value="save">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php }	?>
    <!-- /.col (right) -->

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
    $(function() {

        //Initialize Select2 Elements

        $(".select2").select2();



        //Datemask dd/mm/yyyy

        $("#datemask").inputmask("YYYY/MM/DD", {
            "placeholder": "YYYY/MM/DD"
        });

        //Datemask2 mm/dd/yyyy

        $("#datemask2").inputmask("YYYY/MM/DD", {
            "placeholder": "YYYY/MM/DD"
        });

        //Money Euro

        $("[data-mask]").inputmask();



        //Date range picker

        $('#reservation').daterangepicker();

        //Date range picker with time picker

        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'YYYY/MM/DD h:mm A'
        });

        //Date range as a button

        $('#daterange-btn').daterangepicker(

            {

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