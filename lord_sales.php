<form method="get" action="sales.php">
	<div class="col-md-10">
	<div class="input-group">              
		<select class="form-control select2" name="id" style="width: 100%;" tabindex="1" autofocus >
		<?php  include("connect.php");
         $result = $db->prepare("SELECT * FROM customer ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){ ?>
		<option value="-22<?php echo $row['vehicle_no'];?>"><?php echo $row['customer_name']; ?>-<?php echo $row['vehicle_no']; ?> </option>
	<?php	} ?>
                </select>
		 </div>
		<input class="btn btn-info" type="submit" value="bill" >
	</div>
	
	
	</form>



<form method="post" action="sales_oder_save.php">
	<div class="col-md-10">
	<div class="input-group">   <br><br>           
		<input type="text" name="id"  class="form-control" data-inputmask='"mask": "AAA-9999"' data-mask required>

		 </div>
		<input class="btn btn-info" type="submit" value="bill" >
	</div>
	
	
	</form>


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

<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

   
    $("[data-mask]").inputmask();

  });
</script>