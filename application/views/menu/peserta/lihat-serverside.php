<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mt-4 mb-2">
  <h1 class="h3 mb-0 text-gray-800 d-none d-sm-block">Peserta</h1>
  <ol class="breadcrumb mb-0">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Peserta</li>
  </ol>
</div>
<!-- Content -->
<?php if (!empty($alert)): ?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <h6><i class="fas fa-exclamation-triangle"></i><b> Informasi</b></h6>
  <strong><?= $alert ?></strong>
</div>
<?php endif; ?>
<div class="row">
  <!-- DataTable with Hover -->
  <!-- <div class="col-lg-12"> -->
    <div class="card mb-4">
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="tabelpeserta-tes">
          <thead class="thead-light">
            <tr>
              <th>Status</th>
              <th>NIPD</th>
              <!-- <th>No KK / NIK</th> -->
              <th>Nama Peserta</th>
              <th>Jenis Kelamin</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kursus / Kelas</th>
              <th>Tanggal Masuk</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
<!-- </div> -->

<button class="fab-presensi" data-toggle="modal" data-target="#tambahPeserta" title="Tambah Peserta">
  <i class="fas fa-plus"></i>
</button>

<!-- Modal Tambah Peserta -->
<div class="modal fade peserta-app-modal" id="tambahPeserta" tabindex="-1" role="dialog" aria-labelledby="tambahPesertaTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-user-plus"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="tambahPesertaTitle">Tambah Peserta</h5>
            <div class="presensi-subtitle">Daftarkan peserta kursus baru</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form action="<?= base_url('peserta/tambah') ?>" method="POST" id="formTambahPesertaBaru" class="modal-body px-3 px-sm-4 py-3">
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="tpNipd">Nomor Induk</label>
            <input type="text" class="form-control presensi-input" id="tpNipd" name="Nipd" maxlength="20" required>
          </div>
          <div class="form-group col-6 mb-3">
            <div class="field-label" id="tpStatusLabel">Status</div>
            <div class="seg-group" role="radiogroup" aria-labelledby="tpStatusLabel">
              <input type="radio" name="Status" id="tpSt0" value="0">
              <label for="tpSt0">Nonaktif</label>
              <input type="radio" name="Status" id="tpSt1" value="1" checked>
              <label for="tpSt1">Aktif</label>
              <input type="radio" name="Status" id="tpSt2" value="2">
              <label for="tpSt2">Lulus</label>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="tpNokk">No Kartu Keluarga</label>
            <input type="text" class="form-control presensi-input" id="tpNokk" name="Nokk" maxlength="30" value="-">
          </div>
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="tpNik">No Induk Keluarga</label>
            <input type="text" class="form-control presensi-input" id="tpNik" name="Nik" maxlength="30" value="-">
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="tpNama">Nama Peserta</label>
          <input type="text" class="form-control presensi-input" id="tpNama" name="Nama" maxlength="50" required>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="tpTtl">Tempat, Tanggal Lahir</label>
          <input type="text" class="form-control presensi-input" id="tpTtl" name="Tgl" maxlength="50" placeholder="Contoh: Bandung, 12 Mei 2005" required>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="tpJk">Jenis Kelamin</label>
            <select class="form-control presensi-input" id="tpJk" name="Jk" required>
              <option value="" selected disabled>Pilih kelamin</option>
              <option value="Laki - Laki">Laki - Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="tpJenis">Jenis Kursus</label>
            <select class="form-control presensi-input" id="tpJenis" name="Jenis" required>
              <option value="" selected disabled>Pilih kursus</option>
              <?php
              $data = $this->db->query("SELECT * FROM rombel")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= $row->Namarombel ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="tpKls">Kelas</label>
            <select class="form-control presensi-input" id="tpKls" name="Kls" required>
              <option value="" selected disabled>Pilih kelas</option>
              <?php foreach ($rombel as $row) { ?>
                <option value="<?= $row->Kelas ?>"><?= $row->Namarombel . ' - ' . $row->Kelas ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-6 mb-3" id="tp-date-masuk">
            <label class="field-label" for="tpTglmasuk">Tanggal Masuk</label>
            <div class="input-group date">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
              </div>
              <input type="text" name="Tglmasuk" class="form-control presensi-input" id="tpTglmasuk" required readonly autocomplete="off">
            </div>
          </div>
        </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formTambahPesertaBaru" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Peserta -->
<div class="modal fade peserta-app-modal" id="modalEditPeserta" tabindex="-1" role="dialog" aria-labelledby="modalEditPesertaTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-user-edit"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="modalEditPesertaTitle">Ubah Peserta</h5>
            <div class="presensi-subtitle">Perbarui data peserta kursus</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form action="<?= base_url('peserta/ubah') ?>" method="POST" id="formUbahPeserta" class="modal-body px-3 px-sm-4 py-3">
        <input type="hidden" name="Id" id="epId">
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="epNipd">Nomor Induk</label>
            <input type="text" class="form-control presensi-input" id="epNipd" name="Nipd" maxlength="20" required>
          </div>
          <div class="form-group col-6 mb-3">
            <div class="field-label" id="epStatusLabel">Status</div>
            <div class="seg-group" role="radiogroup" aria-labelledby="epStatusLabel">
              <input type="radio" name="Status" id="epSt0" value="0">
              <label for="epSt0">Nonaktif</label>
              <input type="radio" name="Status" id="epSt1" value="1">
              <label for="epSt1">Aktif</label>
              <input type="radio" name="Status" id="epSt2" value="2">
              <label for="epSt2">Lulus</label>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="epNokk">No Kartu Keluarga</label>
            <input type="text" class="form-control presensi-input" id="epNokk" name="Nokk" maxlength="30" required>
          </div>
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="epNik">No Induk Keluarga</label>
            <input type="text" class="form-control presensi-input" id="epNik" name="Nik" maxlength="30" required>
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="epNama">Nama Peserta</label>
          <input type="text" class="form-control presensi-input" id="epNama" name="Nama" maxlength="50" required>
        </div>
        <div class="form-group mb-3">
          <label class="field-label" for="epTtl">Tempat, Tanggal Lahir</label>
          <input type="text" class="form-control presensi-input" id="epTtl" name="Tgl" maxlength="50" required>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="epJk">Jenis Kelamin</label>
            <select class="form-control presensi-input" id="epJk" name="Jk" required>
              <option value="Laki - Laki">Laki - Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="epJenis">Jenis Kursus</label>
            <select class="form-control presensi-input" id="epJenis" name="Jenis" required>
              <?php
              $data = $this->db->query("SELECT * FROM rombel")->result();
              foreach ($data as $row) { ?>
                <option value="<?= $row->Id ?>"><?= $row->Namarombel ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="epKls">Kelas</label>
            <select class="form-control presensi-input" id="epKls" name="Kls" required>
              <?php foreach ($rombel as $row) { ?>
                <option value="<?= $row->Kelas ?>"><?= $row->Namarombel . ' - ' . $row->Kelas ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-6 mb-3" id="ep-date-masuk">
            <label class="field-label" for="epTglmasuk">Tanggal Masuk</label>
            <div class="input-group date">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
              </div>
              <input type="text" name="Tglmasuk" class="form-control presensi-input" id="epTglmasuk" required readonly autocomplete="off">
            </div>
          </div>
        </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formUbahPeserta" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<style>
/* ===== Modal Tambah & Ubah Peserta: gaya aplikasi mobile ===== */
.peserta-app-modal .modal-content {
  border: 0;
  border-radius: .75rem;
  max-height: calc(100vh - 3.5rem);
  box-shadow: 0 20px 60px rgba(15, 23, 42, .22);
}
@supports (height: 100dvh) {
  .peserta-app-modal .modal-content { max-height: calc(100dvh - 3.5rem); }
}
.peserta-app-modal .modal-header,
.peserta-app-modal .modal-footer { flex-shrink: 0; }
.peserta-app-modal .modal-body {
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
.peserta-app-modal .presensi-close:hover { background: #f1f5f9; color: #111827; }
.field-label {
  font-size: .85rem; font-weight: 600; color: #374151;
  margin-bottom: .35rem; display: block;
}
.peserta-app-modal .form-control { border-radius: .6rem; }
.peserta-app-modal .input-group-text {
  border-radius: .6rem 0 0 .6rem;
  border-right: 0;
}
.peserta-app-modal .input-group > .form-control {
  border-radius: 0 .6rem .6rem 0;
}
.peserta-app-modal .form-control:focus {
  border-color: #93b4f5;
  box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .15);
}
.presensi-input { min-height: 44px; font-size: 16px; }
.modal-footer .presensi-btn {
  min-height: 48px;
  border-radius: .55rem;
  font-weight: 600;
}

/* Segmented control (Status) */
.seg-group {
  display: flex;
  background: #eef1f6;
  border-radius: .65rem;
  padding: .25rem;
  min-height: 44px;
}
.seg-group input[type="radio"] {
  position: absolute;
  opacity: 0;
  pointer-events: none;
}
.seg-group label {
  flex: 1 1 0;
  min-width: 0;
  min-height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: .15rem .25rem;
  margin: 0;
  border-radius: .5rem;
  font-size: .85rem;
  font-weight: 600;
  color: #6b7280;
  cursor: pointer;
  text-align: center;
  transition: background-color .15s, color .15s, box-shadow .15s;
}
.seg-group label:hover { color: #374151; }
.seg-group input:checked + label {
  background: #fff;
  color: #2563eb;
  box-shadow: 0 1px 4px rgba(15, 23, 42, .18);
}
.seg-group input:focus-visible + label {
  box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .25);
}

/* Tampilan aplikasi mobile di layar kecil */
@media (max-width: 575.98px) {
  .peserta-app-modal .modal-dialog {
    margin: 0; max-width: 100%;
    height: 100%;
    overscroll-behavior: contain;
  }
  @supports (height: 100svh) {
    .peserta-app-modal .modal-dialog { height: 100svh; }
  }
  .peserta-app-modal .modal-content {
    height: 100%;
    max-height: none;
    border-radius: 1.25rem 1.25rem 0 0;
    box-shadow: 0 -8px 40px rgba(15, 23, 42, .18);
    overscroll-behavior: contain;
  }
  .peserta-app-modal .modal-header {
    justify-content: flex-start;
    padding: .85rem 1rem .85rem .5rem;
    border-bottom: 1px solid #eef0f4;
  }
  .peserta-app-modal .presensi-close {
    order: -1;
    margin: 0 .35rem 0 0;
    color: #2563eb;
    flex-shrink: 0;
  }
  .peserta-app-modal .presensi-close:hover { background: rgba(37, 99, 235, .08); color: #2563eb; }
  .peserta-app-modal .presensi-title-wrap { margin-left: .15rem !important; }
  .peserta-app-modal .modal-footer {
    flex-direction: column-reverse;
    align-items: stretch;
    padding: .65rem 1rem calc(.75rem + env(safe-area-inset-bottom, 0px));
  }
  .peserta-app-modal .modal-footer .presensi-btn {
    width: 100%;
    margin-left: 0 !important;
    border-radius: 9999px;
  }
  .peserta-app-modal .modal-footer .btn-secondary {
    min-height: 42px;
    background: rgba(37, 99, 235, .07);
    border-color: transparent;
    color: #2563eb;
  }
  .peserta-app-modal .modal-footer .btn-secondary:hover,
  .peserta-app-modal .modal-footer .btn-secondary:focus {
    background: rgba(37, 99, 235, .14);
    border-color: transparent;
    color: #1d4ed8;
  }
}
@media (max-width: 575.98px) and (prefers-reduced-motion: no-preference) {
  .peserta-app-modal.fade .modal-dialog { transform: translateY(28px); }
  .peserta-app-modal.show .modal-dialog { transform: none; }
}
@media (min-width: 576px) {
  .peserta-app-modal .modal-dialog { max-width: 540px; }
}
@media (prefers-reduced-motion: reduce) {
  .presensi-close { transition: none; }
}
html.app-modal-open, html.app-modal-open body {
  overflow: hidden !important;
  overscroll-behavior: none;
}
</style>
<script>
if (window.jQuery) {
  window.jQuery(document)
    .on('show.bs.modal', '.peserta-app-modal', function () {
      document.documentElement.classList.add('app-modal-open');
    });
  window.jQuery(document).on('hidden.bs.modal', function () {
    if (!document.querySelector('.modal.show')) {
      document.documentElement.classList.remove('app-modal-open');
    }
  });
}
</script>
    <script type="text/javascript">
      document.title = "Peserta Didik <?= $profil[0]->Namalkp ?>";
    </script>

    <script>
      var tabel = null;
      
      // Fungsi untuk memperbarui parameter URL
      function updateUrlParameter(url, param, paramVal) {
        var newUrl = new URL(url);
        newUrl.searchParams.set(param, paramVal);
        return newUrl.toString();
      }
      $(document).ready(function() {
        // Ambil parameter dari URL
        var urlParams = new URLSearchParams(window.location.search);
        var page = urlParams.get('page') || 1; // Halaman default 1
        var search = urlParams.get('search') || ''; // Pencarian default kosong

        tabel = $('#tabelpeserta-tes').DataTable({
          "processing": true,
          "responsive": true,
          "serverSide": true,
          "ordering": true,
          "order": [
            [1, 'desc']
          ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
          "ajax": {
            "url": "<?= base_url('cek/view2'); ?>",
            "type": "POST"
          },
          "deferRender": true,
          "aLengthMenu": [
            [10, 50, 100],
            [10, 50, 100]
          ],
          "columns": [{
              "data": "Status"
            },
            {
              "data": "Nipd"
            },
            {
              "data": "Nama"
            },
            {
              "data": "Kelamin"
            },
            {
              "data": "Ttl"
            },
            {
              "data": "Namarombel"
            },
            {
              "data": "Tglmasuk"
            },
            {
              "data": "Idp"
            }
          ],
          columnDefs: [{
            targets: 0,
            orderable: !1,
            render: function(e, a, t, r) {
              if (t.Status == '0') {
                t = '<span class="badge bg-danger text-white">Nonaktif</span>'
              } else if (t.Status == '1') {
                t = '<span class="badge bg-success text-white">Aktif</span>'
              } else {
                t = '<span class="badge bg-secondary text-white">Lulus</span>'
              };
              return t
            }
          }, {
            className: "t",
            targets: 2,
            render: function(e, a, t, r) {
              return '<a class="btn" style="width:max-content" href="' + appPath + 'presensi/peserta?Id=' + t.Idp + '">' + t.Nama + '</a>'
            }
          }, {
            className: "",
            targets: -2,
            render: function(e, a, t, r) {
              var d = new Date(t.Tglmasuk);
              if (isNaN(d.getTime()) || !t.Tglmasuk || t.Tglmasuk === '0000-00-00') return '-';
              return d.toISOString().slice(0, 10).split("-").reverse().join("/");
            }
          }, {
            className: "noExport",
            targets: -1,
            render: function(e, a, t, r) {
              return '<div class="btn-group btn-group-toggle action-group"><a class="btn btn-warning btn-sm flex-fill text-white btn-edit-peserta" href="#" data-id="' + t.Idp + '" title="Klik untuk merubah data.">' +
                '<i class="fas fa-pen-alt"></i><span class="btn-text"> Edit</span></a><a class="btn btn-danger btn-sm flex-fill text-white" href="#" data-toggle="modal" data-target="#deleteuser' + t.Idp + '" title="Klik untuk menghapus data.">' +
                '<i class="fas fa-trash-alt"></i><span class="btn-text"> Hapus</span></a></div>' +
                '<div class="example-modal"><div id="deleteuser' + t.Idp + '" class="modal fade" role="dialog" style="display:none;">' +
                '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h3 class="modal-title">Konfirmasi Delete Data</h3>' +
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' +
                '<div class="modal-body"><h6 align="center">Apakah anda yakin ingin menghapus data ' + t.Nama + '<strong><span class="grt"></span></strong> ?</h6></div>' +
                '<div class="modal-footer"><a href="' + appPath + 'peserta/hapus/' + t.Idp + '" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a></div> </div> </div> </div> </div>'
            }
          }, ],
          dom: 'Bfrtl<"d-flex justify-content-between"<"p-1">p>',
          "search": {
            "search": ""
          },
          language: {
            searchPlaceholder: "Pencarian",
            search: ""
          },
          buttons: [{
              text: '<i class="fas fa-plus"></i> Tambah',
              className: 'btn btn-info',
              action: function() {
                $("#tambahPeserta").modal();
              }
            },
            {
              extend: 'excelHtml5',
              text: '<i class="fas fa-file-excel"></i> Export Excel',
              className: 'btn btn-success',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
              }
            },
            {
              extend: 'pdfHtml5',
              text: '<i class="fas fa-file-pdf"></i> Export PDF',
              className: 'btn btn-danger',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
              }
            },
            {
              extend: 'print',
              text: '<i class="fas fa-print"></i> Print',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
              }
            }
          ]
        });
        tabel.on('page.dt', function() {
        var pageInfo = tabel.page.info();
        var currentPage = pageInfo.page + 1; // Halaman saat ini (1-indexed)
        var searchValue = tabel.search(); // Nilai pencarian
  
        // Update URL
        var newUrl = updateUrlParameter(window.location.href, 'page', currentPage);
        newUrl = updateUrlParameter(newUrl, 'search', searchValue);
        window.history.replaceState(null, '', newUrl);
      });
  
      tabel.on('search.dt', function() {
        var pageInfo = tabel.page.info();
        var currentPage = pageInfo.page + 1; // Halaman saat ini (1-indexed)

        // Update URL
        var newUrl = updateUrlParameter(window.location.href, 'page', currentPage);
        newUrl = updateUrlParameter(newUrl, 'search', tabel.search());
        window.history.replaceState(null, '', newUrl);
      });
      });
    </script>

    <script>
      $(document).ready(function() {
        // Datepicker Tanggal Masuk (tambah & ubah)
        $('#tp-date-masuk .input-group.date, #ep-date-masuk .input-group.date').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true,
          todayBtn: 'linked'
        });

        // Klik ikon kalender => fokus ke input
        [['tp-date-masuk', 'tpTglmasuk'], ['ep-date-masuk', 'epTglmasuk']].forEach(function(pair) {
          var icon = document.querySelector('#' + pair[0] + ' .input-group-text');
          if (icon) {
            icon.addEventListener('click', function() {
              document.getElementById(pair[1]).focus();
            });
          }
        });

        // Tombol edit di tabel => buka modal ubah tanpa reload
        $('#tabelpeserta-tes tbody').on('click', '.btn-edit-peserta', function(e) {
          e.preventDefault();
          if (!window.tabel) return;
          var id = String($(this).data('id'));
          var rows = tabel.rows().data().toArray();
          var r = null;
          for (var i = 0; i < rows.length; i++) {
            if (String(rows[i].Idp) === id) { r = rows[i]; break; }
          }
          if (!r) return;
          $('#epId').val(r.Idp);
          $('#epNipd').val(r.Nipd);
          $('#formUbahPeserta input[name="Status"]').prop('checked', false);
          $('#formUbahPeserta input[name="Status"][value="' + String(r.Status) + '"]').prop('checked', true);
          $('#epNokk').val(r.Nokk || '-');
          $('#epNik').val(r.Nik || '-');
          $('#epNama').val(r.Nama);
          $('#epJk').val(r.Kelamin);
          $('#epTtl').val(r.Ttl);
          $('#epJenis').val(String(r.Jeniskursus));
          $('#epKls').val(r.Kelas);
          $('#epTglmasuk').val((r.Tglmasuk || '').substring(0, 10));
          if ($('#epTglmasuk').data('datepicker')) {
            $('#epTglmasuk').datepicker('update');
          }
          $('#modalEditPeserta').modal('show');
        });
      });
    </script>