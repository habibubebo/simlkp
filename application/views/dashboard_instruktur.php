<style>
.modern-head h1{letter-spacing:-.02em}
.modern-stat .stat-icon{width:2.6rem;height:2.6rem;border-radius:.65rem;display:flex;align-items:center;justify-content:center;font-size:1rem}
.modern-stat.stat-ins .stat-icon{background:rgba(37,99,235,.1);color:#2563eb}
.modern-stat.stat-rombel .stat-icon{background:rgba(245,158,11,.14);color:#d97706}
.modern-stat.stat-peserta .stat-icon{background:rgba(16,185,129,.12);color:#059669}
.modern-stat.stat-lulus .stat-icon{background:rgba(139,92,246,.12);color:#7c3aed}
.stat-pres .stat-icon{background:rgba(37,99,235,.1);color:#2563eb}
.stat-hari .stat-icon{background:rgba(245,158,11,.14);color:#d97706}
.stat-bulan .stat-icon{background:rgba(16,185,129,.12);color:#059669}
.stat-dihadiri .stat-icon{background:rgba(139,92,246,.12);color:#7c3aed}
.modern-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04);background:#fff;min-width:0;max-width:100%;overflow:hidden}
.modern-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.info-card{border:1px solid #bfdbfe;background:#eff6ff;border-radius:.85rem}
.info-card .info-icon{width:40px;height:40px;border-radius:.7rem;background:#2563eb;color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 4px 12px rgba(37,99,235,.2)}
.insight-icon{width:32px;height:32px;border-radius:.6rem;display:flex;align-items:center;justify-content:center;font-size:.8rem;flex-shrink:0}
.masonry{display:grid;grid-template-columns:1fr;gap:1.5rem;align-items:start;min-width:0;max-width:100%}
@media(min-width:992px){.masonry{grid-template-columns:1fr 1fr}}
@media(min-width:992px){.masonry.is-packed{display:block}.masonry.is-packed>.masonry-item{width:calc(50% - .75rem)}}
.masonry-item{margin-bottom:0;min-width:0;max-width:100%;overflow:hidden}
.masonry.is-packed>.masonry-item{position:absolute;margin-bottom:0}
.card-body{min-width:0;max-width:100%}
.tile-btn .fa-chevron-down{transition:transform .2s;margin-left:.3rem}
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}}
.streak-chip{width:28px;height:28px;border-radius:.5rem;background:linear-gradient(135deg,#fbbf24,#f97316 55%,#ef4444);color:#fff;border:0;box-shadow:0 4px 10px rgba(249,115,22,.25)}
.streak-num{background:linear-gradient(180deg,#f59e0b,#ea580c 60%,#dc2626);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ea580c}
.streak-flame{color:#f97316;filter:drop-shadow(0 1px 3px rgba(249,115,22,.45))}
.streak-flame-top{animation:streakFlicker 1.4s ease-in-out infinite;transform-origin:50% 80%}
@keyframes streakFlicker{0%,100%{transform:scale(1) rotate(-2deg)}30%{transform:scale(1.12) rotate(2deg)}55%{transform:scale(.94) rotate(-1deg)}75%{transform:scale(1.06) rotate(1deg)}}
@media(prefers-reduced-motion:reduce){.streak-flame-top{animation:none}}
.streak-copy{width:28px;height:28px;border-radius:.5rem;border:1px solid #eef0f4;background:#fff;color:#94a3b8;display:inline-flex;align-items:center;justify-content:center;padding:0;box-shadow:none;transition:color .15s,border-color .15s,background .15s;flex-shrink:0}
.streak-copy:hover{color:#ea580c;border-color:#fed7aa;background:#fff7ed}
.streak-copy.done{color:#059669;border-color:#a7f3d0;background:#ecfdf5}
.streak-copy.loading i{opacity:.4}
.bulan-nav{width:28px;height:28px;border-radius:9999px;display:flex;align-items:center;justify-content:center;color:#475569;font-size:.65rem;text-decoration:none;background:transparent}
.bulan-nav:hover{background:#f8fafc;color:#1e293b}
.bulan-nav-off{color:#cbd5e1;pointer-events:none}
</style>

<?php
$bulanIndo = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
$mapHari = ['Monday'=>'Senin','Tuesday'=>'Selasa','Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu','Sunday'=>'Minggu'];
function __parseBday($str){
  $s = trim((string)$str);
  if ($s === '' || $s === '-') return 0;
  $ts = strtotime($s);
  if ($ts) return $ts;
  static $bn = null;
  if ($bn === null) {
    $blnNama = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
    $bn = [];
    foreach ($blnNama as $n => $nm) { $bn[strtolower($nm)] = $n; $bn[strtolower(substr($nm,0,3))] = $n; }
  }
  if (preg_match('/(\d{1,2})\s*[\s\-\/\.]+\s*([a-zA-Z]+)\s*[\s\-\/\.]+\s*(\d{2,4})/', $s, $m)) {
    $mn = $bn[strtolower($m[2])] ?? 0;
    if ($mn) { $yy = (int)$m[3]; if ($yy < 100) $yy += ($yy >= 70 ? 1900 : 2000); return mktime(0,0,0,$mn,(int)$m[1],$yy); }
  }
  if (preg_match('/(\d{1,2})\s*[\s\-\/\.]+\s*(\d{1,2})\s*[\s\-\/\.]+\s*(\d{2,4})/', $s, $m)) {
    $a = (int)$m[1]; $b = (int)$m[2]; $yy = (int)$m[3]; if ($yy < 100) $yy += ($yy >= 70 ? 1900 : 2000);
    if (checkdate($b,$a,$yy)) return mktime(0,0,0,$b,$a,$yy);
    if (checkdate($a,$b,$yy)) return mktime(0,0,0,$a,$b,$yy);
  }
  return 0;
}
$ulangHariIni = ['Pegawai'=>[],'Instruktur'=>[],'Siswa'=>[]];
$__md = date('m-d');
foreach ($this->db->query("SELECT NamaPegawai AS n, TanggalLahir AS t FROM pegawai")->result() as $__r) { $__ts = __parseBday($__r->t); if ($__ts && date('m-d',$__ts) === $__md) $ulangHariIni['Pegawai'][] = $__r->n; }
foreach ($this->db->query("SELECT NamaInstruktur AS n, Tanggallahir AS t FROM instruktur")->result() as $__r) { $__ts = __parseBday($__r->t); if ($__ts && date('m-d',$__ts) === $__md) $ulangHariIni['Instruktur'][] = $__r->n; }
foreach ($this->db->query("SELECT Nama AS n, Ttl AS t FROM peserta")->result() as $__r) { $__ts = __parseBday($__r->t); if ($__ts && date('m-d',$__ts) === $__md) $ulangHariIni['Siswa'][] = $__r->n; }
$__bdayTotal = 0; foreach ($ulangHariIni as $__v) $__bdayTotal += count($__v);
?>

<div class="modern-head d-none d-md-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Dashboard Instruktur</h1>
    <p class="text-muted small mb-0">Ringkasan aktivitas <?= html_escape($nama_instruktur) ?></p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url("pages/dashboard_instruktur") ?>" style="color:#94a3b8;text-decoration:none">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Dashboard</li>
  </ol>
</div>

<div class="d-md-none mt-3 mb-3 app-page-head">
  <h1 style="font-size:1.15rem;font-weight:800;color:#1e293b;letter-spacing:-.01em;margin:0">Dashboard Instruktur</h1>
  <div class="small text-muted" style="font-size:.72rem"><?= html_escape($nama_instruktur) ?></div>
</div>

<a href="<?= base_url("pages/presensi") ?>" class="text-decoration-none d-block mb-3">
  <div class="info-card d-flex align-items-center p-3" style="gap:.9rem">
    <div class="info-icon"><i class="fas fa-clipboard-check" style="font-size:.95rem"></i></div>
    <div style="flex:1;min-width:0">
      <div class="small font-weight-bold" style="color:#1e3a8a;font-size:.78rem;letter-spacing:.02em">Presensi Hari Ini</div>
      <div class="small" style="color:#1e40af;line-height:1.4;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
        <?php
        echo "<b style=\"color:#1e293b\">$totalPeserta</b> Peserta &nbsp;·&nbsp; ";
        echo "<b style=\"color:#1e293b\">$jmlPegawai</b> pegawai" . ($jmlPegawai > 0 ? " ($pegawaiNames)" : "");
        ?>
      </div>
    </div>
    <span class="d-none d-sm-inline-flex align-items-center justify-content-center" style="width:32px;height:32px;border-radius:9999px;background:#fff;border:1px solid #bfdbfe;color:#2563eb;flex-shrink:0"><i class="fas fa-chevron-right" style="font-size:.65rem"></i></span>
  </div>
</a>

<div class="row mb-2">
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card modern-card modern-stat stat-pres h-100">
      <div class="card-body py-3 d-flex align-items-center" style="gap:.85rem">
        <div class="stat-icon"><i class="fas fa-check-double"></i></div>
        <div>
          <div class="text-muted" style="font-size:.6rem;letter-spacing:.06em;text-transform:uppercase;font-weight:800">Total Presensi</div>
          <div class="h4 mb-0" style="font-weight:800;color:#1e293b"><?= number_format($totalPresensi) ?></div>
          <div class="small text-muted" style="font-size:.68rem">Milik instruktur</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card modern-card modern-stat stat-hari h-100">
      <div class="card-body py-3 d-flex align-items-center" style="gap:.85rem">
        <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
        <div>
          <div class="text-muted" style="font-size:.6rem;letter-spacing:.06em;text-transform:uppercase;font-weight:800">Hari Ini</div>
          <div class="h4 mb-0" style="font-weight:800;color:#d97706"><?= number_format($presensiHari) ?></div>
          <div class="small text-muted" style="font-size:.68rem">Presensi hari ini</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card modern-card modern-stat stat-bulan h-100">
      <div class="card-body py-3 d-flex align-items-center" style="gap:.85rem">
        <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
        <div>
          <div class="text-muted" style="font-size:.6rem;letter-spacing:.06em;text-transform:uppercase;font-weight:800">Bulan Ini</div>
          <div class="h4 mb-0" style="font-weight:800;color:#059669"><?= number_format($presensiBulan) ?></div>
          <div class="small text-muted" style="font-size:.68rem">Presensi bulan berjalan</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="card modern-card modern-stat stat-dihadiri h-100">
      <div class="card-body py-3 d-flex align-items-center" style="gap:.85rem">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div>
          <div class="text-muted" style="font-size:.6rem;letter-spacing:.06em;text-transform:uppercase;font-weight:800">Peserta Dihadiri</div>
          <div class="h4 mb-0" style="font-weight:800;color:#7c3aed"><?= number_format($totalPeserta) ?></div>
          <div class="small text-muted" style="font-size:.68rem">Peserta unik dihadiri</div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if ($__bdayTotal > 0): $__bdayParts = []; foreach ($ulangHariIni as $__bt => $__bn) { if (!empty($__bn)) $__bdayParts[] = '<span style="font-weight:700;color:#9a3412">'.$__bt.':</span> '.html_escape(implode(', ', $__bn)); } ?>
<div class="d-flex align-items-center p-3 mb-3" style="gap:.85rem;background:linear-gradient(135deg,#fff1f2,#fef3c7);border:1px solid #fecdd3;border-radius:.85rem">
  <span class="d-flex align-items-center justify-content-center flex-shrink-0" style="width:40px;height:40px;border-radius:.7rem;background:linear-gradient(135deg,#f472b6,#fb923c);color:#fff;box-shadow:0 6px 16px rgba(244,114,182,.35)"><i class="fas fa-birthday-cake" style="font-size:.9rem"></i></span>
  <div style="flex:1;min-width:0">
    <div class="small font-weight-bold" style="color:#be123c;font-size:.78rem;letter-spacing:.02em">Selamat ulang tahun hari ini</div>
    <div class="small" style="color:#7c2d12;line-height:1.5;padding-top:.15rem"><?= implode(' &nbsp;·&nbsp; ', $__bdayParts) ?></div>
  </div>
</div>
<?php endif; ?>

<div class="d-flex align-items-center justify-content-between mb-3" style="gap:.75rem">
  <div class="small text-muted" style="font-size:.72rem">Periode kartu bulanan</div>
  <div class="d-inline-flex align-items-center" style="background:#fff;border:1px solid #eef0f4;border-radius:9999px;box-shadow:0 1px 3px rgba(15,23,42,.04);padding:3px;gap:2px">
    <?php if ($bulanPrev): ?>
      <a href="<?= base_url('pages/dashboard_instruktur') ?>?bulan=<?= $bulanPrev ?>" class="bulan-nav" aria-label="Bulan sebelumnya"><i class="fas fa-chevron-left"></i></a>
    <?php else: ?>
      <span class="bulan-nav bulan-nav-off" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
    <?php endif; ?>
    <span style="min-width:110px;text-align:center;font-size:.78rem;font-weight:800;color:#1e293b"><?= html_escape($bulanLabel) ?></span>
    <?php if ($bulanNext): ?>
      <a href="<?= base_url('pages/dashboard_instruktur') ?>?bulan=<?= $bulanNext ?>" class="bulan-nav" aria-label="Bulan berikutnya"><i class="fas fa-chevron-right"></i></a>
    <?php else: ?>
      <span class="bulan-nav bulan-nav-off" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
    <?php endif; ?>
  </div>
</div>

<div class="masonry">
  <div class="masonry-item">
    <div class="card modern-card">
      <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center" style="gap:.5rem">
          <span class="streak-chip d-flex align-items-center justify-content-center"><i class="fas fa-fire-alt" style="font-size:.78rem"></i></span>
          <div>
            <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Streak Peserta</h6>
            <div class="small text-muted d-none d-sm-block" style="font-size:.68rem;margin-top:.1rem">Hadir minimal 3 hari berturut-turut</div>
          </div>
        </div>
        <span class="badge" style="background:#fff7ed;color:#9a3412;border:1px solid #fed7aa;font-size:.68rem;border-radius:9999px;padding:.25rem .5rem"><i class="fas fa-fire mr-1" style="font-size:.6rem;color:#f97316"></i><?= count($streakPeserta ?? []) ?> aktif</span>
      </div>
      <div class="card-body" style="padding:1.1rem;min-width:0;max-width:100%;overflow:hidden">
        <?php if (empty($streakPeserta)): ?>
          <div class="text-center py-3">
            <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:44px;height:44px;border-radius:.7rem;background:#fff7ed;border:1px solid #fed7aa;color:#fdba74"><i class="fas fa-fire"></i></div>
            <div class="small font-weight-bold" style="color:#334155">Belum ada streak aktif</div>
            <div class="small text-muted">Peserta muncul di sini setelah hadir 3 hari berturut-turut</div>
          </div>
        <?php else: $sRank = 1; foreach (array_slice($streakPeserta, 0, 5) as $sk) {
          $initialsS = strtoupper(substr(trim($sk->Nama), 0, 1) . (strpos(trim($sk->Nama), ' ') ? substr(trim($sk->Nama), strpos(trim($sk->Nama), ' ') + 1, 1) : ''));
          $flameSize = min(1.15, 0.8 + $sk->streak * 0.03);
        ?>
          <div class="d-flex align-items-center py-2" style="gap:.7rem;min-width:0;max-width:100%;overflow:hidden;<?= $sRank > 1 ? 'border-top:1px solid #f8fafc' : '' ?>">
            <span class="d-flex align-items-center justify-content-center flex-shrink-0" style="width:28px;height:28px;border-radius:9999px;background:<?= $sRank == 1 ? '#f97316' : ($sRank == 2 ? '#fb923c' : ($sRank == 3 ? '#fdba74' : '#e2e8f0')) ?>;color:<?= $sRank <= 3 ? '#fff' : '#475569' ?>;font-size:.7rem;font-weight:800"><?= $sRank ?></span>
            <div class="d-flex align-items-center" style="gap:.6rem;flex:1;min-width:0;max-width:100%;overflow:hidden">
              <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width:32px;height:32px;border-radius:.6rem;background:rgba(249,115,22,.1);color:#ea580c;font-weight:800;font-size:.68rem"><?= html_escape($initialsS) ?></div>
              <div style="flex:1;min-width:0;max-width:100%;overflow:hidden">
                <div class="small font-weight-bold" style="color:#1e293b;font-size:.78rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;overflow-wrap:anywhere;word-break:break-word;max-width:100%;display:block;min-width:0" title="<?= html_escape($sk->Nama) ?>"><?= html_escape($sk->Nama) ?></div>
                <div class="small text-muted" style="font-size:.68rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:100%;display:block;overflow-wrap:anywhere;word-break:break-word;min-width:0"><?= html_escape($sk->Namarombel ?? '-') ?> · <span class="mono" style="font-size:.66rem;white-space:nowrap"><?= html_escape((string)$sk->Nipd) ?></span></div>
              </div>
            </div>
            <div class="d-flex align-items-center flex-shrink-0" style="gap:.4rem">
              <i class="fas fa-fire-alt streak-flame<?= $sRank == 1 ? ' streak-flame-top' : '' ?>" style="font-size:<?= $flameSize ?>rem"></i>
              <span style="line-height:1;white-space:nowrap"><span class="streak-num" style="font-size:1.05rem;font-weight:800"><?= $sk->streak ?></span> <span style="font-size:.62rem;color:#9a3412;font-weight:700">hari</span></span>
              <button type="button" class="btn streak-copy" data-streak-url="<?= base_url('cek/streak?hari=' . (int)$sk->streak . '&nama=') . rawurlencode($sk->Nama) ?>" title="Copy gambar streak <?= html_escape($sk->Nama) ?> ke clipboard" aria-label="Copy gambar streak <?= html_escape($sk->Nama) ?> ke clipboard"><i class="fas fa-copy"></i></button>
            </div>
          </div>
        <?php $sRank++; } ?>
          <?php if (count($streakPeserta) > 5): ?>
            <div class="small text-muted mt-2" style="font-size:.66rem">dan <?= count($streakPeserta) - 5 ?> peserta streak lainnya</div>
          <?php endif; ?>
          <div class="small text-muted mt-3" style="font-size:.66rem"><i class="fas fa-info-circle mr-1" style="color:#94a3b8"></i>Streak dihitung dari kehadiran tanpa jeda sampai hari ini atau kemarin</div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="masonry-item">
    <div class="card modern-card">
      <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center" style="gap:.5rem">
          <span class="d-flex align-items-center justify-content-center" style="width:28px;height:28px;border-radius:.5rem;background:#fffbeb;color:#d97706;border:1px solid #fde68a"><i class="fas fa-calendar-alt" style="font-size:.75rem"></i></span>
          <div>
            <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Hari Favorit <?= $isBulanIni ? 'Bulan Ini' : html_escape($bulanLabel) ?></h6>
            <div class="small text-muted d-none d-sm-block" style="font-size:.68rem;margin-top:.1rem"><?= html_escape($bulanLabel) ?> · presensi</div>
          </div>
        </div>
        <span class="badge" style="background:#2563eb;color:#fff;border:1px solid #2563eb;font-size:.72rem;border-radius:9999px;padding:.3rem .6rem;font-weight:700"><i class="fas fa-star mr-1" style="font-size:.6rem"></i><?= html_escape($hariFav) ?></span>
      </div>
      <div class="card-body" style="padding:1.1rem">
        <?php 
if($hariFavJml==0): ?>
          <div class="text-center py-3">
            <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:44px;height:44px;border-radius:.7rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-calendar-times"></i></div>
            <div class="small font-weight-bold" style="color:#334155"><?= $isBulanIni ? 'Belum ada presensi bulan ini' : 'Tidak ada presensi di ' . html_escape($bulanLabel) ?></div>
            <div class="small text-muted"><?= $isBulanIni ? 'Data akan muncul setelah ada presensi di bulan ' . html_escape($bulanLabel) : 'Coba pilih bulan lain dengan panah di atas' ?></div>
          </div>
        <?php 
else: ?>
          <div class="d-flex align-items-end" style="gap:.6rem;flex-wrap:wrap">
            <div>
              <div style="font-size:1.9rem;font-weight:800;color:#1e293b;line-height:1"><?= html_escape($hariFav) ?></div>
              <div class="small" style="color:#64748b;font-size:.75rem"><b style="color:#2563eb"><?= $hariFavJml ?> sesi</b> terbanyak</div>
            </div>
            <span class="ml-auto small d-inline-flex align-items-center" style="background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe;border-radius:9999px;padding:.2rem .5rem;font-size:.68rem;font-weight:700"><i class="fas fa-fire mr-1" style="color:#f59e0b"></i>Paling aktif</span>
          </div>
          <div class="mt-3" style="display:grid;gap:.45rem">
            <?php 
$orderHari = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']; foreach($orderHari as $en){ $jml=$hariFavMapBulan[$en]??0; $label=$mapHari[$en]; $pct=$maxHariBulan?($jml/$maxHariBulan*100):0; $isFav=($label===$hariFav); ?>
              <div class="d-flex align-items-center" style="gap:.5rem">
                <span class="small font-weight-bold" style="width:52px;flex-shrink:0;color:<?= $isFav?'#2563eb':'#475569' ?>;font-size:.72rem"><?= $label ?></span>
                <div class="flex-fill" style="height:7px;background:#f1f5f9;border-radius:9999px;overflow:hidden"><div style="height:100%;width:<?= $pct ?>%;background:<?= $isFav?'#2563eb':'#cbd5e1' ?>;border-radius:9999px"></div></div>
                <span class="small" style="width:38px;text-align:right;color:#64748b;font-size:.68rem;font-weight:600"><?= $jml ?></span>
              </div>
            <?php 
} ?>
          </div>
          <div class="small text-muted mt-3" style="font-size:.66rem"><i class="fas fa-info-circle mr-1" style="color:#94a3b8"></i><?= html_escape($rangeLabel) ?></div>
        <?php 
endif; ?>
      </div>
    </div>
  </div>

  <div class="masonry-item">
    <div class="card modern-card">
      <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center" style="gap:.5rem">
          <span class="d-flex align-items-center justify-content-center" style="width:28px;height:28px;border-radius:.5rem;background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe"><i class="fas fa-medal" style="font-size:.75rem"></i></span>
          <div>
            <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Peserta Paling Rajin <?= $isBulanIni ? 'Bulan Ini' : html_escape($bulanLabel) ?></h6>
            <div class="small text-muted d-none d-sm-block" style="font-size:.68rem;margin-top:.1rem"><?= html_escape($bulanLabel) ?> · kehadiran terbanyak</div>
          </div>
        </div>
        <span class="badge" style="background:#fffbeb;color:#92400e;border:1px solid #fde68a;font-size:.68rem;border-radius:9999px;padding:.25rem .5rem"><i class="fas fa-trophy mr-1" style="font-size:.6rem"></i>Top 5</span>
      </div>
      <div class="card-body" style="padding:1.1rem">
        <?php 
if(empty($rajinBulan)): ?>
          <div class="text-center py-3">
            <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:44px;height:44px;border-radius:.7rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-user-clock"></i></div>
            <div class="small font-weight-bold" style="color:#334155"><?= $isBulanIni ? 'Belum ada presensi bulan ini' : 'Tidak ada presensi di ' . html_escape($bulanLabel) ?></div>
            <div class="small text-muted"><?= $isBulanIni ? 'Rajin akan muncul setelah ada kehadiran di ' . html_escape($bulanLabel) : 'Coba pilih bulan lain dengan panah di atas' ?></div>
          </div>
        <?php 
else: $rRank=1; foreach($rajinBulan as $rj){
          $pctR = $maxRajin ? ($rj->jml/$maxRajin*100) : 0;
          $initialsR = strtoupper(substr(trim($rj->Nama),0,1) . (strpos(trim($rj->Nama),' ') ? substr(trim($rj->Nama),strpos(trim($rj->Nama),' ')+1,1) : ''));
        ?>
          <div class="d-flex align-items-center py-2" style="gap:.7rem;<?= $rRank>1?'border-top:1px solid #f8fafc':'' ?>">
            <span class="d-flex align-items-center justify-content-center flex-shrink-0" style="width:28px;height:28px;border-radius:9999px;background:<?= $rRank==1?'#2563eb':($rRank==2?'#f59e0b':($rRank==3?'#10b981':'#e2e8f0')) ?>;color:<?= $rRank<=3?'#fff':'#475569' ?>;font-size:.7rem;font-weight:800"><?= $rRank ?></span>
            <div class="d-flex align-items-center" style="gap:.6rem;flex:1;min-width:0">
              <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width:32px;height:32px;border-radius:.6rem;background:rgba(37,99,235,.08);color:#2563eb;font-weight:800;font-size:.68rem"><?= html_escape($initialsR) ?></div>
              <div style="flex:1;min-width:0">
                <div class="small font-weight-bold" style="color:#1e293b;font-size:.78rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= html_escape($rj->Nama) ?></div>
                <div class="small text-muted" style="font-size:.68rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= html_escape($rj->Namarombel) ?> · <span class="mono" style="font-size:.66rem"><?= html_escape($rj->Nipd) ?></span></div>
              </div>
            </div>
            <div style="text-align:right;flex-shrink:0;min-width:64px">
              <div class="small font-weight-bold" style="color:#1e293b;font-size:.82rem"><?= $rj->jml ?> <span class="text-muted" style="font-weight:600;font-size:.65rem">sesi</span></div>
              <div style="height:5px;background:#f1f5f9;border-radius:9999px;overflow:hidden;margin-top:.2rem"><div style="height:100%;width:<?= $pctR ?>%;background:<?= $rRank==1?'#2563eb':($rRank==2?'#f59e0b':'#94a3b8') ?>;border-radius:9999px"></div></div>
            </div>
          </div>
        <?php 
$rRank++; } ?>
          <div class="small text-muted mt-3" style="font-size:.66rem"><i class="fas fa-info-circle mr-1" style="color:#94a3b8"></i>Dihitung dari presensi <?= html_escape($rangeLabel) ?></div>
        <?php 
endif; ?>
      </div>
    </div>
  </div>

  <div class="masonry-item">
    <div class="card modern-card">
      <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center" style="gap:.5rem">
          <span class="d-flex align-items-center justify-content-center" style="width:28px;height:28px;border-radius:.5rem;background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe"><i class="fas fa-chalkboard-teacher" style="font-size:.75rem"></i></span>
          <div>
            <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Instruktur Paling Aktif <?= $isBulanIni ? 'Bulan Ini' : html_escape($bulanLabel) ?></h6>
            <div class="small text-muted d-none d-sm-block" style="font-size:.68rem;margin-top:.1rem"><?= html_escape($bulanLabel) ?> · sesi mengajar terbanyak</div>
          </div>
        </div>
        <span class="badge" style="background:#2563eb;color:#fff;border:1px solid #2563eb;font-size:.68rem;border-radius:9999px;padding:.25rem .5rem"><i class="fas fa-fire mr-1" style="font-size:.6rem"></i>Top 5</span>
      </div>
      <div class="card-body" style="padding:1.1rem">
        <?php 
if(empty($instrukturBulan)): ?>
          <div class="text-center py-3">
            <div class="mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:44px;height:44px;border-radius:.7rem;background:#f8fafc;border:1px solid #eef0f4;color:#94a3b8"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="small font-weight-bold" style="color:#334155"><?= $isBulanIni ? 'Belum ada sesi mengajar bulan ini' : 'Tidak ada sesi mengajar di ' . html_escape($bulanLabel) ?></div>
            <div class="small text-muted"><?= $isBulanIni ? 'Data akan muncul setelah ada presensi di ' . html_escape($bulanLabel) : 'Coba pilih bulan lain dengan panah di atas' ?></div>
          </div>
        <?php 
else: $iRank=1; foreach($instrukturBulan as $ins){
          $pctI = $maxInstruktur ? ($ins->jml/$maxInstruktur*100) : 0;
          $initI = strtoupper(substr(trim($ins->NamaInstruktur),0,1) . (strpos(trim($ins->NamaInstruktur),' ') ? substr(trim($ins->NamaInstruktur),strpos(trim($ins->NamaInstruktur),' ')+1,1) : ''));
          $rombelIns = $rombelInsMap[(int)$ins->Id] ?? null;
        ?>
          <div class="d-flex align-items-center py-2" style="gap:.7rem;<?= $iRank>1?'border-top:1px solid #f8fafc':'' ?>">
            <span class="d-flex align-items-center justify-content-center flex-shrink-0" style="width:28px;height:28px;border-radius:9999px;background:<?= $iRank==1?'#2563eb':($iRank==2?'#f59e0b':($iRank==3?'#10b981':'#e2e8f0')) ?>;color:<?= $iRank<=3?'#fff':'#475569' ?>;font-size:.7rem;font-weight:800"><?= $iRank ?></span>
            <div class="d-flex align-items-center" style="gap:.6rem;flex:1;min-width:0">
              <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width:32px;height:32px;border-radius:.6rem;background:rgba(245,158,11,.12);color:#d97706;font-weight:800;font-size:.68rem"><?= html_escape($initI) ?></div>
              <div style="flex:1;min-width:0">
                <div class="small font-weight-bold" style="color:#1e293b;font-size:.78rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= html_escape($ins->NamaInstruktur) ?></div>
                <div class="small text-muted" style="font-size:.68rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= $rombelIns ? html_escape($rombelIns->Namarombel) : 'Belum ada rombel' ?></div>
              </div>
            </div>
            <div style="text-align:right;flex-shrink:0;min-width:64px">
              <div class="small font-weight-bold" style="color:#1e293b;font-size:.82rem"><?= $ins->jml ?> <span class="text-muted" style="font-weight:600;font-size:.65rem">sesi</span></div>
              <div style="height:5px;background:#f1f5f9;border-radius:9999px;overflow:hidden;margin-top:.2rem"><div style="height:100%;width:<?= $pctI ?>%;background:<?= $iRank==1?'#2563eb':($iRank==2?'#f59e0b':'#94a3b8') ?>;border-radius:9999px"></div></div>
            </div>
          </div>
        <?php 
$iRank++; } ?>
          <div class="small text-muted mt-3" style="font-size:.66rem"><i class="fas fa-info-circle mr-1" style="color:#94a3b8"></i>Dihitung dari presensi <?= html_escape($rangeLabel) ?></div>
        <?php 
endif; ?>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  var M = document.querySelector('.masonry');
  if (!M) return;
  var items = Array.prototype.slice.call(M.children);
  var COLS = 2, GAP = 24;

  function layout(){
    if (window.innerWidth < 992){
      M.classList.remove('is-packed');
      M.style.height = '';
      items.forEach(function(el){
        el.style.position = ''; el.style.top = ''; el.style.left = ''; el.style.width = '';
      });
      return;
    }
    M.classList.add('is-packed');
    M.style.position = 'relative';
    var colW = Math.floor((M.clientWidth - GAP) / COLS);
    items.forEach(function(el){ el.style.width = colW + 'px'; });
    var bh = items.map(function(el){ return el.offsetHeight; });
    var colH = [0, 0];
    items.forEach(function(el, i){
      var col = colH[0] <= colH[1] ? 0 : 1;
      el.style.position = 'absolute';
      el.style.left = (col * (colW + GAP)) + 'px';
      el.style.top = colH[col] + 'px';
      colH[col] += bh[i] + GAP;
    });
    M.style.height = (Math.max(colH[0], colH[1]) - GAP) + 'px';
  }

  layout();
  window.addEventListener('load', function(){ setTimeout(layout, 0); setTimeout(layout, 450); });
  var r;
  window.addEventListener('resize', function(){ clearTimeout(r); r = setTimeout(layout, 150); });
})();
</script>
<script>
(function(){
  var btns = document.querySelectorAll('.streak-copy');
  if (!btns.length) return;
  var GIFTLESS = !(window.isSecureContext && window.ClipboardItem && window.navigator.clipboard && window.navigator.clipboard.write);

  function setState(btn, done, msg){
    var ic = btn.querySelector('i');
    if (done) {
      btn.classList.add('done');
      if (ic) ic.className = 'fas fa-check';
    } else {
      if (ic) ic.className = 'fas fa-copy';
    }
    if (ic) ic.style.transition = 'opacity .15s';
    btn.title = msg;
    if (done) {
      setTimeout(function(){
        btn.classList.remove('done');
        btn.classList.remove('loading');
        if (ic) ic.className = 'fas fa-copy';
        btn.title = btn.getAttribute('aria-label') || 'Copy gambar streak ke clipboard';
      }, 1600);
    }
  }

  function copyImage(imgUrl){
    return fetch(imgUrl, { cache: 'no-store' })
      .then(function(r){ if (!r.ok) throw new Error('HTTP ' + r.status); return r.blob(); })
      .then(function(blob){
        var item = new ClipboardItem({ 'image/png': blob });
        return navigator.clipboard.write([item]);
      });
  }

  function downloadImage(imgUrl){
    var a = document.createElement('a');
    a.href = imgUrl;
    a.download = 'streak.png';
    a.rel = 'noopener';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
  }

  btns.forEach(function(btn){
    var url = btn.getAttribute('data-streak-url');
    if (GIFTLESS) {
      btn.title = 'Browser tidak mendukung copy gambar, akan diunduh';
      btn.addEventListener('click', function(e){
        e.preventDefault();
        downloadImage(url);
      });
      return;
    }
    btn.addEventListener('click', function(e){
      e.preventDefault();
      if (btn.classList.contains('loading')) return;
      btn.classList.add('loading');
      copyImage(url)
        .then(function(){
          setState(btn, true, 'Gambar streak disalin ke clipboard');
        })
        .catch(function(){
          setState(btn, false, 'Gagal menyalin, mencoba mengunduh');
          setTimeout(function(){ btn.classList.remove('loading'); }, 800);
          downloadImage(url);
        });
    });
  });
})();
</script>

<script type="text/javascript">document.title = "Dashboard Instruktur";</script>
