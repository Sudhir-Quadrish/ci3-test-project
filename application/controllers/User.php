<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
class User extends CI_Controller {
private $userId;
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')['user_type']!='user')
		{
			redirect(base_url('Login'));
		}
		$this->userId=$this->session->userdata('logged_in')['id'];
		$this->load->model('User_model','user_model');
	}
	
	public function index()
	{
		$this->load->view('user_page');
	}
	
	public function assign_products()
	{
		$data['products'] = $this->user_model->get_products();
		$data['assign_products'] = $this->user_model->get_assign_products($this->userId);
		$this->load->view('user/page_assign_product',$data);
	}
	
	
	public function save_product_data()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('productName','Product Name','required|trim');
		$this->form_validation->set_rules('productNumber','Last Name','required|trim');
		$this->form_validation->set_rules('productPrice','Product Price','required|trim');
		if($this->form_validation->run()==TRUE)
		{
				$post_data['user_id']  = $this->userId;
				$post_data['product_id']  = $this->input->post('productName'); 
				$post_data['product_count']   = $this->input->post('productNumber');
				$post_data['product_price']       = $this->input->post('productPrice');
				
				$prod_id = $this->user_model->insert_row('tbl_user_products',$post_data);
				if($prod_id >0){
					$this->session->set_flashdata('message','<p style="color:green">Product assigned successfully</p>');
					echo json_encode(array('status'=>'success', 'data'=>$prod_id, 'message'=>"Product assigned successfully.")); die;
					
				}else{
						$this->session->set_flashdata('message','<p style="color:red">Error in assigned</p>');
					echo json_encode(array('status'=>'error', 'data'=>"", 'message'=>"Error in assigned")); die;
				}
				
		}
		else{
			
			
			
			$message = validation_errors();
			echo json_encode(array('status'=>'error', 'data'=>"", 'message'=>$message)); die;
		}		
		
	}
	
	
	
	
}
