
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/toastr/toastr.min.css">
<script type="text/javascript">
	
  //Trying to pass php array to json  //
  <?php 
    $json = json_encode($episodes, JSON_PRETTY_PRINT);
  ?>
  var episodes = <?= $json ?>;
</script>