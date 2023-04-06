<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Unit Kompetensi</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url("index.php/pages/uk") ?>">Unit Kompetensi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah Unit Kompetensi</li>
    </ol>
</div>

<div class="container col-lg-6">
    <!-- Form Basic -->
    <div class="card mb-4">
        <div class="card-body">
            <?php foreach ($uks as $tp); ?>
            <form action="<?php echo base_url() . 'index.php/uk/ubah'; ?>" method="POST">
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="exampleInputEmail1" hidden aria-describedby="emailHelp" placeholder="ID" name="Id" value="<?php echo $tp->Id ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <select class="form-control" id="rombel" aria-describedby="emailHelp" name="rombel" maxlength=50>
                            <option selected value="<?php echo $tp->Rombel ?>"><?php echo $tp->Namarombel.' - '.$tp->Kelas ?></option>
                            <?php
                            $data = $this->db->query("SELECT * FROM rombel")->result();
                            foreach ($data as $row) { ?>
                                <option value="<?php echo $row->Id ?>">
                                    <?php echo $row->Namarombel.' - '.$row->Kelas ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unit 1" name="uk1" maxlength=50 required value="<?php echo $tp->Uk1 ?>">
                    </div>
                     <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="JP 1" name="jp1" maxlength=50 required value="<?php echo $tp->Jp1 ?>">
                    </div>
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unit 2" name="uk2" maxlength=50 required value="<?php echo $tp->Uk2 ?>">
                    </div>
                     <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="JP 2" name="jp2" maxlength=50 required value="<?php echo $tp->Jp2 ?>">
                    </div>
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unit 3" name="uk3" maxlength=50 required value="<?php echo $tp->Uk3 ?>">
                    </div>
                     <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="JP 3" name="jp3" maxlength=50 required value="<?php echo $tp->Jp3 ?>">
                    </div>
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unit 4" name="uk4" maxlength=50 value="<?php echo $tp->Uk4 ?>">
                    </div>
                     <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="JP 4" name="jp4" maxlength=50 value="<?php echo $tp->Jp4 ?>">
                    </div>
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unit 5" name="uk5" maxlength=50 value="<?php echo $tp->Uk5 ?>">
                    </div>
                     <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="JP 5" name="jp5" maxlength=50 value="<?php echo $tp->Jp5 ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Total JP" name="jptotal" maxlength=50 value="<?php echo $tp->Jptotal ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?php echo base_url("index.php/pages/uk") ?>" class="btn btn-secondary" role="button">Batal</a>
            </form>
        </div>
    </div>
</div>