<?php
class Reviews extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
	$this->load->model('books_model');
	$this->load->model('reviews_model');
  }
  
  public function new_review($isbn){
    $this->load->helper('form');
	$this->load->library('form_validation');
    $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[100]');
    $this->form_validation->set_rules('rating', 'Rating', 'required');
	$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[10]|max_length[2000]');
	
	if($this->session->userdata('logged_in')){
		$books_item = $this->books_model->get_book($isbn);
		$this->load->view('templates/navigation_view');
		$this->load->view('books/header', array('title'=>'Write a Review'));  
		$this->load->view('reviews/create', $books_item);
		$this->load->view('templates/footer');
	}
	else{
		redirect('users/login');
	}
  }
  
  public function create(){
	$this->load->helper('form');
	$this->load->library('form_validation');
    $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[100]');
    $this->form_validation->set_rules('rating', 'Rating', 'required');
	$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[10]|max_length[2000]');

	if($this->session->userdata('logged_in')){
		$isbn = $this->input->post('isbn');
		$books_item = $this->books_model->get_book(strip_quotes($isbn));
		if($this->form_validation->run()===FALSE){
			$this->load->view('templates/navigation_view');
			$this->load->view('books/header', array('title'=>'Write a Review'));  
			$this->load->view('reviews/create', $books_item);
			$this->load->view('templates/footer');
		}
		else{
			$rid = $this->reviews_model->add_review();
			redirect('reviews/view/'.$rid);
		}
	}
	else{
		redirect('users/login');
	}
	
  }
  
  public function view($rid)
  {
	  $review_item = $this->reviews_model->get_review($rid);
	
	  if (empty($review_item))
		show_404();

	  $data['title'] = $review_item['RTITLE'].' (Review: '.$review_item['BNAME'].')';
	  $data['user_name'] = $this->session->userdata('user_name');

	  $this->load->view('templates/navigation_view');
	  $this->load->view('books/header', $data);
	  $this->load->view('reviews/view', $review_item);
	  $this->load->view('templates/footer'); 
  }
  
  public function edit($rid){
    $this->load->helper('form');
	$this->load->library('form_validation');
    $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[100]');
    $this->form_validation->set_rules('rating', 'Rating', 'required');
	$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[10]|max_length[2000]');
	
	if($this->session->userdata('logged_in')){
		$data['title'] = 'Edit a Review';
		$data['books_item'] = $this->books_model->get_book($isbn);
		$data['user_name'] = $this->session->userdata('user_name');
		$this->load->view('templates/navigation_view');
		$this->load->view('books/header', $data);  
		$this->load->view('reviews/edit', $data);
		$this->load->view('templates/footer');
	}
	else{
		redirect('users/login');
	}
  }
  
}