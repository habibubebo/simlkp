<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistem Informasi Manajemen Lembaga Kursus Pelatihan Cendekia Utama Kota Blitar">
  <meta name="author" content="">
  <title>LKP Cendekia Utama - Login</title>
  <link href="<?= base_url("asset/vendor/fontawesome-free/css/all.min.css") ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url("asset/vendor/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url("asset/css/ruang-admin.css") ?>?v=<?= filemtime(FCPATH . 'asset/css/ruang-admin.css') ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="manifest" href="<?= base_url() ?>manifest.json" />
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
<style>
  .btn-loading {
    pointer-events: none;
    opacity: 0.8;
  }
  .alert-login {
    border-radius: 0.5rem;
    font-size: 0.875rem;
  }

  .login-split {
    min-height: 100vh;
  }

  .login-left {
    background: #fff;
    padding: 2rem;
  }

  .login-left .login-form-wrapper {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
  }

  .login-left .login-form-wrapper .login-form {
    padding: 0 !important;
  }

  .login-right {
    position: relative;
    background: url('https://images.unsplash.com/photo-1523050854058-8df90110c7f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80') center center / cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .login-right .login-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(78, 115, 223, 0.85) 0%, rgba(90, 92, 105, 0.85) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
  }

  .login-right .login-overlay-content {
    text-align: center;
    color: #fff;
    animation: fadeInUp 1s ease;
  }

  .login-right .login-overlay-content img {
    max-width: 180px;
    margin-bottom: 1.5rem;
    filter: brightness(0) invert(1);
  }

  .login-right .login-overlay-content p {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 2rem;
  }

  .form-group .input-group {
    border-radius: 0.5rem;
    overflow: hidden;
    border: 1px solid #d1d3e2;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .form-group .input-group:focus-within {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
  }

  .form-group .input-group .input-group-prepend,
  .form-group .input-group .input-group-append {
    margin: 0;
  }

  .form-group .input-group .input-group-text {
    border: none;
    background: #f8f9fc;
    color: #858796;
    padding: 0.5rem 0.75rem;
  }

  .form-group .input-group .form-control {
    border: none;
    background: #fff;
    padding-left: 0.75rem;
    height: 2.75rem;
    font-size: 0.875rem;
    box-shadow: none !important;
  }

  .form-group .input-group .form-control::placeholder {
    color: #b0b3c1;
  }

  .form-group .input-group .form-control:focus {
    box-shadow: none !important;
  }

  .form-group .input-group .input-group-append .input-group-text {
    cursor: pointer;
    transition: color 0.2s ease;
  }

  .form-group .input-group .input-group-append .input-group-text:hover {
    color: #4e73df !important;
  }

  @media (max-width: 991.98px) {
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
    }

    .login-left {
      padding: 0;
      background: transparent;
    }

    .login-left .login-form-wrapper {
      max-width: 100%;
      padding: 0 1rem;
    }

    .login-left .login-form-wrapper .login-form {
      padding: 2.5rem 2rem !important;
      background: #fff;
      border-radius: 1rem;
      box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
    }
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>
</head>

<body>
  <div class="container-fluid p-0">
    <div class="row no-gutters login-split">
      <div class="col-lg-6 d-flex align-items-center justify-content-center login-left order-2 order-lg-1">
        <div class="login-form-wrapper animate__animated animate__fadeInLeft">
          <div class="login-form">
            <div class="text-center mb-4">
              <img src="<?= base_url("asset/img/logo/logo.png") ?>" class="mb-3 d-lg-none" width="50%" alt="LKP Cendekia Utama">
              <h5 class="text-gray-900 font-weight-bold mb-1">Selamat Datang</h5>
              <p class="text-muted small mb-0">Silakan masuk ke akun Anda</p>
            </div>

            <?php if ($this->session->flashdata('error')): ?>
              <div class="alert alert-danger alert-login animate__animated animate__shakeX" role="alert">
                <i class="fas fa-exclamation-circle mr-1"></i> <?= $this->session->flashdata('error') ?>
              </div>
            <?php endif; ?>

            <form class="user" action="<?= base_url("login/auth") ?>" method="POST" id="form-login">
              <input type="hidden" name="is_pwa" id="isPwa" value="">
              <div class="form-group">
                <label for="inputUser" class="small font-weight-bold">Username</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" name="user" class="form-control" id="inputUser" placeholder="Masukkan username" required autofocus>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword" class="small font-weight-bold">Password</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  </div>
                  <input type="password" name="pass" class="form-control border-0" id="inputPassword" placeholder="Masukkan password" required>
                  <div class="input-group-append">
                    <span class="input-group-text" id="togglePassword">
                      <i class="fas fa-eye" id="toggleIcon"></i>
                    </span>
                  </div>
                </div>
              </div>

              <div class="form-group d-flex justify-content-between align-items-center mb-4">
                <div class="custom-control custom-checkbox small">
                  <input type="checkbox" class="custom-control-input" id="rememberCheck">
                  <label class="custom-control-label text-gray-600" for="rememberCheck">Ingat saya</label>
                </div>
              </div>

              <button type="submit" class="btn btn-primary btn-user btn-block" id="btnLogin">
                Masuk
              </button>
            </form>

            <hr class="mt-4">
            <div class="text-center">
              <small class="text-muted">
                Sistem Informasi Manajemen<br>
                Lembaga Kursus Pelatihan Cendekia Utama Kota Blitar
              </small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 d-none d-lg-flex login-right order-1 order-lg-2">
        <div class="login-overlay">
          <div class="login-overlay-content">
            <img src="<?= base_url("asset/img/logo/logo.png") ?>" alt="LKP Cendekia Utama">
            <p>Pusat Pelatihan dan Kursus Terpercaya di Kota Blitar</p>
            <div class="d-flex justify-content-center">
              <span class="badge badge-light mr-2 px-3 py-2"><i class="fas fa-certificate mr-1"></i> Terakreditasi</span>
              <span class="badge badge-light px-3 py-2"><i class="fas fa-users mr-1"></i> Profesional</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url("asset/vendor/jquery/jquery.min.js") ?>"></script>
  <script src="<?= base_url("asset/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
  <script src="<?= base_url("asset/vendor/jquery-easing/jquery.easing.min.js") ?>"></script>
  <script src="<?= base_url("asset/js/ruang-admin.min.js") ?>"></script>
  <script>
    $(document).ready(function() {
      $('#togglePassword').on('click', function() {
        const passwordInput = $('#inputPassword');
        const icon = $('#toggleIcon');
        const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
        passwordInput.attr('type', type);
        icon.toggleClass('fa-eye fa-eye-slash');
      });

      $('#form-login').on('submit', function() {
        const btn = $('#btnLogin');
        btn.addClass('btn-loading').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Memproses...');
      });

      var isPwa = window.matchMedia('(display-mode: standalone)').matches;
      if (isPwa) {
        $('#isPwa').val('1');
      }
    });
  </script>
</body>

</html>
