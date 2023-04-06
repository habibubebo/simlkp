<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Lulusan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url("index.php/pages/lulusan") ?>">Lulusan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah Lulusan</li>
    </ol>
</div>

<div class="container col-lg-6">
    <!-- Form Basic -->
    <div class="card mb-4">
        <div class="card-body">
            <?php foreach ($lulusan as $tp); ?>
            <form action="<?php echo base_url() . 'index.php/lulusan/ubah'; ?>" method="POST">
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="exampleInputEmail1" hidden aria-describedby="emailHelp" placeholder="Id" name="Id" value="<?php echo $tp->Id ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nomor Induk" name="nipd" maxlength=20 required value="<?php echo $tp->Nipd ?>">
                    </div>
                    <div class="form-group col-md-8">
                        <select type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Instruktur" maxlength=20 required>
                            <option selected value="<?php echo $tp->Instruktur ?>"><?php echo $tp->NamaInstruktur ?></option>
                            <?php
                            $data = $this->db->query("SELECT * FROM instruktur")->result();
                            foreach ($data as $row) { ?>
                                <option value="<?php echo $row->Id ?>">
                                    <?php echo $row->NamaInstruktur ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6" id="simple-date1">
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="text" name="tl" class="form-control" placeholder="Tgl Lulus" id="simpleDataInput" maxlength=30 required value="<?php echo $tp->Tgllulus ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-6" id="simple-date1">
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="text" name="tc" class="form-control" placeholder="Tgl Cetak" id="simpleDataInput" maxlength=30 required value="<?php echo $tp->Tglcetak ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nilai 1" name="n1" maxlength="1" required value="<?php echo $tp->n1 ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nilai 2" name="n2" maxlength="1" required value="<?php echo $tp->n2 ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nilai 3" name="n3" maxlength="1" required value="<?php echo $tp->n3 ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nilai 4" name="n4" maxlength="1" required value="<?php echo $tp->n4 ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?php echo base_url("index.php/pages/lulusan") ?>" class="btn btn-secondary" role="button">Batal</a>
            </form>
        </div>
    </div>
</div>
