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
	
		$data['title'] = 'Home';
		$data['user_name'] = $this->session->userdata('user_name');
		$this->load->view('templates/navigation_view');
		$this->load->view('books/header', $data);
		$this->load->view('books/index');
		$this->load->view('templates/footer');
   
  }
  
  public function search()
  {
	$this->load->helper('form');
    
	$data['user_name'] = $this->session->userdata('user_name');
	
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
	$this->load->view('templates/navigation_view');	
	$this->load->view('books/header', $data);
    $this->load->view('books/search', $data);
	$this->load->view('books/result', $data);
	$this->load->view('templates/footer');
    
  }

  public function view($isbn)
  {
	  $this->load->helper('form');
	  $data['user_name'] = $this->session->userdata('user_name');
	  $data['books_item'] = $this->books_model->get_book_information($isbn);
	
	  if (empty($data['books_item']))
		show_404();

	  $data['title'] = $data['books_item']['BNAME'];
	
	  $this->load->view('templates/navigation_view');
	  $this->load->view('books/header', $data);
	  $this->load->view('books/view', $data);
	  $this->load->view('templates/footer');
    
  }
  
  public function add_reader(){
	$this->load->helper('form');
	if($this->session->userdata('logged_in')){
		$isbn=$this->input->post('isbn');
		echo $this->input->post('wanttoread');
		echo $this->input->post('reading');
		echo $this->input->post('read');
		if($this->input->post('wanttoread') != FALSE){
			$this->books_model->set_wanttoread();
		}
		elseif($this->input->post('reading')!= FALSE){
			$this->books_model->set_reading();
		}
		elseif($this->input->post('read')!= FALSE){
			$this->books_model->set_read();
		}
		redirect('books/view/'.$isbn);
	}
	else{
		redirect('users/login');
	}
  }
  
  
}