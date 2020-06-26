
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <p class="col-12 mt-2 card-title text-muted text-sm float-left">Tambah Series Hanya Dengan 1x Klik, dengan <a href="https://kitsu.io/">Kitsu API</a>
                </p>
               <form action="" method="get">
                <div class="col-12 mt-2 card-tools float-left">
                  <div class="input-group input-group-md" style="width: 80%;">
                    <input type="text" class="form-control" name="kitsu_search" placeholder="Search" autofocus="on">
                    <div class="input-group-append" style="position: relative;">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
               </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Title</th>
                      <th>Season Year</th>
                      <th>Average Rating</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($kitsu_anime)): ?>
                    <?php foreach ($kitsu_anime as $key => $anime): ?>
                      <tr>
                        <?php 
                        // filtering semua karakter yang gak boleh ada di URI
                        $anime_name = stripslashes(str_replace("!", " ", $anime['attributes']['titles']['en_jp']));
                        $anime_name = str_replace(' ', '%20', $anime_name); //replacing space characters
                        $anime_name = str_replace('/', '%20', $anime_name); //replacing slash
                        $anime_name = str_replace('!', '%20', $anime_name); //replacing exclamation
                        $anime_name = str_replace('?', '%20', $anime_name); //replacing question mark
                        $anime_name = str_replace("'", '%20', $anime_name); //replacing question mark
                        $anime_name = str_replace("&", '%20', $anime_name); //replacing & symbol
                        $anime_name = htmlspecialchars($anime_name);
                        // nah, kalo anime-nya ada judul jepangnya, pake judul jepang aja buat search karena judul jepang lebih unik utk mencari secara pasti, gak ketuker sama anime lain
                        if ( !empty($anime['attributes']['titles']['ja_jp']) ) {
                          $anime_name = $anime['attributes']['titles']['ja_jp'];
                        }
                        $link_edit = base_url('admin/add_new_anime_series_step2/' . $anime_name);
                        ?>
                        <td><?php echo $key+1; ?></td>

                        <td><a href="<?= $link_edit; ?>"><?php
                        if (!empty($anime['attributes']['titles']['en'])) {
                           echo $anime['attributes']['titles']['en'].' || ';
                         } 
                        ?> <?php
                        if (!empty($anime['attributes']['titles']['en_jp'])) {
                           echo $anime['attributes']['titles']['en_jp'].' || ';
                         }
                        ?> <?php
                        if (!empty($anime['attributes']['titles']['ja_jp'])) {
                           echo $anime['attributes']['titles']['ja_jp'];
                         } 
                        ?></a></td>

                        <td><a href="<?= $link_edit; ?>"><?php
                        if (!empty($anime['attributes']['startDate'])) {
                           echo $anime['attributes']['startDate'];
                         } 
                        ?></a></td>

                        <td><a href="<?= $link_edit; ?>"><?php
                        if (!empty($anime['attributes']['averageRating'])) {
                           echo $anime['attributes']['averageRating'];
                         } 
                        ?>%</a></td>
                      </tr>
                    <?php endforeach ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="4">
                          <p class="text-muted text-center text-sm"><i>Tinggal search anime-nya dan tambah series. Easy peasy crazy...</i></p>
                        </td>
                        
                      </tr>
                      
                   <?php endif ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->