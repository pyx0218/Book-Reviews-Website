<?php
class Notes extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
	$this->load->model('books_model');
	$this->load->model('notes_model');
	
  }
  
  public function new_note($isbn){
	$this->load->helper('form');
	$this->load->library('form_validation');
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
	$this->form_validation->set_rules('visibility', 'Visibility', 'required');
	
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
  
  public function edit($nid){
  
    $this->load->helper('form');
	$this->load->library('form_validation');
	
	if($this->session->userdata('logged_in')){
		$data['title'] = 'Edit a note';
		$note_item = $this->notes_model->get_note($nid);
		$data['user_name'] = $this->session->userdata('user_name');
		
		$this->load->view('templates/navigation_view');
		$this->load->view('books/header', $data);  
		
		$this->load->view('notes/edit', $note_item);
		$this->load->view('templates/footer');
	}
	else{
		redirect('users/login');
	}
  }
  
    public function update(){
	$this->load->helper('form');
	$this->load->library('form_validation');
    $this->form_validation->set_rules('page', 'Page', 'trim|required|integer');
	$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[10]|max_length[2000]');
	$this->form_validation->set_rules('visibility', 'Visibility', 'required');
	if($this->session->userdata('logged_in')){
		$nid = $this->input->post('nid');
		echo $this->input->post('submit');
		if($this->input->post('submit')=='Save'){
			$note_item = $this->notes_model->get_note(strip_quotes($nid));
			if($this->form_validation->run()===FALSE){
				$this->load->view('templates/navigation_view');
				$this->load->view('books/header', array('title'=>'Edit a note'));  
				$this->load->view('notes/edit', $note_item);
				$this->load->view('templates/footer');
			}
			else{
				$this->notes_model->update_note();
				redirect('notes/view/'.$nid);
			}
		}
		elseif($this->input->post('cancel')=='Cancel') {
			redirect('notes/view/'.$nid);
		}
	}
	else{
		redirect('users/login');
	}
  }
  
  public function delete($nid){
	  if($this->session->userdata('logged_in')){
		$this->notes_model->delete_review($nid);
		redirect('users/view/'.$this->session->userdata('user_id'));
	  }
	  else{
		redirect('users/login');
	  }
  }
  
}