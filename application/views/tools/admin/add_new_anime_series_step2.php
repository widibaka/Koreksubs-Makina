
<form action="" method="post" id="form_add_new_anime">
  
      <!-- ./row -->
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><?= $page_title; ?></h3>

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
                  <?php 
                  // kalau ada trailer-nya, print domain youtube sama settings buat fancybox-mya, kalo gak ada print kosong aja
                  if ( !empty($kitsu_anime['attributes']['youtubeVideoId']) ) {
                    $link_youtube = "https://youtube.com/watch?v=" . $kitsu_anime['attributes']['youtubeVideoId'];
                  }else {
                    $link_youtube = "";
                  }
                      
                   ?>
                  <a class="info-box btn btn-default bg-gradient-dark callout callout-danger" data-fancybox href="<?= $link_youtube . '&amp;autoplay=0&amp;rel=0&amp;controls=0&amp;showinfo=0'; ?>" id="trailer_play">
                    <div class="info-box-content">
                      <h4 class="info-box-text text-center text-bold mb-0" style="font-size: 22px; color: #fff; padding-top: 8px;"><i class="fa fa-play"></i></h4>
                      <span class="info-box-text text-center mb-0 mt-0" style="font-size: 14px; color: #ddd;"><i>Play Trailer</i></span>
                    </div>
                  </a>
                    <p class="text-muted text-sm">Trailer url
                      <input type="hidden" name="rating" value="<?= $kitsu_anime['attributes']["averageRating"]; ?>">
                      <input type="hidden" name="author" value="<?php
                        if (!empty($this->session->userdata('username'))) {
                           echo $this->session->userdata('username');
                         } 
                        ?>">
                      <input type="text" name="trailer" value="<?= $link_youtube; ?>" class="form-control form-control-sm is-warning bg-dark bg-dark" placeholder="Tempatkan link youtube..." id="trailer" onchange="update_youtube()">
                    </p>
                </div>
                <div class="col-12 col-sm-4">
                  <a class="info-box btn btn-default bg-gradient-success disabled" href="#link_download">
                    <div class="info-box-content">
                      <h4 class="info-box-text text-center text-bold mb-0" style="font-size: 22px; color: #fff; padding-top: 8px;"><i class="fa fa-download"></i> Download</h4>
                      <span class="info-box-text text-center mb-0 mt-0" style="font-size: 14px; color: #ddd;"><i>2300 kali</i></span>
                    </div>
                  </a>
                    <p class="text-muted text-sm">Judul
                      <input type="text" name="title" value="<?php
                        if (!empty($kitsu_anime['attributes']['titles']['en_jp'])) {
                           echo $kitsu_anime['attributes']['titles']['en_jp'];
                         } 
                        ?><?php
                        if (!empty($kitsu_anime['attributes']['titles']['en'])) {
                           echo ' (' . $kitsu_anime['attributes']['titles']['en'] . ')';
                         } 
                        ?>" class="form-control form-control-sm is-warning bg-dark bg-dark" placeholder="Judul..." required="required">
                    </p>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box callout callout-info">
                    <div class="info-box-content" style="color: #fff; ">
                      <span class="info-box-text text-center text-muted">Dibagikan</span>
                      <span class="info-box-number text-center text-muted mb-0">20 x<span>
                    </div>
                  </div>
                    <p class="text-muted text-sm">Total Episode (Kosongkan jika tdk ada episode)
                      <?php if ( $kitsu_anime['attributes']["episodeCount"] == -100 ): // -100 adalah kode kalo ini dari anime_kosong.json ?>
                      <input type="text" name="full_episode" class="form-control form-control-sm is-warning bg-dark bg-dark" value="" placeholder="Total Episode..."  required="required">
                      <?php else: ?>
                      <input type="number" name="full_episode" class="form-control form-control-sm is-warning bg-dark bg-dark" value="<?= $kitsu_anime['attributes']["episodeCount"]; ?>" placeholder="Total Episode..."  required="required">                 
                      <?php endif ?>
                      
                    </p>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                    <div class="post">
                      <!-- Sinopsis -->
                      <div class="mb-3">
                        <strong>Sinopsis</strong> <br>
                        <p>English:
                        <textarea disabled style="width: 100%; height: 140px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $kitsu_anime["attributes"]["synopsis"]; ?></textarea>
                        </p>

                        <p>Indonesia:<br>
                        <small><i>Silakan terjemahkan dari atas itu, atau copas aja langsung.</i></small>
                        <textarea class="textarea1" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="sinopsis"></textarea>
                        </p>
                      </div>
                        
                    </div>
                  <h4>[Kolom komentar akan ada di sini]</h4>
                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?= base_url() ?>assets/img/no_photo.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Kyokou</a>
                        </span>
                        <span class="description">Waktu</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Komentar
                      </p>
                    </div>

                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?= base_url() ?>assets/img/no_photo.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Kyokou</a>
                        </span>
                        <span class="description">Waktu</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Komentar
                      </p>
                    </div>

                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-lg-2">
              <p class="text-muted text-sm">Poster small
                <input type="text" name="poster_url_small" value="<?= $kitsu_anime['attributes']["posterImage"]['small']; ?>" class="form-control form-control-sm is-warning bg-dark"  placeholder="..." id="poster_url_small" onchange="update_gambar()"  required="required">
              </p>
              <div class="row">
                  <div class="col-12">
                    <div class="bg-light">
                      <img style="width: 150px;" src="<?= $kitsu_anime['attributes']["posterImage"]['small']; ?>" class="img-fluid  mx-auto d-block" alt="Masukkan URI Gambar yang Valid" id="poster_small">
                    </div>
                  </div>
              </div>
              <p class="text-muted text-sm">Poster medium
                <input type="text" name="poster_url_medium" value="<?= $kitsu_anime['attributes']["posterImage"]['medium']; ?>" class="form-control form-control-sm is-warning bg-dark" placeholder="..." id="poster_url_medium" onchange="update_gambar()"  required="required">
              </p>
              <div class="row">
                  <div class="col-12">
                    <div class="bg-light">
                      <div class="ribbon-wrapper ribbon-xl">
                        <div class="ribbon bg-danger text-lg">
                          <i class="fas fa-star"></i> <?= $kitsu_anime['attributes']['averageRating']; ?> rated
                        </div>
                      </div>
                      <img src="<?= $kitsu_anime['attributes']["posterImage"]['medium']; ?>" class="img-fluid  mx-auto d-block" alt="Masukkan URI Gambar yang Valid" id="poster_medium">
                    </div>
                  </div>
              </div>
              <br>
              <div class="text-muted">
                <p class="text-sm">Categories
                  <input type="text" name="categories" value="<?php
                      if(!empty($kitsu_categories)){
                        //Echo semua categories
                        foreach ($kitsu_categories["data"] as $key_cat => $value) {
                          echo $value["attributes"]["title"].", ";
                        }
                      }
                   ?>" class="form-control form-control-sm is-warning bg-dark" placeholder="...">
                </p>
                <p class="text-sm">Musim
                  <input type="text" name="season" value="<?= $season; ?>" class="form-control form-control-sm is-warning bg-dark" placeholder="...">
                </p>
                <p class="text-sm">Tahun
                  <input type="text" name="year" value="<?= $year; ?>" class="form-control form-control-sm is-warning bg-dark" placeholder="...">
                </p>
                <p class="text-sm">Credits
                  <textarea name="credits" class="textarea2 form-control form-control-sm is-warning bg-dark"></textarea>
                </p>
                <p class="text-sm">Keterangan Singkat
                  <input type="text" name="ket" value="" class="form-control form-control-sm is-warning bg-dark" placeholder="Misal, oleh AWSubs atau MoeSubs...">
                </p>
                <p class="text-sm">Link Informasi
                  <input type="text" name="kitsu_info" value="<?= $kitsu_info; ?>" class="form-control form-control-sm is-warning bg-dark" placeholder="Link myanimelist atau kitsu...">
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" name="submit" class="float-right btn btn-primary" id="save_button">Save</button>
        </div>
      </div>
      <!-- /.card -->


</form>