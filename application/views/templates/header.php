<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php if ( $this->User_model->getMessageUnreadYet() > 0):  echo "(" . $this->User_model->getMessageUnreadYet() . ") "; ?><?php endif ?><?= $fansub_preferences['fansub_name']; ?> | <?= $page_title; ?></title>
  <meta content='Fansub & Fanshare Anime Sub Indo' name='description'/>
  <meta content='Fansub & Fanshare Anime Sub Indo' name='keywords'/> 
  <meta content="anime, subtitle, indonesia, sub indo, jepang" name="keywords"/>
  <meta content="index follow" name="robots"/>
  <!--     Favicon     -->  
  <link rel="icon" type="image/png" href="<?= base_url('assets/dist/img/ori_logo.png') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- Widi Custom CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>widi_custom/custom.widibaka.css?ver.8.1.1">


  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" id="content_header" marker="<?= $page; ?>"><?= $page_title; ?></h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><?= $page_title ?></li>
              <li class="breadcrumb-item active">Inline Charts</li>
            </ol>
          </div> -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div id="content">