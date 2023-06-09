<?php
 date_default_timezone_set("Asia/Colombo");
 include("connect.php");

$id=$_GET['id'];


?>

<div class="form-group">
	<div class="box-body">
       <form method="post" action="save_cancel_job.php">
		   
         <label>	Reason Note</label>
		<textarea name="note" class="textarea" placeholder="Reason" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
		
				

		   
		   
		<input type="hidden"  name="id" value="<?php echo $id; ?>"  >	  
		   <div class="col-md-8">
       <input class="btn btn-info" type="submit" value="Submit" >
              </div></div>
 
			  </form>
              </div>

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