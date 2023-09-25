<?php

namespace App\Models;

class Measurements_model extends Crud_model {

    protected $table = "measurement_library";
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'measurement_type', 'task_name', 'area_timesing', 'area_number_of', 'area_length', 'area_breadth', 'area_description', 'area_quantity', 'area_total', 'area_unit', 'volume_timesing', 'volume_number_of', 'volume_length', 'volume_breadth', 'volume_height', 'volume_description', 'volume_quantity', 'volume_total', 'volume_unit', 'bar_mark', 'bar_size', 'cut_length', 'number_used', 'weight_description', 'total_weight_length', 'weight_quantity', 'offcut_length', 'no_of_offcut'];

    function __construct() {
        $this->table = 'measurement_library';
        parent::__construct($this->table);
    }

    public function getAllMeasurement() {
        return $this->db->table($this->table)->get()->getResultArray();
    }
    
    public function get_measurement_types() {
        $query = $this->db->query("SELECT DISTINCT measurement_type FROM {$this->table}");
        return $query->getResult();
    }

    public function getExistingValues($measurementId) {
        return $this->db->table('measurement_library')
            ->where('id', $measurementId)
            ->get()
            ->getRowArray();

    }

    // Get measurement by user ID
    public function getMeasurementByUserId($userId) {
        return $this->db->table($this->table)->where('user_id', $userId)->get()->getResultArray();
    }

    // Get measurement by ID
    public function getmeasurementById($id) {
        return $this->db->table($this->table)->find($id);
    }

    // Insert a new measurement
    public function insertMeasurement($data) {
        return $this->db->table($this->table)->insert($data);
    }

    // Update a measurement by ID
    public function updateMeasurement($id, $data) {
        return $this->db->table($this->table)->update($id, $data);
    }

    // Delete a measurement by ID
    public function deletemeasurement($id) {
        return $this->db->table($this->table)->delete($id);
    }

}
