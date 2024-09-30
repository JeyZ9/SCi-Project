<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\RoleModel;

class User extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $users = new UserModel();
        return $this->respond(['users' => $users->findAll()], 200);
    }

    // Method to create default roles
    public function createDefaultRoles()
    {
        $roleModel = new RoleModel();

        $data = [
            ['role_name' => 'Teacher'],
            ['role_name' => 'Student'],
            ['role_name' => 'Manager'],
            ['role_name' => 'Admin'],
        ];

        // Insert roles if they don't already exist
        foreach ($data as $role) {
            $existingRole = $roleModel->where('role_name', $role['role_name'])->first();
            if (!$existingRole) {
                $roleModel->insert($role);
            }
        }

        return $this->respond(['message' => 'Roles created successfully'], 201);
    }
}
