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

        Month END

        <small>Preview</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Forms</a></li>

        <li class="active">PRODUCT</li>

      </ol>

    </section>

   

   

   
<form action="tech_com.php" method="get">   
	<center>
	
			  
			  
			<strong>

From :<input type="text" style="width:223px; padding:4px;" name="d1" id="datepicker" value="" autocomplete="off" /> 
To:<input type="text" style="width:223px; padding:4px;" name="d2" id="datepickerd"  value="" autocomplete="off"/>

 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>
 
</strong>  
			  
		<br>	  
			  
         <h4> Report from&nbsp;<i class=" text-primary "><?php echo $_GET['d1'] ?></i>&nbsp;to&nbsp;<i class=" text-primary "><?php echo $_GET['d2'] ?> </i>  </h4>
			 
			 </center>
			 </form>
   

   

   

  <a href="month_end_print.php?d1=<?php echo $_GET['d1'] ?>&d2=<?php echo $_GET['d2'] ?>"> <input class="btn btn-info" name="com" type="submit" valu="Print" ></a>

   <section class="content">

   

     <div class="box box-success">

            <div class="box-header">

              <h3 class="box-title">Month END Data</h3>

		

            </div>

            <!-- /.box-header -->

			

            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">

			  

                <thead>

                <tr>
				<th>Model</th>
					<th>Product Value</th>
					<th>Product Value (1%) </th>
                
                </tr>
                </thead>

				

                <tbody>

				<?php
	$repair11=0;
				$full11=0;
				$ned_free11=0;
				$free111=0;
				$free211=0;
			    $st2=0;
			 $nd2=0;

   $date1=$_GET['d1'];
					$date2=$_GET['d2'];

   $result = $db->prepare("SELECT * FROM mechanic ");

				$result->bindParam(':userid', $date);

                $result->execute();

                for($i=0; $row = $result->fetch(); $i++){	
					$id=$row['id'];
					$name=$row['name'];
				$repair=0;
				$full=0;
				$ned_free=0;
				$free1=0;
				$free2=0;
$result1 = $db->prepare("SELECT * FROM sales where action='active' and mechanic_id='$id' and date BETWEEN '$date1' and '$date2' ORDER by transaction_id ASC   ");
				$result1->bindParam(':userid', $id);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
$invo=$row1['invoice_number'];

		$result2 = $db->prepare("SELECT sum(price) FROM sales_list where invoice_no='$invo' and type='Product'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$repair1=$row2['sum(price)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where invoice_no='$invo' and product_id='404'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$repair2=$row2['count(id)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where invoice_no='$invo' and product_id='402'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$full1=$row2['count(id)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where invoice_no='$invo' and product_id='407'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$ned_free1=$row2['count(id)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where invoice_no='$invo' and product_id='431'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$st=$row2['count(id)'];
				}
				$result2 = $db->prepare("SELECT count(id) FROM sales_list where invoice_no='$invo' and product_id='432'  ");
				$result2->bindParam(':userid', $id);
                $result2->execute();
                for($i=0; $row2 = $result2->fetch(); $i++){
					$nd=$row2['count(id)'];
				}
				
					$repair_cou+=$repair2;
				$repair+=$repair1;
				$full+=$full1;
				$ned_free+=$ned_free1;
				$free1+=$st;
				$free2+=$nd;
				}
			?>

                <tr class="record" >
				<td><?php echo $row['name'];?></td>

			      <td>Rs.<?php echo $repair; ?></td>
					<td><?php echo $repair/100; ?></td>
                  

				       

                  

				  

				 

				  

				   <?php 
				$repair11+=$repair;
				$full11+=$full;
				$ned_free11+=$ned_free;
				$free111+=$free1;
				$free211+=$free2;
				}

				

				?>

                </tr>

               

                

                </tbody>

                <tfoot>

                <tr style="background-color:cornsilk">
					<td>Total</td>
				<td>Rs.<?php echo $repair11; ?></td>
                  <td><?php echo $full11; ?></td>
				 	
				</tr>

					
					
					<tr style="background-color:cornsilk">
					<td>Total</td>
				<td>Rs.<?php echo $repair12; ?></td>
                  <td><?php echo $full12; ?></td>
				  
				</tr>
					
					
				
                </tfoot>

              </table>

 
				

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
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
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
	
	
	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd'});
    $('#datepicker').datepicker({ autoclose: true });
	
	
	
	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd'});
    $('#datepickerd').datepicker({ autoclose: true  });
	
</script>
</body>
</html>