<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Lulusan</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url("index.php/pages/lulusan")?>">Lulusan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Lulusan</li>
  </ol>
</div>
<div class="container col-lg-6">
    <!-- Form Basic -->
    <div class="card mb-4">
        <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Sarana Prasarana</h6>
        </div> -->
        <div class="card-body">
            <form action="<?php echo base_url().'index.php/lulusan/tambah'; ?>" method="POST">
                <div class="row">
					<div class="form-group col-md-12">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Nomor Induk" name="Nipd" maxlength=20 required onkeyup="GetDetail(this.value)">
                    </div>
					<div class="form-group col-md-8">
                        <input class="form-control" id="nama" aria-describedby="emailHelp"
                         name="nmlulusan" maxlength=50 required>
                        
                    </div>
                    <div class="form-group col-md-4">
                        <select class="form-control" id="jk" aria-describedby="emailHelp" name="jk" required>
                            <option value="">Kelamin</option>
                            <option value="Laki - Laki">Laki - laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
					 <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="ttl" aria-describedby="emailHelp"
                        placeholder="Tempat Tanggal Lahir" name="ttl" maxlength="30" required>
                    </div>
					<div class="form-group col-md-6">
                        <select class="form-control" id="jks" aria-describedby="emailHelp"
                         name="jks" maxlength=50 required>
                        <option disabled selected value="">Jenis Kursus</option>
                            <?php
                            $data = $this->db->query("SELECT * FROM rombel")->result();
                            foreach ($data as $row){ ?>    
                                <option value="<?php echo $row->Namarombel ?>">
                                <?php echo $row->Namarombel ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6" id="simple-date1">
                        <div class="input-group date">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="text" name="tl" class="form-control" placeholder="Tanggal Lulus" id="simpleDataInput" maxlength=30 required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <select type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="Instruktur" maxlength=20 required>
                        <option disabled selected value="">Instruktur</option>
                            <?php
                            $data = $this->db->query("SELECT * FROM instruktur")->result();
                            foreach ($data as $row){ ?>    
                                <option value="<?php echo $row->NamaInstruktur ?>">
                                <?php echo $row->NamaInstruktur ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
					<div class="form-group col-md-3">
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Nilai 1" name="n1" maxlength="1" required>
					</div>
					<div class="form-group col-md-3">
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Nilai 2" name="n1" maxlength="1" required>
					</div>
					<div class="form-group col-md-3">
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Nilai 3" name="n1" maxlength="1" required>
					</div>
					<div class="form-group col-md-3">
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Nilai 4" name="n1" maxlength="1" required>
					</div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
<script>

// onkeyup event will occur when the user
// release the key and calls the function
// assigned to this event
function GetDetail(str) {
    if (str.length == 0) {
        document.getElementById("nama").value = "";
        document.getElementById("jk").value = "";
        document.getElementById("ttl").value = "";
        document.getElementById("jks").value = "";
        return;
    }
    else {

        // Creates a new XMLHttpRequest object
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {

            // Defines a function to be called when
            // the readyState property changes
            if (this.readyState == 4 &&
                    this.status == 200) {
                
                // Typical action to be performed
                // when the document is ready
                var myObj = JSON.parse(this.responseText);

                // Returns the response data as a
                // string and store this array in
                // a variable assign the value
                // received to first name input field
                
                document.getElementById
                    ("nama").value = myObj[0];
                
                // Assign the value received to
                // last name input field
                document.getElementById(
                    "jk").value = myObj[1];
                document.getElementById(
                    "ttl").value = myObj[2];
                document.getElementById(
                    "jks").value = myObj[3];
            }
        };

        // xhttp.open("GET", "filename", true);
        xmlhttp.open("GET", "kon.php?nipd=" + str, true);
        
        // Sends the request to the server
        xmlhttp.send();
    }
}

</script>