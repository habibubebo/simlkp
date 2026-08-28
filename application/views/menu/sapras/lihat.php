<?php
$__total = count($sapras);
$__baik = 0; $__rusak = 0; $__perbaikan = 0; $__luas = 0;
foreach ($sapras as $__r) {
  $k = strtolower(trim($__r->kondisi ?? ''));
  if ($k === 'baik') $__baik++;
  elseif ($k === 'rusak') $__rusak++;
  elseif ($k === 'perbaikan') $__perbaikan++;
  $__luas += (float)($__r->Luaslahan ?? 0);
}
?>
<style>
.sapras-head h1{letter-spacing:-.02em}
.sapras-stat .stat-icon{width:2.6rem;height:2.6rem;border-radius:.65rem;display:flex;align-items:center;justify-content:center;font-size:1rem}
.sapras-stat.stat-total .stat-icon{background:rgba(37,99,235,.1);color:#2563eb}
.sapras-stat.stat-baik .stat-icon{background:rgba(16,185,129,.12);color:#059669}
.sapras-stat.stat-perbaikan .stat-icon{background:rgba(245,158,11,.14);color:#d97706}
.sapras-stat.stat-rusak .stat-icon{background:rgba(239,68,68,.12);color:#dc2626}
.sapras-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04)}
.sapras-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.sapras-table{width:100%!important}
.sapras-table thead th{font-size:.66rem;letter-spacing:.07em;text-transform:uppercase;color:#94a3b8;font-weight:700;border-top:0;border-bottom:1px solid #f1f5f9;white-space:nowrap;padding:.8rem .85rem;background:#fcfdff}
.sapras-table thead th.sorting,.sapras-table thead th.sorting_asc,.sapras-table thead th.sorting_desc{cursor:pointer;position:relative;padding-right:1.6rem}
.sapras-table thead th.sorting:after,.sapras-table thead th.sorting_asc:after,.sapras-table thead th.sorting_desc:after{position:absolute;right:.55rem;top:50%;transform:translateY(-50%);font-family:'Font Awesome 5 Free';font-weight:900;font-size:.6rem;color:#cbd5e1;content:'\f0dc'}
.sapras-table thead th.sorting_asc:after{color:#2563eb;content:'\f0de'}
.sapras-table thead th.sorting_desc:after{color:#2563eb;content:'\f0dd'}
.sapras-table tbody td{font-size:.82rem;color:#334155;vertical-align:middle;padding:.72rem .85rem;border-top:1px solid #f8fafc}
.sapras-table tbody tr:first-child td{border-top:0}
.sapras-table tbody tr:hover td{background:#f8fafc}
.sapras-table tbody tr:last-child td{border-bottom:0}
.kondisi-badge{font-size:.68rem;font-weight:700;letter-spacing:.02em;padding:.28rem .55rem;border-radius:9999px;border:1px solid transparent;white-space:nowrap}
.kondisi-baik{background:#ecfdf5;color:#047857;border-color:#a7f3d0}
.kondisi-rusak{background:#fef2f2;color:#b91c1c;border-color:#fecaca}
.kondisi-perbaikan{background:#fffbeb;color:#92400e;border-color:#fde68a}
.kondisi-unknown{background:#f1f5f9;color:#64748b;border-color:#e2e8f0}
.mono-num{font-family:'SFMono-Regular',Consolas,'Liberation Mono',Menlo,monospace;font-size:.78rem;color:#475569}
.sapras-actions .btn{border-radius:.5rem;font-weight:600;font-size:.78rem;padding:.42rem .7rem}
.sapras-actions .btn-primary{background:#2563eb;border-color:#2563eb}
.sapras-actions .btn-outline-secondary{border-color:#e2e8f0;color:#475569;background:#fff}
.sapras-actions .btn-outline-secondary:hover{background:#f8fafc;border-color:#cbd5e1;color:#1e293b}
.sapras-table-wrap{border-radius:0 0 .85rem .85rem;overflow:hidden}
/* DataTables modern overrides */
.sapras-card .dataTables_wrapper{padding:0}
.sapras-card .dataTables_wrapper .row{margin:0}
.sapras-card .dataTables_wrapper .dataTables_length,.sapras-card .dataTables_wrapper .dataTables_filter,.sapras-card .dataTables_wrapper .dataTables_info,.sapras-card .dataTables_wrapper .dataTables_paginate{padding:0}
.sapras-card .dt-top{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:.75rem;padding:1rem 1.1rem .85rem;border-bottom:1px solid #f1f5f9;background:#fff}
.sapras-card .dataTables_length label{margin:0;display:flex;align-items:center;gap:.4rem;font-size:.78rem;color:#64748b;font-weight:500}
.sapras-card .dataTables_length select{border:1px solid #e2e8f0;border-radius:.5rem;padding:.32rem 1.6rem .32rem .6rem;font-size:.78rem;color:#334155;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E") no-repeat right .5rem center;appearance:none;min-width:64px}
.sapras-card .dataTables_length select:focus{outline:none;border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
.sapras-card .dataTables_filter label{margin:0;display:flex;align-items:center;gap:.5rem;font-size:.78rem;color:#64748b;font-weight:500}
.sapras-card .dataTables_filter input{border:1px solid #e2e8f0;border-radius:.6rem;padding:.42rem .75rem .42rem 2rem;font-size:.82rem;color:#334155;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' stroke='%2394a3b8' stroke-width='1.7' viewBox='0 0 24 24'%3E%3Ccircle cx='11' cy='11' r='7'/%3E%3Cpath d='M20 20l-3.5-3.5'/%3E%3C/svg%3E") no-repeat 9px center;width:240px;transition:border-color .15s,box-shadow .15s}
.sapras-card .dataTables_filter input:focus{outline:none;border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
.sapras-card .dataTables_filter input::placeholder{color:#94a3b8}
.sapras-card .dt-bottom{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:.75rem;padding:.85rem 1.1rem;border-top:1px solid #f1f5f9;background:#fcfdff}
.sapras-card .dataTables_info{font-size:.76rem;color:#94a3b8;padding:0!important}
.sapras-card .dataTables_paginate{padding:0!important}
.sapras-card .dataTables_paginate .pagination{margin:0;gap:.28rem}
.sapras-card .dataTables_paginate .paginate_button{border:1px solid #e2e8f0!important;background:#fff!important;color:#475569!important;border-radius:.5rem!important;padding:.32rem .62rem!important;font-size:.76rem!important;font-weight:600!important;line-height:1!important;min-width:32px;text-align:center;transition:all .15s}
.sapras-card .dataTables_paginate .paginate_button:hover{background:#f8fafc!important;border-color:#cbd5e1!important;color:#1e293b!important}
.sapras-card .dataTables_paginate .paginate_button.current,.sapras-card .dataTables_paginate .paginate_button.current:hover{background:#2563eb!important;border-color:#2563eb!important;color:#fff!important;box-shadow:0 2px 8px rgba(37,99,235,.25)}
.sapras-card .dataTables_paginate .paginate_button.disabled{opacity:.4;pointer-events:none}
.sapras-card .dataTables_empty{padding:2rem!important;color:#94a3b8!important}
@media(max-width:767.98px){
  .sapras-table thead{display:table-header-group}
  .sapras-head .breadcrumb{display:none}
  .sapras-card .dt-top{flex-direction:column;align-items:stretch}
  .sapras-card .dataTables_filter input{width:100%}
  .sapras-card .dataTables_filter label{width:100%}
  .sapras-card .dt-bottom{flex-direction:column;align-items:stretch;text-align:center}
  .sapras-card .dataTables_paginate .pagination{justify-content:center}
}
</style>

<!-- Header -->
<div class="sapras-head d-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Sarana Prasarana</h1>
    <p class="text-muted small mb-0">Kelola data tanah, bangunan, alat dan inventaris lembaga</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Sarana Prasarana</li>
  </ol>
</div>

<!-- Stats -->
<div class="row mb-3">
  <div class="col-6 col-xl-3 mb-3">
    <div class="card sapras-card sapras-stat stat-total h-100">
      <div class="card-body py-3 d-flex align-items-center justify-content-between">
        <div>
          <div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Total Unit</div>
          <div class="h4 mb-0 mt-1" style="font-weight:800;color:#1e293b"><?= $__total ?></div>
          <div class="small text-muted" style="font-size:.72rem"><?= number_format($__luas,0,',','.') ?> m² total luas</div>
        </div>
        <div class="stat-icon"><i class="fas fa-warehouse"></i></div>
      </div>
    </div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card sapras-card sapras-stat stat-baik h-100">
      <div class="card-body py-3 d-flex align-items-center justify-content-between">
        <div>
          <div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Kondisi Baik</div>
          <div class="h4 mb-0 mt-1" style="font-weight:800;color:#065f46"><?= $__baik ?></div>
          <div class="small" style="font-size:.72rem;color:#059669"><?= $__total ? round($__baik/$__total*100) : 0 ?>% dari total</div>
        </div>
        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
      </div>
    </div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card sapras-card sapras-stat stat-perbaikan h-100">
      <div class="card-body py-3 d-flex align-items-center justify-content-between">
        <div>
          <div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Perbaikan</div>
          <div class="h4 mb-0 mt-1" style="font-weight:800;color:#92400e"><?= $__perbaikan ?></div>
          <div class="small" style="font-size:.72rem;color:#d97706">Perlu tindak lanjut</div>
        </div>
        <div class="stat-icon"><i class="fas fa-tools"></i></div>
      </div>
    </div>
  </div>
  <div class="col-6 col-xl-3 mb-3">
    <div class="card sapras-card sapras-stat stat-rusak h-100">
      <div class="card-body py-3 d-flex align-items-center justify-content-between">
        <div>
          <div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Rusak</div>
          <div class="h4 mb-0 mt-1" style="font-weight:800;color:#991b1b"><?= $__rusak ?></div>
          <div class="small" style="font-size:.72rem;color:#dc2626"><?= $__rusak ? 'Butuh perhatian' : 'Aman' ?></div>
        </div>
        <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
      </div>
    </div>
  </div>
</div>

<!-- Table Card -->
<div class="card sapras-card mb-4">
  <div class="card-header py-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
    <div class="d-flex align-items-center gap-2">
      <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Daftar Sarana</h6>
      <span class="badge" style="background:#f1f5f9;color:#475569;font-weight:600;font-size:.68rem;border-radius:9999px;padding:.3rem .55rem"><?= $__total ?> data</span>
    </div>
    <div class="sapras-actions d-flex align-items-center gap-2">
      <a href="<?= base_url('Laporan/sapras'); ?>" class="btn btn-outline-secondary">
        <i class="fas fa-download mr-1"></i> Unduh
      </a>
      <a href="<?= base_url('sapras/form'); ?>" class="btn btn-primary">
        <i class="fas fa-plus mr-1"></i> Tambah
      </a>
    </div>
  </div>
  <div class="sapras-table-wrap table-responsive">
    <table class="table sapras-table table-hover mb-0" id="dataTableHover" style="width:100%">
      <thead>
        <tr>
          <th>Jenis</th>
          <th>Nama Prasarana</th>
          <th>No Sertifikat</th>
          <th>Dimensi</th>
          <th>Luas</th>
          <th>Kondisi</th>
          <th class="text-center">Jml</th>
          <th class="text-right" style="width:96px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($sapras as $tp) {
          $kond = strtolower(trim($tp->kondisi ?? ''));
          $badgeClass = 'kondisi-unknown';
          if ($kond === 'baik') $badgeClass = 'kondisi-baik';
          elseif ($kond === 'rusak') $badgeClass = 'kondisi-rusak';
          elseif ($kond === 'perbaikan') $badgeClass = 'kondisi-perbaikan';
          $sert = trim($tp->Nosertifikat ?? '');
          $dim = '-';
          if ($tp->Panjang || $tp->Lebar) $dim = ($tp->Panjang ? $tp->Panjang : '-') . ' × ' . ($tp->Lebar ? $tp->Lebar : '-');
        ?>
          <tr>
            <td><span class="badge" style="background:#f8fafc;color:#334155;border:1px solid #e2e8f0;font-weight:600;font-size:.7rem;border-radius:.4rem;padding:.25rem .45rem"><?= html_escape($tp->Jenissarana) ?></span></td>
            <td style="font-weight:600;color:#1e293b;max-width:220px">
              <div class="text-truncate" title="<?= html_escape($tp->Namaprasarana) ?>"><?= html_escape($tp->Namaprasarana) ?></div>
            </td>
            <td>
              <?php if ($sert !== '' && $sert !== '-') { ?>
                <span class="mono-num" title="<?= html_escape($sert) ?>"><?= html_escape($sert) ?></span>
              <?php } else { ?>
                <span class="text-muted" style="font-size:.78rem">—</span>
              <?php } ?>
            </td>
            <td><span class="mono-num"><?= html_escape($dim) ?> <span class="text-muted" style="font-size:.68rem">m</span></span></td>
            <td><span class="mono-num"><?= $tp->Luaslahan ? html_escape($tp->Luaslahan) . ' <span class="text-muted" style="font-size:.68rem">m²</span>' : '<span class="text-muted">—</span>' ?></span></td>
            <td><span class="kondisi-badge <?= $badgeClass ?>"><?= html_escape($tp->kondisi ?: '—') ?></span></td>
            <td class="text-center"><span class="mono-num" style="font-weight:700;color:#1e293b"><?= html_escape($tp->Banyaknya) ?></span></td>
            <td class="text-right">
              <div class="d-inline-flex" style="gap:.35rem">
                <a href="<?= base_url("sapras/form_ubah/$tp->Id") ?>" class="btn btn-sm" style="background:#fff;border:1px solid #e2e8f0;color:#475569;border-radius:.45rem;padding:.32rem .5rem" title="Ubah">
                  <i class="fas fa-pen" style="font-size:.7rem"></i>
                </a>
                <a href="#" class="btn btn-sm" style="background:#fff;border:1px solid #fecaca;color:#dc2626;border-radius:.45rem;padding:.32rem .5rem" data-toggle="modal" data-target="#deleteSarpras<?= $tp->Id; ?>" title="Hapus">
                  <i class="fas fa-trash-alt" style="font-size:.7rem"></i>
                </a>
              </div>
              <!-- delete modal -->
              <div class="modal fade" id="deleteSarpras<?= $tp->Id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:420px">
                  <div class="modal-content" style="border:0;border-radius:.85rem;box-shadow:0 20px 60px rgba(15,23,42,.18)">
                    <div class="modal-body p-4 text-center">
                      <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;border-radius:50%;background:#fef2f2;color:#dc2626"><i class="fas fa-trash-alt"></i></div>
                      <h6 class="font-weight-bold mb-1" style="color:#1e293b">Hapus sarana?</h6>
                      <p class="small text-muted mb-0">Yakin ingin menghapus <span style="font-weight:600;color:#334155"><?= html_escape($tp->Namaprasarana) ?></span> ? Tindakan tidak dapat dibatalkan.</p>
                    </div>
                    <div class="modal-footer border-0 pt-0 px-4 pb-4 d-flex" style="gap:.5rem">
                      <button type="button" class="btn flex-fill" data-dismiss="modal" style="border:1px solid #e2e8f0;background:#fff;color:#475569;border-radius:.55rem;font-weight:600">Batal</button>
                      <a href="<?= base_url('sapras/hapus/' . $tp->Id) ?>" class="btn btn-danger flex-fill" style="border-radius:.55rem;font-weight:600">Hapus</a>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php if ($__total === 0) { ?>
    <div class="text-center py-5 px-3">
      <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:56px;height:56px;border-radius:.85rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-box-open fa-lg"></i></div>
      <h6 class="font-weight-bold" style="color:#1e293b">Belum ada data sarana</h6>
      <p class="small text-muted mb-3">Tambahkan sarana prasarana pertama untuk mulai mengelola inventaris.</p>
      <a href="<?= base_url('sapras/form'); ?>" class="btn btn-primary" style="border-radius:.6rem;font-weight:600"><i class="fas fa-plus mr-1"></i> Tambah Sarana</a>
    </div>
  <?php } ?>
</div>

<script type="text/javascript">document.title = "Sarana Prasarana";</script>
<script>
$(function(){
  // modernize DataTable — override default init from footer
  function initSaprasTable(){
    var $t = $('#dataTableHover');
    if (!$t.length) return;
    if ($.fn.DataTable.isDataTable($t)) {
      try { $t.DataTable().destroy(); } catch(e) {}
      $t.removeAttr('style');
    }
    var dt = $t.DataTable({
      pageLength: 10,
      lengthMenu: [5, 10, 25, 50],
      order: [[1, 'asc']],
      columnDefs: [
        { orderable: false, targets: [7] },
        { searchable: false, targets: [7] }
      ],
      dom: '<"dt-top"lf>t<"dt-bottom"ip>',
      language: {
        search: "",
        searchPlaceholder: "Cari jenis, nama, sertifikat...",
        lengthMenu: "Tampil _MENU_",
        info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
        infoEmpty: "Tidak ada data",
        infoFiltered: "(difilter dari _MAX_ total)",
        zeroRecords: "Tidak ada data yang cocok",
        emptyTable: "Belum ada data sarana",
        paginate: { first: "Awal", last: "Akhir", next: "›", previous: "‹" }
      },
      drawCallback: function(){
        // keep mobile card labels in sync (ruang-admin mobile pattern)
        var api = this.api();
        var headers = [];
        api.columns().header().toArray().forEach(function(th){ headers.push($(th).text().trim()); });
        api.rows({page:'current'}).nodes().toArray().forEach(function(row){
          $(row).find('td').each(function(i){ if(headers[i]) $(this).attr('data-label', headers[i]); });
        });
      }
    });
    // move pagination to Bootstrap pagination markup for our styling
    $t.on('draw.dt', function(){
      $('.dataTables_paginate .pagination').addClass('mb-0');
    });
  }
  // run after footer's default init
  if (document.readyState === 'complete') setTimeout(initSaprasTable, 80);
  else $(window).on('load', function(){ setTimeout(initSaprasTable, 80); });
  setTimeout(initSaprasTable, 300);
});
</script>
