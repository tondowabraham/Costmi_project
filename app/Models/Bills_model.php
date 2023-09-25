<?php

namespace App\Models;

class Bills_model extends Crud_model {

    protected $table = "boq";
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'task_id', 'project_name', 'bill_type', 'task_library', 'task_name', 'description', 'quantity', 'unit', 'rate', 'amount'];

    function __construct() {
        $this->table = 'boq';
        parent::__construct($this->table);
    }

    public function getAllBills() {
        return $this->db->table($this->table)->get()->getResultArray();
    }

    // Get bills by user ID
    public function getBillsByUserId($userId) {
        return $this->db->table($this->table)->where('user_id', $userId)->get()->getResultArray();
    }

    public function isBillCreatedByUser($bill_id, $user_id) {
        return $this->db->table($this->table)
            ->where('id', $bill_id)
            ->where('user_id', $user_id)
            ->countAllResults() > 0;
    }

    public function get_client_bills() {
        $query = $this->db->query("SELECT DISTINCT task_name FROM {$this->table}");
        return $query->getResult();
    }

    public function getPredefinedValues($billId) {
        return $this->db->table('boq')
            ->where('id', $billId)
            ->get()
            ->getRowArray();
    }

}