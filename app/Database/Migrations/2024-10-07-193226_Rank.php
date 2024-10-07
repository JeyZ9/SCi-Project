<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rank extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => false,
                'auto_increment' => true,
                'unique' => true
            ],
            'rank_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true
            ],
            'coin_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id','id');
        $this->forge->createTable('ranks');
    }

    public function down()
    {
        //
        $this->forge->dropTable('ranks');
    }
}
