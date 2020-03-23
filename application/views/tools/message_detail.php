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
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Membaca Pesan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h6>From: <?php echo $message['from'] ?>
                  <span class="mailbox-read-time float-right"><?php echo $this->Client_model->convertTimeFormat($message['timestamp']); ?></span></h6>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-read-message">
                <?php echo htmlspecialchars_decode($message['text']) ?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="float-right">
                <?php if ( $this->session->userdata('username') != $message['from'] ): ?>
                  <a href="<?php echo base_url('client/message_compose.asp?reply_to=') ?><?php echo $message['from'] ?>" type="button" class="btn btn-default"><i class="fas fa-reply"></i> Balas</a>
                <?php endif ?>
              </div>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
      </div>