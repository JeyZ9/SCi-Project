<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserRole extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false
            ],
            'role_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false
            ]
        ]);

        $this->forge->addKey(['user_id', 'role_id'], true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('user_role');
    }

    public function down()
    {
        $this->forge->dropTable('user_role');
    }
}