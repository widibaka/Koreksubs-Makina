
<!-- fancybox -->
<script src="<?= base_url('assets/'); ?>plugins/fancybox/jquery.fancybox.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "ordering": false,
      <?php 
      if (is_string($comments)) {
      	echo '"paging": false,';
      } 
      else {
      	echo '"paging": true,';
      }
      ?>
      "lengthChange": false,
      "searching": false,
      "info": false,
      "autoWidth": false,
      "lengthMenu": [6]
    });
  });
  $(function () {
    $("#download_section").DataTable({
      "ordering": false,
      "border" : false
    });
  });

	// For comment submission
	$('#form_comment').on('submit',function(e) {
	  e.preventDefault();
	  // Disable button to avoid double submit
	  $("#post_button").text('Wait...');
	  $("#post_button").attr("disabled", "disabled");
	  $("#post_button").addClass("disabled");
	  $.ajax({
	    type: $(this).attr('method'),
	    url: $(this).attr('action'),
	    data: $(this).serialize(),
	    success: function() {
	      show_comment_immediately();
	      $('#comment').val('')
	      $('#comment').focus()
	      // Turn it back when success
	      $("#post_button").text('Post');
	      $("#post_button").removeAttr("disabled");
	      $("#post_button").removeClass("disabled");
	    }
	  });
	});
	<?php if ( !is_string($comments) ) :?>

		<?php foreach ($comments as $key => $value): ?>

		// For comment delete
		$('#form_delete_comment-<?php echo $value['id'] ?>').on('submit',function(e) {
		  e.preventDefault();
		  // Disable button to avoid double submit
		  $("#delete_comment_button-<?php echo $value['id'] ?>").text('Wait...');
		  $("#delete_comment_button-<?php echo $value['id'] ?>").attr("disabled", "disabled");
		  $("#delete_comment_button-<?php echo $value['id'] ?>").addClass("disabled");
		  $.ajax({
		    type: $(this).attr('method'),
		    url: $(this).attr('action'),
		    data: $(this).serialize(),
		    success: function() {
		      // Give some feedback
		      $('#content-value-<?php echo $value['id'] ?>').html('<h5><span class="badge badge-secondary"><i>-- Komentar ini telah dihapus --</i></span></h5>')
		  	  $("#delete_comment_button-<?php echo $value['id'] ?>").text('Deleted');
		    }
		  });
		});
			
		<?php endforeach ?>
	<?php endif ?>
	
	// to show submitted comment immediately
	function show_comment_immediately(){

		var content_of_comment = $('#comment').val()
		$('#kolom_komentar').prepend('                    <tr><td><div class="post clearfix">                      <div class="user-block">                              <div class="img-circle img-bordered-sm " style="background: url(\'<?= base_url("assets/img/"); ?><?php 
                                    //Jika foto dengan nama user ada, maka tampilkan. Jika tidak, maka pakai no_photo.jpg 
                                    $semua_foto_profil = $this->Directory_model->directory_to_array('assets/img/');
                                      // var_dump($semua_foto_profil);
                                    if( in_array( 'assets/img/' . $this->session->userdata("user_id") . '.jpg', $semua_foto_profil ) ){
                                      echo strtolower($this->session->userdata("user_id"));
                                    } else {
                                      echo 'no_photo';
                                    }
                                    ?>.jpg\') center; width: 40px; height: 40px; background-size: cover; margin-bottom: -40px"></div>                        <span class="username">                          <a><?php 
				
								$try = $this->User_model->getUserDataById( $this->session->userdata("user_id") );

                                if ( !empty($try) ) {

                                  $user_detail = $this->User_model->getUserDataById( $this->session->userdata("user_id") )[0]; // oiya, harus ada index 0 nya. haduuuh...
                                  echo $user_detail['username'];
                                  if ($user_detail['admin'] == 1) {
                                    echo ' <span class="right badge badge-danger" id="message_notification">admin</span>';
                                  }
                                  elseif ( $user_detail['admin'] == 2) {
                                    echo ' <span class="right badge badge-danger" id="message_notification">adminnya admin </span>';
                                  }
                                }else{
                                  echo "<i>Akun ini telah dihapus</i>";
                                }


                                  
                                  ?></a>                        </span>                        <span class="description">Baru saja</span>                      </div>                      <!-- /.user-block -->                      <p>'+content_of_comment+'</p>                     </div><button class="btn disabled badge bg-secondary link-white text-sm float-right" id=""><i class="fas fa-trash mr-1"></i> Refresh first to delete</button></td></tr>')
	}
</script>