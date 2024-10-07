<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Activity extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => false
            ],
           'description' => [
               'type' => 'VARCHAR',
               'constraint' => '255',
               'null' => false,
               'unique' => false
           ],
            'count' => [
                'type' => 'BIGINT',
                'constraint' => '5',
                'null' => false
            ],
            'data_time' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'is_closed' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => false
            ],
            'major' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'user_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false
            ]
        ]);
        $this->forge->addKey(['id', 'user_id'], true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->createTable('activity');
    }

    public function down()
    {
        //
        $this->forge-dropTable('activity');
    }
}
