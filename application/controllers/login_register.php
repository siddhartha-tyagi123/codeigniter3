<?php
class Login_register extends CI_Controller{
 function __construct()
  {
    parent::__construct();
    // Load Membership_model
    $this->load->model('Membership_model');
  }
 function index($msg = NULL)
 {
  $data['msg'] = $msg;
  $data['main_content'] = 'login_form';
  $this->load->view('includes/template', $data); 
   
   
 } 
 function validate_credentials()
 {  
  $this->load->model('membership_model');
  $query = $this->membership_model->validate();
   
  if($query) // if the user's credentials validated...
  {
   $data = array(
    'username' => $this->input->post('username'),
    'is_logged_in' => true
   );
   $this->session->set_userdata($data);
   redirect('Login_register/logged_in_area');
  }
  else // incorrect username or password
  {
   $msg = '<p class=error>Invalid username and/or password.</p>';
            $this->index($msg);
  }
 } 
  
 function signup()
 {
  $data['main_content'] = 'signup_form';
  $this->load->view('includes/template', $data);
 }
 function logged_in_area()
 {
  $data['main_content'] = 'logged_in_area';
  $this->load->view('includes/template', $data);
 }
  
 function create_member()
 {
  $this->load->library('form_validation');
   
  // field name, error message, validation rules
  $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
  $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
  $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
  $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
  $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
  $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
   
   
  if($this->form_validation->run() == FALSE)
  {
   $this->load->view('signup_form');
  }
   
  else
  {   
   $this->load->model('membership_model');
    
   if($query = $this->membership_model->create_member())
   {
    $data['main_content'] = 'signup_successful';
    $this->load->view('includes/template', $data);
   }
   else
   {
    $this->load->view('signup_form');   
   }
  }
   
 }
  
 function logout()
 {
  $this->session->sess_destroy();
  $this->index();
 }
 
}