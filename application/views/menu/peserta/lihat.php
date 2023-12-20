<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Peserta</h1>
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
    <strong>'.$alert.'</strong>
  </div>';
   };
?>
<div class="row">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="tabelpeserta">
          <thead class="thead-light">
            <tr>
              <th>NIPD</th>
              <th>No KK / NIK</th>
              <th>Nama Peserta</th>
              <th>L/P</th>
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
              if ($tp->Kelamin == "Laki - Laki") {
                $jk = "L";
              } else {
                $jk = "P";
              };
              if ($tp->Status == "0") {
                $status = '<span class="badge bg-danger text-white">Nonaktif</span>';
              } elseif ($tp->Status == "1") {
                $status = '<span class="badge bg-success text-white">Aktif</span>';
              } else {
                $status = '<span class="badge bg-secondary text-white">Lulus</span>';
              }

            ?>
              <tr>
                <td><?= $tp->Nipd ?></td>
                <td><?= $tp->Nokk ?><br>
                  /<br><?= $tp->Nik ?></td>
                <td><a class="btn" style="width:max-content" href="<?= base_url("index.php/presensi/peserta?Id=$tp->Idp") ?>"><?= $tp->Nama ?></td>
                <td><?= $jk; ?></td>
                <td><?= $tp->Ttl ?></td>
                <td><?= $tp->Namarombel ?><br>
                  <?= "/" . $tp->Kelas ?>
                </td>

                <td><?= $tp->Tglmasuk ?></td>
                <td>
                  <?= $status ?><br>
                  <a href="<?= base_url("peserta/form_ubah/$tp->Idp") ?>" class="btn btn-warning btn-sm" title="Klik untuk merubah data.">
                    <i class="fas fa-pen-alt"></i>
                  </a>
                  <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteuser<?= $tp->Idp; ?>" title="Klik untuk menghapus data.">
                    <i class="fas fa-trash-alt"></i>
                  </a>
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
</div>
<script type="text/javascript">
  document.title = "Peserta Didik LKP Cenditama";
</script>