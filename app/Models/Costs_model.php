<?php

namespace App\Models;

class Costs_model extends Crud_model {

    protected $table = "cost_library";
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'resource_type', 'notes', 'material_name', 'description', 'material_code', 'material_manufacturer', 'unit', 'size', 'cost', 'material_source', 'labour_name', 'trade', 'trade_category', 'labour_code', 'trade_status', 'labour_rate', 'equipment_name', 'equipment_category', 'equipment_manufacturer', 'equipment_code', 'equipment_model', 'power_rating', 'equipment_status', 'equipment_rate', 'effective_from', 'validity'];

    function __construct() {
        $this->table = 'cost_library';
        parent::__construct($this->table);
    }

    public function getAllCosts() {
        return $this->db->table($this->table)->get()->getResultArray();
    }

    // Get costs by user ID
    public function getCostsByUserId($userId) {
        return $this->db->table($this->table)->where('user_id', $userId)->get()->getResultArray();
    }

    // Get cost by ID
    public function getCostById($id) {
        return $this->db->table($this->table)->find($id);
    }

    public function getPreviousValues($costId) {
        return $this->db->table('cost_library')
            ->where('id', $costId)
            ->get()
            ->getRowArray();
    }

    public function get_resource_types() {
        $query = $this->db->query("SELECT DISTINCT resource_type FROM {$this->table}");
        return $query->getResult();
    }

}
