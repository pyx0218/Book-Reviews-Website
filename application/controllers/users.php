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
	
	$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
	$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[32]');
	
	if ($this->form_validation->run() === FALSE){		//form syntax error
		$this->load->view('templates/header', array('title'=>'Log In'));  
		$this->load->view('users/login_view');
		$this->load->view('templates/footer');
	}
	else{
		$result = $this->users_model->login();
		if($result){
			redirect('books/');
		}
		else{			//unsucceed 
			$data['content'] = 'Wrong combination of username and password. Please try again!';
			$this->load->view('templates/header', array('title'=>'Failed'));
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
		$this->load->view('templates/header', array('title'=>'Registration'));
		$this->load->view('users/registration_view');
		$this->load->view('templates/footer');
	}
	else{
		$this->users_model->add_user();
		$data['content'] = 'Congradulations! You have successfully finished registration!';
		$this->load->view('templates/header', array('title'=>'Succeed'));
		$this->load->view('templates/body', $data);
		$this->load->view('users/login_view');
		$this->load->view('templates/footer');
	}
 }
  
  
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	public function view($user_id =0){
		$data = $this->users_model->user_info($user_id);
		$user_data=$this->session->all_userdata();
		$this->load->view('templates/header', array('title'=>'Profile'));
		$this->load->view('templates/navigation_view',$user_data);
		$this->load->view('users/personal_page_view', $data);
		$this->load->view('templates/footer');
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	public function setting(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');
		
		$user_data=$this->session->all_userdata();
		if($this->form_validation->run() == FALSE){
			$data = $this->session->all_userdata();
			$this->load->view('templates/header', array('title'=>'Setting'));
			$this->load->view('templates/navigation_view',$user_data);
			$this->load->view('users/setting_view', $data);
			$this->load->view('templates/footer');
		}
		else{
			$this->users_model->setting();
			$data['content'] = 'Congradulations! You have successfully changed your password!';
			$this->load->view('templates/header', array('title'=>'Succeed'));
			$this->load->view('templates/navigation_view',$user_data);
			$this->load->view('templates/body', $data);
			$this->load->view('users/login_view');
			$this->load->view('templates/footer');
		}
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////
	public function add_friend($friend_id){
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in){
			$this->users_model->add_friend($friend_id);
			redirect('users/view/'.$friend_id);
		}
		else {
			redirect('users/login');
		}
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