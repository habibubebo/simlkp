          <!-- Header -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url("pages/dashboard") ?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>
          <a href="<?= base_url("pages/presensi") ?>" class="text-decoration-none">
            <div class="alert alert-info alert-dismissible" role="alert">
              <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
              <h6><i class="fas fa-info"></i><b> Informasi</b></h6>
                <?php
                $today = date("Y-m-d 00:00:00");
                $todays = date("Y-m-d H:i:s");
                $data = $this->db->query("SELECT * FROM presensi WHERE Tgl between '$today' and '$todays' AND pegawai IS Null ")->result();
                $total = 0;
                foreach ($data as $row) {
                  $total += 1;
                };
                echo "<b>$total</b> Peserta dan ";
                $data = $this->db->query("SELECT * FROM presensi JOIN pegawai ON  presensi.Nipd = pegawai.Nipg WHERE Tgl between '$today' and '$todays' AND pegawai=1")->result();
                echo "Pegawai <b>";
                $jml = count($data);
                foreach ($data as $row) {
                  if ($jml>1){ echo $row->NamaPegawai.', ';} else echo $row->NamaPegawai;
                };
                echo "</b> telah presensi hari ini.";
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
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100 bg-gradient-warning text-white">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Pegawai / Instruktur</div>
                      <div class="h5 mb-0 font-weight-bold">
                        <?php
                        $ins = 0;
                        foreach ($instruktur as $row) {
                          $ins += 1;
                        }
                        ?>
                        <span><?= $ins; ?> Instruktur</span>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-md">
                        <a class="badge badge-warning" href="<?= base_url("pages/pegawai") ?>">
                          Lihat Pegawai
                        </a>
                        <a class="badge badge-warning" href="<?= base_url("pages/instruktur") ?>">
                          Lihat Instruktur
                        </a>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Rombel -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100 bg-gradient-info text-white">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Rombongan Belajar</div>
                      <div class="h5 mb-0 font-weight-bold">
                        <?php
                        $rom = 0;
                        foreach ($rombel as $row) {
                          $rom += 1;
                        }
                        ?>
                        <span><?= $rom; ?> RomBel</span>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-md">
                        <a class="badge badge-info" href="<?= base_url("pages/rombel") ?>">
                          Lihat Data
                        </a>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-th-list fa-2x text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Peserta -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100 bg-gradient-success text-white">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Peserta</div>
                      <div class="h5 mb-0 font-weight-bold">
                        <?php
                        $pes = 0;
                        foreach ($peserta as $row) {
                          $pes += 1;
                        }
                        ?>
                        <span><?= $pes; ?> Peserta</span>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-md">
                        <a class="badge badge-success" href="<?= base_url("pages/peserta") ?>">
                          Lihat Data
                        </a>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Lulusan -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100 bg-gradient-danger text-white">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Lulusan</div>
                      <div class="h5 mb-0 font-weight-bold">
                        <?php
                        $lus = 0;
                        foreach ($lulusan as $row) {
                          $lus += 1;
                        }
                        ?>
                        <span><?= $lus; ?> Lulusan</span>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-md">
                        <a class="badge badge-danger" href="<?= base_url("pages/lulusan") ?>">
                          Lihat Data
                        </a>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-graduation-cap fa-2x text-white"></i>
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
                  <h6 class="m-0 font-weight-bold text-info">Progres Pelatihan</h6>
                  <div class="col-auto">
                  <i class="fas fa-graduation-cap fa-2x text-info"></i>
                  </div>
                </div>
                <div class="card-body">

                <?php foreach ($totals as $tp) { ?>
                  <div class="mb-3">
                    <div class="small text-gray"><?= $tp->Namarombel ?>
                      <div class="small float-right"><b class="text-warning"><?= $tp->BL ?> belum lulus</b> dari total <b class="text-success"> <?= $tp->TP ?></b> peserta </div>
                    </div>
                    <div class="progress" style="height: 20px;">
                      <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $tp->Persen ?>%" aria-valuenow="<?= $tp->Persen ?>"
                        aria-valuemin="0" aria-valuemax="100"><?= round($tp->Persen,1) ?>%</div>
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
    labels: [<?php foreach ($chart as $x) { echo '"'.date("d/m/y",strtotime($x->Hari)).'", '; } ?>],
    datasets: [{
      label: "Total",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.5)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php foreach ($chart as $x) { echo "$x->Jml, "; } ?>],
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
            return number_format(value) + ' Sesi' ;
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
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel)+ ' Sesi';
        }
      }
    }
  }
});</script>