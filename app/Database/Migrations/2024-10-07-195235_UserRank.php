<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserRank extends Migration
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
            'rank_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false
            ]
        ]);
        $this->forge->addKey('id', true);

        $this->forge->addUniqueKey(['user_id', 'activity_id', 'rank_id']);
        $this->forge->addForeignKey('user_id', 'users', 'id','CASCADE', 'CASCADE');
        $this->forge->addForeignKey('activity_id', 'activity', 'id','CASCADE', 'CASCADE');
        $this->forge->addForeignKey('rank_id', 'ranks', 'id','CASCADE', 'CASCADE');

        $this->forge->createTable('user_rank');
    }

    public function down()
    {
        //
        $this->forge->dropTable('user_rank');
    }
}
