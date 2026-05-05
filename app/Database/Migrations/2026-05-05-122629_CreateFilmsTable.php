<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFilmsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           =>['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'        =>['type' => 'VARCHAR', 'constraint' => 255],
            'year'         =>['type' => 'SMALLINT', 'constraint' => 4],
            'length'       =>['type' => 'SMALLINT', 'constraint' => 4],
            'poster_image' =>['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'description'  =>['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('films');
    }

    public function down()
    {
        $this->forge->dropTable('films');
    }
}
