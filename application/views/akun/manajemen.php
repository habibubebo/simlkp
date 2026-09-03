<style>
.modern-head h1{letter-spacing:-.02em}
.modern-card{border:1px solid #eef0f4;border-radius:.85rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.04)}
.modern-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:.85rem .85rem 0 0}
.modern-table{width:100%!important}
.modern-table thead th{font-size:.66rem;letter-spacing:.07em;text-transform:uppercase;color:#94a3b8;font-weight:700;border-top:0;border-bottom:1px solid #f1f5f9;white-space:nowrap;padding:.8rem .7rem;background:#fcfdff}
.modern-table tbody td{font-size:.82rem;color:#334155;vertical-align:middle;padding:.62rem .7rem;border-top:1px solid #f8fafc}
.modern-table tbody tr:hover td{background:#f8fafc}
.role-chip{display:inline-flex;align-items:center;padding:.22rem .6rem;border-radius:9999px;font-size:.68rem;font-weight:700;letter-spacing:.02em}
.role-super{background:#fef2f2;color:#dc2626}
.role-admin{background:#eff6ff;color:#2563eb}
.role-instructor{background:#ecfdf5;color:#059669}
.dt-btn{display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:.45rem;font-size:.7rem;border:1px solid transparent;transition:all .15s;flex-shrink:0;text-decoration:none!important}
.dt-btn-edit{background:#fff;border-color:#e2e8f0;color:#475569}
.dt-btn-edit:hover{background:#f8fafc;border-color:#cbd5e1;color:#1e293b}
.dt-btn-delete{background:#fff;border-color:#fecaca;color:#dc2626}
.dt-btn-delete:hover{background:#fef2f2;border-color:#fca5a5;color:#991b1b}
@media(max-width:767.98px){.modern-head .breadcrumb{display:none}}
</style>

<div class="modern-head d-none d-md-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Manajemen Akun</h1>
    <p class="text-muted small mb-0">Kelola akun login pengguna sistem</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Manajemen Akun</li>
  </ol>
</div>

<?php if ($this->session->flashdata('error')): ?>
<div class="alert alert-danger py-2" style="font-size:.82rem"><?= html_escape($this->session->flashdata('error')) ?></div>
<?php endif; ?>

<div class="card modern-card mb-4">
  <div class="card-header py-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between" style="gap:.6rem">
    <h6 class="m-0 font-weight-bold" style="color:#1e293b;font-size:.9rem">Daftar Akun</h6>
    <a class="btn btn-sm" style="background:#2563eb;color:#fff;border-radius:.5rem;font-weight:600;font-size:.78rem" href="<?= base_url('akun/tambah') ?>"><i class="fas fa-plus mr-1"></i> Tambah Akun</a>
  </div>
  <div class="table-responsive">
    <table class="table modern-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Username</th>
          <th>Role</th>
          <th>Instruktur</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($akun)): ?>
        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada akun.</td></tr>
        <?php else: foreach ($akun as $a): ?>
        <tr>
          <td><?= $a->id ?></td>
          <td class="font-weight-bold" style="color:#1e293b"><?= html_escape($a->nama ?: '-') ?></td>
          <td><?= html_escape($a->username) ?></td>
          <td>
            <?php
            $chip = 'instructor'; $label = 'Instructor';
            if ($a->role === 'superadmin') { $chip='super'; $label='Superadmin'; }
            elseif ($a->role === 'admin') { $chip='admin'; $label='Admin'; }
            ?>
            <span class="role-chip role-<?= $chip ?>"><?= $label ?></span>
          </td>
          <td>
            <?php if ($a->instructor_id): ?>
              <?php $ins = $this->db->where('Id', $a->instructor_id)->get('instruktur')->row(); ?>
              <?= $ins ? html_escape($ins->NamaInstruktur) : '#' . $a->instructor_id ?>
            <?php else: ?>-<?php endif; ?>
          </td>
          <td class="text-center">
            <div class="d-inline-flex" style="gap:.3rem">
              <a class="dt-btn dt-btn-edit" href="<?= base_url('akun/form_ubah/' . $a->id) ?>" title="Ubah"><i class="fas fa-pen"></i></a>
              <a class="dt-btn dt-btn-delete" href="<?= base_url('akun/hapus/' . $a->id) ?>" title="Hapus" onclick="return confirm('Hapus akun <?= html_escape($a->username) ?>?')"><i class="fas fa-trash-alt"></i></a>
            </div>
          </td>
        </tr>
        <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script type="text/javascript">document.title = "Manajemen Akun";</script>
