<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Presensi</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url("index.php/pages/presensi") ?>">Presensi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Presensi</li>
    </ol>
</div>
<div class="container col-lg-6">
    <!-- Form Basic -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?php echo base_url() . 'index.php/presensi/tambah'; ?>" method="POST">
                <div class="row">
                    <div class="form-group col-md-12" id="simple-date1">
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="text" name="tgl" class="form-control" placeholder="Tanggal Hadir" id="simpleDataInput" maxlength=20 required value="<?php echo date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <select class="form-control" id="nama" aria-describedby="emailHelp" name="nama" maxlength=50 required>
                            <option selected value="">Nama Peserta</option>
                            <?php
                            $data = $this->db->query("SELECT Nama,Nipd FROM peserta")->result();
                            foreach ($data as $row) { ?>
                                <option value="<?php echo $row->Nipd ?>">
                                    <?php echo $row->Nama ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="jks" aria-describedby="emailHelp" placeholder="Jenis Kursus" name="jks" maxlength="50" required>
                    </div>
                    <div class="form-group col-md-12">
                        <select type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Instruktur" maxlength=20 required>
                            <option disabled selected value="">Instruktur</option>
                            <?php
                            $data = $this->db->query("SELECT Id,NamaInstruktur FROM instruktur")->result();
                            foreach ($data as $row) { ?>
                                <option value="<?php echo $row->Id ?>">
                                    <?php echo $row->NamaInstruktur ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Materi" name="materi" maxlength="50" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?php echo base_url("index.php/pages/presensi") ?>" class="btn btn-secondary" role="button">Batal</a>
            </form>
        </div>
    </div>
</div>
