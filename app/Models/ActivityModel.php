<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table            = 'activity';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'description', 'count', 'date_time', 'is_closed', 'major', 'user_id'];

    // Validation
    protected $validationRules      = [
        'name' => 'required|is_unique[activity.name]',
        'description' => 'required|is_unique[activity.description]',
        'count' => 'required|is_unique[activity.count]',
        'date_time' => 'required|is_unique[activity.data_time]',
        'is_closed' => 'required|is_unique[activity.is_closed]',
        'major' => 'required|is_unique[activity.major]',
        'user_id' => 'required|is_unique[activity.user_id]'
    ];

    public function findActivity(){
        return $this->select()->findAll();
    }

    public function findActivityById($id){
        $data = $this->select()->where('id', $id)->findAll();
        return $data;
    }

    public function createActivity($data) {
        if (empty($data['name']) || empty($data['data_time'])) {
            return [
                'status' => 'error',
                'message' => 'Name and data_time are required fields.'
            ];
        }

        if ($this->insert($data)) {
            return [
                'status' => 'success',
                'message' => 'Activity added successfully',
                'activity_id' => $this->insertID()
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to add activity. Please try again.'
            ];
        }
    }

}
