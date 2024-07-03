<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('StudentModel');
    }

    public function index() {
        $data['students_detail'] = $this->StudentModel->get_students_ordered_by_id_desc();
        $this->load->view('students/list', $data);
    }

    public function store() {
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name'  => $this->input->post('last_name'),
            'address'    => $this->input->post('address'),
        ];
    
        // Insert data into database
        $save = $this->StudentModel->insert_data($data);
    
        // Check if data was successfully inserted
        if ($save) {
            // If successful, fetch the data by ID
            $data = $this->StudentModel->get_by_id($save);
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            // If failed, return status false
            echo json_encode(array("status" => false, 'data' => $data));
        }
    }
    

    public function edit($id = null) {
        $data = $this->StudentModel->get_by_id($id);
        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }
    

    public function update() {
        $id = $this->input->post('hdnStudentId');
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name'  => $this->input->post('last_name'),
            'address'    => $this->input->post('address'),
        ];
        $update = $this->StudentModel->update_data($id, $data);
        if ($update) {
            $data = $this->StudentModel->get_by_id($id);
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false, 'data' => $data));
        }
    }

    public function delete($id = null) {
        $delete = $this->StudentModel->delete_data($id);
        if ($delete) {
            echo json_encode(array("status" => true));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    

}

?>
