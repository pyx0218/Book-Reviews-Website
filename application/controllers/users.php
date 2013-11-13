<?php
class Users extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('users_model');
  }
/////////////////////////////////////////////////////////////////////////////////////////////////////
  public function login(){
  
	$this->load->helper('form');
	$this->load->library('form_validation');
	
	$data['title'] = 'Log In';
	$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
	$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[32]');
	
	if ($this->form_validation->run() === FALSE){		//form syntax error
		$this->load->view('templates/header', $data);  
		$this->load->view('users/login_view');
		$this->load->view('templates/footer');
	}
	else{
		$result = $this->users_model->login($this->input->post('username'), $this->input->post('password'));
		if($result){
			//$this->load->view('users/success_view');
			redirect('books/');
		}
		else{			//unsucceed 
			$data['title'] = 'Fail!';
			$data['content'] = 'Wrong combination of username and password. Please try again!';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/body', $data);
			$this->load->view('users/login_view');
			$this->load->view('templates/footer');
		}
	}
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////
  public function registration(){
	$this->load->library('form_validation');
	// field name, error message, validation rules
	$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
	$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

	if($this->form_validation->run() == FALSE){
		$data['title'] = 'Registration!';
		$data['content'] = 'You can finish your registration here!';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/body', $data);
		$this->load->view('users/registration_view');
		$this->load->view('templates/footer');
	}
	else{
		$this->users_model->add_user();
		$data['title'] = 'Succeed!';
		$data['content'] = 'Congradulations! I have successfully finished registration!';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/body', $data);
		$this->load->view('users/login_view');
		$this->load->view('templates/footer');
	}
 }
  
  
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	public function view($user_id =0){
		$data = $this->users_model->user_info($user_id);
		$this->load->view('templates/navigation_view');
		$this->load->view('users/personal_page_view', $data);
		
		$this->load->view('templates/footer');
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////
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
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////
	public function add_friend($friend_id){
		$this->users_model->add_friend($friend_id);
		redirect('users/view/'.$friend_id);
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////
	public function unfriend($friend_id){
		$this->users_model->unfriend($friend_id);
		redirect('users/view/'.$this->session->userdata('user_id'));
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	public function logout(){
		$newdata = array(
		'user_id'   =>'',
		'user_name'  =>'',
		'logged_in' => FALSE,
		);
		$this->session->unset_userdata($newdata );
		$this->session->sess_destroy();
		$this->login();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}