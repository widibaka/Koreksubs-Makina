
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="<?php echo base_url('client/message_compose.asp') ?>" class="btn btn-primary btn-block mb-3">Compose</a>

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
            <div class="card-header">
              <h3 class="card-title"><?php echo $page_title; ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <a type="button" href="<?php echo base_url('client/message/'); ?>" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></a>
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <div class="container">
                  
                  <table id="example1"  class="table table-bordered table-striped no-border">
                    <thead>
                    <tr>
                      <th><?php 

                        if ($page_title == 'Pesan Masuk') {
                          echo "Dari";
                        }else {
                          echo "Kepada";
                        }

                       ?></th>
                      <th>Pesan</th>
                      <th>Waktu</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($messages as $key => $value): ?>
                    <tr>
                      <td class="mailbox-name"><a title="Buka pesan ini" href="<?php echo base_url('client/message_detail/').$value['id']; ?>"><b><?php 

                        if ($page_title == 'Pesan Masuk') {
                          echo $value['from'];
                        }else {
                          echo $value['to'];
                        }

                       ?></b></a></td>
                      <td style="max-width: 180px" class="mailbox-subject"><?php echo htmlspecialchars_decode( substr($value['text'], 0, 50) ) ?><a title="Buka pesan ini" href="<?php echo base_url('client/message_detail/').$value['id']; ?>"> read more</a>
                      </td>
                      <td class="mailbox-date"><?php echo $this->Client_model->get_time_ago($value['timestamp']); ?></td>
                    </tr>
                    <?php endforeach ?>
                    </tbody>
                  </table>
                  <!-- /.table -->
                </div>
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls mt-4"><?php 

                        if ($page_title == 'Pesan Masuk') {
                          echo "<i>Jumlah maksimum pesan masuk adalah 100 tiap user untuk mencegah database penuh. Pesan lama akan otomatis terhapus</i>";
                        } ?>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->