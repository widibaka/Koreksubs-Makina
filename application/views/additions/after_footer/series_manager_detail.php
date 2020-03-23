
<!-- Summernote -->
<script src="<?= base_url('assets/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- fancybox -->
<script src="<?= base_url('assets/'); ?>plugins/fancybox/jquery.fancybox.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2@9.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>

<!-- AJAX Form AddEpisode -->

<script>

  $(document).ready(function(){

    $('#form_edit_anime').on('submit',function(e) {
      e.preventDefault();
      // Disable button to avoid double submit
      $("#save_edit").text('Wait...');
      $("#save_edit").attr("disabled", "disabled");
      $("#save_edit").addClass("disabled");
      $("#save_edit").removeClass("btn-primary");
      $("#save_edit").addClass("btn-secondary");
      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function() {
          successUpdateAnime();
          // Turn it back when success
          $("#save_edit").text('Save edit');
          $("#save_edit").removeAttr("disabled");
          $("#save_edit").removeClass("disabled");
          $("#save_edit").addClass("btn-primary");
          $("#save_edit").removeClass("btn-secondary");
        }
      });
    });
    // Ketika reset default
    $('#reset_default').on('click',function() {
      $('#trailer_button').attr('href', 'https://youtube.com/watch?v=<?= $kitsu_anime['attributes']['youtubeVideoId']; ?>');
      $('#title').val('<?php
                        if (!empty($kitsu_anime['attributes']['titles']['en_jp'])) {
                           echo str_replace('"', '\"', str_replace("'", "\'", $kitsu_anime['attributes']['titles']['en_jp']));
                         } 
                        ?><?php
                        if (!empty($kitsu_anime['attributes']['titles']['en'])) {
                           echo ' (' . str_replace('"', '\"', str_replace("'", "\'", $kitsu_anime['attributes']['titles']['en'])) . ')';
                         } 
                        ?>');
      $('#trailer').val('https://youtube.com/watch?v=<?= $kitsu_anime['attributes']['youtubeVideoId']; ?>');
      $('#poster_url_small').val('<?= $kitsu_anime['attributes']["posterImage"]['small']; ?>');
      $('#poster_url_medium').val('<?= $kitsu_anime['attributes']["posterImage"]['medium']; ?>');
      $('#categories').val('<?php
                      //Echo semua categories
                      foreach ($kitsu_categories["data"] as $key_cat => $value) {
                        echo $value["attributes"]["title"].", ";
                      }
                   ?>');
      $('#season').val('<?= $season; ?>');
      $('#year').val('<?= $year; ?>');
      $('#kitsu_info').val('<?= $kitsu_info; ?>');
    });

    function successUpdateAnime() {
      swal.fire({
        title: "Perubahan anime berhasil disimpan",
        icon: "success",
        showCancelButton: true,
        confirmButtonText: "Ke halaman client dan lihat perubahan",
        cancelButtonText: "Close",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          location.href='<?= base_url("client/anime/" . "$id") ?>';
        }
      })
    }
    $(function () {
      // Summernote
      $('.textarea').summernote({
          placeholder: 'Halo selamat pagisiangsoremalam...',
          tabsize: 2,
          height: 120,
          toolbar: [
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
          ]
        })
    })

  });
  
</script>


