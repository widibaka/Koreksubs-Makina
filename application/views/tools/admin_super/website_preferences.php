<div class="row">
	<div class="col-xl-6">
	      <!-- SEPARATOR -->
	      <div class="card card-default">
	        <div class="card-header">
	          <h3 class="card-title">Website Preferences</h3>

	          <div class="card-tools">
	            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	          </div>
	        </div>
	        <!-- /.card-header -->
	        <div class="card-body">
	          <div class="row">
	            <div class="col-12">
	              <form action="" method="post" name="form_preferences" id="form_preferences">
	              	<p class="mb-1 mt-3">Fansub name</p>
	                <input type="text" class="form-control" name="fansub_name" value="<?php echo $fansub_preferences['fansub_name'] ?>">
	              	<p class="mb-1 mt-3">Konten per halaman, untuk tampilan tile </p>
	                <input type="text" class="form-control" name="rows_perpage_tile" value="<?php echo $fansub_preferences['rows_perpage_tile'] ?>">
	              	<p class="mb-1 mt-3">Konten per halaman, untuk tampilan list </p>
	                <input type="text" class="form-control" name="rows_perpage_list" value="<?php echo $fansub_preferences['rows_perpage_list'] ?>">
	              	<p class="mb-1 mt-3">Teks About </p>
	                <textarea type="text" class="form-control" name="about_text"><?php echo $fansub_preferences['about_text'] ?></textarea>
	              	<p class="mb-1 mt-3">Logo</p>
	              	<code>Logo bisa diganti di directory : assets/dist/img/Logo.png</code>
	              	<p class="mb-1 mt-3">Theme default (yang dilihat oleh Guest) </p>
	                <select class="form-control" name="theme_default">
	                	<?php foreach ($themes_collection as $key => $value): ?>
	                		<?php if ( $fansub_preferences['theme_default'] == $value['name'] ): ?>
	                		<option selected><?= $value['name'] ?></option>
	                		<?php else: ?>
	                		<option><?= $value['name'] ?></option>
	                		<?php endif ?>
	                		
	                	<?php endforeach ?>
	                	
	                </select>
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
