<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\User;

class Seed extends Seeder
{
    public function run()
    {
        $adminModel = model(User::class);

        $adminModel->insert([
            "username" => "admin",
            "password" => password_hash("admin", PASSWORD_BCRYPT),
            "full_name" => "Aku Admin kau mahasiswa",
            "role" => "ADMIN"
        ]);
    }
}
