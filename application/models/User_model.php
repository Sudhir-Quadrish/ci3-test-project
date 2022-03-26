<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

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
	
	
	
	
	
	function get_products()
	{ 
		$res =array();
	    $this->db->select('id as Id ,title as productName , description as  productDes, status as productStatus ');
		$this->db->from('tbl_product');
		$this->db->where('status','Active');
		$query = $this->db->get();
	
		if($query->num_rows() > 0 ){
			$res = $query->result_array();
		}
		
		
		return $res;
		
	}
	
	
	
	function get_assign_products($user_id)
	{ 
		$res =array();
	    $this->db->select('p.id as Id ,p.title as productName , p.description as  productDes, u.product_price as productPrice, u.product_count as prodNumber ');
		$this->db->from('tbl_product p');
		$this->db->join('tbl_user_products u','u.product_id=p.id','INNER');
		$this->db->where('p.status','Active');
		$this->db->where('u.user_id',$user_id);
		$query = $this->db->get();
	
		if($query->num_rows() > 0 ){
			$res = $query->result_array();
		}
		
		
		return $res;
		
	}




}