
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.all.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

		// ================  For themes
		<?php foreach ($themes_collection as $key => $current_theme): ?>

		$('#<?php echo $current_theme['name'] ?>').on('click',function() {
		  $("#input_theme_name").val('<?php echo $current_theme['name'] ?>');
		  $("#input_theme_image").val('<?php echo base_url("assets/img/theme/") . $current_theme['image'] ?>');
		  $("#input_theme_navbar_skin").val('<?php echo $current_theme['navbar_skin'] ?>');
		  $("#input_theme_navbar_varian").val('<?php echo $current_theme['navbar_varian'] ?>');
		  $("#input_theme_brand_color").val('<?php echo $current_theme['brand_color'] ?>');
		  $("#input_theme_sidebar_color").val('<?php echo $current_theme['sidebar_color'] ?>');
		  $("#input_theme_accent_color").val('<?php echo $current_theme['accent_color'] ?>');
		});
		<?php endforeach ?>

		// ================ For brand color
		<?php
		#makes php array into js array
			echo "
			var brand_colors_classes = [";
			foreach ($brand_colors as $i => $v){
				 echo "'bg-" . $v . "',
				 ";
			}
			echo "]";
		?>

		<?php foreach ($brand_colors as $key => $value): ?>

		$('#<?php echo $value ?>').on('click',function() {
		  $("#input_brand_color").val('<?php echo $value; ?>');
		  $("#brand").removeClass(brand_colors_classes);
		  $("#brand").addClass('bg-<?php echo $value; ?>');
		});
		<?php endforeach ?>


		// ================  For navbar color
		<?php
		#makes php array into js array
			echo "
			var varian_light = [";
			foreach ($navbar_colors['light'] as $i => $v){
				 echo "'" . $v . "',
				 ";
			}
			echo "]";
		?>
		<?php
			echo "
			var varian_dark = [";
			foreach ($navbar_colors['dark'] as $i => $v){
				 echo "'" . $v . "',
				 ";
			}
			echo "]";
		?>

		<?php foreach ($navbar_colors['light'] as $key => $value): ?>

		$('#<?php echo $value ?>').on('click',function() {

		  $("#input_navbar_skin").val('navbar-light');
		  $('#input_navbar_varian').val('<?php echo $value; ?>')
		  	// remove all varian light classes
			$('.main-header').removeClass(varian_light);
		 	// remove all varian dark classes
			$('.main-header').removeClass(varian_dark);
		 	// remove dark classes
			$('.main-header').removeClass('navbar-dark')
		 	// add light classes
			$('.main-header').addClass('navbar-light')
		 	// add varian classes
			$('.main-header').addClass('<?php echo $value; ?>')

		});
		<?php endforeach ?>
		<?php foreach ($navbar_colors['dark'] as $key => $value): ?>

		$('#<?php echo $value ?>').on('click',function() {

		  $("#input_navbar_skin").val('navbar-dark');
		  $('#input_navbar_varian').val('<?php echo $value; ?>')
		  	// remove all varian light classes
			$('.main-header').removeClass(varian_light);
		 	// remove all varian dark classes
			$('.main-header').removeClass(varian_dark);
		 	// remove light classes
			$('.main-header').removeClass('navbar-light')
		 	// add dark classes
			$('.main-header').addClass('navbar-dark')
		 	// add varian classes
			$('.main-header').addClass('<?php echo $value; ?>')

		});
		<?php endforeach ?>


		// ================ For sidebar color
		<?php
		#makes php array into js array
			echo "
			var sidebar_colors_classes = [";
			foreach ($sidebar_colors as $i => $v){
				 echo "'" . $v . "',
				 ";
			}
			echo "]";
		?>

		<?php foreach ($sidebar_colors as $key => $value): ?>

		$('#<?php echo $value ?>').on('click',function() {
		  $("#input_sidebar_color").val('<?php echo $value; ?>');
		  $(".main-sidebar").removeClass(sidebar_colors_classes);
		  $(".main-sidebar").addClass('<?php echo $value; ?>');
		});
		<?php endforeach ?>



		// ================ For accent color

		<?php foreach ($accent_colors as $key => $value): ?>

		$('#accent_<?php echo $value ?>').on('click',function() {
		  $("#input_accent_color").val('<?php echo $value; ?>');
		});
		<?php endforeach ?>







		//  ================ For navbar color submission
		$('#form_navbar_color').on('submit',function(e) {
		  e.preventDefault();
		  // Disable button to avoid double submit
		  $("#simpan_navbar").text('Wait...');
		  $("#simpan_navbar").attr("disabled", "disabled");
		  $("#simpan_navbar").addClass("disabled");
		  $.ajax({
		    type: $(this).attr('method'),
		    url: $(this).attr('action'),
		    data: $(this).serialize(),
		    success: function() {
		      successAlert();
		      // Turn it back when success
		      $("#simpan_navbar").text('Simpan');
		      $("#simpan_navbar").removeAttr("disabled");
		      $("#simpan_navbar").removeClass("disabled");
		    }
		  });
		});

		//  ================ For brand color submission
		$('#form_brand_color').on('submit',function(e) {
		  e.preventDefault();
		  // Disable button to avoid double submit
		  $("#simpan_brand").text('Wait...');
		  $("#simpan_brand").attr("disabled", "disabled");
		  $("#simpan_brand").addClass("disabled");
		  $.ajax({
		    type: $(this).attr('method'),
		    url: $(this).attr('action'),
		    data: $(this).serialize(),
		    success: function() {
		      successAlert();
		      // Turn it back when success
		      $("#simpan_brand").text('Simpan');
		      $("#simpan_brand").removeAttr("disabled");
		      $("#simpan_brand").removeClass("disabled");
		    }
		  });
		});

		//  ================ For sidebar color submission
		$('#form_sidebar_color').on('submit',function(e) {
		  e.preventDefault();
		  // Disable button to avoid double submit
		  $("#simpan_sidebar").text('Wait...');
		  $("#simpan_sidebar").attr("disabled", "disabled");
		  $("#simpan_sidebar").addClass("disabled");
		  $.ajax({
		    type: $(this).attr('method'),
		    url: $(this).attr('action'),
		    data: $(this).serialize(),
		    success: function() {
		      successAlert();
		      // Turn it back when success
		      $("#simpan_sidebar").text('Simpan');
		      $("#simpan_sidebar").removeAttr("disabled");
		      $("#simpan_sidebar").removeClass("disabled");
		    }
		  });
		});


		//  ================ For accent color submission
		$('#form_accent_color').on('submit',function(e) {
		  e.preventDefault();
		  // Disable button to avoid double submit
		  $("#simpan_accent").text('Wait...');
		  $("#simpan_accent").attr("disabled", "disabled");
		  $("#simpan_accent").addClass("disabled");
		  $.ajax({
		    type: $(this).attr('method'),
		    url: $(this).attr('action'),
		    data: $(this).serialize(),
		    success: function() {
		      successAlert();
		      // Turn it back when success
		      $("#simpan_accent").text('Simpan');
		      $("#simpan_accent").removeAttr("disabled");
		      $("#simpan_accent").removeClass("disabled");
		    }
		  });
		});




		const Toast = Swal.mixin({
		  toast: true,
		  position: 'top-end',
		  showConfirmButton: false,
		  timer: 3000,
		  timerProgressBar: true,
		  onOpen: (toast) => {
		    toast.addEventListener('mouseenter', Swal.stopTimer)
		    toast.addEventListener('mouseleave', Swal.resumeTimer)
		  }
		})

		function successAlert() {
		  Toast.fire({
		    type: 'success',
		    title: 'Perubahan berhasil disimpan'
		  })
		}






	});
</script>