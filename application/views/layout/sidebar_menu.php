    <style>
      /* Desktop sidebar - modern pill */
      .sidebar{border-right:1px solid #eef0f4}
      .sidebar .sidebar-brand{padding:1.25rem 1rem .9rem;background:#fff}
      .sidebar .sidebar-brand-icon img{height:38px;width:auto;object-fit:contain}
      .sidebar hr.sidebar-divider{margin:.5rem 1rem;border-top:1px solid #f1f5f9}
      .sidebar .sidebar-heading{padding:.9rem 1.1rem .4rem;font-size:.62rem;letter-spacing:.08em;font-weight:800;color:#94a3b8}
      .sidebar .nav-item{margin:2px 0}
      .sidebar .nav-item .nav-link{display:flex;align-items:center;gap:.7rem;padding:.62rem .9rem;margin:0 .65rem;border-radius:9999px;color:#475569;font-weight:600;font-size:.84rem;transition:background .15s,color .15s,transform .15s}
      .sidebar .nav-item .nav-link i{width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:9999px;background:#f8fafc;color:#64748b;font-size:.85rem;flex-shrink:0;transition:background .15s,color .15s}
      .sidebar .nav-item .nav-link:hover{background:#f8fafc;color:#1e293b}
      .sidebar .nav-item .nav-link:hover i{background:#eef2ff;color:#2563eb}
      .sidebar .nav-item.active .nav-link{background:var(--pill-active, #2563eb) !important;color:#fff !important;font-weight:700;box-shadow:0 4px 14px rgba(37,99,235,.25)}
      .sidebar .nav-item.active .nav-link::before{display:none}
      .sidebar .nav-item.active .nav-link i{background:rgba(255,255,255,.18) !important;color:#fff !important}
      .sidebar .nav-item.active .nav-link:hover{background:#1d4ed8 !important;color:#fff !important}
      @media(max-width:767.98px){ .sidebar{display:none !important} }
    </style>
    <!-- Sidebar (Menu)-->
    <?php
      $ci =& get_instance();
      $active_method = $ci->router->fetch_method();
      $active_class = $ci->router->fetch_class();
    ?>
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <!-- top menu -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
          <img src="<?php echo base_url("asset/img/logo/logo.png") ?>">

        </div>
        <div class="sidebar-brand-text mx-2"></div>
      </a>
      <!-- body menu -->
      <hr class="sidebar-divider my-0">
      <?php if (is_instructor()): ?>
      <li class="nav-item <?php echo ($active_method == 'dashboard_instruktur') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url("pages/dashboard_instruktur") ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <?php else: ?>
      <li class="nav-item <?php echo ($active_method == 'dashboard') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url("pages/dashboard") ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <?php endif; ?>
      <?php if (is_admin()): ?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Menu
      </div>
      <li class="nav-item <?php echo ($active_method == 'lembaga') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url("pages/lembaga") ?>">
          <i class="fas fa-fw fa-university"></i>
          <span>Lembaga</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($active_method == 'sapras') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url("pages/sapras") ?>">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Sarana Prasarana</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($active_method == 'pegawai') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url("pages/pegawai") ?>">
          <i class="fas fa-fw fa-users"></i>
          <span>Pegawai </span>
        </a>
      </li>
      <li class="nav-item <?php echo ($active_method == 'instruktur') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url("pages/instruktur") ?>">
          <i class="fas fa-fw fa-users"></i>
          <span>Instruktur</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($active_method == 'rombel') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url("pages/rombel") ?>">
          <i class="fas fa-fw fa-th-list"></i>
          <span>Program Pelatihan</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($active_method == 'uk') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url("pages/uk") ?>">
          <i class="fas fa-fw fa-archive"></i>
          <span>Unit Kompetensi</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($active_class == 'laporan' && $active_method == 'form') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url('Laporan/form'); ?>">
          <i class="fas fa-fw fa-file"></i>
          <span>Formulir Pendaftaran</span>
        </a>
      </li>
      <?php if (is_superadmin()): ?>
      <li class="nav-item <?php echo ($active_class == 'akun') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url('akun'); ?>">
          <i class="fas fa-fw fa-user-cog"></i>
          <span>Manajemen Akun</span>
        </a>
      </li>
      <?php endif; ?>
      <?php endif; ?>
      <?php if (is_logged_in()): ?>
      <li class="nav-item <?php echo ($active_method == 'peserta' || $active_method == 'peserta2') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url("pages/peserta") ?>">
          <i class="fas fa-fw fa-users"></i>
          <span>Peserta</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($active_method == 'lulusan') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url("pages/lulusan") ?>">
          <i class="fas fa-fw fa-graduation-cap"></i>
          <span>Lulusan</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($active_method == 'presensi') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url("pages/presensi") ?>">
          <i class="fas fa-fw fa-archive"></i>
          <span>Presensi</span>
        </a>
      </li>
      <?php endif; ?>
      <hr class="sidebar-divider">
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">