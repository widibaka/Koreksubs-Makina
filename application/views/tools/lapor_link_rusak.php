
<div class="col-sm-12 col-lg-4">
    <?php if ( $this->session->flashdata("success")=="yes" ): ?>
        <div class="lockscreen-logo badge bg-white">
        <b>Terima kasih sudah membantu!</b>
        </div>
        <div class="text-center">
        <img src="<?= base_url('assets/img/chocolate_shiawase.png'); ?>">
        </div>
        <div class="input-group">
        <form action="" method="post" id="form_lapor_link_rusak"> 
        <!-- START LOCK SCREEN ITEM -->
          <!-- lockscreen credentials (contains the form) -->
          <p class="container text-center text-success">
            <strong><?= $episode['file_name'] ?></strong>
          </p>
            <a href="<?= base_url() ?>" class="text-center mt-3 btn btn-default bg-light form-control" type="submit">Kembali Ke Home</a>

          <!-- /.lockscreen credentials -->
          
        </form>

        </div>
        <!-- /.lockscreen-item -->
    <?php else: ?>
        <div class="lockscreen-logo badge bg-white">
        <b>Link-nya rusak? Gawat!</b>
        </div>
        <div class="text-center">
        <img src="<?= base_url('assets/img/chocolate_asetteru.png'); ?>">
        </div>
        <div class="input-group">
        <form action="" method="post" id="form_lapor_link_rusak"> 
        <!-- START LOCK SCREEN ITEM -->
          <!-- lockscreen credentials (contains the form) -->
          <p class="container text-center">
            Apa kamu mau menolongku untuk melaporkan berkas bernama <br> <strong class="text-danger"><?= $episode['file_name'] ?></strong> ini?<br><br>
            Tolong pilih salah satu jenis kerusakan:</p>
              <input type="hidden" name="lapor_link_rusak" value="yes">
              <input type="hidden" name="anime_child_id" value="<?= $episode['anime_child_id'] ?>">
              <input type="hidden" name="username" value="<?= $this->session->userdata('username') ?>">
              <input type="hidden" name="jenis_kerusakan" id="jenis_kerusakan" value="1">

            <div class="col-12 btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn bg-warning active" id="rusak_sebagian">
                <input type="radio" name="rusak_sebagian" autocomplete="off" checked=""> Link Rusak Sebagian
              </label>
              <label class="btn bg-danger" id="rusak_semua">
                <input type="radio" name="rusak_semua" autocomplete="off"> Link Rusak Semua
              </label>
            </div>
            <button class="text-center mt-3 btn btn-default bg-light form-control" type="submit">Submit<i class="fas ml-3 fa-arrow-right text-muted"></i></button>

          <!-- /.lockscreen credentials -->
          
        </form>

        </div>
        <!-- /.lockscreen-item -->
    <?php endif ?>


</div>