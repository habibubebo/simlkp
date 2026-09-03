<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cek extends CI_Controller
{
   
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_APS');
        require_login();
    }
    
    function index()
    {
        $induk = (int)($this->input->get('nipd') ?? 0);
        if ($induk <= 0) {
            return;
        }
        $query = $this->db->query("SELECT *,lulusan.Id AS Idl FROM lulusan JOIN instruktur JOIN peserta JOIN rombel JOIN unitkompetensi on lulusan.Instruktur=instruktur.Id AND lulusan.Nipd=peserta.Nipd AND peserta.Jeniskursus=rombel.Id AND unitkompetensi.Rombel=rombel.Id where peserta.Nipd=$induk");
        $data = $query->result();
        
        if ($query->num_rows() == 0) {echo('<script>console.log("not found");</script>');} else echo('<script>console.log('.json_encode($data).');</script>');       
         // $this->load->view('menu/lulusan/lihat', $data);
    }
    function view()
    {
        $tables = "peserta";
        $search = array('Nama', 'Id', 'Nipd', 'Ttl');
        // jika memakai IS NULL pada where sql
        $isWhere = null;
        header('Content-Type: application/json');
        echo $this->Model_APS->get_tables($tables, $search, $isWhere);
    }
    function view2()
    {
        $query  = "SELECT *,peserta.Id AS Idp FROM peserta JOIN rombel ON peserta.Jeniskursus=rombel.Id";
        $search = array('Nama', 'peserta.Id', 'Nipd', 'Ttl', 'Status','rombel.Namarombel');
        $where  = null;

        $isWhere = null;
        // $isWhere = 'artikel.deleted_at IS NULL';
        header('Content-Type: application/json');
        echo $this->Model_APS->get_tables_query($query, $search, $where, $isWhere);
    }

    function lulusan()
    {
        $draw = (int)($this->input->get('draw') ?? 0);
        $start = (int)($this->input->get('start') ?? 0);
        $length = (int)($this->input->get('length') ?? 10);
        if ($length < 1 || $length > 200) { $length = 10; }
        $search_value = $this->db->escape_like_str((string)($this->input->get('search')['value'] ?? ''));

        $query = "SELECT *,lulusan.Id AS Idl FROM lulusan JOIN instruktur JOIN peserta JOIN rombel JOIN unitkompetensi on lulusan.Instruktur=instruktur.Id AND lulusan.Nipd=peserta.Nipd AND peserta.Jeniskursus=rombel.Id AND unitkompetensi.Rombel=rombel.Id";
        
        if ($search_value !== '') {
            $query .= " WHERE (peserta.Nama LIKE '%" . $search_value . "%' OR rombel.Namarombel LIKE '%" . $search_value . "%')";
        }
        
        $query .= " ORDER BY lulusan.Id desc";
        
        // Hitung total data tanpa filter
        $total_data = $this->db->query($query)->num_rows();
        
        // Tambahkan LIMIT untuk paginasi
        $query .= " LIMIT " . $start . ", " . $length;
        
        $data = $this->db->query($query)->result_array();
        
        // Persiapkan respons dalam format JSON untuk DataTables
        $response = array(
            "draw" => $draw,
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,  // Anda bisa menghitung ulang jika ada filter pencarian
            "data" => $data
        );
        
        echo json_encode($response);
    }

    function presensi()
    {
        $draw = intval($_POST['draw'] ?? 0);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 10);
        $search = $_POST['search']['value'] ?? '';
        $orderCol = intval($_POST['order'][0]['column'] ?? 0);
        $orderDir = strtoupper((string)($_POST['order'][0]['dir'] ?? '')) === 'ASC' ? 'ASC' : 'DESC';

        $cols = ['Tgl', 'Nama', 'Namarombel', 'NamaInstruktur', 'Materi', 'Id'];
        $orderField = $cols[$orderCol] ?? 'Tgl';

        $base = "FROM presensi JOIN peserta ON presensi.Nipd=peserta.Nipd JOIN instruktur ON presensi.Instruktur=instruktur.Id JOIN rombel ON presensi.Jeniskursus=rombel.Id";

        $where = '';
        $role_where = '';
        if (is_instructor()) {
            $role_where = " presensi.Instruktur = " . current_instructor_id();
        }
        if (!empty($search)) {
            $s = $this->db->escape_like_str($search);
            $where = " WHERE (peserta.Nama LIKE '%$s%' OR rombel.Namarombel LIKE '%$s%' OR instruktur.NamaInstruktur LIKE '%$s%' OR presensi.Materi LIKE '%$s%')";
        }
        if (!empty($role_where)) {
            $where = ($where === '') ? " WHERE $role_where" : " $where AND $role_where";
        }

        $total = $this->db->query("SELECT COUNT(*) AS cnt $base $where")->row()->cnt;

        $sql = "SELECT presensi.Id, presensi.Tgl, presensi.Nipd, peserta.Nama, peserta.Jeniskursus, rombel.Namarombel, instruktur.Id AS IdI, instruktur.NamaInstruktur, peserta.Id AS Idp, presensi.Materi $base $where ORDER BY $orderField $orderDir LIMIT $start, $length";
        $rows = $this->db->query($sql)->result();

        $data = [];
        foreach ($rows as $r) {
            $data[] = [
                'Tgl' => $r->Tgl,
                'Nama' => $r->Nama,
                'Namarombel' => $r->Namarombel,
                'NamaInstruktur' => $r->NamaInstruktur,
                'Materi' => $r->Materi,
                'Id' => $r->Id,
                'Nipd' => $r->Nipd,
                'IdI' => $r->IdI,
                'Idp' => $r->Idp,
                'Jeniskursus' => $r->Jeniskursus,
            ];
        }

        header('Content-Type: application/json');
        echo json_encode([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ]);
    }
    
    function streak()
    {
        // 1. Nama & jumlah hari (?nama=&hari= / ?days= / ?n=)
        $nama_peserta = isset($_GET['nama']) ? strtoupper(trim($_GET['nama'])) : "NAMA PESERTA";
        if ($nama_peserta === '') $nama_peserta = "NAMA PESERTA";
        $nama_peserta = preg_replace('/\s+/', ' ', trim($nama_peserta));
        $hariRaw = $_GET['hari'] ?? $_GET['days'] ?? $_GET['n'] ?? $_GET['jumlah'] ?? $_GET['streak'] ?? null;
        $hari = 3;
        if ($hariRaw !== null) {
            if (is_numeric($hariRaw)) $hari = max(1, (int)$hariRaw);
            elseif (preg_match('/\d+/', (string)$hariRaw, $m)) $hari = max(1, (int)$m[0]);
        }

        $width  = 500;
        $targetCap = 430;
        $aspect_logo = 993 / 368;

        // Font utama: Archivo Black (asset) -> heavy black untuk angka & teks streak
        $fontAB   = FCPATH . 'asset/font/ArchivoBlack-Regular.ttf';
        $fontReg  = FCPATH . 'asset/font/Nunito-Regular.ttf';
        $hasAB    = is_file($fontAB) && function_exists('imagettfbbox') && function_exists('imagettftext');
        $hasTTF   = $hasAB || (is_file($fontReg) && function_exists('imagettfbbox') && function_exists('imagettftext'));
        if ($hasAB)      { $font = $fontAB; $fakeBold = false; }
        else if ($hasTTF){ $font = $fontReg; $fakeBold = true;  }
        else             { $font = null; $fakeBold = false; }

        $lineHari  = "HARI";
        $lineTanpa = "TANPA JEDA";
        $numStr    = (string)$hari;

        // ---------- TTF path: logo atas -> nama -> api -> angka hitam -> HARI -> TANPA JEDA ----------
        if ($hasTTF) {
            // --- ukuran nama (Archivo Black) ---
            $targetName = 430;
            $maxSizeName = 40; $minReadable = 20; $minSize = 14;
            $bestLines = null; $bestSize = null;
            for ($allowed = 1; $allowed <= 3; $allowed++) {
                for ($sz = $maxSizeName; $sz >= $minReadable; $sz--) {
                    $lines = $this->_streak_wrap_ttf($nama_peserta, $targetName, $font, $sz, $fakeBold);
                    if (count($lines) <= $allowed) {
                        $ok = true;
                        foreach ($lines as $ln) {
                            if ($this->_streak_ttf_width($ln, $sz, $font, $fakeBold) > $targetName) { $ok = false; break; }
                        }
                        if ($ok) { $bestLines = $lines; $bestSize = $sz; break 2; }
                    }
                }
            }
            if ($bestLines === null) {
                for ($allowed = 1; $allowed <= 3; $allowed++) {
                    for ($sz = $minReadable - 1; $sz >= $minSize; $sz--) {
                        $lines = $this->_streak_wrap_ttf($nama_peserta, $targetName, $font, $sz, $fakeBold);
                        if (count($lines) <= $allowed) {
                            $ok = true;
                            foreach ($lines as $ln) {
                                if ($this->_streak_ttf_width($ln, $sz, $font, $fakeBold) > $targetName) { $ok = false; break; }
                            }
                            if ($ok) { $bestLines = $lines; $bestSize = $sz; break 2; }
                        }
                    }
                }
            }
            if ($bestLines === null) {
                $bestSize = 16;
                $bestLines = $this->_streak_wrap_ttf($nama_peserta, $targetName, $font, $bestSize, $fakeBold);
            }
            $nameLineH = 0;
            foreach ($bestLines as $ln) {
                $h = $this->_streak_ttf_height($ln, $bestSize, $font, $fakeBold);
                if ($h > $nameLineH) $nameLineH = $h;
            }
            $nameGap = (int)max(4, $bestSize * 0.30);
            $nameBlockH = count($bestLines) * $nameLineH + max(0, count($bestLines) - 1) * $nameGap;

            // --- ukuran HARI & TANPA JEDA (lebar sama = $targetCap) ---
            $sizeHari  = $this->_streak_find_size_for_width($lineHari,  $targetCap, $font, 14, 54, $fakeBold);
            $sizeTanpa = $this->_streak_find_size_for_width($lineTanpa, $targetCap, $font, 14, 54, $fakeBold);
            $hariH  = $this->_streak_ttf_height($lineHari,  $sizeHari,  $font, $fakeBold) + 4;
            $tanpaH = $this->_streak_ttf_height($lineTanpa, $sizeTanpa, $font, $fakeBold) + 4;

            // --- ukuran angka N (hitam, di atas api) - setengah dari sebelumnya ---
            $sizeNum = $this->_streak_find_size_for_width($numStr, 85, $font, 20, 70, $fakeBold);
            $numW = $this->_streak_ttf_width($numStr, $sizeNum, $font, $fakeBold);
            $numH = $this->_streak_ttf_height($numStr, $sizeNum, $font, $fakeBold);

            // --- tata letak vertikal ---
            $logoW = 300; $logoH = (int)round($logoW / $aspect_logo);
            $logoY = 26;
            $nameY = $logoY + $logoH + 18;

            $display = 285;
            $iconY = $nameY + $nameBlockH + 16;

            // angka N: turunkan ke bawah api (mendekati dasar api), rata tengah horizontal
            $numX = (int)round(($width - $numW) / 2);
            $numY = (int)round($iconY + $display * 0.82 - $numH / 2);

            $hariY  = $iconY + $display + 16;
            $tanpaY = $hariY + $hariH + 14;
            $height = $tanpaY + $tanpaH + 24;

            $image = imagecreatetruecolor($width, $height);
            imagealphablending($image, false);
            imagesavealpha($image, true);
            imagefill($image, 0, 0, imagecolorallocatealpha($image, 0, 0, 0, 127));
            imagealphablending($image, true);

            // --- logo di paling atas ---
            $logo = @imagecreatefrompng(FCPATH . 'asset/img/logo/logo.png');
            if ($logo !== false) {
                $logo_w = imagesx($logo); $logo_h = imagesy($logo);
                $lw = $logoW; $lh = (int)round($logo_h * $lw / $logo_w);
                imagecopyresampled($image, $logo, (int)(($width - $lw) / 2), $logoY, 0, 0, $lw, $lh, $logo_w, $logo_h);
                imagedestroy($logo);
            }

            // --- api utama + api-api kecil ---
            $ox = (int)(($width - $display) / 2);
            $icon_path = FCPATH . 'asset/api.png';
            if (!is_file($icon_path)) $icon_path = FCPATH . 'asset/img/api.png';
            $icon = is_file($icon_path) ? @imagecreatefrompng($icon_path) : false;
            if ($icon !== false) {
                $icon_w = imagesx($icon); $icon_h = imagesy($icon);
                $sc = min($display / $icon_w, $display / $icon_h);
                $iw = (int)round($icon_w * $sc); $ih = (int)round($icon_h * $sc);
                $ix = (int)round($ox + ($display - $iw) / 2);
                $iy = (int)round($iconY + ($display - $ih) / 2);
                imagecopyresampled($image, $icon, $ix, $iy, 0, 0, $iw, $ih, $icon_w, $icon_h);
                imagedestroy($icon);
            } else {
                $flame = imagecreatetruecolor(70, 70);
                imagealphablending($flame, false); imagesavealpha($flame, true);
                imagefill($flame, 0, 0, imagecolorallocatealpha($flame, 0, 0, 0, 127));
                imagealphablending($flame, true);
                $this->_streak_flame($flame, 0, 0);
                imagecopyresampled($image, $flame, $ox, $iconY, 0, 0, $display, $display, 70, 70);
                imagedestroy($flame);
            }

            // --- api kecil random di samping api utama sebanyak $hari (ukuran lebih kecil) ---
            $nSmall = max(0, min((int)$hari, 60));
            if ($nSmall > 0) {
                $smallSize = $nSmall <= 5 ? 46 : ($nSmall <= 10 ? 38 : ($nSmall <= 20 ? 30 : ($nSmall <= 40 ? 22 : 16)));
                $centerX = $width / 2; $centerY = $iconY + $display / 2;
                $rMin = $display/2 + $smallSize*0.55 + 12; $rMax = $display/2 + $smallSize*0.55 + 48;
                if ($nSmall > 20) $rMax += 12;
                $smallIcon = is_file($icon_path) ? @imagecreatefrompng($icon_path) : false;
                if ($smallIcon !== false) {
                    $siW = imagesx($smallIcon); $siH = imagesy($smallIcon);
                    // distribusi sudut merata keliling agar tidak mengumpul di satu sisi
                    $spread = 360 / max(1, $nSmall);
                    $baseAngle = mt_rand(0, 359);
                    for ($fi = 0; $fi < $nSmall; $fi++) {
                        $angle = ($baseAngle + $fi * $spread + mt_rand(-14, 14)) * M_PI / 180;
                        $rad = mt_rand((int)($rMin*10), (int)($rMax*10)) / 10;
                        $ss = (int)round($smallSize * mt_rand(85, 115) / 100);
                        $x = (int)round($centerX + cos($angle)*$rad - $ss/2 + mt_rand(-6, 6));
                        $y = (int)round($centerY + sin($angle)*$rad - $ss/2 + mt_rand(-6, 6));
                        if ($x < 2) $x = 2; if ($x + $ss > $width - 2) $x = $width - 2 - $ss;
                        if ($y < $iconY - 20) $y = $iconY + mt_rand(6, 24) - ($ss / 2);
                        if ($y + $ss > $hariY + 8) $y = $hariY - $ss - mt_rand(4, 16);
                        imagecopyresampled($image, $smallIcon, $x, $y, 0, 0, $ss, $ss, $siW, $siH);
                    }
                    imagedestroy($smallIcon);
                } else {
                    $spread = 360 / max(1, $nSmall);
                    $baseAngle = mt_rand(0, 359);
                    for ($fi = 0; $fi < $nSmall; $fi++) {
                        $angle = ($baseAngle + $fi * $spread + mt_rand(-14, 14)) * M_PI / 180;
                        $rad = mt_rand((int)($rMin*10), (int)($rMax*10))/10;
                        $ss = (int)round($smallSize * mt_rand(85, 115)/100);
                        $x = (int)round($centerX + cos($angle)*$rad - $ss/2 + mt_rand(-6, 6));
                        $y = (int)round($centerY + sin($angle)*$rad - $ss/2 + mt_rand(-6, 6));
                        if ($x < 2) $x = 2; if ($x + $ss > $width - 2) $x = $width - 2 - $ss; if ($y < 2) $y = 2;
                        $tmpF = imagecreatetruecolor($ss, $ss);
                        imagealphablending($tmpF, false); imagesavealpha($tmpF, true); imagefill($tmpF, 0, 0, imagecolorallocatealpha($tmpF, 0, 0, 0, 127)); imagealphablending($tmpF, true);
                        $base = imagecreatetruecolor(70, 70);
                        imagealphablending($base, false); imagesavealpha($base, true); imagefill($base, 0, 0, imagecolorallocatealpha($base, 0, 0, 0, 127)); imagealphablending($base, true);
                        $this->_streak_flame($base, 0, 0);
                        imagecopyresampled($tmpF, $base, 0, 0, 0, 0, $ss, $ss, 70, 70); imagedestroy($base);
                        imagecopy($image, $tmpF, $x, $y, 0, 0, $ss, $ss); imagedestroy($tmpF);
                    }
                }
            }

            $white = imagecolorallocate($image, 255, 255, 255);
            $orange = imagecolorallocate($image, 243, 112, 33);

            // Nama peserta (Archivo Black), rata tengah
            foreach ($bestLines as $idx => $ln) {
                $w = $this->_streak_ttf_width($ln, $bestSize, $font, $fakeBold);
                $dx = (int)round(($width - $w) / 2);
                $dyTop = $nameY + $idx * ($nameLineH + $nameGap);
                $this->_streak_draw_ttf($image, $ln, $bestSize, $font, $white, $dx, $dyTop, $fakeBold);
            }

            // Angka N hitam di tengah api utama, 1/3 dari bawah
            $this->_streak_draw_ttf($image, $numStr, $sizeNum, $font, $orange, $numX, $numY, $fakeBold);

            // HARI (di bawah api)
            {
                $w = $this->_streak_ttf_width($lineHari, $sizeHari, $font, $fakeBold);
                $dx = (int)round(($width - $w) / 2);
                $this->_streak_draw_ttf($image, $lineHari, $sizeHari, $font, $white, $dx, $hariY, $fakeBold);
            }
            // TANPA JEDA (paling bawah)
            {
                $w = $this->_streak_ttf_width($lineTanpa, $sizeTanpa, $font, $fakeBold);
                $dx = (int)round(($width - $w) / 2);
                $this->_streak_draw_ttf($image, $lineTanpa, $sizeTanpa, $font, $white, $dx, $tanpaY, $fakeBold);
            }

            header('Content-Type: image/png');
            imagepng($image);
            imagedestroy($image);
            return;
        }

        // ---------- Fallback GD (jika TTF tidak tersedia) ----------
        $fw = imagefontwidth(5); $fh = imagefontheight(5);
        $namaLines = $this->_streak_wrap_name($nama_peserta, 430, $fw);
        $maxLenNama = 0; foreach ($namaLines as $ln) $maxLenNama = max($maxLenNama, strlen($ln));
        $nameScale = 430 / ($fw * max(1,$maxLenNama)); if($nameScale>4.0)$nameScale=4.0; if($nameScale<0.9)$nameScale=0.9;
        $nameDh=(int)round($fh*$nameScale); $nameGap=(int)round(max(4,$nameScale*3.5));
        $nameBlockH=count($namaLines)*$nameDh+max(0,count($namaLines)-1)*$nameGap;
        $scaleHari=$targetCap/($fw*max(1,strlen($lineHari))); $scaleTanpa=$targetCap/($fw*max(1,strlen($lineTanpa)));
        if($scaleHari>4.0)$scaleHari=4.0; if($scaleHari<0.8)$scaleHari=0.8; if($scaleTanpa>4.0)$scaleTanpa=4.0; if($scaleTanpa<0.8)$scaleTanpa=0.8;
        $hariH=(int)round($fh*$scaleHari); $tanpaH=(int)round($fh*$scaleTanpa);
        // angka N hitam
        $numScale=$targetCap/($fw*max(1,strlen($numStr))); if($numScale>2.5)$numScale=2.5; if($numScale<0.5)$numScale=0.5;
        $numDh=(int)round($fh*$numScale); $numDw=(int)round($fw*strlen($numStr)*$numScale);
        $logoW=300; $logoH=(int)round($logoW/$aspect_logo); $logoY=26;
        $nameY=$logoY+$logoH+18; $display=285; $iconY=$nameY+$nameBlockH+16;
        $numX=(int)round(($width-$numDw)/2); $numY=(int)round($iconY+$display*0.82-$numDh/2);
        $hariY=$iconY+$display+16; $tanpaY=$hariY+$hariH+14; $height=$tanpaY+$tanpaH+24;
        $image=imagecreatetruecolor($width,$height);
        imagealphablending($image,false); imagesavealpha($image,true);
        imagefill($image,0,0,imagecolorallocatealpha($image,0,0,0,127)); imagealphablending($image,true);
        // logo
        $logo=@imagecreatefrompng(FCPATH.'asset/img/logo/logo.png');
        if($logo!==false){$logo_w=imagesx($logo);$logo_h=imagesy($logo);$lw=$logoW;$lh=(int)round($logo_h*$lw/$logo_w);imagecopyresampled($image,$logo,(int)(($width-$lw)/2),$logoY,0,0,$lw,$lh,$logo_w,$logo_h);imagedestroy($logo);}
        $ox=(int)(($width-$display)/2);
        $icon_path=FCPATH.'asset/api.png'; if(!is_file($icon_path)) $icon_path=FCPATH.'asset/img/api.png';
        $icon=is_file($icon_path)?@imagecreatefrompng($icon_path):false;
        if($icon!==false){$icon_w=imagesx($icon);$icon_h=imagesy($icon);$sc=min($display/$icon_w,$display/$icon_h);$iw=(int)round($icon_w*$sc);$ih=(int)round($icon_h*$sc);$ix=(int)round($ox+($display-$iw)/2);$iy=(int)round($iconY+($display-$ih)/2);imagecopyresampled($image,$icon,$ix,$iy,0,0,$iw,$ih,$icon_w,$icon_h);imagedestroy($icon);}else{$flame=imagecreatetruecolor(70,70);imagealphablending($flame,false);imagesavealpha($flame,true);imagefill($flame,0,0,imagecolorallocatealpha($flame,0,0,0,127));imagealphablending($flame,true);$this->_streak_flame($flame,0,0);imagecopyresampled($image,$flame,$ox,$iconY,0,0,$display,$display,70,70);imagedestroy($flame);}
        // api kecil random disamping api utama (GD fallback) sebanyak $hari
        $nSmall = max(0, min((int)$hari, 60));
        if ($nSmall > 0) {
            $smallSize = $nSmall <= 5 ? 46 : ($nSmall <= 10 ? 38 : ($nSmall <= 20 ? 30 : ($nSmall <= 40 ? 22 : 16)));
            $centerX = $width / 2; $centerY = $iconY + $display / 2;
            $rMin = $display/2 + $smallSize*0.55 + 12; $rMax = $display/2 + $smallSize*0.55 + 48; if ($nSmall > 20) $rMax += 12;
            $smallIcon = is_file($icon_path) ? @imagecreatefrompng($icon_path) : false;
            if ($smallIcon !== false) {
                $siW = imagesx($smallIcon); $siH = imagesy($smallIcon);
                $spread=360/max(1,$nSmall); $baseAngle=mt_rand(0,359);
                for ($fi=0;$fi<$nSmall;$fi++){ $angle=($baseAngle+$fi*$spread+mt_rand(-14,14))*M_PI/180; $rad=mt_rand((int)($rMin*10),(int)($rMax*10))/10; $ss=(int)round($smallSize*mt_rand(85,115)/100); $x=(int)round($centerX+cos($angle)*$rad-$ss/2+mt_rand(-6,6)); $y=(int)round($centerY+sin($angle)*$rad-$ss/2+mt_rand(-6,6)); if($x<2)$x=2; if($x+$ss>$width-2)$x=$width-2-$ss; if($y<2)$y=2; if($y+$ss>$hariY+8)$y=$hariY-$ss-mt_rand(4,16); imagecopyresampled($image,$smallIcon,$x,$y,0,0,$ss,$ss,$siW,$siH); }
                imagedestroy($smallIcon);
            } else {
                $spread=360/max(1,$nSmall); $baseAngle=mt_rand(0,359);
                for ($fi=0;$fi<$nSmall;$fi++){ $angle=($baseAngle+$fi*$spread+mt_rand(-14,14))*M_PI/180; $rad=mt_rand((int)($rMin*10),(int)($rMax*10))/10; $ss=(int)round($smallSize*mt_rand(85,115)/100); $x=(int)round($centerX+cos($angle)*$rad-$ss/2+mt_rand(-6,6)); $y=(int)round($centerY+sin($angle)*$rad-$ss/2+mt_rand(-6,6)); if($x<2)$x=2; if($x+$ss>$width-2)$x=$width-2-$ss; if($y<2)$y=2; $tmpF=imagecreatetruecolor($ss,$ss); imagealphablending($tmpF,false); imagesavealpha($tmpF,true); imagefill($tmpF,0,0,imagecolorallocatealpha($tmpF,0,0,0,127)); imagealphablending($tmpF,true); $base=imagecreatetruecolor(70,70); imagealphablending($base,false); imagesavealpha($base,true); imagefill($base,0,0,imagecolorallocatealpha($base,0,0,0,127)); imagealphablending($base,true); $this->_streak_flame($base,0,0); imagecopyresampled($tmpF,$base,0,0,0,0,$ss,$ss,70,70); imagedestroy($base); imagecopy($image,$tmpF,$x,$y,0,0,$ss,$ss); imagedestroy($tmpF); }
            }
        }
        foreach($namaLines as $idx=>$ln){$twLn=$fw*strlen($ln);$dwLn=(int)round($twLn*$nameScale);$dxLn=(int)round(($width-$dwLn)/2);$dyLn=$nameY+$idx*($nameDh+$nameGap);$this->_streak_text($image,$ln,$nameScale,array($dxLn,$dyLn));}
        $this->_streak_text_orange($image,$numStr,$numScale,array($numX,$numY));
        $this->_streak_text($image,$lineHari,$scaleHari,array((int)round(($width-$fw*strlen($lineHari)*$scaleHari)/2),$hariY));
        $this->_streak_text($image,$lineTanpa,$scaleTanpa,array((int)round(($width-$fw*strlen($lineTanpa)*$scaleTanpa)/2),$tanpaY));
        header('Content-Type: image/png'); imagepng($image); imagedestroy($image);
    }

    // GD fallback helpers
    private function _streak_text($image, $text, $scale, $dest)
    {
        $fw = imagefontwidth(5); $fh = imagefontheight(5);
        $tw = $fw * strlen($text); $th = $fh;
        $tmp = imagecreatetruecolor($tw,$th);
        imagealphablending($tmp,false); imagesavealpha($tmp,true);
        imagefill($tmp,0,0,imagecolorallocatealpha($tmp,0,0,0,127));
        imagestring($tmp,5,0,0,$text,imagecolorallocate($tmp,255,255,255));
        $dw=(int)round($tw*$scale); $dh=(int)round($th*$scale);
        if($dest!==null){imagealphablending($image,true);imagecopyresampled($image,$tmp,(int)$dest[0],(int)$dest[1],0,0,$dw,$dh,$tw,$th);}
        imagedestroy($tmp); return array($dw,$dh);
    }
    private function _streak_text_orange($image, $text, $scale, $dest)
    {
        $fw = imagefontwidth(5); $fh = imagefontheight(5);
        $tw = $fw * strlen($text); $th = $fh;
        $tmp = imagecreatetruecolor($tw,$th);
        imagealphablending($tmp,false); imagesavealpha($tmp,true);
        imagefill($tmp,0,0,imagecolorallocatealpha($tmp,0,0,0,127));
        imagestring($tmp,5,0,0,$text,imagecolorallocate($tmp,243,112,33));
        $dw=(int)round($tw*$scale); $dh=(int)round($th*$scale);
        if($dest!==null){imagealphablending($image,true);imagecopyresampled($image,$tmp,(int)$dest[0],(int)$dest[1],0,0,$dw,$dh,$tw,$th);}
        imagedestroy($tmp); return array($dw,$dh);
    }
    private function _streak_wrap_name($text, $target, $fw)
    {
        $text = trim((string)$text); if($text==='') return array("NAMA PESERTA");
        $len=strlen($text); $singleScale=$target/($fw*max(1,$len));
        if($len<=18 && $singleScale>=1.6) return array($text);
        if(strpos($text,' ')===false){$ideal=2.4;$maxChars=max(8,(int)floor($target/($fw*$ideal)));return str_split($text,$maxChars);}
        $idealScale=2.4;$maxChars=max(10,(int)floor($target/($fw*$idealScale))); if($len>28)$maxChars=max(10,$maxChars-2);
        $words=explode(' ',$text); $lines=array(); $cur='';
        foreach($words as $w){$cand=$cur==='' ? $w : $cur.' '.$w; if(strlen($cand)<=$maxChars){$cur=$cand;}else{if($cur!=='')$lines[]=$cur; if(strlen($w)>$maxChars){$parts=str_split($w,$maxChars);$cur=array_shift($parts); if(!empty($parts)){$lines[]=$cur; while(count($parts)>1){$lines[]=array_shift($parts);} $cur=$parts[0]??'';}}else{$cur=$w;}}}
        if($cur!=='')$lines[]=$cur; return $lines;
    }
    // ---------- TTF modern helpers: nama BOLD ----------
    private function _streak_ttf_width($text, $size, $font, $fakeBold=false)
    {
        $bbox = imagettfbbox($size, 0, $font, $text);
        $w = $bbox[2] - $bbox[0];
        if ($fakeBold) $w += 2;
        return $w;
    }
    private function _streak_ttf_height($text, $size, $font, $fakeBold=false)
    {
        $bbox = imagettfbbox($size, 0, $font, $text);
        $h = $bbox[1] - $bbox[7];
        if ($fakeBold) $h += 2;
        return $h;
    }
    private function _streak_wrap_ttf($text, $target, $font, $size, $fakeBold=false)
    {
        $text = trim((string)$text); if($text==='') return array("NAMA PESERTA");
        $words = explode(' ', $text); $lines=array(); $cur='';
        foreach($words as $w){
            $cand = $cur==='' ? $w : $cur.' '.$w;
            if($this->_streak_ttf_width($cand,$size,$font,$fakeBold) <= $target){ $cur=$cand; }
            else {
                if($cur!=='') $lines[]=$cur;
                if($this->_streak_ttf_width($w,$size,$font,$fakeBold) > $target){
                    $part=''; for($i=0;$i<strlen($w);$i++){ $test=$part.$w[$i]; if($this->_streak_ttf_width($test,$size,$font,$fakeBold) <= $target) $part=$test; else { if($part!=='') $lines[]=$part; $part=$w[$i]; } }
                    $cur=$part;
                } else { $cur=$w; }
            }
        }
        if($cur!=='') $lines[]=$cur; return $lines;
    }
    private function _streak_find_size_for_width($text, $target, $font, $min, $max, $fakeBold=false)
    {
        $best=$min;
        for($sz=$max;$sz>=$min;$sz--){
            $w=$this->_streak_ttf_width($text,$sz,$font,$fakeBold);
            if($w <= $target){ return $sz; }
            $best=$sz;
        }
        // binary-like: cari terbesar yang masih <= target
        for($sz=$max;$sz>=$min;$sz--) if($this->_streak_ttf_width($text,$sz,$font,$fakeBold) <= $target) return $sz;
        return $min;
    }
    private function _streak_draw_ttf($image, $text, $size, $font, $color, $xTop, $yTop, $fakeBold=false)
    {
        $bbox = imagettfbbox($size, 0, $font, $text);
        $yBaseline = $yTop - $bbox[7];
        $x = $xTop;
        $y = $yBaseline;
        if ($fakeBold) {
            // fake bold: 4-direction overdraw untuk efek tebal
            imagettftext($image,$size,0,$x,$y,$color,$font,$text);
            imagettftext($image,$size,0,$x+1,$y,$color,$font,$text);
            imagettftext($image,$size,0,$x,$y+1,$color,$font,$text);
            imagettftext($image,$size,0,$x+1,$y+1,$color,$font,$text);
        } else {
            imagettftext($image,$size,0,$x,$y,$color,$font,$text);
        }
    }

    private function _streak_flame($image, $ox, $oy)
    {
        $cOut  = imagecolorallocate($image, 234, 88, 12);    // api terluar
        $cMid  = imagecolorallocate($image, 251, 146, 60);   // api tengah
        $cGlow = imagecolorallocate($image, 253, 224, 71);   // bagian terang dalam
        $cCore = imagecolorallocate($image, 254, 243, 199);  // inti api

        imagefilledpolygon($image, array(35+$ox,6+$oy, 14+$ox,42+$oy, 22+$ox,60+$oy, 48+$ox,60+$oy, 54+$ox,40+$oy), $cOut);
        imagefilledellipse($image, 35+$ox, 60+$oy, 46, 20, $cOut);
        imagefilledpolygon($image, array(35+$ox,20+$oy, 23+$ox,46+$oy, 29+$ox,58+$oy, 44+$ox,58+$oy, 48+$ox,42+$oy), $cMid);
        imagefilledellipse($image, 35+$ox, 58+$oy, 28, 16, $cMid);
        imagefilledellipse($image, 35+$ox, 47+$oy, 16, 22, $cGlow);
        imagefilledellipse($image, 35+$ox, 49+$oy, 9, 14, $cCore);
    }

    function build_streak()
    {
        $this->load->view('streak');
    }
}
