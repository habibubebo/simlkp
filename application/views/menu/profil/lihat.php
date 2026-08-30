<?php
foreach (($profil ?? []) as $pr);
if (!isset($pr)) $pr = (object)[];

$val = function ($x) {
  return ($x !== null && trim((string)$x) !== '') ? html_escape($x) : '-';
};
$email = trim((string)($pr->Email ?? ''));
$phone = trim((string)($pr->Telepon ?? ''));
$rt_rw = trim(($pr->Rt <> '' ? $pr->Rt : '') . '/' . ($pr->Rw <> '' ? $pr->Rw : ''), '/');
?>

<style>
  .pfl {
    --pfl-brand: #2563eb;
    --pfl-deep: #1d4ed8;
    --pfl-ink: #1e293b;
    --pfl-muted: #64748b;
    --pfl-line: #eef0f4;
  }
  .modern-head h1{letter-spacing:-.02em}

  /* Banner */
  .pfl-banner {
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    gap: 15px;
    background: linear-gradient(135deg, var(--pfl-brand) 0%, var(--pfl-deep) 85%);
    border-radius: 16px;
    padding: 18px 18px 20px;
    color: #fff;
  }

  .pfl-banner::before {
    content: "";
    position: absolute;
    top: -140px;
    right: -110px;
    width: 340px;
    height: 340px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(255, 255, 255, .13) 0%, rgba(255, 255, 255, 0) 68%);
    pointer-events: none;
  }

  .pfl-banner-top {
    display: flex;
    align-items: center;
    gap: 14px;
    position: relative;
  }

  .pfl-logo {
    flex: none;
    width: 58px;
    height: 58px;
    background: #fff;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(15, 23, 66, .25);
  }

  .pfl-logo img {
    max-width: 78%;
    max-height: 78%;
  }

  .pfl-idtext {
    min-width: 0;
  }

  .pfl-idtext h4 {
    margin: 0;
    font-size: 1.06rem;
    font-weight: 700;
    letter-spacing: -.01em;
    line-height: 1.3;
    color: #fff;
    word-break: break-word;
  }

  .pfl-idtext p {
    margin: 3px 0 0;
    font-size: .8rem;
    color: rgba(255, 255, 255, .82);
    word-break: break-word;
  }

  .pfl-edit {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    width: 100%;
    height: 47px;
    background: #fff;
    color: var(--pfl-deep);
    border-radius: 12px;
    padding: 0 18px;
    font-size: .86rem;
    font-weight: 700;
    text-decoration: none;
    transition: transform .12s ease, box-shadow .2s ease;
  }

  .pfl-edit:hover,
  .pfl-edit:focus {
    color: var(--pfl-brand);
    text-decoration: none;
    box-shadow: 0 8px 20px rgba(15, 23, 66, .3);
  }

  .pfl-edit:active {
    transform: scale(.98);
  }

  /* Grid & cards */
  .pfl-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 13px;
    margin-top: 13px;
  }

  .pfl-card {
    background: #fff;
    border: 1px solid var(--pfl-line);
    border-radius: 16px;
    padding: 17px 18px 7px;
    box-shadow: 0 2px 8px rgba(31, 35, 64, .04);
  }

  .pfl-card-title {
    display: flex;
    align-items: center;
    gap: 9px;
    margin: 0 0 2px;
    font-size: .92rem;
    font-weight: 700;
    color: var(--pfl-ink);
    letter-spacing: -.01em;
  }

  .pfl-card-title i {
    color: var(--pfl-brand);
    font-size: .85rem;
    width: 18px;
    text-align: center;
  }

  .pfl-items {
    display: grid;
    margin: 0;
  }

  .pfl-item {
    display: flex;
    align-items: baseline;
    gap: 12px;
    padding: 9px 0;
  }

  .pfl-item dt {
    flex: 0 0 41%;
    max-width: 41%;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .04em;
    text-transform: uppercase;
    color: var(--pfl-muted);
  }

  .pfl-item dd {
    flex: 1;
    min-width: 0;
    margin: 0;
    font-size: .87rem;
    font-weight: 600;
    color: var(--pfl-ink);
    word-break: break-word;
  }

  .pfl-item dd a {
    color: var(--pfl-brand);
    text-decoration: none;
  }

  .pfl-item dd a:hover {
    text-decoration: underline;
  }

  @media (max-width: 575.98px) {
    .pfl-banner { border-radius: 1rem; }
  }

  @media (min-width: 640px) {
    .pfl-banner {
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      padding: 22px 26px;
    }

    .pfl-edit {
      width: auto;
      height: 48px;
    }

    .pfl-cols {
      grid-template-columns: 1fr 1fr;
      column-gap: 28px;
    }
  }

  @media (min-width: 768px) {
    .pfl-grid {
      grid-template-columns: 1fr 1fr;
    }

    .pfl-wide {
      grid-column: 1 / -1;
    }

    .pfl-banner {
      padding: 26px 30px;
    }

    .pfl-logo {
      width: 70px;
      height: 70px;
      border-radius: 16px;
    }

    .pfl-idtext h4 {
      font-size: 1.3rem;
    }

    .pfl-idtext p {
      font-size: .85rem;
    }

    .pfl-card {
      padding: 20px 24px 10px;
    }

    .pfl-item dt {
      flex-basis: 34%;
      max-width: 34%;
    }
  }
</style>

<!-- Header desktop -->
<div class="modern-head d-none d-md-flex flex-column flex-md-row align-items-md-center justify-content-between mt-4 mb-3">
  <div class="mb-2 mb-md-0">
    <h1 class="h4 mb-1 font-weight-bold text-gray-800" style="font-weight:800">Lembaga</h1>
    <p class="text-muted small mb-0">Data profil dan identitas lembaga kursus</p>
  </div>
  <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size:.8rem">
    <li class="breadcrumb-item"><a href="<?= base_url('pages/dashboard') ?>" style="color:#94a3b8;text-decoration:none">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#334155;font-weight:600">Lembaga</li>
  </ol>
</div>

<!-- Header mobile -->
<div class="d-md-none mt-3 mb-3 app-page-head">
  <div class="d-flex align-items-center justify-content-between" style="gap:.6rem">
    <div style="min-width:0">
      <h1 style="font-size:1.15rem;font-weight:800;color:#1e293b;letter-spacing:-.01em;margin:0">Lembaga</h1>
      <div class="small text-muted" style="font-size:.72rem">Data profil dan identitas lembaga kursus</div>
    </div>
  </div>
</div>

<div class="pfl">
  <section class="pfl-banner">
    <div class="pfl-banner-top">
      <div class="pfl-logo">
        <img src="<?= base_url("asset/img/logo/logo.png") ?>" alt="Logo <?= $val($pr->Namalkp) ?>">
      </div>
      <div class="pfl-idtext">
        <h4><?= $val($pr->Namalkp) ?></h4>
        <p><i class="fas fa-landmark mr-1"></i><?= $val($pr->Namayayasan) ?></p>
      </div>
    </div>
    <a href="<?= base_url('pages/lembaga_edit'); ?>" class="pfl-edit">
      <i class="fas fa-pen"></i> Ubah
    </a>
  </section>

  <div class="pfl-grid">
    <section class="pfl-card">
      <h6 class="pfl-card-title"><i class="fas fa-id-badge"></i> Identitas</h6>
      <dl class="pfl-items">
        <div class="pfl-item">
          <dt>NPSN</dt>
          <dd><?= $val($pr->Npsn) ?></dd>
        </div>
        <div class="pfl-item">
          <dt>Nama Lembaga</dt>
          <dd><?= $val($pr->Namalkp) ?></dd>
        </div>
        <div class="pfl-item">
          <dt>Yayasan</dt>
          <dd><?= $val($pr->Namayayasan) ?></dd>
        </div>
      </dl>
    </section>

    <section class="pfl-card">
      <h6 class="pfl-card-title"><i class="fas fa-address-book"></i> Kontak</h6>
      <dl class="pfl-items">
        <div class="pfl-item">
          <dt>Telepon</dt>
          <dd>
            <?php if ($phone !== ''): ?>
              <a href="tel:<?= html_escape(preg_replace('/[^0-9+]/', '', $phone)) ?>"><?= html_escape($phone) ?></a>
            <?php else: ?>-
            <?php endif; ?>
          </dd>
        </div>
        <div class="pfl-item">
          <dt>No Fax</dt>
          <dd><?= $val($pr->Nofax) ?></dd>
        </div>
        <div class="pfl-item">
          <dt>Email</dt>
          <dd>
            <?php if ($email !== ''): ?>
              <a href="mailto:<?= html_escape($email) ?>"><?= html_escape($email) ?></a>
            <?php else: ?>-
            <?php endif; ?>
          </dd>
        </div>
      </dl>
    </section>

    <section class="pfl-card pfl-wide">
      <h6 class="pfl-card-title"><i class="fas fa-map-marker-alt"></i> Alamat</h6>
      <dl class="pfl-items pfl-cols">
        <div class="pfl-item">
          <dt>Jalan</dt>
          <dd><?= $val($pr->Alamat) ?></dd>
        </div>
        <div class="pfl-item">
          <dt>RT/RW</dt>
          <dd><?= $rt_rw !== '' ? html_escape($rt_rw) : '-' ?></dd>
        </div>
        <div class="pfl-item">
          <dt>Kelurahan</dt>
          <dd><?= $val($pr->Kelurahan) ?></dd>
        </div>
        <div class="pfl-item">
          <dt>Kecamatan</dt>
          <dd><?= $val($pr->Kecamatan) ?></dd>
        </div>
        <div class="pfl-item">
          <dt>Kota</dt>
          <dd><?= $val($pr->Kota) ?></dd>
        </div>
        <div class="pfl-item">
          <dt>Provinsi</dt>
          <dd><?= $val($pr->Provinsi) ?></dd>
        </div>
        <div class="pfl-item">
          <dt>Kode Pos</dt>
          <dd><?= $val($pr->Kodepos) ?></dd>
        </div>
      </dl>
    </section>
  </div>
</div>

<script type="text/javascript">
  document.title = <?= json_encode("Profil " . ($pr->Namalkp ?? 'Lembaga')) ?>;
</script>