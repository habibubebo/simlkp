    <style>
      .topbar.bg-navbar{background:var(--pill-active, #2563eb) !important;border-bottom:1px solid rgba(255,255,255,.10)}
      .topbar{position:sticky !important;top:0;z-index:1030;height:64px;box-shadow:0 4px 24px rgba(37,99,235,.12) !important}
      #content{padding-top:0}
      .topbar .navbar-nav .nav-link{height:64px}
      .topbar #sidebarToggleTop{color:#fff !important}
      .topbar .topbar-brand-mobile{display:flex;align-items:center;gap:.6rem;min-width:0}
      .topbar .topbar-logo{width:36px;height:36px;border-radius:1rem;background:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.12)}
      .topbar .topbar-logo img{width:100%;height:100%;object-fit:contain;padding:4px}
      .topbar .topbar-title{line-height:1.1;min-width:0}
      .topbar .topbar-title strong{display:block;font-size:.88rem;font-weight:800;color:#fff;letter-spacing:-.01em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:42vw}
      .topbar .topbar-title span{display:block;font-size:.68rem;color:rgba(255,255,255,.78);font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
      .topbar .nav-item .nav-link .badge-counter{background:var(--accent, #f59e0b) !important;color:#fff;border:2px solid #2563eb;font-weight:800}
      .topbar .dropdown-menu{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 12px 32px rgba(15,23,42,.12) !important;overflow:hidden}
      .topbar .img-profile{border:2px solid rgba(255,255,255,.9);box-shadow:0 2px 8px rgba(0,0,0,.12)}
      @media(max-width:767.98px){
        .topbar{position:fixed !important;top:8px;left:50%;transform:translateX(-50%);z-index:1030;height:56px;width:calc(100% - 16px);margin:0;border-radius:9999px;padding-left:.75rem !important;padding-right:.75rem !important;box-shadow:0 8px 32px rgba(15,23,42,.14),0 4px 12px rgba(37,99,235,.12) !important}
        .topbar .navbar-nav .nav-link{height:56px}
        #content{padding-top:72px}
        #container-wrapper{padding-top:.25rem}
      }
      @media(min-width:768px){
        .topbar .topbar-title strong{max-width:none}
      }
    </style>
    <div id="content">
      <!-- TopBar - modern -->
      <nav class="navbar navbar-expand navbar-light bg-navbar topbar static-top">
        <div class="topbar-brand-mobile">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-2 d-none d-md-inline-flex" style="color:#fff">
            <i class="fa fa-bars"></i>
          </button>
          <a href="<?= base_url('pages/dashboard') ?>" class="topbar-logo d-md-none" aria-label="Beranda">
            <img src="<?= base_url('asset/img/logo/logo.png') ?>" alt="Logo">
          </a>
          <div class="topbar-title">
            <?php foreach ($profil as $pr); ?>
            <strong class="d-none d-sm-block"><?= html_escape($pr->Namalkp) ?></strong>
            <strong id="pageMobile" class="d-block d-sm-none"></strong>
            <span class="d-none d-sm-block" style="opacity:.9">Sistem Informasi Manajemen</span>
            <span class="d-block d-sm-none" style="opacity:.85">SIM LKP</span>
          </div>
        </div>
        <!-- User Info -->
        <ul class="navbar-nav ml-auto align-items-center">
          <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">*</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header" style="background:var(--pill-active);border-color:var(--pill-active)">
                  Logs Center
                </h6>
                <?php
                foreach ($logs as $l) {
                ?>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle" style="background:var(--accent)">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"><?= "$l->log_tgl, <b>$l->log_user</b>" ?></div>
                    <?= "$l->log_desc" ?>
                  </div>
                </a>
              <?php }; ?>
                <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('index.php/pages/log'); ?>">Show All logs</a>
              </div>
            </li>
          <div class="topbar-divider d-none d-sm-block" style="border-color:rgba(255,255,255,.2)"></div>
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff">
              <img class="img-profile rounded-circle" src="<?= base_url("asset/img/boy.png") ?>" style="max-width:36px;max-height:36px">
              <span class="ml-2 d-none d-lg-inline text-white small" style="font-weight:700"><?= $this->session->userdata('nama') ?></span>
            </a>
            <?php
            $__ci =& get_instance();
            $__m = $__ci->router->fetch_method();
            $__c = $__ci->router->fetch_class();
            $__act = 'style="color:#2563eb;font-weight:700"';
            ?>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="max-height:70vh;overflow-y:auto">
              <a class="dropdown-item" href="<?= base_url("index.php/utama") ?>">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profil
              </a>
              <a class="dropdown-item" href="<?= base_url('index.php/utama/akun'); ?>">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Pengaturan akun
              </a>
              <div class="dropdown-divider d-md-none"></div>
              <div class="dropdown-header d-md-none" style="font-size:.65rem;letter-spacing:.07em;text-transform:uppercase;font-weight:800;color:#94a3b8">Menu</div>
              <a class="dropdown-item d-md-none" href="<?= base_url("pages/lembaga") ?>" <?= $__m == 'lembaga' ? $__act : '' ?>>
                <i class="fas fa-university fa-sm fa-fw mr-2 text-gray-400"></i>
                Lembaga
              </a>
              <a class="dropdown-item d-md-none" href="<?= base_url("pages/sapras") ?>" <?= $__m == 'sapras' ? $__act : '' ?>>
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Sarana Prasarana
              </a>
              <a class="dropdown-item d-md-none" href="<?= base_url("pages/pegawai") ?>" <?= $__m == 'pegawai' ? $__act : '' ?>>
                <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                Pegawai
              </a>
              <a class="dropdown-item d-md-none" href="<?= base_url("pages/instruktur") ?>" <?= $__m == 'instruktur' ? $__act : '' ?>>
                <i class="fas fa-chalkboard-teacher fa-sm fa-fw mr-2 text-gray-400"></i>
                Instruktur
              </a>
              <a class="dropdown-item d-md-none" href="<?= base_url("pages/uk") ?>" <?= $__m == 'uk' ? $__act : '' ?>>
                <i class="fas fa-archive fa-sm fa-fw mr-2 text-gray-400"></i>
                Unit Kompetensi
              </a>
              <a class="dropdown-item d-md-none" href="<?= base_url('Laporan/form'); ?>" <?= $__c == 'laporan' && $__m == 'form' ? $__act : '' ?>>
                <i class="fas fa-file fa-sm fa-fw mr-2 text-gray-400"></i>
                Formulir Pendaftaran
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?= base_url('index.php/login/logout'); ?>">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Keluar
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- Topbar -->
      <!-- Container Fluid-->
      <div class="container-fluid" id="container-wrapper">