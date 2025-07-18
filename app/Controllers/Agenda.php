<?php
namespace App\Controllers;
use App\Models\AgendaModel;
use CodeIgniter\RESTful\ResourceController;

class Agenda extends ResourceController
{
    protected $modelName = AgendaModel::class;
    protected $format    = 'json';

public function index()
{
    $data = $this->model->orderBy('tanggal', 'ASC')->findAll();

    // Format tanggal ke DD-MMMM-YYYY
    $formatted = array_map(function ($row) {
        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $dateParts = explode('-', $row['tanggal']); // format: YYYY-MM-DD
        $yyyy = $dateParts[0];
        $mm = intval($dateParts[1]);
        $dd = ltrim($dateParts[2], '0'); // buang nol di depan

        $row['tanggal'] = "{$dd}-{$bulan[$mm]}-{$yyyy}";
        return $row;
    }, $data);

    return $this->respond($formatted);
}

    public function create()
{
    $data = $this->request->getPost();

    if ($this->model->insert($data)) {
        return $this->respondCreated(['message' => 'Agenda berhasil ditambahkan']);
    }

    // ✅ Tampilkan error validasi biar bisa dilihat di frontend
    return $this->failValidationErrors($this->model->errors());
}
public function update($id = null)
{
    $json = $this->request->getJSON(true); // ambil input JSON sebagai array

    if ($this->model->update($id, $json)) {
        return $this->respond(['message' => 'Agenda berhasil diupdate']);
    }

    return $this->failValidationErrors($this->model->errors());
}


public function delete($id = null)
{
    if ($this->model->delete($id)) {
        return $this->respondDeleted(['message' => 'Agenda berhasil dihapus']);
    }
    return $this->fail('Gagal menghapus agenda');
}

}
