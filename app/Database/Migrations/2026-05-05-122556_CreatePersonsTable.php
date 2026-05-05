<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePersonsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           =>['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'first_name'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'last_name'    => ['type' => 'VARCHAR', 'constraint' => 255],
            'age'          => ['type' => 'TINYINT', 'constraint' => 3, 'null' => true],
            'sex'          => ['type' => 'TINYINT', 'constraint' => 1],
            'birthday'     =>['type' => 'DATE', 'null' => true],
            'countries_id' =>['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('countries_id', 'countries', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('persons');
    }

    public function down()
    {
        $this->forge->dropTable('persons');
    }
}
