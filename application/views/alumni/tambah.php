<!DOCTYPE html>
<html>
<head>
    <title>Tambah Alumni</title>
    <style>
        .tab {
            display: inline-block;
            margin: 5px;
            padding: 10px 20px;
            background-color: #ddd;
            cursor: pointer;
        }

        .tab.active {
            background-color: #007bff;
            color: white;
        }

        .form-section {
            display: none;
            margin-top: 20px;
        }

        .form-section.active {
            display: block;
        }
    </style>
</head>
<body>

    <h2>Tambah Data Alumni</h2>

    <!-- Tab Buttons -->
    <div id="tabs">
        <div class="tab active" data-target="#form-satu">Satu Alumni</div>
        <div class="tab" data-target="#form-batch">Batch Alumni</div>
    </div>

    <!-- Form Input Satu Alumni -->
    <div id="form-satu" class="form-section active">
        <form method="post">
            <input type="text" name="alumni[nik]" placeholder="NIK" required><br>
            <input type="text" name="alumni[nama]" placeholder="Nama" required><br>
            <input type="text" name="alumni[tanggal_lahir]" placeholder="Tanggal Lahir" required><br>
            <input type="text" name="alumni[judul_pelatihan]" placeholder="Judul Pelatihan" required><br>
            <input type="text" name="alumni[tahap]" placeholder="Tahap" required><br>
            <input type="text" name="alumni[tahun]" placeholder="Tahun" required><br>
            <input type="text" name="alumni[foto]" placeholder="Path Foto" required><br>
            <button type="submit">Simpan</button>
        </form>
    </div>

    <!-- Form Input Batch Alumni -->
    <div id="form-batch" class="form-section">
        <form method="post">
            <?php for ($i = 0; $i < 16; $i++): ?>
                <fieldset style="border:1px solid #ccc;padding:10px;margin:10px 0;">
                    <legend>Alumni <?= $i+1 ?></legend>
                    <input type="text" name="alumni[<?= $i ?>][nik]" placeholder="NIK" required><br>
                    <input type="text" name="alumni[<?= $i ?>][nama]" placeholder="Nama" required><br>
                    <input type="text" name="alumni[<?= $i ?>][tanggal_lahir]" placeholder="Tanggal Lahir" required><br>
                    <input type="text" name="alumni[<?= $i ?>][judul_pelatihan]" placeholder="Judul Pelatihan" required><br>
                    <input type="text" name="alumni[<?= $i ?>][tahap]" placeholder="Tahap" required><br>
                    <input type="text" name="alumni[<?= $i ?>][tahun]" placeholder="Tahun" required><br>
                    <input type="text" name="alumni[<?= $i ?>][foto]" placeholder="Path Foto" required><br>
                </fieldset>
            <?php endfor; ?>
            <button type="submit">Simpan Semua</button>
        </form>
    </div>

    <script>
        const tabs = document.querySelectorAll('.tab');
        const sections = document.querySelectorAll('.form-section');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                sections.forEach(s => s.classList.remove('active'));

                tab.classList.add('active');
                document.querySelector(tab.dataset.target).classList.add('active');
            });
        });
    </script>

</body>
</html>
