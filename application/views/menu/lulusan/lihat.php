<!-- Header -->
<style type="text/css">
    .txtedit {
      display: none;
      width: 100%;
    }
  </style>
<div class="d-sm-flex align-items-center justify-content-between mt-4 mb-2">
  <h1 class="h3 mb-0 text-gray-800 d-none d-sm-block">Lulusan</h1>
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
                <td><?php $nilais=[]; for($i=1;$i<=6;$i++){ $v=trim((string)$tp->{'n'.$i}); if($v!=='') $nilais[]=$v; } echo $nilais?html_escape(implode(', ',$nilais)):''; ?></td>
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
<div class="modal fade lulusan-app-modal" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content lulusan-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-graduation-cap"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="modalTambahTitle">Tambah Lulusan</h5>
            <div class="presensi-subtitle">Catat kelulusan peserta kursus</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form action="<?= base_url('lulusan/tambah') ?>" method="POST" id="formTambahLulusan" class="modal-body px-3 px-sm-4 py-3">
          <div class="form-group mb-3">
            <label class="field-label" for="peserta">Peserta <span class="font-weight-normal text-muted">(sudah lulus, belum tercatat)</span></label>
            <select class="form-control" id="peserta" name="nipd" required>
              <option value=""></option>
              <?php
              $data = $this->db->query("SELECT Nipd,Nama FROM peserta WHERE Status=2 AND NOT EXISTS (SELECT Nipd FROM lulusan WHERE Nipd=peserta.Nipd) ORDER BY Nama ASC")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Nipd ?>"><?= $row->Nama ?> (<?= $row->Nipd ?>)</option>
              <?php } ?>
            </select>
          </div>

          <div class="form-row">
            <div class="form-group col-12 col-sm-6 mb-3">
              <label class="field-label" for="pelatihan">Pelatihan</label>
              <input type="text" class="form-control presensi-input input-info" id="pelatihan" disabled>
            </div>
            <div class="form-group col-12 col-sm-6 mb-3">
              <label class="field-label" for="ttl_lulusan">Tgl Lahir</label>
              <input type="text" class="form-control presensi-input input-info" id="ttl_lulusan" disabled>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-6 mb-3" id="date-tl">
              <label class="field-label" for="tl">Tgl Lulus</label>
              <div class="input-group date">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
                </div>
                <input type="text" name="tl" class="form-control presensi-input" id="tl" required readonly autocomplete="off">
              </div>
            </div>
            <div class="form-group col-6 mb-3" id="date-tc">
              <label class="field-label" for="tc">Tgl Cetak</label>
              <div class="input-group date">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
                </div>
                <input type="text" name="tc" class="form-control presensi-input" id="tc" value="<?= date('Y-m-d') ?>" required readonly autocomplete="off">
              </div>
            </div>
          </div>

          <div class="form-group mb-3">
            <label class="field-label" for="instrukturLulusan">Instruktur</label>
            <select class="form-control presensi-input" id="instrukturLulusan" name="Instruktur" required>
              <option value="">Pilih instruktur</option>
              <?php
              $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= $row->NamaInstruktur ?></option>
              <?php } ?>
            </select>
          </div>

          <div id="nilaiContainer" style="display:none">
            <label class="field-label">Nilai Kompetensi</label>
            <?php for ($i = 1; $i <= 6; $i++) { ?>
            <div class="form-group mb-2" id="nilaiGroup<?= $i ?>">
              <div class="d-flex align-items-center justify-content-between">
                <span class="nilai-label" id="labelNilai<?= $i ?>">Unit Kompetensi <?= $i ?></span>
                <select class="form-control presensi-input nilai-select" name="n<?= $i ?>">
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
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formTambahLulusan" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ubah Lulusan -->
<div class="modal fade lulusan-app-modal" id="modalUbah" tabindex="-1" role="dialog" aria-labelledby="modalUbahTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-edit"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="modalUbahTitle">Ubah Lulusan</h5>
            <div class="presensi-subtitle">Perbarui data kelulusan peserta</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form action="<?= base_url('lulusan/ubah') ?>" method="POST" id="formUbahLulusan" class="modal-body px-3 px-sm-4 py-3">
        <input type="hidden" name="Id" id="editId">
          <input type="hidden" name="nipd" id="editNipd">
          <div class="form-group mb-3">
            <label class="field-label" for="editNama">Peserta</label>
            <input type="text" class="form-control presensi-input input-info" id="editNama" disabled>
          </div>
          <div class="form-row">
            <div class="form-group col-12 col-sm-6 mb-3">
              <label class="field-label" for="editPelatihan">Pelatihan</label>
              <input type="text" class="form-control presensi-input input-info" id="editPelatihan" disabled>
            </div>
            <div class="form-group col-12 col-sm-6 mb-3">
              <label class="field-label" for="editTtl">Tgl Lahir</label>
              <input type="text" class="form-control presensi-input input-info" id="editTtl" disabled>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-6 mb-3" id="edit-date-tl">
              <label class="field-label" for="editTl">Tgl Lulus</label>
              <div class="input-group date">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
                </div>
                <input type="text" name="tl" class="form-control presensi-input" id="editTl" required readonly autocomplete="off">
              </div>
            </div>
            <div class="form-group col-6 mb-3" id="edit-date-tc">
              <label class="field-label" for="editTc">Tgl Cetak</label>
              <div class="input-group date">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
                </div>
                <input type="text" name="tc" class="form-control presensi-input" id="editTc" required readonly autocomplete="off">
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <label class="field-label" for="editInstruktur">Instruktur</label>
            <select class="form-control presensi-input" id="editInstruktur" name="Instruktur" required>
              <option value="">Pilih instruktur</option>
              <?php
              $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= $row->NamaInstruktur ?></option>
              <?php } ?>
            </select>
          </div>
          <div id="editNilaiContainer" style="display:none">
            <label class="field-label">Nilai Kompetensi</label>
            <?php for ($i = 1; $i <= 6; $i++) { ?>
            <div class="form-group mb-2" id="editNilaiGroup<?= $i ?>">
              <div class="d-flex align-items-center justify-content-between">
                <span class="nilai-label" id="editLabelNilai<?= $i ?>">Unit Kompetensi <?= $i ?></span>
                <select class="form-control presensi-input nilai-select" name="n<?= $i ?>" id="editN<?= $i ?>">
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
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formUbahLulusan" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<style>
/* ===== Modal Tambah & Ubah Lulusan: gaya aplikasi mobile ===== */
.lulusan-app-modal .modal-content {
  border: 0;
  border-radius: .75rem;
  max-height: calc(100vh - 3.5rem);
  box-shadow: 0 20px 60px rgba(15, 23, 42, .22);
}
@supports (height: 100dvh) {
  .lulusan-app-modal .modal-content { max-height: calc(100dvh - 3.5rem); }
}
.lulusan-app-modal .modal-header,
.lulusan-app-modal .modal-footer { flex-shrink: 0; }
.lulusan-app-modal .modal-body {
  flex: 1 1 auto;
  min-height: 0;
  overflow-y: auto;
  overscroll-behavior: contain;
}
.minw-0 { min-width: 0; }
.presensi-icon {
  width: 2.5rem; height: 2.5rem;
  border-radius: .6rem;
  display: inline-flex; align-items: center; justify-content: center;
  background: rgba(37, 99, 235, .1);
  color: #2563eb;
  font-size: 1.05rem;
  flex-shrink: 0;
}
.presensi-subtitle { font-size: .8rem; color: #6b7280; margin-top: .1rem; }
.presensi-close {
  width: 2.5rem; height: 2.5rem;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.35rem;
  color: #6b7280;
  transition: background-color .15s, color .15s;
}
.presensi-close:hover { background: #f1f5f9; color: #111827; }
.field-label {
  font-size: .85rem; font-weight: 600; color: #374151;
  margin-bottom: .35rem; display: block;
}
.presensi-input { min-height: 44px; font-size: 16px; }
.input-info {
  background: #f8fafc !important;
  border-color: #e2e8f0;
  color: #334155;
}
#instrukturLulusan { font-size: 16px; }
.nilai-label {
  font-size: .85rem; font-weight: 500; color: #374151;
  padding-right: .75rem;
}
.nilai-select { width: auto; min-width: 88px; }

/* Input & select outlined, sudut lembut */
.lulusan-app-modal .form-control { border-radius: .6rem; }
.lulusan-app-modal .input-group-text {
  border-radius: .6rem 0 0 .6rem;
  border-right: 0;
}
.lulusan-app-modal .input-group > .form-control {
  border-radius: 0 .6rem .6rem 0;
}
.lulusan-app-modal .form-control:focus {
  border-color: #93b4f5;
  box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .15);
}

/* Select2 di dalam modal */
.lulusan-app-modal .select2-container--default .select2-selection--single {
  min-height: 44px;
  padding: .45rem .75rem;
  border-color: #ced4da;
  border-radius: .6rem;
  font-size: 16px;
  display: flex; align-items: center;
}
.lulusan-app-modal .select2-container--default .select2-selection--single .select2-selection__arrow { height: 100%; }
.lulusan-app-modal .select2-container--default.select2-container--focus .select2-selection--single {
  border-color: #93b4f5;
  box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .18);
}

.modal-footer .presensi-btn {
  min-height: 48px;
  border-radius: .55rem;
  font-weight: 600;
}

/* Tampilan aplikasi mobile di layar kecil */
@media (max-width: 575.98px) {
  .lulusan-app-modal .modal-dialog {
    margin: 0; max-width: 100%;
    height: 100%;
    overscroll-behavior: contain;
  }
  /* Kunci tinggi ke viewport terkecil agar layout stabil saat URL bar iOS turun/naik */
  @supports (height: 100svh) {
    .lulusan-app-modal .modal-dialog { height: 100svh; }
  }
  .lulusan-app-modal .modal-content {
    height: 100%;
    max-height: none;
    border-radius: 1.25rem 1.25rem 0 0;
    box-shadow: 0 -8px 40px rgba(15, 23, 42, .18);
    overscroll-behavior: contain;
  }
  .lulusan-app-modal .modal-header {
    justify-content: flex-start;
    padding: .85rem 1rem .85rem .5rem;
    border-bottom: 1px solid #eef0f4;
  }
  /* Reset margin auto dari BS4 (.modal-header .close) agar panah tidak terdorong ke tengah */
  .lulusan-app-modal .presensi-close {
    order: -1;
    margin: 0 .35rem 0 0;
    color: #2563eb;
    flex-shrink: 0;
  }
  .lulusan-app-modal .presensi-close:hover { background: rgba(37, 99, 235, .08); color: #2563eb; }
  .lulusan-app-modal .presensi-title-wrap { margin-left: .15rem !important; }
  .lulusan-app-modal .modal-footer {
    flex-direction: column-reverse;
    align-items: stretch;
    padding: .65rem 1rem calc(.75rem + env(safe-area-inset-bottom, 0px));
  }
  .lulusan-app-modal .modal-footer .presensi-btn {
    width: 100%;
    margin-left: 0 !important;
    border-radius: 9999px;
  }
  .lulusan-app-modal .modal-footer .btn-secondary {
    min-height: 42px;
    background: rgba(37, 99, 235, .07);
    border-color: transparent;
    color: #2563eb;
  }
  .lulusan-app-modal .modal-footer .btn-secondary:hover,
  .lulusan-app-modal .modal-footer .btn-secondary:focus {
    background: rgba(37, 99, 235, .14);
    border-color: transparent;
    color: #1d4ed8;
  }
}
/* Slide-up halus saat sheet muncul */
@media (max-width: 575.98px) and (prefers-reduced-motion: no-preference) {
  .lulusan-app-modal.fade .modal-dialog { transform: translateY(28px); }
  .lulusan-app-modal.show .modal-dialog { transform: none; }
}
@media (min-width: 576px) {
  .lulusan-app-modal .modal-dialog { max-width: 540px; }
}
@media (prefers-reduced-motion: reduce) {
  .presensi-close { transition: none; }
}
/* Kunci scroll halaman belakang saat modal terbuka (cegah lompatan scroll iOS) */
html.app-modal-open, html.app-modal-open body {
  overflow: hidden !important;
  overscroll-behavior: none;
}
</style>
<script>
if (window.jQuery) {
  window.jQuery(document)
    .on('show.bs.modal', '.lulusan-app-modal', function () {
      document.documentElement.classList.add('app-modal-open');
    });
  window.jQuery(document).on('hidden.bs.modal', function (e) {
    if (!document.querySelector('.modal.show')) {
      document.documentElement.classList.remove('app-modal-open');
    }
  });
}
</script>
<script>
(function () {
  [['date-tl', 'tl'], ['date-tc', 'tc'], ['edit-date-tl', 'editTl'], ['edit-date-tc', 'editTc']].forEach(function (p) {
    var icon = document.querySelector('#' + p[0] + ' .input-group-text');
    if (icon) {
      icon.addEventListener('click', function () {
        document.getElementById(p[1]).focus();
      });
    }
  });
})();
</script>
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
    for (var i = 1; i <= 6; i++) {
      $('#labelNilai' + i).text('Unit Kompetensi ' + i);
      $('[name="n' + i + '"]').val('');
    }
  });

  $('#peserta').on('change', function() {
    var nipd = $(this).val();
    $('#nilaiContainer').hide();
    for (var i = 1; i <= 6; i++) {
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
          for (var i = 1; i <= 6; i++) {
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
    for (var i = 1; i <= 6; i++) {
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
        for (var i = 1; i <= 6; i++) {
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
