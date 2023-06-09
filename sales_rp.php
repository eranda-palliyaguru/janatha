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
	
//header("location: 404.php");
?>




<link rel="stylesheet" href="datepicker.css"  type="text/css" media="all" />
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
        Sales Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>
   
   
   
    
     <form action="sales_rp.php" method="get">   
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
  
   <section class="content">
   
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sales Report</h3>
            </div>
            <!-- /.box-header -->
			
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
			  
                <thead>
                <tr>
					<th>Date</th>
                  <th>Invoice no</th>
				  <th>Vehicle No</th>
                  
				  <th>Customer Name</th>
					
					<th>F/S</th>
                  
					<th>Labor Cost</th>
                  <th>Part Price</th>
				  
				  <th>Amount</th>
                  <th>View</th>
                </tr>
				
                </thead>
				
                <tbody>
				<?php
   $d1=$_GET['d1'];
				$d2=$_GET['d2'];
			 $tot=0;
   $result = $db->prepare("SELECT * FROM sales WHERE action='active' and date BETWEEN '$d1' AND '$d2'  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
				$type=$row['type'];
				$id=$row['invoice_number'];
				
			?>
                <tr>
				  <td><?php echo $row['date'];?></td>
				  <td><?php echo $row['invoice_number'];?></td>
				  <td><?php echo $row['vehicle_no'];?></td>
                  <td><?php echo $row['customer_name'];?></td>
					
					<td><?php if($type=="fs"){ echo "X"; } ;?></td>
                  
				  <td><?php echo $row['labor_cost'];?></td>
                  <td><?php echo $row['amount']-$row['labor_cost'];?></td>
                  <td><?php echo $row['amount'];?></td>
				  <td><a href="bill.php?id=<?php echo $id;?>" class="btn btn-primary btn-xs"><b>Print</b></a></td>
				  
				  
				   <?php 
					$tot+=$row['amount'];
					$labor+=$row['amount']-$row['labor_cost'];
				}
				
				?>
                </tr>
               
                
                </tbody>
                <tfoot>
                
				
				<tr>
					<th></th>
                  <th></th>
					<th></th>
					<th>Total </th>
					
					<th>F/S</th>
                  
                  <th><?php echo $tot-$labor; ?>.00</th>
				  <th><?php echo $labor; ?>.00</th>
				  <th><?php echo $tot; ?>.00</th>
                  <th></th>
                </tr>
				
				<?php 
					$hold=0;
					$result = $db->prepare("SELECT sum(amount) FROM expenses_records WHERE  date BETWEEN '$d1' AND '$d2'  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$ex=$row['sum(amount)'];
				}
					
			$result = $db->prepare("SELECT sum(amount) FROM sales WHERE pay_type='Card' and action='active' and date BETWEEN '$d1' AND '$d2'  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$card_tot1=$row['sum(amount)'];
				}
					
			$result = $db->prepare("SELECT sum(advance) FROM sales WHERE advance_type='Card' and  date BETWEEN '$d1' AND '$d2'  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$card_tot2=$row['sum(advance)'];
				}
				
			$card_tot=$card_tot2+$card_tot1;
					
					
					
		$result = $db->prepare("SELECT sum(advance) FROM sales WHERE action='active' and date BETWEEN '$d1' AND '$d2'  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$advance_x=$row['sum(advance)'];
				}
					
		$result = $db->prepare("SELECT sum(advance) FROM sales WHERE  advance_date BETWEEN '$d1' AND '$d2'  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$advance=$row['sum(advance)'];
				}
					
					
	$result1 = $db->prepare("SELECT * FROM hold_amount WHERE date='$d2' ORDER by id DESC limit 0,1 ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$hold=$row1['amount'];
		}
		$result1 = $db->prepare("SELECT * FROM hold_amount WHERE date_sum='$d2'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$hold1=$row1['amount'];
		$hold_date=$row1['date'];
		}
					$cash=$tot-$card_tot;
					$total=$hold1+$advance+$cash-$ex;
					$total=$total-$advance_x;
					
					?>
                </tfoot>
              </table>
				<div class="row">
					 <h3>Total Balance</h3>
				<div class="col-md-6">	
				<table id="example1" class="table table-bordered table-striped">
				<thead>
                <tr>
					<th>Description</th>
                  <th>Amount</th>
                </tr>
				</thead>
				
					<tr>
					<th>Bill Total</th>
                  <th>Rs.<?php echo $tot; ?>.00</th>
                </tr>
					<tr>
					<th>Advance Total</th>
                  <th>Rs.<?php echo $advance; ?>.00</th>
                </tr>
					
					<tr>
					<th>Card Amount Total</th>
                  <th>Rs.<?php echo $card_tot; ?></th>
                </tr>
					<tr>
					<th>Cash Amount Total</th>
                  <th>Rs.<?php echo $cash; ?></th>
                </tr>
					<tr>
					<th>Expenses</th>
                  <th>Rs.<?php echo $ex; ?></th>
                </tr>
					
					<tr>
					<th>Hold Amount (<?php echo $hold_date; ?>)</th>
                  <th>Rs.<?php echo $hold1; ?>.00</th>
                </tr>
					<tr>
					<th>Total</th>
                  <th>Rs.<?php echo $total; ?>.00</th>
                </tr>
					<tr>
					<th>-</th>
                  <th>-</th>
                </tr>
					<tr>
					<th>Hold Amount</th>
                  <th>Rs.<?php echo $hold; ?>.00</th>
                </tr>
					<tr>
					<th>Balance</th>
                  <th>Rs.<?php echo $total-$hold; ?>.00</th>
                </tr>
					
					
					
					<tfoot>
					</tfoot>
					</table>
					
					
            </div>
					
					<h3>Expenses</h3>
					<div class="col-md-6">	
				<table id="example1" class="table table-bordered table-striped">
				<thead>
                <tr>
					<th>Description</th>
                  <th>Amount</th>
					<th>Comment</th>
                </tr>
				</thead>
				<?php
    $result = $db->prepare("SELECT * FROM expenses_records WHERE  date BETWEEN '$d1' AND '$d2'  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				
			?>
					<tr>
					<th><?php echo $row['type']; ?></th>
                  <th>Rs.<?php echo $row['amount']; ?></th>
				<th><?php echo $row['comment']; ?></th>
                </tr>
				<?php } ?>	
					
					
					<tfoot>
					</tfoot>
					</table>
					
					
            </div>
				
				
				
				
				
				
				</div></div>
				
		 <a href="sales_rp_print.php?d1=<?php echo $_GET['d1']; ?>&d2=<?php echo $_GET['d2']; ?>"><button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" >
 <i class="icon icon-search icon-large"></i> print
 </button></a>
            <!-- /.box-body -->
          </div>
	    <form action="hold_save.php" method="post">
			<div class="input-group-addon">
			<label>Hold Amount</label>
   <input type="text" name="amount" style="width:223px; padding:4px;">
				<input type="hidden" name="d1" value="<?php echo $_GET['d1']; ?>">
				<input type="hidden" name="d2" value="<?php echo $_GET['d2']; ?>">
	   <button class="btn btn-danger" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Save
 </button></div>
   </form>
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
	
	
	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepicker').datepicker({ autoclose: true });
	
	
	
	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepickerd').datepicker({ autoclose: true  });
	
</script>
</body>
</html>
