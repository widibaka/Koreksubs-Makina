        

        <div class="row">
          <div class="col-md-6">
            <!-- DONUT CHART -->
            <div class="card card-<?php echo $theme['accent_color'] ?>">
              <div class="card-header">
                <h3 class="card-title">Preferensi</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form action="" method="post" name="form" id="form">
                  <?php if ( $userdata['subscription'] == 0 ): ?>
                    <p> Subscription / Pemberitahuan melalui email. <span class="text-danger text-bold">(Nonaktif)</span>
                    <input type="hidden" class="form-control" name="status" value="1" id="status">
                    <button class="float-right btn mt-2 bg-success btn btn-sm" type="submit" id="simpan">Aktifkan</button></p>
                  <?php else : ?>
                    <p> Subscription / Pemberitahuan melalui email. <span class="text-success text-bold">(Aktif)</span>
                    <input type="hidden" class="form-control" name="status" value="0" id="status">
                    <button class="float-right btn mt-2 bg-danger btn btn-sm" type="submit" id="simpan">Matikan</button></p>
                  <?php endif ?>
                  <br><i>(Fitur ini sedang dalam tahap pengembangan)</i>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->

