<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Presensi</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Presensi</li>
  </ol>
</div>
<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
  <?php
  $today = date("Y-m-d 00:00:00");
  $todays = date("Y-m-d H:i:s");
  $data = $this->db->query("SELECT * FROM presensi WHERE Tgl between '$today' and '$todays'")->result();
  $total = 0;
  foreach ($data as $row) {
    $total += 1;
  };
  echo "<i class='fas fa-bell'></i>&nbsp;&nbsp;<b>$total</b> Peserta telah presensi hari ini.";
  ?>
</div>
<!-- Content -->
<div class="row">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
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
                <td><a class="btn" style="width:max-content" href="<?= base_url("index.php/presensi/peserta?Id=$tp->Idp") ?>"><?= $tp->Nama ?></td>
                <td><?= $tp->Namarombel ?></td>
                <td><?= $tp->NamaInstruktur ?></td>
                <td><?= $tp->Materi ?></td>
                <td>
                  <a href="<?= base_url("index.php/presensi/form_ubah/$tp->Id") ?>" class="btn btn-warning btn-sm" title="Klik untuk merubah data.">
                    <i class="fas fa-pen-alt"></i>
                  </a>
                  <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteuser<?= $tp->Id; ?>" title="Klik untuk menghapus data.">
                    <i class="fas fa-trash-alt"></i>
                  </a>
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
<script type="text/javascript">
  document.title = "Presensi LKP Cenditama";
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Presensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url() . 'index.php/presensi/tambah'; ?>" method="POST">
          <div class="row">
            <div class="form-group col-md-10" id="simple-date1">
              <div class="input-group date">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="text" name="tgl" class="form-control" placeholder="Tanggal Hadir" id="simpleDataInput" maxlength=20 required value="<?php echo date('Y-m-d H:i:s') ?>">
              </div>
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="jumlah" aria-describedby="emailHelp" name="jumlah" maxlength=2>
                <option value="1">1 Pertemuan</option>
                <option value="2">2 Pertemuan</option>
                <option value="3">3 Pertemuan</option>
              </select> 
            </div> 
            <div class="form-group col-md-12">
              <select class="form-control" id="nama" aria-describedby="emailHelp" name="nama" maxlength=50 required>
                <option selected value="">Nama Peserta</option>
                <?php
                $data = $this->db->query("SELECT Nama,Nipd FROM peserta WHERE Status=1")->result();
                $no = 1;
                foreach ($data as $row) { ?>
                  <option value="<?php echo $row->Nipd ?>">
                    <?php echo $no . '. ' . $row->Nama ?>
                  </option>
                <?php $no++;
                } ?>
              </select>
            </div>
            <div class="form-group col-md-6" hidden>
              <input type="text" class="form-control" id="jks" aria-describedby="emailHelp" placeholder="Jenis Kursus" name="jks" maxlength="50" required>
            </div>
            <div class="form-group col-md-12">
              <select type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Instruktur" maxlength=20 required>
                <option disabled selected value="">Instruktur</option>
                <?php
                $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
                foreach ($data as $row) { ?>
                  <option value="<?php echo $row->Id ?>">
                    <?php echo $row->NamaInstruktur ?>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-12">
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Materi" name="materi" maxlength="50" required>
            </div>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>