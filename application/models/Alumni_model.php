<?php
class Alumni_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_dan_buat_file();
    }

    private $file = FCPATH . 'data/alumni.json';

    public function cek_dan_buat_file()
    {
        if (!file_exists($this->file)) {
            $folder = dirname($this->file);
            if (!is_dir($folder)) {
                mkdir($folder, 0755, true);
            }

            file_put_contents($this->file, json_encode([], JSON_PRETTY_PRINT));
        }
    }

    public function get_all()
    {
        if (!file_exists($this->file)) {
            return [];
        }
        $json = file_get_contents($this->file);
        return json_decode($json, true);
    }

    public function save_all($data)
    {
        return file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function add_batch($batch)
    {
        $data = $this->get_all();
        foreach ($batch as $alumni) {
            $key = $alumni['nik'] . '-' . $alumni['tahun'];
            $data[$key] = $alumni;
        }
        $this->save_all($data);
    }

    public function get_by_key($nik, $tahun)
    {
        $data = $this->get_all();
        $key = $nik . '-' . $tahun;
        return $data[$key] ?? null;
    }

    public function update($nik, $tahun, $new_data)
    {
        $data = $this->get_all();
        $key = $nik . '-' . $tahun;
        $data[$key] = $new_data;
        $this->save_all($data);
    }

    public function delete($nik, $tahun)
    {
        $data = $this->get_all();
        $key = $nik . '-' . $tahun;
        unset($data[$key]);
        $this->save_all($data);
    }
}
