





    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Price</h3>

          
        <!-- /.box-header -->
		<div class="form-group">
              
		<form method="post" action="product_edit_save.php">
		
        <div class="box-body">
         
	   				  
											  
      <!-- /.box -->
<div class="form-group">
              
	<?php 
	include('connect.php');
	$id=$_GET['id'];
	 $result = $db->prepare("SELECT * FROM product WHERE product_id='$id' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){

				$sell=$row['sell'];
					$cost=$row['cost'];
					$re_order=$row['re_order'];
				}
	
	
	?>	
	
	
       
	<div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>sell price</label>
                 <div class="input-group">
				   <div class="input-group-addon">
                    <i >Rs.</i>
                  </div>
                <input type="text" name="sell" value="<?php echo $sell ?>" class="form-control pull-right" required >
					 <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control pull-right" required >
                  </div>  
                  </div>
				</div>
			  <div class="form-group">
                <label>cost price</label>
				  <div class="input-group">
				   <div class="input-group-addon">
                    <i >Rs.</i>
                  </div>
                <input type="text" name="cost" value="<?php echo $cost ?>" class="form-control pull-right" required >
                  </div>
                  </div> 
			  
			   <div class="form-group">
                <label>Re order</label>
				  <div class="input-group">
				   <div class="input-group-addon">
                    <i ></i>
                  </div>
                <input type="text" name="re" value="<?php echo $re_order; ?>" class="form-control pull-right" required >
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
     