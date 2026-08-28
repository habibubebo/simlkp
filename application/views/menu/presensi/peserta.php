<?php
$__p = $presensi[0];
$__n = $__p->Nama ?? '-';
$__initial = strtoupper(substr(trim($__n),0,1) . (strpos(trim($__n),' ') ? substr(trim($__n),strpos(trim($__n),' ')+1,1) : ''));
$__total = count($presensi);
$__materi = count(array_unique(array_map(fn($r)=>trim($r->Materi ?? ''), $presensi)));
$__last = end($presensi)->Tgl ?? $__p->Tgl ?? '';
$__statusLulus = '';
$__nipd = $__p->Nipd ?? '';
if ($__nipd !== '') { $q = $this->db->query("SELECT Tgllulus FROM lulusan WHERE Nipd='". $this->db->escape_str($__nipd) ."'"); if ($q->num_rows()==0) $__statusLulus='Belum Lulus'; else $__statusLulus='Lulus '.date('d-m-Y', strtotime($q->row()->Tgllulus)); }
?>
<style>
.modern-head h1{letter-spacing:-.02em}
.modern-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04)}
.modern-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.profile-card{border:1px solid #eef0f4;border-radius:.85rem;overflow:hidden}
.profile-head{background:linear-gradient(135deg,#2563eb 0%,#1d4ed8 100%);padding:1.25rem;color:#fff;position:relative;overflow:hidden}
.profile-head::after{content:"";position:absolute;inset:0;background:radial-gradient(400px 120px at 90% -10%,rgba(255,255,255,.18),transparent 60%);pointer-events:none}
.avatar-lg{width:52px;height:52px;border-radius:.75rem;background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.25);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.1rem;flex-shrink:0;backdrop-filter:blur(6px)}
.badge-status{font-size:.68rem;font-weight:700;padding:.25rem .5rem;border-radius:9999px;border:1px solid transparent}
.badge-belum{background:rgba(255,255,255,.18);color:#fff;border-color:rgba(255,255,255,.28)}
.badge-lulus{background:#fef3c7;color:#92400e;border-color:#fde68a}
.mono{font-family:'SFMono-Regular',Consolas,'Liberation Mono',Menlo,monospace}
.modern-table{width:100%!important}
.modern-table thead th{font-size:.66rem;letter-spacing:.07em;text-transform:uppercase;color:#94a3b8;font-weight:700;border-top:0;border-bottom:1px solid #f1f5f9;white-space:nowrap;padding:.8rem .7rem;background:#fcfdff}
.modern-table tbody td{font-size:.82rem;color:#334155;vertical-align:middle;padding:.65rem .7rem;border-top:1px solid #f8fafc}
.modern-table tbody td:first-child{font-weight:600;color:#94a3b8}
.modern-table tbody tr:hover td{background:#f8fafc}
.modern-table-wrap{border-radius:0 0 .85rem .85rem;overflow:hidden}
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
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}.modern-card .dt-top{flex-direction:column;align-items:stretch}.modern-card .dataTables_filter input{width:100%}.modern-card .dataTables_filter label{width:100%}}
</style>

<div class="modern-head d-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <a href="<?= base_url('pages/presensi') ?>" class="small d-inline-flex align-items-center mb-2" style="color:#64748b;text-decoration:none;font-weight:500"><i class="fas fa-arrow-left mr-1" style="font-size:.7rem"></i> Kembali ke Presensi</a>
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Presensi Peserta</h1>
    <p class="text-muted small mb-0"><?= html_escape($__p->Namarombel ?? '-') ?> — riwayat kehadiran</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0 d-none d-md-flex" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/presensi') ?>" style="color:#94a3b8;text-decoration:none">Presensi</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Peserta</li>
  </ol>
</div>

<div class="profile-card modern-card mb-3">
  <div class="profile-head d-flex align-items-center" style="gap:1rem">
    <div class="avatar-lg"><?= html_escape($__initial) ?></div>
    <div style="min-width:0;flex:1">
      <div class="d-flex align-items-center flex-wrap" style="gap:.5rem">
        <span style="font-weight:800;font-size:1.05rem;letter-spacing:-.01em"><?= html_escape($__n) ?></span>
        <span class="badge-status <?= strpos($__statusLulus,'Belum')!==false?'badge-belum':'badge-lulus' ?>"><?= html_escape($__statusLulus) ?></span>
      </div>
      <div class="small" style="opacity:.9;margin-top:.15rem"><span class="mono" style="font-size:.75rem;opacity:.9"><?= html_escape($__p->Nipd ?? '-') ?></span> · <span style="font-weight:600"><?= html_escape($__p->Namarombel ?? '-') ?></span></div>
    </div>
    <a href="<?= base_url('presensi/instruktur?Id='.$__p->IdI) ?>" class="btn btn-sm d-none d-md-inline-flex align-items-center" style="background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.28);color:#fff;border-radius:.5rem;font-weight:600;backdrop-filter:blur(6px)"><i class="fas fa-chalkboard-teacher mr-1" style="font-size:.7rem"></i> <?= html_escape($__p->NamaInstruktur ?? '-') ?></a>
  </div>
  <div class="card-body p-0">
    <div class="row no-gutters text-center" style="font-size:.78rem">
      <div class="col-4 py-3" style="border-right:1px solid #f1f5f9"><div class="text-muted" style="font-size:.65rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Pertemuan</div><div style="font-weight:800;color:#1e293b;font-size:1.1rem"><?= $__total ?></div></div>
      <div class="col-4 py-3" style="border-right:1px solid #f1f5f9"><div class="text-muted" style="font-size:.65rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Materi</div><div style="font-weight:800;color:#1e293b;font-size:1.1rem"><?= $__materi ?></div></div>
      <div class="col-4 py-3"><div class="text-muted" style="font-size:.65rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Terakhir</div><div class="mono" style="font-weight:700;color:#334155;font-size:.78rem"><?= $__last ? date('d-m-Y', strtotime($__last)) : '-' ?></div></div>
    </div>
  </div>
</div>

<div class="card modern-card mb-4">
  <div class="card-header py-3 d-flex align-items-center" style="gap:.6rem">
    <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Riwayat Presensi</h6>
    <span class="badge" style="background:#f1f5f9;color:#475569;font-weight:600;font-size:.68rem;border-radius:9999px;padding:.3rem .55rem"><?= $__total ?> sesi</span>
  </div>
  <div class="modern-table-wrap table-responsive">
    <table class="table modern-table table-hover mb-0" id="tabelpresensipeserta" style="width:100%">
      <thead>
        <tr>
          <th style="width:48px" class="text-center">No</th>
          <th>Tanggal</th>
          <th>Instruktur</th>
          <th>Materi</th>
          <th class="text-right" style="width:70px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; foreach ($presensi as $tp) { ?>
          <tr>
            <td class="text-center mono" style="color:#94a3b8"><?= $no++ ?></td>
            <td><span class="mono" style="font-size:.74rem;color:#334155"><?php $this->Model_APS->Gethari($tp->Tgl) ?></span></td>
            <td><a href="<?= base_url('presensi/instruktur?Id='.$tp->IdI) ?>" style="font-weight:600;color:#2563eb;text-decoration:none;font-size:.82rem"><?= html_escape($tp->NamaInstruktur) ?></a></td>
            <td><span style="color:#334155"><?= html_escape($tp->Materi) ?></span></td>
            <td class="text-right"><a href="#" class="dt-btn dt-btn-edit" data-toggle="modal" data-target="#editPresensi" data-id="<?= $tp->Idpr ?>" data-tgl="<?= html_escape($tp->Tgl) ?>" data-nipd="<?= html_escape($tp->Nipd) ?>" data-nama="<?= html_escape($tp->Nama ?? $__n) ?>" data-jks="<?= html_escape($tp->Jeniskursus ?? '') ?>" data-ins="<?= html_escape($tp->IdI ?? $tp->Instruktur ?? '') ?>" data-materi="<?= html_escape($tp->Materi) ?>" title="Ubah"><i class="fas fa-pen"></i></a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">document.title = "Presensi <?= html_escape($__n) ?> - <?= html_escape($__p->Namarombel ?? '') ?>";</script>
<script>
$(function(){
  function initPP(){
    var $t=$('#tabelpresensipeserta'); if(!$t.length) return;
    if($.fn.DataTable.isDataTable($t)){ try{$t.DataTable().destroy();}catch(e){} $t.removeAttr('style'); }
    $t.DataTable({
      pageLength:10, lengthMenu:[5,10,25,50], order:[[1,'desc']],
      columnDefs:[{orderable:false,targets:[4]}],
      dom:'<"dt-top"lf>rt<"dt-bottom"ip>',
      language:{search:"",searchPlaceholder:"Cari materi, instruktur...",lengthMenu:"Tampil _MENU_",info:"Menampilkan _START_–_END_ dari _TOTAL_ sesi",infoEmpty:"Tidak ada sesi",infoFiltered:"(difilter dari _MAX_ total)",zeroRecords:"Tidak ada data yang cocok",emptyTable:"Belum ada presensi",paginate:{first:"Awal",last:"Akhir",next:"›",previous:"‹"}},
      drawCallback:function(){ var h=[]; this.api().columns().header().toArray().forEach(function(th){h.push($(th).text().trim());}); this.api().rows({page:'current'}).nodes().toArray().forEach(function(r){$(r).find('td').each(function(i){if(h[i])$(this).attr('data-label',h[i]);});}); }
    });
  }
  if(document.readyState==='complete') setTimeout(initPP,80); else $(window).on('load',function(){setTimeout(initPP,80);});
  setTimeout(initPP,300);
});
</script>
<style>
.app-modal .modal-content{border:0;border-radius:.75rem;max-height:calc(100vh - 3.5rem);box-shadow:0 20px 60px rgba(15,23,42,.22)}
@supports (height: 100dvh){.app-modal .modal-content{max-height:calc(100dvh - 3.5rem)}}
.app-modal .modal-header,.app-modal .modal-footer{flex-shrink:0}
.app-modal .modal-body{flex:1 1 auto;min-height:0;overflow-y:auto;overscroll-behavior:contain}
.minw-0{min-width:0}
.presensi-icon{width:2.5rem;height:2.5rem;border-radius:.6rem;display:inline-flex;align-items:center;justify-content:center;background:rgba(37,99,235,.1);color:#2563eb;font-size:1.05rem;flex-shrink:0}
.presensi-subtitle{font-size:.8rem;color:#6b7280;margin-top:.1rem}
.presensi-close{width:2.5rem;height:2.5rem;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.35rem;color:#6b7280;transition:background-color .15s,color .15s}
.presensi-close:hover{background:#f1f5f9;color:#111827}
.field-label{font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.35rem;display:block}
.presensi-input{min-height:44px;font-size:16px}
.app-modal .form-control{border-radius:.6rem}
.app-modal .form-control:focus{border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.15)}
.modal-footer .presensi-btn{min-height:48px;border-radius:.55rem;font-weight:600}
@media(max-width:575.98px){
  .app-modal .modal-dialog{margin:0;max-width:100%;height:100%}
  @supports (height: 100svh){.app-modal .modal-dialog{height:100svh}}
  .app-modal .modal-content{height:100%;max-height:none;border-radius:1.25rem 1.25rem 0 0;box-shadow:0 -8px 40px rgba(15,23,42,.18)}
  .app-modal .modal-header{justify-content:flex-start;padding:.85rem 1rem .85rem .5rem;border-bottom:1px solid #eef0f4}
  .app-modal .presensi-close{order:-1;margin:0 .35rem 0 0;color:#2563eb}
  .app-modal .modal-footer{flex-direction:column-reverse;align-items:stretch;padding:.65rem 1rem calc(.75rem + env(safe-area-inset-bottom,0px))}
  .app-modal .modal-footer .presensi-btn{width:100%;margin-left:0!important;border-radius:9999px}
}
</style>
<div class="modal fade app-modal" id="editPresensi" tabindex="-1" role="dialog" aria-labelledby="editPresensiTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-user-edit"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="editPresensiTitle">Ubah Presensi</h5>
            <div class="presensi-subtitle">Perbarui data kehadiran</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup"><span class="d-none d-sm-inline" aria-hidden="true">&times;</span><i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i></button>
      </div>
      <form id="formEditPresensi" action="<?= base_url('index.php/presensi/ubah') ?>" method="POST" class="modal-body px-3 px-sm-4 py-3">
        <input type="hidden" name="Id" id="epId">
        <input type="hidden" name="jks" id="epJks">
        <div class="form-row mb-2">
          <div class="form-group col-8 mb-0" id="ep-date-tgl">
            <label class="field-label" for="epTgl">Tanggal Hadir</label>
            <div class="input-group date">
              <div class="input-group-prepend"><span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span></div>
              <input type="text" name="tgl" class="form-control presensi-input" id="epTgl" required readonly autocomplete="off">
            </div>
          </div>
          <div class="form-group col-4 mb-0">
            <label class="field-label" for="epJam">Jam</label>
            <div class="input-group"><div class="input-group-prepend"><span class="input-group-text bg-white"><i class="fas fa-clock text-primary"></i></span></div><input type="time" name="jam" class="form-control presensi-input" id="epJam" required></div>
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="epNipd">Nama Peserta</label>
          <select class="form-control presensi-input" id="epNipd" name="nama" required>
            <?php $data=$this->db->query("SELECT Nama,Nipd FROM peserta WHERE Status=1")->result(); foreach($data as $row){ ?><option value="<?= $row->Nipd ?>"><?= html_escape($row->Nama) ?></option><?php } ?>
          </select>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="epIns">Instruktur</label>
          <select class="form-control presensi-input" id="epIns" name="Instruktur" required>
            <?php $data=$this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result(); foreach($data as $row){ ?><option value="<?= $row->Id ?>"><?= html_escape($row->NamaInstruktur) ?></option><?php } ?>
          </select>
        </div>
        <div class="form-group mb-1">
          <label class="field-label" for="epMateri">Materi</label>
          <input type="text" class="form-control presensi-input" id="epMateri" name="materi" maxlength="50" required>
        </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formEditPresensi" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $('#ep-date-tgl .input-group.date').datepicker({format:'yyyy-mm-dd',autoclose:true,todayHighlight:true,todayBtn:'linked'});
  $('#editPresensi').on('show.bs.modal', function(e){
    var b=$(e.relatedTarget); if(!b||!b.length) return;
    var tgl=String(b.data('tgl')||''); var m=tgl.match(/^(\d{4}-\d{2}-\d{2})(?:\s+(.+))?$/);
    $('#epTgl').val(m?m[1]:tgl); var jam=(m&&m[2])?m[2].replace(/:\d{2}$/,''):''; $('#epJam').val(jam);
    $('#epId').val(b.data('id')); $('#epJks').val(b.data('jks'));
    var nipd=String(b.data('nipd')||''); var $sel=$('#epNipd'); if(nipd&&$sel.find('option[value="'+nipd+'"]').length===0) $('<option>').val(nipd).text(b.data('nama')||nipd).appendTo($sel); $sel.val(nipd);
    $('#epIns').val(String(b.data('ins')||'')); $('#epMateri').val(b.data('materi'));
  });
  $('#formEditPresensi').on('submit', function(){ var t=$('#epJam').val(); if(t) $('#epTgl').val($('#epTgl').val()+' '+t+':00'); });
});
</script>
