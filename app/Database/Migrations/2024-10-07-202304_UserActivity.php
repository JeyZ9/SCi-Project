<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserActivity extends Migration
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
            'user_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false
            ],
            'activity_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false
            ],
            'is_allowed' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => false
            ],
            'is_joined' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => false
            ]
        ]);
        $this->forge->addKey('id',true);

        $this->forge->addUniqueKey(['user_id', 'activity_id']);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('activity_id', 'activity', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('user_activity');
    }

    public function down()
    {
        //
        $this->forge->dropTable('user_activity');
    }
}
