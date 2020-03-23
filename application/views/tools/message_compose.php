      
        <div class="row">
          <div class="col-md-3">
            <a href="<?php echo base_url('client/message.asp') ?>" class="btn btn-primary btn-block mb-3">Back to Inbox</a>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="<?php echo base_url('client/message.asp') ?>" class="nav-link">
                    <i class="fas fa-inbox"></i> Inbox
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('client/sent_message.asp') ?>" class="nav-link">
                    <i class="far fa-envelope"></i> Sent
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary card-outline">
             <form action="" method="post" id="form_message_compose">
              <div class="card-header">
                <h3 class="card-title">Buat Pesan Baru</h3>
              </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label>Kepada:</label>
                    <select class="form-control select2bs4" style="width: 100%;" name="input_to">
                      <?php foreach ($all_username as $key => $value): ?>
                        <!-- $reply_to is to refering the user our user want to reply we get from parameter -->
                      <option <?php if ($reply_to == $value['username']) {
                        echo "selected='selected'";
                      } ?>><?php echo $value['username']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <!-- /.form-group -->

                  <div class="form-group">
                      <textarea name="input_message" id="compose-textarea" class="form-control" style="height: 300px"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="float-right">
                    <button type="submit" class="btn btn-primary" id="kirim_button"><i class="far fa-envelope"></i> Kirim</button>
                  </div>
                </div>
              <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->