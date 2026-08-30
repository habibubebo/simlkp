<?php
$__total = count($peserta);
$__aktif = 0; $__non = 0; $__lulus = 0;
foreach ($peserta as $__r) { if ($__r->Status=="1") $__aktif++; elseif ($__r->Status=="0") $__non++; else $__lulus++; }
usort($peserta, function($a,$b){ $ai = $a->Idp ?? $a->Id ?? 0; $bi = $b->Idp ?? $b->Id ?? 0; return $bi <=> $ai; });
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
.modern-table thead th.sorting,.modern-table thead th.sorting_asc,.modern-table thead th.sorting_desc{cursor:pointer;position:relative;padding-right:1.5rem}
.modern-table thead th.sorting:after,.modern-table thead th.sorting_asc:after,.modern-table thead th.sorting_desc:after{position:absolute;right:.45rem;top:50%;transform:translateY(-50%);font-family:'Font Awesome 5 Free';font-weight:900;font-size:.6rem;color:#cbd5e1;content:'\f0dc'}
.modern-table thead th.sorting_asc:after{color:#2563eb;content:'\f0de'}
.modern-table thead th.sorting_desc:after{color:#2563eb;content:'\f0dd'}
.modern-table tbody td{font-size:.78rem;color:#334155;vertical-align:middle;padding:.6rem .6rem;border-top:1px solid #f8fafc}
.modern-table tbody tr:first-child td{border-top:0}
.modern-table tbody tr:hover td{background:#f8fafc}
.mono{font-family:'SFMono-Regular',Consolas,'Liberation Mono',Menlo,monospace;font-size:.74rem;color:#475569}
.badge-status{font-size:.66rem;font-weight:700;padding:.22rem .5rem;border-radius:9999px;border:1px solid transparent;letter-spacing:.02em}
.badge-aktif{background:#ecfdf5;color:#065f46;border-color:#a7f3d0}
.badge-non{background:#f1f5f9;color:#475569;border-color:#e2e8f0}
.badge-lulus{background:#ede9fe;color:#5b21b6;border-color:#ddd6fe}
.badge-jk{font-size:.66rem;font-weight:700;padding:.15rem .4rem;border-radius:9999px;border:1px solid transparent}
.badge-jk-l{background:#eff6ff;color:#1d4ed8;border-color:#bfdbfe}
.badge-jk-p{background:#fdf2f8;color:#be185d;border-color:#fbcfe8}
.avatar-sm{width:32px;height:32px;border-radius:.5rem;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.7rem;flex-shrink:0}
.avatar-peserta{background:rgba(37,99,235,.1);color:#2563eb}
.modern-table-wrap{border-radius:0 0 .85rem .85rem;overflow:hidden}
.modern-card .dataTables_wrapper{padding:0}
.modern-card .dt-top{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:.75rem;padding:1rem 1.1rem .85rem;border-bottom:1px solid #f1f5f9;background:#fff}
.modern-card .dataTables_length label{margin:0;display:flex;align-items:center;gap:.4rem;font-size:.78rem;color:#64748b;font-weight:500}
.modern-card .dataTables_length select{border:1px solid #e2e8f0;border-radius:.5rem;padding:.32rem 1.6rem .32rem .6rem;font-size:.78rem;color:#334155;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E") no-repeat right .5rem center;appearance:none;min-width:64px}
.modern-card .dataTables_filter label{margin:0;display:flex;align-items:center;gap:.5rem;font-size:.78rem;color:#64748b;font-weight:500}
.modern-card .dataTables_filter input{border:1px solid #e2e8f0;border-radius:.6rem;padding:.42rem .75rem .42rem 2rem;font-size:.82rem;color:#334155;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' stroke='%2394a3b8' stroke-width='1.7' viewBox='0 0 24 24'%3E%3Ccircle cx='11' cy='11' r='7'/%3E%3Cpath d='M20 20l-3.5-3.5'/%3E%3C/svg%3E") no-repeat 9px center;width:240px;transition:border-color .15s,box-shadow .15s}
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
.dt-btn-delete{background:#fff;border-color:#fecaca;color:#dc2626}
.dt-btn-delete:hover{background:#fef2f2;border-color:#fca5a5;color:#991b1b}
@media(max-width:767.98px){
  .modern-head .breadcrumb{display:none}
  .modern-card .dt-top{flex-direction:column;align-items:stretch}
  .modern-card .dataTables_filter input{width:100%}.modern-card .dataTables_filter label{width:100%}
  .modern-card .dt-bottom{flex-direction:column;align-items:stretch;text-align:center}
  .modern-card .dataTables_paginate .pagination{justify-content:center}
}
.app-search{position:relative;display:flex;align-items:center;background:#fff;border:1px solid #e2e8f0;border-radius:9999px;padding:.6rem 1rem .6rem 2.5rem;box-shadow:0 1px 2px rgba(15,23,42,.04);transition:border-color .15s,box-shadow .15s}
.app-search:focus-within{border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
.app-search i{position:absolute;left:1rem;color:#94a3b8;font-size:.85rem}
.app-search input{border:none;outline:none;width:100%;font-size:.82rem;color:#1e293b;background:transparent}
.app-search input::placeholder{color:#94a3b8}
.app-filters{display:flex;gap:.5rem;overflow-x:auto;padding:.85rem 0 .25rem;scrollbar-width:none;-webkit-overflow-scrolling:touch}
.app-filters::-webkit-scrollbar{display:none}
.app-filter{flex-shrink:0;padding:.45rem .9rem;border-radius:9999px;border:1px solid #e2e8f0;background:#fff;color:#475569;font-size:.74rem;font-weight:700;white-space:nowrap;transition:all .15s}
.app-filter.active{background:#2563eb;color:#fff;border-color:#2563eb;box-shadow:0 4px 12px rgba(37,99,235,.2)}
.app-list{display:grid;gap:.75rem}
.app-item{background:#fff;border:1px solid #eef0f4;border-radius:.85rem;padding:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04);display:flex;gap:.75rem;align-items:center;transition:transform .12s}
.app-item:active{transform:scale(.98)}
.app-item-avatar{width:44px;height:44px;border-radius:.75rem;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.78rem;flex-shrink:0}
.app-item-main{flex:1;min-width:0}
.app-item-name{font-weight:800;color:#1e293b;font-size:.82rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.app-item-sub{font-size:.70rem;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:flex;align-items:center;gap:.35rem;flex-wrap:wrap}
.app-item-arrow{width:32px;height:32px;border-radius:9999px;background:#f8fafc;border:1px solid #eef0f4;display:flex;align-items:center;justify-content:center;color:#94a3b8;flex-shrink:0}
@media(max-width:767.98px){
  .modern-table thead{display:none !important}
  .modern-table tbody tr{display:block;background:#fff;border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04);margin-bottom:.9rem;overflow:hidden}
  .modern-table tbody tr:hover td{background:#fff !important}
  .modern-table tbody td{display:flex;align-items:center;justify-content:space-between;gap:.6rem;padding:.65rem .9rem !important;border:none !important;border-bottom:1px solid #f8fafc !important;min-height:auto}
  .modern-table tbody td:before{content:attr(data-label);font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700;color:#94a3b8;flex-shrink:0;white-space:nowrap}
  .modern-table tbody td:nth-child(1){background:#fcfdff;padding:.85rem .9rem !important;border-bottom:1px solid #f1f5f9 !important}
  .modern-table tbody td:nth-child(1):before{display:none}
  .modern-table tbody td:nth-child(1) .avatar-sm{width:40px;height:40px;border-radius:.7rem;font-size:.75rem}
  .modern-table tbody td:nth-child(2):before{content:"Status"}
  .modern-table tbody td:nth-child(3):before{content:"JK"}
  .modern-table tbody td:nth-child(4):before{content:"TTL"}
  .modern-table tbody td:nth-child(5):before{content:"Program"}
  .modern-table tbody td:nth-child(5) div{text-align:right}
  .modern-table tbody td:nth-child(6):before{content:"Masuk"}
  .modern-table tbody td:last-child{justify-content:stretch;padding:.6rem !important;border-bottom:none !important;background:#f8fafc}
  .modern-table tbody td:last-child:before{display:none}
  .modern-table tbody td:last-child .d-inline-flex{width:100%}
  .modern-table tbody td:last-child .dt-btn{flex:1;width:auto;height:38px;border-radius:.6rem;font-size:.78rem;font-weight:600;gap:.4rem}
  .modern-table tbody td:last-child .dt-btn .m-label{display:inline !important}
}
.peserta-app-modal .modal-content{border:0;border-radius:.75rem;max-height:calc(100vh - 3.5rem);box-shadow:0 20px 60px rgba(15,23,42,.22)}
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
@media (max-width:575.98px){
  .peserta-app-modal .modal-dialog{margin:0;max-width:100%;height:100%;overscroll-behavior:contain}
  @supports (height: 100svh){.peserta-app-modal .modal-dialog{height:100svh}}
  .peserta-app-modal .modal-content{height:100%;max-height:none;border-radius:1.25rem 1.25rem 0 0;box-shadow:0 -8px 40px rgba(15,23,42,.18);overscroll-behavior:contain}
  .peserta-app-modal .modal-header{justify-content:flex-start;padding:.85rem 1rem .85rem .5rem;border-bottom:1px solid #eef0f4}
  .peserta-app-modal .presensi-close{order:-1;margin:0 .35rem 0 0;color:#2563eb;flex-shrink:0}
  .peserta-app-modal .presensi-title-wrap{margin-left:.15rem!important}
  .peserta-app-modal .modal-footer{flex-direction:column-reverse;align-items:stretch;padding:.65rem 1rem calc(.75rem + env(safe-area-inset-bottom,0px))}
  .peserta-app-modal .modal-footer .presensi-btn{width:100%;margin-left:0!important;border-radius:9999px}
  .peserta-app-modal .modal-footer .btn-secondary{min-height:42px;background:rgba(37,99,235,.07);border-color:transparent;color:#2563eb}
}
@media (max-width:575.98px) and (prefers-reduced-motion:no-preference){
  .peserta-app-modal.fade .modal-dialog{transform:translateY(28px)}
  .peserta-app-modal.show .modal-dialog{transform:none}
}
@media (min-width:576px){.peserta-app-modal .modal-dialog{max-width:540px}}
html.app-modal-open,html.app-modal-open body{overflow:hidden!important;overscroll-behavior:none}
</style>

<div class="modern-head d-none d-md-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
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
      <span class="badge" style="background:#f1f5f9;color:#475569;font-weight:600;font-size:.68rem;border-radius:9999px;padding:.3rem .55rem"><?= $__total ?> data</span>
    </div>
    <button class="btn btn-primary btn-sm d-none d-md-inline-flex align-items-center" data-toggle="modal" data-target="#tambahPeserta" style="background:#2563eb;border-color:#2563eb;border-radius:.5rem;font-weight:600;font-size:.78rem;padding:.42rem .75rem"><i class="fas fa-plus mr-1"></i> Tambah Peserta</button>
  </div>
  <div class="d-block d-md-none">
    <div class="px-3 pt-3">
      <div class="app-search"><i class="fas fa-search"></i><input type="search" id="appSearch2" placeholder="Cari nama, NIPD, program..."></div>
      <div class="app-filters" id="appFilters2">
        <button class="app-filter active" data-status="">Semua</button>
        <button class="app-filter" data-status="1">Aktif</button>
        <button class="app-filter" data-status="2">Lulus</button>
        <button class="app-filter" data-status="0">Nonaktif</button>
      </div>
    </div>
    <div class="px-3 pb-3">
      <div id="appList2" class="app-list">
        <?php foreach ($peserta as $tp) {
          $jk2 = ($tp->Kelamin == "Laki - Laki") ? "L" : "P";
          $jkClass2 = $jk2=="L" ? "badge-jk-l" : "badge-jk-p";
          if ($tp->Status == "0") { $stClass2='badge-non'; $stText2='Nonaktif'; }
          elseif ($tp->Status == "1") { $stClass2='badge-aktif'; $stText2='Aktif'; }
          else { $stClass2='badge-lulus'; $stText2='Lulus'; }
          $initials2 = strtoupper(substr(trim($tp->Nama),0,1) . (strpos(trim($tp->Nama),' ') ? substr(trim($tp->Nama),strpos(trim($tp->Nama),' ')+1,1) : ''));
        ?>
          <a href="<?= base_url("index.php/presensi/peserta?Id=$tp->Idp") ?>" class="app-item text-decoration-none" data-status="<?= $tp->Status ?>" data-search="<?= html_escape(strtolower($tp->Nama.' '.$tp->Nipd.' '.$tp->Namarombel.' '.$tp->Kelas)) ?>">
            <div class="app-item-avatar avatar-peserta"><?= html_escape($initials2) ?></div>
            <div class="app-item-main">
              <div class="app-item-name"><?= html_escape($tp->Nama) ?> <span class="badge-jk <?= $jkClass2 ?>" style="margin-left:.3rem;vertical-align:middle"><?= $jk2 ?></span></div>
              <div class="app-item-sub"><span class="mono" style="font-size:.68rem;color:#94a3b8"><?= html_escape($tp->Nipd) ?></span><span style="width:3px;height:3px;border-radius:50%;background:#cbd5e1;display:inline-block"></span><span><?= html_escape($tp->Namarombel) ?></span></div>
              <div class="app-item-meta"><span class="badge-status <?= $stClass2 ?>" style="font-size:.6rem;padding:.15rem .4rem"><?= $stText2 ?></span> <span style="margin-left:.3rem;color:#94a3b8;font-size:.66rem"><?= html_escape($tp->Kelas) ?></span> · <span style="color:#64748b"><?= html_escape(date("d/m/Y", strtotime($tp->Tglmasuk))) ?></span></div>
            </div>
            <div class="app-item-arrow"><i class="fas fa-chevron-right" style="font-size:.65rem"></i></div>
          </a>
        <?php } ?>
      </div>
      <div id="appEmpty2" class="text-center py-4 d-none">
        <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:44px;height:44px;border-radius:.7rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-search"></i></div>
        <div class="small font-weight-bold" style="color:#334155">Tidak ada peserta</div>
        <div class="small text-muted">Coba ubah pencarian atau filter</div>
      </div>
    </div>
  </div>
  <div class="d-none d-md-block modern-table-wrap table-responsive">
    <table class="table modern-table table-hover mb-0" id="tabelpeserta" style="width:100%">
      <thead>
        <tr>
          <th>Peserta</th>
          <th>Status</th>
          <th class="text-center" style="width:48px">JK</th>
          <th>TTL</th>
          <th>Program</th>
          <th>Masuk</th>
          <th class="text-right" style="width:90px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($peserta as $tp) {
          $jk = ($tp->Kelamin == "Laki - Laki") ? "L" : "P";
          $jkBadge = $jk=="L" ? "badge-jk-l" : "badge-jk-p";
          if ($tp->Status == "0") $statusBadge='<span class="badge-status badge-non">Nonaktif</span>';
          elseif ($tp->Status == "1") $statusBadge='<span class="badge-status badge-aktif">Aktif</span>';
          else $statusBadge='<span class="badge-status badge-lulus">Lulus</span>';
          $initials = strtoupper(substr(trim($tp->Nama),0,1) . (strpos(trim($tp->Nama),' ') ? substr(trim($tp->Nama),strpos(trim($tp->Nama),' ')+1,1) : ''));
        ?>
          <tr>
            <td>
              <div class="d-flex align-items-center" style="gap:.6rem;min-width:180px">
                <div class="avatar-sm avatar-peserta"><?= html_escape($initials) ?></div>
                <div style="min-width:0">
                  <a href="<?= base_url("index.php/presensi/peserta?Id=$tp->Idp") ?>" style="font-weight:700;color:#1e293b;font-size:.82rem;text-decoration:none;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:150px;display:block" title="<?= html_escape($tp->Nama) ?>"><?= html_escape($tp->Nama) ?></a>
                  <span class="mono" style="font-size:.7rem;color:#94a3b8"><?= html_escape($tp->Nipd) ?></span>
                </div>
              </div>
            </td>
            <td><?= $statusBadge ?></td>
            <td class="text-center"><span class="badge-jk <?= $jkBadge ?>"><?= $jk ?></span></td>
            <td><span class="small" style="color:#475569;white-space:nowrap"><?= html_escape($tp->Ttl) ?></span></td>
            <td><div style="line-height:1.2"><span style="font-weight:600;color:#1e293b;font-size:.78rem"><?= html_escape($tp->Namarombel) ?></span><br><span class="badge" style="background:#f8fafc;color:#334155;border:1px solid #e2e8f0;font-size:.65rem;border-radius:.3rem;padding:.15rem .35rem"><?= html_escape($tp->Kelas) ?></span></div></td>
            <td><span class="mono" style="font-size:.74rem"><?= html_escape(date("d-m-Y", strtotime($tp->Tglmasuk))) ?></span></td>
            <td class="text-right">
              <div class="d-inline-flex" style="gap:.45rem">
                <a href="<?= base_url("peserta/form_ubah/$tp->Idp") ?>" class="dt-btn dt-btn-edit" title="Ubah"><i class="fas fa-pen"></i><span class="m-label" style="display:none">Ubah</span></a>
                <a href="#" class="dt-btn dt-btn-delete" data-toggle="modal" data-target="#deletePeserta<?= $tp->Idp; ?>" title="Hapus"><i class="fas fa-trash-alt"></i><span class="m-label" style="display:none">Hapus</span></a>
              </div>
              <div class="modal fade" id="deletePeserta<?= $tp->Idp; ?>" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document" style="max-width:420px"><div class="modal-content" style="border:0;border-radius:.9rem;box-shadow:0 20px 60px rgba(15,23,42,.18)"><div class="modal-body p-4 text-center"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;border-radius:50%;background:#fef2f2;color:#dc2626"><i class="fas fa-trash-alt"></i></div><h6 class="font-weight-bold mb-1" style="color:#1e293b">Hapus peserta?</h6><p class="small text-muted mb-0">Yakin ingin menghapus <span style="font-weight:600;color:#334155"><?= html_escape($tp->Nama) ?></span> ?</p></div><div class="modal-footer border-0 pt-0 px-4 pb-4 d-flex" style="gap:.5rem"><button type="button" class="btn flex-fill" data-dismiss="modal" style="border:1px solid #e2e8f0;background:#fff;color:#475569;border-radius:.55rem;font-weight:600">Batal</button><a href="<?= base_url('peserta/hapus/' . $tp->Idp) ?>" class="btn btn-danger flex-fill" style="border-radius:.55rem;font-weight:600">Hapus</a></div></div></div></div>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php if ($__total === 0) { ?>
    <div class="text-center py-5 px-3"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;border-radius:.85rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-users fa-lg"></i></div><h6 class="font-weight-bold" style="color:#1e293b">Belum ada peserta</h6><p class="small text-muted mb-3">Tambahkan peserta pertama.</p><button class="btn btn-primary" data-toggle="modal" data-target="#tambahPeserta" style="border-radius:.6rem;font-weight:600"><i class="fas fa-plus mr-1"></i> Tambah Peserta</button></div>
  <?php } ?>
</div>

<button class="fab-presensi" data-toggle="modal" data-target="#tambahPeserta" title="Tambah Peserta"><i class="fas fa-plus"></i></button>

<div class="modal fade peserta-app-modal" id="tambahPeserta" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-user-plus"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h6 class="modal-title mb-0" style="font-weight:700;color:#1e293b">Tambah Peserta</h6>
            <small class="text-muted" style="font-size:.72rem">Lengkapi data peserta baru</small>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Close"><span class="d-none d-sm-inline" aria-hidden="true">&times;</span><i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i></button>
      </div>
      <form action="<?= base_url('peserta/tambah'); ?>" method="POST" id="formTambahPesertaFix" class="modal-body px-3 px-sm-4 py-3">
        <div class="form-row">
          <div class="form-group col-6 mb-3"><label class="field-label">Nomor Induk <span class="text-danger">*</span></label><input type="text" class="form-control presensi-input" name="Nipd" maxlength="20" required placeholder="NIPD"></div>
          <div class="form-group col-6 mb-3"><div class="field-label">Status <span class="text-danger">*</span></div><div class="seg-group" role="radiogroup"><input type="radio" name="Status" id="nsSt0" value="0"><label for="nsSt0">Nonaktif</label><input type="radio" name="Status" id="nsSt1" value="1" checked><label for="nsSt1">Aktif</label><input type="radio" name="Status" id="nsSt2" value="2"><label for="nsSt2">Lulus</label></div></div>
          <div class="form-group col-6 mb-3"><label class="field-label">No KK</label><input type="text" class="form-control presensi-input" name="Nokk" maxlength="30" value="-" placeholder="No Kartu Keluarga"></div>
          <div class="form-group col-6 mb-3"><label class="field-label">NIK</label><input type="text" class="form-control presensi-input" name="Nik" maxlength="30" value="-" placeholder="NIK"></div>
          <div class="form-group col-8 mb-3"><label class="field-label">Nama Peserta <span class="text-danger">*</span></label><input type="text" class="form-control presensi-input" name="Nama" maxlength="50" required placeholder="Nama lengkap"></div>
          <div class="form-group col-4 mb-3"><label class="field-label">Kelamin <span class="text-danger">*</span></label><select class="form-control presensi-input" name="Jk" required><option disabled selected value="">Pilih</option><option value="Laki - Laki">Laki - Laki</option><option value="Perempuan">Perempuan</option></select></div>
          <div class="form-group col-8 mb-3"><label class="field-label">Tempat, Tanggal Lahir <span class="text-danger">*</span></label><input type="text" name="Tgl" class="form-control presensi-input" placeholder="Blitar, 01 Januari 2000" maxlength="50" required></div>
          <div class="form-group col-4 mb-3"><label class="field-label">Jenis Kursus <span class="text-danger">*</span></label><select class="form-control presensi-input" name="Jenis" required><option disabled selected value="">Pilih kursus</option><?php $data=$this->db->query("SELECT * FROM rombel")->result(); foreach($data as $row){ ?><option value="<?= $row->Id ?>"><?= html_escape($row->Namarombel) ?></option><?php } ?></select></div>
          <div class="form-group col-6 mb-3"><label class="field-label">Kelas <span class="text-danger">*</span></label><select class="form-control presensi-input" name="Kls" required><option disabled selected value="">Pilih kelas</option><?php foreach($rombel as $row){ ?><option value="<?= html_escape($row->Kelas) ?>"><?= html_escape($row->Namarombel.' - '.$row->Kelas) ?></option><?php } ?></select></div>
          <div class="form-group col-6 mb-3" id="ns-date2"><label class="field-label">Tanggal Masuk <span class="text-danger">*</span></label><div class="input-group date"><div class="input-group-prepend"><span class="input-group-text bg-white" style="border-radius:.6rem 0 0 .6rem;border-color:#e2e8f0;color:#94a3b8"><i class="fas fa-calendar" style="font-size:.75rem"></i></span></div><input type="text" name="Tglmasuk" class="form-control presensi-input" placeholder="Tanggal Masuk" maxlength="20" required readonly autocomplete="off" style="border-radius:0 .6rem .6rem 0;border-left:0"></div></div>
        </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formTambahPesertaFix" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">document.title = "Peserta Didik <?= $profil[0]->Namalkp ?>";</script>
<script>
$(function(){
  function initPeserta(){
    var $t=$('#tabelpeserta'); if(!$t.length) return;
    if($.fn.DataTable.isDataTable($t)){ try{$t.DataTable().destroy();}catch(e){} $t.removeAttr('style'); }
    $t.DataTable({
      pageLength:10, lengthMenu:[5,10,25,50], order:[],
      columnDefs:[{orderable:false,targets:[6]}],
      dom:'<"dt-top"lf>rt<"dt-bottom"ip>',
      language:{search:"",searchPlaceholder:"Cari nama, NIPD, program...",lengthMenu:"Tampil _MENU_",info:"Menampilkan _START_–_END_ dari _TOTAL_ peserta",infoEmpty:"Tidak ada peserta",infoFiltered:"(difilter dari _MAX_ total)",zeroRecords:"Tidak ada data yang cocok",emptyTable:"Belum ada peserta",paginate:{first:"Awal",last:"Akhir",next:"›",previous:"‹"}},
      drawCallback:function(){ var h=[]; this.api().columns().header().toArray().forEach(function(th){h.push($(th).text().trim());}); this.api().rows({page:'current'}).nodes().toArray().forEach(function(r){$(r).find('td').each(function(i){if(h[i])$(this).attr('data-label',h[i]);});}); }
    });
  }
  if(document.readyState==='complete') setTimeout(initPeserta,80); else $(window).on('load',function(){setTimeout(initPeserta,80);});
  setTimeout(initPeserta,300);
  $('#ns-date2 .input-group.date').datepicker({format:'yyyy-mm-dd',autoclose:true,todayHighlight:true,todayBtn:'linked'});
  $(document).on('show.bs.modal','.peserta-app-modal',function(){document.documentElement.classList.add('app-modal-open')});
  $(document).on('hidden.bs.modal',function(){if(!document.querySelector('.modal.show')) document.documentElement.classList.remove('app-modal-open')});
  function filterApp2(){
    var q=(($('#appSearch2').val()||'').toLowerCase());
    var st=$('#appFilters2 .app-filter.active').data('status'); st=st===""?"":String(st);
    var visible=0;
    $('#appList2 .app-item').each(function(){
      var $it=$(this);
      var matchSearch=!q || String($it.data('search')).indexOf(q)!==-1;
      var matchStatus=st==="" || String($it.data('status'))===st;
      var show=matchSearch && matchStatus;
      $it.toggle(show);
      if(show) visible++;
    });
    $('#appEmpty2').toggleClass('d-none', visible>0);
  }
  $(document).on('input','#appSearch2',filterApp2);
  $(document).on('click','#appFilters2 .app-filter',function(){ $('#appFilters2 .app-filter').removeClass('active'); $(this).addClass('active'); filterApp2(); });
});
</script>
