
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $fansub_preferences['fansub_name'] ?> | Lupa Password</title>
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
      <a href="<?= base_url() ?>"><b><?= $fansub_preferences['fansub_name'] ?></b> Forgot Password</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
      <div class="text-center">
        <?php if ( $this->session->flashdata('email_send')=='error' ): ?>
      <p class="login-box-msg">Sebelumnya mohon maaf, Tuan. <br>Tolong input email dulu.</p>
      <img src="<?= base_url('assets/img/chocolate_asetteru.png'); ?>">
        <?php else: ?>
      <p class="login-box-msg">Lupa password, Tuan? Sini biar Chocolate bantuin kirim ke email Tuan.</p>
      <img src="<?= base_url('assets/img/chocolate_shiawase.png'); ?>">
        <?php endif ?>
      </div>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email Anda...">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">I love Chocolate</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="<?php echo base_url('user/login.asp') ?>">Login</a>
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
<script type="text/javascript">
<?php 
    if ($this->session->flashdata('email_send')=='success') {
      echo '
        swal.fire({
          title: "Beres! Password berhasil dikirim.",
          icon: "success",
          confirmButtonText: "OK",
        });
      ';
    }
?>
<?php 
    if ($this->session->flashdata('email_send')=='error') {
      echo '
        swal.fire({
          title: "Mohon inputkan email Anda, Tuan. Pliiss..",
          icon: "error",
          confirmButtonText: "OK",
        });
      ';
    }
?>
</script> 
</body>
</html>
