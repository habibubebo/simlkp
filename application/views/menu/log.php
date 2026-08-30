<?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'];
$__total = count($logs);
$__today = date('Y-m-d');
$__todayCount = 0; $__byType = [];
foreach ($logs as $__r) {
  $d = substr($__r->log_tgl ?? '', 0, 10);
  if ($d === $__today) $__todayCount++;
  $t = strtolower(trim($__r->log_tipe ?? ''));
  $__byType[$t] = ($__byType[$t] ?? 0) + 1;
}
$__login = ($__byType['login'] ?? 0);
$__add = ($__byType['add'] ?? 0);
$__edit = ($__byType['edit'] ?? 0);
$__delete = ($__byType['delete'] ?? 0);
?>
<style>
.modern-head h1{letter-spacing:-.02em}
.modern-stat .stat-icon{width:2.6rem;height:2.6rem;border-radius:.65rem;display:flex;align-items:center;justify-content:center;font-size:1rem}
.modern-stat.stat-total .stat-icon{background:rgba(37,99,235,.1);color:#2563eb}
.modern-stat.stat-today .stat-icon{background:rgba(16,185,129,.12);color:#059669}
.modern-stat.stat-login .stat-icon{background:rgba(139,92,246,.12);color:#7c3aed}
.modern-stat.stat-act .stat-icon{background:rgba(245,158,11,.14);color:#d97706}
.modern-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04)}
.modern-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.modern-table{width:100%!important}
.modern-table thead th{font-size:.66rem;letter-spacing:.07em;text-transform:uppercase;color:#94a3b8;font-weight:700;border-top:0;border-bottom:1px solid #f1f5f9;white-space:nowrap;padding:.8rem .7rem;background:#fcfdff}
.modern-table tbody td{font-size:.82rem;color:#334155;vertical-align:middle;padding:.62rem .7rem;border-top:1px solid #f8fafc}
.modern-table tbody tr:first-child td{border-top:0}
.modern-table tbody tr:hover td{background:#f8fafc}
.mono{font-family:'SFMono-Regular',Consolas,'Liberation Mono',Menlo,monospace;font-size:.72rem;color:#475569}
.badge-tipe{font-size:.65rem;font-weight:700;padding:.22rem .5rem;border-radius:9999px;border:1px solid transparent;letter-spacing:.02em;text-transform:uppercase}
.badge-login{background:#eff6ff;color:#1d4ed8;border-color:#bfdbfe}
.badge-logout{background:#f1f5f9;color:#475569;border-color:#e2e8f0}
.badge-add{background:#ecfdf5;color:#065f46;border-color:#a7f3d0}
.badge-edit{background:#fffbeb;color:#92400e;border-color:#fde68a}
.badge-delete{background:#fef2f2;color:#991b1b;border-color:#fecaca}
.avatar-log{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.65rem;flex-shrink:0;background:#f1f5f9;color:#475569}
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
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}.modern-card .dt-top{flex-direction:column;align-items:stretch}.modern-card .dataTables_filter input{width:100%}.modern-card .dataTables_filter label{width:100%}}
</style>

<div class="modern-head d-none d-md-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Log Sistem</h1>
    <p class="text-muted small mb-0">Riwayat aktivitas pengguna — 200 terbaru</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Log</li>
  </ol>
</div>

<div class="row mb-3">
  <div class="col-6 col-xl-3 mb-3"><div class="card modern-card modern-stat stat-total h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total Log</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#1e293b"><?= $__total ?></div><div class="small text-muted" style="font-size:.72rem">Terbaru 200</div></div><div class="stat-icon"><i class="fas fa-list-alt"></i></div></div></div></div>
  <div class="col-6 col-xl-3 mb-3"><div class="card modern-card modern-stat stat-today h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Hari Ini</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#065f46"><?= $__todayCount ?></div><div class="small text-muted" style="font-size:.72rem"><?= date('d').' '.$bulanPendekIndo[date('n')].' '.date('Y')?></div></div><div class="stat-icon"><i class="fas fa-calendar-day"></i></div></div></div></div>
  <div class="col-6 col-xl-3 mb-3"><div class="card modern-card modern-stat stat-login h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Login</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#5b21b6"><?= $__login ?></div><div class="small text-muted" style="font-size:.72rem">Akses sistem</div></div><div class="stat-icon"><i class="fas fa-sign-in-alt"></i></div></div></div></div>
  <div class="col-6 col-xl-3 mb-3"><div class="card modern-card modern-stat stat-act h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Aktivitas</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#92400e"><?= $__add + $__edit + $__delete ?></div><div class="small text-muted" style="font-size:.72rem">Add <?= $__add ?> · Edit <?= $__edit ?> · Del <?= $__delete ?></div></div><div class="stat-icon"><i class="fas fa-exchange-alt"></i></div></div></div></div>
</div>

<div class="card modern-card mb-4">
  <div class="card-header py-3 d-flex align-items-center" style="gap:.6rem">
    <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Riwayat Log</h6>
    <span class="badge" style="background:#f1f5f9;color:#475569;font-weight:600;font-size:.68rem;border-radius:9999px;padding:.3rem .55rem"><?= $__total ?> entri</span>
  </div>
  <div class="modern-table-wrap table-responsive">
    <table class="table modern-table table-hover mb-0" id="tabelLog" style="width:100%">
      <thead>
        <tr>
          <th style="width:48px" class="text-center">No</th>
          <th>Waktu</th>
          <th>Pengguna</th>
          <th>Tipe</th>
          <th>Deskripsi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; $no=1; foreach ($logs as $tp) {
          $tipe = strtolower(trim($tp->log_tipe ?? ''));
          $badgeClass = 'badge-logout';
          if ($tipe==='login') $badgeClass='badge-login';
          elseif ($tipe==='logout') $badgeClass='badge-logout';
          elseif ($tipe==='add') $badgeClass='badge-add';
          elseif ($tipe==='edit') $badgeClass='badge-edit';
          elseif ($tipe==='delete') $badgeClass='badge-delete';
          $tgl = $tp->log_tgl ?? '';
          $tglFmt = $tgl ? date('d-m-Y', strtotime($tgl)) : '-';
          $jamFmt = $tgl ? date('H:i:s', strtotime($tgl)) : '';
          $initial = strtoupper(substr(trim($tp->log_user ?? '?'),0,1));
        ?>
          <tr>
            <td class="text-center"><span class="mono" style="color:#94a3b8"><?= $no++ ?></span></td>
            <td><div style="line-height:1.25"><span class="mono" style="font-size:.78rem;color:#1e293b;font-weight:600"><?= $tglFmt ?></span><br><span class="mono" style="font-size:.68rem;color:#94a3b8"><?= $jamFmt ?></span></div></td>
            <td>
              <div class="d-flex align-items-center" style="gap:.5rem">
                <span class="avatar-log"><?= html_escape($initial) ?></span>
                <span style="font-weight:600;color:#1e293b;font-size:.82rem"><?= html_escape($tp->log_user) ?></span>
              </div>
            </td>
            <td><span class="badge-tipe <?= $badgeClass ?>"><?= html_escape($tp->log_tipe) ?></span></td>
            <td><span class="small" style="color:#334155"><?= html_escape($tp->log_desc) ?></span></td>
          </tr>
        <?php 
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; 
$bulanPendekIndo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des']; } ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">document.title = "Log Sistem";</script>
<script>
$(function(){
  function initLog(){
    var $t=$('#tabelLog'); if(!$t.length) return;
    if($.fn.DataTable.isDataTable($t)){ try{$t.DataTable().destroy();}catch(e){} $t.removeAttr('style'); }
    $t.DataTable({
      pageLength:25, lengthMenu:[10,25,50,100], order:[[1,'desc']],
      columnDefs:[{orderable:false,targets:[0]}],
      dom:'<"dt-top"lf>rt<"dt-bottom"ip>',
      language:{search:"",searchPlaceholder:"Cari pengguna, tipe, deskripsi...",lengthMenu:"Tampil _MENU_",info:"Menampilkan _START_–_END_ dari _TOTAL_ log",infoEmpty:"Tidak ada log",infoFiltered:"(difilter dari _MAX_ total)",zeroRecords:"Tidak ada data yang cocok",emptyTable:"Belum ada log",paginate:{first:"Awal",last:"Akhir",next:"›",previous:"‹"}},
      drawCallback:function(){ var h=[]; this.api().columns().header().toArray().forEach(function(th){h.push($(th).text().trim());}); this.api().rows({page:'current'}).nodes().toArray().forEach(function(r){$(r).find('td').each(function(i){if(h[i])$(this).attr('data-label',h[i]);});}); }
    });
  }
  if(document.readyState==='complete') setTimeout(initLog,80); else $(window).on('load',function(){setTimeout(initLog,80);});
  setTimeout(initLog,300);
});
</script>
