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
		$user_data['user_data'] = $this->admin_model->get_user_count_stat();
		
		$user_data['product'] = $this->admin_model->get_product_count_stat();
		
		$user_data['users'] = $this->admin_model->get_user_product();
		
		
		//print_r($user_data); die;
		
		$this->load->view('admin_user',$user_data);
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
	
	public function edit_product()
	{
		    $status='';
			$pr_id = $this->uri->segment(3);
			$con = array('id'=>$pr_id);
			$product =$this->admin_model->get_row_data('tbl_product',$con);
				if($product['status'])
				{
					if($product['status']=='Active') 
						$update['status'] = 'Inactive';
					else
						$update['status'] = 'Active';
					$status = $this->admin_model->update_row_data('tbl_product',$con,$update);
			
					if($status)
					{
						$this->session->set_flashdata('message','<p style="color:green">Status Updated.</p>');
					}
					else{
						$this->session->set_flashdata('message','<p style="color:red">Error in update status.</p>');
					}
				}	
				else{
						$this->session->set_flashdata('message','<p style="color:red">Invalid product.</p>');
					}	
		redirect(base_url('Admin/products'));
				  
	}
	
	
	
	function get_exchange_ron_rate()
	{
		$this->load->config('exchage_api');
		$this->load->helper('exchange_rate');
		
		
		$access_key = $this->config->item('API_KEY');
		
		$endpoint = 'convert';
		$from = 'EURO';
		$to = 'UDS';
		$amount = 10;
		
		$res = get_exchange_rate($endpoint, $from, $to,$amount, $access_key);

		print_r($res); die;
	}
	
	function get_exchange_dollor_rate()
	{
		$this->load->config('exchage_api');
		$this->load->helper('exchange_rate');
		
		
		$access_key = $this->config->item('API_KEY');
		
		$endpoint = 'convert';
		$from = 'EURO';
		$to = 'UDS';
		$amount = 10;
		
		$res = get_exchange_rate($endpoint, $from, $to,$amount, $access_key);

		print_r($res); die;
	}
	
	function exchange_data()
	{
		$this->load->config('exchage_api');
		
		$access_key = $this->config->item('API_KEY');
		// set API Endpoint, access key, required parameters
		$endpoint = 'convert';
		
		$from = 'USD';
		$to = 'EUR';
		$amount = 10;

		// initialize CURL:
		$ch = curl_init('https://api.exchangeratesapi.io/v1/'.$endpoint.'?access_key='.$access_key.'&from='.$from.'&to='.$to.'&amount='.$amount.'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// get the JSON data:
		$json = curl_exec($ch);
		print_r($json);
		curl_close($ch);

		// Decode JSON response:
		$conversionResult = json_decode($json, true);

		// access the conversion result
		echo $conversionResult['result'];
		
	}
}
