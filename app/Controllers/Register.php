<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class Register extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        // Validation rules
        $rules = [
            'email' => [
                'rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please provide a valid email address.',
                    'is_unique' => 'This email is already registered.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[255]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must be at least 8 characters long.'
                ]
            ],
            'confirm_password' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Please confirm your password.',
                    'matches' => 'Passwords do not match.'
                ]
            ],
            'name' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Name is required.',
                    'min_length' => 'Name must be at least 3 characters long.'
                ]
            ],
            'role_id' => [
                'rules' => 'required|integer|exists[roles,id]', // Adjust based on your roles table
                'errors' => [
                    'required' => 'Role ID is required.',
                    'integer' => 'Role ID must be an integer.',
                    'exists' => 'The selected Role ID does not exist.'
                ]
            ]
        ];

        // Validate the request data
        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'name'     => $this->request->getVar('name'),
                'role_id'  => $this->request->getVar('role_id')
            ];

            // Log the registration data for debugging
            log_message('info', 'Registration data: ' . json_encode($data));

            // Save user data
            if ($model->save($data)) {
                return $this->respond(['message' => 'Registered Successfully'], 201);
            } else {
                // Log the errors if saving fails
                log_message('error', 'Registration failed: ' . json_encode($model->errors()));
                return $this->fail($model->errors(), 500);
            }
        } else {
            // Return validation errors
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response, 409);
        }
    }
}
