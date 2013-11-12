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
	$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
	$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[32]');
	
	if ($this->form_validation->run() === FALSE){
		$this->load->view('templates/header', $data);  
		$this->load->view('users/login_view');
		$this->load->view('templates/footer');
	}
	else{
		$result = $this->users_model->login($this->input->post('username'), $this->input->post('password'));
		if($result){
			//$this->load->view('users/success_view');
			redirect('/books/');
		}
		else{
			$this->load->view('users/fail_view');
		}
	}
  }
  
  public function registration(){
	$this->load->library('form_validation');
	// field name, error message, validation rules
	$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
	$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

	if($this->form_validation->run() == FALSE){
		$this->load->view('users/registration_view');
	}
	else{
		$this->users_model->add_user();
	}
 }
  
  

	public function view($user_id =0){
		$data = $this->users_model->user_info($user_id);
		$this->load->view('users/personal_page_view', $data);
		
		$this->load->view('templates/footer');
	}
	
	public function setting(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');
		if($this->form_validation->run() == FALSE){
			$this->load->view('users/setting_view');
		}
		else{
			$this->users_model->setting();
			$this->load->view('users/change_password_succeed');
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}