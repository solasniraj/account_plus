<?php

class Program_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    function insert_programm_listing($id,$code, $programName, $programBudget, $category)
    {
        $data = Array(
            'code' => $code,
            'programName' => $programName,
            'programBudget' => $programBudget,
            'category' => $category,
            'user_id' =>$id
            );
       return  $this->db->insert('user_programs_list', $data);
    }
  function  view_programm_listing($id) 
  {
    $this->db->order_by('id', 'DESC');
    $this->db->where('user_id', $id);
    $query = $this->db->get("user_programs_list");
    return $query->result();

  }

    
    
}