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









<link rel="stylesheet" href="datepicker.css"
        type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js"
        type="text/javascript"></script>
 <script type="text/javascript">

     

		 $(function(){

        $("#datepicker1").datepicker({ dateFormat: 'yy/mm/dd' });

        $("#datepicker2").datepicker({ dateFormat: 'yy/mm/dd' });

       

    });



    </script>

    <!-- /.sidebar -->

  </aside>



  <!-- Content Wrapper. Contains page content -->

     <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Stock

        <small>Preview</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Forms</a></li>

        <li class="active">PRODUCT</li>

      </ol>

    </section>

   

   

   

   

   

   

   

   <section class="content">

   

     <div class="box box-success">

            <div class="box-header">

              <h3 class="box-title">STOCK Data</h3>

		<a href="stock_rp_print.php"><button style="background-color: yellow">PRINT</button></a>

            </div>

            <!-- /.box-header -->

			

            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">

			  

                <thead>

                <tr>

				<th>Product_id</th>

					<th>Code</th>

                  <th>Name</th>
                  <th>Price</th>
				  <th>qty</th>
					<th>Value</th>
                 
				

				  

				

                </tr>

				

                </thead>

				

                <tbody>

				<?php
$tot=0;
   

   $result = $db->prepare("SELECT * FROM product  WHERE qty > '0' ORDER by product_id ASC  ");

				$result->bindParam(':userid', $date);

                $result->execute();

                for($i=0; $row = $result->fetch(); $i++){	

			?>

                <tr class="record" >

				<td><?php echo $id=$row['product_id'];?></td>

			      <td><?php echo $row['code'];?></td>

                  <td><?php echo $row['name'];?></td>  
                  <td>Rs.<?php echo $row['sell'];?></td>
				  <td><?php echo $row['qty'];?></td>
                  <td>Rs.<?php echo $row['qty']*$row['sell'];?></td>
				  

		

				  

				   <?php 

				$tot+=$row['qty']*$row['sell'];

				}

				?>

                </tr>

               

                

                </tbody>

                <tfoot>

                

				

				

				

				

				

				

                </tfoot>

              </table>
<h3>Total Value Rs.<?php echo $tot; ?></h3>
            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->

        </div>

        <!-- /.col -->

      

   

   

   



    <!-- Main content -->

    


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

<script src="js/jquery.js"></script>

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

  $(function () {

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

<script type="text/javascript">

$(function() {





$(".delbutton").click(function(){



//Save the link in a variable called element

var element = $(this);



//Find the id of the link that was clicked

var del_id = element.attr("id");



//Built a url to send

var info = 'id=' + del_id;

 if(confirm("Sure you want to delete this product? There is NO undo!"))

		  {



 $.ajax({

   type: "GET",

   url: "product_dll.php",

   data: info,

   success: function(){

   

   }

 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")

		.animate({ opacity: "hide" }, "slow");



 }



return false;



});



});

</script>

</body>

</html>

