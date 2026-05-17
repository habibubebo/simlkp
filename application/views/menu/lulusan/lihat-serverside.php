<!-- Header -->
<style type="text/css">
    .txtedit {
      display: none;
      width: 100%;
    }
  </style>
<div class="d-sm-flex align-items-center justify-content-between mt-4 mb-2">
  <h1 class="h3 mb-0 text-gray-800">Lulusan</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Lulusan</li>
  </ol>
</div>
<!-- Content -->
<div class="row">
  <div class="col-xl mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="my-auto">Catatan</h5>
                        <span class="text-warning">Klik pada teks untuk edit</span>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead hidden>
                                <tr>
                                    <th></th>
                                    <th width='10%'></th>
                                    <th width='90%'></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php foreach ($notes as $tp) { ?>
                                    <tr>
                                        <td hidden><a class="text-danger" href="<?= base_url('admin/deletemaster/pk/' . $tp->id) ?>">Del</a></td>
                                        <td><b class="text-info">
                                            <span class='edit'><?= $tp->jenis ?></span>
                                            <input type='text' class='txtedit pk' data-id='<?= $tp->id ?>' data-field='jenis' id='jenistxt_<?= $tp->id ?>' value='<?= $tp->jenis ?>'></b>
                                        </td>
                                        <td>
                                            <span class='edit'><?= $tp->data ?></span>
                                            <input type='text' class='txtedit pk' data-id='<?= $tp->id ?>' data-field='data' id='datatxt_<?= $tp->id ?>' value='<?= $tp->data ?>'>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</div>
<div class="row">
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">

      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="tabellulusan">
          <thead class="thead-light">
            <tr>
              <th>Nama</th>
              <th>No Induk</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kursus</th>
              <th>Tanggal Masuk</th>
              <th>Tanggal Lulus</th>
              <th>Tanggal Cetak</th>
              <th>Instruktur</th>
              <th>Nilai</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($lulusan as $tp) {

            ?>
              <tr>
                <td><?= $tp->Nama ?></td>
                <td><?= $tp->Nipd ?></td>
                <td><?= $tp->Ttl ?></td>
                <td><?= $tp->Namarombel ?></td>
                <td><?= date("d-m-Y",strtotime($tp->Tglmasuk))  ?></td>
                <td><?= date("d-m-Y",strtotime($tp->Tgllulus))  ?></td>
                <td><?= date("d-m-Y",strtotime($tp->Tglcetak))  ?></td>
                <td><?= $tp->NamaInstruktur ?></td>
                <td><?= $tp->n1 . ',' . $tp->n2 . ',' . $tp->n3 . ',' . $tp->n4 . ',' . $tp->n5 ?></td>
                <td>
                  <div class="btn-group btn-group-toggle">
                    <label class="btn btn-info btn-sm">
                    <a href="<?= base_url("lulusan/form_ubah/$tp->Idl") ?>" class="text-white" title="Klik untuk merubah data.">
                    <i class="fas fa-pen-alt"></i>
                    </a>
                    </label>
                    <label class="btn btn-warning btn-sm">
                    <a href="<?= base_url("sertifikat?Id=$tp->Idl") ?>" class="text-white print" disabled title="Klik untuk mencetak pdf.">
                    <i class="fas fa-print"></i>
                    </a>
                    </label>
                    <label class="btn btn-danger btn-sm">
                    <a href="#" class="text-white" data-toggle="modal" data-target="#deleteuser<?= $tp->Idl; ?>" title="Klik untuk menghapus data.">
                    <i class="fas fa-trash-alt"></i>
                    </a>
                    </label>
                  </div>
                  
                  <!-- modal delete -->
                  <div class="example-modal">
                    <div id="deleteuser<?= $tp->Idl; ?>" class="modal fade" role="dialog" style="display:none;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title">Konfirmasi Delete Data</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body">
                            <h6 align="center">Apakah anda yakin ingin menghapus data <?= $tp->Nama; ?><strong><span class="grt"></span></strong> ?</h6>
                          </div>
                          <div class="modal-footer">
                            <a href="<?= base_url('lulusan/hapus/' . $tp->Idl) ?>" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal delete -->
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- modal tambah -->
<div class="example-modal">
  <div id="modalTambah" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Tambah Lulusan</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
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
                                <table class="mx-auto">
                                  <tr>
                                    <td><span id="Uk1">Unit Kompetensi 1</span></td>
                                    <td class="col-3"><input type="text" class="form-control" placeholder="Nilai" name="n1" maxlength="1"></td>
                                  </tr>
                                  <tr>
                                    <td><span id="Uk2">Unit Kompetensi 2</span></td>
                                    <td class="col-3"><input type="text" class="form-control" placeholder="Nilai" name="n2" maxlength="1"></td>
                                  </tr>
                                  <tr>
                                    <td><span id="Uk3">Unit Kompetensi 3</span></td>
                                    <td class="col-3"><input type="text" class="form-control" placeholder="Nilai" name="n3" maxlength="1"></td>
                                  </tr>
                                  <tr>
                                    <td><span id="Uk4">Unit Kompetensi 4</span></td>
                                    <td class="col-3"><input type="text" class="form-control" placeholder="Nilai" name="n4" maxlength="1"></td>
                                  </tr>
                                  <tr>
                                    <td><span id="Uk5">Unit Kompetensi 5</span></td>
                                    <td class="col-3"><input type="text" class="form-control" placeholder="Nilai" name="n5" maxlength="1"></td>
                                  </tr>
                                </table>
                </div>
              </div>
              <div class="modal-footer">
                <a href="#" data-dismiss="modal" aria-label="Close" class="btn btn-secondary" role="button">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
      </div>
    </div>
  </div>
  </div>
<!-- end modal tambah -->
<script type="text/javascript">
  document.title = "Lulusan <?= $profil[0]->Namalkp?>";
</script>
<script type="text/javascript">
            $(document).ready(function() {

                // On text click
                $('.edit').click(function() {

                    // Hide input element
                    $('.txtedit').hide();

                    // Show next input element
                    $(this).next('.txtedit').show().focus();

                    // Hide clicked element
                    $(this).hide();
                });
                 $('.txtedit.pk').focusout(function() {
                    // Get edit id, field name and value
                    var edit_id = $(this).data('id');
                    var fieldname = $(this).data('field');
                    var value = $(this).val();

                    // Hide Input element
                    $(this).hide();

                    // Update viewing value and display it
                    $(this).prev('.edit').show();
                    $(this).prev('.edit').text(value);

                    // Send AJAX request
                    $.ajax({
                        url: '<?= base_url() ?>lulusan/notes/update',
                        type: 'post',
                        data: {
                            field: fieldname,
                            value: value,
                            id: edit_id
                        },
                        success: function(response) {
                            console.log(response);

                        }
                    });
                });
                 });
               </script>
<script>
    function GetDetail(str) {
        if (str.length == 0) {
            document.getElementById("nama").value = "";
            document.getElementById("jk").value = "";
            document.getElementById("ttl").value = "";
            document.getElementById("jks").value = "";
            document.getElementById("tm").value = "";
            document.getElementById("Uk1").innerText = "Unit Kompetensi 1";
            document.getElementById("Uk2").innerText = "Unit Kompetensi 2";
            document.getElementById("Uk3").innerText = "Unit Kompetensi 3";
            document.getElementById("Uk4").innerText = "Unit Kompetensi 4";
            document.getElementById("Uk5").innerText = "Unit Kompetensi 5";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 &&
                    this.status == 200) {
                    var myObj = JSON.parse(this.responseText);
                    // console.log(myObj);
                    $.each(myObj, function(i) {
                        document.getElementById("nama").value = myObj[i].Nama;
                        document.getElementById("jk").value = myObj[i].Kelamin;
                        document.getElementById("ttl").value = myObj[i].Ttl;
                        document.getElementById("jks").value = myObj[i].Jeniskursus;
                        document.getElementById("tm").value = myObj[i].Tglmasuk;
                        document.getElementById("Uk1").innerText = myObj[i].Uk1;
                        document.getElementById("Uk2").innerText = myObj[i].Uk2;
                        document.getElementById("Uk3").innerText = myObj[i].Uk3;
                        document.getElementById("Uk4").innerText = myObj[i].Uk4;
                        document.getElementById("Uk5").innerText = myObj[i].Uk5;
                    });
                }
            };
            xmlhttp.open("POST", "<?= base_url() ?>pesertas/nipd", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("Nipd=" + str);
        }
    }
</script>