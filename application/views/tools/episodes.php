  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" id="go_to_download"><?php 

              if ( $page == 'home' ) {
                 echo $download_title; 
              } else {
                 echo "Tautan Unduh";
              }

              ?></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body text-sm">
              
              <table id="download_section" class="table table-bordered table-striped no-border">
                <thead>
                <tr> 
                  <th>Nama</th>
                  <?php if ( $page == "home" ): ?>
                  <th>Informasi</th>
                  <?php endif ?>
                  <th>Sumber</th>
                  <th>Waktu</th>
                </tr>
                </thead>
                <tbody class="no-border">
                <?php foreach ($episodes as $eps) :?>
                <tr>
                  <td>
                    <?php
                      // Untuk link status
                      $exploded_link_status = explode(",", $eps['link_status']);

                      $link_status =  $exploded_link_status[0];
                      $pelapor =  $exploded_link_status[1];
                    ?>
                    <?= $eps['file_name']; ?>
                    <div class="btn-group">
                      <a title="Tautan Unduh" class="btn btn-sm btn-default dropdown-toggle <?php 
                        if ( $link_status == "2" AND $pelapor != "0" ) : 
                          echo("border-danger link_rusak_semua");
                        elseif ( $link_status == "1" AND $pelapor != "0" ) : 
                          echo("border-warning link_rusak_sebagian");
                        endif;
                      ?> " data-toggle="dropdown" href="#">
                      <i class="fa fa-download"></i>
                      (<?php echo count( $eps['converted_links'] )/2 ; // Untuk meberitahu jumlah link, dibagi 2 karena yang satu link dan satunya nama link ?>)
                      </a>
                      <div class="dropdown-menu">                        
                        <?php foreach ($eps['converted_links'] as $key => $value) : // di sini adalah link yg udah diconvert jadi array

                          /*if index is even then print link*/
                        if( $key%2 == 0 ) :

                          // ini nanti gabungannya sama 'shortlink'
                          $value = str_replace('http://', 'http_prefix__', $value);
                          $value = str_replace('https://', 'http_prefix__', $value);
                          $value = str_replace('#','_pagar_', $value);
                          $value = str_replace('/','-_-_-_-_-_', $value);
                          $value = str_replace('.','_moe_moe_kyun', $value);

                          $value = str_replace('http_prefix__', base_url('client/ready_to_download/'.$eps['anime_parent_id'].'/'), $value);
                          $value = str_replace('http_prefix__', base_url('client/ready_to_download/'.$eps['anime_parent_id'].'/'), $value);
                          

                          ?><a target="_blank" class="dropdown-item" tabindex="-1" href="<?= $value ?>" id="link_downloads"><?php 
                          /*if index is odd then print link name*/ 
                        else : 

                          echo $value ?></a>
                        <?php endif; 
                          endforeach; ?>
                          <div class="dropdown-divider"></div>
                          <?php if ( $link_status == "2" AND $pelapor != "0" ): ?>
                            <a class="dropdown-item bg-danger">Link ini rusak semua <br><i>(laporan dari <strong><?= $pelapor ?></strong>)</i></a>
                          <?php elseif ( $link_status == "1" AND $pelapor != "0" ): ?>
                            <a class="dropdown-item bg-warning">Link ini rusak sebagian <br><i>(laporan dari <strong><?= $pelapor ?></strong>)</i></a>
                          <?php else: ?>
                            <a class="dropdown-item" href="<?= base_url('client/lapor_link_rusak/').$eps['anime_child_id'] ?>">Laporkan link rusak</a>
                          <?php endif ?>
                      </div>
                    </div>
                  </td>
                  <?php if ( $page == "home" ): ?>
                  <td>
                    <a href="<?= base_url('client/anime/'); ?><?= $eps['anime_parent_id']; ?>" title="Tampilkan semua episode dari series ini">
                      Episode lainnya
                    </a>
                  </td>
                  <?php endif ?>
                  <td >
                    <a href="<?= $eps['website']; ?>">Website</a>
                  </td>
                  <td>
                    <?php
                      $this->load->model('Client_model');
                      $time_ago = $this->Client_model->get_time_ago($eps['timestamp']);
                      $time_ago_exploded = explode(" ", $time_ago);
                      if ( 
                        $time_ago_exploded[1] == "detik" or  
                        $time_ago_exploded[1] == "menit" or  
                        $time_ago_exploded[0] < 24 AND $time_ago_exploded[1] == "jam" ) {
                        echo "<span class='text-success'>".$time_ago."</span>";
                      }else{
                        echo $time_ago;
                      }
                     ?>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->