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




<link rel="stylesheet" href="datepicker.css"
        type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js"
        type="text/javascript"></script>
 <script type="text/javascript">
     
		 $(function(){
        $("#datepickergv").datepicker({ dateFormat: 'yy/mm/dd' });
        $("#datepickerg").datepicker({ dateFormat: 'yy/mm/dd' });
       
    });

    </script>




    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Loan Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Loan Report</li>
      </ol>
    </section>
	<br>
	<a  href="customer_rp_print.php"><button  class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" >
  Print All Deta
 </button></a>
 
 <a href="customer_rp_print_week.php"><button  class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" >
  Print Week  Deta
 </button></a>
 
 <a rel="facebox" href="week_view.php"><button  class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" >
  Print Week  Deta
 </button></a>
	

      <!-- SELECT2 EXAMPLE -->
	        
      
     
			 
			

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Loan Report</h3>
		  
		  
		  
		  
		  
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>ORDER ID</th>
                  <th>Name</th>
				  <th>Type</th>
                  <th>Amount</th>
                  <th>Amount Balance</th>
				  <th>Total Pay</th>
                  <th>Dela</th>
				   <th>Rate</th>
                  
                </tr>
                </thead>
                <tbody>
				
				
				
				
				
				
				
				
				<?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
				
				//$d1=$_GET['d1'];
				//$d2=$_GET['d2'];
				//$d3=$_SESSION['SESS_FIRST_NAME'];
				//$d3=$_GET['d3'];
				$result = $db->prepare("SELECT * FROM credit_sales_order WHERE   status='incomplete' ORDER by sn DESC");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$ord=$row['order_id'];
				
			?>
			
                <tr>
				<td><?php echo $id=$row['order_id'];?></td>
				<?php
				$result1 = $db->prepare("SELECT * FROM customer WHERE   order_id='$id' ");				
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				$cid = $row1['customer_id'];
				
				}
			?> 
                  <td><a href="profile.php?id=<?php echo $cid;?>"> <?php echo $row['cus_name'];?></a></td>
				  <td><?php echo $row['type'];?></td>
                  <td>Rs.<?php echo $row['amount'];?></td>
                  
                  <td>Rs.<?php 
				  $alf=$row['amount_left'];
				  $i_amount=$row['interest_amount'];
				  
				  
					 $i_amount=0; 
				  
				  
				  
				  
				  echo $alf+$i_amount;?>.00</td>
				  <?php
				$result1 = $db->prepare("SELECT sum(amount) FROM sales WHERE   order_id='$ord' AND do='' ");				
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				$int = $row1['sum(amount)'];
				
				}
			?>  
			<td>Rs.<?php echo $int;?></td>
				   <td>Rs.<?php echo $row['dela'];?></td> 
				  <td>Rs.<?php $re=$row['rate'];
				           echo $re;?></td>
				  
				
				 
				   
				   
				  
				  
				  <?php 
				  
				}
				   ?>
                </tr>
               
                
                </tbody>
				
                <tfoot>
                
				
				
				
				 
				
				
                </tfoot>
              </table>
            </div>
			
			<center>
			
			
			
			
			</center>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
   
   
   

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
<!-- Page script -->





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

</body>
</html>
