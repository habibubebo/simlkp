<?php
defined('BASEPATH') or exit('No direct script access allowed');
$baseStreakUrl = base_url('cek/streak');
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Streak Builder — Tes cek/streak</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
	<style>
		:root{--line:#e5e7eb;--line2:#f1f5f9;--accent:#ea580c;--accent2:#c2410c;--ink:#0f172a}
		body{background:#f8fafc;font-family:'Inter',system-ui,sans-serif;color:var(--ink)}
		.topbar{position:sticky;top:0;z-index:20;background:rgba(248,250,252,.92);backdrop-filter:blur(10px);border-bottom:1px solid var(--line)}
		.topbar-inner{max-width:1060px;margin:0 auto;padding:12px 16px;display:flex;align-items:center;justify-content:space-between;gap:12px}
		.brand{display:flex;align-items:center;gap:10px;font-weight:800;letter-spacing:-.02em;font-size:15px}
		.brand-mark{width:32px;height:32px;border-radius:10px;background:#0f172a;color:#fff;display:grid;place-items:center;font-size:16px}
		.pill{font-size:11px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;background:#fff;border:1px solid var(--line);padding:6px 10px;border-radius:999px;color:#64748b;display:inline-flex;align-items:center;gap:6px}
		.pill-dot{width:7px;height:7px;border-radius:999px;background:#22c55e;box-shadow:0 0 0 4px #dcfce7}
		.wrap{max-width:1060px;margin:0 auto;padding:22px 16px 36px}
		.hero{margin-bottom:18px}
		.hero h1{font-size:clamp(26px,4vw,38px);font-weight:800;letter-spacing:-.03em;line-height:.95;margin:0}
		.hero h1 span{color:var(--accent)}
		.hero p{margin:8px 0 0;color:#64748b;font-size:13.8px;max-width:640px;line-height:1.6}
		.hero code{font-family:'JetBrains Mono',monospace;font-size:12px;background:#fff;border:1px solid var(--line);padding:2px 6px;border-radius:6px;color:#334155}
		.grid{display:grid;grid-template-columns:1.05fr .95fr;gap:16px;align-items:start}
		@media(max-width:900px){.grid{grid-template-columns:1fr}}
		.cardx{background:#fff;border:1px solid var(--line);border-radius:12px;box-shadow:0 1px 2px rgba(0,0,0,.05),0 8px 24px rgba(0,0,0,.04);overflow:hidden}
		.cardx-head{padding:16px 18px 12px;border-bottom:1px solid var(--line2);display:flex;align-items:center;justify-content:space-between;gap:10px}
		.cardx-head h2{font-size:12px;font-weight:750;letter-spacing:.07em;text-transform:uppercase;color:#1e293b;margin:0}
		.cardx-head small{font-size:11px;color:#94a3b8;font-weight:600}
		.cardx-body{padding:16px 18px 18px}
		.label{font-size:11px;font-weight:750;letter-spacing:.07em;text-transform:uppercase;color:#1e293b;margin-bottom:8px;display:flex;justify-content:space-between;gap:8px}
		.label span{letter-spacing:0;text-transform:none;font-weight:500;color:#94a3b8;font-size:11px}
		.input{width:100%;background:#f8fafc;border:1px solid var(--line);border-radius:12px;padding:11px 13px;font-size:14.5px;font-weight:600;color:var(--ink);outline:none;transition:.15s}
		.input::placeholder{color:#94a3b8;font-weight:500}
		.input:focus{border-color:#fdba74;background:#fff;box-shadow:0 0 0 4px #fff7ed}
		.stepper{display:flex;align-items:center;gap:8px;background:#f8fafc;border:1px solid var(--line);border-radius:12px;padding:6px}
		.stepper button{width:40px;height:40px;border-radius:11px;border:1px solid var(--line);background:#fff;display:grid;place-items:center;font-size:20px;font-weight:700;cursor:pointer;transition:.15s;color:#0f172a;flex-shrink:0}
		.stepper button:hover{border-color:#cbd5e1;background:#f8fafc}
		.stepper button:active{transform:scale(.97)}
		.stepper input{flex:1;width:0;text-align:center;border:0;background:transparent;outline:none;font-weight:800;font-size:22px;color:var(--ink);font-family:'Inter',sans-serif}
		.stepper input::-webkit-outer-spin-button,.stepper input::-webkit-inner-spin-button{-webkit-appearance:none;margin:0}
		.stepper input[type=number]{-moz-appearance:textfield}
		.chips{display:flex;gap:6px;flex-wrap:wrap;margin-top:8px}
		.chip{font-size:12px;font-weight:700;padding:6px 10px;border-radius:999px;border:1px solid var(--line);background:#fff;cursor:pointer;transition:.15s;color:#334155}
		.chip:hover{border-color:#fed7aa;background:#fff7ed;color:#9a3412}
		.chip.active{background:#0f172a;color:#fff;border-color:#0f172a}
		.hint{font-size:11.5px;color:#94a3b8;margin-top:7px;line-height:1.5}
		.divider{height:1px;background:var(--line2);margin:14px 0}
		.result-sticky{position:sticky;top:66px}
		@media(max-width:900px){.result-sticky{position:static}}
		.preview-box{background:#fff;border:1px solid var(--line);border-radius:12px;padding:12px;position:relative}
		.preview-head{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:10px}
		.mono{font-family:'JetBrains Mono',monospace;font-size:10px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:#94a3b8}
		.img-wrap{position:relative;background:#f8fafc;border:1px dashed #cbd5e1;border-radius:10px;min-height:260px;display:grid;place-items:center;overflow:hidden;padding:14px}
		.img-wrap img{max-width:100%;height:auto;display:block;image-rendering:auto;filter:drop-shadow(0 8px 20px rgba(0,0,0,.12));border-radius:6px}
		.img-placeholder{color:#64748b;font-size:13px;font-weight:600;text-align:center;line-height:1.5}
		.skeleton{width:100%;height:220px;border-radius:10px;background:linear-gradient(90deg,#f1f5f9 25%,#e2e8f0 37%,#f1f5f9 63%);background-size:400% 100%;animation:shimmer 1.1s ease-in-out infinite}
		@keyframes shimmer{0%{background-position:100% 0}100%{background-position:-100% 0}}
		.url-row{display:flex;gap:8px;margin-top:12px}
		.url-input{flex:1;font-family:'JetBrains Mono',monospace;font-size:11.5px;background:#f8fafc;border:1px solid var(--line);color:#334155;border-radius:10px;padding:10px 11px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
		.btn{appearance:none;border:0;border-radius:11px;padding:11px 14px;font-weight:750;font-size:13.5px;cursor:pointer;transition:.15s;display:inline-flex;align-items:center;justify-content:center;gap:8px;font-family:'Inter',sans-serif;white-space:nowrap}
		.btn-copy{background:var(--accent);color:#fff;box-shadow:0 6px 18px rgba(249,115,22,.32);flex:1}
		.btn-copy:hover{background:var(--accent2);transform:translateY(-1px)}
		.btn-copy:active{transform:none}
		.btn-copy.done{background:#16a34a;box-shadow:0 6px 18px rgba(22,163,74,.32)}
		.btn-ghost{background:#fff;color:#334155;border:1px solid var(--line)}
		.btn-ghost:hover{background:#f8fafc;border-color:#cbd5e1}
		.btn-sub{padding:9px 10px;font-size:12.5px;border-radius:10px;flex:0 0 auto}
		.actions{display:grid;grid-template-columns:1fr auto auto;gap:8px;margin-top:10px;position:relative}
		@media(max-width:520px){.actions{grid-template-columns:1fr 1fr}.actions .btn-ghost:last-child{grid-column:span 2}}
		.toast{position:fixed;left:50%;bottom:18px;transform:translateX(-50%) translateY(10px);background:#0f172a;color:#fff;padding:10px 14px;border-radius:999px;font-size:13px;font-weight:650;display:flex;align-items:center;gap:8px;box-shadow:0 10px 30px rgba(0,0,0,.22);opacity:0;pointer-events:none;transition:.22s;z-index:50;border:1px solid #1e293b}
		.toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
		.toast i{width:20px;height:20px;border-radius:999px;background:#22c55e;display:grid;place-items:center;font-size:12px;color:#fff;font-style:normal}
	</style>
</head>
<body>
	<div class="topbar">
		<div class="topbar-inner">
			<div class="brand"><div class="brand-mark">🔥</div> STREAK BUILDER</div>
			<div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;justify-content:flex-end">
				<a href="<?= base_url() ?>" class="pill" style="text-decoration:none;color:#334155">← Dashboard</a>
			</div>
		</div>
	</div>

	<div class="wrap">
		<div class="hero">
			<h1>Tes Gambar <span>Streak</span></h1>
			<p><code><?= html_escape($baseStreakUrl) ?>?hari=&amp;nama=</code></p>
		</div>

		<div class="grid">
			<!-- Builder -->
			<div class="cardx">
				<div class="cardx-head">
					<h2>⚙️ Builder</h2>
					<small id="builderSub">hari: 3 • nama: —</small>
				</div>
				<div class="cardx-body">
					<div style="margin-bottom:14px">
						<div class="label" for="nama">Nama Peserta <span>→ ?nama=</span></div>
						<input id="nama" class="input" type="text" placeholder="BINTANG DWI ADISTI" maxlength="64" autocomplete="off" value="">
						<div class="hint">Kosong = <code>NAMA PESERTA</code></div>
					</div>

					<div>
						<div class="label">Jumlah Hari <span>1–100</span></div>
						<div class="stepper" role="group" aria-label="Stepper hari">
							<button type="button" id="btnMinus" aria-label="Kurangi hari">−</button>
							<input id="hari" type="number" inputmode="numeric" min="1" max="100" value="3" aria-label="Jumlah hari">
							<button type="button" id="btnPlus" aria-label="Tambah hari">+</button>
						</div>
						<div class="chips" id="chips">
							<button type="button" class="chip active" data-v="3">3 hari</button>
							<button type="button" class="chip" data-v="7">7 hari</button>
							</div>
						<div class="hint" style="display:flex;justify-content:space-between;gap:10px"><span>Alias: <code>?days</code> <code>?n</code> <code>?jumlah</code></span><span id="hintHari" style="color:#0f172a;font-weight:700"></span></div>
					</div>
				</div>
			</div>

			<!-- Hasil -->
			<div class="result-sticky">
				<div class="cardx" style="overflow:visible;background:transparent;border:0;box-shadow:none">
					<div class="preview-box">
						<div class="preview-head">
							<span class="mono">HASIL</span>
							<span class="mono" id="statusText" style="color:#64748b">siap</span>
						</div>

						<div class="img-wrap" id="imgWrap">
							<div id="skeleton" class="skeleton" style="display:none"></div>
							<img id="previewImg" alt="Preview streak" style="display:none" crossorigin="anonymous">
							<div id="placeholder" class="img-placeholder">Belum ada preview<br><span style="font-weight:500;color:#94a3b8">Atur Nama &amp; Hari → preview muncul di sini</span></div>
						</div>

						<!-- URL row -->
						<div class="url-row" style="position:relative">
							<input id="urlField" class="url-input" type="text" readonly spellcheck="false" value="">
							<button type="button" class="btn btn-ghost btn-sub" id="btnCopyLink" title="Copy link URL">⎘ Link</button>
						</div>

						<div class="actions">
							<button type="button" class="btn btn-copy" id="btnCopyImg"><span id="copyIcon">⎘</span> <span id="copyText">Copy Gambar</span></button>
							<button type="button" class="btn btn-ghost" id="btnOpen">↗ Buka</button>
							<button type="button" class="btn btn-ghost" id="btnDownload">⤓ PNG</button>
						</div>

						<div class="hint" style="margin-top:10px;text-align:center;color:#94a3b8">PNG transparan 500px • Archivo Black</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="toast" class="toast" role="status" aria-live="polite"><i>✓</i> <span id="toastText">Tersalin!</span></div>

	<script>
		const baseUrl = <?= json_encode($baseStreakUrl) ?>;
		const $ = s => document.querySelector(s);
		const nama = $('#nama');
		const hari = $('#hari');
		const btnMinus = $('#btnMinus');
		const btnPlus = $('#btnPlus');
		const chips = document.querySelectorAll('.chip');
		const previewImg = $('#previewImg');
		const skeleton = $('#skeleton');
		const placeholder = $('#placeholder');
		const urlField = $('#urlField');
		const statusText = $('#statusText');
		const builderSub = $('#builderSub');
		const hintHari = $('#hintHari');
		const btnCopyImg = $('#btnCopyImg');
		const btnCopyLink = $('#btnCopyLink');
		const copyText = $('#copyText');
		const copyIcon = $('#copyIcon');
		const toast = $('#toast');
		const toastText = $('#toastText');

		let toastTimer, debounceTimer;
		let currentUrl = '';
		const DEBOUNCE_MS = 650;

		function clampHari(v){
			v = parseInt(v,10);
			if(isNaN(v)) return 1;
			return Math.min(100, Math.max(1, v));
		}
		function buildUrl(){
			const h = clampHari(hari.value);
			const n = nama.value.trim();
			const params = new URLSearchParams();
			params.set('hari', String(h));
			if(n) params.set('nama', n);
			// bust cache biar tiap ganti hari tetap fresh (jaga biar angka kecil flame random berubah)
			params.set('_', String(Date.now()));
			const clean = baseUrl + '?' + params.toString().replace(/&_=.*$/,'') // untuk display tanpa cache buster
			const fetchUrl = baseUrl + '?' + params.toString();
			return { fetchUrl, clean };
		}
		function syncChips(h){
			chips.forEach(c => c.classList.toggle('active', parseInt(c.dataset.v,10) === h));
		}
		function showToast(msg){
			toastText.textContent = msg;
			toast.classList.add('show');
			clearTimeout(toastTimer);
			toastTimer = setTimeout(()=> toast.classList.remove('show'), 2200);
		}
		function setLoading(on){
			if(on){
				skeleton.style.display = 'block';
				previewImg.style.display = 'none';
				placeholder.style.display = 'none';
				statusText.textContent = 'memuat…';
				statusText.style.color = '#f59e0b';
			} else {
				skeleton.style.display = 'none';
			}
		}
		function updateMeta(){
			const {clean} = buildUrl();
			const h = clampHari(hari.value);
			const n = nama.value.trim() || '—';
			builderSub.textContent = `hari: ${h} • nama: ${n.length>18 ? n.slice(0,18)+'…' : n}`;
			hintHari.textContent = h + ' hari';
			urlField.value = clean;
			currentUrl = clean;
		}

		let loadToken = 0;
		function refreshPreview(){
			updateMeta();
			const {fetchUrl, clean} = buildUrl();
			currentUrl = clean;
			const token = ++loadToken;
			setLoading(true);
			// preload via Image to get load/error handling
			const img = new Image();
			img.crossOrigin = 'anonymous';
			img.onload = () => {
				if(token !== loadToken) return;
				previewImg.src = fetchUrl;
				previewImg.style.display = 'block';
				placeholder.style.display = 'none';
				skeleton.style.display = 'none';
				statusText.textContent = 'ok • ' + clampHari(hari.value) + ' hari';
				statusText.style.color = '#22c55e';
			};
			img.onerror = () => {
				if(token !== loadToken) return;
				skeleton.style.display = 'none';
				previewImg.style.display = 'none';
				placeholder.style.display = 'block';
				placeholder.innerHTML = '<span style="color:#ef4444;font-weight:700">Gagal memuat</span><br><span style="color:#94a3b8">Pastikan endpoint cek/streak aktif & asset/api.png tersedia</span>';
				statusText.textContent = 'gagal';
				statusText.style.color = '#ef4444';
			};
			img.src = fetchUrl;
		}
		function queuePreview(ms = DEBOUNCE_MS){
			// update URL/meta langsung biar user lihat, tapi tunda request gambar ke server
			updateMeta();
			statusText.textContent = 'mengetik…';
			statusText.style.color = '#15191e';
			clearTimeout(debounceTimer);
			debounceTimer = setTimeout(refreshPreview, ms);
		}

		btnMinus.addEventListener('click', ()=>{ hari.value = clampHari(parseInt(hari.value,10)-1); syncChips(clampHari(hari.value)); queuePreview(); });
		btnPlus.addEventListener('click', ()=>{ hari.value = clampHari(parseInt(hari.value,10)+1); syncChips(clampHari(hari.value)); queuePreview(); });
		hari.addEventListener('input', ()=>{ syncChips(clampHari(hari.value)); queuePreview(); });
		hari.addEventListener('blur', ()=>{ hari.value = clampHari(hari.value); syncChips(clampHari(hari.value)); queuePreview(300); });
		hari.addEventListener('keydown', e=>{ if(e.key==='ArrowUp'){e.preventDefault();btnPlus.click();} if(e.key==='ArrowDown'){e.preventDefault();btnMinus.click();} });
		nama.addEventListener('input', ()=> queuePreview());
		chips.forEach(c=> c.addEventListener('click', ()=>{ hari.value = c.dataset.v; syncChips(clampHari(hari.value)); queuePreview(200); }));

		// copy link
		btnCopyLink.addEventListener('click', async ()=>{
			const v = urlField.value;
			try{
				await navigator.clipboard.writeText(v);
				btnCopyLink.textContent = '✓ Disalin';
				showToast('Link disalin ke clipboard');
				setTimeout(()=> btnCopyLink.textContent='⎘ Link', 1400);
			}catch{
				urlField.select(); document.execCommand('copy');
				showToast('Link disalin');
			}
		});
		urlField.addEventListener('click', ()=> urlField.select());
		urlField.addEventListener('focus', ()=> urlField.select());

		// copy image (mirip dashboard)
		async function copyImageToClipboard(url){
			const canImageClipboard = window.isSecureContext && window.ClipboardItem && navigator.clipboard && navigator.clipboard.write;
			if(!canImageClipboard){
				// fallback download
				download(url);
				showToast('Browser tidak support copy gambar — diunduh');
				return false;
			}
			const res = await fetch(url, {cache:'no-store'});
			if(!res.ok) throw new Error('HTTP '+res.status);
			const blob = await res.blob();
			const item = new ClipboardItem({'image/png': blob});
			await navigator.clipboard.write([item]);
			return true;
		}
		function download(url){
			const a=document.createElement('a');
			a.href=url; a.download='streak-'+ (nama.value.trim().replace(/\s+/g,'-').toLowerCase() || 'peserta') +'-'+ clampHari(hari.value) +'hari.png';
			a.rel='noopener'; document.body.appendChild(a); a.click(); a.remove();
		}
		btnCopyImg.addEventListener('click', async ()=>{
			if(btnCopyImg.classList.contains('loading')) return;
			const {fetchUrl} = buildUrl();
			// pastikan preview sudah ada; pakai fetchUrl biar fresh
			btnCopyImg.classList.add('loading');
			copyText.textContent='Menyalin…';
			try{
				await copyImageToClipboard(fetchUrl);
				btnCopyImg.classList.add('done');
				copyIcon.textContent='✓'; copyText.textContent='Tersalin!';
				showToast('Gambar streak disalin ke clipboard ✓');
				setTimeout(()=>{ btnCopyImg.classList.remove('done','loading'); copyIcon.textContent='⎘'; copyText.textContent='Copy Gambar'; }, 1600);
			}catch(e){
				btnCopyImg.classList.remove('loading');
				copyText.textContent='Gagal, mengunduh…';
				showToast('Gagal menyalin, mengunduh PNG');
				download(fetchUrl);
				setTimeout(()=>{ copyText.textContent='Copy Gambar'; }, 1400);
			}
		});

		$('#btnOpen').addEventListener('click', ()=>{
			const {fetchUrl} = buildUrl();
			window.open(fetchUrl, '_blank', 'noopener');
		});
		$('#btnDownload').addEventListener('click', ()=>{
			const {fetchUrl} = buildUrl();
			download(fetchUrl);
			showToast('PNG diunduh');
		});

		// keyboard: Ctrl+Enter copy image
		document.addEventListener('keydown', e=>{
			if((e.ctrlKey||e.metaKey) && e.key==='Enter'){ e.preventDefault(); btnCopyImg.click(); }
		});

		// init
		updateMeta();
		refreshPreview();
	</script>
</body>
</html>
