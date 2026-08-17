<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800 d-none d-sm-block">Peserta</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Peserta</li>
  </ol>
</div>
<!-- Content -->
<?php
$alert = $this->session->flashdata('alert');
if (isset($alert)) {
  echo '<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <h6><i class="fas fa-exclamation-triangle"></i><b> Informasi</b></h6>
    <strong>' . $alert . '</strong>
  </div>';
};
?>
<div class="row">
  <!-- DataTable with Hover -->
  <!-- <div class="col-lg-12"> -->
    <div class="card mb-4">
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="tabelpeserta">
          <thead class="thead-light">
            <tr>
              <th>Status</th>
              <th>NIPD</th>
              <!-- <th>No KK / NIK</th> -->
              <th>Nama Peserta</th>
              <th>Jenis Kelamin</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kursus / Kelas</th>
              <th>Tanggal Masuk</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $jk = "";
            foreach ($peserta as $tp) {
              ($tp->Kelamin == "Laki - Laki") ? $jk = "L" : $jk = "P";
              if ($tp->Status == "0") {
                $status = '<span class="badge bg-danger text-white">Nonaktif</span>';
              } elseif ($tp->Status == "1") {
                $status = '<span class="badge bg-success text-white">Aktif</span>';
              } else {
                $status = '<span class="badge bg-secondary text-white">Lulus</span>';
              }

            ?>
              <tr>
                <td><?= $status ?></td>
                <td><?= $tp->Nipd ?></td>
                <!-- <td><?= $tp->Nokk ?><br>/<br><?= $tp->Nik ?></td> -->
                <td><a class="btn" style="width:max-content" href="<?= base_url("index.php/presensi/peserta?Id=$tp->Idp") ?>"><?= $tp->Nama ?></td>
                <td><?= $jk; ?></td>
                <td><?= $tp->Ttl ?></td>
                <td><?= $tp->Namarombel ?><br>
                  <?= "/" . $tp->Kelas ?>
                </td>

                <td><?= date("d-m-Y", strtotime($tp->Tglmasuk)) ?></td>
                <td>
                  <div class="btn-group btn-group-toggle">
                    <label class="btn btn-warning btn-sm">
                      <a class="text-white" href="<?= base_url("peserta/form_ubah/$tp->Idp") ?>" title="Klik untuk merubah data.">
                        <i class="fas fa-pen-alt"></i>
                      </a>
                    </label>
                    <label class="btn btn-danger btn-sm">
                      <a class="text-white" href="#" data-toggle="modal" data-target="#deleteuser<?= $tp->Idp; ?>" title="Klik untuk menghapus data.">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </label>
                  </div>
                  <!-- modal delete -->
                  <div class="example-modal">
                    <div id="deleteuser<?= $tp->Idp; ?>" class="modal fade" role="dialog" style="display:none;">
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
                            <a href="<?= base_url('peserta/hapus/' . $tp->Idp) ?>" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a>
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
<!-- </div> -->

<!-- modal tambah -->
<div class="example-modal peserta">
  <div id="tambahPeserta" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Tambah Peserta Baru</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url() . 'peserta/tambah'; ?>" method="POST">
            <div class="row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nomor Induk" name="Nipd" maxlength=20 required>
              </div>
              <div class="form-group col-md-6">
                <select class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Status" required>
                  <option disabled selected value="">Status</option>
                  <option value="0">Nonaktif</option>
                  <option value="1">Aktif</option>
                  <option value="2">Lulus</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Kartu Keluarga" name="Nokk" maxlength=30 value="-">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Induk Keluarga" name="Nik" maxlength=30 value="-">
              </div>
              <div class="form-group col-md-8">
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Peserta" name="Nama" maxlength=50 required>
              </div>
              <div class="form-group col-md-4">
                <select class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Jk" required>
                  <option disabled selected value="">Kelamin</option>
                  <option value="Laki - Laki">Laki - Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="form-group col-md-8" id="exampleInputEmail1">
                <div class="input-group">
                  <input type="text" name="Tgl" class="form-control" placeholder="Tempat, Tanggal Lahir" id="simpleDataInput" maxlength=50 required>
                </div>
              </div>
              <div class="form-group col-md-4">
                <select class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Jenis" maxlength=50 required>
                  <option disabled selected value="">Jenis Kursus</option>
                  <?php
                  $data = $this->db->query("SELECT * FROM rombel")->result();
                  foreach ($data as $row) { ?>
                    <option value="<?php echo $row->Id ?>">
                      <?php echo $row->Namarombel ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <select type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Kls" maxlength=20 required>
                  <option disabled selected value="">Kelas</option>
                  <?php
                  foreach ($rombel as $row) { ?>
                    <option value="<?php echo $row->Kelas ?>">
                      <?php echo $row->Namarombel . ' - ' . $row->Kelas ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-6" id="simple-date2">
                <div class="input-group date">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                  </div>
                  <input type="text" name="Tglmasuk" class="form-control" placeholder="Tanggal Masuk" id="simpleDataInput" maxlength=20 required>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
    <!-- end modal tambah -->
    <script type="text/javascript">
      document.title = "Peserta Didik <?= $profil[0]->Namalkp ?>";
    </script>