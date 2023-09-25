<?php

namespace App\Controllers;

class Resources extends Security_Controller {

    public function __construct() {
        parent::__construct();
        $this->Resources_model = model("App\Models\Resources_model");
    }

    public function index() {
        $userId = session()->get('user_id');
        $data['resources'] = $this->Resources_model->getAllResources();
        $data['resources'] = $this->Resources_model->getResourcesByUserId($userId);
        return view('resources/index', $data);
    }

    public function modal_form() {
        $id = $this->request->getPost('id');

        // Fetch predefined values based on the $id (bill entry ID)
        $predefinedValues = $this->Resources_model->getExistingValues($id);

        // Ensure that $predefinedValues is not empty before using it
        if (!empty($predefinedValues)) {
            $data = $predefinedValues;
        } else {
            // Provide default values if no predefined values are found
            $data = [
                'resource_type' => '',
                'notes' => '',
            
                // Material Resource Type
                'material_name' => '',
                'material_name_code' => '',
                'material_group' => '',
                'material_group_code' => '',
                'description' => '',
                'description_code' => '',
                'material_manufacturer' => '',
                'unit' => '',
                'size' => '',
            
                // Labour Resource Type
                'labour_name' => '',
                'labour_code' => '',
                'trade' => '',
                'trade_code' => '',
                'trade_category' => '',
                'trade_category_code' => '',
                'trade_status' => '',
            
                // Equipment Resource Type
                'equipment_name' => '',
                'equipment_name_code' => '',
                'equipment_category' => '',
                'equipment_category_code' => '',
                'equipment_manufacturer' => '',
                'equipment_model' => '',
                'power_rating' => '',
                'equipment_status' => '',
            ];
        }

        return view('resources/modal_form', $data);
    }

    function save_resource() {

        $validationRules = [
            'resource_type' => 'required',
        ];
        
        if (!$this->validate($validationRules)) {
            return json_encode(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'user_id' => session()->get('user_id'), // Associate resource with the current user
            "resource_type" => $this->request->getPost('resource_type'),
            "notes" => $this->request->getPost('notes'),

            // Material Resource Type
            "material_name" => $this->request->getPost('material_name'),
            "material_name_code" => $this->request->getPost('material_name_code'),
            "material_group" => $this->request->getPost('material_group'),
            "material_group_code" => $this->request->getPost('material_group_code'),
            "description" => $this->request->getPost('description'),
            "description_code" => $this->request->getPost('description_code'),
            "material_manufacturer" => $this->request->getPost('material_manufacturer'),
            "unit" => $this->request->getPost('unit'),
            "size" => $this->request->getPost('size'),

            // Labour Resource Type
            "labour_name" => $this->request->getPost('labour_name'),
            "labour_code" => $this->request->getPost('labour_code'),
            "trade" => $this->request->getPost('trade'),
            "trade_code" => $this->request->getPost('trade_code'),
            "trade_category" => $this->request->getPost('trade_category'),
            "trade_category_code" => $this->request->getPost('trade_category_code'),
            "trade_status" => $this->request->getPost('trade_status'),

            // Equipment Resource Type
            "equipment_name" => $this->request->getPost('equipment_name'),
            "equipment_name_code" => $this->request->getPost('equipment_name_code'),
            "equipment_category" => $this->request->getPost('equipment_category'),
            "equipment_category_code" => $this->request->getPost('equipment_category_code'),
            "equipment_manufacturer" => $this->request->getPost('equipment_manufacturer'),
            "equipment_model" => $this->request->getPost('equipment_model'),
            "power_rating" => $this->request->getPost('power_rating'),
            "equipment_status" => $this->request->getPost('equipment_status')
        ];

        $resourceModel = new \App\Models\Resources_model();

        if ($resourceModel->insert($data)) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false]);
        }
    }
    
    public function delete_resource($id)
    {
        $resourceModel = new \App\Models\Resources_model();
        $resource = $resourceModel->find($id);
        
        if (!$resource) {
            return json_encode(['success' => false, 'message' => 'Resource not found.']);
        }
        
        if ($resource['user_id'] != session()->get('user_id')) {
            return json_encode(['success' => false, 'message' => 'You do not have permission to delete this resource.']);
        }
        
        $resourceModel->delete($id);
        
        return json_encode(['success' => true]);
    }
}