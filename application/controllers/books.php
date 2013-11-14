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
	
	$data['user_loggedin'] = $this->session->userdata('logged_in');
	$data['popular_books'] = $this->books_model->get_popular_books();
	$data['may_like_books'] = $this->books_model->get_may_like_books();
	$data['friend_books'] = $this->books_model->get_friend_books();
	$this->load->view('templates/navigation_view');
	$this->load->view('books/header', array('title'=>'Home'));
	$this->load->view('books/index');
	$this->load->view('books/personalized_home',$data);
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
	  $data['admin'] = $this->session->userdata('admin');
	  $data['books_item'] = $this->books_model->get_book_information($isbn);
	
	  if (empty($data['books_item']))
		show_404();

	  $data['title'] = $data['books_item']['BNAME'];
	
	  $this->load->view('templates/navigation_view');
	  $this->load->view('books/header', $data);
	  $this->load->view('books/view', $data);
	  $this->load->view('templates/footer');
    
  }
  
  public function change_status(){
	$this->load->helper('form');
	if($this->session->userdata('logged_in')){
		$isbn=$this->input->post('isbn');
		if($this->input->post('wanttoread') != FALSE){
			$this->books_model->set_wanttoread();
			redirect('books/view/'.$isbn);
		}
		elseif($this->input->post('reading')!= FALSE){
			$this->books_model->set_reading();
			redirect('books/view/'.$isbn);
		}
		elseif($this->input->post('read')!= FALSE){
			$this->books_model->set_read();
			redirect('books/view/'.$isbn);
		}
		elseif($this->input->post('unwanttoread')!=FALSE){
			$this->books_model->reset_wanttoread();
			redirect('books/view/'.$isbn);
		}
		elseif($this->input->post('unreading')!= FALSE){
			$this->load->view('books/delete_reading',array('isbn'=>$isbn));
		}
		elseif($this->input->post('unread')!= FALSE){
			$this->load->view('books/delete_read',array('isbn'=>$isbn));
		}
	}
	else{
		redirect('users/login');
	}
  }
  
  public function delete_reading(){
	$this->load->helper('form');
	$isbn=$this->input->post('isbn');
	if($this->input->post('yes') != FALSE){
		$this->books_model->reset_reading();
	}
	redirect('books/view/'.$isbn);
  }
  
  public function delete_read(){
	$this->load->helper('form');
	$isbn=$this->input->post('isbn');
	if($this->input->post('yes') != FALSE){
		$this->books_model->reset_read();
	}
	redirect('books/view/'.$isbn);
  }
  
  
}