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
		$user_data = $this->session->all_userdata();
		$books_item = $this->books_model->get_book($isbn);
		$this->load->view('templates/header', array('title'=>'Take a note'));  
		$this->load->view('templates/navigation_view',$user_data);
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
		if($this->input->post('submit')=='Submit'){
			if($this->form_validation->run()===FALSE){
				$books_item = $this->books_model->get_book(strip_quotes($isbn));
				$this->load->view('templates/header', array('title'=>'Take a note')); 
				$this->load->view('templates/navigation_view');
				$this->load->view('notes/create', $books_item);
				$this->load->view('templates/footer');
			}
			else{
				$nid = $this->notes_model->add_note();
				redirect('notes/view/'.$nid);
			}
		}
		elseif($this->input->post('cancel')=='Return') {
			redirect('books/view/'.$isbn);
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
	$user_data = $this->session->all_userdata();
	$this->load->view('templates/header', $data);
	$this->load->view('templates/navigation_view',$user_data);	
	$this->load->view('notes/view', $note_item);
	$this->load->view('templates/footer'); 
  }
  
  public function edit($nid){
  
    $this->load->helper('form');
	$this->load->library('form_validation');
	
	if($this->session->userdata('logged_in')){
		$note_item = $this->notes_model->get_note($nid);
		$user_data = $this->session->all_userdata();
		$this->load->view('templates/header', array('title'=>'Edit a note'));
		$this->load->view('templates/navigation_view',$user_data);
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
				$user_data = $this->session->all_userdata();
				$this->load->view('templates/header', array('title'=>'Edit a note')); 
				$this->load->view('templates/navigation_view',$user_data); 
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