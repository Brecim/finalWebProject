<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            =>['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'          =>['type' => 'VARCHAR', 'constraint' => 255],
            'password_hash' =>['type' => 'VARCHAR', 'constraint' => 255],
            'password_salt' =>['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'email'         =>['type' => 'VARCHAR', 'constraint' => 255],
            'sex'           =>['type' => 'TINYINT', 'constraint' => 1],
            'countries_id'  =>['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('countries_id', 'countries', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
