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
      <li class="ml-2 nav-item active"><a class="link-black" href="<?= base_url("client/set_tampilan/tile/") ?><?= $current_url ?>"><i class="fa fa-th"></i></a></li>
      <li list-style-type="none" class="ml-2 nav-item"><a class="link-black"><i class="fa fa-th-list"></a></i>
    </ul>
  </div>
</div>


<?php if (empty($anime)) :?>
<div class="row">
  <div class="col-12 text-center">
      <i><p class="text-muted"><i class="fa fa-times-circle"></i> 404 Data tidak ditemukan.</p></i>
  </div>
</div>

<?php endif; ?>

<!-- Series -->
        <div class="row">
        <?php foreach ($anime as $key => $value) :?>

          <!-- Separator -->
          <div class="wadah_konten_in_list ml-1 float-left">
            <!-- gambar poster -->
            <div class="gambar_in_list" style="background-image: url(<?= str_replace("small.jpg", "tiny.jpg", $anime[$key]['poster_url_small']) ; ?>);">
            </div>
            <!-- overlay hitam dan tombol-tombol -->
            <div class="overlay_in_list" style="display: none">
              <div class="overlay_tulisan_in_list">
                  <!-- Tab nav -->
                  <ul class="nav" role="tablist" style="width: 50%;">
                    <li>
                      <a href="#informasi-<?= $anime[$key]['anime_parent_id']; ?>" role="tab" data-toggle="tab" class="btn btn-link btn-sm overlay_tombol_kiri" style="color: #fff">
                        <i class="fa fa-info fa-fw fa_ukuran_kecil_in_list"></i> informasi
                      <br>
                      </a>
                    </li>
                    <?php 
                    // If who logged in was admin or admin super, then show this edit button
                    if ( !empty( $this->session->userdata('admin') ) or !empty( $this->session->userdata('admin_super')) ): ?>
                    <li>
                      <a href="#edit-<?= $anime[$key]['anime_parent_id']; ?>" role="tab" data-toggle="tab" class="btn btn-link btn-sm overlay_tombol_kiri" style="color: #fff; background: rgba(255, 0, 0, 0.192); width: 50px;">
                      <i class="fa fa-wrench fa-fw fa_ukuran_kecil_in_list"></i> edit
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
            <!-- Tulisan di bagian kanan -->
            <div class="tulisan_kanan_in_list">

              <div class="rating_in_list bg-<?= $rating_color; ?>">
                <i class="fa fa-star fa-fw text-white"></i><span class="shadow text-white"> <?= $anime[$key]['rating']; ?>%</span>
              </div>
               <div class="tab-content tab-space">
                 <div class="tab-pane active container" id="informasi-<?= $anime[$key]['anime_parent_id']; ?>">
                   <h2><a class="text-<?= $theme['accent_color']; ?>" href="<?= base_url('client/anime/'); ?><?= $anime[$key]['anime_parent_id']; ?>" title="<?php echo $anime[$key]['title']; ?>"><?php
                    
                      echo $anime[$key]['title'];
                    ?></a></h2>
                 </div>

                 <?php 
                 // If who logged in was admin or admin super, then show this edit panel
                 if ($this->session->userdata('admin') or $this->session->userdata('admin_super')): ?>

                 <div class="btn-group" style="position: absolute; top: 0; left: 0;">
                   <a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#" style="text-shadow: 1px 1px 6px #000;"><i class="fa fa-cog"></i>
                   </a>
                   <div class="dropdown-menu">
                     <a class="dropdown-item" tabindex="-1" href="<?= base_url('admin/series_manager_detail/') ?><?= $anime[$key]['anime_parent_id']; ?>">Edit series</a>
                     <a class="dropdown-item" tabindex="-1" href="<?= base_url('admin/episode_manager/') ?><?= $anime[$key]['anime_parent_id']; ?>">Edit episode</a>
                     <a class="dropdown-item" tabindex="-1" href="<?= base_url( 'admin/delete_series/'.$current_page.'/'. $anime[$key]["anime_parent_id"] ); ?>">Hapus</a>
                   </div>
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
            <div class="progress progress-line-success progress_bar_in_list mb-0" id="progressZ">
              <div class="progress-bar progress-bar-success bg-<?= $theme['accent_color'] ?>" role="progressbar" style="width: <?= $pembagian; ?>%;" >
              </div>
              <span class="episode_tergarap_in_list"><?= $anime[$key]['progress']; ?> / <?= $full_episode; ?> Episode
              </span>
            </div>
          </div>
         
        <?php endforeach; ?>
        </div>
<!-- ./Series -->