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









    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Collection Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Collection Report</li>
      </ol>
    </section>
	
	
	

      <!-- SELECT2 EXAMPLE -->
	        
      
     <form action="delay payment.php" method="get">   
	<center>
	
			  
			  
			<strong>


			<label>Type</label>
                  <select class="form-control" name="id" style="width:123px; padding:4px;" >
                    <option  >day</option>
                    <option>week</option>
                    
                  </select>
			
			<br>

 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>
 
</strong>  
			  
		<br>	  
			  
         	 
			 </center>
			 </form>
			 
			

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Collection Report</h3>
		  
		  
		  
		  
		  
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>ORDER ID</th>
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Pay Amount</th>
					<th>Delay Amount</th>
                  <th>Delay Date</th>
				   <th>Type</th>
				   <th>#########</th>
                  
                </tr>
                </thead>
                <tbody>
				
			
			<?php
$type=$_GET['id'];
 



if($type=="week"){
			
		date_default_timezone_set("Asia/Colombo");
		$date =  date('Y/m/d',strtotime("-7 days") );
				  

$hh=$date;
}


else{
	date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
}

		
		
		$type=$_GET['id'];
		$result = $db->prepare("SELECT * FROM credit_sales_order WHERE ls_date< :userid AND status='incomplete' AND type='$type' ORDER by ls_date ASC ");
$result->bindParam(':userid', $hh);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
	
	$date1 = $row['ls_date'];
	$type=$row['type'];
	
$h1=$row['amount'];
$h2=$row['amount_left'];
$h3=$h1/100;
$h41=$h2/$h3;
$h4=100-$h41;







                     date_default_timezone_set("Asia/Colombo");
                       $date =  date("Y/m/d");
				  $sday= strtotime( $date1);
                  $nday= strtotime($date);
                  $tdf= abs($nday-$sday);
                  $nbday= $tdf/86400;
                  $nbday= intval($nbday);
                  
				  

?>
			
			
			
                <tr>
				<td>OR_<?php echo $row['order_id'];?></td>
                  <td><a href="cus_s.php?id=<?php echo $row['cus_name'];?>"><?php echo $row['cus_name'];?></a></td>
                  <td>Rs.<?php echo $row['amount'];?>
                  </td>
				   <td>Rs.<?php echo $row['amount'] - $row['amount_left'];?></td>
					<td>Rs.<?php echo $row['dela'];?></td>
                  <td><?php


if($type=="week"){
				  echo $nbday-7;
				  echo '</td><td><small class="label  bg-red">Week</small></td>';
				  
				  
}
else{
		echo $nbday;
		  echo '</td><td><small class="label  bg-green">Delay</small></td>';
}		
				  
				  
				  ?></td>
                 
				   <td><div class="progress progress-sm active">
                      <div class="progress-bar progress-bar-danger progress-bar-striped" style="width: <?php echo$h4;?>%"></div>
                    </div></td>
                  
                </tr>
               <?php 
				  
				}
				   ?>
                
                </tbody>
				
                <tfoot>
                
				
				
				
				 
				
				
                </tfoot>
              </table>
            </div>
			
			<center>
			
			
			
			<td>
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






<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<
<!-- FastClick -->






  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="../../plugins/chartjs/Chart.min.js"></script>
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
    //$('#datepicker').datepicker({datepicker: true,  format: 'yyyy/mm/dd '});
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
	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy/mm/dd '});
    $('#datepicker').datepicker({
      autoclose: true
    });
	
	
	
	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy/mm/dd '});
    $('#datepickerd').datepicker({
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
