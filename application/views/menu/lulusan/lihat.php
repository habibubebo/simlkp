<!-- Header -->
<style type="text/css">
    .txtedit {
      display: none;
      width: 100%;
    }
  </style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Lulusan</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Lulusan</li>
  </ol>
</div>
<!-- Content -->
<div class="row">
  <div class="col-xl mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="my-auto">Catatan</h5>
                        <span class="text-warning">Klik pada teks untuk edit</span>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead hidden>
                                <tr>
                                    <th></th>
                                    <th width='10%'></th>
                                    <th width='90%'></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php foreach ($notes as $tp) { ?>
                                    <tr>
                                        <td hidden><a class="text-danger" href="<?= base_url('admin/deletemaster/pk/' . $tp->id) ?>">Del</a></td>
                                        <td><b class="text-info">
                                            <span class='edit'><?= $tp->jenis ?></span>
                                            <input type='text' class='txtedit pk' data-id='<?= $tp->id ?>' data-field='jenis' id='jenistxt_<?= $tp->id ?>' value='<?= $tp->jenis ?>'></b>
                                        </td>
                                        <td>
                                            <span class='edit'><?= $tp->data ?></span>
                                            <input type='text' class='txtedit pk' data-id='<?= $tp->id ?>' data-field='data' id='datatxt_<?= $tp->id ?>' value='<?= $tp->data ?>'>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</div>
<div class="row">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">

      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="tabellulusan">
          <thead class="thead-light">
            <tr>
              <th>Nama</th>
              <th>No Induk</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kursus</th>
              <th>Tanggal Masuk</th>
              <th>Tanggal Lulus</th>
              <th>Tanggal Cetak</th>
              <th>Instruktur</th>
              <th>Nilai</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($lulusan as $tp) {

            ?>
              <tr>
                <td><?= $tp->Nama ?></td>
                <td><?= $tp->Nipd ?></td>
                <td><?= $tp->Ttl ?></td>
                <td><?= $tp->Namarombel ?></td>
                <td><?= $tp->Tglmasuk ?></td>
                <td><?= $tp->Tgllulus ?></td>
                <td><?= $tp->Tglcetak ?></td>
                <td><?= $tp->NamaInstruktur ?></td>
                <td><?= $tp->n1 . ',' . $tp->n2 . ',' . $tp->n3 . ',' . $tp->n4 . ',' . $tp->n5 ?></td>
                <td>
                  <a href="<?= base_url("lulusan/form_ubah/$tp->Idl") ?>" class="btn btn-warning btn-sm" title="Klik untuk merubah data.">
                    <i class="fas fa-pen-alt"></i>
                  </a>
                  <a href="<?= base_url("sertifikat?Id=$tp->Idl") ?>" class="btn btn-success btn-sm" disabled title="Klik untuk mencetak pdf.">
                    <i class="fas fa-print"></i>
                  </a>
                  <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteuser<?= $tp->Idl; ?>" title="Klik untuk menghapus data.">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                  <!-- modal delete -->
                  <div class="example-modal">
                    <div id="deleteuser<?= $tp->Idl; ?>" class="modal fade" role="dialog" style="display:none;">
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
                            <a href="<?= base_url('lulusan/hapus/' . $tp->Idl) ?>" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a>
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
  document.title = "Lulusan LKP Cenditama";
</script>
<script type="text/javascript">
            $(document).ready(function() {

                // On text click
                $('.edit').click(function() {

                    // Hide input element
                    $('.txtedit').hide();

                    // Show next input element
                    $(this).next('.txtedit').show().focus();

                    // Hide clicked element
                    $(this).hide();
                });
                 $('.txtedit.pk').focusout(function() {
                    // Get edit id, field name and value
                    var edit_id = $(this).data('id');
                    var fieldname = $(this).data('field');
                    var value = $(this).val();

                    // Hide Input element
                    $(this).hide();

                    // Update viewing value and display it
                    $(this).prev('.edit').show();
                    $(this).prev('.edit').text(value);

                    // Send AJAX request
                    $.ajax({
                        url: '<?= base_url() ?>lulusan/notes/update',
                        type: 'post',
                        data: {
                            field: fieldname,
                            value: value,
                            id: edit_id
                        },
                        success: function(response) {
                            console.log(response);

                        }
                    });
                });
                 });
               </script>