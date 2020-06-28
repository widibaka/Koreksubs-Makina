<?php if (  !empty($this->session->userdata('admin')) or !empty($this->session->userdata('admin_super'))  ): ?>
  
  <div class="row">
    
    <a style="text-transform: none;" href="<?= base_url('admin/series_manager_detail/') ?><?= $anime['anime_parent_id']; ?>" class="btn btn-sm btn-secondary mb-2 ml-2"> Edit Series Ini
    </a>
    <a style="text-transform: none;" href="<?= base_url('admin/episode_manager/') ?><?= $anime['anime_parent_id']; ?>" class="btn btn-sm btn-secondary mb-2 ml-2"> Edit Episode Series Ini
    </a>

  </div>
  
<?php endif ?>



<?php 
    switch ($anime['rating']) {
      case $anime['rating'] >75:
        $rating_color = "success";
        break;
      case $anime['rating'] >65:
        $rating_color =  "secondary";
        break;
      
      default:
        $rating_color =  "danger";
        break;
    }
?>


      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-lg-1">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <a class="info-box btn btn-default bg-gradient-dark callout callout-danger <?php if($anime['trailer']=='https://youtube.com/watch?v='){ echo "disabled";} ?>" data-fancybox href="<?= $anime['trailer']; ?>&amp;autoplay=0&amp;rel=0&amp;controls=1&amp;showinfo=1">
                    <div class="info-box-content">
                      <h4 class="info-box-text text-center text-bold mb-0" style="font-size: 22px; color: #fff; padding-top: 8px;"><i class="fa fa-play"></i></h4>
                      <span class="info-box-text text-center mb-0 mt-0" style="font-size: 14px; color: #ddd;"><i>Play Trailer</i></span>
                    </div>
                  </a>
                </div>
                <div class="col-12 col-sm-4">
                  <a class="info-box btn btn-default bg-gradient-success" href="#go_to_download" id="go_to_download_button">
                    <div class="info-box-content">
                      <h4 class="info-box-text text-center text-bold mb-0" style="font-size: 22px; color: #fff; padding-top: 8px;"><i class="fa fa-download"></i> Download</h4>
                      <span class="info-box-text text-center mb-0 mt-0" style="font-size: 14px; color: #ddd;"><i><?= $anime['download_count'] ?>x diunduh</i></span>
                    </div>
                  </a>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box callout callout-info">
                    <div class="info-box-content" style="color: #fff; ">
                      <span class="info-box-text text-center text-muted">Dilihat</span>
                      <span class="info-box-number text-center text-muted mb-0"><?= $anime['view_count'] ?>x<span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                    <div class="post">
                      <!-- Sinopsis -->
                      <p>
                        <strong>Sinopsis</strong> <br>
                        <?= $anime['sinopsis']; ?>
                      </p>
                    </div>
                  <h4>Bagaimana pendapatmu tentang konten ini?</h4>
                          <?php if (empty($this->session->userdata("user_id"))): ?>
                            <div class="user-block mb-2 mt-2">
                              <div class="img-circle img-bordered-sm " style="background: url('<?= base_url(); ?>assets/img/no_photo.jpg') center; width: 40px; height: 40px; background-size: cover; margin-bottom: -40px">
                              </div>
                              <span class="username">User</span>
                              <span class="description ">Login untuk berkomentar</span>
                            <!-- /.user-block -->
                            </div>
                            <form action="" method="post" id="form_comment">
                              <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id') ?>">
                              <input type="hidden" name="anime_parent_id" value="<?php echo $anime['anime_parent_id'] ?>" required>
                              <textarea class="col-12 form-control" name="comment" placeholder="Tulis komentar..." id="comment"></textarea>
                              <a href="<?php echo base_url('user/login') ?>" class="btn btn-sm pr-3 pl-3 bg-<?php echo $theme['accent_color'] ?> mt-1 mb-1 float-right" id="post_button">Login first</a>
                            </form>
                            
                          <?php else : ?>
                            <div class="user-block mt-2 mb-4">
                              <div class="img-circle img-bordered-sm " style="background: url('<?= base_url(); ?>assets/img/<?php 
                                    //Jika foto dengan nama user ada, maka tampilkan. Jika tidak, maka pakai no_photo.jpg 
                                    $semua_foto_profil = $this->Directory_model->directory_to_array('assets/img/');
                                      // var_dump($semua_foto_profil);
                                    if( in_array( 'assets/img/' . $this->session->userdata("user_id") . '.jpg', $semua_foto_profil ) ){
                                      echo strtolower($this->session->userdata("user_id"));
                                    } else {
                                      echo 'no_photo';
                                    }
                                    ?>.jpg?') center; width: 40px; height: 40px; background-size: cover; margin-bottom: -40px">
                              </div>
                              <span class="username">                          <a ><?php 

                                $user_detail = $this->User_model->getUserDataById( $this->session->userdata("user_id") )[0]; // oiya, harus ada index 0 nya. haduuuh...
                                echo $user_detail['username'];
                                if ($user_detail['admin'] == 1) {
                                  echo ' <span class="right badge badge-danger" id="message_notification">admin</span>';
                                }
                                elseif ( $user_detail['admin'] == 2) {
                                  echo ' <span class="right badge badge-danger" id="message_notification">adminnya admin</span>';
                                }
                                ?></a>
                              </span>
                            <!-- /.user-block -->
                            </div>
                            <form action="" method="post" id="form_comment">
                              <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id') ?>">
                              <input type="hidden" name="anime_parent_id" value="<?php echo $anime['anime_parent_id'] ?>" required>
                              <textarea class="col-12 form-control" name="comment" placeholder="Tulis komentar..." id="comment"></textarea>
                              <button type='submit' class="btn btn-sm pr-3 pl-3 bg-<?php echo $theme['accent_color'] ?> mt-1 float-right" id="post_button">Post</button>
                            </form>
                          <?php endif ?>
                  <hr class="mt-5">

                    <?php if (is_string($comments)): ?>




                      <table id="example1" class="table table-striped no-border">
                        <thead>
                        <tr>
                          <th></th>
                        </tr>
                        </thead>
                        <tbody class="no-border" id="kolom_komentar">
                          <tr>
                            <td><span class="text-muted"><?php echo $comments ?></span></td>
                          </tr>
                        </tbody>
                      </table>
                    <?php else: ?>
                      <table id="example1" class="table table-striped no-border">
                        <thead>
                        <tr>
                          <th></th>
                        </tr>
                        </thead>
                        <tbody class="no-border" id="kolom_komentar">




                        <?php foreach ($comments as $key => $value): ?>
                        <tr id="comment-<?php echo $value['id'] ?>">
                         <td>
                          <div class="post clearfix">
                            <div class="user-block">
                              <div class="img-circle img-bordered-sm " style="background: url('<?= base_url(); ?>assets/img/<?php 
                                    //Jika foto dengan nama user ada, maka tampilkan. Jika tidak, maka pakai no_photo.jpg 
                                    $semua_foto_profil = $this->Directory_model->directory_to_array('assets/img/');
                                      // var_dump($semua_foto_profil);
                                    if( in_array( 'assets/img/' . $value['user_id'] . '.jpg', $semua_foto_profil ) ){
                                      echo strtolower($value['user_id']);
                                    } else {
                                      echo 'no_photo';
                                    }
                                    ?>.jpg?') center; width: 40px; height: 40px; background-size: cover; margin-bottom: -40px">
                              </div>

                              <span class="username">
                                <a><?php 

                                $try = $this->User_model->getUserDataById( $value['user_id'] );

                                if ( !empty($try) ) {

                                  $user_detail = $this->User_model->getUserDataById( $value['user_id'] )[0]; // oiya, harus ada index 0 nya. haduuuh...
                                  echo $user_detail['username'];
                                  if ($user_detail['admin'] == 1) {
                                    echo ' <span class="right badge badge-danger" id="message_notification">admin</span>';
                                  }
                                  elseif ( $user_detail['admin'] == 2) {
                                    echo ' <span class="right badge badge-danger" id="message_notification">adminnya admin </span>';

                                  }
                                }else{
                                  echo "<i>Akun ini telah dihapus</i>";
                                }


                                ?>
                                <!-- Show the dropdown Only if the user exists  -->
                                <?php if ( $this->session->userdata('user_id') != $value['user_id'] ): ?>
                                  <?php if ( !empty($try) ): ?>
                                    <!-- Dropdown btn -->
                                      <div class="btn-group" style="margin-left: -16px">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                        </a>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('client/profile_publicly/'.$value['user_id'].'.asp') ?>">Lihat profil orang ini</a>
                                          <a class="dropdown-item" tabindex="-1" href="<?php echo base_url('client/message_compose.asp?reply_to='.$user_detail['username']) ?>">Kirim pesan ke orang ini</a>
                                        </div>
                                      </div>
                                    <!-- /.Dropdown btn -->
                                  <?php endif ?>
                                <?php endif ?>
                                <!--/. Show the dropdown Only if the user exists  -->
                                </a>
                              </span>
                              <span class="description">
                          <?php 
                              $this->load->model('Client_model');
                              echo $this->Client_model->get_time_ago($value['timestamp']);
                           ?></span>
                            </div>
                            <!-- /.user-block -->
                            <p id="content-value-<?php echo $value['id'] ?>"><?php 

                            if ( !empty($value['comment']) ) {
                              echo $value['comment'] ;
                            }else{
                              echo '<h5><span class="badge badge-secondary"><i>-- Komentar ini telah dihapus --</i></span></h5>';
                            }
                            

                            ?></p>
                            <?php if ( !empty($value['comment']) ): ?>
                              <?php if ( $value['user_id'] == $this->session->userdata('user_id') ): ?>
                                <p>
                                  <form action="" method="get" id="form_delete_comment-<?php echo $value['id'] ?>">
                                    <input type="hidden"  name="delete_comment" value="<?php echo $value['id'] ?>">
                                    <button type="submit" class="btn badge bg-secondary link-white text-sm float-right" id="delete_comment_button-<?php echo $value['id'] ?>"><i class="fas fa-trash mr-1"></i> Delete</button>
                                  </form>
                                </p>
                              <?php endif ?>
                            <?php endif ?>
                          </div>
                         </td>
                        </tr>
                        <?php endforeach ?>



                          
                        </tbody>
                      </table>





                    <?php endif ?>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-lg-2">
              <div class="row">
                  <div class="col-12">
                    <div class="bg-light">
                      <div class="ribbon-wrapper ribbon-xl">
                        <div class='ribbon bg-<?= $rating_color; ?> text-lg'>
                          <i class="fas fa-star"></i> <?= $anime['rating']; ?>% rated
                        </div>
                      </div>
                      <img src="<?= str_replace("medium.jpg", "large.jpg", $anime['poster_url_medium']) ; ?>" class="img-fluid  mx-auto d-block" alt="Responsive image">
                    </div>
                  </div>

              </div>
              <?php if ( !empty($anime['full_episode']) ): ?>
                
                <div class="progress">
                    <?php 
                        if (!empty($anime['full_episode'])) {
                          $progress_width = round($anime['progress'] / $anime['full_episode'] * 100);
                          $progress_width_percent = $progress_width . '%';
                          $progress = $anime['progress'];
                          $full_episode = $anime['full_episode'];
                        }else{
                          $progress_width_percent = '0%';
                          $full_episode = '(Na)';
                        }
                    
                    ?>
                  <div class="progress-bar" role="progressbar" style="width: <?= $progress_width_percent; ?>;" aria-valuenow="<?= $progress_width_percent; ?>" aria-valuemin="0" aria-valuemax="100"><?= $progress_width_percent; ?>
                  </div>
                </div>
                    <p>
                      <?php echo $progress .'/'. $full_episode; ?> Episode
                    </p>

              <?php endif ?>
              <br>

              <div class="text-muted text-sm">
                <p class="text-sm"><b>Categories
                  </b><span class="d-block"><?= $anime['categories']; ?></span>
                </p>
                <p class="text-sm"><b>Musim
                  </b><span class="d-block"><?= $anime['season']; ?> <?= $anime['year']; ?></span>
                </p>
                <p class="text-sm"><b>Credits
                  </b><span class="d-block"><?= $anime['credits']; ?></span>
                </p>
                <p class="text-sm"><b>Keterangan
                  </b><span class="d-block"><?= $anime['ket']; ?></span>
                </p>
                <p class="text-sm"><b>Info
                  </b><span class="d-block"><a href="<?= $anime['kitsu_info']; ?>"><?= $anime['kitsu_info']; ?></a></span>
                </p>
                <p class="text-sm"><b>Author
                  </b><span class="d-block"><?= $anime['author']; ?></span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->