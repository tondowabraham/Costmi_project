<?php

namespace App\Models;

class Production_model extends Crud_model {

    protected $table = "production_rates";
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'item', 'task_name', 'capacity', 'conditions', 'special_conditions', 'output', 'units_per_hr'];

    function __construct() {
        $this->table = 'production_rates';
        parent::__construct($this->table);
    }

    public function getAllProdRates() {
        return $this->db->table($this->table)->get()->getResultArray();
    }

    public function getProdRatesByUserId($userId) {
        return $this->db->table($this->table)->get()->getResultArray();
    }

    public function getPredefinedValues($prodRateId) {
        return $this->db->table('production_rates')
            ->where('id', $prodRateId)
            ->get()
            ->getRowArray();
    }

    // Get prodrate by ID
    public function getProdRateById($id) {
        return $this->db->table($this->table)->find($id);
    }

    // Insert a new prodrate
    public function insertProdRate($data) {
        return $this->db->table($this->table)->insert($data);
    }

    // Update a prodrate by ID
    public function updateProdRate($id, $data) {
        return $this->db->table($this->table)->update($id, $data);
    }

    // Delete a prodrate by ID
    public function deleteProdRate($id) {
        return $this->db->table($this->table)->delete($id);
    }
}