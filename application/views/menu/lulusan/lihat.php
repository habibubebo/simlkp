<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Lulusan</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Lulusan</li>
  </ol>
</div>
<!-- Content -->
<div class="row">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 flex-row align-items-center justify-content-between">
        <a href="<?php echo base_url('index.php/lulusan/form'); ?>" class="btn btn-primary btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
          </span>
          <span class="text">Tambah</span>
        </a>
        <a href="<?php echo base_url('index.php/Laporan/lulusan'); ?>" class="btn btn-success btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-download"></i>
          </span>
          <span class="text">Unduh</span>
        </a>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>No Induk</th>
              <th>Tempat Tanggal Lahir</th>
              <th>Jenis Kursus</th>
              <th>Tanggal Masuk</th>
              <th>Tanggal Lulus</th>
              <th>Tanggal Cetak</th>
              <th>Instruktur</th>
              <th>Nilai 1</th>
              <th>Nilai 2</th>
              <th>Nilai 3</th>
              <th>Nilai 4</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 0;
            foreach ($lulusan as $tp) {
              $no += 1;
            ?>
              <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $tp->Nama ?></td>
                <td><?php echo $tp->Nipd ?></td>
                <td><?php echo $tp->Ttl ?></td>
                <td><?php echo $tp->Jeniskursus ?></td>
                <td><?php echo $tp->Tglmasuk ?></td>
                <td><?php echo $tp->Tgllulus ?></td>
                <td><?php echo $tp->Tglcetak ?></td>
                <td><?php echo $tp->Instruktur ?></td>
                <td><?php echo $tp->n1 ?></td>
                <td><?php echo $tp->n2 ?></td>
                <td><?php echo $tp->n3 ?></td>
                <td><?php echo $tp->n4 ?></td>

                <td>
                  <a href="<?= base_url("index.php/lulusan/form_ubah/$tp->Id") ?>" class="btn btn-warning btn-sm" title="Klik untuk merubah data.">
                    <i class="fas fa-pen-alt"></i>
                  </a>
                  <a href="<?= base_url("index.php/sertifikat?Id=$tp->Id") ?>" class="btn btn-success btn-sm" title="Klik untuk mencetak pdf.">
                    <i class="fas fa-print"></i>
                  </a>
                  <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteuser<?php echo $tp->Id; ?>" title="Klik untuk menghapus data.">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                  <!-- modal delete -->
                  <div class="example-modal">
                    <div id="deleteuser<?php echo $tp->Id; ?>" class="modal fade" role="dialog" style="display:none;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title">Konfirmasi Delete Data</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body">
                            <h6 align="center">Apakah anda yakin ingin menghapus data <?php echo $tp->Nama; ?><strong><span class="grt"></span></strong> ?</h6>
                          </div>
                          <div class="modal-footer">
                            <a href="<?= base_url('index.php/lulusan/hapus/' . $tp->Id) ?>" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a>
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