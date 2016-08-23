<?php

class Program_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    function insert_programm_listing($id, $programName)
    {
        $data = Array(
            'code' => 00531,
            'program_name' => $programName,
            'user_id' =>$id
            );
       return  $this->db->insert('programs_list', $data);
    }
  function  view_programm_listing($id) 
  {
    $this->db->order_by('id', 'DESC');
    $this->db->where('user_id', $id);
    $query = $this->db->get("programs_list");
    return $query->result();

  }

    
    
}