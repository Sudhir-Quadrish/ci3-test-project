<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->model('General_model','general_model');
		
	}
	
	public function index()
	{
		$this->load->view('auth/login_user');
	}
	
	
	public function login_user(){
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('userEmail','User Email','required|trim');
		$this->form_validation->set_rules('userPassword','Password','required|trim');
		if($this->form_validation->run()==TRUE)
		{
		
					$email       = $this->input->post('userEmail');
			        $password    = md5($this->input->post('userPassword'));
			
				
				$res  = $this->general_model->check_login($email,$password);
			
				if($res['status']=='success')
				{   
				     $this->session->set_userdata('logged_in',$res['data']);
					
					 if($res['data']['user_type']=='admin')
						 redirect(base_url('Admin/'));
					else
						redirect(base_url('User/'));
					
					
				}else{
					$this->session->set_flashdata('message','<p style="color:red">'.$res['message'].'</p>');
					redirect(base_url('Login/'));
				}
			
		}
		else{
			
			
			
			$message = validation_errors();
			echo json_encode(array('status'=>'error', 'data'=>"", 'message'=>$message)); die;
		}
		
	}
}
