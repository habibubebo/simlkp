    <!-- Modal Presensi Pegawai -->
<div class="modal fade ppg-modal" id="tambahPres" tabindex="-1" role="dialog" aria-labelledby="tambahPresTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center ppg-wrap">
          <span class="ppg-icon d-none d-sm-inline-flex"><i class="fas fa-user-clock"></i></span>
          <div class="ml-3 ppg-wrap">
            <h5 class="modal-title mb-0" id="tambahPresTitle">Presensi Pegawai</h5>
            <div class="ppg-subtitle">Catat kehadiran pegawai</div>
          </div>
        </div>
        <button type="button" class="close ppg-close" data-dismiss="modal" aria-label="Tutup">
          <span class="d-none d-sm-inline" aria-hidden="true">&times;</span>
          <i class="fas fa-arrow-left d-sm-none" aria-hidden="true"></i>
        </button>
      </div>
      <form action="<?= base_url('presensi/tambahpegawai') ?>" method="POST" id="formTambahPresPegawai" class="modal-body px-3 px-sm-4 py-3">
        <div class="form-group mb-3">
          <label class="ppg-label" for="pegNipg">Nama Pegawai</label>
          <select class="form-control ppg-input" id="pegNipg" name="nipg" required>
            <option value="" selected disabled>Pilih pegawai</option>
            <?php
            $data = $this->db->query("SELECT Nipg,NamaPegawai FROM pegawai")->result();
            foreach ($data as $row) { ?>
              <option value="<?= $row->Nipg ?>"><?= $row->NamaPegawai ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-row">
          <div class="form-group col-7 mb-1" id="simple-date3">
            <label class="ppg-label" for="pegTgl">Tanggal</label>
            <div class="input-group date">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white"><i class="fas fa-calendar-alt text-primary"></i></span>
              </div>
              <input type="text" name="tgl" class="form-control ppg-input" id="pegTgl" required readonly value="<?= date('Y-m-d') ?>" autocomplete="off">
            </div>
          </div>
          <div class="form-group col-5 mb-1">
            <label class="ppg-label" for="pegWaktu">Jam</label>
            <input type="time" class="form-control ppg-input" id="pegWaktu" value="<?= date('H:i') ?>" required>
          </div>
        </div>
      </form>
      <div class="modal-footer px-3 px-sm-4 pt-2 pb-3">
        <button type="button" class="btn btn-secondary ppg-btn flex-fill" data-dismiss="modal">Batal</button>
        <button type="submit" form="formTambahPresPegawai" class="btn btn-primary ppg-btn flex-fill ml-2"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>

<style>
/* ===== Modal Presensi Pegawai: gaya aplikasi mobile ===== */
.ppg-modal .modal-content {
  border: 0;
  border-radius: .75rem;
  max-height: calc(100vh - 3.5rem);
  box-shadow: 0 20px 60px rgba(15, 23, 42, .22);
}
@supports (height: 100dvh) {
  .ppg-modal .modal-content { max-height: calc(100dvh - 3.5rem); }
}
.ppg-modal .modal-header,
.ppg-modal .modal-footer { flex-shrink: 0; }
.ppg-modal .modal-body {
  flex: 1 1 auto;
  min-height: 0;
  overflow-y: auto;
  overscroll-behavior: contain;
}
.ppg-wrap { min-width: 0; }
.ppg-icon {
  width: 2.5rem; height: 2.5rem;
  border-radius: .6rem;
  display: inline-flex; align-items: center; justify-content: center;
  background: rgba(37, 99, 235, .1);
  color: #2563eb;
  font-size: 1.05rem;
  flex-shrink: 0;
}
.ppg-subtitle { font-size: .8rem; color: #6b7280; margin-top: .1rem; }
.ppg-close {
  width: 2.5rem; height: 2.5rem;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.35rem;
  color: #6b7280;
  transition: background-color .15s, color .15s;
}
.ppg-modal .ppg-close:hover { background: #f1f5f9; color: #111827; }
.ppg-label {
  font-size: .85rem; font-weight: 600; color: #374151;
  margin-bottom: .35rem; display: block;
}
.ppg-modal .form-control { border-radius: .6rem; }
.ppg-modal .input-group-text {
  border-radius: .6rem 0 0 .6rem;
  border-right: 0;
}
.ppg-modal .input-group > .form-control {
  border-radius: 0 .6rem .6rem 0;
}
.ppg-modal .form-control:focus {
  border-color: #93b4f5;
  box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .15);
}
.ppg-input { min-height: 44px; font-size: 16px; }
.modal-footer .ppg-btn {
  min-height: 48px;
  border-radius: .55rem;
  font-weight: 600;
}

/* Tampilan aplikasi mobile di layar kecil */
@media (max-width: 575.98px) {
  .ppg-modal .modal-dialog {
    margin: 0; max-width: 100%;
    height: 100%;
    overscroll-behavior: contain;
  }
  @supports (height: 100svh) {
    .ppg-modal .modal-dialog { height: 100svh; }
  }
  .ppg-modal .modal-content {
    height: 100%;
    max-height: none;
    border-radius: 1.25rem 1.25rem 0 0;
    box-shadow: 0 -8px 40px rgba(15, 23, 42, .18);
    overscroll-behavior: contain;
  }
  .ppg-modal .modal-header {
    justify-content: flex-start;
    padding: .85rem 1rem .85rem .5rem;
    border-bottom: 1px solid #eef0f4;
  }
  .ppg-modal .ppg-close {
    order: -1;
    margin: 0 .35rem 0 0;
    color: #2563eb;
    flex-shrink: 0;
  }
  .ppg-modal .ppg-close:hover { background: rgba(37, 99, 235, .08); color: #2563eb; }
  .ppg-modal .ppg-wrap.ml-3 { margin-left: .15rem !important; }
  .ppg-modal .modal-footer {
    flex-direction: column-reverse;
    align-items: stretch;
    padding: .65rem 1rem calc(.75rem + env(safe-area-inset-bottom, 0px));
  }
  .ppg-modal .modal-footer .ppg-btn {
    width: 100%;
    margin-left: 0 !important;
    border-radius: 9999px;
  }
  .ppg-modal .modal-footer .btn-secondary {
    min-height: 42px;
    background: rgba(37, 99, 235, .07);
    border-color: transparent;
    color: #2563eb;
  }
  .ppg-modal .modal-footer .btn-secondary:hover,
  .ppg-modal .modal-footer .btn-secondary:focus {
    background: rgba(37, 99, 235, .14);
    border-color: transparent;
    color: #1d4ed8;
  }
}
@media (max-width: 575.98px) and (prefers-reduced-motion: no-preference) {
  .ppg-modal.fade .modal-dialog { transform: translateY(28px); }
  .ppg-modal.show .modal-dialog { transform: none; }
}
@media (min-width: 576px) {
  .ppg-modal .modal-dialog { max-width: 460px; }
}
@media (prefers-reduced-motion: reduce) {
  .ppg-close { transition: none; }
}
html.app-modal-open, html.app-modal-open body {
  overflow: hidden !important;
  overscroll-behavior: none;
}
</style>
<script>
if (window.jQuery) {
  window.jQuery(document)
    .on('show.bs.modal', '.ppg-modal', function () {
      document.documentElement.classList.add('app-modal-open');
    });
  window.jQuery(document).on('hidden.bs.modal', function () {
    if (!document.querySelector('.modal.show')) {
      document.documentElement.classList.remove('app-modal-open');
    }
  });
}

$(document).ready(function () {
  // Klik ikon kalender => fokus ke input tanggal
  var ppgIcon = document.querySelector('#simple-date3 .input-group-text');
  if (ppgIcon) {
    ppgIcon.addEventListener('click', function () {
      document.getElementById('pegTgl').focus();
    });
  }

  // Gabungkan tanggal + jam menjadi satu nilai DATETIME saat simpan
  $('#formTambahPresPegawai').on('submit', function () {
    var d = document.getElementById('pegTgl').value;
    var w = document.getElementById('pegWaktu').value;
    if (d && w && d.indexOf(' ') === -1) {
      document.getElementById('pegTgl').value = d + ' ' + w + ':00';
    }
  });
});
</script>
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
                $("#tambahRombel").modal();
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
          var pageMobile = document.getElementById("pageMobile");
          if (h && p.indexOf(h) !== -1) a.classList.add('active');
          if (h && p.indexOf(h) !== -1) pageMobile.innerText = a.getAttribute('title');
        });
      }, 200);
    });
    </script>
    </body>

    </html>