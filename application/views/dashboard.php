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
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h6><i class="fas fa-info"></i><b> Informasi</b></h6>
              <strong>
                <?php
                $today = date("Y-m-d 00:00:00");
                $todays = date("Y-m-d H:i:s");
                $data = $this->db->query("SELECT * FROM presensi WHERE Tgl between '$today' and '$todays'")->result();
                $total = 0;
                foreach ($data as $row) {
                  $total += 1;
                };
                echo "<b>$total</b> Peserta telah presensi hari ini.";
                ?>
            </div>
          </a>

          <!-- Content -->
          <div class="row mb-3">
            <!-- Sapras -->
            <div class="col-xl-3 col-md-6 mb-4">
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
            </div>
            <!-- Instruktur -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100 bg-gradient-warning text-white">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Instruktur</div>
                      <div class="h5 mb-0 font-weight-bold">
                        <?php
                        $data = $this->db->query("SELECT * FROM instruktur")->result();
                        $ins = 0;
                        foreach ($data as $row) {
                          $ins += 1;
                        }
                        ?>
                        <span><?= $ins; ?> Instruktur</span>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-md">
                        <a class="badge badge-warning" href="<?= base_url("pages/instruktur") ?>">
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
            <!-- Rombel -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100 bg-gradient-info text-white">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Rombongan Belajar</div>
                      <div class="h5 mb-0 font-weight-bold">
                        <?php
                        $data = $this->db->query("SELECT * FROM rombel")->result();
                        $rom = 0;
                        foreach ($data as $row) {
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
                        $data = $this->db->query("SELECT * FROM peserta WHERE Status=1")->result();
                        $pes = 0;
                        foreach ($data as $row) {
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
                        $data = $this->db->query("SELECT * FROM lulusan")->result();
                        $lus = 0;
                        foreach ($data as $row) {
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