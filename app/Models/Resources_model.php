<?php

namespace App\Models;

class Resources_model extends Crud_model {

    protected $table = "resource_library";
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'resource_type', 'notes', 'material_name', 'material_name_code', 'material_group', 'material_group_code', 'description', 'description_code', 'material_manufacturer', 'unit', 'size', 'labour_name', 'labour_code', 'trade', 'trade_code', 'trade_category', 'trade_category_code', 'trade_status', 'equipment_name', 'equipment_name_code', 'equipment_category', 'equipment_category_code', 'equipment_manufacturer', 'equipment_model', 'power_rating', 'equipment_status'];

    function __construct() {
        $this->table = 'resource_library';
        parent::__construct($this->table);
    }

    public function getAllResources() {
        return $this->db->table($this->table)->get()->getResultArray();
    }

    public function getExistingValues($resourceId) {
        return $this->db->table('resource_library')
            ->where('id', $resourceId)
            ->get()
            ->getRowArray();
    }
    
    public function get_resource_types() {
        $query = $this->db->query("SELECT DISTINCT resource_type FROM {$this->table}");
        return $query->getResult();
    }

    public function get_materials() {
        $query = $this->db->query("SELECT DISTINCT material_name FROM {$this->table}");
        return $query->getResult();
    }

    public function getMaterialsByUserId($userId) {
        $query = $this->db->table($this->table)
            ->selectDistinct('material_name')
            ->where('user_id', $userId)
            ->get();
    
        return $query->getResult();
    }

    public function get_material_code() {
        $query = $this->db->query("SELECT DISTINCT material_name_code FROM {$this->table}");
        return $query->getResult();
    }

    public function get_description() {
        $query = $this->db->query("SELECT DISTINCT description FROM {$this->table}");
        return $query->getResult();
    }

    public function get_description_code() {
        $query = $this->db->query("SELECT DISTINCT description_code FROM {$this->table}");
        return $query->getResult();
    }

    public function get_material_group() {
        $query = $this->db->query("SELECT DISTINCT material_group FROM {$this->table}");
        return $query->getResult();
    }

    public function get_material_group_code() {
        $query = $this->db->query("SELECT DISTINCT material_group_code FROM {$this->table}");
        return $query->getResult();
    }

    public function get_manufacturer() {
        $query = $this->db->query("SELECT DISTINCT material_manufacturer FROM {$this->table}");
        return $query->getResult();
    }

    public function get_labourers() {
        $query = $this->db->query("SELECT DISTINCT labour_name FROM {$this->table}");
        return $query->getResult();
    }

    public function get_labour_code() {
        $query = $this->db->query("SELECT DISTINCT labour_code FROM {$this->table}");
        return $query->getResult();
    }

    public function get_trade() {
        $query = $this->db->query("SELECT DISTINCT trade FROM {$this->table}");
        return $query->getResult();
    }

    public function get_trade_code() {
        $query = $this->db->query("SELECT DISTINCT trade_code FROM {$this->table}");
        return $query->getResult();
    }

    public function get_trade_category() {
        $query = $this->db->query("SELECT DISTINCT trade_category FROM {$this->table}");
        return $query->getResult();
    }

    public function get_trade_category_code() {
        $query = $this->db->query("SELECT DISTINCT trade_category_code FROM {$this->table}");
        return $query->getResult();
    }

    public function get_labour_status() {
        $query = $this->db->query("SELECT DISTINCT trade_status FROM {$this->table}");
        return $query->getResult();
    }

    public function get_equipment() {
        $query = $this->db->query("SELECT DISTINCT equipment_name FROM {$this->table}");
        return $query->getResult();
    }

    public function get_equipment_code() {
        $query = $this->db->query("SELECT DISTINCT equipment_name_code FROM {$this->table}");
        return $query->getResult();
    }

    public function get_equipment_category() {
        $query = $this->db->query("SELECT DISTINCT equipment_category FROM {$this->table}");
        return $query->getResult();
    }

    public function get_equipment_category_code() {
        $query = $this->db->query("SELECT DISTINCT equipment_category_code FROM {$this->table}");
        return $query->getResult();
    }

    public function get_equipment_manufacturer() {
        $query = $this->db->query("SELECT DISTINCT equipment_manufacturer FROM {$this->table}");
        return $query->getResult();
    }

    public function get_equipment_model() {
        $query = $this->db->query("SELECT DISTINCT equipment_model FROM {$this->table}");
        return $query->getResult();
    }

    public function get_power_rating() {
        $query = $this->db->query("SELECT DISTINCT power_rating FROM {$this->table}");
        return $query->getResult();
    }

    public function get_equipment_status() {
        $query = $this->db->query("SELECT DISTINCT equipment_status FROM {$this->table}");
        return $query->getResult();
    }

    // Get resources by user ID
    public function getResourcesByUserId($userId) {
        return $this->db->table($this->table)->where('user_id', $userId)->get()->getResultArray();
    }

    // Get resource by ID
    public function getResourceById($id) {
        return $this->db->table($this->table)->find($id);
    }

    // Insert a new resource
    public function insertResource($data) {
        return $this->db->table($this->table)->insert($data);
    }

    // Update a resource by ID
    public function updateResource($id, $data) {
        return $this->db->table($this->table)->update($id, $data);
    }

    // Delete a resource by ID
    public function deleteResource($id) {
        return $this->db->table($this->table)->delete($id);
    }

}
