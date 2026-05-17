<?php
// require_once APPPATH . 'libraries/phpqrcode/qrlib.php';

class Alumni extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Alumni_model');
        $host_web2 = 'https://s1.cenditama.com';
    }

    public function index()
    {
        $data['alumni'] = $this->Alumni_model->get_all();
        $this->load->view('alumni/index', $data);
    }

    public function tambah()
    {
        if ($this->input->post()) {
            $input = $this->input->post('alumni');
            $batch = isset($input[0]) ? $input : [$input];

            $this->Alumni_model->add_batch($batch);

            foreach ($batch as $alumni) {
                $this->generate_qr($alumni);
            }

            redirect('alumni');
        }

        $this->load->view('alumni/tambah');
    }

    private function send_to_web2($alumni)
    {
        // URL endpoint API di Web 2
        $url = $host_web2.'/api/receive_alumni';

        // Data yang akan dikirim
        $data = [
            'nik' => $alumni['nik'],
            'nama' => $alumni['nama'],
            'tanggal_lahir' => $alumni['tanggal_lahir'],
            'judul_pelatihan' => $alumni['judul_pelatihan'],
            'tahap' => $alumni['tahap'],
            'tahun' => $alumni['tahun'],
            'foto' => $alumni['foto'] ?? null,
            'qr_code' => base_url("qr_test/{$alumni['tahun']}/TAHAP {$alumni['tahap']}/{$alumni['judul_pelatihan']}/{$alumni['nik']}.png")
        ];

        // Inisialisasi cURL
        $ch = curl_init($url);

        // Set opsi cURL
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-API-KEY: your-secret-key' // Tambahkan API key untuk autentikasi
        ]);

        // Eksekusi cURL
        $response = curl_exec($ch);

        // Cek error
        if (curl_errno($ch)) {
            log_message('error', 'cURL error: ' . curl_error($ch));
        } else {
            $result = json_decode($response, true);
            log_message('info', 'Response from Web 2: ' . $result['message']);
        }

        // Tutup cURL
        curl_close($ch);
    }

    public function detail($nik, $tahun)
    {
        $alumni = $this->Alumni_model->get_by_key($nik, $tahun);
        if (!$alumni) show_404();

        $data['alumni'] = $alumni;
        $this->load->view('alumni/detail', $data);
    }

    public function edit($nik = null, $tahun = null)
    {
        $data = $this->Alumni_model->get_all();
        $key = "$nik-$tahun";

        if (!isset($data[$key])) {
            show_404();
        }

        if ($this->input->post()) {
            $update = [
                'nik' => $nik,
                'nama' => $this->input->post('nama'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'judul_pelatihan' => $this->input->post('judul_pelatihan'),
                'tahap' => $this->input->post('tahap'),
                'tahun' => $this->input->post('tahun'),
                'foto' => $this->input->post('foto'),
            ];

            $this->Alumni_model->update($nik, $tahun, $update);
            $this->generate_qr($update); // QR diperbarui jika judul/tahun berubah
            redirect('alumni');
        }

        $data['alumni'] = $data[$key];
        $this->load->view('alumni/edit', $data);
    }

    public function hapus($nik, $tahun)
    {
        $this->Alumni_model->delete($nik, $tahun);
        $this->delete_on_web2($nik, $tahun); // Kirim permintaan hapus ke Web 2
        redirect('alumni');
    }

    private function delete_on_web2($nik, $tahun)
    {
        $url = $host_web2.'/api/delete_alumni';
        $data = [
            'nik' => $nik,
            'tahun' => $tahun
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-API-KEY: your-secret-key'
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            log_message('error', 'cURL error: ' . curl_error($ch));
        } else {
            $result = json_decode($response, true);
            log_message('info', 'Response from Web 2: ' . $result['message']);
        }

        curl_close($ch);
    }

    private function generate_qr($alumni)
    {
        $tahun = $alumni['tahun'];
        $tahap = $alumni['tahap'];
        $judul = $alumni['judul_pelatihan'];
        $nik = $alumni['nik'];
        $link = base_url("alumni/detail/{$nik}/{$tahun}");

        $folder = FCPATH . "qr_test/$tahun/TAHAP $tahap/$judul";
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $file_path = "$folder/{$nik}.png";
        QRcode::png($link, $file_path, 'L', 6, 2);
    }

    
}
