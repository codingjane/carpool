<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
//should have one function per page/view
//pass session data thru this variable to view since session is not available across views
	private $view_data;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		$this->view_data['errors_login'] = $this->session->flashdata('errors_login');
		$this->load->view('login_view', $this->view_data);

	}
	public function home()
	{
		//if you login - go to landing page or user profile page
		$this->load->view('home_view');
	}

	public function login_process() 
	{   //var_dump('in login'); die();
		//var_dump($_POST);
		$this->load->helper('date');
		$this->load->library('form_validation');

		// validate email
		$this->form_validation->set_rules('email', 'Email', 'required');
		//$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[20]');

		if ($this->form_validation->run() == FALSE)
		{	//go back to login form and show errors
			$this->session->set_flashdata('errors_login', validation_errors());
			redirect(base_url('/login/index'));
			
		}
		else
		{
			//validate against database and see if user has registered
			//use first letter as capital for loading models
			$this->load->model('Login_model');
			$email = $this->input->post('email');
			$password = sha1($this->config->item('salt').$this->input->post('password'));

			$result = $this->Login_model->login_user($email, $password);
			//var_dump($result); die();

			if (!empty($result))
			{ 
				$session_data = array(
					   'user_id' => $result->id,
	                   'first_name'  => $result->first_name,
	                   'last_name'  => $result->last_name,
	                   'email'     => $result->email,
	                   'logged_in' => TRUE
	               );

				//save session info with a key of 'user_info'
			   $this->session->set_userdata('user_info', $session_data);
			   redirect(base_url('/login/home'));

			}
			else
			{	//your table has duplicates so data issue 
				$this->session->set_flashdata("message_duplicate","<font class='warning'>Duplicate person in DataBase!!</font>");
				redirect(base_url('/login/index'));
			}			
		}
		
	}// end of function	

	public function registration_process()
	{
		//var_dump('in registration');
		//var_dump($_POST);
		$this->load->helper('date');
		$this->load->library('form_validation');
		$this->load->library('security');
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[20]');
		$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

		if($this->form_validation->run() == FALSE)
		{
		  	$this->session->set_flashdata('errors', validation_errors());
			redirect(base_url('/login/index'));
			  	
		}
		else
		  	// you have valid data so can post to DB if it is not a duplicate user
		{	  	
		  	// check for duplicate email - does email already exists in DB
		  	$this->load->model('Login_model');
			$email = $this->input->post('email');
			
			$does_user_exist = $this->Login_model->check_user_exists($email);
			
			if ($does_user_exist !=0)
			{ //var_dump($does_user_exist);
				$this->session->set_flashdata("message_duplicate","<h4>Duplicate user - email already exists - reenter new user !!</h4>");
				redirect(base_url('/login/index'));
			}
			else
			{	
			  	$this->load->model('Login_model');

				$data=array(
			    'first_name'=>$this->input->post('first_name'),
			    'last_name'=>$this->input->post('last_name'),
			    'email'=>$this->input->post('email'),
			    //use sha1 encryption for password 
			    'password'=>sha1($this->input->post('password')),
			    'created_at' => now(),
			    'updated_at' => now(),
			    );

			    $this->input->security->xss_clean('data');
				$result = $this->Login_model->add_user($data);
				//check result if insert went thru correctly
				if ($result)
				{
					$this->session->set_flashdata("message_success","<font class='success'>User Successfully Registered - Please login !!</font>");
					//go back to index page so new user can login
					redirect(base_url('/login/index'));
				}//end - after creation of new user in DB
			}//end - user does not exist in DB	
		}//end - post new user to DB
	}// end - of function

	public function logout()
	{
			  $newdata = array(
			  'user_id'   =>'',
			  'first_name'  =>'',
			  'last_name'  =>'',
			  'email'     => '',
			  'logged_in' => FALSE,
			  );
			  $this->session->unset_userdata($newdata );
			  $this->session->sess_destroy();
			  $this->index();
	}
}
?>