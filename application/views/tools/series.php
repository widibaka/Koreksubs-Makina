<?php  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $current_url = "https://";   
    else  
         $current_url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $current_url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $current_url.= $_SERVER['REQUEST_URI'];    
    $current_url = base64_encode($current_url);
?>   

<div class="col-12 navbar navbar-expand mb-2" style="margin-top: -20px;">
  <div class="float-right mt-0" style="position: absolute; right: 0px; float: right;">
    <ul type="none" class="navbar-nav mt-0">
      <li class="ml-2 nav-item active"><a class="link-black"><i class="fa fa-th"></i></a></li>
      <li list-style-type="none" class="ml-2 nav-item"><a class="link-black" href="<?= base_url("client/set_tampilan/list/") ?><?= $current_url ?>"><i class="fa fa-th-list"></a></i>
    </ul>
  </div>
</div>


<?php if (empty($anime)) :?>
<div class="row">
  <div class="col-12 text-center">
      <i><p class="text-muted"><i class="fa fa-times-circle"></i> Data tidak ditemukan.</p></i>
  </div>
</div>

<?php endif; ?>

<!-- Series -->
        <div class="row">
        <?php foreach ($anime as $key => $value) :?>

          <!-- Separator -->
          <div class="wadah_konten ml-1 float-left">
            <!-- gambar poster -->
            <div class="gambar" style="background-image: url(<?= $anime[$key]['poster_url_small']; ?>);">
            </div>
            <!-- overlay hitam dan tombol-tombol -->
            <div class="overlay">
              <div class="overlay_tulisan">
                  <!-- Tab nav -->
                  <ul class="nav" role="tablist" style="width: 50%;">
                    <li>
                      <a href="#informasi-<?= $anime[$key]['anime_parent_id']; ?>" role="tab" data-toggle="tab" class="btn btn-link btn-sm overlay_tombol_kiri" style="color: #fff">
                        <i class="fa fa-info fa-fw fa_ukuran_kecil"></i> informasi
                      <br>
                      </a>
                    </li>
                    <li>
                      <a href="#sinopsis-<?= $anime[$key]['anime_parent_id']; ?>" role="tab" data-toggle="tab" class="btn btn-link btn-sm overlay_tombol_kiri" style="color: #fff">
                        <i class="fa fa-paragraph fa-fw fa_ukuran_kecil"></i> sinopsis
                      </a>
                      <br>
                    </li>
                    <li>
                      <a href="<?= base_url('client/anime/'); ?><?= $anime[$key]['anime_parent_id']; ?>" class="btn btn-link btn-sm  overlay_tombol_kiri bg-<?= $theme['accent_color']; ?>" style="color: #fff">
                        <i class="fa fa-eye fa-fw fa_ukuran_kecil"></i> read more...
                      </a>
                      <br>
                    </li>
                    <?php 
                    // If who logged in was admin or admin super, then show this edit button
                    if ( !empty( $this->session->userdata('admin') ) or !empty( $this->session->userdata('admin_super')) ): ?>
                    <li>
                      <a href="#edit-<?= $anime[$key]['anime_parent_id']; ?>" role="tab" data-toggle="tab" class="btn btn-link btn-sm overlay_tombol_kiri" style="color: #fff; background: rgba(255, 0, 0, 0.192); width: 50px;">
                      <i class="fa fa-wrench fa-fw fa_ukuran_kecil"></i> edit
                      </a>
                      <br>
                    </li>
                    <?php endif ?>
                  </ul>
              </div>
            </div>

<?php 
    switch ($anime[$key]['rating']) {
      case $anime[$key]['rating'] >80:
        $rating_color = "success";
        break;
      case $anime[$key]['rating'] >65:
        $rating_color =  "secondary";
        break;
      
      default:
        $rating_color =  "danger";
        break;
    }
?>
              <?php if ( !empty($anime[$key]['rating']) ): ?>
                <div class="rating bg-<?= $rating_color; ?>">
                  <i class="fa fa-star fa-fw text-white"></i><span class="shadow text-white"> <?= $anime[$key]['rating']; ?>%</span>
                </div>
              <?php endif ?>
              
            <!-- Tulisan di bagian kanan -->
            <div class="tulisan_kanan">
               <div class="tab-content tab-space">
                 <div class="tab-pane active container" id="informasi-<?= $anime[$key]['anime_parent_id']; ?>">
                   <h2><a class="text-<?= $theme['accent_color']; ?>" href="<?= base_url('client/anime/'); ?><?= $anime[$key]['anime_parent_id']; ?>" title="<?php echo $anime[$key]['title']; ?>"><?php
                    if (strlen($anime[$key]['title'])>40) {
                      
                      echo substr($anime[$key]['title'], 0, 40) . "...";
                    }else{
                      echo $anime[$key]['title'];
                    }
                    ?></a></h2>
                   <p><strong>Category:</strong> <?php if (strlen($anime[$key]['categories']) > 70) {
                     echo substr($anime[$key]['categories'], 0, 70) . "...";
                   }else {
                     echo $anime[$key]['categories'];
                   }  ?>
                   <p><strong>Musim:</strong> <?= $anime[$key]['season']; ?> <?= $anime[$key]['year']; ?></p>
                   <p><strong>Diunduh:</strong> <?= $anime[$key]['download_count']; ?>x</p>
                 </div>
                 <div class="tab-pane justify container" id="sinopsis-<?= $anime[$key]['anime_parent_id']; ?>">
                   <h2>Sinopsis</h2>
                   <p><?= substr($anime[$key]['sinopsis'], 0, 210); ?>... <a class="text-<?= $theme['accent_color']; ?> fa_ukuran_kecil" href="<?= base_url('client/anime/'); ?><?= $anime[$key]['anime_parent_id']; ?>">read more</a></p>
                 </div>

                 <?php 
                 // If who logged in was admin or admin super, then show this edit panel
                 if ($this->session->userdata('admin') or $this->session->userdata('admin_super')): ?>

                 <div class="tab-pane container mt-4" id="edit-<?= $anime[$key]['anime_parent_id']; ?>">
                  <a style="text-transform: none;" href="<?= base_url('admin/series_manager_detail/') ?><?= $anime[$key]['anime_parent_id']; ?>" class="btn btn-sm btn-danger mb-2">
                    <i class="fa fa-pencil-alt fa-fh fa-fw"></i> Edit Series
                  </a><br>
                  <a style="text-transform: none;" href="<?= base_url('admin/episode_manager/') ?><?= $anime[$key]['anime_parent_id']; ?>" class="btn btn-sm btn-danger mb-2">
                    <i class="fa fa-pencil-alt fa-fh fa-fw"></i> Edit Eps
                  </a><br>
                  <a style="text-transform: none;" href="<?= base_url( 'admin/delete_series/'.$current_page.'/'. $anime[$key]["anime_parent_id"] ); ?>" class="btn btn-sm btn-danger mb-2">
                    <i class="fa fa-trash fa-fh fa-fw"></i> Hapus
                  </a>
                 <p class="text-danger text-sm" style="line-height: 13px; font-style: italic;">Hapus terlebih dulu seluruh episode sebelum menghapus series.</p>
                 </div>
                  
                 <?php endif ?>
               </div>
            </div>
            <!-- Progress bar -->
            <?php 
            if (!empty($anime[$key]['full_episode'])) {
              $pembagian = $anime[$key]['progress'] / $anime[$key]['full_episode'] * 100;
              $full_episode = $anime[$key]['full_episode'];
            }else{
              $pembagian = 0;
              $full_episode = 'Na';
            }
                
             ?>
            <?php if ( !empty($anime[$key]['full_episode']) ): ?>
              <div class="progress progress-line-success progress_bar mb-0" id="progressZ">
                <div class="progress-bar progress-bar-success bg-<?= $theme['accent_color'] ?>" role="progressbar" style="width: <?= $pembagian; ?>%;" >
                </div>
                <span class="episode_tergarap"><?= $anime[$key]['progress']; ?> / <?= $full_episode; ?> Episode
                </span>
              </div>
            <?php endif ?>
          </div>
         
        <?php endforeach; ?>
        <div class="container col-md-12 mb-4">
        </div>
        </div>
<!-- ./Series -->