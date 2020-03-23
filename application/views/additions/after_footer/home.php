
<!-- Jika berada di halaman "latest_update", maka script di-print
# If in the page "latest_update", then script will be printed -->

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