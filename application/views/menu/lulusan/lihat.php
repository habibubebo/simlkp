<?php
$__totalLulus = count($lulusan);
$__bulanIni = 0; $__tahunIni = 0; $__progSet = [];
$__nowM = date('Y-m'); $__nowY = date('Y');
foreach ($lulusan as $__r) {
  $tgl = $__r->Tgllulus ?? '';
  if ($tgl && date('Y-m', strtotime($tgl)) === $__nowM) $__bulanIni++;
  if ($tgl && date('Y', strtotime($tgl)) === $__nowY) $__tahunIni++;
  $pn = trim($__r->Namarombel ?? '');
  if ($pn !== '') $__progSet[$pn] = true;
}
$__progCount = count($__progSet);
?>
<style type="text/css">
.modern-head h1{letter-spacing:-.02em}
.notes-card .note-row{transition:background .15s}
.notes-card .note-row:hover{background:#f8fafc}
.notes-card .note-label{font-size:.72rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700;color:#64748b}
.notes-card .note-jenis-wrap{display:inline-flex;align-items:center;gap:.35rem;max-width:100%}
.notes-card .note-dot{width:7px;height:7px;border-radius:50%;background:#f59e0b;flex-shrink:0;opacity:.9}
.edit{display:inline-flex;align-items:center;gap:.4rem;max-width:100%;padding:.3rem .55rem;margin:-.3rem -.1rem;border-radius:.5rem;border:1px solid transparent;cursor:pointer;transition:background .15s,border-color .15s,color .15s;word-break:break-word}
.edit:hover{background:#f1f5f9;border-color:#e2e8f0;color:#1e293b}
.edit:focus-visible{outline:none;border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.15)}
.edit .edit-icon{opacity:0;transform:translateX(-2px);transition:opacity .15s,transform .15s;color:#94a3b8;font-size:.7rem;flex-shrink:0}
.edit:hover .edit-icon,.edit:focus-visible .edit-icon{opacity:1;transform:translateX(0)}
.edit.is-editing{opacity:.6;pointer-events:none}
.txtedit{display:none;width:100%;border:1px solid #e2e8f0;border-radius:.6rem;padding:.42rem .65rem;font-size:.82rem;color:#1e293b;background:#fff;transition:border-color .15s,box-shadow .15s}
.txtedit:focus{outline:none;border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12);background:#fff}
.txtedit.saving{opacity:.7;pointer-events:none}
.note-saved{font-size:.68rem;font-weight:600;color:#059669;opacity:0;transform:translateY(2px);transition:opacity .2s,transform .2s}
.note-saved.show{opacity:1;transform:translateY(0)}
.modern-stat .stat-icon{width:2.6rem;height:2.6rem;border-radius:.65rem;display:flex;align-items:center;justify-content:center;font-size:1rem}
.modern-stat.stat-total .stat-icon{background:rgba(37,99,235,.1);color:#2563eb}
.modern-stat.stat-bulan .stat-icon{background:rgba(16,185,129,.12);color:#059669}
.modern-stat.stat-tahun .stat-icon{background:rgba(139,92,246,.12);color:#7c3aed}
.modern-stat.stat-prog .stat-icon{background:rgba(245,158,11,.14);color:#d97706}
.modern-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04)}
.modern-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.modern-table{width:100%!important}
.modern-table thead th{font-size:.64rem;letter-spacing:.07em;text-transform:uppercase;color:#94a3b8;font-weight:700;border-top:0;border-bottom:1px solid #f1f5f9;white-space:nowrap;padding:.75rem .6rem;background:#fcfdff}
.modern-table tbody td{font-size:.78rem;color:#334155;vertical-align:middle;padding:.6rem .6rem;border-top:1px solid #f8fafc}
.modern-table tbody tr:first-child td{border-top:0}
.modern-table tbody tr:hover td{background:#f8fafc}
.mono{font-family:'SFMono-Regular',Consolas,'Liberation Mono',Menlo,monospace;font-size:.74rem;color:#475569}
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
.dt-btn{display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:.45rem;font-size:.7rem;border:1px solid transparent;transition:all .15s;flex-shrink:0;text-decoration:none!important}
.dt-btn-edit{background:#fff;border-color:#e2e8f0;color:#475569}
.dt-btn-edit:hover{background:#f8fafc;border-color:#cbd5e1;color:#1e293b}
.dt-btn-print{background:#fffbeb;border-color:#fde68a;color:#92400e}
.dt-btn-print:hover{background:#fef3c7;border-color:#fcd34d;color:#78350f}
.dt-btn-delete{background:#fff;border-color:#fecaca;color:#dc2626}
.dt-btn-delete:hover{background:#fef2f2;border-color:#fca5a5;color:#991b1b}
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}.modern-card .dt-top{flex-direction:column;align-items:stretch}.modern-card .dataTables_filter input{width:100%}.modern-card .dataTables_filter label{width:100%}}
</style>
<div class="modern-head d-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Lulusan</h1>
    <p class="text-muted small mb-0">Data alumni yang telah menyelesaikan pelatihan</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Lulusan</li>
  </ol>
</div>
<div class="row mb-3">
  <div class="col-6 col-xl-3 mb-3"><div class="card modern-card modern-stat stat-total h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total Lulusan</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#1e293b"><?= $__totalLulus ?></div><div class="small text-muted" style="font-size:.72rem">Alumni terdata</div></div><div class="stat-icon"><i class="fas fa-graduation-cap"></i></div></div></div></div>
  <div class="col-6 col-xl-3 mb-3"><div class="card modern-card modern-stat stat-bulan h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Bulan Ini</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#065f46"><?= $__bulanIni ?></div><div class="small text-muted" style="font-size:.72rem"><?= date('F Y') ?></div></div><div class="stat-icon"><i class="fas fa-calendar-check"></i></div></div></div></div>
  <div class="col-6 col-xl-3 mb-3"><div class="card modern-card modern-stat stat-tahun h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Tahun Ini</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#5b21b6"><?= $__tahunIni ?></div><div class="small text-muted" style="font-size:.72rem"><?= date('Y') ?> lulus</div></div><div class="stat-icon"><i class="fas fa-chart-line"></i></div></div></div></div>
  <div class="col-6 col-xl-3 mb-3"><div class="card modern-card modern-stat stat-prog h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Program</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#92400e"><?= $__progCount ?></div><div class="small text-muted" style="font-size:.72rem">Jenis kursus</div></div><div class="stat-icon"><i class="fas fa-layer-group"></i></div></div></div></div>
</div>
<!-- Content - Catatan inline edit modern -->
<div class="row">
  <div class="col-12 mb-3">
    <div class="card modern-card notes-card">
      <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center" style="gap:.6rem">
          <span class="d-flex align-items-center justify-content-center" style="width:32px;height:32px;border-radius:.6rem;background:#fffbeb;color:#d97706;border:1px solid #fde68a;flex-shrink:0"><i class="fas fa-sticky-note" style="font-size:.8rem"></i></span>
          <div>
            <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Catatan Sertifikat</h6>
            <div class="small text-muted" style="font-size:.70rem;margin-top:.1rem">Klik isi catatan untuk ubah, Enter simpan, Esc batal</div>
          </div>
        </div>
      </div>
      <div style="border-radius:0 0 .85rem .85rem;overflow:hidden">
        <div class="d-none d-md-flex align-items-center px-3 py-2" style="background:#fcfdff;border-bottom:1px solid #f1f5f9;gap:.75rem">
          <span class="note-label" style="width:200px;flex-shrink:0">Jenis</span>
          <span class="note-label" style="flex:1">Isi Catatan</span>
          <span class="note-label" style="width:70px;flex-shrink:0;text-align:right">Status</span>
        </div>
        <?php foreach ($notes as $tp) { ?>
          <div class="note-row d-flex flex-column flex-md-row align-items-stretch align-items-md-center px-3 py-3" style="gap:.6rem;border-top:1px solid #f8fafc">
            <div class="d-flex align-items-center" style="width:100%;max-width:200px;flex-shrink:0;gap:.5rem;min-width:0">
              <span class="note-dot d-none d-md-inline-block"></span>
              <div style="flex:1;min-width:0">
                <div class="d-md-none note-label mb-1">Jenis</div>
                <span class="d-inline-flex align-items-center" style="font-size:.82rem;font-weight:700;color:#1e293b;background:#f8fafc;border:1px solid #e2e8f0;border-radius:9999px;padding:.22rem .55rem;max-width:100%;word-break:break-word"><?= html_escape($tp->jenis) ?></span>
              </div>
            </div>
            <div style="flex:1;min-width:0">
              <div class="d-md-none note-label mb-1">Isi Catatan</div>
              <span class="edit" data-id="<?= $tp->id ?>" data-field="data" tabindex="0" role="button" aria-label="Ubah data"><span class="edit-text"><?= $tp->data !== '' ? html_escape($tp->data) : '<em style="color:#94a3b8;font-style:normal">Belum diisi</em>' ?></span><i class="fas fa-pen edit-icon"></i></span>
              <input type="text" class="txtedit pk" data-id="<?= $tp->id ?>" data-field="data" id="datatxt_<?= $tp->id ?>" value="<?= html_escape($tp->data) ?>" placeholder="Tulis catatan..." aria-label="Edit data">
            </div>
            <div class="d-flex align-items-center justify-content-between justify-content-md-end" style="width:100%;max-width:70px;flex-shrink:0;gap:.4rem">
              <span class="note-saved" id="saved-<?= $tp->id ?>"><i class="fas fa-check mr-1"></i>Tersimpan</span>
            </div>
          </div>
        <?php } ?>
        <?php if (empty($notes)) { ?>
          <div class="text-center py-4 px-3">
            <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:44px;height:44px;border-radius:.7rem;background:#fffbeb;border:1px solid #fde68a;color:#d97706"><i class="fas fa-sticky-note"></i></div>
            <div class="small font-weight-bold" style="color:#1e293b">Belum ada catatan</div>
            <div class="small text-muted">Tambahkan catatan melalui menu master data</div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<div class="card modern-card mb-4">
  <div class="card-header py-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between" style="gap:.6rem">
    <div class="d-flex align-items-center" style="gap:.6rem">
      <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Daftar Lulusan</h6>
    </div>
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah" style="background:#2563eb;border-color:#2563eb;border-radius:.5rem;font-weight:600;font-size:.78rem;padding:.42rem .75rem"><i class="fas fa-plus mr-1"></i> Tambah Lulusan</button>
  </div>
  <div class="table-responsive">
    <table class="table modern-table table-hover mb-0" id="tabellulusan" style="width:100%">
          <thead class="thead-light">
            <tr>
              <th>Nama</th>
              <th>No Induk</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kursus</th>
              <th>Periode</th>
              <th>Tanggal Cetak</th>
              <th>Instruktur</th>
              <th>Nilai</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($lulusan as $tp) {

            ?>
              <tr>
                <td><?= $tp->Nama ?></td>
                <td><?= $tp->Nipd ?></td>
                <td><?= $tp->Ttl ?></td>
                <td><?= $tp->Namarombel ?></td>
                <td>
                  <div style="line-height:1.3;display:flex;flex-direction:column;gap:.15rem">
                    <span class="mono" style="font-size:.72rem;color:#334155;white-space:nowrap"><?= date("d-m-Y",strtotime($tp->Tglmasuk)) ?> <span style="color:#94a3b8;font-weight:500;font-size:.65rem">Masuk</span></span>
                    <span class="mono" style="font-size:.72rem;color:#334155;white-space:nowrap"><?= date("d-m-Y",strtotime($tp->Tgllulus)) ?> <span style="color:#94a3b8;font-weight:500;font-size:.65rem">Lulus</span></span>
                  </div>
                </td>
                <td><?= date("d-m-Y",strtotime($tp->Tglcetak))  ?></td>
                <td><?= $tp->NamaInstruktur ?></td>
                <td><?php $nilais=[]; for($i=1;$i<=6;$i++){ $v=trim((string)$tp->{'n'.$i}); if($v!=='') $nilais[]=$v; } echo $nilais?html_escape(implode(', ',$nilais)):''; ?></td>
                <td>
                  <div class="d-inline-flex" style="gap:.3rem">
                    <a href="#" class="dt-btn dt-btn-edit btn-edit-lulusan" data-id="<?= $tp->Idl ?>" title="Ubah"><i class="fas fa-pen"></i></a>
                    <a href="<?= base_url("sertifikat?Id=$tp->Idl") ?>" target="_blank" class="dt-btn dt-btn-print" title="Cetak Sertifikat"><i class="fas fa-print"></i></a>
                    <a href="#" class="dt-btn dt-btn-delete" data-toggle="modal" data-target="#deleteuser<?= $tp->Idl; ?>" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                  </div>
                  
                  <!-- modal delete -->
                  <div class="example-modal">
                    <div id="deleteuser<?= $tp->Idl; ?>" class="modal fade" role="dialog" style="display:none;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title">Konfirmasi Delete Data</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body">
                            <h6 align="center">Apakah anda yakin ingin menghapus data <?= $tp->Nama; ?><strong><span class="grt"></span></strong> ?</h6>
                          </div>
                          <div class="modal-footer">
                            <a href="<?= base_url('lulusan/hapus/' . $tp->Idl) ?>" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal delete -->
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
</div>
<script>
$(function(){
  function initLulus(){
    var $t=$('#tabellulusan'); if(!$t.length) return;
    if($.fn.DataTable.isDataTable($t)){ try{$t.DataTable().destroy();}catch(e){} $t.removeAttr('style'); }
    $t.DataTable({
      pageLength:10, lengthMenu:[5,10,25,50], order:[],
      columnDefs:[{orderable:false,targets:[8]}],
      dom:'<"dt-top"lf>rt<"dt-bottom"ip>',
      language:{search:"",searchPlaceholder:"Cari lulusan, NIPD, kursus...",lengthMenu:"Tampil _MENU_",info:"Menampilkan _START_–_END_ dari _TOTAL_ lulusan",infoEmpty:"Tidak ada lulusan",infoFiltered:"(difilter dari _MAX_ total)",zeroRecords:"Tidak ada data yang cocok",emptyTable:"Belum ada lulusan",paginate:{first:"Awal",last:"Akhir",next:"›",previous:"‹"}},
      drawCallback:function(){ var h=[]; this.api().columns().header().toArray().forEach(function(th){h.push($(th).text().trim());}); this.api().rows({page:'current'}).nodes().toArray().forEach(function(r){$(r).find('td').each(function(i){if(h[i])$(this).attr('data-label',h[i]);});}); }
    });
  }
  if(document.readyState==='complete') setTimeout(initLulus,80); else $(window).on('load',function(){setTimeout(initLulus,80);});
  setTimeout(initLulus,300);
});
</script>
<button class="fab-presensi" data-toggle="modal" data-target="#modalTambah" title="Tambah Lulusan">
  <i class="fas fa-plus"></i>
</button>

<!-- Modal Tambah Lulusan -->
<div class="modal fade lulusan-app-modal" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content lulusan-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-graduation-cap"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="modalTambahTitle">Tambah Lulusan</h5>
            <div class="presensi-subtitle">Catat kelulusan peserta kursus</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form action="<?= base_url('lulusan/tambah') ?>" method="POST" id="formTambahLulusan" class="modal-body px-3 px-sm-4 py-3">
          <div class="form-group mb-3">
            <label class="field-label" for="peserta">Peserta <span class="font-weight-normal text-muted">(sudah lulus, belum tercatat)</span></label>
            <select class="form-control" id="peserta" name="nipd" required>
              <option value=""></option>
              <?php
              $data = $this->db->query("SELECT Nipd,Nama FROM peserta WHERE Status=2 AND NOT EXISTS (SELECT Nipd FROM lulusan WHERE Nipd=peserta.Nipd) ORDER BY Nama ASC")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Nipd ?>"><?= $row->Nama ?> (<?= $row->Nipd ?>)</option>
              <?php } ?>
            </select>
          </div>

          <div class="form-row">
            <div class="form-group col-12 col-sm-6 mb-3">
              <label class="field-label" for="pelatihan">Pelatihan</label>
              <input type="text" class="form-control presensi-input input-info" id="pelatihan" disabled>
            </div>
            <div class="form-group col-12 col-sm-6 mb-3">
              <label class="field-label" for="ttl_lulusan">Tgl Lahir</label>
              <input type="text" class="form-control presensi-input input-info" id="ttl_lulusan" disabled>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-6 mb-3" id="date-tl">
              <label class="field-label" for="tl">Tgl Lulus</label>
              <div class="input-group date">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
                </div>
                <input type="text" name="tl" class="form-control presensi-input" id="tl" required readonly autocomplete="off">
              </div>
            </div>
            <div class="form-group col-6 mb-3" id="date-tc">
              <label class="field-label" for="tc">Tgl Cetak</label>
              <div class="input-group date">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
                </div>
                <input type="text" name="tc" class="form-control presensi-input" id="tc" value="<?= date('Y-m-d') ?>" required readonly autocomplete="off">
              </div>
            </div>
          </div>

          <div class="form-group mb-3">
            <label class="field-label" for="instrukturLulusan">Instruktur</label>
            <select class="form-control presensi-input" id="instrukturLulusan" name="Instruktur" required>
              <option value="">Pilih instruktur</option>
              <?php
              $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= $row->NamaInstruktur ?></option>
              <?php } ?>
            </select>
          </div>

          <div id="nilaiContainer" style="display:none">
            <label class="field-label">Nilai Kompetensi</label>
            <?php for ($i = 1; $i <= 6; $i++) { ?>
            <div class="form-group mb-2" id="nilaiGroup<?= $i ?>">
              <div class="d-flex align-items-center justify-content-between">
                <span class="nilai-label" id="labelNilai<?= $i ?>">Unit Kompetensi <?= $i ?></span>
                <select class="form-control presensi-input nilai-select" name="n<?= $i ?>">
                  <option value="">-</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                </select>
              </div>
            </div>
            <?php } ?>
          </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formTambahLulusan" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ubah Lulusan -->
<div class="modal fade lulusan-app-modal" id="modalUbah" tabindex="-1" role="dialog" aria-labelledby="modalUbahTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-edit"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="modalUbahTitle">Ubah Lulusan</h5>
            <div class="presensi-subtitle">Perbarui data kelulusan peserta</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form action="<?= base_url('lulusan/ubah') ?>" method="POST" id="formUbahLulusan" class="modal-body px-3 px-sm-4 py-3">
        <input type="hidden" name="Id" id="editId">
          <input type="hidden" name="nipd" id="editNipd">
          <div class="form-group mb-3">
            <label class="field-label" for="editNama">Peserta</label>
            <input type="text" class="form-control presensi-input input-info" id="editNama" disabled>
          </div>
          <div class="form-row">
            <div class="form-group col-12 col-sm-6 mb-3">
              <label class="field-label" for="editPelatihan">Pelatihan</label>
              <input type="text" class="form-control presensi-input input-info" id="editPelatihan" disabled>
            </div>
            <div class="form-group col-12 col-sm-6 mb-3">
              <label class="field-label" for="editTtl">Tgl Lahir</label>
              <input type="text" class="form-control presensi-input input-info" id="editTtl" disabled>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-6 mb-3" id="edit-date-tl">
              <label class="field-label" for="editTl">Tgl Lulus</label>
              <div class="input-group date">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
                </div>
                <input type="text" name="tl" class="form-control presensi-input" id="editTl" required readonly autocomplete="off">
              </div>
            </div>
            <div class="form-group col-6 mb-3" id="edit-date-tc">
              <label class="field-label" for="editTc">Tgl Cetak</label>
              <div class="input-group date">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
                </div>
                <input type="text" name="tc" class="form-control presensi-input" id="editTc" required readonly autocomplete="off">
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <label class="field-label" for="editInstruktur">Instruktur</label>
            <select class="form-control presensi-input" id="editInstruktur" name="Instruktur" required>
              <option value="">Pilih instruktur</option>
              <?php
              $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= $row->NamaInstruktur ?></option>
              <?php } ?>
            </select>
          </div>
          <div id="editNilaiContainer" style="display:none">
            <label class="field-label">Nilai Kompetensi</label>
            <?php for ($i = 1; $i <= 6; $i++) { ?>
            <div class="form-group mb-2" id="editNilaiGroup<?= $i ?>">
              <div class="d-flex align-items-center justify-content-between">
                <span class="nilai-label" id="editLabelNilai<?= $i ?>">Unit Kompetensi <?= $i ?></span>
                <select class="form-control presensi-input nilai-select" name="n<?= $i ?>" id="editN<?= $i ?>">
                  <option value="">-</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                </select>
              </div>
            </div>
            <?php } ?>
          </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formUbahLulusan" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<style>
/* ===== Modal Tambah & Ubah Lulusan: gaya aplikasi mobile ===== */
.lulusan-app-modal .modal-content {
  border: 0;
  border-radius: .75rem;
  max-height: calc(100vh - 3.5rem);
  box-shadow: 0 20px 60px rgba(15, 23, 42, .22);
}
@supports (height: 100dvh) {
  .lulusan-app-modal .modal-content { max-height: calc(100dvh - 3.5rem); }
}
.lulusan-app-modal .modal-header,
.lulusan-app-modal .modal-footer { flex-shrink: 0; }
.lulusan-app-modal .modal-body {
  flex: 1 1 auto;
  min-height: 0;
  overflow-y: auto;
  overscroll-behavior: contain;
}
.minw-0 { min-width: 0; }
.presensi-icon {
  width: 2.5rem; height: 2.5rem;
  border-radius: .6rem;
  display: inline-flex; align-items: center; justify-content: center;
  background: rgba(37, 99, 235, .1);
  color: #2563eb;
  font-size: 1.05rem;
  flex-shrink: 0;
}
.presensi-subtitle { font-size: .8rem; color: #6b7280; margin-top: .1rem; }
.presensi-close {
  width: 2.5rem; height: 2.5rem;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.35rem;
  color: #6b7280;
  transition: background-color .15s, color .15s;
}
.presensi-close:hover { background: #f1f5f9; color: #111827; }
.field-label {
  font-size: .85rem; font-weight: 600; color: #374151;
  margin-bottom: .35rem; display: block;
}
.presensi-input { min-height: 44px; font-size: 16px; }
.input-info {
  background: #f8fafc !important;
  border-color: #e2e8f0;
  color: #334155;
}
#instrukturLulusan { font-size: 16px; }
.nilai-label {
  font-size: .85rem; font-weight: 500; color: #374151;
  padding-right: .75rem;
}
.nilai-select { width: auto; min-width: 88px; }

/* Input & select outlined, sudut lembut */
.lulusan-app-modal .form-control { border-radius: .6rem; }
.lulusan-app-modal .input-group-text {
  border-radius: .6rem 0 0 .6rem;
  border-right: 0;
}
.lulusan-app-modal .input-group > .form-control {
  border-radius: 0 .6rem .6rem 0;
}
.lulusan-app-modal .form-control:focus {
  border-color: #93b4f5;
  box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .15);
}

/* Select2 di dalam modal */
.lulusan-app-modal .select2-container--default .select2-selection--single {
  min-height: 44px;
  padding: .45rem .75rem;
  border-color: #ced4da;
  border-radius: .6rem;
  font-size: 16px;
  display: flex; align-items: center;
}
.lulusan-app-modal .select2-container--default .select2-selection--single .select2-selection__arrow { height: 100%; }
.lulusan-app-modal .select2-container--default.select2-container--focus .select2-selection--single {
  border-color: #93b4f5;
  box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .18);
}

.modal-footer .presensi-btn {
  min-height: 48px;
  border-radius: .55rem;
  font-weight: 600;
}

/* Tampilan aplikasi mobile di layar kecil */
@media (max-width: 575.98px) {
  .lulusan-app-modal .modal-dialog {
    margin: 0; max-width: 100%;
    height: 100%;
    overscroll-behavior: contain;
  }
  /* Kunci tinggi ke viewport terkecil agar layout stabil saat URL bar iOS turun/naik */
  @supports (height: 100svh) {
    .lulusan-app-modal .modal-dialog { height: 100svh; }
  }
  .lulusan-app-modal .modal-content {
    height: 100%;
    max-height: none;
    border-radius: 1.25rem 1.25rem 0 0;
    box-shadow: 0 -8px 40px rgba(15, 23, 42, .18);
    overscroll-behavior: contain;
  }
  .lulusan-app-modal .modal-header {
    justify-content: flex-start;
    padding: .85rem 1rem .85rem .5rem;
    border-bottom: 1px solid #eef0f4;
  }
  /* Reset margin auto dari BS4 (.modal-header .close) agar panah tidak terdorong ke tengah */
  .lulusan-app-modal .presensi-close {
    order: -1;
    margin: 0 .35rem 0 0;
    color: #2563eb;
    flex-shrink: 0;
  }
  .lulusan-app-modal .presensi-close:hover { background: rgba(37, 99, 235, .08); color: #2563eb; }
  .lulusan-app-modal .presensi-title-wrap { margin-left: .15rem !important; }
  .lulusan-app-modal .modal-footer {
    flex-direction: column-reverse;
    align-items: stretch;
    padding: .65rem 1rem calc(.75rem + env(safe-area-inset-bottom, 0px));
  }
  .lulusan-app-modal .modal-footer .presensi-btn {
    width: 100%;
    margin-left: 0 !important;
    border-radius: 9999px;
  }
  .lulusan-app-modal .modal-footer .btn-secondary {
    min-height: 42px;
    background: rgba(37, 99, 235, .07);
    border-color: transparent;
    color: #2563eb;
  }
  .lulusan-app-modal .modal-footer .btn-secondary:hover,
  .lulusan-app-modal .modal-footer .btn-secondary:focus {
    background: rgba(37, 99, 235, .14);
    border-color: transparent;
    color: #1d4ed8;
  }
}
/* Slide-up halus saat sheet muncul */
@media (max-width: 575.98px) and (prefers-reduced-motion: no-preference) {
  .lulusan-app-modal.fade .modal-dialog { transform: translateY(28px); }
  .lulusan-app-modal.show .modal-dialog { transform: none; }
}
@media (min-width: 576px) {
  .lulusan-app-modal .modal-dialog { max-width: 540px; }
}
@media (prefers-reduced-motion: reduce) {
  .presensi-close { transition: none; }
}
/* Kunci scroll halaman belakang saat modal terbuka (cegah lompatan scroll iOS) */
html.app-modal-open, html.app-modal-open body {
  overflow: hidden !important;
  overscroll-behavior: none;
}
</style>
<script>
if (window.jQuery) {
  window.jQuery(document)
    .on('show.bs.modal', '.lulusan-app-modal', function () {
      document.documentElement.classList.add('app-modal-open');
    });
  window.jQuery(document).on('hidden.bs.modal', function (e) {
    if (!document.querySelector('.modal.show')) {
      document.documentElement.classList.remove('app-modal-open');
    }
  });
}
</script>
<script>
(function () {
  [['date-tl', 'tl'], ['date-tc', 'tc'], ['edit-date-tl', 'editTl'], ['edit-date-tc', 'editTc']].forEach(function (p) {
    var icon = document.querySelector('#' + p[0] + ' .input-group-text');
    if (icon) {
      icon.addEventListener('click', function () {
        document.getElementById(p[1]).focus();
      });
    }
  });
})();
</script>
<script type="text/javascript">
  document.title = "Lulusan <?= $profil[0]->Namalkp?>";
</script>
<script type="text/javascript">
$(function(){
  function showSaved(id){
    var $s=$('#saved-'+id); $s.addClass('show');
    setTimeout(function(){ $s.removeClass('show'); }, 1800);
  }
  function enterEdit($edit){
    var $input=$edit.next('.txtedit');
    if(!$input.length) return;
    $edit.addClass('is-editing').hide();
    $input.show().focus().select();
  }
  function exitEdit($input, save){
    var $edit=$input.prev('.edit');
    var id=$input.data('id');
    var field=$input.data('field');
    var val=$input.val();
    var display = val !== '' ? $('<div>').text(val).html() : '<em style="color:#94a3b8;font-style:normal">Belum diisi</em>';
    if(!save){
      $input.hide();
      $edit.removeClass('is-editing').show();
      return;
    }
    $edit.find('.edit-text').html(display);
    $input.hide().removeClass('saving');
    $edit.removeClass('is-editing').show();
    $input.addClass('saving');
    $.ajax({
      url: '<?= base_url() ?>lulusan/notes/update',
      type: 'post',
      data: { field: field, value: val, id: id },
      success: function(res){
        $input.removeClass('saving');
        showSaved(id);
        console.log(res);
      },
      error: function(){
        $input.removeClass('saving');
        $edit.css('color','#dc2626');
        setTimeout(function(){ $edit.css('color',''); }, 1500);
      }
    });
  }
  $(document).on('click', '.notes-card .edit', function(e){
    e.preventDefault();
    $('.txtedit:visible').each(function(){ exitEdit($(this), false); });
    enterEdit($(this));
  });
  $(document).on('keydown', '.notes-card .edit', function(e){
    if(e.key==='Enter' || e.key===' '){ e.preventDefault(); enterEdit($(this)); }
  });
  $(document).on('focusout', '.txtedit.pk', function(){
    var $t=$(this);
    setTimeout(function(){ if($t.is(':visible')) exitEdit($t, true); }, 150);
  });
  $(document).on('keydown', '.txtedit.pk', function(e){
    if(e.key==='Enter'){ e.preventDefault(); $(this).blur(); }
    if(e.key==='Escape'){ e.preventDefault(); exitEdit($(this), false); }
  });
});
</script>
<script>
$(document).ready(function() {
  $('#peserta').select2({
    placeholder: 'Cari peserta...',
    width: '100%',
    dropdownParent: $('#modalTambah'),
    language: { noResults: function() { return 'Peserta tidak ditemukan'; } }
  });

  $('#modalTambah').on('shown.bs.modal', function() {
    $('#peserta').val('').trigger('change');
    $('#ttl_lulusan, #pelatihan').val('');
    $('#tl').val('');
    $('[name="Instruktur"]').val('');
    $('#nilaiContainer').hide();
    for (var i = 1; i <= 6; i++) {
      $('#labelNilai' + i).text('Unit Kompetensi ' + i);
      $('[name="n' + i + '"]').val('');
    }
  });

  $('#peserta').on('change', function() {
    var nipd = $(this).val();
    $('#nilaiContainer').hide();
    for (var i = 1; i <= 6; i++) {
      $('#labelNilai' + i).text('Unit Kompetensi ' + i);
      $('[name="n' + i + '"]').val('');
    }
    if (!nipd) {
      $('#ttl_lulusan, #pelatihan, #tl').val('');
      return;
    }
    $.ajax({
      url: '<?= base_url() ?>index.php/pesertas/Nipd',
      method: 'post',
      data: { Nipd: nipd },
      dataType: 'json',
      success: function(res) {
        if (res.length) {
          $('#ttl_lulusan').val(res[0].Ttl);
          $('#pelatihan').val(res[0].Namarombel);
          var showNilai = false;
          for (var i = 1; i <= 6; i++) {
            var uk = res[0]['Uk' + i];
            if (uk && uk !== '-') {
              $('#labelNilai' + i).text(uk);
              $('#nilaiGroup' + i).show();
              showNilai = true;
            } else {
              $('#nilaiGroup' + i).hide();
            }
          }
          if (showNilai) $('#nilaiContainer').show();
        }
      }
    });
    $.ajax({
      url: '<?= base_url() ?>index.php/pesertas/lastPresensi',
      method: 'post',
      data: { Nipd: nipd },
      dataType: 'json',
      success: function(res) {
        if (res.Tgl) {
          var d = new Date(res.Tgl);
          var ds = d.getFullYear() + '-' + String(d.getMonth()+1).padStart(2,'0') + '-' + String(d.getDate()).padStart(2,'0');
          $('#tl').val(ds);
        }
      }
    });
  });

  $('#date-tl .input-group.date, #date-tc .input-group.date').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
    todayBtn: 'linked',
  });

  $(document).on('click', '.btn-edit-lulusan', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#editNilaiContainer').hide();
    for (var i = 1; i <= 6; i++) {
      $('#editLabelNilai' + i).text('Unit Kompetensi ' + i);
      $('#editN' + i).val('');
    }
    $.ajax({
      url: '<?= base_url() ?>index.php/lulusan/getData',
      method: 'post',
      data: { id: id },
      dataType: 'json',
      success: function(res) {
        if (!res || !res.Id) return;
        $('#editId').val(res.Id);
        $('#editNipd').val(res.Nipd);
        $('#editNama').val(res.Nama);
        $('#editPelatihan').val(res.Namarombel);
        $('#editTtl').val(res.Ttl);
        $('#editTl').val(res.Tgllulus);
        $('#editTc').val(res.Tglcetak);
        $('#editInstruktur').val(res.Instruktur);
        var show = false;
        for (var i = 1; i <= 6; i++) {
          var uk = res['Uk' + i];
          if (uk && uk !== '-') {
            $('#editLabelNilai' + i).text(uk);
            $('#editNilaiGroup' + i).show();
            $('#editN' + i).val(res['n' + i]);
            show = true;
          } else {
            $('#editNilaiGroup' + i).hide();
          }
        }
        $('#editNilaiContainer').toggle(show);
        $('#edit-date-tl .input-group.date, #edit-date-tc .input-group.date').datepicker('destroy').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true,
          todayBtn: 'linked',
        });
        $('#modalUbah').modal('show');
      }
    });
  });
});
</script>
