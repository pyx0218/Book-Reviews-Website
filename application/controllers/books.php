<?php
class Books extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('books_model');
  }

  public function index()
  {
    $data['books'] = $this->books_model->get_books();
	$data['title'] = 'Search results';

  $this->load->view('templates/header', $data);
  $this->load->view('books/index', $data);
  $this->load->view('templates/footer');
  }

  public function view($bname)
  {
    $data['books_item'] = $this->books_model->get_books($bname);
  }
}