<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    <?php
include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];
if($r =='Cashier'){
include_once("sidebar2.php");
}
if($r =='admin'){
include_once("sidebar.php");
}

	$invo = $_GET['id'];
	$co = substr($invo,0,2) ;
		$type_name = "Quotations";
		$type_color= "success";
	
	
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
                               



                                <!-- /.box -->


                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                            
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <label>Price</label>
                                                        </div>
                                                        <input type="number" class="form-control" name="price" id="price" value="1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <label>QTY</label>
                                                        </div>
                                                        <input type="number" class="form-control" id="qty" name="qty" value="1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="input-group date">
                                                       
                                                        <input class="btn btn-<?php echo $type_color ?>" type="submit"
                                                value="Submit">
                                                    </div>
                                                </div>
                                            </div>

                                            </div>
                                            <div class="col-md-12">
                                            <div id="sales_list">
                                            <table id="example2" class="table table-bordered table-hover">
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>QTY</th>
                                                    <th>Dic (Rs.)</th>
                                                    <th>Price (Rs.)</th>
                                                    <th>Amount (Rs.)</th>
                                                    <th>#</th>
                                                </tr>
                                                <tr style="background-color: #FFA245;">
                                                    <td colspan="6">
                                                        Supply
                                                    </td>

                                                </tr>
                                                <?php $total=0; $supTot=0; $style="";
                                            $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invo' AND service_type = 'supply'");
		                                    $result->bindParam(':userid', $res);
		                                    $result->execute();
		                                    for($i=0; $row = $result->fetch(); $i++){
			                                $pro_id=$row['product_id'];
                                            ?>

                                                <tr>
                                                    <td width="40%"><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td align="right"><?php echo $row['dic']; ?></td>
                                                    <td align="right"><?php echo $row['price']; ?></td>
                                                    <td align="right"><?php echo $row['amount']; ?></td>
                                                    <td width="5%"> <a
                                                            href="sales_dll.php?id=<?php echo $row['id']; ?>&invo=<?php echo $invo; ?>">
                                                            <button class="btn btn-danger"><i
                                                                    class="fa fa trash">X</i></button></a></td>
                                                    <?php  $supTot+=$row['amount']; $total+=$row['amount']; ?>
                                                </tr>
                                                <?php } ?>
                                                <tr style="background-color: #C8C8C8;">

                                                    <td align="right" colspan="4">Total</td>
                                                    <td>Rs.<?php echo $supTot; ?></td>
                                                    <td></td>

                                                </tr>

                                                <tr style="background-color: #FFA245; ">
                                                    <td colspan="6">
                                                        Remove & Refitting
                                                    </td>

                                                </tr>
                                                <?php  $supTot=0; $style="";
                                            $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invo' AND service_type = 'refit'");
		                                    $result->bindParam(':userid', $res);
		                                    $result->execute();
		                                    for($i=0; $row = $result->fetch(); $i++){
			                                $pro_id=$row['product_id'];
                                            ?>

                                                <tr>
                                                    <td width="50%"><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td align="right"><?php echo $row['dic']; ?></td>
                                                    <td align="right"><?php echo $row['price']; ?></td>
                                                    <td align="right"><?php echo $row['amount']; ?></td>
                                                    <td width="5%"> <a
                                                            href="sales_dll.php?id=<?php echo $row['id']; ?>&invo=<?php echo $invo; ?>">
                                                            <button class="btn btn-danger"><i
                                                                    class="fa fa trash">X</i></button></a></td>
                                                    <?php  $supTot+=$row['amount']; $total+=$row['amount']; ?>
                                                </tr>
                                                <?php } ?>
                                                <tr style="background-color: #C8C8C8;">

                                                    <td colspan="4" align="right">Total</td>
                                                    <td>Rs.<?php echo $supTot; ?></td>
                                                    <td></td>

                                                </tr>



                                                <tr style="background-color: #FFA245;">
                                                    <td colspan="6">
                                                        Repair
                                                    </td>

                                                </tr>
                                                <?php  $supTot=0; $style="";
                                            $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invo' AND service_type = 'repair'");
		                                    $result->bindParam(':userid', $res);
		                                    $result->execute();
		                                    for($i=0; $row = $result->fetch(); $i++){
			                                $pro_id=$row['product_id'];
                                            ?>

                                                <tr>
                                                    <td width="50%"><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td align="right"><?php echo $row['dic']; ?></td>
                                                    <td align="right"><?php echo $row['price']; ?></td>
                                                    <td align="right"><?php echo $row['amount']; ?></td>
                                                    <td width="5%"> <a
                                                            href="sales_dll.php?id=<?php echo $row['id']; ?>&invo=<?php echo $invo; ?>">
                                                            <button class="btn btn-danger"><i
                                                                    class="fa fa trash">X</i></button></a></td>
                                                    <?php  $supTot+=$row['amount']; $total+=$row['amount']; ?>
                                                </tr>
                                                <?php } ?>
                                                <tr style="background-color: #C8C8C8;">
                                                    <td colspan="4" align="right">Total</td>
                                                    <td>Rs.<?php echo $supTot; ?></td>
                                                    <td></td>

                                                </tr>




                                                <tr style="background-color: #FFA245;">
                                                    <td colspan="6"> Paint </td>

                                                </tr>
                                                <?php  $supTot=0; $style="";
                                            $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invo' AND service_type = 'paint'");
		                                    $result->bindParam(':userid', $res);
		                                    $result->execute();
		                                    for($i=0; $row = $result->fetch(); $i++){
			                                $pro_id=$row['product_id'];
                                            ?>

                                                <tr>
                                                    <td width="50%"><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td align="right"><?php echo $row['dic']; ?></td>
                                                    <td align="right"><?php echo $row['price']; ?></td>
                                                    <td align="right"><?php echo $row['amount']; ?></td>
                                                    <td width="5%"> <a
                                                            href="sales_dll.php?id=<?php echo $row['id']; ?>&invo=<?php echo $invo; ?>">
                                                            <button class="btn btn-danger"><i
                                                                    class="fa fa trash">X</i></button></a></td>
                                                    <?php  $supTot+=$row['amount']; $total+=$row['amount']; ?>
                                                </tr>
                                                <?php } ?>
                                                <tr style="background-color: #C8C8C8;">
                                                    <td colspan="4" align="right">Total</td>
                                                    <td>Rs.<?php echo $supTot; ?></td>
                                                    <td></td>

                                                </tr>


                                            </table>

                                            <?php 
                                        $adv=0;
                                        $result1 = $db->prepare("SELECT * FROM sales WHERE invoice_number='$invo' ");
                                        $result1->bindParam(':userid', $a1);
                                        $result1->execute();
                                        for($i=0; $row1 = $result1->fetch(); $i++){
                                        $adv=$row1['advance'];
                                        $customer_id=$row1['customer_id'];
                                        $job_no=$row1['job_no'];
                            
                                        } ?>
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
                                                    <td align="right">Rs.<?php echo number_format($total-$adv,2); ?>
                                                    </td>
                                                    <td width="15%"></td>
                                                </tr>
                                            </table>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <button style="width: 100%;" id="supply" onclick="type_apply('info','supply');"
                                                            class="btn btn-info">Supply</button>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <button style="width: 100%;" id="rerefit" onclick="type_apply('danger','rerefit');"
                                                            class="btn btn-danger">ReReFit</button>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <button style="width: 100%;" id="repair" onclick="type_apply('success','repair');"
                                                            class="btn btn-success">Repair</button>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <button style="width: 100%;" id="paint" onclick="type_apply('warning','paint');"
                                                            class="btn btn-warning">Paint</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <br><br>
                                            <input type="hidden" id="product_type" >
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <button style="width: 100%;" id="front" onclick="get_item('front');"
                                                            class="btn "> <img src="img/type_img/fron.svg" alt="">
                                                            <br> FRONT</button>
                                                            
                                                    </div>

                                                    <div class="col-md-3">
                                                        <button style="width: 100%;" id="rear" onclick="get_item('rear');"
                                                            class="btn btn-"><img src="img/type_img/REAR.svg" alt="">
                                                            <br> REAR</button>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <button style="width: 100%;" id="eroom" onclick="get_item('eroom');"
                                                            class="btn btn-"><img src="img/type_img/ENGINE ROOM.svg" alt="">
                                                            <br> ENGINE ROOM</button>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <button style="width: 100%;" id="room" onclick="get_item('room');"
                                                            class="btn "><img src="img/type_img/ROOM.svg" alt="">
                                                            <br> ROOM</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <input type="hidden" name="area" id="area">
                                                <input type="hidden" name="type" id='type'>
                                               <input id='serch' onkeypress="item_serch()" type="text" placeholder="Search" style="border-radius: 15px; width: 90%; margin:10px; text-align:center;">
                                            </div>
                                            <div class="col-md-12">
                                                <div style="height: 400px; overflow: auto" id="product_list"></div>
                                            </div>
                                        </div>



                                    </div>





                                </div>
                            </div>
                            <!-- /.col (left) -->



                            <!-- /sub -->





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
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->
                </div>
            </div>


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

function type_apply(info,id){

document.getElementById('supply').className='btn';
document.getElementById('rerefit').className='btn';
document.getElementById('repair').className='btn';
document.getElementById('paint').className='btn';

document.getElementById(id).className='btn btn-'+info;

document.getElementById("front").className="btn btn-"+info;
document.getElementById("rear").className="btn btn-"+info;
document.getElementById("eroom").className='btn btn-'+info;
document.getElementById("room").className="btn btn-"+info;

document.getElementById("product_type").value=info;
document.getElementById("product_list").innerHTML="";
}






function list_update(id,price,item_type){
console.log(item_type);
    var invo = '<?php echo $invo; ?>'

    var xmlhttp;
if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
} else { // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById("sales_list").innerHTML = xmlhttp.responseText;
    }
}

xmlhttp.open("GET", "sales_product_list_add.php?type="+item_type+"&invo=" +invo+"&price="+price+"&id="+id+"&qty=1", true);
xmlhttp.send();

document.getElementById('ls_'+id).style.display="none";

}




function list_load(id,amount){
    document.getElementById("price").value=amount;
}






function item_serch(){
    var area = document.getElementById('area').value;
    var type = document.getElementById('type').value;
    var serch = document.getElementById('serch').value;
    var invo = '<?php echo $invo; ?>'

    var xmlhttp;
if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
} else { // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById("product_list").innerHTML = xmlhttp.responseText;
    }
}

xmlhttp.open("GET", "sales_product_list.php?type=" +type+ "&area=" +area+'&invo='+invo+'&serch='+serch, true);
xmlhttp.send();
}






function get_item(item){
    var cl = document.getElementById('product_type').value;
    var part="";
    var invo = '<?php echo $invo; ?>'

    if(cl == "info"){ part="supply"; }
    if(cl == "danger"){ part="refit"; }
    if(cl == "success"){ part="repair"; }
    if(cl == "warning"){ part="paint"; }

document.getElementById("front").className="btn";
document.getElementById("rear").className="btn";
document.getElementById("eroom").className='btn';
document.getElementById("room").className='btn';



var ty= document.getElementById("product_type").value;
document.getElementById(item).className="btn btn-"+ty; 

        var xmlhttp;

        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("product_list").innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "sales_product_list.php?type=" + part + "&area=" + item+'&invo='+invo, true);
        xmlhttp.send();

        document.getElementById("type").value= part;
        document.getElementById("area").value= item;
        document.getElementById("serch").value= "";
}









    $(function() {

        //Initialize Select2 Elements
        $(".select2").select2();

        $('#datepicker').datepicker({
            autoclose: true
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

    });
    </script>

</body>

</html>