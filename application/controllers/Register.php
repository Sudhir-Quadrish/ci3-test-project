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
		$this->form_validation->set_rules('userEmail','User Email','required|trim|is_unique[tbl_login.email]');
		//$this->form_validation->set_rules('userType','User Role','required|trim');
		$this->form_validation->set_rules('userPassword','Password','required|trim');
		if($this->form_validation->run()==TRUE)
		{
		
				$post_data['first_name']  = $this->input->post('firstName'); 
				$post_data['last_name']   = $this->input->post('lastName');
				$post_data['email']       = $this->input->post('userEmail');
			    $post_data['password']    = md5($this->input->post('userPassword'));
				$post_data['login_type']  = 'user';
				$post_data['status']      = 'Active';
				$post_data['created_at']      = date('Y-m-d H:i:s');
				$post_data['email_verify_token']  = $this->general_model->random_strings(25);
				$login_id = $this->general_model->insert_row('tbl_login',$post_data);
				if($login_id)
				{   
				    $template['name'] = $post_data['first_name'];
					$template['verify_link'] = base_url().'Verify/'.$post_data['email_verify_token'];
					$fromEmail = 'developer.quadrish@gmail.com';
					$toEmail  = $post_data['email'];
					$subject  = "Verification Email";
					
					 $mesage='<div id="container">
						<h1>Welcome to Ci Project!</h1>

						<div id="body">
							<p>Hi, '.$template['name'].'</p>

							<p>Please click on the following link to verify your account.</p>
							
							<p><a href="'.$template['verify_link'].'" >Click Here</a></p>
							
							<p>Contact for support</p>
							<p><a href="test.support@test.com">test.support@test.com</a></p>
							<p>Thanks</p>
							</div>
						</div>';
			     
								$this->load->library('email');
							    $this->email->clear();
								$config['protocol'] = 'smtp';
								$config['smtp_host'] = 'smtp.gmail.com';
								$config['smtp_port'] = '465';
								$config['smtp_user'] = 'developer.quadrish@gmail.com';
								$config['smtp_pass'] = 'quadrish123456';
								$config['charset'] = 'utf-8';
								
								$this->email->initialize($config);
								$this->email->set_mailtype('html');
								$this->email->set_newline($config);
								$this->email->from($fromEmail);	
								$this->email->to($toEmail);
								$this->email->subject($subject);
								$this->email->message($mmesage);
							
								if($this->email->send())
								{
								    $status = 1; 
									$mail_msg = '\n'."Verification link has sent at your mail.";
								}
								else
								{
									
								   $status = 0; 
								   	$mail_msg = '\n'."Email not sent Please contact to our support.";
								}
					//Implement the mail function to verify the User
					
					echo json_encode(array('status'=>'success', 'data'=>$login_id, 'message'=>"Register user successfully.".$mail_msg)); die;
					
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
