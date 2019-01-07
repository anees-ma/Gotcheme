



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
	  
    <?php
		if($this->session->userdata("profile")){
			echo $this->session->userdata('profile');
			$this->session->unset_userdata("profile");
		}
	?>
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <?php //echo $error;?> 
			<?php echo form_open_multipart('admin/edit_profile');?>
              <div class="box-body">
                <div class="form-group">
                  <label for="">New username</label>
                  <input type="text" class="form-control" value="" name="newuname" placeholder="New username">
                </div>
                <div class="form-group">
                  <label for="">New Password</label>
                  <input type="text" class="form-control" value="" name="newpword" placeholder="New password">
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
