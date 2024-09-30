<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRolesToRolesTable extends Migration
{
    public function up()
    {
        $data = [
            ['role_name' => 'Teacher'],
            ['role_name' => 'Student'],
            ['role_name' => 'Manager'],
            ['role_name' => 'Admin'],
        ];

        // Insert roles into the roles table
        $this->db->table('roles')->insertBatch($data);
    }

    public function down()
    {
        // Remove these specific roles
        $this->db->table('roles')->whereIn('role_name', ['Teacher', 'Student', 'Manager', 'Admin'])->delete();
    }
}
