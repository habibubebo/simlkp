<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pegawai</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Pegawai</li>
  </ol>
</div>
<div class="alert alert-info alert-dismissible" role="alert">
  <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button> -->
  <?php
  $today = date("Y-m-d 00:00:00");
  $todays = date("Y-m-d H:i:s");
  $data = $this->db->query("SELECT * FROM presensi JOIN pegawai ON  presensi.Nipd = pegawai.Nipg WHERE Tgl between '$today' and '$todays' AND pegawai=1")->result();
  echo "<i class='fas fa-bell'></i>&nbsp;&nbsp;Pegawai <b>";
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
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="tabelpegawai">
          <thead class="thead-light">
            <tr>
              <th>No Induk</th>
              <th>Nama Pegawai</th>
              <th>Kelamin</th>
              <th>Tempat Lahir</th>
              <th>Tanggal Lahir</th>
              <th>Alamat</th>
              <th>Email</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($pegawai as $tp) {
            ?>
              <tr>
                <td><?= $tp->Nipg ?></td>
                <td><?= $tp->NamaPegawai ?></td>
                <td><?= $tp->Kelamin ?></td>
                <td><?= $tp->TempatLahir ?></td>
                <td><?= $tp->TanggalLahir ?></td>
                <td><?= $tp->Alamat ?></td>
                <td><?= $tp->Email ?></td>
                <td>
                <div class="btn-group btn-group-toggle">
                  <label class="btn btn-info btn-sm">
                  <a class="text-white" href="<?= base_url("presensi/pegawai?Id=$tp->Nipg") ?>" title="Melihat presensi">
                    <i class="fas fa-newspaper"></i>
                  </a>
                  </label>
                  <label class="btn btn-warning btn-sm">
                  <a class="text-white" href="<?= base_url("pegawai/form_ubah/$tp->Id") ?>" title="Klik untuk merubah data.">
                    <i class="fas fa-pen-alt"></i>
                  </a>
                  </label>
                  <label class="btn btn-danger btn-sm">
                  <a class="text-white" href="#" data-toggle="modal" data-target="#deleteuser<?= $tp->Id; ?>" title="Klik untuk menghapus data.">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                  </label>
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
                            <h6 align="center">Apakah anda yakin ingin menghapus data <?= $tp->NamaPegawai; ?><strong><span class="grt"></span></strong> ?</h6>
                          </div>
                          <div class="modal-footer">
                            <a href="<?= base_url('pegawai/hapus/' . $tp->Id) ?>" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a>
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

  <!-- modal tambah -->
  <div class="example-modal tambah">
                    <div id="tambahPegs" class="modal fade" role="dialog" style="display:none;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title">Tambah Pegawai</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body">
                          <form action="<?php echo base_url() . 'pegawai/tambah'; ?>" method="POST">
                <div class="row">
                    <div class="form-group col-md-9">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama pegawai" name="ni" maxlength=100 required>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Induk" name="nipg" required>
                    </div>
                    <div class="form-group col-md-4">
                        <select name="jk" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            <option value="">Kelamin</option>
                            <option value="Laki - Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Alamat" name="al" maxlength=100 required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tempat Lahir" name="tl" maxlength=20 required>
                    </div>
                    <div class="form-group col-md-6" id="simple-date3">
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="text" name="tgl" class="form-control" placeholder="Tanggal Lahir" id="simpleDataInput" maxlength=20 required>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Alamat Email" name="email" maxlength=30 required>
                    </div>
                </div>
                          </div>
                          <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Batal</button>
            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
<!-- end modal Tambah -->

</div>
<script type="text/javascript">
  document.title = "Pegawai <?= $profil[0]->Namalkp?>";
</script>