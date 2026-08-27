<?php
foreach ($profil as $pr);
?>

<style>
  .pfu {
    --pfu-brand: #4e73df;
    --pfu-deep: #224abe;
    --pfu-ink: #1f2340;
    --pfu-muted: #6b7194;
    --pfu-line: #e3e5ef;
    --pfu-field: #f3f4f9;
  }

  /* Header */
  .pfu-head {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
    gap: 14px;
    margin-bottom: 18px;
  }

  .pfu-head h4 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    letter-spacing: -.01em;
    color: var(--pfu-ink);
  }

  .pfu-head p {
    margin: 3px 0 0;
    font-size: .85rem;
    color: var(--pfu-muted);
  }

  .pfu-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    border: 1px solid var(--pfu-line);
    border-radius: 999px;
    padding: 9px 17px;
    font-size: .82rem;
    font-weight: 600;
    color: var(--pfu-muted);
    text-decoration: none;
    transition: color .2s ease, border-color .2s ease;
  }

  .pfu-back:hover,
  .pfu-back:focus {
    color: var(--pfu-brand);
    border-color: var(--pfu-brand);
    text-decoration: none;
  }

  /* Cards */
  .pfu-card {
    background: #fff;
    border: 1px solid var(--pfu-line);
    border-radius: 16px;
    padding: 20px 22px 22px;
    margin-bottom: 16px;
    box-shadow: 0 2px 8px rgba(31, 35, 64, .04);
  }

  .pfu-card-title {
    display: flex;
    align-items: center;
    gap: 9px;
    margin: 0 0 4px;
    font-size: .95rem;
    font-weight: 700;
    color: var(--pfu-ink);
  }

  .pfu-card-title i {
    color: var(--pfu-brand);
    font-size: .9rem;
    width: 18px;
    text-align: center;
  }

  /* Fields */
  .pfu-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
    margin-top: 14px;
  }

  .pfu-field label {
    display: block;
    font-size: .78rem;
    font-weight: 600;
    color: var(--pfu-ink);
    margin-bottom: 7px;
  }

  .pfu-field input {
    width: 100%;
    height: 46px;
    background: var(--pfu-field);
    border: 1.5px solid transparent;
    border-radius: 12px;
    padding: 0 14px;
    font-family: inherit;
    font-size: 16px;
    color: var(--pfu-ink);
    outline: none;
    transition: border-color .2s ease, background-color .2s ease, box-shadow .2s ease;
  }

  .pfu-field input::placeholder {
    color: #9aa0b5;
  }

  .pfu-field input:focus {
    background: #fff;
    border-color: var(--pfu-brand);
    box-shadow: 0 0 0 4px rgba(78, 115, 223, .14);
  }

  .pfu-split {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .pfu-split input {
    flex: 1;
    min-width: 0;
  }

  .pfu-split .pfu-slash {
    color: var(--pfu-muted);
    font-weight: 600;
  }

  /* Actions */
  .pfu-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 20px;
  }

  .pfu-save {
    flex: 1;
    min-width: 170px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    height: 50px;
    background: var(--pfu-deep);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-family: inherit;
    font-size: .95rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color .2s ease, transform .12s ease, box-shadow .2s ease;
  }

  .pfu-save:hover {
    background: #3449b2;
    box-shadow: 0 8px 20px rgba(34, 74, 190, .28);
  }

  .pfu-save:active {
    transform: scale(.98);
  }

  .pfu-save:focus-visible {
    outline: 3px solid rgba(78, 115, 223, .45);
    outline-offset: 2px;
  }

  .pfu-cancel {
    flex: 1;
    min-width: 130px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 50px;
    background: #fff;
    border: 1px solid var(--pfu-line);
    border-radius: 12px;
    font-size: .95rem;
    font-weight: 600;
    color: var(--pfu-muted);
    text-decoration: none;
    transition: color .2s ease, border-color .2s ease;
  }

  .pfu-cancel:hover,
  .pfu-cancel:focus {
    color: var(--pfu-brand);
    border-color: var(--pfu-brand);
    text-decoration: none;
  }

  @media (min-width: 640px) {
    .pfu-grid {
      grid-template-columns: 1fr 1fr;
      column-gap: 24px;
    }

    .pfu-span2 {
      grid-column: 1 / -1;
    }
  }
</style>

<div class="pfu">
  <header class="pfu-head">
    <div>
      <h4>Ubah Profil Lembaga</h4>
      <p>Perbarui identitas, alamat, dan kontak lembaga.</p>
    </div>
    <a href="<?= base_url('pages/lembaga'); ?>" class="pfu-back">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
  </header>

  <form action="<?= base_url('pages/ubahdata'); ?>" method="POST">
    <section class="pfu-card">
      <h6 class="pfu-card-title"><i class="fas fa-id-badge"></i> Identitas</h6>
      <div class="pfu-grid">
        <div class="pfu-field pfu-span2">
          <label for="nl">Nama Lembaga</label>
          <input type="text" id="nl" name="nmlem" maxlength="100" placeholder="Nama Lembaga" value="<?= html_escape($pr->Namalkp) ?>">
        </div>
        <div class="pfu-field">
          <label for="npsn">NPSN</label>
          <input type="text" id="npsn" name="npsn" maxlength="10" inputmode="numeric" placeholder="NPSN" value="<?= html_escape($pr->Npsn) ?>">
        </div>
        <div class="pfu-field">
          <label for="namaya">Nama Yayasan</label>
          <input type="text" id="namaya" name="namaya" maxlength="50" placeholder="Nama Yayasan" value="<?= html_escape($pr->Namayayasan) ?>">
        </div>
      </div>
    </section>

    <section class="pfu-card">
      <h6 class="pfu-card-title"><i class="fas fa-map-marker-alt"></i> Alamat</h6>
      <div class="pfu-grid">
        <div class="pfu-field pfu-span2">
          <label for="al">Jalan</label>
          <input type="text" id="al" name="alamat" maxlength="100" placeholder="Jalan" value="<?= html_escape($pr->Alamat) ?>">
        </div>
        <div class="pfu-field">
          <label>RT / RW</label>
          <div class="pfu-split">
            <input type="text" id="rt" name="rt" maxlength="5" inputmode="numeric" placeholder="RT" aria-label="RT" value="<?= html_escape($pr->Rt) ?>">
            <span class="pfu-slash">/</span>
            <input type="text" id="rw" name="rw" maxlength="5" inputmode="numeric" placeholder="RW" aria-label="RW" value="<?= html_escape($pr->Rw) ?>">
          </div>
        </div>
        <div class="pfu-field">
          <label for="kel">Kelurahan</label>
          <input type="text" id="kel" name="kel" maxlength="30" placeholder="Kelurahan" value="<?= html_escape($pr->Kelurahan) ?>">
        </div>
        <div class="pfu-field">
          <label for="kec">Kecamatan</label>
          <input type="text" id="kec" name="kec" maxlength="30" placeholder="Kecamatan" value="<?= html_escape($pr->Kecamatan) ?>">
        </div>
        <div class="pfu-field">
          <label for="kota">Kota</label>
          <input type="text" id="kota" name="kota" maxlength="20" placeholder="Kota" value="<?= html_escape($pr->Kota) ?>">
        </div>
        <div class="pfu-field">
          <label for="prov">Provinsi</label>
          <input type="text" id="prov" name="prov" maxlength="20" placeholder="Provinsi" value="<?= html_escape($pr->Provinsi) ?>">
        </div>
        <div class="pfu-field">
          <label for="kp">Kode Pos</label>
          <input type="text" id="kp" name="kp" maxlength="6" inputmode="numeric" placeholder="Kode Pos" value="<?= html_escape($pr->Kodepos) ?>">
        </div>
      </div>
    </section>

    <section class="pfu-card">
      <h6 class="pfu-card-title"><i class="fas fa-address-book"></i> Kontak</h6>
      <div class="pfu-grid">
        <div class="pfu-field">
          <label for="telp">Telepon</label>
          <input type="text" id="telp" name="telp" maxlength="12" inputmode="tel" placeholder="Telepon" value="<?= html_escape($pr->Telepon) ?>">
        </div>
        <div class="pfu-field">
          <label for="nofax">No Fax</label>
          <input type="text" id="nofax" name="fax" maxlength="12" inputmode="tel" placeholder="No Fax" value="<?= html_escape($pr->Nofax) ?>">
        </div>
        <div class="pfu-field pfu-span2">
          <label for="email">Alamat Email</label>
          <input type="text" id="email" name="email" maxlength="30" inputmode="email" placeholder="Alamat email" value="<?= html_escape($pr->Email) ?>">
        </div>
      </div>
    </section>

    <div class="pfu-actions">
      <button type="submit" class="pfu-save"><i class="fas fa-check"></i> Simpan</button>
      <a href="<?= base_url('pages/lembaga'); ?>" class="pfu-cancel">Batal</a>
    </div>
  </form>
</div>
