<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    function __construct(){
		
		parent::__construct();
	
	}
	
	function insert_row($table,$data)
	{
		if($this->db->insert($table,$data))
		{
			return $this->db->insert_id();
		}
		
	}
	
	
	function get_row_data($table,$con)
	{	
		$res = array();
		$query = $this->db->select('*')->from($table)->where($con)->get();
		if($query->num_rows() > 0 )
			$res = $query->row_array();
		
		return $res;
	}
	
	
	function update_row_data($table,$con,$data)
	{	
		$res = array();
		$this->db->where($con);
		$status = $this->db->update($table,$data);
		
		
		return $status;
	}
	
	function get_select_data($table,$column, $con)
	{	
		$res = array();
		$colms = implode(',',$column);
		$query = $this->db->select("$colms")->from($table)->where($con)->get();
		if($query->num_rows() > 0 )
			$res = $query->row_array();
		return $res;
	}
	
	
	function get_users()
	{ 
		$res =array();
	    $this->db->select('id as Id,first_name as firstName, last_name as lastName, email as userEmail, (CASE WHEN is_verified=1 THEN "Verified" ELSE "Un Verified" END) as userStatus ',FALSE);
		$this->db->from('tbl_login');
		$this->db->where('login_type','user');
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			$res = $query->result_array();
		}
		
		
		return $res;
		
	}
	
	
	
	function get_products()
	{ 
		$res =array();
	    $this->db->select('id as Id ,title as productName , description as  productDes, status as productStatus ');
		$this->db->from('tbl_product');
		$query = $this->db->get();
	
		if($query->num_rows() > 0 ){
			$res = $query->result_array();
		}
		return $res;
		
	}
	public function get_user_count_stat(){
		$res =array();
		$this->db->select('(Select count(*) FROM tbl_login WHERE is_verified="1") as verified');
		$this->db->select('(Select count(*) FROM tbl_login WHERE is_verified="0") as un_verified');
		$this->db->select('(Select count(*) FROM tbl_user_products p  INNER JOIN  tbl_product tp ON tp.id=p.product_id INNER JOIN  tbl_login l ON p.user_id=l.id WHERE tp.status="Active" AND l.is_verified="1" ) as ap_user_product');
		$this->db->from('tbl_login');
		$query = $this->db->get();
		if($query->num_rows() >0)
		{
			$res = $query->row_array();
		
		}
		
		return $res;

	}
	
	public function get_product_count_stat(){
		$res =array();
		$this->db->select('(Select count(*) FROM tbl_product WHERE status="Active") as acitve_product');
		
		$this->db->select('(Select count(*) FROM tbl_product WHERE id NOT IN(Select product_id FROM tbl_user_products )) as not_attach_product');
		
		$this->db->select('(Select sum((product_count)) FROM tbl_user_products p INNER JOIN  tbl_product tp ON tp.id=p.product_id INNER JOIN  tbl_login l ON p.user_id=l.id WHERE tp.status="Active" AND l.is_verified="1") as attach_product_count');
		
		$this->db->select('(Select sum((product_price*product_count)) FROM tbl_user_products p INNER JOIN  tbl_product tp ON tp.id=p.product_id INNER JOIN  tbl_login l ON p.user_id=l.id WHERE tp.status="Active" AND l.is_verified="1") as total_amount');
	
		$this->db->from('tbl_product');
		$query = $this->db->get();
		if($query->num_rows() >0)
		{
			$res = $query->row_array();
		
		}
		
		return $res;

	}
	
	
	function get_user_product()
	{ 
		$res =array();
	    $this->db->select('first_name as firstName, last_name as lastName');
		
		$this->db->select('(Select sum((product_price*product_count)) FROM tbl_user_products p INNER JOIN  tbl_product tp ON tp.id=p.product_id WHERE tp.status="Active" AND p.user_id=tbl_login.id) as total_amount');
		
		
		$this->db->from('tbl_login');
		$this->db->where('login_type','user');
		$this->db->where('is_verified','1');
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ){
			$res = $query->result_array();
		}
		
		
		return $res;
		
	}


}