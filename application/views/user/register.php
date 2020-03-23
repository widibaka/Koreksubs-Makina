
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $fansub_preferences['fansub_name'] ?> | Registrasi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--     Favicon     -->  
  <link rel="icon" type="image/png" href="<?= base_url('assets/dist/img/ori_logo.png') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?= base_url() ?>"><b><?= $fansub_preferences['fansub_name'] ?></b> Registrasi</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password_verify" class="form-control" placeholder="Retype password" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <p>Opsional:</p>
        <div class="input-group mb-3">
          <input type="text" name="kota_asal" class="form-control" placeholder="Kota asal" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-map-marker-alt"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text"  name="skills" class="form-control" placeholder="Skills, pisahkan dengan koma" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-pencil-alt "></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- Atau -</p>
        <a href="<?php echo base_url('user/login.asp') ?>" class="btn btn-block btn-danger">
          <i class="fab fa-google mr-2"></i> Login dengan Akun Google
        </a>
      </div>

      <a href="<?php echo base_url('user/login') ?>" class="text-center">Saya sudah punya akun</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2@9.js"></script>

<script type="text/javascript">
    //Initialize Select2 Elements
    $('.select2').select2()
</script>
<?php 
    if ($this->session->flashdata('register')=='error') {
      echo '
      <script type="text/javascript">
        swal.fire({
          title: "Unable to register. Please try again.",
          icon: "error",
          confirmButtonText: "OK",
        });
      </script> 
      ';
    }
    if ($this->session->flashdata('register')=='username_taken') {
      echo '
      <script type="text/javascript">
        swal.fire({
          title: "Username has already taken. Please use another one.",
          icon: "error",
          confirmButtonText: "OK",
        });
      </script> 
      ';
    }
    if ($this->session->flashdata('register')=='username_tooshort') {
      echo '
      <script type="text/javascript">
        swal.fire({
          title: "Username terlalu pendek. Coba yang agak panjang",
          icon: "error",
          confirmButtonText: "OK",
        });
      </script> 
      ';
    }
?>
</body>
</html>
