<?php
$__ins = $presensi[0];
$__n = $__ins->NamaInstruktur ?? '-';
$__initial = strtoupper(substr(trim($__n),0,1) . (strpos(trim($__n),' ') ? substr(trim($__n),strpos(trim($__n),' ')+1,1) : ''));
$__total = count($presensi);
$__peserta = count(array_unique(array_map(fn($r)=>$r->Nipd ?? $r->Nama ?? '', $presensi)));
$__materi = count(array_unique(array_map(fn($r)=>trim($r->Materi ?? ''), $presensi)));
$__last = $presensi[0]->Tgl ?? '';
foreach ($presensi as $__r) if (strtotime($__r->Tgl) > strtotime($__last)) $__last = $__r->Tgl;
$__nowYm = date('Y-m'); $__prevYm = date('Y-m', strtotime('-1 month'));
$__bulanIni = 0; $__bulanLalu = 0; $__perBulan = [];
foreach ($presensi as $__r) {
  $ym = date('Y-m', strtotime($__r->Tgl));
  if (!isset($__perBulan[$ym])) $__perBulan[$ym] = ['sesi'=>0, 'peserta'=>[]];
  $__perBulan[$ym]['sesi']++;
  $__k = trim($__r->Nipd ?? '');
  $__nm = trim($__r->Nama ?? '');
  if ($__k !== '') $__perBulan[$ym]['peserta'][$__k] = $__nm !== '' ? $__nm : $__k;
  elseif ($__nm !== '') $__perBulan[$ym]['peserta'][$__nm] = $__nm;
  if ($ym === $__nowYm) $__bulanIni++;
  if ($ym === $__prevYm) $__bulanLalu++;
}
krsort($__perBulan);
$__blnNames = [1=>'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
$__palette = [
  ['bg'=>'#eff6ff','bd'=>'#bfdbfe','c'=>'#1d4ed8'],
  ['bg'=>'#ecfdf5','bd'=>'#a7f3d0','c'=>'#065f46'],
  ['bg'=>'#fef3c7','bd'=>'#fde68a','c'=>'#92400e'],
  ['bg'=>'#fce7f3','bd'=>'#fbcfe8','c'=>'#be185d'],
  ['bg'=>'#ede9fe','bd'=>'#ddd6fe','c'=>'#6d28d9'],
  ['bg'=>'#e0f2fe','bd'=>'#bae6fd','c'=>'#0c4a6e'],
  ['bg'=>'#ffedd5','bd'=>'#fed7aa','c'=>'#9a3412'],
  ['bg'=>'#fef2f2','bd'=>'#fecaca','c'=>'#991b1b'],
  ['bg'=>'#f0fdf4','bd'=>'#bbf7d0','c'=>'#166534'],
  ['bg'=>'#fdf4ff','bd'=>'#f5d0fe','c'=>'#86198f'],
  ['bg'=>'#ecfeff','bd'=>'#a5f3fc','c'=>'#155e75'],
  ['bg'=>'#ccfbf1','bd'=>'#99f6e4','c'=>'#115e59'],
  ['bg'=>'#e0e7ff','bd'=>'#c7d2fe','c'=>'#3730a3'],
  ['bg'=>'#f3f4f6','bd'=>'#d1d5db','c'=>'#374151'],
];
$__allMap = [];
foreach ($__perBulan as $__d) foreach ($__d['peserta'] as $__k=>$__nm) if (!isset($__allMap[$__k])) $__allMap[$__k] = $__nm;
asort($__allMap);
$__colorMap = []; $__idx=0;
foreach ($__allMap as $__k=>$__v) { $__colorMap[$__k] = $__palette[$__idx % count($__palette)]; $__idx++; }
?>
<style>
.modern-head h1{letter-spacing:-.02em}
.modern-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04)}
.modern-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.profile-card{border:1px solid #eef0f4;border-radius:.85rem;overflow:hidden}
.profile-head{background:linear-gradient(135deg,#0f766e 0%,#115e59 100%);padding:1.25rem;color:#fff;position:relative;overflow:hidden}
.profile-head::after{content:"";position:absolute;inset:0;background:radial-gradient(400px 120px at 90% -10%,rgba(255,255,255,.18),transparent 60%);pointer-events:none}
.avatar-lg{width:52px;height:52px;border-radius:.75rem;background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.25);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.1rem;flex-shrink:0;backdrop-filter:blur(6px)}
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
.modern-card .dataTables_paginate .paginate_button.current,.modern-card .dataTables_paginate .paginate_button.current:hover{background:#0f766e!important;border-color:#0f766e!important;color:#fff!important;box-shadow:0 2px 8px rgba(15,118,110,.25)}
.dt-btn{display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:.45rem;font-size:.7rem;border:1px solid transparent;transition:all .15s;flex-shrink:0;text-decoration:none!important}
.dt-btn-edit{background:#fff;border-color:#e2e8f0;color:#475569}
.dt-btn-edit:hover{background:#f8fafc;border-color:#cbd5e1;color:#1e293b}
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}.modern-card .dt-top{flex-direction:column;align-items:stretch}.modern-card .dataTables_filter input{width:100%}.modern-card .dataTables_filter label{width:100%}}
</style>

<div class="modern-head d-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <a href="<?= base_url('pages/presensi') ?>" class="small d-inline-flex align-items-center mb-2" style="color:#64748b;text-decoration:none;font-weight:500"><i class="fas fa-arrow-left mr-1" style="font-size:.7rem"></i> Kembali ke Presensi</a>
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Presensi Instruktur</h1>
    <p class="text-muted small mb-0">Riwayat mengajar dan sesi pelatihan</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0 d-none d-md-flex" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/presensi') ?>" style="color:#94a3b8;text-decoration:none">Presensi</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Instruktur</li>
  </ol>
</div>

<div class="profile-card modern-card mb-3">
  <div class="profile-head d-flex align-items-center" style="gap:1rem">
    <div class="avatar-lg"><?= html_escape($__initial) ?></div>
    <div style="min-width:0;flex:1">
      <div style="font-weight:800;font-size:1.05rem;letter-spacing:-.01em"><?= html_escape($__n) ?></div>
      <div class="small" style="opacity:.9;margin-top:.15rem"><span style="opacity:.8"><?= html_escape($__ins->Kelamin ?? '-') ?></span><span style="margin:0 .4rem;opacity:.5">·</span><?= html_escape($__ins->Alamat ?? '-') ?></div>
    </div>
    <span class="badge d-none d-md-inline-flex align-items-center" style="background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.28);color:#fff;border-radius:9999px;padding:.35rem .6rem;font-weight:700;font-size:.7rem;backdrop-filter:blur(6px)"><?= $__total ?> sesi</span>
  </div>
  <div class="card-body p-0">
    <div class="row no-gutters text-center" style="font-size:.78rem">
      <div class="col-4 py-3" style="border-right:1px solid #f1f5f9"><div class="text-muted" style="font-size:.65rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Sesi</div><div style="font-weight:800;color:#1e293b;font-size:1.1rem"><?= $__total ?></div></div>
      <div class="col-4 py-3" style="border-right:1px solid #f1f5f9"><div class="text-muted" style="font-size:.65rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Peserta</div><div style="font-weight:800;color:#1e293b;font-size:1.1rem"><?= $__peserta ?></div></div>
      <div class="col-4 py-3"><div class="text-muted" style="font-size:.65rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Materi</div><div style="font-weight:800;color:#1e293b;font-size:1.1rem"><?= $__materi ?></div></div>
    </div>
  </div>
</div>

<div class="row mb-3">
  <div class="col-6 mb-3"><div class="card modern-card h-100" style="border-left:3px solid #0f766e"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.65rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Bulan Ini</div><div style="font-weight:800;color:#0f766e;font-size:1.35rem"><?= $__bulanIni ?></div><div class="small text-muted" style="font-size:.72rem"><?= $__blnNames[(int)date('n')] ?> <?= date('Y') ?> · <?= $__bulanIni ? round($__bulanIni/$__total*100) : 0 ?>% dari total</div></div><div class="d-flex align-items-center justify-content-center" style="width:36px;height:36px;border-radius:.6rem;background:rgba(15,118,110,.12);color:#0f766e"><i class="fas fa-calendar-check"></i></div></div></div></div>
  <div class="col-6 mb-3"><div class="card modern-card h-100" style="border-left:3px solid #94a3b8"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.65rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Bulan Lalu</div><div style="font-weight:800;color:#475569;font-size:1.35rem"><?= $__bulanLalu ?></div><div class="small text-muted" style="font-size:.72rem"><?= $__blnNames[(int)date('n', strtotime('-1 month'))] ?> <?= date('Y', strtotime('-1 month')) ?></div></div><div class="d-flex align-items-center justify-content-center" style="width:36px;height:36px;border-radius:.6rem;background:#f1f5f9;color:#64748b"><i class="fas fa-history"></i></div></div></div></div>
</div>

<div class="card modern-card mb-3">
  <div class="card-header py-3">
    <div class="d-flex align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.85rem"><i class="fas fa-chart-bar mr-2" style="color:#0f766e"></i>Resume Peserta per Bulan</h6>
      <span class="badge" style="background:#f1f5f9;color:#475569;font-weight:600;font-size:.65rem;border-radius:9999px;padding:.25rem .5rem"><?= count($__perBulan) ?> bulan</span>
    </div>
    <small class="text-muted" style="font-size:.68rem">Warna pill unik per siswa — sama di semua bulan untuk tracing</small>
  </div>
  <div class="table-responsive" style="border-radius:0 0 .85rem .85rem;overflow:hidden">
    <table class="table modern-table table-hover mb-0" style="width:100%">
      <thead><tr><th>Bulan</th><th class="text-center">Sesi</th><th class="text-center">Peserta</th><th>Nama Siswa</th></tr></thead>
      <tbody>
        <?php $shown=0; foreach ($__perBulan as $ym=>$d) { if($shown++>=6) break; [$y,$m]=explode('-',$ym); $cPes = count($d['peserta']); ?>
          <tr>
            <td style="font-weight:600;color:#1e293b;white-space:nowrap"><?= $__blnNames[(int)$m] ?> <?= $y ?></td>
            <td class="text-center"><span class="mono" style="font-weight:700;color:#0f766e"><?= $d['sesi'] ?></span></td>
            <td class="text-center"><span class="mono" style="font-weight:700;color:#334155"><?= $cPes ?></span></td>
            <td>
              <div class="d-flex flex-wrap" style="gap:.35rem">
                <?php $keys=array_keys($d['peserta']); $vals=array_values($d['peserta']); foreach($vals as $idx=>$nm){ $k=$keys[$idx]; $pal=$__colorMap[$k] ?? ['bg'=>'#f1f5f9','bd'=>'#e2e8f0','c'=>'#1e293b']; ?><span class="badge" style="background:<?= $pal['bg'] ?>;color:<?= $pal['c'] ?>;border:1px solid <?= $pal['bd'] ?>;font-weight:600;font-size:.7rem;border-radius:9999px;padding:.28rem .55rem;max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="<?= html_escape($nm) ?>"><?= html_escape($nm) ?></span><?php } ?>
              </div>
            </td>
          </tr>
        <?php } if (empty($__perBulan)) { ?><tr><td colspan="4" class="text-center text-muted small py-3">Belum ada data per bulan</td></tr><?php } ?>
      </tbody>
    </table>
  </div>
</div>

<div class="card modern-card mb-4">
  <div class="card-header py-3 d-flex align-items-center" style="gap:.6rem">
    <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Riwayat Mengajar</h6>
    <span class="badge" style="background:#f1f5f9;color:#475569;font-weight:600;font-size:.68rem;border-radius:9999px;padding:.3rem .55rem"><?= $__total ?> sesi</span>
  </div>
  <div class="modern-table-wrap table-responsive">
    <table class="table modern-table table-hover mb-0" id="tabelpresensiIns" style="width:100%">
      <thead>
        <tr>
          <th style="width:48px" class="text-center">No</th>
          <th>Tanggal</th>
          <th>Peserta</th>
          <th>Materi</th>
          <th class="text-right" style="width:70px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; foreach ($presensi as $tp) { ?>
          <tr>
            <td class="text-center mono" style="color:#94a3b8"><?= $no++ ?></td>
            <td><span class="mono" style="font-size:.74rem;color:#334155"><?php $this->Model_APS->Gethari($tp->Tgl) ?></span></td>
            <td><a href="<?= base_url('presensi/peserta?Id='.$tp->Idp) ?>" style="font-weight:600;color:#0f766e;text-decoration:none;font-size:.82rem"><?= html_escape($tp->Nama) ?></a></td>
            <td><span style="color:#334155"><?= html_escape($tp->Materi) ?></span></td>
            <td class="text-right"><a href="#" class="dt-btn dt-btn-edit" data-toggle="modal" data-target="#editPresensiIns" data-id="<?= $tp->Idpr ?>" data-tgl="<?= html_escape($tp->Tgl) ?>" data-nipd="<?= html_escape($tp->Nipd) ?>" data-nama="<?= html_escape($tp->Nama ?? '') ?>" data-jks="<?= html_escape($tp->Jeniskursus ?? '') ?>" data-ins="<?= html_escape($tp->Instruktur ?? $__ins->Id ?? '') ?>" data-materi="<?= html_escape($tp->Materi) ?>" title="Ubah"><i class="fas fa-pen"></i></a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">document.title = "Presensi Instruktur <?= html_escape($__n) ?>";</script>
<script>
$(function(){
  function initIns(){
    var $t=$('#tabelpresensiIns'); if(!$t.length) return;
    if($.fn.DataTable.isDataTable($t)){ try{$t.DataTable().destroy();}catch(e){} $t.removeAttr('style'); }
    $t.DataTable({
      pageLength:10, lengthMenu:[5,10,25,50], order:[[1,'desc']],
      columnDefs:[{orderable:false,targets:[4]}],
      dom:'<"dt-top"lf>rt<"dt-bottom"ip>',
      language:{search:"",searchPlaceholder:"Cari peserta, materi...",lengthMenu:"Tampil _MENU_",info:"Menampilkan _START_–_END_ dari _TOTAL_ sesi",infoEmpty:"Tidak ada sesi",infoFiltered:"(difilter dari _MAX_ total)",zeroRecords:"Tidak ada data yang cocok",emptyTable:"Belum ada sesi",paginate:{first:"Awal",last:"Akhir",next:"›",previous:"‹"}},
      drawCallback:function(){ var h=[]; this.api().columns().header().toArray().forEach(function(th){h.push($(th).text().trim());}); this.api().rows({page:'current'}).nodes().toArray().forEach(function(r){$(r).find('td').each(function(i){if(h[i])$(this).attr('data-label',h[i]);});}); }
    });
  }
  if(document.readyState==='complete') setTimeout(initIns,80); else $(window).on('load',function(){setTimeout(initIns,80);});
  setTimeout(initIns,300);
});
</script>
<style>
.app-modal .modal-content{border:0;border-radius:.75rem;max-height:calc(100vh - 3.5rem);box-shadow:0 20px 60px rgba(15,23,42,.22)}
@supports (height: 100dvh){.app-modal .modal-content{max-height:calc(100dvh - 3.5rem)}}
.app-modal .modal-header,.app-modal .modal-footer{flex-shrink:0}
.app-modal .modal-body{flex:1 1 auto;min-height:0;overflow-y:auto;overscroll-behavior:contain}
.minw-0{min-width:0}
.presensi-icon{width:2.5rem;height:2.5rem;border-radius:.6rem;display:inline-flex;align-items:center;justify-content:center;background:rgba(15,118,110,.12);color:#0f766e;font-size:1.05rem;flex-shrink:0}
.presensi-subtitle{font-size:.8rem;color:#6b7280;margin-top:.1rem}
.presensi-close{width:2.5rem;height:2.5rem;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.35rem;color:#6b7280;transition:background-color .15s,color .15s}
.presensi-close:hover{background:#f1f5f9;color:#111827}
.field-label{font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.35rem;display:block}
.presensi-input{min-height:44px;font-size:16px}
.app-modal .form-control{border-radius:.6rem}
.app-modal .form-control:focus{border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(15,118,110,.15)}
.modal-footer .presensi-btn{min-height:48px;border-radius:.55rem;font-weight:600}
@media(max-width:575.98px){
  .app-modal .modal-dialog{margin:0;max-width:100%;height:100%}
  @supports (height: 100svh){.app-modal .modal-dialog{height:100svh}}
  .app-modal .modal-content{height:100%;max-height:none;border-radius:1.25rem 1.25rem 0 0;box-shadow:0 -8px 40px rgba(15,23,42,.18)}
  .app-modal .modal-header{justify-content:flex-start;padding:.85rem 1rem .85rem .5rem;border-bottom:1px solid #eef0f4}
  .app-modal .presensi-close{order:-1;margin:0 .35rem 0 0;color:#0f766e}
  .app-modal .modal-footer{flex-direction:column-reverse;align-items:stretch;padding:.65rem 1rem calc(.75rem + env(safe-area-inset-bottom,0px))}
  .app-modal .modal-footer .presensi-btn{width:100%;margin-left:0!important;border-radius:9999px}
}
</style>
<div class="modal fade app-modal" id="editPresensiIns" tabindex="-1" role="dialog" aria-labelledby="editPresensiInsTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-user-edit"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="editPresensiInsTitle">Ubah Presensi</h5>
            <div class="presensi-subtitle">Perbarui data kehadiran</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup"><span class="d-none d-sm-inline" aria-hidden="true">&times;</span><i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i></button>
      </div>
      <form id="formEditPresensiIns" action="<?= base_url('index.php/presensi/ubah') ?>" method="POST" class="modal-body px-3 px-sm-4 py-3">
        <input type="hidden" name="Id" id="epIdIns">
        <input type="hidden" name="jks" id="epJksIns">
        <div class="form-row mb-2">
          <div class="form-group col-8 mb-0" id="ep-date-tgl-ins">
            <label class="field-label" for="epTglIns">Tanggal Hadir</label>
            <div class="input-group date">
              <div class="input-group-prepend"><span class="input-group-text bg-white"><i class="fas fa-calendar-alt" style="color:#0f766e"></i></span></div>
              <input type="text" name="tgl" class="form-control presensi-input" id="epTglIns" required readonly autocomplete="off">
            </div>
          </div>
          <div class="form-group col-4 mb-0">
            <label class="field-label" for="epJamIns">Jam</label>
            <div class="input-group"><div class="input-group-prepend"><span class="input-group-text bg-white"><i class="fas fa-clock" style="color:#0f766e"></i></span></div><input type="time" name="jam" class="form-control presensi-input" id="epJamIns" required></div>
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="epNipdIns">Nama Peserta</label>
          <select class="form-control presensi-input" id="epNipdIns" name="nama" required>
            <?php $data=$this->db->query("SELECT Nama,Nipd FROM peserta WHERE Status=1")->result(); foreach($data as $row){ ?><option value="<?= $row->Nipd ?>"><?= html_escape($row->Nama) ?></option><?php } ?>
          </select>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="epInsIns">Instruktur</label>
          <select class="form-control presensi-input" id="epInsIns" name="Instruktur" required>
            <?php $data=$this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result(); foreach($data as $row){ ?><option value="<?= $row->Id ?>"><?= html_escape($row->NamaInstruktur) ?></option><?php } ?>
          </select>
        </div>
        <div class="form-group mb-1">
          <label class="field-label" for="epMateriIns">Materi</label>
          <input type="text" class="form-control presensi-input" id="epMateriIns" name="materi" maxlength="50" required>
        </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formEditPresensiIns" class="btn btn-primary presensi-btn flex-fill ml-2" style="background:#0f766e;border-color:#0f766e"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $('#ep-date-tgl-ins .input-group.date').datepicker({format:'yyyy-mm-dd',autoclose:true,todayHighlight:true,todayBtn:'linked'});
  $('#editPresensiIns').on('show.bs.modal', function(e){
    var b=$(e.relatedTarget); if(!b||!b.length) return;
    var tgl=String(b.data('tgl')||''); var m=tgl.match(/^(\d{4}-\d{2}-\d{2})(?:\s+(.+))?$/);
    $('#epTglIns').val(m?m[1]:tgl); var jam=(m&&m[2])?m[2].replace(/:\d{2}$/,''):''; $('#epJamIns').val(jam);
    $('#epIdIns').val(b.data('id')); $('#epJksIns').val(b.data('jks'));
    var nipd=String(b.data('nipd')||''); var $sel=$('#epNipdIns'); if(nipd&&$sel.find('option[value="'+nipd+'"]').length===0) $('<option>').val(nipd).text(b.data('nama')||nipd).appendTo($sel); $sel.val(nipd);
    $('#epInsIns').val(String(b.data('ins')||'')); $('#epMateriIns').val(b.data('materi'));
  });
  $('#formEditPresensiIns').on('submit', function(){ var t=$('#epJamIns').val(); if(t) $('#epTglIns').val($('#epTglIns').val()+' '+t+':00'); });
});
</script>
