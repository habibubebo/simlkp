    <div id="content">
      <!-- TopBar -->
      <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>
        <div class="mt-2 text-white">
          <?php
          foreach ($profil as $pr);
          ?>
          <h5><?= $pr->Namalkp ?></h5>
        </div>

        <!-- User Info -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">*</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Logs Center
                </h6>
                <?php
                foreach ($logs as $l) {
                ?>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
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
          <div class="topbar-divider d-none d-sm-block"></div>
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="img-profile rounded-circle" src="<?= base_url("asset/img/boy.png") ?>" style="max-width: 60px">
              <span class="ml-2 d-none d-lg-inline text-white small"><?= $this->session->userdata('nama') ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="<?= base_url("index.php/utama") ?>">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profil
              </a>
              <a class="dropdown-item" href="<?= base_url('index.php/utama/akun'); ?>">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Pengaturan akun
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