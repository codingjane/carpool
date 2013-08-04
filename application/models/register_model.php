<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_model
{
//Models should contain only the sql query part - move everything else to the controller
	// public function login_user($email, $password)
	// {
	// 	$user_query = "SELECT id,first_name,last_name,email,password 
	// 		   		   FROM parents
	// 		    	   WHERE email = '{$email}' and password = '{$password}'";

	// 	$result = array (
	// 		'user'=>$this->db->query($user_query)
	// 		);
	// 	//var_dump($result);
	// 	return $row=$result['user']->row();
	// }

		public function check_user_exists($email)
		{ // function checks if user's email is unique in DB
			$check_user_query = "SELECT id,first_name,last_name,email,password 
				   		   		 FROM parents
				   		   		 WHERE email = '{$email}'";
			$query = $this->db->query($check_user_query);
			$count = $query->num_rows();
			return $count;

		}//end function

		public function add_user($data)
	 	{
		  $result = $this->db->insert('parents',$data);
		  return $result;
		  
	 	}//end function add_user

		function get_states_dropdown()
		{
			$state_query = "SELECT id,state_name from states ORDER BY state_name";
			$result = $this->db->query($state_query);
			$states = array();

		    if($result->num_rows() > 0){

		           $states[''] = 'please select';
		        foreach($result->result_array() as $row)
		        {	$states[$row->id] = $row->state_name;
		        	//$states[] = $row;
		            // $states[$row['id']] = $row['id'];
		            // $states[$row['state_abbrev']] = $row['state_abbrev'];
		            // $states[$row['state_name']] = $row['state_name'];
		        } // end 
		    }
		    return $states;
		}

} // end of class
?>
