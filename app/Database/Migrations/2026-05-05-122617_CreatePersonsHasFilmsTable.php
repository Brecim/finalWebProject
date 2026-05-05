<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePersonsHasFilmsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'persons_id' =>['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'films_id'   =>['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'roles_id'   =>['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);
        // Dle diagramu je primární klíč složen z osoby a filmu
        $this->forge->addKey(['persons_id', 'films_id'], true);
        $this->forge->addForeignKey('persons_id', 'persons', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('films_id', 'films', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('roles_id', 'roles', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('persons_has_films');
    }

    public function down()
    {
        $this->forge->dropTable('persons_has_films');
    }
}
