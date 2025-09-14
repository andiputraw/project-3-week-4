<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCourseTable extends Migration
{
    public function up()
    {
         $this->forge->addField([
            "course_id" => [
                "type" => "int",
                "auto_increment" => true
            ],
            "course_name" => [
                "type" => "varchar",
                "constraint" => 255,
            ], 
            "credits" => [
                "type" => "INT",
            ]
        ]);
        
        $this->forge->addKey("course_id", true);
        $this->forge->createTable("courses");
    }

    public function down()
    {
             $this->forge->dropTable("courses");
    }
}
