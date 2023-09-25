<?php

namespace App\Controllers;

class costs extends Security_Controller {

    public function __construct() {
        parent::__construct();
        $this->Costs_model = model("App\Models\Costs_model");
        $this->Resources_model = model("App\Models\Resources_model");
    }

    function index() {
        // Load the view
        $userId = session()->get('user_id');
        $data['costs'] = $this->Costs_model->getAllCosts();
        $data['costs'] = $this->Costs_model->getCostsByUserId($userId);
        return view('costs/index', $data);
    }

    public function modal_form() {
        $id = $this->request->getPost('id');

        // Fetch predefined values based on the $id (cost entry ID)
        $predefinedValues = $this->Costs_model->getPreviousValues($id);

        // Ensure that $predefinedValues is not empty before using it
        if (!empty($predefinedValues)) {
            $data = $predefinedValues;
        } else {
            // Provide default values if no predefined values are found
            $data = [
                'resource_type' => '',
                'effective_from' => '',
                'validity' => '',
                'notes' => '',
            
                // Material cost Type
                'material_name' => '',
                'material_code' => '',
                'material_group' => '',
                'description' => '',
                'material_manufacturer' => '',
                'unit' => '',
                'size' => '',
                'cost' => '',
                'material_source' => '',
            
                // Labour cost Type
                'labour_name' => '',
                'labour_code' => '',
                'trade' => '',
                'trade_category' => '',
                'trade_status' => '',
                'labour_rate' => '',
            
                // Equipment cost Type
                'equipment_name' => '',
                'equipment_code' => '',
                'equipment_category' => '',
                'equipment_manufacturer' => '',
                'equipment_model' => '',
                'power_rating' => '',
                'equipment_status' => '',
                'equipment_rate' => '',
            ];
        }

        $this->Resources_model = model("App\Models\Resources_model");
        $data['resource_types'] = $this->Resources_model->get_resource_types();

        $data['materials'] = $this->Resources_model->get_materials();
        $data['material_name_code'] = $this->Resources_model->get_material_code();
        $data['description'] = $this->Resources_model->get_description();
        $data['description_code'] = $this->Resources_model->get_description_code();
        $data['material_group'] = $this->Resources_model->get_material_group();
        $data['material_group_code'] = $this->Resources_model->get_material_group_code();
        $data['material_manufacturer'] = $this->Resources_model->get_manufacturer();

        $data['labour_name'] = $this->Resources_model->get_labourers();
        $data['labour_code'] = $this->Resources_model->get_labour_code();
        $data['trade'] = $this->Resources_model->get_trade();
        $data['trade_code'] = $this->Resources_model->get_trade_code();
        $data['trade_category'] = $this->Resources_model->get_trade_category();
        $data['trade_category_code'] = $this->Resources_model->get_trade_category_code();
        $data['trade_status'] = $this->Resources_model->get_labour_status();

        $data['equipment_name'] = $this->Resources_model->get_equipment();
        $data['equipment_name_code'] = $this->Resources_model->get_equipment_code();
        $data['equipment_category'] = $this->Resources_model->get_equipment_category();
        $data['equipment_category_code'] = $this->Resources_model->get_equipment_category_code();
        $data['equipment_manufacturer'] = $this->Resources_model->get_equipment_manufacturer();
        $data['equipment_model'] = $this->Resources_model->get_equipment_model();
        $data['power_rating'] = $this->Resources_model->get_power_rating();
        $data['equipment_status'] = $this->Resources_model->get_equipment_status();

        return view('costs/modal_form', $data);
    }

    function save_cost() {

        $validationRules = [
            'resource_type' => 'required',
            'effective_from' => 'required',
            'validity' => 'required',
        ];
        
        if (!$this->validate($validationRules)) {
            return json_encode(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'user_id' => session()->get('user_id'), // Associate cost with the current user
            "resource_type" => $this->request->getPost('resource_type'),
            "effective_from" => $this->request->getPost('effective_from'),
            "validity" => $this->request->getPost('validity'),
            "notes" => $this->request->getPost('notes'),

            // Material cost Type
            "material_name" => $this->request->getPost('material_name'),
            "material_code" => $this->request->getPost('material_code'),
            "material_group" => $this->request->getPost('material_group'),
            "description" => $this->request->getPost('description'),
            "material_manufacturer" => $this->request->getPost('material_manufacturer'),
            "unit" => $this->request->getPost('unit'),
            "size" => $this->request->getPost('size'),
            "cost" => $this->request->getPost('cost'),
            "material_source" => $this->request->getPost('material_source'),

            // Labour cost Type
            "labour_name" => $this->request->getPost('labour_name'),
            "labour_code" => $this->request->getPost('labour_code'),
            "trade" => $this->request->getPost('trade'),
            "trade_category" => $this->request->getPost('trade_category'),
            "trade_status" => $this->request->getPost('trade_status'),
            "labour_rate" => $this->request->getPost('labour_rate'),

            // Equipment cost Type
            "equipment_name" => $this->request->getPost('equipment_name'),
            "equipment_code" => $this->request->getPost('equipment_code'),
            "equipment_category" => $this->request->getPost('equipment_category'),
            "equipment_manufacturer" => $this->request->getPost('equipment_manufacturer'),
            "equipment_model" => $this->request->getPost('equipment_model'),
            "power_rating" => $this->request->getPost('power_rating'),
            "equipment_status" => $this->request->getPost('equipment_status'),
            "equipment_rate" => $this->request->getPost('equipment_rate')
        ];

        $costModel = new \App\Models\Costs_model();
        if ($costModel->insert($data)) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false]);
        }
    }
    
    // public function delete_cost($id)
    // {
    //     $costModel = new \App\Models\Costs_model();
    //     $cost = $costModel->find($id);
        
    //     if (!$cost) {
    //         return json_encode(['success' => false, 'message' => 'Cost item not found.']);
    //     }
        
    //     if ($cost['user_id'] != session()->get('user_id')) {
    //         return json_encode(['success' => false, 'message' => 'You do not have permission to delete this cost item.']);
    //     }
        
    //     $costModel->delete($id);
        
    //     return json_encode(['success' => true]);
    // }
}