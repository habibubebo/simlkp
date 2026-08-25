<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Ubah Unit Kompetensi</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url("pages/uk") ?>">Unit Kompetensi</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ubah</li>
  </ol>
</div>

<style>
/* ===== Form Unit Kompetensi ===== */
.ukf-card {
  border: 0;
  border-radius: .75rem;
  box-shadow: 0 4px 24px rgba(15, 23, 42, .07);
}
.ukf-head {
  display: flex;
  align-items: center;
  padding: 1.1rem 1.25rem;
  border-bottom: 1px solid #eef0f4;
}
.ukf-icon {
  width: 2.5rem;
  height: 2.5rem;
  border-radius: .6rem;
  background: rgba(37, 99, 235, .1);
  color: #2563eb;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 1.05rem;
  flex-shrink: 0;
  margin-right: .9rem;
}
.ukf-title { margin: 0; font-weight: 700; color: #111827; }
.ukf-sub { font-size: .8rem; color: #6b7280; margin-top: .1rem; }
.ukf-label {
  font-size: .85rem;
  font-weight: 600;
  color: #374151;
  margin-bottom: .35rem;
  display: block;
}
.ukf-input {
  min-height: 44px;
  font-size: 16px;
  border-radius: .6rem;
}
.ukf-input:focus {
  border-color: #93b4f5;
  box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .15);
}
.ukf-section {
  font-size: .78rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  color: #6b7280;
  margin: 1.4rem 0 .7rem;
  display: flex;
  align-items: center;
}
.ukf-section::after {
  content: "";
  flex: 1;
  height: 1px;
  background: #eef0f4;
  margin-left: .75rem;
}
.ukf-cap {
  font-size: .75rem;
  font-weight: 600;
  color: #6b7280;
  text-transform: uppercase;
  letter-spacing: .04em;
}
.ukf-note { font-size: .78rem; color: #9ca3af; margin-top: .35rem; }
.ukf-wrap { position: relative; }
.ukf-wrap .ukf-input { padding-right: 3.4rem; }
.ukf-count {
  position: absolute;
  right: .75rem;
  top: 50%;
  transform: translateY(-50%);
  font-size: .7rem;
  color: #9ca3af;
  background: #fff;
  padding-left: .25rem;
  pointer-events: none;
}
.ukf-count.near { color: #d97706; font-weight: 600; }
.ukf-count.max { color: #dc2626; font-weight: 700; }
.ukf-total { background: #f8fafc; font-weight: 700; }
.ukf-actions {
  display: flex;
  gap: .6rem;
  padding: 1rem 1.25rem;
  border-top: 1px solid #eef0f4;
}
.ukf-actions .btn {
  min-height: 44px;
  border-radius: .55rem;
  font-weight: 600;
  flex: 1;
  white-space: nowrap;
}
.ukf-actions .btn:active { transform: scale(.98); }
@media (min-width: 576px) {
  .ukf-actions { justify-content: flex-end; }
  .ukf-actions .btn { flex: 0 0 auto; min-width: 130px; }
}
</style>

<div class="container col-lg-8">
  <?php if (empty($uks)) { ?>
    <div class="card ukf-card mb-4">
      <div class="card-body text-center py-5">
        <i class="fas fa-search fa-2x text-muted mb-3"></i>
        <h6 class="font-weight-bold text-gray-800">Data tidak ditemukan</h6>
        <p class="text-muted mb-0">Unit kompetensi dengan ID tersebut tidak ada.</p>
      </div>
      <div class="ukf-actions justify-content-center">
        <a href="<?= base_url("pages/uk") ?>" class="btn btn-secondary" role="button">Kembali</a>
      </div>
    </div>
  <?php } ?>
  <?php foreach ($uks as $tp) {
    $rombelHilang = is_null($tp->Namarombel); // jenis kursus sudah terhapus
  ?>
  <div class="card ukf-card mb-4">
    <div class="ukf-head">
      <span class="ukf-icon"><i class="fas fa-pen-alt"></i></span>
      <div>
        <h5 class="ukf-title">Data Unit Kompetensi</h5>
        <div class="ukf-sub">Perbarui unit dan jam pelajaran<?= $rombelHilang ? '' : ' ' . $tp->Namarombel ?></div>
      </div>
    </div>

    <div class="card-body pt-3">
      <form action="<?= base_url('uk/ubah') ?>" method="POST" id="formUk">
        <input type="hidden" name="Id" value="<?= $tp->Id ?>">

        <div class="form-group mb-3">
          <label class="ukf-label" for="rombel">Jenis Kursus <span class="text-danger">*</span></label>
          <select class="form-control ukf-input" id="rombel" name="rombel" required>
            <?php if ($rombelHilang) { ?>
              <option value="" selected disabled>Jenis kursus tidak ditemukan, silakan pilih</option>
            <?php } else { ?>
              <option value="" disabled>Pilih jenis kursus</option>
            <?php } ?>
            <?php
            $rombelList = $this->db->query("SELECT * FROM rombel")->result();
            foreach ($rombelList as $row) { ?>
              <option value="<?= $row->Id ?>" <?= $row->Id == $tp->Rombel ? 'selected' : '' ?>>
                <?= $row->Namarombel . ' - ' . $row->Kelas ?>
              </option>
            <?php } ?>
          </select>
        </div>

        <div class="ukf-section">Unit &amp; Jam Pelajaran</div>

        <div class="row mb-1">
          <div class="col-8"><span class="ukf-cap">Nama Unit</span></div>
          <div class="col-4"><span class="ukf-cap">JP</span></div>
        </div>

        <?php for ($i = 1; $i <= 5; $i++) {
          $wajib = $i <= 3;
          $opt = $wajib ? '' : ' (opsional)';
          $unitField = 'Uk' . $i;
          $jpField = 'Jp' . $i;
        ?>
          <div class="form-row">
            <div class="form-group col-8 mb-2">
              <div class="ukf-wrap">
                <input type="text" class="form-control ukf-input" aria-label="Unit <?= $i ?>"
                       placeholder="Unit <?= $i . $opt ?>" name="uk<?= $i ?>"
                       value="<?= $tp->$unitField ?>" <?= $wajib ? 'required' : '' ?>>
                <span class="ukf-count">0/50</span>
              </div>
            </div>
            <div class="form-group col-4 mb-2">
              <input type="text" inputmode="numeric" class="form-control ukf-input ukf-jp" aria-label="Jam pelajaran unit <?= $i ?>"
                     placeholder="JP <?= $i ?>" name="jp<?= $i ?>"
                     value="<?= preg_replace('/[^0-9]/', '', $tp->$jpField) ?>" <?= $wajib ? 'required' : '' ?>>
            </div>
          </div>
        <?php } ?>

        <small class="ukf-note d-block mb-2">Unit 1 sampai 3 wajib diisi. Isi unit 4 dan 5 bila ada.</small>

        <div class="form-group mb-1">
          <label class="ukf-label" for="jptotal">Total JP <span class="text-danger">*</span></label>
          <input type="text" inputmode="numeric" class="form-control ukf-input ukf-total" id="jptotal"
                 name="jptotal" placeholder="0" value="<?= preg_replace('/[^0-9]/', '', $tp->Jptotal) ?>" readonly required>
          <small class="ukf-note">Otomatis dihitung dari jumlah JP di atas.</small>
        </div>
      </form>
    </div>

    <div class="ukf-actions">
      <a href="<?= base_url("pages/uk") ?>" class="btn btn-secondary" role="button">Batal</a>
      <button type="submit" form="formUk" class="btn btn-primary">
        <i class="fas fa-save mr-1"></i>Simpan
      </button>
    </div>
  </div>
  <?php } ?>
</div>

<script>
$(document).ready(function () {
  $('#rombel').select2({
    placeholder: 'Pilih jenis kursus',
    width: '100%',
    language: {
      noResults: function () { return 'Jenis kursus tidak ditemukan'; }
    }
  });

  var jpFields = document.querySelectorAll('.ukf-jp');
  var totalEl = document.getElementById('jptotal');

  function angkaMurni(str) {
    return String(str).replace(/[^0-9]/g, '');
  }

  function hitungTotal() {
    var total = 0;
    jpFields.forEach(function (f) {
      var v = parseInt(angkaMurni(f.value), 10);
      if (!isNaN(v) && v > 0) total += v;
    });
    if (total > 0) totalEl.value = total;
  }

  jpFields.forEach(function (f) {
    f.addEventListener('input', function () {
      this.value = angkaMurni(this.value); // buang teks seperti "JP", sisakan angka
      hitungTotal();
    });
  });

  // Counter karakter unit kompetensi (maks 50)
  document.querySelectorAll('.ukf-wrap').forEach(function (w) {
    var input = w.querySelector('input');
    var count = w.querySelector('.ukf-count');
    var max = input.getAttribute('maxlength') || 50;
    function update() {
      var len = input.value.length;
      count.textContent = len + '/' + max;
      count.classList.toggle('near', len >= max - 5 && len < max);
      count.classList.toggle('max', len >= max);
    }
    input.addEventListener('input', update);
    update();
  });
});
</script>
