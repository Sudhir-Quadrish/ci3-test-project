<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model {

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
	
	
	function check_login($email, $password)
	{ 
	
	    $this->db->select('id,first_name,password,login_type, last_name, email, status,is_verified');
		$this->db->from('tbl_login');
		$this->db->where('email',$email);
		$query = $this->db->get();
		if($query->num_rows() > 0 ){
			$row = $query->row_array();
			if($row['is_verified']==1)
			{
				if($row['status']=='Active')
				{
					
					if($row['password']=trim($password))
					{
						$res['data']  = array('id'=>$row['id'],'first_name'=>$row['firstName'],'last_name'=>$row['last_name'],'email'=>$row['email'],'user_type'=>$row['login_type']);
						$res['status']='success';
					}
					else{
						$res['status']='error';
						$res['message']='Please enter correct password.';
					}
				}
				else{
						$res['status']='error';
						$res['message']='Your account is in '.$row['status'].' status';
				}					
			}
			else{
				$res['status']='error';
			    $res['message']='Your account is not verified.';
				
			}
		}
		else{
			$res['status']='error';
			$res['message']='Please enter correct email';
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