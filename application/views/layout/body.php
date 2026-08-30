<?php
$__ci =& get_instance();
$__nama = trim($__ci->session->userdata('nama') ?: '-');
$__user = trim($__ci->session->userdata('username') ?: '-');
$__last = (int)$__ci->session->userdata('last_active');
$__isPwa = $__ci->session->userdata('is_pwa') === '1';
$__initial = strtoupper(substr($__nama,0,1) . (strpos($__nama,' ') ? substr($__nama, strpos($__nama,' ')+1,1) : ''));
$__profilRow = $__ci->db->get('profil')->row();
$__namalkp = $__profilRow->Namalkp ?? 'LKP Cendekia Utama';
?>
<style>
.modern-head h1{letter-spacing:-.02em}
.modern-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04);background:#fff}
.modern-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.profile-head{background:linear-gradient(135deg,#2563eb 0%,#1d4ed8 100%);padding:1.5rem;color:#fff;position:relative;overflow:hidden;border-radius:.85rem .85rem 0 0}
.profile-head::after{content:"";position:absolute;inset:0;background:radial-gradient(420px 140px at 90% -10%,rgba(255,255,255,.18),transparent 60%);pointer-events:none}
.avatar-lg{width:64px;height:64px;border-radius:1rem;background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.25);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.3rem;flex-shrink:0;backdrop-filter:blur(6px)}
.info-row{display:flex;align-items:center;justify-content:space-between;gap:.75rem;padding:.65rem 0;border-top:1px solid #f8fafc}
.info-row:first-child{border-top:0;padding-top:0}
.info-label{font-size:.66rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700;color:#94a3b8}
.info-value{font-size:.82rem;font-weight:600;color:#1e293b;text-align:right;word-break:break-all}
.quick-action{display:flex;align-items:center;gap:.7rem;width:100%;padding:.7rem .8rem;border-radius:.7rem;border:1px solid;text-decoration:none!important;transition:transform .12s}
.quick-action:active{transform:scale(.98)}
.quick-action .qa-icon{width:34px;height:34px;border-radius:.6rem;display:flex;align-items:center;justify-content:center;font-size:.85rem;flex-shrink:0}
.qa-title{font-size:.8rem;font-weight:700;line-height:1.2}
.qa-sub{font-size:.68rem;color:#64748b;font-weight:500}
.qa-blue{background:#eff6ff;border-color:#bfdbfe}
.qa-blue .qa-icon{background:#fff;color:#2563eb;border:1px solid #bfdbfe}
.qa-blue .qa-title{color:#1d4ed8}
.qa-amber{background:#fffbeb;border-color:#fde68a}
.qa-amber .qa-icon{background:#fff;color:#d97706;border:1px solid #fde68a}
.qa-amber .qa-title{color:#92400e}
.qa-neutral{background:#fff;border-color:#e2e8f0}
.qa-neutral .qa-icon{background:#f8fafc;color:#475569;border:1px solid #e2e8f0}
.qa-neutral .qa-title{color:#334155}
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}.profile-head{padding:1.1rem}.avatar-lg{width:52px;height:52px;font-size:1.05rem}}
@media(prefers-reduced-motion:reduce){.quick-action{transition:none}}
</style>

<div class="modern-head d-none d-md-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Profil</h1>
    <p class="text-muted small mb-0">Selamat datang kembali di SIM <?= html_escape($__namalkp) ?></p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Profil</li>
  </ol>
</div>

<div class="d-md-none mt-3 mb-3 app-page-head">
  <div class="d-flex align-items-center justify-content-between" style="gap:.6rem">
    <div style="min-width:0">
      <h1 style="font-size:1.15rem;font-weight:800;color:#1e293b;letter-spacing:-.01em;margin:0">Profil</h1>
      <div class="small text-muted" style="font-size:.72rem">Selamat datang kembali di SIM <?= html_escape($__namalkp) ?></div>
    </div>
  </div>
</div>

<div class="card modern-card mb-3">
  <div class="profile-head d-flex align-items-center" style="gap:1rem">
    <div class="avatar-lg"><?= html_escape($__initial) ?></div>
    <div style="min-width:0;flex:1">
      <div style="font-weight:800;font-size:1.1rem;letter-spacing:-.01em"><?= html_escape($__nama) ?></div>
      <div class="small" style="opacity:.9;margin-top:.15rem"><?= html_escape($__user) ?></div>
    </div>
    <span class="badge d-none d-md-inline-flex align-items-center" style="background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.28);color:#fff;border-radius:9999px;padding:.35rem .6rem;font-weight:700;font-size:.7rem;backdrop-filter:blur(6px)">Akun aktif</span>
  </div>
  <div class="card-body p-0">
    <div class="row no-gutters text-center" style="font-size:.78rem">
      <div class="col-4 py-3" style="border-right:1px solid #f1f5f9"><div class="text-muted" style="font-size:.62rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Status</div><div style="font-weight:800;color:#059669;font-size:.95rem">Masuk</div></div>
      <div class="col-4 py-3" style="border-right:1px solid #f1f5f9"><div class="text-muted" style="font-size:.62rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Mode</div><div style="font-weight:800;color:#1e293b;font-size:.95rem"><?= $__isPwa ? 'Aplikasi (PWA)' : 'Web Browser' ?></div></div>
      <div class="col-4 py-3"><div class="text-muted" style="font-size:.62rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Login Terakhir</div><div style="font-weight:800;color:#1e293b;font-size:.95rem"><?= $__last ? date('d/m/Y H:i', $__last) : '-' ?></div></div>
    </div>
  </div>
</div>

<div class="row mb-4">
  <div class="col-lg-7 mb-3 mb-lg-0">
    <div class="card modern-card h-100">
      <div class="card-header py-3 d-flex align-items-center" style="gap:.5rem">
        <span class="d-flex align-items-center justify-content-center" style="width:28px;height:28px;border-radius:.5rem;background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe"><i class="fas fa-id-card" style="font-size:.75rem"></i></span>
        <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Informasi Akun</h6>
      </div>
      <div class="card-body" style="padding:1.1rem">
        <div class="info-row"><span class="info-label">Nama</span><span class="info-value"><?= html_escape($__nama) ?></span></div>
        <div class="info-row"><span class="info-label">Username</span><span class="info-value"><?= html_escape($__user) ?></span></div>
        <div class="info-row"><span class="info-label">Lembaga</span><span class="info-value"><?= html_escape($__namalkp) ?></span></div>
        <div class="small text-muted mt-3" style="font-size:.66rem"><i class="fas fa-info-circle mr-1" style="color:#94a3b8"></i>Untuk mengubah nama, username, atau kata sandi, buka Pengaturan Akun</div>
      </div>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="card modern-card h-100">
      <div class="card-header py-3 d-flex align-items-center" style="gap:.5rem">
        <span class="d-flex align-items-center justify-content-center" style="width:28px;height:28px;border-radius:.5rem;background:#fffbeb;color:#d97706;border:1px solid #fde68a"><i class="fas fa-bolt" style="font-size:.75rem"></i></span>
        <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Aksi Cepat</h6>
      </div>
      <div class="card-body d-flex flex-column" style="padding:1.1rem;gap:.6rem">
        <a href="<?= base_url('index.php/utama/akun') ?>" class="quick-action qa-blue">
          <span class="qa-icon"><i class="fas fa-cogs"></i></span>
          <span style="flex:1;min-width:0"><span class="qa-title d-block">Pengaturan Akun</span><span class="qa-sub d-block">Ubah nama, username, kata sandi</span></span>
          <i class="fas fa-chevron-right" style="font-size:.65rem;color:#93c5fd"></i>
        </a>
        <a href="<?= base_url('pages/dashboard') ?>" class="quick-action qa-neutral">
          <span class="qa-icon"><i class="fas fa-tachometer-alt"></i></span>
          <span style="flex:1;min-width:0"><span class="qa-title d-block">Dashboard</span><span class="qa-sub d-block">Ringkasan aktivitas LKP</span></span>
          <i class="fas fa-chevron-right" style="font-size:.65rem;color:#cbd5e1"></i>
        </a>
        <a href="<?= base_url('index.php/pages/log') ?>" class="quick-action qa-amber">
          <span class="qa-icon"><i class="fas fa-history"></i></span>
          <span style="flex:1;min-width:0"><span class="qa-title d-block">Log Aktivitas</span><span class="qa-sub d-block">Riwayat penggunaan sistem</span></span>
          <i class="fas fa-chevron-right" style="font-size:.65rem;color:#fcd34d"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">document.title = "Profil <?= html_escape($__nama) ?>";</script>
