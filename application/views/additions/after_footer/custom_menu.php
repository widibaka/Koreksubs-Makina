
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.all.js"></script>
<script type="text/javascript">
	
$(document).ready(function(){

	$('#form_custom_menu').on('submit',function(e) {
	  e.preventDefault();
	  // Disable button to avoid double submit
	  $("#simpan").text('Wait...');
	  $("#simpan").attr("disabled", "disabled");
	  $("#simpan").addClass("disabled");
	  $("#simpan").removeClass("btn-primary");
	  $("#simpan").addClass("btn-secondary");
	  $.ajax({
	    type: $(this).attr('method'),
	    url: $(this).attr('action'),
	    data: $(this).serialize(),
	    success: function() {
	      successAlert();
	      // Turn it back when success
	      $("#simpan").text('Simpan');
	      $("#simpan").removeAttr("disabled");
	      $("#simpan").removeClass("disabled");
	      $("#simpan").addClass("btn-primary");
	      $("#simpan").removeClass("btn-secondary");
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