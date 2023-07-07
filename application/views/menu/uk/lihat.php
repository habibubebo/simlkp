<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Unit Kompetensi</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Unit Kompetensi</li>
  </ol>
</div>
<!-- Content -->
<div class="row">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="tabeluk">
          <thead class="thead-light">
            <tr>
              <th>Jenis Kursus</th>
              <th>Kelas </th>
              <th>Unit 1</th>
              <th>Unit 2</th>
              <th>Unit 3</th>
              <th>Unit 4</th>
              <th>Unit 5</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($uks as $tp) {
            ?>
              <tr>
                <td><?= $tp->Namarombel ?></td>
                <td><?= $tp->Kelas ?></td>
                <td><?= $tp->Uk1 . ' - ' . $tp->Jp1 ?></td>
                <td><?= $tp->Uk2 . ' - ' . $tp->Jp2 ?></td>
                <td><?= $tp->Uk3 . ' - ' . $tp->Jp3 ?></td>
                <td><?= $tp->Uk4 . ' - ' . $tp->Jp4 ?></td>
                <td><?= $tp->Uk5 . ' - ' . $tp->Jp5 ?></td>
                <td>
                  <a href="<?= base_url("uk/form_ubah/$tp->Id") ?>" class="btn btn-warning btn-sm" title="Klik untuk merubah data.">
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
                            <h6 align="center">Apakah anda yakin ingin menghapus data <?= $tp->Namarombel; ?><strong><span class="grt"></span></strong> ?</h6>
                          </div>
                          <div class="modal-footer">
                            <a href="<?= base_url('uk/hapus/' . $tp->Id) ?>" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a>
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
  document.title = "Unit Kompetensi LKP Cenditama";
</script>