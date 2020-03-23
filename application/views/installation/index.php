
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Koreksubs Makina | Installation</title>
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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Koreksubs </b>Makina
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <div class="col-12">
        <img style="margin-left: 45%; margin-right: 50%; transform: translate(-50px);" width="150px" src="<?= base_url('assets/dist/img/ori_logo.png') ?>">
      </div>
      <p class="login-box-msg">Selamat datang di halaman instalasi KM, sebuah aplikasi CMS khusus untuk konten anime.</p>
      <div class="social-auth-links text-center mb-3">
        <a href="<?= base_url('installation/configuration/'); ?>" class="btn btn-block btn-primary">
          <i class="fa fa-hdd mr-2"></i> Install now
        </a>
        <a href="#youtube" class="btn btn-block btn-danger">
          <i class="fa fa-eye mr-2"></i> Watch demo (coming soon)
        </a>
      </div>

     <!--  <p class="mb-1">
        <a href="forgot-password.html">Documentation in Indonesian language</a>
      </p> -->
      <p class="mb-1 text-center">
         2020 &copy; Koreksubs Makina
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

<!-- if error -->
<?php if( $this->session->flashdata('db_error') ) : ?>
  <script type="text/javascript">
    swal.fire({
      title: "There was an error!",
      icon: "error",
      html: "Sorry, probably the database name you inputed was wrong. Please try to install again.",
      confirmButtonText: "OK!",
    });
  </script>  
<?php endif; ?>
<!-- ./only redirect to base url when status flash data is 'success' -->
</body>
</html>
<?php  ?>