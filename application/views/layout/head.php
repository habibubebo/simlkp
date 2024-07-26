<!DOCTYPE html>
<html lang="en">

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
  <link href="<?= base_url("asset/css/ruang-admin.min.css") ?>" rel="stylesheet">
  <link href="https://cdn.datatables.net/v/dt/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/r-3.0.2/datatables.min.css" rel="stylesheet">
  <link href="<?= base_url("asset/vendor/datatables/jquery.dataTables.min.css") ?>" rel="stylesheet">
  <link href="<?= base_url("asset/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css") ?>" rel="stylesheet">
</head>
<script src="<?= base_url("asset/vendor/jquery/jquery.min.js") ?>"></script>
<div class="preloader"> <div class="loading"> <div class="spinner-border text-warning" role="status"> <span class="sr-only">Loading...</span> </div> </div> </div>
<style type="text/css"> .preloader { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; background-color: #fff; opacity: 0.7} .loading { position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%); font: 14px arial; } </style>
<body id="page-top">
  <div id="wrapper">