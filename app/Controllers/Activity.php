<?php

namespace App\Controllers;


use App\Models\ActivityModel;

class Activity extends BaseController
{
    private ActivityModel $activityModel;
    public function __construct(){
        $this->activityModel = new ActivityModel;
    }

    public function index(){
        $data = $this->activityModel->findActivity();
        return $this->response->setJSON($data);
    }

    public function getActivityById($id){
        $data = $this->activityModel->findActivityById($id);
        return $this->response->setJSON($data);
    }

    public function addActivity() {
        // Log the raw POST data
        log_message('info', 'Raw POST Data: ' . json_encode($this->request->getPost()));

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'count' => $this->request->getPost('count'),
            'data_time' => (new \DateTime())->format('Y-m-d H:i:s'),
            'is_closed' => $this->request->getPost('is_closed'),
            'major' => $this->request->getPost('major'),
            'user_id' => $this->request->getPost('user_id')
        ];

//        $data = [
//            'name' => 'Test Activity',
//            'description' => 'This is a test activity.',
//            'count' => 1,
//            'is_closed' => false,
//            'major' => 'Test Major',
//            'user_id' => 1
//        ];

        // Log the processed data
        log_message('info', 'Activity Data: ' . json_encode($data));

//        if (!$this->validate([
//            'name' => 'required',
//            'description' => 'required',
//            'count' => 'required|numeric',
//            'user_id' => 'required|numeric'
//        ])) {
//            // Log the errors if validation fails
//            log_message('error', 'Validation errors: ' . json_encode($this->validator->getErrors()));
//            return $this->response->setJSON(['message' => 'Validation failed', 'errors' => $this->validator->getErrors()], 400);
//        }

        if ($this->activityModel->createActivity($data)) {
            return $this->response->setJSON(['message' => 'Activity added successfully'], 200);
        } else {
            return $this->response->setJSON(['message' => 'Failed to add activity'], 400);
        }
    }



}