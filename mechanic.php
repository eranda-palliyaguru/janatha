<!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Mechanic</h3>
        <!-- /.box-header -->
		<div class="form-group">
		<form method="post" action="mechanic_save.php">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Mechanic Name</label>
               <input type="text" name="mechanic">
				</div>
              </div>
			   <?php date_default_timezone_set("Asia/Colombo"); ?>
        </div>
      </div>									  
      <!-- /.box -->
<div class="form-group">
<input class="btn btn-info" type="submit" value="Save" >	  
			  </form>
          <!-- /.box -->
        </div>
<!-- /.box-body -->           
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->