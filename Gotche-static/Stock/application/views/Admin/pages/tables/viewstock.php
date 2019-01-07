

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
		
		<?php 
			if($this->session->userdata("profile")){
				echo $this->session->userdata('profile');
				$this->session->unset_userdata("profile");
			}
		?>

		<p id="dlt-scs" style="color:green;font-weight:bold;display:none">Stock entry deleted successfully!</p>
		<p id="dlt-fld" style="color:red;font-weight:bold;display:none">Failed to delete stock entry, try again!</p>
		
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Stock list</h3>
			  
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="stocklist" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Item Name</th>
                  <th>Quantity</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php 
				
				$this->load->helper('general_helper');
				$i=0;
				foreach($result as $values){
					
					$img_path=img_path_trim($values['file']);
					echo '<tr id="tr'.$i.'">
					  <td id="id'.$i.'">'.$values['id'].'</td>
					  <td>'.$values['item_name'].'
					  </td>
					  <td>'.$values['quantity'].'</td>
					  <td> <img src="'.base_url($img_path).'" width="60"></td>
					  <td><button id="delete_b'.$i.'" type="button" class="btn btn-primary delete_btn">Delete</button></td>
					</tr>';
					$i++;
				}
               ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

<!-- DataTables -->
<script src="<?php echo base_url() ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $('#stocklist').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>

<script>

	$(".delete_btn").click(function() {
		if(confirm('Are you sure to delete the item?')){
		var bid=this.id;
	var id_digit=bid.substring(8);
	var id_item=$("#id"+id_digit).html();
	var tr_id='#tr'+id_digit;
	
	$.ajax({
		url  : "<?php echo base_url(); ?>/admin/delete_stock",
	   type: "POST",
	   data: {id:id_item},
	   success: function(msg){
		   $(tr_id).css("display", "none");
		 $("#dlt-scs").css("display", "block");
	   },
		error: function () {
			$("#dlt-fld").css("display", "block");
		}
	});
	

		}else {
			alert('cancelled');
		}
});
</script>
</body>
</html>
