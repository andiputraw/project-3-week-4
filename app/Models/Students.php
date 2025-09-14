<?php

namespace App\Models;

use CodeIgniter\Model;

class Students extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'nim';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["nim", "nama_lengkap", "tanggal_lahir", "jenis_kelamin", "entry_year", "user_id"];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Ini tidak diperlukan karena menggunakan Model
    // public function getMahasiswas(String $name = "") {
    //     $q = $this->db->query("SELECT * FROM mahasiswa WHERE nama_lengkap LIKE '%$name%'");
        
    //     return $q->getResultArray();
    // }

    // public function getMahasiswa(String $nim) {
    //     $q = $this->db->query("SELECT * FROM mahasiswa WHERE nim = '$nim' LIMIT  1");
        
    //     return $q->getRowArray();
    // }

    // public function createMahasiswa($data) {
    //     $this->db->query("INSERT INTO mahasiswa (nim, nama_lengkap, tanggal_lahir, jenis_kelamin) VALUES ('$data[nim]', '$data[nama_lengkap]', '$data[tanggal_lahir]', '$data[jenis_kelamin]')");
    // }

    // public function updateMahasiswa($nim, $data) {
    //     $this->db->query("UPDATE mahasiswa SET nama_lengkap = '$data[nama_lengkap]', tanggal_lahir = '$data[tanggal_lahir]', jenis_kelamin = '$data[jenis_kelamin]' WHERE nim = '$nim'");
    // }

    // public function deleteMahasiswa($nim) {
    //     $this->db->query("DELETE FROM mahasiswa WHERE nim = '$nim'");
    // }
}
