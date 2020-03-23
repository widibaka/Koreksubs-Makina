
<?php if (empty($episodes)) :?>
<div class="row">
  <div class="col-12 text-center">
      <i><p class="text-muted"><i class="fa fa-thumbs-up"></i></i> Aman, tidak ada laporan link rusak.</p></i>
  </div>
</div>

<?php else : ?>


  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" id="link_download">Select one serie to edit</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body text-sm">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama File</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($episodes as $key => $value) :?>
                <tr><?php 

                $link_episode_manager = base_url('admin/episode_manager/' . $value['anime_parent_id']); 

                ?>
                  <td>
                    <?= $value['file_name']; ?>
                  </td>
                  <td>
                    <a class="btn btn-sm btn-success" href="<?php echo $link_episode_manager ?>">Edit episodes</a>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


<?php endif; ?>