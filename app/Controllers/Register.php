<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserRoleModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\RoleModel;


class Register extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $rules = [
            'student_id' => ['rules' => 'required|min_length[9]|is_unique[users.student_id]'],
            'name' => ['rules' => 'required|min_length[3]|max_length[255]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password' => ['label' => 'confirm password', 'rules' => 'matches[password]'],
//            'role_id' => ['rules' => 'required|integer']
        ];



        if($this->validate($rules)){
            $model = new UserModel();
            $user_role = new UserRoleModel();

            $role_id = $this->request->getVar('role_id');
            // Check if the role exists in the database
            $roleModel = new RoleModel();
            $role = $roleModel->find($role_id);
//            echo 'this role' . $role;
            if (!$role) {
                return $this->fail(['message' => 'Invalid Role ID'], 400);
            }
            $data = [
                'student_id' => $this->request->getVar('student_id'),
                'name' => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
//                'role_id' => $role_id
            ];

            $model->save($data);
            $userId = $model->getInsertID();
            $role_id = 1;
//            $user_role_list = [
//                'user_id' => $userId,
//                'role_id' => $role_id
//            ];
            $user_role->assignRole($userId, $role_id);


            return $this->respond(['message' => 'Registered Successfully'], 200);
        }else{
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response , 409);

        }

    }
}