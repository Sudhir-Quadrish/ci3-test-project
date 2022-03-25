<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		//print_r($this->session->userdata('logged_in')); die;
		if($this->session->userdata('logged_in')['user_type']!='admin')
		{
			redirect(base_url('Login/'));
		}
		
		$this->load->model('General_model','general_model');
	}
	
	public function index()
	{
		$this->load->view('admin_user');
	}
	
	
	
}
