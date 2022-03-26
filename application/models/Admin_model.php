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


	function random_strings($length_of_string)
{
 
    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
 
    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result),
                       0, $length_of_string);
}



}