<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Lulusan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url("pages/lulusan") ?>">Lulusan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Lulusan</li>
    </ol>
</div>
<div class="container col-lg-6">
    <!-- Form Basic -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?php echo base_url() . 'lulusan/tambah'; ?>" method="POST">
                <div class="row">
                    <div class="form-group col-md-4">
                        <select type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nomor Induk" name="nipd" maxlength=20 required onchange="GetDetail(this.value)">
                            <option value="">Pilih</option>
                            <?php
                            $data = $this->db->query("SELECT Nipd FROM peserta AS td WHERE STATUS=2 AND NOT EXISTS (SELECT Nipd FROM lulusan AS d WHERE Nipd=td.Nipd) order by Nipd DESC")->result();
                            foreach ($data as $row) { ?>
                                <option value="<?php echo $row->Nipd ?>">
                                    <?php echo $row->Nipd ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <input class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Nama" name="nmlulusan" maxlength=50 disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <select class="form-control" id="jk" aria-describedby="emailHelp" name="jk" disabled>
                            <option value="">Kelamin</option>
                            <option value="Laki - Laki">Laki - laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" id="ttl" aria-describedby="emailHelp" placeholder="Tempat Tanggal Lahir" name="ttl" maxlength="30" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="jks" aria-describedby="emailHelp" placeholder="Jenis Kursus" name="jks" maxlength="30" disabled>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
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
                    <div class="form-group col-md-4" id="simple-date2">
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="tmp"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="text" name="tm" class="form-control" placeholder="Tgl Masuk" id="tm" maxlength=30 disabled>
                        </div>
                    </div>
                    <div class="form-group col-md-4" id="simple-date1">
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="text" name="tl" class="form-control" placeholder="Tgl Lulus" id="tl" maxlength=30 required>
                        </div>
                    </div>
                    <div class="form-group col-md-4" id="simple-date1">
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="text" name="tc" class="form-control" placeholder="Tgl Cetak" id="tc" maxlength=30 required>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nilai 1" name="n1" maxlength="1">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nilai 2" name="n2" maxlength="1">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nilai 3" name="n3" maxlength="1">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nilai 4" name="n4" maxlength="1">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?php echo base_url("pages/lulusan") ?>" class="btn btn-secondary" role="button">Batal</a>
            </form>
        </div>
    </div>
</div>
<script>
    function GetDetail(str) {
        if (str.length == 0) {
            document.getElementById("nama").value = "";
            document.getElementById("jk").value = "";
            document.getElementById("ttl").value = "";
            document.getElementById("jks").value = "";
            document.getElementById("tm").value = "";
            return;
        } else {

            // Creates a new XMLHttpRequest object
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {

                if (this.readyState == 4 &&
                    this.status == 200) {

                    var myObj = JSON.parse(this.responseText);

                    console.log(myObj);
                    $.each(myObj, function(i) {

                        document.getElementById("nama").value = myObj[i].Nama;
                        document.getElementById("jk").value = myObj[i].Kelamin;
                        document.getElementById("ttl").value = myObj[i].Ttl;
                        document.getElementById("jks").value = myObj[i].Jeniskursus;
                        document.getElementById("tm").value = myObj[i].Tglmasuk;

                    });

                }
            };

            xmlhttp.open("POST", "<?= base_url() ?>pesertas/nipd", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("Nipd=" + str);
        }
    }
</script>