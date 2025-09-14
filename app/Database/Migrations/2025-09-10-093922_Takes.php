<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Takes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "course_id" => [
                "type" => "int",
            ],
            "nim" => [
                "type" => "varchar",
                "constraint" => 9,
            ], 
            "enroll_date" => [
                "type" => "DATE"
            ]
        ]);
        
        $this->forge->addKey(['course_id', 'nim'], true);
        
        $this->forge->createTable("takes");
    }


    public function down()
    {
        $this->forge->dropTable("takes");
    }
}
