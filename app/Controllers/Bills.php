<?php

namespace App\Controllers;

class Bills extends Security_Controller {

    public function __construct() {
        parent::__construct();
        $this->Bills_model = model("App\Models\Bills_model");
        $this->Projects_model = model("App\Models\Projects_model");
    }

    public function index() {
        $userId = session()->get('user_id');
        $data['bills'] = $this->Bills_model->getAllBills();
        $data['bills'] = $this->Bills_model->getBillsByUserId($userId);
        return view('bills/index', $data);
    }

    public function modal_form() {
        $id = $this->request->getPost('id');

        // Fetch predefined values based on the $id (bill entry ID)
        $predefinedValues = $this->Bills_model->getPredefinedValues($id);

        // Ensure that $predefinedValues is not empty before using it
        if (!empty($predefinedValues)) {
            $data = $predefinedValues;
        } else {
            // Provide default values if no predefined values are found
            $data = [
                'task_id' => '',
                'bill_type' => '',
                'task_library' => '',
                'task_name' => '',
                'description' => '',
                'quantity' => '',
                'unit' => '',
                'rate' => '',
                'amount' => '',
            ];
        }

        $this->Projects_model = model("App\Models\Projects_model");
        $client_id = $this->login_user->client_id;
        $data['title'] = $this->Projects_model->get_client_projects($client_id);
        return view('bills/modal_form', $data);
    }

    function save_bill() {

        $validationRules = [
            'task_id' => 'required',
            'bill_type' => 'required',
            'task_name' => 'required',
        ];
        
        if (!$this->validate($validationRules)) {
            return json_encode(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'user_id' => session()->get('user_id'), // Associate bill with the current user
            "task_id" => $this->request->getPost('task_id'),
            "task_name" => $this->request->getPost('task_name'),
            "project_name" => $this->request->getPost('project_name'),
            "bill_type" => $this->request->getPost('bill_type'),
            "description" => $this->request->getPost('description'),
            "quantity" => $this->request->getPost('quantity'),
            "unit" => $this->request->getPost('unit'),
            "rate" => $this->request->getPost('rate'),
            "amount" => $this->request->getPost('amount')
        ];

        $billModel = new \App\Models\Bills_model();

        if ($billModel->insert($data)) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false]);
        }

    }

    public function edit_bill($id) {
        $billModel = new \App\Models\Bills_model();
        $Bill = $BillModel->find($id);
        
        if (!$Bill) {
            return redirect()->to('/Bills')->with('error', 'Bill not found.');
        }
        
        if ($Bill['user_id'] != session()->get('user_id')) {
            return redirect()->to('/Bills')->with('error', 'You do not have permission to edit this Bill.');
        }
        
        $data['bills'] = $Bill;
        
        return view('bills/edit_form', $data); // Pass $data to the view
    }


    public function delete_bill($bill_id) {
        $user_id = session()->get('user_id');
    
        // Check if the bill exists and belongs to the current user
        if ($this->Bills_model->isBillCreatedByUser($bill_id, $user_id)) {
            // Delete the bill
            if ($this->Bills_model->delete($bill_id)) {
                // Bill deleted successfully
                // Redirect or return a success message
                return json_encode(['success' => true, 'message' => 'Bill deleted successfully']);
            } else {
                // Unable to delete the bill
                // Return an error message
                return json_encode(['success' => false, 'message' => 'Unable to delete the bill']);
            }
        } else {
            // The bill does not exist or does not belong to the current user
            // Return an error message
            return json_encode(['success' => false, 'message' => 'You do not have permission to delete this bill']);
        }
    }
    

}