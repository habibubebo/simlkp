<!-- Header -->
<?php
function perpendekNama($s) {
    $p = explode(',', $s, 2);
    $k = preg_split('/\s+/', trim($p[0]));
    $n = implode(' ', array_splice($k, 0, 2)) . ($k ? ' ' . implode('', array_map(fn($w) => strtoupper($w[0] ?? ''), $k)) . '.' : '');
    
    return trim($n) . (isset($p[1]) ? ', ' . rtrim(trim($p[1]), '.') : '');
}
// echo perpendekNama("Haris Dwi Saputra, S.Pi."); 
// Hasil: Haris DS, S.Pi
?>
<div class="d-sm-flex align-items-center justify-content-between mt-4 mb-0">
  <h1 class="h3 mb-0 text-gray-800 d-none d-sm-block">Presensi</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Presensi</li>
  </ol>
</div>
<div class="alert alert-info" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
  <?php
  $today = date("Y-m-d 00:00:00");
  $todays = date("Y-m-d H:i:s");
  $data = $this->db->query("SELECT * FROM presensi WHERE Tgl between '$today' and '$todays' AND pegawai IS Null ")->result();
  $total = 0;
  foreach ($data as $row) {
    $total += 1;
  };
  echo "<b>$total</b> Peserta dan ";
  $data = $this->db->query("SELECT * FROM presensi JOIN pegawai ON  presensi.Nipd = pegawai.Nipg WHERE Tgl between '$today' and '$todays' AND pegawai=1")->result();
  echo "Pegawai <b>";
  $jml = count($data);
  foreach ($data as $row) {
    if ($jml>1){ echo $row->NamaPegawai.', ';} else echo $row->NamaPegawai;
  };
  echo "</b> telah presensi hari ini.";
  ?>
</div>
<!-- Content -->
<div class="row">
  <!-- DataTable with Hover -->
  <div class="">
    <div class="card mb-0">
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="tabelpresensi">
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
          <tbody>
            <?php
            foreach ($presensi as $tp) {
            ?>
              <tr>
                <td><?php $this->Model_APS->Gethari($tp->Tgl) ?></td>
                <td><a class="table-link" href="<?= base_url("index.php/presensi/peserta?Id=$tp->Idp") ?>" title="Melihat seluruh presensi <?= $tp->Nama ?>"><?= perpendekNama($tp->Nama) ?></a></td>
                <td><?= $tp->Namarombel ?></td>
                <td><?php $insParts = explode(' ', trim($tp->NamaInstruktur)); ?><a class="table-link ins-link" href="<?= base_url("presensi/instruktur?Id=$tp->IdI") ?>" title="Melihat presensi instruktur <?= htmlspecialchars($tp->NamaInstruktur) ?>"><span class="ins-w1"><?= htmlspecialchars($insParts[0]) ?></span><span class="ins-rest"><?= isset($insParts[1]) ? ' ' . htmlspecialchars(implode(' ', array_slice($insParts, 1))) : '' ?></span></a></td>
                <td><?= $tp->Materi ?></td>
                <td>
                  <div class="btn-group btn-group-toggle action-group">
                    <a class="btn btn-warning btn-sm flex-fill text-white" href="#" data-toggle="modal" data-target="#editPresensi"
                      data-id="<?= $tp->Id ?>"
                      data-tgl="<?= htmlspecialchars($tp->Tgl, ENT_QUOTES) ?>"
                      data-nipd="<?= htmlspecialchars($tp->Nipd, ENT_QUOTES) ?>"
                      data-nama="<?= htmlspecialchars($tp->Nama, ENT_QUOTES) ?>"
                      data-jks="<?= htmlspecialchars($tp->Jeniskursus, ENT_QUOTES) ?>"
                      data-ins="<?= htmlspecialchars($tp->IdI, ENT_QUOTES) ?>"
                      data-materi="<?= htmlspecialchars($tp->Materi, ENT_QUOTES) ?>"
                      title="Klik untuk merubah data.">
                      <i class="fas fa-pen-alt"></i><span class="btn-text"> Edit</span>
                    </a>
                    <a class="btn btn-danger btn-sm flex-fill text-white" href="#" data-toggle="modal" data-target="#deleteuser<?= $tp->Id; ?>" title="Klik untuk menghapus data.">
                      <i class="fas fa-trash-alt"></i><span class="btn-text"> Hapus</span>
                    </a>
                  </div>
                  <!-- modal delete -->
                  <div class="example-modal">
                    <div id="deleteuser<?= $tp->Id; ?>" class="modal fade" role="dialog" style="display:none;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title">Konfirmasi Delete Data</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body">
                            <h6 align="center">Apakah anda yakin ingin menghapus data <?= $tp->Nama . ' tanggal ' . $tp->Tgl; ?><strong><span class="grt"></span></strong> ?</h6>
                          </div>
                          <div class="modal-footer">
                            <a href="<?= base_url('index.php/presensi/hapus/' . $tp->Id) ?>" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a>
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
  </div>
</div>
<button class="fab-presensi" data-toggle="modal" data-target="#tambahPresensiSiswa" title="Tambah Presensi">
  <i class="fas fa-plus"></i>
</button>
<script type="text/javascript">
  document.title = "Presensi <?= $profil[0]->Namalkp?>";
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
        <div class="form-group mb-2" id="ep-date-tgl">
          <label class="field-label" for="epTgl">Tanggal Hadir</label>
          <div class="input-group date">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
            </div>
            <input type="text" name="tgl" class="form-control presensi-input" id="epTgl" required readonly autocomplete="off">
          </div>
          <small class="text-muted d-block mt-1">Jam sesi mengikuti data awal.</small>
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
  #tabelpresensi tbody tr { transition: none; }
  #tabelpresensi tbody tr:active { transform: none; }
}
/* Kunci scroll halaman belakang saat modal terbuka (cegah lompatan scroll iOS) */
html.app-modal-open, html.app-modal-open body {
  overflow: hidden !important;
  overscroll-behavior: none;
}

/* ====== Daftar presensi ala iPhone (layar kecil) ====== */
@media (max-width: 767.98px) {
  #tabelpresensi_wrapper div.dataTables_filter {
    padding: 0 .25rem .6rem;
  }
  #tabelpresensi_wrapper div.dataTables_filter label {
    margin-bottom: 0;
  }
  #tabelpresensi_wrapper div.dataTables_filter input {
    height: 44px;
    font-size: 16px;
    background: #eef0f4;
    border: 1px solid transparent;
    border-radius: 13px;
    box-shadow: none;
    -webkit-appearance: none;
    appearance: none;
  }
  #tabelpresensi_wrapper div.dataTables_filter input:focus {
    background: #fff;
    border-color: #93b4f5;
    box-shadow: 0 0 0 .25rem rgba(37, 99, 235, .12);
  }

  /* Latar konten abu lembut agar kartu putih kontras (ala grouped list iOS) */
  #container-wrapper { background: #eceff4; }

  /* Kartu luar pembungkus tabel menyatu dengan warna halaman */
  .card.mb-0 {
    background: transparent;
    border: 0;
    box-shadow: none;
  }
  .card.mb-0 > .table-responsive {
    padding: .25rem .75rem 0 !important;
    overflow-x: visible;
  }
  #tabelpresensi,
  #tabelpresensi tbody {
    display: block;
    width: 100%;
    background: transparent !important;
  }
  #tabelpresensi thead { display: none; }

  /* Baris = kartu putih melayang dengan bayangan berlapis */
  #tabelpresensi tbody tr {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    background: #fff;
    border: 0;
    border-radius: 18px;
    padding: .9rem 1rem .95rem;
    margin-bottom: .7rem;
    box-shadow:
      0 1px 2px rgba(17, 24, 39, .06),
      0 6px 16px -6px rgba(17, 24, 39, .10),
      0 0 0 .5px rgba(17, 24, 39, .05);
    -webkit-tap-highlight-color: transparent;
    transition: transform .12s ease;
  }
  #tabelpresensi tbody tr:active { transform: scale(.985); }
  #tabelpresensi td {
    display: block;
    padding: 0 !important;
    border: 0 !important;
    white-space: normal;
    vertical-align: top;
  }
  #tabelpresensi td:not(:nth-child(5)):before { display: none; }

  /* Tanggal → teks di kiri atas kartu, berbagi baris dengan ikon aksi */
  #tabelpresensi td:nth-child(1) {
    order: 0;
    flex: 1 1 auto;
    min-width: 0;
    font-size: .78rem;
    line-height: 1.35;
    font-weight: 600;
    letter-spacing: .01em;
    color: #64748b;
    margin-bottom: .2rem;
  }
  #tabelpresensi td:nth-child(1) .text-info {
    display: block;
    margin-top: .1rem;
    color: #94a3b8 !important;
    font-weight: 500;
  }

  /* Nama → judul kartu dengan chevron di kanan */
  #tabelpresensi td:nth-child(2) {
    order: 1;
    display: flex;
    align-items: center;
    flex: 0 0 100%;
    margin: .1rem 0 .05rem;
  }
  #tabelpresensi td:nth-child(2) .table-link,
  #tabelpresensi td:nth-child(2) a.btn {
    flex: 1 1 auto;
    min-width: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 0;
    font-size: 1.02rem;
    font-weight: 600;
    color: #111827;
    text-decoration: none;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  #tabelpresensi td:nth-child(2) a::after {
    content: "\203A";
    flex: 0 0 auto;
    margin-left: .55rem;
    font-size: 1.45rem;
    font-weight: 400;
    line-height: 1;
    color: #c4cad3;
  }

  /* Baris info: "Jenis Kursus - Materi" rata kiri, avatar instruktur di kanan */
  #tabelpresensi td:nth-child(3) {
    order: 2;
    flex: 0 1 auto;
    min-width: 0;
    max-width: 48%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: .8rem;
    font-weight: 600;
    color: #374151;
  }
  #tabelpresensi td:nth-child(5) {
    order: 3;
    flex: 0 1 auto;
    min-width: 0;
    max-width: 38%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: .8rem;
    font-weight: 400;
    color: #6b7280;
  }
  #tabelpresensi td:nth-child(5)::before {
    content: "-";
    margin: 0 .35rem;
    color: #cbd2dc;
  }
  /* Instruktur → kata pertama saja, hitam bold + chevron, rata kanan */
  #tabelpresensi td:nth-child(4) {
    order: 4;
    flex: 0 1 auto;
    margin-left: auto;
    min-width: 0;
    max-width: 42%;
    overflow: hidden;
    white-space: nowrap;
  }
  #tabelpresensi td:nth-child(4) .ins-rest { display: none; }
  #tabelpresensi td:nth-child(4) a.table-link {
    max-width: 100%;
    overflow: hidden;
    font-size: .8rem;
    font-weight: 700;
    color: #111827 !important;
    border-bottom: 0;
    text-decoration: none;
  }
  #tabelpresensi td:nth-child(4) .ins-w1 {
    overflow: hidden;
    text-overflow: ellipsis;
  }

  /* Aksi → ikon kecil di pojok kanan atas, sebaris dengan tanggal */
  #tabelpresensi td:last-child {
    order: 0;
    flex: 0 0 auto;
    margin: 0 0 0 .5rem;
  }
  #tabelpresensi td:last-child .action-group {
    gap: .4rem;
  }
  #tabelpresensi td:last-child .action-group .btn {
    width: 32px;
    height: 32px;
    min-height: 0;
    padding: 0;
    border-radius: 9px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: .8rem;
  }
  #tabelpresensi td:last-child .action-group .btn-text { display: none; }
  #tabelpresensi td:last-child .action-group .btn i { display: inline-block !important; }

  /* Info & paginasi ala iOS: kapsul putih melayang */
  #tabelpresensi_info {
    padding: .15rem .95rem 0;
    font-size: .74rem;
    color: #8a919c;
    text-align: center;
  }
  #tabelpresensi_paginate {
    display: flex;
    justify-content: center;
    padding: .5rem .75rem calc(1rem + env(safe-area-inset-bottom, 0px));
    max-width: 100%;
    overflow-x: auto;
    scrollbar-width: none;
  }
  #tabelpresensi_paginate::-webkit-scrollbar { display: none; }
  #tabelpresensi_paginate .pagination {
    display: inline-flex;
    flex-wrap: nowrap;
    align-items: center;
    gap: .15rem;
    margin: 0;
    background: #fff;
    border-radius: 9999px;
    padding: .25rem;
    box-shadow:
      0 1px 2px rgba(17, 24, 39, .06),
      0 6px 16px -6px rgba(17, 24, 39, .10),
      0 0 0 .5px rgba(17, 24, 39, .05);
  }
  #tabelpresensi_paginate .page-link {
    border: 0;
    background: transparent;
    border-radius: 9999px;
    min-width: 34px;
    height: 34px;
    padding: 0 .55rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #475569;
    font-size: .85rem;
    font-weight: 600;
  }
  #tabelpresensi_paginate .page-item.disabled .page-link { color: #c3cad4; }
  #tabelpresensi_paginate .page-item:not(.disabled):not(.active) .page-link:hover {
    background: rgba(37, 99, 235, .08);
    color: #2563eb;
  }
  #tabelpresensi_paginate .page-item.active .page-link {
    background: #2563eb;
    color: #fff;
    box-shadow: 0 1px 3px rgba(37, 99, 235, .35);
  }
  /* Prev/Next jadi ikon chevron */
  #tabelpresensi_paginate .previous a,
  #tabelpresensi_paginate .next a {
    width: 34px;
    min-width: 34px;
    padding: 0;
    font-size: 0;
  }
  #tabelpresensi_paginate .previous a::before,
  #tabelpresensi_paginate .next a::before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: .8rem;
    line-height: 1;
  }
  #tabelpresensi_paginate .previous a::before {
    content: "\f053";
  }
  #tabelpresensi_paginate .next a::before {
    content: "\f054";
  }
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
      if (!prevJam[i - 1]) prevJam[i - 1] = addMinutes(last, 45);
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
    $('#epTgl').data('origtime', (m && m[2]) ? m[2] : '');
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

  // Kembalikan komponen jam asli agar tidak berubah saat simpan
  $('#formEditPresensi').on('submit', function () {
    var t = $('#epTgl').data('origtime');
    if (t) {
      $('#epTgl').val($('#epTgl').val() + ' ' + t);
    }
  });
});
</script>
