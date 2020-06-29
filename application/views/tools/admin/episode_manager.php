<div id="table_episode">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">


    <!-- Main content -->
    <section class="content">

<div class="row">
  
  <a style="text-transform: none;" href="<?= base_url('admin/series_manager_detail/') ?><?= $anime['anime_parent_id']; ?>" class="btn btn-sm btn-secondary mb-2 ml-2"> Edit Series Ini
  </a>

</div>
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                  <div class="card-tools float-right mr-2">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                  </div>
                <ul class="nav nav-tabs col-12" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="add_a_new_episode-tab" data-toggle="pill" href="#add_a_new_episode" role="tab" aria-controls="add_a_new_episode" aria-selected="true">Add a new episode</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="add_multiple_episodes-tab" data-toggle="pill" href="#add_multiple_episodes" role="tab" aria-controls="add_multiple_episodes" aria-selected="false">Add multiple episodes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="add_multiple_episodes-tab" data-toggle="pill" href="#progress" role="tab" aria-controls="add_multiple_episodes" aria-selected="false">Progress</a>
                  </li>
                </ul>
              </div>

              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="add_a_new_episode" role="tabpanel" aria-labelledby="add_a_new_episode-tab">
                    <form action="" method="post" role="form border" id="form_add_episode">
                      <div class="card-body">
                        <div class="form-group">
                          <label for="">Link Downloads</label>
                          <br><small class="text-muted text-sm"><i>Anda dapat dengan mudah menambah episode hanya dengan memasukkan link tanpa harus mengetik nama link dan nama file.</i></small>
                       <!--    <br><small class="text-muted text-sm"><i>Anda dapat menyimpan link dengan cara input</i> <font color="red">"http://url_download@nama_url"</font><i> dengan '@' sebagai pemisah.</i></small>
                          <br><small class="text-muted text-sm"><i>Atau multiple link dengan cara input</i> <font color="red">"http://url_download1@nama_url1@http://url_download2@nama_url2"</font>.</small>
                          <br><small class="text-muted text-sm"><i>Contoh.</i> <font color="red">"http://google.com/url_download@GoogleDrive@http://mega.nz/url_download@Mega"</font>.</small> -->
                          <textarea name="links" id="links" class="d-none"></textarea><br>
                          <div class="row" id="link_inputs">
                            <input type="text" class="form-control col-md-8 mt-1" placeholder="Link 1 download goes here..." id="link1" name="link1" required onchange="getMetaOfLink(1)">
                            <input type="text" class="form-control col-md-4 mt-1 nama_link" id="nama_link1" placeholder="Nama link 1..." name="nama_link1" required>
                          </div>
                          <div class="form-group mb-5">
                            <div class="col-12 mt-2">
                              <a href="javascript:void(0)" class="btn btn-primary float-right" id="tambah_input_link" onclick="tambah_link()"><i class="fa fa-plus"></i> Tambah link</a>
                            </div>
                            <div class="col-12 mt-2">
                              <a href="javascript:void(0)" class="btn btn-primary float-right mr-2" id="tambah_input_link" onclick="kurangi_link()"><i class="fa fa-minus"></i> Kurangi link</a>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="">File name</label>
                          <input type="hidden" value="yes" name="is_add_episode">
                          <input type="hidden" class="form-control" value="<?= $anime['anime_parent_id'] ?>" name="anime_parent_id">
                          <input type="text" class="form-control" id="file_name1" placeholder="Place file name here..." name="file_name" required>
                        </div>
                        <div class="form-group"> 
                          <label for="">Sumber Website</label>
                          <input type="text" class="form-control" id="" placeholder="And website source is here..." name="website">
                       </div>
                      </div>
                          <button type="submit" name="add_new_episode_button" class="float-right btn btn-primary" id="add_new_episode_button">Add new episode</button>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="add_multiple_episodes" role="tabpanel" aria-labelledby="add_multiple_episodes-tab">
                      <div class="text-sm">
                      <p>Format script seperti berikut:</p>
                      <font color="red">
                      [Koreksubs] Yakusoku no Neverland - 01 [1080p][x265][10-bit].mkv
                      <br>http://url_download1@nama_url1@http://url_download2@nama_url2
                      <br>http://www.koreksubs.online
                      <br>
                      <br>[Koreksubs] Yakusoku no Neverland - 02 [1080p][x265][10-bit].mkv
                      <br>http://url_download1@nama_url1@http://url_download2@nama_url2
                      <br>http://www.koreksubs.online
                      <br>
                      <br>(Dan seterusnya...)
                      <br>
                      </font>
                      <strong>PASTIKAN SESUAI FORMAT! KALAU RUSAK TANGGUNG SENDIRI AKIBATNYA wKwK!</strong>
                      </div>
                       <form action="" method="post" role="form border" id="form_multiple_episode">
                          <input type="hidden" value="yes" name="is_multiple_episode">
                          <input type="hidden" name="anime_parent_id" value="<?= $anime['anime_parent_id'] ?>">
                          <textarea placeholder="Place your episode scripts here..." class="mt-3" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; background-color: #f0f0f0;" name="multiple_episodes" id="multiple_episodes" required></textarea>
                        <button type="submit" name="submit" class="float-right btn btn-primary mt-4" id="add_multiple_episodes_button">Add multiple episodes</button>
                       </form>
                  </div>
                  <div class="tab-pane fade" id="progress" role="tabpanel">
                     <div class="form-group">
                      <label for="">Sampai mana progres kamu?</label>
                       <form action="" method="post" role="form border" id="form_progress">
                          Sudah
                          <div class="row col-2">
                            <select style="width: 120px" class="form-control" name="progress">
                              <?php for ($i=0; $i < $anime['full_episode']+1 ; $i++): ?>
                              <option <?php if($i == $anime['progress']){echo "selected";} ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                              <?php endfor ?>
                            </select>
                          </div>
                          episode
                        <button type="submit" name="progress_submit" class="float-right btn btn-primary mt-4" id="progress_submit">Simpan Progres</button>
                       </form>
                     </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
        <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" id="link_download">Episode dari "<?= $anime['title']; ?>" <br> <a target="_blank" class="btn btn-xs btn-primary mt-1" href="<?= base_url('admin/generate_episode_script/' . $anime['anime_parent_id'] ) ?>">Generate Episode Script dari series ini</a><a href="javascript:void(0)" class="btn btn-xs ml-3 mt-2 btn-danger" id="delete_all_episode">Delete All Episode!!</a></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body text-sm">
              <table class="table table-bordered table-striped" id="download_section">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>File Name</th>
                  <th>Link Download</th>
                  <th>Sumber</th>
                  <th>Tanggal</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $nomor = 0; ?>
                <?php foreach ($episodes as $eps) :?>
                <tr id="episode-<?php echo $eps['anime_child_id'] ?>">
                  <td>
                    <?php $nomor++; ?>
                    <?= $nomor; ?>
                  </td>
                  <td>
                    <?= $eps['file_name']; ?>
                  </td>
                  <td class=" text-center">
                    <?php foreach ($eps['converted_links'] as $key => $value) :
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
                      
                      ?><a target="_blank" class="btn btn-xs btn-default mb-2 ml-2" href="<?= $value ?>"><?php 
                      /*if index is odd then print link name*/ else : 
                      echo $value ?></a><?php endif; 
                      endforeach; ?>
                  </td>
                  <td >
                    <a href="<?= $eps['website']; ?>">Website</a>
                  </td>
                  <td>
                    <?= $eps['timestamp']; ?>
                  </td>
                  <td class=" text-center">
                    <form action="" method="post" id="form_hapus_episode-<?= $eps['anime_child_id']; ?>">
                      <input type="hidden" value="yes" name="is_delete_episode">
                      <input type="hidden" name="anime_child_id" value="<?= $eps['anime_child_id']; ?>">
                      <button title="Hapus episode ini" class="btn btn-sm btn-danger mt-1" type="submit" name="delete_episode" value="delete_episode" id="delete_episode_button-<?= $eps['anime_child_id']; ?>" ><i class="fas fa-trash"></i></button>
                    </form>
                      <button type="button" title="Edit episode ini" class="btn btn-sm btn-primary mt-1" data-toggle="modal" data-target="#modal-edit" onclick="updateEpisode(<?= $eps['anime_child_id']; ?>)">
                        <i class="fas fa-pencil-alt"></i>
                      </button>
                      <?php
                        // Untuk link status
                        $exploded_link_status = explode(",", $eps['link_status']);

                        $link_status =  $exploded_link_status[0];
                        $pelapor =  $exploded_link_status[1];
                      ?>
                      <?php 
                        if ( $link_status == "2" AND $pelapor != "0" ) : ?>
                          <form action="" method="post">
                            <input type="hidden" value="yes" name="is_reset_link_status">
                            <input type="hidden" name="anime_child_id" value="<?= $eps['anime_child_id'] ?>">
                            <button type="submit" title="Hapus Tanda Rusak Semuanya" class="btn btn-sm btn-danger mt-1 link_rusak_semua">
                            <i class="fa fa-link"></i>
                            </button>
                          </form>
                        <?php elseif ( $link_status == "1" AND $pelapor != "0" ) : ?>
                          <form action="" method="post">
                            <input type="hidden" value="yes" name="is_reset_link_status">
                            <input type="hidden" name="anime_child_id" value="<?= $eps['anime_child_id'] ?>">
                            <button type="submit" title="Hapus Tanda Rusak Sebagian" class="btn btn-sm btn-warning mt-1 link_rusak_sebagian">
                              <i class="fa fa-link"></i>
                            </button>
                          </form>
                        <?php else : ?>
                          <form>
                            <button type="button" title="Link Sehat" class="btn btn-sm btn-default mt-1">
                              <i class="fa fa-link"></i>
                            </button>
                          </form>
                        <?php endif; ?>
                      
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
</div>




<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Episode</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



          <form action="" method="post" role="form border" id="form_edit_episode">
            <div class="card-body">
                <input type="hidden" value="yes" name="is_edit_episode">
                <input type="hidden" value="" name="anime_child_id" id="anime_child_id">
              <div class="form-group">
                <label for="">File name</label>
                <input type="hidden" value="<?= $anime['anime_parent_id'] ?>" name="anime_parent_id">
                <input type="text" class="form-control" id="" placeholder="Place file name here..." name="file_name" value="<?= $eps['file_name']; ?>" id="file_name" required>
              </div>
              <div class="form-group">
                <label for="">Link Downloads</label>
                <textarea name="links" id="links_edit" class="d-none"></textarea><br>                
                <div class="row"  id="links_in_modal">
                  
                </div>
              </div>
              <div class="form-group"> 
                <label for="">Sumber Website</label>
                <input type="text" class="form-control" id="" placeholder="And website source is here..." name="website" value="<?= $eps['website']; ?>">
             </div>
            </div>



      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan_perubahan_episode" value="1" type="button" class="btn btn-primary" id="simpan_perubahan_episode">Simpan perubahan</button>
      </div>
         

          </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->






