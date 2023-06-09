
<?php 
 date_default_timezone_set("Asia/Colombo");
 include("connect.php");
$sales_id=1;
$resultj = $db->prepare("SELECT * FROM job WHERE type='active'  ORDER by id ASC ");
				$resultj->bindParam(':userid', $date);
                $resultj->execute();
                for($i=0; $rowj = $resultj->fetch(); $i++){
					$pro_invo="-45".$rowj['vehicle_no'];
		
		$id=$rowj['id'];						
		$reason=$rowj['reason'];
				$vehicle=$rowj['vehicle_no'];
					
					$result1 = $db->prepare("SELECT * FROM customer WHERE vehicle_no='$vehicle'");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				$idi=$row1['customer_id'];	
					$name=$row1['customer_name'];
					$phone=$row1['contact'];
					$phone2=0;
				}
					
					
		if($reason==""){
			}else{	
					
?>



	<div class="col-md-5">
 <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $vehicle; ?></h3><br>
				
<?php echo $name; ?><br>
		<?php echo $phone; ?> / <?php echo $phone2; ?><br>
				
				<span class="badge bg-green"> <?php echo $reason; ?> </span>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
         
<a href="cancel_job_appr.php?id=<?php echo $id; ?>" >
					  <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button></a>
	 </div></div>


<?php }   }	?>
	