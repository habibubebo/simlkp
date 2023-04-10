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
            <a href="<?php echo base_url('index.php/login/logout'); ?>" class="btn btn-danger">Keluar</a>
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
          <small>(Version 0.4 Beta) </small>
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
    <script src="<?php echo base_url("asset/vendor/jquery/jquery.min.js") ?>"></script>
    <script src="<?php echo base_url("asset/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <script src="<?php echo base_url("asset/vendor/jquery-easing/jquery.easing.min.js") ?>"></script>
    <script src="<?php echo base_url("asset/js/ruang-admin.min.js") ?>"></script>
    <!-- <script src="<?php echo base_url("asset/vendor/chart.js/Chart.min.js") ?>"></script>
  <script src="<?php echo base_url("asset/js/demo/chart-area-demo.js") ?>"></script> -->
    <!-- Page level plugins -->
    <script src="<?php echo base_url("asset/vendor/datatables/jquery.dataTables.min.js") ?>"></script>
    <script src="<?php echo base_url("asset/vendor/datatables/dataTables.bootstrap4.min.js") ?>"></script>
    <!-- pdfmake -->
    <script src="<?php echo base_url("asset/vendor/datatables/pdfmake.min.js") ?>"></script>
    <script src="<?php echo base_url("asset/vendor/datatables/vfs_fonts.js") ?>"></script>
    <!-- Buttons -->
    <script src="<?php echo base_url("asset/vendor/Buttons/js/dataTables.buttons.min.js") ?>"></script>
    <script src="<?php echo base_url("asset/vendor/Buttons/js/buttons.bootstrap4.min.js") ?>"></script>
    <script src="<?php echo base_url("asset/vendor/Buttons/js/buttons.colVis.min.js") ?>"></script>
    <script src="<?php echo base_url("asset/vendor/Buttons/js/buttons.html5.min.js") ?>"></script>
    <script src="<?php echo base_url("asset/vendor/Buttons/js/buttons.print.min.js") ?>"></script>
    <!-- Export Excel -->
    <script src="<?php echo base_url("asset/vendor/JSZip/jszip.min.js") ?>"></script>
    <!-- Bootstrap Datepicker -->
    <script src="<?php echo base_url("asset/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js") ?>"></script>
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
            buttons: [
            {
               extend: 'excel',
               exportOptions: {
               columns: [0,1,2]
                }
                    },
            {
               extend: 'pdfHtml5',
               exportOptions: {
               columns: [0,1,2]
                }
                    },
            {
               extend: 'print',
               exportOptions: {
               columns: [0,1,2]
                }
                    }
        ]
        });
        $('#tabellulusan').DataTable({
           dom: 'Bfrtip',
           ordering: false,
            buttons: [
            {
               extend: 'excel',
               exportOptions: {
               columns: [0,1,2,3,4,5,6,7,8]
                }
                    },
            {
               extend: 'pdfHtml5',
               exportOptions: {
               columns: [0,1,2,3,4,5,6,7,8]
                }
                    },
            {
               extend: 'print',
               exportOptions: {
               columns: [0,1,2,3,4,5,6,7,8]
                }
                    }
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
          var username = $(this).val();
          $.ajax({
            url: '<?= base_url() ?>index.php/pesertas/nipd',
            method: 'post',
            data: {
              Nipd: username
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