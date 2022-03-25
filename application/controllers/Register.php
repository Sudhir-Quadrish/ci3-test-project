<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
class Register extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->model('General_model','general_model');
	}
	
	public function index()
	{
		$this->load->view('auth/register_user');
	}
	
	
	public function save_data(){
		
		
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('firstName','First Name','required|trim');
		$this->form_validation->set_rules('lastName','Last Name','required|trim');
		$this->form_validation->set_rules('userEmail','User Email','required|trim');
		$this->form_validation->set_rules('userType','User Role','required|trim');
		$this->form_validation->set_rules('userPassword','Password','required|trim');
		if($this->form_validation->run()==TRUE)
		{
		
				$post_data['first_name']  = $this->input->post('firstName'); 
				$post_data['last_name']   = $this->input->post('lastName');
				$post_data['email']       = $this->input->post('userEmail');
			    $post_data['password']    = md5($this->input->post('userPassword'));
				$post_data['login_type']  = $this->input->post('userType');
				$post_data['status']      = 'Active';
				$post_data['created_at']      = date('Y-m-d H:i:s');
				$post_data['email_verify_token']  = $this->general_model->random_strings(25);
				
				$login_id = $this->general_model->insert_row('tbl_login',$post_data);
				if($login_id)
				{   
				    $template['name'] = $post_data['first_name'];
					$template['verify_link'] = base_url().'Verify/'.$post_data['email_verify_token'];
					
			        $mmesage = $this->load->view('verify_email',$template);
					//Implement the mail function to verify the User
					
					echo json_encode(array('status'=>'success', 'data'=>$login_id, 'message'=>"Register user successfully.")); die;
					
				}else{
					echo json_encode(array('status'=>'error', 'data'=>"", 'message'=>"Error in registration")); die;
				}
			
		}
		else{
			
			
			
			$message = validation_errors();
			echo json_encode(array('status'=>'error', 'data'=>"", 'message'=>$message)); die;
		}
		
	}
}
