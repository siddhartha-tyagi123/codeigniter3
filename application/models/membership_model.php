<?php
class Membership_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        // If needed, load database explicitly
        // $this->load->database();
    }

    public function validate() {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get('membership');
        
        if ($query->num_rows() == 1) {
            return true;
        }
        return false;
    }

    public function create_member() {
        $new_member_insert_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email_address' => $this->input->post('email_address'),   
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))      
        );
        
        $insert = $this->db->insert('membership', $new_member_insert_data);
        return $insert;
    }
}
