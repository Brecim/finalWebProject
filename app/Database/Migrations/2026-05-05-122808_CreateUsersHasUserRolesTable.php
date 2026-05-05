<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersHasUserRolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'users_id'      =>['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'user_roles_id' =>['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);
        // Složený primární klíč z obou cizích klíčů
        $this->forge->addKey(['users_id', 'user_roles_id'], true);
        $this->forge->addForeignKey('users_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_roles_id', 'user_roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('users_has_user_roles');
    }

    public function down()
    {
        $this->forge->dropTable('users_has_user_roles');
    }
}
