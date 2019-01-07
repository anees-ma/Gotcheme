



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
	  
	  <?php 
		if($this->session->userdata("notification")){
			echo $this->session->userdata('notification');
			$this->session->unset_userdata("notification");
		}
	?>
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <?php //echo $error;?> 
			<?php echo form_open_multipart('admin/add_stock');?>
              <div class="box-body">
                <div class="form-group">
                  <label for="">Item name</label>
                  <input type="text" class="form-control" value="" name="itemname" placeholder="Enter item name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Item quantity</label>
                  <input type="text" class="form-control" value="" name="quantity" placeholder="Enter quantity">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Item image</label>
                  <input type="file" id="exampleInputFile" name="image">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

          <!-- Form Element sizes -->
          <!-- /.box -->

          
          <!-- /.box -->

          <!-- Input addon -->
         
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
       
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<!-- ./wrapper -->
