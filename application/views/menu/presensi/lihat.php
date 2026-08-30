<!-- Header -->
<?php
function perpendekNama($s) {
    $p = explode(',', $s, 2);
    $k = preg_split('/\s+/', trim($p[0]));
    $n = implode(' ', array_splice($k, 0, 2)) . ($k ? ' ' . implode('', array_map(fn($w) => strtoupper($w[0] ?? ''), $k)) . '.' : '');
    
    return trim($n) . (isset($p[1]) ? ', ' . rtrim(trim($p[1]), '.') : '');
}

?>
<style>
.modern-head h1{letter-spacing:-.02em}
.modern-stat .stat-icon{width:2.6rem;height:2.6rem;border-radius:.65rem;display:flex;align-items:center;justify-content:center;font-size:1rem}
.modern-stat.stat-pes .stat-icon{background:rgba(37,99,235,.1);color:#2563eb}
.modern-stat.stat-peg .stat-icon{background:rgba(16,185,129,.12);color:#059669}
.modern-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04)}
.modern-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.modern-table{width:100%!important}
.modern-table thead th{font-size:.66rem;letter-spacing:.07em;text-transform:uppercase;color:#94a3b8;font-weight:700;border-top:0;border-bottom:1px solid #f1f5f9;white-space:nowrap;padding:.8rem .7rem;background:#fcfdff}
.modern-table tbody td{font-size:.82rem;color:#334155;vertical-align:middle;padding:.62rem .7rem;border-top:1px solid #f8fafc}
.modern-table tbody tr:hover td{background:#f8fafc}
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
.app-item{background:#fff;border:1px solid #eef0f4;border-radius:.85rem;padding:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04);display:flex;gap:.75rem;align-items:center;transition:transform .12s}
.app-item:active{transform:scale(.98)}
.app-item-avatar{width:44px;height:44px;border-radius:.75rem;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.78rem;flex-shrink:0}
.app-item-main{flex:1;min-width:0}
.app-item-name{font-weight:800;color:#1e293b;font-size:.82rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.app-item-sub{font-size:.70rem;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:flex;align-items:center;gap:.35rem;flex-wrap:wrap}
.app-item-arrow{width:32px;height:32px;border-radius:9999px;background:#f8fafc;border:1px solid #eef0f4;display:flex;align-items:center;justify-content:center;color:#94a3b8;flex-shrink:0}
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}.modern-card .dt-top{flex-direction:column;align-items:stretch}.modern-card .dataTables_filter input{width:100%}.modern-card .dataTables_filter label{width:100%}}
</style>
<?php
$today = date("Y-m-d 00:00:00");
$todays = date("Y-m-d 23:59:59");
$_pes = $this->db->query("SELECT COUNT(*) as c FROM presensi WHERE Tgl between '$today' and '$todays' AND pegawai IS Null")->row()->c ?? 0;
$_pegArr = $this->db->query("SELECT NamaPegawai FROM presensi JOIN pegawai ON presensi.Nipd = pegawai.Nipg WHERE Tgl between '$today' and '$todays' AND pegawai=1")->result();
$_insArr = $this->db->query("SELECT DISTINCT NamaInstruktur FROM presensi JOIN instruktur ON presensi.Instruktur = instruktur.Id WHERE Tgl between '$today' and '$todays' AND (pegawai IS NULL OR pegawai != 1) AND Instruktur IS NOT NULL")->result();
$_pegNamesArr = array_map(fn($r)=>$r->NamaPegawai, $_pegArr);
$_insNamesArr = array_map(fn($r)=>$r->NamaInstruktur, $_insArr);
$_allStaff = array_values(array_unique(array_merge($_pegNamesArr, $_insNamesArr)));
$_pegCount = count($_allStaff);
$_pegNames = implode(', ', $_allStaff);
?>
<div class="modern-head d-none d-md-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Presensi</h1>
    <p class="text-muted small mb-0">Kehadiran peserta dan staff (instruktur/pegawai) harian</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Presensi</li>
  </ol>
</div>
<div class="row mb-3">
  <div class="col-6 mb-3"><div class="card modern-card modern-stat stat-pes h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Peserta Hari Ini</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#1e293b"><?= $_pes ?></div><div class="small text-muted" style="font-size:.72rem">Kehadiran tercatat</div></div><div class="stat-icon"><i class="fas fa-user-check"></i></div></div></div></div>
  <div class="col-6 mb-3"><div class="card modern-card modern-stat stat-peg h-100"><div class="card-body py-3 d-flex align-items-center justify-content-between"><div><div class="text-muted" style="font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700">Staff Hari Ini</div><div class="h4 mb-0 mt-1" style="font-weight:800;color:#065f46"><?= $_pegCount ?></div><div class="small text-muted" style="font-size:.72rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:160px" title="<?= html_escape($_pegNames) ?>"><?= 'Ada' ? 'Ada' : 'Belum ada' ?></div></div><div class="stat-icon"><i class="fas fa-users"></i></div></div></div></div>
</div>
<!-- Content -->
<div class="card modern-card mb-4">
  <div class="card-header py-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between" style="gap:.6rem">
    <div class="d-flex align-items-center" style="gap:.6rem">
      <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Daftar Presensi</h6>
    </div>
    <div class="d-flex align-items-center" style="gap:.5rem">
      <button class="btn btn-sm d-none d-md-inline-flex align-items-center" style="background:#eff6ff;border:1px solid #bfdbfe;color:#2563eb;border-radius:.5rem;font-weight:600;font-size:.78rem;padding:.38rem .6rem" data-toggle="modal" data-target="#tambahPresensiSiswa"><i class="fas fa-user-plus mr-1"></i> Peserta</button>
      <button class="btn btn-sm d-none d-md-inline-flex align-items-center" style="background:#fffbeb;border:1px solid #fde68a;color:#92400e;border-radius:.5rem;font-weight:600;font-size:.78rem;padding:.38rem .6rem" data-toggle="modal" data-target="#tambahPres"><i class="fas fa-id-badge mr-1"></i> Pegawai</button>
    </div>
  </div>
  <div class="d-block d-md-none">
    <div class="px-3 pt-3">
      <div class="app-search"><i class="fas fa-search"></i><input type="search" id="appSearchPresensi" placeholder="Cari nama, materi, kursus..."></div>
      <div class="app-filters" id="appFiltersPresensi">
        <button class="app-filter active" data-filter="">Semua</button>
        <button class="app-filter" data-filter="hariini">Hari Ini</button>
        <button class="app-filter" data-filter="mingguini">Minggu Ini</button>
      </div>
    </div>
    <div class="px-3 pb-3">
      <div id="appListPresensi" class="app-list"></div>
      <div id="appEmptyPresensi" class="text-center py-4 d-none">
        <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:44px;height:44px;border-radius:.7rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-search"></i></div>
        <div class="small font-weight-bold" style="color:#334155">Tidak ada presensi</div>
        <div class="small text-muted">Coba ubah pencarian atau filter</div>
      </div>
      <div class="d-flex align-items-center justify-content-between mt-3" id="appPaginationPresensi" style="gap:.5rem">
        <span class="small text-muted" id="appInfoPresensi" style="font-size:.72rem"></span>
        <div style="display:flex;gap:.4rem">
          <button id="appPrevPresensi" class="btn btn-sm" style="background:#fff;border:1px solid #e2e8f0;border-radius:.5rem;padding:.35rem .7rem;font-size:.72rem"><i class="fas fa-chevron-left"></i></button>
          <button id="appNextPresensi" class="btn btn-sm" style="background:#fff;border:1px solid #e2e8f0;border-radius:.5rem;padding:.35rem .7rem;font-size:.72rem"><i class="fas fa-chevron-right"></i></button>
        </div>
      </div>
    </div>
  </div>
  <div class="d-none d-md-block table-responsive">
    <table class="table modern-table table-hover mb-0" id="tabelpresensi" style="width:100%">
          <thead class="thead-light">
            <tr>
              <th>Tanggal</th>
              <th>Nama</th>
              <th>Jenis Kursus</th>
              <th>Instuktur</th>
              <th>Materi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
</div>
<button class="fab-presensi" data-toggle="modal" data-target="#tambahPresensiSiswa" title="Tambah Presensi">
  <i class="fas fa-plus"></i>
</button>
<script type="text/javascript">
  document.title = "Presensi <?= $profil[0]->Namalkp?>";
</script>
<script>
var appPath = '<?= base_url() ?>';
var hariList = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
var bulanList = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

function fmtTanggal(raw) {
  if (!raw) return '';
  var d = new Date(raw);
  var dd = ('0'+d.getDate()).slice(-2);
  var hh = ('0'+d.getHours()).slice(-2);
  var mm = ('0'+d.getMinutes()).slice(-2);
  var bln = bulanList[d.getMonth()+1].substring(0,3);
  return '<span style="font-size:.74rem;font-weight:600;color:#334155;white-space:nowrap">'+dd+' '+bln+'</span><br><span style="font-size:.66rem;color:#94a3b8;white-space:nowrap">'+hh+':'+mm+'</span>';
}

function pendekNama(s) {
  if (!s) return '';
  var parts = s.split(',', 2);
  var words = parts[0].trim().split(/\s+/);
  var out = words.slice(0, 2).join(' ');
  if (words.length > 2) {
    out += ' ' + words.slice(2).map(function(w){ return w.charAt(0).toUpperCase() + '.'; }).join('');
  }
  return out.trim() + (parts[1] ? ', ' + parts[1].trim().replace(/\.$/, '') : '');
}

function esc(s) { return s ? s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;') : ''; }

$(document).ready(function() {
  var tabel = $('#tabelpresensi').DataTable({
    processing: true,
    serverSide: true,
    ordering: true,
    order: [[0, 'desc']],
    dom: '<"dt-top"lf>rt<"dt-bottom"ip>',
    pagingType: 'numbers',
    language: {
      search: "",
      searchPlaceholder: "Cari nama, materi, kursus...",
      lengthMenu: "Tampil _MENU_",
      info: "Menampilkan _START_–_END_ dari _TOTAL_ presensi",
      infoEmpty: "Tidak ada presensi",
      infoFiltered: "(difilter dari _MAX_ total)",
      zeroRecords: "Tidak ada data yang cocok",
      emptyTable: "Belum ada presensi",
      paginate: { first: "Awal", last: "Akhir", next: "›", previous: "‹" }
    },
    ajax: {
      url: '<?= base_url('cek/presensi'); ?>',
      type: 'POST'
    },
    deferRender: true,
    aLengthMenu: [[10, 50, 100], [10, 50, 100]],
    columns: [
      { data: 'Tgl' },
      { data: 'Nama' },
      { data: 'Namarombel' },
      { data: 'NamaInstruktur' },
      { data: 'Materi' },
      { data: 'Id' }
    ],
    columnDefs: [
      {
        targets: 0,
        render: function(data) { return fmtTanggal(data); }
      },
      {
        targets: 1,
        render: function(data, type, row) {
          return '<a class="table-link" href="' + appPath + 'index.php/presensi/peserta?Id=' + row.Idp + '" title="Melihat seluruh presensi ' + esc(row.Nama) + '">' + esc(pendekNama(row.Nama)) + '</a>';
        }
      },
      {
        targets: 3,
        render: function(data, type, row) {
          if (!data) return '<span style="color:#cbd5e1;font-size:.72rem">-</span>';
          var short = (function(n) {
            var c = n.split(',');
            var title = c.length > 1 ? c[c.length - 1].trim().split(/\s+/)[0] : '';
            var namePart = c[0].trim();
            var words = namePart.split(/\s+/);
            var prefixes = ['dr.','prof.','drs.','drj.','ir.','hj.','hm.','drh.'];
            var first = words[0];
            var nama = prefixes.indexOf(first.toLowerCase()) !== -1 && words.length > 1 ? words[1] : first;
            return title ? nama.substring(0,8)+'. ' + title.substring(0,4)+'.' : nama.substring(0,8);
          })(data);
          return '<a class="table-link ins-link" href="' + appPath + 'presensi/instruktur?Id=' + row.IdI + '" title="'+esc(data)+'" style="font-size:.72rem;white-space:nowrap">'+esc(short)+'</a>';
        }
      },
      {
        targets: 5,
        orderable: false,
        className: 'text-center',
        render: function(data, type, row) {
          return '<div class="d-inline-flex" style="gap:.3rem">' +
            '<a class="dt-btn dt-btn-edit" href="#" data-toggle="modal" data-target="#editPresensi" data-id="' + row.Id + '" data-tgl="' + esc(row.Tgl) + '" data-nipd="' + esc(row.Nipd) + '" data-nama="' + esc(row.Nama) + '" data-jks="' + esc(row.Jeniskursus) + '" data-ins="' + esc(row.IdI) + '" data-materi="' + esc(row.Materi) + '" title="Ubah"><i class="fas fa-pen"></i></a>' +
            '<a class="dt-btn dt-btn-delete btn-hapus-presensi" href="#" data-id="' + row.Id + '" data-nama="' + esc(row.Nama) + '" data-tgl="' + esc(row.Tgl) + '" title="Hapus"><i class="fas fa-trash-alt"></i></a>' +
            '</div>';
        }
      }
    ],
    drawCallback: function(){ var h=[]; this.api().columns().header().toArray().forEach(function(th){h.push($(th).text().trim());}); this.api().rows({page:'current'}).nodes().toArray().forEach(function(r){$(r).find('td').each(function(i){if(h[i])$(this).attr('data-label',h[i]);});}); }
  });
  function initialsPresensi(n){ if(!n) return '?'; var p=n.trim().split(/\s+/); if(p.length===1) return p[0].substring(0,2).toUpperCase(); return (p[0][0]+p[p.length-1][0]).toUpperCase(); }
  function renderAppPresensi(){
    var $list=$('#appListPresensi'); if(!$list.length) return;
    var data=tabel.rows({page:'current'}).data().toArray();
    $list.empty();
    if(!data.length){ $('#appEmptyPresensi').removeClass('d-none'); $('#appInfoPresensi').text('Tidak ada data'); $('#appPrevPresensi,#appNextPresensi').prop('disabled',true).css('opacity',.4); return; }
    $('#appEmptyPresensi').addClass('d-none');
    var info=tabel.page.info(); $('#appInfoPresensi').text('Menampilkan '+(info.start+1)+'–'+info.end+' dari '+info.recordsTotal);
    $('#appPrevPresensi').prop('disabled',!info.page).css('opacity',info.page?1:.4);
    $('#appNextPresensi').prop('disabled',info.page>=info.pages-1).css('opacity',info.page>=info.pages-1?.4:1);
    data.forEach(function(row){
      var init=initialsPresensi(row.Nama);
      var tgl=row.Tgl? new Date(row.Tgl):null;
      var tglStr='-'; var jamStr='';
      if(tgl && !isNaN(tgl.getTime())){
        var blnShort=['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'][tgl.getMonth()+1];
        tglStr=String(tgl.getDate())+' '+blnShort;
        jamStr=String(tgl.getHours()).padStart(2,'0')+':'+String(tgl.getMinutes()).padStart(2,'0');
      }
      var prog=esc(row.Namarombel||'-');
      var materiShort=esc((row.Materi||'-').substring(0,18));
      var nama=esc(pendekNama(row.Nama));
      var insShort=(function(n){ if(!n) return '-'; var c=n.split(','); var w=c[0].trim().split(/\s+/); return w[0].substring(0,7); })(row.NamaInstruktur||'');
      var html='<div class="app-item" data-id="'+row.Id+'" data-idp="'+row.Idp+'" data-idi="'+row.IdI+'">'
        +'<div class="app-item-avatar" style="background:rgba(37,99,235,.08);color:#2563eb">'+init+'</div>'
        +'<div class="app-item-main">'
          +'<div class="app-item-name" style="font-size:.78rem">'+nama+' <span style="font-weight:500;color:#94a3b8;font-size:.66rem">'+jamStr+'</span></div>'
          +'<div class="app-item-sub" style="font-size:.66rem"><span>'+prog+'</span><span style="width:3px;height:3px;border-radius:50%;background:#cbd5e1;display:inline-block"></span><span style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:42%">'+materiShort+'</span></div>'
          +'<div class="app-item-meta" style="font-size:.62rem;color:#94a3b8"><span style="color:#64748b;font-size:.66rem">'+tglStr+'</span> · <span style="color:#94a3b8;font-size:.62rem">'+esc(insShort)+'</span></div>'
        +'</div>'
        +'<div class="app-item-arrow"><i class="fas fa-chevron-right" style="font-size:.60rem"></i></div>'
        +'</div>';
      $list.append(html);
    });
  }
  tabel.on('draw', renderAppPresensi);
  $('#appSearchPresensi').on('input', function(){ tabel.search(this.value).draw(); });
  $('#appFiltersPresensi .app-filter').on('click', function(){
    $('#appFiltersPresensi .app-filter').removeClass('active'); $(this).addClass('active');
    var f=$(this).data('filter');
    if(f==='hariini'){ var d=new Date().toISOString().slice(0,10); tabel.search(d).draw(); }
    else if(f==='mingguini'){ tabel.search('').draw(); }
    else { tabel.search('').draw(); }
  });
  $('#appPrevPresensi').on('click', function(){ tabel.page('previous').draw('page'); });
  $('#appNextPresensi').on('click', function(){ tabel.page('next').draw('page'); });
  $('#appListPresensi').on('click', '.app-item', function(e){
    if($(e.target).closest('a,button').length) return;
    var idp=$(this).data('idp');
    var idi=$(this).data('idi');
    if(idp) window.location.href=appPath+'presensi/peserta?Id='+idp;
    else if(idi) window.location.href=appPath+'presensi/instruktur?Id='+idi;
  });

  // Hapus via konfirmasi (tanpa modal statis)
  $(document).on('click', '.btn-hapus-presensi', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    var tgl = $(this).data('tgl');
    if (confirm('Apakah anda yakin ingin menghapus data ' + nama + ' tanggal ' + tgl + ' ?')) {
      window.location.href = appPath + 'index.php/presensi/hapus/' + id;
    }
  });
});
</script>

<!-- Modal Tambah Presensi Siswa -->
<div class="modal fade app-modal" id="tambahPresensiSiswa" tabindex="-1" role="dialog" aria-labelledby="tambahPresensiTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content presensi-content">
      <div class="modal-header presensi-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-user-check"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="tambahPresensiTitle">Tambah Presensi</h5>
            <div class="presensi-subtitle">Catat kehadiran peserta kursus</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form id="formPresensi" action="<?= base_url('index.php/presensi/tambah') ?>" method="POST" class="modal-body presensi-body px-3 px-sm-4 py-3">
          <div class="form-group mb-3" id="simple-date1">
            <label class="field-label" for="simpleDataInput">Tanggal</label>
            <div class="input-group date">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
              </div>
              <input type="text" name="tgl" class="form-control presensi-input" id="simpleDataInput" required readonly value="<?= date('Y-m-d') ?>" autocomplete="off">
            </div>
          </div>

          <div class="form-group mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <label class="field-label mb-0" for="nama">Peserta <span class="font-weight-normal text-muted">(boleh pilih banyak)</span></label>
              <span class="badge badge-pill badge-presensi d-none" id="pesertaCount"></span>
            </div>
            <select class="form-control" id="nama" name="nama[]" multiple>
              <?php
              $data = $this->db->query("SELECT Nama,Nipd FROM peserta WHERE Status=1")->result();
              $no = 1;
              foreach ($data as $row) { ?>
                <option value="<?= $row->Nipd ?>"><?= $no++ . '. ' . $row->Nama ?></option>
              <?php } ?>
            </select>
            <div class="field-error d-none" id="pesertaError">Pilih minimal satu peserta.</div>
          </div>

          <div class="form-group mb-3">
            <label class="field-label" for="instrukturPresensi">Instruktur</label>
            <select class="form-control presensi-input" id="instrukturPresensi" name="Instruktur" required>
              <option value="">Pilih instruktur</option>
              <?php
              $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= $row->NamaInstruktur ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group mb-1">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
              <label class="field-label mb-0 mr-2">Jadwal & Materi</label>
              <div class="d-flex align-items-center">
                <div class="sesi-stepper mr-2" role="group" aria-label="Geser jam dalam kelipatan 15 menit">
                  <button type="button" class="step-btn" id="jamMinBtn" title="Kurangi 15 menit" aria-label="Kurangi 15 menit"><i class="fas fa-minus" aria-hidden="true"></i></button>
                  <span class="step-value" title="Bulatkan ke 15 menit">15</span>
                  <button type="button" class="step-btn" id="jamPlusBtn" title="Tambah 15 menit" aria-label="Tambah 15 menit"><i class="fas fa-plus" aria-hidden="true"></i></button>
                </div>
                <div class="sesi-stepper" role="group" aria-label="Atur jumlah sesi">
                  <button type="button" class="step-btn" id="minusBtn" aria-label="Kurangi sesi"><i class="fas fa-minus" aria-hidden="true"></i></button>
                  <input type="text" class="step-value" id="jumlah" name="jumlah" value="1" readonly aria-label="Jumlah sesi">
                  <button type="button" class="step-btn" id="plusBtn" aria-label="Tambah sesi"><i class="fas fa-plus" aria-hidden="true"></i></button>
                </div>
              </div>
            </div>
            <div id="materiContainer">
              <div class="materi-row">
                <span class="materi-num">1</span>
                <input type="time" class="form-control presensi-input materi-jam" name="waktu[]" value="<?= date('H:i') ?>" required aria-label="Jam pertemuan 1">
                <input type="text" class="form-control presensi-input" name="materi[]" placeholder="Materi pertemuan 1" required aria-label="Materi pertemuan 1">
              </div>
            </div>
          </div>
      </form>
      <div class="modal-footer presensi-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formPresensi" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Presensi -->
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
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form id="formEditPresensi" action="<?= base_url('index.php/presensi/ubah') ?>" method="POST" class="modal-body px-3 px-sm-4 py-3">
        <input type="hidden" name="Id" id="epId">
        <input type="hidden" name="jks" id="epJks">
        <div class="form-row mb-2">
          <div class="form-group col-8 col-md-8 mb-0" id="ep-date-tgl">
            <label class="field-label" for="epTgl">Tanggal Hadir</label>
            <div class="input-group date">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
              </div>
              <input type="text" name="tgl" class="form-control presensi-input" id="epTgl" required readonly autocomplete="off">
            </div>
          </div>
          <div class="form-group col-4 col-md-4 mb-0">
            <label class="field-label" for="epJam">Jam</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white"><i class="fas fa-clock text-primary"></i></span>
              </div>
              <input type="time" name="jam" class="form-control presensi-input" id="epJam" required>
            </div>
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="epNipd">Nama Peserta</label>
          <select class="form-control presensi-input" id="epNipd" name="nama" required>
            <?php
            $data = $this->db->query("SELECT Nama,Nipd FROM peserta WHERE Status=1")->result();
            foreach ($data as $row) { ?>
              <option value="<?= $row->Nipd ?>"><?= $row->Nama ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="epIns">Instruktur</label>
          <select class="form-control presensi-input" id="epIns" name="Instruktur" required>
            <?php
            $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
            foreach ($data as $row) { ?>
              <option value="<?= $row->Id ?>"><?= $row->NamaInstruktur ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group mb-1">
          <label class="field-label" for="epMateri">Materi</label>
          <input type="text" class="form-control presensi-input" id="epMateri" name="materi" maxlength="50" required>
        </div>
      </form>
      <div class="modal-footer presensi-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formEditPresensi" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<style>
.app-modal .modal-content {
  border: 0;
  border-radius: .75rem;
  max-height: calc(100vh - 3.5rem);
  box-shadow: 0 20px 60px rgba(15, 23, 42, .22);
}
@supports (height: 100dvh) {
  .app-modal .modal-content { max-height: calc(100dvh - 3.5rem); }
}
.app-modal .modal-header,
.app-modal .modal-footer { flex-shrink: 0; }
.app-modal .modal-body {
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
#instrukturPresensi { font-size: 16px; }

/* Input & select bergaya outlined, sudut lembut */
.app-modal .form-control { border-radius: .6rem; }
.app-modal .input-group-text {
  border-radius: .6rem 0 0 .6rem;
  border-right: 0;
}
.app-modal .input-group > .form-control {
  border-radius: 0 .6rem .6rem 0;
}
.app-modal .input-group > .form-control.is-invalid,
.app-modal .input-group > .form-control:focus { z-index: auto; }
.app-modal .form-control:focus {
  border-color: #93b4f5;
  box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .15);
}
.badge-presensi { background: rgba(37, 99, 235, .1); color: #2563eb; font-weight: 600; }
.field-error { font-size: .8rem; color: #dc3545; margin-top: .35rem; }

/* Stepper sesi gaya Material, ringkas */
.sesi-stepper {
  display: inline-flex; align-items: center;
  padding: 3px;
  background: #fff;
  border: 1.5px solid #d7dce3;
  border-radius: 9999px;
  transition: border-color .15s, box-shadow .15s;
}
.sesi-stepper:focus-within { border-color: #2563eb; box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .12); }
.step-btn {
  width: 36px; height: 36px; padding: 0;
  border: none; border-radius: 50%;
  background: transparent; color: #2563eb;
  font-size: .72rem;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; flex-shrink: 0;
  transition: background-color .15s, transform .12s;
}
.step-btn:hover { background: rgba(37, 99, 235, .08); }
.step-btn:not(:disabled):active { background: rgba(37, 99, 235, .16); transform: scale(.9); }
.step-btn:focus-visible { outline: 2px solid #93b4f5; outline-offset: 2px; }
.step-btn:disabled { color: #c3c9d4; cursor: not-allowed; }
.step-value {
  width: 36px; padding: 0;
  border: none; background: transparent;
  font-size: 16px; font-weight: 700; color: #111827;
  text-align: center;
}
.step-value:focus { outline: none; }
.materi-row { display: flex; align-items: center; gap: .55rem; margin-bottom: .55rem; }
.materi-row:last-child { margin-bottom: 0; }
.materi-jam { flex: 0 0 100px; padding-left: .4rem; padding-right: .4rem; text-align: center; }
.materi-num {
  width: 26px; height: 26px; border-radius: 50%;
  background: rgba(37, 99, 235, .08); color: #2563eb;
  font-size: .78rem; font-weight: 700;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.presensi-footer { border-top: 1px solid #eef0f4; }
.presensi-footer .presensi-btn {
  min-height: 48px;
  border-radius: .55rem;
  font-weight: 600;
}

/* Select2 di dalam modal */
.app-modal .select2-container--default .select2-selection--multiple {
  min-height: 44px;
  padding: .4rem .5rem;
  border-color: #ced4da;
  border-radius: .6rem;
  font-size: 15px;
}
.app-modal .select2-container--default.select2-container--focus .select2-selection--multiple {
  border-color: #93b4f5;
  box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .18);
}
.app-modal .select2-selection__choice {
  margin: 4px 4px 0 0;
  padding: 4px 10px;
  font-size: .85rem;
  background: #eef2f7;
  border-color: #eef2f7;
  color: #374151;
}
.app-modal .select2-selection__choice__remove { margin-right: 6px; color: #6b7280; }
.app-modal .select2-search__field { font-size: 16px; }

/* Tampilan aplikasi mobile di layar kecil */
@media (max-width: 575.98px) {
  .app-modal .modal-dialog {
    margin: 0; max-width: 100%;
    height: 100%;
    overscroll-behavior: contain;
  }
  /* Kunci tinggi ke viewport terkecil agar layout stabil saat URL bar iOS turun/naik */
  @supports (height: 100svh) {
    .app-modal .modal-dialog { height: 100svh; }
  }

  /* Sheet setinggi layar, sudut atas membulat seperti aplikasi */
  .app-modal .modal-content {
    height: 100%;
    max-height: none;
    border-radius: 1.25rem 1.25rem 0 0;
    box-shadow: 0 -8px 40px rgba(15, 23, 42, .18);
    overscroll-behavior: contain;
  }

  /* App bar: tombol kembali di kiri, judul mengikuti */
  .app-modal .modal-header {
    justify-content: flex-start;
    padding: .85rem 1rem .85rem .5rem;
    border-bottom: 1px solid #eef0f4;
  }
  /* Reset margin auto dari BS4 (.modal-header .close) agar panah tidak terdorong ke tengah */
  .app-modal .presensi-close {
    order: -1;
    margin: 0 .35rem 0 0;
    color: #2563eb;
    flex-shrink: 0;
  }
  .app-modal .presensi-close:hover { background: rgba(37, 99, 235, .08); color: #2563eb; }
  .app-modal .presensi-title-wrap { margin-left: .15rem !important; }

  /* Bottom bar aksi ala aplikasi: satu CTA utama penuh + batal tonal */
  .app-modal .modal-footer {
    flex-direction: column-reverse;
    align-items: stretch;
    padding: .65rem 1rem calc(.75rem + env(safe-area-inset-bottom, 0px));
  }
  .app-modal .modal-footer .presensi-btn {
    width: 100%;
    margin-left: 0 !important;
    border-radius: 9999px;
  }
  .app-modal .modal-footer .btn-secondary {
    min-height: 42px;
    background: rgba(37, 99, 235, .07);
    border-color: transparent;
    color: #2563eb;
  }
  .app-modal .modal-footer .btn-secondary:hover,
  .app-modal .modal-footer .btn-secondary:focus {
    background: rgba(37, 99, 235, .14);
    border-color: transparent;
    color: #1d4ed8;
  }
}
/* Slide-up halus saat sheet muncul */
@media (max-width: 575.98px) and (prefers-reduced-motion: no-preference) {
  .app-modal.fade .modal-dialog { transform: translateY(28px); }
  .app-modal.show .modal-dialog { transform: none; }
}
@media (min-width: 576px) {
  .app-modal .modal-dialog { max-width: 540px; }
}
@media (prefers-reduced-motion: reduce) {
  .presensi-close, .step-btn { transition: none; }
  .step-btn:not(:disabled):active { transform: none; }
}
/* Kunci scroll halaman belakang saat modal terbuka (cegah lompatan scroll iOS) */
html.app-modal-open, html.app-modal-open body {
  overflow: hidden !important;
  overscroll-behavior: none;
}

/* ====== Daftar presensi mobile ====== */
@media (max-width: 767.98px) {
  /* === Toolbar === */
  #tabelpresensi_wrapper > .row:first-child {
    padding: 0 .75rem .5rem;
    gap: .45rem;
  }
  #tabelpresensi_wrapper div.dataTables_filter {
    padding: 0;
    flex: 1 1 100%;
    margin-bottom: 0;
  }
  #tabelpresensi_wrapper div.dataTables_filter label {
    margin-bottom: 0;
    width: 100%;
  }
  #tabelpresensi_wrapper div.dataTables_filter input {
    width: 100% !important;
    height: 44px;
    font-size: 16px;
    background: #eef0f4;
    border: 1px solid transparent;
    border-radius: 13px;
    padding: 0 1rem;
  }
  #tabelpresensi_wrapper div.dataTables_filter input:focus {
    background: #fff;
    border-color: #93b4f5;
    box-shadow: 0 0 0 .25rem rgba(37,99,235,.12);
  }
  #tabelpresensi_wrapper .dt-buttons {
    display: flex !important;
    gap: .4rem;
    flex: 1 1 100%;
  }
  #tabelpresensi_wrapper .dt-buttons .btn {
    flex: 1 1 0;
    font-size: .8rem;
    padding: .45rem .5rem;
    border-radius: 10px;
    font-weight: 600;
  }
  #tabelpresensi_wrapper .dataTables_length { display: none !important; }

  #tabelpresensi_wrapper { background: transparent !important; border: 0 !important; box-shadow: none !important; }

  /* === Override base: table & tbody === */
  #tabelpresensi,
  #tabelpresensi.dataTable { width: 100% !important; background: transparent !important; }

  /* === Override base: baris kartu === */
  table.dataTable#tabelpresensi tbody tr {
    display: flex !important;
    flex-wrap: wrap;
    align-items: stretch;
    background: #fff !important;
    border: 0 !important;
    border-radius: 14px !important;
    padding: .7rem .85rem .65rem !important;
    margin: 0 .75rem .55rem !important;
    box-shadow: 0 1px 3px rgba(17,24,39,.07), 0 0 0 .5px rgba(17,24,39,.04) !important;
  }
  table.dataTable#tabelpresensi tbody tr:nth-child(even) { background: #fff !important; }

  /* === Override base: cell layout === */
  table.dataTable#tabelpresensi tbody td {
    display: block !important;
    padding: 0 !important;
    border: none !important;
    border-bottom: 0 !important;
    min-height: auto !important;
    gap: 0;
    justify-content: flex-start !important;
    align-items: stretch !important;
    background: transparent !important;
    white-space: normal !important;
  }
  /* Sembunyiin pseudo label bawaan ruang-admin */
  table.dataTable#tabelpresensi tbody td:before { display: none !important; }
  table.dataTable#tabelpresensi tbody td:last-child { border-bottom: 0 !important; }

  /* === Tanggal: baris pertama, kiri atas === */
  table.dataTable#tabelpresensi tbody td:nth-child(1) {
    order: 0;
    flex: 1 1 0%;
    min-width: 0;
    font-size: .73rem;
    line-height: 1.3;
    font-weight: 600;
    color: #64748b;
  }
  table.dataTable#tabelpresensi tbody td:nth-child(1) .text-info {
    display: block;
    margin-top: .05rem;
    color: #94a3b8 !important;
    font-weight: 500;
  }

  /* === Aksi: ikon kecil di pojok kanan, sebaris tanggal === */
  table.dataTable#tabelpresensi tbody td:nth-child(6) {
    order: 1;
    flex: 0 0 auto;
    align-self: flex-start;
  }
  /* Override base action-group: jadi icon-only */
  table.dataTable#tabelpresensi td .action-group {
    width: auto !important;
    display: flex !important;
    gap: .3rem !important;
  }
  table.dataTable#tabelpresensi td .action-group .btn {
    width: 30px !important;
    height: 30px !important;
    min-height: 0 !important;
    padding: 0 !important;
    border-radius: 8px !important;
    border: none !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: .72rem !important;
  }
  table.dataTable#tabelpresensi td .action-group .btn-text { display: none !important; }
  table.dataTable#tabelpresensi td .action-group .btn i { display: inline-block !important; }

  /* === Nama: judul kartu === */
  table.dataTable#tabelpresensi tbody td:nth-child(2) {
    order: 2;
    flex: 0 0 100%;
    margin: .12rem 0 0;
    overflow: hidden;
  }
  table.dataTable#tabelpresensi tbody td:nth-child(2) .table-link {
    display: block;
    font-size: .95rem;
    font-weight: 600;
    color: #111827;
    text-decoration: none;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  table.dataTable#tabelpresensi tbody td:nth-child(2) .table-link::after {
    content: "\203A";
    float: right;
    font-size: 1.2rem;
    font-weight: 400;
    color: #c4cad3;
    line-height: 1;
  }

  /* === Info baris: Jenis Kursus (kiri) — Materi (kanan) === */
  table.dataTable#tabelpresensi tbody td:nth-child(3) {
    order: 3;
    flex: 1 1 auto;
    min-width: 0;
    max-width: 55%;
    font-size: .75rem;
    font-weight: 600;
    color: #374151;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  table.dataTable#tabelpresensi tbody td:nth-child(5) {
    order: 4;
    flex: 0 1 auto;
    min-width: 0;
    max-width: 42%;
    margin-left: auto;
    font-size: .75rem;
    color: #6b7280;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  table.dataTable#tabelpresensi tbody td:nth-child(5)::before {
    content: "\2014\00a0" !important;
    display: inline !important;
    color: #cbd2dc;
    font-weight: 400;
  }

  /* === Instruktur: baris bawah, full width === */
  table.dataTable#tabelpresensi tbody td:nth-child(4) {
    order: 5;
    flex: 0 0 100%;
    margin-top: .25rem;
    padding-top: .3rem !important;
    border-top: 1px solid #f1f5f9 !important;
    font-size: .72rem;
    color: #6b7280;
  }
  table.dataTable#tabelpresensi tbody td:nth-child(4):before { display: none !important; }
  table.dataTable#tabelpresensi tbody td:nth-child(4) .ins-rest { display: none; }
  table.dataTable#tabelpresensi tbody td:nth-child(4) a.table-link {
    font-size: .72rem;
    font-weight: 600;
    color: #334155 !important;
    text-decoration: none;
  }

  /* === Info & paginasi === */
  #tabelpresensi_info {
    padding: .1rem .5rem 0;
    font-size: .72rem;
    color: #8a919c;
    text-align: center;
  }
  #tabelpresensi_paginate {
    display: flex;
    justify-content: center;
    padding: .4rem .5rem calc(.6rem + env(safe-area-inset-bottom, 0px));
    overflow-x: auto;
    scrollbar-width: none;
  }
  #tabelpresensi_paginate::-webkit-scrollbar { display: none; }
  #tabelpresensi_paginate .pagination {
    display: inline-flex;
    flex-wrap: nowrap;
    align-items: center;
    gap: .12rem;
    margin: 0;
    background: #fff;
    border-radius: 9999px;
    padding: .2rem .25rem;
    box-shadow: 0 1px 3px rgba(17,24,39,.07);
  }
  #tabelpresensi_paginate .page-link {
    border: 0;
    background: transparent;
    border-radius: 9999px;
    min-width: 32px;
    height: 32px;
    padding: 0 .5rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #475569;
    font-size: .82rem;
    font-weight: 600;
  }
  #tabelpresensi_paginate .page-item.disabled .page-link { color: #c3cad4; }
  #tabelpresensi_paginate .page-item:not(.disabled):not(.active) .page-link:hover {
    background: rgba(37,99,235,.08);
    color: #2563eb;
  }
  #tabelpresensi_paginate .page-item.active .page-link {
    background: #2563eb;
    color: #fff;
    box-shadow: 0 1px 3px rgba(37,99,235,.35);
  }
  #tabelpresensi_paginate .previous a,
  #tabelpresensi_paginate .next a {
    width: 32px;
    min-width: 32px;
    padding: 0;
    font-size: 0;
  }
  #tabelpresensi_paginate .previous a::before,
  #tabelpresensi_paginate .next a::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: .75rem;
    line-height: 1;
  }
  #tabelpresensi_paginate .previous a::before { content: "\f053"; }
  #tabelpresensi_paginate .next a::before { content: "\f054"; }
}
</style>
<script>
if (window.jQuery) {
  window.jQuery(document)
    .on('show.bs.modal', '.app-modal', function () {
      document.documentElement.classList.add('app-modal-open');
    })
    .on('hidden.bs.modal', '.app-modal', function () {
      document.documentElement.classList.remove('app-modal-open');
    });
}
</script>
<script>
(function () {
  var jml = document.getElementById('jumlah'),
      minusBtn = document.getElementById('minusBtn'),
      plusBtn = document.getElementById('plusBtn');

  function nowHM() {
    var d = new Date();
    return ('0' + d.getHours()).slice(-2) + ':' + ('0' + d.getMinutes()).slice(-2);
  }

  function addMinutes(hhmm, m) {
    var p = (hhmm || '00:00').split(':');
    var t = ((parseInt(p[0], 10) || 0) * 60 + (parseInt(p[1], 10) || 0) + m) % 1440;
    if (t < 0) t += 1440;
    return ('0' + Math.floor(t / 60)).slice(-2) + ':' + ('0' + (t % 60)).slice(-2);
  }

  function updateMateri(n) {
    var c = document.getElementById('materiContainer');
    var prevJam = [], prevMateri = [];
    c.querySelectorAll('input[name="waktu[]"]').forEach(function (inp) { prevJam.push(inp.value); });
    c.querySelectorAll('input[name="materi[]"]').forEach(function (inp) { prevMateri.push(inp.value); });
    c.innerHTML = '';
    var last = prevJam.length ? prevJam[prevJam.length - 1] : nowHM();
    for (var i = 1; i <= n; i++) {
      var row = document.createElement('div');
      row.className = 'materi-row';
      var num = document.createElement('span');
      num.className = 'materi-num';
      num.textContent = i;

      // Jam sesi: nilai lama dipertahankan; sesi baru otomatis +45 menit
      var jam = document.createElement('input');
      jam.type = 'time';
      jam.className = 'form-control presensi-input materi-jam';
      jam.name = 'waktu[]';
      jam.setAttribute('aria-label', 'Jam pertemuan ' + i);
      jam.required = true;
      if (!prevJam[i - 1]) prevJam[i - 1] = addMinutes(last, 90);
      last = prevJam[i - 1];
      jam.value = last;

      var inp = document.createElement('input');
      inp.type = 'text';
      inp.className = 'form-control presensi-input';
      inp.name = 'materi[]';
      inp.placeholder = 'Materi pertemuan ' + i;
      inp.setAttribute('aria-label', 'Materi pertemuan ' + i);
      inp.required = true;
      inp.value = prevMateri[i - 1] || '';

      row.appendChild(num);
      row.appendChild(jam);
      row.appendChild(inp);
      c.appendChild(row);
    }
  }

  function refreshStepper() {
    var v = parseInt(jml.value, 10) || 1;
    minusBtn.disabled = v <= 1;
    plusBtn.disabled = v >= 10;
  }

  function step(delta) {
    var v = (parseInt(jml.value, 10) || 1) + delta;
    if (v < 1 || v > 10) return;
    jml.value = v;
    updateMateri(v);
    refreshStepper();
  }

  minusBtn.addEventListener('click', function () { step(-1); });
  plusBtn.addEventListener('click', function () { step(1); });
  refreshStepper();

  // Geser semua jam sesi dalam kelipatan 15 menit (0/15/30/45)
  function stepQuarter(hhmm, steps) {
    var p = (hhmm || nowHM()).split(':');
    var total = ((parseInt(p[0], 10) || 0) * 60 + (parseInt(p[1], 10) || 0)) % 1440;
    var snapped = Math.round(total / 15) * 15 + steps * 15;
    snapped = ((snapped % 1440) + 1440) % 1440;
    return ('0' + Math.floor(snapped / 60)).slice(-2) + ':' + ('0' + (snapped % 60)).slice(-2);
  }
  function shiftJams(steps) {
    document.querySelectorAll('#materiContainer input[name="waktu[]"]').forEach(function (inp) {
      inp.value = stepQuarter(inp.value || nowHM(), steps);
    });
  }
  var jamMinBtn = document.getElementById('jamMinBtn'),
      jamPlusBtn = document.getElementById('jamPlusBtn');
  if (jamMinBtn && jamPlusBtn) {
    jamMinBtn.addEventListener('click', function () { shiftJams(-1); });
    jamPlusBtn.addEventListener('click', function () { shiftJams(1); });
  }

  var kalIcon = document.querySelector('#simple-date1 .input-group-text');
  if (kalIcon) {
    kalIcon.addEventListener('click', function () {
      document.getElementById('simpleDataInput').focus();
    });
  }

  function hitungTerpilih() {
    var sel = document.getElementById('nama'), n = 0;
    for (var i = 0; i < sel.options.length; i++) {
      if (sel.options[i].selected) n++;
    }
    return n;
  }

  function bersihkanError() {
    document.getElementById('pesertaError').classList.add('d-none');
    var sc = document.querySelector('.app-modal .select2-selection--multiple');
    if (sc) sc.style.borderColor = '';
  }

  function syncCount() {
    var n = hitungTerpilih(),
        b = document.getElementById('pesertaCount');
    b.textContent = n + ' dipilih';
    b.classList.toggle('d-none', n === 0);
    if (n > 0) bersihkanError();
  }

  if (window.jQuery) {
    window.jQuery('#nama').on('change', syncCount);
  } else {
    document.getElementById('nama').addEventListener('change', syncCount);
  }

  document.getElementById('formPresensi').addEventListener('submit', function (e) {
    if (hitungTerpilih() === 0) {
      e.preventDefault();
      document.getElementById('pesertaError').classList.remove('d-none');
      var sc = document.querySelector('.app-modal .select2-selection--multiple');
      if (sc) sc.style.borderColor = '#dc3545';
    }
  });
})();
</script>

<script>
$(document).ready(function () {
  // Datepicker tanggal hadir
  $('#ep-date-tgl .input-group.date').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
    todayBtn: 'linked'
  });
  var epIcon = document.querySelector('#ep-date-tgl .input-group-text');
  if (epIcon) {
    epIcon.addEventListener('click', function () {
      document.getElementById('epTgl').focus();
    });
  }

  // Isi modal ubah dari data-* tombol edit yang diklik
  $('#editPresensi').on('show.bs.modal', function (e) {
    var b = $(e.relatedTarget);
    if (!b || !b.length) return;
    var tgl = String(b.data('tgl') || '');
    var m = tgl.match(/^(\d{4}-\d{2}-\d{2})(?:\s+(.+))?$/);
    $('#epTgl').val(m ? m[1] : tgl);
    var jam = (m && m[2]) ? m[2].replace(/:\d{2}$/, '') : '';
    $('#epJam').val(jam);
    $('#epId').val(b.data('id'));
    $('#epJks').val(b.data('jks'));
    var nipd = String(b.data('nipd') || '');
    var $sel = $('#epNipd');
    if (nipd && $sel.find('option[value="' + nipd + '"]').length === 0) {
      $('<option>').val(nipd).text(b.data('nama') || nipd).appendTo($sel);
    }
    $sel.val(nipd);
    $('#epIns').val(String(b.data('ins') || ''));
    $('#epMateri').val(b.data('materi'));
  });

  // Gabungkan tanggal + jam saat submit
  $('#formEditPresensi').on('submit', function () {
    var t = $('#epJam').val();
    if (t) {
      $('#epTgl').val($('#epTgl').val() + ' ' + t + ':00');
    }
  });
});
</script>
