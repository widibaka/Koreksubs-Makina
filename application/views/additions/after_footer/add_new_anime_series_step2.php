
<!-- When page is add_new_anime_series_step2 -->

<!-- Summernote -->
<script src="<?= base_url('assets/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- fancybox -->
<script src="<?= base_url('assets/'); ?>plugins/fancybox/jquery.fancybox.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2@9.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>

<!-- Text Editor -->
<script>
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
</script>

<!-- form_add_new_anime script -->
<script>
      $('#form_add_new_anime').on('submit',function(e) {
        e.preventDefault();
        $("#save_button").addClass("disabled");
        $("#save_button").html("Wait ...");
        $("#save_button").attr("disabled", "disabled");
        $.ajax({
          type: $(this).attr('method'),
          url: $(this).attr('action'),
          data: $(this).serialize(),
          success: function() {
            successAddAnimeAlert();
          }
        }
        );
      })
    function successAddAnimeAlert() {
      swal.fire({
        title: "Series berhasil ditambahkan!",
        icon: "success",
        showCancelButton: false,
        confirmButtonText: "OK!",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          location.href="<?= base_url('admin/series_manager') ?>";
        }
      })
    }
</script>