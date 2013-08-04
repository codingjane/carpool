
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller 
{

		public function main(){

		  $this->load->library('table');

		  $this->load->helper('html');  

		  $this->load->model('carpool_model');

		  $data = $this->carpool_model->general();

		  $data['query'] = $this->carpool_model->get_carpool_list(event_id);

		  $this->load->view('carpoolers_view',$data);

		}
}
?>
