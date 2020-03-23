
<!-- Summernote -->
<script src="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/') ?>plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/') ?>dist/js/demo.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.all.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote({
        placeholder: 'Tulis pesan...',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['font', ['bold', 'underline', 'clear']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link']],
          ['view', ['fullscreen', 'help']]
        ]
    })
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>
<script type="text/javascript">
  $(document).ready(function(){

    $('#form_message_compose').on('submit',function(e) {
      e.preventDefault();
      // Disable button to avoid double submit
      $("#kirim_button").text('Wait...');
      $("#kirim_button").attr("disabled", "disabled");
      $("#kirim_button").addClass("disabled");
      $("#kirim_button").removeClass("btn-primary");
      $("#kirim_button").addClass("btn-secondary");
      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function() {
          successKirim();
          // Turn it back when success
          $("#kirim_button").text('Kirim');
          $("#kirim_button").removeAttr("disabled");
          $("#kirim_button").removeClass("disabled");
          $("#kirim_button").addClass("btn-primary");
          $("#kirim_button").removeClass("btn-secondary");
        }
      })
    })
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
    function successKirim() {
      Toast.fire({
        type: 'success',
        title: 'Pesan berhasil dikirim.'
      })
    }
  })
</script>