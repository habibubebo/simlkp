<?php
$__ci =& get_instance();
$__nama = trim($__ci->session->userdata('nama') ?: '-');
$__user = trim($__ci->session->userdata('username') ?: '-');
$__initial = strtoupper(substr($__nama,0,1) . (strpos($__nama,' ') ? substr($__nama, strpos($__nama,' ')+1,1) : ''));
?>
<style>
.modern-head h1{letter-spacing:-.02em}
.modern-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04);background:#fff}
.modern-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.avatar-sm2{width:40px;height:40px;border-radius:.7rem;background:rgba(37,99,235,.1);color:#1d4ed8;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;flex-shrink:0}
.field-label{font-size:.68rem;letter-spacing:.06em;text-transform:uppercase;font-weight:700;color:#64748b;margin-bottom:.35rem;display:block}
.akun-input{border:1px solid #e2e8f0;border-radius:.6rem;padding:.55rem .8rem;font-size:.85rem;color:#1e293b;width:100%;background:#fff;transition:border-color .15s,box-shadow .15s}
.akun-input:focus{outline:none;border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
.pass-wrap{position:relative}
.pass-toggle{position:absolute;right:.5rem;top:50%;transform:translateY(-50%);width:32px;height:32px;border:0;background:transparent;color:#94a3b8;border-radius:.5rem;display:flex;align-items:center;justify-content:center}
.pass-toggle:hover{background:#f8fafc;color:#475569}
.hint-line{display:flex;gap:.5rem;align-items:flex-start;font-size:.72rem;color:#64748b;padding:.4rem 0}
.hint-line i{color:#f59e0b;margin-top:.1rem}
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}}
</style>

<div class="modern-head d-none d-md-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Pengaturan Akun</h1>
    <p class="text-muted small mb-0">Perbarui nama, username, dan kata sandi Anda</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url('index.php/utama') ?>" style="color:#94a3b8;text-decoration:none">Profil</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Pengaturan Akun</li>
  </ol>
</div>

<div class="d-md-none mt-3 mb-3 app-page-head">
  <div style="min-width:0">
    <h1 style="font-size:1.15rem;font-weight:800;color:#1e293b;letter-spacing:-.01em;margin:0">Pengaturan Akun</h1>
    <div class="small text-muted" style="font-size:.72rem">Perbarui nama, username, dan kata sandi Anda</div>
  </div>
</div>

<div class="row mb-4">
  <div class="col-lg-7 mb-3 mb-lg-0">
    <div class="card modern-card h-100">
      <div class="card-header py-3 d-flex align-items-center" style="gap:.6rem">
        <span class="avatar-sm2"><?= html_escape($__initial) ?></span>
        <div style="min-width:0">
          <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem"><?= html_escape($__nama) ?></h6>
          <div class="small text-muted" style="font-size:.68rem"><?= html_escape($__user) ?></div>
        </div>
      </div>
      <div class="card-body" style="padding:1.1rem">
        <form action="<?= base_url() . 'utama/ubah_akun' ?>" method="POST">
          <input type="hidden" name="id" value="<?= html_escape($this->session->userdata('id')) ?>">
          <div class="form-group mb-3">
            <label class="field-label" for="akNama">Nama</label>
            <input type="text" class="akun-input" id="akNama" name="nama" value="<?= html_escape($__nama) ?>" maxlength="100" required>
          </div>
          <div class="form-group mb-3">
            <label class="field-label" for="akUser">Username</label>
            <input type="text" class="akun-input" id="akUser" name="username" value="<?= html_escape($__user) ?>" maxlength="20" required>
          </div>
          <div class="form-group mb-3">
            <label class="field-label" for="akPass">Kata Sandi</label>
            <div class="pass-wrap">
              <input type="password" class="akun-input" id="akPass" name="password" placeholder="Masukkan password baru" maxlength="30" required style="padding-right:2.6rem">
              <button type="button" class="pass-toggle" id="akPassToggle" aria-label="Tampilkan kata sandi"><i class="fas fa-eye"></i></button>
            </div>
            <div class="small text-muted mt-1" style="font-size:.66rem">Kata sandi disimpan dalam bentuk terenkripsi; gunakan kombinasi yang tidak mudah ditebak</div>
          </div>
          <div class="d-flex" style="gap:.5rem">
            <a href="<?= base_url('index.php/utama') ?>" class="btn flex-fill" style="border:1px solid #e2e8f0;background:#fff;color:#475569;border-radius:.6rem;font-weight:600;font-size:.8rem">Kembali</a>
            <button type="submit" class="btn btn-primary flex-fill" style="background:#2563eb;border-color:#2563eb;border-radius:.6rem;font-weight:600;font-size:.8rem"><i class="fas fa-save mr-1"></i>Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="card modern-card h-100">
      <div class="card-header py-3 d-flex align-items-center" style="gap:.5rem">
        <span class="d-flex align-items-center justify-content-center" style="width:28px;height:28px;border-radius:.5rem;background:#fffbeb;color:#d97706;border:1px solid #fde68a"><i class="fas fa-shield-alt" style="font-size:.75rem"></i></span>
        <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Sebelum Menyimpan</h6>
      </div>
      <div class="card-body" style="padding:1.1rem">
        <div class="hint-line"><i class="fas fa-sign-out-alt"></i><span>Setelah menyimpan perubahan, Anda akan keluar otomatis dan diminta login ulang dengan data baru.</span></div>
        <div class="hint-line"><i class="fas fa-user"></i><span>Username dipakai untuk masuk ke sistem; maksimal 20 karakter tanpa spasi akan lebih aman.</span></div>
        <div class="hint-line"><i class="fas fa-key"></i><span>Kata sandi maksimal 30 karakter. Perbarui secara berkala dan jangan dibagikan.</span></div>
        <div class="small text-muted mt-2 pt-2" style="font-size:.66rem;border-top:1px dashed #e2e8f0"><i class="fas fa-info-circle mr-1" style="color:#94a3b8"></i>Perubahan hanya berlaku untuk akun Anda, tidak memengaruhi data lembaga</div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">document.title = "Pengaturan Akun <?= html_escape($__nama) ?>";</script>
<script>
$(function(){
  $('#akPassToggle').on('click', function(){
    var $i = $('#akPass');
    var show = $i.attr('type') === 'password';
    $i.attr('type', show ? 'text' : 'password');
    $(this).find('i').toggleClass('fa-eye fa-eye-slash', true).attr('class', show ? 'fas fa-eye-slash' : 'fas fa-eye');
    $(this).attr('aria-label', show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
  });
});
</script>
