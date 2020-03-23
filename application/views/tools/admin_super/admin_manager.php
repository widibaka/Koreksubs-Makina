
        <div class="row">

          <?php if ( !empty($all_admin) ): ?>

            <?php foreach ($all_admin as $key => $value): ?>
              
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-<?= $theme['accent_color'] ?> card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <div class="img-circle img-bordered mr-auto ml-auto" style="background: url('<?= base_url(); ?>assets/img/<?php 
                          //Jika foto dengan nama user ada, maka tampilkan. Jika tidak, maka pakai no_photo.jpg 
                          $semua_foto_profil = $this->Directory_model->directory_to_array('assets/img/');
                            // var_dump($semua_foto_profil);
                          if( in_array( 'assets/img/' . $value['user_id'] . '.jpg', $semua_foto_profil ) ){
                            echo strtolower($value['user_id']);
                          } else {
                            echo 'no_photo';
                          }
                          ?>.jpg?<?php echo mt_rand(10,1000); //Kasih tanda tanya dan angka random, biar refresh terus setiap reload page, nggak di-cache oleh browser ?>') center; width: 180px; height: 180px; background-size: cover;">
                    </div>
                  </div>

                  <h3 class="profile-username text-center"><?php echo $value['username'] ?></h3>

                  <p class="text-muted text-center">Nomor ID: <?php echo $value['user_id'] ?></p>

                  <p class="text-muted text-center">Series Authoring: <?php 

                  echo $this->Admin_model->countAuthoring( $value['username'] );

                  ?></p>

                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <a href="<?php echo base_url('client/profile_publicly/'.$value['user_id'].'.asp') ?>" class="btn btn-secondary" style="width: 100%" >Lihat Profile</a>
                      <a href="<?php echo base_url('admin/admin_manager.asp?id='.$value['user_id']) ?>" class="btn btn-danger mt-1" style="width: 100%" >Hapus jabatan admin</a>
                    </li>
                  </ul>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            </div>

            <?php endforeach ?>
          <?php else: ?>
            <div class="container text-muted">
              <p>Anda tidak memiliki admin bawahan.</p>
            </div> 
          <?php endif ?>

        </div>