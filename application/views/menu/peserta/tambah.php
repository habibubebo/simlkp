<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Peserta</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url("pages/peserta") ?>">Peserta</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Peserta</li>
    </ol>
</div>
<div class="container col-lg-6">
    <!-- Form Basic -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?php echo base_url() . 'peserta/tambah'; ?>" method="POST">
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nomor Induk" name="Nipd" maxlength=20 required>
                    </div>
                    <div class="form-group col-md-6">
                        <select class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Status" required>
                            <option disabled selected value="">Status</option>
                            <option value="0">Nonaktif</option>
                            <option value="1">Aktif</option>
                            <option value="2">Lulus</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Kartu Keluarga" name="Nokk" maxlength=30 required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Induk Keluarga" name="Nik" maxlength=30 required>
                    </div>
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Peserta" name="Nama" maxlength=50 required>
                    </div>
                    <div class="form-group col-md-4">
                        <select class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Jk" required>
                            <option disabled selected value="">Kelamin</option>
                            <option value="Laki - Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8" id="exampleInputEmail1">
                        <div class="input-group">
                            <input type="text" name="Tgl" class="form-control" placeholder="Tempat, Tanggal Lahir" id="simpleDataInput" maxlength=50 required>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <select class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Jenis" maxlength=50 required>
                            <option disabled selected value="">Jenis Kursus</option>
                            <?php
                            $data = $this->db->query("SELECT * FROM rombel")->result();
                            foreach ($data as $row) { ?>
                                <option value="<?php echo $row->Id ?>">
                                    <?php echo $row->Namarombel ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <select type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Kls" maxlength=20 required>
                            <option disabled selected value="">Kelas</option>
                            <?php
                            foreach ($rombel as $row) { ?>
                                <option value="<?php echo $row->Kelas ?>">
                                    <?php echo $row->Kelas ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6" id="simple-date2">
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="text" name="Tglmasuk" class="form-control" placeholder="Tanggal Masuk" id="simpleDataInput" maxlength=20 required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?php echo base_url("pages/peserta") ?>" class="btn btn-secondary" role="button">Batal</a>
            </form>
        </div>
    </div>
</div>