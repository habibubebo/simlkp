<h2>Daftar Alumni</h2>
<a href="<?= base_url('alumni/tambah') ?>">Tambah Alumni</a>
<table border="1">
    <tr>
        <th>NIK</th><th>Nama</th><th>Tahun</th><th>Pelatihan</th><th>Aksi</th>
    </tr>
    <?php foreach ($alumni as $key => $a): ?>
        <tr>
            <td><?= $a['nik'] ?></td>
            <td><?= $a['nama'] ?></td>
            <td><?= $a['tahun'] ?></td>
            <td><?= $a['judul_pelatihan'] ?></td>
            <td>
                <a href="<?= base_url("alumni/detail/{$a['nik']}/{$a['tahun']}") ?>">Detail</a> |
                <a href="<?= base_url("alumni/edit/{$a['nik']}/{$a['tahun']}") ?>">Edit</a> |
                <a href="<?= base_url("alumni/hapus/{$a['nik']}/{$a['tahun']}") ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
