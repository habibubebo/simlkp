<?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'];
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
.modern-stat.stat-belum .stat-icon{background:rgba(245,158,11,.14);color:#d97706}
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
.app-item{background:#fff;border:1px solid #eef0f4;border-radius:.85rem;padding:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04);display:flex;gap:.75rem;align-items:center;transition:transform .12s;overflow:hidden;max-width:100%}
.app-item-main{flex:1;min-width:0;overflow:hidden}
.app-item-avatar{width:44px;height:44px;border-radius:.75rem;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.78rem;flex-shrink:0}
.app-item-name{font-weight:800;color:#1e293b;font-size:.82rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.app-item-sub{font-size:.70rem;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:flex;align-items:center;gap:.35rem;flex-wrap:wrap}
.app-item-arrow{width:32px;height:32px;border-radius:9999px;background:#f8fafc;border:1px solid #eef0f4;display:flex;align-items:center;justify-content:center;color:#94a3b8;flex-shrink:0}
.sticky-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:.75rem}
.sticky-note{position:relative;background:#fffbeb;border:1px solid #fde68a;border-radius:.65rem;padding:1rem 1rem .9rem;box-shadow:0 4px 12px rgba(245,158,11,.12),0 1px 3px rgba(15,23,42,.06);transform:rotate(-0.4deg);transition:transform .15s,box-shadow .15s}
.sticky-note:nth-child(even){transform:rotate(0.5deg);background:#fef9c3}
.sticky-note:nth-child(3n){transform:rotate(-0.3deg)}
.sticky-note:hover{transform:rotate(0deg) translateY(-2px);box-shadow:0 8px 20px rgba(245,158,11,.18),0 2px 8px rgba(15,23,42,.08)}
.sticky-tape{position:absolute;top:-8px;left:50%;transform:translateX(-50%) rotate(-2deg);width:64px;height:18px;background:rgba(255,255,255,.72);border:1px solid rgba(203,213,225,.6);border-radius:2px;box-shadow:0 1px 3px rgba(15,23,42,.08);backdrop-filter:blur(2px)}
.sticky-jenis{font-size:.70rem;letter-spacing:.06em;text-transform:uppercase;font-weight:800;color:#92400e;margin-bottom:.35rem;padding-right:1.5rem;word-break:break-word}
.sticky-data{font-size:.82rem;color:#1e293b;line-height:1.45;min-height:1.8rem;word-break:break-word}
.sticky-note .edit{background:transparent;border:1px dashed transparent;border-radius:.4rem;padding:.15rem .3rem;margin:-.15rem -.3rem}
.sticky-note .edit:hover{background:rgba(37,99,235,.06);border-color:rgba(37,99,235,.15)}
.sticky-note .txtedit{margin-top:.4rem;background:#fff}
.sticky-note .note-saved{margin-top:.5rem;display:block;text-align:right}
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}.modern-card .dt-top{flex-direction:column;align-items:stretch}.modern-card .dataTables_filter input{width:100%}.modern-card .dataTables_filter label{width:100%}.sticky-grid{grid-template-columns:1fr}}
</style>
<div class="modern-head d-none d-md-flex flex-column flex-md-row align-items-md-center justify-content-between mt-3 mb-2">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Lulusan</h1>
    <p class="text-muted small mb-0">Data alumni yang telah menyelesaikan pelatihan</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Lulusan</li>
  </ol>
</div>
<div class="row d-none d-lg-flex mb-2">
  <div class="col-lg-4 mb-2"><div class="card modern-card modern-stat stat-total h-100"><div class="card-body py-2 d-flex align-items-center justify-content-between" style="padding-top:.7rem !important;padding-bottom:.7rem !important"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total Lulusan</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#1e293b"><?= $__totalLulus ?></div><div class="small text-muted" style="font-size:.72rem">Alumni terdata</div></div><div class="stat-icon"><i class="fas fa-graduation-cap"></i></div></div></div></div>
  <div class="col-lg-4 mb-2"><div class="card modern-card modern-stat stat-bulan h-100"><div class="card-body py-2 d-flex align-items-center justify-content-between" style="padding-top:.7rem !important;padding-bottom:.7rem !important"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Bulan Ini</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#065f46"><?= $__bulanIni ?></div><div class="small text-muted" style="font-size:.72rem"><?= $bulanIndo[date('n')].date(' Y') ?></div></div><div class="stat-icon"><i class="fas fa-calendar-check"></i></div></div></div></div>
  <div class="col-lg-4 mb-2"><div class="card modern-card modern-stat stat-tahun h-100"><div class="card-body py-2 d-flex align-items-center justify-content-between" style="padding-top:.7rem !important;padding-bottom:.7rem !important"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Tahun Ini</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#5b21b6"><?= $__tahunIni ?></div><div class="small text-muted" style="font-size:.72rem"><?= date('Y') ?> lulus</div></div><div class="stat-icon"><i class="fas fa-chart-line"></i></div></div></div></div>
</div>
<div class="d-block d-lg-none mb-2">
  <div class="card modern-card" style="overflow:hidden">
    <div class="card-body p-0" style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:0">
      <div class="text-center py-2" style="border-right:1px solid #f1f5f9;padding-top:.6rem !important;padding-bottom:.6rem !important">
        <div class="text-muted" style="font-size:.60rem;letter-spacing:.06em;text-transform:uppercase;font-weight:800">Total</div>
        <div style="font-size:1.15rem;font-weight:800;color:#1e293b;line-height:1;margin-top:.12rem"><?= $__totalLulus ?></div>
        <div class="small text-muted" style="font-size:.60rem">Alumni</div>
      </div>
      <div class="text-center py-2" style="border-right:1px solid #f1f5f9;padding-top:.6rem !important;padding-bottom:.6rem !important">
        <div class="text-muted" style="font-size:.60rem;letter-spacing:.06em;text-transform:uppercase;font-weight:800">Bulan Ini</div>
        <div style="font-size:1.15rem;font-weight:800;color:#065f46;line-height:1;margin-top:.12rem"><?= $__bulanIni ?></div>
        <div class="small text-muted" style="font-size:.60rem"><?= $bulanPendekIndo[date('n')].date(' Y') ?></div>
      </div>
      <div class="text-center py-2" style="padding-top:.6rem !important;padding-bottom:.6rem !important">
        <div class="text-muted" style="font-size:.60rem;letter-spacing:.06em;text-transform:uppercase;font-weight:800">Tahun Ini</div>
        <div style="font-size:1.25rem;font-weight:800;color:#5b21b6;line-height:1;margin-top:.15rem"><?= $__tahunIni ?></div>
        <div class="small text-muted" style="font-size:.62rem"><?= date('Y') ?></div>
      </div>
    </div>
  </div>
</div>
<div class="mb-2">
  <div class="sticky-grid">
          <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; foreach ($notes as $tp) { ?>
            <div class="sticky-note">
              <div class="sticky-tape"></div>
              <div class="sticky-jenis"><?= html_escape($tp->jenis) ?></div>
              <div class="sticky-data">
                <span class="edit" data-id="<?= $tp->id ?>" data-field="data" tabindex="0" role="button" aria-label="Ubah catatan"><span class="edit-text"><?= $tp->data !== '' ? html_escape($tp->data) : '<em style="color:#b45309;font-style:normal;opacity:.7">Belum diisi — klik untuk tulis</em>' ?></span><i class="fas fa-pen edit-icon" style="margin-left:.3rem"></i></span>
                <input type="text" class="txtedit pk" data-id="<?= $tp->id ?>" data-field="data" id="datatxt_<?= $tp->id ?>" value="<?= html_escape($tp->data) ?>" placeholder="Tulis catatan..." aria-label="Edit data">
              </div>
              <span class="note-saved" id="saved-<?= $tp->id ?>"><i class="fas fa-check mr-1"></i>Tersimpan</span>
            </div>
          <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; } ?>
          <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; if (empty($notes)) { ?>
            <div class="sticky-note" style="background:#fff;border:1px dashed #cbd5e1;transform:none;box-shadow:none">
              <div class="sticky-tape" style="background:rgba(241,245,249,.9)"></div>
              <div class="text-center py-2">
                <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:36px;height:36px;border-radius:.6rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-sticky-note"></i></div>
                <div class="small font-weight-bold" style="color:#334155">Belum ada catatan</div>
                <div class="small text-muted" style="font-size:.72rem">Tambahkan catatan untuk sertifikat yang belum dicetak</div>
              </div>
            </div>
          <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; } ?>
        </div>
      </div>

<div class="card modern-card mb-3">
  <div class="card-header py-2 d-flex flex-column flex-md-row align-items-md-center justify-content-between" style="gap:.6rem;padding-top:.65rem !important;padding-bottom:.65rem !important">
    <div class="d-flex align-items-center" style="gap:.6rem">
      <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Daftar Lulusan</h6>
    </div>
    <button class="btn btn-primary btn-sm d-none d-md-inline-flex align-items-center" data-toggle="modal" data-target="#modalTambah" style="background:#2563eb;border-color:#2563eb;border-radius:.5rem;font-weight:600;font-size:.78rem;padding:.38rem .65rem"><i class="fas fa-plus mr-1"></i> Tambah Lulusan</button>
  </div>
  <div class="d-block d-md-none">
    <div class="px-3 pt-3">
      <div class="app-search"><i class="fas fa-search"></i><input type="search" id="appSearchLulusan" placeholder="Cari nama, NIPD, kursus..."></div>
      <div class="app-filters" id="appFiltersLulusan">
        <button class="app-filter active" data-filter="">Semua</button>
        <button class="app-filter" data-filter="bulanini">Bulan Ini</button>
        <button class="app-filter" data-filter="tahunini">Tahun Ini</button>
      </div>
    </div>
    <div class="px-3 pb-3">
      <div id="appListLulusan" class="app-list">
        <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; foreach ($lulusan as $tp) {
          $initL = strtoupper(substr(trim($tp->Nama),0,1) . (strpos(trim($tp->Nama),' ') ? substr(trim($tp->Nama),strpos(trim($tp->Nama),' ')+1,1) : ''));
          $periode = date("d/m/Y",strtotime($tp->Tglmasuk)).' - '.date("d/m/Y",strtotime($tp->Tgllulus));
          $blnIni = date('Y-m', strtotime($tp->Tgllulus)) === date('Y-m') ? '1' : '0';
          $thnIni = date('Y', strtotime($tp->Tgllulus)) === date('Y') ? '1' : '0';
        ?>
          <div class="app-item" role="button" tabindex="0" style="cursor:pointer" data-search="<?= html_escape(strtolower($tp->Nama.' '.$tp->Nipd.' '.$tp->Namarombel.' '.$tp->NamaInstruktur)) ?>" data-bulan="<?= $blnIni ?>" data-tahun="<?= $thnIni ?>" data-idl="<?= $tp->Idl ?>" data-nama="<?= html_escape($tp->Nama) ?>" data-nipd="<?= html_escape($tp->Nipd) ?>" data-rombel="<?= html_escape($tp->Namarombel) ?>">
            <div class="app-item-avatar" style="background:rgba(139,92,246,.10);color:#7c3aed;flex-shrink:0"><?= html_escape($initL) ?></div>
            <div class="app-item-main" style="min-width:0;overflow:hidden">
              <div class="app-item-name" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= html_escape($tp->Nama) ?> <span class="mono" style="font-size:.66rem;color:#94a3b8;margin-left:.25rem"><?= html_escape($tp->Nipd) ?></span></div>
              <div class="app-item-sub" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><span><?= html_escape($tp->Namarombel) ?></span><span style="width:3px;height:3px;border-radius:50%;background:#cbd5e1;display:inline-block;flex-shrink:0"></span><span style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= html_escape($tp->NamaInstruktur) ?></span></div>
              <div class="app-item-meta" style="font-size:.68rem;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= html_escape($periode) ?> · <span class="mono"><?= html_escape(date("d/m/Y",strtotime($tp->Tglcetak))) ?></span></div>
            </div>
            <div class="app-item-arrow" style="flex-shrink:0"><i class="fas fa-chevron-right" style="font-size:.65rem"></i></div>
          </div>
        <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; } ?>
      </div>
      <div id="appEmptyLulusan" class="text-center py-4 d-none">
        <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:44px;height:44px;border-radius:.7rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-search"></i></div>
        <div class="small font-weight-bold" style="color:#334155">Tidak ada lulusan</div>
        <div class="small text-muted">Coba ubah pencarian atau filter</div>
      </div>
      <div class="d-flex align-items-center justify-content-between mt-3" id="appPaginationLulusan" style="gap:.5rem">
        <span class="small text-muted" id="appInfoLulusan" style="font-size:.72rem"></span>
        <div style="display:flex;gap:.4rem">
          <button id="appPrevLulusan" class="btn btn-sm" style="background:#fff;border:1px solid #e2e8f0;border-radius:.5rem;padding:.35rem .7rem;font-size:.72rem"><i class="fas fa-chevron-left"></i></button>
          <button id="appNextLulusan" class="btn btn-sm" style="background:#fff;border:1px solid #e2e8f0;border-radius:.5rem;padding:.35rem .7rem;font-size:.72rem"><i class="fas fa-chevron-right"></i></button>
        </div>
      </div>
    </div>
  </div>
  <div class="d-none d-md-block table-responsive">
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
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'];
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
                <td><?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; $nilais=[]; for($i=1;$i<=6;$i++){ $v=trim((string)$tp->{'n'.$i}); if($v!=='') $nilais[]=$v; } echo $nilais?html_escape(implode(', ',$nilais)):''; ?></td>
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
            <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; } ?>
          </tbody>
        </table>
      </div>
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
  var lulusPage=0, lulusPageSize=10, lulusFiltered=[];
  function renderLulusanPage(){
    var total=lulusFiltered.length;
    var start=lulusPage*lulusPageSize;
    var end=Math.min(start+lulusPageSize,total);
    $('#appListLulusan .app-item').hide();
    lulusFiltered.slice(start,end).forEach(function(el){ $(el).show(); });
    $('#appEmptyLulusan').toggleClass('d-none', total>0);
    $('#appInfoLulusan').text(total? 'Menampilkan '+(total?start+1:0)+'–'+end+' dari '+total : 'Tidak ada data');
    $('#appPrevLulusan').prop('disabled', lulusPage===0).css('opacity', lulusPage===0?.4:1);
    $('#appNextLulusan').prop('disabled', end>=total).css('opacity', end>=total?.4:1);
    $('#appPaginationLulusan').toggle(total>0);
  }
  function filterLulusanApp(){
    var q=($('#appSearchLulusan').val()||'').toLowerCase();
    var f=$('#appFiltersLulusan .app-filter.active').data('filter')||"";
    lulusFiltered=[];
    $('#appListLulusan .app-item').each(function(){
      var $it=$(this);
      var matchSearch=!q || String($it.data('search')).toLowerCase().indexOf(q)!==-1;
      var matchFilter=true;
      if(f==='bulanini') matchFilter=$it.data('bulan')==1;
      else if(f==='tahunini') matchFilter=$it.data('tahun')==1;
      if(matchSearch && matchFilter) lulusFiltered.push(this);
    });
    lulusPage=0;
    renderLulusanPage();
    var v=$('#appSearchLulusan').val();
    if($.fn.DataTable.isDataTable('#tabellulusan')){ try{ $('#tabellulusan').DataTable().search(v).draw(); }catch(e){} }
  }
  $(document).on('input','#appSearchLulusan', filterLulusanApp);
  $(document).on('click','#appFiltersLulusan .app-filter',function(){
    $('#appFiltersLulusan .app-filter').removeClass('active');
    $(this).addClass('active');
    filterLulusanApp();
  });
  $('#appPrevLulusan').on('click', function(){ if(lulusPage>0){ lulusPage--; renderLulusanPage(); }});
  $('#appNextLulusan').on('click', function(){ var total=lulusFiltered.length; if((lulusPage+1)*lulusPageSize < total){ lulusPage++; renderLulusanPage(); }});
  // init pagination on load
  setTimeout(filterLulusanApp, 120);
  $('#appListLulusan').on('click', '.app-item', function(e){
    if($(e.target).closest('a,button').length) return;
    var $it=$(this);
    var idl=$it.data('idl');
    var nama=$it.data('nama')||$it.find('.app-item-name').text().trim();
    var nipd=$it.data('nipd')||'';
    var rombel=$it.data('rombel')||'';
    $('#appLulusanNama').text(nama);
    $('#appLulusanSub').text(nipd+' · '+rombel);
    $('#appLulusanEdit').data('idl', idl);
    $('#appLulusanPrint').attr('href', '<?= base_url("sertifikat?Id=") ?>'+idl);
    $('#appLulusanHapus').data('idl', idl);
    $('#appLulusanAction').modal('show');
  });
  $('#appLulusanEdit').on('click', function(e){
    e.preventDefault();
    var idl=$(this).data('idl');
    $('#appLulusanAction').modal('hide');
    setTimeout(function(){ $('.btn-edit-lulusan[data-id="'+idl+'"]').trigger('click'); }, 320);
  });
  $('#appLulusanHapus').on('click', function(e){
    e.preventDefault();
    var idl=$(this).data('idl');
    $('#appLulusanAction').modal('hide');
    setTimeout(function(){ $('#deleteuser'+idl).modal('show'); }, 320);
  });
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
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'];
              $data = $this->db->query("SELECT Nipd,Nama FROM peserta WHERE Status=2 AND NOT EXISTS (SELECT Nipd FROM lulusan WHERE Nipd=peserta.Nipd) ORDER BY Nama ASC")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Nipd ?>"><?= $row->Nama ?> (<?= $row->Nipd ?>)</option>
              <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; } ?>
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
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'];
              $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= $row->NamaInstruktur ?></option>
              <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; } ?>
            </select>
          </div>

          <div id="nilaiContainer" style="display:none">
            <label class="field-label">Nilai Kompetensi</label>
            <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; for ($i = 1; $i <= 6; $i++) { ?>
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
            <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; } ?>
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
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'];
              $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= $row->NamaInstruktur ?></option>
              <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; } ?>
            </select>
          </div>
          <div id="editNilaiContainer" style="display:none">
            <label class="field-label">Nilai Kompetensi</label>
            <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; for ($i = 1; $i <= 6; $i++) { ?>
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
            <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; } ?>
          </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formUbahLulusan" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- App action sheet for lulusan mobile -->
<div class="modal fade" id="appLulusanAction" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:360px">
    <div class="modal-content" style="border:0;border-radius:.85rem;box-shadow:0 20px 60px rgba(15,23,42,.22);overflow:hidden">
      <div class="p-3 text-center" style="border-bottom:1px solid #f1f5f9">
        <div class="mx-auto d-flex align-items-center justify-content-center" style="width:44px;height:44px;border-radius:.7rem;background:rgba(139,92,246,.10);color:#7c3aed"><i class="fas fa-graduation-cap"></i></div>
        <div class="font-weight-bold mt-2" id="appLulusanNama" style="color:#1e293b;font-size:.9rem"></div>
        <div class="small text-muted" id="appLulusanSub" style="font-size:.72rem"></div>
      </div>
      <div class="p-2" style="display:grid;gap:.5rem">
        <a href="#" id="appLulusanEdit" class="btn text-left d-flex align-items-center" style="background:#fff;border:1px solid #e2e8f0;border-radius:.6rem;padding:.65rem;gap:.6rem"><span style="width:32px;height:32px;border-radius:.5rem;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-pen" style="font-size:.7rem"></i></span><span style="font-weight:700;color:#334155;font-size:.82rem">Edit Data</span><i class="fas fa-chevron-right ml-auto" style="font-size:.65rem;color:#cbd5e1"></i></a>
        <a href="#" id="appLulusanPrint" target="_blank" class="btn text-left d-flex align-items-center" style="background:#fffbeb;border:1px solid #fde68a;border-radius:.6rem;padding:.65rem;gap:.6rem"><span style="width:32px;height:32px;border-radius:.5rem;background:#fff;color:#d97706;border:1px solid #fde68a;display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-print" style="font-size:.7rem"></i></span><span style="font-weight:700;color:#92400e;font-size:.82rem">Cetak Sertifikat</span><i class="fas fa-external-link-alt ml-auto" style="font-size:.65rem;color:#cbd5e1"></i></a>
        <a href="#" id="appLulusanHapus" class="btn text-left d-flex align-items-center" style="background:#fff;border:1px solid #fecaca;border-radius:.6rem;padding:.65rem;gap:.6rem"><span style="width:32px;height:32px;border-radius:.5rem;background:#fef2f2;color:#dc2626;display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-trash-alt" style="font-size:.7rem"></i></span><span style="font-weight:700;color:#991b1b;font-size:.82rem">Hapus</span><i class="fas fa-chevron-right ml-auto" style="font-size:.65rem;color:#fecaca"></i></a>
      </div>
      <div class="p-2 pt-0">
        <button type="button" class="btn btn-light w-100" data-dismiss="modal" style="border-radius:.6rem;background:#f8fafc;border:1px solid #eef0f4;color:#475569;font-weight:600">Batal</button>
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
@media (max-width: 767.98px) {
  #appLulusanAction.modal.appl-open {
    display: -ms-flexbox !important;
    display: flex !important;
    -ms-flex-align: end;
    align-items: flex-end;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 0;
  }
  #appLulusanAction .modal-dialog {
    margin: 0;
    width: 100%;
    max-width: none;
    min-height: 0;
  }
  #appLulusanAction .modal-content {
    border-radius: 1.25rem 1.25rem 0 0 !important;
    box-shadow: 0 -8px 40px rgba(15, 23, 42, .18) !important;
  }
  #appLulusanAction .modal-content > div:last-child {
    padding-bottom: calc(.5rem + env(safe-area-inset-bottom, 0px)) !important;
  }
  #appLulusanAction.fade .modal-dialog {
    -webkit-transform: translateY(100vh);
    transform: translateY(100vh);
  }
  #appLulusanAction.show .modal-dialog {
    -webkit-transform: none;
    transform: none;
  }
  #appLulusanAction.modal.fade {
    -webkit-transition: opacity .3s linear;
    transition: opacity .3s linear;
  }
  #appLulusanAction.modal.fade .modal-dialog {
    -webkit-transition: -webkit-transform .3s ease-out;
    transition: transform .3s ease-out;
  }
  .example-modal > .modal.del-open {
    display: -ms-flexbox !important;
    display: flex !important;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: .75rem;
  }
  .example-modal .modal-dialog {
    margin: 0;
    width: 100%;
    max-width: 400px;
    min-height: 0;
  }
  .example-modal .modal.show .modal-dialog {
    -webkit-transform: none;
    transform: none;
  }
}
/* Slide-up halus saat sheet muncul */
@media (max-width: 575.98px) and (prefers-reduced-motion: no-preference) {
  .lulusan-app-modal.fade .modal-dialog { transform: translateY(28px); }
  .lulusan-app-modal.show .modal-dialog { transform: none; }
}
@media (min-width: 768px) {
  .lulusan-app-modal .modal-dialog { max-width: 540px; }
  #appLulusanAction.modal.appl-open {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: .75rem;
  }
  #appLulusanAction .modal-dialog {
    margin: 0;
    min-height: 0;
  }
  #appLulusanAction.show .modal-dialog {
    -webkit-transform: none;
    transform: none;
  }
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
    })
    .on('show.bs.modal', '#appLulusanAction', function () {
      this.classList.add('appl-open');
    })
    .on('hidden.bs.modal', '#appLulusanAction', function () {
      this.classList.remove('appl-open');
    })
    .on('show.bs.modal', '.example-modal > .modal', function () {
      this.classList.add('del-open');
    })
    .on('hidden.bs.modal', '.example-modal > .modal', function () {
      this.classList.remove('del-open');
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
  $(document).on('click', '.sticky-note .edit', function(e){
    e.preventDefault();
    $('.txtedit:visible').each(function(){ exitEdit($(this), false); });
    enterEdit($(this));
  });
  $(document).on('keydown', '.sticky-note .edit', function(e){
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
