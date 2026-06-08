<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDirectorAndTimestampsToFilmsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('films', [
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
            ],
            'deleted_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('films', ['created_at', 'updated_at', 'deleted_at']);
    }
}
