<?php
class Notes extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
	$this->load->model('books_model');
	$this->load->model('notes_model');
  }
  
  public function new_note($isbn){
	
	if($this->session->userdata('logged_in')){
		$books_item = $this->books_model->get_book($isbn);
		$this->load->view('templates/navigation_view');
		$this->load->view('books/header', array('title'=>'Write a note'));  
		$this->load->view('notes/create', $books_item);
		$this->load->view('templates/footer');
	}
	else{
		redirect('users/login');
	}
  }
  
  public function create(){
	$this->load->helper('form');
	$this->load->library('form_validation');
    $this->form_validation->set_rules('page', 'Page', 'trim|required|integer');
	$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[10]|max_length[2000]');

	if($this->session->userdata('logged_in')){
		$isbn = $this->input->post('isbn');
		$books_item = $this->books_model->get_book(strip_quotes($isbn));
		if($this->form_validation->run()===FALSE){
			$this->load->view('templates/navigation_view');
			$this->load->view('books/header', array('title'=>'Write a note'));  
			$this->load->view('notes/create', $books_item);
			$this->load->view('templates/footer');
		}
		else{
			$nid = $this->notes_model->add_note();
			redirect('notes/view/'.$nid);
		}
	}
	else{
		redirect('users/login');
	}
	
  }
  
  public function view($nid)
  {
	
	$note_item = $this->notes_model->get_note($nid);

	if (empty($note_item))
	show_404();

	$data['title'] = 'Note';
	$data['user_name'] = $this->session->userdata('user_name');
	
	$this->load->view('templates/navigation_view');	
	$this->load->view('books/header', $data);
	$this->load->view('notes/view', $note_item);
	$this->load->view('templates/footer'); 
  }
  
  public function edit($rid){
    $this->load->helper('form');
	$this->load->library('form_validation');
    $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[100]');
    $this->form_validation->set_rules('rating', 'Rating', 'required');
	$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[10]|max_length[2000]');
	
	if($this->session->userdata('logged_in')){
		$data['title'] = 'Edit a note';
		$data['books_item'] = $this->books_model->get_book($isbn);
		$data['user_name'] = $this->session->userdata('user_name');
		$this->load->view('templates/navigation_view');
		$this->load->view('books/header', $data);  
		$this->load->view('notes/edit', $data);
		$this->load->view('templates/footer');
	}
	else{
		redirect('users/login');
	}
  }
  
}