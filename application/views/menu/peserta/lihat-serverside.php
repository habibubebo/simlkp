<?php
$__total = (int)($this->db->query("SELECT COUNT(*) as c FROM peserta")->row()->c ?? 0);
$__aktif = (int)($this->db->query("SELECT COUNT(*) as c FROM peserta WHERE Status=1")->row()->c ?? 0);
$__non = (int)($this->db->query("SELECT COUNT(*) as c FROM peserta WHERE Status=0")->row()->c ?? 0);
$__lulus = (int)($this->db->query("SELECT COUNT(*) as c FROM peserta WHERE Status=2")->row()->c ?? 0);
?>
<style>
.modern-head h1{letter-spacing:-.02em}
.modern-stat .stat-icon{width:2.6rem;height:2.6rem;border-radius:.65rem;display:flex;align-items:center;justify-content:center;font-size:1rem}
.modern-stat.stat-total .stat-icon{background:rgba(37,99,235,.1);color:#2563eb}
.modern-stat.stat-aktif .stat-icon{background:rgba(16,185,129,.12);color:#059669}
.modern-stat.stat-non .stat-icon{background:rgba(100,116,139,.12);color:#64748b}
.modern-stat.stat-lulus .stat-icon{background:rgba(139,92,246,.12);color:#7c3aed}
.modern-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04)}
.modern-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.modern-table{width:100%!important}
.modern-table thead th{font-size:.64rem;letter-spacing:.07em;text-transform:uppercase;color:#94a3b8;font-weight:700;border-top:0;border-bottom:1px solid #f1f5f9;white-space:nowrap;padding:.75rem .6rem;background:#fcfdff}
.modern-table tbody td{font-size:.78rem;color:#334155;vertical-align:middle;padding:.6rem .6rem;border-top:1px solid #f8fafc}
.modern-table tbody tr:first-child td{border-top:0}
.modern-table tbody tr:hover td{background:#f8fafc}
.mono{font-family:'SFMono-Regular',Consolas,'Liberation Mono',Menlo,monospace;font-size:.74rem;color:#475569}
.avatar-sm{width:32px;height:32px;border-radius:.5rem;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.7rem;flex-shrink:0}
.avatar-peserta{background:rgba(37,99,235,.1);color:#2563eb}
.badge-status{font-size:.66rem;font-weight:700;padding:.22rem .5rem;border-radius:9999px;border:1px solid transparent;letter-spacing:.02em}
.badge-aktif{background:#ecfdf5;color:#065f46;border-color:#a7f3d0}
.badge-non{background:#f1f5f9;color:#475569;border-color:#e2e8f0}
.badge-lulus{background:#ede9fe;color:#5b21b6;border-color:#ddd6fe}
.badge-jk{font-size:.66rem;font-weight:700;padding:.15rem .4rem;border-radius:9999px;border:1px solid transparent}
.badge-jk-l{background:#eff6ff;color:#1d4ed8;border-color:#bfdbfe}
.badge-jk-p{background:#fdf2f8;color:#be185d;border-color:#fbcfe8}
.modern-card .dataTables_wrapper{padding:0}
.modern-card .dt-top{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:.75rem;padding:1rem 1.1rem .85rem;border-bottom:1px solid #f1f5f9;background:#fff}
.modern-card .dataTables_length label{margin:0;display:flex;align-items:center;gap:.4rem;font-size:.78rem;color:#64748b;font-weight:500}
.modern-card .dataTables_length select{border:1px solid #e2e8f0;border-radius:.5rem;padding:.32rem 1.6rem .32rem .6rem;font-size:.78rem;color:#334155;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E") no-repeat right .5rem center;appearance:none;min-width:64px}
.modern-card .dataTables_filter label{margin:0;display:flex;align-items:center;gap:.5rem;font-size:.78rem;color:#64748b;font-weight:500}
.modern-card .dataTables_filter input{border:1px solid #e2e8f0;border-radius:.6rem;padding:.42rem .75rem .42rem 2rem;font-size:.82rem;color:#334155;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' stroke='%2394a3b8' stroke-width='1.7' viewBox='0 0 24 24'%3E%3Ccircle cx='11' cy='11' r='7'/%3E%3Cpath d='M20 20l-3.5-3.5'/%3E%3C/svg%3E") no-repeat 9px center;width:220px;transition:border-color .15s,box-shadow .15s}
.modern-card .dataTables_filter input:focus{outline:none;border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
.modern-card .dt-bottom{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:.75rem;padding:.85rem 1.1rem;border-top:1px solid #f1f5f9;background:#fcfdff}
.modern-card .dataTables_info{font-size:.76rem;color:#94a3b8;padding:0!important}
.modern-card .dataTables_paginate .pagination{margin:0;gap:.28rem}
.modern-card .dataTables_paginate .paginate_button{border:1px solid #e2e8f0!important;background:#fff!important;color:#475569!important;border-radius:.5rem!important;padding:.32rem .62rem!important;font-size:.76rem!important;font-weight:600!important;min-width:32px;text-align:center}
.modern-card .dataTables_paginate .paginate_button:hover{background:#f8fafc!important;border-color:#cbd5e1!important;color:#1e293b!important}
.modern-card .dataTables_paginate .paginate_button.current,.modern-card .dataTables_paginate .paginate_button.current:hover{background:#2563eb!important;border-color:#2563eb!important;color:#fff!important;box-shadow:0 2px 8px rgba(37,99,235,.25)}
.modern-card .dt-buttons{display:flex;align-items:center;gap:.4rem;flex-wrap:wrap}
.modern-card .dt-buttons .btn{border-radius:.5rem!important;font-size:.72rem!important;font-weight:600!important;padding:.35rem .6rem!important;border:1px solid #e2e8f0!important;background:#fff!important;color:#475569!important;box-shadow:none!important}
.modern-card .dt-buttons .btn:hover{background:#f8fafc!important;border-color:#cbd5e1!important;color:#1e293b!important}
.modern-card .dt-buttons .btn.btn-success{border-color:#a7f3d0!important;color:#065f46!important;background:#ecfdf5!important}
.modern-card .dt-buttons .btn.btn-danger{border-color:#fecaca!important;color:#991b1b!important;background:#fef2f2!important}
.modern-card .dt-buttons .btn.btn-info{border-color:#bfdbfe!important;color:#1e40af!important;background:#eff6ff!important}
.dt-btn{display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:.45rem;font-size:.7rem;border:1px solid transparent;transition:all .15s;flex-shrink:0;text-decoration:none!important}
.dt-btn-edit{background:#fff;border-color:#e2e8f0;color:#475569}
.dt-btn-edit:hover{background:#f8fafc;border-color:#cbd5e1;color:#1e293b}
.dt-btn-delete{background:#fff;border-color:#fecaca;color:#dc2626}
.dt-btn-delete:hover{background:#fef2f2;border-color:#fca5a5;color:#991b1b}
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}.modern-card .dt-top{flex-direction:column;align-items:stretch}.modern-card .dataTables_filter input{width:100%}.modern-card .dataTables_filter label{width:100%}.modern-card .dt-buttons{width:100%;justify-content:flex-start}}
</style>

<div class="modern-head d-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Peserta</h1>
    <p class="text-muted small mb-0">Kelola data peserta didik dan status keaktifan</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Peserta</li>
  </ol>
</div>

<?php if (!empty($alert)): ?>
<div class="alert d-flex align-items-center mb-3" style="background:#fef2f2;border:1px solid #fecaca;border-radius:.7rem;padding:.75rem 1rem">
  <span class="d-flex align-items-center justify-content-center mr-3" style="width:32px;height:32px;border-radius:50%;background:#dc2626;color:#fff;flex-shrink:0"><i class="fas fa-exclamation-triangle" style="font-size:.7rem"></i></span>
  <div class="small" style="color:#991b1b;font-weight:600"><?= $alert ?></div>
  <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<?php endif; ?>

<div class="row mb-3">
  <div class="col-6 col-xl-3 mb-3"><div class="card modern-card modern-stat stat-total h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total Peserta</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#1e293b"><?= $__total ?></div><div class="small text-muted" style="font-size:.72rem">Terdaftar</div></div><div class="stat-icon"><i class="fas fa-users"></i></div></div></div></div>
  <div class="col-6 col-xl-3 mb-3"><div class="card modern-card modern-stat stat-aktif h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Aktif</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#065f46"><?= $__aktif ?></div><div class="small" style="font-size:.72rem;color:#059669"><?= $__total?round($__aktif/$__total*100):0 ?>%</div></div><div class="stat-icon"><i class="fas fa-user-check"></i></div></div></div></div>
  <div class="col-6 col-xl-3 mb-3"><div class="card modern-card modern-stat stat-non h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Nonaktif</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#475569"><?= $__non ?></div><div class="small text-muted" style="font-size:.72rem"><?= $__non ?> peserta</div></div><div class="stat-icon"><i class="fas fa-user-times"></i></div></div></div></div>
  <div class="col-6 col-xl-3 mb-3"><div class="card modern-card modern-stat stat-lulus h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Lulus</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#5b21b6"><?= $__lulus ?></div><div class="small" style="font-size:.72rem;color:#7c3aed">Alumni</div></div><div class="stat-icon"><i class="fas fa-graduation-cap"></i></div></div></div></div>
</div>

<div class="card modern-card mb-4">
  <div class="card-header py-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between" style="gap:.6rem">
    <div class="d-flex align-items-center" style="gap:.6rem">
      <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Daftar Peserta</h6>
      <span class="badge" style="background:#f1f5f9;color:#475569;font-weight:600;font-size:.68rem;border-radius:9999px;padding:.3rem .55rem" id="badgeTotal"><?= $__total ?> data</span>
    </div>
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahPeserta" style="background:#2563eb;border-color:#2563eb;border-radius:.5rem;font-weight:600;font-size:.78rem;padding:.42rem .75rem"><i class="fas fa-plus mr-1"></i> Tambah Peserta</button>
  </div>
  <div class="table-responsive" style="border-radius:0 0 .85rem .85rem;overflow:hidden">
    <table class="table modern-table table-hover mb-0" id="tabelpeserta-tes" style="width:100%">
      <thead>
        <tr>
          <th>Peserta</th>
          <th>Status</th>
          <th class="text-center">JK</th>
          <th>Tempat, Tgl Lahir</th>
          <th>Program</th>
          <th>Masuk</th>
          <th class="text-right">Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>

<button class="fab-presensi" data-toggle="modal" data-target="#tambahPeserta" title="Tambah Peserta">
  <i class="fas fa-plus"></i>
</button>

<!-- Modal Tambah Peserta -->
<div class="modal fade peserta-app-modal" id="tambahPeserta" tabindex="-1" role="dialog" aria-labelledby="tambahPesertaTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-user-plus"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="tambahPesertaTitle">Tambah Peserta</h5>
            <div class="presensi-subtitle">Daftarkan peserta kursus baru</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form action="<?= base_url('peserta/tambah') ?>" method="POST" id="formTambahPesertaBaru" class="modal-body px-3 px-sm-4 py-3">
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="tpNipd">Nomor Induk</label>
            <input type="text" class="form-control presensi-input" id="tpNipd" name="Nipd" maxlength="20" required>
          </div>
          <div class="form-group col-6 mb-3">
            <div class="field-label" id="tpStatusLabel">Status</div>
            <div class="seg-group" role="radiogroup" aria-labelledby="tpStatusLabel">
              <input type="radio" name="Status" id="tpSt0" value="0">
              <label for="tpSt0">Nonaktif</label>
              <input type="radio" name="Status" id="tpSt1" value="1" checked>
              <label for="tpSt1">Aktif</label>
              <input type="radio" name="Status" id="tpSt2" value="2">
              <label for="tpSt2">Lulus</label>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="tpNokk">No Kartu Keluarga</label>
            <input type="text" class="form-control presensi-input" id="tpNokk" name="Nokk" maxlength="30" value="-">
          </div>
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="tpNik">No Induk Keluarga</label>
            <input type="text" class="form-control presensi-input" id="tpNik" name="Nik" maxlength="30" value="-">
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="tpNama">Nama Peserta</label>
          <input type="text" class="form-control presensi-input" id="tpNama" name="Nama" maxlength="50" required>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="tpTtl">Tempat, Tanggal Lahir</label>
          <input type="text" class="form-control presensi-input" id="tpTtl" name="Tgl" maxlength="50" placeholder="Contoh: Bandung, 12 Mei 2005" required>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="tpJk">Jenis Kelamin</label>
            <select class="form-control presensi-input" id="tpJk" name="Jk" required>
              <option value="" selected disabled>Pilih kelamin</option>
              <option value="Laki - Laki">Laki - Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="tpJenis">Jenis Kursus</label>
            <select class="form-control presensi-input" id="tpJenis" name="Jenis" required>
              <option value="" selected disabled>Pilih kursus</option>
              <?php
              $data = $this->db->query("SELECT * FROM rombel")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= html_escape($row->Namarombel) ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="tpKls">Kelas</label>
            <select class="form-control presensi-input" id="tpKls" name="Kls" required>
              <option value="" selected disabled>Pilih kelas</option>
              <?php foreach ($rombel as $row) { ?>
                <option value="<?= $row->Kelas ?>"><?= html_escape($row->Namarombel . ' - ' . $row->Kelas) ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-6 mb-3" id="tp-date-masuk">
            <label class="field-label" for="tpTglmasuk">Tanggal Masuk</label>
            <div class="input-group date">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
              </div>
              <input type="text" name="Tglmasuk" class="form-control presensi-input" id="tpTglmasuk" required readonly autocomplete="off">
            </div>
          </div>
        </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formTambahPesertaBaru" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Peserta -->
<div class="modal fade peserta-app-modal" id="modalEditPeserta" tabindex="-1" role="dialog" aria-labelledby="modalEditPesertaTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-user-edit"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="modalEditPesertaTitle">Ubah Peserta</h5>
            <div class="presensi-subtitle">Perbarui data peserta kursus</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form action="<?= base_url('peserta/ubah') ?>" method="POST" id="formUbahPeserta" class="modal-body px-3 px-sm-4 py-3">
        <input type="hidden" name="Id" id="epId">
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="epNipd">Nomor Induk</label>
            <input type="text" class="form-control presensi-input" id="epNipd" name="Nipd" maxlength="20" required>
          </div>
          <div class="form-group col-6 mb-3">
            <div class="field-label" id="epStatusLabel">Status</div>
            <div class="seg-group" role="radiogroup" aria-labelledby="epStatusLabel">
              <input type="radio" name="Status" id="epSt0" value="0">
              <label for="epSt0">Nonaktif</label>
              <input type="radio" name="Status" id="epSt1" value="1">
              <label for="epSt1">Aktif</label>
              <input type="radio" name="Status" id="epSt2" value="2">
              <label for="epSt2">Lulus</label>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="epNokk">No Kartu Keluarga</label>
            <input type="text" class="form-control presensi-input" id="epNokk" name="Nokk" maxlength="30" required>
          </div>
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="epNik">No Induk Keluarga</label>
            <input type="text" class="form-control presensi-input" id="epNik" name="Nik" maxlength="30" required>
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="epNama">Nama Peserta</label>
          <input type="text" class="form-control presensi-input" id="epNama" name="Nama" maxlength="50" required>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="epTtl">Tempat, Tanggal Lahir</label>
          <input type="text" class="form-control presensi-input" id="epTtl" name="Tgl" maxlength="50" required>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="epJk">Jenis Kelamin</label>
            <select class="form-control presensi-input" id="epJk" name="Jk" required>
              <option value="Laki - Laki">Laki - Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="epJenis">Jenis Kursus</label>
            <select class="form-control presensi-input" id="epJenis" name="Jenis" required>
              <?php
              $data = $this->db->query("SELECT * FROM rombel")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= html_escape($row->Namarombel) ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="epKls">Kelas</label>
            <select class="form-control presensi-input" id="epKls" name="Kls" required>
              <?php foreach ($rombel as $row) { ?>
                <option value="<?= $row->Kelas ?>"><?= html_escape($row->Namarombel . ' - ' . $row->Kelas) ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-6 mb-3" id="ep-date-masuk">
            <label class="field-label" for="epTglmasuk">Tanggal Masuk</label>
            <div class="input-group date">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
              </div>
              <input type="text" name="Tglmasuk" class="form-control presensi-input" id="epTglmasuk" required readonly autocomplete="off">
            </div>
          </div>
        </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formUbahPeserta" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<style>
.peserta-app-modal .modal-content{
  border:0;border-radius:.75rem;max-height:calc(100vh - 3.5rem);box-shadow:0 20px 60px rgba(15,23,42,.22)
}
@supports (height: 100dvh){.peserta-app-modal .modal-content{max-height:calc(100dvh - 3.5rem)}}
.peserta-app-modal .modal-header,.peserta-app-modal .modal-footer{flex-shrink:0}
.peserta-app-modal .modal-body{flex:1 1 auto;min-height:0;overflow-y:auto;overscroll-behavior:contain}
.minw-0{min-width:0}
.presensi-icon{width:2.5rem;height:2.5rem;border-radius:.6rem;display:inline-flex;align-items:center;justify-content:center;background:rgba(37,99,235,.1);color:#2563eb;font-size:1.05rem;flex-shrink:0}
.presensi-subtitle{font-size:.8rem;color:#6b7280;margin-top:.1rem}
.presensi-close{width:2.5rem;height:2.5rem;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.35rem;color:#6b7280;transition:background-color .15s,color .15s}
.peserta-app-modal .presensi-close:hover{background:#f1f5f9;color:#111827}
.field-label{font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.35rem;display:block}
.peserta-app-modal .form-control{border-radius:.6rem}
.peserta-app-modal .input-group-text{border-radius:.6rem 0 0 .6rem;border-right:0}
.peserta-app-modal .input-group>.form-control{border-radius:0 .6rem .6rem 0}
.peserta-app-modal .form-control:focus{border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.15)}
.presensi-input{min-height:44px;font-size:16px}
.modal-footer .presensi-btn{min-height:48px;border-radius:.55rem;font-weight:600}
.seg-group{display:flex;background:#eef1f6;border-radius:.65rem;padding:.25rem;min-height:44px}
.seg-group input[type="radio"]{position:absolute;opacity:0;pointer-events:none}
.seg-group label{flex:1 1 0;min-width:0;min-height:36px;display:flex;align-items:center;justify-content:center;padding:.15rem .25rem;margin:0;border-radius:.5rem;font-size:.85rem;font-weight:600;color:#6b7280;cursor:pointer;text-align:center;transition:background-color .15s,color .15s,box-shadow .15s}
.seg-group label:hover{color:#374151}
.seg-group input:checked+label{background:#fff;color:#2563eb;box-shadow:0 1px 4px rgba(15,23,42,.18)}
.seg-group input:focus-visible+label{box-shadow:0 0 0 .2rem rgba(37,99,235,.25)}
@media (max-width:575.98px){
  .peserta-app-modal .modal-dialog{margin:0;max-width:100%;height:100%;overscroll-behavior:contain}
  @supports (height: 100svh){.peserta-app-modal .modal-dialog{height:100svh}}
  .peserta-app-modal .modal-content{height:100%;max-height:none;border-radius:1.25rem 1.25rem 0 0;box-shadow:0 -8px 40px rgba(15,23,42,.18);overscroll-behavior:contain}
  .peserta-app-modal .modal-header{justify-content:flex-start;padding:.85rem 1rem .85rem .5rem;border-bottom:1px solid #eef0f4}
  .peserta-app-modal .presensi-close{order:-1;margin:0 .35rem 0 0;color:#2563eb;flex-shrink:0}
  .peserta-app-modal .presensi-close:hover{background:rgba(37,99,235,.08);color:#2563eb}
  .peserta-app-modal .presensi-title-wrap{margin-left:.15rem!important}
  .peserta-app-modal .modal-footer{flex-direction:column-reverse;align-items:stretch;padding:.65rem 1rem calc(.75rem + env(safe-area-inset-bottom,0px))}
  .peserta-app-modal .modal-footer .presensi-btn{width:100%;margin-left:0!important;border-radius:9999px}
  .peserta-app-modal .modal-footer .btn-secondary{min-height:42px;background:rgba(37,99,235,.07);border-color:transparent;color:#2563eb}
  .peserta-app-modal .modal-footer .btn-secondary:hover,.peserta-app-modal .modal-footer .btn-secondary:focus{background:rgba(37,99,235,.14);border-color:transparent;color:#1d4ed8}
}
@media (max-width:575.98px) and (prefers-reduced-motion:no-preference){
  .peserta-app-modal.fade .modal-dialog{transform:translateY(28px)}
  .peserta-app-modal.show .modal-dialog{transform:none}
}
@media (min-width:576px){.peserta-app-modal .modal-dialog{max-width:540px}}
@media (prefers-reduced-motion:reduce){.presensi-close{transition:none}}
html.app-modal-open,html.app-modal-open body{overflow:hidden!important;overscroll-behavior:none}
</style>
<script>
if(window.jQuery){
  window.jQuery(document).on('show.bs.modal','.peserta-app-modal',function(){document.documentElement.classList.add('app-modal-open')});
  window.jQuery(document).on('hidden.bs.modal',function(){if(!document.querySelector('.modal.show'))document.documentElement.classList.remove('app-modal-open')});
}
</script>
<script type="text/javascript">document.title = "Peserta Didik <?= $profil[0]->Namalkp ?>";</script>

<script>
var tabel = null;
function updateUrlParameter(url, param, paramVal){
  var u=new URL(url, window.location.origin);
  u.searchParams.set(param, paramVal);
  return u.toString();
}
function initialsFromName(n){
  if(!n) return '?';
  var parts=n.trim().split(/\s+/);
  if(parts.length===1) return parts[0].substring(0,2).toUpperCase();
  return (parts[0][0]+parts[parts.length-1][0]).toUpperCase();
}
function escHtml(s){
  if(s==null) return '';
  return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
$(document).ready(function(){
  var urlParams=new URLSearchParams(window.location.search);
  var page=urlParams.get('page')||1;
  var search=urlParams.get('search')||'';
  tabel=$('#tabelpeserta-tes').DataTable({
    processing:true,
    responsive:false,
    serverSide:true,
    ordering:true,
    order:[[6,'desc']],
    ajax:{url:"<?= base_url('cek/view2'); ?>",type:"POST"},
    deferRender:true,
    pageLength:10,
    lengthMenu:[5,10,25,50],
    dom:'<"dt-top"lfB>rt<"dt-bottom"ip>',
    language:{search:"",searchPlaceholder:"Cari nama, NIPD, program...",lengthMenu:"Tampil _MENU_",info:"Menampilkan _START_–_END_ dari _TOTAL_ peserta",infoEmpty:"Tidak ada peserta",infoFiltered:"(difilter dari _MAX_ total)",zeroRecords:"Tidak ada data yang cocok",emptyTable:"Belum ada peserta",paginate:{first:"Awal",last:"Akhir",next:"›",previous:"‹"}},
    columns:[
      {data:"Nama"},
      {data:"Status"},
      {data:"Kelamin"},
      {data:"Ttl"},
      {data:"Namarombel"},
      {data:"Tglmasuk"},
      {data:"Idp"}
    ],
    columnDefs:[
      {
        targets:0,
        render:function(data,type,row){
          var init=initialsFromName(row.Nama);
          var nipd=escHtml(row.Nipd);
          var nama=escHtml(row.Nama);
          return '<div class="d-flex align-items-center" style="gap:.6rem;min-width:180px"><div class="avatar-sm avatar-peserta">'+init+'</div><div style="min-width:0"><a href="'+appPath+'presensi/peserta?Id='+row.Idp+'" style="font-weight:700;color:#1e293b;font-size:.82rem;text-decoration:none;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:150px;display:block" title="'+nama+'">'+nama+'</a><span class="mono" style="font-size:.7rem;color:#94a3b8">'+nipd+'</span></div></div>';
        }
      },
      {
        targets:1,
        orderable:false,
        render:function(data,type,row){
          if(row.Status=='0') return '<span class="badge-status badge-non">Nonaktif</span>';
          if(row.Status=='1') return '<span class="badge-status badge-aktif">Aktif</span>';
          return '<span class="badge-status badge-lulus">Lulus</span>';
        }
      },
      {
        targets:2,
        className:"text-center",
        render:function(data,type,row){
          var isL=(row.Kelamin||'').toLowerCase().indexOf('laki')!==-1;
          return isL ? '<span class="badge-jk badge-jk-l">L</span>' : '<span class="badge-jk badge-jk-p">P</span>';
        }
      },
      {
        targets:3,
        render:function(data,type,row){
          return '<span class="small" style="color:#475569;white-space:nowrap">'+escHtml(row.Ttl||'-')+'</span>';
        }
      },
      {
        targets:4,
        render:function(data,type,row){
          var prog=escHtml(row.Namarombel||'-');
          var kelas=escHtml(row.Kelas||'');
          return '<div style="line-height:1.25"><span style="font-weight:600;color:#1e293b;font-size:.78rem;white-space:nowrap">'+prog+'</span>'+(kelas ? '<br><span class="badge" style="background:#f8fafc;color:#334155;border:1px solid #e2e8f0;font-size:.62rem;border-radius:.3rem;padding:.12rem .32rem;margin-top:.15rem;display:inline-block">'+kelas+'</span>' : '')+'</div>';
        }
      },
      {
        targets:5,
        render:function(data,type,row){
          var v=row.Tglmasuk;
          if(!v || v==='0000-00-00' || v==='0000-00-00 00:00:00') return '<span class="mono" style="color:#94a3b8">-</span>';
          var d=new Date(v);
          if(isNaN(d.getTime())) return '<span class="mono">'+escHtml(v.substring(0,10))+'</span>';
          var dd=String(d.getDate()).padStart(2,'0')+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+d.getFullYear();
          return '<span class="mono">'+dd+'</span>';
        }
      },
      {
        targets:6,
        orderable:false,
        className:"text-right",
        render:function(data,type,row){
          var id=row.Idp;
          var namaAttr=escHtml(row.Nama).replace(/"/g,'&quot;');
          return '<div class="d-inline-flex" style="gap:.3rem">'
            +'<a href="#" class="dt-btn dt-btn-edit btn-edit-peserta" data-id="'+id+'" title="Ubah"><i class="fas fa-pen"></i></a>'
            +'<a href="#" class="dt-btn dt-btn-delete" data-toggle="modal" data-target="#deleteuser'+id+'" title="Hapus"><i class="fas fa-trash-alt"></i></a>'
            +'</div>'
            +'<div class="modal fade" id="deleteuser'+id+'" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document" style="max-width:420px"><div class="modal-content" style="border:0;border-radius:.9rem;box-shadow:0 20px 60px rgba(15,23,42,.18)"><div class="modal-body p-4 text-center"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;border-radius:50%;background:#fef2f2;color:#dc2626"><i class="fas fa-trash-alt"></i></div><h6 class="font-weight-bold mb-1" style="color:#1e293b">Hapus peserta?</h6><p class="small text-muted mb-0">Yakin ingin menghapus <span style="font-weight:600;color:#334155">'+namaAttr+'</span> ?</p></div><div class="modal-footer border-0 pt-0 px-4 pb-4 d-flex" style="gap:.5rem"><button type="button" class="btn flex-fill" data-dismiss="modal" style="border:1px solid #e2e8f0;background:#fff;color:#475569;border-radius:.55rem;font-weight:600">Batal</button><a href="'+appPath+'peserta/hapus/'+id+'" class="btn btn-danger flex-fill" style="border-radius:.55rem;font-weight:600">Hapus</a></div></div></div></div>';
        }
      }
    ],
    buttons:[
      {extend:'excelHtml5',text:'<i class="fas fa-file-excel"></i> Excel',className:'btn btn-success',exportOptions:{columns:[0,1,2,3,4,5]}},
      {extend:'pdfHtml5',text:'<i class="fas fa-file-pdf"></i> PDF',className:'btn btn-danger',exportOptions:{columns:[0,1,2,3,4,5]}},
      {extend:'print',text:'<i class="fas fa-print"></i> Print',className:'btn btn-info',exportOptions:{columns:[0,1,2,3,4,5]}}
    ],
    drawCallback:function(){
      var h=[]; this.api().columns().header().toArray().forEach(function(th){h.push($(th).text().trim());});
      this.api().rows({page:'current'}).nodes().toArray().forEach(function(r){$(r).find('td').each(function(i){if(h[i]) $(this).attr('data-label',h[i]);});});
    }
  });
  tabel.on('page.dt',function(){
    var pi=tabel.page.info(); var cp=pi.page+1; var sv=tabel.search();
    var u=updateUrlParameter(window.location.href,'page',cp);
    u=updateUrlParameter(u,'search',sv);
    window.history.replaceState(null,'',u);
  });
  tabel.on('search.dt',function(){
    var pi=tabel.page.info(); var cp=pi.page+1;
    var u=updateUrlParameter(window.location.href,'page',cp);
    u=updateUrlParameter(u,'search',tabel.search());
    window.history.replaceState(null,'',u);
  });
  // update badge total on draw
  tabel.on('draw',function(){
    var info=tabel.page.info();
    $('#badgeTotal').text(info.recordsTotal+' data');
  });
});
</script>
<script>
$(document).ready(function(){
  $('#tp-date-masuk .input-group.date, #ep-date-masuk .input-group.date').datepicker({format:'yyyy-mm-dd',autoclose:true,todayHighlight:true,todayBtn:'linked'});
  [['tp-date-masuk','tpTglmasuk'],['ep-date-masuk','epTglmasuk']].forEach(function(pair){
    var icon=document.querySelector('#'+pair[0]+' .input-group-text');
    if(icon) icon.addEventListener('click',function(){document.getElementById(pair[1]).focus();});
  });
  $('#tabelpeserta-tes tbody').on('click','.btn-edit-peserta',function(e){
    e.preventDefault();
    if(!window.tabel) return;
    var id=String($(this).data('id'));
    var rows=tabel.rows().data().toArray();
    var r=null;
    for(var i=0;i<rows.length;i++){ if(String(rows[i].Idp)===id){ r=rows[i]; break; } }
    if(!r) return;
    $('#epId').val(r.Idp);
    $('#epNipd').val(r.Nipd);
    $('#formUbahPeserta input[name="Status"]').prop('checked',false);
    $('#formUbahPeserta input[name="Status"][value="'+String(r.Status)+'"]').prop('checked',true);
    $('#epNokk').val(r.Nokk||'-');
    $('#epNik').val(r.Nik||'-');
    $('#epNama').val(r.Nama);
    $('#epJk').val(r.Kelamin);
    $('#epTtl').val(r.Ttl);
    $('#epJenis').val(String(r.Jeniskursus));
    $('#epKls').val(r.Kelas);
    $('#epTglmasuk').val((r.Tglmasuk||'').substring(0,10));
    if($('#epTglmasuk').data('datepicker')){ $('#epTglmasuk').datepicker('update'); }
    $('#modalEditPeserta').modal('show');
  });
});
</script>
