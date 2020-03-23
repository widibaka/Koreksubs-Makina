<!-- Navbar -->
  <nav class="main-header navbar navbar-expand <?= $theme['navbar_skin'] ?> <?= $theme['navbar_varian'] ?>">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" id="top_navbar">Contact</a>
      </li> -->
    </ul>
    <!-- SEARCH FORM -->
    <form action="<?= base_url('client/search.asp') ?>" method="get" class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="contoh. re zero ..." aria-label="Search" value="<?= $this->input->get('nama_anime'); ?>" name="nama_anime">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" title="About" data-toggle="modal" data-target="#modal-about" href="#">
          <i class="fa fa-info"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" title="Recent comments" href="#">
          <i class="far fa-comments"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="javascript:void(0)" class="dropdown-item dropdown-footer">Recent comments</a>
          <div class="dropdown-divider"></div>
          <?php foreach ($five_recent_comments as $key => $value): ?>
            
            <?php if ( !empty($this->User_model->getUserDataById( $value['user_id'] )) ): ?>
              <a href="<?php echo base_url('client/anime/'.$value['anime_parent_id']) ?>" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <div class="img-size-50 mr-3 img-circle img-bordered-sm" style="background: url('<?= base_url(); ?>assets/img/<?php 
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
                  <div class="media-body">
                    <h3 class="dropdown-item-title text-<?php echo $theme['accent_color'] ?> ">
                      <?php 
                      $userdata_navbar = $this->User_model->getUserDataById( $value['user_id'] )[0];
                       $a = $userdata_navbar['username'];
                       if (strlen($a)>23) {
                         echo substr($a, 0,23).'...';
                       }
                       else{
                         echo $a;
                       } ?>
                    </h3>
                    <p class="text-sm"><?php 
                    $a =  $value['comment'] ;
                    if (strlen($a)>35) {
                      echo substr($a, 0,35).'...';
                    }
                    else{
                      echo $a; 
                    }
                    ?></p>
                    <p class="text-sm text-secondary">
                  <small><i class="far fa-clock mr-1"></i> <?php echo $this->Client_model->get_time_ago( $value['timestamp'] ) ?>, di <?php
                     $a = $this->Client_model->getAnimeNameById( $value['anime_parent_id'] );
                     if (strlen($a)>23) {
                       echo substr($a, 0,23).'...';
                     }
                     else{
                       echo $a;
                     }
                     ?></small></p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
            <?php endif ?>

          <?php endforeach ?>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
