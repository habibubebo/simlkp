          <!-- Header -->
          <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-2">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url("pages/dashboard") ?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>
          <a href="<?= base_url("pages/presensi") ?>" class="text-decoration-none">
            <div class="alert alert-info" role="alert">
              <h6><i class="fas fa-info"></i><b> Informasi</b></h6>
              <?php
              $today = date("Y-m-d 00:00:00");
              $todays = date("Y-m-d H:i:s");

              $dataPeserta = $this->db->query("SELECT COUNT(*) as total FROM presensi WHERE Tgl BETWEEN '$today' AND '$todays' AND pegawai IS NULL")->row();
              $totalPeserta = $dataPeserta->total;

              echo "<b>$totalPeserta</b> Peserta dan ";

              $dataPegawai = $this->db->query("SELECT NamaPegawai FROM presensi JOIN pegawai ON presensi.Nipd = pegawai.Nipg WHERE Tgl BETWEEN '$today' AND '$todays' AND pegawai = 1")->result();

              $namaPegawai = array_map(function ($row) {
                return $row->NamaPegawai;
              }, $dataPegawai);

              $jmlPegawai = count($namaPegawai);
              $pegawai = ($jmlPegawai > 1) ? implode(", ", $namaPegawai) : ($jmlPegawai ? $namaPegawai[0] : 'tidak ada pegawai');

              echo "<b>$pegawai</b> presensi hari ini.";
              ?>
            </div>
          </a>

          <!-- Content -->
          <div class="row mb-3">
            <!-- Sapras -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100 bg-gradient-primary text-white">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Sarana Prasarana</div>
                      <div class="h5 mb-0 font-weight-bold ">
                        <?php
                        $data = $this->db->query("SELECT * FROM sapras")->result();
                        $sapras = 0;
                        foreach ($data as $row) {
                          $sapras += count($row->Jenissarana);
                        }
                        ?>
                        <span><?= $sapras; ?> Sarana</span>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-md">
                        <a class="badge badge-primary" href="<?= base_url("pages/sapras") ?>">
                          Lihat Data
                        </a>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-cogs fa-2x text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
            <!-- Instruktur -->
            <div class="col-xl-3 col-md-6 col-6 mb-4">
              <div class="card stat-card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-title">Instruktur</div>
                      <div class="stat-value">
                        <?php
                        $ins = 0;
                        foreach ($instruktur as $row) {
                          $ins += 1;
                        }
                        ?>
                        <span><?= $ins; ?></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <div class="stat-icon">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Rombel -->
            <div class="col-xl-3 col-md-6 col-6 mb-4">
              <div class="card stat-card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-title">RomBel</div>
                      <div class="stat-value">
                        <?php
                        $rom = 0;
                        foreach ($rombel as $row) {
                          $rom += 1;
                        }
                        ?>
                        <span><?= $rom; ?></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <div class="stat-icon">
                        <i class="fas fa-th-list"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Peserta -->
            <div class="col-xl-3 col-md-6 col-6 mb-4">
              <div class="card stat-card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-title">Peserta</div>
                      <div class="stat-value">
                        <?php
                        $pes = 0;
                        foreach ($peserta as $row) {
                          $pes += 1;
                        }
                        ?>
                        <span><?= $pes; ?></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <div class="stat-icon">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Lulusan -->
            <div class="col-xl-3 col-md-6 col-6 mb-4">
              <div class="card stat-card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-title">Lulusan</div>
                      <div class="stat-value">
                        <?php
                        $lus = 0;
                        foreach ($lulusan as $row) {
                          $lus += 1;
                        }
                        ?>
                        <span><?= $lus; ?></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <div class="stat-icon">
                        <i class="fas fa-graduation-cap"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Progres Pelatihan -->
          <div class="row">
            <div class="col-xl-6 col-lg-6">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold" style="color:var(--color-primary)">Progres Pelatihan</h6>
                </div>
                <div class="card-body">

                  <?php foreach ($totals as $tp) { ?>
                    <div class="mb-3">
                      <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="small font-weight-bold text-gray-700"><?= $tp->Namarombel ?></span>
                        <span class="small"><b class="text-warning"><?= $tp->BL ?> blm lulus</b> dari <b style="color:var(--color-primary)"><?= $tp->TP ?></b></span>
                      </div>
                      <div class="progress" style="height: 8px; background: #e9ecef; border-radius: 4px;">
                        <div class="progress-bar" role="progressbar" style="width: <?= $tp->Persen ?>%; background: var(--color-primary); border-radius: 4px;" aria-valuenow="<?= $tp->Persen ?>"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>

            <!-- Presensi Chart -->
            <div class="col-xl-6 col-lg-6">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Presensi Mingguan</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                      aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Aksi:</div>
                      <a class="dropdown-item" href="<?php echo base_url("pages/presensi") ?>">Lihat Presensi</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <script src="<?= base_url("asset/vendor/chart.js/Chart.min.js") ?>"></script>
          <script>
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            function number_format(number, decimals, dec_point, thousands_sep) {
              number = (number + '').replace(',', '').replace(' ', '');
              var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                  var k = Math.pow(10, prec);
                  return '' + Math.round(n * k) / k;
                };
              s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
              if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
              }
              if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
              }
              return s.join(dec);
            }
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: [<?php foreach ($chart as $x) {
                            echo '"' . date("d/m/y", strtotime($x->Hari)) . '", ';
                          } ?>],
                datasets: [{
                  label: "Total",
                  lineTension: 0.3,
                  backgroundColor: "rgba(37, 99, 235, 0.5)",
                  borderColor: "rgba(37, 99, 235, 1)",
                  pointRadius: 5,
                  pointBackgroundColor: "rgba(37, 99, 235, 1)",
                  pointBorderColor: "rgba(245, 158, 11, 1)",
                  pointHoverRadius: 3,
                  pointHoverBackgroundColor: "rgba(37, 99, 235, 1)",
                  pointHoverBorderColor: "rgba(245, 158, 11, 1)",
                  pointHitRadius: 10,
                  pointBorderWidth: 2,
                  data: [<?php foreach ($chart as $x) {
                            echo "$x->Jml, ";
                          } ?>],
                }],
              },
              options: {
                maintainAspectRatio: false,
                layout: {
                  padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                  }
                },
                scales: {
                  xAxes: [{
                    time: {
                      unit: 'Hari'
                    },
                    gridLines: {
                      display: false,
                      drawBorder: false
                    },
                    ticks: {
                      maxTicksLimit: 7
                    }
                  }],
                  yAxes: [{
                    ticks: {
                      maxTicksLimit: 6,
                      padding: 10,
                      callback: function(value, index, values) {
                        return number_format(value) + ' Sesi';
                      }
                    },
                    gridLines: {
                      color: "rgb(234, 236, 244)",
                      zeroLineColor: "rgb(234, 236, 244)",
                      drawBorder: false,
                      borderDash: [2],
                      zeroLineBorderDash: [2]
                    }
                  }],
                },
                legend: {
                  display: false
                },
                tooltips: {
                  backgroundColor: "rgb(255,255,255)",
                  bodyFontColor: "#858796",
                  titleMarginBottom: 10,
                  titleFontColor: '#6e707e',
                  titleFontSize: 14,
                  borderColor: '#dddfeb',
                  borderWidth: 1,
                  xPadding: 15,
                  yPadding: 15,
                  displayColors: false,
                  intersect: false,
                  mode: 'index',
                  caretPadding: 10,
                  callbacks: {
                    label: function(tooltipItem, chart) {
                      var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || 'Hari';
                      return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' Sesi';
                    }
                  }
                }
              }
            });
          </script>