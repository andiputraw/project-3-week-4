<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Students;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController {

    private $rules = [
            "username" => [
                'rules' => "required",
                'errors' => [
                    "required" => "Username harus diisi",
                ],
            ],
            "password" => [
                'rules' => "required",
                'errors' => [
                    "required" => "Password harus diisi",
                ],
            ],
        ];

    public function index()
    {
        $atmin = session()->get("admin");
    
        if($atmin) {
            return redirect()->to("/");
        }

        return view("auth/login");
    }

    public function login() {
        
        if(!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }

        $adminModel = model(User::class);

        $email = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $user = $adminModel->where("username", $email)->first();
         

        if(!$user || !password_verify($password, $user["password"])) {
            return redirect()->back()->with("error", "username atau password salah")->withInput();
        }

        session()->set("role", $user['role']);
        if($user['role'] !== User::ROLE_ADMIN) {
            $mahasiswa = model(Students::class)->where("user_id", $user['id'])->first();
            session()->set("user", $user);
            session()->set("mahasiswa", $mahasiswa);
        }else {
            session()->set("admin", $user);
        }

        return redirect()->to("/");
    }

    public function logout() {
        session()->remove("mahasiswa");
        session()->remove("admin");
        session()->remove("user");
        session()->remove("role");
        
        return redirect()->to("/auth/login");
    }
}
