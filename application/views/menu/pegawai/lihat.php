<?php
$__total = count($pegawai);
$__laki = 0; $__perempuan = 0;
foreach ($pegawai as $__r) {
  $k = strtolower(trim($__r->Kelamin ?? ''));
  if (strpos($k, 'laki') !== false) $__laki++;
  elseif (strpos($k, 'perempuan') !== false) $__perempuan++;
}
$__today = date("Y-m-d 00:00:00"); $__todays = date("Y-m-d H:i:s");
$__pres = $this->db->query("SELECT NamaPegawai FROM presensi JOIN pegawai ON presensi.Nipd = pegawai.Nipg WHERE Tgl between '$__today' and '$__todays' AND pegawai=1")->result();
$__presCount = count($__pres);
?>
<style>
.modern-head h1{letter-spacing:-.02em}
.modern-stat .stat-icon{width:2.6rem;height:2.6rem;border-radius:.65rem;display:flex;align-items:center;justify-content:center;font-size:1rem}
.modern-stat.stat-total .stat-icon{background:rgba(37,99,235,.1);color:#2563eb}
.modern-stat.stat-laki .stat-icon{background:rgba(59,130,246,.12);color:#2563eb}
.modern-stat.stat-perempuan .stat-icon{background:rgba(236,72,153,.12);color:#db2777}
.modern-stat.stat-pres .stat-icon{background:rgba(16,185,129,.12);color:#059669}
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
.avatar-pegawai{background:rgba(37,99,235,.1);color:#2563eb}
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
/* modal modern */
.modal-pegawai .modal-content{border:0;border-radius:.9rem;box-shadow:0 20px 60px rgba(15,23,42,.18)}
.modal-pegawai .modal-header{border-bottom:1px solid #f1f5f9;padding:1.1rem 1.25rem}
.modal-pegawai .modal-body{padding:1.25rem}
.field-label{font-size:.78rem;font-weight:600;color:#334155;margin-bottom:.35rem;display:block}
.m-input{border-radius:.6rem;border:1px solid #e2e8f0;min-height:42px;font-size:.85rem;padding:.5rem .75rem;transition:border-color .15s,box-shadow .15s}
.m-input:focus{border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
</style>

<div class="modern-head d-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Pegawai</h1>
    <p class="text-muted small mb-0">Kelola data pegawai dan kehadiran harian</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Pegawai</li>
  </ol>
</div>

<?php if ($__presCount > 0) { ?>
<div class="alert d-flex align-items-center" style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:.7rem;padding:.75rem 1rem">
  <span class="d-flex align-items-center justify-content-center mr-3" style="width:32px;height:32px;border-radius:50%;background:#2563eb;color:#fff;flex-shrink:0"><i class="fas fa-bell" style="font-size:.7rem"></i></span>
  <div class="small" style="color:#1e40af"><strong><?= $__presCount ?> pegawai</strong> telah presensi hari ini — <span style="color:#334155"><?= html_escape(implode(', ', array_map(fn($r)=>$r->NamaPegawai,$__pres))) ?></span></div>
</div>
<?php } ?>

<div class="row mb-3">
  <div class="col-6 col-xl-3 mb-3">
    <div class="card modern-card modern-stat stat-total h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total Pegawai</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#1e293b"><?= $__total ?></div><div class="small text-muted" style="font-size:.72rem"><?= $__presCount ?> presensi hari ini</div></div><div class="stat-icon"><i class="fas fa-id-badge"></i></div></div></div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card modern-card modern-stat stat-laki h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Laki-laki</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#1e40af"><?= $__laki ?></div><div class="small text-muted" style="font-size:.72rem"><?= $__total?round($__laki/$__total*100):0 ?>% dari total</div></div><div class="stat-icon"><i class="fas fa-mars"></i></div></div></div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card modern-card modern-stat stat-perempuan h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Perempuan</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#9d174d"><?= $__perempuan ?></div><div class="small text-muted" style="font-size:.72rem"><?= $__total?round($__perempuan/$__total*100):0 ?>% dari total</div></div><div class="stat-icon"><i class="fas fa-venus"></i></div></div></div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card modern-card modern-stat stat-pres h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Presensi Hari Ini</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#065f46"><?= $__presCount ?></div><div class="small" style="font-size:.72rem;color:#059669"><?= $__total?round($__presCount/$__total*100):0 ?>% kehadiran</div></div><div class="stat-icon"><i class="fas fa-clipboard-check"></i></div></div></div>
  </div>
</div>

<div class="card modern-card mb-4">
  <div class="card-header py-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between" style="gap:.6rem">
    <div class="d-flex align-items-center" style="gap:.6rem">
      <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Daftar Pegawai</h6>
      <span class="badge" style="background:#f1f5f9;color:#475569;font-weight:600;font-size:.68rem;border-radius:9999px;padding:.3rem .55rem"><?= $__total ?> data</span>
    </div>
    <div class="d-flex align-items-center" style="gap:.5rem">
      <a href="<?= base_url('pegawai/form') ?>" class="btn btn-sm d-md-none" style="background:#fff;border:1px solid #e2e8f0;color:#475569;border-radius:.5rem;font-weight:600"><i class="fas fa-plus mr-1"></i> Tambah</a>
      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahPegs" style="background:#2563eb;border-color:#2563eb;border-radius:.5rem;font-weight:600;font-size:.78rem;padding:.42rem .75rem"><i class="fas fa-plus mr-1"></i> Tambah Pegawai</button>
    </div>
  </div>
  <div class="modern-table-wrap table-responsive">
    <table class="table modern-table table-hover mb-0" id="tabelpegawai" style="width:100%">
      <thead>
        <tr>
          <th>Pegawai</th>
          <th>No Induk</th>
          <th>Kelamin</th>
          <th>TTL</th>
          <th>Alamat</th>
          <th>Email</th>
          <th class="text-right" style="width:110px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pegawai as $tp) {
          $isLaki = stripos($tp->Kelamin ?? '', 'laki') !== false && stripos($tp->Kelamin, 'perempuan')===false;
          $badgeClass = $isLaki ? 'badge-laki' : 'badge-perempuan';
          $initials = strtoupper(substr(trim($tp->NamaPegawai),0,1) . (strpos(trim($tp->NamaPegawai),' ') ? substr(trim($tp->NamaPegawai), strpos(trim($tp->NamaPegawai),' ')+1,1) : ''));
          $ttl = trim(($tp->TempatLahir ?? '-') . ', ' . ($tp->TanggalLahir ?? '-'), ', -');
        ?>
          <tr>
            <td>
              <div class="d-flex align-items-center" style="gap:.6rem;min-width:160px">
                <div class="avatar-sm avatar-pegawai"><?= html_escape($initials) ?></div>
                <div style="min-width:0">
                  <div style="font-weight:700;color:#1e293b;font-size:.82rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:160px" title="<?= html_escape($tp->NamaPegawai) ?>"><?= html_escape($tp->NamaPegawai) ?></div>
                  <div class="mono" style="font-size:.7rem;color:#94a3b8"><?= html_escape($tp->TempatLahir ?? '-') ?></div>
                </div>
              </div>
            </td>
            <td><span class="mono" style="font-weight:600;color:#334155"><?= html_escape($tp->Nipg) ?></span></td>
            <td><span class="badge-kelamin <?= $badgeClass ?>"><?= html_escape($tp->Kelamin) ?></span></td>
            <td><span class="small" style="color:#475569"><?= html_escape($ttl) ?></span></td>
            <td><span class="small text-truncate d-inline-block" style="max-width:160px;color:#475569" title="<?= html_escape($tp->Alamat) ?>"><?= html_escape($tp->Alamat) ?></span></td>
            <td><span class="mono" style="font-size:.74rem;max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:inline-block;vertical-align:middle" title="<?= html_escape($tp->Email) ?>"><?= html_escape($tp->Email) ?></span></td>
            <td class="text-right">
              <div class="d-inline-flex" style="gap:.3rem">
                <a href="<?= base_url("presensi/pegawai?Id=$tp->Nipg") ?>" class="btn btn-sm" style="background:#eff6ff;border:1px solid #bfdbfe;color:#2563eb;border-radius:.45rem;padding:.32rem .45rem" title="Presensi"><i class="fas fa-clipboard-list" style="font-size:.7rem"></i></a>
                <a href="<?= base_url("pegawai/form_ubah/$tp->Id") ?>" class="btn btn-sm" style="background:#fff;border:1px solid #e2e8f0;color:#475569;border-radius:.45rem;padding:.32rem .45rem" title="Ubah"><i class="fas fa-pen" style="font-size:.7rem"></i></a>
                <a href="#" class="btn btn-sm" style="background:#fff;border:1px solid #fecaca;color:#dc2626;border-radius:.45rem;padding:.32rem .45rem" data-toggle="modal" data-target="#deletePeg<?= $tp->Id; ?>" title="Hapus"><i class="fas fa-trash-alt" style="font-size:.7rem"></i></a>
              </div>
              <div class="modal fade modal-pegawai" id="deletePeg<?= $tp->Id; ?>" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document" style="max-width:420px"><div class="modal-content"><div class="modal-body p-4 text-center"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;border-radius:50%;background:#fef2f2;color:#dc2626"><i class="fas fa-trash-alt"></i></div><h6 class="font-weight-bold mb-1" style="color:#1e293b">Hapus pegawai?</h6><p class="small text-muted mb-0">Yakin ingin menghapus <span style="font-weight:600;color:#334155"><?= html_escape($tp->NamaPegawai) ?></span> ?</p></div><div class="modal-footer border-0 pt-0 px-4 pb-4 d-flex" style="gap:.5rem"><button type="button" class="btn flex-fill" data-dismiss="modal" style="border:1px solid #e2e8f0;background:#fff;color:#475569;border-radius:.55rem;font-weight:600">Batal</button><a href="<?= base_url('pegawai/hapus/' . $tp->Id) ?>" class="btn btn-danger flex-fill" style="border-radius:.55rem;font-weight:600">Hapus</a></div></div></div></div>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php if ($__total === 0) { ?>
    <div class="text-center py-5 px-3"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;border-radius:.85rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-users fa-lg"></i></div><h6 class="font-weight-bold" style="color:#1e293b">Belum ada pegawai</h6><p class="small text-muted mb-3">Tambahkan pegawai pertama untuk mulai mengelola data.</p><button class="btn btn-primary" data-toggle="modal" data-target="#tambahPegs" style="border-radius:.6rem;font-weight:600"><i class="fas fa-plus mr-1"></i> Tambah Pegawai</button></div>
  <?php } ?>
</div>

<!-- modal tambah modern -->
<div class="modal fade modal-pegawai" id="tambahPegs" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:560px">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
          <span class="d-flex align-items-center justify-content-center mr-3" style="width:36px;height:36px;border-radius:.6rem;background:rgba(37,99,235,.1);color:#2563eb"><i class="fas fa-user-plus" style="font-size:.85rem"></i></span>
          <div><h6 class="modal-title mb-0" style="font-weight:700;color:#1e293b">Tambah Pegawai</h6><small class="text-muted" style="font-size:.72rem">Lengkapi data pegawai baru</small></div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="<?= base_url('pegawai/tambah'); ?>" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-8 mb-3"><label class="field-label">Nama Pegawai <span class="text-danger">*</span></label><input type="text" class="form-control m-input" name="ni" maxlength="100" required placeholder="Nama lengkap"></div>
            <div class="form-group col-md-4 mb-3"><label class="field-label">No Induk <span class="text-danger">*</span></label><input type="text" class="form-control m-input" name="nipg" required placeholder="NIPG"></div>
            <div class="form-group col-md-4 mb-3"><label class="field-label">Kelamin <span class="text-danger">*</span></label><select name="jk" class="form-control m-input" required><option value="" disabled selected>Pilih</option><option value="Laki - Laki">Laki - Laki</option><option value="Perempuan">Perempuan</option></select></div>
            <div class="form-group col-md-8 mb-3"><label class="field-label">Alamat <span class="text-danger">*</span></label><input type="text" class="form-control m-input" name="al" maxlength="100" required placeholder="Alamat lengkap"></div>
            <div class="form-group col-md-5 mb-3"><label class="field-label">Tempat Lahir <span class="text-danger">*</span></label><input type="text" class="form-control m-input" name="tl" maxlength="20" required placeholder="Kota lahir"></div>
            <div class="form-group col-md-7 mb-3" id="simple-date3"><label class="field-label">Tanggal Lahir <span class="text-danger">*</span></label><div class="input-group date"><div class="input-group-prepend"><span class="input-group-text bg-white" style="border-radius:.6rem 0 0 .6rem;border-color:#e2e8f0;color:#94a3b8"><i class="fas fa-calendar" style="font-size:.75rem"></i></span></div><input type="text" name="tgl" class="form-control m-input" placeholder="Tanggal Lahir" id="simpleDataInput" maxlength="20" required style="border-radius:0 .6rem .6rem 0;border-left:0"></div></div>
            <div class="form-group col-12 mb-0"><label class="field-label">Email <span class="text-danger">*</span></label><input type="email" class="form-control m-input" name="email" maxlength="30" required placeholder="email@contoh.com"></div>
          </div>
        </div>
        <div class="modal-footer border-0 pt-0 px-4 pb-4 d-flex" style="gap:.5rem"><button type="button" class="btn flex-fill" data-dismiss="modal" style="border:1px solid #e2e8f0;background:#fff;color:#475569;border-radius:.55rem;font-weight:600">Batal</button><button type="submit" class="btn btn-primary flex-fill" style="border-radius:.55rem;font-weight:600;background:#2563eb;border-color:#2563eb">Simpan</button></div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">document.title = "Pegawai <?= $profil[0]->Namalkp?>";</script>
<script>
$(function(){
  function initPeg(){
    var $t=$('#tabelpegawai'); if(!$t.length) return;
    if($.fn.DataTable.isDataTable($t)){ try{$t.DataTable().destroy();}catch(e){} $t.removeAttr('style'); }
    $t.DataTable({
      pageLength:10, lengthMenu:[5,10,25,50], order:[[0,'asc']],
      columnDefs:[{orderable:false,targets:[6]}],
      dom:'<"dt-top"lf>rt<"dt-bottom"ip>',
      language:{search:"",searchPlaceholder:"Cari pegawai, NIPG, email...",lengthMenu:"Tampil _MENU_",info:"Menampilkan _START_–_END_ dari _TOTAL_ data",infoEmpty:"Tidak ada data",infoFiltered:"(difilter dari _MAX_ total)",zeroRecords:"Tidak ada data yang cocok",emptyTable:"Belum ada pegawai",paginate:{first:"Awal",last:"Akhir",next:"›",previous:"‹"}},
      drawCallback:function(){ var h=[]; this.api().columns().header().toArray().forEach(function(th){h.push($(th).text().trim());}); this.api().rows({page:'current'}).nodes().toArray().forEach(function(r){$(r).find('td').each(function(i){if(h[i])$(this).attr('data-label',h[i]);});}); }
    });
  }
  if(document.readyState==='complete') setTimeout(initPeg,80); else $(window).on('load',function(){setTimeout(initPeg,80);});
  setTimeout(initPeg,300);
});
</script>
