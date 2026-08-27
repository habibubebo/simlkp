<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="description" content="Sistem Informasi Manajemen Lembaga Kursus Pelatihan Cendekia Utama Kota Blitar">
  <meta name="author" content="">
  <title>LKP Cendekia Utama - Login</title>
  <link rel="manifest" href="<?= base_url() ?>manifest.json" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-72x72.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-96x96.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-128x128.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-144x144.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-152x152.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-192x192.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-384x384.png" />
  <link rel="apple-touch-icon" href="<?= base_url() ?>/icons/icon-512x512.png" />
  <meta name="apple-mobile-web-app-status-bar" content="#f6f7fa" />
  <meta name="theme-color" content="#f6f7fa" />
  <link href="<?= base_url("asset/vendor/fontawesome-free/css/all.min.css") ?>" rel="stylesheet" type="text/css">
  <style>
    :root {
      --brand: #4e73df;
      --brand-strong: #3d55c8;
      --brand-deep: #224abe;
      --ink: #1f2340;
      --muted: #6b7194;
      --line: #e3e5ef;
      --field: #f3f4f9;
      --bg: #f6f7fa;
      --card: #ffffff;
      --danger-bg: #fdecec;
      --danger-text: #b02a37;
      --radius-field: 14px;
      --radius-card: 20px;
      --radius-hero: 28px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      -webkit-text-size-adjust: 100%;
    }

    * img {
      max-width: 100%;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background: var(--bg);
      color: var(--ink);
      line-height: 1.5;
      padding-bottom: env(safe-area-inset-bottom);
    }

    .login-shell {
      min-height: 100vh;
      min-height: 100dvh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: clamp(20px, 5vw, 32px);
      padding-top: max(clamp(20px, 5vw, 32px), env(safe-area-inset-top));
    }

    .form-side {
      width: 100%;
      max-width: 400px;
      margin: auto 0;
      display: flex;
      flex-direction: column;
      align-items: stretch;
    }

    .brand-desktop {
      display: none;
    }

    .brand-mobile {
      text-align: center;
      margin-bottom: 20px;
      animation: rise .5s cubic-bezier(.16, 1, .3, 1) both;
    }

    .brand-mobile img {
      height: 52px;
      width: auto;
      display: inline-block;
    }

    /* Card */
    .login-card {
      width: 100%;
      max-width: 400px;
      background: var(--card);
      border: 1px solid var(--line);
      border-radius: var(--radius-card);
      box-shadow: 0 12px 32px rgba(31, 35, 64, .07), 0 2px 8px rgba(31, 35, 64, .04);
      padding: clamp(24px, 6vw, 32px);
      animation: rise .5s cubic-bezier(.16, 1, .3, 1) .08s both;
    }

    .login-head {
      margin-bottom: 22px;
    }

    .login-head h1 {
      font-size: 1.35rem;
      font-weight: 700;
      letter-spacing: -.01em;
      color: var(--ink);
    }

    .login-head p {
      font-size: .875rem;
      color: var(--muted);
      margin-top: 2px;
    }

    /* Alert */
    .alert-login {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      background: var(--danger-bg);
      color: var(--danger-text);
      border-radius: 12px;
      padding: 11px 14px;
      font-size: .85rem;
      margin-bottom: 18px;
      animation: shake .45s cubic-bezier(.36, .07, .19, .97) both;
    }

    .alert-login i {
      margin-top: 2px;
    }

    /* Form */
    .field {
      margin-bottom: 16px;
    }

    .field label {
      display: block;
      font-size: .82rem;
      font-weight: 600;
      color: var(--ink);
      margin-bottom: 7px;
    }

    .input-wrap {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-wrap>i {
      position: absolute;
      left: 15px;
      font-size: .9rem;
      color: #9aa0b5;
      pointer-events: none;
      transition: color .2s ease;
    }

    .input-wrap input {
      width: 100%;
      height: 50px;
      background: var(--field);
      border: 1.5px solid transparent;
      border-radius: var(--radius-field);
      padding: 0 46px 0 42px;
      font-size: 16px;
      font-family: inherit;
      color: var(--ink);
      outline: none;
      transition: border-color .2s ease, background-color .2s ease, box-shadow .2s ease;
    }

    .input-wrap input::placeholder {
      color: #9aa0b5;
    }

    .input-wrap input:focus {
      background: #fff;
      border-color: var(--brand);
      box-shadow: 0 0 0 4px rgba(78, 115, 223, .14);
    }

    .input-wrap input:focus~i,
    .input-wrap:focus-within>i {
      color: var(--brand);
    }

    .toggle-pass {
      position: absolute;
      right: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      border: none;
      border-radius: 10px;
      background: transparent;
      color: #9aa0b5;
      cursor: pointer;
      transition: color .2s ease, background-color .2s ease;
    }

    .toggle-pass:hover {
      color: var(--brand);
      background: rgba(78, 115, 223, .08);
    }

    .form-meta {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 4px 0 20px;
    }

    .remember {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: .85rem;
      color: var(--muted);
      cursor: pointer;
      user-select: none;
    }

    .remember input {
      width: 17px;
      height: 17px;
      accent-color: var(--brand);
      cursor: pointer;
    }

    /* Button */
    .btn-submit {
      width: 100%;
      height: 52px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 9px;
      background: var(--brand-strong);
      color: #fff;
      border: none;
      border-radius: var(--radius-field);
      font-family: inherit;
      font-size: .95rem;
      font-weight: 600;
      letter-spacing: .01em;
      cursor: pointer;
      transition: background-color .2s ease, transform .12s ease, box-shadow .2s ease;
    }

    .btn-submit:hover {
      background: #3449b2;
      box-shadow: 0 8px 20px rgba(61, 85, 200, .28);
    }

    .btn-submit:active {
      transform: scale(.98);
    }

    .btn-submit:focus-visible {
      outline: 3px solid rgba(78, 115, 223, .45);
      outline-offset: 2px;
    }

    .btn-submit.is-loading {
      pointer-events: none;
      opacity: .85;
    }

    .spin {
      width: 15px;
      height: 15px;
      border: 2px solid rgba(255, 255, 255, .35);
      border-top-color: #fff;
      border-radius: 50%;
      animation: rotate .7s linear infinite;
    }

    .login-foot {
      margin-top: 24px;
      text-align: center;
      font-size: .75rem;
      color: var(--muted);
      animation: rise .5s cubic-bezier(.16, 1, .3, 1) .16s both;
    }

    /* Hero panel (desktop only) */
    .hero-panel {
      display: none;
    }

    @keyframes rise {
      from {
        opacity: 0;
        transform: translateY(18px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes shake {

      10%,
      90% {
        transform: translateX(-1px);
      }

      20%,
      80% {
        transform: translateX(2px);
      }

      30%,
      50%,
      70% {
        transform: translateX(-3px);
      }

      40%,
      60% {
        transform: translateX(3px);
      }
    }

    @keyframes rotate {
      to {
        transform: rotate(360deg);
      }
    }

    /* Desktop */
    @media (min-width: 992px) {
      .login-shell {
        display: grid;
        grid-template-columns: minmax(0, 1.15fr) minmax(0, 1fr);
        padding: 20px;
        gap: 24px;
        align-items: stretch;
      }

      .brand-mobile {
        display: none;
      }

      .form-side {
        max-width: none;
        margin: 0;
        position: relative;
        justify-content: center;
        align-items: center;
      }

      .brand-desktop {
        display: flex;
        position: absolute;
        top: 0;
        left: 8px;
        align-items: center;
        gap: 11px;
      }

      .brand-desktop img {
        height: 40px;
        width: auto;
      }

      .brand-desktop span {
        font-size: .95rem;
        font-weight: 700;
        color: var(--ink);
        letter-spacing: -.01em;
      }

      .login-card {
        animation: rise .55s cubic-bezier(.16, 1, .3, 1) .05s both;
      }

      .hero-panel {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: var(--radius-hero);
        background: linear-gradient(150deg, var(--brand) 0%, var(--brand-deep) 78%);
        padding: 48px;
        animation: rise .55s cubic-bezier(.16, 1, .3, 1) .1s both;
      }

      .hero-panel::before,
      .hero-panel::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
      }

      .hero-panel::before {
        width: 480px;
        height: 480px;
        top: -180px;
        right: -140px;
        background: radial-gradient(circle at center, rgba(255, 255, 255, .12) 0%, rgba(255, 255, 255, 0) 68%);
      }

      .hero-panel::after {
        width: 420px;
        height: 420px;
        bottom: -170px;
        left: -120px;
        background: radial-gradient(circle at center, rgba(255, 255, 255, .09) 0%, rgba(255, 255, 255, 0) 68%);
      }

      .hero-inner {
        position: relative;
        text-align: center;
        color: #fff;
        max-width: 380px;
      }

      .hero-inner img {
        height: 76px;
        width: auto;
        filter: brightness(0) invert(1);
        margin-bottom: 26px;
      }

      .hero-inner h2 {
        font-size: 1.65rem;
        font-weight: 700;
        letter-spacing: -.015em;
        line-height: 1.25;
        margin-bottom: 12px;
      }

      .hero-inner p {
        font-size: .95rem;
        color: rgba(255, 255, 255, .82);
        margin-bottom: 28px;
      }

      .hero-chips {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
      }

      .chip {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(255, 255, 255, .13);
        border: 1px solid rgba(255, 255, 255, .22);
        color: #fff;
        border-radius: 999px;
        padding: 9px 18px;
        font-size: .8rem;
        font-weight: 500;
      }
    }

    @media (prefers-reduced-motion: reduce) {

      .brand-mobile,
      .login-card,
      .login-foot,
      .alert-login,
      .hero-panel,
      .form-side .login-card {
        animation: none;
      }

      * {
        transition-duration: .01ms !important;
      }
    }
  </style>
</head>

<body>
  <main class="login-shell">
    <section class="form-side">
      <div class="brand-desktop">
        <img src="<?= base_url("asset/img/logo/logo.png") ?>" alt="LKP Cendekia Utama">
      
      </div>

      <div class="brand-mobile">
        <img src="<?= base_url("asset/img/logo/logo.png") ?>" alt="LKP Cendekia Utama">
      </div>

      <div class="login-card">
        <div class="login-head">
          <h1>Selamat Datang</h1>
          <p>Silakan masuk ke akun Anda</p>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
          <div class="alert-login" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <span><?= $this->session->flashdata('error') ?></span>
          </div>
        <?php endif; ?>

        <form action="<?= base_url("login/auth") ?>" method="POST" id="form-login">
          <input type="hidden" name="is_pwa" id="isPwa" value="">

          <div class="field">
            <label for="inputUser">Username</label>
            <div class="input-wrap">
              <input type="text" name="user" id="inputUser" placeholder="Masukkan username" autocomplete="username" required autofocus>
              <i class="fas fa-user"></i>
            </div>
          </div>

          <div class="field">
            <label for="inputPassword">Password</label>
            <div class="input-wrap">
              <input type="password" name="pass" id="inputPassword" placeholder="Masukkan password" autocomplete="current-password" required>
              <i class="fas fa-lock"></i>
              <button type="button" class="toggle-pass" id="togglePassword" aria-label="Tampilkan password">
                <i class="fas fa-eye" id="toggleIcon"></i>
              </button>
            </div>
          </div>

          <div class="form-meta">
            <label class="remember" for="rememberCheck">
              <input type="checkbox" id="rememberCheck">
              Ingat saya
            </label>
          </div>

          <button type="submit" class="btn-submit" id="btnLogin">Masuk</button>
        </form>
      </div>

      <p class="login-foot">
        Sistem Informasi Manajemen<br>
        Lembaga Kursus Pelatihan Cendekia Utama Kota Blitar
      </p>
    </section>

    <aside class="hero-panel" aria-hidden="true">
      <div class="hero-inner">
        <img src="<?= base_url("asset/img/logo/logo.png") ?>" alt="">
        <h2>Kursus &amp; Pelatihan Bersertifikat</h2>
        <p>Pusat Pelatihan dan Kursus Terpercaya di Kota Blitar</p>
        <div class="hero-chips">
          <span class="chip"><i class="fas fa-certificate"></i> Terakreditasi</span>
          <span class="chip"><i class="fas fa-users"></i> Profesional</span>
        </div>
      </div>
    </aside>
  </main>

  <script>
    (function() {
      var toggle = document.getElementById('togglePassword');
      var pwd = document.getElementById('inputPassword');
      var icon = document.getElementById('toggleIcon');

      toggle.addEventListener('click', function() {
        var show = pwd.type === 'password';
        pwd.type = show ? 'text' : 'password';
        icon.classList.toggle('fa-eye', !show);
        icon.classList.toggle('fa-eye-slash', show);
        toggle.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
      });

      var form = document.getElementById('form-login');
      var btn = document.getElementById('btnLogin');
      form.addEventListener('submit', function() {
        btn.classList.add('is-loading');
        btn.disabled = true;
        btn.innerHTML = '<span class="spin" aria-hidden="true"></span> Memproses...';
      });

      if (window.matchMedia('(display-mode: standalone)').matches) {
        document.getElementById('isPwa').value = '1';
      }
    })();
  </script>
</body>

</html>
