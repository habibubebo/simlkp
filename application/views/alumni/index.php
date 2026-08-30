<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="description" content="Verifikasi keabsahan sertifikat yang diterbitkan oleh sistem.">
  <meta name="theme-color" content="#2563eb">
  <title>Cek Data Alumni</title>
  <link href="<?= base_url("asset/vendor/fontawesome-free/css/all.min.css") ?>" rel="stylesheet" type="text/css">
  <style>
    :root {
      --bg: #f8fafc;
      --surface: #ffffff;
      --ink: #0f172a;
      --ink-2: #334155;
      --muted: #64748b;
      --line: #e2e8f0;
      --line-soft: #eef0f4;
      --brand: #2563eb;
      --brand-strong: #1d4ed8;
      --brand-soft: #eff6ff;
      --ok: #15803d;
      --ok-soft: #f0fdf4;
      --ok-line: #bbf7d0;
      --warn: #b45309;
      --warn-soft: #fffbeb;
      --warn-line: #fde68a;
      --no: #b91c1c;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background: var(--bg);
      color: var(--ink);
      line-height: 1.5;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      padding-bottom: env(safe-area-inset-bottom);
    }

    .top {
      background: var(--surface);
      border-bottom: 1px solid var(--line-soft);
    }

    .top-inner {
      max-width: 860px;
      margin: 0 auto;
      padding: 14px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: var(--ink);
      min-width: 0;
    }

    .brand img {
      width: 32px;
      height: 32px;
      object-fit: contain;
      flex-shrink: 0;
    }

    .brand-name {
      font-weight: 800;
      font-size: .92rem;
      letter-spacing: -.01em;
      line-height: 1.2;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .main {
      width: 100%;
      max-width: 860px;
      margin: 0 auto;
      padding: 48px 24px 64px;
      flex: 1;
    }

    .page-head h1 {
      font-size: 1.6rem;
      font-weight: 800;
      letter-spacing: -.02em;
    }

    .page-head p {
      margin-top: 8px;
      color: var(--muted);
      font-size: .9rem;
      max-width: 60ch;
    }

    .page-head p b {
      color: var(--ink-2);
    }

    .panel {
      margin-top: 24px;
      background: var(--surface);
      border: 1px solid var(--line);
      border-radius: 14px;
      box-shadow: 0 1px 2px rgba(15, 23, 42, .04);
    }

    .verify-form {
      padding: 20px;
    }

    .verify-form label {
      display: block;
      font-size: .8rem;
      font-weight: 700;
      color: var(--ink-2);
      margin-bottom: 8px;
    }

    .qrow {
      display: flex;
      gap: 10px;
    }

    .qrow input {
      flex: 1;
      min-width: 0;
      font: inherit;
      font-size: .95rem;
      color: var(--ink);
      background: var(--bg);
      border: 1px solid var(--line);
      border-radius: 10px;
      padding: 11px 13px;
      outline: none;
      transition: all .15s ease;
    }

    .qrow input:focus {
      border-color: var(--brand);
      background: var(--surface);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
    }

    .qrow input::placeholder {
      color: #94a3b8;
    }

    .qrow .btn-cek {
      flex-shrink: 0;
      font: inherit;
      font-size: .85rem;
      font-weight: 700;
      color: #fff;
      background: var(--brand);
      border: 0;
      border-radius: 10px;
      padding: 0 20px;
      cursor: pointer;
      transition: background .15s ease, transform .05s ease;
    }

    .qrow .btn-cek:hover {
      background: var(--brand-strong);
    }

    .qrow .btn-cek:active {
      transform: scale(.98);
    }

    .qrow .btn-cek:disabled {
      opacity: .7;
      cursor: wait;
    }

    .hint {
      margin-top: 10px;
      font-size: .74rem;
      color: var(--muted);
      line-height: 1.5;
    }

    .results {
      border-top: 1px solid var(--line-soft);
    }

    .results-meta {
      padding: 14px 20px;
      font-size: .78rem;
      color: var(--muted);
      border-bottom: 1px solid var(--line-soft);
    }

    .results-meta b {
      color: var(--ink-2);
      font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
    }

    .result {
      padding: 20px;
    }

    .status {
      display: flex;
      align-items: center;
      gap: 9px;
      font-size: .8rem;
      font-weight: 800;
      border-radius: 10px;
      padding: 11px 14px;
      margin-bottom: 18px;
      border-left: 3px solid;
    }

    .status .dot {
      width: 7px;
      height: 7px;
      flex-shrink: 0;
      border-radius: 50%;
    }

    .status.ok {
      color: var(--ok);
      background: var(--ok-soft);
      border-left-color: var(--ok);
    }

    .status.ok .dot {
      background: var(--ok);
    }

    .status.warn {
      color: var(--warn);
      background: var(--warn-soft);
      border-left-color: var(--warn);
    }

    .status.warn .dot {
      background: var(--warn);
    }

    .result h2 {
      font-size: 1.08rem;
      font-weight: 800;
      letter-spacing: -.01em;
    }

    .result .nipd {
      margin-top: 2px;
      font-size: .78rem;
      color: var(--muted);
      font-weight: 600;
    }

    .result .nipd span {
      font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
      color: var(--ink-2);
    }

    .detail {
      margin-top: 18px;
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 0 28px;
    }

    .detail .item {
      padding: 14px 0;
      border-top: 1px solid var(--line-soft);
      min-width: 0;
    }

    .detail .item dt {
      font-size: .72rem;
      font-weight: 700;
      color: var(--muted);
      margin-bottom: 4px;
    }

    .detail .item dd {
      font-size: .88rem;
      font-weight: 600;
      color: var(--ink-2);
      word-break: break-word;
    }

    .detail .item dd.mono {
      font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
      font-weight: 700;
    }

    .result .note {
      margin-top: 16px;
      font-size: .78rem;
      font-weight: 600;
      color: var(--warn);
      line-height: 1.55;
    }

    .empty,
    .notfound {
      padding: 36px 20px 40px;
      text-align: left;
      font-size: .82rem;
      color: var(--muted);
      line-height: 1.6;
    }

    .notfound p {
      max-width: 58ch;
    }

    .notfound p b {
      color: var(--ink-2);
    }

    .notfound .head {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: .9rem;
      font-weight: 800;
      color: var(--ink-2);
      margin-bottom: 6px;
    }

    .notfound .head i {
      color: var(--no);
      font-size: .8rem;
    }

    .footer {
      border-top: 1px solid var(--line-soft);
      background: var(--surface);
      text-align: center;
      font-size: .72rem;
      color: var(--muted);
      padding: 20px 24px 28px;
      line-height: 1.7;
    }

    .footer a {
      color: var(--brand);
      font-weight: 700;
      text-decoration: none;
    }

    @media (max-width: 560px) {
      .main {
        padding: 32px 16px 48px;
      }

      .top-inner {
        padding: 12px 16px;
      }

      .qrow {
        flex-direction: column;
      }

      .qrow .btn-cek {
        padding: 12px 20px;
        justify-content: center;
        text-align: center;
      }

      .detail {
        grid-template-columns: 1fr;
        gap: 0;
      }

      .detail .item:first-child {
        border-top: 0;
        padding-top: 4px;
      }
    }
  </style>
</head>

<body>
  <?php $pr = !empty($profil) ? $profil[0] : null; ?>
  <?php $lembaga = $pr ? trim((string)$pr->Namalkp) : 'Lembaga Kursus dan Pelatihan'; ?>

  <header class="top">
    <div class="top-inner">
      <a class="brand" href="<?= base_url() ?>">
        <img src="<?= base_url("asset/img/logo/logo.png") ?>" alt="">
        <span class="brand-name"><?= htmlspecialchars($lembaga) ?></span>
      </a>
    </div>
  </header>

  <main class="main">
    <div class="page-head">
      <h1>Cek Data Alumni</h1>
      <p>Verifikasi keabsahan sertifikat dengan cara mencocokkan nomor induk peserta (NIPD) ke database <b><?= htmlspecialchars($lembaga) ?></b>.</p>
    </div>

    <section class="panel">
      <form class="verify-form" action="<?= base_url('alumni') ?>" method="get">
        <label for="q">Nomor Induk Peserta</label>
        <div class="qrow">
          <input type="text" id="q" name="q" value="<?= htmlspecialchars((string)$q, ENT_QUOTES) ?>" placeholder="Contoh: 20240101" inputmode="numeric" autocomplete="off" maxlength="30" required>
          <button type="submit" class="btn-cek" id="btnCek">Cek Sertifikat</button>
        </div>
        <p class="hint">Nomor induk dicetak pada bagian belakang sertifikat. Hasil hanya ditampilkan untuk nomor induk yang terdaftar di sistem.</p>
      </form>

      <div class="results">
        <?php if ($q === ''): ?>
          <div class="empty">Masukkan nomor induk peserta di atas, lalu tekan <b>Cek Sertifikat</b> untuk memeriksa keabsahannya.</div>

        <?php elseif (empty($hasil)): ?>
          <div class="notfound">
            <div class="head"><i class="fas fa-exclamation-circle"></i> Data tidak ditemukan</div>
            <p>
              Tidak ada alumni dengan nomor induk <b>&ldquo;<?= htmlspecialchars((string)$q, ENT_QUOTES) ?>&rdquo;</b> di dalam sistem.
              Periksa kembali penulisan NIPD. Jika masih ragu, hubungi langsung <?= htmlspecialchars($lembaga) ?>.
            </p>
          </div>

        <?php else: $row = $hasil[0]; ?>
          <div class="results-meta">
            <?= count($hasil) ?> hasil untuk nomor induk <b><?= htmlspecialchars((string)$row->Nipd) ?></b>
          </div>
          <article class="result">
            <div class="status <?= $row->Valid ? 'ok' : 'warn' ?>">
              <span class="dot"></span>
              <?= $row->Valid ? 'Sertifikat Terverifikasi' : 'Belum terverifikasi sebagai alumni' ?>
            </div>

            <h2><?= htmlspecialchars((string)$row->Nama) ?></h2>
            <div class="nipd">Nomor Induk <span><?= htmlspecialchars((string)$row->Nipd) ?></span></div>

            <dl class="detail">
              <div class="item">
                <dt>Program</dt>
                <dd><?= trim((string)$row->Program) !== '' ? htmlspecialchars((string)$row->Program) : '&mdash;' ?></dd>
              </div>
              <div class="item">
                <dt>Periode Pelatihan</dt>
                <dd><?= htmlspecialchars((string)$row->Mulai) ?> &mdash; <?= htmlspecialchars((string)$row->Selesai) ?></dd>
              </div>
              <?php if ($row->Valid): ?>
                <div class="item">
                  <dt>Tanggal Terbit</dt>
                  <dd><?= htmlspecialchars((string)$row->Cetak) ?></dd>
                </div>
                <div class="item">
                  <dt>Nomor Sertifikat</dt>
                  <dd class="mono"><?= htmlspecialchars((string)$row->NoSertifikat) ?></dd>
                </div>
              <?php endif; ?>
            </dl>

            <?php if (!$row->Valid): ?>
              <div class="note">
                NIPD ini terdaftar sebagai peserta, tetapi belum tercatat lulus di sistem. Bila Anda memiliki sertifikat dengan data ini, konfirmasikan ke lembaga.
              </div>
            <?php endif; ?>
          </article>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <footer class="footer">
    Sistem Informasi Manajemen <?= htmlspecialchars($lembaga) ?><br>
    &copy; <?= date('Y') ?>
  </footer>

  <script>
    (function() {
      var btn = document.getElementById('btnCek');
      var form = document.querySelector('.verify-form');
      form.addEventListener('submit', function() {
        btn.disabled = true;
        btn.textContent = 'Memeriksa...';
      });
    })();
  </script>
</body>

</html>