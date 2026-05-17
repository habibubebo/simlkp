<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mt-4 mb-0">
  <h1 class="h3 mb-0 text-gray-800">Presensi</h1>
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
  <!-- <div class="col-lg-12"> -->
    <div class="card mb-4">
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
                <td><a class="table-link" href="<?= base_url("index.php/presensi/peserta?Id=$tp->Idp") ?>" title="Melihat seluruh presensi <?= $tp->Nama ?>"><?= $tp->Nama ?></a></td>
                <td><?= $tp->Namarombel ?></td>
                <td><a class="table-link" href="<?= base_url("presensi/instruktur?Id=$tp->IdI") ?>" title="Melihat presensi instruktur"><?= $tp->NamaInstruktur ?></a></td>
                <td><?= $tp->Materi ?></td>
                <td>
                  <div class="btn-group btn-group-toggle action-group">
                    <a class="btn btn-warning btn-sm flex-fill text-white" href="<?= base_url("index.php/presensi/form_ubah/$tp->Id") ?>" title="Klik untuk merubah data.">
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
<div class="modal fade" id="tambahPresensiSiswa" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-mobile" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Presensi Peserta</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('index.php/presensi/tambah') ?>" method="POST">
          <div class="row g-2">
            <div class="col-6 form-group mb-2" id="simple-date1">
              <label class="small text-muted mb-1">Tanggal</label>
              <div class="input-group input-group-sm date">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="text" name="tgl" class="form-control" id="simpleDataInput" required value="<?= date('Y-m-d') ?>">
              </div>
            </div>
            <div class="col-6 form-group mb-2">
              <label class="small text-muted mb-1">Jam</label>
              <input type="time" name="waktu" class="form-control form-control-sm" value="<?= date('H:i') ?>" required>
            </div>
          </div>
          <div class="form-group mb-2">
            <label class="small text-muted mb-1">Peserta <span class="text-muted">(bisa pilih banyak)</span></label>
            <select class="form-control form-control-sm" id="nama" name="nama[]" multiple required>
              <option value="">Pilih Peserta</option>
              <?php
              $data = $this->db->query("SELECT Nama,Nipd FROM peserta WHERE Status=1")->result();
              $no = 1;
              foreach ($data as $row) { ?>
                <option value="<?= $row->Nipd ?>"><?= $no++ . '. ' . $row->Nama ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group mb-2">
            <label class="small text-muted mb-1">Instruktur</label>
            <select class="form-control form-control-sm" name="Instruktur" required>
              <option value="">Pilih Instruktur</option>
              <?php
              $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= $row->NamaInstruktur ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="row">
            <div class="col-8 form-group mb-0">
              <label class="small text-muted mb-1">Materi</label>
              <div id="materiContainer">
                <div class="input-group input-group-sm mb-1">
                  <div class="input-group-prepend"><span class="input-group-text">1</span></div>
                  <input type="text" class="form-control" name="materi[]" placeholder="Materi pertemuan 1" required>
                </div>
              </div>
            </div>
            <div class="col-4 form-group mb-0">
              <label class="small text-muted mb-1">Sesi</label>
              <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-outline-secondary px-2" id="minusBtn">-</button>
                </div>
                <input type="text" class="form-control text-center" id="jumlah" name="jumlah" value="1" readonly style="background:#fff">
                <div class="input-group-append">
                  <button type="button" class="btn btn-outline-secondary px-2" id="plusBtn">+</button>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer pt-2 px-3 pb-3 d-flex flex-nowrap">
        <button type="button" class="btn btn-secondary flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary flex-fill ml-2">Simpan</button>
      </div>
      </form>
    </div>
  </div>
<!-- </div> -->

<style>
@media (max-width: 576px) {
  .modal-fullscreen-mobile {
    margin: 0 !important;
    max-width: 100%;
  }
  .modal-fullscreen-mobile .modal-footer .btn {
    font-size: 0.95rem;
    padding: 0.65rem 0;
    border-radius: 0.5rem;
  }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function(){
  var jml = document.getElementById('jumlah');
  document.getElementById('plusBtn').addEventListener('click', function(){
    var v = parseInt(jml.value) + 1;
    if(v <= 10){ jml.value = v; updateMateri(v); }
  });
  document.getElementById('minusBtn').addEventListener('click', function(){
    var v = parseInt(jml.value) - 1;
    if(v >= 1){ jml.value = v; updateMateri(v); }
  });
});
function updateMateri(n){
  var c = document.getElementById('materiContainer');
  c.innerHTML = '';
  for(var i = 1; i <= n; i++){
    var d = document.createElement('div');
    d.className = 'input-group input-group-sm mb-1';
    d.innerHTML = '<div class="input-group-prepend"><span class="input-group-text">' + i + '</span></div><input type="text" class="form-control" name="materi[]" placeholder="Materi pertemuan ' + i + '" required>';
    c.appendChild(d);
  }
}
</script>