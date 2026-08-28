<style>
.form-card{border:1px solid #eef0f4;border-radius:.9rem;box-shadow:0 1px 3px rgba(15,23,42,.04),0 8px 24px rgba(15,23,42,.05);overflow:hidden}
.form-card .card-header{background:#fff;border-bottom:1px solid #f1f5f9;padding:1.1rem 1.25rem}
.field-label{font-size:.78rem;font-weight:600;color:#334155;margin-bottom:.35rem;display:block}
.m-input{border-radius:.6rem;border:1px solid #e2e8f0;min-height:42px;font-size:.85rem;padding:.5rem .75rem;transition:border-color .15s,box-shadow .15s}
.m-input:focus{border-color:#93b4f5;box-shadow:0 0 0 .2rem rgba(37,99,235,.12)}
</style>
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div>
    <a href="<?= base_url('pages/peserta') ?>" class="small d-inline-flex align-items-center mb-2" style="color:#64748b;text-decoration:none;font-weight:500"><i class="fas fa-arrow-left mr-1" style="font-size:.7rem"></i> Kembali ke daftar</a>
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800;letter-spacing:-.02em">Tambah Peserta</h1>
    <p class="text-muted small mb-0">Lengkapi data peserta didik baru</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0 d-none d-md-flex" style="font-size:.8rem"><li class="breadcrumb-item"><a href="<?= base_url('pages/peserta') ?>" style="color:#94a3b8;text-decoration:none">Peserta</a></li><li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Tambah</li></ol>
</div>
<div class="row justify-content-center"><div class="col-12 col-lg-9 col-xl-8">
  <form action="<?= base_url('peserta/tambah'); ?>" method="POST">
    <div class="card form-card mb-4">
      <div class="card-header d-flex align-items-center"><div class="d-flex align-items-center justify-content-center mr-3" style="width:36px;height:36px;border-radius:.6rem;background:rgba(37,99,235,.1);color:#2563eb"><i class="fas fa-user-plus" style="font-size:.85rem"></i></div><div><h6 class="mb-0" style="font-weight:700;color:#1e293b;font-size:.9rem">Identitas Peserta</h6><small class="text-muted" style="font-size:.72rem">Data pribadi dan dokumen</small></div></div>
      <div class="card-body p-4">
        <div class="row">
          <div class="form-group col-md-6 mb-3"><label class="field-label">Nomor Induk <span class="text-danger">*</span></label><input type="text" class="form-control m-input" name="Nipd" maxlength="20" required placeholder="NIPD"></div>
          <div class="form-group col-md-6 mb-3"><label class="field-label">Status <span class="text-danger">*</span></label><select class="form-control m-input" name="Status" required><option disabled selected value="">Pilih status</option><option value="0">Nonaktif</option><option value="1">Aktif</option><option value="2">Lulus</option></select></div>
          <div class="form-group col-md-6 mb-3"><label class="field-label">No KK</label><input type="text" class="form-control m-input" name="Nokk" maxlength="30" value="-" placeholder="No Kartu Keluarga"></div>
          <div class="form-group col-md-6 mb-3"><label class="field-label">NIK</label><input type="text" class="form-control m-input" name="Nik" maxlength="30" value="-" placeholder="NIK"></div>
          <div class="form-group col-md-8 mb-3"><label class="field-label">Nama Peserta <span class="text-danger">*</span></label><input type="text" class="form-control m-input" name="Nama" maxlength="50" required placeholder="Nama lengkap"></div>
          <div class="form-group col-md-4 mb-3"><label class="field-label">Kelamin <span class="text-danger">*</span></label><select class="form-control m-input" name="Jk" required><option disabled selected value="">Pilih kelamin</option><option value="Laki - Laki">Laki - Laki</option><option value="Perempuan">Perempuan</option></select></div>
          <div class="form-group col-md-8 mb-3"><label class="field-label">Tempat, Tanggal Lahir <span class="text-danger">*</span></label><input type="text" name="Tgl" class="form-control m-input" placeholder="Mis. Blitar, 01 Januari 2000" maxlength="50" required></div>
          <div class="form-group col-md-4 mb-3"><label class="field-label">Jenis Kursus <span class="text-danger">*</span></label><select class="form-control m-input" name="Jenis" required><option disabled selected value="">Pilih kursus</option><?php $data=$this->db->query("SELECT * FROM rombel")->result(); foreach($data as $row){ ?><option value="<?= $row->Id ?>"><?= html_escape($row->Namarombel) ?></option><?php } ?></select></div>
          <div class="form-group col-md-6 mb-3"><label class="field-label">Kelas <span class="text-danger">*</span></label><select class="form-control m-input" name="Kls" required><option disabled selected value="">Pilih kelas</option><?php foreach($rombel as $row){ ?><option value="<?= html_escape($row->Kelas) ?>"><?= html_escape($row->Namarombel.' - '.$row->Kelas) ?></option><?php } ?></select></div>
          <div class="form-group col-md-6 mb-3" id="simple-date2"><label class="field-label">Tanggal Masuk <span class="text-danger">*</span></label><div class="input-group date"><div class="input-group-prepend"><span class="input-group-text bg-white" style="border-radius:.6rem 0 0 .6rem;border-color:#e2e8f0;color:#94a3b8"><i class="fas fa-calendar" style="font-size:.75rem"></i></span></div><input type="text" name="Tglmasuk" class="form-control m-input" placeholder="Tanggal Masuk" maxlength="20" required style="border-radius:0 .6rem .6rem 0;border-left:0"></div></div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-end" style="gap:.6rem"><a href="<?= base_url('pages/peserta') ?>" class="btn" style="background:#fff;border:1px solid #e2e8f0;color:#475569;border-radius:.6rem;font-weight:600;padding:.55rem 1.1rem">Batal</a><button type="submit" class="btn btn-primary" style="background:#2563eb;border-color:#2563eb;border-radius:.6rem;font-weight:600;padding:.55rem 1.2rem;box-shadow:0 4px 14px rgba(37,99,235,.25)"><i class="fas fa-save mr-1"></i> Simpan</button></div>
  </form>
</div></div>
<script>$(function(){$('#simple-date2 .input-group.date').datepicker({format:'yyyy-mm-dd',autoclose:true,todayHighlight:true,todayBtn:'linked'});});</script>
