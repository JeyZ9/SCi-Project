<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['role_name' => 'Teacher'],
            ['role_name' => 'Student'],
            ['role_name' => 'Manager'],
            ['role_name' => 'Admin'],
        ];

        // Insert the data into the roles table
        $this->db->table('roles')->insertBatch($data);
    }
}
