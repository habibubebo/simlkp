<?php
$ukCell = function ($tp, $i) {
  $kode = trim((string) $tp->{'Kode' . $i});
  $nama = trim((string) $tp->{'Uk' . $i});
  $jp = trim((string) $tp->{'Jp' . $i});
  if ($nama === '' && $kode === '' && $jp === '') return '<span class="uk-empty">—</span>';
  $out = '';
  if ($kode !== '') $out .= '<span class="uk-kode">' . html_escape($kode) . '</span>';
  $out .= '<span class="uk-nama">' . html_escape(trim($nama)) . '</span>';
  if ($jp !== '') $out .= '<span class="uk-jp">' . html_escape($jp) . ' JP</span>';
  return $out;
};
$__total = count($uks);
$__units = 0; $__jpTotal = 0;
foreach ($uks as $__r) { for($i=1;$i<=6;$i++){ $n=trim((string)$__r->{'Uk'.$i}); if($n!==''&&$n!=='-') $__units++; $__jpTotal += (int)preg_replace('/[^0-9]/','', (string)($__r->{'Jp'.$i} ?? '')); } }
?>
<style>
.modern-head h1{letter-spacing:-.02em}
.modern-stat .stat-icon{width:2.6rem;height:2.6rem;border-radius:.65rem;display:flex;align-items:center;justify-content:center;font-size:1rem}
.modern-stat.stat-total .stat-icon{background:rgba(37,99,235,.1);color:#2563eb}
.modern-stat.stat-units .stat-icon{background:rgba(16,185,129,.12);color:#059669}
.modern-stat.stat-jp .stat-icon{background:rgba(245,158,11,.14);color:#d97706}
.modern-stat.stat-avg .stat-icon{background:rgba(139,92,246,.12);color:#7c3aed}
.modern-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04);background:#fff}
.modern-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.modern-table{width:100%!important}
.modern-table thead th{font-size:.64rem;letter-spacing:.07em;text-transform:uppercase;color:#94a3b8;font-weight:700;border-top:0;border-bottom:1px solid #f1f5f9;white-space:nowrap;padding:.75rem .6rem;background:#fcfdff}
.modern-table thead th.sorting,.modern-table thead th.sorting_asc,.modern-table thead th.sorting_desc{cursor:pointer;position:relative;padding-right:1.4rem}
.modern-table thead th.sorting:after,.modern-table thead th.sorting_asc:after,.modern-table thead th.sorting_desc:after{position:absolute;right:.4rem;top:50%;transform:translateY(-50%);font-family:'Font Awesome 5 Free';font-weight:900;font-size:.55rem;color:#cbd5e1;content:'\f0dc'}
.modern-table thead th.sorting_asc:after{color:#2563eb;content:'\f0de'}
.modern-table thead th.sorting_desc:after{color:#2563eb;content:'\f0dd'}
.modern-table tbody td{font-size:.78rem;color:#334155;vertical-align:top;padding:.6rem .6rem;border-top:1px solid #f8fafc;min-width:110px}
.modern-table tbody td:first-child,.modern-table tbody td:nth-child(2){vertical-align:middle;min-width:auto}
.modern-table tbody td:last-child{vertical-align:middle;min-width:90px}
.modern-table tbody tr:first-child td{border-top:0}
.modern-table tbody tr:hover td{background:#f8fafc}
.uk-kode{display:block;font-size:.62rem;letter-spacing:.04em;text-transform:uppercase;font-weight:700;color:#94a3b8;line-height:1}
.uk-nama{display:block;font-weight:600;color:#1e293b;line-height:1.3;margin-top:.1rem;word-break:break-word}
.uk-jp{display:inline-block;margin-top:.25rem;font-size:.66rem;font-weight:700;color:#475569;background:#f1f5f9;border:1px solid #e2e8f0;border-radius:9999px;padding:.12rem .4rem;line-height:1}
.uk-empty{color:#cbd5e1;font-size:.78rem}
.mono{font-family:'SFMono-Regular',Consolas,'Liberation Mono',Menlo,monospace}
.modern-table-wrap{border-radius:0 0 .85rem .85rem;overflow:hidden}
.modern-table-wrap .dataTables_scroll{border-radius:0 0 .85rem .85rem}
.modern-table-wrap .dataTables_scrollHead{border-radius:0}
.modern-table-wrap .dataTables_scrollHeadInner table{margin-bottom:0!important}
.modern-table-wrap .dataTables_scrollBody{border-radius:0 0 .85rem .85rem}
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
.modern-card .dataTables_paginate .paginate_button{border:1px solid #e2e8f0!important;background:#fff!important;color:#475569!important;border-radius:.5rem!important;padding:.32rem .62rem!important;font-size:.76rem!important;font-weight:600!important;line-height:1!important;min-width:32px;text-align:center;transition:all .15s}
.modern-card .dataTables_paginate .paginate_button:hover{background:#f8fafc!important;border-color:#cbd5e1!important;color:#1e293b!important}
.modern-card .dataTables_paginate .paginate_button.current,.modern-card .dataTables_paginate .paginate_button.current:hover{background:#2563eb!important;border-color:#2563eb!important;color:#fff!important;box-shadow:0 2px 8px rgba(37,99,235,.25)}

/* mobile app list */
.app-search{position:relative;display:flex;align-items:center;background:#fff;border:1px solid #e2e8f0;border-radius:9999px;padding:.6rem 1rem .6rem 2.5rem;box-shadow:0 1px 2px rgba(15,23,42,.04);transition:border-color .15s,box-shadow .15s}
.app-search:focus-within{border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
.app-search i{position:absolute;left:1rem;color:#94a3b8;font-size:.85rem}
.app-search input{border:none;outline:none;width:100%;font-size:.82rem;color:#1e293b;background:transparent}
.app-search input::placeholder{color:#94a3b8}
.app-list{display:grid;gap:.7rem}
.app-item{background:#fff;border:1px solid #eef0f4;border-radius:.85rem;padding:.8rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04);display:flex;flex-wrap:wrap;gap:.7rem;align-items:flex-start}
.app-item-main{flex:1;min-width:0;overflow:hidden}
.app-item-actions{width:100%;display:flex;gap:.4rem;margin-top:.15rem}
.app-action{flex:1;display:flex;align-items:center;justify-content:center;gap:.35rem;font-size:.7rem;font-weight:700;border-radius:.5rem;padding:.42rem .3rem;text-decoration:none!important;transition:transform .12s}
.app-action:active{transform:scale(.97)}
.act-edit{background:#fff;border:1px solid #e2e8f0;color:#475569}
.act-del{background:#fff;border:1px solid #fecaca;color:#dc2626}
.app-chip{display:inline-flex;align-items:center;gap:.3rem;background:#f8fafc;border:1px solid #eef0f4;color:#475569;border-radius:9999px;padding:.16rem .5rem;font-size:.66rem;font-weight:600}
.app-chip i{font-size:.55rem;color:#94a3b8}
.avatar-sm{width:32px;height:32px;border-radius:.5rem;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.7rem;flex-shrink:0}
.avatar-uk{background:rgba(37,99,235,.1);color:#2563eb}
.uk-m-list{display:grid;gap:.35rem;margin-top:.55rem}
.uk-m-item{display:flex;align-items:center;gap:.5rem;background:#f8fafc;border:1px solid #f1f5f9;border-radius:.5rem;padding:.42rem .55rem;font-size:.74rem;min-width:0}
.uk-m-kode{flex-shrink:0;font-size:.6rem;letter-spacing:.03em;text-transform:uppercase;font-weight:700;color:#94a3b8;line-height:1}
.uk-m-nama{flex:1;min-width:0;font-weight:600;color:#334155;line-height:1.25;word-break:break-word}
.uk-m-jp{flex-shrink:0;font-size:.62rem;font-weight:700;color:#475569;background:#fff;border:1px solid #e2e8f0;border-radius:9999px;padding:.14rem .4rem;line-height:1}
.fab-uk{position:fixed;bottom:calc(76px + env(safe-area-inset-bottom,0px));right:16px;z-index:1029;width:52px;height:52px;border-radius:9999px;background:#2563eb;color:#fff;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(37,99,235,.4);font-size:1.1rem;text-decoration:none;transition:transform .12s}
.fab-uk:active{transform:scale(.95)}
.modal-uk .modal-content{border:0;border-radius:.9rem;box-shadow:0 20px 60px rgba(15,23,42,.18)}
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}.modern-card .dt-top{flex-direction:column;align-items:stretch}.modern-card .dataTables_filter input{width:100%}.modern-card .dataTables_filter label{width:100%}.modern-card .dt-bottom{flex-direction:column;align-items:stretch;text-align:center}.modern-card .dataTables_paginate .pagination{justify-content:center}}
@media(prefers-reduced-motion:reduce){.app-action,.fab-uk{transition:none}}
</style>

<!-- Header desktop -->
<div class="modern-head d-none d-md-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Unit Kompetensi</h1>
    <p class="text-muted small mb-0">Kelola unit kompetensi per program pelatihan</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Unit Kompetensi</li>
  </ol>
</div>

<!-- Header mobile -->
<div class="d-md-none mt-3 mb-3 app-page-head">
  <div class="d-flex align-items-center justify-content-between mb-2" style="gap:.6rem">
    <div style="min-width:0">
      <h1 style="font-size:1.15rem;font-weight:800;color:#1e293b;letter-spacing:-.01em;margin:0">Unit Kompetensi</h1>
      <div class="small text-muted" style="font-size:.72rem">Kelola unit kompetensi per program pelatihan</div>
    </div>
    <span class="badge flex-shrink-0" style="background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;font-size:.7rem;border-radius:9999px;padding:.3rem .6rem;font-weight:700"><?= $__total ?> program</span>
  </div>
  <div class="app-search"><i class="fas fa-search"></i><input type="search" id="appSearchUk" placeholder="Cari program, kelas, unit..."></div>
</div>

<!-- Stats desktop -->
<div class="row mb-3 d-none d-md-flex">
  <div class="col-6 col-xl-3 mb-3">
    <div class="card modern-card modern-stat stat-total h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Program</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#1e293b"><?= $__total ?></div><div class="small text-muted" style="font-size:.72rem">Jenis kursus terdata</div></div><div class="stat-icon"><i class="fas fa-layer-group"></i></div></div></div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card modern-card modern-stat stat-units h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total Unit</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#065f46"><?= $__units ?></div><div class="small text-muted" style="font-size:.72rem"><?= $__total ? round($__units/$__total,1) : 0 ?> rata-rata / program</div></div><div class="stat-icon"><i class="fas fa-cubes"></i></div></div></div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card modern-card modern-stat stat-jp h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total JP</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#92400e"><?= $__jpTotal ?></div><div class="small text-muted" style="font-size:.72rem">Jam pelajaran</div></div><div class="stat-icon"><i class="fas fa-clock"></i></div></div></div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card modern-card modern-stat stat-avg h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Rata-rata</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#5b21b6"><?= $__total ? round($__jpTotal/$__total) : 0 ?></div><div class="small text-muted" style="font-size:.72rem">JP / program</div></div><div class="stat-icon"><i class="fas fa-chart-bar"></i></div></div></div>
  </div>
</div>

<!-- Stats mobile -->
<div class="card modern-card d-md-none mb-3">
  <div class="row no-gutters text-center" style="font-size:.78rem">
    <div class="col-6 py-3" style="border-right:1px solid #f1f5f9;border-bottom:1px solid #f1f5f9"><div class="text-muted" style="font-size:.62rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Program</div><div style="font-weight:800;color:#1e293b;font-size:1.1rem"><?= $__total ?></div></div>
    <div class="col-6 py-3" style="border-bottom:1px solid #f1f5f9"><div class="text-muted" style="font-size:.62rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total Unit</div><div style="font-weight:800;color:#065f46;font-size:1.1rem"><?= $__units ?></div></div>
    <div class="col-6 py-3" style="border-right:1px solid #f1f5f9"><div class="text-muted" style="font-size:.62rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total JP</div><div style="font-weight:800;color:#92400e;font-size:1.1rem"><?= $__jpTotal ?></div></div>
    <div class="col-6 py-3"><div class="text-muted" style="font-size:.62rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Rata-rata</div><div style="font-weight:800;color:#5b21b6;font-size:1.1rem"><?= $__total ? round($__jpTotal/$__total) : 0 ?> <span style="font-size:.66rem;color:#94a3b8;font-weight:600">JP</span></div></div>
  </div>
</div>

<!-- List mobile -->
<div class="d-md-none mb-4">
  <div id="appListUk" class="app-list">
    <?php foreach ($uks as $tp) {
      $unitCount = 0; $jpProg = 0; $unitsHtml = '';
      for ($i = 1; $i <= 6; $i++) {
        $kode = trim((string) $tp->{'Kode' . $i});
        $nama = trim((string) $tp->{'Uk' . $i});
        $jp = trim((string) $tp->{'Jp' . $i});
        if ($nama === '' && $kode === '' && $jp === '') continue;
        $unitCount++;
        $jpProg += (int) preg_replace('/[^0-9]/', '', $jp);
        $unitsHtml .= '<div class="uk-m-item">';
        if ($kode !== '') $unitsHtml .= '<span class="uk-m-kode">' . html_escape($kode) . '</span>';
        $unitsHtml .= '<span class="uk-m-nama">' . html_escape($nama) . '</span>';
        if ($jp !== '') $unitsHtml .= '<span class="uk-m-jp">' . html_escape($jp) . ' JP</span>';
        $unitsHtml .= '</div>';
      }
      $srcParts = [$tp->Namarombel, $tp->Kelas, $jpProg];
      for ($i = 1; $i <= 6; $i++) { $srcParts[] = (string)$tp->{'Uk' . $i}; $srcParts[] = (string)$tp->{'Kode' . $i}; }
      $search = strtolower(trim(implode(' ', $srcParts)));
    ?>
      <div class="app-item" data-search="<?= html_escape($search) ?>">
        <div class="avatar-sm avatar-uk" style="width:42px;height:42px;border-radius:.6rem;font-size:.95rem"><i class="fas fa-layer-group"></i></div>
        <div class="app-item-main">
          <div class="d-flex align-items-center" style="gap:.45rem;margin-bottom:.2rem">
            <div style="font-weight:700;color:#1e293b;font-size:.84rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= html_escape($tp->Namarombel) ?></div>
            <span class="badge flex-shrink-0" style="background:#f8fafc;color:#334155;border:1px solid #e2e8f0;font-weight:600;font-size:.66rem;border-radius:.4rem;padding:.2rem .4rem"><?= html_escape($tp->Kelas) ?></span>
          </div>
          <div class="d-flex align-items-center" style="gap:.4rem;flex-wrap:wrap">
            <span class="app-chip"><i class="fas fa-cubes"></i><?= $unitCount ?> unit</span>
            <?php if ($jpProg > 0) { ?><span class="app-chip"><i class="fas fa-clock"></i><?= $jpProg ?> JP</span><?php } ?>
          </div>
          <?php if (!empty($unitsHtml)) { ?><div class="uk-m-list"><?= $unitsHtml ?></div><?php } ?>
        </div>
        <div class="app-item-actions">
          <a href="<?= base_url("uk/form_ubah/$tp->Idu") ?>" class="app-action act-edit"><i class="fas fa-pen" style="font-size:.66rem"></i>Ubah</a>
          <a href="#" class="app-action act-del" data-toggle="modal" data-target="#deleteUkModal" data-id="<?= $tp->Idu ?>" data-nama="<?= html_escape($tp->Namarombel) ?>"><i class="fas fa-trash-alt" style="font-size:.66rem"></i>Hapus</a>
        </div>
      </div>
    <?php } ?>
  </div>
  <div id="appEmptyUk" class="text-center py-4 d-none">
    <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:44px;height:44px;border-radius:.7rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-search"></i></div>
    <div class="small font-weight-bold" style="color:#334155">Tidak ada unit kompetensi</div>
    <div class="small text-muted">Coba ubah pencarian</div>
  </div>
  <?php if ($__total === 0) { ?>
    <div class="text-center py-5 px-3"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;border-radius:.85rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-layer-group fa-lg"></i></div><h6 class="font-weight-bold" style="color:#1e293b">Belum ada unit kompetensi</h6><p class="small text-muted mb-0">Tambahkan UK pertama untuk program pelatihan.</p></div>
  <?php } ?>
</div>

<!-- FAB tambah (mobile) -->
<a href="<?= base_url('uk/form') ?>" class="fab-uk d-md-none" aria-label="Tambah UK"><i class="fas fa-plus"></i></a>

<!-- Tabel desktop -->
<div class="card modern-card mb-4 d-none d-md-block">
  <div class="card-header py-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between" style="gap:.6rem">
    <div class="d-flex align-items-center" style="gap:.6rem">
      <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Daftar Unit Kompetensi</h6>
      <span class="badge" style="background:#f1f5f9;color:#475569;font-weight:600;font-size:.68rem;border-radius:9999px;padding:.3rem .55rem"><?= $__total ?> program</span>
    </div>
    <a href="<?= base_url('uk/form') ?>" class="btn btn-primary btn-sm" style="background:#2563eb;border-color:#2563eb;border-radius:.5rem;font-weight:600;font-size:.78rem;padding:.42rem .75rem"><i class="fas fa-plus mr-1"></i> Tambah UK</a>
  </div>
  <div class="modern-table-wrap table-responsive">
    <table class="table modern-table table-hover mb-0" id="tabeluk" style="width:100%">
      <thead>
        <tr>
          <th>Jenis Kursus</th>
          <th>Kelas</th>
          <th>Unit 1</th>
          <th>Unit 2</th>
          <th>Unit 3</th>
          <th>Unit 4</th>
          <th>Unit 5</th>
          <th>Unit 6</th>
          <th class="text-right" style="width:90px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($uks as $tp) { ?>
          <tr>
            <td style="font-weight:700;color:#1e293b;white-space:nowrap"><?= html_escape($tp->Namarombel) ?></td>
            <td><span class="badge" style="background:#f8fafc;color:#334155;border:1px solid #e2e8f0;font-weight:600;font-size:.7rem;border-radius:.4rem;padding:.2rem .4rem"><?= html_escape($tp->Kelas) ?></span></td>
            <td><?= $ukCell($tp, 1) ?></td>
            <td><?= $ukCell($tp, 2) ?></td>
            <td><?= $ukCell($tp, 3) ?></td>
            <td><?= $ukCell($tp, 4) ?></td>
            <td><?= $ukCell($tp, 5) ?></td>
            <td><?= $ukCell($tp, 6) ?></td>
            <td class="text-right">
              <div class="d-inline-flex" style="gap:.3rem">
                <a href="<?= base_url("uk/form_ubah/$tp->Idu") ?>" class="btn btn-sm" style="background:#fff;border:1px solid #e2e8f0;color:#475569;border-radius:.45rem;padding:.32rem .45rem" title="Ubah"><i class="fas fa-pen" style="font-size:.7rem"></i></a>
                <a href="#" class="btn btn-sm" style="background:#fff;border:1px solid #fecaca;color:#dc2626;border-radius:.45rem;padding:.32rem .45rem" data-toggle="modal" data-target="#deleteUkModal" data-id="<?= $tp->Idu ?>" data-nama="<?= html_escape($tp->Namarombel) ?>" title="Hapus"><i class="fas fa-trash-alt" style="font-size:.7rem"></i></a>
              </div>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php if ($__total === 0) { ?>
    <div class="text-center py-5 px-3"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;border-radius:.85rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-layer-group fa-lg"></i></div><h6 class="font-weight-bold" style="color:#1e293b">Belum ada unit kompetensi</h6><p class="small text-muted mb-3">Tambahkan UK pertama untuk program pelatihan.</p><a href="<?= base_url('uk/form') ?>" class="btn btn-primary" style="border-radius:.6rem;font-weight:600"><i class="fas fa-plus mr-1"></i> Tambah UK</a></div>
  <?php } ?>
</div>

<!-- Modal hapus (shared) -->
<div class="modal fade modal-uk" id="deleteUkModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:420px">
    <div class="modal-content">
      <div class="modal-body p-4 text-center">
        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;border-radius:50%;background:#fef2f2;color:#dc2626"><i class="fas fa-trash-alt"></i></div>
        <h6 class="font-weight-bold mb-1" style="color:#1e293b">Hapus UK?</h6>
        <p class="small text-muted mb-0">Yakin ingin menghapus unit kompetensi <span style="font-weight:600;color:#334155" id="deleteUkName"></span> ?</p>
      </div>
      <div class="modal-footer border-0 pt-0 px-4 pb-4 d-flex" style="gap:.5rem">
        <button type="button" class="btn flex-fill" data-dismiss="modal" style="border:1px solid #e2e8f0;background:#fff;color:#475569;border-radius:.55rem;font-weight:600">Batal</button>
        <a href="#" id="deleteUkConfirm" class="btn btn-danger flex-fill" style="border-radius:.55rem;font-weight:600">Hapus</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">document.title = "Unit Kompetensi <?= ($profil[0]->Namalkp ?? '') ?>";</script>
<script>
$(function(){
  function initUk(){
    var $t=$('#tabeluk'); if(!$t.length) return;
    if($.fn.DataTable.isDataTable($t)){ try{$t.DataTable().destroy();}catch(e){} $t.removeAttr('style'); }
    $t.DataTable({
      scrollX:true, scrollCollapse:true, pageLength:10, lengthMenu:[5,10,25,50], order:[[0,'asc']],
      columnDefs:[{orderable:false,targets:[8]}, {width:'90px',targets:[8]}],
      dom:'<"dt-top"lf>rt<"dt-bottom"ip>',
      language:{search:"",searchPlaceholder:"Cari jenis kursus, kelas...",lengthMenu:"Tampil _MENU_",info:"Menampilkan _START_–_END_ dari _TOTAL_ program",infoEmpty:"Tidak ada program",infoFiltered:"(difilter dari _MAX_ total)",zeroRecords:"Tidak ada data yang cocok",emptyTable:"Belum ada UK",paginate:{first:"Awal",last:"Akhir",next:"›",previous:"‹"}}
    });
  }
  if(document.readyState==='complete') setTimeout(initUk,80); else $(window).on('load',function(){setTimeout(initUk,80);});
  setTimeout(initUk,300);

  function filterUkApp(){
    var q=(($('#appSearchUk').val()||'').toLowerCase());
    var vis=0;
    $('#appListUk .app-item').each(function(){
      var $it=$(this);
      var s=String($it.data('search')||'').toLowerCase();
      if(!s) s=$it.text().toLowerCase();
      var show=!q || s.indexOf(q)!==-1;
      $it.toggle(show);
      if(show) vis++;
    });
    $('#appEmptyUk').toggleClass('d-none', vis>0);
  }
  $(document).on('input','#appSearchUk', filterUkApp);

  $('#deleteUkModal').on('show.bs.modal', function(e){
    var b=$(e.relatedTarget); if(!b||!b.length) return;
    $('#deleteUkName').text(b.data('nama')||'');
    $('#deleteUkConfirm').attr('href','<?= base_url('uk/hapus/') ?>'+b.data('id'));
  });
});
</script>