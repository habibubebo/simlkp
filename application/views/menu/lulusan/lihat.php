<!-- Header -->
<style type="text/css">
    .txtedit {
      display: none;
      width: 100%;
    }
  </style>
<div class="d-sm-flex align-items-center justify-content-between mt-4 mb-2">
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
                <td><?= date("d-m-Y",strtotime($tp->Tglmasuk))  ?></td>
                <td><?= date("d-m-Y",strtotime($tp->Tgllulus))  ?></td>
                <td><?= date("d-m-Y",strtotime($tp->Tglcetak))  ?></td>
                <td><?= $tp->NamaInstruktur ?></td>
                <td><?= $tp->n1 . ',' . $tp->n2 . ',' . $tp->n3 . ',' . $tp->n4 . ',' . $tp->n5 ?></td>
                <td>
                  <div class="btn-group btn-group-toggle action-group">
                    <a href="#" class="btn btn-info btn-sm flex-fill text-white btn-edit-lulusan" data-id="<?= $tp->Idl ?>" title="Klik untuk merubah data.">
                    <i class="fas fa-pen-alt"></i><span class="btn-text"> Edit</span>
                    </a>
                    <a href="<?= base_url("sertifikat?Id=$tp->Idl") ?>" target="_blank" class="btn btn-warning btn-sm flex-fill text-white print" title="Klik untuk mencetak pdf.">
                    <i class="fas fa-print"></i><span class="btn-text"> Print</span>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm flex-fill text-white" data-toggle="modal" data-target="#deleteuser<?= $tp->Idl; ?>" title="Klik untuk menghapus data.">
                    <i class="fas fa-trash-alt"></i><span class="btn-text"> Hapus</span>
                    </a>
                  </div>
                  
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
<button class="fab-presensi" data-toggle="modal" data-target="#modalTambah" title="Tambah Lulusan">
  <i class="fas fa-plus"></i>
</button>

<!-- Modal Tambah Lulusan -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-mobile" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Lulusan</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('lulusan/tambah') ?>" method="POST">
          <div class="form-group mb-2">
            <label class="small text-muted mb-1">Peserta</label>
            <select class="form-control form-control-sm" id="peserta" name="nipd" required>
              <option value="">Cari peserta...</option>
              <?php
              $data = $this->db->query("SELECT Nipd,Nama FROM peserta WHERE Status=2 AND NOT EXISTS (SELECT Nipd FROM lulusan WHERE Nipd=peserta.Nipd) ORDER BY Nama ASC")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Nipd ?>"><?= $row->Nama ?> (<?= $row->Nipd ?>)</option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group mb-2">
            <label class="small text-muted mb-1">Pelatihan</label>
            <input type="text" class="form-control form-control-sm" id="pelatihan" disabled>
          </div>
          <div class="form-group mb-2">
            <label class="small text-muted mb-1">Tgl Lahir</label>
            <input type="text" class="form-control form-control-sm" id="ttl_lulusan" disabled>
          </div>
          <div class="row g-2">
            <div class="col-6 form-group mb-2" id="date-tl">
              <label class="small text-muted mb-1">Tgl Lulus</label>
              <div class="input-group input-group-sm date">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="text" name="tl" class="form-control" id="tl" required>
              </div>
            </div>
            <div class="col-6 form-group mb-2" id="date-tc">
              <label class="small text-muted mb-1">Tgl Cetak</label>
              <div class="input-group input-group-sm date">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="text" name="tc" class="form-control" id="tc" value="<?= date('Y-m-d') ?>" required>
              </div>
            </div>
          </div>
          <div class="form-group mb-2">
            <label class="small text-muted mb-1">Instruktur</label>
            <select class="form-control form-control-sm" name="Instruktur" required>
              <option value="">Pilih Instruktur</option>
              <?php
              $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= $row->NamaInstruktur ?></option>
              <?php } ?>
            </select>
          </div>
          <div id="nilaiContainer" style="display:none">
            <?php for ($i = 1; $i <= 5; $i++) { ?>
            <div class="form-group mb-1" id="nilaiGroup<?= $i ?>">
              <div class="d-flex align-items-center">
                <span class="small" id="labelNilai<?= $i ?>">Unit Kompetensi <?= $i ?></span>
                <select class="form-control form-control-sm ml-auto" style="width:auto;min-width:72px" name="n<?= $i ?>">
                  <option value="">-</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                </select>
              </div>
            </div>
            <?php } ?>
          </div>
      </div>
      <div class="modal-footer pt-2 px-3 pb-3 d-flex flex-nowrap">
        <button type="button" class="btn btn-secondary flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary flex-fill ml-2">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Ubah Lulusan -->
<div class="modal fade" id="modalUbah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-mobile" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Lulusan</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('lulusan/ubah') ?>" method="POST">
          <input type="hidden" name="Id" id="editId">
          <input type="hidden" name="nipd" id="editNipd">
          <div class="form-group mb-2">
            <label class="small text-muted mb-1">Peserta</label>
            <input type="text" class="form-control form-control-sm" id="editNama" disabled>
          </div>
          <div class="form-group mb-2">
            <label class="small text-muted mb-1">Pelatihan</label>
            <input type="text" class="form-control form-control-sm" id="editPelatihan" disabled>
          </div>
          <div class="form-group mb-2">
            <label class="small text-muted mb-1">Tgl Lahir</label>
            <input type="text" class="form-control form-control-sm" id="editTtl" disabled>
          </div>
          <div class="row g-2">
            <div class="col-6 form-group mb-2" id="edit-date-tl">
              <label class="small text-muted mb-1">Tgl Lulus</label>
              <div class="input-group input-group-sm date">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="text" name="tl" class="form-control" id="editTl" required>
              </div>
            </div>
            <div class="col-6 form-group mb-2" id="edit-date-tc">
              <label class="small text-muted mb-1">Tgl Cetak</label>
              <div class="input-group input-group-sm date">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="text" name="tc" class="form-control" id="editTc" required>
              </div>
            </div>
          </div>
          <div class="form-group mb-2">
            <label class="small text-muted mb-1">Instruktur</label>
            <select class="form-control form-control-sm" name="Instruktur" id="editInstruktur" required>
              <option value="">Pilih Instruktur</option>
              <?php
              $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= $row->NamaInstruktur ?></option>
              <?php } ?>
            </select>
          </div>
          <div id="editNilaiContainer" style="display:none">
            <?php for ($i = 1; $i <= 5; $i++) { ?>
            <div class="form-group mb-1" id="editNilaiGroup<?= $i ?>">
              <div class="d-flex align-items-center">
                <span class="small" id="editLabelNilai<?= $i ?>">Unit Kompetensi <?= $i ?></span>
                <select class="form-control form-control-sm ml-auto" style="width:auto;min-width:72px" name="n<?= $i ?>" id="editN<?= $i ?>">
                  <option value="">-</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                </select>
              </div>
            </div>
            <?php } ?>
          </div>
      </div>
      <div class="modal-footer pt-2 px-3 pb-3 d-flex flex-nowrap">
        <button type="button" class="btn btn-secondary flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary flex-fill ml-2">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<style>
@media (max-width: 576px) {
  .modal-fullscreen-mobile {
    margin: 0 !important;
    max-width: 100%;
  }
  .modal-fullscreen-mobile .modal-footer .btn {
    font-size: 0.95rem;
    padding: 0.65rem 0;
    border-radius: 0.5rem;
  }
}
</style>
<script type="text/javascript">
  document.title = "Lulusan <?= $profil[0]->Namalkp?>";
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
<script>
$(document).ready(function() {
  $('#peserta').select2({
    placeholder: 'Cari peserta...',
    width: '100%',
    dropdownParent: $('#modalTambah'),
    language: { noResults: function() { return 'Peserta tidak ditemukan'; } }
  });

  $('#modalTambah').on('shown.bs.modal', function() {
    $('#peserta').val('').trigger('change');
    $('#ttl_lulusan, #pelatihan').val('');
    $('#tl').val('');
    $('[name="Instruktur"]').val('');
    $('#nilaiContainer').hide();
    for (var i = 1; i <= 5; i++) {
      $('#labelNilai' + i).text('Unit Kompetensi ' + i);
      $('[name="n' + i + '"]').val('');
    }
  });

  $('#peserta').on('change', function() {
    var nipd = $(this).val();
    $('#nilaiContainer').hide();
    for (var i = 1; i <= 5; i++) {
      $('#labelNilai' + i).text('Unit Kompetensi ' + i);
      $('[name="n' + i + '"]').val('');
    }
    if (!nipd) {
      $('#ttl_lulusan, #pelatihan, #tl').val('');
      return;
    }
    $.ajax({
      url: '<?= base_url() ?>index.php/pesertas/Nipd',
      method: 'post',
      data: { Nipd: nipd },
      dataType: 'json',
      success: function(res) {
        if (res.length) {
          $('#ttl_lulusan').val(res[0].Ttl);
          $('#pelatihan').val(res[0].Namarombel);
          var showNilai = false;
          for (var i = 1; i <= 5; i++) {
            var uk = res[0]['Uk' + i];
            if (uk && uk !== '-') {
              $('#labelNilai' + i).text(uk);
              $('#nilaiGroup' + i).show();
              showNilai = true;
            } else {
              $('#nilaiGroup' + i).hide();
            }
          }
          if (showNilai) $('#nilaiContainer').show();
        }
      }
    });
    $.ajax({
      url: '<?= base_url() ?>index.php/pesertas/lastPresensi',
      method: 'post',
      data: { Nipd: nipd },
      dataType: 'json',
      success: function(res) {
        if (res.Tgl) {
          var d = new Date(res.Tgl);
          var ds = d.getFullYear() + '-' + String(d.getMonth()+1).padStart(2,'0') + '-' + String(d.getDate()).padStart(2,'0');
          $('#tl').val(ds);
        }
      }
    });
  });

  $('#date-tl .input-group.date, #date-tc .input-group.date').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
    todayBtn: 'linked',
  });

  $(document).on('click', '.btn-edit-lulusan', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#editNilaiContainer').hide();
    for (var i = 1; i <= 5; i++) {
      $('#editLabelNilai' + i).text('Unit Kompetensi ' + i);
      $('#editN' + i).val('');
    }
    $.ajax({
      url: '<?= base_url() ?>index.php/lulusan/getData',
      method: 'post',
      data: { id: id },
      dataType: 'json',
      success: function(res) {
        if (!res || !res.Id) return;
        $('#editId').val(res.Id);
        $('#editNipd').val(res.Nipd);
        $('#editNama').val(res.Nama);
        $('#editPelatihan').val(res.Namarombel);
        $('#editTtl').val(res.Ttl);
        $('#editTl').val(res.Tgllulus);
        $('#editTc').val(res.Tglcetak);
        $('#editInstruktur').val(res.Instruktur);
        var show = false;
        for (var i = 1; i <= 5; i++) {
          var uk = res['Uk' + i];
          if (uk && uk !== '-') {
            $('#editLabelNilai' + i).text(uk);
            $('#editNilaiGroup' + i).show();
            $('#editN' + i).val(res['n' + i]);
            show = true;
          } else {
            $('#editNilaiGroup' + i).hide();
          }
        }
        $('#editNilaiContainer').toggle(show);
        $('#edit-date-tl .input-group.date, #edit-date-tc .input-group.date').datepicker('destroy').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true,
          todayBtn: 'linked',
        });
        $('#modalUbah').modal('show');
      }
    });
  });
});
</script>