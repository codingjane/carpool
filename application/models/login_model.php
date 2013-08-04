<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_model
{
//Models should contain only the sql query part - move everything else to the controller
	public function login_user($email, $password)
	{
		$user_query = "SELECT id,first_name,last_name,email,password 
			   		   FROM users
			    	   WHERE email = '{$email}' and password = '{$password}'";

		$result = array (
			'user'=>$this->db->query($user_query)
			);
		//var_dump($result);
		return $row=$result['user']->row();
	}

	public function check_user_exists($email)
	{ // function checks if user's email is unique in DB
		$check_user_query = "SELECT id,first_name,last_name,email,password 
			   		   		 FROM users
			   		   		 WHERE email = '{$email}'";
		$query = $this->db->query($check_user_query);
		$count = $query->num_rows();
		return $count;

	}
	public function add_user($data)
 	{
	  $result = $this->db->insert('users',$data);
	  return $result;
	  
 	}
}
?>
