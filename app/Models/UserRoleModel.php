<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model
{
    protected $table = 'user_role';
    protected $primaryKey = null; // No single primary key, as we have a composite key
    protected $allowedFields = ['user_id', 'role_id'];

    // Assign a role to a user
    public function assignRole($userId, $roleId)
    {
        // Check if the user already has this role
        if ($this->userHasRole($userId, $roleId)) {
            return false; // Role already assigned
        }

        $data = [
            'user_id' => $userId,
            'role_id' => $roleId
        ];

        return $this->insert($data);
    }

    // Retrieve roles assigned to a specific user
    public function getRolesByUserId($userId)
    {
        return $this->select('role_id')
            ->where('user_id', $userId)
            ->findAll();
    }

    // Remove a specific role from a user
    public function removeRole($userId, $roleId)
    {
        return $this->where('user_id', $userId)
            ->where('role_id', $roleId)
            ->delete();
    }

    // Check if a user has a specific role
    public function userHasRole($userId, $roleId)
    {
        return $this->where('user_id', $userId)
                ->where('role_id', $roleId)
                ->countAllResults() > 0;
    }
}
