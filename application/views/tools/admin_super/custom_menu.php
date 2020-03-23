<div class="row">
	<div class="col-xl-6">
	      <!-- SEPARATOR -->
	      <div class="card card-default">
	        <div class="card-header">
	          <h3 class="card-title">Pengaturan Custom Menu</h3>

	          <div class="card-tools">
	            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	          </div>
	        </div>
	        <!-- /.card-header -->
	        <div class="card-body">
	          <div class="row">
	            <div class="col-12">
	              <form action="" method="post" name="form_custom_menu" id="form_custom_menu">
	              	<p class="mb-1 mt-3">Nama Custom Menu</p>
	              	<input type="hidden" name="is_form_custom_menu" value="yes">
	                <input type="text" class="form-control" name="custom_menu_name" value="<?php echo $fansub_preferences['custom_menu_name'] ?>">
	              	<p class="mb-1 mt-3">Status Custom Menu </p>
	                <select style="width: 120px" class="form-control" name="status_custom_menu">
	                	<option <?php 
	                	if( $fansub_preferences['status_custom_menu']=="1" ){echo "selected";} 
	                	?> value="1">Aktif</option>
	                	<option <?php 
	                	if( $fansub_preferences['status_custom_menu']=="0" ){echo "selected";} 
	                	?> value="0">Nonaktif</option>
	                </select>
	              	<p class="mb-1 mt-3">Custom Menu Items </p>
	              	Format pengisian custom menu: <code>nama_item1@link_item1@nama_item2@link_item2 ...</code>
	                <input type="text" class="form-control" name="link_custom_menu" value="<?php echo $fansub_preferences['link_custom_menu'] ?>">
	                <button class="float-right btn mt-2 bg-warning" type="submit" id="simpan">Simpan</button>
	              </form>
	            </div>
	            <!-- /.col -->
	          </div>
	          <!-- /.row -->
	        </div>
	        <!-- /.card-body -->
	      </div>
	      <!-- /.card -->
	</div>
</div>



