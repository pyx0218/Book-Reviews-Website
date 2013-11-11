<?php
class Users extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('users_model');
  }

  public function login(){
  
	$this->load->helper('form');
	$this->load->library('form_validation');
	
	$data['title'] = 'Log In';
	$this->form_validation->set_rules('username', 'Username', 'required');
	$this->form_validation->set_rules('password', 'Password', 'required');
	
	if ($this->form_validation->run() === FALSE){
		$this->load->view('templates/header', $data);  
		$this->load->view('users/login');
		$this->load->view('templates/footer');
	}
	else{
		$this->users_model->check_valid();
		$this->load->view('users/success');
	}
  }
  
  

  public function view()
  {

  $this->load->view('templates/footer');
  }
}