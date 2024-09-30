<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'roles';    // Define your table name
    protected $primaryKey = 'id';  // Assuming 'id' is the primary key
    protected $allowedFields = ['role_name']; // The fields that are allowed for insertion
}
