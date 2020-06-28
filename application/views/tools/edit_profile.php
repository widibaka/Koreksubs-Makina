

        <div class="row">
          <div class="col-md-3">
<form action="<?php echo base_url('client/upload.asp') ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <!-- Profile Image -->
            <div class="card card-<?= $theme['accent_color'] ?> card-outline">
              <div class="card-body box-profile">
                <p>Upload gambar profil. <br>
                <small>Hanya boleh .jpg .jpeg dan .png saja</small></p>
                <div class="mb-3">
                  <input type="file" name="profile_pic" size="20" class="form-control" id="customFile" style="width: 100%; padding: 3px">
                  <!-- <label class="custom-file-label" for="customFile">Pilih berkas</label> -->
                </div>
                <div class="text-center">
                  <div class="img-circle img-bordered mr-auto ml-auto" style="background: url('<?= base_url(); ?>assets/img/<?php 
                  $user_id = $this->session->userdata("user_id");
                  $userdata = $this->User_model->getUserDataById( $user_id )[0];
                  echo $userdata['photo'];
                ?>') center; width: 180px; height: 180px; background-size: cover;">
                  </div>
                </div>

                <h3 class="profile-username text-center"><?php echo $userdata['username'] ?></h3>

                <p class="text-muted text-center">Nomor ID: <?php echo $this->session->userdata("user_id") ?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-3">
            <!-- About Me Box -->
            <div class="card card-<?= $theme['accent_color'] ?>">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Lokasi</strong>

                <p class="text-muted"><input type="text" class="form-control" name="kota_asal" value="<?php echo $userdata['kota_asal'] ?>"></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger"><input type="text" class="form-control" name="skills" value="<?php echo $userdata['skills'] ?>"></span>
                </p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- Profile Image -->
            <div class="card card-<?= $theme['accent_color'] ?> card-outline">
              <div class="card-body box-profile">

                <ul class="list-group list-group-unbordered mb-3">
                    <button type="submit" class="btn btn-primary" style="width: 100%" >Save Profile</button>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</form>
          </div>
          <!-- /.col -->
        </div>
<script type="text/javascript">
  $(document).ready(function(){
$('#konfirmasi_hapus_akun').hide()
      $('#hapus_akun').on('click',function(){
        $('#konfirmasi_hapus_akun').show('slow')
      })
      $('#tidak_jadi_hapus').on('click',function(){
        $('#konfirmasi_hapus_akun').hide('slow')
      })

  })
</script>