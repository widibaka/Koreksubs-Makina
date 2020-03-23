
        <div class="row">
          <div class="col-12">
            <div class="row margin">
            	<!-- form-nya dikasih "action" supaya nanti balik lagi ke halaman pertama -->
            	<!-- I put "action" value into the form so I would go back to the very first page -->
              <form action="<?= base_url() ?>client/advanced_search/1.asp" method="get"  class="col-12 row margin">
	              <div class="col-sm-4 callout callout-danger">
	              	<div class="form-group">
	              		<input id="nama_anime" type="text" name="nama_anime" class="form-control col-12" placeholder="Nama anime..." value="<?= $nama_anime; ?>" autofocus="on">
	              	</div>
	                
	              </div>
	              <!-- /.callout -->
	              <div class="col-sm-4 callout callout-danger">
	              	<p class="text-secondary">Pilih rating.</p>
	              	<x class="text-secondary" id="a_rating_from"></x><x class="text-secondary">%</x>
	              	<x class="text-secondary">sampai dengan</x>
	              	<x class="text-secondary" id="a_rating_to"></x><x class="text-secondary">%</x>
	                <input type="hidden" name="rating_from" id='rating_from'>
	                <input type="hidden" name="rating_to" id='rating_to'>
	                <input id="rating_range" type="text" data-from="<?= $rating_from; ?>" data-to="<?= $rating_to; ?>">
	              </div>
	              <!-- /.callout -->
	              <div class="col-sm-4 callout callout-danger">
	              	<p class="text-secondary">Pilih masa rilis.</p>
	              	<div class="row">
	              		<div class="form-group col-6">
	              		  <label>Musim</label>
	              		  <select class="form-control" style="width: 100%;" name="season">

<?php switch ($season) {
	case 'Winter':
		echo '
	              		    <option>-All-</option>
	              		    <option selected="selected">Winter</option>
	              		    <option>Spring</option>
	              		    <option>Summer</option>
	              		    <option>Fall</option>';
		break;
	
	case 'Spring':
		echo '
	              		    <option>-All-</option>
	              		    <option>Winter</option>
	              		    <option selected="selected">Spring</option>
	              		    <option>Summer</option>
	              		    <option>Fall</option>';
		break;
	
	case 'Summer':
		echo '
	              		    <option>-All-</option>
	              		    <option>Winter</option>
	              		    <option>Spring</option>
	              		    <option selected="selected">Summer</option>
	              		    <option>Fall</option>';
		break;
	
	case 'Fall':
		echo '
	              		    <option>-All-</option>
	              		    <option>Winter</option>
	              		    <option>Spring</option>
	              		    <option>Summer</option>
	              		    <option selected="selected">Fall</option>';
		break;
	
	default:
		echo '
	              		    <option selected="selected">-All-</option>
	              		    <option>Winter</option>
	              		    <option>Spring</option>
	              		    <option>Summer</option>
	              		    <option>Fall</option>';
		break;
} ?>

	              		  </select>
	              		</div>
	              		<!-- /.form-group -->
	              		<div class="form-group col-6">
	              		  <label>Tahun</label>
	              		  <input class="form-control" style="width: 100%;" name="year" placeholder="20xx..." value="<?= $year; ?>">
	              		</div>
	              		<!-- /.form-group -->
	              	</div>
	              </div>
	              <!-- /.callout -->
	              <button class="col-12 btn btn-secondary mb-4">Search <i class="fa fa-search fa-fw" style="font-size: 12px;"></i></button>
              </form>
          	</div>
          	<p class="text-secondary">
          		Result: <?= $total_anime; ?> anime
          	</p>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
