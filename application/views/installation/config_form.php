
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Koreksubs Makina | Installation</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

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
      <p class="login-box-msg">Set your configuration</p>

      <form action="" method="get">
        <div class="input-group mb-3">
          <p class="text-muted text-sm col-12">Host <font color="red">*</font></p>
          <input type="text" class="form-control" placeholder="Host..." autofocus value="localhost" autocomplete="off" name="db_host">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-home"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <p class="text-muted text-sm col-12">DB Username <font color="red">*</font></p>
          <input type="text" class="form-control" placeholder="DB Username..." autocomplete="off"  value="" name="db_username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <p class="text-muted text-sm col-12">DB Password</p>
          <input type="password" class="form-control" placeholder="DB Password..." autocomplete="off" value="" name="db_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <p class="text-muted text-sm col-12">Database name <font color="red">*</font></p>
          <input type="text" class="form-control" placeholder="Database name..." autocomplete="off" value="" name="db_name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-database"></span>
            </div>
          </div>
        </div>
        <font color="red"><p class="text-muted text-sm col-12">Anda juga dapat melakukan konfigurasi secara manual di directory <code>/config/config.php</code>.</p></font>
        <font color="red"><p class="text-muted text-sm col-12">Query SQL untuk Table dapat Anda install manual di <code>/config/install.sql</code>.</p></font>
        <div class="row mt-5">
          <div class="col-12">
            <button onclick="installing_alert();" class="btn btn-primary btn-block float-right ">Install</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1 mt-4 text-center">
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
<!-- only redirect to base url when status flash data is 'success' -->
  <?php if( $this->session->flashdata('flash') == 'success' ) : ?>
    <script type="text/javascript">
      var link = "<?= base_url(); ?>";
      swal.fire({
        title: "<?= $this->session->flashdata('title'); ?>",
        icon: "<?= $this->session->flashdata('flash'); ?>",
        confirmButtonText: "OK!",
      })
      .then((result) => {
        //only redirect to base url when status flash data is 'success'
        if (result.value) {
          location.href=link;
        }
      });
    </script>  
  <?php endif; ?>
<!-- if error -->
  <?php if( $this->session->flashdata('flash') == 'error' ) : ?>
    <script type="text/javascript">
      swal.fire({
        title: "<?= $this->session->flashdata('title'); ?>",
        icon: "<?= $this->session->flashdata('flash'); ?>",
        confirmButtonText: "OK!",
      });
    </script>  
  <?php endif; ?>
<!-- ./only redirect to base url when status flash data is 'success' -->

  <script type="text/javascript">
      function installing_alert()
      {
        Swal.fire({
          title: 'Installing Koreksubs Makina',
          html: 'It may takes several times...',
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading()
          },
          onClose: () => {
            clearInterval(timerInterval)
          }
        });
      }

      
  </script>

</body>
</html>
