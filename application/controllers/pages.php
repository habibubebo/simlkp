<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pages  extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_APS');
        $this->load->view('layout/head');
        $data['profil'] = $this->Model_APS->tampil_data('profil', 'npsn', 'ASC')->result();
        $data['logs'] = $this->db->query("SELECT * FROM log ORDER BY log_tgl DESC LIMIT 3")->result();
        $this->load->view('layout/sidebar_menu', $data);
        $this->load->view('layout/navbar', $data);
        require_login();
    }
    function dashboard()
    {
        require_admin();
        $data['sapras'] = $this->Model_APS->tampil_data('sapras', 'Id', 'ASC')->result();
        $data['lulusan'] = $this->db->query("SELECT * FROM lulusan")->result();
        $data['peserta'] = $this->db->query("SELECT * FROM peserta WHERE Status=1 or Status=0")->result();
        $data['rombel'] = $this->db->query("SELECT * FROM rombel")->result();
        $data['instruktur'] = $this->db->query("SELECT * FROM instruktur")->result();
		$data['totals'] = $this->db->query("SELECT rombel.Id AS Id, Namarombel,IFNULL(BelumLulus, 0) AS BL,IFNULL(TotalPeserta, 0) AS TP, IFNULL(ROUND((IFNULL(TotalPeserta, 0) - IFNULL(BelumLulus, 0)) / NULLIF(IFNULL(TotalPeserta, 0), 0) * 100, 1), 0) AS Persen
        FROM rombel 
        left JOIN (SELECT Jeniskursus, COUNT(Nipd) AS BelumLulus FROM peserta WHERE Nipd NOT IN (SELECT Nipd FROM lulusan) GROUP BY Jeniskursus
        ) AS t ON Jeniskursus=rombel.Id 
        left JOIN (SELECT rombel.Id, COUNT(peserta.Nipd) AS TotalPeserta FROM rombel JOIN peserta ON rombel.Id=peserta.Jeniskursus GROUP BY rombel.Id
        ) AS t2 ON t2.Id=rombel.Id
        ORDER BY Persen ASC, rombel.Id ASC")->result();
		$data['belumLulusNama'] = $this->db->query("SELECT p.Nama AS nm, p.Jeniskursus AS IdRombel, YEAR(p.Tglmasuk) AS ThnMasuk
        FROM peserta p
        WHERE p.Nipd NOT IN (SELECT Nipd FROM lulusan)
        ORDER BY ThnMasuk DESC, p.Nama ASC")->result();
        $data['chart'] = $this->db->query("SELECT CAST(Tgl AS DATE) AS Hari, count(Nipd) AS Jml FROM presensi WHERE Tgl BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL -1 DAY) GROUP BY Hari")->result();

        // Streak peserta: rentetan hadir berturut-turut yang masih aktif (hari ini atau kemarin)
        $streakRows = $this->db->query("SELECT presensi.Nipd, DATE(presensi.Tgl) AS d FROM presensi WHERE presensi.pegawai IS NULL AND presensi.Nipd <> 0 GROUP BY presensi.Nipd, DATE(presensi.Tgl)")->result();
        $datesByNipd = [];
        foreach ($streakRows as $sr) {
            $datesByNipd[(int)$sr->Nipd][] = $sr->d;
        }
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $streakMap = [];
        foreach ($datesByNipd as $nipd => $dates) {
            $dates = array_values(array_unique($dates));
            rsort($dates);
            if ($dates[0] !== $today && $dates[0] !== $yesterday) {
                continue;
            }
            $set = array_flip($dates);
            $streak = 1;
            $cursor = $dates[0];
            while (isset($set[date('Y-m-d', strtotime($cursor . ' -1 day'))])) {
                $cursor = date('Y-m-d', strtotime($cursor . ' -1 day'));
                $streak++;
            }
            if ($streak >= 3) {
                $streakMap[$nipd] = $streak;
            }
        }
        arsort($streakMap);
        $streakList = [];
        if (!empty($streakMap)) {
            $ids = implode(',', array_map('intval', array_keys($streakMap)));
            $detailRows = $this->db->query("SELECT peserta.Nipd, peserta.Nama, rombel.Namarombel FROM peserta LEFT JOIN rombel ON peserta.Jeniskursus = rombel.Id WHERE peserta.Nipd IN ($ids)")->result();
            $detailMap = [];
            foreach ($detailRows as $dr) {
                $detailMap[(int)$dr->Nipd] = $dr;
            }
            foreach ($streakMap as $nipd => $st) {
                if (!isset($detailMap[$nipd])) {
                    continue;
                }
                $streakList[] = (object)[
                    'Nipd' => $nipd,
                    'Nama' => $detailMap[$nipd]->Nama,
                    'Namarombel' => $detailMap[$nipd]->Namarombel,
                    'streak' => $st,
                ];
            }
        }
        $data['streakPeserta'] = $streakList;

        // Presensi hari ini (banner)
        $todayStart = date("Y-m-d 00:00:00");
        $todayEnd = date("Y-m-d 23:59:59");
        $data['totalPeserta'] = (int)($this->db->query("SELECT COUNT(*) as total FROM presensi WHERE Tgl BETWEEN '$todayStart' AND '$todayEnd' AND pegawai IS NULL")->row()->total ?? 0);
        $pegArr = $this->db->query("SELECT NamaPegawai FROM presensi JOIN pegawai ON presensi.Nipd = pegawai.Nipg WHERE Tgl BETWEEN '$todayStart' AND '$todayEnd' AND pegawai=1")->result();
        $insArr = $this->db->query("SELECT DISTINCT NamaInstruktur FROM presensi JOIN instruktur ON presensi.Instruktur = instruktur.Id WHERE Tgl BETWEEN '$todayStart' AND '$todayEnd' AND (pegawai IS NULL OR pegawai != 1) AND Instruktur IS NOT NULL")->result();
        $allStaff = array_values(array_unique(array_merge(
            array_map(function ($row) { return $row->NamaPegawai; }, $pegArr),
            array_map(function ($row) { return $row->NamaInstruktur; }, $insArr)
        )));
        $data['jmlPegawai'] = count($allStaff);
        $data['pegawaiNames'] = !empty($allStaff) ? implode(", ", $allStaff) : "";

        // Ringkasan global
        $data['cntPegawai'] = (int)($this->db->count_all('pegawai') ?? 0);
        $data['cntSapras'] = (int)($this->db->count_all('sapras') ?? 0);
        $data['cntPesertaAll'] = (int)($this->db->count_all('peserta') ?? 0);
        $data['cntAktif'] = (int)($this->db->query("SELECT COUNT(*) as c FROM peserta WHERE Status=1")->row()->c ?? 0);
        $data['cntNon'] = (int)($this->db->query("SELECT COUNT(*) as c FROM peserta WHERE Status=0")->row()->c ?? 0);
        $data['cntLulusPeserta'] = (int)($this->db->query("SELECT COUNT(*) as c FROM peserta WHERE Status=2")->row()->c ?? 0);
        $sum7 = 0;
        foreach (($data['chart'] ?? []) as $ch) {
            $sum7 += (int)($ch->Jml ?? 0);
        }
        $data['avg7'] = count($data['chart'] ?? []) ? round($sum7 / max(1, count($data['chart'])), 1) : 0;
        $data['topRombel'] = $this->db->query("SELECT rombel.Namarombel, COUNT(peserta.Nipd) as jml FROM rombel LEFT JOIN peserta ON peserta.Jeniskursus=rombel.Id GROUP BY rombel.Id ORDER BY jml DESC LIMIT 3")->result();
        $data['recentLulus'] = $this->db->query("SELECT peserta.Nama, rombel.Namarombel, lulusan.Tgllulus FROM lulusan JOIN peserta ON lulusan.Nipd=peserta.Nipd JOIN rombel ON peserta.Jeniskursus=rombel.Id ORDER BY lulusan.Tgllulus DESC LIMIT 3")->result();

        // Periode bulan untuk kartu bulanan (maks. 3 bulan ke belakang)
        $bulanIndoCtl = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
        $bulanMax = date('Y-m');
        $bulanMin = date('Y-m', strtotime('-3 months'));
        $bulanReq = (string)$this->input->get('bulan');
        $bulanAktif = preg_match('/^\d{4}-\d{2}$/', $bulanReq) ? $bulanReq : $bulanMax;
        if ($bulanAktif < $bulanMin || $bulanAktif > $bulanMax) {
            $bulanAktif = $bulanMax;
        }
        $bulanStart = date('Y-m-01 00:00:00', strtotime($bulanAktif . '-01'));
        $bulanEnd = date('Y-m-t 23:59:59', strtotime($bulanAktif . '-01'));
        $bulanNum = (int)substr($bulanAktif, 5, 2);
        $bulanNama = $bulanIndoCtl[$bulanNum] . ' ' . substr($bulanAktif, 0, 4);
        $isBulanIni = $bulanAktif === $bulanMax;
        $data['bulanAktif'] = $bulanAktif;
        $data['isBulanIni'] = $isBulanIni;
        $data['bulanLabel'] = $bulanNama;
        $data['rangeLabel'] = '1-' . ($isBulanIni ? date('d') : date('t', strtotime($bulanAktif . '-01'))) . ' ' . $bulanNama;
        $bulanPrev = date('Y-m', strtotime($bulanAktif . '-01 -1 month'));
        $data['bulanPrev'] = $bulanPrev >= $bulanMin ? $bulanPrev : null;
        $bulanNext = date('Y-m', strtotime($bulanAktif . '-01 +1 month'));
        $data['bulanNext'] = $bulanNext <= $bulanMax ? $bulanNext : null;

        // Hari favorit bulan ini
        $data['mapHari'] = ['Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu'];
        $hariFavRowsBulan = $this->db->query("SELECT DAYNAME(Tgl) as en, COUNT(*) as jml FROM presensi WHERE Tgl BETWEEN '$bulanStart' AND '$bulanEnd' AND Tgl IS NOT NULL AND Tgl != '0000-00-00 00:00:00' GROUP BY en")->result();
        $hariFavMapBulan = [];
        foreach ($hariFavRowsBulan as $r) {
            $hariFavMapBulan[$r->en] = (int)$r->jml;
        }
        $hariFav = '-';
        $hariFavJml = 0;
        if (!empty($hariFavMapBulan)) {
            arsort($hariFavMapBulan);
            $enTop = array_key_first($hariFavMapBulan);
            $hariFav = $data['mapHari'][$enTop] ?? $enTop;
            $hariFavJml = $hariFavMapBulan[$enTop];
        }
        $data['hariFavMapBulan'] = $hariFavMapBulan;
        $data['hariFav'] = $hariFav;
        $data['hariFavJml'] = $hariFavJml;
        $data['maxHariBulan'] = !empty($hariFavMapBulan) ? max($hariFavMapBulan) : 0;

        // Peserta rajin & instruktur aktif bulan ini
        $data['rajinBulan'] = $this->db->query("SELECT peserta.Nama, peserta.Nipd, rombel.Namarombel, COUNT(presensi.Tgl) as jml FROM presensi JOIN peserta ON presensi.Nipd=peserta.Nipd JOIN rombel ON peserta.Jeniskursus=rombel.Id WHERE presensi.Tgl BETWEEN '$bulanStart' AND '$bulanEnd' AND presensi.pegawai IS NULL GROUP BY peserta.Nipd ORDER BY jml DESC LIMIT 5")->result();
        $data['maxRajin'] = !empty($data['rajinBulan']) ? (int)max(array_column(array_map(function ($r) { return (array)$r; }, $data['rajinBulan']), 'jml')) : 0;
        $data['instrukturBulan'] = $this->db->query("SELECT instruktur.NamaInstruktur, instruktur.Id, COUNT(presensi.Tgl) as jml FROM presensi JOIN instruktur ON presensi.Instruktur=instruktur.Id WHERE presensi.Tgl BETWEEN '$bulanStart' AND '$bulanEnd' GROUP BY presensi.Instruktur ORDER BY jml DESC LIMIT 5")->result();
        $data['maxInstruktur'] = !empty($data['instrukturBulan']) ? (int)max(array_column(array_map(function ($r) { return (array)$r; }, $data['instrukturBulan']), 'jml')) : 0;
        $rombelInsRows = $this->db->query("SELECT presensi.Instruktur, rombel.Namarombel, COUNT(*) as jml FROM presensi JOIN rombel ON presensi.Jeniskursus=rombel.Id WHERE presensi.Tgl BETWEEN '$bulanStart' AND '$bulanEnd' GROUP BY presensi.Instruktur, rombel.Namarombel")->result();
        $rombelInsMap = [];
        foreach ($rombelInsRows as $r) {
            $id = (int)$r->Instruktur;
            if (!isset($rombelInsMap[$id]) || (int)$r->jml > (int)$rombelInsMap[$id]->jml) {
                $rombelInsMap[$id] = $r;
            }
        }
        $data['rombelInsMap'] = $rombelInsMap;

		$this->load->view('dashboard', $data);
        $this->load->view('layout/footer');
    }

    function dashboard_instruktur()
    {
        require_login();
        if (!is_instructor()) {
            redirect(base_url('pages/dashboard'));
            return;
        }
        $ins_id = current_instructor_id();
        if ($ins_id <= 0) {
            $this->session->set_flashdata('error', 'Akun Anda belum terhubung ke data instruktur. Hubungi administrator.');
            redirect('login/logout');
            return;
        }

        $ins = $this->db->query("SELECT * FROM instruktur WHERE Id=$ins_id")->row();
        $data['nama_instruktur'] = $ins ? $ins->NamaInstruktur : 'Instruktur';

        // ===== Statistik milik instruktur (dipertahankan dari dashboard lama) =====
        $curStart = date('Y-m-01 00:00:00');
        $curEnd = date('Y-m-t 23:59:59');
        $data['totalPresensi'] = (int)($this->db->query("SELECT COUNT(*) AS c FROM presensi WHERE Instruktur=$ins_id AND pegawai IS NULL")->row()->c ?? 0);
        $data['presensiBulan'] = (int)($this->db->query("SELECT COUNT(*) AS c FROM presensi WHERE Instruktur=$ins_id AND pegawai IS NULL AND Tgl BETWEEN '$curStart' AND '$curEnd'")->row()->c ?? 0);
        $data['presensiHari'] = (int)($this->db->query("SELECT COUNT(*) AS c FROM presensi WHERE Instruktur=$ins_id AND pegawai IS NULL AND DATE(Tgl)=CURDATE()")->row()->c ?? 0);
        $data['totalPeserta'] = (int)($this->db->query("SELECT COUNT(DISTINCT Nipd) AS c FROM presensi WHERE Instruktur=$ins_id AND pegawai IS NULL")->row()->c ?? 0);

        // ===== Replikasi dashboard utama (global) minus beberapa bagian =====
        $data['sapras'] = $this->Model_APS->tampil_data('sapras', 'Id', 'ASC')->result();
        $data['lulusan'] = $this->db->query("SELECT * FROM lulusan")->result();
        $data['peserta'] = $this->db->query("SELECT * FROM peserta WHERE Status=1 or Status=0")->result();
        $data['rombel'] = $this->db->query("SELECT * FROM rombel")->result();
        $data['instruktur'] = $this->db->query("SELECT * FROM instruktur")->result();

        // Streak peserta
        $streakRows = $this->db->query("SELECT presensi.Nipd, DATE(presensi.Tgl) AS d FROM presensi WHERE presensi.pegawai IS NULL AND presensi.Nipd <> 0 GROUP BY presensi.Nipd, DATE(presensi.Tgl)")->result();
        $datesByNipd = [];
        foreach ($streakRows as $sr) {
            $datesByNipd[(int)$sr->Nipd][] = $sr->d;
        }
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $streakMap = [];
        foreach ($datesByNipd as $nipd => $dates) {
            $dates = array_values(array_unique($dates));
            rsort($dates);
            if ($dates[0] !== $today && $dates[0] !== $yesterday) {
                continue;
            }
            $set = array_flip($dates);
            $streak = 1;
            $cursor = $dates[0];
            while (isset($set[date('Y-m-d', strtotime($cursor . ' -1 day'))])) {
                $cursor = date('Y-m-d', strtotime($cursor . ' -1 day'));
                $streak++;
            }
            if ($streak >= 3) {
                $streakMap[$nipd] = $streak;
            }
        }
        arsort($streakMap);
        $streakList = [];
        if (!empty($streakMap)) {
            $ids = implode(',', array_map('intval', array_keys($streakMap)));
            $detailRows = $this->db->query("SELECT peserta.Nipd, peserta.Nama, rombel.Namarombel FROM peserta LEFT JOIN rombel ON peserta.Jeniskursus = rombel.Id WHERE peserta.Nipd IN ($ids)")->result();
            $detailMap = [];
            foreach ($detailRows as $dr) {
                $detailMap[(int)$dr->Nipd] = $dr;
            }
            foreach ($streakMap as $nipd => $st) {
                if (!isset($detailMap[$nipd])) {
                    continue;
                }
                $streakList[] = (object)[
                    'Nipd' => $nipd,
                    'Nama' => $detailMap[$nipd]->Nama,
                    'Namarombel' => $detailMap[$nipd]->Namarombel,
                    'streak' => $st,
                ];
            }
        }
        $data['streakPeserta'] = $streakList;

        // Presensi hari ini (banner)
        $todayStart = date("Y-m-d 00:00:00");
        $todayEnd = date("Y-m-d 23:59:59");
        $data['totalPeserta'] = (int)($this->db->query("SELECT COUNT(*) as total FROM presensi WHERE Tgl BETWEEN '$todayStart' AND '$todayEnd' AND pegawai IS NULL")->row()->total ?? 0);
        $pegArr = $this->db->query("SELECT NamaPegawai FROM presensi JOIN pegawai ON presensi.Nipd = pegawai.Nipg WHERE Tgl BETWEEN '$todayStart' AND '$todayEnd' AND pegawai=1")->result();
        $insArr = $this->db->query("SELECT DISTINCT NamaInstruktur FROM presensi JOIN instruktur ON presensi.Instruktur = instruktur.Id WHERE Tgl BETWEEN '$todayStart' AND '$todayEnd' AND (pegawai IS NULL OR pegawai != 1) AND Instruktur IS NOT NULL")->result();
        $allStaff = array_values(array_unique(array_merge(
            array_map(function ($row) { return $row->NamaPegawai; }, $pegArr),
            array_map(function ($row) { return $row->NamaInstruktur; }, $insArr)
        )));
        $data['jmlPegawai'] = count($allStaff);
        $data['pegawaiNames'] = !empty($allStaff) ? implode(", ", $allStaff) : "";

        // Ringkasan global
        $data['cntPesertaAll'] = (int)($this->db->count_all('peserta') ?? 0);
        $data['cntAktif'] = (int)($this->db->query("SELECT COUNT(*) as c FROM peserta WHERE Status=1")->row()->c ?? 0);
        $data['cntNon'] = (int)($this->db->query("SELECT COUNT(*) as c FROM peserta WHERE Status=0")->row()->c ?? 0);
        $data['cntLulusPeserta'] = (int)($this->db->query("SELECT COUNT(*) as c FROM peserta WHERE Status=2")->row()->c ?? 0);

        // Periode bulan untuk kartu bulanan (maks. 3 bulan ke belakang)
        $bulanIndoCtl = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
        $bulanMax = date('Y-m');
        $bulanMin = date('Y-m', strtotime('-3 months'));
        $bulanReq = (string)$this->input->get('bulan');
        $bulanAktif = preg_match('/^\d{4}-\d{2}$/', $bulanReq) ? $bulanReq : $bulanMax;
        if ($bulanAktif < $bulanMin || $bulanAktif > $bulanMax) {
            $bulanAktif = $bulanMax;
        }
        $bulanStart = date('Y-m-01 00:00:00', strtotime($bulanAktif . '-01'));
        $bulanEnd = date('Y-m-t 23:59:59', strtotime($bulanAktif . '-01'));
        $bulanNum = (int)substr($bulanAktif, 5, 2);
        $bulanNama = $bulanIndoCtl[$bulanNum] . ' ' . substr($bulanAktif, 0, 4);
        $isBulanIni = $bulanAktif === $bulanMax;
        $data['bulanAktif'] = $bulanAktif;
        $data['isBulanIni'] = $isBulanIni;
        $data['bulanLabel'] = $bulanNama;
        $data['rangeLabel'] = '1-' . ($isBulanIni ? date('d') : date('t', strtotime($bulanAktif . '-01'))) . ' ' . $bulanNama;
        $bulanPrev = date('Y-m', strtotime($bulanAktif . '-01 -1 month'));
        $data['bulanPrev'] = $bulanPrev >= $bulanMin ? $bulanPrev : null;
        $bulanNext = date('Y-m', strtotime($bulanAktif . '-01 +1 month'));
        $data['bulanNext'] = $bulanNext <= $bulanMax ? $bulanNext : null;

        // Hari favorit bulan ini
        $data['mapHari'] = ['Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu'];
        $hariFavRowsBulan = $this->db->query("SELECT DAYNAME(Tgl) as en, COUNT(*) as jml FROM presensi WHERE Tgl BETWEEN '$bulanStart' AND '$bulanEnd' AND Tgl IS NOT NULL AND Tgl != '0000-00-00 00:00:00' GROUP BY en")->result();
        $hariFavMapBulan = [];
        foreach ($hariFavRowsBulan as $r) {
            $hariFavMapBulan[$r->en] = (int)$r->jml;
        }
        $hariFav = '-';
        $hariFavJml = 0;
        if (!empty($hariFavMapBulan)) {
            arsort($hariFavMapBulan);
            $enTop = array_key_first($hariFavMapBulan);
            $hariFav = $data['mapHari'][$enTop] ?? $enTop;
            $hariFavJml = $hariFavMapBulan[$enTop];
        }
        $data['hariFavMapBulan'] = $hariFavMapBulan;
        $data['hariFav'] = $hariFav;
        $data['hariFavJml'] = $hariFavJml;
        $data['maxHariBulan'] = !empty($hariFavMapBulan) ? max($hariFavMapBulan) : 0;

        // Peserta rajin & instruktur aktif bulan ini
        $data['rajinBulan'] = $this->db->query("SELECT peserta.Nama, peserta.Nipd, rombel.Namarombel, COUNT(presensi.Tgl) as jml FROM presensi JOIN peserta ON presensi.Nipd=peserta.Nipd JOIN rombel ON peserta.Jeniskursus=rombel.Id WHERE presensi.Tgl BETWEEN '$bulanStart' AND '$bulanEnd' AND presensi.pegawai IS NULL GROUP BY peserta.Nipd ORDER BY jml DESC LIMIT 5")->result();
        $data['maxRajin'] = !empty($data['rajinBulan']) ? (int)max(array_column(array_map(function ($r) { return (array)$r; }, $data['rajinBulan']), 'jml')) : 0;
        $data['instrukturBulan'] = $this->db->query("SELECT instruktur.NamaInstruktur, instruktur.Id, COUNT(presensi.Tgl) as jml FROM presensi JOIN instruktur ON presensi.Instruktur=instruktur.Id WHERE presensi.Tgl BETWEEN '$bulanStart' AND '$bulanEnd' GROUP BY presensi.Instruktur ORDER BY jml DESC LIMIT 5")->result();
        $data['maxInstruktur'] = !empty($data['instrukturBulan']) ? (int)max(array_column(array_map(function ($r) { return (array)$r; }, $data['instrukturBulan']), 'jml')) : 0;
        $rombelInsRows = $this->db->query("SELECT presensi.Instruktur, rombel.Namarombel, COUNT(*) as jml FROM presensi JOIN rombel ON presensi.Jeniskursus=rombel.Id WHERE presensi.Tgl BETWEEN '$bulanStart' AND '$bulanEnd' GROUP BY presensi.Instruktur, rombel.Namarombel")->result();
        $rombelInsMap = [];
        foreach ($rombelInsRows as $r) {
            $id = (int)$r->Instruktur;
            if (!isset($rombelInsMap[$id]) || (int)$r->jml > (int)$rombelInsMap[$id]->jml) {
                $rombelInsMap[$id] = $r;
            }
        }
        $data['rombelInsMap'] = $rombelInsMap;

        $this->load->view('dashboard_instruktur', $data);
        $this->load->view('layout/footer');
    }

    function lembaga()
    {
        require_admin();
        $data['profil'] = $this->Model_APS->tampil_data('profil', 'npsn', 'ASC')->result();
        $this->load->view('menu/profil/lihat', $data);
        $this->load->view('layout/footer');
    }
    function lembaga_edit()
    {
        require_admin();
        $data['profil'] = $this->Model_APS->tampil_data('profil', 'npsn', 'ASC')->result();
        $this->load->view('menu/profil/ubah', $data);
        $this->load->view('layout/footer');
    }
    function ubahdata()
    {
        require_admin();
        $npsn = $this->input->post('npsn');
        $nmlem = $this->input->post('nmlem');
        $alamat = $this->input->post('alamat');
        $rt = $this->input->post('rt');
        $rw = $this->input->post('rw');
        $kel = $this->input->post('kel');
        $kec = $this->input->post('kec');
        $kota = $this->input->post('kota');
        $prov = $this->input->post('prov');
        $kp = $this->input->post('kp');
        $namaya = $this->input->post('namaya');
        $telp = $this->input->post('telp');
        $fax = $this->input->post('fax');
        $email = $this->input->post('email');

        $data = array(
            'Namalkp' => $nmlem,
            'Npsn' => $npsn,
            'Alamat' => $alamat,
            'Kelurahan' => $kel,
            'Kecamatan' => $kec,
            'Kota' => $kota,
            'Provinsi' => $prov,
            'Rt' => $rt,
            'Rw' => $rw,
            'Kodepos' => $kp,
            'Namayayasan' => $namaya,
            'Telepon' => $telp,
            'Nofax' => $fax,
            'Email' => $email
        );
        $this->Model_APS->proses_update_all($data, 'profil');
        redirect('pages/lembaga');
    }

    function sapras()
    {
        require_admin();
        $data['sapras'] = $this->Model_APS->tampil_data('sapras', 'Id', 'ASC')->result();

        $this->load->view('menu/sapras/lihat', $data);
        $this->load->view('layout/footer');
    }
    function instruktur()
    {
        require_admin();
        $data['instruktur'] = $this->Model_APS->tampil_data('instruktur', 'Id', 'ASC')->result();

        $this->load->view('menu/instruktur/lihat', $data);
        $this->load->view('layout/footer');
    }
    function peserta()
    {
        require_login();
        $data['rombel'] = $this->db->query("SELECT Namarombel,Kelas FROM rombel")->result();
        $data['alert'] = $this->session->flashdata('alert');
        $this->load->view('menu/peserta/lihat-serverside', $data);
        $this->load->view('layout/footer');
    }
    function peserta2()
    {
        require_login();
        $data['rombel'] = $this->db->query("SELECT Namarombel,Kelas FROM rombel")->result();
        $data['alert'] = $this->session->flashdata('alert');
        $this->load->view('menu/peserta/lihat-serverside', $data);
        $this->load->view('layout/footer');
    }
    function rombel()
    {
        require_admin();
        $data['rombel'] = $this->Model_APS->tampil_data('rombel', 'Id', 'ASC')->result();

        $this->load->view('menu/rombel/lihat', $data);
        $this->load->view('layout/footer');
    }
    function uk()
    {
        require_admin();
        $on = "unitkompetensi.Rombel=rombel.Id";
        $data['uks'] = $this->Model_APS->tampil_data_join('*, rombel.Id as Idr, unitkompetensi.Id as Idu', 'unitkompetensi', 'rombel', $on, 'unitkompetensi.Id', 'ASC')->result();

        $this->load->view('menu/uk/lihat', $data);
        $this->load->view('layout/footer');
    }
    function lulusan()
    {
        require_login();
        $data['notes'] = $this->Model_APS->tampil_data('notes', 'Id', 'ASC')->result();
        $data['lulusan'] = $this->db->query("SELECT *,lulusan.Id AS Idl FROM lulusan JOIN instruktur JOIN peserta JOIN rombel JOIN unitkompetensi on lulusan.Instruktur=instruktur.Id AND lulusan.Nipd=peserta.Nipd AND peserta.Jeniskursus=rombel.Id AND unitkompetensi.Rombel=rombel.Id ORDER BY lulusan.Id desc")->result();
        $this->load->view('menu/lulusan/lihat', $data);
        $this->load->view('layout/footer');
    }
    function presensi()
    {
        $this->load->view('menu/presensi/lihat');
        $this->load->view('layout/footer');
    }
    function log()
    {
        require_admin();
        $data['logs'] = $this->db->query("SELECT * FROM log ORDER BY log_tgl DESC LIMIT 200")->result();
        $this->load->view('menu/log', $data);
        $this->load->view('layout/footer');
    }
    function pegawai()
    {
        require_admin();
        $data['pegawai'] = $this->Model_APS->tampil_data('pegawai', 'Id', 'ASC')->result();
        $this->load->view('menu/pegawai/lihat', $data);
        $this->load->view('layout/footer');
    }
}
