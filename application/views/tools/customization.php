
<div class="row">
  <div class="col-12">
        <!-- SEPARATOR -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Themes</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="col-12">
                <div class="row btn-group btn-group-toggle" data-toggle="buttons">
                  <?php foreach ($themes_collection as $key => $this_theme): ?>
                    <!-- Theme -->
                    <label class="btn btn-light info-box border <?php if($theme['theme'] == $this_theme['name']){echo 'active';} ?>" style="width: 150px; max-width: 150px; height: 150px;" id="<?php echo $this_theme['name'] ?>">
                      <input type="radio"> 
                      <div class="info-box-content" style="background: top center url('<?= base_url("assets/img/theme/" . $this_theme['image']); ?>'); background-size: cover;">
                        <span class="info-box-text text-center badge bg-<?php echo $this_theme['brand_color'] ?>" style="margin-top: 100px; opacity: 0.7" id="theme_name"><?php echo str_replace('_', ' ', $this_theme['name']) ?></span>
                      </div>
                    </label>
                  <?php endforeach ?>
                </div>
                <p>All illustrations were created by <a href="https://www.pixiv.net/en/artworks/67269335">Lpip</a>, <a href="https://zerochan.net">zerochan.net</a> and many more weeb people.</p>
               <form action="" method="post">
                 <input type="hidden" class="form-control" name="input_theme_name" value="<?= $theme['theme'] ?>" id="input_theme_name">
                 <input type="hidden" class="form-control" name="input_theme_image" value="<?= $theme['sidebar_bg'] ?>" id="input_theme_image">
                 <input type="hidden" class="form-control" name="input_theme_navbar_skin" value="<?= $theme['navbar_skin'] ?>" id="input_theme_navbar_skin">
                 <input type="hidden" class="form-control" name="input_theme_navbar_varian" value="<?= $theme['navbar_varian'] ?>" id="input_theme_navbar_varian">
                 <input type="hidden" class="form-control" name="input_theme_brand_color" value="<?= $theme['brand_color'] ?>" id="input_theme_brand_color">
                 <input type="hidden" class="form-control" name="input_theme_sidebar_color" value="<?= $theme['sidebar_color'] ?>" id="input_theme_sidebar_color">
                 <input type="hidden" class="form-control" name="input_theme_accent_color" value="<?= $theme['accent_color'] ?>" id="input_theme_accent_color">
                 <button type="submit" name="apply_theme" class="btn mt-2 bg-<?= $theme['accent_color'] ?>" value="yes">Apply Theme</button>
                 <?php if (!empty($this->session->userdata('admin_super'))): ?>
                 <button type="submit" name="save_theme" class="btn mt-2 bg-<?= $theme['accent_color'] ?>" value="yes">Save Current State to Theme</button>                   
                 <?php endif ?>
               </form>
              </div>
              <!-- /.col -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
  </div>
  <div class="col-xl-6">
        <!-- SEPARATOR -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Navbar Color</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">


                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                <?php foreach ($navbar_colors['light'] as $key => $value): ?>
                  <?php if ( ($key+1) % 6 == 0 ): //I tried to makeit like ... each line contains max 8 colors ?>
                </div>
                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                  <?php endif ?>
                  <label class="btn btn-sm bg-<?php echo str_replace('navbar-', '', $value); ?>" id="<?php echo $value; ?>">
                    <input type="radio"> <?php echo strtoupper( str_replace('navbar-', '', $value) ); ?>
                  </label>
                <?php endforeach ?>
                </div>


                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                <?php foreach ($navbar_colors['dark'] as $key => $value): ?>
                  <?php if ( ($key+1) % 6 == 0 ): //I tried to makeit like ... each line contains max 8 colors ?>
                </div>
                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                  <?php endif ?>
                  <label class="btn btn-sm bg-<?php echo str_replace('navbar-', '', $value); ?>" id="<?php echo $value; ?>">
                    <input type="radio"> <?php echo strtoupper( str_replace('navbar-', '', $value) ); ?>
                  </label>
                <?php endforeach ?>
                </div>

                <form action="" method="post" name="form_navbar_color" id="form_navbar_color">
                  <input type="hidden" class="form-control" name="input_navbar_skin" value="<?php echo $theme['navbar_skin'] ?>" id="input_navbar_skin">
                  <input type="hidden" class="form-control" name="input_navbar_varian" value="<?php echo $theme['navbar_varian'] ?>" id="input_navbar_varian">
                  <button class="float-right btn mt-2 bg-<?php echo $theme['accent_color'] ?>" type="submit" id="simpan_navbar">Simpan</button>
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
  </div>
  <div class="col-xl-6">
        <!-- SEPARATOR -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Brand Color</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                <?php foreach ($brand_colors as $key => $value): ?>
                  <?php if ( ($key+1) % 6 == 0 ): //I tried to makeit like ... each line contains max 8 colors ?>
                </div>
                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                  <?php endif ?>
                  <label class="btn btn-sm bg-<?php echo $value; ?>" id="<?php echo $value; ?>">
                    <input type="radio"> <?php echo strtoupper($value); ?>
                  </label>
                <?php endforeach ?>
                </div>

                <form action="" method="post" name="form_navbar_color" id="form_brand_color">
                  <input type="hidden" class="form-control" name="input_brand_color" value="<?php echo $theme['brand_color'] ?>" id="input_brand_color">
                  <button class="float-right btn mt-2 bg-<?php echo $theme['accent_color'] ?>" type="submit" id="simpan_brand">Simpan</button>
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
  </div>
  <div class="col-xl-6">
        <!-- SEPARATOR -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Sidebar Color</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <p>Dark/light adalah warna background-nya, dan warna berikutnya adalah warna menu yang aktif.</p>
                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                <?php foreach ($sidebar_colors as $key => $value): ?>
                  <?php 
                    // I try to remove "sidebar-" prefix
                    $value0 = str_replace( '-', ' ', str_replace('sidebar-', '', $value) );
                    // I try to remove "sidebar-light" and "sidebar-dark" to make buttons colorful
                    $value1 = str_replace('sidebar-dark-', '', $value);
                    $value2 = str_replace('sidebar-light-', '', $value1);
                    // echo "<script>alert('".$value2."' )</script>";
                  ?>
                  <?php if ( ($key+1) % 6 == 0 ): //I tried to makeit like ... each line contains max 8 colors ?>
                </div>
                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                  <?php endif ?>
                  <label class="btn btn-sm bg-<?php echo $value2; ?>" id="<?php echo $value; ?>">
                    <input type="radio"> <?php echo strtoupper($value0); ?>
                  </label>
                <?php endforeach ?>
                </div>

                <form action="" method="post" name="form_sidebar_color" id="form_sidebar_color">
                  <input type="hidden" class="form-control" name="input_sidebar_color" value="<?php echo $theme['sidebar_color'] ?>" id="input_sidebar_color">
                  <button class="float-right btn mt-2 bg-<?php echo $theme['accent_color'] ?>" type="submit" id="simpan_sidebar">Simpan</button>
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
  </div>
  <div class="col-xl-6">
        <!-- SEPARATOR -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Accent Color</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <p>Warna aksen. Mencakup warna button dan lain-lain.</p>
                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                <?php foreach ($accent_colors as $key => $value): ?>
                  <?php if ( ($key+1) % 6 == 0 ): //I tried to makeit like ... each line contains max 8 colors ?>
                </div>
                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                  <?php endif ?>
                  <label class="btn btn-sm bg-<?php echo $value; ?>" id="accent_<?php echo $value; ?>">
                    <input type="radio"> <?php echo strtoupper($value); ?>
                  </label>
                <?php endforeach ?>
                </div>

                <form action="" method="post" name="form_accent_color" id="form_accent_color">
                  <input type="hidden" class="form-control" name="input_accent_color" value="<?php echo $theme['accent_color'] ?>" id="input_accent_color">
                  <button class="float-right btn mt-2 bg-<?php echo $theme['accent_color'] ?>" type="submit" id="simpan_accent">Simpan</button>
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
  </div>
  <div class="col-xl-6">
        <!-- SEPARATOR -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Sidebar background</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <p>Anda dapat menggunakan gambar dari situs lain dengan memasukkan link-nya.</p>

                <form action="" method="post" name="form_image" id="form_image">
                  <input type="text" class="form-control" name="input_image" value="<?php echo $theme['sidebar_bg'] ?>" id="input_image">
                  <button class="float-right btn mt-2 bg-<?php echo $theme['accent_color'] ?>" type="submit" id="simpan_image">Simpan</button>
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
  </div>
</div>