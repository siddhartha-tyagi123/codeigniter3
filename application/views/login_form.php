<?php $this->load->view('includes/header'); ?>
<div id="login_form">
 <h1>Login</h1>
 <?php if(! is_null($msg)) echo $msg;?>  
    <?php 
 echo form_open('Login_register/validate_credentials');
 echo form_input('username', 'Username');
 echo form_password('password', 'Password');
 echo form_submit('submit', 'Login');
 echo anchor('Login_register/signup', 'Create Account','style=padding-left:10px;');
 echo form_close();
 ?>
</div>
<?php $this->load->view('includes/tutorial_info'); ?>
<?php $this->load->view('includes/footer'); ?>