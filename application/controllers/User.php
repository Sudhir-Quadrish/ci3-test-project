<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')['user_type']!='user')
		{
			redirect('Login');
		}
		
		$this->load->model('General_model','general_model');
	}
	
	public function index()
	{
		$this->load->view('user_page');
	}
	
	
	
}
