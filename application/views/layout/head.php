<!DOCTYPE html>
<html lang="en" data-app-path="<?= base_url() ?>">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="habibubebo">
  <link href="<?= base_url("asset/img/logo/logo.png") ?>" rel="icon">
  <?php
  $__slug = $this->uri->segment(2) ?: ($this->uri->segment(1) ?: 'dashboard');
  $__titles = ['dashboard' => 'Dashboard', 'utama' => 'Profil', 'akun' => 'Pengaturan Akun', 'lembaga' => 'Profil Lembaga', 'lembaga_edit' => 'Edit Profil', 'sapras' => 'Sarana & Prasarana', 'pegawai' => 'Pegawai', 'instruktur' => 'Instruktur', 'rombel' => 'Program', 'uk' => 'Unit Kompetensi', 'peserta' => 'Peserta', 'peserta2' => 'Peserta', 'lulusan' => 'Lulusan', 'presensi' => 'Presensi', 'log' => 'Log Aktivitas'];
  $__title = $__titles[$__slug] ?? ucfirst($__slug);
  ?>
  <title><?= html_escape($__title . ' - ' . $this->session->userdata('nama')) ?></title>
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
  <meta name="apple-mobile-web-app-status-bar" content="#2563eb" />
  <meta name="theme-color" content="#2563eb" />
  <style>
    :root{ --pill-bg:#ffffff; --pill-border:#eef0f4; --pill-shadow:0 8px 32px rgba(15,23,42,.14),0 2px 8px rgba(15,23,42,.06); --pill-active:#2563eb; --pill-active-text:#ffffff; --accent:#f59e0b; --page-bg:#f8fafc; }
    html{scroll-behavior:smooth}
    body{background:var(--page-bg); -webkit-font-smoothing:antialiased; text-rendering:optimizeLegibility}
    #wrapper #content-wrapper{background:var(--page-bg)}
    .container-fluid{max-width:1280px}
    @media(max-width:767.98px){ .container-fluid{padding-left:1rem;padding-right:1rem} }
  </style>
</head>
<script src="<?= base_url("asset/vendor/jquery/jquery.min.js") ?>"></script>
<script>
  appPath = document.documentElement.getAttribute("data-app-path")
</script>
<div class="preloader">
  <div class="loading">
    <div class="loading-logo"><img src="<?= base_url("asset/img/logo/logo.png") ?>" alt="Logo"></div>
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
    -webkit-backdrop-filter: blur(6px);
    backdrop-filter: blur(6px);
  }
  .preloader.fade {
    opacity: 0;
    pointer-events: none;
  }
  .loading {
    text-align: center;
  }
  .loading-logo {
    width: 5rem;
    height: 5rem;
    margin: 0 auto;
    border-radius: 50%;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 32px rgba(37,99,235,.18), 0 2px 8px rgba(15,23,42,.08);
    position: relative;
  }
  .loading-logo::after {
    content: "";
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    border: 3px solid rgba(37,99,235,.12);
    border-top-color: #2563eb;
    border-right-color: #2563eb;
    animation: loading-spin .8s linear infinite;
  }
  .loading-logo img {
    width: 60%;
    height: 60%;
    object-fit: contain;
    animation: loading-logo-pulse 1.6s ease-in-out infinite;
  }
  .loading-text {
    margin-top: 1rem;
    font: 14px/1.5 system-ui,-apple-system,sans-serif;
    color: #6c757d;
    letter-spacing: .02em;
  }
  @keyframes loading-spin {
    to { -webkit-transform: rotate(360deg);
         transform: rotate(360deg); }
  }
  @keyframes loading-logo-pulse {
    0%, 100% { -webkit-transform: scale(1);
               transform: scale(1); }
    50% { -webkit-transform: scale(1.06);
          transform: scale(1.06); }
  }
  @media (prefers-reduced-motion: reduce) {
    .loading-logo::after,
    .loading-logo img { animation: none; }
  }
</style>

<body id="page-top">
  <div id="wrapper">