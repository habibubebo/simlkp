<style>
.form-card{border:1px solid #eef0f4;border-radius:.9rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.05);overflow:hidden}
.form-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;padding:1.1rem 1.25rem}
.field-label{font-size:.78rem;font-weight:600;color:#334155;margin-bottom:.35rem;display:block}
.m-input{border-radius:.6rem;border:1px solid #e2e8f0;min-height:42px;font-size:.85rem;padding:.5rem .75rem;transition:border-color .15s,box-shadow .15s}
.m-input:focus{border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
</style>
<?php foreach ($rombel as $tp); ?>
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div>
    <a href="<?= base_url('pages/rombel') ?>" class="small d-inline-flex align-items-center mb-2" style="color:#64748b;text-decoration:none;font-weight:500"><i class="fas fa-arrow-left mr-1" style="font-size:.7rem"></i> Kembali ke daftar</a>
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800;letter-spacing:-.02em">Ubah Program</h1>
    <p class="text-muted small mb-0">Perbarui data <span style="font-weight:600;color:#334155"><?= html_escape($tp->Namarombel) ?></span></p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0 d-none d-md-flex" style="font-size:.8rem"><li class="breadcrumb-item"><a href="<?= base_url('pages/rombel') ?>" style="color:#94a3b8;text-decoration:none">Program</a></li><li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Ubah</li></ol>
</div>
<div class="row justify-content-center"><div class="col-12 col-lg-8 col-xl-7">
  <form action="<?= base_url('rombel/ubah'); ?>" method="POST">
    <input type="hidden" name="Id" value="<?= html_escape($tp->Id) ?>">
    <div class="card form-card mb-4">
      <div class="card-header d-flex align-items-center"><div class="d-flex align-items-center justify-content-center mr-3" style="width:36px;height:36px;border-radius:.6rem;background:rgba(37,99,235,.1);color:#2563eb"><i class="fas fa-chalkboard" style="font-size:.85rem"></i></div><div><h6 class="mb-0" style="font-weight:700;color:#1e293b;font-size:.9rem">Informasi Program</h6><small class="text-muted" style="font-size:.72rem">Data jenis kursus dan kelas</small></div></div>
      <div class="card-body p-4">
        <div class="row">
          <div class="form-group col-md-6 mb-3"><label class="field-label">Jenis Kursus <span class="text-danger">*</span></label><input type="text" class="form-control m-input" name="nm" maxlength="30" required value="<?= html_escape($tp->Namarombel) ?>"></div>
          <div class="form-group col-md-6 mb-3"><label class="field-label">Kelas <span class="text-danger">*</span></label><input type="text" class="form-control m-input" name="kls" maxlength="50" required value="<?= html_escape($tp->Kelas) ?>"></div>
          <div class="form-group col-md-6 mb-3"><label class="field-label">Jumlah Peserta <span class="text-danger">*</span></label><input type="number" min="0" class="form-control m-input" name="jml" required value="<?= html_escape($tp->Jumlahpeserta) ?>"></div>
          <div class="form-group col-md-6 mb-3"><label class="field-label">Ruangan <span class="text-danger">*</span></label><input type="text" class="form-control m-input" name="rg" maxlength="20" required value="<?= html_escape($tp->Ruangan) ?>"></div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-end" style="gap:.6rem"><a href="<?= base_url('pages/rombel') ?>" class="btn" style="background:#fff;border:1px solid #e2e8f0;color:#475569;border-radius:.6rem;font-weight:600;padding:.55rem 1.1rem">Batal</a><button type="submit" class="btn btn-primary" style="background:#2563eb;border-color:#2563eb;border-radius:.6rem;font-weight:600;padding:.55rem 1.2rem;box-shadow:0 4px 14px rgba(37,99,235,.25)"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button></div>
  </form>
</div></div>
