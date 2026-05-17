    <!-- modal presensi -->
<div class="example-modal presensi">
                    <div id="tambahPres" class="modal fade" role="dialog" style="display:none;">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title">Tambah Presensi Pegawai</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </div>
                          <div class="modal-body">
                          <form action="<?php echo base_url() . 'presensi/tambahpegawai'; ?>" method="POST">
                          <div class="form-group col-md-12">
                            <select type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nipg" required>
                              <option disabled selected value="">Nama Pegawai</option>
                              <?php
                              $data = $this->db->query("SELECT Nipg,NamaPegawai FROM pegawai")->result();
                              foreach ($data as $row) { ?>
                                <option value="<?php echo $row->Nipg ?>">
                                  <?php echo $row->NamaPegawai ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>
                            <div class="form-group col-md-12" id="simple-date3">
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="text" name="tgl" class="form-control" placeholder="Tanggal" id="simpleDataInput" maxlength=20 value="<?php echo date('Y-m-d H:i:s') ?>" required>
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
                      </div>
<!-- end modal presensi -->
    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-danger" id="exampleModalLabelLogout">
              <i class="fas fa-exclamation-triangle"></i> Keluar
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah kamu ingin keluar?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
            <a href="<?= base_url('index.php/login/logout'); ?>" class="btn btn-danger">Keluar</a>
          </div>
        </div>
      </div>
    </div>

    </div>
    <!---Container Fluid-->
    </div>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Waktu render : {elapsed_time} ms <br>Copyright &copy; <script>
              document.write(new Date().getFullYear());
            </script> - developed by
            <b><a href="https://instagram.com/habibubebo" target="_blank">Habibubebo</a></b>
            <div class="mb-2">
              <a href="<?= base_url('index.php/pages/log'); ?>"><small>(Version 0.8 Beta)</small></a>

            </div>
          </span>
        </div>
      </div>
    </footer>
    <!-- Footer -->
    </div>
    </div>
    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- <script src="<?= base_url("asset/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>"></script> -->
    <!-- <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="<?= base_url("asset/vendor/jquery-easing/jquery.easing.min.js") ?>"></script>
    
    <!-- Page level plugins -->
    <script src="<?= base_url("asset/vendor/datatables/jquery.dataTables.min.js") ?>"></script>
    <!-- <script src="<?= base_url("asset/vendor/datatables/dataTables.bootstrap4.min.js") ?>"></script> -->
    <!-- pdfmake -->
    <script src="<?= base_url("asset/vendor/datatables/pdfmake.min.js") ?>"></script>
    <script src="<?= base_url("asset/vendor/datatables/vfs_fonts.js") ?>"></script>
    <!-- Buttons -->
    <script src="<?= base_url("asset/vendor/Buttons/js/dataTables.buttons.min.js") ?>"></script>
    <script src="<?= base_url("asset/vendor/Buttons/js/buttons.bootstrap4.min.js") ?>"></script>
    <script src="<?= base_url("asset/vendor/Buttons/js/buttons.colVis.min.js") ?>"></script>
    <script src="<?= base_url("asset/vendor/Buttons/js/buttons.html5.min.js") ?>"></script>
    <script src="<?= base_url("asset/vendor/Buttons/js/buttons.print.min.js") ?>"></script>
    <!-- Export Excel -->
    <script src="<?= base_url("asset/vendor/JSZip/jszip.min.js") ?>"></script>
    <!-- Bootstrap Datepicker -->
    <script src="<?= base_url("asset/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js") ?>"></script>
    <!-- Page level custom scripts -->
    <script>
      $(document).ready(function() {
        $('#dataTableHover').DataTable();
        $('#tabelpresensi').DataTable({
          dom: 'Bfrtip',
          ordering: false,
          "pagingType": "numbers",
          language: {
            searchPlaceholder: "Pencarian",
            search: ""
          },
          buttons: [{
            text: '<i class="fas fa-plus"></i> Peserta',
            className: 'btn btn-info',
            action: function() {
              $("#tambahPresensiSiswa").modal();
            }
          },{
              text: '<i class="fas fa-plus"></i> Pegawai',
              className: 'btn btn-warning',
              action: function(){
                $("#tambahPres").modal();
              }
            }, ]
        });
        $('#tabelpresensipeserta').DataTable({
          dom: 'Bfrtip',
          searching: false,
          paging: false,
          ordering: false,
          info: false,
          language: {
            searchPlaceholder: "Pencarian",
            search: ""
          },
          buttons: [{
              text: '<i class="fas fa-plus"></i> Tambah',
              className: 'btn btn-info',
              action: function() {
                location.href = '<?= base_url("index.php/presensi/form") ?>';
              }
            },
            {
              extend: 'excel',
              text: '<i class="fas fa-file-excel"></i> Export Excel',
              className: 'btn btn-success',
              exportOptions: {
                columns: [0, 1, 2, 3]
              }
            },
            {
              extend: 'pdfHtml5',
              text: '<i class="fas fa-file-pdf"></i> Export PDF',
              className: 'btn btn-danger',
              exportOptions: {
                columns: [0, 1, 2, 3]
              }
            },
            {
              extend: 'print',
              text: '<i class="fas fa-print"></i> Print',
              exportOptions: {
                columns: [0, 1, 2, 3]
              }
            }
          ]
        });
        $('#tabellulusan').DataTable({
          dom: 'Bfrtip',
          ordering: false,
          language: {
            searchPlaceholder: "Pencarian",
            search: ""
          },
          buttons: [{
              text: '<i class="fas fa-plus"></i> Tambah',
              className: 'btn btn-info',
              action: function() {
                $("#modalTambah").modal();
              }
            },
            {
              extend: 'excelHtml5',
              text: '<i class="fas fa-file-excel"></i> Export Excel',
              className: 'btn btn-success',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
              }
            },
            {
              extend: 'pdfHtml5',
              text: '<i class="fas fa-file-pdf"></i> Export PDF',
              className: 'btn btn-danger',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
              }
            },
            {
              extend: 'print',
              text: '<i class="fas fa-print"></i> Print',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
              }
            }
          ]
        });
        $('#tabelpeserta').DataTable({
          dom: 'Bfrtip',
          ordering: false,
          "search": {
            "search": "Aktif"
          },language: {
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
        $('#tabelpegawai').DataTable({
          dom: 'Bfrtip',
          paging: false,
          ordering: false,
          language: {
            searchPlaceholder: "Pencarian",
            search: ""
          },
          buttons: [{
              text: '<i class="fas fa-plus"></i> Pegawai',
              className: 'btn btn-info',
              action: function(){
                $("#tambahPegs").modal();
              }
            },
            {
              text: '<i class="fas fa-plus"></i> Presensi',
              className: 'btn btn-warning',
              action: function(){
                $("#tambahPres").modal();
              }
            },
            {
              extend: 'excel',
              text: '<i class="fas fa-file-excel"></i> Export Excel',
              className: 'btn btn-success',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
              }
            },
            {
              extend: 'pdfHtml5',
              text: '<i class="fas fa-file-pdf"></i> Export PDF',
              className: 'btn btn-danger',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
              }
            },
            {
              extend: 'print',
              text: '<i class="fas fa-print"></i> Print',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
              }
            },
          ]
        });
        $('#tabelinstruktur').DataTable({
          dom: 'Bfrtip',
          paging: false,
          ordering: false,
          language: {
            searchPlaceholder: "Pencarian",
            search: ""
          },
          buttons: [{
              text: '<i class="fas fa-plus"></i> Tambah',
              className: 'btn btn-info',
              action: function() {
                location.href = '<?= base_url("instruktur/form") ?>';
              }
            },
            {
              extend: 'excel',
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
            },
            {
              text: '<i class="fas fa-download"></i> Unduh',
              className: 'btn btn-dark',
              action: function() {
                location.href = '<?= base_url('Laporan/instruktur'); ?>';
              }
            },
          ]
        });
        $('#tabelpresensipegawai').DataTable({
          dom: 'Bfrtip',
          paging: false,
          ordering: false,
          language: {
            searchPlaceholder: "Pencarian",
            search: ""
          },
          buttons: [{
              text: '<i class="fas fa-plus"></i> Tambah',
              className: 'btn btn-info',
              action: function() {
                $("#tambahPres").modal();
              }
            },
            {
              extend: 'excel',
              text: '<i class="fas fa-file-excel"></i> Export Excel',
              className: 'btn btn-success',
              exportOptions: {
                columns: [0, 1,]
              }
            },
            {
              extend: 'pdfHtml5',
              text: '<i class="fas fa-file-pdf"></i> Export PDF',
              className: 'btn btn-danger',
              exportOptions: {
                columns: [0, 1,]
              }
            },
            {
              extend: 'print',
              text: '<i class="fas fa-print"></i> Print',
              exportOptions: {
                columns: [0, 1,]
              }
            },
          ]
        });
        $('#tabelrombel').DataTable({
          dom: 'Bfrtip',
          paging: false,
          ordering: false,
          language: {
            searchPlaceholder: "Pencarian",
            search: ""
          },
          buttons: [{
              text: '<i class="fas fa-plus"></i> Tambah',
              className: 'btn btn-info',
              action: function() {
                location.href = '<?= base_url("rombel/form") ?>';
              }
            },
            {
              extend: 'excel',
              text: '<i class="fas fa-file-excel"></i> Export Excel',
              className: 'btn btn-success',
              exportOptions: {
                columns: [0, 1, 2, 3]
              }
            },
            {
              extend: 'pdfHtml5',
              text: '<i class="fas fa-file-pdf"></i> Export PDF',
              className: 'btn btn-danger',
              exportOptions: {
                columns: [0, 1, 2, 3]
              }
            },
            {
              extend: 'print',
              text: '<i class="fas fa-print"></i> Print',
              exportOptions: {
                columns: [0, 1, 2, 3]
              }
            },
            {
              text: '<i class="fas fa-download"></i> Unduh',
              className: 'btn btn-dark',
              action: function() {
                location.href = '<?= base_url('Laporan/rombel'); ?>';
              }
            },
          ]
        });
        $('#tabeluk').DataTable({
          dom: 'Bfrtip',
          paging: false,
          ordering: false,
          language: {
            searchPlaceholder: "Pencarian",
            search: ""
          },
          buttons: [{
              text: '<i class="fas fa-plus"></i> Tambah',
              className: 'btn btn-info',
              action: function() {
                location.href = '<?= base_url("uk/form") ?>';
              }
            },
            {
              extend: 'excel',
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
            },
            {
              text: '<i class="fas fa-download"></i> Unduh',
              className: 'btn btn-dark',
              action: function() {
                location.href = '<?= base_url('Laporan/rombel'); ?>';
              }
            },
          ]
        });
        $('#simple-date1 .input-group.date').datepicker({
          format: 'yyyy-mm-dd',
          todayBtn: 'linked',
          todayHighlight: true,
          autoclose: true,
        });

        $('#simple-date2 .input-group.date').datepicker({
          startView: 1,
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true,
          todayBtn: 'linked',
        });

        $('#simple-date3 .input-group.date').datepicker({
          startView: 2,
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true,
          todayBtn: 'linked',
        });

        $('#simple-date4 .input-daterange').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true,
          todayBtn: 'linked',
        });
      });
    </script>
    <script src="<?= base_url("asset/vendor/select2/dist/js/select2.min.js") ?>"></script>
    <script>
    $(document).ready(function() {
      $('#nama').select2({
        placeholder: 'Cari & pilih peserta...',
        closeOnSelect: false,
        width: '100%',
        dropdownParent: $('#tambahPresensiSiswa'),
        language: {
          noResults: function() { return 'Peserta tidak ditemukan'; }
        }
      });
    });
    </script>


    <script>
    (function(){
      function showLoader(){ $(".preloader").removeClass("fade"); }

      $(document).on("click","a[href]:not([href^='#']):not([data-toggle])",function(e){
        var h = this.getAttribute("href");
        if (h && h !== "#" && !h.match(/^javascript:/)) showLoader();
      });
      $(document).on("submit","form",showLoader);
      $(document).on("click",".print",showLoader);

      $(window).on("beforeunload",function(){ showLoader(); });
    })();

    $(document).ready(function() {  
      setTimeout(function(){ $(".preloader").addClass("fade"); }, 200);

      $(document).on("visibilitychange", function() {
        if (document.visibilityState === "visible") $(".preloader").addClass("fade");
      });

      $("table.dataTable").each(function(){
        var h=[];
        $(this).find("thead th").each(function(){ h.push($(this).text().trim()); });
        var t=$(this);
        t.on("draw.dt",function(){
          t.find("tbody tr").each(function(){
            $(this).find("td").each(function(i){ if(h[i]) $(this).attr("data-label",h[i]); });
          });
        });
        t.trigger("draw.dt");
      });
    }); </script>
<script src="<?= base_url("asset/js/ruang-admin.min.js") ?>"></script>

    <nav class="mobile-bottom-nav">
      <a class="bottom-nav-item" href="<?= base_url("pages/dashboard") ?>" title="Dashboard"><div class="nav-icon-wrap"><i class="fas fa-tachometer-alt"></i></div><span>Dashboard</span></a>
      <a class="bottom-nav-item" href="<?= base_url("pages/peserta") ?>" title="Peserta"><div class="nav-icon-wrap"><i class="fas fa-users"></i></div><span>Peserta</span></a>
      <a class="bottom-nav-item" href="<?= base_url("pages/presensi") ?>" title="Presensi"><div class="nav-icon-wrap"><i class="fas fa-clipboard-list"></i></div><span>Presensi</span></a>
      <a class="bottom-nav-item" href="<?= base_url("pages/lulusan") ?>" title="Lulusan"><div class="nav-icon-wrap"><i class="fas fa-graduation-cap"></i></div><span>Lulusan</span></a>
      <a class="bottom-nav-item" href="<?= base_url("pages/rombel") ?>" title="Program"><div class="nav-icon-wrap"><i class="fas fa-th-list"></i></div><span>Program</span></a>
    </nav>
    <script>
    document.addEventListener('DOMContentLoaded', function(){
      setTimeout(function(){
        var p = window.location.pathname;
        document.querySelectorAll('.bottom-nav-item').forEach(function(a){
          var h = a.pathname;
          if (h && p.indexOf(h) !== -1) a.classList.add('active');
        });
      }, 500);
    });
    </script>
    </body>

    </html>