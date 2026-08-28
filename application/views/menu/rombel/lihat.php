<?php
$__total = count($rombel);
$__peserta = 0; $__ruangan = [];
foreach ($rombel as $__r) { $__peserta += (int)($__r->Jumlahpeserta ?? 0); if (trim($__r->Ruangan ?? '') !== '') $__ruangan[trim($__r->Ruangan)] = true; }
$__ruanganCount = count($__ruangan);
?>
<style>
.modern-head h1{letter-spacing:-.02em}
.modern-stat .stat-icon{width:2.6rem;height:2.6rem;border-radius:.65rem;display:flex;align-items:center;justify-content:center;font-size:1rem}
.modern-stat.stat-total .stat-icon{background:rgba(37,99,235,.1);color:#2563eb}
.modern-stat.stat-peserta .stat-icon{background:rgba(16,185,129,.12);color:#059669}
.modern-stat.stat-ruang .stat-icon{background:rgba(245,158,11,.14);color:#d97706}
.modern-stat.stat-avg .stat-icon{background:rgba(139,92,246,.12);color:#7c3aed}
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
.badge-kelas{background:#f8fafc;color:#334155;border:1px solid #e2e8f0;font-weight:600;font-size:.7rem;border-radius:.4rem;padding:.22rem .45rem}
.badge-ruang{background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;font-weight:600;font-size:.7rem;border-radius:9999px;padding:.22rem .5rem}
.modern-table-wrap{border-radius:0 0 .85rem .85rem;overflow:hidden}
.modern-card .dataTables_wrapper{padding:0}
.modern-card .dt-top{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:.75rem;padding:1rem 1.1rem .85rem;border-bottom:1px solid #f1f5f9;background:#fff}
.modern-card .dataTables_length label{margin:0;display:flex;align-items:center;gap:.4rem;font-size:.78rem;color:#64748b;font-weight:500}
.modern-card .dataTables_length select{border:1px solid #e2e8f0;border-radius:.5rem;padding:.32rem 1.6rem .32rem .6rem;font-size:.78rem;color:#334155;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E") no-repeat right .5rem center;appearance:none;min-width:64px}
.modern-card .dataTables_length select:focus{outline:none;border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
.modern-card .dataTables_filter label{margin:0;display:flex;align-items:center;gap:.5rem;font-size:.78rem;color:#64748b;font-weight:500}
.modern-card .dataTables_filter input{border:1px solid #e2e8f0;border-radius:.6rem;padding:.42rem .75rem .42rem 2rem;font-size:.82rem;color:#334155;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' stroke='%2394a3b8' stroke-width='1.7' viewBox='0 0 24 24'%3E%3Ccircle cx='11' cy='11' r='7'/%3E%3Cpath d='M20 20l-3.5-3.5'/%3E%3C/svg%3E") no-repeat 9px center;width:240px;transition:border-color .15s,box-shadow .15s}
.modern-card .dataTables_filter input:focus{outline:none;border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
.modern-card .dt-bottom{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:.75rem;padding:.85rem 1.1rem;border-top:1px solid #f1f5f9;background:#fcfdff}
.modern-card .dataTables_info{font-size:.76rem;color:#94a3b8;padding:0!important}
.modern-card .dataTables_paginate .pagination{margin:0;gap:.28rem}
.modern-card .dataTables_paginate .paginate_button{border:1px solid #e2e8f0!important;background:#fff!important;color:#475569!important;border-radius:.5rem!important;padding:.32rem .62rem!important;font-size:.76rem!important;font-weight:600!important;line-height:1!important;min-width:32px;text-align:center;transition:all .15s}
.modern-card .dataTables_paginate .paginate_button:hover{background:#f8fafc!important;border-color:#cbd5e1!important;color:#1e293b!important}
.modern-card .dataTables_paginate .paginate_button.current,.modern-card .dataTables_paginate .paginate_button.current:hover{background:#2563eb!important;border-color:#2563eb!important;color:#fff!important;box-shadow:0 2px 8px rgba(37,99,235,.25)}
.modern-card .dataTables_paginate .paginate_button.disabled{opacity:.4;pointer-events:none}
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}.modern-card .dt-top{flex-direction:column;align-items:stretch}.modern-card .dataTables_filter input{width:100%}.modern-card .dataTables_filter label{width:100%}.modern-card .dt-bottom{flex-direction:column;align-items:stretch;text-align:center}.modern-card .dataTables_paginate .pagination{justify-content:center}}
</style>

<div class="modern-head d-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Program Pelatihan</h1>
    <p class="text-muted small mb-0">Kelola rombongan belajar, kelas dan ruangan</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Program Pelatihan</li>
  </ol>
</div>

<div class="row mb-3">
  <div class="col-6 col-xl-3 mb-3">
    <div class="card modern-card modern-stat stat-total h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total Program</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#1e293b"><?= $__total ?></div><div class="small text-muted" style="font-size:.72rem">Jenis kursus aktif</div></div><div class="stat-icon"><i class="fas fa-th-list"></i></div></div></div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card modern-card modern-stat stat-peserta h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total Peserta</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#065f46"><?= $__peserta ?></div><div class="small text-muted" style="font-size:.72rem"><?= $__total ? round($__peserta/$__total) : 0 ?> rata-rata / kelas</div></div><div class="stat-icon"><i class="fas fa-users"></i></div></div></div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card modern-card modern-stat stat-ruang h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Ruangan</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#92400e"><?= $__ruanganCount ?></div><div class="small text-muted" style="font-size:.72rem">Ruang digunakan</div></div><div class="stat-icon"><i class="fas fa-door-open"></i></div></div></div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card modern-card modern-stat stat-avg h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Kapasitas</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#5b21b6"><?= $__total ? round($__peserta/max(1,$__ruanganCount)) : 0 ?></div><div class="small text-muted" style="font-size:.72rem">Peserta / ruang</div></div><div class="stat-icon"><i class="fas fa-chart-bar"></i></div></div></div>
  </div>
</div>

<div class="card modern-card mb-4">
  <div class="card-header py-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between" style="gap:.6rem">
    <div class="d-flex align-items-center" style="gap:.6rem">
      <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Daftar Program</h6>
      <span class="badge" style="background:#f1f5f9;color:#475569;font-weight:600;font-size:.68rem;border-radius:9999px;padding:.3rem .55rem"><?= $__total ?> program</span>
    </div>
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahRombel" style="background:#2563eb;border-color:#2563eb;border-radius:.5rem;font-weight:600;font-size:.78rem;padding:.42rem .75rem"><i class="fas fa-plus mr-1"></i> Tambah Program</button>
  </div>
  <div class="modern-table-wrap table-responsive">
    <table class="table modern-table table-hover mb-0" id="tabelrombel" style="width:100%">
      <thead>
        <tr>
          <th>Jenis Kursus</th>
          <th>Kelas</th>
          <th class="text-center">Peserta</th>
          <th>Ruangan</th>
          <th class="text-right" style="width:110px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rombel as $tp) { ?>
          <tr>
            <td style="font-weight:700;color:#1e293b;min-width:160px"><?= html_escape($tp->Namarombel) ?></td>
            <td><span class="badge-kelas"><?= html_escape($tp->Kelas) ?></span></td>
            <td class="text-center"><span class="mono" style="font-weight:700;color:#1e293b;background:#f8fafc;border:1px solid #e2e8f0;border-radius:9999px;padding:.18rem .5rem"><?= html_escape($tp->Jumlahpeserta) ?></span></td>
            <td><span class="badge-ruang"><i class="fas fa-map-marker-alt mr-1" style="font-size:.65rem"></i><?= html_escape($tp->Ruangan) ?></span></td>
            <td class="text-right">
              <div class="d-inline-flex" style="gap:.3rem">
                <a href="#" class="btn btn-sm" style="background:#fff;border:1px solid #e2e8f0;color:#475569;border-radius:.45rem;padding:.32rem .45rem" data-toggle="modal" data-target="#modalEditRombel" data-id="<?= $tp->Id ?>" data-nm="<?= htmlspecialchars($tp->Namarombel, ENT_QUOTES) ?>" data-kls="<?= htmlspecialchars($tp->Kelas, ENT_QUOTES) ?>" data-jml="<?= htmlspecialchars($tp->Jumlahpeserta, ENT_QUOTES) ?>" data-rg="<?= htmlspecialchars($tp->Ruangan, ENT_QUOTES) ?>" title="Ubah"><i class="fas fa-pen" style="font-size:.7rem"></i></a>
                <a href="#" class="btn btn-sm" style="background:#fff;border:1px solid #fecaca;color:#dc2626;border-radius:.45rem;padding:.32rem .45rem" data-toggle="modal" data-target="#deleteRombel<?= $tp->Id; ?>" title="Hapus"><i class="fas fa-trash-alt" style="font-size:.7rem"></i></a>
              </div>
              <div class="modal fade" id="deleteRombel<?= $tp->Id; ?>" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document" style="max-width:420px"><div class="modal-content" style="border:0;border-radius:.9rem;box-shadow:0 20px 60px rgba(15,23,42,.18)"><div class="modal-body p-4 text-center"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;border-radius:50%;background:#fef2f2;color:#dc2626"><i class="fas fa-trash-alt"></i></div><h6 class="font-weight-bold mb-1" style="color:#1e293b">Hapus program?</h6><p class="small text-muted mb-0">Yakin ingin menghapus <span style="font-weight:600;color:#334155"><?= html_escape($tp->Namarombel) ?></span> ?</p></div><div class="modal-footer border-0 pt-0 px-4 pb-4 d-flex" style="gap:.5rem"><button type="button" class="btn flex-fill" data-dismiss="modal" style="border:1px solid #e2e8f0;background:#fff;color:#475569;border-radius:.55rem;font-weight:600">Batal</button><a href="<?= base_url('rombel/hapus/' . $tp->Id) ?>" class="btn btn-danger flex-fill" style="border-radius:.55rem;font-weight:600">Hapus</a></div></div></div></div>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php if ($__total === 0) { ?>
    <div class="text-center py-5 px-3"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;border-radius:.85rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-th-list fa-lg"></i></div><h6 class="font-weight-bold" style="color:#1e293b">Belum ada program</h6><p class="small text-muted mb-3">Tambahkan program pelatihan pertama.</p><button class="btn btn-primary" data-toggle="modal" data-target="#tambahRombel" style="border-radius:.6rem;font-weight:600"><i class="fas fa-plus mr-1"></i> Tambah Program</button></div>
  <?php } ?>
</div>

<button class="fab-presensi" data-toggle="modal" data-target="#tambahRombel" title="Tambah Program Pelatihan"><i class="fas fa-plus"></i></button>

<!-- Modal Tambah Rombel -->
<div class="modal fade rombel-app-modal" id="tambahRombel" tabindex="-1" role="dialog" aria-labelledby="tambahRombelTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-chalkboard"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="tambahRombelTitle">Tambah Program</h5>
            <div class="presensi-subtitle">Daftarkan jenis kursus baru</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup"><span class="d-none d-sm-inline" aria-hidden="true">&times;</span><i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i></button>
      </div>
      <form action="<?= base_url('rombel/tambah') ?>" method="POST" id="formTambahRombel" class="modal-body px-3 px-sm-4 py-3">
        <div class="form-group mb-3"><label class="field-label" for="trNm">Jenis Kursus</label><input type="text" class="form-control presensi-input" id="trNm" name="nm" maxlength="30" required placeholder="Nama jenis kursus"></div>
        <div class="form-row">
          <div class="form-group col-6 mb-3"><label class="field-label" for="trKls">Kelas</label><input type="text" class="form-control presensi-input" id="trKls" name="kls" maxlength="50" required placeholder="Kelas"></div>
          <div class="form-group col-6 mb-3"><label class="field-label" for="trJml">Jumlah Peserta</label><input type="number" class="form-control presensi-input" id="trJml" name="jml" min="0" required placeholder="0"></div>
        </div>
        <div class="form-group mb-1"><label class="field-label" for="trRg">Ruangan</label><input type="text" class="form-control presensi-input" id="trRg" name="rg" maxlength="20" required placeholder="Ruang kelas"></div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formTambahRombel" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Rombel -->
<div class="modal fade rombel-app-modal" id="modalEditRombel" tabindex="-1" role="dialog" aria-labelledby="modalEditRombelTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-edit"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="modalEditRombelTitle">Ubah Program</h5>
            <div class="presensi-subtitle">Perbarui data program pelatihan</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup"><span class="d-none d-sm-inline" aria-hidden="true">&times;</span><i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i></button>
      </div>
      <form action="<?= base_url('rombel/ubah') ?>" method="POST" id="formUbahRombel" class="modal-body px-3 px-sm-4 py-3">
        <input type="hidden" name="Id" id="erId">
        <div class="form-group mb-3"><label class="field-label" for="erNm">Jenis Kursus</label><input type="text" class="form-control presensi-input" id="erNm" name="nm" maxlength="30" required></div>
        <div class="form-row">
          <div class="form-group col-6 mb-3"><label class="field-label" for="erKls">Kelas</label><input type="text" class="form-control presensi-input" id="erKls" name="kls" maxlength="50" required></div>
          <div class="form-group col-6 mb-3"><label class="field-label" for="erJml">Jumlah Peserta</label><input type="number" class="form-control presensi-input" id="erJml" name="jml" min="0" required></div>
        </div>
        <div class="form-group mb-1"><label class="field-label" for="erRg">Ruangan</label><input type="text" class="form-control presensi-input" id="erRg" name="rg" maxlength="20" required></div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formUbahRombel" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<style>
.rombel-app-modal .modal-content{border:0;border-radius:.75rem;max-height:calc(100vh - 3.5rem);box-shadow:0 20px 60px rgba(15,23,42,.22)}
@supports (height: 100dvh){.rombel-app-modal .modal-content{max-height:calc(100dvh - 3.5rem)}}
.rombel-app-modal .modal-header,.rombel-app-modal .modal-footer{flex-shrink:0}
.rombel-app-modal .modal-body{flex:1 1 auto;min-height:0;overflow-y:auto;overscroll-behavior:contain}
.minw-0{min-width:0}
.presensi-icon{width:2.5rem;height:2.5rem;border-radius:.6rem;display:inline-flex;align-items:center;justify-content:center;background:rgba(37,99,235,.1);color:#2563eb;font-size:1.05rem;flex-shrink:0}
.presensi-subtitle{font-size:.8rem;color:#6b7280;margin-top:.1rem}
.presensi-close{width:2.5rem;height:2.5rem;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.35rem;color:#6b7280;transition:background-color .15s,color .15s}
.rombel-app-modal .presensi-close:hover{background:#f1f5f9;color:#111827}
.field-label{font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.35rem;display:block}
.rombel-app-modal .form-control{border-radius:.6rem}
.rombel-app-modal .form-control:focus{border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.15)}
.presensi-input{min-height:44px;font-size:16px}
.modal-footer .presensi-btn{min-height:48px;border-radius:.55rem;font-weight:600}
@media (max-width: 575.98px){
  .rombel-app-modal .modal-dialog{margin:0;max-width:100%;height:100%;overscroll-behavior:contain}
  @supports (height: 100svh){.rombel-app-modal .modal-dialog{height:100svh}}
  .rombel-app-modal .modal-content{height:100%;max-height:none;border-radius:1.25rem 1.25rem 0 0;box-shadow:0 -8px 40px rgba(15,23,42,.18);overscroll-behavior:contain}
  .rombel-app-modal .modal-header{justify-content:flex-start;padding:.85rem 1rem .85rem .5rem;border-bottom:1px solid #eef0f4}
  .rombel-app-modal .presensi-close{order:-1;margin:0 .35rem 0 0;color:#2563eb;flex-shrink:0}
  .rombel-app-modal .presensi-close:hover{background:rgba(37,99,235,.08);color:#2563eb}
  .rombel-app-modal .presensi-title-wrap{margin-left:.15rem!important}
  .rombel-app-modal .modal-footer{flex-direction:column-reverse;align-items:stretch;padding:.65rem 1rem calc(.75rem + env(safe-area-inset-bottom,0px))}
  .rombel-app-modal .modal-footer .presensi-btn{width:100%;margin-left:0!important;border-radius:9999px}
  .rombel-app-modal .modal-footer .btn-secondary{min-height:42px;background:rgba(37,99,235,.07);border-color:transparent;color:#2563eb}
  .rombel-app-modal .modal-footer .btn-secondary:hover,.rombel-app-modal .modal-footer .btn-secondary:focus{background:rgba(37,99,235,.14);border-color:transparent;color:#1d4ed8}
}
@media (max-width: 575.98px) and (prefers-reduced-motion: no-preference){.rombel-app-modal.fade .modal-dialog{transform:translateY(28px)}.rombel-app-modal.show .modal-dialog{transform:none}}
@media (min-width: 576px){.rombel-app-modal .modal-dialog{max-width:480px}}
@media (prefers-reduced-motion: reduce){.presensi-close{transition:none}}
html.app-modal-open,html.app-modal-open body{overflow:hidden!important;overscroll-behavior:none}
</style>
<script>
if(window.jQuery){
  window.jQuery(document).on('show.bs.modal','.rombel-app-modal',function(){document.documentElement.classList.add('app-modal-open');});
  window.jQuery(document).on('hidden.bs.modal',function(){if(!document.querySelector('.modal.show'))document.documentElement.classList.remove('app-modal-open');});
}
$('#modalEditRombel').on('show.bs.modal',function(e){
  var b=$(e.relatedTarget); if(!b.length) return;
  $('#erId').val(b.data('id')); $('#erNm').val(b.data('nm')); $('#erKls').val(b.data('kls')); $('#erJml').val(b.data('jml')); $('#erRg').val(b.data('rg'));
});
</script>
<script>
$(function(){
  function initRombel(){
    var $t=$('#tabelrombel'); if(!$t.length) return;
    if($.fn.DataTable.isDataTable($t)){ try{$t.DataTable().destroy();}catch(e){} $t.removeAttr('style'); }
    $t.DataTable({
      pageLength:10, lengthMenu:[5,10,25,50], order:[[0,'asc']],
      columnDefs:[{orderable:false,targets:[4]}],
      dom:'<"dt-top"lf>rt<"dt-bottom"ip>',
      language:{search:"",searchPlaceholder:"Cari program, kelas, ruangan...",lengthMenu:"Tampil _MENU_",info:"Menampilkan _START_–_END_ dari _TOTAL_ program",infoEmpty:"Tidak ada program",infoFiltered:"(difilter dari _MAX_ total)",zeroRecords:"Tidak ada data yang cocok",emptyTable:"Belum ada program",paginate:{first:"Awal",last:"Akhir",next:"›",previous:"‹"}},
      drawCallback:function(){ var h=[]; this.api().columns().header().toArray().forEach(function(th){h.push($(th).text().trim());}); this.api().rows({page:'current'}).nodes().toArray().forEach(function(r){$(r).find('td').each(function(i){if(h[i])$(this).attr('data-label',h[i]);});}); }
    });
  }
  if(document.readyState==='complete') setTimeout(initRombel,80); else $(window).on('load',function(){setTimeout(initRombel,80);});
  setTimeout(initRombel,300);
});
</script>
<script type="text/javascript">document.title = "Program Pelatihan <?= $profil[0]->Namalkp?>";</script>
