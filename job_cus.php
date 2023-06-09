<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
?>
<body class="hold-transition skin-red sidebar-mini layout-top-nav">
<?php 
//include_once("auth.php");
//$r=$_SESSION['SESS_LAST_NAME'];

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
   

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Add Customer</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="post" action="save_cus_job.php">
		
        <div class="box-body">
         
	   				  
											  
      <!-- /.box -->
<div class="form-group">
              
		
	<div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>	Vehicle Number</label>
				  <div class="input-group">
				   <div class="input-group-addon">
                    <i class="fa fa-motorcycle"></i>
                  </div>
                <input type="text" name="vehicle_no" value="<?php echo $_GET['id']; ?>"  class="form-control"  required>
                  </div>
                  </div>
				</div>
			  
			  <div class="form-group">
               <label>Model</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-arrow-down"></i>
                  </div>
                  <select class="form-control select2" name="model" style="width: 100%;" autofocus >
                  
                  
				  <?php
                $result = $db->prepare("SELECT * FROM model ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['name'];?>"><?php echo $row['name']; ?>    </option>
	<?php
				}
			?>
                </select>
				  
                </div>
				
        
		
        </div>
              </div>
		</div>	
	
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>	Customer Name</label>
				  <div class="input-group">
				   <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                <input type="text" class="form-control" name="cus_name" required >
                  </div>
                  </div>
				</div>
			  
			   <div class="form-group">
                <label>	Phone Number</label>
				  <div class="input-group">
				   <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                <input type="text" class="form-control" name="phone_no" data-inputmask='"mask": "(999)-9999999"' data-mask>
                  </div>
                  </div>
			  
              </div>
              </div>
	
	
	
	<div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Birthday</label>
                 <div class="input-group">
				   <div class="input-group-addon">
                    <i class="fa fa-odnoklassniki"></i>
                  </div>
                <input type="text" name="birthday"  class="form-control pull-right" data-inputmask='"mask": "9999-99-99"' data-mask >
                  </div>  
                  </div>
				</div>
			  
			  
			  <div class="form-group">
                <label>	gender</label>
				  <div class="input-group">
				   <div class="input-group-addon">
                    <i class="fa fa-users"></i>
                  </div>
                <select class="form-control select2" name="gend" style="width: 100%;" autofocus >
		<option value="Mr.">Mr.</option>
					<option value="Miss.">Miss.</option>
					<option value="Mrs.">Mrs.</option>
	
                </select>
                  </div>
                  </div> 
              </div>
              </div>
	
	
	
      <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                 <div class="input-group">
				   <div class="input-group-addon">
                    <i class="fa fa-at"></i>
                  </div>
                <input type="text" name="email" class="form-control pull-right"  >
                  </div>  
                  </div>
				</div>
			  
			  
			  <div class="form-group">
                <label>	Address</label>
				  <div class="input-group">
				   <div class="input-group-addon">
                    <i class="fa fa-home"></i>
                  </div>
                <input type="text" name="address" class="form-control pull-right"  >
                  </div>
                  </div> 
              </div>
              </div>
	
		
	
	
	<div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Engine Number</label>
                 <div class="input-group">
				   <div class="input-group-addon">
                    <i class="fa fa-gears"></i>
                  </div>
                <input type="text" name="engine_no" class="form-control pull-right"  >
                  </div>  
                  </div>
				</div>
			  
			  
			  <div class="form-group">
                <label>	Chassis No</label>
				  <div class="input-group">
				   <div class="input-group-addon">
                    <i class="fa fa-code-fork"></i>
                  </div>
                <input type="text" name="chassis_no" class="form-control pull-right"  >
                  </div>
                  </div> 
              </div>
              </div>
	
	
	
	
	<div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Bye Date</label>
                 <div class="input-group">
				   <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                <input type="text" name="bye_date" class="form-control pull-right" data-inputmask='"mask": "9999-99-99"' data-mask  >
                  </div>  
                  </div>
				</div>
			  <div class="form-group">
                <label>	Color</label>
				  <div class="input-group">
				   <div class="input-group-addon">
                    <i class="fa fa-paint-brush"></i>
                  </div>
                <input type="text" name="color" class="form-control pull-right"  >
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
  </div>
  
  <!-- /.content-wrapper -->
    <?php
  //include("dounbr.php");
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
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("YYYY/MM/DD", {"placeholder": "YYYY/MM/DD"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("YYYY/MM/DD", {"placeholder": "YYYY/MM/DD"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY/MM/DD h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
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
