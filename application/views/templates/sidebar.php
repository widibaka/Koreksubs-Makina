
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar <?= $theme['sidebar_color'] ?> elevation-3">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>" class="brand-link bg-<?= $theme['brand_color'] ?>" id="brand">
      <img src="<?php echo base_url(); ?>assets/dist/img/Logo.png?xa" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?= $fansub_preferences['fansub_name']; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background: bottom left no-repeat url('<?= $theme['sidebar_bg'] ?>'); background-size: contain;">
      <!-- Sidebar user panel (optional) -->
      <a href="<?php echo base_url('client/profile.asp') ?>">
      	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
      	  <div class="image">

      	      <div class="img-circle elevation-2" style="background: url('<?= base_url(); ?>assets/img/<?php 
      	            //Jika foto dengan nama user ada, maka tampilkan. Jika tidak, maka pakai no_photo.jpg 
      	            $semua_foto_profil = $this->Directory_model->directory_to_array('assets/img/');
      	              // var_dump($semua_foto_profil);
      	            if( in_array( 'assets/img/' . $this->session->userdata("user_id") . '.jpg', $semua_foto_profil ) ){
      	              echo strtolower($this->session->userdata("user_id"));
      	            } else {
      	              echo 'no_photo';
      	            }
      	            ?>.jpg?') center; width: 40px; height: 40px; background-size: cover;">
      	      </div>
      	  </div>
      	  <div class="info">
      	    <span class="d-block">
      	      <?php if( !empty($this->session->userdata('user_id')) ) {
      	        echo $this->session->userdata('username');
      	      }else{
      	        echo "Guest";
      	      } ?>
      	    <small class="text-secondary" style="padding: 0;"><br><?php 
      	      if ( !empty($this->session->userdata('admin')) AND !empty($this->session->userdata('user_id')) ) {
      	        echo "admin";
      	      }
      	      elseif ( !empty($this->session->userdata('admin_super')) AND !empty($this->session->userdata('user_id')) ) {
      	        echo "admin super";
      	      }
      	      elseif (!empty($this->session->userdata('user_id')) ) {
      	        echo "member";
      	      }
      	      else{
      	        echo "";
      	      }
      	    ?></small>
      	    </span>
      	  </div>
      	</div>
      </a>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url(); ?>client/home.asp" class="nav-link sidebar_null" id="home">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>client/series.asp" class="nav-link sidebar_null" id="series">
              <i class="nav-icon fa fa-th-large"></i>
              <p>
                Series
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>client/collection.asp" class="nav-link sidebar_null" id="collection">
              <i class="nav-icon fa fa-list"></i>
              <p>
                List A-Z
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>client/advanced_search.asp" class="nav-link sidebar_null" id="advanced_search">
              <i class="nav-icon fas fa-search-plus"></i>
              <p>
                Pencarian Lanjutan
              </p>
            </a>
          </li>
          <?php if ( !empty($this->session->userdata('username')) ): ?>
            <li class="nav-item">
              <a href="<?= base_url(); ?>client/message.asp" class="nav-link sidebar_null" id="message">
                <i class="nav-icon fas fa-envelope"></i>
                <p>
                  Pesan
                  <?php if ($this->User_model->getMessageUnreadYet() > 0): ?>
                    <span class="right badge badge-danger" id="message_notification"><?php echo $this->User_model->getMessageUnreadYet(); ?></span>
                  <?php endif ?>
                </p>
              </a>
            </li>
          <?php elseif ( empty($this->session->userdata('username')) ) : ?>
            <li class="nav-item">
              <a href="<?= base_url(); ?>user/login.asp" class="nav-link sidebar_null" id="message">
                <i class="nav-icon fas fa-envelope"></i>
                <p>
                  Pesan
                  <span class="right badge badge-danger" id="message_notification">1</span>
                </p>
              </a>
            </li>
          <?php endif ?>
          <?php 
          // Mencegah error, kalau ada @ tambahan di buntut
            $custom_menu_fix = array();
            $custom_menu = explode("@", $fansub_preferences['link_custom_menu']);
            foreach ($custom_menu as $key => $value) {
              if (!empty($value)) {
                array_push($custom_menu_fix, $value);
              }
            }
          ?>
          <?php if ( $fansub_preferences['status_custom_menu'] != "0" ): ?>            
            <li class="nav-item has-treeview">
              <a href="<?= base_url(); ?>client/settings.asp" class="nav-link sidebar_null">
                <i class="fa nav-icon fa-circle-notch"></i>
                <p>
                  <?= $fansub_preferences['custom_menu_name'] ?>
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <?php 
                $total = count($custom_menu_fix);
                $ganjil = $total % 2;
                ?>
                <?php if ($ganjil == 1) : ?>
                	<li class="nav-item">
                	  <a href="#" class="nav-link sidebar_null">
                	    <i class="far fa-circle nav-icon"></i>
                	    <p class="text-danger">(Terjadi Kesalahan)</p>
                	  </a>
                	</li>
                	<li class="nav-item">
                	  <a href="#" class="nav-link sidebar_null">
                	    <i class="far fa-circle nav-icon"></i>
                	    <p class="text-danger">(Cek Lagi Custom Menu)</p>
                	  </a>
                	</li>
                <?php else : ?>
                	<?php for ($i=0; $i < $total ; $i+=2): ?>
                	  <li class="nav-item">
                	    <a href="<?php echo $custom_menu[$i+1] ?>" class="nav-link sidebar_null">
                	      <i class="far fa-circle nav-icon"></i>
                	      <p><?php echo $custom_menu_fix[$i] ?></p>
                	    </a>
                	  </li>
                	<?php endfor; ?>
                <?php endif ?>
                
              </ul>
            </li>
          <?php endif; ?>

          <?php if( !empty($this->session->userdata('username')) ) :?>
          <li class="nav-item has-treeview" id="li_settings">
            <a href="<?= base_url(); ?>client/settings.asp" class="nav-link sidebar_null" id="settings">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(); ?>client/profile.asp" class="nav-link sidebar_null" id="profile">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>client/preferences.asp" class="nav-link sidebar_null" id="preferences">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Preferences</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>client/customization.asp" class="nav-link sidebar_null" id="customization">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customization</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('user/logout/'); ?>" class="nav-link" id="logout">
              <i class="nav-icon fa fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          <?php else : ?>
          <li class="nav-item">
            <a href="<?= base_url('user/login/'); ?>" class="nav-link" id="login">
              <i class="nav-icon fa fa-sign-in-alt"></i>
              <p>
                Login
              </p>
            </a>
          </li>
          <?php endif; ?>
          <?php if( !empty($this->session->userdata('admin')) or !empty($this->session->userdata('admin_super')) ) :?>
          <!-- Separator -->
          <li class="nav-header">Tools For Admin</li>

          <li class="nav-item">
            <a href="<?= base_url('admin/add_new_anime_series.asp'); ?>" class="nav-link sidebar_null" id="add_new_anime_series">
              <i class="nav-icon fa fa-plus"></i>
              <p>
                Add New Series
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/series_manager.asp'); ?>" class="nav-link sidebar_null" id="series_manager">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Series Manager
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/link_rusak.asp'); ?>" class="nav-link sidebar_null" id="link_rusak">
              <i class="nav-icon fas fa-link"></i>
              <p>
                Link Rusak
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/statistics.asp') ?>" class="nav-link sidebar_null"  id="statistics">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Statistics
              </p>
            </a>
          </li>

          <?php endif; ?>

          <?php if( !empty($this->session->userdata('admin_super')) ) :?>
          <!-- Separator -->
          <li class="nav-header text-danger text-bold">Tools For Admin Super</li>

          <li class="nav-item">
            <a href="<?= base_url('admin/website_preferences.asp'); ?>" class="nav-link sidebar_null" id="website_preferences">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Website Preferences
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('admin/custom_menu.asp'); ?>" class="nav-link sidebar_null" id="custom_menu">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Custom Menu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/admin_manager.asp'); ?>" class="nav-link sidebar_null" id="admin_manager">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Admin Manager
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/all_member.asp'); ?>" class="nav-link sidebar_null" id="all_member">
              <i class="nav-icon fas fa-users"></i>
              <p>
                All member
              </p>
            </a>
          </li>

          <?php endif; ?>
          <li class="nav-item mb-5">
            <!-- Just to bikin the item supaya tidak terlalu mepet to the bottom -->
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
