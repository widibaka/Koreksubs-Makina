
<?php if (empty($all_member)) :?>
<div class="row">
  <div class="col-12 text-center">
      <i><p class="text-muted"><i class="fa fa-times-circle"></i> 404 Data tidak ditemukan.</p></i>
  </div>
</div>

<?php endif; ?>


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
                  <th>username</th>
                  <th>email</th>
                  <th>action1</th>
                  <th>action2</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($all_member as $key => $value) :?>
                <tr><?php 

                // $link_series_manager_detail = base_url('admin/series_manager_detail/' . $value['anime_parent_id']); 
                // $link_episode_manager = base_url('admin/episode_manager/' . $value['anime_parent_id']); 

                ?>
                  <td>
                    <?= $value['username']; ?>
                  </td>
                  <td>
                    <?= $value['email']; ?>
                  </td>
                  <td>
                    <a href="<?php echo base_url('client/profile_publicly/'.$value['user_id'].'.asp') ?>" class="btn btn-sm btn-secondary" style="width: 100%" >Lihat Profile</a>
                  </td>
                  <td>
                    <a href="<?php echo base_url('admin/all_member.asp?id='.$value['user_id']) ?>" class="btn btn-sm btn-danger" style="width: 100%" >Jadikan admin</a>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>username</th>
                  <th>email</th>
                  <th>action1</th>
                  <th>action2</th>
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




