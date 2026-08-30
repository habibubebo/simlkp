<?php
$__total = count($instruktur);
$__laki = 0; $__perempuan = 0;
foreach ($instruktur as $__r) {
  $k = strtolower(trim($__r->Kelamin ?? ''));
  if (strpos($k, 'laki') !== false && strpos($k, 'perempuan')===false) $__laki++;
  elseif (strpos($k, 'perempuan') !== false) $__perempuan++;
}
function fmtTglLahir($d) {
  if ($d === null || trim((string)$d) === '' || $d === '-' || $d === '0000-00-00' || $d === '0000-00-00 00:00:00') return '-';
  $ts = strtotime($d);
  if (!$ts) return html_escape($d);
  $bln = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
  return date('j', $ts) . ' ' . $bln[(int)date('n', $ts)] . ' ' . date('Y', $ts);
}
?>
<style>
.modern-head h1{letter-spacing:-.02em}
.modern-stat .stat-icon{width:2.6rem;height:2.6rem;border-radius:.65rem;display:flex;align-items:center;justify-content:center;font-size:1rem}
.modern-stat.stat-total .stat-icon{background:rgba(37,99,235,.1);color:#2563eb}
.modern-stat.stat-laki .stat-icon{background:rgba(59,130,246,.12);color:#2563eb}
.modern-stat.stat-perempuan .stat-icon{background:rgba(236,72,153,.12);color:#db2777}
.modern-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04)}
.modern-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.modern-table{width:100%!important}
.modern-table thead th{font-size:.66rem;letter-spacing:.07em;text-transform:uppercase;color:#94a3b8;font-weight:700;border-top:0;border-bottom:1px solid #f1f5f9;white-space:nowrap;padding:.8rem .75rem;background:#fcfdff}
.modern-table thead th.sorting,.modern-table thead th.sorting_asc,.modern-table thead th.sorting_desc{cursor:pointer;position:relative;padding-right:1.6rem}
.modern-table thead th.sorting:after,.modern-table thead th.sorting_asc:after,.modern-table thead th.sorting_desc:after{position:absolute;right:.55rem;top:50%;transform:translateY(-50%);font-family:'Font Awesome 5 Free';font-weight:900;font-size:.6rem;color:#cbd5e1;content:'\f0dc'}
.modern-table thead th.sorting_asc:after{color:#2563eb;content:'\f0de'}
.modern-table thead th.sorting_desc:after{color:#2563eb;content:'\f0dd'}
.modern-table tbody td{font-size:.82rem;color:#334155;vertical-align:middle;padding:.65rem .75rem;border-top:1px solid #f8fafc}
.modern-table tbody tr:first-child td{border-top:0}
.modern-table tbody tr:hover td{background:#f8fafc}
.mono{font-family:'SFMono-Regular',Consolas,'Liberation Mono',Menlo,monospace;font-size:.76rem;color:#475569}
.badge-kelamin{font-size:.68rem;font-weight:700;padding:.22rem .5rem;border-radius:9999px;border:1px solid transparent}
.badge-laki{background:#eff6ff;color:#1d4ed8;border-color:#bfdbfe}
.badge-perempuan{background:#fdf2f8;color:#be185d;border-color:#fbcfe8}
.avatar-sm{width:32px;height:32px;border-radius:.5rem;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.7rem;flex-shrink:0}
.avatar-ins{background:rgba(37,99,235,.1);color:#1d4ed8}
.modern-table-wrap{border-radius:0 0 .85rem .85rem;overflow:hidden}
.modern-card .dataTables_wrapper{padding:0}
.modern-card .dt-top{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:.75rem;padding:1rem 1.1rem .85rem;border-bottom:1px solid #f1f5f9;background:#fff}
.modern-card .dataTables_length label{margin:0;display:flex;align-items:center;gap:.4rem;font-size:.78rem;color:#64748b;font-weight:500}
.modern-card .dataTables_length select{border:1px solid #e2e8f0;border-radius:.5rem;padding:.32rem 1.6rem .32rem .6rem;font-size:.78rem;color:#334155;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E<path d='M8 11L3 6h10z'/%3E</svg>") no-repeat right .5rem center;appearance:none;min-width:64px}
.modern-card .dataTables_filter label{margin:0;display:flex;align-items:center;gap:.4rem;font-size:.78rem;color:#64748b;font-weight:500}
.modern-card .dataTables_filter input{border:1px solid #e2e8f0;border-radius:.6rem;padding:.42rem .75rem .42rem 2rem;font-size:.82rem;color:#334155;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' stroke='%2394a3b8' stroke-width='1.7' viewBox='0 0 24 24'%3E<circle cx='11' cy='11' r='7'/%3E<path d='M20 20l-3.5-3.5'/%3E</svg>") no-repeat 9px center;width:240px;transition:border-color .15s,box-shadow .15s}
.modern-card .dataTables_filter input:focus{outline:none;border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
.modern-card .dt-bottom{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:.75rem;padding:.85rem 1.1rem;border-top:1px solid #f1f5f9;background:#fcfdff}
.modern-card .dataTables_info{font-size:.76rem;color:#94a3b8;padding:0!important}
.modern-card .dataTables_paginate .pagination{margin:0;gap:.28rem}
.modern-card .dataTables_paginate .paginate_button{border:1px solid #e2e8f0!important;background:#fff!important;color:#475569!important;border-radius:.5rem!important;padding:.32rem .62rem!important;font-size:.76rem!important;font-weight:600!important;line-height:1!important;min-width:32px;text-align:center;transition:all .15s}
.modern-card .dataTables_paginate .paginate_button:hover{background:#f8fafc!important;border-color:#cbd5e1!important;color:#1e293b!important}
.modern-card .dataTables_paginate .paginate_button.current,.modern-card .dataTables_paginate .paginate_button.current:hover{background:#2563eb!important;border-color:#2563eb!important;color:#fff!important;box-shadow:0 2px 8px rgba(37,99,235,.25)}
.modern-card .dataTables_paginate .paginate_button.disabled{opacity:.4;pointer-events:none}
/* mobile app list */
.app-search{position:relative;display:flex;align-items:center;background:#fff;border:1px solid #e2e8f0;border-radius:9999px;padding:.6rem 1rem .6rem 2.5rem;box-shadow:0 1px 2px rgba(15,23,42,.04)}
.app-search i{position:absolute;left:1rem;color:#94a3b8;font-size:.85rem}
.app-search input{border:none;outline:none;width:100%;font-size:.82rem;color:#1e293b;background:transparent}
.app-search input::placeholder{color:#94a3b8}
.app-list{display:grid;gap:.7rem}
.app-item{background:#fff;border:1px solid #eef0f4;border-radius:.85rem;padding:.75rem;box-shadow:0 1px 3px rgba(15,23,42,.04);display:flex;flex-wrap:wrap;gap:.7rem;align-items:center}
.app-item-main{flex:1;min-width:0;overflow:hidden}
.app-item-actions{width:100%;display:flex;gap:.4rem;margin-top:.15rem}
.app-action{flex:1;display:flex;align-items:center;justify-content:center;gap:.35rem;font-size:.7rem;font-weight:700;border-radius:.5rem;padding:.42rem .3rem;text-decoration:none!important;transition:transform .12s}
.app-action:active{transform:scale(.97)}
.act-presensi{background:#eff6ff;border:1px solid #bfdbfe;color:#2563eb}
.act-edit{background:#fff;border:1px solid #e2e8f0;color:#475569}
.act-del{background:#fff;border:1px solid #fecaca;color:#dc2626}
.fab-ins{position:fixed;bottom:calc(76px + env(safe-area-inset-bottom,0px));right:16px;z-index:1029;width:52px;height:52px;border-radius:9999px;background:#2563eb;color:#fff;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(37,99,235,.4);font-size:1.1rem;text-decoration:none;transition:transform .12s}
.fab-ins:active{transform:scale(.95)}
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}.modern-card .dt-top{flex-direction:column;align-items:stretch}.modern-card .dataTables_filter input{width:100%}.modern-card .dataTables_filter label{width:100%}.modern-card .dt-bottom{flex-direction:column;align-items:stretch;text-align:center}.modern-card .dataTables_paginate .pagination{justify-content:center}}
@media(prefers-reduced-motion:reduce){.app-action,.fab-ins{transition:none}}
</style>

<div class="modern-head d-none d-md-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Instruktur</h1>
    <p class="text-muted small mb-0">Kelola data pengajar dan kompetensi</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Instruktur</li>
  </ol>
</div>

<div class="d-md-none mt-3 mb-3 app-page-head">
  <div class="d-flex align-items-center justify-content-between mb-2" style="gap:.6rem">
    <div style="min-width:0">
      <h1 style="font-size:1.15rem;font-weight:800;color:#1e293b;letter-spacing:-.01em;margin:0">Instruktur</h1>
      <div class="small text-muted" style="font-size:.72rem">Kelola data pengajar dan kompetensi</div>
    </div>
    <span class="badge flex-shrink-0" style="background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;font-size:.7rem;border-radius:9999px;padding:.3rem .6rem;font-weight:700"><?= $__total ?> data</span>
  </div>
  <div class="app-search"><i class="fas fa-search"></i><input type="search" id="appSearchInsDir" placeholder="Cari instruktur, email..."></div>
</div>

<div class="card modern-card d-md-none mb-3">
  <div class="row no-gutters text-center" style="font-size:.78rem">
    <div class="col-4 py-3" style="border-right:1px solid #f1f5f9"><div class="text-muted" style="font-size:.62rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total</div><div style="font-weight:800;color:#1e293b;font-size:1.1rem"><?= $__total ?></div></div>
    <div class="col-4 py-3" style="border-right:1px solid #f1f5f9"><div class="text-muted" style="font-size:.62rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Laki-laki</div><div style="font-weight:800;color:#1e40af;font-size:1.1rem"><?= $__laki ?></div></div>
    <div class="col-4 py-3"><div class="text-muted" style="font-size:.62rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Perempuan</div><div style="font-weight:800;color:#9d174d;font-size:1.1rem"><?= $__perempuan ?></div></div>
  </div>
</div>

<div class="row mb-3 d-none d-md-flex">
  <div class="col-6 col-xl-4 mb-3">
    <div class="card modern-card modern-stat stat-total h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total Instruktur</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#1e293b"><?= $__total ?></div><div class="small text-muted" style="font-size:.72rem">Tenaga pengajar aktif</div></div><div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div></div></div>
  </div>
  <div class="col-6 col-xl-4 mb-3">
    <div class="card modern-card modern-stat stat-laki h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Laki-laki</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#1e40af"><?= $__laki ?></div><div class="small text-muted" style="font-size:.72rem"><?= $__total?round($__laki/$__total*100):0 ?>% dari total</div></div><div class="stat-icon"><i class="fas fa-mars"></i></div></div></div>
  </div>
  <div class="col-6 col-xl-4 mb-3">
    <div class="card modern-card modern-stat stat-perempuan h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Perempuan</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#9d174d"><?= $__perempuan ?></div><div class="small text-muted" style="font-size:.72rem"><?= $__total?round($__perempuan/$__total*100):0 ?>% dari total</div></div><div class="stat-icon"><i class="fas fa-venus"></i></div></div></div>
  </div>
</div>

<div class="d-md-none mb-4">
  <div id="appListInsDir" class="app-list">
    <?php foreach ($instruktur as $tp) {
      $isLaki = stripos($tp->Kelamin ?? '', 'laki') !== false && stripos($tp->Kelamin ?? '', 'perempuan') === false;
      $badgeClass = $isLaki ? 'badge-laki' : 'badge-perempuan';
      $initials = strtoupper(substr(trim($tp->NamaInstruktur),0,1) . (strpos(trim($tp->NamaInstruktur),' ') ? substr(trim($tp->NamaInstruktur), strpos(trim($tp->NamaInstruktur),' ')+1,1) : ''));
      $ttl = trim(($tp->Tempatlahir ?? '-') . ', ' . fmtTglLahir($tp->Tanggallahir ?? ''), ', -');
    ?>
      <div class="app-item" data-search="<?= html_escape(strtolower($tp->NamaInstruktur.' '.($tp->Email ?? '').' '.($tp->Alamat ?? ''))) ?>">
        <div class="avatar-sm avatar-ins" style="width:40px;height:40px;font-size:.8rem;border-radius:.6rem"><?= html_escape($initials) ?></div>
        <div class="app-item-main">
          <div class="d-flex align-items-center" style="gap:.45rem">
            <div style="font-weight:700;color:#1e293b;font-size:.84rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= html_escape($tp->NamaInstruktur) ?></div>
            <span class="badge-kelamin <?= $badgeClass ?>" style="flex-shrink:0"><?= html_escape($tp->Kelamin) ?></span>
          </div>
          <div class="small text-muted" style="font-size:.7rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= html_escape($ttl) ?></div>
          <div class="small text-muted" style="font-size:.7rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= html_escape($tp->Email ?? '-') ?></div>
        </div>
        <div class="app-item-actions">
          <a href="<?= base_url("presensi/instruktur?Id=$tp->Id") ?>" class="app-action act-presensi"><i class="fas fa-clipboard-list" style="font-size:.68rem"></i>Presensi</a>
          <a href="<?= base_url("instruktur/form_ubah/$tp->Id") ?>" class="app-action act-edit"><i class="fas fa-pen" style="font-size:.66rem"></i>Ubah</a>
          <a href="#" class="app-action act-del" data-toggle="modal" data-target="#deleteInsModal" data-id="<?= $tp->Id ?>" data-nama="<?= html_escape($tp->NamaInstruktur) ?>"><i class="fas fa-trash-alt" style="font-size:.66rem"></i>Hapus</a>
        </div>
      </div>
    <?php } ?>
  </div>
  <div id="appEmptyInsDir" class="text-center py-4 d-none">
    <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:44px;height:44px;border-radius:.7rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-search"></i></div>
    <div class="small font-weight-bold" style="color:#334155">Tidak ada instruktur</div>
    <div class="small text-muted">Coba ubah pencarian</div>
  </div>
  <?php if ($__total === 0) { ?>
    <div class="text-center py-5 px-3"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;border-radius:.85rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-chalkboard-teacher fa-lg"></i></div><h6 class="font-weight-bold" style="color:#1e293b">Belum ada instruktur</h6><p class="small text-muted mb-0">Tambahkan instruktur pertama.</p></div>
  <?php } ?>
</div>

<a href="<?= base_url('instruktur/form') ?>" class="fab-ins d-md-none" aria-label="Tambah Instruktur"><i class="fas fa-plus"></i></a>

<div class="card modern-card mb-4 d-none d-md-block">
  <div class="card-header py-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between" style="gap:.6rem">
    <div class="d-flex align-items-center" style="gap:.6rem">
      <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Daftar Instruktur</h6>
      <span class="badge" style="background:#f1f5f9;color:#475569;font-weight:600;font-size:.68rem;border-radius:9999px;padding:.3rem .55rem"><?= $__total ?> data</span>
    </div>
    <a href="<?= base_url('instruktur/form') ?>" class="btn btn-primary btn-sm" style="background:#2563eb;border-color:#2563eb;border-radius:.5rem;font-weight:600;font-size:.78rem;padding:.42rem .75rem"><i class="fas fa-plus mr-1"></i> Tambah Instruktur</a>
  </div>
  <div class="modern-table-wrap table-responsive">
    <table class="table modern-table table-hover mb-0" id="tabelinstruktur" style="width:100%">
      <thead>
        <tr>
          <th>Instruktur</th>
          <th>Kelamin</th>
          <th>TTL</th>
          <th>Nama Ibu</th>
          <th>Alamat</th>
          <th>Email</th>
          <th class="text-right" style="width:110px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($instruktur as $tp) {
          $isLaki = stripos($tp->Kelamin ?? '', 'laki') !== false && stripos($tp->Kelamin,'perempuan')===false;
          $badgeClass = $isLaki ? 'badge-laki' : 'badge-perempuan';
          $initials = strtoupper(substr(trim($tp->NamaInstruktur),0,1) . (strpos(trim($tp->NamaInstruktur),' ') ? substr(trim($tp->NamaInstruktur), strpos(trim($tp->NamaInstruktur),' ')+1,1) : ''));
$ttl = trim(($tp->Tempatlahir ?? '-') . ', ' . fmtTglLahir($tp->Tanggallahir ?? ''), ', -');
        ?>
          <tr>
            <td>
              <div class="d-flex align-items-center" style="gap:.6rem;min-width:160px">
                <div class="avatar-sm avatar-ins"><?= html_escape($initials) ?></div>
                <div style="min-width:0">
                  <div style="font-weight:700;color:#1e293b;font-size:.82rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:160px" title="<?= html_escape($tp->NamaInstruktur) ?>"><?= html_escape($tp->NamaInstruktur) ?></div>
                  <div class="mono" style="font-size:.7rem;color:#94a3b8">Pengajar</div>
                </div>
              </div>
            </td>
            <td><span class="badge-kelamin <?= $badgeClass ?>"><?= html_escape($tp->Kelamin) ?></span></td>
            <td><span class="small" style="color:#475569"><?= html_escape($ttl) ?></span></td>
            <td><span class="small" style="color:#475569"><?= html_escape($tp->Namaibu) ?></span></td>
            <td><span class="small text-truncate d-inline-block" style="max-width:150px;color:#475569" title="<?= html_escape($tp->Alamat) ?>"><?= html_escape($tp->Alamat) ?></span></td>
            <td><span class="mono" style="font-size:.74rem;max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:inline-block" title="<?= html_escape($tp->Email) ?>"><?= html_escape($tp->Email) ?></span></td>
            <td class="text-right">
              <div class="d-inline-flex" style="gap:.3rem">
                <a href="<?= base_url("presensi/instruktur?Id=$tp->Id") ?>" class="btn btn-sm" style="background:#eff6ff;border:1px solid #bfdbfe;color:#2563eb;border-radius:.45rem;padding:.32rem .45rem" title="Presensi"><i class="fas fa-clipboard-list" style="font-size:.7rem"></i></a>
                <a href="<?= base_url("instruktur/form_ubah/$tp->Id") ?>" class="btn btn-sm" style="background:#fff;border:1px solid #e2e8f0;color:#475569;border-radius:.45rem;padding:.32rem .45rem" title="Ubah"><i class="fas fa-pen" style="font-size:.7rem"></i></a>
                <a href="#" class="btn btn-sm" style="background:#fff;border:1px solid #fecaca;color:#dc2626;border-radius:.45rem;padding:.32rem .45rem" data-toggle="modal" data-target="#deleteInsModal" data-id="<?= $tp->Id ?>" data-nama="<?= html_escape($tp->NamaInstruktur) ?>" title="Hapus"><i class="fas fa-trash-alt" style="font-size:.7rem"></i></a>
              </div>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php if ($__total === 0) { ?>
    <div class="text-center py-5 px-3"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;border-radius:.85rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-chalkboard-teacher fa-lg"></i></div><h6 class="font-weight-bold" style="color:#1e293b">Belum ada instruktur</h6><p class="small text-muted mb-3">Tambahkan instruktur pertama.</p><a href="<?= base_url('instruktur/form') ?>" class="btn btn-primary" style="border-radius:.6rem;font-weight:600"><i class="fas fa-plus mr-1"></i> Tambah Instruktur</a></div>
  <?php } ?>
</div>

<div class="modal fade" id="deleteInsModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:420px">
    <div class="modal-content" style="border:0;border-radius:.9rem;box-shadow:0 20px 60px rgba(15,23,42,.18)">
      <div class="modal-body p-4 text-center">
        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;border-radius:50%;background:#fef2f2;color:#dc2626"><i class="fas fa-trash-alt"></i></div>
        <h6 class="font-weight-bold mb-1" style="color:#1e293b">Hapus instruktur?</h6>
        <p class="small text-muted mb-0">Yakin ingin menghapus <span style="font-weight:600;color:#334155" id="deleteInsName"></span> ?</p>
      </div>
      <div class="modal-footer border-0 pt-0 px-4 pb-4 d-flex" style="gap:.5rem">
        <button type="button" class="btn flex-fill" data-dismiss="modal" style="border:1px solid #e2e8f0;background:#fff;color:#475569;border-radius:.55rem;font-weight:600">Batal</button>
        <a href="#" id="deleteInsConfirm" class="btn btn-danger flex-fill" style="border-radius:.55rem;font-weight:600">Hapus</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">document.title = "Instruktur <?= $profil[0]->Namalkp?>";</script>
<script>
$(function(){
  function initIns(){
    var $t=$('#tabelinstruktur'); if(!$t.length) return;
    if($.fn.DataTable.isDataTable($t)){ try{$t.DataTable().destroy();}catch(e){} $t.removeAttr('style'); }
    $t.DataTable({
      pageLength:10, lengthMenu:[5,10,25,50], order:[[0,'asc']],
      columnDefs:[{orderable:false,targets:[6]}],
      dom:'<"dt-top"lf>rt<"dt-bottom"ip>',
      language:{search:"",searchPlaceholder:"Cari instruktur, email...",lengthMenu:"Tampil _MENU_",info:"Menampilkan _START_–_END_ dari _TOTAL_ data",infoEmpty:"Tidak ada data",infoFiltered:"(difilter dari _MAX_ total)",zeroRecords:"Tidak ada data yang cocok",emptyTable:"Belum ada instruktur",paginate:{first:"Awal",last:"Akhir",next:"›",previous:"‹"}},
      drawCallback:function(){ var h=[]; this.api().columns().header().toArray().forEach(function(th){h.push($(th).text().trim());}); this.api().rows({page:'current'}).nodes().toArray().forEach(function(r){$(r).find('td').each(function(i){if(h[i])$(this).attr('data-label',h[i]);});}); }
    });
  }
  if(document.readyState==='complete') setTimeout(initIns,80); else $(window).on('load',function(){setTimeout(initIns,80);});
  setTimeout(initIns,300);

  function filterInsDir(){
    var q=(($('#appSearchInsDir').val()||'').toLowerCase());
    var vis=0;
    $('#appListInsDir .app-item').each(function(){
      var $it=$(this);
      var s=String($it.data('search')||'').toLowerCase();
      if(!s) s=$it.text().toLowerCase();
      var show=!q || s.indexOf(q)!==-1;
      $it.toggle(show);
      if(show) vis++;
    });
    $('#appEmptyInsDir').toggleClass('d-none', vis>0);
  }
  $(document).on('input','#appSearchInsDir', filterInsDir);

  $('#deleteInsModal').on('show.bs.modal', function(e){
    var b=$(e.relatedTarget); if(!b||!b.length) return;
    $('#deleteInsName').text(b.data('nama')||'');
    $('#deleteInsConfirm').attr('href', appPath+'instruktur/hapus/'+b.data('id'));
  });
});
</script>
