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
          <span>copyright &copy; <script>
              document.write(new Date().getFullYear());
            </script> - developed by
            <b><a href="https://instagram.com/habibubebo" target="_blank">Habibubebo</a></b>
            <div class=" ml-2">
              <small>(Version 0.5 Beta)<br><?= date("Y-m-d h:m:s") ?></small>

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
    <script src="<?= base_url("asset/vendor/jquery/jquery.min.js") ?>"></script>
    <script src="<?= base_url("asset/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <script src="<?= base_url("asset/vendor/jquery-easing/jquery.easing.min.js") ?>"></script>
    <script src="<?= base_url("asset/js/ruang-admin.min.js") ?>"></script>
    <!-- <script src="<?= base_url("asset/vendor/chart.js/Chart.min.js") ?>"></script>
  <script src="<?= base_url("asset/js/demo/chart-area-demo.js") ?>"></script> -->
    <!-- Page level plugins -->
    <script src="<?= base_url("asset/vendor/datatables/jquery.dataTables.min.js") ?>"></script>
    <script src="<?= base_url("asset/vendor/datatables/dataTables.bootstrap4.min.js") ?>"></script>
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
           language: { searchPlaceholder: "Pencarian",search: "" },
          buttons: [{
            text: '<i class="fas fa-plus"></i> Tambah',
            className: 'btn btn-info',
            action: function() {
              $("#exampleModalCenter").modal();
            }
          }, {
            extend: "collection",
            className: "btn btn-label-primary dropdown-toggle me-2",
            text: '<i class="bx bx-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
            buttons: [{
                extend: "print",
                text: '<i class="bx bx-printer me-1" ></i>Print',
                className: "dropdown-item",
                exportOptions: {
                  columns: ':visible:not(.noExport)',
                  format: {
                    body: function(e, t, a) {
                      var s;
                      return e.length <= 0 ? e : (e = $.parseHTML(e), s = "", $.each(e, function(e, t) {
                        void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                      }), s)
                    }
                  }
                },
                customize: function(e) {
                  $(e.document.body).css("color", config.colors.headingColor).css("border-color", config.colors.borderColor).css("background-color", config.colors.bodyBg), $(e.document.body).find("table").addClass("compact").css("color", "inherit").css("border-color", "inherit").css("background-color", "inherit")
                }
              },
              {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Export Excel',
                className: 'btn btn-success',
                exportOptions: {
                  columns: [0, 1, 2, 3, 4]
                }
              },
              {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> Export PDF',
                className: 'btn btn-danger',
                exportOptions: {
                  columns: [0, 1, 2, 3, 4]
                }
              },
              {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Print',
                exportOptions: {
                  columns: [0, 1, 2, 3, 4]
                }
              },
              {
                text: '<i class="fas fa-download"></i> Unduh',
                className: 'btn btn-dark',
                action: function() {
                  location.href = '<?= base_url('Laporan/presensi'); ?>';
                }
              }
            ]
          }]
        });
        $('#tabelpresensipeserta').DataTable({
          dom: 'Bfrtip',
          searching: false,
          paging: false,
          ordering: false,
          info: false,
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
                columns: [0, 1, 2]
              }
            },
            {
              extend: 'pdfHtml5',
              text: '<i class="fas fa-file-pdf"></i> Export PDF',
              className: 'btn btn-danger',
              exportOptions: {
                columns: [0, 1, 2]
              }
            },
            {
              extend: 'print',
              text: '<i class="fas fa-print"></i> Print',
              exportOptions: {
                columns: [0, 1, 2]
              }
            }
          ]
        });
        $('#tabellulusan').DataTable({
          dom: 'Bfrtip',
          ordering: false,

          buttons: [{
              text: '<i class="fas fa-plus"></i> Tambah',
              className: 'btn btn-info',
              action: function() {
                location.href = '<?= base_url('lulusan/form'); ?>';
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
          },
          buttons: [{
              text: '<i class="fas fa-plus"></i> Tambah',
              className: 'btn btn-info',
              action: function() {
                location.href = '<?= base_url('peserta/form'); ?>';
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
        $('#tabelinstruktur').DataTable({
          dom: 'Bfrtip',
          paging: false,
          ordering: false,
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
        $('#tabelrombel').DataTable({
          dom: 'Bfrtip',
          paging: false,
          ordering: false,
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
        $('#nama').change(function() {
          var isian = $(this).val();
          $.ajax({
            url: '<?= base_url() ?>index.php/pesertas/nipd',
            method: 'post',
            data: {
              Nipd: isian
            },
            dataType: 'json',
            success: function(response) {
              var len = response.length;
              document.getElementById("jks").value = '';
              if (len > 0) {
                document.getElementById("jks").value = response[0].Jeniskursus;
              }

            }
          });
        });
      });
    </script>

    </body>

    </html>