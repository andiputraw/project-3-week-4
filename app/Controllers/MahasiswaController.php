<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Students;
use App\Models\User;
use PhpParser\Node\Expr\AssignOp\Mod;
use SebastianBergmann\CodeUnit\Mapper;

class MahasiswaController extends BaseController
{
         private $rules = [
            "nim" => [
                'rules' => "required|max_length[10]",
                'errors' => [
                    "required" => "NIM harus diisi",
                    "max_length" => "NIM maksimal 10 karakter",
                ],
            ],
            "nama_lengkap" => [
                'rules' => "required",
                'errors' => [
                    "required" => "Nama Lengkap harus diisi",
                ],
            ],
            "tanggal_lahir" => [
                'rules' => "required",
                'errors' => [
                    "required" => "Tanggal Lahir harus diisi",
                ],
            ],
            "jenis_kelamin" => [
                'rules' => "required",
                'errors' => [
                    "required" => "Jenis Kelamin harus diisi",
                ],
            ],
            "entry_year" => [
                'rules' => "required|min_length[4]|max_length[4]",
                'errors' => [
                    "required" => "Entry year harus diisi",
                ],
            ],
            "username" => [
                'rules' => "required",
                'errors' => [
                    "required" => "Username harus diisi",
                ],
            ],
            "password" => [
                'rules' => "required|min_length[8]|regex_match[^(?=.*\d)(?=.*[^a-zA-Z0-9]).*$]",
                'errors' => [
                    "required" => "Password harus diisi",
                    "min_length" => "Password panjang minimal 8",
                    "regex_match" => "Paling tidak 1 angka dan 1 symbol",
                ],
            ]
        ];

    public function index()
    {
        
        $keyword = $this->request->getGet("keyword");
        // $mahasiswa = model(Students::class)->like("nama_lengkap", $keyword ?? "")->findAll();
        $mahasiswa = model(Students::class)->like("nim", $keyword ?? "")->findAll();
        
        return view("mahasiswa/index", ["mahasiswa" => $mahasiswa]);
    }

    public function create() {
        // if($this->request->getOldInput('nim')) {
        //     $old = session('_ci_old_input');
        //     echo old("nim");
        //     dd($old);
        // }
        return view("mahasiswa/create");
    }

    private function populateUserData($data) {
        $data['role'] = User::ROLE_MAHASISWA;
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $data;
    }

    private function populateMahasiswaData($data, $userID) {
        $data['user_id'] = $userID;
        return $data;
    }

    public function store() {
        
   
        $data = $this->request->getPost();

        if(! $this->validateData($data, $this->rules)) {
            return redirect()->to("/mahasiswa/create")->withInput();
        }

        
        $userModel = model(User::class);
        // @cherry1013
        $data = $this->populateUserData($data);

        $userID = $userModel->insert($data);
        
        
        $mahasiswaModel = model(Students::class);
        $data = $this->populateMahasiswaData($data, $userID);
        $mahasiswaModel->insert($data);

        return redirect()->to("/mahasiswa");
    }

    public function edit($nim) {
        $mahasiswa = model(Students::class)->where("nim", $nim)->first();
        $user = model(User::class)->where('id', $mahasiswa['user_id'])->first();

        return view("mahasiswa/edit", ["mahasiswa" => $mahasiswa, 'user' => $user]);
    }

    public function update($nim) {
        $data = $this->request->getPost();

        if(! $this->validateData($data, $this->rules)) {
            return redirect()->to("/mahasiswa/edit/$nim")->withInput();
        }
        $mahasiswaModel = model(Students::class);
        $currentMahasiswa = $mahasiswaModel->where('nim', $nim )->first();
        

        $userModel = model(User::class);
        $data = $this->populateUserData($data);
        // dd($data);
        $userModel->update($currentMahasiswa['user_id'], $data);

        $mahasiswaModel->update($nim, $data);
        return redirect()->to("/mahasiswa");
    }

    public function delete($nim) {
        $mahasiswaModel = model(Students::class);
        $mahasiswaModel->deleteMahasiswa($nim);

        return redirect()->to("/mahasiswa");
    }

    public function show($nim) {
          $mahasiswa = model(Students::class)->getMahasiswa($nim);

        return view("mahasiswa/detail", ["mahasiswa" => $mahasiswa]);
    }
}
