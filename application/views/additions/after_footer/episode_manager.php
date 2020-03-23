<!-- SweetAlert2 -->
<script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2@9.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>

<!-- AJAX Form AddEpisode -->

<script>

  $(document).ready(function(){

    $('#delete_all_episode').on('click',function() {
      delete_all_episode_Confirm();
    });

    $('#form_multiple_episode').on('submit',function(e) {
      e.preventDefault();
      // Disable button to avoid double submit
      $("#add_multiple_episodes_button").text('Wait...');
      $("#add_multiple_episodes_button").attr("disabled", "disabled");
      $("#add_multiple_episodes_button").addClass("disabled");
      $("#add_multiple_episodes_button").removeClass("btn-primary");
      $("#add_multiple_episodes_button").addClass("btn-secondary");
      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function() {
          successAddEpsAlert();
          // Turn it back when success
          $("#add_multiple_episodes_button").text('Add multiple episodes');
          $("#add_multiple_episodes_button").removeAttr("disabled");
          $("#add_multiple_episodes_button").removeClass("disabled");
          $("#add_multiple_episodes_button").addClass("btn-primary");
          $("#add_multiple_episodes_button").removeClass("btn-secondary");

        }
      }
      );
    });

    $('#form_add_episode').on('submit',function(e) {
      e.preventDefault();
      // Disable button to avoid double submit
      $("#add_new_episode_button").text('Wait...');
      $("#add_new_episode_button").attr("disabled", "disabled");
      $("#add_new_episode_button").addClass("disabled");
      $("#add_new_episode_button").removeClass("btn-primary");
      $("#add_new_episode_button").addClass("btn-secondary");
      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function() {
          successAddEpsAlert();
          // Turn it back when success
          $("#add_new_episode_button").text('Add a new episode');
          $("#add_new_episode_button").removeAttr("disabled");
          $("#add_new_episode_button").removeClass("disabled");
          $("#add_new_episode_button").addClass("btn-primary");
          $("#add_new_episode_button").removeClass("btn-secondary");

        }
      }
      );
    });

    $('#form_progress').on('submit',function(e) {
      e.preventDefault();
      // Disable button to avoid double submit
      $("#progress_submit").text('Wait...');
      $("#progress_submit").attr("disabled", "disabled");
      $("#progress_submit").addClass("disabled");
      $("#progress_submit").removeClass("btn-primary");
      $("#progress_submit").addClass("btn-secondary");
      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function() {
          progressSimpan();
          // Turn it back when success
          $("#progress_submit").text('Add a new episode');
          $("#progress_submit").removeAttr("disabled");
          $("#progress_submit").removeClass("disabled");
          $("#progress_submit").addClass("btn-primary");
          $("#progress_submit").removeClass("btn-secondary");

        }
      }
      );
    });
<?php if (!empty($episodes)) : ?>
  // Untuk tombol delete yang banyak, sebanyak episodenya
  <?php foreach ($episodes as $eps) :?>
        //untuk button hapus episode
      $('#form_hapus_episode-<?= $eps['anime_child_id']; ?>').on('submit',function(e) {
        e.preventDefault();
        $("#episode-<?= $eps['anime_child_id']; ?>").addClass("d-none");
        $.ajax({
          type: $(this).attr('method'),
          url: $(this).attr('action'),
          data: $(this).serialize(),
          success: function() {
            successDeleteAlert();
          }
        }
        );
      })
  <?php endforeach; ?>
<?php endif; ?>
    function successAddEpsAlert() {
      swal.fire({
        title: "Episode berhasil ditambahkan",
        icon: "success",
        showCancelButton: true,
        confirmButtonText: "Refresh",
        cancelButtonText: "Close",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          location.href='<?= base_url("admin/episode_manager/" . "$id") ?>';
        }
      })
    }

    function successDeleteEpsAlert() {
      swal.fire({
        title: "Episode berhasil dihapus",
        icon: "success",
        showCancelButton: true,
        confirmButtonText: "Refresh",
        cancelButtonText: "Close",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          location.href='<?= base_url("admin/episode_manager/" . "$id") ?>';
        }
      })
    }

    function delete_all_episode_Confirm() {
      swal.fire({
        title: "Anda yakin ingin menghapus semuanya?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "DELETE ALL!",
        confirmButtonColor: 'red',
        cancelButtonText: "Close",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          location.href='<?php echo base_url('admin/delete_all_episode/' . $id); ?>';
        }
      })
    }

    function progressSimpan() {
      swal.fire({
        title: "Progres berhasil diubah",
        icon: "success",
        showCancelButton: true,
        confirmButtonText: "Refresh",
        cancelButtonText: "Close",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          location.href='<?= base_url("admin/episode_manager/" . "$id") ?>';
        }
      })
    }

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

    function successDeleteAlert() {
      Toast.fire({
        type: 'success',
        title: 'Berkas episode berhasil dihapus'
      })
    }

</script>

<!-- DataTables -->
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#download_section").DataTable({
      "ordering": false,
      "border" : false
    });
  });
</script>

