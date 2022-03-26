<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
class Admin extends CI_Controller {
	private $adminId;
	function __construct(){
		parent::__construct();
		//print_r($this->session->userdata('logged_in')); die;
		if($this->session->userdata('logged_in')['user_type']!='admin')
		{
			redirect(base_url('Login/'));
		}
		$this->adminId = $this->session->userdata('logged_in')['id'];
		$this->load->model('Admin_model','admin_model');
	}
	
	public function index()
	{
		$this->load->view('admin_user');
	}
	
	public function users()
	{
		$data['users'] = $this->admin_model->get_users();
		
		$this->load->view('admin/page_user',$data);
	}
	
	public function products()
	{
		$data['products'] =$this->admin_model->get_products();
		$this->load->view('admin/page_products',$data);
	}
	
	
	
}
