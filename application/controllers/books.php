<?php
class Books extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('books_model');
  }

  public function index()
  {
    $this->load->helper('form');
    $this->load->library('form_validation');
	
	if($this->session->userdata('logged_in')){
		$data['title'] = 'Home';
		$data['user_name'] = $this->session->userdata('user_name');
		$this->load->view('books/header', $data);  
		$this->load->view('books/index');
		$this->load->view('templates/footer');
	}
	else{
		$data['title'] = 'Log In';
		$this->load->view('templates/header', $data);  
		$this->load->view('users/login_view');
		$this->load->view('templates/footer');
	}
   
  }
  
  public function search()
  {
	$this->load->helper('form');
  
	$keyword = $this->input->post('keyword');
	$data['keyword'] = $keyword;
	if(!$keyword){
		$data['title'] = 'Search: All';
		$data['books'] = $this->books_model->search_books();
	}
	else{
		$data['title'] = 'Search:'.$keyword;
		$data['books'] = $this->books_model->search_books($keyword);
	}
	$this->load->view('books/header', $data);  
    $this->load->view('books/search', $data);
	$this->load->view('books/result', $data);
	$this->load->view('templates/footer');
    
  }

  public function view($isbn)
  {
   if($this->session->userdata('logged_in')){
	  $data['user_name'] = $this->session->userdata('user_name');
	  $data['books_item'] = $this->books_model->get_book_information($isbn);
	
	  if (empty($data['books_item']))
		show_404();

	  $data['title'] = $data['books_item']['BNAME'];

	  $this->load->view('books/header', $data);
	  $this->load->view('books/view', $data);
	  $this->load->view('templates/footer');
	}
	else{
		$data['title'] = 'Log In';
		$this->load->view('templates/header', $data);  
		$this->load->view('users/login_view');
		$this->load->view('templates/footer');
	}
    
  }
  
  
}