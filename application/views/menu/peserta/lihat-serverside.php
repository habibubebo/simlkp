<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mt-4 mb-2">
  <h1 class="h3 mb-0 text-gray-800 d-none d-sm-block">Peserta</h1>
  <ol class="breadcrumb mb-0">
    <li class="breadcrumb-item">Menu</li>
    <li class="breadcrumb-item active" aria-current="page">Peserta</li>
  </ol>
</div>
<!-- Content -->
<?php
$alert = $this->session->flashdata('alert');
if (isset($alert)) {
  echo '<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <h6><i class="fas fa-exclamation-triangle"></i><b> Informasi</b></h6>
    <strong>' . $alert . '</strong>
  </div>';
};
?>
<div class="row">
  <!-- DataTable with Hover -->
  <!-- <div class="col-lg-12"> -->
    <div class="card mb-4">
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="tabelpeserta-tes">
          <thead class="thead-light">
            <tr>
              <th>Status</th>
              <th>NIPD</th>
              <!-- <th>No KK / NIK</th> -->
              <th>Nama Peserta</th>
              <th>Jenis Kelamin</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kursus / Kelas</th>
              <th>Tanggal Masuk</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
<!-- </div> -->

<!-- modal tambah -->
<div class="example-modal peserta">
  <div id="tambahPeserta" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Tambah Peserta Baru</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
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
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Kartu Keluarga" name="Nokk" maxlength=30 value="-">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Induk Keluarga" name="Nik" maxlength=30 value="-">
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
                      <?php echo $row->Namarombel . ' - ' . $row->Kelas ?>
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
    <!-- end modal tambah -->
    <script type="text/javascript">
      document.title = "Peserta Didik <?= $profil[0]->Namalkp ?>";
    </script>

    <script>
      var tabel = null;
      
      // Fungsi untuk memperbarui parameter URL
      function updateUrlParameter(url, param, paramVal) {
        var newUrl = new URL(url);
        newUrl.searchParams.set(param, paramVal);
        return newUrl.toString();
      }
      $(document).ready(function() {
        // Ambil parameter dari URL
        var urlParams = new URLSearchParams(window.location.search);
        var page = urlParams.get('page') || 1; // Halaman default 1
        var search = urlParams.get('search') || ''; // Pencarian default kosong

        tabel = $('#tabelpeserta-tes').DataTable({
          "processing": true,
          "responsive": true,
          "serverSide": true,
          "ordering": true,
          "order": [
            [1, 'desc']
          ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
          "ajax": {
            "url": "<?= base_url('cek/view2'); ?>",
            "type": "POST"
          },
          "deferRender": true,
          "aLengthMenu": [
            [10, 50, 100],
            [10, 50, 100]
          ],
          "columns": [{
              "data": "Status"
            },
            {
              "data": "Nipd"
            },
            {
              "data": "Nama"
            },
            {
              "data": "Kelamin"
            },
            {
              "data": "Ttl"
            },
            {
              "data": "Namarombel"
            },
            {
              "data": "Tglmasuk"
            },
            {
              "data": "Idp"
            }
          ],
          columnDefs: [{
            targets: 0,
            orderable: !1,
            render: function(e, a, t, r) {
              if (t.Status == '0') {
                t = '<span class="badge bg-danger text-white">Nonaktif</span>'
              } else if (t.Status == '1') {
                t = '<span class="badge bg-success text-white">Aktif</span>'
              } else {
                t = '<span class="badge bg-secondary text-white">Lulus</span>'
              };
              return t
            }
          }, {
            className: "t",
            targets: 2,
            render: function(e, a, t, r) {
              return '<a class="btn" style="width:max-content" href="' + appPath + 'presensi/peserta?Id=' + t.Idp + '">' + t.Nama + '</a>'
            }
          }, {
            className: "",
            targets: -2,
            render: function(e, a, t, r) {
              return new Date(t.Tglmasuk).toISOString()
                .slice(0, 10)
                .split("-")
                .reverse()
                .join("/");
            }
          }, {
            className: "noExport",
            targets: -1,
            render: function(e, a, t, r) {
              return '<div class="btn-group btn-group-toggle"><label class="btn btn-warning btn-sm"><a class="text-white" href="' + appPath + 'peserta/form_ubah/' + t.Idp + '" title="Klik untuk merubah data.">' +
                '<i class="fas fa-pen-alt"></i></a></label><label class="btn btn-danger btn-sm"><a class="text-white" href="#" data-toggle="modal" data-target="#deleteuser' + t.Idp + '" title="Klik untuk menghapus data.">' +
                '<i class="fas fa-trash-alt"></i></a></label></div>' +
                '<div class="example-modal"><div id="deleteuser' + t.Idp + '" class="modal fade" role="dialog" style="display:none;">' +
                '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h3 class="modal-title">Konfirmasi Delete Data</h3>' +
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' +
                '<div class="modal-body"><h6 align="center">Apakah anda yakin ingin menghapus data ' + t.Nama + '<strong><span class="grt"></span></strong> ?</h6></div>' +
                '<div class="modal-footer"><a href="' + appPath + 'peserta/hapus/' + t.Idp + '" class="btn btn-danger"><i class="fa fa-trash"> </i> Hapus</a></div> </div> </div> </div> </div>'
            }
          }, ],
          dom: 'Bfrtl<"d-flex justify-content-between"<"p-1">p>',
          "search": {
            "search": ""
          },
          language: {
            searchPlaceholder: "Pencarian",
            search: ""
          },
          buttons: [{
              text: '<i class="fas fa-plus"></i> Tambah',
              className: 'btn btn-info',
              action: function() {
                $("#tambahPeserta").modal();
              }
            },
            {
              extend: 'excelHtml5',
              text: '<i class="fas fa-file-excel"></i> Export Excel',
              className: 'btn btn-success',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
              }
            },
            {
              extend: 'pdfHtml5',
              text: '<i class="fas fa-file-pdf"></i> Export PDF',
              className: 'btn btn-danger',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
              }
            },
            {
              extend: 'print',
              text: '<i class="fas fa-print"></i> Print',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
              }
            }
          ]
        });
        tabel.on('page.dt', function() {
        var pageInfo = tabel.page.info();
        var currentPage = pageInfo.page + 1; // Halaman saat ini (1-indexed)
        var searchValue = tabel.search(); // Nilai pencarian
  
        // Update URL
        var newUrl = updateUrlParameter(window.location.href, 'page', currentPage);
        newUrl = updateUrlParameter(newUrl, 'search', searchValue);
        window.history.replaceState(null, '', newUrl);
      });
  
      tabel.on('search.dt', function() {
        var pageInfo = tabel.page.info();
        var currentPage = pageInfo.page + 1; // Halaman saat ini (1-indexed)
  
        // Update URL
        var newUrl = updateUrlParameter(window.location.href, 'page', currentPage);
        newUrl = updateUrlParameter(newUrl, 'search', tabel.search());
        window.history.replaceState(null, '', newUrl);
      });
      });
    </script>