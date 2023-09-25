<?php

namespace App\Controllers;

class Detailed_Estimates extends Security_Controller {

    public function __construct() {
        parent::__construct();
        $this->Direct_costs_model = model("App\Models\Direct_costs_model");
        $this->Indirect_costs_model = model("App\Models\Indirect_costs_model");
        $this->Resources_model = model("App\Models\Resources_model");
        $this->Bills_model = model("App\Models\Bills_model");
    }

    public function index() {
        $userId = session()->get('user_id');
        $data['direct_cost'] = $this->Direct_costs_model->getAllDirectCosts();
        $data['direct_cost'] = $this->Direct_costs_model->getDirectCostsByUserId($userId);
        return view('detailed_estimates/index', $data);
    }

    public function direct_costs_form() {
        $id = $this->request->getPost('id');

        // Fetch predefined values based on the $id (cost entry ID)
        $predefinedValues = $this->Direct_costs_model->getPreviousValues($id);

        // Ensure that $predefinedValues is not empty before using it
        if (!empty($predefinedValues)) {
            $data = $predefinedValues;
        } else {
            // Provide default values if no predefined values are found
            $data = [
                'detailed_estimate_type' => '',
                'task_name' => '',
                'section' => '',
                'trade' => '',
                'resource_type' => '',
                'material_name' => '',
                'labour_name' => '',
                'equipment_name' => '',
                'resource_group' => '',
                'quantity' => '',
                'unit' => '',
                'additional_cost' => '',
                'purpose' => '',
                'price_index' => '',
                'remarks' => '',
            ];
        }

        $this->Resources_model = model("App\Models\Resources_model");
        $this->Bills_model = model("App\Models\Bills_model");

        $data['resource_types'] = $this->Resources_model->get_resource_types();
        $data['task_name'] = $this->Bills_model->get_client_bills();

        $data['materials'] = $this->Resources_model->get_materials();
        $data['labour_name'] = $this->Resources_model->get_labourers();
        $data['equipment_name'] = $this->Resources_model->get_equipment();


        $data['material_group'] = $this->Resources_model->get_material_group();
        $data['trade_category'] = $this->Resources_model->get_trade_category();
        $data['equipment_category'] = $this->Resources_model->get_equipment_category();

        return view('detailed_estimates/direct_costs_form', $data);
    }

    public function indirect_costs_form() {
        return view('detailed_estimates/indirect_costs_form');
    }

    function save_direct_cost() {

        $validationRules = [
            'detailed_estimate_type' => 'required',
            'task_name' => 'required',
            'purpose' => 'required',
            'resource_type' => 'required',
        ];
        
        if (!$this->validate($validationRules)) {
            return json_encode(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'user_id' => session()->get('user_id'), // Associate detailed estimates with the current user
            "detailed_estimate_type" => $this->request->getPost('detailed_estimate_type'),
            "task_name" => $this->request->getPost('task_name'),
            "section" => $this->request->getPost('section'),
            "trade" => $this->request->getPost('trade'),
            "resource_type" => $this->request->getPost('resource_type'),
            "material_name" => $this->request->getPost('material_name'),
            "labour_name" => $this->request->getPost('labour_name'),
            "equipment_name" => $this->request->getPost('equipment_name'),
            "resource_group" => $this->request->getPost('resource_group'),
            "quantity" => $this->request->getPost('quantity'),
            "unit" => $this->request->getPost('unit'),
            "additional_cost" => $this->request->getPost('additional_cost'),
            "purpose" => $this->request->getPost('purpose'),
            "price_index" => $this->request->getPost('price_index'),
            "remarks" => $this->request->getPost('remarks')
        ];

        $directCostsModel = new \App\Models\Direct_costs_model();

        if ($directCostsModel->insert($data)) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false]);
        }

    }
}