
<script type="text/javascript">
  $('#konfirmasi_hapus_akun').hide()
  $(document).ready(function(){
      $('#hapus_akun').on('click',function(){
        $('#konfirmasi_hapus_akun').show('slow')
      })
      $('#tidak_jadi_hapus').on('click',function(){
        $('#konfirmasi_hapus_akun').hide('slow')
      })

  })
</script>