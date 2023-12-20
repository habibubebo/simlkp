<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Presensi Peserta</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Presensi Peserta</li>
  </ol>
</div>
<!-- Content -->
<div class="row">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      
      <table class="table table-borderless">
        <thead>
          <tr>
            <th scope="col">Nama</th>
            <th scope="col"><?php echo $presensi[0]->Nama; ?></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="col">Jenis Kursus</th>
            <td><?php echo $presensi[0]->Namarombel ?></td>
          </tr>
          <tr>
            <th scope="col">Instruktur</th>
            <td><?php echo $presensi[0]->NamaInstruktur ?></td>
          </tr>
        </tbody>
      </table>
      <div class="table-responsive-sm p-3">
        <table class="table align-items-center table-flush table-hover" id="tabelpresensipeserta">
          <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>Tanggal</th> 
              <th>Materi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=1;
            foreach ($presensi as $tp) {
            ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php $this->Model_APS->Gethari($tp->Tgl) ?></td>
                <td><?php echo $tp->Materi ?></td>
                <td>
                  <a href="<?= base_url("index.php/presensi/form_ubah/$tp->Idpr") ?>" class="btn btn-warning btn-sm" title="Klik untuk merubah data.">
                    <i class="fas fa-pen-alt"></i>
                  </a>
                  <!-- <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteuser" title="Klik untuk menghapus data.">
                    <i class="fas fa-trash-alt"></i>
                  </a> -->
                  <!-- modal delete -->
                  <div class="example-modal">
                    <div id="deleteuser" class="modal fade" role="dialog" style="display:none;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title">Konfirmasi Delete Data</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body">
                            <h6 align="center">Apakah anda yakin ingin menghapus data <?php echo $tp->Nama.' tanggal '.$tp->Tgl; ?><strong><span class="grt"></span></strong> ?</h6>
                          </div>
                          <div class="modal-footer">
                            <!-- <a href="<?= base_url("index.php/presensi/hapus/$tp->Idpr") ?>" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a> -->
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
<script type="text/javascript">document.title = "Presensi Kursus <?= $presensi[0]->Nama ?>,<br>Program <?= $presensi[0]->Namarombel ?>";</script>