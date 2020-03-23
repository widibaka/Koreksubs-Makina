
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Chocolate link safer</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--     Favicon     -->  
  <link rel="icon" type="image/png" href="<?= base_url('assets/dist/img/ori_logo.png') ?>">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <b>Arigatou!</b>
  </div>

  <div class="text-center">
  <img src="<?= base_url('assets/img/chocolate_shiawase.png'); ?>">
  </div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">

    <!-- lockscreen credentials (contains the form) -->
      <div class="input-group">
        <a href="<?= $link; ?>" class="text-center btn bg-light form-control">Menuju link</a>

        <div class="input-group-append">
          <button type="button" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Silakan klik tombol di atas untuk menuju link.
  </div>
  <div class="lockscreen-footer text-center">
    Software developed by <b><a href="http://github.com/widibaka" class="text-black">Koreksubs</a></b> <br>2018-2020. 
    All rights reserved
  </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
