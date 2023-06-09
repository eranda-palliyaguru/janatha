<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
?>
<body class="hold-transition skin-red sidebar-mini layout-top-nav">
<?php 
include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];

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
 
<center>
    <!-- Main content -->
    <section class="content">
<a href="job_add.php" >
					  <button class="btn btn-success"><i class="glyphicon glyphicon-user"></i> Add New Job </button></a><br><br>
 <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">JOB Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th >Vehicle No.</th>
                    <th >Mileage</th>
                    <th>Time</th>
					  <th>Type</th>
					  <th>Phone</th>
                   
                  </tr>
                  </thead>
                  <tbody>
					  <?php 
				date_default_timezone_set("Asia/Colombo");	  
			$result = $db->prepare("SELECT * FROM job WHERE type='active' ORDER by id DESC LIMIT 20 ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$date=$row['date'];
					$ramp=$row['ramp'];
					$phone="";
					
					if($ramp==""){ $color_ramp="yellow"; $info="Waiting"; }
					if($ramp>0){ $color_ramp="blue"; $info="Ramp No.".$ramp; }
					if($ramp=="out"){ $color_ramp="green"; $info="Washing"; }
					
					
					
					
					$date1=date("Y-m-d");
					if($date==$date1){
					$time=$row['time'];
					
						
			$split = explode(".", $time);
            $hh = $split[0];
			$hh1=date("H");
						$h=$hh1-$hh;
						
			if($h==0){ 
				$split = explode(".", $time);
			    $m = $split[1];
				$m1= date("i");
				$time_on=$m1-$m;
				
			$time_type="minute";
			}else{
			$time_on=$h;
			$time_type="hours";	
			}
						
						
						
					}else{
				  $sday= strtotime( $date);
                  $nday= strtotime($date1);
                  $tdf= abs($nday-$sday);
                  $nbday1= $tdf/86400;
                  $time_on= intval($nbday1);
						$time_type="Day";
					}
					
					
					if($time_type=="minute"){ $color="green"; }
					if($time_type=="Day"){ $color="red";  }
					if($time_type=="hours"){ $color="blue";								   
					     if($time_on>4){ $color="yellow"; }	 }  
										   
					$vehicle=$row['vehicle_no'];
					$idi=0;
					$result1 = $db->prepare("SELECT * FROM customer WHERE vehicle_no='$vehicle'");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				$idi=$row1['customer_id'];	
					$phone=$row1['contact'];
				}
					
					  ?>
                  <tr>
                    <td><?php echo $row['vehicle_no'];?></td>
                    <td><?php echo $row['km'];?></td>
                    <td><span class="badge bg-<?php echo $color;?>"><i class="fa fa-clock-o"></i> <?php echo $time_on." ".$time_type;?></span></td>
					  
					  <td><span class="badge bg-<?php echo $color_ramp;?>"><?php echo $info;?></span></td>
					  
					  
					  <td><?php echo $phone ?> </td>
                  </tr>
                  <?php } ?>
                  </tbody>
					
                </table>
              </div>
              <!-- /.table-responsive -->
				
            </div>
	 
	 
	 </div>
		
    </section>
	</center>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->
    <?php
	
	
	

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
