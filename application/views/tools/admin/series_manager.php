


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
                  <th>#ID</th>
                  <th>Title</th>
                  <th>Rating</th>
                  <th>Musim</th>
                  <th>Download Count</th>
                  <th>Total Episode</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($anime as $key => $value) :?>
                <tr><?php 

                $link_series_manager_detail = base_url('admin/series_manager_detail/' . $anime[$key]['anime_parent_id']); 
                $link_episode_manager = base_url('admin/episode_manager/' . $anime[$key]['anime_parent_id']); 

                ?>
                  <td>
                    <?= $anime[$key]['anime_parent_id']; ?>
                  </td>
                  <td>
                    <?= $anime[$key]['title']; ?>
                  </td>
                  <td>
                    <?= $anime[$key]['rating']; ?>%
                  </td>
                  <td>
                    <?= $anime[$key]['season']; ?> <?= $anime[$key]['year']; ?>
                  </td>
                  <td>
                    <?= $anime[$key]['download_count']; ?>
                  </td>
                  <td>
                    <?php
                    if (!empty($anime[$key]['full_episode'])) {
                       echo $anime[$key]['full_episode'];
                     } else {
                       echo "(Na)";
                     }
                    ?>
                  </td>
                  <td>
                    <a class="btn btn-sm btn-primary" href="<?php echo $link_series_manager_detail ?>">Edit series</a><br>
                    <a class="btn btn-sm btn-success mt-2" href="<?php echo $link_episode_manager ?>">Edit episodes</a>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>#ID</th>
                  <th>Title</th>
                  <th>Rating</th>
                  <th>Musim</th>
                  <th>Download Count</th>
                  <th>Total Episode</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
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



