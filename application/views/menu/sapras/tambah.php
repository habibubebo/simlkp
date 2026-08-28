<style>
.sapras-form-card{border:1px solid #eef0f4;border-radius:.9rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.05);overflow:hidden}
.sapras-form-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;padding:1.1rem 1.25rem}
.sapras-section-title{font-size:.7rem;letter-spacing:.08em;text-transform:uppercase;font-weight:800;color:#94a3b8;margin:0 0 .9rem}
.field-label{font-size:.78rem;font-weight:600;color:#334155;margin-bottom:.35rem;display:block}
.field-hint{font-size:.72rem;color:#94a3b8;margin-top:.3rem}
.sapras-input{border-radius:.6rem;border:1px solid #e2e8f0;min-height:42px;font-size:.85rem;padding:.5rem .75rem;transition:border-color .15s,box-shadow .15s}
.sapras-input:focus{border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
.sapras-input::placeholder{color:#94a3b8}
.sapras-actions .btn{border-radius:.6rem;font-weight:600;padding:.55rem 1.1rem;font-size:.85rem}
</style>

<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div>
    <a href="<?= base_url('pages/sapras') ?>" class="small d-inline-flex align-items-center mb-2" style="color:#64748b;text-decoration:none;font-weight:500"><i class="fas fa-arrow-left mr-1" style="font-size:.7rem"></i> Kembali ke daftar</a>
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800;letter-spacing:-.02em">Tambah Sarana</h1>
    <p class="text-muted small mb-0">Lengkapi informasi prasarana baru</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0 d-none d-md-flex" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/sapras') ?>" style="color:#94a3b8;text-decoration:none">Sarana Prasarana</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Tambah</li>
  </ol>
</div>

<div class="row justify-content-center">
  <div class="col-12 col-lg-8 col-xl-7">
    <form action="<?= base_url('sapras/tambah'); ?>" method="POST">
      <div class="card sapras-form-card mb-4">
        <div class="card-header d-flex align-items-center">
          <div class="d-flex align-items-center justify-content-center mr-3" style="width:36px;height:36px;border-radius:.6rem;background:rgba(37,99,235,.1);color:#2563eb"><i class="fas fa-cubes" style="font-size:.85rem"></i></div>
          <div>
            <h6 class="mb-0" style="font-weight:700;color:#1e293b;font-size:.9rem">Informasi Umum</h6>
            <small class="text-muted" style="font-size:.72rem">Identitas dan status sarana</small>
          </div>
        </div>
        <div class="card-body p-4">
          <div class="form-group mb-3">
            <label class="field-label" for="fJsp">Jenis Prasarana <span class="text-danger">*</span></label>
            <input type="text" class="form-control sapras-input" id="fJsp" name="Jsp" maxlength="20" required placeholder="Mis. Tanah, Bangunan, Alat, Buku">
            <div class="field-hint">Kategori utama: tanah, bangunan, alat, buku, dll.</div>
          </div>
          <div class="row">
            <div class="form-group col-md-8 mb-3">
              <label class="field-label" for="fNsp">Nama Prasarana <span class="text-danger">*</span></label>
              <input type="text" class="form-control sapras-input" id="fNsp" name="Nsp" maxlength="100" required placeholder="Mis. Gedung Workshop A">
            </div>
            <div class="form-group col-md-4 mb-3">
              <label class="field-label" for="fKd">Kondisi <span class="text-danger">*</span></label>
              <select class="form-control sapras-input" id="fKd" name="Kd" required>
                <option value="" disabled selected>Pilih kondisi</option>
                <option value="Baik">Baik</option>
                <option value="Perbaikan">Perbaikan</option>
                <option value="Rusak">Rusak</option>
              </select>
            </div>
          </div>
          <div class="form-group mb-0">
            <label class="field-label" for="fNs">No Sertifikat <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text bg-white" style="border-radius:.6rem 0 0 .6rem;border-color:#e2e8f0;color:#94a3b8"><i class="fas fa-certificate" style="font-size:.75rem"></i></span></div>
              <input type="text" class="form-control sapras-input" id="fNs" name="Ns" maxlength="20" required placeholder="Nomor sertifikat / dokumen" style="border-radius:0 .6rem .6rem 0;border-left:0">
            </div>
          </div>
        </div>
      </div>

      <div class="card sapras-form-card mb-4">
        <div class="card-header d-flex align-items-center">
          <div class="d-flex align-items-center justify-content-center mr-3" style="width:36px;height:36px;border-radius:.6rem;background:rgba(16,185,129,.12);color:#059669"><i class="fas fa-ruler-combined" style="font-size:.85rem"></i></div>
          <div>
            <h6 class="mb-0" style="font-weight:700;color:#1e293b;font-size:.9rem">Dimensi &amp; Kapasitas</h6>
            <small class="text-muted" style="font-size:.72rem">Ukuran fisik dan jumlah unit</small>
          </div>
        </div>
        <div class="card-body p-4">
          <div class="row">
            <div class="form-group col-md-4 mb-3">
              <label class="field-label" for="fPj">Panjang <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="number" step="0.01" min="0" class="form-control sapras-input" id="fPj" name="Pj" required placeholder="0.00" style="border-radius:.6rem 0 0 .6rem">
                <div class="input-group-append"><span class="input-group-text bg-white" style="border-radius:0 .6rem .6rem 0;border-color:#e2e8f0;color:#64748b;font-size:.75rem;font-weight:600">m</span></div>
              </div>
            </div>
            <div class="form-group col-md-4 mb-3">
              <label class="field-label" for="fLb">Lebar <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="number" step="0.01" min="0" class="form-control sapras-input" id="fLb" name="Lb" required placeholder="0.00" style="border-radius:.6rem 0 0 .6rem">
                <div class="input-group-append"><span class="input-group-text bg-white" style="border-radius:0 .6rem .6rem 0;border-color:#e2e8f0;color:#64748b;font-size:.75rem;font-weight:600">m</span></div>
              </div>
            </div>
            <div class="form-group col-md-4 mb-3">
              <label class="field-label" for="fLl">Luas Lahan <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="number" step="0.01" min="0" class="form-control sapras-input" id="fLl" name="Ll" required placeholder="0.00" style="border-radius:.6rem 0 0 .6rem">
                <div class="input-group-append"><span class="input-group-text bg-white" style="border-radius:0 .6rem .6rem 0;border-color:#e2e8f0;color:#64748b;font-size:.75rem;font-weight:600">m²</span></div>
              </div>
            </div>
          </div>
          <div class="form-group mb-0" style="max-width:220px">
            <label class="field-label" for="fBy">Banyaknya <span class="text-danger">*</span></label>
            <input type="number" min="1" class="form-control sapras-input" id="fBy" name="By" required placeholder="1">
            <div class="field-hint">Jumlah unit tersedia</div>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-end sapras-actions" style="gap:.6rem">
        <a href="<?= base_url('pages/sapras') ?>" class="btn" style="background:#fff;border:1px solid #e2e8f0;color:#475569">Batal</a>
        <button type="submit" class="btn btn-primary" style="background:#2563eb;border-color:#2563eb;box-shadow:0 4px 14px rgba(37,99,235,.25)"><i class="fas fa-save mr-1"></i> Simpan Sarana</button>
      </div>
    </form>
  </div>
</div>
