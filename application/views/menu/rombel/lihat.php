<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mt-4 mb-2">
  <h1 class="h3 mb-0 text-gray-800 d-none d-sm-block">Program Pelatihan</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Program Pelatihan</li>
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
                <td><?= $tp->Namarombel ?></td>
                <td><?= $tp->Kelas ?></td>
                <td><?= $tp->Jumlahpeserta ?></td>
                <td><?= $tp->Ruangan ?></td>
                <td>
                  <div class="btn-group btn-group-toggle action-group">
                    <a class="btn btn-warning btn-sm flex-fill text-white" href="#" data-toggle="modal" data-target="#modalEditRombel"
                      data-id="<?= $tp->Id ?>"
                      data-nm="<?= htmlspecialchars($tp->Namarombel, ENT_QUOTES) ?>"
                      data-kls="<?= htmlspecialchars($tp->Kelas, ENT_QUOTES) ?>"
                      data-jml="<?= htmlspecialchars($tp->Jumlahpeserta, ENT_QUOTES) ?>"
                      data-rg="<?= htmlspecialchars($tp->Ruangan, ENT_QUOTES) ?>"
                      title="Klik untuk merubah data.">
                      <i class="fas fa-pen-alt"></i><span class="btn-text"> Edit</span>
                    </a>
                    <a class="btn btn-danger btn-sm flex-fill text-white" href="#" data-toggle="modal" data-target="#deleteuser<?= $tp->Id; ?>" title="Klik untuk menghapus data.">
                      <i class="fas fa-trash-alt"></i><span class="btn-text"> Hapus</span>
                    </a>
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

<button class="fab-presensi" data-toggle="modal" data-target="#tambahRombel" title="Tambah Program Pelatihan">
  <i class="fas fa-plus"></i>
</button>

<!-- Modal Tambah Rombel -->
<div class="modal fade rombel-app-modal" id="tambahRombel" tabindex="-1" role="dialog" aria-labelledby="tambahRombelTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-chalkboard"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="tambahRombelTitle">Tambah Program</h5>
            <div class="presensi-subtitle">Daftarkan jenis kursus baru</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form action="<?= base_url('rombel/tambah') ?>" method="POST" id="formTambahRombel" class="modal-body px-3 px-sm-4 py-3">
        <div class="form-group mb-3">
          <label class="field-label" for="trNm">Jenis Kursus</label>
          <input type="text" class="form-control presensi-input" id="trNm" name="nm" maxlength="30" required>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="trKls">Kelas</label>
            <input type="text" class="form-control presensi-input" id="trKls" name="kls" maxlength="50" required>
          </div>
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="trJml">Jumlah Peserta</label>
            <input type="number" class="form-control presensi-input" id="trJml" name="jml" min="0" required>
          </div>
        </div>
        <div class="form-group mb-1">
          <label class="field-label" for="trRg">Ruangan</label>
          <input type="text" class="form-control presensi-input" id="trRg" name="rg" maxlength="20" required>
        </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formTambahRombel" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Rombel -->
<div class="modal fade rombel-app-modal" id="modalEditRombel" tabindex="-1" role="dialog" aria-labelledby="modalEditRombelTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center minw-0">
          <span class="presensi-icon d-none d-sm-inline-flex"><i class="fas fa-edit"></i></span>
          <div class="ml-3 minw-0 presensi-title-wrap">
            <h5 class="modal-title mb-0" id="modalEditRombelTitle">Ubah Program</h5>
            <div class="presensi-subtitle">Perbarui data program pelatihan</div>
          </div>
        </div>
        <button type="button" class="close presensi-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form action="<?= base_url('rombel/ubah') ?>" method="POST" id="formUbahRombel" class="modal-body px-3 px-sm-4 py-3">
        <input type="hidden" name="Id" id="erId">
        <div class="form-group mb-3">
          <label class="field-label" for="erNm">Jenis Kursus</label>
          <input type="text" class="form-control presensi-input" id="erNm" name="nm" maxlength="30" required>
        </div>
        <div class="form-row">
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="erKls">Kelas</label>
            <input type="text" class="form-control presensi-input" id="erKls" name="kls" maxlength="50" required>
          </div>
          <div class="form-group col-6 mb-3">
            <label class="field-label" for="erJml">Jumlah Peserta</label>
            <input type="number" class="form-control presensi-input" id="erJml" name="jml" min="0" required>
          </div>
        </div>
        <div class="form-group mb-1">
          <label class="field-label" for="erRg">Ruangan</label>
          <input type="text" class="form-control presensi-input" id="erRg" name="rg" maxlength="20" required>
        </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary presensi-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formUbahRombel" class="btn btn-primary presensi-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<style>
/* ===== Modal Tambah & Ubah Rombel: gaya aplikasi mobile ===== */
.rombel-app-modal .modal-content {
  border: 0;
  border-radius: .75rem;
  max-height: calc(100vh - 3.5rem);
  box-shadow: 0 20px 60px rgba(15, 23, 42, .22);
}
@supports (height: 100dvh) {
  .rombel-app-modal .modal-content { max-height: calc(100dvh - 3.5rem); }
}
.rombel-app-modal .modal-header,
.rombel-app-modal .modal-footer { flex-shrink: 0; }
.rombel-app-modal .modal-body {
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
.rombel-app-modal .presensi-close:hover { background: #f1f5f9; color: #111827; }
.field-label {
  font-size: .85rem; font-weight: 600; color: #374151;
  margin-bottom: .35rem; display: block;
}
.rombel-app-modal .form-control { border-radius: .6rem; }
.rombel-app-modal .form-control:focus {
  border-color: #93b4f5;
  box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .15);
}
.presensi-input { min-height: 44px; font-size: 16px; }
.modal-footer .presensi-btn {
  min-height: 48px;
  border-radius: .55rem;
  font-weight: 600;
}

/* Tampilan aplikasi mobile di layar kecil */
@media (max-width: 575.98px) {
  .rombel-app-modal .modal-dialog {
    margin: 0; max-width: 100%;
    height: 100%;
    overscroll-behavior: contain;
  }
  @supports (height: 100svh) {
    .rombel-app-modal .modal-dialog { height: 100svh; }
  }
  .rombel-app-modal .modal-content {
    height: 100%;
    max-height: none;
    border-radius: 1.25rem 1.25rem 0 0;
    box-shadow: 0 -8px 40px rgba(15, 23, 42, .18);
    overscroll-behavior: contain;
  }
  .rombel-app-modal .modal-header {
    justify-content: flex-start;
    padding: .85rem 1rem .85rem .5rem;
    border-bottom: 1px solid #eef0f4;
  }
  .rombel-app-modal .presensi-close {
    order: -1;
    margin: 0 .35rem 0 0;
    color: #2563eb;
    flex-shrink: 0;
  }
  .rombel-app-modal .presensi-close:hover { background: rgba(37, 99, 235, .08); color: #2563eb; }
  .rombel-app-modal .presensi-title-wrap { margin-left: .15rem !important; }
  .rombel-app-modal .modal-footer {
    flex-direction: column-reverse;
    align-items: stretch;
    padding: .65rem 1rem calc(.75rem + env(safe-area-inset-bottom, 0px));
  }
  .rombel-app-modal .modal-footer .presensi-btn {
    width: 100%;
    margin-left: 0 !important;
    border-radius: 9999px;
  }
  .rombel-app-modal .modal-footer .btn-secondary {
    min-height: 42px;
    background: rgba(37, 99, 235, .07);
    border-color: transparent;
    color: #2563eb;
  }
  .rombel-app-modal .modal-footer .btn-secondary:hover,
  .rombel-app-modal .modal-footer .btn-secondary:focus {
    background: rgba(37, 99, 235, .14);
    border-color: transparent;
    color: #1d4ed8;
  }
}
@media (max-width: 575.98px) and (prefers-reduced-motion: no-preference) {
  .rombel-app-modal.fade .modal-dialog { transform: translateY(28px); }
  .rombel-app-modal.show .modal-dialog { transform: none; }
}
@media (min-width: 576px) {
  .rombel-app-modal .modal-dialog { max-width: 480px; }
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
    .on('show.bs.modal', '.rombel-app-modal', function () {
      document.documentElement.classList.add('app-modal-open');
    });
  window.jQuery(document).on('hidden.bs.modal', function () {
    if (!document.querySelector('.modal.show')) {
      document.documentElement.classList.remove('app-modal-open');
    }
  });
}

// Isi modal ubah dari data-* tombol edit yang diklik
$('#modalEditRombel').on('show.bs.modal', function (e) {
  var b = $(e.relatedTarget);
  if (!b.length) return;
  $('#erId').val(b.data('id'));
  $('#erNm').val(b.data('nm'));
  $('#erKls').val(b.data('kls'));
  $('#erJml').val(b.data('jml'));
  $('#erRg').val(b.data('rg'));
});
</script>
<script type="text/javascript">
  document.title = "Program Pelatihan <?= $profil[0]->Namalkp?>";
</script>