<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller 
{
//should have one function per page/view
//pass session data thru this variable to view since session is not available across views
	private $show_data;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Register_model');
	}
	
	/*
	public function index()
	{	
		$data = array();

		$this->show_data['errors_registration'] = $this->session->flashdata('errors_registration');
		// - SS - $this->load->view('register_view', $this->show_data);
		$this->load->view('register_view', $data);

	}
	*/
	
	public function register_home()
	{
		$data = array();
		$this->load->model('register_model');
		$data['states'] = $this->register_model->get_states_dropdown();
		// - SS - $this->session->set_flashdata('errors_registration'," ");
		// - SS - $this->load->view('register_view','refresh');
		$this->load->view('register_view',$data);
	}

	public function register_process()
	{
		$data = array();

		//var_dump($_POST);
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('security');
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('address_street', 'Address street', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address_city', 'City', 'trim|required|alpha|xss_clean');
		$this->form_validation->set_rules('address_zipcode', 'Zip Code', 'trim|required|exact_length[5]|numeric|xss_clean');
		$this->form_validation->set_rules('address_state', 'Address State', 'trim|alpha|required|xss_clean');
		$this->form_validation->set_rules('address_country', 'Address Country', 'trim|alpha|required|xss_clean');
		$this->form_validation->set_rules('phone_home', 'Home Phone', 'trim|required|xss_clean|regex_match[/\+?1?[-\s.]?\(?(\d{3})\)?[-\s.]?(\d{3})[-\s.]?(\d{4})/]');
		$this->form_validation->set_rules('phone_mobile', 'Mobile Phone', 'trim|required|xss_clean|regex_match[/\+?1?[-\s.]?\(?(\d{3})\)?[-\s.]?(\d{3})[-\s.]?(\d{4})/]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[20]');
		$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE)

		{  //echo ('validation failed');
		  	$this->session->set_flashdata('errors_registration', validation_errors());
			// - SS - redirect(base_url('/register/index'));
			//var_dump($data);
			$this->load->view('register_view',$data);
			  	
		}
		else
		  	// you have valid data so can post to DB if it is not a duplicate user
		{	  	
		  	// check for duplicate email - does email already exists in DB
		  	$this->load->model('Register_model');
			$email = $this->input->post('email');
			
			$does_user_exist = $this->Register_model->check_user_exists($email);
			
			if ($does_user_exist !=0)
			{ //var_dump($does_user_exist);
				$this->session->set_flashdata("message_duplicate","<h4>Duplicate user - email already exists - reenter new user !!</h4>");
				redirect(base_url('/register/index'));
			}
			else
			{	
			  	$this->load->model('Register_model');

				$data=array(
			    'first_name'=>$this->input->post('first_name'),
			    'last_name'=>$this->input->post('last_name'),
			    'email'=>$this->input->post('email'),
			    'address_street'=>$this->input->post('address_street'),
			    'address_city'=>$this->input->post('address_city'),
			    'address_zipcode'=>$this->input->post('address_zipcode'),
			    'address_state'=>$this->input->post('address_state'),
			    'address_country'=>$this->input->post('address_country'),
			    //use sha1 encryption for password 
			    'password'=>sha1($this->input->post('password')),
			    'created_at' => now(),
			    'updated_at' => now(),
			    );

			    $this->input->security->xss_clean('data');
				$result = $this->Register_model->add_user($data);
				//check result if insert went thru correctly
				if ($result)
				{
					$this->session->set_flashdata("message_success","<font class='success'>User Successfully Registered - Please login !!</font>");
					//go back to index page so new user can login
					redirect(base_url('/login/index'));
				}
				else
				{


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
			  $this->session->unset_userdata($newdata);
			  $this->session->sess_destroy();
			  $this->index();
	}
}
?>