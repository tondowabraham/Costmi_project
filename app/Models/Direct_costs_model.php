<?php

namespace App\Models;

class Direct_costs_model extends Crud_model {

    protected $table = "direct_costs";
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'detailed_estimate_type', 'task_name', 'section', 'trade', 'resource_type', 'material_name', 'labour_name', 'equipment_name', 'resource_group', 'quantity', 'unit', 'additional_cost', 'purpose', 'price_index', 'remarks'];

    function __construct() {
        $this->table = 'direct_costs';
        parent::__construct($this->table);
    }

    public function getAllDirectCosts() {
        return $this->db->table($this->table)->get()->getResultArray();
    }

    // Get detailed estimates by user ID
    public function getDirectCostsByUserId($userId) {
        return $this->db->table($this->table)->where('user_id', $userId)->get()->getResultArray();
    }

    public function isDirectCostCreatedByUser($direct_cost_id, $user_id) {
        return $this->db->table($this->table)
            ->where('id', $direct_cost_id)
            ->where('user_id', $user_id)
            ->countAllResults() > 0;
    }

    public function get_client_direct_costs() {
        $query = $this->db->query("SELECT DISTINCT task_name FROM {$this->table}");
        return $query->getResult();
    }

    public function getPreviousValues($DirectCostId) {
        return $this->db->table('direct_costs')
            ->where('id', $DirectCostId)
            ->get()
            ->getRowArray();
    }

}