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
        Transfer Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>
   
   
   
    
    
   
   <section class="content">
   
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Transfer Report</h3>
            </div>
            <!-- /.box-header -->
			
            <div class="box-body">
		<form method="post" action="job_save.php">
			
			<div class="row">
            <div class="col-md-6">
              <div class="form-group has-success">
				  <div class="input-group">
				   <div class="input-group-addon">
                    Vehicle Number
                  </div>
                <input  id="inputSuccess"  type="text" name="vehicle_no"  class="form-control" data-inputmask='"mask": "AAA-9999"' data-mask>
                  </div>
                  </div>
				</div>
				
				<div class="col-md-6">
              <div class="form-group has-warning">
				  <div class="input-group">
				   <div class="input-group-addon">
                    Mileage
                  </div>
                <input  id="inputWarning" type="number" name="km"  class="form-control"  required>
                  </div>
                  </div>
				</div>
				
				</div>
			
			
			<div class="row">
            <div class="col-md-6">
              <div class="form-group">
				  <div class="input-group">
				   <div class="input-group-addon">
                    Type
                  </div>
        <select class="form-control" name="type" style="width: 100%;" tabindex="1" autofocus >
				 
		<?php  $invo = $_GET['id'];
         $result = $db->prepare("SELECT * FROM job_type WHERE action='' ORDER by order_no ASC ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){ ?>
		<option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?></option>
	<?php	} ?>
                </select>
                  </div>
                  </div>
				</div>
				
				<div class="col-md-6">
              <div class="form-group ">
				  <div class="input-group">
				   <div class="input-group-addon">
                    Mileage
                  </div>
                <input  id="inputWarning" type="number" name="km"  class="form-control"  required>
                  </div>
                  </div>
				</div>
				
				</div>
			
				
                  <br><br>
		<label>	Job Note</label>
		<textarea name="note" class="textarea" placeholder="Note" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
		<label>	Job Note - Product</label>
		<textarea name="note1" class="textarea" placeholder="Product" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
		
			<label>	AA-xxxx</label>
<input style="width:120px"  type="text" name="vehicle_no2"  class="form-control" data-inputmask='"mask": "AA-9999"' data-mask >
			
		

				
			<br>
	<input class="btn btn-info" type="submit" value="NEXT >" >	
	</form>	
	</div></div>
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
