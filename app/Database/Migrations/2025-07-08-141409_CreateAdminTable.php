<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "int",
                "auto_increment" => true
            ],
            "username" => [
                "type" => "varchar",
                "constraint" => 255,
                "unique" => true,
            ],
            "password" => [
                "type" => "varchar",
                "constraint" => 255
            ],
            "full_name" => [
                "type" => "varchar",
                "constraint" => 255
            ],
            "role" => [
                "type" => "varchar",
                "constraint" => 50
            ]
        ]);
        
        $this->forge->addKey("id", true);
        $this->forge->createTable("users");
    }

    public function down()
    {
        $this->forge->dropTable("users");
    }
}
