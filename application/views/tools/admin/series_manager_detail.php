
<div class="row">
  
  <a style="text-transform: none;" href="<?= base_url('admin/episode_manager/') ?><?= $anime['anime_parent_id']; ?>" class="btn btn-sm btn-secondary mb-2 ml-2"> Edit Episode Series Ini
  </a>
  <a style="text-transform: none;" href="<?= base_url('admin/delete_series/1/') ?><?= $anime['anime_parent_id']; ?>" class="btn btn-sm btn-danger mb-2 ml-2"> DELETE SERIES INI
  </a>
  <p class="col-12" style="color: red">
   <small><i>Hapus terlebih dulu seluruh episode sebelum menghapus series.</i></small>
  </p>
</div>
<form action="" method="post" id="form_edit_anime">
  
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
                  <a class="info-box btn btn-default bg-gradient-dark callout callout-danger <?php if($anime['trailer']=='https://youtube.com/watch?v='){ echo "disabled";} ?>" data-fancybox href="<?= $anime['trailer']; ?>&amp;autoplay=0&amp;rel=0&amp;controls=1&amp;showinfo=1" id="trailer_button">
                    <div class="info-box-content">
                      <h4 class="info-box-text text-center text-bold mb-0" style="font-size: 22px; color: #fff; padding-top: 8px;"><i class="fa fa-play"></i></h4>
                      <span class="info-box-text text-center mb-0 mt-0" style="font-size: 14px; color: #ddd;"><i>Play Trailer</i></span>
                    </div>
                  </a>
                    <p class="text-muted text-sm">Trailer url
                      <input type="hidden" name="anime_parent_id" required value="<?= $id; ?>" id="anime_parent_id">
                      <input type="text" name="trailer" required value="<?= $anime['trailer']; ?>" class="form-control form-control-sm is-warning bg-dark bg-dark" placeholder="Tempatkan link youtube..." id="trailer">
                    </p>
                </div>
                <div class="col-12 col-sm-4">
                  <a class="info-box btn btn-default bg-gradient-success disabled">
                    <div class="info-box-content">
                      <h4 class="info-box-text text-center text-bold mb-0" style="font-size: 22px; color: #fff; padding-top: 8px;"><i class="fa fa-download"></i> Download</h4>
                      <span class="info-box-text text-center mb-0 mt-0" style="font-size: 14px; color: #ddd;"><i><?= $anime['download_count'] ?> kali</i></span>
                    </div>
                  </a>
                    <p class="text-muted text-sm">Judul anime
                      <input type="text" name="title" value="<?= $anime['title']; ?>" class="form-control form-control-sm is-warning bg-dark bg-dark" placeholder="Judul..." id="title">
                    </p>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box callout callout-info">
                    <div class="info-box-content" style="color: #fff; ">
                      <span class="info-box-text text-center text-muted">Dibagikan</span>
                      <span class="info-box-number text-center text-muted mb-0">20 x<span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                    <div class="post">
                      <!-- Sinopsis -->
                      <div class="mb-3">
                        <strong>Sinopsis</strong> <br>
                        <p>English:
                        <textarea disabled style="width: 100%; height: 140px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="sinopsis_english"><?= $kitsu_anime["attributes"]["synopsis"]; ?></textarea>
                        </p>

                        <p>Indonesia:<br>
                        <small><i>Silakan terjemahkan dari atas itu, atau copas aja langsung.</i></small>
                        <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="sinopsis"><?= $anime['sinopsis']; ?></textarea>
                        </p>
                      </div>
                        
                    </div>
                  <h4>[Kolom komentar]</h4>
                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?= base_url() ?>assets/img/no_photo.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Kyokou</a>
                        </span>
                        <span class="description">[Waktu]</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        [Komentar]
                      </p>
                    </div>

                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?= base_url() ?>assets/img/no_photo.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Kyokou</a>
                        </span>
                        <span class="description">[Waktu]</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        [Komentar]
                      </p>
                    </div>

                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-lg-2">
                    <p class="text-muted text-sm">Poster small (Muncul di halaman depan)
                      <input type="text" name="poster_url_small" required value="<?= $anime['poster_url_small']; ?>" class="form-control form-control-sm is-warning bg-dark"  placeholder="autofilled..." id="poster_url_small">
                    </p>
                    <p class="text-muted text-sm">Poster medium (Muncul di hlmn detil anime)
                      <input type="text" name="poster_url_medium" required value="<?= $anime['poster_url_medium']; ?>" class="form-control form-control-sm is-warning bg-dark" placeholder="autofilled..." id="poster_url_medium">
                    </p>
              <div class="row">
                  <div class="col-12">
                    <div class="bg-light">
                      <div class="ribbon-wrapper ribbon-xl">
                        <div class="ribbon bg-danger text-lg">
                          <i class="fas fa-star"></i> <?= $anime['rating']; ?> rated
                        </div>
                      </div>
                      <img src="<?= $anime['poster_url_medium']; ?>" class="img-fluid  mx-auto d-block" alt="Responsive image" id="poster_image">
                    </div>
                  </div>

              </div>
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
              <br>
              <div class="text-muted">
                <p class="text-sm">Categories
                  <input type="text" name="categories" required value="<?= $anime['categories']; ?>" class="form-control form-control-sm is-warning bg-dark" placeholder="autofilled..." id="categories">
                </p>
                <p class="text-sm">Musim
                  <input type="text" name="season" required value="<?= $anime['season']; ?>" class="form-control form-control-sm is-warning bg-dark" placeholder="autofilled..." id="season">
                </p>
                <p class="text-sm">Tahun
                  <input type="text" name="year" required value="<?= $anime['year']; ?>" class="form-control form-control-sm is-warning bg-dark" placeholder="autofilled..." id="year">
                </p>
                <p class="text-sm">Credits
                  <textarea name="credits" class="textarea form-control form-control-sm is-warning bg-dark"><?= $anime['credits']; ?></textarea>
                </p>
                <p class="text-sm">Keterangan Singkat
                  <input type="text" name="ket" value="<?= $anime['ket']; ?>" class="form-control form-control-sm is-warning bg-dark" placeholder="Misal, oleh AWSubs atau MoeSubs...">
                </p>
                <p class="text-sm">Link Informasi
                  <input type="text" name="kitsu_info" required value="<?= $anime['kitsu_info']; ?>" class="form-control form-control-sm is-warning bg-dark" placeholder="Link myanimelist atau kitsu..." id="kitsu_info">
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" name="submit" class="float-right btn btn-primary" id="save_edit">Save edit</button>
          <a href="javascript:void(0);" class="float-right btn btn-secondary mr-3" id="reset_default">Reset default</a>
        </div>
      </div>
      <!-- /.card -->


</form>