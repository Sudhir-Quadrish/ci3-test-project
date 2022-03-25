<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
class Verify extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->model('General_model','general_model');
	}
	
	public function index()
	{
	     echo $url1 = $this->uri->segment('2');
		 echo $token = $this->uri->segment('3'); die;
			$con = array('email_verify_token'=>$token);
			$row_data = $this->general_model->get_row_data('tbl_login',$con);
			
			
		 
		 die;
	}
	
	public function user()
	{
	  
		    $token = $this->uri->segment('3');
			$con   = array('email_verify_token'=>$token);
			$row_data = $this->general_model->get_select_data('tbl_login',array('id','email'),$con);
			if(!empty($row_data))
			{
				$update['is_verified']  = 1;
				$update['email_verify_token'] = NULL;
				$status = $this->general_model->update_row_data('tbl_login',
				array('id'=>$row_data['id']),$update);
				
				if($status){
					$this->session->set_flashdata('message','User Verified');
				redirect('Login');
				}else{
					$this->session->set_flashdata('message','<p style="color:red">User not verified</p>');	
				}
			}
			else{
				$this->session->set_flashdata('message','<p style="color:red">User not verified</p>');	
			}
			$this->load->view('verify_user');
	}
	
	
}
