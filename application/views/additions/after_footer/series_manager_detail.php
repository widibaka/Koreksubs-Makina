
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


  function update_gambar(){
    
    var poster_url_medium = $("#poster_url_medium").val();
    $("#poster_medium").attr("src", poster_url_medium);
    
    var poster_url_small = $("#poster_url_small").val();
    $("#poster_small").attr("src", poster_url_small);

  }

  function update_youtube(){
    
    var trailer = $("#trailer").val();
    $("#trailer_play").attr("href", trailer);

  }

    $(function () {
      // Summernote
      $('.textarea1').summernote({
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
      $('.textarea2').summernote({
          placeholder: 'Isi credits ...',
          tabsize: 2,
          height: 120,
          toolbar: [
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']]
          ]
        })
    })

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

    function successUpdateAnime() {
      swal.fire({
        title: "Perubahan berhasil disimpan",
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

  });
  
</script>


