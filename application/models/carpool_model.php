<?php

class Carpool_model extends CI_Model{
     
  // function carpool_model(){

  //   parent::Model();         
  // }

  // public function add_carpooler(){

  //   $this->load->database();

  //   $data = array(

  //             'parent_id'=>$this->input->post('parent_id'),
  //             'student_id'=>$this->input->post('student_id'),
  //             'activity_id'=>$this->input->post('activity_id'),
  //             'can_drive_up'=>$this->input->post('can_drive_up'),
  //             'can_drive_return'=>$this->input->post('can_drive_return'),
  //             'notes'=>$this->input->post('notes'),
  //             'created_at'=>$this->input->post('created_at'),
  //             'updated_at'=>$this->input->post('updated_at'),
  //           );

  //   $this->db->insert('carpoolers',$data);
  // }

  // public function get_carpool_list(){

  //   $this->load->database();
  //       //$this->load->library('table');
       
  //       $query = $this->db->query('SELECT * FROM carpoolers 
  //                                  LEFT JOIN parents on carpoolers.parent_id = parents.id'); 

  //       // $table = $this->table->generate($query);
  //       // return $table;  
  //       $query = $this->db->get('carpoolers');
  //       return $query->result();
  // }

  public function get_activity_list() {

    // $query_activity = $this->db->query('SELECT activity_name,id FROM activities');
    // $query = $this->db->get($query_activity);

    $result = $this->db->select('id, activity_name,address_street,address_city,address_zipcode, address_state_id,
                                activity_start_date, activity_start_time,
                                activity_end_time, student_id,student_parent_id')
                        ->from('activities')
                        ->get()
                        ->result_array();
    return $result;
  }

  public function get_carpool_list($activity_id) {

    $carpool_result = $this->db->select('C.id, concat(students.first_name || students.last_name) AS student_name,
                           home_school_name, concat(parents.first_name || parents.last_name) AS parent_name, can_drive,
                           can_drive_up,can_drive_return')
                           ->from ('carpoolers as C')
                           ->where ('activity_id', $activity_id)
                           ->join('parents', 'parents.id = C.parent_id', 'LEFT')
                           ->join ('students','students.id = C.student_id','LEFT')
                           ->get()
                           ->result_array();
    return $carpool_result;
    var_dump($result_array);
  }

  // $carpool_records_query = "SELECT concat(students.first_name || students.last_name) AS student_name,
  //                          home_school_name, concat(parents.first_name || parents.last_name) AS parent_name,
  //                          can_drive_up,can_drive_return
  //                          FROM carpoolers, parents, students
  //                          WHERE activity_id = '{$_POST['id']}'
  //                          LEFT JOIN parents ON parent_id = id
  //                          AND students on student_id = id
  //                          ORDER BY id DESC";
  }

    
          // foreach($result->result_array() as $row)
          // {$activity[$row->id] = $row->activity_name;
            //$states[] = $row;
              // $states[$row['id']] = $row['id'];
              // $states[$row['state_abbrev']] = $row['state_abbrev'];
              // $states[$row['state_name']] = $row['state_name'];
        // } // end 
    // }
    // return $query_activity->result();
   
