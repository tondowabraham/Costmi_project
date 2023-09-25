<?php

namespace App\Controllers;

class Production extends Security_Controller {

    protected $tasks;

    public function __construct() {
        parent::__construct();
        $this->Production_model = model("App\Models\Production_model");
        $this->Resources_model = model("App\Models\Resources_model");
        $this->Bills_model = model("App\Models\Bills_model");
    }

    function index() {
        // Load the view
        $userId = session()->get('user_id');
        $view_data['prodrates'] = $this->Production_model->getAllProdRates();
        $view_data['prodrates'] = $this->Production_model->getProdRatesByUserId($userId);
        return view('production/index', $view_data);
    }

    function modal_form() {
        $id = $this->request->getPost('id');

        // Fetch predefined values based on the $id (bill entry ID)
        $predefinedValues = $this->Production_model->getPredefinedValues($id);

        // Ensure that $predefinedValues is not empty before using it
        if (!empty($predefinedValues)) {
            $data = $predefinedValues;
        } else {
            // Provide default values if no predefined values are found
            $data = [
                'item' => '',
                'task_name' => '',
                'capacity' => '',
                'conditions' => '',
                'special_conditions' => '',
                'output' => '',
                'units_per_hr' => '',
            ];
        }

        $this->Resources_model = model("App\Models\Resources_model");
        $this->Bills_model = model("App\Models\Bills_model");

        $data['resource_types'] = $this->Resources_model->get_resource_types();
        $data['materials'] = $this->Resources_model->get_materials();
        $data['labour_name'] = $this->Resources_model->get_labourers();
        $data['equipment_name'] = $this->Resources_model->get_equipment();
        
        $data['task_name'] = $this->Bills_model->get_client_bills();
        return view('production/modal_form', $data);
    }

    public function edit_form() {
        $userId = session()->get('user_id');
        $data['prodrates'] = $this->Production_model->getProdRatesByUserId($userId);
        return view('production/edit_form', $data);
    }

    function save_prod_rate() {

        $validationRules = [
            'resource_type' => 'required',
        ];
        
        if (!$this->validate($validationRules)) {
            return json_encode(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'user_id' => session()->get('user_id'), // Associate cost with the current user
            "resource_type" => $this->request->getPost('resource_type'),
            "item" => $this->request->getPost('item'),
            "task_name" => $this->request->getPost('task_name'),
            "capacity" => $this->request->getPost('capacity'),
            "conditions" => $this->request->getPost('conditions'),
            "special_conditions" => $this->request->getPost('special_conditions'),
            "output" => $this->request->getPost('output'),
            "units_per_hr" => $this->request->getPost('units_per_hr')
        ];

        $productionModel = new \App\Models\Production_model();
        if ($productionModel->insert($data)) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false]);
        }
    }
}