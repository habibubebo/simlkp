<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Alumni</title>
</head>
<body>

    <h2>Edit Data Alumni</h2>

    <form method="post">
        <input type="hidden" name="nik" value="<?= $alumni['nik'] ?>">

        <label>Nama</label><br>
        <input type="text" name="nama" value="<?= $alumni['nama'] ?>" required><br>

        <label>Tanggal Lahir</label><br>
        <input type="text" name="tanggal_lahir" value="<?= $alumni['tanggal_lahir'] ?>" required><br>

        <label>Judul Pelatihan</label><br>
        <input type="text" name="judul_pelatihan" value="<?= $alumni['judul_pelatihan'] ?>" required><br>

        <label>Tahap</label><br>
        <input type="text" name="tahap" value="<?= $alumni['tahap'] ?>" required><br>

        <label>Tahun</label><br>
        <input type="text" name="tahun" value="<?= $alumni['tahun'] ?>" required><br>

        <label>Path Foto</label><br>
        <input type="text" name="foto" value="<?= $alumni['foto'] ?>" required><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

</body>
</html>
