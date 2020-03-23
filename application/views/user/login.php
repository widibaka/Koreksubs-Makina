
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $fansub_preferences['fansub_name'] ?> | Log in</title>
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
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url() ?>"><b><?= $fansub_preferences['fansub_name'] ?></b> Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login to start your session</p>

      <form action="" method="post">
        <small>Case sensitive, so be careful</small>
        <div class="input-group mb-3">
          <input type="text" class="form-control"  placeholder="Username..." name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control"  placeholder="Password..." name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- Atau -</p>
        <a href="<?php echo $auth_url ?>" class="btn btn-block btn-danger">
          <i class="fab fa-google mr-2"></i> Login dengan Akun Google
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="<?php echo base_url('user/forgot_password.asp') ?>">Saya lupa password</a>
      </p>
      <p class="mb-0">
        <a href="<?php echo base_url('user/register.asp') ?>" class="text-center">Mendaftar sebagai anggota baru</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2@9.js"></script>
<?php 
    if ($this->session->flashdata('register')=='success') {
      echo '
      <script type="text/javascript">
        swal.fire({
          title: "Registrasi Anda berhasil! Sekarang Anda bisa login",
          html: "Bagi yang login dengan Google, silakan lakukan login sekali lagi menggunakan akun yang sama",
          icon: "success",
          confirmButtonText: "OK",
          allowOutsideClick: false,
        });
      </script>
      ';
    }
    if ($this->session->flashdata('login')=='error') {
      echo '
      <script type="text/javascript">
        swal.fire({
          title: "Unable to login. Please try again.",
          icon: "error",
          confirmButtonText: "OK",
        });
      </script> 
      ';
    }
?>
</body>
</html>