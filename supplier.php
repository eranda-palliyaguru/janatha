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
        Supplier Form
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Supplier Form</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">ADD New Supplier</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="post" action="save_supplier.php">
		
        <div class="box-body">
         
	   				  
											  
      <!-- /.box -->
<div class="form-group">
              
		
	<div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                
				  <div class="input-group">
				   <div class="input-group-addon">
                    <label>Company Name</label>
                  </div>
                <input type="text" name="name"  class="form-control" required >
                  </div>
                  </div>
				</div>
			  
			  <div class="col-md-6">
			      <div class="form-group">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <label>Contact Person</label>
                  </div>
                   <input type="text" class="form-control" name="person" required >
                </div>
              </div>
			  </div>
			  
              </div>
			
	
        
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                
				  <div class="input-group">
				   <div class="input-group-addon">
                    <label>Office No</label>
                  </div>
                <input type="text" class="form-control" name="office" >
                  </div>
                  </div>
				</div>
			  
			   <div class="col-md-6">
			       <div class="form-group">
				  <div class="input-group">
				   <div class="input-group-addon">
                    <label>Mobil No</label>
                  </div>
                <input type="text" class="form-control" name="mobil" >
                  </div>
                  </div>
			   </div>
			   
			  
              </div>
              
              
                        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                
				  <div class="input-group">
				   <div class="input-group-addon">
                    <label>Address</label>
                  </div>
                <input type="text" class="form-control" name="address" >
                  </div>
                  </div>
				</div>
				
				
			<div class="col-md-6">
              <div class="form-group">
                
				  <div class="input-group">
				   <div class="input-group-addon">
                    <label>E-mail</label>
                  </div>
                <input type="text" class="form-control" name="email" >
                  </div>
                  </div>
				</div>
			  
			  
              </div>
              
              </div>

		  
			  <input class="btn btn-info" type="submit" value="Submit" >
			  
			  </form>
          <!-- /.box -->

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
    
       <section class="content">
   
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Supplier List</h3>
            </div>
            <!-- /.box-header -->
			
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
			  
                <thead>
                <tr>
                  <th>ID</th>
				  <th>name</th>
                  <th>Person</th>
					<th>Phone NO</th>
				  <th>Address</th>
                  <th>E-mail</th>
                  <th>#</th>
                </tr>
				
                </thead>
				
                <tbody>
				<?php
   
   $result = $db->prepare("SELECT * FROM supplier   ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){

				$id=$row['product_id'];
				
			?>
                <tr>
				  <td><?php echo $row['id'];?></td>
				  <td><?php echo $row['name'];?></td>
                  <td><?php echo $row['contact_person'];?></td>
					<td><?php echo $row['mobil']."/".$row['contact'];?></td>
                  <td><?php echo $row['address'];?></td>
                  <td><?php echo $row['email'];?></td>
                  
				  <td>
					<a href="supplier_dll.php?id=<?php echo $id;?>" class="btn btn-danger btn-xs"><b>DELETE</b></a>
					</td>
				   <?php
				}
				
				?>
                </tr>
               
                
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
