<!DOCTYPE html>
<html lang="en" data-app-path="<?= base_url() ?>">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="habibubebo">
  <link href="<?= base_url("asset/img/logo/logo.png") ?>" rel="icon">
  <title><?= 'Dashboard - ' . $this->session->userdata('nama') ?></title>
  <link href="<?= base_url("asset/vendor/fontawesome-free/css/all.min.css") ?>" rel="stylesheet" type="text/css">
  <!-- <link href="<?= base_url("asset/vendor/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css"> -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link href="<?= base_url("asset/css/ruang-admin.css") ?>?v=<?= filemtime(FCPATH . 'asset/css/ruang-admin.css') ?>" rel="stylesheet">
  <link href="https://cdn.datatables.net/v/dt/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/r-3.0.2/datatables.min.css" rel="stylesheet">
  <link href="<?= base_url("asset/vendor/datatables/jquery.dataTables.min.css") ?>" rel="stylesheet">
  <link href="<?= base_url("asset/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css") ?>" rel="stylesheet">
  <link href="<?= base_url("asset/vendor/select2/dist/css/select2.min.css") ?>?v=<?= filemtime(FCPATH . 'asset/vendor/select2/dist/css/select2.min.css') ?>" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> -->
  <link rel="manifest" href="/manifest.json" />
  <!-- ios support -->
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-72x72.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-96x96.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-128x128.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-144x144.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-152x152.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-192x192.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-384x384.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-512x512.png" />
  <meta name="apple-mobile-web-app-status-bar" content="#000000" />
  <meta name="theme-color" content="#000000" />
</head>
<script src="<?= base_url("asset/vendor/jquery/jquery.min.js") ?>"></script>
<script>
  appPath = document.documentElement.getAttribute("data-app-path")
</script>
<div class="preloader">
  <div class="loading">
    <div class="spinner-grow text-warning" role="status"></div>
    <div class="loading-text">Memuat...</div>
  </div>
</div>
<style type="text/css">
  .preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: rgba(255,255,255,.92);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: opacity .3s;
  }
  .preloader.fade {
    opacity: 0;
    pointer-events: none;
  }
  .loading {
    text-align: center;
  }
  .loading .spinner-grow {
    width: 3rem;
    height: 3rem;
  }
  .loading-text {
    margin-top: .75rem;
    font: 14px/1.5 system-ui,-apple-system,sans-serif;
    color: #6c757d;
    letter-spacing: .02em;
  }
</style>

<body id="page-top">
  <div id="wrapper">