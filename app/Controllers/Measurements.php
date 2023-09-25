<?php

namespace App\Controllers;

class Measurements extends Security_Controller {

    public function __construct() {
        parent::__construct();
        $this->Measurements_model = model("App\Models\Measurements_model");
        $this->Bills_model = model("App\Models\Bills_model");
    }

    public function index() {
        $userId = session()->get('user_id');
        $data['measurements'] = $this->Measurements_model->getAllMeasurement();
        $data['measurements'] = $this->Measurements_model->getMeasurementByUserId($userId);
        return view('measurements/index', $data);
    }

    public function modal_form() {
        $id = $this->request->getPost('id');

        // Fetch predefined values based on the $id (bill entry ID)
        $predefinedValues = $this->Measurements_model->getExistingValues($id);

        // Ensure that $predefinedValues is not empty before using it
                
        if (!empty($predefinedValues)) {
            $data = $predefinedValues;
        } else {
            // Provide default values if no predefined values are found
            $data = [
                'measurement_type' => '',
                'task_name' => '',
            
                // Area Measurement Type
                'area_timesing' => '',
                'area_number_of' => '',
                'area_length' => '',
                'area_breadth' => '',
                'area_description' => '',
                'area_quantity' => '',
                'area_total' => '',
                'area_unit' => '',
                            
                // Volume Measurement Type
                'volume_timesing' => '',
                'volume_number_of' => '',
                'volume_length' => '',
                'volume_breadth' => '',
                'volume_height' => '',
                'volume_description' => '',
                'volume_quantity' => '',
                'volume_total' => '',
                'volume_unit' => '',
            
                // Weight Measurement Type
                'bar_mark' => '',
                'bar_size' => '',
                'cut_length' => '',
                'number_used' => '',
                'weight_description' => '',
                'total_weight_length' => '',
                'weight_quantity' => '',
                'offcut_length' => '',
                'no_of_offcut' => '',
            ];
        }

        $this->Bills_model = model("App\Models\Bills_model");
        $data['task_name'] = $this->Bills_model->get_client_bills();

        return view('measurements/modal_form', $data);
    }

    

    function save_measurement() {

        $validationRules = [
            'measurement_type' => 'required',
            'task_name' => 'required',
        ];
        
        if (!$this->validate($validationRules)) {
            return json_encode(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'user_id' => session()->get('user_id'), // Associate measurement with the current user
            "measurement_type" => $this->request->getPost('measurement_type'),
            "task_name" => $this->request->getPost('task_name'),
             
            // Area Measurement Type
             "area__timesing" => $this->request->getPost('area_timesing'),
             "area_number_of" => $this->request->getPost('area_number_of'),
             "area_length" => $this->request->getPost('area_length'),
             "area_breadth" => $this->request->getPost('area_breadth'),
             "area_description" => $this->request->getPost('area_description'),
             "area_quantity" => $this->request->getPost('area_quantity'),
             "area_total" => $this->request->getPost('area_total'),
             "area_unit" => $this->request->getPost('area_unit'),
             
             // Volume Measurement Type
             "volume_timesing" => $this->request->getPost('volume_timesing'),
             "volume_number_of" => $this->request->getPost('volume_number_of'),
             "volume_length" => $this->request->getPost('volume_length'),
             "volume_breadth" => $this->request->getPost('volume_breadth'),
             "volume_height" => $this->request->getPost('volume_height'),
             "volume_description" => $this->request->getPost('volume_description'),
             "volume_quantity" => $this->request->getPost('volume_quantity'),
             "volume_total" => $this->request->getPost('volume_total'),
             "volume_unit" => $this->request->getPost('volume_unit'),

             // Weight Measurement Type
             "bar_mark" => $this->request->getPost('bar_mark'),
             "bar_size" => $this->request->getPost('bar_size'),
             "cut_length" => $this->request->getPost('cut_length'),
             "number_used" => $this->request->getPost('number_used'),
             "total_weight_length" => $this->request->getPost('total_weight_length'),
             "weight_description" => $this->request->getPost('weight_description'),
             "weight_quantity" => $this->request->getPost('weight_quantity'),
             "offcut_length" => $this->request->getPost('offcut_length'),
             "no_of_offcut" => $this->request->getPost('no_of_offcut'),
            
        ];
        
        $measurementModel = new \App\Models\Measurements_model();

        if ($measurementModel->insert($data)) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false]);
        }
    }


     public function delete_measurement($id)
    {
      $measurementModel = new \App\Models\Measurements_model();
        $measurement = $measurementModel->find($id);
        
        if (!$measurement) {
            return json_encode(['success' => false, 'message' => 'measurement not found.']);
        }
        
        if ($measurement['user_id'] != session()->get('user_id')) {
            return json_encode(['success' => false, 'message' => 'You do not have permission to delete this measurement.']);
        }
        
        $measurementModel->delete($id);
        
        return json_encode(['success' => true]);
    } 
}