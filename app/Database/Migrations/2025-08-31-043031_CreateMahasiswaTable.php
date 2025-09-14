<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMahasiswaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "nim" => [
                "type" => "varchar",
                "constraint" => 9,
                "unique" => true,
            ],
            "nama_lengkap" => [
                "type" => "varchar",
                "constraint" => 100
            ],
            "tanggal_lahir" => [
                "type" => "date"
            ],
            "entry_year" => [
                "type" => "INT"
            ],
            "user_id" => [
                "type" => "INT"
            ]
        ]);
        $this->forge->addField("jenis_kelamin ENUM('L','P')");
        $this->forge->addKey("nim", true);
        $this->forge->addForeignKey("user_id", "users", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("students");
    }

    public function down()
    {
        $this->forge->dropTable("students");
    }
}
