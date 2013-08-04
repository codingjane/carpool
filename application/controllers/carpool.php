<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$data = array();
class Carpool extends CI_Controller 
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Carpool_model');
  }
	
  public function carpool_home()
  {
      //load one record at a time
      //data = array();
      $this->load->model('Carpool_model');

      $data['activity'] = $this->Carpool_model->get_activity_list();
      $data['carpool_list'] = $this->Carpool_model->get_carpool_list(1);
      $this->load->view('carpool_main_view',$data);

  }

  public function get_carpool_list()
  {
    //$data = array();
    //echo 'am here';
    //var_dump($this->session->all_userdata());
    $this->load->model('Carpool_model');

    $data['activity'] = $this->session->userdata();
    $data['carpool_list'] = $this->Carpool_model->get_carpool_list(1);
    $this->load->view('carpool_main_view',$data);
  }

//         $data['carpool_list'] = $html;
//      // $_SESSION['carpool_list'] = $html;
//      //header("Location: index.php");
// }

} 

?>
