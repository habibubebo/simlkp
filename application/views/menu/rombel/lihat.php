<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Rombongan Belajar</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Rombongan Belajar</li>
  </ol>
</div>
<!-- Content -->
<div class="row">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="tabelrombel">
          <thead class="thead-light">
            <tr>
              <th>Jenis Kursus</th>
              <th>Kelas </th>
              <th>Jumlah Peserta</th>
              <th>Ruangan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($rombel as $tp) {
            ?>
              <tr>
                <td><?php echo $tp->Namarombel ?></td>
                <td><?php echo $tp->Kelas ?></td>
                <td><?php echo $tp->Jumlahpeserta ?></td>
                <td><?php echo $tp->Ruangan ?></td>
                <td>
                  <a href="<?= base_url("rombel/form_ubah/$tp->Id") ?>" class="btn btn-warning btn-sm" title="Klik untuk merubah data.">
                    <i class="fas fa-pen-alt"></i>
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
                            <h6 align="center">Apakah anda yakin ingin menghapus data <?php echo $tp->Namarombel; ?><strong><span class="grt"></span></strong> ?</h6>
                          </div>
                          <div class="modal-footer">
                            <a href="<?= base_url('rombel/hapus/' . $tp->Id) ?>" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a>
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
<script type="text/javascript">document.title = "Rombel di LKP Cenditama";</script>