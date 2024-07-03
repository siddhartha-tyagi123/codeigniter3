<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class StudentModel extends CI_Model {

   
    private $table = 'students';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_students_ordered_by_id_desc() {
        $this->db->order_by('id', 'ASC');
        return $this->db->get($this->table)->result_array();
    }

    // Add other methods as needed

    public function insert_data($data) {
        if ($this->db->insert($this->table, $data)) {
            return $this->db->insert_id(); // Use insert_id() to get the last inserted ID
        } else {
            return false;
        }
    }

    public function get_by_id($id) {
        $query = $this->db->get_where('students', array('id' => $id));
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null; // Return null if no data found
        }
    }

    public function update_data($id, $data) {
        $this->db->where('id', $id);
        if ($this->db->update($this->table, $data)) {
            return true; // Return true on successful update
        } else {
            return false; // Return false on failure
        }
    }

    public function delete_data($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    
    
    
    
}
?>
