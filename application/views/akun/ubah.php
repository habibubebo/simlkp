<style>
.form-card{border:1px solid #eef0f4;border-radius:.9rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.05);overflow:hidden}
.form-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;padding:1.1rem 1.25rem}
.field-label{font-size:.78rem;font-weight:600;color:#334155;margin-bottom:.35rem;display:block}
.m-input{border-radius:.6rem;border:1px solid #e2e8f0;min-height:42px;font-size:.85rem;padding:.5rem .75rem;transition:border-color .15s,box-shadow .15s}
.m-input:focus{border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
</style>
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div>
    <a href="<?= base_url('akun') ?>" class="small d-inline-flex align-items-center mb-2" style="color:#64748b;text-decoration:none;font-weight:500"><i class="fas fa-arrow-left mr-1" style="font-size:.7rem"></i> Kembali ke daftar</a>
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800;letter-spacing:-.02em">Ubah Akun</h1>
    <p class="text-muted small mb-0"><?= html_escape($akun->username) ?></p>
  </div>
</div>
<div class="row justify-content-center"><div class="col-12 col-lg-7">
  <?php if ($this->session->flashdata('error')): ?>
  <div class="alert alert-danger py-2" style="font-size:.82rem"><?= html_escape($this->session->flashdata('error')) ?></div>
  <?php endif; ?>
  <form action="<?= base_url('akun/ubah'); ?>" method="POST">
    <input type="hidden" name="id" value="<?= $akun->id ?>">
    <div class="card form-card mb-4">
      <div class="card-body p-4">
        <div class="row">
          <div class="form-group col-12 mb-3"><label class="field-label">Nama <span class="text-muted">(opsional)</span></label><input type="text" class="form-control m-input" name="nama" maxlength="100" value="<?= html_escape($akun->nama ?: '') ?>" placeholder="Nama lengkap"></div>
          <div class="form-group col-md-6 mb-3"><label class="field-label">Username <span class="text-danger">*</span></label><input type="text" class="form-control m-input" name="username" maxlength="100" value="<?= html_escape($akun->username) ?>" required></div>
          <div class="form-group col-md-6 mb-3"><label class="field-label">Password <span class="text-muted">(kosongkan jika tetap)</span></label><input type="text" class="form-control m-input" name="password" maxlength="100" placeholder="Password baru"></div>
          <div class="form-group col-md-6 mb-3"><label class="field-label">Role <span class="text-danger">*</span></label><select name="role" class="form-control m-input"><option value="instructor" <?= $akun->role==='instructor'?'selected':'' ?>>Instructor</option><option value="admin" <?= $akun->role==='admin'?'selected':'' ?>>Admin</option><option value="superadmin" <?= $akun->role==='superadmin'?'selected':'' ?>>Superadmin</option></select></div>
          <div class="form-group col-md-6 mb-3"><label class="field-label">Instruktur <span class="text-muted">(untuk role instructor)</span></label><select name="instructor_id" class="form-control m-input"><option value="">- Tidak terhubung -</option><?php foreach ($instruktur_list as $i): ?><option value="<?= $i->Id ?>" <?= $akun->instructor_id==$i->Id?'selected':'' ?>><?= html_escape($i->NamaInstruktur) ?></option><?php endforeach; ?></select></div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-end" style="gap:.6rem"><a href="<?= base_url('akun') ?>" class="btn" style="background:#fff;border:1px solid #e2e8f0;color:#475569;border-radius:.6rem;font-weight:600;padding:.55rem 1.1rem">Batal</a><button type="submit" class="btn btn-primary" style="background:#2563eb;border-color:#2563eb;border-radius:.6rem;font-weight:600;padding:.55rem 1.2rem"><i class="fas fa-save mr-1"></i> Simpan</button></div>
  </form>
</div></div>

<script type="text/javascript">document.title = "Ubah Akun";</script>
