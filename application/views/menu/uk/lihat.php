<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800 d-none d-sm-block">Unit Kompetensi</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Unit Kompetensi</li>
  </ol>
</div>
<!-- Content -->
<?php
$ukCell = function ($tp, $i) {
  $kode = trim((string) $tp->{'Kode' . $i});
  $nama = trim((string) $tp->{'Uk' . $i});
  $jp = trim((string) $tp->{'Jp' . $i});
  if ($nama === '' && $kode === '' && $jp === '') {
    return '-';
  }
  $out = '';
  if ($kode !== '') {
    $out .= '<small class="text-muted d-block">' . html_escape($kode) . '</small>';
  }
  $out .= html_escape(trim($nama . ' - ' . $jp, ' -'));
  return $out;
};
?>
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
              <th>Unit 6</th>
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
                <td><?= $ukCell($tp, 1) ?></td>
                <td><?= $ukCell($tp, 2) ?></td>
                <td><?= $ukCell($tp, 3) ?></td>
                <td><?= $ukCell($tp, 4) ?></td>
                <td><?= $ukCell($tp, 5) ?></td>
                <td><?= $ukCell($tp, 6) ?></td>
                <td>
                <div class="btn-group btn-group-toggle">
                  <label class="btn btn-warning btn-sm">
                  <a class="text-white" href="<?= base_url("uk/form_ubah/$tp->Idu") ?>" class="btn btn-warning btn-sm" title="Klik untuk merubah data.">
                    <i class="fas fa-pen-alt"></i>
                  </a>
                  </label>
                  <label class="btn btn-danger btn-sm">
                  <a class="text-white" href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteuser<?= $tp->Id; ?>" title="Klik untuk menghapus data.">
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
                            <h6 align="center">Apakah anda yakin ingin menghapus data <?= $tp->Namarombel; ?><strong><span class="grt"></span></strong> ?</h6>
                          </div>
                          <div class="modal-footer">
                            <a href="<?= base_url('uk/hapus/' . $tp->Idu) ?>" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a>
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
  document.title = "Unit Kompetensi <?= $profil[0]->Namalkp?>";
</script>